<?php
/**
 * Transparent Header - Dynamic CSS
 *
 * @package smvmt Addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Transparent Above Header
 */
add_filter( 'SMVMT_dynamic_theme_css', 'SMVMT_ext_transparent_above_header_sections_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          smvmt Dynamic CSS.
 * @param  string $dynamic_css_filtered smvmt Dynamic CSS Filters.
 * @return String Generated dynamic CSS for above header transparent header.
 */
function SMVMT_ext_transparent_above_header_sections_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$above_header_layout = smvmt_get_option( 'above-header-layout', 'disabled' );

	if ( 'disabled' === $above_header_layout ) {
		return $dynamic_css;
	}

	if ( false == SMVMT_Ext_Transparent_Header_Markup::is_transparent_header() ) {
		return $dynamic_css;
	}

	/**
	 * Set colors
	 */

	$transparent_bg_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'desktop' );
	$transparent_bg_color_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'tablet' );
	$transparent_bg_color_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'mobile' );

	$transparent_color_site_title_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-site-title-responsive' ), 'desktop' );
	$transparent_color_site_title_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-site-title-responsive' ), 'tablet' );
	$transparent_color_site_title_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-site-title-responsive' ), 'mobile' );

	$transparent_color_h_site_title_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-h-site-title-responsive' ), 'desktop' );
	$transparent_color_h_site_title_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-h-site-title-responsive' ), 'tablet' );
	$transparent_color_h_site_title_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-h-site-title-responsive' ), 'mobile' );

	$transparent_menu_bg_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-menu-bg-color-responsive' ), 'desktop' );
	$transparent_menu_color_desktop    = smvmt_get_prop( smvmt_get_option( 'transparent-menu-color-responsive' ), 'desktop' );
	$transparent_menu_h_color_desktop  = smvmt_get_prop( smvmt_get_option( 'transparent-menu-h-color-responsive' ), 'desktop' );

	$transparent_menu_bg_color_tablet = smvmt_get_prop( smvmt_get_option( 'transparent-menu-bg-color-responsive' ), 'tablet' );
	$transparent_menu_color_tablet    = smvmt_get_prop( smvmt_get_option( 'transparent-menu-color-responsive' ), 'tablet' );
	$transparent_menu_h_color_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-menu-h-color-responsive' ), 'tablet' );

	$transparent_menu_bg_color_mobile = smvmt_get_prop( smvmt_get_option( 'transparent-menu-bg-color-responsive' ), 'mobile' );
	$transparent_menu_color_mobile    = smvmt_get_prop( smvmt_get_option( 'transparent-menu-color-responsive' ), 'mobile' );
	$transparent_menu_h_color_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-menu-h-color-responsive' ), 'mobile' );

	$transparent_sub_menu_color_desktop    = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-color-responsive' ), 'desktop' );
	$transparent_sub_menu_h_color_desktop  = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-h-color-responsive' ), 'desktop' );
	$transparent_sub_menu_bg_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-bg-color-responsive' ), 'desktop' );

	$transparent_sub_menu_color_tablet    = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-color-responsive' ), 'tablet' );
	$transparent_sub_menu_h_color_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-h-color-responsive' ), 'tablet' );
	$transparent_sub_menu_bg_color_tablet = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-bg-color-responsive' ), 'tablet' );

	$transparent_sub_menu_color_mobile    = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-color-responsive' ), 'mobile' );
	$transparent_sub_menu_h_color_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-h-color-responsive' ), 'mobile' );
	$transparent_sub_menu_bg_color_mobile = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-bg-color-responsive' ), 'mobile' );

	$transparent_content_section_text_color_desktop   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-text-color-responsive' ), 'desktop' );
	$transparent_content_section_link_color_desktop   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-color-responsive' ), 'desktop' );
	$transparent_content_section_link_h_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-h-color-responsive' ), 'desktop' );

	$transparent_content_section_text_color_tablet   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-text-color-responsive' ), 'tablet' );
	$transparent_content_section_link_color_tablet   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-color-responsive' ), 'tablet' );
	$transparent_content_section_link_h_color_tablet = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-h-color-responsive' ), 'tablet' );

	$transparent_content_section_text_color_mobile   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-text-color-responsive' ), 'mobile' );
	$transparent_content_section_link_color_mobile   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-color-responsive' ), 'mobile' );
	$transparent_content_section_link_h_color_mobile = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-h-color-responsive' ), 'mobile' );

	/**
	 * Generate Dynamic CSS
	 */

	$css = '';
	/**
	 * Transparent Header Colors
	 */
	$transparent_header_desktop = array(
		'.smvmt-theme-transparent-header .smvmt-above-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .slide-search .search-field' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .slide-search .search-field:focus' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-item > a,.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
			'color' => esc_attr( $transparent_menu_h_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-navigation li:hover > a'     => array(
			'color' => esc_attr( $transparent_menu_h_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle'                => array(
			'color' => esc_attr( $transparent_menu_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu a' => array(
			'color' => esc_attr( $transparent_sub_menu_color_desktop ),
		),

		// Content Section text color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select, .smvmt-theme-transparent-header .smvmt-above-header-section .widget, .smvmt-theme-transparent-header .smvmt-above-header-section .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_desktop ),
		),
		// Content Section link color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_desktop ),
		),
		// Content Section link hover color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a:hover, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_desktop ),
		),

	);

	$transparent_header_tablet = array(
		'.smvmt-theme-transparent-header .smvmt-above-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .slide-search .search-field' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .slide-search .search-field:focus' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-item > a,.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
			'color' => esc_attr( $transparent_menu_h_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-navigation li:hover > a'     => array(
			'color' => esc_attr( $transparent_menu_h_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle'                => array(
			'color' => esc_attr( $transparent_menu_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu a' => array(
			'color' => esc_attr( $transparent_sub_menu_color_tablet ),
		),

		// Content Section text color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select, .smvmt-theme-transparent-header .smvmt-above-header-section .widget, .smvmt-theme-transparent-header .smvmt-above-header-section .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_tablet ),
		),
		// Content Section link color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_tablet ),
		),
		// Content Section link hover color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a:hover, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_tablet ),
		),
	);

	$transparent_header_mobile = array(
		'.smvmt-theme-transparent-header .smvmt-above-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-below-header-section-separated .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .slide-search .search-field' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header .slide-search .search-field:focus' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-item > a,.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-ancestor > a' => array(
			'color' => esc_attr( $transparent_menu_h_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-navigation li:hover > a'     => array(
			'color' => esc_attr( $transparent_menu_h_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle'                => array(
			'color' => esc_attr( $transparent_menu_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu' => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu a' => array(
			'color' => esc_attr( $transparent_sub_menu_color_mobile ),
		),

		// Content Section text color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select, .smvmt-theme-transparent-header .smvmt-above-header-section .widget, .smvmt-theme-transparent-header .smvmt-above-header-section .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_mobile ),
		),
		// Content Section link color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_mobile ),
		),
		// Content Section link hover color.
		'.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a:hover, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_mobile ),
		),
	);

	/* Parse CSS from array() */
	$css .= smvmt_parse_css( $transparent_header_desktop );
	$css .= smvmt_parse_css( $transparent_header_tablet, '', '768' );
	$css .= smvmt_parse_css( $transparent_header_mobile, '', '544' );

	return $dynamic_css . $css;

}



