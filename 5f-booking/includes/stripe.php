<?php
/**
 * Stripe Checkout through the REST API (no SDK needed).
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Secret key, or '' when online payments aren't set up.
 *
 * @return string
 */
function fivef_bk_stripe_key() {
	$key = trim( (string) get_option( 'fivef_bk_stripe_secret', '' ) );
	return ( 0 === strpos( $key, 'sk_' ) || 0 === strpos( $key, 'rk_' ) ) ? $key : '';
}

/**
 * Whether the key is a test key.
 *
 * @return bool
 */
function fivef_bk_stripe_test_mode() {
	return false !== strpos( fivef_bk_stripe_key(), '_test_' );
}

/**
 * Call the Stripe API.
 *
 * @param string $method GET or POST.
 * @param string $path   e.g. checkout/sessions.
 * @param array  $body   Form fields.
 * @return array|WP_Error
 */
function fivef_bk_stripe( $method, $path, $body = array() ) {
	$key = fivef_bk_stripe_key();
	if ( ! $key ) {
		return new WP_Error( 'fivef_bk_no_stripe', 'Stripe is not set up.' );
	}
	$res = wp_remote_request(
		'https://api.stripe.com/v1/' . $path,
		array(
			'method'  => $method,
			'timeout' => 25,
			'headers' => array(
				'Authorization'  => 'Bearer ' . $key,
				'Stripe-Version' => '2024-06-20',
			),
			'body'    => $body ? http_build_query( $body, '', '&' ) : null,
		)
	);
	if ( is_wp_error( $res ) ) {
		return $res;
	}
	$data = json_decode( wp_remote_retrieve_body( $res ), true );
	$code = (int) wp_remote_retrieve_response_code( $res );
	if ( $code >= 400 || ! is_array( $data ) ) {
		$msg = isset( $data['error']['message'] ) ? $data['error']['message'] : 'Stripe error ' . $code;
		return new WP_Error( 'fivef_bk_stripe', $msg );
	}
	return $data;
}

/**
 * Start Stripe Checkout for a booking's deposit.
 *
 * @param int $id Booking ID.
 * @return array|WP_Error Checkout Session.
 */
function fivef_bk_stripe_checkout( $id ) {
	$b    = fivef_bk_get( $id );
	$t    = fivef_bk_type( $b['type'] );
	$back = add_query_arg(
		array(
			'bk' => $id,
			't'  => $b['token'],
		),
		fivef_bk_page_url()
	);
	/* translators: 1: hunt name, 2: number of hunters */
	$desc = sprintf( _n( '%1$s · %2$d hunter', '%1$s · %2$d hunters', $b['people'], '5f-booking' ), fivef_bk_date_label( $b['type'], $b['date'] ), $b['people'] );
	return fivef_bk_stripe(
		'POST',
		'checkout/sessions',
		array(
			'mode'                => 'payment',
			'success_url'         => $back . '&session_id={CHECKOUT_SESSION_ID}',
			'cancel_url'          => $back . '&cancelled=1',
			'customer_email'      => $b['email'],
			'client_reference_id' => (string) $id,
			'expires_at'          => time() + 31 * MINUTE_IN_SECONDS,
			'metadata'            => array( 'booking_id' => (string) $id ),
			'payment_intent_data' => array(
				'description' => '5F Ranch deposit: ' . $t['label'] . ' · ' . $desc,
				'metadata'    => array( 'booking_id' => (string) $id ),
			),
			'line_items'          => array(
				array(
					'quantity'   => 1,
					'price_data' => array(
						'currency'     => 'usd',
						'unit_amount'  => $b['deposit'] * 100,
						'product_data' => array(
							/* translators: %s: hunt name */
							'name'        => sprintf( __( 'Deposit: %s', '5f-booking' ), $t['label'] ),
							'description' => $desc . ' · ' . $t['deposit_note'],
						),
					),
				),
			),
		)
	);
}

/**
 * Verify a webhook's Stripe-Signature header.
 *
 * @param string $payload Raw body.
 * @param string $header  Stripe-Signature header.
 * @param string $secret  Webhook signing secret (whsec_...).
 * @return bool
 */
function fivef_bk_stripe_verify( $payload, $header, $secret ) {
	if ( ! $secret || ! $header ) {
		return false;
	}
	$ts   = 0;
	$sigs = array();
	foreach ( explode( ',', $header ) as $part ) {
		$kv = explode( '=', trim( $part ), 2 );
		if ( 2 !== count( $kv ) ) {
			continue;
		}
		if ( 't' === $kv[0] ) {
			$ts = (int) $kv[1];
		} elseif ( 'v1' === $kv[0] ) {
			$sigs[] = $kv[1];
		}
	}
	if ( ! $ts || abs( time() - $ts ) > 300 ) {
		return false;
	}
	$expected = hash_hmac( 'sha256', $ts . '.' . $payload, $secret );
	foreach ( $sigs as $sig ) {
		if ( hash_equals( $expected, $sig ) ) {
			return true;
		}
	}
	return false;
}

/**
 * Check a returning guest's Checkout Session and record the payment if it went through.
 *
 * @param int    $id         Booking ID.
 * @param string $session_id Session from the success URL.
 */
function fivef_bk_stripe_sync( $id, $session_id ) {
	$b = fivef_bk_get( $id );
	if ( 'pending' !== $b['status'] && 'expired' !== $b['status'] ) {
		return;
	}
	if ( ! $session_id || $session_id !== $b['session'] ) {
		return;
	}
	$s = fivef_bk_stripe( 'GET', 'checkout/sessions/' . rawurlencode( $session_id ) );
	if ( ! is_wp_error( $s ) && isset( $s['payment_status'] ) && 'paid' === $s['payment_status'] ) {
		fivef_bk_mark_paid( $id, 'checkout return' );
	}
}
