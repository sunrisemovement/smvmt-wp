/**
 * This file adds some LIVE to the Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package smvmt
 * @since x.x.x
 */

( function( $ ) {

	/**
	 * Content <h1> to <h6> headings
	 */
	smvmt_css( 'smvmt-settings[heading-base-color]', 'color', 'h1, .entry-content h1, h2, .entry-content h2, h3, .entry-content h3, h4, .entry-content h4, h5, .entry-content h5, h6, .entry-content h6' );

	SMVMT_generate_outside_font_family_css( 'smvmt-settings[font-family-h1]', 'h1, .entry-content h1' );
	smvmt_css('smvmt-settings[font-weight-h1]', 'font-weight', 'h1, .entry-content h1');
	smvmt_css('smvmt-settings[line-height-h1]', 'line-height', 'h1, .entry-content h1, .elementor-widget-heading h1.elementor-heading-title');
	smvmt_css('smvmt-settings[text-transform-h1]', 'text-transform', 'h1, .entry-content h1');

	SMVMT_generate_outside_font_family_css( 'smvmt-settings[font-family-h2]', 'h2, .entry-content h2' );
	smvmt_css('smvmt-settings[font-weight-h2]', 'font-weight', 'h2, .entry-content h2');
	smvmt_css('smvmt-settings[line-height-h2]', 'line-height', 'h2, .entry-content h2, .elementor-widget-heading h2.elementor-heading-title');
	smvmt_css('smvmt-settings[text-transform-h2]', 'text-transform', 'h2, .entry-content h2');

	SMVMT_generate_outside_font_family_css( 'smvmt-settings[font-family-h3]', 'h3, .entry-content h3' );
	smvmt_css('smvmt-settings[font-weight-h3]', 'font-weight', 'h3, .entry-content h3');
	smvmt_css('smvmt-settings[line-height-h3]', 'line-height', 'h3, .entry-content h3, .elementor-widget-heading h3.elementor-heading-title');
	smvmt_css('smvmt-settings[text-transform-h3]', 'text-transform', 'h3, .entry-content h3');


	if ( smvmtCustomizer.page_builder_button_style_css ) {

		var ele_btn_font_family = '';
		var ele_btn_font_weight = '';
		var ele_btn_font_size = '';
		var ele_btn_transform = '';
		var ele_btn_line_height = '';
		var ele_btn_letter_spacing = '';

		if ( 'color-typo' == smvmtCustomizer.elementor_default_color_font_setting || 'typo' == smvmtCustomizer.elementor_default_color_font_setting ) {
			// Button Typo
			ele_btn_font_family = ',.elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';
			ele_btn_font_weight = ',.elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';
			ele_btn_font_size = ',.elementor-button-wrapper .elementor-button.elementor-size-sm, .elementor-button-wrapper .elementor-button.elementor-size-xs, .elementor-button-wrapper .elementor-button.elementor-size-md, .elementor-button-wrapper .elementor-button.elementor-size-lg, .elementor-button-wrapper .elementor-button.elementor-size-xl, .elementor-button-wrapper .elementor-button';
			ele_btn_transform = ',.elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';
			ele_btn_line_height = ',.elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';
			ele_btn_letter_spacing = ',.elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited', 'px';
		}

		// Button Typo
		SMVMT_generate_outside_font_family_css( 'smvmt-settings[font-family-button]', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + ele_btn_font_family );
		SMVMT_generate_font_weight_css( 'smvmt-settings[font-family-button]', 'smvmt-settings[font-weight-button]', 'font-weight', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + ele_btn_font_weight );
		smvmt_css( 'smvmt-settings[text-transform-button]', 'text-transform', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + ele_btn_transform );
		smvmt_responsive_font_size( 'smvmt-settings[font-size-button]', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + ele_btn_font_size );
		smvmt_css( 'smvmt-settings[theme-btn-line-height]', 'line-height', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + ele_btn_line_height );
		smvmt_css( 'smvmt-settings[theme-btn-letter-spacing]', 'letter-spacing', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + ele_btn_letter_spacing, 'px' );

	} else {
		// Button Typo
		SMVMT_generate_outside_font_family_css( 'smvmt-settings[font-family-button]', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );
		SMVMT_generate_font_weight_css( 'smvmt-settings[font-family-button]', 'smvmt-settings[font-weight-button]', 'font-weight', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );
		smvmt_css( 'smvmt-settings[text-transform-button]', 'text-transform', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );
		smvmt_responsive_font_size( 'smvmt-settings[font-size-button]', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );
		smvmt_css( 'smvmt-settings[theme-btn-line-height]', 'line-height', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );
		smvmt_css( 'smvmt-settings[theme-btn-letter-spacing]', 'letter-spacing', 'button, .smvmt-button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]', 'px' );
	}

} )( jQuery );
