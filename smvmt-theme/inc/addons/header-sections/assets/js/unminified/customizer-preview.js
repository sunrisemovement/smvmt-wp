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

	/**
	 * Height
	 */
	wp.customize( 'smvmt-settings[below-header-height]', function( value ) {
		value.bind( function( height ) {

			var max_height = '26px';
			var padding = '; padding-top: .8em; padding-bottom: .8em;';
			if ( height >= 30 ) {
				max_height = ( height - 8 ) + 'px';
			}
			if ( height < 60 ) {
				padding = '; padding-top: .35em; padding-bottom: .35em;';
			}

			dynamicStyle = '.smvmt-below-header { line-height: ' + height + 'px;}';
			dynamicStyle += '.smvmt-below-header-section-wrap { min-height: ' + height + 'px; }';
			dynamicStyle += '.below-header-user-select .smvmt-search-menu-icon .search-field { max-height: ' + max_height + ';' + padding + ' }';

			smvmt_add_dynamic_css( 'below-header-height', dynamicStyle );

			$( document ).trigger( 'masthead-height-changed' );
		} );
	} );

	/**
	 * Below Header Menu Bg colors & image
	 */

	smvmt_generate_outside_font_family_css( 'smvmt-settings[font-family-below-header-primary-menu]', '.smvmt-below-header-menu' );
	smvmt_css( 'smvmt-settings[font-weight-below-header-primary-menu]', 'font-weight', '.smvmt-below-header-menu' );
	smvmt_responsive_font_size( 'smvmt-settings[font-size-below-header-primary-menu]', '.smvmt-below-header-menu' );
	smvmt_css( 'smvmt-settings[text-transform-below-header-primary-menu]', 'text-transform', '.smvmt-below-header-menu' );

	smvmt_generate_outside_font_family_css( 'smvmt-settings[font-family-below-header-content]', '.below-header-user-select' );
	smvmt_css( 'smvmt-settings[font-weight-below-header-content]', 'font-weight', '.below-header-user-select' );
	smvmt_responsive_font_size( 'smvmt-settings[font-size-below-header-content]', '.below-header-user-select' );
	smvmt_css( 'smvmt-settings[text-transform-below-header-content]', 'text-transform', '.below-header-user-select' );

	smvmt_generate_outside_font_family_css( 'smvmt-settings[font-family-below-header-dropdown-menu]', '.smvmt-below-header .sub-menu' );
	smvmt_css( 'smvmt-settings[font-weight-below-header-dropdown-menu]', 'font-weight', '.smvmt-below-header .sub-menu' );
	smvmt_responsive_font_size( 'smvmt-settings[font-size-below-header-dropdown-menu]', '.smvmt-below-header .sub-menu' );
	smvmt_css( 'smvmt-settings[text-transform-below-header-dropdown-menu]', 'text-transform', '.smvmt-below-header .sub-menu' );


	smvmt_css( 'smvmt-settings[below-header-separator]', 'border-bottom-width', '.smvmt-below-header', 'px' );
	smvmt_css( 'smvmt-settings[below-header-bottom-border-color]', 'border-bottom-color', '.smvmt-below-header' );

	/**
	 * Above Header Responsive Background Image
	 */
	smvmt_apply_responsive_background_css( 'smvmt-settings[below-header-menu-bg-obj-responsive]', '.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-wrap .smvmt-below-header-actual-nav', 'desktop', '', 'mobile-below-header' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[below-header-menu-bg-obj-responsive]', '.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-wrap .smvmt-below-header-actual-nav', 'tablet', '', 'mobile-below-header' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[below-header-menu-bg-obj-responsive]', '.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation-wrap, .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-actual-nav, .smvmt-header-break-point .smvmt-below-header-section-wrap .smvmt-below-header-actual-nav', 'mobile', '', 'mobile-below-header' );

	/**
	 * Below Header Responsive Background Image
	 */

	smvmt_apply_responsive_background_css( 'smvmt-settings[below-header-bg-obj-responsive]', '.smvmt-below-header, .smvmt-header-break-point .smvmt-below-header', 'desktop', '.smvmt-below-header, .smvmt-below-header .sub-menu', 'mobile-below-header' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[below-header-bg-obj-responsive]', '.smvmt-below-header, .smvmt-header-break-point .smvmt-below-header', 'tablet', '.smvmt-below-header, .smvmt-below-header .sub-menu', 'mobile-below-header' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[below-header-bg-obj-responsive]', '.smvmt-below-header, .smvmt-header-break-point .smvmt-below-header', 'mobile', '.smvmt-below-header, .smvmt-below-header .sub-menu', 'mobile-below-header' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-text-color-responsive]', 'color', '.below-header-user-select, .below-header-user-select .widget,.below-header-user-select .widget-title' );
	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-link-color-responsive]', 'color', '.below-header-user-select a, .below-header-user-select .smvmt-search-menu-icon .search-submit, .below-header-user-select .widget a' );
	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-link-hover-color-responsive]', 'color', '.below-header-user-select a:hover, .below-header-user-select .widget a:hover' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-menu-text-color-responsive]', 'color', '.smvmt-below-header, .smvmt-below-header a, .smvmt-below-header-menu, .smvmt-below-header-menu a, .smvmt-header-break-point .smvmt-below-header-menu .current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-below-header-menu .current-menu-ancestor > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-below-header-menu, .smvmt-header-break-point .smvmt-below-header-menu a, .smvmt-header-break-point .smvmt-below-header-menu li:hover > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-below-header-menu li.focus > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-below-header-menu .current-menu-item > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-below-header-menu .current-menu-ancestor > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-below-header-menu .current_page_item > .smvmt-menu-toggle' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-menu-text-hover-color-responsive]', 'color', '.smvmt-below-header li:hover > a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-menu-bg-hover-color-responsive]', 'background-color', '.smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, .smvmt-below-header-menu li.focus > a, .smvmt-desktop .smvmt-mega-menu-enabled.smvmt-below-header-menu li a:hover, .smvmt-desktop .smvmt-mega-menu-enabled.smvmt-below-header-menu li a:focus' );

	smvmt_color_responsive_css( 'mobile-below-header-no-toggle-bg-color', 'smvmt-settings[below-header-menu-bg-hover-color-responsive]', 'background-color', '.smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, .smvmt-below-header-menu li.focus > a, .smvmt-header-break-point .smvmt-below-header-menu li:hover > a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-current-menu-text-color-responsive]', 'color', '.smvmt-below-header li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-header li.current-menu-ancestor > a, .smvmt-below-header li.current-menu-item > a, .smvmt-below-header li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-header li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-header .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header .sub-menu li.current-menu-item:hover > a, .smvmt-below-header .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-header .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle' );

	smvmt_color_responsive_css( 'mobile-below-header-no-toggle-current-color', 'smvmt-settings[below-header-current-menu-text-color-responsive]', 'color', '.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item > a, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item:hover > a, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item > .smvmt-menu-toggle, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor > a, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor:hover > a, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item > a, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item:hover > a, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item > .smvmt-menu-toggle, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item:hover > .smvmt-menu-toggle' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-current-menu-bg-color-responsive]', 'background-color', '.smvmt-below-header li.current-menu-ancestor > a, .smvmt-below-header li.current-menu-item > a, .smvmt-below-header li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-below-header li.current-menu-item > .smvmt-menu-toggle, .smvmt-below-header .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header .sub-menu li.current-menu-item:hover > a, .smvmt-below-header .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-below-header .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle' );

	smvmt_color_responsive_css( 'mobile-below-header-no-toggle-current-bg-color', 'smvmt-settings[below-header-current-menu-bg-color-responsive]', 'background-color', '.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu li.current-menu-item > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu li.current-menu-ancestor > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu li.current_page_item > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item:hover > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-item:hover > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor:hover > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current-menu-ancestor:hover > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item:hover > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation li.current_page_item:hover > .smvmt-menu-toggle' );


	smvmt_color_responsive_css( 'mobile-below-header-no-toggle-color', 'smvmt-settings[below-header-menu-text-hover-color-responsive]', 'color', '.smvmt-below-header-menu li:hover > a, .smvmt-below-header-menu li:focus > a, .smvmt-below-header-menu li.focus > a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-submenu-text-color-responsive]', 'color', '.smvmt-below-header .sub-menu, .smvmt-below-header .sub-menu a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-submenu-bg-color-responsive]', 'background-color', '.smvmt-below-header .sub-menu a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-submenu-hover-color-responsive]', 'color', '.smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-below-header-menu .sub-menu li:focus > a, .smvmt-below-header-menu .sub-menu li.focus > a' );

	smvmt_color_responsive_css( 'smvmt-settings[below-header-submenus-group]', 'below-header-submenu-hover-color-responsive', '.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li:hover > a, .smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li:hover > .smvmt-menu-toggle', 'color' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-submenu-bg-hover-color-responsive]', 'background-color', '.smvmt-below-header .sub-menu li:hover > a, .smvmt-desktop .smvmt-mega-menu-enabled.smvmt-below-header-menu .sub-menu li a:hover' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-submenu-active-color-responsive]', 'color', '.smvmt-below-header .sub-menu li.current-menu-ancestor > a, .smvmt-below-header .sub-menu li.current-menu-item > a, .smvmt-below-header .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header .sub-menu li.current-menu-item:hover > a' );

	smvmt_color_responsive_css( 'mobile-below-header-no-toggle-submenu-active-color', 'smvmt-settings[below-header-submenu-active-color-responsive]', 'color', '.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation .sub-menu li.current-menu-item > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation .sub-menu li.current-menu-item:hover > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation .sub-menu li.current_page_item > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-navigation .sub-menu li.current_page_item:hover > a,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle,.smvmt-no-toggle-below-menu-enable.smvmt-header-break-point .smvmt-below-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[below-header-submenu-active-bg-color-responsive]', 'background-color', '.smvmt-below-header .sub-menu li.current-menu-ancestor > a, .smvmt-below-header .sub-menu li.current-menu-item > a, .smvmt-below-header .sub-menu li.current-menu-ancestor:hover > a, .smvmt-below-header .sub-menu li.current-menu-item:hover > a' );

	smvmt_css( 'smvmt-settings[below-header-submenu-border-color]', 'border-color', '.smvmt-below-header .sub-menu' );
	smvmt_css( 'smvmt-settings[below-header-submenu-item-b-color]', 'border-color', '.smvmt-desktop .smvmt-below-header-menu.submenu-with-border .sub-menu a' );
	/**
	 * Above Header Height
	 */
	wp.customize( 'smvmt-settings[above-header-height]', function( value ) {
		value.bind( function( height ) {

			var max_height = '26px';
			var padding = '; padding-top: .8em; padding-bottom: .8em;';
			if ( height >= 30 ) {
				max_height = ( height - 6 ) + 'px';
			}
			if ( height < 60 ) {
				padding = '; padding-top: .35em; padding-bottom: .35em;';
			}

			var dynamicStyle = '';
			dynamicStyle += '.smvmt-above-header { line-height: ' + height + 'px; } ';
			dynamicStyle += '.smvmt-above-header-section-wrap { min-height: ' + height + 'px; } ';
			dynamicStyle += '.smvmt-above-header .smvmt-search-menu-icon .search-field { max-height: ' + max_height + ';' + padding + ' }';

			smvmt_add_dynamic_css( 'above-header-height', dynamicStyle );

			$( document ).trigger( 'masthead-height-changed' );
		} );
	} );

	/**
	 * Above Header Responsive Background Image
	 */
	smvmt_apply_responsive_background_css( 'smvmt-settings[above-header-bg-obj-responsive]', '.smvmt-above-header, .smvmt-header-break-point .smvmt-above-header', 'desktop', '.smvmt-above-header, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul', 'mobile-above-header' );

	smvmt_apply_responsive_background_css( 'smvmt-settings[above-header-bg-obj-responsive]', '.smvmt-header-break-point .smvmt-above-header', 'tablet', '.smvmt-above-header, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul', 'mobile-above-header' );

	smvmt_apply_responsive_background_css( 'smvmt-settings[above-header-bg-obj-responsive]', '.smvmt-header-break-point .smvmt-above-header', 'mobile', '.smvmt-above-header, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul', 'mobile-above-header' );

	/*
	 * Above header menu label
	 */

	wp.customize( 'smvmt-settings[above-header-menu-label]', function( setting ) {
		setting.bind( function( label ) {
			if( $('button.menu-above-header-toggle .mobile-menu-wrap .mobile-menu').length > 0 ) {
				if ( label != '' ) {
					$('button.menu-above-header-toggle .mobile-menu-wrap .mobile-menu').text(label);
				} else {
					$('button.menu-above-header-toggle .mobile-menu-wrap').remove();
				}
			} else {
				var html = $('button.menu-above-header-toggle').html();
				if( '' != label ) {
					html += '<div class="mobile-menu-wrap"><span class="mobile-menu">'+ label +'</span> </div>';
				}
				$('button.menu-above-header-toggle').html( html )
			}
		} );
	} );

	/*
	* Below header menu label
	*/
	wp.customize( 'smvmt-settings[below-header-menu-label]', function( setting ) {
		setting.bind( function( label ) {
			if( $('button.menu-below-header-toggle .mobile-menu-wrap .mobile-menu').length > 0 ) {
				if ( label != '' ) {
					$('button.menu-below-header-toggle .mobile-menu-wrap .mobile-menu').text(label);
				} else {
					$('button.menu-below-header-toggle .mobile-menu-wrap').remove();
				}
			} else {
				var html = $('button.menu-below-header-toggle').html();
				if( '' != label ) {
					html += '<div class="mobile-menu-wrap"><span class="mobile-menu">'+ label +'</span> </div>';
				}
				$('button.menu-below-header-toggle').html( html )
			}
		} );
	} );

	/* In tabs */
	smvmt_apply_responsive_background_css( 'smvmt-settings[above-header-menu-bg-obj-responsive]', '.smvmt-above-header-menu,.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu', 'desktop', '', 'mobile-above-header' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[above-header-menu-bg-obj-responsive]', '.smvmt-above-header-menu,.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu', 'tablet', '', 'mobile-above-header' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[above-header-menu-bg-obj-responsive]', '.smvmt-above-header-menu,.smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation ul.smvmt-above-header-menu', 'mobile', '', 'mobile-above-header' );

	smvmt_css( 'smvmt-settings[above-header-divider]', 'border-bottom-width', '.smvmt-above-header, .smvmt-header-break-point .smvmt-above-header-merged-responsive .smvmt-above-header', 'px' );
	smvmt_css( 'smvmt-settings[above-header-divider-color]', 'border-bottom-color', '.smvmt-above-header, .smvmt-header-break-point .smvmt-above-header-merged-responsive .smvmt-above-header' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-text-color-responsive]', 'color', '.smvmt-above-header-section .user-select, .smvmt-above-header-section .widget, .smvmt-above-header-section .widget-title' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-link-color-responsive]', 'color', '.smvmt-above-header-section .user-select a, .smvmt-above-header-section .smvmt-search-menu-icon .search-submit, .smvmt-above-header-section .widget a, .smvmt-header-break-point .smvmt-above-header-section .user-select a, .smvmt-above-header-section .smvmt-header-break-point .smvmt-above-header-section .user-select a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-link-h-color-responsive]', 'color', '.smvmt-above-header-section .user-select a:hover, .smvmt-above-header-section .widget a:hover, .smvmt-header-break-point .smvmt-above-header-section .user-select a:hover, .smvmt-above-header-section .smvmt-header-break-point .smvmt-above-header-section .user-select a:hover' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-menu-color-responsive]', 'color', '.smvmt-above-header-navigation a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-menu-h-color-responsive]', 'color', '.smvmt-above-header-navigation li:hover > a, .smvmt-above-header-navigation .menu-item.focus > a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-menu-h-bg-color-responsive]', 'background-color', '.smvmt-above-header-navigation li:hover, .smvmt-above-header-navigation li:hover > a', 'background-color' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-menu-active-color-responsive]', 'color', '.smvmt-above-header-navigation li.current-menu-item > a,.smvmt-above-header-navigation li.current-menu-ancestor > a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-submenu-text-color-responsive]', 'color', '.smvmt-above-header-menu .sub-menu, .smvmt-above-header-menu .sub-menu a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-submenu-bg-color-responsive]', 'background-color', '.smvmt-above-header-menu .sub-menu, .smvmt-header-break-point .smvmt-above-header-section-separated .smvmt-above-header-navigation .sub-menu' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-submenu-hover-color-responsive]', 'color', '.smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-above-header-menu .sub-menu li:focus > a, .smvmt-above-header-menu .sub-menu li.focus > a,.smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.focus > .smvmt-menu-toggle, .smvmt-desktop .smvmt-above-header-navigation .smvmt-above-header-menu .smvmt-megamenu-li .sub-menu li a:hover, .smvmt-desktop .smvmt-above-header-navigation .smvmt-above-header-menu .smvmt-megamenu-li .sub-menu .menu-item a:focus' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-submenu-bg-hover-color-responsive]', 'background-color', '.smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-desktop .smvmt-mega-menu-enabled.smvmt-above-header-menu .sub-menu li a:hover' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-submenu-active-color-responsive]', 'color', '.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a' );

	smvmt_color_responsive_css( 'header-sections', 'smvmt-settings[above-header-submenu-active-bg-color-responsive]', 'background-color', '.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > a, .smvmt-above-header-menu .sub-menu li.current-menu-item > a, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > a, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > a' );

	smvmt_color_responsive_css( 'mobile-header-above-header-submenu-hover-color', 'smvmt-settings[above-header-submenu-hover-color-responsive]', 'color', '.smvmt-header-break-point .smvmt-above-header-menu .sub-menu li:hover > a, .smvmt-header-break-point .smvmt-above-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .smvmt-header-break-point .smvmt-above-header-menu .sub-menu li:focus > a' );

	smvmt_color_responsive_css( 'mobile-header-above-header-submenu-active-color', 'smvmt-settings[above-header-submenu-active-color-responsive]', 'color', '.smvmt-above-header-menu .sub-menu li.current-menu-ancestor > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-ancestor.focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:hover > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item:focus > .smvmt-menu-toggle, .smvmt-above-header-menu .sub-menu li.current-menu-item.focus > .smvmt-menu-toggle' );

	smvmt_css( 'smvmt-settings[above-header-submenu-border-color]', 'border-color', '.smvmt-above-header .sub-menu, .smvmt-above-header .sub-menu a' );
	smvmt_css( 'smvmt-settings[above-header-submenu-item-b-color]', 'border-color', '.smvmt-desktop .smvmt-above-header-menu.submenu-with-border .sub-menu a' );

	smvmt_generate_outside_font_family_css( 'smvmt-settings[above-header-font-family]', '.smvmt-above-header-menu, .smvmt-above-header .user-select' );
	smvmt_css( 'smvmt-settings[above-header-font-weight]', 'font-weight', '.smvmt-above-header-menu, .smvmt-above-header .user-select' );
	smvmt_responsive_font_size( 'smvmt-settings[above-header-font-size]', '.smvmt-above-header-menu, .smvmt-above-header .user-select' );
	smvmt_css( 'smvmt-settings[above-header-text-transform]', 'text-transform', '.smvmt-above-header-menu, .smvmt-above-header .user-select' );

	smvmt_generate_outside_font_family_css( 'smvmt-settings[font-family-above-header-dropdown-menu]', '.smvmt-above-header .sub-menu' );
	smvmt_css( 'smvmt-settings[font-weight-above-header-dropdown-menu]', 'font-weight', '.smvmt-above-header .sub-menu' );
	smvmt_responsive_font_size( 'smvmt-settings[font-size-above-header-dropdown-menu]', '.smvmt-above-header .sub-menu' );
	smvmt_css( 'smvmt-settings[text-transform-above-header-dropdown-menu]', 'text-transform', '.smvmt-above-header .sub-menu' );

	/**
	 * Above header submenu border
	 */
	wp.customize( 'smvmt-settings[above-header-submenu-border]', function( value ) {
		value.bind( function( border ) {
			if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {
				var dynamicStyle = '.smvmt-desktop .smvmt-above-header-menu.submenu-with-border .sub-menu';
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'  + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';
					dynamicStyle += '.smvmt-desktop .smvmt-above-header-menu.submenu-with-border .sub-menu .sub-menu';
					dynamicStyle += '{';
					dynamicStyle += 'top:-'   + border.top + 'px;';
					dynamicStyle += '}';
					// Submenu items goes outside?
					dynamicStyle += '@media (min-width: 769px){';
					dynamicStyle += '.smvmt-above-header-menu ul li.smvmt-left-align-sub-menu:hover > ul, .smvmt-above-header-menu ul li.smvmt-left-align-sub-menu.focus > ul';
					dynamicStyle += '{';
					dynamicStyle += 'margin-left:-'   + ( +border.left + +border.right ) + 'px;';
					dynamicStyle += '}';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'above-header-submenu-border', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	/**
	 * Above header submenu divider
	 */
	wp.customize( 'smvmt-settings[above-header-submenu-item-border]', function( value ) {
		value.bind( function( border ) {
			var color = wp.customize( 'smvmt-settings[above-header-submenu-item-b-color]' ).get();
			if( true === border ) {
				var dynamicStyle  = '.smvmt-desktop .smvmt-above-header-menu.submenu-with-border .sub-menu a';
					dynamicStyle += '{';
					dynamicStyle += 'border-bottom-width:'   + ( (true === border) ? '1px;' : '0px;' );
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += 'border-color:'        + color + ';';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'above-header-submenu-item-border', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	/**
	 * Below header submenu border
	 */
	wp.customize( 'smvmt-settings[below-header-submenu-border]', function( value ) {
		value.bind( function( border ) {
			if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {
				var dynamicStyle = '.smvmt-desktop .smvmt-below-header-menu.submenu-with-border .sub-menu';
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'  + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';
					dynamicStyle += '.smvmt-desktop .smvmt-below-header-menu.submenu-with-border .sub-menu .sub-menu';
					dynamicStyle += '{';
					dynamicStyle += 'top:-'   + border.top + 'px;';
					dynamicStyle += '}';
					// Submenu items goes outside?
					dynamicStyle += '@media (min-width: 769px){';
					dynamicStyle += '.smvmt-below-header-menu ul li.smvmt-left-align-sub-menu:hover > ul, .smvmt-below-header-menu ul li.smvmt-left-align-sub-menu.focus > ul';
					dynamicStyle += '{';
					dynamicStyle += 'margin-left:-'   + ( +border.left + +border.right ) + 'px;';
					dynamicStyle += '}';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'below-header-submenu-border', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );
	/**
	 * below header submenu divider
	 */
	wp.customize( 'smvmt-settings[below-header-submenu-item-border]', function( value ) {
		value.bind( function( border ) {
			var color = wp.customize( 'smvmt-settings[below-header-submenu-item-b-color]' ).get();
			if( true === border ) {
				var dynamicStyle  = '.smvmt-desktop .smvmt-below-header-menu.submenu-with-border .sub-menu a';
					dynamicStyle += '{';
					dynamicStyle += 'border-bottom-width:'   + ( (true === border) ? '1px;' : '0;' );
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += 'border-color:'        + color + ';';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'below-header-submenu-item-border', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

} )( jQuery );
