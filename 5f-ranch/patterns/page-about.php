<?php
/**
 * Title: About the Ranch page
 * Slug: 5f-ranch/page-about
 * Categories: 5f-ranch-pages
 * Keywords: about, ranch, story, land
 * Post Types: page
 * Description: About the Ranch page content: the land, stewardship and ranch guidelines.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( '5F Ranch is a 2,600-acre private ranch in Alvord, Texas, managed for good habitat and good days in the field, and close enough to Fort Worth that you spend more time hunting and less time driving.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color"><?php esc_html_e( 'The Land', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'The ranch covers approximately 2,600 acres of North Texas country. The active hunting area is roughly 500 rolling acres planted and managed with sunflowers and dove weed, broken up by roosting and shade trees, with several ponds for water.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'It’s the kind of country doves love, and the kind of place you’ll want to bring a rod on hunting days, too.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'ranch-overview', 'placeholder-pond.jpg' ); ?>" alt="<?php echo fivef_photo_alt( 'ranch-overview' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|60"},"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center" style="margin-top:var(--wp--preset--spacing--60)"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo fivef_photo( 'headquarters', 'placeholder-dove.jpg' ); ?>" alt="<?php echo fivef_photo_alt( 'headquarters' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"className":"is-style-ruled","textColor":"texas-tan"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color"><?php esc_html_e( 'Stewardship First', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo wp_kses_post( __( 'We intentionally limit hunting to Opening Day and weekends, because <strong>rested habitat hunts better</strong>.', '5f-ranch' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Quiet weekdays let the birds settle and give Ranch Management time to work the property: shredding fresh feeding strips to keep birds local, managing tree lines and improving habitat ahead of the next weekend.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"is-style-script","textColor":"sunset-gold","fontSize":"x-large"} -->
<p class="is-style-script has-sunset-gold-color has-text-color has-x-large-font-size"><?php esc_html_e( 'Thoughtful stewardship creates better hunts.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php echo fivef_section( 'stats-strip' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|30"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--30)"><!-- wp:heading {"textAlign":"center","className":"is-style-default","textColor":"texas-tan"} -->
<h2 class="wp-block-heading has-text-align-center is-style-default has-texas-tan-color has-text-color"><?php esc_html_e( 'Ranch Guidelines at a Glance', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Hunters must be 18 years of age or older.</strong> No exceptions.', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Hunt only on authorized dates: Opening Day and weekends during the season.', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Carry the proper Texas licenses and follow all Texas Parks & Wildlife regulations.', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Use the gate and access instructions provided to you. Keep gate details private.', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Leave it better than you found it: pack out hulls, trash and gear.', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Follow Ranch Management’s direction on the property at all times.', '5f-ranch' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"fontSize":"small","textColor":"texas-tan"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'Confirmed members and guests receive the full Ranch Guidelines, property map and access information before arriving.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<?php
echo fivef_section( 'expectations' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
echo fivef_section( 'cta-band' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
