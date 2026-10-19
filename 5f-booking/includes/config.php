<?php
/**
 * Hunt types, prices and settings.
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bookable hunt types.
 *
 * mode "spots": hunters book individual spots until the date's capacity is reached.
 * mode "group": one private group per date, between min and max people.
 *
 * @return array
 */
function fivef_bk_types() {
	$types = array(
		'hog'  => array(
			'label'       => __( 'Thermal Hog Hunt Weekend', '5f-booking' ),
			'short'       => __( 'Hog hunt', '5f-booking' ),
			'unit'        => 'weekend',
			'mode'        => 'spots',
			'capacity'    => 4,
			'min'         => 1,
			'max'         => 4,
			'price'       => 2000,
			'group_price' => 1800, // Per hunter when one booking takes every spot.
			'deposit'     => 1000, // Per hunter.
			'enabled'     => true,
			'summary'     => __( 'Two-day guided weekend · 4 hunters max · $2,000 per hunter, or $7,200 when you book all four spots · $1,000 deposit per hunter', '5f-booking' ),
			'terms'       => __( 'I understand the deposit is non-refundable and is applied to the total price. Hunters must be 18 or older.', '5f-booking' ),
			'deposit_note' => __( 'Non-refundable, applied to the total price.', '5f-booking' ),
		),
		'duck' => array(
			'label'       => __( 'Guided Duck Hunt', '5f-booking' ),
			'short'       => __( 'Duck hunt', '5f-booking' ),
			'unit'        => 'morning',
			'mode'        => 'group',
			'capacity'    => 1,
			'min'         => 4,
			'max'         => 6,
			'price'       => 300,
			'group_price' => 300,
			'deposit'     => (int) get_option( 'fivef_bk_duck_deposit', 150 ), // 50% of $300.
			'enabled'     => (bool) get_option( 'fivef_bk_duck_enabled', 0 ),
			'summary'     => __( 'One-morning guided hunt, 30 minutes before sunrise to 10 a.m. · 4 to 6 hunters · $300 per person · 50% deposit to book · larger groups, call 817-703-3689', '5f-booking' ),
			'terms'       => __( 'I understand the deposit is applied to the total price. Hunters must be 18 or older.', '5f-booking' ),
			'deposit_note' => __( 'Applied to the total price.', '5f-booking' ),
		),
	);
	return apply_filters( 'fivef_bk_types', $types );
}

/**
 * One hunt type, or null.
 *
 * @param string $type Type key.
 * @return array|null
 */
function fivef_bk_type( $type ) {
	$types = fivef_bk_types();
	return isset( $types[ $type ] ) ? $types[ $type ] : null;
}

/**
 * Price for a booking.
 *
 * @param string $type   Type key.
 * @param int    $people Hunters in the booking.
 * @return array per, total, deposit, balance (whole dollars) and discount flag.
 */
function fivef_bk_quote( $type, $people ) {
	$t        = fivef_bk_type( $type );
	$people   = max( 0, (int) $people );
	$discount = 'spots' === $t['mode'] && $people >= $t['capacity'] && $t['group_price'] < $t['price'];
	$per      = $discount ? $t['group_price'] : $t['price'];
	$total    = $per * $people;
	$deposit  = min( $total, $t['deposit'] * $people );
	return array(
		'per'      => $per,
		'total'    => $total,
		'deposit'  => $deposit,
		'balance'  => $total - $deposit,
		'discount' => $discount,
	);
}

/**
 * Where messages about bookings go.
 *
 * @return string
 */
function fivef_bk_ranch_email() {
	$email = get_option( 'fivef_bk_notify_email' );
	if ( ! is_email( $email ) ) {
		$email = get_option( 'fivef_contact_email' );
	}
	return is_email( $email ) ? $email : get_option( 'admin_email' );
}

/**
 * The page holding the [fivef_booking] shortcode.
 *
 * @return string
 */
function fivef_bk_page_url() {
	$page = get_page_by_path( 'book' );
	return $page ? get_permalink( $page ) : home_url( '/book/' );
}

/**
 * Human label for a hunt date.
 *
 * @param string $type Type key.
 * @param string $date Y-m-d.
 * @return string
 */
function fivef_bk_date_label( $type, $date ) {
	$t  = fivef_bk_type( $type );
	$ts = strtotime( $date . ' 12:00:00' );
	if ( $t && 'weekend' === $t['unit'] ) {
		/* translators: %s: date the weekend hunt starts */
		return sprintf( __( 'Weekend starting %s', '5f-booking' ), wp_date( 'l, F j, Y', $ts, new DateTimeZone( 'UTC' ) ) );
	}
	/* translators: %s: hunt date */
	return sprintf( __( '%s, morning hunt', '5f-booking' ), wp_date( 'l, F j, Y', $ts, new DateTimeZone( 'UTC' ) ) );
}

/**
 * Money as "$1,000".
 *
 * @param int $dollars Whole dollars.
 * @return string
 */
function fivef_bk_money( $dollars ) {
	return '$' . number_format( (int) $dollars );
}
