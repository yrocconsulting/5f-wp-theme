<?php
/**
 * Title: Thermal Hog Hunts page
 * Slug: 5f-ranch/page-hog-hunts
 * Categories: 5f-ranch-pages
 * Keywords: hog, thermal, night, hunt, feral
 * Post Types: page
 * Description: Dedicated page for guided nighttime thermal hog hunts.
 *
 * @package 5f-ranch
 */

$fivef_c     = fivef_contacts();
$fivef_steps = array(
	array( '1', __( 'Arrive & Gear Up', '5f-ranch' ), __( 'Meet your guide at the ranch before dark for a safety briefing, a look at the property and a check of your rifle and optics.', '5f-ranch' ) ),
	array( '2', __( 'Glass the Dark', '5f-ranch' ), __( 'After nightfall, scan fields, creek bottoms and feeding areas with thermal optics to find hogs and pick out your target.', '5f-ranch' ) ),
	array( '3', __( 'Close In & Take the Shot', '5f-ranch' ), __( 'Work the wind, close the distance with your guide and take a clean, identified shot. Then recover your hog and get photos.', '5f-ranch' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Feral hogs do their damage after dark, and that’s when we go after them. Our guided thermal hunts put you on private ground along Big Sandy Creek with the optics to see every hog in the field, less than an hour from Fort Worth.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'hog-hunt-1' ); ?>" alt="<?php echo fivef_photo_alt( 'hog-hunt-1' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color"><?php esc_html_e( 'Guided Night Hunts', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Every hunt is led by an experienced guide who knows where the hogs travel and feed on the ranch. You’ll hunt with thermal optics that pick up body heat in total darkness, so you can see the whole sounder and choose your shot.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php esc_html_e( 'Weekend hunts with overnight lodging and hearty ranch meals', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Night hunting with thermal optics', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Private ground along Big Sandy Creek', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Just four hunters per weekend', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'No harvest limit on feral hogs, subject to applicable laws and safe hunting practices', '5f-ranch' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_c['booking']['phone'] ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Book: %s', '5f-ranch' ), $fivef_c['booking']['phone'] ) ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'How It Works', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'A Night on the Ranch', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $fivef_steps as $fivef_step ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-ticket","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"dimensions":{"minHeight":"100%"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-ticket" style="min-height:100%;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","className":"is-style-script","textColor":"sunset-gold","fontSize":"huge"} -->
<p class="has-text-align-center is-style-script has-sunset-gold-color has-text-color has-huge-font-size"><?php echo esc_html( $fivef_step[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":4,"fontSize":"large"} -->
<h4 class="wp-block-heading has-text-align-center has-large-font-size"><?php echo esc_html( $fivef_step[1] ); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size"><?php echo esc_html( $fivef_step[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'predator-feature' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<?php echo fivef_section( 'hunt-photos' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"860px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:group {"className":"is-style-paper","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group is-style-paper" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-script","style":{"color":{"text":"#26341f"}},"fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center is-style-script has-text-color has-xx-large-font-size" style="color:#26341f"><?php esc_html_e( 'Why We Hunt Hogs', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'Feral hogs aren’t native to Texas. They root up pastures, foul ponds and creeks, and compete with deer, turkey and quail for food and nesting cover. Keeping their numbers down protects the land and the wildlife on it, and it makes for some of the most exciting hunting in Texas.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"typography":{"fontWeight":"700"}},"fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-x-small-font-size" style="font-weight:700"><a href="<?php echo esc_url( home_url( '/feral-hogs-texas-night-hunting/' ) ); ?>"><?php esc_html_e( 'Read our Field Notes on feral hogs →', '5f-ranch' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
