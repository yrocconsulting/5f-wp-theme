<?php
/**
 * Title: Duck Hunting page
 * Slug: 5f-ranch/page-duck-hunting
 * Categories: 5f-ranch-pages
 * Keywords: duck, waterfowl, hunting, group
 * Post Types: page
 * Description: Duck hunting: one private group of 4 to 6 per morning at $300 per person. Placeholder copy until the ranch's content arrives.
 *
 * @package 5f-ranch
 */

$fivef_c = fivef_contacts();
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Private morning duck hunts on the ranch ponds and lakes of 5F Ranch, less than an hour from Fort Worth. One group per morning, so the water is yours.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'geese-lake' ); ?>" alt="<?php echo fivef_photo_alt( 'geese-lake' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color"><?php esc_html_e( 'Your Group, Your Morning', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>$300 per person</strong>', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>4 hunters minimum, 6 maximum</strong> per group', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'One private group per morning', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Valid Texas hunting license, waterfowl endorsements and federal duck stamp required', '5f-ranch' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( fivef_book_url( 'duck' ) ); ?>"><?php esc_html_e( 'Check Dates & Book', '5f-ranch' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_c['booking']['phone'] ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_c['booking']['phone'] ) ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"860px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"className":"is-style-paper","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-paper" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-script","style":{"color":{"text":"#26341f"}},"fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center is-style-script has-text-color has-xx-large-font-size" style="color:#26341f"><?php esc_html_e( 'More Details Coming Soon', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'Season dates, what to bring and what a morning on the water looks like at 5F Ranch. Call the Hunt & Booking line with any questions.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
