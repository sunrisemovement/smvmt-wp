<?php
/**
 * Transparent Header - Dynamic CSS
 *
 * @package smvmt
 */

add_filter( 'smvmt_dynamic_css', 'smvmt_ext_above_header_sections_dynamic_css', 30 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function smvmt_ext_above_header_sections_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * Set colors
	 *
	 * If colors extension is_active then get color from it.
	 * Else set theme default colors.
	 */
	$stick_header            = smvmt_get_option_meta( 'stick-header-meta' );
	$stick_header_above_meta = smvmt_get_option_meta( 'header-above-stick-meta' );

	$stick_header_above = smvmt_get_option( 'header-above-stick' );

	$sticky_header_style   = smvmt_get_option( 'sticky-header-style' );
	$sticky_hide_on_scroll = smvmt_get_option( 'sticky-hide-on-scroll' );

	/**
	 * Above Header.
	 */
	$desktop_sticky_above_header_bg_color = smvmt_get_prop( smvmt_get_option( 'sticky-above-header-bg-color-responsive' ), 'desktop', '#ffffff' );

	$tablet_sticky_above_header_bg_color = smvmt_get_prop( smvmt_get_option( 'sticky-above-header-bg-color-responsive' ), 'tablet' );
	$mobile_sticky_above_header_bg_color = smvmt_get_prop( smvmt_get_option( 'sticky-above-header-bg-color-responsive' ), 'mobile' );

	$sticky_above_header_menu_bg_color_responsive     = smvmt_get_option( 'sticky-above-header-menu-bg-color-responsive' );
	$sticky_above_header_menu_color_responsive        = smvmt_get_option( 'sticky-above-header-menu-color-responsive' );
	$sticky_above_header_menu_h_color_responsive      = smvmt_get_option( 'sticky-above-header-menu-h-color-responsive' );
	$sticky_above_header_menu_h_a_bg_color_responsive = smvmt_get_option( 'sticky-above-header-menu-h-a-bg-color-responsive' );

	$sticky_above_header_submenu_bg_color_responsive     = smvmt_get_option( 'sticky-above-header-submenu-bg-color-responsive' );
	$sticky_above_header_submenu_color_responsive        = smvmt_get_option( 'sticky-above-header-submenu-color-responsive' );
	$sticky_above_header_submenu_h_color_responsive      = smvmt_get_option( 'sticky-above-header-submenu-h-color-responsive' );
	$sticky_above_header_submenu_h_a_bg_color_responsive = smvmt_get_option( 'sticky-above-header-submenu-h-a-bg-color-responsive' );

	$sticky_above_content_section_text_color   = smvmt_get_option( 'sticky-above-header-content-section-text-color-responsive' );
	$sticky_above_content_section_link_color   = smvmt_get_option( 'sticky-above-header-content-section-link-color-responsive' );
	$sticky_above_content_section_link_h_color = smvmt_get_option( 'sticky-above-header-content-section-link-h-color-responsive' );

	if ( ! $stick_header_above && ( 'disabled' !== $stick_header && empty( $stick_header ) && ( empty( $stick_header_above_meta ) ) ) ) {
		return $dynamic_css;
	}

	$parse_css = '';

	/**
	 * Sticky Header
	 *
	 * [1]. Sticky Header Above colors options.
	 */

		/**
		 * Above Header.
		 */
	if ( 'none' === $sticky_header_style && ! $sticky_hide_on_scroll ) {
		$desktop_above_header_css_output = array(
			'.smvmt-above-sticky-header-active .smvmt-above-header-wrap .smvmt-above-header' => array(
				'background-color' => esc_attr( $desktop_sticky_above_header_bg_color ),
			),
			'.smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation > ul' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['desktop'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field, .smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field:focus' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['desktop'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu,.smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['desktop'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu a, .smvmt-header-break-point .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle'                => array(
				'color' => esc_attr( $sticky_above_header_menu_color_responsive['desktop'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation .menu-item.focus > a'     => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-item > a,.smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			/**
			 * Above Header Dropdown Navigation
			 */
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.focus > a,.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_submenu_h_color_responsive['desktop'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .submenu'            => array(
				'background-color' => esc_attr( $sticky_above_header_submenu_bg_color_responsive['desktop'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.sub-menu' => array(
				'color' => esc_attr( $sticky_above_header_submenu_color_responsive['desktop'] ),
			),

			// Content Section text color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget-title' => array(
				'color' => esc_attr( $sticky_above_content_section_text_color['desktop'] ),
			),
			// Content Section link color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a' => array(
				'color' => esc_attr( $sticky_above_content_section_link_color['desktop'] ),
			),
			// Content Section link hover color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a:hover, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a:hover' => array(
				'color' => esc_attr( $sticky_above_content_section_link_h_color['desktop'] ),
			),
		);
		$tablet_above_header_css_output = array(

			'.smvmt-above-sticky-header-active .smvmt-above-header-wrap .smvmt-above-header' => array(
				'background-color' => esc_attr( $tablet_sticky_above_header_bg_color ),
			),
			'.smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation > ul' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['tablet'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field, .smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field:focus' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['tablet'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu,.smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['tablet'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu a, .smvmt-header-break-point .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle'                => array(
				'color' => esc_attr( $sticky_above_header_menu_color_responsive['tablet'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation .menu-item.focus > a'     => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-item > a,.smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			/**
			 * Above Header Dropdown Navigation
			 */
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.focus > a,.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_submenu_h_color_responsive['tablet'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .submenu'            => array(
				'background-color' => esc_attr( $sticky_above_header_submenu_bg_color_responsive['tablet'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.sub-menu' => array(
				'color' => esc_attr( $sticky_above_header_submenu_color_responsive['tablet'] ),
			),

			// Content Section text color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget-title' => array(
				'color' => esc_attr( $sticky_above_content_section_text_color['tablet'] ),
			),
			// Content Section link color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a' => array(
				'color' => esc_attr( $sticky_above_content_section_link_color['tablet'] ),
			),
			// Content Section link hover color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a:hover, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a:hover' => array(
				'color' => esc_attr( $sticky_above_content_section_link_h_color['tablet'] ),
			),
		);
		$mobile_above_header_css_output = array(

			'.smvmt-above-sticky-header-active .smvmt-above-header-wrap .smvmt-above-header' => array(
				'background-color' => esc_attr( $mobile_sticky_above_header_bg_color ),
			),
			'.smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation > ul' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['mobile'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field, .smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field:focus' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['mobile'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu,.smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['mobile'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu a, .smvmt-header-break-point .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle'                => array(
				'color' => esc_attr( $sticky_above_header_menu_color_responsive['mobile'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation .menu-item.focus > a'     => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['mobile'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-item > a,.smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['mobile'] ),
			),

			/**
			 * Above Header Dropdown Navigation
			 */
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.focus > a,.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_submenu_h_color_responsive['mobile'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),
			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .submenu'            => array(
				'background-color' => esc_attr( $sticky_above_header_submenu_bg_color_responsive['mobile'] ),
			),

			'.smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.sub-menu' => array(
				'color' => esc_attr( $sticky_above_header_submenu_color_responsive['mobile'] ),
			),
			// Content Section text color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget-title' => array(
				'color' => esc_attr( $sticky_above_content_section_text_color['mobile'] ),
			),
			// Content Section link color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a' => array(
				'color' => esc_attr( $sticky_above_content_section_link_color['mobile'] ),
			),
			// Content Section link hover color.
			'.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a:hover, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a:hover' => array(
				'color' => esc_attr( $sticky_above_content_section_link_h_color['mobile'] ),
			),
		);
	} else {
		// Only when Fixed Header Merkup added.
		$desktop_above_header_css_output = array(

			'#smvmt-fixed-header .smvmt-above-header' => array(
				'background-color' => esc_attr( $desktop_sticky_above_header_bg_color ),
			),
			'.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['desktop'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field, #smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field:focus' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['desktop'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu,.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu a, #smvmt-fixed-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_menu_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation li:hover > a, #smvmt-fixed-header .smvmt-above-header-navigation .menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-item > a,#smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			/**
			 * Above Header Dropdown Navigation
			 */
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.focus > a,#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_submenu_h_color_responsive['desktop'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_submenu_bg_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, #smvmt-fixed-header .smvmt-above-header-navigation .sub-menu' => array(
				'color' => esc_attr( $sticky_above_header_submenu_color_responsive['desktop'] ),
			),
			// Content Section text color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select, #smvmt-fixed-header .smvmt-above-header-section .widget, #smvmt-fixed-header .smvmt-above-header-section .widget-title' => array(
				'color' => esc_attr( $sticky_above_content_section_text_color['desktop'] ),
			),
			// Content Section link color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select a, #smvmt-fixed-header .smvmt-above-header-section .widget a' => array(
				'color' => esc_attr( $sticky_above_content_section_link_color['desktop'] ),
			),
			// Content Section link hover color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select a:hover, #smvmt-fixed-header .smvmt-above-header-section .widget a:hover' => array(
				'color' => esc_attr( $sticky_above_content_section_link_h_color['desktop'] ),
			),
		);
		$tablet_above_header_css_output = array(

			'#smvmt-fixed-header .smvmt-above-header' => array(
				'background-color' => esc_attr( $tablet_sticky_above_header_bg_color ),
			),
			'.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['tablet'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field, #smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field:focus' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['tablet'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu,.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu a, #smvmt-fixed-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_menu_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation li:hover > a, #smvmt-fixed-header .smvmt-above-header-navigation .menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-item > a,#smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			/**
			 * Above Header Dropdown Navigation
			 */
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.focus > a,#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_submenu_h_color_responsive['tablet'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_submenu_bg_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, #smvmt-fixed-header .smvmt-above-header-navigation .sub-menu' => array(
				'color' => esc_attr( $sticky_above_header_submenu_color_responsive['tablet'] ),
			),
			// Content Section text color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select, #smvmt-fixed-header .smvmt-above-header-section .widget, #smvmt-fixed-header .smvmt-above-header-section .widget-title' => array(
				'color' => esc_attr( $sticky_above_content_section_text_color['tablet'] ),
			),
			// Content Section link color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select a, #smvmt-fixed-header .smvmt-above-header-section .widget a' => array(
				'color' => esc_attr( $sticky_above_content_section_link_color['tablet'] ),
			),
			// Content Section link hover color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select a:hover, #smvmt-fixed-header .smvmt-above-header-section .widget a:hover' => array(
				'color' => esc_attr( $sticky_above_content_section_link_h_color['tablet'] ),
			),
		);
		$mobile_above_header_css_output = array(

			'#smvmt-fixed-header .smvmt-above-header' => array(
				'background-color' => esc_attr( $mobile_sticky_above_header_bg_color ),
			),
			'.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['mobile'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field, #smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field:focus' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['mobile'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu,.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_menu_bg_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu a, #smvmt-fixed-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_menu_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation li:hover > a, #smvmt-fixed-header .smvmt-above-header-navigation .menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['mobile'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-item > a,#smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $sticky_above_header_menu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_menu_h_a_bg_color_responsive['mobile'] ),
			),

			/**
			 * Above Header Dropdown Navigation
			 */
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.focus > a,#smvmt-fixed-header .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_above_header_submenu_h_color_responsive['mobile'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_above_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_above_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),
			'#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_above_header_submenu_bg_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, #smvmt-fixed-header .smvmt-above-header-navigation .sub-menu' => array(
				'color' => esc_attr( $sticky_above_header_submenu_color_responsive['mobile'] ),
			),
			// Content Section text color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select, #smvmt-fixed-header .smvmt-above-header-section .widget, #smvmt-fixed-header .smvmt-above-header-section .widget-title' => array(
				'color' => esc_attr( $sticky_above_content_section_text_color['mobile'] ),
			),
			// Content Section link color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select a, #smvmt-fixed-header .smvmt-above-header-section .widget a' => array(
				'color' => esc_attr( $sticky_above_content_section_link_color['mobile'] ),
			),
			// Content Section link hover color.
			'#smvmt-fixed-header .smvmt-above-header-section .user-select a:hover, #smvmt-fixed-header .smvmt-above-header-section .widget a:hover' => array(
				'color' => esc_attr( $sticky_above_content_section_link_h_color['mobile'] ),
			),
		);
	}

		/* Parse CSS from array() */
		$parse_css .= smvmt_parse_css( $desktop_above_header_css_output );
		$parse_css .= smvmt_parse_css( $tablet_above_header_css_output, '', '768' );
		$parse_css .= smvmt_parse_css( $mobile_above_header_css_output, '', '544' );

	return $dynamic_css .= $parse_css;

}


