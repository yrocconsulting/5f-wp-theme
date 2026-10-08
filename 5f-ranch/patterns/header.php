<?php
/**
 * Title: Header
 * Slug: 5f-ranch/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 *
 * @package 5f-ranch
 */

$fivef_c = fivef_contacts();
?>
<!-- wp:group {"className":"fivef-header","style":{"spacing":{"padding":{"top":"0.85rem","bottom":"0.85rem"}},"elements":{"link":{"color":{"text":"var:preset|color|bone"}}}},"backgroundColor":"charcoal","textColor":"bone","layout":{"type":"constrained"}} -->
<div class="wp-block-group fivef-header has-bone-color has-charcoal-background-color has-text-color has-background has-link-color" style="padding-top:0.85rem;padding-bottom:0.85rem"><!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide"><!-- wp:image {"width":"210px","sizeSlug":"full","linkDestination":"custom","className":"fivef-header-logo","style":{"border":{"radius":"0px"}}} -->
<figure class="wp-block-image size-full is-resized has-custom-border fivef-header-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo fivef_img( 'logo-horizontal-cream.svg' ); ?>" alt="<?php esc_attr_e( '5F Ranch, Alvord, Texas — home', '5f-ranch' ); ?>" style="border-radius:0px;width:210px"/></a></figure>
<!-- /wp:image -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
<div class="wp-block-group"><!-- wp:navigation {<?php echo fivef_nav_ref(); // phpcs:ignore ?>"overlayBackgroundColor":"charcoal","overlayTextColor":"bone","layout":{"type":"flex","justifyContent":"right"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} /-->

<!-- wp:buttons {"className":"fivef-header-cta"} -->
<div class="wp-block-buttons fivef-header-cta"><!-- wp:button {"style":{"spacing":{"padding":{"top":"0.7em","bottom":"0.7em","left":"1.3em","right":"1.3em"}}},"fontSize":"x-small"} -->
<div class="wp-block-button has-custom-font-size has-x-small-font-size"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_c['booking']['phone'] ); ?>" style="padding-top:0.7em;padding-right:1.3em;padding-bottom:0.7em;padding-left:1.3em"><?php esc_html_e( 'Book a Hunt', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
