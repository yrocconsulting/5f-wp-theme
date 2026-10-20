<?php
/**
 * Booking emails.
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Email the guest and the ranch about a booking.
 *
 * @param int    $id   Booking ID.
 * @param string $kind "paid" (deposit received) or "requested" (no online payment).
 */
function fivef_bk_send_emails( $id, $kind ) {
	$b     = fivef_bk_get( $id );
	$t     = fivef_bk_type( $b['type'] );
	$when  = fivef_bk_date_label( $b['type'], $b['date'] );
	$phone = function_exists( 'fivef_contacts' ) ? fivef_contacts()['booking']['phone'] : '817-703-3689';
	$lines = array(
		__( 'Hunt:', '5f-booking' ) . ' ' . $t['label'],
		__( 'Date:', '5f-booking' ) . ' ' . $when,
		__( 'Hunters:', '5f-booking' ) . ' ' . $b['people'],
	);
	if ( $b['addon'] && ! empty( $t['addon'] ) ) {
		$lines[] = __( 'Add-on:', '5f-booking' ) . ' ' . $t['addon']['short'] . ' (' . fivef_bk_money( $t['addon']['price'] ) . ')';
	}
	$lines = array_merge(
		$lines,
		array(
			__( 'Total:', '5f-booking' ) . ' ' . fivef_bk_money( $b['total'] ),
		)
	);
	if ( 'paid' === $kind ) {
		$lines[] = __( 'Deposit paid:', '5f-booking' ) . ' ' . fivef_bk_money( $b['deposit'] ) . ' (' . rtrim( $t['deposit_note'], '.' ) . ')';
		$lines[] = __( 'Balance due:', '5f-booking' ) . ' ' . fivef_bk_money( $b['balance'] );
	} else {
		$lines[] = __( 'Deposit due to confirm:', '5f-booking' ) . ' ' . fivef_bk_money( $b['deposit'] );
	}
	$details = implode( "\n", $lines );
	$guest   = array(
		__( 'Name:', '5f-booking' ) . ' ' . $b['name'],
		__( 'Email:', '5f-booking' ) . ' ' . $b['email'],
		__( 'Phone:', '5f-booking' ) . ' ' . $b['phone'],
	);
	if ( $b['notes'] ) {
		$guest[] = __( 'Notes:', '5f-booking' ) . ' ' . $b['notes'];
	}

	if ( 'paid' === $kind ) {
		$guest_subject = __( 'Your 5F Ranch hunt is reserved', '5f-booking' );
		$guest_intro   = __( 'Thanks! We received your deposit and your spots are reserved. We’ll be in touch with everything you need before you arrive.', '5f-booking' );
		/* translators: 1: guest name, 2: hunt date */
		$ranch_subject = sprintf( __( 'New booking (deposit paid): %1$s, %2$s', '5f-booking' ), $b['name'], $when );
	} else {
		$guest_subject = __( 'We received your 5F Ranch booking request', '5f-booking' );
		$guest_intro   = __( 'Thanks! Your dates are held while we confirm your booking. We’ll contact you shortly about the deposit.', '5f-booking' );
		/* translators: 1: guest name, 2: hunt date */
		$ranch_subject = sprintf( __( 'New booking request: %1$s, %2$s', '5f-booking' ), $b['name'], $when );
	}

	wp_mail(
		$b['email'],
		$guest_subject,
		$guest_intro . "\n\n" . $details . "\n\n"
		/* translators: %s: phone number */
		. sprintf( __( 'Questions? Call the Hunt & Booking line: %s', '5f-booking' ), $phone ) . "\n\n5F Ranch · Alvord, Texas\n" . home_url( '/' ),
		array( 'Reply-To: 5F Ranch <' . fivef_bk_ranch_email() . '>' )
	);

	wp_mail(
		fivef_bk_ranch_email(),
		$ranch_subject,
		$details . "\n\n" . implode( "\n", $guest ) . "\n\n"
		. __( 'Manage bookings:', '5f-booking' ) . ' ' . admin_url( 'post.php?post=' . $id . '&action=edit' ),
		array( 'Reply-To: ' . $b['name'] . ' <' . $b['email'] . '>' )
	);
}
