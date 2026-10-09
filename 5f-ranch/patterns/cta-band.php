<?php
/**
 * Title: Call to action band
 * Slug: 5f-ranch/cta-band
 * Categories: 5f-ranch, call-to-action
 * Keywords: cta, book, call, contact
 * Description: Green band with a heading, booking phone button and a contact link.
 *
 * @package 5f-ranch
 */

$fivef_c = fivef_contacts();
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|sunset-gold","width":"1px"}}},"backgroundColor":"pine","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-pine-background-color has-background" style="border-top-color:var(--wp--preset--color--sunset-gold);border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"textColor":"bone","fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center has-bone-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Ready to Hunt 5F Ranch?', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"texas-tan"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color"><?php esc_html_e( 'Call for hog hunt availability and booking. We’re happy to answer questions about the ranch.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_c['booking']['phone'] ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_c['booking']['phone'] ) ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact the Ranch', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php esc_html_e( 'Hunters must be 18 or older. No exceptions.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
