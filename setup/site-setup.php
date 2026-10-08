<?php
/**
 * One-time / idempotent site setup for 5F Ranch.
 *
 * Run on the server with:  wp eval-file setup/site-setup.php
 *
 * Safe to run repeatedly: it only CREATES things that are missing. It never
 * overwrites a page, menu or image you have edited in WordPress.
 *
 * @package 5f-ranch
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( "Run this with WP-CLI: wp eval-file setup/site-setup.php\n" );
}

$fivef_log = static function ( $msg ) {
	if ( class_exists( 'WP_CLI' ) ) {
		WP_CLI::log( $msg );
	} else {
		echo $msg . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
};

/*
 * 1. Site basics.
 */
if ( 'Just another WordPress site' === get_option( 'blogdescription' ) || '' === get_option( 'blogdescription' ) ) {
	update_option( 'blogdescription', 'Private ranch hunting & fishing in Alvord, Texas' );
}
if ( in_array( get_option( 'blogname' ), array( '', 'My WordPress Website', 'My Blog' ), true ) ) {
	update_option( 'blogname', '5F Ranch' );
}
if ( '' === get_option( 'permalink_structure' ) ) {
	update_option( 'permalink_structure', '/%postname%/' );
	$fivef_log( 'Permalinks set to /%postname%/' );
}
update_option( 'timezone_string', get_option( 'timezone_string' ) ? get_option( 'timezone_string' ) : 'America/Chicago' );

/*
 * 2. Media: import ranch photos from the theme into the Media Library (once each).
 */
require_once ABSPATH . 'wp-admin/includes/image.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';

$fivef_photo_titles = array(
	'aerial-ponds'   => 'Aerial view of the ranch ponds',
	'long-pond'      => 'Long pond between pastures',
	'quarry-lake'    => 'Ranch lake with rock ledges',
	'geese-lake'     => 'Canada geese on the ranch lake',
	'stock-tank'     => 'Pasture and stock tank',
	'creek'          => 'Creek through the brush',
	'creek-bottom'   => 'Timbered creek bottom',
	'ranch-overview' => 'Aerial view across the ranch',
	'headquarters'   => 'Ranch headquarters and 5F barn',
);

$fivef_media = array();
$fivef_dir   = get_theme_file_path( 'assets/photos' );
foreach ( $fivef_photo_titles as $slot => $title ) {
	$src = $fivef_dir . '/' . $slot . '.jpg';
	if ( ! file_exists( $src ) ) {
		continue;
	}
	$existing = get_posts(
		array(
			'post_type'   => 'attachment',
			'post_status' => 'inherit',
			'meta_key'    => '_fivef_photo_slot', // phpcs:ignore WordPress.DB.SlowDBQuery
			'meta_value'  => $slot, // phpcs:ignore WordPress.DB.SlowDBQuery
			'numberposts' => 1,
			'fields'      => 'ids',
		)
	);
	if ( $existing ) {
		$fivef_media[ $slot ] = (int) $existing[0];
		continue;
	}
	$tmp = wp_tempnam( $slot . '.jpg' );
	copy( $src, $tmp );
	$id = media_handle_sideload(
		array(
			'name'     => '5f-ranch-' . $slot . '.jpg',
			'tmp_name' => $tmp,
		),
		0,
		$title
	);
	if ( is_wp_error( $id ) ) {
		$fivef_log( "Could not import {$slot}: " . $id->get_error_message() );
		continue;
	}
	update_post_meta( $id, '_fivef_photo_slot', $slot );
	update_post_meta( $id, '_wp_attachment_image_alt', $title );
	$fivef_media[ $slot ] = (int) $id;
	$fivef_log( "Imported photo: {$slot} (#{$id})" );
}

/*
 * 3. Pages. Content is the matching theme pattern; the editor expands it into
 *    normal, editable blocks the first time the page is opened.
 */
$fivef_pages = array(
	'home'               => array( 'Home', 'page-home', 0, 'page-landing', '' ),
	'about-the-ranch'    => array( 'About the Ranch', 'page-about', 0, '', 'headquarters' ),
	'hunting-fishing'    => array( 'Hunting & Fishing', 'page-hunting-fishing', 0, '', 'ranch-overview' ),
	'dove-hunting'       => array( 'Dove Hunting', 'page-dove-hunting', 'hunting-fishing', '', 'stock-tank' ),
	'open-range-hunting' => array( 'Open Range Hunting', 'page-open-range-hunting', 'hunting-fishing', '', 'creek' ),
	'fishing'            => array( 'Fishing', 'page-fishing', 'hunting-fishing', '', 'geese-lake' ),
	'contact'            => array( 'Contact', 'page-contact', 0, '', 'aerial-ponds' ),
);

