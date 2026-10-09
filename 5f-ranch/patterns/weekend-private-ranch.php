<?php
/**
 * Title: A private ranch, a personal experience
 * Slug: 5f-ranch/weekend-private-ranch
 * Categories: 5f-ranch, gallery, text
 * Keywords: land, private, ranch, photos, small group
 * Description: The private-ranch pitch beside a grid of ranch landscape photos.
 *
 * @package 5f-ranch
 */

$fivef_land = array( 'ranch-overview', 'creek-bottom', 'quarry-lake', 'long-pond' );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"44%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:44%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'The Ranch', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'A Private Ranch. A Personal Experience.', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'With approximately 2,600 acres of private ranch property and just four hunters per weekend, 5F Ranch offers a more personal alternative to high-volume hunting operations.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Bring your friends, business partners or valued clients. Enjoy guided thermal hog hunting, overnight accommodations and time together away from the usual demands of work.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-script","textColor":"sunset-gold","fontSize":"x-large"} -->
<p class="is-style-script has-sunset-gold-color has-text-color has-x-large-font-size"><?php esc_html_e( 'Four hunters. One private ranch. A full weekend to remember.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/about-the-ranch/' ) ); ?>"><?php esc_html_e( 'About the Ranch', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"className":"fivef-land-grid","layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null},"style":{"spacing":{"blockGap":"0.75rem"}}} -->
<div class="wp-block-group fivef-land-grid"><?php foreach ( $fivef_land as $fivef_slot ) : ?><!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo fivef_photo( $fivef_slot ); ?>" alt="<?php echo fivef_photo_alt( $fivef_slot ); ?>"/></figure>
<!-- /wp:image -->

<?php endforeach; ?></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
