<?php
/**
 * Title: From the Field (hunt photos)
 * Slug: 5f-ranch/hunt-photos
 * Categories: 5f-ranch, gallery
 * Keywords: photos, hunts, hogs, gallery
 * Description: Row of three recent hunt photos.
 *
 * @package 5f-ranch
 */
?>
<?php if ( file_exists( get_theme_file_path( 'assets/photos/hog-hunt-2-portrait.jpg' ) ) ) : ?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'From the Field', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"x-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-x-large-font-size"><?php esc_html_e( 'Recent Hunts on 5F Ranch', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"fivef-photo-portrait"} -->
<figure class="wp-block-image size-full fivef-photo-portrait"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/photos/hog-hunt-2-portrait.jpg' ) ); ?>" alt="<?php echo fivef_photo_alt( 'hog-hunt-2' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"fivef-photo-portrait"} -->
<figure class="wp-block-image size-full fivef-photo-portrait"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/photos/hog-hunt-3-portrait.jpg' ) ); ?>" alt="<?php echo fivef_photo_alt( 'hog-hunt-3' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"fivef-photo-portrait"} -->
<figure class="wp-block-image size-full fivef-photo-portrait"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/photos/hog-pair-portrait.jpg' ) ); ?>" alt="<?php echo fivef_photo_alt( 'hog-pair' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

</div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
<?php endif; ?>
