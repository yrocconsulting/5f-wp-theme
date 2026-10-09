<?php
/**
 * Title: Open Range Hunting page
 * Slug: 5f-ranch/page-open-range-hunting
 * Categories: 5f-ranch-pages
 * Keywords: open range, deer, whitetail, hog, thermal, hunting
 * Post Types: page
 * Description: Open range hunting across the wider property: white-tailed deer, feral hogs and seasonal opportunities.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Beyond the night hog hunts, 5F Ranch spans roughly 2,600 acres of North Texas pasture, ponds and the timbered bottoms of Big Sandy Creek. That’s room to hunt the way it should feel: wide open and unhurried.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'ranch-overview' ); ?>" alt="<?php echo fivef_photo_alt( 'ranch-overview' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color"><?php esc_html_e( 'The Country', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Timbered creek bottoms along Big Sandy Creek, oak-lined tree lines, open pasture and stock tanks: the kind of mixed cover and water that holds game all year.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php esc_html_e( 'Private ground with a limited number of hunters', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Creek bottoms, tree lines, pasture edges and water', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Less than an hour from Fort Worth', '5f-ranch' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php
$fivef_species = array(
	array(
		'title' => __( 'White-tailed Deer', '5f-ranch' ),
		'slot'  => 'creek-bottom',
		'text'  => __( 'Whitetails travel the creek bottoms, tree lines and pasture edges across the property. Deer hunts follow Texas season dates and county rules. Call to ask about availability and options.', '5f-ranch' ),
		'link'  => '/white-tailed-deer-texas-guide/',
		'label' => __( 'Whitetail field notes →', '5f-ranch' ),
	),
	array(
		'title' => __( 'Feral Hogs', '5f-ranch' ),
		'slot'  => 'hog-hunt-1',
		'text'  => __( 'Hogs are an invasive species and can be hunted year-round. Guided thermal night hunts put you in the field with an experienced guide and thermal optics.', '5f-ranch' ),
		'link'  => '/thermal-hog-hunts/',
		'label' => __( 'Thermal hog hunts →', '5f-ranch' ),
	),
	array(
		'title' => __( 'Ask About This Season', '5f-ranch' ),
		'slot'  => 'headquarters',
		'text'  => __( 'Have something else in mind? Opportunities on the wider property change with the seasons. Call the Hunt & Booking line to ask what’s open.', '5f-ranch' ),
		'link'  => '/contact/',
		'label' => __( 'Contact the ranch →', '5f-ranch' ),
	),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Open Range Game', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'What You Can Hunt', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $fivef_species as $fivef_sp ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%;padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:image {"sizeSlug":"full","linkDestination":"custom","style":{"border":{"radius":"0px"}}} -->
<figure class="wp-block-image size-full has-custom-border"><a href="<?php echo esc_url( home_url( $fivef_sp['link'] ) ); ?>"><img src="<?php echo fivef_photo( $fivef_sp['slot'] ); ?>" alt="<?php echo fivef_photo_alt( $fivef_sp['slot'] ); ?>" style="border-radius:0px"/></a></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"padding":{"left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":4,"textColor":"texas-tan"} -->
<h4 class="wp-block-heading has-texas-tan-color has-text-color"><?php echo esc_html( $fivef_sp['title'] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php echo esc_html( $fivef_sp['text'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-tracked","style":{"typography":{"fontWeight":"700"}},"fontSize":"x-small"} -->
<p class="is-style-tracked has-x-small-font-size" style="font-weight:700"><a href="<?php echo esc_url( home_url( $fivef_sp['link'] ) ); ?>"><?php echo esc_html( $fivef_sp['label'] ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"860px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"className":"is-style-paper","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-paper" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-script","style":{"color":{"text":"#26341f"}},"fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center is-style-script has-text-color has-xx-large-font-size" style="color:#26341f"><?php esc_html_e( 'Seasons Change', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'What’s open on the wider property depends on the time of year and Texas season dates. Call the Hunt & Booking line and we’ll tell you what’s available and help you plan your hunt.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