add_filter( 'smvmt_dynamic_css', 'smvmt_ext_below_header_sections_dynamic_css', 30 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function smvmt_ext_below_header_sections_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * Set colors
	 *
	 * If colors extension is_active then get color from it.
	 * Else set theme default colors.
	 */
	$stick_header            = smvmt_get_option_meta( 'stick-header-meta' );
	$stick_header_below_meta = smvmt_get_option_meta( 'header-below-stick-meta' );

	$stick_header_below = smvmt_get_option( 'header-below-stick' );

	$sticky_header_style   = smvmt_get_option( 'sticky-header-style' );
	$sticky_hide_on_scroll = smvmt_get_option( 'sticky-hide-on-scroll' );
	/**
	 * Below Header.
	 */
	$desktop_sticky_below_header_bg_color = smvmt_get_prop( smvmt_get_option( 'sticky-below-header-bg-color-responsive' ), 'desktop', '#414042' );
	$tablet_sticky_below_header_bg_color  = smvmt_get_prop( smvmt_get_option( 'sticky-below-header-bg-color-responsive' ), 'tablet' );
	$mobile_sticky_below_header_bg_color  = smvmt_get_prop( smvmt_get_option( 'sticky-below-header-bg-color-responsive' ), 'mobile' );

	$sticky_below_header_menu_bg_color_responsive     = smvmt_get_option( 'sticky-below-header-menu-bg-color-responsive' );
	$sticky_below_header_menu_color_responsive        = smvmt_get_option( 'sticky-below-header-menu-color-responsive' );
	$sticky_below_header_menu_h_color_responsive      = smvmt_get_option( 'sticky-below-header-menu-h-color-responsive' );
	$sticky_below_header_menu_h_a_bg_color_responsive = smvmt_get_option( 'sticky-below-header-menu-h-a-bg-color-responsive' );

	$sticky_below_header_submenu_bg_color_responsive     = smvmt_get_option( 'sticky-below-header-submenu-bg-color-responsive' );
	$sticky_below_header_submenu_color_responsive        = smvmt_get_option( 'sticky-below-header-submenu-color-responsive' );
	$sticky_below_header_submenu_h_color_responsive      = smvmt_get_option( 'sticky-below-header-submenu-h-color-responsive' );
	$sticky_below_header_submenu_h_a_bg_color_responsive = smvmt_get_option( 'sticky-below-header-submenu-h-a-bg-color-responsive' );

	$sticky_below_content_section_text_color   = smvmt_get_option( 'sticky-below-header-content-section-text-color-responsive' );
	$sticky_below_content_section_link_color   = smvmt_get_option( 'sticky-below-header-content-section-link-color-responsive' );
	$sticky_below_content_section_link_h_color = smvmt_get_option( 'sticky-below-header-content-section-link-h-color-responsive' );

	if ( ! $stick_header_below && ( 'disabled' !== $stick_header && empty( $stick_header ) && ( empty( $stick_header_below_meta ) ) ) ) {
		return $dynamic_css;
	}

	$parse_css = '';

	/**
	 * Sticky Header
	 *
	 * [1]. Sticky Header Below colors options.
	 */

		/**
		 * Below Header.
		 */
	if ( 'none' === $sticky_header_style && ! $sticky_hide_on_scroll ) {
		$desktop_below_header_css_output = array(
			'.smvmt-below-sticky-header-active .smvmt-below-header-wrap .smvmt-below-header' => array(
				'background-color' => esc_attr( $desktop_sticky_below_header_bg_color ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-actual-nav, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-below-sticky-header-active .smvmt-below-header-actual-nav.smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_bg_color_responsive['desktop'] ),
			),

			'.smvmt-fullscreen-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap' => array(
				'background' => esc_attr( $sticky_below_header_menu_bg_color_responsive['desktop'] ),
			),

			/**
			 * Below Header Navigation
			 */
			'.smvmt-below-sticky-header-active .smvmt-below-header-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu a' => array(
				'color' => esc_attr( $sticky_below_header_menu_color_responsive['desktop'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_menu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_below_header_menu_h_color_responsive['desktop'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			/**
			 * Below Header Dropdown Navigation
			 */

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),

			'.smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),

			'.smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus > a' => array(
				'background-color' => 'transparent',
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu'               => array(
				'background-color' => esc_attr( $sticky_below_header_submenu_bg_color_responsive['desktop'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu a' => array(
				'color' => esc_attr( $sticky_below_header_submenu_color_responsive['desktop'] ),
			),

			// Content Section text color.
			'.smvmt-below-sticky-header-active .below-header-user-select, .smvmt-below-sticky-header-active .below-header-user-select .widget,.smvmt-below-sticky-header-active .below-header-user-select .widget-title' => array(
				'color' => esc_attr( $sticky_below_content_section_text_color['desktop'] ),
			),
			// Content Section link color.
			'.smvmt-below-sticky-header-active .below-header-user-select a, .smvmt-below-sticky-header-active .below-header-user-select .widget a' => array(
				'color' => esc_attr( $sticky_below_content_section_link_color['desktop'] ),
			),
			// Content Section link hover color.
			'.smvmt-below-sticky-header-active .below-header-user-select a:hover, .smvmt-below-sticky-header-active .below-header-user-select .widget a:hover' => array(
				'color' => esc_attr( $sticky_below_content_section_link_h_color['desktop'] ),
			),
		);
		$tablet_below_header_css_output = array(

			'.smvmt-below-sticky-header-active .smvmt-below-header-wrap .smvmt-below-header' => array(
				'background-color' => esc_attr( $tablet_sticky_below_header_bg_color ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-actual-nav, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-below-sticky-header-active .smvmt-below-header-actual-nav.smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_bg_color_responsive['tablet'] ),
			),

			'.smvmt-fullscreen-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap' => array(
				'background' => esc_attr( $sticky_below_header_menu_bg_color_responsive['tablet'] ),
			),

			/**
			 * Below Header Navigation
			 */
			'.smvmt-below-sticky-header-active .smvmt-below-header-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu a' => array(
				'color' => esc_attr( $sticky_below_header_menu_color_responsive['tablet'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_menu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_below_header_menu_h_color_responsive['tablet'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			/**
			 * Below Header Dropdown Navigation
			 */

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),

			'.smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu'               => array(
				'background-color' => esc_attr( $sticky_below_header_submenu_bg_color_responsive['tablet'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu a' => array(
				'color' => esc_attr( $sticky_below_header_submenu_color_responsive['tablet'] ),
			),

			// Content Section text color.
			'.smvmt-below-sticky-header-active .below-header-user-select, .smvmt-below-sticky-header-active .below-header-user-select .widget,.smvmt-below-sticky-header-active .below-header-user-select .widget-title' => array(
				'color' => esc_attr( $sticky_below_content_section_text_color['tablet'] ),
			),
			// Content Section link color.
			'.smvmt-below-sticky-header-active .below-header-user-select a, .smvmt-below-sticky-header-active .below-header-user-select .widget a' => array(
				'color' => esc_attr( $sticky_below_content_section_link_color['tablet'] ),
			),
			// Content Section link hover color.
			'.smvmt-below-sticky-header-active .below-header-user-select a:hover, .smvmt-below-sticky-header-active .below-header-user-select .widget a:hover' => array(
				'color' => esc_attr( $sticky_below_content_section_link_h_color['tablet'] ),
			),
		);
		$mobile_below_header_css_output = array(

			'.smvmt-below-sticky-header-active .smvmt-below-header-wrap .smvmt-below-header' => array(
				'background-color' => esc_attr( $mobile_sticky_below_header_bg_color ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-actual-nav, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-below-sticky-header-active .smvmt-below-header-actual-nav.smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_bg_color_responsive['mobile'] ),
			),

			'.smvmt-fullscreen-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap' => array(
				'background' => esc_attr( $sticky_below_header_menu_bg_color_responsive['mobile'] ),
			),

			/**
			 * Below Header Navigation
			 */
			'.smvmt-below-sticky-header-active .smvmt-below-header-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu a' => array(
				'color' => esc_attr( $sticky_below_header_menu_color_responsive['mobile'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_menu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['mobile'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_below_header_menu_h_color_responsive['mobile'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['mobile'] ),
			),

			/**
			 * Below Header Dropdown Navigation
			 */

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),

			'.smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus, .smvmt-fullscreen-below-menu-enable.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu'               => array(
				'background-color' => esc_attr( $sticky_below_header_submenu_bg_color_responsive['mobile'] ),
			),

			'.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu a' => array(
				'color' => esc_attr( $sticky_below_header_submenu_color_responsive['mobile'] ),
			),

			// Content Section text color.
			'.smvmt-below-sticky-header-active .below-header-user-select, .smvmt-below-sticky-header-active .below-header-user-select .widget,.smvmt-below-sticky-header-active .below-header-user-select .widget-title' => array(
				'color' => esc_attr( $sticky_below_content_section_text_color['mobile'] ),
			),
			// Content Section link color.
			'.smvmt-below-sticky-header-active .below-header-user-select a, .smvmt-below-sticky-header-active .below-header-user-select .widget a' => array(
				'color' => esc_attr( $sticky_below_content_section_link_color['mobile'] ),
			),
			// Content Section link hover color.
			'.smvmt-below-sticky-header-active .below-header-user-select a:hover, .smvmt-below-sticky-header-active .below-header-user-select .widget a:hover' => array(
				'color' => esc_attr( $sticky_below_content_section_link_h_color['mobile'] ),
			),
		);
	} else {
		// Only when Fixed Header Merkup added.
		$desktop_below_header_css_output = array(

			'#smvmt-fixed-header .smvmt-below-header' => array(
				'background-color' => esc_attr( $desktop_sticky_below_header_bg_color ),
			),

			'#smvmt-fixed-header .smvmt-below-header-actual-nav' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_bg_color_responsive['desktop'] ),
			),

			/**
			 * Below Header Navigation
			 */
			'#smvmt-fixed-header .smvmt-below-header-menu, #smvmt-fixed-header .smvmt-below-header-menu a' => array(
				'color' => esc_attr( $sticky_below_header_menu_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_menu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_below_header_menu_h_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['desktop'] ),
			),

			/**
			 * Below Header Dropdown Navigation
			 */

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['desktop'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_below_header_submenu_bg_color_responsive['desktop'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu a' => array(
				'color' => esc_attr( $sticky_below_header_submenu_color_responsive['desktop'] ),
			),

			// Content Section text color.
			'#smvmt-fixed-header .below-header-user-select, #smvmt-fixed-header .below-header-user-select .widget,#smvmt-fixed-header .below-header-user-select .widget-title' => array(
				'color' => esc_attr( $sticky_below_content_section_text_color['desktop'] ),
			),
			// Content Section link color.
			'#smvmt-fixed-header .below-header-user-select a, #smvmt-fixed-header .below-header-user-select .widget a' => array(
				'color' => esc_attr( $sticky_below_content_section_link_color['desktop'] ),
			),
			// Content Section link hover color.
			'#smvmt-fixed-header .below-header-user-select a:hover, #smvmt-fixed-header .below-header-user-select .widget a:hover' => array(
				'color' => esc_attr( $sticky_below_content_section_link_h_color['desktop'] ),
			),
		);
		$tablet_below_header_css_output = array(

			'#smvmt-fixed-header .smvmt-below-header' => array(
				'background-color' => esc_attr( $tablet_sticky_below_header_bg_color ),
			),

			'#smvmt-fixed-header .smvmt-below-header-actual-nav' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_bg_color_responsive['tablet'] ),
			),

			/**
			 * Below Header Navigation
			 */
			'#smvmt-fixed-header .smvmt-below-header-menu, #smvmt-fixed-header .smvmt-below-header-menu a' => array(
				'color' => esc_attr( $sticky_below_header_menu_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_menu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_below_header_menu_h_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['tablet'] ),
			),

			/**
			 * Below Header Dropdown Navigation
			 */

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['tablet'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_below_header_submenu_bg_color_responsive['tablet'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu a' => array(
				'color' => esc_attr( $sticky_below_header_submenu_color_responsive['tablet'] ),
			),

			// Content Section text color.
			'#smvmt-fixed-header .below-header-user-select, #smvmt-fixed-header .below-header-user-select .widget,#smvmt-fixed-header .below-header-user-select .widget-title' => array(
				'color' => esc_attr( $sticky_below_content_section_text_color['tablet'] ),
			),
			// Content Section link color.
			'#smvmt-fixed-header .below-header-user-select a, #smvmt-fixed-header .below-header-user-select .widget a' => array(
				'color' => esc_attr( $sticky_below_content_section_link_color['tablet'] ),
			),
			// Content Section link hover color.
			'#smvmt-fixed-header .below-header-user-select a:hover, #smvmt-fixed-header .below-header-user-select .widget a:hover' => array(
				'color' => esc_attr( $sticky_below_content_section_link_h_color['tablet'] ),
			),
		);
		$mobile_below_header_css_output = array(

			'#smvmt-fixed-header .smvmt-below-header' => array(
				'background-color' => esc_attr( $mobile_sticky_below_header_bg_color ),
			),

			'#smvmt-fixed-header .smvmt-below-header-actual-nav' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_bg_color_responsive['mobile'] ),
			),

			/**
			 * Below Header Navigation
			 */
			'#smvmt-fixed-header .smvmt-below-header-menu, #smvmt-fixed-header .smvmt-below-header-menu a' => array(
				'color' => esc_attr( $sticky_below_header_menu_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_menu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $sticky_below_header_menu_h_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'background-color' => esc_attr( $sticky_below_header_menu_h_a_bg_color_responsive['mobile'] ),
			),

			/**
			 * Below Header Dropdown Navigation
			 */

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
				'color'            => esc_attr( $sticky_below_header_submenu_h_color_responsive['mobile'] ),
				'background-color' => esc_attr( $sticky_below_header_submenu_h_a_bg_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu' => array(
				'background-color' => esc_attr( $sticky_below_header_submenu_bg_color_responsive['mobile'] ),
			),

			'#smvmt-fixed-header .smvmt-below-header-menu .sub-menu, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu a' => array(
				'color' => esc_attr( $sticky_below_header_submenu_color_responsive['mobile'] ),
			),

			// Content Section text color.
			'#smvmt-fixed-header .below-header-user-select, #smvmt-fixed-header .below-header-user-select .widget,#smvmt-fixed-header .below-header-user-select .widget-title' => array(
				'color' => esc_attr( $sticky_below_content_section_text_color['mobile'] ),
			),
			// Content Section link color.
			'#smvmt-fixed-header .below-header-user-select a, #smvmt-fixed-header .below-header-user-select .widget a' => array(
				'color' => esc_attr( $sticky_below_content_section_link_color['mobile'] ),
			),
			// Content Section link hover color.
			'#smvmt-fixed-header .below-header-user-select a:hover, #smvmt-fixed-header .below-header-user-select .widget a:hover' => array(
				'color' => esc_attr( $sticky_below_content_section_link_h_color['mobile'] ),
			),
		);
	}
		/* Parse CSS from array() */
		$parse_css .= smvmt_parse_css( $desktop_below_header_css_output );
		$parse_css .= smvmt_parse_css( $tablet_below_header_css_output, '', '768' );
		$parse_css .= smvmt_parse_css( $mobile_below_header_css_output, '', '544' );

	return $dynamic_css .= $parse_css;

}
