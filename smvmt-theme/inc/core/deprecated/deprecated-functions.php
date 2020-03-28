<?php
/**
 * Deprecated Functions of smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.0.23
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'SMVMT_blog_post_thumbnai_and_title_order' ) ) :

	/**
	 * Blog post thumbnail & title order
	 *
	 * @since 1.4.9
	 * @deprecated 1.4.9 Use SMVMT_blog_post_thumbnail_and_title_order()
	 * @see SMVMT_blog_post_thumbnail_and_title_order()
	 *
	 * @return void
	 */
	function SMVMT_blog_post_thumbnai_and_title_order() {
		_deprecated_function( __FUNCTION__, '1.4.9', 'SMVMT_blog_post_thumbnail_and_title_order()' );

		SMVMT_blog_post_thumbnail_and_title_order();
	}

endif;

if ( ! function_exists( 'get_smvmt_secondary_class' ) ) :

	/**
	 * Retrieve the classes for the secondary element as an array.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use smvmt_get_secondary_class()
	 * @param string|array $class One or more classes to add to the class list.
	 * @see smvmt_get_secondary_class()
	 *
	 * @return array
	 */
	function get_smvmt_secondary_class( $class = '' ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'smvmt_get_secondary_class()' );

		return smvmt_get_secondary_class( $class );
	}

endif;

if ( ! function_exists( 'deprecated_smvmt_color_palette' ) ) :

	/**
	 * Depreciating smvmt_color_palletes filter.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use SMVMT_deprecated_color_palette()
	 * @param array $color_palette  customizer color palettes.
	 * @see SMVMT_deprecated_color_palette()
	 *
	 * @return array
	 */
	function deprecated_smvmt_color_palette( $color_palette ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'SMVMT_deprecated_color_palette()' );

		return SMVMT_deprecated_color_palette( $color_palette );
	}

endif;

if ( ! function_exists( 'deprecated_SMVMT_sigle_post_navigation_enabled' ) ) :

	/**
	 * Deprecating SMVMT_sigle_post_navigation_enabled filter.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use SMVMT_deprecated_sigle_post_navigation_enabled()
	 * @param boolean $post_nav true | false.
	 * @see SMVMT_deprecated_sigle_post_navigation_enabled()
	 *
	 * @return array
	 */
	function deprecated_SMVMT_sigle_post_navigation_enabled( $post_nav ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'SMVMT_deprecated_sigle_post_navigation_enabled()' );

		return SMVMT_deprecated_sigle_post_navigation_enabled( $post_nav );
	}

endif;

if ( ! function_exists( 'deprecated_SMVMT_primary_header_main_rt_section' ) ) :

	/**
	 * Deprecating SMVMT_primary_header_main_rt_section filter.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use SMVMT_deprecated_primary_header_main_rt_section()
	 * @param array  $elements List of elements.
	 * @param string $header Header section type.
	 * @see SMVMT_deprecated_primary_header_main_rt_section()
	 *
	 * @return array
	 */
	function deprecated_SMVMT_primary_header_main_rt_section( $elements, $header ) {
		_deprecated_function( __FUNCTION__, '1.5.2', 'SMVMT_deprecated_primary_header_main_rt_section()' );

		return SMVMT_deprecated_primary_header_main_rt_section( $elements, $header );
	}

endif;

if ( ! function_exists( 'astar' ) ) :

	/**
	 * Get a specific property of an array without needing to check if that property exists.
	 *
	 * @since 1.5.2
	 * @deprecated 1.5.2 Use smvmt_get_prop()
	 * @param array  $array   Array from which the property's value should be retrieved.
	 * @param string $prop    Name of the property to be retrieved.
	 * @param string $default Optional. Value that should be returned if the property is not set or empty. Defaults to null.
	 * @see smvmt_get_prop()
	 *
	 * @return null|string|mixed The value
	 */
	function astar( $array, $prop, $default = null ) {
		return smvmt_get_prop( $array, $prop, $default );
	}

endif;

/**
 * Check if we're being delivered AMP.
 *
 * @return bool
 */
function smvmt_is_emp_endpoint() {
	_deprecated_function( __FUNCTION__, '2.0.1', 'smvmt_is_amp_endpoint()' );

	return smvmt_is_amp_endpoint();
}
