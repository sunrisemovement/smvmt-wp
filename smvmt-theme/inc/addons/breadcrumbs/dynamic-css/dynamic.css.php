<?php
/**
 * Breadcrumbs - Dynamic CSS
 *
 * @package smvmt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Breadcrumbs
 */
add_filter( 'SMVMT_dynamic_theme_css', 'SMVMT_breadcrumb_section_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          smvmt Dynamic CSS.
 * @param  string $dynamic_css_filtered smvmt Dynamic CSS Filters.
 * @return String Generated dynamic CSS for Breadcrumb.
 *
 * @since 1.7.0
 */
function SMVMT_breadcrumb_section_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$breadcrumb_position = smvmt_get_option( 'breadcrumb-position', 'none' );

	$dynamic_css .= smvmt_parse_css(
		array(
			'.smvmt-breadcrumbs .trail-browse, .smvmt-breadcrumbs .trail-items, .smvmt-breadcrumbs .trail-items li' => array(
				'display'     => 'inline-block',
				'margin'      => '0',
				'padding'     => '0',
				'border'      => 'none',
				'background'  => 'inherit',
				'text-indent' => '0',
			),
			'.smvmt-breadcrumbs .trail-browse'      => array(
				'font-size'   => 'inherit',
				'font-style'  => 'inherit',
				'font-weight' => 'inherit',
				'color'       => 'inherit',
			),
			'.smvmt-breadcrumbs .trail-items'       => array(
				'list-style' => 'none',
			),
			'.trail-items li::after'              => array(
				'padding' => '0 0.3em',
				'content' => '"\00bb"',
			),
			'.trail-items li:last-of-type::after' => array(
				'display' => 'none',
			),
		),
		'',
		''
	);

	if ( 'none' === $breadcrumb_position ) {
		return $dynamic_css;
	}

	/**
	 * Set CSS Params
	 */

	$default_color_array = array(
		'desktop' => '',
		'tablet'  => '',
		'mobile'  => '',
	);

	$breadcrumb_text_color      = smvmt_get_option( 'breadcrumb-text-color-responsive', $default_color_array );
	$breadcrumb_active_color    = smvmt_get_option( 'breadcrumb-active-color-responsive', $default_color_array );
	$breadcrumb_hover_color     = smvmt_get_option( 'breadcrumb-hover-color-responsive', $default_color_array );
	$breadcrumb_separator_color = smvmt_get_option( 'breadcrumb-separator-color', $default_color_array );
	$breadcrumb_bg_color        = smvmt_get_option( 'breadcrumb-bg-color', $default_color_array );

	$breadcrumb_font_family    = smvmt_get_option( 'breadcrumb-font-family' );
	$breadcrumb_font_weight    = smvmt_get_option( 'breadcrumb-font-weight' );
	$breadcrumb_font_size      = smvmt_get_option( 'breadcrumb-font-size' );
	$breadcrumb_line_height    = smvmt_get_option( 'breadcrumb-line-height' );
	$breadcrumb_text_transform = smvmt_get_option( 'breadcrumb-text-transform' );

	$breadcrumb_spacing = smvmt_get_option( 'breadcrumb-spacing' );

	$breadcrumb_alignment = smvmt_get_option( 'breadcrumb-alignment' );

	/**
	 * Generate dynamic CSS based on the Breadcrumb Source option selected from the customizer.
	 */
	$breadcrumb_source = smvmt_get_option( 'select-breadcrumb-source' );

	/**
	 * Generate Dynamic CSS
	 */

	$css                     = '';
	$breadcrumbs_default_css = array();
	$breadcrumb_enable       = is_callable( 'WPSEO_Options::get' ) ? WPSEO_Options::get( 'breadcrumbs-enable' ) : false;
	$wpseo_option            = get_option( 'wpseo_internallinks' ) ? get_option( 'wpseo_internallinks' ) : $breadcrumb_enable;
	if ( ! is_array( $wpseo_option ) ) {
		unset( $wpseo_option );
		$wpseo_option = array(
			'breadcrumbs-enable' => $breadcrumb_enable,
		);
	}

	$css .= smvmt_parse_css(
		array(
			'.trail-items li::after' => array(
				'content' => '"' . smvmt_get_option( 'breadcrumb-separator', '\00bb' ) . '"',
			),
		),
		'',
		''
	);

	/**
	 * Breadcrumb Colors & Typography
	 */
	if ( function_exists( 'yoast_breadcrumb' ) && true === $wpseo_option['breadcrumbs-enable'] && $breadcrumb_source && 'yoast-seo-breadcrumbs' == $breadcrumb_source ) {

		/* Yoast SEO Breadcrumb CSS - Desktop */
		$breadcrumbs_desktop = array(
			'.smvmt-breadcrumbs-wrapper a'                => array(
				'color' => esc_attr( $breadcrumb_text_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .breadcrumb_last' => array(
				'color' => esc_attr( $breadcrumb_active_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'          => array(
				'color' => esc_attr( $breadcrumb_hover_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper span'             => array(
				'color' => esc_attr( $breadcrumb_separator_color['desktop'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span' => array(
				'font-family'    => smvmt_get_font_family( $breadcrumb_font_family ),
				'font-weight'    => esc_attr( $breadcrumb_font_weight ),
				'font-size'      => smvmt_responsive_font( $breadcrumb_font_size, 'desktop' ),
				'line-height'    => esc_attr( $breadcrumb_line_height ),
				'text-transform' => esc_attr( $breadcrumb_text_transform ),
			),
		);

		/* Yoast SEO Breadcrumb CSS - Tablet */
		$breadcrumbs_tablet = array(
			'.smvmt-breadcrumbs-wrapper a'                => array(
				'color' => esc_attr( $breadcrumb_text_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .breadcrumb_last' => array(
				'color' => esc_attr( $breadcrumb_active_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'          => array(
				'color' => esc_attr( $breadcrumb_hover_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper span'             => array(
				'color' => esc_attr( $breadcrumb_separator_color['tablet'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'tablet' ),
			),
		);

		/* Yoast SEO Breadcrumb CSS - Mobile */
		$breadcrumbs_mobile = array(
			'.smvmt-breadcrumbs-wrapper a'                => array(
				'color' => esc_attr( $breadcrumb_text_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper .breadcrumb_last' => array(
				'color' => esc_attr( $breadcrumb_active_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'          => array(
				'color' => esc_attr( $breadcrumb_hover_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper span'             => array(
				'color' => esc_attr( $breadcrumb_separator_color['mobile'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'mobile' ),
			),
		);
	} elseif ( function_exists( 'bcn_display' ) && $breadcrumb_source && 'breadcrumb-navxt' == $breadcrumb_source ) {

		/* Breadcrumb NavXT CSS - Desktop */
		$breadcrumbs_desktop = array(
			'.smvmt-breadcrumbs-wrapper a'             => array(
				'color' => esc_attr( $breadcrumb_text_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .current-item' => array(
				'color' => esc_attr( $breadcrumb_active_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'       => array(
				'color' => esc_attr( $breadcrumb_hover_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .breadcrumbs'  => array(
				'color' => esc_attr( $breadcrumb_separator_color['desktop'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item' => array(
				'font-family'    => smvmt_get_font_family( $breadcrumb_font_family ),
				'font-weight'    => esc_attr( $breadcrumb_font_weight ),
				'font-size'      => smvmt_responsive_font( $breadcrumb_font_size, 'desktop' ),
				'line-height'    => esc_attr( $breadcrumb_line_height ),
				'text-transform' => esc_attr( $breadcrumb_text_transform ),
			),
		);

		/* Breadcrumb NavXT CSS - Tablet */
		$breadcrumbs_tablet = array(
			'.smvmt-breadcrumbs-wrapper a'             => array(
				'color' => esc_attr( $breadcrumb_text_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .current-item' => array(
				'color' => esc_attr( $breadcrumb_active_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'       => array(
				'color' => esc_attr( $breadcrumb_hover_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .breadcrumbs'  => array(
				'color' => esc_attr( $breadcrumb_separator_color['tablet'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'tablet' ),
			),
		);

		/* Breadcrumb NavXT CSS - Mobile */
		$breadcrumbs_mobile = array(
			'.smvmt-breadcrumbs-wrapper a'             => array(
				'color' => esc_attr( $breadcrumb_text_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper .current-item' => array(
				'color' => esc_attr( $breadcrumb_active_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'       => array(
				'color' => esc_attr( $breadcrumb_hover_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper .breadcrumbs'  => array(
				'color' => esc_attr( $breadcrumb_separator_color['mobile'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'mobile' ),
			),
		);
	} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) && $breadcrumb_source && 'rank-math' == $breadcrumb_source ) {

		/* Rank Math CSS - Desktop */
		$breadcrumbs_desktop = array(
			'.smvmt-breadcrumbs-wrapper a'          => array(
				'color' => esc_attr( $breadcrumb_text_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .last'      => array(
				'color' => esc_attr( $breadcrumb_active_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'    => array(
				'color' => esc_attr( $breadcrumb_hover_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .separator' => array(
				'color' => esc_attr( $breadcrumb_separator_color['desktop'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator' => array(
				'font-family'    => smvmt_get_font_family( $breadcrumb_font_family ),
				'font-weight'    => esc_attr( $breadcrumb_font_weight ),
				'font-size'      => smvmt_responsive_font( $breadcrumb_font_size, 'desktop' ),
				'line-height'    => esc_attr( $breadcrumb_line_height ),
				'text-transform' => esc_attr( $breadcrumb_text_transform ),
			),
		);

		/* Rank Math CSS - Tablet */
		$breadcrumbs_tablet = array(
			'.smvmt-breadcrumbs-wrapper a'          => array(
				'color' => esc_attr( $breadcrumb_text_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .last'      => array(
				'color' => esc_attr( $breadcrumb_active_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'    => array(
				'color' => esc_attr( $breadcrumb_hover_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .separator' => array(
				'color' => esc_attr( $breadcrumb_separator_color['tablet'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'tablet' ),
			),
		);

		/* Rank Math CSS - Mobile */
		$breadcrumbs_mobile = array(
			'.smvmt-breadcrumbs-wrapper a'          => array(
				'color' => esc_attr( $breadcrumb_text_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper .last'      => array(
				'color' => esc_attr( $breadcrumb_active_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper a:hover'    => array(
				'color' => esc_attr( $breadcrumb_hover_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper .separator' => array(
				'color' => esc_attr( $breadcrumb_separator_color['mobile'] ),
			),

			'.smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'mobile' ),
			),
		);
	} else {

		/* Default Breadcrumb CSS - Desktop */
		$breadcrumbs_desktop = array(
			'.smvmt-breadcrumbs-wrapper .trail-items a' => array(
				'color' => esc_attr( $breadcrumb_text_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items .trail-end' => array(
				'color' => esc_attr( $breadcrumb_active_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items a:hover' => array(
				'color' => esc_attr( $breadcrumb_hover_color['desktop'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items li::after' => array(
				'color' => esc_attr( $breadcrumb_separator_color['desktop'] ),
			),

			'.smvmt-breadcrumbs-wrapper, .smvmt-breadcrumbs-wrapper a' => array(
				'font-family'    => smvmt_get_font_family( $breadcrumb_font_family ),
				'font-weight'    => esc_attr( $breadcrumb_font_weight ),
				'font-size'      => smvmt_responsive_font( $breadcrumb_font_size, 'desktop' ),
				'line-height'    => esc_attr( $breadcrumb_line_height ),
				'text-transform' => esc_attr( $breadcrumb_text_transform ),
			),
		);

		/* Default Breadcrumb CSS - Tablet */
		$breadcrumbs_tablet = array(
			'.smvmt-breadcrumbs-wrapper .trail-items a' => array(
				'color' => esc_attr( $breadcrumb_text_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items .trail-end' => array(
				'color' => esc_attr( $breadcrumb_active_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items a:hover' => array(
				'color' => esc_attr( $breadcrumb_hover_color['tablet'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items li::after' => array(
				'color' => esc_attr( $breadcrumb_separator_color['tablet'] ),
			),

			'.smvmt-breadcrumbs-wrapper, .smvmt-breadcrumbs-wrapper a' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'tablet' ),
			),
		);

		/* Default Breadcrumb CSS - Mobile */
		$breadcrumbs_mobile = array(
			'.smvmt-breadcrumbs-wrapper .trail-items a' => array(
				'color' => esc_attr( $breadcrumb_text_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items .trail-end' => array(
				'color' => esc_attr( $breadcrumb_active_color['mobile'] ),
			),
			'.smvmt-breadcrumbs-wrapper .trail-items a:hover' => array(
				'color' => esc_attr( $breadcrumb_hover_color['mobile'] ),
			),

			'.smvmt-breadcrumbs-wrapper .trail-items li::after' => array(
				'color' => esc_attr( $breadcrumb_separator_color['mobile'] ),
			),

			'.smvmt-breadcrumbs-wrapper, .smvmt-breadcrumbs-wrapper a' => array(
				'font-size' => smvmt_responsive_font( $breadcrumb_font_size, 'mobile' ),
			),
		);
	}

	/* Breadcrumb CSS for Background Color */
	$breadcrumbs_desktop['.smvmt-breadcrumbs-wrapper, .main-header-bar.smvmt-header-breadcrumb'] = array(
		'background-color' => esc_attr( $breadcrumb_bg_color['desktop'] ),
	);
	$breadcrumbs_tablet['.smvmt-breadcrumbs-wrapper, .main-header-bar.smvmt-header-breadcrumb']  = array(
		'background-color' => esc_attr( $breadcrumb_bg_color['tablet'] ),
	);
	$breadcrumbs_mobile['.smvmt-breadcrumbs-wrapper, .main-header-bar.smvmt-header-breadcrumb']  = array(
		'background-color' => esc_attr( $breadcrumb_bg_color['mobile'] ),
	);

	/* Breadcrumb CSS for Spacing */
	if ( 'smvmt_header_markup_after' === $breadcrumb_position ) {
		// After Header.
		$breadcrumbs_desktop['.main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .header-main-layout-2 .main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .smvmt-mobile-header-stack .main-header-bar.smvmt-header-breadcrumb, .smvmt-default-menu-enable.smvmt-main-header-nav-open.smvmt-header-break-point .main-header-bar-wrap .main-header-bar.smvmt-header-breadcrumb, .smvmt-main-header-nav-open .main-header-bar-wrap .main-header-bar.smvmt-header-breadcrumb'] = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'desktop' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'desktop' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'desktop' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'desktop' ),
		);
		$breadcrumbs_tablet['.main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .header-main-layout-2 .main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .smvmt-mobile-header-stack .main-header-bar.smvmt-header-breadcrumb, .smvmt-default-menu-enable.smvmt-main-header-nav-open.smvmt-header-break-point .main-header-bar-wrap .main-header-bar.smvmt-header-breadcrumb, .smvmt-main-header-nav-open .main-header-bar-wrap .main-header-bar.smvmt-header-breadcrumb']  = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'tablet' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'tablet' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'tablet' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'tablet' ),
		);
		$breadcrumbs_mobile['.main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .header-main-layout-2 .main-header-bar.smvmt-header-breadcrumb, .smvmt-header-break-point .smvmt-mobile-header-stack .main-header-bar.smvmt-header-breadcrumb, .smvmt-default-menu-enable.smvmt-main-header-nav-open.smvmt-header-break-point .main-header-bar-wrap .main-header-bar.smvmt-header-breadcrumb, .smvmt-main-header-nav-open .main-header-bar-wrap .main-header-bar.smvmt-header-breadcrumb']  = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'mobile' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'mobile' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'mobile' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'mobile' ),
		);
		$breadcrumbs_default_css['.smvmt-header-breadcrumb'] = array(
			'padding-top'    => '10px',
			'padding-bottom' => '10px',
		);
	} elseif ( 'SMVMT_masthead_content' === $breadcrumb_position ) {
		// Inside Header.
		$breadcrumbs_desktop['.smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .breadcrumbs, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .rank-math-breadcrumb'] = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'desktop' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'desktop' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'desktop' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'desktop' ),
		);
		$breadcrumbs_tablet['.smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .breadcrumbs, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .rank-math-breadcrumb']  = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'tablet' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'tablet' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'tablet' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'tablet' ),
		);
		$breadcrumbs_mobile['.smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .breadcrumbs, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .rank-math-breadcrumb']  = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'mobile' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'mobile' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'mobile' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'mobile' ),
		);
		$breadcrumbs_default_css['.smvmt-breadcrumbs-inner #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-inner .breadcrumbs, .smvmt-breadcrumbs-inner .rank-math-breadcrumb'] = array(
			'padding-bottom' => '10px',
		);
		$breadcrumbs_default_css['.smvmt-header-break-point .smvmt-breadcrumbs-wrapper'] = array(
			'order' => '4',
		);
	} else {
		// Before Title.
		$breadcrumbs_desktop['.smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .rank-math-breadcrumb'] = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'desktop' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'desktop' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'desktop' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'desktop' ),
		);
		$breadcrumbs_tablet['.smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .rank-math-breadcrumb']  = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'tablet' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'tablet' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'tablet' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'tablet' ),
		);
		$breadcrumbs_mobile['.smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .rank-math-breadcrumb']  = array(
			'padding-top'    => smvmt_responsive_spacing( $breadcrumb_spacing, 'top', 'mobile' ),
			'padding-right'  => smvmt_responsive_spacing( $breadcrumb_spacing, 'right', 'mobile' ),
			'padding-bottom' => smvmt_responsive_spacing( $breadcrumb_spacing, 'bottom', 'mobile' ),
			'padding-left'   => smvmt_responsive_spacing( $breadcrumb_spacing, 'left', 'mobile' ),
		);
	}

	/* Breadcrumb CSS for Alignment */
	$breadcrumbs_desktop['.smvmt-breadcrumbs-wrapper'] = array(
		'text-align' => esc_attr( $breadcrumb_alignment ),
	);

	$css .= smvmt_parse_css( $breadcrumbs_desktop );
	$css .= smvmt_parse_css( $breadcrumbs_tablet, '', '768' );
	$css .= smvmt_parse_css( $breadcrumbs_mobile, '', '544' );
	$css .= smvmt_parse_css( $breadcrumbs_default_css );

	/* Breadcrumb default CSS */
	$css .= smvmt_parse_css(
		array(
			'.smvmt-default-menu-enable.smvmt-main-header-nav-open.smvmt-header-break-point .main-header-bar.smvmt-header-breadcrumb, .smvmt-main-header-nav-open .main-header-bar.smvmt-header-breadcrumb' => array(
				'padding-top'    => '1em',
				'padding-bottom' => '1em',
			),
		),
		'',
		''
	);

	$css .= smvmt_parse_css(
		array(
			'.smvmt-header-break-point .main-header-bar.smvmt-header-breadcrumb' => array(
				'border-bottom-width' => '1px',
				'border-bottom-color' => '#eaeaea',
				'border-bottom-style' => 'solid',
			),
		),
		'',
		''
	);

	$css .= smvmt_parse_css(
		array(
			'.smvmt-breadcrumbs-wrapper' => array(
				'line-height' => '1.4',
			),
		),
		'',
		''
	);

	$css .= smvmt_parse_css(
		array(
			'.smvmt-breadcrumbs-wrapper .rank-math-breadcrumb p' => array(
				'margin-bottom' => '0px',
			),
		),
		'',
		''
	);

	$css .= smvmt_parse_css(
		array(
			'.smvmt-breadcrumbs-wrapper' => array(
				'display' => 'block',
				'width'   => '100%',
			),
		),
		'',
		''
	);

	$dynamic_css .= $css;

	return $dynamic_css;
}
