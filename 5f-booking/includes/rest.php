<?php
/**
 * Public endpoints: availability, new bookings, Stripe webhook.
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action(
	'rest_api_init',
	static function () {
		register_rest_route(
			'fivef/v1',
			'/availability',
			array(
				'methods'             => 'GET',
				'permission_callback' => '__return_true',
				'callback'            => 'fivef_bk_rest_availability',
			)
		);
		register_rest_route(
			'fivef/v1',
			'/book',
			array(
				'methods'             => 'POST',
				'permission_callback' => '__return_true',
				'callback'            => 'fivef_bk_rest_book',
			)
		);
		register_rest_route(
			'fivef/v1',
			'/stripe-webhook',
			array(
				'methods'             => 'POST',
				'permission_callback' => '__return_true',
				'callback'            => 'fivef_bk_rest_webhook',
			)
		);
	}
);

/**
 * Open dates per enabled hunt type.
 *
 * @return WP_REST_Response
 */
function fivef_bk_rest_availability() {
	$out = array();
	foreach ( fivef_bk_types() as $key => $t ) {
		if ( ! $t['enabled'] ) {
			continue;
		}
		$out[ $key ] = array(
			'dates' => fivef_bk_availability( $key ),
		);
	}
	$res = new WP_REST_Response( $out );
	$res->header( 'Cache-Control', 'no-store, max-age=0' );
	return $res;
}

/**
 * Error response.
 *
 * @param string $msg Message for the guest.
 * @param int    $code HTTP status.
 * @return WP_REST_Response
 */
function fivef_bk_fail( $msg, $code = 400 ) {
	return new WP_REST_Response( array( 'error' => $msg ), $code );
}

/**
 * Create a booking and start payment.
 *
 * @param WP_REST_Request $req Request.
 * @return WP_REST_Response
 */
