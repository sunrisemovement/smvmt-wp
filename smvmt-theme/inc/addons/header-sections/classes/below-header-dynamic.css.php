<?php
/**
 * Below Header - Dyanamic CSS
 *
 * @package smvmt
 */

add_filter( 'smvmt_dynamic_css', 'smvmt_ext_below_header_dynamic_css' );

/**
 * Dynamic CSS funtion
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dyanamic CSS Filters.
 * @return string
 */
function smvmt_ext_below_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	// set page width depending on site layout.
	$below_header_layout = smvmt_get_option( 'below-header-layout' );

	if ( 'disabled' == $below_header_layout ) {
		return $dynamic_css;
	}

	$theme_text_color = smvmt_get_option( 'text-color' );
	$theme_link_color = smvmt_get_option( 'link-color' );

	// Below Header - Height/Line-Height.
	$below_header_line_height = smvmt_get_option( 'below-header-height' );
	$below_header_border      = smvmt_get_option( 'below-header-separator' );

	// Background & Color.
	$link_color            = smvmt_get_option( 'link-color' );
	$link_hover_color      = smvmt_get_option( 'link-h-color' );
	$text_color            = smvmt_get_option( 'text-color' );
	$right_left_text_color = smvmt_get_option( 'below-header-text-color-responsive' );

	$desktop_right_left_link_color = smvmt_get_prop( smvmt_get_option( 'below-header-link-color-responsive' ), 'desktop', '#d6d6d6' );
	$tablet_right_left_link_color  = smvmt_get_prop( smvmt_get_option( 'below-header-link-color-responsive' ), 'tablet' );
	$mobile_right_left_link_color  = smvmt_get_prop( smvmt_get_option( 'below-header-link-color-responsive' ), 'mobile' );

	$desktop_right_left_link_hover_color = smvmt_get_prop( smvmt_get_option( 'below-header-link-hover-color-responsive' ), 'desktop', '#ffffff' );
	$tablet_right_left_link_hover_color  = smvmt_get_prop( smvmt_get_option( 'below-header-link-hover-color-responsive' ), 'tablet' );
	$mobile_right_left_link_hover_color  = smvmt_get_prop( smvmt_get_option( 'below-header-link-hover-color-responsive' ), 'mobile' );

	$below_header_obj        = smvmt_get_option( 'below-header-bg-obj-responsive' );
	$desktop_below_header_bg = isset( $below_header_obj['desktop']['background-color'] ) ? $below_header_obj['desktop']['background-color'] : '#414042';
	$tablet_below_header_bg  = isset( $below_header_obj['tablet']['background-color'] ) ? $below_header_obj['tablet']['background-color'] : '';
	$mobile_below_header_bg  = isset( $below_header_obj['mobile']['background-color'] ) ? $below_header_obj['mobile']['background-color'] : '';

	$below_header_border_color = smvmt_get_option( 'below-header-bottom-border-color' );

	$below_header_menu_bg_obj = smvmt_get_option( 'below-header-menu-bg-obj-responsive' );

	$below_header_menu_text             = smvmt_get_option( 'below-header-menu-text-color-responsive' );
	$below_header_menu_hover_color      = smvmt_get_option( 'below-header-menu-text-hover-color-responsive' );
	$below_header_menu_hover_bg_color   = smvmt_get_option( 'below-header-menu-bg-hover-color-responsive' );
	$below_header_menu_current_color    = smvmt_get_option( 'below-header-current-menu-text-color-responsive' );
	$below_header_menu_current_bg_color = smvmt_get_option( 'below-header-current-menu-bg-color-responsive' );

	$below_header_submenu_text_color      = smvmt_get_option( 'below-header-submenu-text-color-responsive' );
	$below_header_submenu_bg_color        = smvmt_get_option( 'below-header-submenu-bg-color-responsive' );
	$below_header_submenu_hover_color     = smvmt_get_option( 'below-header-submenu-hover-color-responsive' );
	$below_header_submenu_bg_hover_color  = smvmt_get_option( 'below-header-submenu-bg-hover-color-responsive' );
	$below_header_submenu_active_color    = smvmt_get_option( 'below-header-submenu-active-color-responsive' );
	$below_header_submenu_active_bg_color = smvmt_get_option( 'below-header-submenu-active-bg-color-responsive' );

	$below_header_submenu_border       = smvmt_get_option( 'below-header-submenu-border' );
	$below_header_submenu_item_border  = smvmt_get_option( 'below-header-submenu-item-border' );
	$below_header_submenu_item_b_color = smvmt_get_option( 'below-header-submenu-item-b-color' );
	$below_header_submenu_border_color = smvmt_get_option( 'below-header-submenu-border-color' );

	$font_size_below_header_content      = smvmt_get_option( 'font-size-below-header-content' );
	$font_family_below_header_content    = smvmt_get_option( 'font-family-below-header-content' );
	$font_weight_below_header_content    = smvmt_get_option( 'font-weight-below-header-content' );
	$text_transform_below_header_content = smvmt_get_option( 'text-transform-below-header-content' );

	$font_size_below_header_primary      = smvmt_get_option( 'font-size-below-header-primary-menu' );
	$font_family_below_header_primary    = smvmt_get_option( 'font-family-below-header-primary-menu' );
	$font_weight_below_header_primary    = smvmt_get_option( 'font-weight-below-header-primary-menu' );
	$text_transform_below_header_primary = smvmt_get_option( 'text-transform-below-header-primary-menu' );

	$font_size_below_header_dropdown      = smvmt_get_option( 'font-size-below-header-dropdown-menu' );
	$font_family_below_header_dropdown    = smvmt_get_option( 'font-family-below-header-dropdown-menu' );
	$font_weight_below_header_dropdown    = smvmt_get_option( 'font-weight-below-header-dropdown-menu' );
	$text_transform_below_header_dropdown = smvmt_get_option( 'text-transform-below-header-dropdown-menu' );

	// Header Break Point.
	$header_break_point = smvmt_header_break_point();

	$max_height = '26px';
	$padding    = '';
	if ( '' != $below_header_line_height && 30 < $below_header_line_height ) {
		$max_height = ( $below_header_line_height - 8 ) . 'px';
	}

	if ( 60 > $below_header_line_height ) {
		$padding = '.35em';
	}

	$parse_css = '';

	/**
	 * [1]. Below Header General options
	 * [2]. Below Header Responsive Typography
	 * [3]. Below Header Responsive Colors
	 */

	/**
	 * [1]. Below Header General options
	 */
	$common_css_output = array(

		'.smvmt-below-header'                => array(
			'border-bottom-width' => smvmt_get_css_value( $below_header_border, 'px' ),
			'border-bottom-color' => esc_attr( $below_header_border_color ),
			'line-height'         => smvmt_get_css_value( $below_header_line_height, 'px' ),
		),

		'.smvmt-below-header-section-wrap'   => array(
			'min-height' => smvmt_get_css_value( $below_header_line_height, 'px' ),
		),

		'.below-header-user-select .smvmt-search-menu-icon .search-field' => array(
			'max-height'     => esc_attr( $max_height ),
			'padding-top'    => esc_attr( $padding ),
			'padding-bottom' => esc_attr( $padding ),
		),

		/**
		 * Below Header Navigation
		 */
		'.smvmt-below-header-menu'           => array(
			'font-family'    => smvmt_get_css_value( $font_family_below_header_primary, 'font' ),
			'font-weight'    => smvmt_get_css_value( $font_weight_below_header_primary, 'font' ),
			'font-size'      => smvmt_responsive_font( $font_size_below_header_primary, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_below_header_primary ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */
		'.smvmt-below-header-menu .sub-menu' => array(
			'font-family'    => smvmt_get_css_value( $font_family_below_header_dropdown, 'font' ),
			'font-weight'    => smvmt_get_css_value( $font_weight_below_header_dropdown, 'font' ),
			'font-size'      => smvmt_responsive_font( $font_size_below_header_dropdown, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_below_header_dropdown ),
		),

		'.smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu .smvmt-full-megamenu-wrapper' => array(
			'border-color' => esc_attr( $below_header_submenu_border_color ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select'        => array(
			'font-family'    => smvmt_get_css_value( $font_family_below_header_content, 'font' ),
			'font-weight'    => smvmt_get_css_value( $font_weight_below_header_content, 'font' ),
			'font-size'      => smvmt_responsive_font( $font_size_below_header_content, 'desktop' ),
			'text-transform' => esc_attr( $text_transform_below_header_content ),
		),
	);

	/**
	 * [2]. Below Header General options
	 */
	$tablet_typography_css = array(
		'.smvmt-below-header-menu'           => array(
			'font-size' => smvmt_responsive_font( $font_size_below_header_primary, 'tablet' ),
		),
		'.smvmt-below-header-menu .sub-menu' => array(
			'font-size' => smvmt_responsive_font( $font_size_below_header_dropdown, 'tablet' ),
		),
		'.below-header-user-select'        => array(
			'font-size' => smvmt_responsive_font( $font_size_below_header_content, 'tablet' ),
		),
	);

	$mobile_typography_css = array(
		'.smvmt-below-header-menu'           => array(
			'font-size' => smvmt_responsive_font( $font_size_below_header_primary, 'mobile' ),
		),
		'.smvmt-below-header-menu .sub-menu' => array(
			'font-size' => smvmt_responsive_font( $font_size_below_header_dropdown, 'mobile' ),
		),
		'.below-header-user-select'        => array(
			'font-size' => smvmt_responsive_font( $font_size_below_header_content, 'mobile' ),
		),
	);

	/**
	 * [3]. Below Header Responsive Colors
	 */
	$desktop_colors = array(
		'.smvmt-below-header'                                => smvmt_get_responsive_background_obj( $below_header_obj, 'desktop' ),
		'.smvmt-below-header, .smvmt-below-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $desktop_below_header_bg ),
		),
		'.smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $desktop_below_header_bg ),
		),
		'.smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $desktop_below_header_bg ),
		),
		'.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-wrap .smvmt-below-header-actual-nav' => smvmt_get_background_obj( $below_header_menu_bg_obj['desktop'] ),

		/**
		 * Below Header Navigation
		 */

		'.smvmt-below-header-menu, .smvmt-below-header-menu a' => array(
			'color' => esc_attr( $below_header_menu_text['desktop'] ),
		),

		'.smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, .smvmt-below-header-menu li.focus > a' => array(
			'color'            => esc_attr( $below_header_menu_hover_color['desktop'] ),
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['desktop'] ),
		),

		'.smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_current_color['desktop'] ),
		),

		'.smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['desktop'] ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-header-menu .sub-menu li.focus > a' => array(
			'color'            => esc_attr( $below_header_submenu_hover_color['desktop'] ),
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['desktop'] ),
		),

		'.smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color'            => esc_attr( $below_header_submenu_active_color['desktop'] ),
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['desktop'] ),
		),

		'.smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['desktop'] ),
		),

		'.smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu .sub-menu a' => array(
			'color' => esc_attr( $below_header_submenu_text_color['desktop'] ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select .widget,.below-header-user-select .widget-title' => array(
			'color' => esc_attr( $right_left_text_color['desktop'] ),
		),

		'.below-header-user-select a, .below-header-user-select .widget a' => array(
			'color' => esc_attr( $desktop_right_left_link_color ),
		),

		'.below-header-user-select a:hover, .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $desktop_right_left_link_hover_color ),
		),

		'.below-header-user-select input.search-field:focus, .below-header-user-select input.search-field.focus' => array(
			'border-color' => esc_attr( $desktop_right_left_link_color ),
		),
		'.below-header-user-select'                        => array(
			'color' => esc_attr( $right_left_text_color['desktop'] ),
		),
	);

	$tablet_colors = array(
		'.smvmt-below-header'                                => smvmt_get_responsive_background_obj( $below_header_obj, 'tablet' ),
		'.smvmt-below-header, .smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $tablet_below_header_bg ),
		),
		'.smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $tablet_below_header_bg ),
		),
		'.smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $tablet_below_header_bg ),
		),
		'.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-wrap .smvmt-below-header-actual-nav' => smvmt_get_background_obj( $below_header_menu_bg_obj['tablet'] ),

		/**
		 * Below Header Navigation
		 */

		'.smvmt-below-header-menu, .smvmt-below-header-menu a' => array(
			'color' => esc_attr( $below_header_menu_text['tablet'] ),
		),

		'.smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, .smvmt-below-header-menu li.focus > a' => array(
			'color'            => esc_attr( $below_header_menu_hover_color['tablet'] ),
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['tablet'] ),
		),

		'.smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_current_color['tablet'] ),
		),

		'.smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['tablet'] ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-header-menu .sub-menu li.focus > a' => array(
			'color'            => esc_attr( $below_header_submenu_hover_color['tablet'] ),
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['tablet'] ),
		),

		'.smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color'            => esc_attr( $below_header_submenu_active_color['tablet'] ),
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['tablet'] ),
		),

		'.smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['tablet'] ),
		),

		'.smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu .sub-menu a' => array(
			'color' => esc_attr( $below_header_submenu_text_color['tablet'] ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select .widget,.below-header-user-select .widget-title' => array(
			'color' => esc_attr( $right_left_text_color['tablet'] ),
		),

		'.below-header-user-select a, .below-header-user-select .widget a' => array(
			'color' => esc_attr( $tablet_right_left_link_color ),
		),

		'.below-header-user-select a:hover, .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $tablet_right_left_link_hover_color ),
		),

		'.below-header-user-select input.search-field:focus, .below-header-user-select input.search-field.focus' => array(
			'border-color' => esc_attr( $tablet_right_left_link_color ),
		),
		'.below-header-user-select'                        => array(
			'color' => esc_attr( $right_left_text_color['tablet'] ),
		),
	);

	$mobile_colors = array(
		'.smvmt-below-header'                                => smvmt_get_responsive_background_obj( $below_header_obj, 'mobile' ),
		'.smvmt-below-header, .smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $mobile_below_header_bg ),
		),
		'.smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $mobile_below_header_bg ),
		),
		'.smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $mobile_below_header_bg ),
		),
		'.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-wrap .smvmt-below-header-actual-nav' => smvmt_get_background_obj( $below_header_menu_bg_obj['mobile'] ),

		/**
		 * Below Header Navigation
		 */

		'.smvmt-below-header-menu, .smvmt-below-header-menu a' => array(
			'color' => esc_attr( $below_header_menu_text['mobile'] ),
		),

		'.smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, .smvmt-below-header-menu li.focus > a' => array(
			'color'            => esc_attr( $below_header_menu_hover_color['mobile'] ),
			'background-color' => esc_attr( $below_header_menu_hover_bg_color['mobile'] ),
		),

		'.smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $below_header_menu_current_color['mobile'] ),
		),

		'.smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'background-color' => esc_attr( $below_header_menu_current_bg_color['mobile'] ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-header-menu .sub-menu li.focus > a' => array(
			'color'            => esc_attr( $below_header_submenu_hover_color['mobile'] ),
			'background-color' => esc_attr( $below_header_submenu_bg_hover_color['mobile'] ),
		),

		'.smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color'            => esc_attr( $below_header_submenu_active_color['mobile'] ),
			'background-color' => esc_attr( $below_header_submenu_active_bg_color['mobile'] ),
		),

		'.smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu.smvmt-mega-menu-enabled.submenu-with-border .smvmt-full-megamenu-wrapper' => array(
			'background-color' => esc_attr( $below_header_submenu_bg_color['mobile'] ),
		),

		'.smvmt-below-header-menu .sub-menu, .smvmt-below-header-menu .sub-menu a' => array(
			'color' => esc_attr( $below_header_submenu_text_color['mobile'] ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.below-header-user-select .widget,.below-header-user-select .widget-title' => array(
			'color' => esc_attr( $right_left_text_color['mobile'] ),
		),

		'.below-header-user-select a, .below-header-user-select .widget a' => array(
			'color' => esc_attr( $mobile_right_left_link_color ),
		),

		'.below-header-user-select a:hover, .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $mobile_right_left_link_hover_color ),
		),

		'.below-header-user-select input.search-field:focus, .below-header-user-select input.search-field.focus' => array(
			'border-color' => esc_attr( $mobile_right_left_link_color ),
		),
		'.below-header-user-select'                        => array(
			'color' => esc_attr( $right_left_text_color['mobile'] ),
		),
	);

	// Common options of Below Header.
	$parse_css .= smvmt_parse_css( $common_css_output );

	// Below Header Responsive Typography.
	$parse_css .= smvmt_parse_css( $tablet_typography_css, '', '768' );
	$parse_css .= smvmt_parse_css( $mobile_typography_css, '', '544' );

	// Below Header Responsive Colors.
	$parse_css .= smvmt_parse_css( $desktop_colors );
	$parse_css .= smvmt_parse_css( $tablet_colors, '', '768' );
	$parse_css .= smvmt_parse_css( $mobile_colors, '', '544' );

	/**
	 * Hide the default naviagtion markup for responsive devices.
	 * Once class .smvmt-header-break-point is added to the body below CSS will be override by the
	 * .smvmt-header-break-point class
	 */
	$smvmt_navigation = array(
		'.smvmt-below-header-actual-nav, .smvmt-below-header-hide-on-mobile .smvmt-below-header-wrap' => array(
			'display' => esc_attr( 'none' ),
		),
	);
	$parse_css       .= smvmt_parse_css( $smvmt_navigation, '', $header_break_point );

	// Below header border.
	$border = array(
		'.smvmt-desktop .smvmt-below-header-menu.submenu-with-border .sub-menu a' => array(
			'border-bottom-width' => ( true == $below_header_submenu_item_border ) ? '1px' : '0px',
			'border-style'        => 'solid',
			'border-color'        => esc_attr( $below_header_submenu_item_b_color ),
		),
		'.smvmt-desktop .smvmt-below-header-menu.submenu-with-border .sub-menu .sub-menu' => array(
			'top' => ( isset( $below_header_submenu_border['top'] ) && '' != $below_header_submenu_border['top'] ) ? smvmt_get_css_value( '-' . $below_header_submenu_border['top'], 'px' ) : '',
		),
		'.smvmt-desktop .smvmt-below-header-menu.submenu-with-border .sub-menu' => array(
			'border-top-width'    => smvmt_get_css_value( $below_header_submenu_border['top'], 'px' ),
			'border-left-width'   => smvmt_get_css_value( $below_header_submenu_border['left'], 'px' ),
			'border-right-width'  => smvmt_get_css_value( $below_header_submenu_border['right'], 'px' ),
			'border-bottom-width' => smvmt_get_css_value( $below_header_submenu_border['bottom'], 'px' ),
			'border-style'        => 'solid',
		),
	);

	// Submenu items goes outside?
	$submenu_border_for_left_align_menu = array(
		'.smvmt-below-header-menu ul li.smvmt-left-align-sub-menu:hover > ul, .smvmt-below-header-menu ul li.smvmt-left-align-sub-menu.focus > ul' => array(
			'margin-left' => ( ( isset( $below_header_submenu_border['left'] ) && '' != $below_header_submenu_border['left'] ) || isset( $below_header_submenu_border['right'] ) && '' != $below_header_submenu_border['right'] ) ? smvmt_get_css_value( '-' . ( $below_header_submenu_border['left'] + $below_header_submenu_border['right'] ), 'px' ) : '',
		),
	);

	/* Parse CSS from array() */
	$parse_css .= smvmt_parse_css( $border );
	// Submenu items goes outside?
	$parse_css .= smvmt_parse_css( $submenu_border_for_left_align_menu, '769' );

	// Add Inline style.
	return $dynamic_css . $parse_css;
}
