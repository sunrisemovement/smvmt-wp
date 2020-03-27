<?php
/**
 * Colors & Background - Dynamic CSS
 *
 * @package smvmt
 */

add_filter( 'smvmt_dynamic_css', 'smvmt_ext_header_sections_colors_dynamic_css' );

/**
 * Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @param  string $dynamic_css_filtered Astra Dynamic CSS Filters.
 * @return string
 */
function smvmt_ext_header_sections_colors_dynamic_css( $dynamic_css, $dynamic_css_filtered = '' ) {

	$header_bg_obj           = smvmt_get_option( 'header-bg-obj-responsive' );
	$desktop_header_bg_color = isset( $header_bg_obj['desktop']['background-color'] ) ? $header_bg_obj['desktop']['background-color'] : '';
	$tablet_header_bg_color  = isset( $header_bg_obj['tablet']['background-color'] ) ? $header_bg_obj['tablet']['background-color'] : '';
	$mobile_header_bg_color  = isset( $header_bg_obj['mobile']['background-color'] ) ? $header_bg_obj['mobile']['background-color'] : '';

	$disable_primary_nav = smvmt_get_option( 'disable-primary-nav' );
	$above_header_merged = smvmt_get_option( 'above-header-merge-menu' );
	$below_header_merged = smvmt_get_option( 'below-header-merge-menu' );

	$primary_menu_bg_image   = smvmt_get_option( 'primary-menu-bg-obj-responsive' );
	$primary_menu_color      = smvmt_get_option( 'primary-menu-color-responsive' );
	$primary_menu_h_bg_color = smvmt_get_option( 'primary-menu-h-bg-color-responsive' );
	$primary_menu_h_color    = smvmt_get_option( 'primary-menu-h-color-responsive' );
	$primary_menu_a_bg_color = smvmt_get_option( 'primary-menu-a-bg-color-responsive' );
	$primary_menu_a_color    = smvmt_get_option( 'primary-menu-a-color-responsive' );

	$primary_submenu_b_color    = smvmt_get_option( 'primary-submenu-b-color' );
	$primary_submenu_bg_color   = smvmt_get_option( 'primary-submenu-bg-color-responsive' );
	$primary_submenu_color      = smvmt_get_option( 'primary-submenu-color-responsive' );
	$primary_submenu_h_bg_color = smvmt_get_option( 'primary-submenu-h-bg-color-responsive' );
	$primary_submenu_h_color    = smvmt_get_option( 'primary-submenu-h-color-responsive' );
	$primary_submenu_a_bg_color = smvmt_get_option( 'primary-submenu-a-bg-color-responsive' );
	$primary_submenu_a_color    = smvmt_get_option( 'primary-submenu-a-color-responsive' );

	$header_break_point = smvmt_header_break_point(); // Header Break Point.

	$parse_css = '';

	/**
	 * Merge Header Section when there is no primary menu
	 */
	if ( $disable_primary_nav && ( $above_header_merged || $below_header_merged ) ) {
		// Desktop.
		$desktop_colors = array(

			/**
			 * Primary Menu merge with Above Header & Below Header menu
			 */
			'.smvmt-header-sections-navigation li.current-menu-item > a, .smvmt-above-header-menu-items li.current-menu-item > a,.smvmt-below-header-menu-items li.current-menu-item > a,.smvmt-header-sections-navigation li.current-menu-ancestor > a, .smvmt-above-header-menu-items li.current-menu-ancestor > a,.smvmt-below-header-menu-items li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $primary_menu_a_color['desktop'] ),
				'background-color' => esc_attr( $primary_menu_a_bg_color['desktop'] ),
			),
			'.main-header-menu a:hover, .smvmt-header-custom-item a:hover, .main-header-menu li:hover > a, .main-header-menu li.focus > a, .smvmt-header-break-point .smvmt-header-sections-navigation a:hover, .smvmt-header-break-point .smvmt-header-sections-navigation a:focus' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['desktop'] ),
				'color'            => esc_attr( $primary_menu_h_color['desktop'] ),
			),
			'.smvmt-header-sections-navigation li:hover > .smvmt-menu-toggle, .smvmt-header-sections-navigation li.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_h_color['desktop'] ),
			),

			'.smvmt-header-sections-navigation, .smvmt-header-sections-navigation a, .smvmt-above-header-menu-items,.smvmt-above-header-menu-items a,.smvmt-below-header-menu-items, .smvmt-below-header-menu-items a' => array(
				'color' => esc_attr( $primary_menu_color['desktop'] ),
			),

			'.smvmt-header-sections-navigation .smvmt-inline-search form' => array(
				'border-color' => esc_attr( $primary_menu_color['desktop'] ),
			),

			/**
			 * Primary Submenu
			 */
			'.smvmt-header-sections-navigation .sub-menu a, .smvmt-above-header-menu-items .sub-menu a, .smvmt-below-header-menu-items .sub-menu a' => array(
				'color' => esc_attr( $primary_submenu_color['desktop'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu a:hover, .smvmt-above-header-menu-items .sub-menu a:hover, .smvmt-below-header-menu-items .sub-menu a:hover' => array(
				'color'            => esc_attr( $primary_submenu_h_color['desktop'] ),
				'background-color' => esc_attr( $primary_submenu_h_bg_color['desktop'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-header-sections-navigation .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-header-menu-items .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-below-header-menu-items .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-header-menu-items .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-below-header-menu-items .sub-menu li:focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $primary_submenu_h_color['desktop'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu li.current-menu-item > a, .smvmt-above-header-menu-items .sub-menu li.current-menu-item > a, .smvmt-below-header-menu-items .sub-menu li.current-menu-item > a' => array(
				'color'            => esc_attr( $primary_submenu_a_color['desktop'] ),
				'background-color' => esc_attr( $primary_submenu_a_bg_color['desktop'] ),
			),
			'.smvmt-header-sections-navigation div > li > ul' => array(
				'border-color' => esc_attr( $primary_submenu_b_color ),
			),
			'.main-navigation .sub-menu, .smvmt-header-break-point .main-header-menu ul, .smvmt-header-sections-navigation div > li > ul, .smvmt-above-header-menu-items li > ul, .smvmt-below-header-menu-items li > ul' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['desktop'] ),
			),
		);

		// Tablet.
		$tablet_colors = array(

			/**
			 * Primary Menu merge with Above Header & Below Header menu
			 */
			'.smvmt-header-sections-navigation li.current-menu-item > a, .smvmt-above-header-menu-items li.current-menu-item > a,.smvmt-below-header-menu-items li.current-menu-item > a,.smvmt-header-sections-navigation li.current-menu-ancestor > a, .smvmt-above-header-menu-items li.current-menu-ancestor > a,.smvmt-below-header-menu-items li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $primary_menu_a_color['tablet'] ),
				'background-color' => esc_attr( $primary_menu_a_bg_color['tablet'] ),
			),
			'.main-header-menu a:hover, .smvmt-header-custom-item a:hover, .main-header-menu li:hover > a, .main-header-menu li.focus > a, .smvmt-header-break-point .smvmt-header-sections-navigation a:hover, .smvmt-header-break-point .smvmt-header-sections-navigation a:focus' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['tablet'] ),
				'color'            => esc_attr( $primary_menu_h_color['tablet'] ),
			),
			'.smvmt-header-sections-navigation li:hover > .smvmt-menu-toggle, .smvmt-header-sections-navigation li.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_h_color['tablet'] ),
			),

			'.smvmt-header-sections-navigation, .smvmt-header-sections-navigation a, .smvmt-above-header-menu-items,.smvmt-above-header-menu-items a,.smvmt-below-header-menu-items, .smvmt-below-header-menu-items a' => array(
				'color' => esc_attr( $primary_menu_color['tablet'] ),
			),

			'.smvmt-header-sections-navigation .smvmt-inline-search form' => array(
				'border-color' => esc_attr( $primary_menu_color['tablet'] ),
			),

			/**
			 * Primary Submenu
			 */
			'.smvmt-header-sections-navigation .sub-menu a, .smvmt-above-header-menu-items .sub-menu a, .smvmt-below-header-menu-items .sub-menu a' => array(
				'color' => esc_attr( $primary_submenu_color['tablet'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu a:hover, .smvmt-above-header-menu-items .sub-menu a:hover, .smvmt-below-header-menu-items .sub-menu a:hover' => array(
				'color'            => esc_attr( $primary_submenu_h_color['tablet'] ),
				'background-color' => esc_attr( $primary_submenu_h_bg_color['tablet'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-header-sections-navigation .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-header-menu-items .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-below-header-menu-items .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-header-menu-items .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-below-header-menu-items .sub-menu li:focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $primary_submenu_h_color['tablet'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu li.current-menu-item > a, .smvmt-above-header-menu-items .sub-menu li.current-menu-item > a, .smvmt-below-header-menu-items .sub-menu li.current-menu-item > a' => array(
				'color'            => esc_attr( $primary_submenu_a_color['tablet'] ),
				'background-color' => esc_attr( $primary_submenu_a_bg_color['tablet'] ),
			),
			'.main-navigation .sub-menu, .smvmt-header-break-point .main-header-menu ul, .smvmt-header-sections-navigation div > li > ul, .smvmt-above-header-menu-items li > ul, .smvmt-below-header-menu-items li > ul' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['tablet'] ),
			),
		);

		// Mobile.
		$mobile_colors = array(

			/**
			 * Primary Menu merge with Above Header & Below Header menu
			 */
			'.smvmt-header-sections-navigation li.current-menu-item > a, .smvmt-above-header-menu-items li.current-menu-item > a,.smvmt-below-header-menu-items li.current-menu-item > a,.smvmt-header-sections-navigation li.current-menu-ancestor > a, .smvmt-above-header-menu-items li.current-menu-ancestor > a,.smvmt-below-header-menu-items li.current-menu-ancestor > a' => array(
				'color'            => esc_attr( $primary_menu_a_color['mobile'] ),
				'background-color' => esc_attr( $primary_menu_a_bg_color['mobile'] ),
			),
			'.main-header-menu a:hover, .smvmt-header-custom-item a:hover, .main-header-menu li:hover > a, .main-header-menu li.focus > a, .smvmt-header-break-point .smvmt-header-sections-navigation a:hover, .smvmt-header-break-point .smvmt-header-sections-navigation a:focus' => array(
				'background-color' => esc_attr( $primary_menu_h_bg_color['mobile'] ),
				'color'            => esc_attr( $primary_menu_h_color['mobile'] ),
			),
			'.smvmt-header-sections-navigation li:hover > .smvmt-menu-toggle, .smvmt-header-sections-navigation li.focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $primary_menu_h_color['mobile'] ),
			),

			'.smvmt-header-sections-navigation, .smvmt-header-sections-navigation a, .smvmt-above-header-menu-items,.smvmt-above-header-menu-items a,.smvmt-below-header-menu-items, .smvmt-below-header-menu-items a' => array(
				'color' => esc_attr( $primary_menu_color['mobile'] ),
			),

			'.smvmt-header-sections-navigation .smvmt-inline-search form' => array(
				'border-color' => esc_attr( $primary_menu_color['mobile'] ),
			),

			/**
			 * Primary Submenu
			 */
			'.smvmt-header-sections-navigation .sub-menu a, .smvmt-above-header-menu-items .sub-menu a, .smvmt-below-header-menu-items .sub-menu a' => array(
				'color' => esc_attr( $primary_submenu_color['mobile'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu a:hover, .smvmt-above-header-menu-items .sub-menu a:hover, .smvmt-below-header-menu-items .sub-menu a:hover' => array(
				'color'            => esc_attr( $primary_submenu_h_color['mobile'] ),
				'background-color' => esc_attr( $primary_submenu_h_bg_color['mobile'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-header-sections-navigation .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-header-menu-items .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-below-header-menu-items .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-header-menu-items .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-below-header-menu-items .sub-menu li:focus > .smvmt-menu-toggle' => array(
				'color' => esc_attr( $primary_submenu_h_color['mobile'] ),
			),
			'.smvmt-header-sections-navigation .sub-menu li.current-menu-item > a, .smvmt-above-header-menu-items .sub-menu li.current-menu-item > a, .smvmt-below-header-menu-items .sub-menu li.current-menu-item > a' => array(
				'color'            => esc_attr( $primary_submenu_a_color['mobile'] ),
				'background-color' => esc_attr( $primary_submenu_a_bg_color['mobile'] ),
			),
			'.main-navigation .sub-menu, .smvmt-header-break-point .main-header-menu ul, .smvmt-header-sections-navigation div > li > ul, .smvmt-above-header-menu-items li > ul, .smvmt-below-header-menu-items li > ul' => array(
				'background-color' => esc_attr( $primary_submenu_bg_color['mobile'] ),
			),
		);

		// Desktop.
		if ( '' != $primary_menu_bg_image['desktop']['background-color'] || '' != $primary_menu_bg_image['desktop']['background-image'] ) {
			// If primary menu background color is set then only apply it to the Merged menu.
			$desktop_colors['.smvmt-header-break-point .smvmt-header-sections-navigation'] = smvmt_get_responsive_background_obj( $primary_menu_bg_image, 'desktop' );
		} else {
			// If primary menu background color is not set then only apply Header background color to the Merged menu.
			$desktop_colors['.smvmt-header-break-point .smvmt-header-sections-navigation, .smvmt-header-break-point .smvmt-above-header-menu-items, .smvmt-header-break-point .smvmt-below-header-menu-items'] = array(
				'background-color' => esc_attr( $desktop_header_bg_color ),
			);
		}

		// Tablet.
		if ( '' != $primary_menu_bg_image['tablet']['background-color'] || '' != $primary_menu_bg_image['tablet']['background-image'] ) {
			// If primary menu background color is set then only apply it to the Merged menu.
			$tablet_colors['.smvmt-header-break-point .smvmt-header-sections-navigation'] = smvmt_get_responsive_background_obj( $primary_menu_bg_image, 'tablet' );
		} else {
			// If primary menu background color is not set then only apply Header background color to the Merged menu.
			$tablet_colors['.smvmt-header-break-point .smvmt-header-sections-navigation, .smvmt-header-break-point .smvmt-above-header-menu-items, .smvmt-header-break-point .smvmt-below-header-menu-items'] = array(
				'background-color' => esc_attr( $tablet_header_bg_color ),
			);
		}

		// mobile.
		if ( '' != $primary_menu_bg_image['mobile']['background-color'] || '' != $primary_menu_bg_image['mobile']['background-image'] ) {
			// If primary menu background color is set then only apply it to the Merged menu.
			$mobile_colors['.smvmt-header-break-point .smvmt-header-sections-navigation'] = smvmt_get_responsive_background_obj( $primary_menu_bg_image, 'mobile' );
		} else {
			// If primary menu background color is not set then only apply Header background color to the Merged menu.
			$mobile_colors['.smvmt-header-break-point .smvmt-header-sections-navigation, .smvmt-header-break-point .smvmt-above-header-menu-items, .smvmt-header-break-point .smvmt-below-header-menu-items'] = array(
				'background-color' => esc_attr( $mobile_header_bg_color ),
			);
		}

		/* Parse CSS from array() */
		$parse_css .= smvmt_parse_css( $desktop_colors );
		$parse_css .= smvmt_parse_css( $tablet_colors, '', '768' );
		$parse_css .= smvmt_parse_css( $mobile_colors, '', '544' );
	}

	return $dynamic_css . $parse_css;
}
