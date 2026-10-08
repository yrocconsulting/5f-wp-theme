<?php
/**
 * Title: Blog category filters
 * Slug: 5f-ranch/blog-filters
 * Categories: 5f-ranch
 * Inserter: no
 * Description: "All" plus one pill per category that has posts.
 *
 * @package 5f-ranch
 */

$fivef_blog = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/field-notes/' );
?>
<!-- wp:group {"className":"fivef-cat-pills","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
<div class="wp-block-group fivef-cat-pills"><!-- wp:paragraph -->
<p><a href="<?php echo esc_url( $fivef_blog ); ?>"><?php esc_html_e( 'All', '5f-ranch' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:categories {"showEmpty":false} /--></div>
<!-- /wp:group -->
