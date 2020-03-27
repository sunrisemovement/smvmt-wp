<?php
/**
 * Deprecated Filters of smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.23
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Depreciating smvmt_color_palletes filter.
add_filter( 'smvmt_color_palettes', 'SMVMT_deprecated_color_palette', 10, 1 );

/**
 * smvmt Color Palettes
 *
 * @since 1.0.23
 * @param array $color_palette  customizer color palettes.
 * @return array  $color_palette updated customizer color palettes.
 */
function SMVMT_deprecated_color_palette( $color_palette ) {

	$color_palette = smvmt_apply_filters_deprecated( 'smvmt_color_palletes', array( $color_palette ), '1.0.22', 'smvmt_color_palettes', '' );

	return $color_palette;
}


// Deprecating SMVMT_sigle_post_navigation_enabled filter.
add_filter( 'SMVMT_single_post_navigation_enabled', 'SMVMT_deprecated_sigle_post_navigation_enabled', 10, 1 );

/**
 * smvmt Single Post Navigation
 *
 * @since 1.0.27
 * @param boolean $post_nav true | false.
 * @return boolean $post_nav true for enabled | false for disable.
 */
function SMVMT_deprecated_sigle_post_navigation_enabled( $post_nav ) {

	$post_nav = smvmt_apply_filters_deprecated( 'SMVMT_sigle_post_navigation_enabled', array( $post_nav ), '1.0.27', 'SMVMT_single_post_navigation_enabled', '' );

	return $post_nav;
}

// Deprecating SMVMT_primary_header_main_rt_section filter.
add_filter( 'smvmt_header_section_elements', 'SMVMT_deprecated_primary_header_main_rt_section', 10, 2 );

/**
 * smvmt Header elements.
 *
 * @since 1.2.2
 * @param array  $elements List of elements.
 * @param string $header Header section type.
 * @return array
 */
function SMVMT_deprecated_primary_header_main_rt_section( $elements, $header ) {

	$elements = smvmt_apply_filters_deprecated( 'SMVMT_primary_header_main_rt_section', array( $elements, $header ), '1.2.2', 'smvmt_header_section_elements', '' );

	return $elements;
}

if ( ! function_exists( 'smvmt_apply_filters_deprecated' ) ) {
	/**
	 * smvmt Filter Deprecated
	 *
	 * @since 1.1.1
	 * @param string $tag         The name of the filter hook.
	 * @param array  $args        Array of additional function arguments to be passed to apply_filters().
	 * @param string $version     The version of WordPress that deprecated the hook.
	 * @param string $replacement Optional. The hook that should have been used. Default false.
	 * @param string $message     Optional. A message regarding the change. Default null.
	 */
	function smvmt_apply_filters_deprecated( $tag, $args, $version, $replacement = false, $message = null ) {
		if ( function_exists( 'apply_filters_deprecated' ) ) { /* WP >= 4.6 */
			return apply_filters_deprecated( $tag, $args, $version, $replacement, $message );
		} else {
			return apply_filters_ref_array( $tag, $args );
		}
	}
}

