<?php
/**
 * Title: Blog header
 * Slug: 5f-ranch/blog-header
 * Categories: 5f-ranch, banner
 * Inserter: no
 * Description: Photo banner and category filters at the top of the Field Notes blog.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:cover {"url":"<?php echo fivef_photo( 'creek-bottom' ); ?>","dimRatio":70,"customGradient":"linear-gradient(180deg,rgba(31,43,25,0.55) 0%,rgba(22,21,18,0.92) 100%)","minHeight":340,"contentPosition":"bottom center","isDark":true,"align":"full","className":"fivef-page-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull has-custom-content-position is-position-bottom-center is-dark fivef-page-hero" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50);min-height:340px"><img class="wp-block-cover__image-background" alt="" src="<?php echo fivef_photo( 'creek-bottom' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-70 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:linear-gradient(180deg,rgba(31,43,25,0.55) 0%,rgba(22,21,18,0.92) 100%)"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"typography":{"fontWeight":"600"}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="font-weight:600"><?php esc_html_e( '5F Ranch Blog', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":1,"className":"fivef-text-shadow","textColor":"bone"} -->
<h1 class="wp-block-heading has-text-align-center fivef-text-shadow has-bone-color has-text-color"><?php esc_html_e( 'Field Notes', '5f-ranch' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","className":"fivef-text-shadow","textColor":"bone","fontSize":"large"} -->
<p class="has-text-align-center fivef-text-shadow has-bone-color has-text-color has-large-font-size"><?php esc_html_e( 'Species guides, habitat know-how and stories from the field on native Texas game.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->
