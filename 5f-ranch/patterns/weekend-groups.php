<?php
/**
 * Title: Make it more than a hunt (groups)
 * Slug: 5f-ranch/weekend-groups
 * Categories: 5f-ranch, call-to-action
 * Keywords: corporate, clients, team, friends, private weekend
 * Description: Photo band for friends' weekends, corporate groups and client entertainment, with a private-weekend inquiry button.
 *
 * @package 5f-ranch
 */

$fivef_bg = fivef_photo( 'creek-bottom' );
?>
<!-- wp:cover {"url":"<?php echo $fivef_bg; // phpcs:ignore ?>","dimRatio":80,"overlayColor":"charcoal","minHeight":420,"contentPosition":"center center","isDark":true,"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-cover alignfull is-dark" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);min-height:420px"><img class="wp-block-cover__image-background" alt="" src="<?php echo $fivef_bg; // phpcs:ignore ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-charcoal-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Groups & Private Weekends', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"bone","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-bone-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Make It More Than a Hunt', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"bone"} -->
<p class="has-text-align-center has-bone-color has-text-color"><?php esc_html_e( 'Trade conference rooms for the Texas countryside. Bring your team, entertain your best customers or reconnect with friends over a weekend built around hunting, good food and authentic hospitality.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"typography":{"fontWeight":"600"}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="font-weight:600"><?php esc_html_e( 'Friends’ weekends · Small corporate groups · Client entertainment · Special occasions', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( fivef_inquiry_url( 'Private / group weekend' ) ); ?>"><?php esc_html_e( 'Ask About a Private Weekend', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->
