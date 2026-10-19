<?php
/**
 * Plugin Name: 5F Ranch Booking
 * Description: Booking calendar for 5F Ranch hunts: open dates, spot limits, and online deposits through Stripe Checkout. Add the [fivef_booking] shortcode to a page.
 * Version: 1.0.0
 * Requires PHP: 7.4
 * Author: 5F Ranch
 * Text Domain: 5f-booking
 *
 * @package 5f-booking
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FIVEF_BK_VERSION', '1.0.0' );
define( 'FIVEF_BK_DIR', __DIR__ );
define( 'FIVEF_BK_URL', plugin_dir_url( __FILE__ ) );

require_once FIVEF_BK_DIR . '/includes/config.php';
require_once FIVEF_BK_DIR . '/includes/data.php';
require_once FIVEF_BK_DIR . '/includes/stripe.php';
require_once FIVEF_BK_DIR . '/includes/emails.php';
require_once FIVEF_BK_DIR . '/includes/rest.php';
require_once FIVEF_BK_DIR . '/includes/shortcode.php';

if ( is_admin() ) {
	require_once FIVEF_BK_DIR . '/includes/admin.php';
}
