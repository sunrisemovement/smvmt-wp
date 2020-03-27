<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @see  https://github.com/zamoose/themehookalliance
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Themes and Plugins can check for SMVMT_hooks using current_theme_supports( 'SMVMT_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 *
 * Example:
 * <code>
 *      // Declare support for all hook types
 *      add_theme_support( 'SMVMT_hooks', array( 'all' ) );
 *
 *      // Declare support for certain hook types only
 *      add_theme_support( 'SMVMT_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support(
	'SMVMT_hooks',
	array(

		/**
		 * As a Theme developer, use the 'all' parameter, to declare support for all
		 * hook types.
		 * Please make sure you then actually reference all the hooks in this file,
		 * Plugin developers depend on it!
		 */
		'all',

		/**
		 * Themes can also choose to only support certain hook types.
		 * Please make sure you then actually reference all the hooks in this type
		 * family.
		 *
		 * When the 'all' parameter was set, specific hook types do not need to be
		 * added explicitly.
		 */
		'html',
		'body',
		'head',
		'header',
		'content',
		'entry',
		'comments',
		'sidebars',
		'sidebar',
		'footer',

	/**
	 * If/when WordPress Core implements similar methodology, Themes and Plugins
	 * will be able to check whether the version of THA supplied by the theme
	 * supports Core hooks.
	 */
	)
);

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 *      if ( current_theme_supports( 'SMVMT_hooks', 'header' ) )
 *          add_action( 'smvmt_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool  $bool true.
 * @param array $args The hook type being checked.
 * @param array $registered All registered hook types.
 *
 * @return bool
 */
function SMVMT_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-SMVMT_hooks', 'SMVMT_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $SMVMT_supports[] = 'html;
 */
function smvmt_html_before() {
	do_action( 'smvmt_html_before' );
}
/**
 * HTML <body> hooks
 * $SMVMT_supports[] = 'body';
 */
function smvmt_body_top() {
	do_action( 'smvmt_body_top' );
}

/**
 * Body Bottom
 */
function smvmt_body_bottom() {
	do_action( 'smvmt_body_bottom' );
}

/**
 * HTML <head> hooks
 *
 * $SMVMT_supports[] = 'head';
 */
function smvmt_head_top() {
	do_action( 'smvmt_head_top' );
}

/**
 * Head Bottom
 */
function smvmt_head_bottom() {
	do_action( 'smvmt_head_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $SMVMT_supports[] = 'header';
 */
function smvmt_header_before() {
	do_action( 'smvmt_header_before' );
}

/**
 * Site Header
 */
function smvmt_header() {
	do_action( 'smvmt_header' );
}

/**
 * Masthead Top
 */
function SMVMT_masthead_top() {
	do_action( 'SMVMT_masthead_top' );
}

/**
 * Masthead
 */
function SMVMT_masthead() {
	do_action( 'SMVMT_masthead' );
}

/**
 * Masthead Bottom
 */
function SMVMT_masthead_bottom() {
	do_action( 'SMVMT_masthead_bottom' );
}

/**
 * Header After
 */
function smvmt_header_after() {
	do_action( 'smvmt_header_after' );
}

/**
 * Main Header bar top
 */
function SMVMT_main_header_bar_top() {
	do_action( 'SMVMT_main_header_bar_top' );
}

/**
 * Main Header bar bottom
 */
function SMVMT_main_header_bar_bottom() {
	do_action( 'SMVMT_main_header_bar_bottom' );
}

/**
 * Main Header Content
 */
function SMVMT_masthead_content() {
	do_action( 'SMVMT_masthead_content' );
}
/**
 * Main toggle button before
 */
function SMVMT_masthead_toggle_buttons_before() {
	do_action( 'SMVMT_masthead_toggle_buttons_before' );
}

/**
 * Main toggle buttons
 */
function SMVMT_masthead_toggle_buttons() {
	do_action( 'SMVMT_masthead_toggle_buttons' );
}

/**
 * Main toggle button after
 */
function SMVMT_masthead_toggle_buttons_after() {
	do_action( 'SMVMT_masthead_toggle_buttons_after' );
}

/**
 * Semantic <content> hooks
 *
 * $SMVMT_supports[] = 'content';
 */
function smvmt_content_before() {
	do_action( 'smvmt_content_before' );
}

/**
 * Content after
 */
function smvmt_content_after() {
	do_action( 'smvmt_content_after' );
}

/**
 * Content top
 */
function smvmt_content_top() {
	do_action( 'smvmt_content_top' );
}

/**
 * Content bottom
 */
function smvmt_content_bottom() {
	do_action( 'smvmt_content_bottom' );
}

/**
 * Content while before
 */
function smvmt_content_while_before() {
	do_action( 'smvmt_content_while_before' );
}

/**
 * Content loop
 */
function smvmt_content_loop() {
	do_action( 'smvmt_content_loop' );
}

/**
 * Conten Page Loop.
 *
 * Called from page.php
 */
function smvmt_content_page_loop() {
	do_action( 'smvmt_content_page_loop' );
}

/**
 * Content while after
 */
function smvmt_content_while_after() {
	do_action( 'smvmt_content_while_after' );
}

/**
 * Semantic <entry> hooks
 *
 * $SMVMT_supports[] = 'entry';
 */
function SMVMT_entry_before() {
	do_action( 'SMVMT_entry_before' );
}

/**
 * Entry after
 */
function SMVMT_entry_after() {
	do_action( 'SMVMT_entry_after' );
}

/**
 * Entry content before
 */
function SMVMT_entry_content_before() {
	do_action( 'SMVMT_entry_content_before' );
}

/**
 * Entry content after
 */
function SMVMT_entry_content_after() {
	do_action( 'SMVMT_entry_content_after' );
}

/**
 * Entry Top
 */
function SMVMT_entry_top() {
	do_action( 'SMVMT_entry_top' );
}

/**
 * Entry bottom
 */
function SMVMT_entry_bottom() {
	do_action( 'SMVMT_entry_bottom' );
}

/**
 * Single Post Header Before
 */
function SMVMT_single_header_before() {
	do_action( 'SMVMT_single_header_before' );
}

/**
 * Single Post Header After
 */
function SMVMT_single_header_after() {
	do_action( 'SMVMT_single_header_after' );
}

/**
 * Single Post Header Top
 */
function SMVMT_single_header_top() {
	do_action( 'SMVMT_single_header_top' );
}

/**
 * Single Post Header Bottom
 */
function SMVMT_single_header_bottom() {
	do_action( 'SMVMT_single_header_bottom' );
}

/**
 * Comments block hooks
 *
 * $SMVMT_supports[] = 'comments';
 */
function SMVMT_comments_before() {
	do_action( 'SMVMT_comments_before' );
}

/**
 * Comments after.
 */
function SMVMT_comments_after() {
	do_action( 'SMVMT_comments_after' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $SMVMT_supports[] = 'sidebar';
 */
function smvmt_sidebars_before() {
	do_action( 'smvmt_sidebars_before' );
}

/**
 * Sidebars after
 */
function smvmt_sidebars_after() {
	do_action( 'smvmt_sidebars_after' );
}

/**
 * Semantic <footer> hooks
 *
 * $SMVMT_supports[] = 'footer';
 */
function smvmt_footer() {
	do_action( 'smvmt_footer' );
}

/**
 * Footer before
 */
function smvmt_footer_before() {
	do_action( 'smvmt_footer_before' );
}

/**
 * Footer after
 */
function smvmt_footer_after() {
	do_action( 'smvmt_footer_after' );
}

/**
 * Footer top
 */
function smvmt_footer_content_top() {
	do_action( 'smvmt_footer_content_top' );
}

/**
 * Footer
 */
function smvmt_footer_content() {
	do_action( 'smvmt_footer_content' );
}

/**
 * Footer bottom
 */
function smvmt_footer_content_bottom() {
	do_action( 'smvmt_footer_content_bottom' );
}

/**
 * Archive header
 */
function smvmt_archive_header() {
	do_action( 'smvmt_archive_header' );
}

/**
 * Pagination
 */
function smvmt_pagination() {
	do_action( 'smvmt_pagination' );
}

/**
 * Entry content single
 */
function SMVMT_entry_content_single() {
	do_action( 'SMVMT_entry_content_single' );
}

/**
 * 404
 */
function SMVMT_entry_content_404_page() {
	do_action( 'SMVMT_entry_content_404_page' );
}

/**
 * Entry content blog
 */
function SMVMT_entry_content_blog() {
	do_action( 'SMVMT_entry_content_blog' );
}

/**
 * Blog featured post section
 */
function SMVMT_blog_post_featured_format() {
	do_action( 'SMVMT_blog_post_featured_format' );
}

/**
 * Primary Content Top
 */
function smvmt_primary_content_top() {
	do_action( 'smvmt_primary_content_top' );
}

/**
 * Primary Content Bottom
 */
function smvmt_primary_content_bottom() {
	do_action( 'smvmt_primary_content_bottom' );
}

/**
 * 404 Page content template action.
 */
function SMVMT_404_content_template() {
	do_action( 'SMVMT_404_content_template' );
}

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Fire the wp_body_open action.
	 * Adds backward compatibility for WordPress versions < 5.2
	 *
	 * @since 1.8.7
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
