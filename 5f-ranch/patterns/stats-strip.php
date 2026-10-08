<?php
/**
 * Title: Ranch at a glance (stats)
 * Slug: 5f-ranch/stats-strip
 * Categories: 5f-ranch, text
 * Keywords: stats, numbers, facts, glance
 * Description: Five quick facts about the ranch, separated by thin rules.
 *
 * @package 5f-ranch
 */

$fivef_stats = array(
	array( 'Alvord, TX', __( 'Less than an hour from Fort Worth', '5f-ranch' ) ),
	array( '2,600', __( 'Private ranch acres', '5f-ranch' ) ),
	array( '~500', __( 'Acres of managed dove habitat', '5f-ranch' ) ),
	array( __( 'Weekends', '5f-ranch' ), __( 'Opening Day & weekends only', '5f-ranch' ) ),
	array( '18+', __( 'Hunters only. No exceptions.', '5f-ranch' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"#d9c8a926","width":"1px"},"bottom":{"color":"#d9c8a926","width":"1px"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="border-top-color:#d9c8a926;border-top-width:1px;border-bottom-color:#d9c8a926;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide","className":"fivef-stats"} -->
<div class="wp-block-columns alignwide fivef-stats"><?php foreach ( $fivef_stats as $fivef_stat ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center","className":"fivef-stat-number","style":{"typography":{"fontWeight":"700"}},"fontSize":"x-large"} -->
<p class="has-text-align-center fivef-stat-number has-x-large-font-size" style="font-weight:700"><?php echo esc_html( $fivef_stat[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"typography":{"lineHeight":"1.5"}},"textColor":"bone","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-bone-color has-text-color has-x-small-font-size" style="line-height:1.5"><?php echo esc_html( $fivef_stat[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
