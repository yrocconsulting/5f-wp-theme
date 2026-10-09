<?php
/**
 * Title: On the trail cams
 * Slug: 5f-ranch/trailcam-strip
 * Categories: 5f-ranch, gallery
 * Keywords: trail camera, hogs, photos, gallery
 * Description: Four trail-camera photos of hogs on the ranch, with a link to the Gallery.
 *
 * @package 5f-ranch
 */

$fivef_pick  = array( 'featured-01-trail-cam-feeder.jpg', '07-sounder-at-field-feeder.jpg', '12-sounder-on-the-oil-pump-trail.jpg', '17-snow-day-at-the-hog-trap.jpg' );
$fivef_items = array_values(
	array_filter(
		fivef_gallery_items(),
		static function ( $item ) use ( $fivef_pick ) {
			return in_array( $item['file'], $fivef_pick, true );
		}
	)
);
if ( ! $fivef_items ) {
	return;
}
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'On the Trail Cams', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'The Hogs Are Here', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
<p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Real photos from the ranch’s trail cameras: big sounders, lone boars and hogs at the feeders, night after night.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<?php echo fivef_gallery_markup( $fivef_items, 4 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/gallery/' ) ); ?>"><?php esc_html_e( 'See the Gallery', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
