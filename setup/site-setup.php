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

$fivef_log(
	sprintf(
		'Environment: theme=%s, photos dir=%s (%s), Contact Form 7 %s',
		get_stylesheet(),
		get_theme_file_path( 'assets/photos' ),
		is_dir( get_theme_file_path( 'assets/photos' ) ) ? count( glob( get_theme_file_path( 'assets/photos' ) . '/*.jpg' ) ) . ' photos' : 'missing',
		class_exists( 'WPCF7_ContactForm' ) ? 'loaded' : 'NOT loaded'
	)
);

/*
 * 1. Site basics.
 */
if ( 'Just another WordPress site' === get_option( 'blogdescription' ) || '' === get_option( 'blogdescription' ) ) {
	update_option( 'blogdescription', 'Guided thermal hog hunts in Alvord, Texas' );
}
// Replace installer defaults such as "My WordPress" (SiteGround) or "My WordPress Website".
if ( preg_match( '/^\s*(my (wordpress|blog|site|website)\b.*)?$/i', (string) get_option( 'blogname' ) ) ) {
	update_option( 'blogname', '5F Ranch' );
	$fivef_log( 'Site title set to 5F Ranch' );
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
	'doves-lake'     => 'Mourning doves over the ranch lake',
	'hog-hunt-1'     => 'Feral hog taken at night on 5F Ranch',
	'hog-hunt-2'     => 'Night hog hunt with thermal optics',
	'hog-hunt-3'     => 'Feral hog after a night hunt',
	'hog-pair'       => 'Two feral hogs from a night hunt',
	'thermal-ranch-banner' => 'Thermal-style view of hogs on 5F Ranch pasture (illustrated)',
	'gallery-banner' => 'Trail camera: feral hogs at a feeder on 5F Ranch',
	'hero-trailcam'      => 'Trail camera: a sounder of feral hogs at night on 5F Ranch',
	'hog-boar-banner' => 'Trail camera: a big feral boar on 5F Ranch',
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

// A slot without its own photo borrows a related one (see fivef_photo_alternates()).
$fivef_resolve = static function ( $slot ) use ( &$fivef_media ) {
	$found = function_exists( 'fivef_photo_slot' ) ? fivef_photo_slot( $slot ) : $slot;
	return ( $found && isset( $fivef_media[ $found ] ) ) ? $fivef_media[ $found ] : 0;
};

// Site Icon (favicon, app icons): set once from the theme's 512px icon. Change it any time in
// Appearance → Editor → Styles, or Settings → General → Site Icon.
if ( ! get_option( 'site_icon' ) && file_exists( get_theme_file_path( 'assets/images/site-icon-512.png' ) ) ) {
	$tmp = wp_tempnam( 'site-icon-512.png' );
	copy( get_theme_file_path( 'assets/images/site-icon-512.png' ), $tmp );
	$icon_id = media_handle_sideload(
		array(
			'name'     => '5f-ranch-site-icon.png',
			'tmp_name' => $tmp,
		),
		0,
		'5F Ranch site icon'
	);
	if ( is_wp_error( $icon_id ) ) {
		$fivef_log( 'Could not import site icon: ' . $icon_id->get_error_message() );
	} else {
		update_option( 'site_icon', $icon_id );
		$fivef_log( "Site icon set (#{$icon_id})" );
	}
}

/*
 * 3. Pages. Content is the matching theme pattern; the editor expands it into
 *    normal, editable blocks the first time the page is opened.
 */
$fivef_pages = array(
	'home'               => array( 'Home', 'page-home', 0, 'page-landing', '' ),
	'thermal-hog-hunts'  => array( 'Thermal Hog Hunts', 'page-hog-hunts', 0, '', 'hog-boar-banner' ),
	'about-the-ranch'    => array( 'About the Ranch', 'page-about', 0, '', 'headquarters' ),
	'hunting-fishing'    => array( 'Hunting & Fishing', 'page-hunting-fishing', 0, '', 'ranch-overview' ),
	'dove-hunting'       => array( 'Dove Hunting', 'page-dove-hunting', 'hunting-fishing', '', 'stock-tank' ),
	'open-range-hunting' => array( 'Open Range Hunting', 'page-open-range-hunting', 'hunting-fishing', '', 'creek-bottom' ),
	'fishing'            => array( 'Fishing', 'page-fishing', 'hunting-fishing', '', 'geese-lake' ),
	'field-notes'        => array( 'Field Notes', '', 0, '', 'creek-bottom' ),
	'gallery'            => array( 'Gallery', 'page-gallery', 0, '', 'gallery-banner' ),
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
			'post_content' => $pattern ? '<!-- wp:pattern {"slug":"5f-ranch/' . $pattern . '"} /-->' : '',
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
	if ( $photo && $fivef_resolve( $photo ) ) {
		set_post_thumbnail( $id, $fivef_resolve( $photo ) );
	}
	$fivef_ids[ $slug ] = $id;
	$fivef_created[]    = $slug;
	$fivef_log( "Created page: {$title} (#{$id})" );
}
update_option( 'fivef_setup_created', array_values( array_unique( $fivef_created ) ), false );

// Add featured images to existing pages that still have none (never replaces one).
foreach ( $fivef_pages as $slug => $def ) {
	$photo = $def[4];
	if ( $photo && isset( $fivef_ids[ $slug ] ) && $fivef_resolve( $photo ) && ! has_post_thumbnail( $fivef_ids[ $slug ] ) ) {
		set_post_thumbnail( $fivef_ids[ $slug ], $fivef_resolve( $photo ) );
		$fivef_log( "Featured image set on {$slug}" );
	}
}

// Thermal Hog Hunts banner: move off earlier versions (a hunter photo, then a drawn
// illustration) to the thermal-style ranch photo. Only swaps if one of those is still set.
if ( ! get_option( 'fivef_setup_hogbanner_v3' ) && isset( $fivef_ids['thermal-hog-hunts'], $fivef_media['thermal-ranch-banner'] ) ) {
	$fivef_old_banners = array_filter(
		array(
			isset( $fivef_media['hog-hunt-1'] ) ? (int) $fivef_media['hog-hunt-1'] : 0,
			(int) current(
				get_posts(
					array(
						'post_type'   => 'attachment',
						'post_status' => 'inherit',
						'meta_key'    => '_fivef_photo_slot', // phpcs:ignore WordPress.DB.SlowDBQuery
						'meta_value'  => 'thermal-banner', // phpcs:ignore WordPress.DB.SlowDBQuery
						'numberposts' => 1,
						'fields'      => 'ids',
					)
				)
			),
		)
	);
	if ( in_array( (int) get_post_thumbnail_id( $fivef_ids['thermal-hog-hunts'] ), $fivef_old_banners, true ) ) {
		set_post_thumbnail( $fivef_ids['thermal-hog-hunts'], $fivef_media['thermal-ranch-banner'] );
		$fivef_log( 'Thermal Hog Hunts banner set to the thermal-style ranch photo' );
	}
	update_option( 'fivef_setup_hogbanner_v3', 1, false );
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

// Blog: Field Notes lists the posts (set once, so you can change it in Settings → Reading).
if ( isset( $fivef_ids['field-notes'] ) && ! get_option( 'fivef_setup_blog' ) ) {
	update_option( 'page_for_posts', $fivef_ids['field-notes'] );
	update_option( 'fivef_setup_blog', 1, false );
	$fivef_log( 'Blog page set to Field Notes' );
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

$fivef_link = static function ( $slug, $block = 'navigation-link', $inner = '' ) use ( $fivef_ids ) {
	if ( empty( $fivef_ids[ $slug ] ) ) {
		return '';
	}
	$id    = (int) $fivef_ids[ $slug ];
	$attrs = wp_json_encode(
		array(
			'label' => get_the_title( $id ),
			'type'  => 'page',
			'id'    => $id,
			'url'   => get_permalink( $id ),
			'kind'  => 'post-type',
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
	);
	return 'navigation-submenu' === $block
		? "<!-- wp:navigation-submenu {$attrs} -->{$inner}<!-- /wp:navigation-submenu -->"
		: "<!-- wp:navigation-link {$attrs} /-->";
};

// Hog hunts first; open range and fishing in the Hunting & Fishing dropdown. Dove Hunting is kept
// as a hidden draft (see below), so it isn't in the menu.
$fivef_menu = implode(
	"\n",
	array_filter(
		array(
			$fivef_link( 'home' ),
			$fivef_link( 'thermal-hog-hunts' ),
			$fivef_link( 'hunting-fishing', 'navigation-submenu', $fivef_link( 'open-range-hunting' ) . $fivef_link( 'fishing' ) ),
			$fivef_link( 'about-the-ranch' ),
			$fivef_link( 'field-notes' ),
			$fivef_link( 'gallery' ),
			$fivef_link( 'contact' ),
		)
	)
);

if ( ! $fivef_nav && ! get_option( 'fivef_setup_nav' ) ) {
	$nav_id = wp_insert_post(
		array(
			'post_type'    => 'wp_navigation',
			'post_status'  => 'publish',
			'post_title'   => 'Main Menu',
			'post_content' => $fivef_menu,
		),
		true
	);
	if ( is_wp_error( $nav_id ) ) {
		$fivef_log( 'Could not create menu: ' . $nav_id->get_error_message() );
	} else {
		update_option( 'fivef_setup_nav', $nav_id, false );
		update_option( 'fivef_setup_nav_v2', 1, false );
		update_option( 'fivef_setup_nav_gallery', 1, false );
		$fivef_log( "Created Main Menu (#{$nav_id})" );
	}
} elseif ( $fivef_nav && ! get_option( 'fivef_setup_nav_v2' ) ) {
	// One-time reorganisation for the hog-first site structure. Later menu edits are kept.
	wp_update_post(
		array(
			'ID'           => $fivef_nav[0]->ID,
			'post_content' => $fivef_menu,
		)
	);
	update_option( 'fivef_setup_nav_v2', 1, false );
	update_option( 'fivef_setup_nav_gallery', 1, false );
	$fivef_log( 'Main Menu reorganised: Home, Thermal Hog Hunts, Hunting & Fishing (Open Range, Fishing), About, Field Notes, Gallery, Contact' );
}

// Gallery: add to an existing menu once, before Contact. Removing it later is respected.
if ( $fivef_nav && ! get_option( 'fivef_setup_nav_gallery' ) && isset( $fivef_ids['gallery'] ) ) {
	$fivef_nav_post = get_post( $fivef_nav[0]->ID );
	$content        = $fivef_nav_post->post_content;
	if ( false === strpos( $content, '"id":' . (int) $fivef_ids['gallery'] . ',' ) ) {
		$fivef_gallery_link = $fivef_link( 'gallery' );
		$contact_pos        = strpos( $content, '<!-- wp:navigation-link {"label":"Contact"' );
		$content            = false === $contact_pos
			? $content . "\n" . $fivef_gallery_link
			: substr( $content, 0, $contact_pos ) . $fivef_gallery_link . "\n" . substr( $content, $contact_pos );
		wp_update_post(
			array(
				'ID'           => $fivef_nav_post->ID,
				'post_content' => $content,
			)
		);
		$fivef_log( 'Added Gallery to Main Menu' );
	}
	update_option( 'fivef_setup_nav_gallery', 1, false );
}

// Tagline (shown in the homepage's browser title): lead with hog hunts, once, if still our earlier wording.
if ( ! get_option( 'fivef_setup_tagline_v2' ) ) {
	if ( in_array( wp_specialchars_decode( get_option( 'blogdescription' ) ), array( 'Private ranch hunting & fishing in Alvord, Texas', 'Just another WordPress site', '' ), true ) ) {
		update_option( 'blogdescription', 'Guided thermal hog hunts in Alvord, Texas' );
		$fivef_log( 'Tagline set to: Guided thermal hog hunts in Alvord, Texas' );
	}
	update_option( 'fivef_setup_tagline_v2', 1, false );
}

/*
 * 5c. Hog-first focus (client, Oct 2026): hog hunts are the focus of the whole site,
 *     predators are a bonus, and dove hunting may not run next year, so its page is
 *     kept but hidden. Runs once; anything changed in WordPress afterwards is kept.
 *     To bring dove back: publish the Dove Hunting page (Pages → Drafts) and add it
 *     to the menu in Appearance → Editor → Navigation.
 */
if ( ! get_option( 'fivef_setup_hog_focus' ) ) {
	// Dove Hunting page: unpublish (kept as a draft, nothing is lost).
	if ( isset( $fivef_ids['dove-hunting'] ) && 'publish' === get_post_status( $fivef_ids['dove-hunting'] ) ) {
		wp_update_post(
			array(
				'ID'          => $fivef_ids['dove-hunting'],
				'post_status' => 'draft',
			)
		);
		$fivef_log( 'Dove Hunting page hidden (moved to Drafts)' );
	}

	// Main Menu: drop the Dove Hunting link.
	if ( $fivef_nav && isset( $fivef_ids['dove-hunting'] ) ) {
		$fivef_nav_post = get_post( $fivef_nav[0]->ID );
		$content        = preg_replace( '/<!-- wp:navigation-link \{[^}]*"id":' . (int) $fivef_ids['dove-hunting'] . ',[^}]*\} \/-->\s*/', '', $fivef_nav_post->post_content );
		if ( $content !== $fivef_nav_post->post_content ) {
			wp_update_post(
				array(
					'ID'           => $fivef_nav_post->ID,
					'post_content' => $content,
				)
			);
			$fivef_log( 'Removed Dove Hunting from the Main Menu' );
		}
	}

	// Tagline, if it's still our earlier wording.
	if ( 'Thermal hog hunts & dove hunting in Alvord, Texas' === wp_specialchars_decode( get_option( 'blogdescription' ) ) ) {
		update_option( 'blogdescription', 'Guided thermal hog hunts in Alvord, Texas' );
		$fivef_log( 'Tagline set to: Guided thermal hog hunts in Alvord, Texas' );
	}

	// Thermal Hog Hunts banner: the illustrated thermal image becomes the real trail-cam boar.
	if ( isset( $fivef_ids['thermal-hog-hunts'], $fivef_media['thermal-ranch-banner'], $fivef_media['hog-boar-banner'] )
		&& (int) get_post_thumbnail_id( $fivef_ids['thermal-hog-hunts'] ) === (int) $fivef_media['thermal-ranch-banner'] ) {
		set_post_thumbnail( $fivef_ids['thermal-hog-hunts'], $fivef_media['hog-boar-banner'] );
		$fivef_log( 'Thermal Hog Hunts banner set to the trail-camera boar photo' );
	}

	// Mourning dove post: point its closing link at the hog hunts instead of the hidden page.
	$fivef_dove_post = get_page_by_path( 'mourning-dove-texas-guide', OBJECT, 'post' );
	if ( $fivef_dove_post && false !== strpos( $fivef_dove_post->post_content, 'href="/hunting-fishing/dove-hunting/"' ) ) {
		wp_update_post(
			array(
				'ID'           => $fivef_dove_post->ID,
				'post_content' => preg_replace(
					'#<p><strong>Dove hunting at 5F Ranch:</strong>.*?</p>#s',
					'<p><strong>Hunting at 5F Ranch:</strong> our focus is guided thermal hog hunts after dark along Big Sandy Creek. <a href="/thermal-hog-hunts/">See how a night hunt works</a>.</p>',
					$fivef_dove_post->post_content
				),
			)
		);
		$fivef_log( 'Mourning dove post now links to Thermal Hog Hunts' );
	}

	// Contact form: hog-first "I'm interested in" options, if still our original list.
	if ( class_exists( 'WPCF7_ContactForm' ) ) {
		$fivef_form_post = get_posts(
			array(
				'post_type'   => 'wpcf7_contact_form',
				'title'       => '5F Ranch Contact',
				'post_status' => 'any',
				'numberposts' => 1,
			)
		);
		if ( $fivef_form_post ) {
			$fivef_form = WPCF7_ContactForm::get_instance( $fivef_form_post[0]->ID );
			$fivef_old  = '"Dove Hunting" "Open Range / Hog Hunting" "Fishing" "Memberships" "Something else"';
			if ( $fivef_form && false !== strpos( $fivef_form->prop( 'form' ), $fivef_old ) ) {
				$fivef_form->set_properties( array( 'form' => str_replace( $fivef_old, '"Thermal Hog Hunt" "Open Range / Deer Hunting" "Fishing" "Something else"', $fivef_form->prop( 'form' ) ) ) );
				$fivef_form->save();
				$fivef_log( 'Contact form options updated for hog hunts' );
			}
		}
	}

	update_option( 'fivef_setup_hog_focus', 1, false );
}

// Pages still showing the theme layout pick up theme updates; pages saved in the editor keep their own copy.
foreach ( array( 'home', 'thermal-hog-hunts', 'about-the-ranch', 'hunting-fishing', 'open-range-hunting', 'fishing', 'gallery', 'contact' ) as $fivef_slug ) {
	if ( isset( $fivef_ids[ $fivef_slug ] ) && false === strpos( (string) get_post_field( 'post_content', $fivef_ids[ $fivef_slug ] ), '<!-- wp:pattern ' ) ) {
		$fivef_log( "Note: page '{$fivef_slug}' has been edited in WordPress, so theme content updates don't reach it." );
	}
}

/*
 * 5b. Blog: categories and starter posts from setup/posts/*.html.
 *     Each file starts with <!-- fivef-post {json} -->. Posts are created once;
 *     edits and deletions in WordPress are left alone.
 */
foreach ( glob( __DIR__ . '/posts/*.html' ) as $fivef_file ) {
	$raw = file_get_contents( $fivef_file ); // phpcs:ignore WordPress.WP.AlternativeFunctions
	if ( ! preg_match( '/^<!-- fivef-post (\{.*?\}) -->\s*/s', $raw, $m ) ) {
		continue;
	}
	$meta = json_decode( $m[1], true );
	$key  = 'post:' . $meta['slug'];
	if ( get_page_by_path( $meta['slug'], OBJECT, 'post' ) ) {
		continue;
	}
	if ( in_array( $key, $fivef_created, true ) ) {
		continue;
	}

	$cat = term_exists( $meta['category'], 'category' );
	if ( ! $cat ) {
		$cat = wp_insert_term( $meta['category'], 'category' );
	}
	$cat_id = is_array( $cat ) ? (int) $cat['term_id'] : 0;

	$post_id = wp_insert_post(
		array(
			'post_type'     => 'post',
			'post_status'   => 'publish',
			'post_title'    => $meta['title'],
			'post_name'     => $meta['slug'],
			'post_excerpt'  => $meta['excerpt'],
			'post_content'  => str_replace( '{{photos}}', untrailingslashit( get_theme_file_uri( 'assets/photos' ) ), substr( $raw, strlen( $m[0] ) ) ),
			'post_category' => $cat_id ? array( $cat_id ) : array(),
			'tags_input'    => $meta['tags'],
			'post_date'     => wp_date( 'Y-m-d H:i:s', time() - DAY_IN_SECONDS * (int) $meta['days_ago'] ),
		),
		true
	);
	if ( is_wp_error( $post_id ) ) {
		$fivef_log( "Could not create post {$meta['slug']}: " . $post_id->get_error_message() );
		continue;
	}
	if ( $fivef_resolve( $meta['photo'] ) ) {
		set_post_thumbnail( $post_id, $fivef_resolve( $meta['photo'] ) );
	}
	$fivef_created[] = $key;
	$fivef_log( "Created post: {$meta['title']} (#{$post_id})" );
}
update_option( 'fivef_setup_created', array_values( array_unique( $fivef_created ) ), false );

// WordPress's default "Hello world!" post and "Sample Page": move to Trash once if never edited.
if ( ! get_option( 'fivef_setup_defaults_trashed' ) ) {
	foreach ( array( array( 'hello-world', 'post' ), array( 'sample-page', 'page' ) ) as $fivef_default ) {
		$d = get_page_by_path( $fivef_default[0], OBJECT, $fivef_default[1] );
		if ( $d && 'publish' === $d->post_status && $d->post_modified_gmt === $d->post_date_gmt ) {
			wp_trash_post( $d->ID );
			$fivef_log( "Moved default {$fivef_default[1]} '{$d->post_title}' to Trash" );
		}
	}
	update_option( 'fivef_setup_defaults_trashed', 1, false );
}

// Hosts like SiteGround touch "Hello world!" during install, so also match its default text.
if ( ! get_option( 'fivef_setup_hello_trashed' ) ) {
	$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $hello && 'publish' === $hello->post_status && false !== strpos( $hello->post_content, 'Welcome to WordPress' ) ) {
		wp_trash_post( $hello->ID );
		$fivef_log( "Moved default post 'Hello world!' to Trash" );
	}
	update_option( 'fivef_setup_hello_trashed', 1, false );
}

/*
 * 6. Contact form (Contact Form 7). The Contact page shows it automatically.
 *    Messages go to the fivef_contact_email option (set from the CONTACT_EMAIL
 *    deploy secret), or the site admin email until that is set.
 */
if ( class_exists( 'WPCF7_ContactForm' ) ) {
	$fivef_recipient = get_option( 'fivef_contact_email' );
	$fivef_recipient = is_email( $fivef_recipient ) ? $fivef_recipient : get_option( 'admin_email' );

	$fivef_form_post = get_posts(
		array(
			'post_type'   => 'wpcf7_contact_form',
			'title'       => '5F Ranch Contact',
			'post_status' => 'any',
			'numberposts' => 1,
		)
	);

	if ( ! $fivef_form_post ) {
		$fivef_form = WPCF7_ContactForm::get_template( array( 'title' => '5F Ranch Contact' ) );
		$fivef_mail = $fivef_form->prop( 'mail' );

		$fivef_form->set_properties(
			array(
				'form'     => implode(
					"\n",
					array(
						'<div class="fivef-form-grid">',
						'<p class="fivef-field"><label for="fivef-name">Your name <span class="fivef-req">*</span></label>[text* your-name id:fivef-name autocomplete:name]</p>',
						'<p class="fivef-field"><label for="fivef-email">Email <span class="fivef-req">*</span></label>[email* your-email id:fivef-email autocomplete:email]</p>',
						'<p class="fivef-field"><label for="fivef-phone">Phone</label>[tel your-phone id:fivef-phone autocomplete:tel]</p>',
						'<p class="fivef-field"><label for="fivef-interest">I’m interested in</label>[select your-interest id:fivef-interest "Thermal Hog Hunt" "Open Range / Deer Hunting" "Fishing" "Something else"]</p>',
						'</div>',
						'<p class="fivef-field"><label for="fivef-message">Message <span class="fivef-req">*</span></label>[textarea* your-message id:fivef-message x5]</p>',
						'<p class="fivef-submit">[submit "Send Message"]</p>',
					)
				),
				'mail'     => array_merge(
					$fivef_mail,
					array(
						'subject'            => '5F Ranch website: [your-interest] inquiry from [your-name]',
						'recipient'          => $fivef_recipient,
						'body'               => "Name: [your-name]\nEmail: [your-email]\nPhone: [your-phone]\nInterested in: [your-interest]\n\n[your-message]\n\n--\nSent from the contact form at [_site_url]",
						'additional_headers' => 'Reply-To: [your-name] <[your-email]>',
					)
				),
				'messages' => array_merge(
					$fivef_form->prop( 'messages' ),
					array( 'mail_sent_ok' => 'Thanks! Your message is on its way. We’ll be in touch soon.' )
				),
			)
		);
		$fivef_form->save();
		update_option( 'fivef_contact_email_applied', $fivef_recipient, false );
		$fivef_log( "Created contact form (messages go to {$fivef_recipient})" );
	} elseif ( get_option( 'fivef_contact_email_applied' ) !== $fivef_recipient && get_option( 'fivef_contact_email' ) ) {
		// The recipient secret changed: update just the recipient.
		$fivef_form = WPCF7_ContactForm::get_instance( $fivef_form_post[0]->ID );
		$fivef_mail = $fivef_form->prop( 'mail' );
		$fivef_mail['recipient'] = $fivef_recipient;
		$fivef_form->set_properties( array( 'mail' => $fivef_mail ) );
		$fivef_form->save();
		update_option( 'fivef_contact_email_applied', $fivef_recipient, false );
		$fivef_log( "Contact form messages now go to {$fivef_recipient}" );
	}
}

flush_rewrite_rules( false );
$fivef_log( '5F Ranch setup complete.' );
