<?php
/**
 * Title: Weekend at a glance
 * Slug: 5f-ranch/weekend-glance
 * Categories: 5f-ranch, text
 * Keywords: stats, glance, four hunters, lodging, harvest limit
 * Description: The four headline points of a 5F Ranch weekend, in a strip under the hero.
 *
 * @package 5f-ranch
 */

$fivef_stats = array(
	array( '4', __( 'Hunters per weekend', '5f-ranch' ) ),
	array( '2,600', __( 'Private acres', '5f-ranch' ) ),
	array( __( 'Overnight', '5f-ranch' ), __( 'Lodging included', '5f-ranch' ) ),
	array( __( 'No Limit', '5f-ranch' ), __( 'Feral hog harvest', '5f-ranch' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|sunset-gold","width":"1px"},"bottom":{"color":"#d9c8a926","width":"1px"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="border-top-color:var(--wp--preset--color--sunset-gold);border-top-width:1px;border-bottom-color:#d9c8a926;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide","className":"fivef-stats fivef-glance"} -->
<div class="wp-block-columns alignwide fivef-stats fivef-glance"><?php foreach ( $fivef_stats as $fivef_stat ) : ?><!-- wp:column -->
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
