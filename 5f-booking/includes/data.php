<?php
/**
 * Open dates and bookings.
 *
 * Open dates live in the fivef_bk_dates option: array( type => array( 'Y-m-d' => 1 open | 0 closed ) ).
 * Bookings are fivef_booking posts with their details in post meta.
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const FIVEF_BK_HOLD_MINUTES = 35; // Stripe Checkout lasts 30 minutes; hold the spots slightly longer.

/**
 * Booking statuses and whether they hold spots.
 *
 * @return array status => label
 */
function fivef_bk_statuses() {
	return array(
		'pending'   => __( 'Awaiting deposit', '5f-booking' ),
		'requested' => __( 'Requested (no payment taken)', '5f-booking' ),
		'paid'      => __( 'Deposit paid', '5f-booking' ),
		'confirmed' => __( 'Confirmed', '5f-booking' ),
		'cancelled' => __( 'Cancelled', '5f-booking' ),
		'expired'   => __( 'Expired (not paid)', '5f-booking' ),
	);
}

add_action(
	'init',
	static function () {
		register_post_type(
			'fivef_booking',
			array(
				'labels'          => array(
					'name'          => __( 'Bookings', '5f-booking' ),
					'singular_name' => __( 'Booking', '5f-booking' ),
					'edit_item'     => __( 'Booking', '5f-booking' ),
					'all_items'     => __( 'All Bookings', '5f-booking' ),
					'search_items'  => __( 'Search Bookings', '5f-booking' ),
					'not_found'     => __( 'No bookings yet.', '5f-booking' ),
				),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				'menu_icon'       => 'dashicons-calendar-alt',
				'menu_position'   => 26,
				'supports'        => array( 'title' ),
				'capability_type' => 'post',
				'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
				'map_meta_cap'    => true,
			)
		);
	}
);

/**
 * All dates for a type.
 *
 * @param string $type Type key.
 * @return array 'Y-m-d' => 1|0, sorted.
 */
function fivef_bk_dates( $type ) {
	$all   = (array) get_option( 'fivef_bk_dates', array() );
	$dates = isset( $all[ $type ] ) ? (array) $all[ $type ] : array();
	ksort( $dates );
	return $dates;
}

/**
 * Save one date's state; null removes it.
 *
 * @param string   $type Type key.
 * @param string   $date Y-m-d.
 * @param int|null $open 1 open, 0 closed, null remove.
 */
function fivef_bk_set_date( $type, $date, $open ) {
	$all = (array) get_option( 'fivef_bk_dates', array() );
	if ( ! isset( $all[ $type ] ) ) {
		$all[ $type ] = array();
	}
	if ( null === $open ) {
		unset( $all[ $type ][ $date ] );
	} else {
		$all[ $type ][ $date ] = $open ? 1 : 0;
	}
	update_option( 'fivef_bk_dates', $all, false );
}

/**
 * Today's date in the site's time zone.
 *
 * @return string Y-m-d
 */
function fivef_bk_today() {
	return wp_date( 'Y-m-d' );
}

/**
 * Bookings for a type and date that hold spots.
 *
 * @param string $type Type key.
 * @param string $date Y-m-d.
 * @return WP_Post[]
 */
function fivef_bk_active_bookings( $type, $date ) {
	$posts = get_posts(
		array(
			'post_type'      => 'fivef_booking',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery
				array(
					'key'   => '_fivef_type',
					'value' => $type,
				),
				array(
					'key'   => '_fivef_date',
					'value' => $date,
				),
			),
		)
	);
	return array_values(
		array_filter(
			$posts,
			static function ( $p ) {
				$status = get_post_meta( $p->ID, '_fivef_status', true );
				if ( 'pending' === $status ) {
					return (int) get_post_meta( $p->ID, '_fivef_hold_until', true ) > time();
				}
				return in_array( $status, array( 'requested', 'paid', 'confirmed' ), true );
			}
		)
	);
}

/**
 * Spots (or groups) left on a date.
 *
 * @param string $type Type key.
 * @param string $date Y-m-d.
 * @param int    $exclude Booking ID to leave out of the count.
 * @return int
 */
