<?php
/**
 * Sticky Header for Site Layouts Dynamic CSS
 *
 * @package smvmt
 */

add_filter( 'smvmt_dynamic_css', 'smvmt_ext_sticky_header_with_site_layouts_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function smvmt_ext_sticky_header_with_site_layouts_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$stick_header            = smvmt_get_option_meta( 'stick-header-meta' );
	$stick_header_main_meta  = smvmt_get_option_meta( 'header-main-stick-meta' );
	$stick_header_above_meta = smvmt_get_option_meta( 'header-above-stick-meta' );
	$stick_header_below_meta = smvmt_get_option_meta( 'header-below-stick-meta' );

	$stick_header_main  = smvmt_get_option( 'header-main-stick' );
	$stick_header_above = smvmt_get_option( 'header-above-stick' );
	$stick_header_below = smvmt_get_option( 'header-below-stick' );

	$site_layout = smvmt_get_option( 'site-layout' );

	if ( ! $stick_header_main && ! $stick_header_above && ! $stick_header_below && ( 'disabled' !== $stick_header && empty( $stick_header ) && ( empty( $stick_header_above_meta ) || empty( $stick_header_below_meta ) || empty( $stick_header_main_meta ) ) ) ) {
		return $dynamic_css;
	}

	$parse_css = '';
	$css       = '';

	/**
	 * Sticky Header with Site Layouts
	 */

	$page_width = '100%';
	if ( 'smvmt-box-layout' == $site_layout ) {
		$page_width = smvmt_get_option( 'site-layout-box-width' ) . 'px';
	}
	if ( 'smvmt-padded-layout' == $site_layout ) {

		$padded_layout_padding = smvmt_get_option( 'site-layout-padded-pad' );

		/**
		 * Padded layout Desktop Spacing
		 */
		$padded_layout_spacing = array(
			'#smvmt-fixed-header' => array(
				'top'    => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'desktop' ),
				'left'   => smvmt_responsive_spacing( $padded_layout_padding, 'left', 'desktop' ),
				'margin' => esc_attr( 0 ),
			),
		);
		/**
		 * Padded layout Tablet Spacing
		 */
		$tablet_padded_layout_spacing = array(
			'#smvmt-fixed-header' => array(
				'top'    => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'tablet' ),
				'left'   => smvmt_responsive_spacing( $padded_layout_padding, 'left', 'tablet' ),
				'margin' => esc_attr( 0 ),
			),
		);

		/**
		 * Padded layout Mobile Spacing
		 */
		$mobile_padded_layout_spacing = array(
			'#smvmt-fixed-header' => array(
				'top'    => smvmt_responsive_spacing( $padded_layout_padding, 'top', 'mobile' ),
				'left'   => smvmt_responsive_spacing( $padded_layout_padding, 'left', 'mobile' ),
				'margin' => esc_attr( 0 ),
			),
		);

		$parse_css .= smvmt_parse_css( $padded_layout_spacing );
		$parse_css .= smvmt_parse_css( $tablet_padded_layout_spacing, '', '768' );
		$parse_css .= smvmt_parse_css( $mobile_padded_layout_spacing, '', '544' );
	}
	$css       .= '.smvmt-above-header > div, .main-header-bar > div, .smvmt-below-header > div {';
	$css       .= '-webkit-transition: all 0.2s linear;';
	$css       .= 'transition: all 0.2s linear;';
	$css       .= '}';
	$css       .= '.smvmt-above-header, .main-header-bar, .smvmt-below-header {';
	$css       .= 'max-width:' . esc_attr( $page_width ) . ';';
	$css       .= '}';
	$parse_css .= $css;

	return $dynamic_css .= $parse_css;

}
