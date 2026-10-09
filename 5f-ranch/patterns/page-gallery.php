<?php
/**
 * Title: Gallery page
 * Slug: 5f-ranch/page-gallery
 * Categories: 5f-ranch-pages
 * Keywords: gallery, photos, trail camera, hunts
 * Post Types: page
 * Description: Featured photos and a grid of ranch and hunt photos (from assets/gallery/gallery.json).
 *
 * @package 5f-ranch
 */

$fivef_featured = fivef_gallery_items( true );
$fivef_more     = fivef_gallery_items( false );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Trail cameras, night hunts and life on the ranch. Click any photo to see it larger.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<?php if ( $fivef_featured ) : ?>
<!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow" style="margin-top:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Featured', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<?php echo fivef_gallery_markup( $fivef_featured, 3 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
<?php endif; ?>

<?php if ( $fivef_more ) : ?>
<!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow" style="margin-top:var(--wp--preset--spacing--60)"><?php esc_html_e( 'From the Ranch', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<?php echo fivef_gallery_markup( $fivef_more, 4 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>
<?php endif; ?></div>
<!-- /wp:group -->

<?php echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
