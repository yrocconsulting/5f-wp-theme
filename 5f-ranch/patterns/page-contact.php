<?php
/**
 * Title: Contact page
 * Slug: 5f-ranch/page-contact
 * Categories: 5f-ranch-pages
 * Keywords: contact, phone, map, location
 * Post Types: page
 * Description: Phone numbers, location and map.
 *
 * @package 5f-ranch
 */

$fivef_c     = fivef_contacts();
$fivef_lines = array(
	array( $fivef_c['booking']['label'], $fivef_c['booking']['phone'], __( 'Hog hunt availability and booking', '5f-ranch' ) ),
	array( $fivef_c['management']['label'], $fivef_c['management']['phone'], __( 'On-property questions and access', '5f-ranch' ) ),
	array( __( 'Emergency', '5f-ranch' ), '911', __( 'Call 911 for any immediate emergency', '5f-ranch' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Questions about the ranch or booking a hog hunt? Give us a call. We’re happy to help.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $fivef_lines as $fivef_line ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-ticket","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"dimensions":{"minHeight":"100%"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-ticket" style="min-height:100%;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php echo esc_html( $fivef_line[0] ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontWeight":"700"}},"fontSize":"x-large"} -->
<p class="has-text-align-center has-x-large-font-size" style="font-weight:700"><a href="<?php echo fivef_tel( $fivef_line[1] ); ?>"><?php echo esc_html( $fivef_line[1] ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size"><?php echo esc_html( $fivef_line[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide"><?php if ( class_exists( 'WPCF7' ) ) : ?><!-- wp:column {"width":"58%"} -->
<div class="wp-block-column" style="flex-basis:58%"><!-- wp:group {"className":"is-style-paper","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-paper" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"level":2,"className":"is-style-script","style":{"color":{"text":"#26341f"}},"fontSize":"xx-large"} -->
<h2 class="wp-block-heading is-style-script has-text-color has-xx-large-font-size" style="color:#26341f"><?php esc_html_e( 'Send Us a Message', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size"><?php esc_html_e( 'Tell us what you’re interested in and how to reach you. We’ll get back to you as soon as we can.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[contact-form-7 title="5F Ranch Contact" html_class="fivef-form"]
<!-- /wp:shortcode --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endif; ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color"><?php esc_html_e( 'Getting Here', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo wp_kses_post( sprintf( '<strong>%s</strong><br>%s.', esc_html( $fivef_c['location'] ), esc_html( $fivef_c['location_sub'] ) ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:html -->
<div class="fivef-map"><iframe title="<?php esc_attr_e( 'Map of Alvord, Texas', '5f-ranch' ); ?>" src="https://www.google.com/maps?q=Alvord,+TX&amp;z=11&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
<!-- /wp:html -->

<!-- wp:paragraph {"fontSize":"small","textColor":"texas-tan"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'The ranch is private property. Exact directions and gate access are provided to confirmed members and guests.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
