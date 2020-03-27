/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * Use function smvmt_css() to generate dynamic CSS
 *
 * E.g. smvmt_css( CONTROL, CSS_PROPERTY, SELECTOR, UNIT )
 *
 * @package smvmt
 * @since  1.0.0
 */

( function( $ ) {

	/**
	 * Primary Header Responsive Background Image
	 */
	smvmt_apply_responsive_background_css( 'smvmt-settings[header-bg-obj-responsive]', '.main-header-bar, .smvmt-header-break-point .main-header-bar', 'desktop' );

	smvmt_apply_responsive_background_css( 'smvmt-settings[header-bg-obj-responsive]', '.main-header-bar, .smvmt-header-break-point .main-header-bar', 'tablet' );

	smvmt_apply_responsive_background_css( 'smvmt-settings[header-bg-obj-responsive]', '.main-header-bar, .smvmt-header-break-point .main-header-bar', 'mobile' );

	/**
	 * Primary Menu + Custom Menu Items
	 */
	wp.customize( 'smvmt-settings[primary-menu-color-responsive]', function( value ) {
		value.bind( function( color ) {

			var DeskVal = '',
					TabletFontVal = '',
					MobileVal = '',
					mobile_style = '',
					tablet_style = '';

			if ( '' != color.desktop ) {
				DeskVal = color.desktop;
			}
			if ( '' != color.tablet ) {
				TabletFontVal = color.tablet;
			}
			if ( '' != color.mobile ) {
				MobileVal = color.mobile;
			}

			if( '' != color ) {
				var dynamicStyle = '.main-header-menu, .main-header-menu a,.smvmt-masthead-custom-menu-items, .smvmt-masthead-custom-menu-items a, .smvmt-header-break-point .smvmt-header-sections-navigation a, .smvmt-header-sections-navigation, .smvmt-header-sections-navigation a, .smvmt-above-header-menu-items a,.smvmt-below-header-menu-items, .smvmt-below-header-menu-items a{ color: ' + DeskVal + ';}';

				// Sticky Header colors for Custom Menu.
				dynamicStyle   += '#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu > li > a, #smvmt-fixed-header .smvmt-masthead-custom-menu-items, #smvmt-fixed-header .smvmt-masthead-custom-menu-items a, .main-header-bar.smvmt-sticky-active, .main-header-bar.smvmt-sticky-active .main-header-menu > li > a, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items a{ color: ' + DeskVal + ';}';


				if( '' != TabletFontVal ) {
					tablet_style  += '@media (max-width: 768px) { .main-header-menu, .main-header-menu a,.smvmt-header-break-point .main-header-menu a,.smvmt-masthead-custom-menu-items, .smvmt-masthead-custom-menu-items a, .smvmt-header-break-point .smvmt-header-sections-navigation a, .smvmt-header-sections-navigation, .smvmt-header-sections-navigation a, .smvmt-above-header-menu-items a,.smvmt-below-header-menu-items, .smvmt-below-header-menu-items a{ color: ' + TabletFontVal + ';}';
					// Sticky Header colors for Custom Menu.
					tablet_style   += '#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu > li > a, #smvmt-fixed-header .smvmt-masthead-custom-menu-items, #smvmt-fixed-header .smvmt-masthead-custom-menu-items a, .main-header-bar.smvmt-sticky-active, .main-header-bar.smvmt-sticky-active .main-header-menu > li > a, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items a{ color: ' + TabletFontVal + ';}';

				}

				if( '' != MobileVal ) {
					mobile_style  += '@media (max-width: 544px ) { .main-header-menu, .main-header-menu a,.smvmt-header-break-point .main-header-menu a,.smvmt-masthead-custom-menu-items, .smvmt-masthead-custom-menu-items a, .smvmt-header-break-point .smvmt-header-sections-navigation a, .smvmt-header-sections-navigation, .smvmt-header-sections-navigation a, .smvmt-above-header-menu-items a,.smvmt-below-header-menu-items, .smvmt-below-header-menu-items a{ color: ' + MobileVal + ';}';
					// Sticky Header colors for Custom Menu.
					mobile_style   += '#smvmt-fixed-header .main-header-menu, #smvmt-fixed-header .main-header-menu > li > a, #smvmt-fixed-header .smvmt-masthead-custom-menu-items, #smvmt-fixed-header .smvmt-masthead-custom-menu-items a, .main-header-bar.smvmt-sticky-active, .main-header-bar.smvmt-sticky-active .main-header-menu > li > a, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items, .main-header-bar.smvmt-sticky-active .smvmt-masthead-custom-menu-items a{ color: ' + MobileVal + ';}';

				}

				dynamicStyle += tablet_style + mobile_style;

				smvmt_add_dynamic_css( 'primary-menu-color-responsive', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-menu-h-color-responsive]', 		'color', 				'.main-header-menu a:hover, .main-header-menu li:hover > a, .main-header-menu li.focus > a,  .main-header-menu li:hover > .smvmt-menu-toggle, .main-header-menu li.focus > .smvmt-menu-toggle, .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-header-sections-navigation li.current-menu-item > a' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-menu-h-bg-color-responsive]', 	'background-color', 	'.main-header-menu a:hover, .main-header-menu li:hover > a, .main-header-menu li.focus > a, .smvmt-header-sections-navigation li.hover > a,.smvmt-header-sections-navigation li.focus > a' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-menu-a-color-responsive]', 		'color',				'.main-header-menu .current-menu-item > a, .main-header-menu .current-menu-ancestor > a, .main-header-menu .current_page_item > a,.smvmt-header-sections-navigation li.current-menu-item > a, .smvmt-above-header-menu-items li.current-menu-item > a,.smvmt-below-header-menu-items li.current-menu-item > a,.smvmt-header-sections-navigation li.current-menu-ancestor > a, .smvmt-above-header-menu-items li.current-menu-ancestor > a,.smvmt-below-header-menu-items li.current-menu-ancestor > a' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-menu-a-bg-color-responsive]', 	'background-color', 	'.main-header-menu .current-menu-item > a, .main-header-menu .current-menu-ancestor > a, .main-header-menu .current_page_item > a,.smvmt-header-sections-navigation li.current-menu-item > a, .smvmt-above-header-menu-items li.current-menu-item > a,.smvmt-below-header-menu-items li.current-menu-item > a,.smvmt-header-sections-navigation li.current-menu-ancestor > a, .smvmt-above-header-menu-items li.current-menu-ancestor > a,.smvmt-below-header-menu-items li.current-menu-ancestor > a, .smvmt-fullscreen-menu-overlay .main-header-menu li.current-menu-item > a, .smvmt-fullscreen-menu-overlay .main-header-menu li.current-menu-ancestor > a, .smvmt-fullscreen-menu-overlay .main-header-menu li.current_page_item > a' );

	/**
	 * Primary Submenu
	 */

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-submenu-bg-color-responsive]', 	 'background-color', 	'.main-navigation .sub-menu, .smvmt-header-break-point .main-header-menu ul' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-submenu-color-responsive]', 	 'color', 				'.main-header-menu .sub-menu, .main-header-menu .sub-menu a, .main-header-menu .children a, .smvmt-header-sections-navigation .sub-menu a, .smvmt-above-header-menu-items .sub-menu a, .smvmt-below-header-menu-items .sub-menu a' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-submenu-h-color-responsive]', 	 'color', 				'.main-header-menu .sub-menu a:hover, .main-header-menu .children a:hover, .main-header-menu .sub-menu li:hover > a, .main-header-menu .children li:hover > a,.main-header-menu .sub-menu li.focus > a, .main-header-menu .children li.focus > a, .main-header-menu .sub-menu li:hover > .smvmt-menu-toggle, .main-header-menu .sub-menu li.focus > .smvmt-menu-toggle, .smvmt-header-sections-navigation .sub-menu a:hover, .smvmt-above-header-menu-items .sub-menu a:hover, .smvmt-below-header-menu-items .sub-menu a:hover, .smvmt-desktop .main-header-menu .smvmt-megamenu-li .sub-menu li a:hover, .smvmt-desktop .main-header-menu .smvmt-megamenu-li .sub-menu .menu-item a:focus' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-submenu-h-bg-color-responsive]', 'background-color', 	'.main-header-menu .sub-menu a:hover, .main-header-menu .children a:hover, .main-header-menu .sub-menu li:hover > a, .main-header-menu .children li:hover > a,.main-header-menu .sub-menu li.focus > a, .main-header-menu .children li.focus > a, .smvmt-header-sections-navigation .sub-menu a:hover, .smvmt-above-header-menu-items .sub-menu a:hover, .smvmt-below-header-menu-items .sub-menu a:hover, .smvmt-desktop .smvmt-mega-menu-enabled.main-header-menu .sub-menu li a:hover, .smvmt-desktop .smvmt-mega-menu-enabled.main-header-menu .sub-menu .menu-item a:focus' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-submenu-a-color-responsive]', 	 'color', 				'.smvmt-header-break-point.smvmt-no-toggle-menu-enable .main-header-menu li.current-menu-item > .smvmt-menu-toggle:hover, .smvmt-header-break-point.smvmt-no-toggle-menu-enable .main-header-menu li.current-menu-item > .smvmt-menu-toggle, .main-header-menu .sub-menu li.current-menu-item > a, .main-header-menu .children li.current_page_item > a, .main-header-menu .sub-menu li.current-menu-ancestor > a, .main-header-menu .children li.current_page_ancestor > a, .main-header-menu .sub-menu li.current_page_item > a, .main-header-menu .children li.current_page_item > a, .smvmt-header-sections-navigation .sub-menu li.current-menu-item > a, .smvmt-above-header-menu-items .sub-menu li.current-menu-item > a, .smvmt-below-header-menu-items .sub-menu li.current-menu-item > a, .smvmt-header-break-point .main-header-menu .sub-menu li.current-menu-item > a, .smvmt-header-break-point .main-header-menu .sub-menu li.current_page_item > a' );

	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-submenu-a-bg-color-responsive]', 'background-color', 	'.main-header-menu .sub-menu li.current-menu-item > a, .main-header-menu .children li.current_page_item > a, .main-header-menu .sub-menu li.current-menu-ancestor > a, .main-header-menu .children li.current_page_ancestor > a, .main-header-menu .sub-menu li.current_page_item > a, .main-header-menu .children li.current_page_item > a, .smvmt-header-sections-navigation .sub-menu li.current-menu-item > a, .smvmt-above-header-menu-items .sub-menu li.current-menu-item > a, .smvmt-below-header-menu-items .sub-menu li.current-menu-item > a, .smvmt-header-break-point .main-header-menu .sub-menu li.current-menu-item > a, .smvmt-header-break-point .main-header-menu .sub-menu li.current_page_item > a' );


	/**
	 * Content background color
	 */
	wp.customize( 'smvmt-settings[content-bg-obj]', function( value ) {
		value.bind( function( bg_obj ) {
			if( '' != bg_obj ) {

				var content_bg_image = bg_obj['background-image'] || '';
				var content_bg_color = bg_obj['background-color'] || '';

				if( jQuery( 'body' ).hasClass( 'smvmt-separate-container' ) && jQuery( 'body' ).hasClass( 'smvmt-two-container' )){
					var dynamicStyle   = '.smvmt-separate-container .smvmt-article-single, .smvmt-separate-container .comment-respond,.smvmt-separate-container .smvmt-comment-list li, .smvmt-separate-container .smvmt-woocommerce-container, .smvmt-separate-container .error-404, .smvmt-separate-container .no-results, .single.smvmt-separate-container .smvmt-author-meta, .smvmt-separate-container .related-posts, .smvmt-separate-container .comments-area, .smvmt-separate-container .comments-count-wrapper, .smvmt-separate-container.smvmt-two-container #secondary .widget { {{css}} }';
					smvmt_background_obj_css( wp.customize, bg_obj, 'content-bg-obj', dynamicStyle );
				}
				else if ( jQuery( 'body' ).hasClass( 'smvmt-separate-container' ) ) {
					var dynamicStyle   = '.smvmt-separate-container .smvmt-article-single, .smvmt-separate-container .comment-respond,.smvmt-separate-container .smvmt-comment-list li, .smvmt-separate-container .smvmt-woocommerce-container, .smvmt-separate-container .error-404, .smvmt-separate-container .no-results, .single.smvmt-separate-container .smvmt-author-meta, .smvmt-separate-container .related-posts, .smvmt-separate-container .comments-area, .smvmt-separate-container .comments-count-wrapper { {{css}} }';
					smvmt_background_obj_css( wp.customize, bg_obj, 'content-bg-obj', dynamicStyle );
				}
				else if ( jQuery( 'body' ).hasClass( 'smvmt-plain-container' ) && ( jQuery( 'body' ).hasClass( 'smvmt-box-layout' ) || jQuery( 'body' ).hasClass( 'smvmt-padded-layout' ) ) ) {
					var dynamicStyle   = '.smvmt-box-layout.smvmt-plain-container .site-content, .smvmt-padded-layout.smvmt-plain-container .site-content { {{css}} }';
					smvmt_background_obj_css( wp.customize, bg_obj, 'content-bg-obj', dynamicStyle );
				}


				var blog_grid = (typeof ( wp.customize._value['smvmt-settings[blog-grid]'] ) != 'undefined') ? wp.customize._value['smvmt-settings[blog-grid]']._value : 1;
				var blog_layout = (typeof ( wp.customize._value['smvmt-settings[blog-layout]'] ) != 'undefined') ? wp.customize._value['smvmt-settings[blog-layout]']._value : 'blog-layout-1';

				if( 'blog-layout-1' == blog_layout && 1 != blog_grid )
				{
					var dynamicStyle   = '.smvmt-separate-container .blog-layout-1, .smvmt-separate-container .blog-layout-2, .smvmt-separate-container .blog-layout-3 { {{css}} }';
					smvmt_background_obj_css( wp.customize, bg_obj, 'content-bg-obj-post', dynamicStyle );
				} else {
					var dynamicStyle   = '.smvmt-separate-container .smvmt-article-post { {{css}} }';
					smvmt_background_obj_css( wp.customize, bg_obj, 'content-bg-obj-post', dynamicStyle );

					var dynamicStyle  = '.smvmt-separate-container .blog-layout-1, .smvmt-separate-container .blog-layout-2, .smvmt-separate-container .blog-layout-3 {';
						dynamicStyle += '	background-color: transparent;';
						dynamicStyle += '	background-image: none;';
						dynamicStyle += '}';
					smvmt_add_dynamic_css( 'content-bg-obj-blog-layouts', dynamicStyle );
				}

			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	/**
	 * Body
	 */
	smvmt_css( 'smvmt-settings[archive-summary-box-bg-color]', 'background-color', '.smvmt-separate-container .smvmt-archive-description');
	smvmt_css( 'smvmt-settings[archive-summary-box-title-color]', 'color', '.smvmt-archive-description .page-title');
	smvmt_css( 'smvmt-settings[archive-summary-box-text-color]', 'color', '.smvmt-archive-description');
	/**
	 * Content <h1> to <h6> headings
	 */
	smvmt_css( 'smvmt-settings[h1-color]', 'color', 'h1, .entry-content h1' );
	smvmt_css( 'smvmt-settings[h2-color]', 'color', 'h2, .entry-content h2' );
	smvmt_css( 'smvmt-settings[h3-color]', 'color', 'h3, .entry-content h3' );
	smvmt_css( 'smvmt-settings[h4-color]', 'color', 'h4, .entry-content h4' );
	smvmt_css( 'smvmt-settings[h5-color]', 'color', 'h5, .entry-content h5' );
	smvmt_css( 'smvmt-settings[h6-color]', 'color', 'h6, .entry-content h6' );

	/**
	 * Header
	 */
	smvmt_css( 'smvmt-settings[header-color-site-title]', 'color', '.site-title a, .site-title a:focus, .site-title a:hover, .site-title a:visited' );
	smvmt_css( 'smvmt-settings[header-color-h-site-title]', 'color', '.site-header .site-title a:hover' );
	smvmt_css( 'smvmt-settings[header-color-site-tagline]',	'color', '.site-header .site-description' );

	/**
	 * Primary Menu
	 */
	/**
	 * Primary Menu Bg colors & image
	 */

	var headersectionSelector = '';

	var primaryMenuBgStyle = '.main-header-menu, .smvmt-header-break-point .main-header-menu, .smvmt-header-break-point .smvmt-header-custom-item, .smvmt-header-break-point .smvmt-header-sections-navigation';

	if ( jQuery('body').hasClass('smvmt-primary-menu-disabled') ) {
		headersectionSelector = ', .smvmt-above-header-menu-items, .smvmt-below-header-menu-items';
		primaryMenuBgStyle += headersectionSelector;
	}

	smvmt_apply_responsive_background_css( 'smvmt-settings[primary-menu-bg-obj-responsive]', primaryMenuBgStyle, 'desktop' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[primary-menu-bg-obj-responsive]', primaryMenuBgStyle, 'tablet' );
	smvmt_apply_responsive_background_css( 'smvmt-settings[primary-menu-bg-obj-responsive]', primaryMenuBgStyle, 'mobile' );
	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-menu-h-bg-color-responsive]', 	'background-color', 	'.main-header-menu a:hover, .main-header-menu li:hover > a, .main-header-menu li.focus > a, .smvmt-header-sections-navigation li.hover > a,.smvmt-header-sections-navigation li.focus > a' );
	smvmt_color_responsive_css( 'colors-background', 'smvmt-settings[primary-menu-h-color-responsive]', 		'color', 				'.main-header-menu a:hover, .main-header-menu li:hover > a, .main-header-menu li.focus > a,  .main-header-menu li:hover > .smvmt-menu-toggle, .main-header-menu li.focus > .smvmt-menu-toggle, .main-header-menu .smvmt-masthead-custom-menu-items a:hover, .smvmt-header-sections-navigation li.current-menu-item > a' );


	/**
	 * Single Post / Page Title Color
	 */
	smvmt_css( 'smvmt-settings[entry-title-color]', 'color', '.smvmt-single-post .entry-title, .page-title' );

	/**
	 * Blog / Archive Title
	 */
	smvmt_css( 'smvmt-settings[page-title-color]', 'color', '.entry-title a');

	/**
	 * Blog / Archive Meta
	 */
	smvmt_css( 'smvmt-settings[post-meta-color]', 'color', '.entry-meta, .entry-meta *');
	smvmt_css( 'smvmt-settings[post-meta-link-color]', 'color', '.entry-meta a, .entry-meta a *, .read-more a');
	smvmt_css( 'smvmt-settings[post-meta-link-h-color]', 'color', '.read-more a:hover, .entry-meta a:hover, .entry-meta a:hover *');

	/**
	 * Sidebar
	 */
	smvmt_css( 'smvmt-settings[sidebar-widget-title-color]', 'color', '.secondary .widget-title, .secondary .widget-title *');
	smvmt_css( 'smvmt-settings[sidebar-text-color]', 'color', '.secondary .widget');
	smvmt_css( 'smvmt-settings[sidebar-link-color]', 'color', '.secondary a');
	smvmt_css( 'smvmt-settings[sidebar-link-h-color]', 'color', '.secondary a:hover');
	wp.customize( 'smvmt-settings[sidebar-bg-obj]', function( value ) {
		value.bind( function( bg_obj ) {
			smvmt_background_obj_css( wp.customize, bg_obj, 'sidebar-bg-obj', ' .sidebar-main { {{css}} } ' );
		} );
	} );

	/**
	 * Footer
	 */
	smvmt_css( 'smvmt-settings[footer-color]', 'color', '.smvmt-small-footer' );
	smvmt_css( 'smvmt-settings[footer-link-color]', 'color', '.smvmt-small-footer a' );
	smvmt_css( 'smvmt-settings[footer-link-h-color]', 'color', '.smvmt-small-footer a:hover' );

} )( jQuery );
