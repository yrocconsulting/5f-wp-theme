<?php
/**
 * Title: The hunt comes first, hospitality comes with it
 * Slug: 5f-ranch/weekend-hospitality
 * Categories: 5f-ranch, featured
 * Keywords: weekend, included, lodging, meals, hog hunt, harvest limit
 * Description: What a 5F Ranch weekend includes, beside a hunt photo, with a link to Thermal Hog Hunts.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"fivef-photo-portrait"} -->
<figure class="wp-block-image size-full fivef-photo-portrait"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/photos/hog-hunt-2-portrait.jpg' ) ); ?>" alt="<?php echo fivef_photo_alt( 'hog-hunt-2' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Your Weekend', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'The Hunt Comes First. Hospitality Comes With It.', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Your weekend at 5F Ranch is built around great hunting, comfortable overnight lodging and authentic Texas hospitality.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Guided thermal hog hunting</strong> on private ranch property', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Overnight lodging</strong> to enjoy the full weekend', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Hearty ranch meals</strong>', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Soft drinks</strong>, plus adult beverages back at the lodge after the hunt', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>No harvest limit on feral hogs</strong>, subject to applicable laws and safe hunting practices', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Between hunts, relax, share a meal, enjoy the ranch and spend time with the people you came to be with.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php echo wp_kses_post( sprintf( /* translators: %s: link to the predators section */ __( 'Bonus: coyotes and bobcats work the same creek bottoms, and are often taken on a hog hunt when the chance comes. %s', '5f-ranch' ), '<a href="' . esc_url( home_url( '/thermal-hog-hunts/#predators' ) ) . '">' . esc_html__( 'More on predators →', '5f-ranch' ) . '</a>' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/thermal-hog-hunts/' ) ); ?>"><?php esc_html_e( 'Explore Thermal Hog Hunts', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
