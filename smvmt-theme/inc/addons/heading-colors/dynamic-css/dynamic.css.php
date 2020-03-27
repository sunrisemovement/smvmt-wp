<?php
/**
 * Heading Colors - Dynamic CSS
 *
 * @package smvmt
 * @since 2.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Heading Colors
 */
add_filter( 'SMVMT_dynamic_theme_css', 'SMVMT_heading_colors_section_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          smvmt Dynamic CSS.
 * @param  string $dynamic_css_filtered smvmt Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Heading Colors.
 *
 * @since 2.1.4
 */
function SMVMT_heading_colors_section_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * Heading Colors - h1 - h6.
	 */
	$heading_base_color = smvmt_get_option( 'heading-base-color' );

	/**
	 * Normal Colors without reponsive option.
	 * [1]. Heading Colors
	 */
	$css_output = array(

		/**
		 * Content base heading color.
		 */
		'h1, .entry-content h1, h2, .entry-content h2, h3, .entry-content h3, h4, .entry-content h4, h5, .entry-content h5, h6, .entry-content h6' => array(
			'color' => esc_attr( $heading_base_color ),
		),
	);

	/* Parse CSS from array() */
	$css_output = smvmt_parse_css( $css_output );

	$dynamic_css .= $css_output;

	return $dynamic_css;
}
