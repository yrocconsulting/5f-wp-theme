<?php
/**
 * Title: Thermal Hog Hunt Pricing page
 * Slug: 5f-ranch/page-pricing
 * Categories: 5f-ranch-pages
 * Keywords: pricing, price, rates, deposit, book, hog hunt, group
 * Post Types: page
 * Description: Pricing for the two-day guided thermal hog hunt: per-hunter and four-hunter group prices, deposit, what's included and booking buttons.
 *
 * @package 5f-ranch
 */

$fivef_includes = array(
	__( 'Two-day guided thermal hog hunting experience', '5f-ranch' ),
	__( 'Overnight ranch lodging', '5f-ranch' ),
	__( 'Hearty ranch meals', '5f-ranch' ),
	__( 'Soft drinks, plus adult beverages back at the lodge after the hunt', '5f-ranch' ),
	__( 'Thermal optics and hunting equipment, including rifles, suppressors, ammunition and tripods', '5f-ranch' ),
	__( 'Use of ranch transportation such as ATVs and side-by-sides during the hunt', '5f-ranch' ),
	__( 'Two guides to support the hunting experience', '5f-ranch' ),
	__( 'Access to approximately 2,600 acres of private ranch property', '5f-ranch' ),
	__( 'No harvest limit on feral hogs', '5f-ranch' ),
);
$fivef_book  = fivef_book_url( 'hog' );
$fivef_group = fivef_inquiry_url( 'Private / group weekend' );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"820px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"typography":{"fontWeight":"700"}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="font-weight:700"><?php esc_html_e( 'Escape the Office. Own the Weekend.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":2,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'A Full Weekend. A Private Ranch. A Hunt Worth Remembering.', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"medium"} -->
<p class="has-text-align-center has-medium-font-size"><?php esc_html_e( 'Bring your friends, business partners or valued clients to 5F Ranch for an all-inclusive, two-day guided thermal hog hunt near Alvord, Texas, less than an hour west of Fort Worth. Enjoy approximately 2,600 acres of private ranch property, overnight lodging, hearty ranch meals and authentic Texas hospitality, with just four hunters booked per weekend to keep the experience personal.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Straightforward Pricing', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","className":"fivef-prices","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide fivef-prices" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card fivef-price-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group is-style-card fivef-price-card" style="min-height:100%;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"className":"is-style-tracked","style":{"typography":{"fontWeight":"700"}},"textColor":"texas-tan","fontSize":"x-small"} -->
<p class="is-style-tracked has-texas-tan-color has-text-color has-x-small-font-size" style="font-weight:700"><?php esc_html_e( 'Individual booking', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"fivef-price"} -->
<p class="fivef-price"><?php esc_html_e( '$2,000', '5f-ranch' ); ?> <span><?php esc_html_e( 'per hunter', '5f-ranch' ); ?></span></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php esc_html_e( 'The standard rate for individual bookings and for groups booking fewer than four spots.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $fivef_book ); ?>"><?php esc_html_e( 'Check Dates & Book Your Hunt', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card fivef-price-card is-featured","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|30"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group is-style-card fivef-price-card is-featured" style="min-height:100%;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"className":"is-style-tracked","style":{"typography":{"fontWeight":"700"}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="font-weight:700"><?php esc_html_e( 'Best value · Book all four spots', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"fivef-price"} -->
<p class="fivef-price"><?php esc_html_e( '$7,200', '5f-ranch' ); ?> <span><?php esc_html_e( 'for four hunters', '5f-ranch' ); ?></span></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo wp_kses_post( __( '<strong>$1,800 per hunter</strong>: a 10% group discount, saving $800, when one booking reserves all four hunter spots together.', '5f-ranch' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $fivef_group ); ?>"><?php esc_html_e( 'Ask About a Private Group', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"small","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php esc_html_e( 'The 10% discount applies when one booking reserves all four hunter spots together. Individual bookings and groups booking fewer than four spots are charged the standard rate of $2,000 per hunter.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained","contentSize":"820px"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Reserve Your Dates', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php echo wp_kses_post( __( 'A <strong>$1,000 non-refundable deposit per hunter</strong> is required to secure your dates. The deposit is applied toward the total package price.', '5f-ranch' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:table {"className":"fivef-price-table"} -->
<figure class="wp-block-table fivef-price-table"><table><thead><tr><th><?php esc_html_e( 'Booking', '5f-ranch' ); ?></th><th><?php esc_html_e( 'Deposit due', '5f-ranch' ); ?></th><th><?php esc_html_e( 'Remaining balance', '5f-ranch' ); ?></th></tr></thead><tbody><tr><td><?php esc_html_e( 'One hunter at standard rate', '5f-ranch' ); ?></td><td><strong><?php esc_html_e( '$1,000', '5f-ranch' ); ?></strong></td><td><strong><?php esc_html_e( '$1,000', '5f-ranch' ); ?></strong></td></tr><tr><td><?php esc_html_e( 'Four hunters booked together', '5f-ranch' ); ?></td><td><strong><?php esc_html_e( '$4,000 total', '5f-ranch' ); ?></strong></td><td><strong><?php esc_html_e( '$3,200 total', '5f-ranch' ); ?></strong></td></tr></tbody></table></figure>
<!-- /wp:table --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'All-Inclusive', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Your Hunt Includes', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><?php foreach ( $fivef_includes as $fivef_item ) : ?><!-- wp:list-item -->
<li><?php echo esc_html( $fivef_item ); ?></li>
<!-- /wp:list-item -->

<?php endforeach; ?></ul>
<!-- /wp:list --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'hog-boar-banner' ); ?>" alt="<?php echo fivef_photo_alt( 'hog-boar-banner' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","level":2,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Built for More Than the Hunt', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'Whether you’re reconnecting with old friends, rewarding your team or entertaining important clients, 5F Ranch offers room to step away from the daily grind and spend meaningful time together. The hunt is the centerpiece; the stories, meals and time around the ranch make it a weekend to remember.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'weekend-close' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
