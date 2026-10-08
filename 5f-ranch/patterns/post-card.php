<?php
/**
 * Title: Blog post card
 * Slug: 5f-ranch/post-card
 * Categories: 5f-ranch
 * Inserter: no
 * Description: One post card (inside a Post Template block).
 *
 * @package 5f-ranch
 */
?>
<!-- wp:group {"className":"is-style-card fivef-post-card","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"},"blockGap":"0"},"dimensions":{"minHeight":"100%"}},"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap","justifyContent":"stretch"}} -->
<div class="wp-block-group is-style-card fivef-post-card" style="min-height:100%;padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/10","style":{"spacing":{"margin":{"bottom":"0"}}}} /-->

<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"0.6rem"}},"layout":{"type":"default"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:post-terms {"term":"category","className":"is-style-tracked fivef-post-cats","style":{"typography":{"fontWeight":"700"}},"fontSize":"x-small"} /-->

<!-- wp:post-title {"isLink":true,"level":3,"fontSize":"large"} /-->

<!-- wp:post-excerpt {"moreText":"<?php echo esc_attr__( 'Read more →', '5f-ranch' ); ?>","excerptLength":26,"fontSize":"small"} /-->

<!-- wp:post-date {"className":"is-style-tracked","textColor":"texas-tan","fontSize":"x-small"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
