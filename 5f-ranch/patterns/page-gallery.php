<?php
/**
 * Title: Gallery page
 * Slug: 5f-ranch/page-gallery
 * Categories: 5f-ranch-pages
 * Keywords: gallery, photos, trail camera, hunts
 * Post Types: page
 * Description: Photos with filter buttons (hogs, ducks, predators, the ranch), from assets/gallery, assets/duck and assets/ranch.
 *
 * @package 5f-ranch
 */

$fivef_featured = fivef_gallery_items( true );
$fivef_more     = fivef_gallery_items( false );
// Duck photos show once the Duck Hunting page is published.
$fivef_duck_pg  = get_page_by_path( 'hunting-fishing/duck-hunting' );
$fivef_duck     = ( $fivef_duck_pg && 'publish' === $fivef_duck_pg->post_status ) ? fivef_gallery_items( null, 'duck' ) : array();
$fivef_ranch    = fivef_gallery_items( null, 'ranch' );

// Filter buttons for the categories that have photos.
$fivef_labels = array(
	'hogs'      => __( 'Hog Hunts', '5f-ranch' ),
	'ducks'     => __( 'Duck Hunts', '5f-ranch' ),
	'predators' => __( 'Predators', '5f-ranch' ),
	'ranch'     => __( 'The Ranch', '5f-ranch' ),
);
$fivef_have   = array();
foreach ( array_merge( $fivef_featured, $fivef_more, $fivef_duck, $fivef_ranch ) as $fivef_item ) {
	$fivef_have[ $fivef_item['cat'] ] = true;
}
$fivef_sections = array(
	array( '', __( 'Featured', '5f-ranch' ), $fivef_featured, 3, 'fivef-gallery-featured' ),
	array( 'hog-hunts', __( 'Hog Hunts & Trail Cams', '5f-ranch' ), $fivef_more, 4, '' ),
	array( 'duck-hunts', __( 'Duck Hunts', '5f-ranch' ), $fivef_duck, 4, '' ),
	array( 'the-ranch', __( 'The Ranch', '5f-ranch' ), $fivef_ranch, 4, '' ),
);
?>
<!-- wp:group {"align":"full","className":"fivef-gallery-page","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull fivef-gallery-page" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Trail cameras, hunts and life on the ranch. Pick a category, and click any photo to see it larger.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="fivef-gallery-filters" role="group" aria-label="<?php esc_attr_e( 'Show photos of', '5f-ranch' ); ?>"><button type="button" class="fivef-filter is-active" data-filter="all" aria-pressed="true"><?php esc_html_e( 'All', '5f-ranch' ); ?></button><?php foreach ( $fivef_labels as $fivef_key => $fivef_label ) : if ( empty( $fivef_have[ $fivef_key ] ) ) { continue; } ?><button type="button" class="fivef-filter" data-filter="<?php echo esc_attr( $fivef_key ); ?>" aria-pressed="false"><?php echo esc_html( $fivef_label ); ?></button><?php endforeach; ?></div>
<!-- /wp:html -->

<?php
foreach ( $fivef_sections as $fivef_sec ) :
	if ( ! $fivef_sec[2] ) {
		continue;
	}
	?>
<!-- wp:group {"<?php echo $fivef_sec[0] ? 'anchor":"' . esc_attr( $fivef_sec[0] ) . '","' : ''; ?>className":"fivef-gallery-section","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
<div<?php echo $fivef_sec[0] ? ' id="' . esc_attr( $fivef_sec[0] ) . '"' : ''; ?> class="wp-block-group alignwide fivef-gallery-section" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php echo esc_html( $fivef_sec[1] ); ?></h2>
<!-- /wp:heading -->

<?php echo fivef_gallery_markup( $fivef_sec[2], $fivef_sec[3], $fivef_sec[4] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?></div>
<!-- /wp:group -->

<?php endforeach; ?></div>
<!-- /wp:group -->

<?php echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
