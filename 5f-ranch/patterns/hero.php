<?php
/**
 * Title: Home hero
 * Slug: 5f-ranch/hero
 * Categories: 5f-ranch, banner
 * Keywords: hero, banner, cover, sunset
 * Description: Full-width sunset hero with the stacked logo, tagline and two buttons. Swap the background for a ranch photo.
 *
 * @package 5f-ranch
 */

$fivef_c = fivef_contacts();
?>
<!-- wp:cover {"url":"<?php echo fivef_photo( 'aerial-ponds', 'hero-sunset.svg' ); ?>","dimRatio":60,"customGradient":"linear-gradient(180deg,rgba(22,21,18,0.55) 0%,rgba(22,21,18,0.35) 45%,rgba(22,21,18,0.85) 100%)","minHeight":82,"minHeightUnit":"vh","isDark":true,"align":"full","className":"fivef-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull is-dark fivef-hero" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);min-height:82vh"><img class="wp-block-cover__image-background" alt="" src="<?php echo fivef_photo( 'aerial-ponds', 'hero-sunset.svg' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-60 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(22,21,18,0.55) 0%,rgba(22,21,18,0.35) 45%,rgba(22,21,18,0.85) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:image {"width":"360px","sizeSlug":"full","linkDestination":"none","align":"center","className":"fivef-hero-logo","style":{"border":{"radius":"0px"}}} -->
<figure class="wp-block-image aligncenter size-full is-resized has-custom-border fivef-hero-logo"><img src="<?php echo fivef_img( 'logo-stacked-cream.svg' ); ?>" alt="<?php esc_attr_e( '5F Ranch, Alvord, Texas', '5f-ranch' ); ?>" style="border-radius:0px;width:360px"/></figure>
<!-- /wp:image -->

<!-- wp:heading {"textAlign":"center","level":1,"className":"fivef-text-shadow","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"bone","fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-text-align-center fivef-text-shadow has-bone-color has-text-color has-xx-large-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php esc_html_e( 'Private Ranch Hunting in Alvord, Texas', '5f-ranch' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"fivef-text-shadow","textColor":"bone","fontSize":"large"} -->
<p class="has-text-align-center fivef-text-shadow has-bone-color has-text-color has-large-font-size"><?php esc_html_e( 'Dove, open range and fishing on 2,600 private acres, less than an hour from Fort Worth.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/hunting-fishing/' ) ); ?>"><?php esc_html_e( 'Explore the Hunts', '5f-ranch' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_c['booking']['phone'] ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_c['booking']['phone'] ) ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->
