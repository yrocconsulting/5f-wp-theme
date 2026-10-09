<?php
/**
 * Title: Home hero (thermal hog hunts)
 * Slug: 5f-ranch/hero
 * Categories: 5f-ranch, banner
 * Keywords: hero, banner, cover, hog, thermal, night
 * Description: Full-width night hero for the private thermal hog-hunting weekend, on a real trail-camera photo from the ranch.
 *
 * @package 5f-ranch
 */

$fivef_hero = fivef_photo( 'hero-trailcam', 'hero-sunset.svg' );
?>
<!-- wp:cover {"url":"<?php echo $fivef_hero; // phpcs:ignore ?>","dimRatio":60,"customGradient":"linear-gradient(90deg,rgba(14,13,11,0.92) 0%,rgba(14,13,11,0.7) 38%,rgba(14,13,11,0.15) 70%,rgba(14,13,11,0.35) 100%)","focalPoint":{"x":0.7,"y":0.5},"minHeight":84,"minHeightUnit":"vh","contentPosition":"center left","isDark":true,"align":"full","className":"fivef-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"clamp(1rem, 6vw, 6rem)","right":"clamp(1rem, 4vw, 2.5rem)"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
<div class="wp-block-cover alignfull has-custom-content-position is-position-center-left is-dark fivef-hero" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-right:clamp(1rem, 4vw, 2.5rem);padding-bottom:var(--wp--preset--spacing--60);padding-left:clamp(1rem, 6vw, 6rem);min-height:84vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo $fivef_hero; // phpcs:ignore ?>" style="object-position:70% 50%" data-object-fit="cover" data-object-position="70% 50%"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(90deg,rgba(14,13,11,0.92) 0%,rgba(14,13,11,0.7) 38%,rgba(14,13,11,0.15) 70%,rgba(14,13,11,0.35) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"className":"fivef-hero-copy","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group fivef-hero-copy"><!-- wp:image {"width":"200px","sizeSlug":"full","linkDestination":"none","className":"fivef-hero-logo","style":{"border":{"radius":"0px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border fivef-hero-logo"><img src="<?php echo fivef_img( 'logo-stacked-cream.svg' ); ?>" alt="<?php esc_attr_e( '5F Ranch, Alvord, Texas', '5f-ranch' ); ?>" style="border-radius:0px;width:200px"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"is-style-tracked","style":{"typography":{"fontWeight":"700"},"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--40);font-weight:700"><?php esc_html_e( 'Premium Guided Thermal Hog Hunts at 5F Ranch', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"fivef-text-shadow","textColor":"bone","fontSize":"huge"} -->
<h1 class="wp-block-heading fivef-text-shadow has-bone-color has-text-color has-huge-font-size"><?php esc_html_e( 'Escape the Office. Own the Weekend.', '5f-ranch' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"fivef-text-shadow","textColor":"bone","fontSize":"medium"} -->
<p class="fivef-text-shadow has-bone-color has-text-color has-medium-font-size"><?php esc_html_e( 'Bring your friends, best customers or business partners for a private thermal hog-hunting weekend built around great hunting, overnight lodging and authentic Texas hospitality. Across approximately 2,600 acres of private ranch, we keep it personal by limiting each weekend to just four hunters.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( fivef_inquiry_url( 'Thermal Hog Hunt weekend' ) ); ?>"><?php esc_html_e( 'Plan Your Hunt', '5f-ranch' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/thermal-hog-hunts/' ) ); ?>"><?php esc_html_e( 'See Thermal Hog Hunts', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php esc_html_e( 'Alvord, Texas • Less than an hour west of Fort Worth', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div></div>
<!-- /wp:cover -->
