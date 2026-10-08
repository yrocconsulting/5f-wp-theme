<?php
/**
 * Title: Hunting & Fishing overview page
 * Slug: 5f-ranch/page-hunting-fishing
 * Categories: 5f-ranch-pages
 * Keywords: services, hunting, fishing, overview
 * Post Types: page
 * Description: Overview of everything offered at the ranch, linking to each sub-page.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:0"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'From thermal hog hunts after dark to fast dove shoots over sunflower fields and quiet afternoons on the ponds, 5F Ranch is built for time outdoors. Hunts are limited, habitat is rested, and the drive from Fort Worth is less than an hour.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'experiences-grid' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan","fontSize":"x-large"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color has-x-large-font-size"><?php esc_html_e( 'Who Can Hunt', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Hunters must be 18 or older.</strong> No exceptions.', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Confirmed members and booked guests only.', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Valid Texas licenses and endorsements required, plus all Texas Parks & Wildlife regulations.', '5f-ranch' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan","fontSize":"x-large"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color has-x-large-font-size"><?php esc_html_e( 'Memberships & Booking', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Access is offered through limited seasonal memberships and booked hunts, so the ranch never gets crowded. Once you’re confirmed, you’ll receive your member information, gate access, property map, Ranch Guidelines and everything you need before arriving.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Call the Hunt & Booking line for current availability.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php
echo fivef_section( 'expectations' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
