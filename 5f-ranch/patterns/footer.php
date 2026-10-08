<?php
/**
 * Title: Footer
 * Slug: 5f-ranch/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 *
 * @package 5f-ranch
 */

$fivef_c = fivef_contacts();
?>
<!-- wp:group {"className":"fivef-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"},"margin":{"top":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|bone"}}}},"gradient":"pine-fade","textColor":"bone","layout":{"type":"constrained"}} -->
<div class="wp-block-group fivef-footer has-bone-color has-pine-fade-gradient-background has-text-color has-background has-link-color" style="margin-top:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"30%"} -->
<div class="wp-block-column" style="flex-basis:30%"><!-- wp:image {"width":"200px","sizeSlug":"full","linkDestination":"custom","style":{"border":{"radius":"0px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo fivef_img( 'logo-stacked-cream.svg' ); ?>" alt="<?php esc_attr_e( '5F Ranch, Alvord, Texas', '5f-ranch' ); ?>" style="border-radius:0px;width:200px"/></a></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Find Us', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><strong><?php echo esc_html( $fivef_c['location'] ); ?></strong><br><?php echo esc_html( $fivef_c['location_sub'] ); ?>.</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small","textColor":"texas-tan"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'Gate access details are provided to confirmed members and guests.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Call the Ranch', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo esc_html( $fivef_c['booking']['label'] ); ?><br><a href="<?php echo fivef_tel( $fivef_c['booking']['phone'] ); ?>"><strong><?php echo esc_html( $fivef_c['booking']['phone'] ); ?></strong></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo esc_html( $fivef_c['management']['label'] ); ?><br><a href="<?php echo fivef_tel( $fivef_c['management']['phone'] ); ?>"><strong><?php echo esc_html( $fivef_c['management']['phone'] ); ?></strong></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"fontSize":"x-small","textColor":"texas-tan"} -->
<p class="has-texas-tan-color has-text-color has-x-small-font-size"><?php esc_html_e( 'Emergency: call 911.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Explore', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:navigation {<?php echo fivef_nav_ref(); // phpcs:ignore ?>"overlayMenu":"never","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.35rem"},"typography":{"textTransform":"none","letterSpacing":"0.02em","fontWeight":"500"}},"fontSize":"small"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:separator {"align":"wide","className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40"}}}} -->
<hr class="wp-block-separator alignwide has-alpha-channel-opacity is-style-wide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--40)"/>
<!-- /wp:separator -->

<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group alignwide"><!-- wp:paragraph {"className":"is-style-script","textColor":"sunset-gold","fontSize":"x-large"} -->
<p class="is-style-script has-sunset-gold-color has-text-color has-x-large-font-size"><?php esc_html_e( 'We’ll See You at the Gate.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-tracked","textColor":"texas-tan","fontSize":"x-small"} -->
<p class="is-style-tracked has-texas-tan-color has-text-color has-x-small-font-size">© <?php echo esc_html( gmdate( 'Y' ) ); ?> 5F Ranch &nbsp;★&nbsp; Alvord, Texas</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
