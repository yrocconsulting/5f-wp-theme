<?php
/**
 * Title: Book a Hunt page
 * Slug: 5f-ranch/page-book
 * Categories: 5f-ranch-pages
 * Keywords: book, booking, calendar, dates, deposit, reserve
 * Post Types: page
 * Description: The booking calendar (5F Ranch Booking plugin) with how booking works.
 *
 * @package 5f-ranch
 */

$fivef_c = fivef_contacts();
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"large"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php esc_html_e( 'Pick an open date, choose how many hunters, and reserve your spots with a deposit. Four hunters. One ranch. A weekend worth remembering.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--60)"><?php if ( shortcode_exists( 'fivef_booking' ) ) : ?><!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:shortcode -->
[fivef_booking]
<!-- /wp:shortcode --></div>
<!-- /wp:group --><?php else : ?><!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">
<?php
echo wp_kses_post(
	sprintf(
		/* translators: 1: phone link, 2: contact page URL */
		__( 'Online booking is coming soon. To reserve dates now, call %1$s or <a href="%2$s">send us a message</a>.', '5f-ranch' ),
		'<a href="' . fivef_tel( $fivef_c['booking']['phone'] ) . '">' . esc_html( $fivef_c['booking']['phone'] ) . '</a>',
		esc_url( fivef_inquiry_url( 'Thermal Hog Hunt weekend' ) )
	)
);
?>
</p>
<!-- /wp:paragraph --><?php endif; ?></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'How Booking Works', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"},"blockGap":{"left":"var:preset|spacing|40"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--40)"><?php
$fivef_steps = array(
	array( '1', __( 'Pick Your Date', '5f-ranch' ), __( 'Highlighted dates are open. Each hog hunt weekend takes up to four hunters; book a spot or the whole weekend.', '5f-ranch' ) ),
	array( '2', __( 'Pay Your Deposit', '5f-ranch' ), __( 'A $1,000 non-refundable deposit per hunter holds your spots and is applied to your total. You pay securely on Stripe’s checkout page.', '5f-ranch' ) ),
	array( '3', __( 'We’ll Be in Touch', '5f-ranch' ), __( 'You’ll get a confirmation email right away. Before your hunt we’ll send gate access, a property map and everything you need.', '5f-ranch' ) ),
);
foreach ( $fivef_steps as $fivef_step ) :
	?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center","className":"is-style-script","textColor":"sunset-gold","fontSize":"xx-large"} -->
<p class="has-text-align-center is-style-script has-sunset-gold-color has-text-color has-xx-large-font-size"><?php echo esc_html( $fivef_step[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-large-font-size"><?php echo esc_html( $fivef_step[1] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size"><?php echo esc_html( $fivef_step[2] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"small","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-small-font-size" style="margin-top:var(--wp--preset--spacing--50)">
<?php
echo wp_kses_post(
	sprintf(
		/* translators: 1: pricing page URL, 2: phone link */
		__( 'See the full <a href="%1$s">pricing and what’s included</a>. Questions, or a date you don’t see? Call %2$s.', '5f-ranch' ),
		esc_url( home_url( '/pricing/' ) ),
		'<a href="' . fivef_tel( $fivef_c['booking']['phone'] ) . '">' . esc_html( $fivef_c['booking']['phone'] ) . '</a>'
	)
);
?>
</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
