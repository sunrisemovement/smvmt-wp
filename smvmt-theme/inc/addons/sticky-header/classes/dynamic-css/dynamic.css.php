<?php
/**
 * Transparent Header - Dynamic CSS
 *
 * @package smvmt
 */

add_filter( 'smvmt_dynamic_css', 'smvmt_ext_sticky_header_dynamic_css', 30 );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function smvmt_ext_sticky_header_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	/**
	 * Set colors
	 *
	 * If colors extension is_active then get color from it.
	 * Else set theme default colors.
	 */
	$stick_header            = smvmt_get_option_meta( 'stick-header-meta' );
	$stick_header_main_meta  = smvmt_get_option_meta( 'header-main-stick-meta' );
	$stick_header_above_meta = smvmt_get_option_meta( 'header-above-stick-meta' );
	$stick_header_below_meta = smvmt_get_option_meta( 'header-below-stick-meta' );

	$stick_header_main  = smvmt_get_option( 'header-main-stick' );
	$stick_header_above = smvmt_get_option( 'header-above-stick' );
	$stick_header_below = smvmt_get_option( 'header-below-stick' );

	$sticky_header_style   = smvmt_get_option( 'sticky-header-style' );
	$sticky_hide_on_scroll = smvmt_get_option( 'sticky-hide-on-scroll' );

	$sticky_header_logo_width = smvmt_get_option( 'sticky-header-logo-width' );
	// Old Log Width Option that we are no loginer using it our theme.
	$header_logo_width            = smvmt_get_option( 'smvmt-header-logo-width' );
	$header_responsive_logo_width = smvmt_get_option( 'smvmt-header-responsive-logo-width' );

	$site_layout = smvmt_get_option( 'site-layout' );

	$header_color_site_title = '#222';
	$text_color              = smvmt_get_option( 'text-color' );
	$link_color              = smvmt_get_option( 'link-color' );

	$sticky_header_logo_different = smvmt_get_option( 'different-sticky-logo' );
	$sticky_header_logo           = smvmt_get_option( 'sticky-header-logo' );

	// Compatible with header full width.
	$header_break_point = smvmt_header_break_point();
	$smvmt_header_width = smvmt_get_option( 'header-main-layout-width' );

	// Sticky Header Background colors.
	$text_color = smvmt_get_option( 'text-color' );
	$link_color = smvmt_get_option( 'link-color' );

	$desktop_sticky_header_bg_color = smvmt_get_prop( smvmt_get_option( 'sticky-header-bg-color-responsive' ), 'desktop', '#ffffff' );
	$tablet_sticky_header_bg_color  = smvmt_get_prop( smvmt_get_option( 'sticky-header-bg-color-responsive' ), 'tablet' );
	$mobile_sticky_header_bg_color  = smvmt_get_prop( smvmt_get_option( 'sticky-header-bg-color-responsive' ), 'mobile' );

	$sticky_header_menu_bg_color = smvmt_get_option( 'sticky-header-menu-bg-color-responsive' );

	$desktop_sticky_header_color_site_title = smvmt_get_prop( smvmt_get_option( 'sticky-header-color-site-title-responsive' ), 'desktop', '#222' );
	$tablet_sticky_header_color_site_title  = smvmt_get_prop( smvmt_get_option( 'sticky-header-color-site-title-responsive' ), 'tablet' );
	$mobile_sticky_header_color_site_title  = smvmt_get_prop( smvmt_get_option( 'sticky-header-color-site-title-responsive' ), 'mobile' );

	$sticky_header_color_h_site_title = smvmt_get_option( 'sticky-header-color-h-site-title-responsive' );

	$desktop_sticky_header_color_site_tagline = smvmt_get_prop( smvmt_get_option( 'sticky-header-color-site-tagline-responsive' ), 'desktop', $text_color );
	$tablet_sticky_header_color_site_tagline  = smvmt_get_prop( smvmt_get_option( 'sticky-header-color-site-tagline-responsive' ), 'tablet' );
	$mobile_sticky_header_color_site_tagline  = smvmt_get_prop( smvmt_get_option( 'sticky-header-color-site-tagline-responsive' ), 'mobile' );

	$desktop_sticky_primary_menu_color = smvmt_get_prop( smvmt_get_option( 'sticky-header-menu-color-responsive' ), 'desktop' );
	$tablet_sticky_primary_menu_color  = smvmt_get_prop( smvmt_get_option( 'sticky-header-menu-color-responsive' ), 'tablet' );
	$mobile_sticky_primary_menu_color  = smvmt_get_prop( smvmt_get_option( 'sticky-header-menu-color-responsive' ), 'mobile' );

	$desktop_sticky_primary_menu_h_color = smvmt_get_prop( smvmt_get_option( 'sticky-header-menu-h-color-responsive' ), 'desktop' );
	$tablet_sticky_primary_menu_h_color  = smvmt_get_prop( smvmt_get_option( 'sticky-header-menu-h-color-responsive' ), 'tablet' );
	$mobile_sticky_primary_menu_h_color  = smvmt_get_prop( smvmt_get_option( 'sticky-header-menu-h-color-responsive' ), 'mobile' );

	$sticky_header_menu_h_a_bg_color = smvmt_get_option( 'sticky-header-menu-h-a-bg-color-responsive' );

	$sticky_header_submenu_bg_color      = smvmt_get_option( 'sticky-header-submenu-bg-color-responsive' );
	$sticky_primary_submenu_color        = smvmt_get_option( 'sticky-header-submenu-color-responsive' );
	$sticky_primary_submenu_h_color      = smvmt_get_option( 'sticky-header-submenu-h-color-responsive' );
	$sticky_primary_submenu_h_a_bg_color = smvmt_get_option( 'sticky-header-submenu-h-a-bg-color-responsive' );

	$sticky_header_content_section_text_color   = smvmt_get_option( 'sticky-header-content-section-text-color-responsive' );
	$sticky_header_content_section_link_color   = smvmt_get_option( 'sticky-header-content-section-link-color-responsive' );
	$sticky_header_content_section_link_h_color = smvmt_get_option( 'sticky-header-content-section-link-h-color-responsive' );

	$header_custom_button_style                 = smvmt_get_option( 'header-main-rt-section-button-style' );
	$header_custom_sticky_button_text_color     = smvmt_get_option( 'header-main-rt-sticky-section-button-text-color' );
	$header_custom_sticky_button_text_h_color   = smvmt_get_option( 'header-main-rt-sticky-section-button-text-h-color' );
	$header_custom_sticky_button_back_color     = smvmt_get_option( 'header-main-rt-sticky-section-button-back-color' );
	$header_custom_sticky_button_back_h_color   = smvmt_get_option( 'header-main-rt-sticky-section-button-back-h-color' );
	$header_custom_sticky_button_spacing        = smvmt_get_option( 'header-main-rt-sticky-section-button-padding' );
	$header_custom_sticky_button_radius         = smvmt_get_option( 'header-main-rt-sticky-section-button-border-radius' );
	$header_custom_sticky_button_border_color   = smvmt_get_option( 'header-main-rt-sticky-section-button-border-color' );
	$header_custom_sticky_button_border_h_color = smvmt_get_option( 'header-main-rt-sticky-section-button-border-h-color' );
	$header_custom_sticky_button_border_size    = smvmt_get_option( 'header-main-rt-sticky-section-button-border-size' );

	if ( ! $stick_header_main && ! $stick_header_above && ! $stick_header_below && ( 'disabled' !== $stick_header && empty( $stick_header ) && ( empty( $stick_header_above_meta ) || empty( $stick_header_below_meta ) || empty( $stick_header_main_meta ) ) ) ) {
		return $dynamic_css;
	}

	$parse_css = '';

	/**
	 * Sticky Header
	 *
	 * [1]. Apply default colors from theme for sticky header.
	 * [2]. Hide Sticky Header logo if Sticky Header logo is not enabled.
	 * [3]. Sticky Header Logo responsive widths.
	 * [4]. Compatible with Header Width.
	 * [5]. Stciky Header & Sticky Header Primary menu background color.
	 */

	/**
	 * [1]. Apply default colors from theme for sticky header.
	 */
	$css_output = array(
		'#smvmt-fixed-header .main-header-bar .site-title a, #smvmt-fixed-header .main-header-bar .site-title a:focus, #smvmt-fixed-header .main-header-bar .site-title a:hover, #smvmt-fixed-header .main-header-bar .site-title a:visited, .main-header-bar.smvmt-sticky-active .site-title a, .main-header-bar.smvmt-sticky-active .site-title a:focus, .main-header-bar.smvmt-sticky-active .site-title a:hover, .main-header-bar.smvmt-sticky-active .site-title a:visited' => array(
			'color' => esc_attr( $header_color_site_title ),
		),
		'#smvmt-fixed-header .main-header-bar .site-description, .main-header-bar.smvmt-sticky-active .site-description' => array(
			'color' => esc_attr( $text_color ),
		),

		'#smvmt-fixed-header .main-header-menu > li.current-menu-item > a, #smvmt-fixed-header .main-header-menu >li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu > li.current_page_item > a, .main-header-bar.smvmt-sticky-active .main-header-menu > li.current-menu-item > a, .main-header-bar.smvmt-sticky-active .main-header-menu >li.current-menu-ancestor > a, .main-header-bar.smvmt-sticky-active .main-header-menu > li.current_page_item > a' => array(
			'color' => esc_attr( $link_color ),
		),

		'#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu > li > a, #smvmt-fixed-header .smvmt-masthead-custom-menu-items, #smvmt-fixed-header .smvmt-masthead-custom-menu-items a, .main-header-bar.smvmt-sticky-active, .main-header-bar.smvmt-sticky-active .main-header-menu > li > a, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items a' => array(
			'color' => esc_attr( $text_color ),
		),
		'#smvmt-fixed-header .main-header-menu a:hover, #smvmt-fixed-header .main-header-menu li:hover > a, #smvmt-fixed-header .main-header-menu li.focus > a, .main-header-bar.smvmt-sticky-active .main-header-menu li:hover > a, .main-header-bar.smvmt-sticky-active .main-header-menu li.focus > a' => array(
			'color' => esc_attr( $link_color ),
		),
		'#smvmt-fixed-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header .main-header-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu li.focus > .smvmt-menu-toggle,.main-header-bar.smvmt-sticky-active .main-header-menu li:hover > .smvmt-menu-toggle,.main-header-bar.smvmt-sticky-active .main-header-menu li.focus > .smvmt-menu-toggle' => array(
			'color' => esc_attr( $link_color ),
		),
	);

	/* Parse CSS from array() */
	$parse_css .= smvmt_parse_css( $css_output );

	/**
	 * [2]. Hide Sticky Header logo if Sticky Header logo is not enabled.
	 */
	if ( '0' === $sticky_header_logo_different && '' != $sticky_header_logo ) {
		$css_output = array(
			'.smvmt-sticky-active .site-logo-img .custom-logo' => array(
				'display' => 'none',
			),
		);
		$parse_css .= smvmt_parse_css( $css_output );
	}

	/**
	 * [3]. Sticky Header Logo responsive widths
	 */
		// Desktop Sticky Header Logo width.
		$desktop_css_output = array(
			'#masthead .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .smvmt-sticky-main-shrink .smvmt-sticky-shrunk .site-logo-img .smvmt-logo-svg' => array(
				'width' => smvmt_get_css_value( $sticky_header_logo_width['desktop'], 'px' ),
			),
			'.site-logo-img .sticky-custom-logo img' => array(
				'max-width' => smvmt_get_css_value( $sticky_header_logo_width['desktop'], 'px' ),
			),
		);
		$parse_css         .= smvmt_parse_css( $desktop_css_output );

		// Tablet Sticky Header Logo width.
		$tablet_css_output = array(
			'#masthead .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .smvmt-sticky-main-shrink .smvmt-sticky-shrunk .site-logo-img .smvmt-logo-svg' => array(
				'width' => smvmt_get_css_value( $sticky_header_logo_width['tablet'], 'px' ),
			),
			'.site-logo-img .sticky-custom-logo img' => array(
				'max-width' => smvmt_get_css_value( $sticky_header_logo_width['tablet'], 'px' ),
			),
		);
		$parse_css        .= smvmt_parse_css( $tablet_css_output, '', '768' );

		// Mobile Sticky Header Logo width.
		$mobile_css_output = array(
			'#masthead .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .smvmt-sticky-main-shrink .smvmt-sticky-shrunk .site-logo-img .smvmt-logo-svg' => array(
				'width' => smvmt_get_css_value( $sticky_header_logo_width['mobile'], 'px' ),
			),
			'.site-logo-img .sticky-custom-logo img' => array(
				'max-width' => smvmt_get_css_value( $sticky_header_logo_width['mobile'], 'px' ),
			),
		);
		$parse_css        .= smvmt_parse_css( $mobile_css_output, '', '543' );

		// Theme Main Logo width option for responsive devices.
		if ( is_array( $header_responsive_logo_width ) ) {
			/* Responsive main logo width */
			$responsive_logo_output = array(
				'#masthead .site-logo-img .smvmt-logo-svg, .smvmt-header-break-point #smvmt-fixed-header .site-logo-img .custom-logo-link img ' => array(
					'max-width' => smvmt_get_css_value( $header_responsive_logo_width['desktop'], 'px' ),
				),
			);
			$parse_css             .= smvmt_parse_css( $responsive_logo_output );

			$responsive_logo_output_tablet = array(
				'#masthead .site-logo-img .smvmt-logo-svg, .smvmt-header-break-point #smvmt-fixed-header .site-logo-img .custom-logo-link img ' => array(
					'max-width' => smvmt_get_css_value( $header_responsive_logo_width['tablet'], 'px' ),
				),
			);
			$parse_css                    .= smvmt_parse_css( $responsive_logo_output_tablet, '', '768' );

			$responsive_logo_output_mobile = array(
				'#masthead .site-logo-img .smvmt-logo-svg, .smvmt-header-break-point #smvmt-fixed-header .site-logo-img .custom-logo-link img ' => array(
					'max-width' => smvmt_get_css_value( $header_responsive_logo_width['mobile'], 'px' ),
				),
			);
			$parse_css                    .= smvmt_parse_css( $responsive_logo_output_mobile, '', '543' );
		} else {
			/* Old main logo width */
			$logo_output = array(
				'#masthead .site-logo-img .smvmt-logo-svg' => array(
					'width' => smvmt_get_css_value( $header_logo_width, 'px' ),
				),
			);
			/* Parse CSS from array() */
			$parse_css .= smvmt_parse_css( $logo_output );
		}

		/**
		 * [4]. Compatible with Header Width
		 */
		if ( 'content' != $smvmt_header_width ) {

			$general_global_responsive = array(
				'#smvmt-fixed-header .smvmt-container' => array(
					'max-width'     => '100%',
					'padding-left'  => '35px',
					'padding-right' => '35px',
				),
			);
			$padding_below_breakpoint  = array(
				'#smvmt-fixed-header .smvmt-container' => array(
					'padding-left'  => '20px',
					'padding-right' => '20px',
				),
			);

			/* Parse CSS from array()*/
			$parse_css .= smvmt_parse_css( $general_global_responsive );
			$parse_css .= smvmt_parse_css( $padding_below_breakpoint, '', $header_break_point );
		}

		/**
		 * [5]. Stciky Header & Sticky Header Primary menu colors.
		 */

		if ( 'none' === $sticky_header_style && ! $sticky_hide_on_scroll ) {
			$desktop_css_output = array(
				/**
				 * Header
				 */
				'.smvmt-primary-sticky-header-active .site-title a, .smvmt-primary-sticky-header-active .site-title a:focus, .smvmt-primary-sticky-header-active .site-title a:hover, .smvmt-primary-sticky-header-active .site-title a:visited' => array(
					'color' => esc_attr( $desktop_sticky_header_color_site_title ),
				),
				'.smvmt-primary-sticky-header-active .site-header .site-title a:hover'           => array(
					'color' => esc_attr( $sticky_header_color_h_site_title['desktop'] ),
				),
				'.smvmt-primary-sticky-header-active .site-header .site-description'             => array(
					'color' => esc_attr( $desktop_sticky_header_color_site_tagline ),
				),
				'.smvmt-transparent-header.smvmt-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .smvmt-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .smvmt-primary-sticky-header-active.smvmt-header-break-point .main-header-bar-wrap .main-header-bar'                      => array(
					'background' => esc_attr( $desktop_sticky_header_bg_color ),
				),
				/**
				 * Primary Header Menu
				 */

				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation' => array(
					'background-color' => esc_attr( $sticky_header_menu_bg_color['desktop'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu li.current_page_item > a' => array(
					'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu a:hover, .smvmt-header-custom-item a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu li.focus > a, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a:hover, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a:focus' => array(
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
					'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $desktop_sticky_primary_menu_h_color ),
				),

				'.smvmt-primary-sticky-header-active .main-header-menu, .smvmt-primary-sticky-header-active .main-header-menu a, .smvmt-primary-sticky-header-active .smvmt-header-custom-item, .smvmt-header-custom-item a, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a' => array(
					'color' => esc_attr( $desktop_sticky_primary_menu_color ),
				),

				'.smvmt-primary-sticky-header-active .smvmt-masthead-custom-menu-items .smvmt-inline-search form' => array(
					'border-color' => esc_attr( $desktop_sticky_primary_menu_color ),
				),
				/**
				 * Primary Submenu
				 */
					'.smvmt-primary-sticky-header-active .main-navigation ul ul.sub-menu, .smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul' => array(
						'background-color' => esc_attr( $sticky_header_submenu_bg_color['desktop'] ),
					),
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .children a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_color['desktop'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .sub-menu a:hover, .smvmt-primary-sticky-header-active .main-header-menu .children a:hover, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .children li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.focus > a' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .children li.current_page_ancestor > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.current_page_item > .smvmt-menu-toggle' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
				),

				// Content Section text color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget-title' => array(
					'color' => esc_attr( $sticky_header_content_section_text_color['desktop'] ),
				),
				// Content Section link color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a' => array(
					'color' => esc_attr( $sticky_header_content_section_link_color['desktop'] ),
				),
				// Content Section link hover color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
					'color' => esc_attr( $sticky_header_content_section_link_h_color['desktop'] ),
				),
			);
			$tablet_css_output = array(

				/**
				 * Header
				 */
				'.smvmt-primary-sticky-header-active .site-title a, .smvmt-primary-sticky-header-active .site-title a:focus, .smvmt-primary-sticky-header-active .site-title a:hover, .smvmt-primary-sticky-header-active .site-title a:visited' => array(
					'color' => esc_attr( $tablet_sticky_header_color_site_title ),
				),
				'.smvmt-primary-sticky-header-active .site-header .site-title a:hover'           => array(
					'color' => esc_attr( $sticky_header_color_h_site_title['tablet'] ),
				),
				'.smvmt-primary-sticky-header-active .site-header .site-description'             => array(
					'color' => esc_attr( $tablet_sticky_header_color_site_tagline ),
				),
				'.smvmt-transparent-header.smvmt-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .smvmt-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .smvmt-primary-sticky-header-active.smvmt-header-break-point .main-header-bar-wrap .main-header-bar'                      => array(
					'background' => esc_attr( $tablet_sticky_header_bg_color ),
				),
				/**
				 * Primary Header Menu
				 */
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation' => array(
					'background-color' => esc_attr( $sticky_header_menu_bg_color['tablet'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu li.current_page_item > a' => array(
					'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu a:hover, .smvmt-header-custom-item a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu li.focus > a, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a:hover, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a:focus' => array(
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
					'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $tablet_sticky_primary_menu_h_color ),
				),

				'.smvmt-primary-sticky-header-active .main-header-menu, .smvmt-primary-sticky-header-active .main-header-menu a, .smvmt-primary-sticky-header-active .smvmt-header-custom-item, .smvmt-header-custom-item a, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a' => array(
					'color' => esc_attr( $tablet_sticky_primary_menu_color ),
				),

				'.smvmt-primary-sticky-header-active .smvmt-masthead-custom-menu-items .smvmt-inline-search form' => array(
					'border-color' => esc_attr( $tablet_sticky_primary_menu_color ),
				),
				/**
				 * Primary Submenu
				 */
					'.smvmt-primary-sticky-header-active .main-navigation ul ul.sub-menu, .smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul' => array(
						'background-color' => esc_attr( $sticky_header_submenu_bg_color['tablet'] ),
					),
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .children a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_color['tablet'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .sub-menu a:hover, .smvmt-primary-sticky-header-active .main-header-menu .children a:hover, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .children li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.focus > a' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.current_page_item > .smvmt-menu-toggle' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
				),

				// Content Section text color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget-title' => array(
					'color' => esc_attr( $sticky_header_content_section_text_color['tablet'] ),
				),
				// Content Section link color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a' => array(
					'color' => esc_attr( $sticky_header_content_section_link_color['tablet'] ),
				),
				// Content Section link hover color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
					'color' => esc_attr( $sticky_header_content_section_link_h_color['tablet'] ),
				),
			);
			$mobile_css_output = array(

				/**
				 * Header
				 */
					'.smvmt-primary-sticky-header-active .site-title a, .smvmt-primary-sticky-header-active .site-title a:focus, .smvmt-primary-sticky-header-active .site-title a:hover, .smvmt-primary-sticky-header-active .site-title a:visited' => array(
						'color' => esc_attr( $mobile_sticky_header_color_site_title ),
					),
				'.smvmt-primary-sticky-header-active .site-header .site-title a:hover'           => array(
					'color' => esc_attr( $sticky_header_color_h_site_title['mobile'] ),
				),
				'.smvmt-primary-sticky-header-active .site-header .site-description'             => array(
					'color' => esc_attr( $mobile_sticky_header_color_site_tagline ),
				),
				'.smvmt-transparent-header.smvmt-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .smvmt-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .smvmt-primary-sticky-header-active.smvmt-header-break-point .main-header-bar-wrap .main-header-bar'                      => array(
					'background' => esc_attr( $mobile_sticky_header_bg_color ),
				),
				/**
				 * Primary Header Menu
				 */
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation' => array(
					'background-color' => esc_attr( $sticky_header_menu_bg_color['mobile'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu li.current_page_item > a' => array(
					'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu a:hover, .smvmt-header-custom-item a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu li.focus > a, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a:hover, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a:focus' => array(
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
					'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $mobile_sticky_primary_menu_h_color ),
				),

				'.smvmt-primary-sticky-header-active .main-header-menu, .smvmt-primary-sticky-header-active .main-header-menu a, .smvmt-primary-sticky-header-active .smvmt-header-custom-item, .smvmt-header-custom-item a, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active.smvmt-advanced-headers .main-header-menu > li > a' => array(
					'color' => esc_attr( $mobile_sticky_primary_menu_color ),
				),

				'.smvmt-primary-sticky-header-active .smvmt-masthead-custom-menu-items .smvmt-inline-search form' => array(
					'border-color' => esc_attr( $mobile_sticky_primary_menu_color ),
				),
				/**
				 * Primary Submenu
				 */
					'.smvmt-primary-sticky-header-active .main-navigation ul ul.sub-menu, .smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul' => array(
						'background-color' => esc_attr( $sticky_header_submenu_bg_color['mobile'] ),
					),
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .children a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_color['mobile'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .sub-menu a:hover, .smvmt-primary-sticky-header-active .main-header-menu .children a:hover, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .children li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.focus > a' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
				),
				'.smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li.current_page_item > .smvmt-menu-toggle' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
				),

				// Content Section text color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget-title' => array(
					'color' => esc_attr( $sticky_header_content_section_text_color['mobile'] ),
				),
				// Content Section link color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a' => array(
					'color' => esc_attr( $sticky_header_content_section_link_color['mobile'] ),
				),
				// Content Section link hover color.
				'.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
					'color' => esc_attr( $sticky_header_content_section_link_h_color['mobile'] ),
				),
			);
		} else {
			// Only when Fixed Header Merkup added.
			$desktop_css_output = array(

				/**
				 * Header
				 */
				'#smvmt-fixed-header .site-title a, #smvmt-fixed-header .site-title a:focus, #smvmt-fixed-header .site-title a:hover, #smvmt-fixed-header .site-title a:visited' => array(
					'color' => esc_attr( $desktop_sticky_header_color_site_title ),
				),
				'#smvmt-fixed-header.site-header .site-title a:hover' => array(
					'color' => esc_attr( $sticky_header_color_h_site_title['desktop'] ),
				),
				'#smvmt-fixed-header.site-header .site-description' => array(
					'color' => esc_attr( $desktop_sticky_header_color_site_tagline ),
				),
				'.smvmt-transparent-header #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field:focus' => array(
					'background-color' => esc_attr( $desktop_sticky_header_bg_color ),
				),
				/**
				 * Primary Header Menu
				 */
					'#smvmt-fixed-header .main-header-menu' => array(
						'background' => esc_attr( $sticky_header_menu_bg_color['desktop'] ),
					),
				'#smvmt-fixed-header .main-header-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu li.current_page_item > a' => array(
					'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
				),
				'#smvmt-fixed-header .main-header-menu a:hover, .smvmt-header-custom-item a:hover, #smvmt-fixed-header .main-header-menu li:hover > a, #smvmt-fixed-header .main-header-menu li.focus > a' => array(
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['desktop'] ),
					'color'            => esc_attr( $desktop_sticky_primary_menu_h_color ),
				),
				'#smvmt-fixed-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header .main-header-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $desktop_sticky_primary_menu_h_color ),
				),

				'#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu a, #smvmt-fixed-header .smvmt-header-custom-item, .smvmt-header-custom-item a, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items a' => array(
					'color' => esc_attr( $desktop_sticky_primary_menu_color ),
				),

				'#smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search form' => array(
					'border-color' => esc_attr( $desktop_sticky_primary_menu_color ),
				),
				/**
				 * Primary Submenu
				 */
					'#smvmt-fixed-header .main-navigation ul ul.sub-menu, .smvmt-header-break-point#smvmt-fixed-header .main-header-menu ul' => array(
						'background-color' => esc_attr( $sticky_header_submenu_bg_color['desktop'] ),
					),
				'#smvmt-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu .children a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_color['desktop'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu a:hover, #smvmt-fixed-header .main-header-menu .children a:hover, #smvmt-fixed-header .main-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .main-header-menu .children li:hover > a, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > a, #smvmt-fixed-header .main-header-menu .children li.focus > a' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu .children li.current_page_ancestor > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current_page_item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu li.current_page_item > .smvmt-menu-toggle' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['desktop'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['desktop'] ),
				),
				// Content Section text color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget-title' => array(
					'color' => esc_attr( $sticky_header_content_section_text_color['desktop'] ),
				),
				// Content Section link color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a' => array(
					'color' => esc_attr( $sticky_header_content_section_link_color['desktop'] ),
				),
				// Content Section link hover color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
					'color' => esc_attr( $sticky_header_content_section_link_h_color['desktop'] ),
				),
			);
			$tablet_css_output = array(

				/**
				 * Header
				 */
				'#smvmt-fixed-header .site-title a, #smvmt-fixed-header .site-title a:focus, #smvmt-fixed-header .site-title a:hover, #smvmt-fixed-header .site-title a:visited' => array(
					'color' => esc_attr( $tablet_sticky_header_color_site_title ),
				),
				'#smvmt-fixed-header.site-header .site-title a:hover' => array(
					'color' => esc_attr( $sticky_header_color_h_site_title['tablet'] ),
				),
				'#smvmt-fixed-header.site-header .site-description' => array(
					'color' => esc_attr( $tablet_sticky_header_color_site_tagline ),
				),
				'.smvmt-transparent-header #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field:focus' => array(
					'background-color' => esc_attr( $tablet_sticky_header_bg_color ),
				),
				/**
				 * Primary Header Menu
				 */
					'#smvmt-fixed-header .main-header-menu' => array(
						'background' => esc_attr( $sticky_header_menu_bg_color['tablet'] ),
					),
				'#smvmt-fixed-header .main-header-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu li.current_page_item > a' => array(
					'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
				),
				'#smvmt-fixed-header .main-header-menu a:hover, .smvmt-header-custom-item a:hover, #smvmt-fixed-header .main-header-menu li:hover > a, #smvmt-fixed-header .main-header-menu li.focus > a' => array(
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['tablet'] ),
					'color'            => esc_attr( $tablet_sticky_primary_menu_h_color ),
				),
				'#smvmt-fixed-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header .main-header-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $tablet_sticky_primary_menu_h_color ),
				),

				'#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu a, #smvmt-fixed-header .smvmt-header-custom-item, .smvmt-header-custom-item a, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items a' => array(
					'color' => esc_attr( $tablet_sticky_primary_menu_color ),
				),

				'#smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search form' => array(
					'border-color' => esc_attr( $tablet_sticky_primary_menu_color ),
				),
				/**
				 * Primary Submenu
				 */
					'#smvmt-fixed-header .main-navigation ul ul.sub-menu, .smvmt-header-break-point#smvmt-fixed-header .main-header-menu ul' => array(
						'background-color' => esc_attr( $sticky_header_submenu_bg_color['tablet'] ),
					),
				'#smvmt-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu, #smvmt-fixed-header .main-header-menu .sub-menu a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu .children a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_color['tablet'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu a:hover, #smvmt-fixed-header .main-header-menu .children a:hover, #smvmt-fixed-header .main-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .main-header-menu .children li:hover > a, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > a, #smvmt-fixed-header .main-header-menu .children li.focus > a' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu .children li.current_page_ancestor > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current_page_item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu li.current_page_item > .smvmt-menu-toggle' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['tablet'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['tablet'] ),
				),
				// Content Section text color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget-title' => array(
					'color' => esc_attr( $sticky_header_content_section_text_color['tablet'] ),
				),
				// Content Section link color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a' => array(
					'color' => esc_attr( $sticky_header_content_section_link_color['tablet'] ),
				),
				// Content Section link hover color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
					'color' => esc_attr( $sticky_header_content_section_link_h_color['tablet'] ),
				),
			);
			$mobile_css_output = array(

				/**
				 * Header
				 */
				'#smvmt-fixed-header .site-title a, #smvmt-fixed-header .site-title a:focus, #smvmt-fixed-header .site-title a:hover, #smvmt-fixed-header .site-title a:visited' => array(
					'color' => esc_attr( $mobile_sticky_header_color_site_title ),
				),
				'#smvmt-fixed-header.site-header .site-title a:hover' => array(
					'color' => esc_attr( $sticky_header_color_h_site_title['mobile'] ),
				),
				'#smvmt-fixed-header.site-header .site-description' => array(
					'color' => esc_attr( $mobile_sticky_header_color_site_tagline ),
				),
				'.smvmt-transparent-header #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field:focus' => array(
					'background-color' => esc_attr( $mobile_sticky_header_bg_color ),
				),
				/**
				 * Primary Header Menu
				 */
					'#smvmt-fixed-header .main-header-menu' => array(
						'background' => esc_attr( $sticky_header_menu_bg_color['mobile'] ),
					),
				'#smvmt-fixed-header .main-header-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu li.current_page_item > a' => array(
					'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
				),
				'#smvmt-fixed-header .main-header-menu a:hover, .smvmt-header-custom-item a:hover, #smvmt-fixed-header .main-header-menu li:hover > a, #smvmt-fixed-header .main-header-menu li.focus > a' => array(
					'background-color' => esc_attr( $sticky_header_menu_h_a_bg_color['mobile'] ),
					'color'            => esc_attr( $mobile_sticky_primary_menu_h_color ),
				),
				'#smvmt-fixed-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header .main-header-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $mobile_sticky_primary_menu_h_color ),
				),

				'#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu a, #smvmt-fixed-header .smvmt-header-custom-item, .smvmt-header-custom-item a, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items a' => array(
					'color' => esc_attr( $mobile_sticky_primary_menu_color ),
				),

				'#smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search form' => array(
					'border-color' => esc_attr( $mobile_sticky_primary_menu_color ),
				),
				/**
				 * Primary Submenu
				 */
					'#smvmt-fixed-header .main-navigation ul ul.sub-menu, .smvmt-header-break-point#smvmt-fixed-header .main-header-menu ul' => array(
						'background-color' => esc_attr( $sticky_header_submenu_bg_color['mobile'] ),
					),
				'#smvmt-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu, #smvmt-fixed-header .main-header-menu .sub-menu a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu .children a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_color['mobile'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu a:hover, #smvmt-fixed-header .main-header-menu .children a:hover, #smvmt-fixed-header .main-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .main-header-menu .children li:hover > a, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > a, #smvmt-fixed-header .main-header-menu .children li.focus > a' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle' => array(
					'color' => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
				),
				'#smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu .children li.current_page_ancestor > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current_page_item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-bar-navigation .main-header-menu .sub-menu li.current_page_item > .smvmt-menu-toggle' => array(
					'color'            => esc_attr( $sticky_primary_submenu_h_color['mobile'] ),
					'background-color' => esc_attr( $sticky_primary_submenu_h_a_bg_color['mobile'] ),
				),
				// Content Section text color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget-title' => array(
					'color' => esc_attr( $sticky_header_content_section_text_color['mobile'] ),
				),
				// Content Section link color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a' => array(
					'color' => esc_attr( $sticky_header_content_section_link_color['mobile'] ),
				),
				// Content Section link hover color.
				'#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a:hover' => array(
					'color' => esc_attr( $sticky_header_content_section_link_h_color['mobile'] ),
				),
			);
		}

		if ( 'custom-button' === $header_custom_button_style ) {
			$css_output = array(
				// Custom menu item button - Transparent.
				'.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' => array(
					'color'               => esc_attr( $header_custom_sticky_button_text_color ),
					'background-color'    => esc_attr( $header_custom_sticky_button_back_color ),
					'padding-top'         => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'top', 'desktop' ),
					'padding-bottom'      => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'bottom', 'desktop' ),
					'padding-left'        => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'left', 'desktop' ),
					'padding-right'       => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'right', 'desktop' ),
					'border-radius'       => smvmt_get_css_value( $header_custom_sticky_button_radius, 'px' ),
					'border-style'        => 'solid',
					'border-color'        => esc_attr( $header_custom_sticky_button_border_color ),
					'border-top-width'    => ( isset( $header_custom_sticky_button_border_size['top'] ) && '' !== $header_custom_sticky_button_border_size['top'] ) ? smvmt_get_css_value( $header_custom_sticky_button_border_size['top'], 'px' ) : '',
					'border-right-width'  => ( isset( $header_custom_sticky_button_border_size['right'] ) && '' !== $header_custom_sticky_button_border_size['right'] ) ? smvmt_get_css_value( $header_custom_sticky_button_border_size['right'], 'px' ) : '',
					'border-left-width'   => ( isset( $header_custom_sticky_button_border_size['left'] ) && '' !== $header_custom_sticky_button_border_size['left'] ) ? smvmt_get_css_value( $header_custom_sticky_button_border_size['left'], 'px' ) : '',
					'border-bottom-width' => ( isset( $header_custom_sticky_button_border_size['bottom'] ) && '' !== $header_custom_sticky_button_border_size['bottom'] ) ? smvmt_get_css_value( $header_custom_sticky_button_border_size['bottom'], 'px' ) : '',
				),
				'.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' => array(
					'color'            => esc_attr( $header_custom_sticky_button_text_h_color ),
					'background-color' => esc_attr( $header_custom_sticky_button_back_h_color ),
					'border-color'     => esc_attr( $header_custom_sticky_button_border_h_color ),
				),
			);

			/* Parse CSS from array() */
			$parse_css .= smvmt_parse_css( $css_output );

			$custom_trans_button_css = array(
				'.smvmt-sticky-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' => array(
					'padding-top'    => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'top', 'tablet' ),
					'padding-bottom' => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'bottom', 'tablet' ),
					'padding-left'   => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'left', 'tablet' ),
					'padding-right'  => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'right', 'tablet' ),
				),
			);

			/* Parse CSS from array()*/
			$parse_css .= smvmt_parse_css( $custom_trans_button_css, '', '768' );

			$custom_trans_button = array(
				'.smvmt-sticky-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' => array(
					'padding-top'    => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'top', 'mobile' ),
					'padding-bottom' => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'bottom', 'mobile' ),
					'padding-left'   => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'left', 'mobile' ),
					'padding-right'  => smvmt_responsive_spacing( $header_custom_sticky_button_spacing, 'right', 'mobile' ),
				),
			);

			/* Parse CSS from array()*/
			$parse_css .= smvmt_parse_css( $custom_trans_button, '', '544' );
		}

		if ( false === smvmt_pro_sticky_header_submenu_below_header_fix() ) :
			$submenu_below_header = array(
				'.smvmt-sticky-main-shrink .smvmt-sticky-shrunk .main-header-bar' => array(
					'padding-top'    => '0.5em',
					'padding-bottom' => '0.5em',
				),
				'.smvmt-sticky-main-shrink .smvmt-sticky-shrunk .main-header-bar .smvmt-site-identity' => array(
					'padding-top'    => '0',
					'padding-bottom' => '0',
				),
			);

			$parse_css .= smvmt_parse_css( $submenu_below_header );
	endif;

		/* Parse CSS from array() */
		$parse_css .= smvmt_parse_css( $desktop_css_output );
		$parse_css .= smvmt_parse_css( $tablet_css_output, '', '768' );
		$parse_css .= smvmt_parse_css( $mobile_css_output, '', '544' );

		return $dynamic_css .= $parse_css;

}


/**
 * Check backwards compatibility CSS for loading submenu below the header needs to be added.
 *
 * @since 1.6.0
 * @return boolean true if CSS should be included, False if not.
 */
function smvmt_pro_sticky_header_submenu_below_header_fix() {

	if ( false == smvmt_get_option( 'submenu-below-header', true ) &&
		false === apply_filters(
			'smvmt_submenu_below_header_fix',
			false
		) ) {

			return false;
	} else {

		return true;
	}

}
