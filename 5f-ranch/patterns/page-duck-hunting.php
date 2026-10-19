<?php
/**
 * Title: Guided Duck Hunting page
 * Slug: 5f-ranch/page-duck-hunting
 * Categories: 5f-ranch-pages
 * Keywords: duck, waterfowl, guided, ponds, retrievers, group
 * Post Types: page
 * Description: Guided duck hunts: experienced guide, HRCH retrievers, ten ponds, $300 per person for groups of 4 to 6, with the hunt video and photos.
 *
 * @package 5f-ranch
 */

$fivef_c      = fivef_contacts();
$fivef_phone  = $fivef_c['booking']['phone'];
$fivef_photos = fivef_gallery_items( true, 'duck' );
$fivef_video  = file_exists( get_theme_file_path( 'assets/duck/duck-hunt.mp4' ) );
// "Check Availability" opens the booking calendar once duck hunts are bookable online; until then it calls the ranch.
$fivef_online = function_exists( 'fivef_bk_type' ) && fivef_bk_type( 'duck' ) && fivef_bk_type( 'duck' )['enabled'];
$fivef_book   = $fivef_online ? esc_url( fivef_book_url( 'duck' ) ) : fivef_tel( $fivef_phone );
$fivef_duck   = static function ( $file ) {
	return esc_url( get_theme_file_uri( 'assets/duck/' . $file ) );
};
$fivef_facts  = array(
	array( '$300', __( 'Per person', '5f-ranch' ) ),
	array( '4', __( 'Hunter minimum', '5f-ranch' ) ),
	array( '6', __( 'Hunter maximum per standard booking', '5f-ranch' ) ),
	array( '10', __( 'Huntable ponds', '5f-ranch' ) ),
);
$fivef_dogs   = array(
	array( 'duck-08-two-labs-and-the-limit.jpg', __( 'Two black labs sitting behind a row of ducks laid out on the bank', '5f-ranch' ) ),
	array( 'duck-16-labs-under-the-cedar.jpg', __( 'A yellow lab and a black lab beside ducks and duck calls hung on a cedar', '5f-ranch' ) ),
	array( 'duck-12-two-labs-at-sunrise.jpg', __( 'A yellow lab and a black lab on a duck boat with mallards and shovelers at sunrise', '5f-ranch' ) ),
);
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"54%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:54%"><!-- wp:paragraph {"className":"is-style-tracked","style":{"typography":{"fontWeight":"700"}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="font-weight:700"><?php esc_html_e( 'Ten Ponds. Experienced Guiding. A Texas Waterfowl Experience.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Guided Duck Hunts at 5F Ranch', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Hunt with a guide who brings more than 30 years of experience to the blind. With 10 huntable ponds across our private ranch property near Alvord, Texas, 5F Ranch offers groups the opportunity to enjoy a guided waterfowl hunt in a welcoming, authentic Texas setting.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Conveniently located about one hour west of Fort Worth, 5F Ranch makes it easy to get out of the city and into the field for a day of guided waterfowl hunting.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"fontWeight":"700"}},"textColor":"bone"} -->
<p class="has-bone-color has-text-color" style="font-weight:700"><?php esc_html_e( 'Hunts start at $300 per person · 4-hunter minimum · 6-hunter maximum per standard booking', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'Have a larger group?', '5f-ranch' ); ?> <a href="<?php echo fivef_tel( $fivef_phone ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_phone ) ); ?></a> <?php esc_html_e( 'to discuss arrangements.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo $fivef_book; // phpcs:ignore -- escaped above. ?>"><?php esc_html_e( 'Check Availability', '5f-ranch' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_phone ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_phone ) ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo $fivef_duck( 'duck-01-crew-on-the-boat.jpg' ); // phpcs:ignore ?>" alt="<?php esc_attr_e( 'Three hunters and two black labs behind a limit of diving ducks laid on a boat at the edge of a 5F Ranch pond', '5f-ranch' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|sunset-gold","width":"1px"},"bottom":{"color":"#d9c8a926","width":"1px"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="border-top-color:var(--wp--preset--color--sunset-gold);border-top-width:1px;border-bottom-color:#d9c8a926;border-bottom-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide","className":"fivef-stats fivef-glance"} -->
<div class="wp-block-columns alignwide fivef-stats fivef-glance"><?php foreach ( $fivef_facts as $fivef_fact ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:paragraph {"align":"center","className":"fivef-stat-number","style":{"typography":{"fontWeight":"700"}},"fontSize":"x-large"} -->
<p class="has-text-align-center fivef-stat-number has-x-large-font-size" style="font-weight:700"><?php echo esc_html( $fivef_fact[0] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"typography":{"lineHeight":"1.5"}},"textColor":"bone","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-bone-color has-text-color has-x-small-font-size" style="line-height:1.5"><?php echo esc_html( $fivef_fact[1] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"level":2,"className":"is-style-ruled","textColor":"texas-tan","fontSize":"x-large"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color has-x-large-font-size"><?php esc_html_e( 'What’s Included', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Your guide</strong>, with 30+ years of experience', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Decoys</strong>', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Blinds</strong>', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo wp_kses_post( __( '<strong>Dogs:</strong> the guide’s own trained retrievers', '5f-ranch' ) ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:paragraph {"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'Meals and lodging are not included.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"}},"dimensions":{"minHeight":"100%"}},"layout":{"type":"default"}} -->
<div class="wp-block-group is-style-card" style="min-height:100%;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:heading {"level":2,"className":"is-style-ruled","textColor":"texas-tan","fontSize":"x-large"} -->
<h2 class="wp-block-heading is-style-ruled has-texas-tan-color has-text-color has-x-large-font-size"><?php esc_html_e( 'Hunt Hours &amp; Deposit', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo wp_kses_post( __( 'Each guided duck hunt is a <strong>one-morning hunt</strong>. It starts <strong>30 minutes before sunrise</strong> and ends at <strong>10 a.m.</strong>', '5f-ranch' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><?php echo wp_kses_post( __( 'A <strong>50% deposit</strong> is required to book your hunt.', '5f-ranch' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'Bring your own shotgun, ammunition and the licenses listed below.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"fivef-photo-portrait"} -->
<figure class="wp-block-image size-full fivef-photo-portrait"><img src="<?php echo $fivef_duck( 'duck-18-strap-full-of-ducks.jpg' ); // phpcs:ignore ?>" alt="<?php esc_attr_e( 'Hunter in waders carrying a full strap of ducks along the edge of a ranch pond', '5f-ranch' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'Your Guide', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'A Guide with 30+ Years of Experience', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Good waterfowl hunting takes experience, preparation, and an understanding of the conditions that shape a hunt. With more than three decades of guiding experience, your guide brings years of knowledge to help make your time in the field rewarding, safe, and enjoyable.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php esc_html_e( 'Every hunt depends on natural conditions and wild birds, so harvests can never be guaranteed. Our focus is to provide a quality guided experience on private ranch property.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained","contentSize":"820px"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'The Dogs', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Well-Trained Retrievers. Proven Experience.', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php esc_html_e( 'The guide’s trusted retrievers are part of what sets this experience apart. He has personally trained his dogs from just six weeks of age, continues to run them in hunt tests, and has earned a Hunting Retriever Champion (HRCH) title. That hands-on training and proven working-dog experience reflect the high standard he brings to the field, and to the dogs working alongside him.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|30"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><?php foreach ( $fivef_dogs as $fivef_dog ) : ?><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"fivef-photo-square"} -->
<figure class="wp-block-image size-full fivef-photo-square"><img src="<?php echo $fivef_duck( $fivef_dog[0] ); // phpcs:ignore ?>" alt="<?php echo esc_attr( $fivef_dog[1] ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column -->

<?php endforeach; ?></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|60"}}}} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"48%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%"><!-- wp:heading {"level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading is-style-eyebrow"><?php esc_html_e( 'The Water', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Ten Huntable Ponds. More Places to Hunt.', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( '5F Ranch features 10 huntable ponds across the property, creating multiple waterfowl hunting opportunities. Pond conditions, bird activity, weather, and seasonal patterns all influence where and how a hunt unfolds. Your guide will determine the best available approach for the conditions and the group.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"is-style-torn"} -->
<figure class="wp-block-image size-full is-style-torn"><img src="<?php echo $fivef_duck( 'duck-13-ducks-over-the-pond.jpg' ); // phpcs:ignore ?>" alt="<?php esc_attr_e( 'Ducks dropping toward decoys on a 5F Ranch pond at first light, silhouetted against the tree line', '5f-ranch' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php if ( $fivef_video ) : ?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained","contentSize":"960px"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'From the Blind', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'A Morning on the Water', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:video {"className":"fivef-video"} -->
<figure class="wp-block-video fivef-video"><video controls poster="<?php echo $fivef_duck( 'duck-hunt-poster.jpg' ); // phpcs:ignore ?>" preload="none" src="<?php echo $fivef_duck( 'duck-hunt.mp4' ); // phpcs:ignore ?>" playsinline></video></figure>
<!-- /wp:video --></div>
<!-- /wp:group -->
<?php endif; ?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Straightforward Pricing', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:table {"className":"fivef-price-table"} -->
<figure class="wp-block-table fivef-price-table"><table><thead><tr><th><?php esc_html_e( 'Booking details', '5f-ranch' ); ?></th><th><?php esc_html_e( 'Rate', '5f-ranch' ); ?></th></tr></thead><tbody><tr><td><strong><?php esc_html_e( 'Guided duck hunt', '5f-ranch' ); ?></strong></td><td><strong><?php esc_html_e( '$300 per person', '5f-ranch' ); ?></strong></td></tr><tr><td><?php esc_html_e( 'Minimum group size', '5f-ranch' ); ?></td><td><?php esc_html_e( '4 hunters', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Maximum standard group size', '5f-ranch' ); ?></td><td><?php esc_html_e( '6 hunters', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Deposit to book', '5f-ranch' ); ?></td><td><?php esc_html_e( '50% ($150 per person)', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Hunt hours', '5f-ranch' ); ?></td><td><?php esc_html_e( '30 minutes before sunrise to 10 a.m.', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Larger groups', '5f-ranch' ); ?></td><td><a href="<?php echo fivef_tel( $fivef_phone ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_phone ) ); ?></a></td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:paragraph {"align":"center","textColor":"texas-tan","fontSize":"small"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color has-small-font-size"><?php echo wp_kses_post( sprintf( /* translators: %s: phone link */ __( 'A minimum of four hunters is required for a standard booking, with a maximum of six hunters. If your group has more than six hunters, call %s so we can discuss options.', '5f-ranch' ), '<a href="' . fivef_tel( $fivef_phone ) . '">' . esc_html( $fivef_phone ) . '</a>' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}}},"backgroundColor":"charcoal-soft","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-charcoal-soft-background-color has-background" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Before You Book', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large"} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Season Dates & Licenses', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"},"blockGap":{"left":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns alignwide" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"textColor":"texas-tan"} -->
<h4 class="wp-block-heading has-texas-tan-color has-text-color"><?php esc_html_e( '2026–2027 North Texas Duck Season', '5f-ranch' ); ?></h4>
<!-- /wp:heading -->

<!-- wp:table {"className":"fivef-price-table"} -->
<figure class="wp-block-table fivef-price-table"><table><tbody><tr><td><?php esc_html_e( 'Early teal (statewide)', '5f-ranch' ); ?></td><td><?php esc_html_e( 'Sept. 19 – Sept. 27, 2026', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Youth, veteran & active duty', '5f-ranch' ); ?></td><td><?php esc_html_e( 'Nov. 7 – Nov. 8, 2026', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Regular season, first segment', '5f-ranch' ); ?></td><td><?php esc_html_e( 'Nov. 14 – Nov. 29, 2026', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Closed (season split)', '5f-ranch' ); ?></td><td><?php esc_html_e( 'Nov. 30 – Dec. 4, 2026', '5f-ranch' ); ?></td></tr><tr><td><?php esc_html_e( 'Regular season, second segment', '5f-ranch' ); ?></td><td><?php esc_html_e( 'Dec. 5, 2026 – Jan. 31, 2027', '5f-ranch' ); ?></td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:paragraph {"textColor":"texas-tan","fontSize":"small"} -->
<p class="has-texas-tan-color has-text-color has-small-font-size"><?php echo wp_kses_post( sprintf( /* translators: %s: TPWD URL */ __( 'Shooting hours are one-half hour before sunrise to sunset. Federal and Texas bag limits apply; see <a href="%s" target="_blank" rel="noopener">Texas Parks &amp; Wildlife</a> for current dates and limits.', '5f-ranch' ), 'https://tpwd.texas.gov/regulations/outdoor-annual/hunting/migratory-game-bird-regulations' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":4,"textColor":"texas-tan"} -->
<h4 class="wp-block-heading has-texas-tan-color has-text-color"><?php esc_html_e( 'What Every Hunter Must Carry', '5f-ranch' ); ?></h4>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-checks"} -->
<ul class="wp-block-list is-style-checks"><!-- wp:list-item -->
<li><?php esc_html_e( 'A valid Texas hunting license', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Texas Migratory Game Bird Endorsement', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'HIP (Harvest Information Program) certification', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Federal Duck Stamp (hunters 16 and older)', '5f-ranch' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'Proof of hunter education, if born on or after September 2, 1971', '5f-ranch' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<?php if ( $fivef_photos ) : ?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:heading {"textAlign":"center","level":2,"className":"is-style-eyebrow"} -->
<h2 class="wp-block-heading has-text-align-center is-style-eyebrow"><?php esc_html_e( 'Duck Season at 5F Ranch', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","level":3,"textColor":"texas-tan","fontSize":"xx-large","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}}} -->
<h3 class="wp-block-heading has-text-align-center has-texas-tan-color has-text-color has-xx-large-font-size" style="margin-bottom:var(--wp--preset--spacing--50)"><?php esc_html_e( 'Labs, Limits and Sunrises', '5f-ranch' ); ?></h3>
<!-- /wp:heading -->

<?php echo fivef_gallery_markup( $fivef_photos, 3 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in the helper. ?>

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--50)"><!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/gallery/#ducks' ) ); ?>"><?php esc_html_e( 'More Duck Photos', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
<?php endif; ?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"margin":{"top":"0","bottom":"0"}},"border":{"top":{"color":"var:preset|color|sunset-gold","width":"1px"}}},"backgroundColor":"pine","layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull has-pine-background-color has-background" style="border-top-color:var(--wp--preset--color--sunset-gold);border-top-width:1px;margin-top:0;margin-bottom:0;padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)"><!-- wp:heading {"textAlign":"center","level":2,"textColor":"bone","fontSize":"xx-large"} -->
<h2 class="wp-block-heading has-text-align-center has-bone-color has-text-color has-xx-large-font-size"><?php esc_html_e( 'Plan Your Hunt', '5f-ranch' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"texas-tan"} -->
<p class="has-text-align-center has-texas-tan-color has-text-color"><?php esc_html_e( 'Gather your group and contact 5F Ranch to ask about available dates and current hunting conditions. We’ll discuss your group size and help you understand what to expect before you arrive.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}}} -->
<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo fivef_tel( $fivef_phone ); ?>"><?php echo esc_html( sprintf( /* translators: %s: phone number */ __( 'Call %s', '5f-ranch' ), $fivef_phone ) ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo $fivef_book; // phpcs:ignore -- escaped above. ?>"><?php esc_html_e( 'Book a Guided Duck Hunt', '5f-ranch' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"align":"center","className":"is-style-tracked","style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"textColor":"sunset-gold","fontSize":"x-small"} -->
<p class="has-text-align-center is-style-tracked has-sunset-gold-color has-text-color has-x-small-font-size" style="margin-top:var(--wp--preset--spacing--40)"><?php esc_html_e( '5F Ranch · Near Alvord, Texas · More Time Hunting. Less Time Driving.', '5f-ranch' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
