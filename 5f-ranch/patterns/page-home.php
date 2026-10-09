<?php
/**
 * Title: Home page
 * Slug: 5f-ranch/page-home
 * Categories: 5f-ranch-pages
 * Keywords: home, front page, landing
 * Post Types: page
 * Template Types: front-page
 * Description: The complete 5F Ranch home page.
 *
 * @package 5f-ranch
 */

// Hog hunts are the focus; the land and the other options follow.
// Sections are separate patterns so each can also be inserted on its own.
foreach ( array( 'hero', 'tagline-band', 'hog-feature', 'stats-strip', 'trailcam-strip', 'predator-feature', 'land-showcase', 'experiences-grid', 'latest-posts', 'cta-band' ) as $fivef_slug ) {
	echo fivef_section( $fivef_slug ) . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped inside each pattern.
}
