<?php
/**
 * Title: Hunting & fishing cards
 * Slug: 5f-ranch/experiences-grid
 * Categories: 5f-ranch, featured
 * Keywords: services, hunts, cards, grid, hogs, predators, fishing
 * Description: Linked cards for Thermal Hog Hunts, Predators, Open Range Hunting and Fishing.
 *
 * @package 5f-ranch
 */

$fivef_cards = array(
	array(
		'title' => __( 'Thermal Hog Hunts', '5f-ranch' ),
		'url'   => '/thermal-hog-hunts/',
		'img'   => fivef_photo( 'hog-boar-banner' ),
		'alt'   => fivef_photo_alt( 'hog-boar-banner' ),
		'text'  => __( 'Guided night hunts for feral hogs with thermal optics on private ground along Big Sandy Creek.', '5f-ranch' ),
	),
	array(
		'title' => __( 'Predators', '5f-ranch' ),
		'url'   => '/thermal-hog-hunts/#predators',
		'img'   => esc_url( get_theme_file_uri( 'assets/gallery/featured-03-bobcat.jpg' ) ),
		'alt'   => esc_attr__( 'Bobcat taken on 5F Ranch, laid on the rack of a ranch truck at dusk', '5f-ranch' ),
		'text'  => __( 'Coyotes and bobcats are often taken on hog hunts when the opportunity comes up.', '5f-ranch' ),
	),
	array(
		'title' => __( 'Open Range Hunting', '5f-ranch' ),
		'url'   => '/hunting-fishing/open-range-hunting/',
		'img'   => fivef_photo( 'creek-bottom' ),
		'alt'   => fivef_photo_alt( 'creek-bottom' ),
		'text'  => __( 'White-tailed deer and seasonal opportunities across the wider 2,600-acre property.', '5f-ranch' ),
	),
	array(
		'title' => __( 'Fishing', '5f-ranch' ),
		'url'   => '/hunting-fishing/fishing/',
		'img'   => fivef_photo( 'aerial-ponds' ),
		'alt'   => fivef_photo_alt( 'aerial-ponds' ),
		'text'  => __( 'Bass, catfish and brim in ranch ponds on designated hunting days.', '5f-ranch' ),
	),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Hunting & Fishing', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Ways to Enjoy the Ranch', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $fivef_cards as $fivef_card ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%;padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","style":{"border":{"radius":"0px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><a href="<?php echo esc_url( home_url( $fivef_card['url'] ) ); ?>"><img src="<?php echo $fivef_card['img']; ?>" alt="<?php echo $fivef_card['alt']; // phpcs:ignore -- escaped in fivef_photo_alt(). ?>" style="border-radius:0px"/></a></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":4,"textColor":"texas-tan"} -->
<h4 class="wp-block-heading has-texas-tan-color has-text-color"><a href="<?php echo esc_url( home_url( $fivef_card['url'] ) ); ?>"><?php echo esc_html( $fivef_card['title'] ); ?></a></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo esc_html( $fivef_card['text'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-tracked","style":{"typography":{"fontWeight":"700"}},"fontSize":"x-small"} -->
<p class="is-style-tracked has-x-small-font-size" style="font-weight:700"><a href="<?php echo esc_url( home_url( $fivef_card['url'] ) ); ?>"><?php esc_html_e( 'Learn more →', '5f-ranch' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