// Slugs this script has created before. A page you later delete is NOT re-created.
$fivef_created = (array) get_option( 'fivef_setup_created', array() );
$fivef_ids     = array();
$fivef_order   = 0;
foreach ( $fivef_pages as $slug => $def ) {
	list( $title, $pattern, $parent_slug, $template, $photo ) = $def;
	$fivef_order++;
	$parent_id = $parent_slug ? ( isset( $fivef_ids[ $parent_slug ] ) ? $fivef_ids[ $parent_slug ] : 0 ) : 0;

	$found = get_posts(
		array(
			'post_type'   => 'page',
			'name'        => $slug,
			'post_parent' => $parent_id,
			'post_status' => array( 'publish', 'draft', 'private', 'pending', 'future' ),
			'numberposts' => 1,
		)
	);

	if ( $found ) {
		$fivef_ids[ $slug ] = $found[0]->ID;
		$fivef_log( "Page exists, left untouched: {$title} (#{$found[0]->ID})" );
		continue;
	}
	if ( in_array( $slug, $fivef_created, true ) ) {
		$fivef_log( "Page {$title} was removed in WordPress; not re-creating it." );
		continue;
	}

	$id = wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => $title,
			'post_name'    => $slug,
			'post_parent'  => $parent_id,
			'menu_order'   => $fivef_order,
			'post_content' => '<!-- wp:pattern {"slug":"5f-ranch/' . $pattern . '"} /-->',
		),
		true
	);

	if ( is_wp_error( $id ) ) {
		$fivef_log( "Could not create {$title}: " . $id->get_error_message() );
		continue;
	}
	if ( $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}
	if ( $photo && isset( $fivef_media[ $photo ] ) ) {
		set_post_thumbnail( $id, $fivef_media[ $photo ] );
	}
	$fivef_ids[ $slug ] = $id;
	$fivef_created[]    = $slug;
	$fivef_log( "Created page: {$title} (#{$id})" );
}
update_option( 'fivef_setup_created', array_values( array_unique( $fivef_created ) ), false );

// Add featured images to existing pages that still have none (never replaces one).
foreach ( $fivef_pages as $slug => $def ) {
	$photo = $def[4];
	if ( $photo && isset( $fivef_ids[ $slug ], $fivef_media[ $photo ] ) && ! has_post_thumbnail( $fivef_ids[ $slug ] ) ) {
		set_post_thumbnail( $fivef_ids[ $slug ], $fivef_media[ $photo ] );
		$fivef_log( "Featured image set on {$slug}" );
	}
}

/*
 * 4. Static front page.
 */
if ( isset( $fivef_ids['home'] ) && ! get_option( 'fivef_setup_front' ) ) {
	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $fivef_ids['home'] );
	update_option( 'fivef_setup_front', 1, false );
	$fivef_log( 'Front page set to Home' );
}

/*
 * 5. Main menu (a block-theme Navigation). Edit it any time in
 *    Appearance → Editor → Navigation.
 */
$fivef_nav = get_posts(
	array(
		'post_type'   => 'wp_navigation',
		'title'       => 'Main Menu',
		'post_status' => 'publish',
		'numberposts' => 1,
	)
);

if ( ! $fivef_nav && ! get_option( 'fivef_setup_nav' ) ) {
	$link = static function ( $slug ) use ( $fivef_ids ) {
		if ( empty( $fivef_ids[ $slug ] ) ) {
			return '';
		}
		$id    = (int) $fivef_ids[ $slug ];
		$attrs = array(
			'label' => get_the_title( $id ),
			'type'  => 'page',
			'id'    => $id,
			'url'   => get_permalink( $id ),
			'kind'  => 'post-type',
		);
		return $attrs;
	};

	$item = static function ( $attrs ) {
		return '<!-- wp:navigation-link ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . ' /-->';
	};

	$blocks   = array();
	$blocks[] = $item( $link( 'home' ) );
	$blocks[] = $item( $link( 'about-the-ranch' ) );

	$sub = '';
	foreach ( array( 'dove-hunting', 'open-range-hunting', 'fishing' ) as $child ) {
		$sub .= $item( $link( $child ) );
	}
	$parent   = $link( 'hunting-fishing' );
	$blocks[] = '<!-- wp:navigation-submenu ' . wp_json_encode( $parent, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . ' -->' . $sub . '<!-- /wp:navigation-submenu -->';
	$blocks[] = $item( $link( 'contact' ) );

	$nav_id = wp_insert_post(
		array(
			'post_type'    => 'wp_navigation',
			'post_status'  => 'publish',
			'post_title'   => 'Main Menu',
			'post_content' => implode( "\n", $blocks ),
		),
		true
	);
	if ( is_wp_error( $nav_id ) ) {
		$fivef_log( 'Could not create menu: ' . $nav_id->get_error_message() );
	} else {
		update_option( 'fivef_setup_nav', $nav_id, false );
		$fivef_log( "Created Main Menu (#{$nav_id})" );
	}
}

flush_rewrite_rules( false );
$fivef_log( '5F Ranch setup complete.' );
