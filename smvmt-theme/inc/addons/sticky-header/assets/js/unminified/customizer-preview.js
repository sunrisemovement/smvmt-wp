/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package smvmt
 * @since  1.0.0
 */

( function( $ ) {

	wp.customize( 'smvmt-settings[site-layout-box-width]', function( value ) {
		value.bind( function( width ) {
			/**
			 * Has sticky header?
			 */
			if ( jQuery( '*[data-stick-maxwidth]' ).length ) {
				jQuery( '*[data-stick-maxwidth]' ).find( '.smvmt-sticky-active, .smvmt-header-sticky-active, .smvmt-custom-footer' ).css( { 'max-width': width + 'px', 'transition': 'none' } );
				jQuery( '*[data-stick-maxwidth]' ).attr( 'data-stick-maxwidth', width );
			}
		} );
	} );

	wp.customize( 'smvmt-settings[site-layout-box-tb-margin]', function( value ) {
		value.bind( function( margin ) {

			header_top 			= (typeof ( wp.customize._value['smvmt-settings[above-header-layout]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[above-header-layout]']._value: '';
			header_below		= (typeof ( wp.customize._value['smvmt-settings[below-header-layout]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[below-header-layout]']._value: '';
			header_above_stick 	= (typeof ( wp.customize._value['smvmt-settings[header-above-stick]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[header-above-stick]']._value: '';
			header_below_stick 	= (typeof ( wp.customize._value['smvmt-settings[header-below-stick]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[header-below-stick]']._value: '';
			header_main_stick 	= (typeof ( wp.customize._value['smvmt-settings[header-main-stick]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[header-main-stick]']._value: '';

			if( header_main_stick || ( header_top != 'disabled' && header_above_stick ) || ( header_below != 'disabled' && header_below_stick ) ) {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	wp.customize( 'smvmt-settings[site-layout-padded-pad]', function( value ) {
		value.bind( function( padding ) {

			header_top 			= (typeof ( wp.customize._value['smvmt-settings[above-header-layout]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[above-header-layout]']._value : '';
			header_below 		= (typeof ( wp.customize._value['smvmt-settings[below-header-layout]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[below-header-layout]']._value : '';
			header_above_stick 	= (typeof ( wp.customize._value['smvmt-settings[header-above-stick]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[header-above-stick]']._value : '';
			header_below_stick 	= (typeof ( wp.customize._value['smvmt-settings[header-below-stick]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[header-below-stick]']._value : '';
			header_main_stick 	= (typeof ( wp.customize._value['smvmt-settings[header-main-stick]'] ) != 'undefined' ) ? wp.customize._value['smvmt-settings[header-main-stick]']._value : '';

			if( header_main_stick || ( header_top != 'disabled' && header_above_stick ) || ( header_below != 'disabled' && header_below_stick ) ) {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

		var stickyHeaderStyle = astSticky.stickyHeaderStyle || '';
		var stickyHideOnScroll = astSticky.stickyHideOnScroll || '';

		if ( 'none' === stickyHeaderStyle &&  '1' != stickyHideOnScroll ) {

			/**
			 * Sticky Primary Header
			 */
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-color-site-title-responsive]','color', '.smvmt-primary-sticky-header-active .site-title a, .smvmt-primary-sticky-header-active .site-title a:focus, .smvmt-primary-sticky-header-active .site-title a:hover, .smvmt-primary-sticky-header-active .site-title a:visited' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-color-h-site-title-responsive]','color', '.smvmt-primary-sticky-header-active .site-header .site-title a:hover' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-color-site-tagline-responsive]','color', '.smvmt-primary-sticky-header-active .site-header .site-description' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-bg-color-responsive]','background-color', '.smvmt-transparent-header.smvmt-primary-sticky-header-active .main-header-bar, .smvmt-primary-sticky-header-active .main-header-bar-wrap .main-header-bar, .smvmt-primary-sticky-header-active.smvmt-header-break-point .main-header-bar' );

			// Sticky -- Primary Menu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-bg-color-responsive]','background-color', '.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu, .smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-menu, .smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-color-responsive]','color', '.smvmt-primary-sticky-header-active .main-header-menu, .smvmt-primary-sticky-header-active .main-header-menu a, .smvmt-primary-sticky-header-active .smvmt-header-custom-item, .smvmt-header-custom-item a, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active li.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active .smvmt-masthead-custom-menu-items .smvmt-inline-search form' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-h-color-responsive]','color', '.smvmt-primary-sticky-header-active .main-header-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu a:hover, .smvmt-header-custom-item a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-menu li.focus > .smvmt-menu-toggle' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-h-a-bg-color-responsive]','background-color', '.smvmt-primary-sticky-header-active .main-header-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu li.current_page_item > a,.smvmt-primary-sticky-header-active .main-header-menu a:hover, .smvmt-header-custom-item a:hover, .smvmt-primary-sticky-header-active .main-header-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu li.focus > a' );


			// Sticky -- Primary Submenu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-bg-color-responsive]','background-color', '.smvmt-primary-sticky-header-active .main-navigation ul.main-header-menu ul.sub-menu, .smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-menu ul.sub-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-color-responsive]','color', '.smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .children a, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-h-color-responsive]','color', '.smvmt-primary-sticky-header-active .main-header-menu .sub-menu a:hover, .smvmt-primary-sticky-header-active .main-header-menu .children a:hover, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .children li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-h-a-bg-color-responsive]','background-color', '.smvmt-primary-sticky-header-active .main-header-menu .sub-menu a:hover, .smvmt-primary-sticky-header-active .main-header-menu .children a:hover, .smvmt-primary-sticky-header-active .main-header-bar-navigation .main-header-menu .sub-menu li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .children li:hover > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.focus > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_ancestor > a, .smvmt-primary-sticky-header-active .main-header-menu .sub-menu li.current_page_item > a, .smvmt-primary-sticky-header-active .main-header-menu .children li.current_page_item > a' );


			// Sticky -- Custom Menu item outside
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-content-section-text-color-responsive]','color', '.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget-title' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-content-section-link-color-responsive]','color', '.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-content-section-link-h-color-responsive]','color', '.smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items a:hover, .smvmt-primary-sticky-header-active div.smvmt-masthead-custom-menu-items .widget a:hover' );


			/**
			 * Sticky Above Header
			 */
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-bg-color-responsive]','background-color', '.smvmt-above-sticky-header-active .smvmt-above-header-wrap .smvmt-above-header' );


			// Sticky -- Above Header Menu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-bg-color-responsive]','background-color', '.smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation > ul, .smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field, .smvmt-above-sticky-header-active .smvmt-above-header .smvmt-search-menu-icon .search-field:focus, .smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-color-responsive]','color', '.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu a, .smvmt-header-break-point .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-h-color-responsive]','color', '.smvmt-above-sticky-header-active .smvmt-above-header-navigation li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation .menu-item.focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-item > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-ancestor > a, .smvmt-header-break-point .smvmt-above-header-navigation > ul > .menu-item-has-children.current-menu-item > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-above-header-navigation .menu-item-has-children:hover > .smvmt-menu-toggle' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-h-a-bg-color-responsive]','background-color', '.smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-item > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation li.current-menu-ancestor > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation .menu-item.focus > a' );


			// Sticky -- Above Header Submenu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-bg-color-responsive]','background-color', '.smvmt-above-sticky-header-active .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .sub-menu, .smvmt-header-break-point.smvmt-above-sticky-header-active .smvmt-above-header-section-separated .smvmt-above-header-navigation .submenu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-color-responsive]','color', '.smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, .smvmt-above-sticky-header-active .smvmt-above-header-navigation ul.sub-menu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-h-color-responsive]','color', '.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.smvmt-submenu-expanded + a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li.focus > a,.smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle,.smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle,.smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-h-a-bg-color-responsive]','background-color', '.smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.smvmt-submenu-expanded > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-above-sticky-header-active .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' );


			// Sticky -- Above Header Content Section.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-content-section-text-color-responsive]','color', '.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget-title' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-content-section-link-color-responsive]','color', '.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-content-section-link-h-color-responsive]','color', '.smvmt-above-sticky-header-active .smvmt-above-header-section .user-select a:hover, .smvmt-above-sticky-header-active .smvmt-above-header-section .widget a:hover' );

			/**
			 * Sticky Below Header
			 */
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-bg-color-responsive]','background-color', '.smvmt-below-sticky-header-active .smvmt-below-header-wrap .smvmt-below-header' );


			// Sticky -- below Header Menu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-menu-bg-color-responsive]','background-color', '.smvmt-below-sticky-header-active .smvmt-below-header-actual-nav, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-below-sticky-header-active .smvmt-below-header-navigation-wrap .smvmt-below-header-actual-nav, .smvmt-fullscreen-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap' );
			smvmt_color_responsive_css('sticky-header-menu-link', 'smvmt-settings[sticky-below-header-menu-color-responsive]','color', '.smvmt-below-sticky-header-active .smvmt-below-header-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu a,.smvmt-below-sticky-header-active .below-header-user-select .widget,.smvmt-below-sticky-header-active .below-header-user-select .widget-title,.smvmt-below-sticky-header-active .below-header-user-select, .smvmt-below-sticky-header-active .below-header-user-select a, .smvmt-below-sticky-header-active .below-header-user-select .widget a' );
			smvmt_color_responsive_css('sticky-header-search-border', 'smvmt-settings[sticky-below-header-menu-color-responsive]','border-color', '.smvmt-below-sticky-header-active .below-header-user-select input.search-field:focus, .smvmt-below-sticky-header-active .below-header-user-select input.search-field.focus' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-menu-h-color-responsive]','color', '.smvmt-below-sticky-header-active .smvmt-below-header-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.focus > a,.smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle,.smvmt-below-sticky-header-active .below-header-user-select a:hover, .smvmt-below-sticky-header-active .below-header-user-select .widget a:hover, #smvmt-fixed-header .below-header-user-select .widget a:hover, .smvmt-header-break-point .smvmt-below-header-menu li:hover > .smvmt-menu-toggle' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-menu-h-a-bg-color-responsive]','background-color', '.smvmt-below-sticky-header-active .smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' );

			// Sticky -- below Header Submenu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-bg-color-responsive]','background-color', '.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-color-responsive]','color', '.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-h-color-responsive]','color', '.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-h-a-bg-color-responsive]','background-color', '.smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-below-sticky-header-active .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' );


			// Sticky -- Below Header Content Section.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-content-section-text-color-responsive]','color', '.smvmt-below-sticky-header-active .below-header-user-select, .smvmt-below-sticky-header-active .below-header-user-select .widget,.smvmt-below-sticky-header-active .below-header-user-select .widget-title' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-content-section-link-color-responsive]','color', '.smvmt-below-sticky-header-active .below-header-user-select a, .smvmt-below-sticky-header-active .below-header-user-select .widget a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-content-section-link-h-color-responsive]','color', '.smvmt-below-sticky-header-active .below-header-user-select a:hover, .smvmt-below-sticky-header-active .below-header-user-select .widget a:hover' );
		} else{

			/**
			 * Sticky Primary Header
			 */
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-color-site-title-responsive]','color', '#smvmt-fixed-header .site-title a, #smvmt-fixed-header .site-title a:focus, #smvmt-fixed-header .site-title a:hover, #smvmt-fixed-header .site-title a:visited' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-color-h-site-title-responsive]','color', '#smvmt-fixed-header.site-header .site-title a:hover' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-color-site-tagline-responsive]','color', '#smvmt-fixed-header.site-header .site-description' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-bg-color-responsive]','background-color', '.smvmt-transparent-header #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .main-header-bar, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search .search-field:focus' );

			// Sticky -- Primary Menu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-bg-color-responsive]','background-color', '#smvmt-fixed-header .main-header-menu, .smvmt-header-break-point.smvmt-primary-sticky-header-active .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-color-responsive]','color', '#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu a, #smvmt-fixed-header .smvmt-header-custom-item, .smvmt-header-custom-item a, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items, #smvmt-fixed-header li.smvmt-masthead-custom-menu-items a, #smvmt-fixed-header .smvmt-masthead-custom-menu-items .smvmt-inline-search form' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-h-color-responsive]','color', '#smvmt-fixed-header .main-header-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu li.current_page_item > a, #smvmt-fixed-header .main-header-menu a:hover, .smvmt-header-custom-item a:hover, #smvmt-fixed-header .main-header-menu li:hover > a, #smvmt-fixed-header .main-header-menu li.focus > a, #smvmt-fixed-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header .main-header-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu li.focus > .smvmt-menu-toggle' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-menu-h-a-bg-color-responsive]','background-color', '#smvmt-fixed-header .main-header-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu li.current_page_item > a,#smvmt-fixed-header .main-header-menu a:hover, .smvmt-header-custom-item a:hover, #smvmt-fixed-header .main-header-menu li:hover > a, #smvmt-fixed-header .main-header-menu li.focus > a' );


			// Sticky -- Primary Submenu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-bg-color-responsive]','background-color', '#smvmt-fixed-header .main-navigation ul ul.sub-menu, .smvmt-header-break-point #smvmt-fixed-header .main-header-menu ul' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-color-responsive]','color', '#smvmt-fixed-header .main-header-menu .sub-menu, #smvmt-fixed-header .main-header-menu .sub-menu a, #smvmt-fixed-header .main-header-menu .children a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-h-color-responsive]','color', '#smvmt-fixed-header .main-header-menu .sub-menu a:hover, #smvmt-fixed-header .main-header-menu .children a:hover, #smvmt-fixed-header .main-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .main-header-menu .children li:hover > a, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > a, #smvmt-fixed-header .main-header-menu .children li.focus > a, #smvmt-fixed-header .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle, #smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu .children li.current_page_ancestor > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current_page_item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-submenu-h-a-bg-color-responsive]','background-color', '#smvmt-fixed-header .main-header-menu .sub-menu a:hover, #smvmt-fixed-header .main-header-menu .children a:hover, #smvmt-fixed-header .main-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .main-header-menu .children li:hover > a, #smvmt-fixed-header .main-header-menu .sub-menu li.focus > a, #smvmt-fixed-header .main-header-menu .children li.focus > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .main-header-menu .children li.current_page_ancestor > a, #smvmt-fixed-header .main-header-menu .sub-menu li.current_page_item > a, #smvmt-fixed-header .main-header-menu .children li.current_page_item > a' );


			// Sticky -- Custom Menu item outside
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-content-section-text-color-responsive]','color', '#smvmt-fixed-header div.smvmt-masthead-custom-menu-items, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget-title' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-content-section-link-color-responsive]','color', '#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-header-content-section-link-h-color-responsive]','color', '#smvmt-fixed-header div.smvmt-masthead-custom-menu-items a:hover, #smvmt-fixed-header div.smvmt-masthead-custom-menu-items .widget a:hover' );


			/**
			 * Sticky Above Header
			 */
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-above-header' );

			// Sticky -- Above Header Menu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-bg-color-responsive]','background-color', '.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul, #smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field, #smvmt-fixed-header .smvmt-above-header .smvmt-search-menu-icon .search-field:focus, #smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu,.smvmt-header-break-point #smvmt-fixed-header .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-color-responsive]','color', '#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu a, #smvmt-fixed-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-h-color-responsive]','color', '#smvmt-fixed-header .smvmt-above-header-navigation li:hover > a, #smvmt-fixed-header .smvmt-above-header-navigation .menu-item.focus > a, #smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-item > a, #smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-ancestor > a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-menu-h-a-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-item > a, #smvmt-fixed-header .smvmt-above-header-navigation li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-above-header-navigation li:hover > a, #smvmt-fixed-header .smvmt-above-header-navigation .menu-item.focus > a' );


			// Sticky -- Above Header Submenu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-color-responsive]','color', '#smvmt-fixed-header .smvmt-above-header-navigation ul.smvmt-above-header-menu .sub-menu a, #smvmt-fixed-header .smvmt-above-header-navigation .sub-menu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-h-color-responsive]','color', '#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:hover > a, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > a,#smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu ul.sub-menu li:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle,#smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle,#smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-submenu-h-a-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-above-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li:focus > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.focus > a,#smvmt-fixed-header .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' );


			// Sticky -- Above Header Content Section.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-content-section-text-color-responsive]','color', '#smvmt-fixed-header .smvmt-above-header-section .user-select, #smvmt-fixed-header .smvmt-above-header-section .widget, #smvmt-fixed-header .smvmt-above-header-section .widget-title' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-content-section-link-color-responsive]','color', '#smvmt-fixed-header .smvmt-above-header-section .user-select a, #smvmt-fixed-header .smvmt-above-header-section .widget a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-above-header-content-section-link-h-color-responsive]','color', '#smvmt-fixed-header .smvmt-above-header-section .user-select a:hover, #smvmt-fixed-header .smvmt-above-header-section .widget a:hover' );

			/**
			 * Sticky Below Header
			 */
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-below-header' );


			// Sticky -- below Header Menu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-menu-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-below-header-actual-nav' );
			smvmt_color_responsive_css('sticky-header-menu-link', 'smvmt-settings[sticky-below-header-menu-color-responsive]','color', '#smvmt-fixed-header .smvmt-below-header-menu, #smvmt-fixed-header .smvmt-below-header-menu a,#smvmt-fixed-header .below-header-user-select .widget,#smvmt-fixed-header .below-header-user-select .widget-title,#smvmt-fixed-header .below-header-user-select, #smvmt-fixed-header .below-header-user-select a, #smvmt-fixed-header .below-header-user-select .widget a' );
			smvmt_color_responsive_css('sticky-header-search-border', 'smvmt-settings[sticky-below-header-menu-color-responsive]','border-color', '#smvmt-fixed-header .below-header-user-select input.search-field:focus, #smvmt-fixed-header .below-header-user-select input.search-field.focus' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-menu-h-color-responsive]','color', '#smvmt-fixed-header .smvmt-below-header-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu li.focus > a,#smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle,#smvmt-fixed-header .below-header-user-select a:hover, #smvmt-fixed-header .below-header-user-select .widget a:hover' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-menu-h-a-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu li.focus > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' );


			// Sticky -- below Header Submenu.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-below-header-menu .sub-menu' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-color-responsive]','color', '#smvmt-fixed-header .smvmt-below-header-menu .sub-menu, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-h-color-responsive]','color', '#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-submenu-h-a-bg-color-responsive]','background-color', '#smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, #smvmt-fixed-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' );



			// Sticky -- Below Header Content Section.
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-content-section-text-color-responsive]','color', '#smvmt-fixed-header .below-header-user-select, #smvmt-fixed-header .below-header-user-select .widget,#smvmt-fixed-header .below-header-user-select .widget-title' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-content-section-link-color-responsive]','color', '#smvmt-fixed-header .below-header-user-select a, #smvmt-fixed-header .below-header-user-select .widget a' );
			smvmt_color_responsive_css('sticky-header', 'smvmt-settings[sticky-below-header-content-section-link-h-color-responsive]','color', '#smvmt-fixed-header .below-header-user-select a:hover, #smvmt-fixed-header .below-header-user-select .widget a:hover' );
		}


	/**
	 * Sticky Above Header background color opacity
	 */
	wp.customize( 'smvmt-settings[sticky-header-logo-width]', function( setting ) {
		setting.bind( function( logo_width ) {
			if ( logo_width['desktop'] != '' || logo_width['tablet'] != '' || logo_width['mobile'] != '' ) {
				var dynamicStyle = '.site-logo-img .sticky-custom-logo img {max-width: ' + logo_width['desktop'] + 'px;} #masthead .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .smvmt-sticky-main-shrink .smvmt-sticky-shrunk .site-logo-img .smvmt-logo-svg { width: ' + logo_width['desktop'] + 'px;} @media( max-width: 768px ) { .site-logo-img .sticky-custom-logo img {max-width: ' + logo_width['tablet'] + 'px;} #masthead .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .smvmt-sticky-main-shrink .smvmt-sticky-shrunk .site-logo-img .smvmt-logo-svg { width: ' + logo_width['tablet'] + 'px;} } @media( max-width: 544px ) { .site-logo-img .sticky-custom-logo img {max-width: ' + logo_width['mobile'] + 'px;} #masthead .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .site-logo-img .sticky-custom-logo .smvmt-logo-svg, .smvmt-sticky-main-shrink .smvmt-sticky-shrunk .site-logo-img .smvmt-logo-svg { width: ' + logo_width['mobile'] + 'px;} }'
				smvmt_add_dynamic_css( 'sticky-header-logo-width', dynamicStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		});
	});

	smvmt_css( 'smvmt-settingsheader-main-rt-sticky-section-button-text-color]', 'color', '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settingsheader-main-rt-sticky-section-button-back-color]', 'background-color', '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settingsheader-main-rt-sticky-section-button-text-h-color]', 'color', '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_css( 'smvmt-settingsheader-main-rt-sticky-section-button-back-h-color]', 'background-color', '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_responsive_spacing( 'smvmt-settings[header-main-rt-sticky-section-button-padding]','.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button', 'padding', ['top', 'right', 'bottom', 'left' ] );
	smvmt_css( 'smvmt-settings[header-main-rt-sticky-section-button-border-radius]', 'border-radius', '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button', 'px' );
	smvmt_css( 'smvmt-settings[header-main-rt-sticky-section-button-border-color]', 'border-color', '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settings[header-main-rt-sticky-section-button-border-h-color]', 'border-color', '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );

	/**
	 * Button border
	 */
	wp.customize( 'smvmt-settings[sticky-header-button-border-group]', function( value ) {
		value.bind( function( value ) {

			var optionValue = JSON.parse(value);
			var border =  optionValue['header-main-rt-sticky-section-button-border-size'];

			if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {
				var dynamicStyle = '.smvmt-primary-sticky-header-active .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button';
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'  + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'header-main-rt-sticky-section-button-border-size', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	/**
	 * Sticky Header Site Title color
	 */
	wp.customize( 'smvmt-settings[header-color-site-title]', function( setting ) {
		setting.bind( function( site_title ) {
			if ( site_title != '' ) {
				var dynamicStyle = '#smvmt-fixed-header .main-header-bar .site-title a, #smvmt-fixed-header .main-header-bar .site-title a:focus, #smvmt-fixed-header .main-header-bar .site-title a:hover, #smvmt-fixed-header .main-header-bar .site-title a:visited, .main-header-bar.smvmt-sticky-active .site-title a, .main-header-bar.smvmt-sticky-active .site-title a:focus, .main-header-bar.smvmt-sticky-active .site-title a:hover, .main-header-bar.smvmt-sticky-active .site-title a:visited { color: ' + site_title + '}';
				smvmt_add_dynamic_css( 'sticky-header-site-title-color', dynamicStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		});
	});

	/**
	 * Sticky Header Site Title Hover color
	 */
	wp.customize( 'smvmt-settings[header-color-h-site-title]', function( setting ) {
		setting.bind( function( site_title_hover ) {
			if ( site_title_hover != '' ) {
				var dynamicStyle = '#smvmt-fixed-header .main-header-bar .site-title a:hover, .main-header-bar.smvmt-sticky-active .site-title a:hover { color: ' + site_title_hover + '}';
				smvmt_add_dynamic_css( 'sticky-header-site-title-hover-color', dynamicStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		});
	});

	/**
	 * Sticky Header Site Tagline color
	 */
	wp.customize( 'smvmt-settings[header-color-site-tagline]', function( setting ) {
		setting.bind( function( site_tagline_hover ) {
			if ( site_tagline_hover != '' ) {
				var dynamicStyle = '#smvmt-fixed-header .main-header-bar .site-description, .main-header-bar.smvmt-sticky-active .site-description { color: ' + site_tagline_hover + '}';
				smvmt_add_dynamic_css( 'sticky-header-site-tagline-hover-color', dynamicStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		});
	});

} )( jQuery );
