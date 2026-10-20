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
			// Optional morning duck hunt for a group booking all four spots.
			'addon'       => array(
				'label'   => __( 'Add a morning duck hunt for all four hunters', '5f-booking' ),
				'short'   => __( 'Morning duck hunt add-on (4 hunters)', '5f-booking' ),
				'price'   => 1200,
				'deposit' => 600, // 50%.
			),
		),
		'duck' => array(
			'label'       => __( 'Guided Duck Hunt', '5f-booking' ),
			'short'       => __( 'Duck hunt', '5f-booking' ),
			'unit'        => 'morning',
			'mode'        => 'group',
			'capacity'    => 1,
			'min'         => 4,
			'max'         => 6,
			'price'       => 300, // Weekday mornings, per person.
			'weekend_price' => 350, // Saturday and Sunday mornings, per person.
			'group_price' => 300,
			'deposit'     => 0,
			'deposit_pct' => max( 0, min( 100, (int) get_option( 'fivef_bk_duck_deposit_pct', 50 ) ) ),
			'enabled'     => (bool) get_option( 'fivef_bk_duck_enabled', 0 ),
			'summary'     => __( 'One-morning guided hunt, 30 minutes before sunrise to 10 a.m. · 4 to 6 hunters · $300 per person on weekdays, $350 on weekends · 50% deposit to book · larger groups, call 817-703-3689', '5f-booking' ),
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
function fivef_bk_quote( $type, $people, $date = '', $addon = false ) {
	$t        = fivef_bk_type( $type );
	$people   = max( 0, (int) $people );
	$base     = fivef_bk_base_price( $type, $date );
	$discount = 'spots' === $t['mode'] && $people >= $t['capacity'] && $t['group_price'] < $base;
	$per      = $discount ? $t['group_price'] : $base;
	$total    = $per * $people;
	$deposit  = empty( $t['deposit_pct'] ) ? $t['deposit'] * $people : (int) round( $total * $t['deposit_pct'] / 100 );
	$addon    = $addon && fivef_bk_addon_allowed( $type, $people );
	if ( $addon ) {
		$total   += $t['addon']['price'];
		$deposit += $t['addon']['deposit'];
	}
	$deposit = min( $total, $deposit );
	return array(
		'per'      => $per,
		'total'    => $total,
		'deposit'  => $deposit,
		'balance'  => $total - $deposit,
		'discount' => $discount,
		'addon'    => $addon,
	);
}

/**
 * Per-person price for a date: weekend mornings can cost more (duck hunts).
 *
 * @param string $type Type key.
 * @param string $date Y-m-d, or '' for the base price.
 * @return int
 */
function fivef_bk_base_price( $type, $date = '' ) {
	$t = fivef_bk_type( $type );
	if ( $date && ! empty( $t['weekend_price'] ) && in_array( (int) gmdate( 'w', strtotime( $date . ' 12:00:00 UTC' ) ), array( 0, 6 ), true ) ) {
		return (int) $t['weekend_price'];
	}
	return (int) $t['price'];
}

/**
 * Whether the type's add-on can go with this many hunters (only when one booking takes every spot).
 *
 * @param string $type   Type key.
 * @param int    $people Hunters.
 * @return bool
 */
function fivef_bk_addon_allowed( $type, $people ) {
	$t = fivef_bk_type( $type );
	return ! empty( $t['addon'] ) && (int) $people >= (int) $t['capacity'];
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
