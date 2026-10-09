<?php
/**
 * Title: The land (photo showcase)
 * Slug: 5f-ranch/land-showcase
 * Categories: 5f-ranch, gallery, text
 * Keywords: land, property, ranch, photos, creek, ponds
 * Description: Intro to the property with a grid of ranch landscape photos and a link to About the Ranch.
 *
 * @package 5f-ranch
 */

$fivef_land = array( 'ranch-overview', 'creek-bottom', 'quarry-lake', 'long-pond' );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'The Land', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( '2,600 Acres Along Big Sandy Creek', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo wp_kses_post( __( '<strong>5F Ranch</strong> is a private ranch in Alvord, Texas, less than an hour from Fort Worth with easy access off Highway 287.', '5f-ranch' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Big Sandy Creek winds through timbered bottoms, open pasture, stock tanks and lakes. It’s prime hog country, and beautiful land to spend a night on.', '5f-ranch' ); ?></p>
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
