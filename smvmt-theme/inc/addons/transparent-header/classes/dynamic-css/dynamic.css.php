<?php
/**
 * Transparent Header - Dynamic CSS
 *
 * @package smvmt Addon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'SMVMT_dynamic_theme_css', 'SMVMT_ext_transparent_header_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  String $dynamic_css          smvmt Dynamic CSS.
 * @param  String $dynamic_css_filtered smvmt Dynamic CSS Filters.
 * @return String Dynamic CSS.
 */
function SMVMT_ext_transparent_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	if ( true != SMVMT_Ext_Transparent_Header_Markup::is_transparent_header() ) {
		return $dynamic_css;
	}

	/**
	 * Set colors
	 *
	 * If colors extension is_active then get color from it.
	 * Else set theme default colors.
	 */
	$transparent_header_separator       = smvmt_get_option( 'transparent-header-main-sep' );
	$transparent_header_separator_color = smvmt_get_option( 'transparent-header-main-sep-color' );

	$transparent_header_logo_width = smvmt_get_option( 'transparent-header-logo-width' );

	$transparent_header_inherit = smvmt_get_option( 'different-transparent-logo' );
	$transparent_header_logo    = smvmt_get_option( 'transparent-header-logo' );

	$transparent_bg_color_desktop = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'desktop' );
	$transparent_bg_color_tablet  = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'tablet', $transparent_bg_color_desktop );
	$transparent_bg_color_mobile  = smvmt_get_prop( smvmt_get_option( 'transparent-header-bg-color-responsive' ), 'mobile', ( $transparent_bg_color_tablet ) ? $transparent_bg_color_tablet : $transparent_bg_color_desktop );

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

	$transparent_header_devices = smvmt_get_option( 'transparent-header-on-devices' );

	/**
	 * Generate Dynamic CSS
	 */

	$css = '';

	if ( '0' === $transparent_header_inherit && '' != $transparent_header_logo ) {
		$css_output = array(
			'.smvmt-theme-transparent-header .site-logo-img .custom-logo-link' => array(
				'display' => 'none',
			),
		);
		$css       .= smvmt_parse_css( $css_output );
	}

	// Desktop Transparent Heder Logo Width.
	$css_output = array(
		'.smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .smvmt-logo-svg' => array(
			'width' => smvmt_get_css_value( $transparent_header_logo_width['desktop'], 'px' ),
		),
		'.smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img' => array(
			' max-width' => smvmt_get_css_value( $transparent_header_logo_width['desktop'], 'px' ),
		),
	);
	$css       .= smvmt_parse_css( $css_output );

	// Tablet Transparent Heder Logo Width.
	$tablet_css_output = array(
		'.smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .smvmt-logo-svg' => array(
			'width' => smvmt_get_css_value( $transparent_header_logo_width['tablet'], 'px' ),
		),
		'.smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img' => array(
			' max-width' => smvmt_get_css_value( $transparent_header_logo_width['tablet'], 'px' ),
		),
	);
	$css              .= smvmt_parse_css( $tablet_css_output, '', '768' );

	// Mobile Transparent Heder Logo Width.
	$mobile_css_output = array(
		'.smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .smvmt-logo-svg' => array(
			'width' => smvmt_get_css_value( $transparent_header_logo_width['mobile'], 'px' ),
		),
		'.smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img' => array(
			' max-width' => smvmt_get_css_value( $transparent_header_logo_width['mobile'], 'px' ),
		),
	);
	$css              .= smvmt_parse_css( $mobile_css_output, '', '543' );

	$transparent_header_base = array(
		'.smvmt-theme-transparent-header #masthead'         => array(
			'position' => 'absolute',
			'left'     => '0',
			'right'    => '0',
		),

		'.smvmt-theme-transparent-header .main-header-bar, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar' => array(
			'background' => 'none',
		),

		'body.elementor-editor-active.smvmt-theme-transparent-header #masthead, .fl-builder-edit .smvmt-theme-transparent-header #masthead, body.vc_editor.smvmt-theme-transparent-header #masthead, body.brz-ed.smvmt-theme-transparent-header #masthead' => array(
			'z-index' => '0',
		),

		'.smvmt-header-break-point.smvmt-replace-site-logo-transparent.smvmt-theme-transparent-header .custom-mobile-logo-link' => array(
			'display' => 'none',
		),

		'.smvmt-header-break-point.smvmt-replace-site-logo-transparent.smvmt-theme-transparent-header .transparent-custom-logo' => array(
			'display' => 'inline-block',
		),

		'.smvmt-theme-transparent-header .smvmt-above-header' => array(
			'background-image' => 'none',
			'background-color' => 'transparent',
		),

		'.smvmt-theme-transparent-header .smvmt-below-header' => array(
			'background-image' => 'none',
			'background-color' => 'transparent',
		),
	);

	/**
	 * Transparent Header Colors
	 */
	$transparent_header_desktop = array(

		'.smvmt-theme-transparent-header .main-header-bar, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-bar' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .main-header-bar .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header, .smvmt-theme-transparent-header .smvmt-below-header, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header' => array(
			'background-color' => esc_attr( $transparent_bg_color_desktop ),
		),

		'.smvmt-theme-transparent-header .site-title a, .smvmt-theme-transparent-header .site-title a:focus, .smvmt-theme-transparent-header .site-title a:hover, .smvmt-theme-transparent-header .site-title a:visited' => array(
			'color' => esc_attr( $transparent_color_site_title_desktop ),
		),
		'.smvmt-theme-transparent-header .site-header .site-title a:hover' => array(
			'color' => esc_attr( $transparent_color_h_site_title_desktop ),
		),

		'.smvmt-theme-transparent-header .site-header .site-description' => array(
			'color' => esc_attr( $transparent_color_site_title_desktop ),
		),

		'.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-flyout-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation-wrap .smvmt-above-header-navigation, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-navigation-wrap .smvmt-below-header-actual-nav, .smvmt-fullscreen-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation-wrap, .smvmt-fullscreen-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-navigation-wrap' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu, .smvmt-header-break-point.smvmt-flyout-menu-enable.smvmt-header-break-point .main-header-bar-navigation .main-header-menu ul.sub-menu' => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_desktop ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_color_desktop ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu a:hover,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_desktop ),
		),
		'.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header .main-header-menu a, .smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items a,.smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_color_desktop ),
		),
		'.smvmt-theme-transparent-header .main-header-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header .main-header-menu .focus > a, .smvmt-theme-transparent-header .main-header-menu .focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > a, .smvmt-theme-transparent-header .main-header-menu .current_page_item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current_page_item > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_h_color_desktop ),
		),
		// Content Section text color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_desktop ),
		),
		// Content Section link color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_desktop ),
		),
		// Content Section link hover color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_desktop ),
		),
	);

	$transparent_header_tablet = array(

		'.smvmt-theme-transparent-header .main-header-bar, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-bar' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .main-header-bar .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .smvmt-above-header, .smvmt-theme-transparent-header .smvmt-below-header, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header' => array(
			'background-color' => esc_attr( $transparent_bg_color_tablet ),
		),

		'.smvmt-theme-transparent-header .site-title a, .smvmt-theme-transparent-header .site-title a:focus, .smvmt-theme-transparent-header .site-title a:hover, .smvmt-theme-transparent-header .site-title a:visited' => array(
			'color' => esc_attr( $transparent_color_site_title_tablet ),
		),
		'.smvmt-theme-transparent-header .site-header .site-title a:hover' => array(
			'color' => esc_attr( $transparent_color_h_site_title_tablet ),
		),

		'.smvmt-theme-transparent-header .site-header .site-description' => array(
			'color' => esc_attr( $transparent_color_site_title_tablet ),
		),

		'.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-flyout-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation-wrap .smvmt-above-header-navigation, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-navigation-wrap .smvmt-below-header-actual-nav, .smvmt-fullscreen-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation-wrap, .smvmt-fullscreen-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-navigation-wrap' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu, .smvmt-header-break-point.smvmt-flyout-menu-enable.smvmt-header-break-point .main-header-bar-navigation .main-header-menu ul.sub-menu' => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_tablet ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_color_tablet ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu a:hover,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_tablet ),
		),
		'.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header .main-header-menu a, .smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items a,.smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_color_tablet ),
		),
		'.smvmt-theme-transparent-header .main-header-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header .main-header-menu .focus > a, .smvmt-theme-transparent-header .main-header-menu .focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > a, .smvmt-theme-transparent-header .main-header-menu .current_page_item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current_page_item > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_h_color_tablet ),
		),
		// Content Section text color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_tablet ),
		),
		// Content Section link color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_tablet ),
		),
		// Content Section link hover color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_tablet ),
		),
	);

	$transparent_header_mobile = array(

		'.smvmt-theme-transparent-header .main-header-bar, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-bar' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .main-header-bar .smvmt-search-menu-icon form' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),

		'.smvmt-theme-transparent-header .smvmt-above-header, .smvmt-theme-transparent-header .smvmt-below-header, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header' => array(
			'background-color' => esc_attr( $transparent_bg_color_mobile ),
		),

		'.smvmt-theme-transparent-header .site-title a, .smvmt-theme-transparent-header .site-title a:focus, .smvmt-theme-transparent-header .site-title a:hover, .smvmt-theme-transparent-header .site-title a:visited' => array(
			'color' => esc_attr( $transparent_color_site_title_mobile ),
		),
		'.smvmt-theme-transparent-header .site-header .site-title a:hover' => array(
			'color' => esc_attr( $transparent_color_h_site_title_mobile ),
		),

		'.smvmt-theme-transparent-header .site-header .site-description' => array(
			'color' => esc_attr( $transparent_color_site_title_mobile ),
		),

		'.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-flyout-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation-wrap .smvmt-above-header-navigation, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-navigation-wrap .smvmt-below-header-actual-nav, .smvmt-fullscreen-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation-wrap, .smvmt-fullscreen-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-navigation-wrap' => array(
			'background-color' => esc_attr( $transparent_menu_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu, .smvmt-header-break-point.smvmt-flyout-menu-enable.smvmt-header-break-point .main-header-bar-navigation .main-header-menu ul.sub-menu' => array(
			'background-color' => esc_attr( $transparent_sub_menu_bg_color_mobile ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_color_mobile ),
		),
		'.smvmt-theme-transparent-header .main-header-menu ul.sub-menu a:hover,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_sub_menu_h_color_mobile ),
		),
		'.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header .main-header-menu a, .smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items a,.smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_color_mobile ),
		),
		'.smvmt-theme-transparent-header .main-header-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header .main-header-menu .focus > a, .smvmt-theme-transparent-header .main-header-menu .focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > a, .smvmt-theme-transparent-header .main-header-menu .current_page_item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current_page_item > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $transparent_menu_h_color_mobile ),
		),
		// Content Section text color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget-title' => array(
			'color' => esc_attr( $transparent_content_section_text_color_mobile ),
		),
		// Content Section link color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a' => array(
			'color' => esc_attr( $transparent_content_section_link_color_mobile ),
		),
		// Content Section link hover color.
		'.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
			'color' => esc_attr( $transparent_content_section_link_h_color_mobile ),
		),
	);

	/* Parse CSS from array() */
	if ( 'both' === $transparent_header_devices || 'desktop' === $transparent_header_devices ) {
		$css .= smvmt_parse_css( $transparent_header_base, '769' );

		// If Transparent header is active on mobile + desktop, enqueue CSS without media queeries.
		// If only for desktop add media query for the transparent header.
		if ( 'both' === $transparent_header_devices ) {
			$css .= smvmt_parse_css( $transparent_header_desktop );
		} else {
			$css .= smvmt_parse_css( $transparent_header_desktop, '769' );
		}
	}

	if ( 'mobile' === $transparent_header_devices ) {
		$css .= smvmt_parse_css(
			array(
				'.transparent-custom-logo' => array(
					'display' => 'none',
				),
			),
			'768'
		);

		$css .= smvmt_parse_css(
			array(
				'.transparent-custom-logo' => array(
					'display' => 'block',
				),
			),
			'',
			'768'
		);

		$css .= smvmt_parse_css(
			array(
				'.smvmt-transparent-desktop-logo' => array(
					'display' => 'none',
				),
			),
			'',
			'768'
		);
	}

	if ( 'desktop' === $transparent_header_devices ) {
		$css .= smvmt_parse_css(
			array(
				'.transparent-custom-logo' => array(
					'display' => 'none',
				),
			),
			'',
			'768'
		);

		$css .= smvmt_parse_css(
			array(
				'.smvmt-transparent-mobile-logo' => array(
					'display' => 'none',
				),
			),
			'768'
		);

		$css .= smvmt_parse_css(
			array(
				'.smvmt-transparent-mobile-logo' => array(
					'display' => 'block',
				),
			),
			'',
			'768'
		);
	}

	if ( 'both' === $transparent_header_devices || 'mobile' === $transparent_header_devices ) {
		$css .= smvmt_parse_css( $transparent_header_base, '', '768' );
		$css .= smvmt_parse_css( $transparent_header_tablet, '', '768' );
		$css .= smvmt_parse_css( $transparent_header_mobile, '', '544' );
	}

	if ( 'both' === $transparent_header_devices ) {
		$css .= smvmt_parse_css(
			array(
				'.smvmt-theme-transparent-header .main-header-bar, .smvmt-theme-transparent-header .site-header' => array(
					'border-bottom-width' => smvmt_get_css_value( $transparent_header_separator, 'px' ),
					'border-bottom-color' => esc_attr( $transparent_header_separator_color ),
				),
			)
		);
	}

	if ( 'mobile' === $transparent_header_devices ) {
		$css .= smvmt_parse_css(
			array(
				'.smvmt-theme-transparent-header .site-header' => array(
					'border-bottom-width' => smvmt_get_css_value( $transparent_header_separator, 'px' ),
					'border-bottom-color' => esc_attr( $transparent_header_separator_color ),
				),
			),
			'',
			'768'
		);
	}

	if ( 'desktop' === $transparent_header_devices ) {
		$css .= smvmt_parse_css(
			array(
				'.smvmt-theme-transparent-header .main-header-bar' => array(
					'border-bottom-width' => smvmt_get_css_value( $transparent_header_separator, 'px' ),
					'border-bottom-color' => esc_attr( $transparent_header_separator_color ),
				),
			),
			'768'
		);
	}

	$dynamic_css .= $css;

	return $dynamic_css;
}
