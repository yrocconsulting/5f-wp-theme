<?php
/**
 * Title: Blog post grid (follows the page's query)
 * Slug: 5f-ranch/post-card-grid
 * Categories: 5f-ranch
 * Inserter: no
 * Description: Card grid used by the blog index, category archives and search.
 *
 * @package 5f-ranch
 */
?>
<!-- wp:query {"queryId":11,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":true},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"18rem"}} -->
<?php echo fivef_section( 'post-card' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<!-- /wp:post-template -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|60"}}}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center","textColor":"texas-tan"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color"><?php esc_html_e( 'No posts here yet. Check back soon.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
