/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package smvmt Addon
 * @since  1.0.0
 */

( function( $ ) {

	/**
	 * Transparent Logo Width
	 */
	wp.customize( 'smvmt-settings[transparent-header-logo-width]', function( setting ) {
		setting.bind( function( logo_width ) {
			if ( logo_width['desktop'] != '' || logo_width['tablet'] != '' || logo_width['mobile'] != '' ) {
				var dynamicStyle = '.smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img {max-width: ' + logo_width['desktop'] + 'px;} .smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .smvmt-logo-svg { width: ' + logo_width['desktop'] + 'px;} @media( max-width: 768px ) { .smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img {max-width: ' + logo_width['tablet'] + 'px;} .smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .smvmt-logo-svg { width: ' + logo_width['tablet'] + 'px;} } @media( max-width: 544px ) { .smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo img {max-width: ' + logo_width['mobile'] + 'px;} .smvmt-theme-transparent-header #masthead .site-logo-img .transparent-custom-logo .smvmt-logo-svg { width: ' + logo_width['mobile'] + 'px;} }';
				smvmt_add_dynamic_css( 'transparent-header-logo-width', dynamicStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	/**
	 * Transparent Header Bottom Border width
	 */
	wp.customize( 'smvmt-settings[transparent-header-main-sep]', function( value ) {
		value.bind( function( border ) {

			var dynamicStyle = ' body.smvmt-theme-transparent-header.smvmt-header-break-point .site-header { border-bottom-width: ' + border + 'px } ';

			dynamicStyle += 'body.smvmt-theme-transparent-header.smvmt-desktop .main-header-bar {';
			dynamicStyle += 'border-bottom-width: ' + border + 'px';
			dynamicStyle += '}';

			smvmt_add_dynamic_css( 'transparent-header-main-sep', dynamicStyle );

		} );
	} );

	/**
	 * Transparent Header Bottom Border color
	 */
	wp.customize( 'smvmt-settings[transparent-header-main-sep-color]', function( value ) {
		value.bind( function( color ) {
			if (color == '') {
				wp.customize.preview.send( 'refresh' );
			}

			if ( color ) {

				var dynamicStyle = ' body.smvmt-theme-transparent-header.smvmt-desktop .main-header-bar { border-bottom-color: ' + color + '; } ';
					dynamicStyle += ' body.smvmt-theme-transparent-header.smvmt-header-break-point .site-header { border-bottom-color: ' + color + '; } ';

				smvmt_add_dynamic_css( 'transparent-header-main-sep-color', dynamicStyle );
			}

		} );
	} );


	/* Transparent Header Colors */
	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-menu-a-bg-color-responsive]', 	'background-color', 	'.main-header-menu .current-menu-item > a, .main-header-menu .current-menu-ancestor > a, .main-header-menu .current_page_item > a,.smvmt-header-sections-navigation li.current-menu-item > a, .smvmt-above-header-menu-items li.current-menu-item > a,.smvmt-below-header-menu-items li.current-menu-item > a,.smvmt-header-sections-navigation li.current-menu-ancestor > a, .smvmt-above-header-menu-items li.current-menu-ancestor > a,.smvmt-below-header-menu-items li.current-menu-ancestor > a' );

	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-header-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .main-header-bar, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar-wrap .main-header-bar' );
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-header-color-site-title-responsive]', 'color', '.smvmt-theme-transparent-header .site-title a, .smvmt-theme-transparent-header .site-title a:focus, .smvmt-theme-transparent-header .site-title a:hover, .smvmt-theme-transparent-header .site-title a:visited, .smvmt-theme-transparent-header .site-header .site-description' );
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-header-color-h-site-title-responsive]', 'color', '.smvmt-theme-transparent-header .site-header .site-title a:hover' );

	// Primary Menu
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-menu-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .main-header-bar .main-header-menu, .smvmt-flyout-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-fullscreen-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .main-header-bar-navigation #site-navigation, .smvmt-flyout-menu-enable.smvmt-header-break-point .main-header-bar-navigation #site-navigation' );
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-menu-color-responsive]', 'color', '.smvmt-theme-transparent-header .main-header-menu, .smvmt-theme-transparent-header .main-header-menu a,.smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header .smvmt-masthead-custom-menu-items a,.smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu li > .smvmt-menu-toggle' );
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-menu-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .main-header-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header .main-header-menu .focus > a, .smvmt-theme-transparent-header .main-header-menu .focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > a, .smvmt-theme-transparent-header .main-header-menu .current_page_item > a, .smvmt-theme-transparent-header .main-header-menu .current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu .current_page_item > .smvmt-menu-toggle' );
	// Primary SubMenu
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-submenu-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .main-header-menu ul.sub-menu, .smvmt-header-break-point.smvmt-theme-transparent-header .main-header-menu ul.sub-menu' );
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-submenu-color-responsive]', 'color', '.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li a,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li > .smvmt-menu-toggle' );
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-submenu-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .main-header-menu ul.sub-menu a:hover,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > a, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > a, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > a,	.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.current-menu-item > .smvmt-menu-toggle,.smvmt-theme-transparent-header .main-header-menu ul.sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .main-header-menu ul.sub-menu li.focus > .smvmt-menu-toggle' );


	// Primary Content Section text color
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-content-section-text-color-responsive]', 'color', '.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget-title' );
	// Primary Content Section link color
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-content-section-link-color-responsive]', 'color', '.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a' );
	// Primary Content Section link hover color
	smvmt_color_responsive_css( 'transparent-primary-header', 'smvmt-settings[transparent-content-section-link-h-color-responsive]', 'color', '.smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items a:hover, .smvmt-theme-transparent-header div.smvmt-masthead-custom-menu-items .widget a:hover' );



	// Above Header Menu
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-header-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .smvmt-above-header-wrap .smvmt-above-header' );

	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-menu-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .smvmt-above-header-menu, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul, .smvmt-flyout-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation-wrap .smvmt-above-header-navigation, .smvmt-fullscreen-above-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-section-separated .smvmt-above-header-navigation-wrap' );
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-menu-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-above-header-navigation > ul.smvmt-above-header-menu > .menu-item-has-children:not(.current-menu-item) > .smvmt-menu-toggle' );
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-menu-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-item > a,.smvmt-theme-transparent-header .smvmt-above-header-navigation li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-above-header-navigation li:hover > a' )
	// Above Header SubMenu
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-submenu-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu' );
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-submenu-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-above-header-navigation .smvmt-above-header-menu .sub-menu a' );
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-submenu-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle,.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle,.smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > a' );

	// Above Header Content Section text color
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-content-section-text-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-above-header-section .user-select, .smvmt-theme-transparent-header .smvmt-above-header-section .widget, .smvmt-theme-transparent-header .smvmt-above-header-section .widget-title' );
	// Above Header Content Section link color
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-content-section-link-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a' );
	// Above Header Content Section link hover color
	smvmt_color_responsive_css( 'transparent-above-header', 'smvmt-settings[transparent-content-section-link-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-above-header-section .user-select a:hover, .smvmt-theme-transparent-header .smvmt-above-header-section .widget a:hover' );



	// below Header Menu
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-header-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .smvmt-below-header-wrap .smvmt-below-header' );

	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-menu-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-theme-transparent-header .smvmt-below-header-actual-nav, .smvmt-theme-transparent-header.smvmt-header-break-point .smvmt-below-header-actual-nav, .smvmt-flyout-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-navigation-wrap .smvmt-below-header-actual-nav, .smvmt-fullscreen-below-menu-enable.smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-section-separated .smvmt-below-header-navigation-wrap' );
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-menu-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-below-header-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu a, .smvmt-header-break-point.smvmt-theme-transparent-header .smvmt-below-header-menu' );
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-menu-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-below-header-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.focus > a,.smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' );
	// below Header SubMenu
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-submenu-bg-color-responsive]', 'background-color', '.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu' );
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-submenu-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu a' );
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-submenu-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.focus > a,.smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > a, .smvmt-theme-transparent-header .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > a' );

	// below Header Content Section text color
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-content-section-text-color-responsive]', 'color', '', '.smvmt-theme-transparent-header .below-header-user-select, .smvmt-theme-transparent-header .below-header-user-select .widget,.smvmt-theme-transparent-header .below-header-user-select .widget-title' );
	// below Header Content Section link color
	smvmt_color_responsive_css( 'transparent-below-header', 'smvmt-settings[transparent-content-section-link-color-responsive]', 'color', '', '.smvmt-theme-transparent-header .below-header-user-select a, .smvmt-theme-transparent-header .below-header-user-select .widget a' );
	// below Header Content Section link hover color
	smvmt_color_responsive_css( 'below-transparent-header', 'smvmt-settings[transparent-content-section-link-h-color-responsive]', 'color', '.smvmt-theme-transparent-header .below-header-user-select a:hover, .smvmt-theme-transparent-header .below-header-user-select .widget a:hover' );

	/**
	 * Button border
	 */
	wp.customize( 'smvmt-settings[primary-header-button-border-group]', function( value ) {
		value.bind( function( value ) {

			var optionValue = JSON.parse(value);
			var border =  optionValue['header-main-rt-section-button-border-size'];

			if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {
				var dynamicStyle = '.main-header-bar .smvmt-container .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button';
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'  + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'header-main-rt-section-button-border-size', dynamicStyle );
			}

		} );
	} );

	smvmt_css( 'smvmt-settings[header-main-rt-trans-section-button-text-color]', 'color', '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settings[header-main-rt-trans-section-button-back-color]', 'background-color', '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settings[header-main-rt-trans-section-button-text-h-color]', 'color', '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_css( 'smvmt-settings[header-main-rt-trans-section-button-back-h-color]', 'background-color', '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_css( 'smvmt-settings[header-main-rt-trans-section-button-border-radius]', 'border-radius', '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button', 'px' );
	smvmt_css( 'smvmt-settings[header-main-rt-trans-section-button-border-color]', 'border-color', '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settings[header-main-rt-trans-section-button-border-h-color]', 'border-color', '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_responsive_spacing( 'smvmt-settings[header-main-rt-trans-section-button-padding]','.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button', 'padding', ['top', 'right', 'bottom', 'left' ] );

} )( jQuery );