function fivef_bk_left( $type, $date, $exclude = 0 ) {
	$t     = fivef_bk_type( $type );
	$taken = 0;
	foreach ( fivef_bk_active_bookings( $type, $date ) as $p ) {
		if ( (int) $p->ID === (int) $exclude ) {
			continue;
		}
		$taken += 'group' === $t['mode'] ? 1 : (int) get_post_meta( $p->ID, '_fivef_people', true );
	}
	return max( 0, $t['capacity'] - $taken );
}

/**
 * Upcoming open dates with what's left, for the public calendar.
 *
 * @param string $type Type key.
 * @return array[] date, label, left
 */
function fivef_bk_availability( $type ) {
	$out   = array();
	$today = fivef_bk_today();
	foreach ( fivef_bk_dates( $type ) as $date => $open ) {
		if ( ! $open || $date <= $today ) {
			continue;
		}
		$out[] = array(
			'date'  => $date,
			'label' => fivef_bk_date_label( $type, $date ),
			'left'  => fivef_bk_left( $type, $date ),
		);
	}
	return $out;
}

/**
 * Serialize booking for a date (MySQL named lock), so two guests can't take the last spot at once.
 *
 * @param string $key Lock name.
 * @return bool Whether the lock was taken (always true where locks aren't supported).
 */
function fivef_bk_lock( $key ) {
	global $wpdb;
	$prev = $wpdb->suppress_errors( true );
	$got  = $wpdb->get_var( $wpdb->prepare( 'SELECT GET_LOCK(%s, 10)', 'fivef_bk_' . $key ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$wpdb->suppress_errors( $prev );
	// "0" means another booking held the lock for 10 seconds; anything else (1, or no lock support) carries on.
	return '0' !== (string) $got;
}

/**
 * Release the lock from fivef_bk_lock().
 *
 * @param string $key Lock name.
 */
function fivef_bk_unlock( $key ) {
	global $wpdb;
	$prev = $wpdb->suppress_errors( true );
	$wpdb->get_var( $wpdb->prepare( 'SELECT RELEASE_LOCK(%s)', 'fivef_bk_' . $key ) ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$wpdb->suppress_errors( $prev );
}

/**
 * A booking's details.
 *
 * @param int $id Booking ID.
 * @return array
 */
function fivef_bk_get( $id ) {
	$m = static function ( $k ) use ( $id ) {
		return get_post_meta( $id, '_fivef_' . $k, true );
	};
	return array(
		'id'      => (int) $id,
		'type'    => $m( 'type' ),
		'date'    => $m( 'date' ),
		'people'  => (int) $m( 'people' ),
		'name'    => $m( 'name' ),
		'email'   => $m( 'email' ),
		'phone'   => $m( 'phone' ),
		'notes'   => $m( 'notes' ),
		'total'   => (int) $m( 'total' ),
		'deposit' => (int) $m( 'deposit' ),
		'balance' => (int) $m( 'balance' ),
		'status'  => $m( 'status' ),
		'token'   => $m( 'token' ),
		'session' => $m( 'session' ),
	);
}

/**
 * Change a booking's status, noting it in the booking's log.
 *
 * @param int    $id     Booking ID.
 * @param string $status New status.
 * @param string $note   Optional note.
 */
function fivef_bk_set_status( $id, $status, $note = '' ) {
	update_post_meta( $id, '_fivef_status', $status );
	$log   = (array) get_post_meta( $id, '_fivef_log', true );
	$log[] = wp_date( 'Y-m-d H:i' ) . ' · ' . $status . ( $note ? ' · ' . $note : '' );
	update_post_meta( $id, '_fivef_log', array_filter( $log ) );
}

/**
 * Mark a deposit paid (idempotent) and send the confirmation emails.
 *
 * @param int    $id   Booking ID.
 * @param string $note Where the confirmation came from.
 */
function fivef_bk_mark_paid( $id, $note = '' ) {
	$b = fivef_bk_get( $id );
	if ( in_array( $b['status'], array( 'paid', 'confirmed' ), true ) ) {
		return;
	}
	fivef_bk_set_status( $id, 'paid', $note );
	fivef_bk_send_emails( $id, 'paid' );
}
