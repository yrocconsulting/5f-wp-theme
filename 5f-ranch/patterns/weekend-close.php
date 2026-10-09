<?php
/**
 * Title: Conveniently close + closing call to action
 * Slug: 5f-ranch/weekend-close
 * Categories: 5f-ranch, call-to-action
 * Keywords: location, fort worth, book, plan, weekend
 * Description: Short location note followed by the closing "Four hunters. One ranch." band with the inquiry button.
 *
 * @package 5f-ranch
 */

$fivef_c = fivef_contacts();
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Alvord, Texas', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Conveniently Close. A World Away.', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size"><?php esc_html_e( 'Located near Alvord, Texas, less than an hour west of Fort Worth, 5F Ranch is close enough for a convenient getaway, and far enough away to feel like you have truly escaped.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|sunset-gold","width":"1px"}}},"backgroundColor":"pine","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-pine-background-color has-background" style="border-top-color:var(--wp--preset--color--sunset-gold);border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"textColor":"bone","fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center has-bone-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Four Hunters. One Ranch. A Weekend Worth Remembering.', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"texas-tan"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color"><?php esc_html_e( 'Availability is limited to keep the experience personal. Plan your 5F Ranch weekend.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( fivef_inquiry_url( 'Thermal Hog Hunt weekend' ) ); ?>"><?php esc_html_e( 'Plan Your 5F Ranch Experience', '5f-ranch' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_c['booking']['phone'] ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_c['booking']['phone'] ) ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php esc_html_e( '5F Ranch · More Time Hunting. Less Time Driving.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
