<?php
/**
 * Above Header - Dyanamic CSS
 *
 * @package smvmt
 */

add_filter( 'smvmt_dynamic_css', 'smvmt_ext_above_header_dynamic_css' );

/**
 * Dynamic CSS funtion
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dyanamic CSS Filters.
 * @return string
 */
function smvmt_ext_above_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$above_header_layout = smvmt_get_option( 'above-header-layout' );

	if ( 'disabled' == $above_header_layout ) {
		return $dynamic_css;
	}

	$parse_css = '';

	$height       = smvmt_get_option( 'above-header-height' );
	$border_width = smvmt_get_option( 'above-header-divider' );
	$border_color = smvmt_get_option( 'above-header-divider-color' );

	$theme_color            = smvmt_get_option( 'theme-color' );
	$theme_text_color       = smvmt_get_option( 'text-color' );
	$theme_link_color       = smvmt_get_option( 'link-color' );
	$theme_link_hover_color = smvmt_get_option( 'link-h-color' );

	$desktop_above_header_text_color = smvmt_get_prop( smvmt_get_option( 'above-header-text-color-responsive' ), 'desktop' );
	$tablet_above_header_text_color  = smvmt_get_prop( smvmt_get_option( 'above-header-text-color-responsive' ), 'tablet' );
	$mobile_above_header_text_color  = smvmt_get_prop( smvmt_get_option( 'above-header-text-color-responsive' ), 'mobile' );

	$desktop_above_header_link_color = smvmt_get_prop( smvmt_get_option( 'above-header-link-color-responsive' ), 'desktop', $theme_link_color );
	$tablet_above_header_link_color  = smvmt_get_prop( smvmt_get_option( 'above-header-link-color-responsive' ), 'tablet' );
	$mobile_above_header_link_color  = smvmt_get_prop( smvmt_get_option( 'above-header-link-color-responsive' ), 'mobile' );

	$desktop_above_header_link_h_color = smvmt_get_prop( smvmt_get_option( 'above-header-link-h-color-responsive' ), 'desktop', $theme_link_hover_color );
	$tablet_above_header_link_h_color  = smvmt_get_prop( smvmt_get_option( 'above-header-link-h-color-responsive' ), 'tablet' );
	$mobile_above_header_link_h_color  = smvmt_get_prop( smvmt_get_option( 'above-header-link-h-color-responsive' ), 'mobile' );

	$above_header_bg_obj = smvmt_get_option( 'above-header-bg-obj-responsive' );
	$desktop_background  = isset( $above_header_bg_obj['desktop']['background-color'] ) ? $above_header_bg_obj['desktop']['background-color'] : '';
	$tablet_background   = isset( $above_header_bg_obj['tablet']['background-color'] ) ? $above_header_bg_obj['tablet']['background-color'] : '';
	$mobile_background   = isset( $above_header_bg_obj['mobile']['background-color'] ) ? $above_header_bg_obj['mobile']['background-color'] : '';

	$above_header_menu_bg_obj = smvmt_get_option( 'above-header-menu-bg-obj-responsive' );

	$desktop_above_header_menu_color = smvmt_get_prop( smvmt_get_option( 'above-header-menu-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_h_color = smvmt_get_prop( smvmt_get_option( 'above-header-menu-h-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_h_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-h-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_h_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-h-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_h_bg_color = smvmt_get_prop( smvmt_get_option( 'above-header-menu-h-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_h_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-h-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_h_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-h-bg-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_active_color = smvmt_get_prop( smvmt_get_option( 'above-header-menu-active-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_active_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-active-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_active_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-active-color-responsive' ), 'mobile' );

	$desktop_above_header_menu_active_bg_color = smvmt_get_prop( smvmt_get_option( 'above-header-menu-active-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_menu_active_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-active-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_menu_active_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-menu-active-bg-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_text_color = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-text-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_text_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-text-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_text_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-text-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_bg_color = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-bg-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_hover_color = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-hover-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_hover_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-hover-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_hover_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-hover-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_bg_hover_color = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-bg-hover-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_bg_hover_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-bg-hover-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_bg_hover_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-bg-hover-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_active_color = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-active-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_active_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-active-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_active_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-active-color-responsive' ), 'mobile' );

	$desktop_above_header_submenu_active_bg_color = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-active-bg-color-responsive' ), 'desktop' );
	$tablet_above_header_submenu_active_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-active-bg-color-responsive' ), 'tablet' );
	$mobile_above_header_submenu_active_bg_color  = smvmt_get_prop( smvmt_get_option( 'above-header-submenu-active-bg-color-responsive' ), 'mobile' );

	$above_header_submenu_border       = smvmt_get_option( 'above-header-submenu-border' );
	$above_header_submenu_item_border  = smvmt_get_option( 'above-header-submenu-item-border' );
	$above_header_submenu_item_b_color = smvmt_get_option( 'above-header-submenu-item-b-color', '#eaeaea' );
	$above_header_submenu_border_color = smvmt_get_option( 'above-header-submenu-border-color', $theme_color );

	$font_family    = smvmt_get_option( 'above-header-font-family' );
	$font_weight    = smvmt_get_option( 'above-header-font-weight' );
	$font_size      = smvmt_get_option( 'above-header-font-size' );
	$text_transform = smvmt_get_option( 'above-header-text-transform' );

	// Above header submenu typography.
	$font_size_above_header_dropdown      = smvmt_get_option( 'font-size-above-header-dropdown-menu' );
	$font_family_above_header_dropdown    = smvmt_get_option( 'font-family-above-header-dropdown-menu' );
	$font_weight_above_header_dropdown    = smvmt_get_option( 'font-weight-above-header-dropdown-menu' );
	$text_transform_above_header_dropdown = smvmt_get_option( 'text-transform-above-header-dropdown-menu' );

	// Header Break Point.
	$header_break_point = smvmt_header_break_point();

	$max_height = '26px';
	$padding    = '';
	if ( '' != $height && 30 < $height ) {
		$max_height = ( $height - 6 ) . 'px';
	}

	if ( 60 > $height ) {
		$padding = '.35em';
	}

	/**
	 * [1]. Above Header General options
	 * [2]. Above Header Responsive Typography
	 * [3]. Above Header Responsive Colors
	 */

	/**
	 * [1]. Above Header General options
	 */
	$common_css_output = array(

		'.smvmt-above-header'                => array(
			'border-bottom-width' => smvmt_get_css_value( $border_width, 'px' ),
			'border-bottom-color' => esc_attr( $border_color ),
			'line-height'         => smvmt_get_css_value( $height, 'px' ),
		),
		'.smvmt-above-header-menu, .smvmt-above-header .user-select' => array(
			'font-family'    => smvmt_get_css_value( $font_family, 'font' ),
			'font-weight'    => smvmt_get_css_value( $font_weight, 'font' ),
			'font-size'      => smvmt_responsive_font( $font_size, 'desktop' ),
			'text-transform' => esc_attr( $text_transform ),
		),
		/**
		 * Above Header Dropdown Navigation
		 */
		'.smvmt-above-header-menu .sub-menu' => array(
			'font-family'    => smvmt_get_css_value( $font_family_above_header_dropdown, 'font' ),
			'font-weight'    => smvmt_get_css_value( $font_weight_above_header_dropdown, 'font' ),
			'font-size'      => smvmt_responsive_font( $font_size_above_header_dropdown, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_above_header_dropdown ),
		),
		'.smvmt-header-break-point .smvmt-above-header-merged-responsive .smvmt-above-header' => array(
			'border-bottom-width' => smvmt_get_css_value( $border_width, 'px' ),
			'border-bottom-color' => esc_attr( $border_color ),
		),

		'.smvmt-above-header .smvmt-search-menu-icon .search-field' => array(
			'max-height'     => esc_attr( $max_height ),
			'padding-top'    => esc_attr( $padding ),
			'padding-bottom' => esc_attr( $padding ),
		),

		'.smvmt-above-header-section-wrap'   => array(
			'min-height' => smvmt_get_css_value( $height, 'px' ),
		),
		'.smvmt-above-header-menu .sub-menu, .smvmt-above-header-menu .sub-menu a, .smvmt-above-header-menu .smvmt-full-megamenu-wrapper' => array(
			'border-color' => esc_attr( $above_header_submenu_border_color ),
		),
		'.smvmt-header-break-point .smvmt-below-header-merged-responsive .below-header-user-select, .smvmt-header-break-point .smvmt-below-header-merged-responsive .below-header-user-select .widget, .smvmt-header-break-point .smvmt-below-header-merged-responsive .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $theme_text_color ),
		),
		'.smvmt-header-break-point .smvmt-below-header-merged-responsive .below-header-user-select a' => array(
			'color' => esc_attr( $theme_link_color ),
		),
	);

	/**
	 * [2]. Above Header General options
	 */
	$tablet_typography_css = array(
		'.smvmt-above-header-menu, .smvmt-above-header .user-select' => array(
			'font-size' => smvmt_responsive_font( $font_size, 'tablet' ),
		),
		'.smvmt-above-header-menu .sub-menu' => array(
			'font-size' => smvmt_responsive_font( $font_size_above_header_dropdown, 'mobile' ),
		),
	);

	$mobile_typography_css = array(
		'.smvmt-above-header-menu, .smvmt-above-header .user-select' => array(
			'font-size' => smvmt_responsive_font( $font_size, 'mobile' ),
		),
		'.smvmt-above-header-menu .sub-menu' => array(
			'font-size' => smvmt_responsive_font( $font_size_above_header_dropdown, 'tablet' ),
		),
	);

	/**
	 * [3]. Above Header Responsive Colors
	 */
	$desktop_colors = array(
		'.smvmt-above-header'                             => smvmt_get_responsive_background_obj( $above_header_bg_obj, 'desktop' ),
		'.smvmt-header-break-point .smvmt-above-header-merged-responsive .smvmt-above-header' => array(
			'background-color' => esc_attr( $desktop_background ),
		),
		'.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul' => array(
			'background-color' => esc_attr( $desktop_background ),
		),
		'.smvmt-above-header-menu, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => smvmt_get_responsive_background_obj( $above_header_menu_bg_obj, 'desktop' ),

		'.smvmt-above-header-section .user-select, .smvmt-above-header-section .widget, .smvmt-above-header-section .widget-title' => array(
			'color' => esc_attr( $desktop_above_header_text_color ),
		),

		'.smvmt-above-header-section .user-select a, .smvmt-above-header-section .widget a' => array(
			'color' => esc_attr( $desktop_above_header_link_color ),
		),

		'.smvmt-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $desktop_above_header_link_color ),
		),

		'.smvmt-above-header-section .user-select a:hover, .smvmt-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $desktop_above_header_link_h_color ),
		),

		'.smvmt-above-header-navigation a'                => array(
			'color' => esc_attr( $desktop_above_header_menu_color ),
		),

		'.smvmt-above-header-navigation li:hover > a'     => array(
			'color'            => esc_attr( $desktop_above_header_menu_h_color ),
			'background-color' => esc_attr( $desktop_above_header_menu_h_bg_color ),
		),

		'.smvmt-above-header-navigation .menu-item.focus > a' => array(
			'color'            => esc_attr( $desktop_above_header_menu_h_color ),
			'background-color' => esc_attr( $desktop_above_header_menu_h_bg_color ),
		),

		'.smvmt-above-header-navigation li.current-menu-item > a, .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
			'color'            => esc_attr( $desktop_above_header_menu_active_color ),
			'background-color' => esc_attr( $desktop_above_header_menu_active_bg_color ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color'            => esc_attr( $desktop_above_header_submenu_hover_color ),
			'background-color' => esc_attr( $desktop_above_header_submenu_bg_hover_color ),
		),
		'.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $desktop_above_header_submenu_active_color ),
		),
		'.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color'            => esc_attr( $desktop_above_header_submenu_active_color ),
			'background-color' => esc_attr( $desktop_above_header_submenu_active_bg_color ),
		),
		'.smvmt-above-header-menu .sub-menu, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul ul' => array(
			'background-color' => esc_attr( $desktop_above_header_submenu_bg_color ),
		),
		'.smvmt-above-header-menu .sub-menu, .smvmt-above-header-menu .sub-menu a' => array(
			'color' => esc_attr( $desktop_above_header_submenu_text_color ),
		),
	);

	$tablet_colors = array(
		'.smvmt-above-header'                             => smvmt_get_responsive_background_obj( $above_header_bg_obj, 'tablet' ),
		'.smvmt-header-break-point .smvmt-above-header-merged-responsive .smvmt-above-header' => array(
			'background-color' => esc_attr( $tablet_background ),
		),
		'.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul' => array(
			'background-color' => esc_attr( $tablet_background ),
		),
		'.smvmt-above-header-menu,.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => smvmt_get_responsive_background_obj( $above_header_menu_bg_obj, 'tablet' ),
		'.smvmt-above-header-section .user-select, .smvmt-above-header-section .widget, .smvmt-above-header-section .widget-title' => array(
			'color' => esc_attr( $tablet_above_header_text_color ),
		),

		'.smvmt-above-header-section .user-select a, .smvmt-above-header-section .widget a, .smvmt-header-break-point .smvmt-above-header-section .user-select a, .smvmt-above-header-section .smvmt-header-break-point .smvmt-above-header-section .user-select a' => array(
			'color' => esc_attr( $tablet_above_header_link_color ),
		),

		'.smvmt-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $tablet_above_header_link_color ),
		),

		'.smvmt-above-header-section .user-select a:hover, .smvmt-above-header-section .widget a:hover, .smvmt-header-break-point .smvmt-above-header-section .user-select a:hover, .smvmt-above-header-section .smvmt-header-break-point .smvmt-above-header-section .user-select a:hover' => array(
			'color' => esc_attr( $tablet_above_header_link_h_color ),
		),

		'.smvmt-above-header-navigation a'                => array(
			'color' => esc_attr( $tablet_above_header_menu_color ),
		),

		'.smvmt-above-header-navigation li:hover > a'     => array(
			'color'            => esc_attr( $tablet_above_header_menu_h_color ),
			'background-color' => esc_attr( $tablet_above_header_menu_h_bg_color ),
		),

		'.smvmt-above-header-navigation .menu-item.focus > a' => array(
			'color'            => esc_attr( $tablet_above_header_menu_h_color ),
			'background-color' => esc_attr( $tablet_above_header_menu_h_bg_color ),
		),

		'.smvmt-above-header-navigation li.current-menu-item > a, .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
			'color'            => esc_attr( $tablet_above_header_menu_active_color ),
			'background-color' => esc_attr( $tablet_above_header_menu_active_bg_color ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color'            => esc_attr( $tablet_above_header_submenu_hover_color ),
			'background-color' => esc_attr( $tablet_above_header_submenu_bg_hover_color ),
		),
		'.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $tablet_above_header_submenu_active_color ),
		),
		'.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color'            => esc_attr( $tablet_above_header_submenu_active_color ),
			'background-color' => esc_attr( $tablet_above_header_submenu_active_bg_color ),
		),
		'.smvmt-above-header-menu .sub-menu, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul ul' => array(
			'background-color' => esc_attr( $tablet_above_header_submenu_bg_color ),
		),
		'.smvmt-above-header-menu .sub-menu, .smvmt-above-header-menu .sub-menu a' => array(
			'color' => esc_attr( $tablet_above_header_submenu_text_color ),
		),
	);

	$mobile_colors = array(
		'.smvmt-above-header'                             => smvmt_get_responsive_background_obj( $above_header_bg_obj, 'mobile' ),
		'.smvmt-header-break-point .smvmt-above-header-merged-responsive .smvmt-above-header' => array(
			'background-color' => esc_attr( $mobile_background ),
		),
		'.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul' => array(
			'background-color' => esc_attr( $mobile_background ),
		),
		'.smvmt-above-header-menu,.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => smvmt_get_responsive_background_obj( $above_header_menu_bg_obj, 'mobile' ),
		'.smvmt-above-header-section .user-select, .smvmt-above-header-section .widget, .smvmt-above-header-section .widget-title' => array(
			'color' => esc_attr( $mobile_above_header_text_color ),
		),

		'.smvmt-above-header-section .user-select a, .smvmt-above-header-section .widget a, .smvmt-header-break-point .smvmt-above-header-section .user-select a, .smvmt-above-header-section .smvmt-header-break-point .smvmt-above-header-section .user-select a' => array(
			'color' => esc_attr( $mobile_above_header_link_color ),
		),

		'.smvmt-above-header-section .search-field:focus' => array(
			'border-color' => esc_attr( $mobile_above_header_link_color ),
		),

		'.smvmt-above-header-section .user-select a:hover, .smvmt-above-header-section .widget a:hover, .smvmt-header-break-point .smvmt-above-header-section .user-select a:hover, .smvmt-above-header-section .smvmt-header-break-point .smvmt-above-header-section .user-select a:hover' => array(
			'color' => esc_attr( $mobile_above_header_link_h_color ),
		),

		'.smvmt-above-header-navigation a'                => array(
			'color' => esc_attr( $mobile_above_header_menu_color ),
		),

		'.smvmt-above-header-navigation li:hover > a'     => array(
			'color'            => esc_attr( $mobile_above_header_menu_h_color ),
			'background-color' => esc_attr( $mobile_above_header_menu_h_bg_color ),
		),

		'.smvmt-above-header-navigation .menu-item.focus > a' => array(
			'color'            => esc_attr( $mobile_above_header_menu_h_color ),
			'background-color' => esc_attr( $mobile_above_header_menu_h_bg_color ),
		),

		'.smvmt-above-header-navigation li.current-menu-item > a, .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
			'color'            => esc_attr( $mobile_above_header_menu_active_color ),
			'background-color' => esc_attr( $mobile_above_header_menu_active_bg_color ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color'            => esc_attr( $mobile_above_header_submenu_hover_color ),
			'background-color' => esc_attr( $mobile_above_header_submenu_bg_hover_color ),
		),
		'.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $mobile_above_header_submenu_active_color ),
		),
		'.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color'            => esc_attr( $mobile_above_header_submenu_active_color ),
			'background-color' => esc_attr( $mobile_above_header_submenu_active_bg_color ),
		),
		'.smvmt-above-header-menu .sub-menu, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul ul' => array(
			'background-color' => esc_attr( $mobile_above_header_submenu_bg_color ),
		),
		'.smvmt-above-header-menu .sub-menu, .smvmt-above-header-menu .sub-menu a' => array(
			'color' => esc_attr( $mobile_above_header_submenu_text_color ),
		),
	);

	// Common options of Above Header.
	$parse_css .= smvmt_parse_css( $common_css_output );

	// Above Header Responsive Typography.
	$parse_css .= smvmt_parse_css( $tablet_typography_css, '', '768' );
	$parse_css .= smvmt_parse_css( $mobile_typography_css, '', '544' );

	// Above Header Responsive Colors.
	$parse_css .= smvmt_parse_css( $desktop_colors );
	$parse_css .= smvmt_parse_css( $tablet_colors, '', '768' );
	$parse_css .= smvmt_parse_css( $mobile_colors, '', '544' );

	/**
	 * Hide the default naviagtion markup for responsive devices.
	 * Once class .smvmt-header-break-point is added to the body below CSS will be override by the
	 * .smvmt-header-break-point class
	 */
	$smvmt_navigation = array(
		'.smvmt-above-header-navigation,.smvmt-above-header-hide-on-mobile .smvmt-above-header-wrap' => array(
			'display' => esc_attr( 'none' ),
		),
	);
	$parse_css       .= smvmt_parse_css( $smvmt_navigation, '', $header_break_point );

	// Above header border.
	$border = array(
		'.smvmt-desktop .smvmt-above-header-menu.submenu-with-border .sub-menu a' => array(
			'border-bottom-width' => ( true == $above_header_submenu_item_border ) ? '1px' : '0px',
			'border-style'        => 'solid',
			'border-color'        => esc_attr( $above_header_submenu_item_b_color ),
		),
		'.smvmt-desktop .smvmt-above-header-menu.submenu-with-border .sub-menu .sub-menu' => array(
			'top' => ( isset( $above_header_submenu_border['top'] ) && '' != $above_header_submenu_border['top'] ) ? smvmt_get_css_value( '-' . $above_header_submenu_border['top'], 'px' ) : '',
		),
		'.smvmt-desktop .smvmt-above-header-menu.submenu-with-border .sub-menu' => array(
			'border-top-width'    => smvmt_get_css_value( $above_header_submenu_border['top'], 'px' ),
			'border-left-width'   => smvmt_get_css_value( $above_header_submenu_border['left'], 'px' ),
			'border-right-width'  => smvmt_get_css_value( $above_header_submenu_border['right'], 'px' ),
			'border-bottom-width' => smvmt_get_css_value( $above_header_submenu_border['bottom'], 'px' ),
			'border-style'        => 'solid',
		),
	);

	// Submenu items goes outside?
	$submenu_border_for_left_align_menu = array(
		'.smvmt-above-header-menu ul li.smvmt-left-align-sub-menu:hover > ul, .smvmt-above-header-menu ul li.smvmt-left-align-sub-menu.focus > ul' => array(
			'margin-left' => ( ( isset( $above_header_submenu_border['left'] ) && '' != $above_header_submenu_border['left'] ) || isset( $above_header_submenu_border['right'] ) && '' != $above_header_submenu_border['right'] ) ? smvmt_get_css_value( '-' . ( $above_header_submenu_border['left'] + $above_header_submenu_border['right'] ), 'px' ) : '',
		),
	);

	/* Parse CSS from array() */
	$parse_css .= smvmt_parse_css( $border );
	// Submenu items goes outside?
	$parse_css .= smvmt_parse_css( $submenu_border_for_left_align_menu, '769' );

	// Add Inline style.
	return $dynamic_css . $parse_css;
}
