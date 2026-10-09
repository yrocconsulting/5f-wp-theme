<?php
/**
 * Title: Thermal hog hunts feature
 * Slug: 5f-ranch/hog-feature
 * Categories: 5f-ranch, featured
 * Keywords: hog, thermal, night, hunt, feature
 * Description: Homepage feature for guided thermal hog hunts with a photo and key points.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Thermal Hog Hunts', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Hunt After Dark', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Feral hogs move at night, so that’s when we hunt them. Our guided hunts put you in the field after dark with thermal optics, working the creek bottoms, tree lines and fields where hogs feed along Big Sandy Creek.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Thermal optics</strong> to find and identify hogs in total darkness', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Guided night hunts</strong> with an experienced guide', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Private ground</strong> and a limited number of hunters', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Predators</strong> like coyotes and bobcats are a bonus when the chance comes', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Less than an hour</strong> from Fort Worth', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/thermal-hog-hunts/' ) ); ?>"><?php esc_html_e( 'Explore Thermal Hog Hunts', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"fivef-photo-portrait"} -->
<figure class="wp-block-image size-full fivef-photo-portrait"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/photos/hog-hunt-2-portrait.jpg' ) ); ?>" alt="<?php echo fivef_photo_alt( 'hog-hunt-2' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
