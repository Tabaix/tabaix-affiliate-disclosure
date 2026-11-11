<?php
/**
 * Plugin Name:       Tabaix Affiliate Disclosure
 * Plugin URI:        https://tabaix.com
 * Description:       Automatically prepends a standard affiliate disclosure to single blog posts that mention Amazon (affiliate links, product cards or ASINs) and do not already contain a disclosure anywhere in the post. No post content is edited or stored; the box is added at display time only, so deactivating this plugin removes it everywhere instantly.
 * Version:           1.0.1
 * Author:            Tabaix
 * License:           GPL-2.0-or-later
 * Text Domain:       tabaix-affiliate-disclosure
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Decide whether a post needs the disclosure box.
 *
 * Rules (all must be true):
 *  - Not already added to this post in this request.
 *  - The raw content mentions "amazon" (covers amazon.* links, amzn
 *    short links, Hostinger/Tabaix card blocks and ASIN references).
 *  - The word "disclosure" does not appear in the first 2,000
 *    characters of the post text (posts that already carry one at
 *    the top, like the car vacuum guide, are left completely
 *    untouched; a disclosure buried at the very bottom does not
 *    stop the box, because readers meet affiliate links first).
 */
function tad_needs_disclosure( $content ) {
	if ( ! is_string( $content ) || $content === '' ) {
		return false;
	}
	if ( stripos( $content, 'amazon' ) === false ) {
		return false;
	}
	$opening = substr( wp_strip_all_tags( $content ), 0, 2000 );
	if ( stripos( $opening, 'disclosure' ) !== false ) {
		return false;
	}
	return true;
}

/**
 * The disclosure box markup. Inline styles only, so it looks right in
 * any theme and never depends on enqueued CSS. Cream + green are the
 * Tabaix brand colours.
 */
function tad_box_html() {
	$text = 'Affiliate disclosure: This post contains affiliate links. If you buy something through them, Tabaix may earn a small commission at no extra cost to you. This helps keep our guides and free tools running.';
	return '<div class="tabaix-affiliate-disclosure" style="background:#FAF6ED;border:1px solid #E7DCC3;border-left:4px solid #0C6B4F;border-radius:8px;padding:12px 16px;margin:0 0 20px 0;font-size:14px;line-height:1.55;color:#3E4A44;">' . esc_html( $text ) . '</div>';
}

add_filter( 'the_content', function ( $content ) {
	// Only on the front-end view of a single blog post, in the main loop.
	if ( is_admin() || is_feed() ) {
		return $content;
	}
	if ( ! is_singular( 'post' ) || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	static $done = array();
	$id = get_the_ID();
	if ( $id && isset( $done[ $id ] ) ) {
		return $content;
	}
	if ( ! tad_needs_disclosure( $content ) ) {
		return $content;
	}
	if ( $id ) {
		$done[ $id ] = true;
	}
	return tad_box_html() . $content;
}, 9 );