function fivef_bk_rest_book( WP_REST_Request $req ) {
	$p = $req->get_json_params();
	$p = is_array( $p ) ? $p : $req->get_body_params();
	$g = static function ( $k ) use ( $p ) {
		return isset( $p[ $k ] ) ? trim( (string) $p[ $k ] ) : '';
	};

	// Spam: a hidden field people never fill in, and a simple per-visitor limit.
	if ( '' !== $g( 'company' ) ) {
		return fivef_bk_fail( __( 'Something went wrong. Please call us to book.', '5f-booking' ) );
	}
	$ip   = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$rl   = 'fivef_bk_rl_' . md5( $ip );
	$hits = (int) get_transient( $rl );
	if ( $hits >= 8 ) {
		return fivef_bk_fail( __( 'Too many attempts. Please wait a few minutes or call us to book.', '5f-booking' ), 429 );
	}
	set_transient( $rl, $hits + 1, 15 * MINUTE_IN_SECONDS );

	$type = sanitize_key( $g( 'type' ) );
	$t    = fivef_bk_type( $type );
	if ( ! $t || ! $t['enabled'] ) {
		return fivef_bk_fail( __( 'That hunt isn’t available to book online.', '5f-booking' ) );
	}
	$date  = $g( 'date' );
	$dates = fivef_bk_dates( $type );
	if ( ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) || empty( $dates[ $date ] ) || $date <= fivef_bk_today() ) {
		return fivef_bk_fail( __( 'That date isn’t open for booking. Please pick another.', '5f-booking' ) );
	}
	$people = (int) $g( 'people' );
	if ( $people < $t['min'] || $people > $t['max'] ) {
		/* translators: 1: minimum, 2: maximum */
		return fivef_bk_fail( sprintf( __( 'Please choose between %1$d and %2$d hunters.', '5f-booking' ), $t['min'], $t['max'] ) );
	}
	$name  = sanitize_text_field( $g( 'name' ) );
	$email = sanitize_email( $g( 'email' ) );
	$phone = sanitize_text_field( $g( 'phone' ) );
	$notes = sanitize_textarea_field( $g( 'notes' ) );
	if ( '' === $name || ! is_email( $email ) || strlen( preg_replace( '/\D/', '', $phone ) ) < 10 ) {
		return fivef_bk_fail( __( 'Please enter your name, a valid email and a phone number.', '5f-booking' ) );
	}
	if ( ! $g( 'agree' ) || 'false' === $g( 'agree' ) ) {
		return fivef_bk_fail( __( 'Please confirm you understand the deposit terms.', '5f-booking' ) );
	}

	$lock = $type . $date;
	if ( ! fivef_bk_lock( $lock ) ) {
		return fivef_bk_fail( __( 'The calendar is busy. Please try again.', '5f-booking' ), 503 );
	}
	$left = fivef_bk_left( $type, $date );
	$fits = 'group' === $t['mode'] ? $left > 0 : $people <= $left;
	if ( ! $fits ) {
		fivef_bk_unlock( $lock );
		return fivef_bk_fail(
			$left > 0 && 'spots' === $t['mode']
				/* translators: %d: spots left */
				? sprintf( _n( 'Only %d spot is left on that date.', 'Only %d spots are left on that date.', $left, '5f-booking' ), $left )
				: __( 'Sorry, that date was just booked. Please pick another.', '5f-booking' ),
			409
		);
	}

	$addon  = '' !== $g( 'addon' ) && 'false' !== $g( 'addon' ) && '0' !== $g( 'addon' ) && fivef_bk_addon_allowed( $type, $people );
	$q      = fivef_bk_quote( $type, $people, $date, $addon );
	$stripe = '' !== fivef_bk_stripe_key();
	$id     = wp_insert_post(
		array(
			'post_type'   => 'fivef_booking',
			'post_status' => 'publish',
			'post_title'  => $name . ' · ' . $t['short'] . ' · ' . $date,
		),
		true
	);
	if ( is_wp_error( $id ) ) {
		fivef_bk_unlock( $lock );
		return fivef_bk_fail( __( 'We couldn’t save your booking. Please call us.', '5f-booking' ), 500 );
	}
	$meta = array(
		'type'       => $type,
		'date'       => $date,
		'people'     => $people,
		'name'       => $name,
		'email'      => $email,
		'phone'      => $phone,
		'notes'      => $notes,
		'total'      => $q['total'],
		'deposit'    => $q['deposit'],
		'balance'    => $q['balance'],
		'addon'      => $q['addon'] ? 1 : 0,
		'token'      => wp_generate_password( 20, false ),
		'hold_until' => time() + FIVEF_BK_HOLD_MINUTES * MINUTE_IN_SECONDS,
	);
	foreach ( $meta as $k => $v ) {
		update_post_meta( $id, '_fivef_' . $k, $v );
	}
	fivef_bk_set_status( $id, $stripe ? 'pending' : 'requested' );
	fivef_bk_unlock( $lock );

	if ( ! $stripe ) {
		fivef_bk_send_emails( $id, 'requested' );
		return new WP_REST_Response(
			array(
				'message' => __( 'Thanks! Your dates are held and we’ve emailed you a copy. We’ll contact you shortly to take the deposit and confirm your hunt.', '5f-booking' ),
			)
		);
	}

	$session = fivef_bk_stripe_checkout( $id );
	if ( is_wp_error( $session ) || empty( $session['url'] ) ) {
		fivef_bk_set_status( $id, 'cancelled', 'Stripe: ' . ( is_wp_error( $session ) ? $session->get_error_message() : 'no URL' ) );
		return fivef_bk_fail( __( 'We couldn’t start the payment. Please try again, or call us to book.', '5f-booking' ), 502 );
	}
	update_post_meta( $id, '_fivef_session', $session['id'] );
	return new WP_REST_Response( array( 'redirect' => $session['url'] ) );
}

/**
 * Stripe webhook: record payments and release unpaid holds.
 *
 * @param WP_REST_Request $req Request.
 * @return WP_REST_Response
 */
function fivef_bk_rest_webhook( WP_REST_Request $req ) {
	$payload = $req->get_body();
	if ( ! fivef_bk_stripe_verify( $payload, (string) $req->get_header( 'stripe_signature' ), (string) get_option( 'fivef_bk_stripe_webhook', '' ) ) ) {
		return new WP_REST_Response( array( 'error' => 'bad signature' ), 400 );
	}
	$event = json_decode( $payload, true );
	$obj   = isset( $event['data']['object'] ) ? $event['data']['object'] : array();
	$id    = isset( $obj['metadata']['booking_id'] ) ? (int) $obj['metadata']['booking_id'] : 0;
	if ( ! $id || 'fivef_booking' !== get_post_type( $id ) ) {
		return new WP_REST_Response( array( 'ok' => true ) );
	}
	$b = fivef_bk_get( $id );
	if ( isset( $obj['id'] ) && $b['session'] && $obj['id'] !== $b['session'] ) {
		return new WP_REST_Response( array( 'ok' => true ) );
	}
	switch ( isset( $event['type'] ) ? $event['type'] : '' ) {
		case 'checkout.session.completed':
		case 'checkout.session.async_payment_succeeded':
			if ( isset( $obj['payment_status'] ) && 'paid' === $obj['payment_status'] ) {
				fivef_bk_mark_paid( $id, 'Stripe webhook' );
			}
			break;
		case 'checkout.session.expired':
			if ( 'pending' === $b['status'] ) {
				fivef_bk_set_status( $id, 'expired', 'Stripe checkout expired' );
			}
			break;
	}
	return new WP_REST_Response( array( 'ok' => true ) );
}
