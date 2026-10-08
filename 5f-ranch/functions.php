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
	wp_enqueue_style( 'fivef-style', get_stylesheet_uri(), array(), FIVEF_VERSION );
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
 * Ranch photo slots. Each slot uses assets/photos/{slot}.jpg when present,
 * otherwise falls back to a placeholder so the layout never breaks.
 *
 * @param string $slot     Photo slot name.
 * @param string $fallback Optional placeholder file in assets/images.
 * @return string Escaped URL.
 */
function fivef_photo( $slot, $fallback = '' ) {
	$fallbacks = array(
		'aerial-ponds'   => 'placeholder-pond.jpg',
		'long-pond'      => 'placeholder-pond.jpg',
		'quarry-lake'    => 'placeholder-pond.jpg',
		'geese-lake'     => 'placeholder-pond.jpg',
		'stock-tank'     => 'placeholder-dove.jpg',
		'creek'          => 'hero-sunset.svg',
		'creek-bottom'   => 'hero-sunset.svg',
		'ranch-overview' => 'hero-sunset.svg',
		'headquarters'   => 'hero-sunset.svg',
	);
	$file = 'assets/photos/' . sanitize_file_name( $slot ) . '.jpg';
	if ( file_exists( get_theme_file_path( $file ) ) ) {
		return esc_url( get_theme_file_uri( $file ) );
	}
	if ( ! $fallback ) {
		$fallback = isset( $fallbacks[ $slot ] ) ? $fallbacks[ $slot ] : 'placeholder-pond.jpg';
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