/**
 * Transparent Below Header
 */
add_filter( 'SMVMT_dynamic_theme_css', 'SMVMT_ext_transparent_below_header_sections_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          smvmt Dynamic CSS.
 * @param  string $dynamic_css_filtered smvmt Dynamic CSS Filters.
 * @return String Generated dynamic CSS.
 */
function SMVMT_ext_transparent_below_header_sections_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	// set page width depending on site layout.
	$below_header_layout = smvmt_get_option( 'below-header-layout', 'disabled' );

	if ( 'disabled' === $below_header_layout ) {
		return $dynamic_css;
	}

	if ( false == SMVMT_Ext_Transparent_Header_Markup::is_transparent_header() ) {
		return $dynamic_css;
	}

	/**
	 * Set colors
	 */

	$transparent_bg_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'desktop' );
	$transparent_bg_color_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'tablet' );
	$transparent_bg_color_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'mobile' );

	$transparent_color_site_title_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-site-title-responsive' ), 'desktop' );
	$transparent_color_site_title_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-site-title-responsive' ), 'tablet' );
	$transparent_color_site_title_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-site-title-responsive' ), 'mobile' );

	$transparent_color_h_site_title_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-h-site-title-responsive' ), 'desktop' );
	$transparent_color_h_site_title_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-h-site-title-responsive' ), 'tablet' );
	$transparent_color_h_site_title_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-header-color-h-site-title-responsive' ), 'mobile' );

	$transparent_menu_bg_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-menu-bg-color-responsive' ), 'desktop' );
	$transparent_menu_color_desktop    = smvmt_get_prop( smvmt_get_option( 'transparent-menu-color-responsive' ), 'desktop' );
	$transparent_menu_h_color_desktop  = smvmt_get_prop( smvmt_get_option( 'transparent-menu-h-color-responsive' ), 'desktop' );

	$transparent_menu_bg_color_tablet = smvmt_get_prop( smvmt_get_option( 'transparent-menu-bg-color-responsive' ), 'tablet' );
	$transparent_menu_color_tablet    = smvmt_get_prop( smvmt_get_option( 'transparent-menu-color-responsive' ), 'tablet' );
	$transparent_menu_h_color_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-menu-h-color-responsive' ), 'tablet' );

	$transparent_menu_bg_color_mobile = smvmt_get_prop( smvmt_get_option( 'transparent-menu-bg-color-responsive' ), 'mobile' );
	$transparent_menu_color_mobile    = smvmt_get_prop( smvmt_get_option( 'transparent-menu-color-responsive' ), 'mobile' );
	$transparent_menu_h_color_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-menu-h-color-responsive' ), 'mobile' );

	$transparent_sub_menu_color_desktop    = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-color-responsive' ), 'desktop' );
	$transparent_sub_menu_h_color_desktop  = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-h-color-responsive' ), 'desktop' );
	$transparent_sub_menu_bg_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-bg-color-responsive' ), 'desktop' );

	$transparent_sub_menu_color_tablet    = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-color-responsive' ), 'tablet' );
	$transparent_sub_menu_h_color_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-h-color-responsive' ), 'tablet' );
	$transparent_sub_menu_bg_color_tablet = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-bg-color-responsive' ), 'tablet' );

	$transparent_sub_menu_color_mobile    = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-color-responsive' ), 'mobile' );
	$transparent_sub_menu_h_color_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-h-color-responsive' ), 'mobile' );
	$transparent_sub_menu_bg_color_mobile = smvmt_get_prop( smvmt_get_option( 'transparent-submenu-bg-color-responsive' ), 'mobile' );

	$transparent_content_section_text_color_desktop   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-text-color-responsive' ), 'desktop' );
	$transparent_content_section_link_color_desktop   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-color-responsive' ), 'desktop' );
	$transparent_content_section_link_h_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-h-color-responsive' ), 'desktop' );

	$transparent_content_section_text_color_tablet   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-text-color-responsive' ), 'tablet' );
	$transparent_content_section_link_color_tablet   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-color-responsive' ), 'tablet' );
	$transparent_content_section_link_h_color_tablet = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-h-color-responsive' ), 'tablet' );

	$transparent_content_section_text_color_mobile   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-text-color-responsive' ), 'mobile' );
	$transparent_content_section_link_color_mobile   = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-color-responsive' ), 'mobile' );
	$transparent_content_section_link_h_color_mobile = smvmt_get_prop( smvmt_get_option( 'transparent-content-section-link-h-color-responsive' ), 'mobile' );

	/**
	 * Generate Dynamic CSS
	 */

	$css = '';
	/**
	 * Transparent Header Colors
	 */
	$transparent_header_desktop = array(
		'.smvmt-theme-transparent-header.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-theme-transparent-header .smvmt-below-header-actual-nav, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .slide-search .search-field' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .slide-search .search-field:focus' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),
		/**
		 * Below Header Navigation
		 */

		'.smvmt-theme-transparent-header .smvmt-below-header-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu' => array(
			'color' => esc_attr( $transparent_menu_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.focus > a' => array(
			'color' => esc_attr( $transparent_menu_h_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_h_color_desktop ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu'               => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu a' => array(
			'color' => esc_attr( $transparent_sub_menu_color_desktop ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.smvmt-theme-transparent-header .below-header-user-select, .smvmt-theme-transparent-header .below-header-user-select .widget,.smvmt-theme-transparent-header .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_desktop ),
		),

		'.smvmt-theme-transparent-header .below-header-user-select a, .smvmt-theme-transparent-header .below-header-user-select .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_desktop ),
		),

		'.smvmt-theme-transparent-header .below-header-user-select a:hover, .smvmt-theme-transparent-header .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_desktop ),
		),
	);

	$transparent_header_tablet = array(

		'.smvmt-theme-transparent-header.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-theme-transparent-header .smvmt-below-header-actual-nav, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .slide-search .search-field' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .slide-search .search-field:focus' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),
		/**
		 * Below Header Navigation
		 */

		'.smvmt-theme-transparent-header .smvmt-below-header-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu' => array(
			'color' => esc_attr( $transparent_menu_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.focus > a' => array(
			'color' => esc_attr( $transparent_menu_h_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_h_color_tablet ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu'               => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_tablet ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu a' => array(
			'color' => esc_attr( $transparent_sub_menu_color_tablet ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.smvmt-theme-transparent-header .below-header-user-select, .smvmt-theme-transparent-header .below-header-user-select .widget,.smvmt-theme-transparent-header .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_tablet ),
		),

		'.smvmt-theme-transparent-header .below-header-user-select a, .smvmt-theme-transparent-header .below-header-user-select .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_tablet ),
		),

		'.smvmt-theme-transparent-header .below-header-user-select a:hover, .smvmt-theme-transparent-header .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_tablet ),
		),
	);

	$transparent_header_mobile = array(

		'.smvmt-theme-transparent-header.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-theme-transparent-header .smvmt-below-header-actual-nav, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-below-header-actual-nav' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .slide-search .search-field' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .smvmt-below-header .slide-search .search-field:focus' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),
		/**
		 * Below Header Navigation
		 */

		'.smvmt-theme-transparent-header .smvmt-below-header-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu' => array(
			'color' => esc_attr( $transparent_menu_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.focus > a' => array(
			'color' => esc_attr( $transparent_menu_h_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_h_color_mobile ),
		),

		/**
		 * Below Header Dropdown Navigation
		 */

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu'               => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu a' => array(
			'color' => esc_attr( $transparent_sub_menu_color_mobile ),
		),

		/**
		 * Content Colors & Typography
		 */
		'.smvmt-theme-transparent-header .below-header-user-select, .smvmt-theme-transparent-header .below-header-user-select .widget,.smvmt-theme-transparent-header .below-header-user-select .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_mobile ),
		),

		'.smvmt-theme-transparent-header .below-header-user-select a, .smvmt-theme-transparent-header .below-header-user-select .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_mobile ),
		),

		'.smvmt-theme-transparent-header .below-header-user-select a:hover, .smvmt-theme-transparent-header .below-header-user-select .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_mobile ),
		),
	);

	/* Parse CSS from array() */
	$css .= smvmt_parse_css( $transparent_header_desktop );
	$css .= smvmt_parse_css( $transparent_header_tablet, '', '768' );
	$css .= smvmt_parse_css( $transparent_header_mobile, '', '544' );

	return $dynamic_css . $css;
}
