<?php
/**
 * Title: Predators: a bonus on the hunt
 * Slug: 5f-ranch/predator-feature
 * Categories: 5f-ranch, featured
 * Keywords: predator, coyote, bobcat, bonus, hog hunt
 * Description: Predators (coyotes, bobcats) taken on hog hunts when the chance comes, with the ranch bobcat photo.
 *
 * @package 5f-ranch
 */

$fivef_bobcat = file_exists( get_theme_file_path( 'assets/gallery/featured-03-bobcat.jpg' ) )
	? esc_url( get_theme_file_uri( 'assets/gallery/featured-03-bobcat.jpg' ) )
	: fivef_photo( 'creek-bottom' );
?>
<!-- wp:group {"anchor":"predators","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div id="predators" class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo $fivef_bobcat; // phpcs:ignore -- escaped above. ?>" alt="<?php esc_attr_e( 'Bobcat taken on 5F Ranch, laid on the rack of a ranch truck at dusk', '5f-ranch' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"52%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Predators', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'A Bonus on the Hunt', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Hogs aren’t the only thing moving after dark. Coyotes and bobcats work the same creek bottoms and feeders, and when the opportunity comes up on a hog hunt, predators are usually taken as well.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'Predators are taken at your guide’s call and under Texas Parks & Wildlife regulations.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
