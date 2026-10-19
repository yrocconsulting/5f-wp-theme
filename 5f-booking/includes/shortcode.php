<?php
/**
 * [fivef_booking] — the public booking calendar.
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_shortcode( 'fivef_booking', 'fivef_bk_shortcode' );

/**
 * Message for a guest returning from Stripe Checkout.
 *
 * @return string HTML or ''.
 */
function fivef_bk_return_notice() {
	// phpcs:disable WordPress.Security.NonceVerification.Recommended -- links from Stripe; the booking token is the check.
	$id    = isset( $_GET['bk'] ) ? absint( $_GET['bk'] ) : 0;
	$token = isset( $_GET['t'] ) ? sanitize_text_field( wp_unslash( $_GET['t'] ) ) : '';
	if ( ! $id || 'fivef_booking' !== get_post_type( $id ) ) {
		return '';
	}
	$b = fivef_bk_get( $id );
	if ( ! $token || ! hash_equals( (string) $b['token'], $token ) ) {
		return '';
	}
	if ( ! empty( $_GET['cancelled'] ) && 'pending' === $b['status'] ) {
		if ( $b['session'] ) {
			fivef_bk_stripe( 'POST', 'checkout/sessions/' . rawurlencode( $b['session'] ) . '/expire' );
		}
		fivef_bk_set_status( $id, 'cancelled', 'guest left checkout' );
		$b['status'] = 'cancelled';
	} elseif ( ! empty( $_GET['session_id'] ) ) {
		fivef_bk_stripe_sync( $id, sanitize_text_field( wp_unslash( $_GET['session_id'] ) ) );
		$b = fivef_bk_get( $id );
	}
	// phpcs:enable

	$when = fivef_bk_date_label( $b['type'], $b['date'] );
	if ( in_array( $b['status'], array( 'paid', 'confirmed' ), true ) ) {
		$cls = 'is-success';
		$msg = sprintf(
			/* translators: 1: hunt date, 2: number of hunters, 3: email address */
			__( '<strong>You’re booked!</strong> Your deposit was received for %1$s (%2$d hunters). A confirmation is on its way to %3$s.', '5f-booking' ),
			esc_html( $when ),
			$b['people'],
			esc_html( $b['email'] )
		);
	} elseif ( 'pending' === $b['status'] ) {
		$cls = 'is-info';
		$msg = __( '<strong>Payment processing.</strong> We’ll email you as soon as your deposit is confirmed.', '5f-booking' );
	} else {
		$cls = 'is-warning';
		$msg = __( '<strong>No payment was taken</strong> and the dates were released. Pick a date below to try again.', '5f-booking' );
	}
	return '<div class="fivef-bk-notice ' . esc_attr( $cls ) . '" role="status">' . wp_kses_post( $msg ) . '</div>';
}

/**
 * Render the calendar.
 *
 * @param array $atts Shortcode attributes: type (hog|duck) to preselect.
 * @return string
 */
function fivef_bk_shortcode( $atts ) {
	$atts  = shortcode_atts( array( 'type' => '' ), $atts, 'fivef_booking' );
	$types = array();
	foreach ( fivef_bk_types() as $key => $t ) {
		if ( ! $t['enabled'] ) {
			continue;
		}
		$types[ $key ] = array(
			'label'      => $t['label'],
			'summary'    => $t['summary'],
			'unit'       => $t['unit'],
			'mode'       => $t['mode'],
			'capacity'   => $t['capacity'],
			'min'        => $t['min'],
			'max'        => $t['max'],
			'price'      => $t['price'],
			'groupPrice' => $t['group_price'],
			'deposit'    => $t['deposit'],
			'terms'      => $t['terms'],
		);
	}
	$start = isset( $_GET['type'] ) ? sanitize_key( wp_unslash( $_GET['type'] ) ) : sanitize_key( $atts['type'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	wp_enqueue_style( 'fivef-booking', FIVEF_BK_URL . 'assets/booking.css', array(), FIVEF_BK_VERSION );
	wp_enqueue_script( 'fivef-booking', FIVEF_BK_URL . 'assets/booking.js', array(), FIVEF_BK_VERSION, true );

	$phone  = function_exists( 'fivef_contacts' ) ? fivef_contacts()['booking']['phone'] : '817-703-3689';
	$config = array(
		'api'    => esc_url_raw( rest_url( 'fivef/v1/' ) ),
		'types'  => $types,
		'start'  => isset( $types[ $start ] ) ? $start : '',
		'online' => '' !== fivef_bk_stripe_key(),
		'phone'  => $phone,
	);

	return fivef_bk_return_notice()
		. '<div class="fivef-bk" data-config="' . esc_attr( wp_json_encode( $config ) ) . '">'
		. '<p class="fivef-bk-loading">' . esc_html__( 'Loading open dates…', '5f-booking' ) . '</p>'
		. '<noscript><p>' . sprintf(
			/* translators: %s: phone number */
			esc_html__( 'The booking calendar needs JavaScript. Please call %s to book.', '5f-booking' ),
			esc_html( $phone )
		) . '</p></noscript></div>';
}

// The booking page shows live state (payment mode, return messages): keep it out of page caches.
add_action(
	'template_redirect',
	static function () {
		if ( is_singular() && has_shortcode( (string) get_post_field( 'post_content', get_queried_object_id() ), 'fivef_booking' ) || is_page( 'book' ) ) {
			nocache_headers();
			if ( ! defined( 'DONOTCACHEPAGE' ) ) {
				define( 'DONOTCACHEPAGE', true );
			}
		}
	}
);

// Switching payments on or off changes the booking page; clear SiteGround's cache when settings change.
foreach ( array( 'fivef_bk_stripe_secret', 'fivef_bk_duck_enabled', 'fivef_bk_duck_deposit' ) as $fivef_bk_opt ) {
	add_action(
		'update_option_' . $fivef_bk_opt,
		static function () {
			if ( function_exists( 'sg_cachepress_purge_everything' ) ) {
				sg_cachepress_purge_everything();
			}
		}
	);
}
