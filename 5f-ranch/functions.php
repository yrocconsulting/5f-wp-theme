<?php
/**
 * 5F Ranch theme functions.
 *
 * @package 5f-ranch
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FIVEF_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Theme supports.
 */
function fivef_setup() {
	add_theme_support( 'editor-styles' );
	add_editor_style( 'style.css' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'fivef_setup' );

/**
 * Front-end stylesheet.
 */
function fivef_enqueue_assets() {
	// Version by file time so every deploy busts browser and CDN caches.
	wp_enqueue_style( 'fivef-style', get_stylesheet_uri(), array(), (string) filemtime( get_stylesheet_directory() . '/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'fivef_enqueue_assets' );

/**
 * Preload the heading and body fonts so the hero renders without a flash.
 */
function fivef_preload_fonts() {
	foreach ( array( 'cinzel-latin.woff2', 'montserrat-latin.woff2' ) as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $font ) )
		);
	}
}
add_action( 'wp_head', 'fivef_preload_fonts', 1 );

/**
 * Block style variations, selectable in the editor's Styles panel.
 */
function fivef_register_block_styles() {
	$styles = array(
		'core/group'     => array(
			'paper'  => __( 'Paper card', '5f-ranch' ),
			'ticket' => __( 'Ticket', '5f-ranch' ),
			'card'   => __( 'Hover card', '5f-ranch' ),
		),
		'core/heading'   => array(
			'eyebrow' => __( 'Eyebrow', '5f-ranch' ),
			'ruled'   => __( 'Ruled', '5f-ranch' ),
			'script'  => __( 'Script', '5f-ranch' ),
		),
		'core/paragraph' => array(
			'tracked' => __( 'Tracked caps', '5f-ranch' ),
			'script'  => __( 'Script', '5f-ranch' ),
		),
		'core/image'     => array(
			'torn' => __( 'Torn edge', '5f-ranch' ),
		),
		'core/list'      => array(
			'checks' => __( 'Gold checks', '5f-ranch' ),
		),
	);

	foreach ( $styles as $block => $variations ) {
		foreach ( $variations as $name => $label ) {
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
add_action( 'init', 'fivef_register_block_styles' );

/**
 * Pattern categories.
 */
function fivef_register_pattern_categories() {
	register_block_pattern_category( '5f-ranch', array( 'label' => __( '5F Ranch', '5f-ranch' ) ) );
	register_block_pattern_category( '5f-ranch-pages', array( 'label' => __( '5F Ranch: Full pages', '5f-ranch' ) ) );
}
add_action( 'init', 'fivef_register_pattern_categories' );

/**
 * Theme asset URL helper for patterns.
 *
 * @param string $file Path relative to assets/images.
 * @return string
 */
function fivef_img( $file ) {
	return esc_url( get_theme_file_uri( 'assets/images/' . $file ) );
}

/**
 * Contact details used across patterns, kept in one place.
 *
 * @return array
 */
function fivef_contacts() {
	return array(
		'management'   => array(
			'label' => __( 'Ranch Management', '5f-ranch' ),
			'phone' => '817-225-8648',
		),
		'booking'      => array(
			'label' => __( 'Hunt & Booking Information', '5f-ranch' ),
			'phone' => '817-703-3689',
		),
		'location'     => __( 'Alvord, Texas', '5f-ranch' ),
		'location_sub' => __( 'Less than an hour from Fort Worth, with easy access directly off Highway 287', '5f-ranch' ),
	);
}

/**
 * tel: link helper.
 *
 * @param string $phone Phone number as displayed.
 * @return string
 */
function fivef_tel( $phone ) {
	return esc_url( 'tel:+1' . preg_replace( '/\D/', '', $phone ) );
}

/**
 * Render another pattern file's markup so full-page patterns can reuse sections.
 *
 * @param string $slug Pattern file name without extension.
 * @return string
 */
function fivef_section( $slug ) {
	$file = get_theme_file_path( 'patterns/' . sanitize_file_name( $slug ) . '.php' );
	if ( ! file_exists( $file ) ) {
		return '';
	}
	ob_start();
	include $file;
	return ob_get_clean();
}

/**
 * Ranch photo slots: assets/photos/{slot}.jpg. A slot without its own photo
 * borrows a related one, and finally a placeholder, so layouts never break.
 */
function fivef_photo_alternates() {
	return array(
		'stock-tank'     => array( 'doves-lake' ),
		'creek-bottom'   => array( 'creek' ),
		'ranch-overview' => array( 'aerial-ponds' ),
		'headquarters'   => array( 'quarry-lake' ),
		'hog-hunt-1'     => array( 'creek-bottom', 'creek' ),
		'hog-hunt-2'     => array( 'creek-bottom', 'creek' ),
		'hog-hunt-3'     => array( 'creek-bottom', 'creek' ),
		'hog-pair'       => array( 'creek-bottom', 'creek' ),
	);
}

/**
 * Resolve a slot to the slot whose photo file actually exists.
 *
 * @param string $slot Photo slot name.
 * @return string|null Slot name with a file, or null.
 */
function fivef_photo_slot( $slot ) {
	$alts = fivef_photo_alternates();
	foreach ( array_merge( array( $slot ), isset( $alts[ $slot ] ) ? $alts[ $slot ] : array() ) as $candidate ) {
		if ( file_exists( get_theme_file_path( 'assets/photos/' . sanitize_file_name( $candidate ) . '.jpg' ) ) ) {
			return $candidate;
		}
	}
	return null;
}

/**
 * URL for a photo slot.
 *
 * @param string $slot     Photo slot name.
 * @param string $fallback Placeholder file in assets/images when no photo exists.
 * @return string Escaped URL.
 */
function fivef_photo( $slot, $fallback = 'hero-sunset.svg' ) {
	$found = fivef_photo_slot( $slot );
	if ( $found ) {
		return esc_url( get_theme_file_uri( 'assets/photos/' . $found . '.jpg' ) );
	}
	return fivef_img( $fallback );
}

/**
 * Navigation block "ref" attribute for the menu named "Main Menu", so the
 * header and footer always show that menu (edit it in Appearance → Editor →
 * Navigation). Without it the block falls back to the newest menu.
 *
 * @return string JSON fragment such as `"ref":12,` or an empty string.
 */
function fivef_nav_ref() {
	static $ref = null;
	if ( null === $ref ) {
		$nav = get_posts(
			array(
				'post_type'   => 'wp_navigation',
				'title'       => 'Main Menu',
				'post_status' => 'publish',
				'numberposts' => 1,
				'fields'      => 'ids',
			)
		);
		$ref = $nav ? '"ref":' . (int) $nav[0] . ',' : '';
	}
	return $ref;
}

/**
 * Alt text for whichever photo a slot resolves to.
 *
 * @param string $slot Photo slot name.
 * @return string Escaped alt text.
 */
function fivef_photo_alt( $slot ) {
	$alts  = array(
		'aerial-ponds'   => __( 'Aerial view of the ranch ponds, pasture and a dirt ranch road', '5f-ranch' ),
		'long-pond'      => __( 'Long brush-lined pond between open pastures', '5f-ranch' ),
		'quarry-lake'    => __( 'Aerial view of the ranch lake with rock ledges and surrounding timber', '5f-ranch' ),
		'geese-lake'     => __( 'Canada geese on the ranch lake below a rock bluff', '5f-ranch' ),
		'doves-lake'     => __( 'Mourning doves flying over the tree line above a ranch lake', '5f-ranch' ),
		'stock-tank'     => __( 'Open pasture and stock tank on the dove hunting area', '5f-ranch' ),
		'creek'          => __( 'Creek winding through dense brush and timber', '5f-ranch' ),
		'creek-bottom'   => __( 'Timbered creek bottom between open pastures', '5f-ranch' ),
		'ranch-overview' => __( 'Aerial view across the ranch: pasture, tree lines and stock tanks', '5f-ranch' ),
		'headquarters'   => __( 'Ranch headquarters with the 5F barn, pens and pond', '5f-ranch' ),
		'hog-hunt-1'     => __( 'Hunter with a large feral hog taken at night on 5F Ranch', '5f-ranch' ),
		'hog-hunt-2'     => __( 'Hunter with a thermal-scoped rifle and a feral hog taken at night', '5f-ranch' ),
		'hog-hunt-3'     => __( 'Hunter kneeling beside a feral hog after a night hunt', '5f-ranch' ),
		'hog-pair'       => __( 'Two feral hogs taken on a night hunt, with a thermal-scoped rifle', '5f-ranch' ),
	);
	$found = fivef_photo_slot( $slot );
	$key   = $found ? $found : $slot;
	return esc_attr( isset( $alts[ $key ] ) ? $alts[ $key ] : __( '5F Ranch', '5f-ranch' ) );
}

/**
 * Contact Form 7: keep the form markup exactly as written (no auto <p>/<br>),
 * so the theme's form styles control the layout.
 */
add_filter( 'wpcf7_autop_or_not', '__return_false' );

/**
 * Favicons. The crisp SVG (letters only, made for 16-32px tabs) is always
 * offered; modern browsers prefer it. The .ico and touch icon are only
 * printed when no Site Icon is set, since WordPress prints its own then.
 */
function fivef_favicons() {
	printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( get_theme_file_uri( 'assets/images/favicon.svg' ) ) );
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" href="%s" sizes="32x32">' . "\n", esc_url( get_theme_file_uri( 'assets/images/favicon.ico' ) ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( get_theme_file_uri( 'assets/images/apple-touch-icon.png' ) ) );
}
add_action( 'wp_head', 'fivef_favicons', 2 );
