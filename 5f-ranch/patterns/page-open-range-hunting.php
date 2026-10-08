<?php
/**
 * Title: Open Range Hunting page
 * Slug: 5f-ranch/page-open-range-hunting
 * Categories: 5f-ranch-pages
 * Keywords: open range, hog, thermal, hunting
 * Post Types: page
 * Description: Open range hunting across the wider property, including guided thermal hog hunts.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Beyond the dove fields, 5F Ranch spans roughly 2,600 acres of North Texas pasture, ponds and the timbered bottoms of Big Sandy Creek. That’s room to hunt the way it should feel: wide open and unhurried.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'hog-hunt-1' ); ?>" alt="<?php echo fivef_photo_alt( 'hog-hunt-1' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color"><?php esc_html_e( 'Guided Thermal Hog Hunts', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Feral hogs are fair game year-round in Texas, and after dark is when they move. Our all-inclusive guided thermal hog hunts put you in the field at night with an experienced guide and thermal optics, working the Big Sandy Creek bottoms, tree lines and feeding areas hogs use most.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php esc_html_e( 'Guided, multi-day hunt packages', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Night hunting with thermal equipment', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Private ground, limited hunters', '5f-ranch' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php if ( file_exists( get_theme_file_path( 'assets/photos/hog-hunt-2-portrait.jpg' ) ) ) : ?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'From Recent Hunts', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"x-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-x-large-font-size"><?php esc_html_e( 'Night Hunts on 5F Ranch', '5f-ranch' ); ?></h3>
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

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"860px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"className":"is-style-paper","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-paper" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-script","style":{"color":{"text":"#26341f"}},"fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center is-style-script has-text-color has-xx-large-font-size" style="color:#26341f"><?php esc_html_e( 'More on the Way', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'We’re building out more open range opportunities across the wider property. Call the Hunt & Booking line to ask what’s available this season.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
