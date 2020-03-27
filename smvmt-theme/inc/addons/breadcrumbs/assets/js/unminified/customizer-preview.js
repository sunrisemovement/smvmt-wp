/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package smvmt
 * @since 1.7.0
 */

( function( $ ) {

	/* Breadcrumb Typography */
	smvmt_responsive_font_size(
		'smvmt-settings[breadcrumb-font-size]',
		'.smvmt-breadcrumbs-wrapper .trail-items span, .smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span,  .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator'
	);
	SMVMT_generate_outside_font_family_css(
		'smvmt-settings[breadcrumb-font-family]',
		'.smvmt-breadcrumbs-wrapper .trail-items span, .smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span,  .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator'
	);
	smvmt_css(
		'smvmt-settings[breadcrumb-font-weight]',
		'font-weight',
		'.smvmt-breadcrumbs-wrapper .trail-items span, .smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span,  .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator'
	);
	smvmt_css(
		'smvmt-settings[breadcrumb-text-transform]',
		'text-transform',
		'.smvmt-breadcrumbs-wrapper .trail-items span, .smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span,  .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Line Height */
	smvmt_css(
		'smvmt-settings[breadcrumb-line-height]',
		'line-height',
		'.smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-name, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-item, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs .separator, .smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumb_last, .smvmt-breadcrumbs-wrapper span, .smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .current-item, .smvmt-breadcrumbs-wrapper a, .smvmt-breadcrumbs-wrapper .last, .smvmt-breadcrumbs-wrapper .separator'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Text Color */
	smvmt_color_responsive_css(
		'breadcrumb',
		'smvmt-settings[breadcrumb-active-color-responsive]',
		'color',
		'.smvmt-breadcrumbs-wrapper .trail-items .trail-end, .smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast .breadcrumb_last, .smvmt-breadcrumbs-wrapper .current-item, .smvmt-breadcrumbs-wrapper .last'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Link Color */
	smvmt_color_responsive_css(
		'breadcrumb',
		'smvmt-settings[breadcrumb-text-color-responsive]',
		'color',
		'.smvmt-breadcrumbs-wrapper .trail-items a, .smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast a, .smvmt-breadcrumbs-wrapper .breadcrumbs a, .smvmt-breadcrumbs-wrapper .rank-math-breadcrumb a'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Hover Color */
	smvmt_color_responsive_css(
		'breadcrumb',
		'smvmt-settings[breadcrumb-hover-color-responsive]',
		'color',
		'.smvmt-breadcrumbs-wrapper .trail-items a:hover, .smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast a:hover, .smvmt-breadcrumbs-wrapper .breadcrumbs a:hover, .smvmt-breadcrumbs-wrapper .rank-math-breadcrumb a:hover'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Separator Color */
	smvmt_color_responsive_css(
		'breadcrumb',
		'smvmt-settings[breadcrumb-separator-color]',
		'color',
		'.smvmt-breadcrumbs-wrapper .trail-items li::after, .smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .rank-math-breadcrumb .separator'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Background Color */
	smvmt_color_responsive_css(
		'breadcrumb',
		'smvmt-settings[breadcrumb-bg-color]',
		'background-color',
		'.smvmt-breadcrumbs-wrapper, .main-header-bar.smvmt-header-breadcrumb, .smvmt-primary-sticky-header-active .main-header-bar.smvmt-header-breadcrumb'
	);

	/* Breadcrumb default, Yoast SEO Breadcrumb, Breadcrumb NavXT, Ran Math Breadcrumb - Alignment */
	smvmt_css( 'smvmt-settings[breadcrumb-alignment]',
		'text-align',
		'.smvmt-breadcrumbs-wrapper'
	);

	/**
	 * Breadcrumb Spacing
	 */
	wp.customize( 'smvmt-settings[breadcrumb-spacing]', function( value ) {
		value.bind( function( padding ) {
			if( 'smvmt_header_markup_after' == wp.customize( 'smvmt-settings[breadcrumb-position]' ).get() ) {
				smvmt_responsive_spacing( 'smvmt-settings[breadcrumb-spacing]','.main-header-bar.smvmt-header-breadcrumb', 'padding',  ['top', 'right', 'bottom', 'left' ] );
			} else if( 'SMVMT_masthead_content' == wp.customize( 'smvmt-settings[breadcrumb-position]' ).get() ) {
				smvmt_responsive_spacing( 'smvmt-settings[breadcrumb-spacing]','.smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .breadcrumbs, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .rank-math-breadcrumb, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs-inner .smvmt-breadcrumbs', 'padding',  ['top', 'right', 'bottom', 'left' ] );
			} else {
				smvmt_responsive_spacing( 'smvmt-settings[breadcrumb-spacing]','.smvmt-breadcrumbs-wrapper #smvmt-breadcrumbs-yoast, .smvmt-breadcrumbs-wrapper .breadcrumbs, .smvmt-breadcrumbs-wrapper .rank-math-breadcrumb, .smvmt-breadcrumbs-wrapper .smvmt-breadcrumbs', 'padding',  ['top', 'right', 'bottom', 'left' ] );
			}
		} );
	} );

} )( jQuery );
