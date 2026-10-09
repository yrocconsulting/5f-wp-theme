<?php
/**
 * Title: Fishing page
 * Slug: 5f-ranch/page-fishing
 * Categories: 5f-ranch-pages
 * Keywords: fishing, bass, catfish, ponds
 * Post Types: page
 * Description: Fishing on designated hunting days, with species rules.
 *
 * @package 5f-ranch
 */

$fivef_species = array(
	array( __( 'Bass', '5f-ranch' ), __( 'Catch and release only.', '5f-ranch' ) ),
	array( __( 'Catfish', '5f-ranch' ), __( 'May be kept under Texas Parks & Wildlife regulations and Ranch Management restrictions.', '5f-ranch' ) ),
	array( __( 'Brim & Sunfish', '5f-ranch' ), __( 'May be kept under Texas Parks & Wildlife regulations.', '5f-ranch' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Make a day of it. Guests can fish the ranch ponds on hunt days, so bring a rod for the afternoon before the night hunt.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"align":"wide","sizeSlug":"full","linkDestination":"none","className":"is-style-torn","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<figure class="wp-block-image alignwide size-full is-style-torn" style="margin-top:var(--wp--preset--spacing--50)"><img src="<?php echo fivef_photo( 'quarry-lake', 'placeholder-pond.jpg' ); ?>" alt="<?php echo fivef_photo_alt( 'quarry-lake' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","className":"is-style-default","textColor":"texas-tan"} -->
<h2 class="wp-block-heading has-text-align-center is-style-default has-texas-tan-color has-text-color"><?php esc_html_e( 'What You Can Keep', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $fivef_species as $fivef_fish ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-ticket","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"dimensions":{"minHeight":"100%"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-ticket" style="min-height:100%;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-text-align-center has-large-font-size"><?php echo esc_html( $fivef_fish[0] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size"><?php echo esc_html( $fivef_fish[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Fishing is permitted on designated hunting days only. Follow all applicable Texas Parks & Wildlife regulations and any posted ranch rules.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'geese-lake', 'placeholder-pond.jpg' ); ?>" alt="<?php echo fivef_photo_alt( 'geese-lake' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'long-pond', 'placeholder-pond.jpg' ); ?>" alt="<?php echo fivef_photo_alt( 'long-pond' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
