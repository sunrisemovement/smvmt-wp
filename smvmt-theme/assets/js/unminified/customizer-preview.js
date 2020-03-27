/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package smvmt
 */

/**
 * Generate font size in PX & REM
 */
function smvmt_font_size_rem( size, with_rem, device ) {

	var css = '';

	if( size != '' ) {

		var device = ( typeof device != undefined ) ? device : 'desktop';

		// font size with 'px'.
		css = 'font-size: ' + size + 'px;';

		// font size with 'rem'.
		if ( with_rem ) {
			var body_font_size = wp.customize( 'smvmt-settings[font-size-body]' ).get();

			body_font_size['desktop'] 	= ( body_font_size['desktop'] != '' ) ? body_font_size['desktop'] : 15;
			body_font_size['tablet'] 	= ( body_font_size['tablet'] != '' ) ? body_font_size['tablet'] : body_font_size['desktop'];
			body_font_size['mobile'] 	= ( body_font_size['mobile'] != '' ) ? body_font_size['mobile'] : body_font_size['tablet'];

			css += 'font-size: ' + ( size / body_font_size[device] ) + 'rem;';
		}
	}

	return css;
}


/**
 * Apply CSS for the element
 */
function smvmt_color_responsive_css( addon, control, css_property, selector ) {

	wp.customize( control, function( value ) {
		value.bind( function( value ) {
			if ( value.desktop || value.mobile || value.tablet ) {
				// Remove <style> first!
				control = control.replace( '[', '-' );
				control = control.replace( ']', '' );
				jQuery( 'style#' + control + '-' + addon ).remove();

				var DeskVal = '',
					TabletFontVal = '',
					MobileVal = '';

				if ( '' != value.desktop ) {
					DeskVal = css_property + ': ' + value.desktop;
				}
				if ( '' != value.tablet ) {
					TabletFontVal = css_property + ': ' + value.tablet;
				}
				if ( '' != value.mobile ) {
					MobileVal = css_property + ': ' + value.mobile;
				}

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '-' + addon + '">'
					+ selector + '	{ ' + DeskVal + ' }'
					+ '@media (max-width: 768px) {' + selector + '	{ ' + TabletFontVal + ' } }'
					+ '@media (max-width: 544px) {' + selector + '	{ ' + MobileVal + ' } }'
					+ '</style>'
				);

			} else {
				wp.customize.preview.send( 'refresh' );
				jQuery( 'style#' + control + '-' + addon ).remove();
			}

		} );
	} );
}


/**
 * Responsive Font Size CSS
 */
function smvmt_responsive_font_size( control, selector ) {

	wp.customize( control, function( value ) {
		value.bind( function( value ) {

			if ( value.desktop || value.mobile || value.tablet ) {
				// Remove <style> first!
				control = control.replace( '[', '-' );
				control = control.replace( ']', '' );
				jQuery( 'style#' + control + '-' + css_property ).remove();

				var fontSize = '',
					tabletFontSize = '',
					mobileFontSize = '',
					css_property = 'font-size';

				if ( '' != value.desktop ) {
					fontSize = 'font-size: ' + value.desktop + value['desktop-unit'];
				}
				if ( '' != value.tablet ) {
					tabletFontSize = 'font-size: ' + value.tablet + value['tablet-unit'];
				}
				if ( '' != value.mobile ) {
					mobileFontSize = 'font-size: ' + value.mobile + value['mobile-unit'];
				}

				if( value['desktop-unit'] == 'px' ) {
					fontSize = smvmt_font_size_rem( value.desktop, true, 'desktop' );
				}

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '-' + css_property + '">'
					+ selector + '	{ ' + fontSize + ' }'
					+ '@media (max-width: 768px) {' + selector + '	{ ' + tabletFontSize + ' } }'
					+ '@media (max-width: 544px) {' + selector + '	{ ' + mobileFontSize + ' } }'
					+ '</style>'
				);

			} else {

				jQuery( 'style#' + control ).remove();
			}

		} );
	} );
}

/**
 * Responsive Spacing CSS
 */
function smvmt_responsive_spacing( control, selector, type, side ) {

	wp.customize( control, function( value ) {
		value.bind( function( value ) {
			var sidesString = "";
			var spacingType = "padding";
			if ( value.desktop.top || value.desktop.right || value.desktop.bottom || value.desktop.left || value.tablet.top || value.tablet.right || value.tablet.bottom || value.tablet.left || value.mobile.top || value.mobile.right || value.mobile.bottom || value.mobile.left ) {
				if ( typeof side != undefined ) {
					sidesString = side + "";
					sidesString = sidesString.replace(/,/g , "-");
				}
				if ( typeof type != undefined ) {
					spacingType = type + "";
				}
				// Remove <style> first!
				control = control.replace( '[', '-' );
				control = control.replace( ']', '' );
				jQuery( 'style#' + control + '-' + spacingType + '-' + sidesString ).remove();

				var desktopPadding = '',
					tabletPadding = '',
					mobilePadding = '';

				var paddingSide = ( typeof side != undefined ) ? side : [ 'top','bottom','right','left' ];

				jQuery.each(paddingSide, function( index, sideValue ){
					if ( '' != value['desktop'][sideValue] ) {
						desktopPadding += spacingType + '-' + sideValue +': ' + value['desktop'][sideValue] + value['desktop-unit'] +';';
					}
				});

				jQuery.each(paddingSide, function( index, sideValue ){
					if ( '' != value['tablet'][sideValue] ) {
						tabletPadding += spacingType + '-' + sideValue +': ' + value['tablet'][sideValue] + value['tablet-unit'] +';';
					}
				});

				jQuery.each(paddingSide, function( index, sideValue ){
					if ( '' != value['mobile'][sideValue] ) {
						mobilePadding += spacingType + '-' + sideValue +': ' + value['mobile'][sideValue] + value['mobile-unit'] +';';
					}
				});

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '-' + spacingType + '-' + sidesString + '">'
					+ selector + '	{ ' + desktopPadding +' }'
					+ '@media (max-width: 768px) {' + selector + '	{ ' + tabletPadding + ' } }'
					+ '@media (max-width: 544px) {' + selector + '	{ ' + mobilePadding + ' } }'
					+ '</style>'
				);

			} else {
				wp.customize.preview.send( 'refresh' );
				jQuery( 'style#' + control + '-' + spacingType + '-' + sidesString ).remove();
			}

		} );
	} );
}

/**
 * CSS
 */
function smvmt_css_font_size( control, selector ) {

	wp.customize( control, function( value ) {
		value.bind( function( size ) {

			if ( size ) {

				// Remove <style> first!
				control = control.replace( '[', '-' );
				control = control.replace( ']', '' );
				jQuery( 'style#' + control ).remove();

				var fontSize = 'font-size: ' + size;
				if ( ! isNaN( size ) || size.indexOf( 'px' ) >= 0 ) {
					size = size.replace( 'px', '' );
					fontSize = smvmt_font_size_rem( size, true );
				}

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '">'
					+ selector + '	{ ' + fontSize + ' }'
					+ '</style>'
				);

			} else {

				jQuery( 'style#' + control ).remove();
			}

		} );
	} );
}

/**
 * Return get_hexdec()
 */
function get_hexdec( hex ) {
	var hexString = hex.toString( 16 );
	return parseInt( hexString, 16 );
}

/**
 * Apply CSS for the element
 */
function smvmt_css( control, css_property, selector, unit ) {

	wp.customize( control, function( value ) {
		value.bind( function( new_value ) {

			// Remove <style> first!
			control = control.replace( '[', '-' );
			control = control.replace( ']', '' );

			if ( new_value ) {

				/**
				 *	If ( unit == 'url' ) then = url('{VALUE}')
				 *	If ( unit == 'px' ) then = {VALUE}px
				 *	If ( unit == 'em' ) then = {VALUE}em
				 *	If ( unit == 'rem' ) then = {VALUE}rem.
				 */
				if ( 'undefined' != typeof unit) {

					if ( 'url' === unit ) {
						new_value = 'url(' + new_value + ')';
					} else {
						new_value = new_value + unit;
					}
				}

				// Remove old.
				jQuery( 'style#' + control + '-' + css_property ).remove();

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '-' + css_property + '">'
					+ selector + '	{ ' + css_property + ': ' + new_value + ' }'
					+ '</style>'
				);

			} else {
				// Remove old.
				jQuery( 'style#' + control ).remove();
			}

		} );
	} );
}


/**
 * Dynamic Internal/Embedded Style for a Control
 */
function smvmt_add_dynamic_css( control, style ) {
	control = control.replace( '[', '-' );
	control = control.replace( ']', '' );
	jQuery( 'style#' + control ).remove();

	jQuery( 'head' ).append(
		'<style id="' + control + '">' + style + '</style>'
	);
}

/**
 * Generate background_obj CSS
 */
function smvmt_background_obj_css( wp_customize, bg_obj, ctrl_name, style ) {

	var gen_bg_css 	= '';
	var bg_img		= bg_obj['background-image'];
	var bg_color	= bg_obj['background-color'];

	if( '' === bg_color && '' === bg_img ) {
		wp_customize.preview.send( 'refresh' );
	}else{
		if ( '' !== bg_img && '' !== bg_color) {
			if ( undefined !== bg_color ) {
				gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_img + ');';
			}
		}else if ( '' !== bg_img ) {
			gen_bg_css = 'background-image: url(' + bg_img + ');';
		}else if ( '' !== bg_color ) {
			gen_bg_css = 'background-color: ' + bg_color + ';';
			gen_bg_css += 'background-image: none;';
		}

		if ( '' !== bg_img ) {

			gen_bg_css += 'background-repeat: ' + bg_obj['background-repeat'] + ';';
			gen_bg_css += 'background-position: ' + bg_obj['background-position'] + ';';
			gen_bg_css += 'background-size: ' + bg_obj['background-size'] + ';';
			gen_bg_css += 'background-attachment: ' + bg_obj['background-attachment'] + ';';
		}

		var dynamicStyle = style.replace( "{{css}}", gen_bg_css );

		smvmt_add_dynamic_css( ctrl_name, dynamicStyle );
	}
}

/**
 * Apply CSS for the element
 */
function smvmt_apply_background_css(group, subControl, selector ) {
	wp.customize(group, function (control) {
		control.bind(function (value, oldValue) {
			var parse_bg_obj = JSON.parse(value);

				bg_obj = parse_bg_obj[subControl];
			if ( '' === bg_obj || undefined === bg_obj ) {
				return;
			}

			jQuery( 'style#' + subControl ).remove();

			var gen_bg_css = '';
			var bg_img = bg_obj['background-image'];
			var bg_color = bg_obj['background-color'];
			if ('' !== bg_img && '' !== bg_color) {
				if (undefined !== bg_color) {
					gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_img + ');';
				}
			} else if ('' !== bg_img) {
				gen_bg_css = 'background-image: url(' + bg_img + ');';
			} else if ('' !== bg_color) {
				gen_bg_css = 'background-color: ' + bg_color + ';';
			}

			if ('' == bg_img) {
				gen_bg_css += 'background-image: none;';
			} else {
				gen_bg_css += 'background-repeat: ' + bg_obj['background-repeat'] + ';';
				gen_bg_css += 'background-position: ' + bg_obj['background-position'] + ';';
				gen_bg_css += 'background-size: ' + bg_obj['background-size'] + ';';
				gen_bg_css += 'background-attachment: ' + bg_obj['background-attachment'] + ';';
			}

			var dynamicStyle = '<style id="' + subControl + '">'
				+ selector + '	{ ' + gen_bg_css + ' }'
				+ '</style>'

			// Concat and append new <style>.
			jQuery('head').append(
				dynamicStyle
			);
		});
	});
}

/*
* Generate Font Family CSS
*/
function smvmt_generate_outside_font_family_css( control, selector ) {
	wp.customize( control, function (value) {
		value.bind( function ( value, oldValue ) {

			var cssProperty = 'font-family';
			var link = '';

			var fontName = value.split(",")[0];
			fontName = fontName.replace(/'/g, '');

			// Remove <style> first!
			control = control.replace( '[', '-' );
			control = control.replace( ']', '' );

			jQuery('style#' + control + '-' + cssProperty ).remove();

			if ( fontName in smvmtCustomizer.googleFonts ) {
				// Remove old.

				var fontName = fontName.split(' ').join('+');

				jQuery('link#' + control).remove();
				link = '<link id="' + control + '" href="https://fonts.googleapis.com/css?family=' + fontName + '"  rel="stylesheet">';
			}

			// Concat and append new <style> and <link>.
			jQuery('head').append(
				'<style id="' + control + '-' + cssProperty + '">'
				+ selector + '	{ ' + cssProperty + ': ' + value + ' }'
				+ '</style>'
				+ link
			);
		});
	});
}

/*
* Generate Font Weight CSS
*/
function smvmt_generate_font_weight_css( font_control, control, css_property, selector ) {
	wp.customize( control, function( value ) {
		value.bind( function( new_value ) {

			control = control.replace( '[', '-' );
			control = control.replace( ']', '' );

			if ( new_value ) {

				/**
				 *	If ( unit == 'url' ) then = url('{VALUE}')
				 *	If ( unit == 'px' ) then = {VALUE}px
				 *	If ( unit == 'em' ) then = {VALUE}em
				 *	If ( unit == 'rem' ) then = {VALUE}rem.
				 */
				if ( 'undefined' != typeof unit) {

					if ( 'url' === unit ) {
						new_value = 'url(' + new_value + ')';
					} else {
						new_value = new_value + unit;
					}
				}

				fontName = wp.customize._value[font_control]._value;
				fontName = fontName.split(',');
				fontName = fontName[0].replace( /'/g, '' );

				// Remove old.
				jQuery( 'style#' + control + '-' + css_property ).remove();

				if ( fontName in smvmtCustomizer.googleFonts ) {
					// Remove old.

					jQuery('#' + font_control).remove();
					link = '<link id="' + font_control + '" href="https://fonts.googleapis.com/css?family=' + fontName + '"  rel="stylesheet">';
				}

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '-' + css_property + '">'
					+ selector + '	{ ' + css_property + ': ' + new_value + ' }'
					+ '</style>'
					+ link
				);

			} else {
				// Remove old.
				jQuery( 'style#' + control ).remove();
			}

		} );
	});
}

/**
 * Astra Addon Common functions
 *
 * @package Astra Addon
 * @since  1.0.0
 */

/**
 * Convert HEX to RGBA
 *
 * @param  {string} hex   HEX color code.
 * @param  {number} alpha Alpha number for RGBA.
 * @return {string}       Return RGBA or RGB.
 */
function smvmt_hex2rgba( hex, alpha ) {

	hex = hex.replace( '#', '' );
	var r = g = b = '';

	if ( hex.length == 3 ) {
		r = get_hexdec( hex.substring( 0, 1 ) + hex.substring( 0, 1 ) );
		g = get_hexdec( hex.substring( 1, 1 ) + hex.substring( 1, 1 ) );
		b = get_hexdec( hex.substring( 2, 1 ) + hex.substring( 2, 1 ) );
	} else {
		r = get_hexdec( hex.substring( 0, 2 ) );
		g = get_hexdec( hex.substring( 2, 4 ) );
		b = get_hexdec( hex.substring( 4, 6 ) );
	}

	var rgb = r + ',' + g + ',' + b;

	if ( '' == alpha ) {
		return 'rgb(' + rgb + ')';
	} else {
		alpha = parseFloat( alpha );

		return 'rgba(' + rgb + ',' + alpha + ')';
	}

}

/**
 * Check the color is HEX or not
 *
 * @param  {string} hex | rgba | rgb  HEX | RGBA | RGB color code.
 * @return {bool}       Return true | false.
 */
function astraIsHexColor( string ){
	isHex = false;
	regexp = /^[0-9a-fA-F]+$/;

	if ( regexp.test( string ) ) {
		isHex = true;
	}
	return isHex;
}

/**
 * Trim A From RGBA color scheme.
 *
 * @param  {string} rgba | rgb   RGBA | RGB color code.
 * @return {string}       Return string
 */
function astraTrimAlpha( string ) {
	return string.replace(/^\s+|\s+$/gm,'');
}

/**
 * Convert RGBA to HEX
 *
 * @param  {string} hex | rgba | rgb  HEX | RGBA | RGB color code.
 * @return {string}       Return HEX color.
 */
function astraRgbaToHex( string ) {
	if ( '' !== string ) {
		if ( ! astraIsHexColor( string.replace( '#', '' ) ) ) {

	    	var parts = string.substring(string.indexOf("(")).split(","),
			r = parseInt(astraTrimAlpha(parts[0].substring(1)), 10),
			g = parseInt(astraTrimAlpha(parts[1]), 10),
			b = parseInt(astraTrimAlpha(parts[2]), 10),
			a = parseFloat(astraTrimAlpha(parts[3].substring(0, parts[3].length - 1))).toFixed(2);
			string =  ('#' + r.toString(16) + g.toString(16) + b.toString(16) + (a * 255).toString(16).substring(0,2));
		}
	}
    return string;
}

/**
 * Apply CSS for the element
 */
function smvmt_color_responsive_css( addon, control, css_property, selector ) {

	wp.customize( control, function( value ) {
		value.bind( function( value ) {
			if ( value.desktop || value.mobile || value.tablet ) {
				// Remove <style> first!
				control = control.replace( '[', '-' );
				control = control.replace( ']', '' );
				jQuery( 'style#' + control + '-' + addon ).remove();

				var DeskVal = '',
					TabletFontVal = '',
					MobileVal = '';

				if ( '' != value.desktop ) {
					DeskVal = css_property + ': ' + value.desktop;
				}
				if ( '' != value.tablet ) {
					TabletFontVal = css_property + ': ' + value.tablet;
				}
				if ( '' != value.mobile ) {
					MobileVal = css_property + ': ' + value.mobile;
				}

				// Concat and append new <style>.
				jQuery( 'head' ).append(
					'<style id="' + control + '-' + addon + '">'
					+ selector + '	{ ' + DeskVal + ' }'
					+ '@media (max-width: 768px) {' + selector + '	{ ' + TabletFontVal + ' } }'
					+ '@media (max-width: 544px) {' + selector + '	{ ' + MobileVal + ' } }'
					+ '</style>'
				);

			} else {
				wp.customize.preview.send( 'refresh' );
				jQuery( 'style#' + control + '-' + addon ).remove();
			}

		} );
	} );
}

/**
 * Apply CSS for the element
 */
function smvmt_apply_responsive_background_css( control, selector, device, singleColorSelector, addon ) {
	wp.customize( control, function( value ) {
		value.bind( function( bg_obj ) {

			addon = addon || '';
			singleColorSelector = singleColorSelector || '';

			addon = ( addon ) ? addon : 'header';

			if( '' === bg_obj[device] || undefined === bg_obj[device] ){
				return;
			}
			jQuery( 'style#' + control + '-' + device + '-' + addon ).remove();

			var gen_bg_css 	= '';
			var bg_img		= bg_obj[device]['background-image'];
			var bg_tab_img	= bg_obj['tablet']['background-image'];
			var bg_desk_img	= bg_obj['desktop']['background-image'];
			var bg_color	= bg_obj[device]['background-color'];
			var tablet_css  = ( bg_obj['tablet']['background-image'] ) ? true : false;
			var desktop_css = ( bg_obj['desktop']['background-image'] ) ? true : false;

			if ( '' !== bg_img && '' !== bg_color ) {
				if ( undefined !== bg_color ) {
					gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_img + ');';
				}
			} else if ( '' !== bg_img ) {
				gen_bg_css = 'background-image: url(' + bg_img + ');';
			} else if ( '' !== bg_color ) {
				if( 'mobile' === device ) {
					if( true == desktop_css && true == tablet_css ) {
						gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_tab_img + ');';
					} else if( true == desktop_css ) {
						gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_desk_img + ');';
					} else if( true == tablet_css ) {
						gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_tab_img + ');';
					} else {
						gen_bg_css = 'background-color: ' + bg_color + ';';
						gen_bg_css += 'background-image: none;';
					}
				} else if( 'tablet' === device ) {
					if( true == desktop_css ) {
						gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_desk_img + ');';
					} else {
						gen_bg_css = 'background-color: ' + bg_color + ';';
						gen_bg_css += 'background-image: none;';
					}
				} else {
					gen_bg_css = 'background-color: ' + bg_color + ';';
					gen_bg_css += 'background-image: none;';
				}

				if( ! selector.includes( singleColorSelector ) ) {
					selector += ', ' + singleColorSelector;
				}
			}


			if ( '' != bg_img ) {
				gen_bg_css += 'background-repeat: ' + bg_obj[device]['background-repeat'] + ';';
				gen_bg_css += 'background-position: ' + bg_obj[device]['background-position'] + ';';
				gen_bg_css += 'background-size: ' + bg_obj[device]['background-size'] + ';';
				gen_bg_css += 'background-attachment: ' + bg_obj[device]['background-attachment'] + ';';
			}

			if ( 'desktop' == device ) {
				var dynamicStyle = '<style id="' + control + '-' + device + '-' + addon + '">'
					+ selector + '	{ ' + gen_bg_css + ' }'
				+ '</style>'
			}
			if ( 'tablet' == device ) {
				var dynamicStyle = '<style id="' + control + '-' + device + '-' + addon + '">'
					+ '@media (max-width: 768px) {' + selector + '	{ ' + gen_bg_css + ' } }'
				+ '</style>'
			}
			if ( 'mobile' == device ) {
				var dynamicStyle = '<style id="' + control + '-' + device + '-' + addon + '">'
					+ '@media (max-width: 544px) {' + selector + '	{ ' + gen_bg_css + ' } }'
				+ '</style>'
			}

			// Concat and append new <style>.
			jQuery( 'head' ).append(
				dynamicStyle
			);
		});
	});
}


/**
 * Generate responsive background_obj CSS
 */
function smvmt_responsive_background_obj_css( wp_customize, bg_obj, ctrl_name, style, device ) {

	if( '' === bg_obj[device] || undefined === bg_obj[device] ){
		return;
	}

	var gen_bg_css 	= '';
	var bg_img		= bg_obj[device]['background-image'];
	var bg_color	= bg_obj[device]['background-color'];

		if ( '' !== bg_img && '' !== bg_color ) {
			if ( undefined !== bg_color ) {
				gen_bg_css = 'background-image: linear-gradient(to right, ' + bg_color + ', ' + bg_color + '), url(' + bg_img + ');';
			}
		} else if ( '' !== bg_img ) {
			gen_bg_css = 'background-image: url(' + bg_img + ');';
		} else if ( '' !== bg_color ) {
			gen_bg_css = 'background-color: ' + bg_color + ';';
			// gen_bg_css += 'background-image: none;';
		}

		if ( '' !== bg_img ) {

			gen_bg_css += 'background-repeat: ' + bg_obj[device]['background-repeat'] + ';';
			gen_bg_css += 'background-position: ' + bg_obj[device]['background-position'] + ';';
			gen_bg_css += 'background-size: ' + bg_obj[device]['background-size'] + ';';
			gen_bg_css += 'background-attachment: ' + bg_obj[device]['background-attachment'] + ';';
		} else {
			gen_bg_css += 'background-image: none;';
		}

		if ( 'desktop' == device ) {
			var dynamicStyle = style.replace( "{{css}}", gen_bg_css );
		}
		if ( 'tablet' == device ) {
			var dynamicStyle = '@media (max-width: 768px) {' + style.replace( "{{css}}", gen_bg_css ) + '};';
		}
		if ( 'mobile' == device ) {
			var dynamicStyle = '@media (max-width: 544px) {' + style.replace( "{{css}}", gen_bg_css ) + '};';
		}

		smvmt_add_dynamic_css( ctrl_name +'-'+ device, dynamicStyle );
}

/**
 * Customizer refresh for empty value for all responsive empty color or background image
 */
function smvmt_responsive_background_obj_refresh( bg_obj ) {
	if ( undefined !== bg_obj['desktop'] && undefined !== bg_obj['tablet'] && undefined !== bg_obj['mobile'] ) {
		if (
				( '' === bg_obj['desktop']['background-color'] )
				&&
				( '' === bg_obj['tablet']['background-color'] )
				&&
				( '' === bg_obj['mobile']['background-color'] )
			) {
				wp.customize.preview.send( 'refresh' );
		}
	}
}


function getChangedKey( value, other ) {

	value = isJsonString(value) ? JSON.parse(value) : value;
	other = isJsonString(other) ? JSON.parse(other) : other;

	// Compare two items
	var compare = function ( item1, item2 ) {

		// Get the object type
		var itemType = Object.prototype.toString.call(item1);

		// If an object or array, compare recursively
		if (['[object Array]', '[object Object]'].indexOf(itemType) >= 0) {
			if ('string' == typeof getChangedKey(item1, item2)) {
				return false;
			}
		}

		// Otherwise, do a simple comparison
		else {

			// If the two items are not the same type, return false
			if (itemType !== Object.prototype.toString.call(item2)) return false;

			// Else if it's a function, convert to a string and compare
			// Otherwise, just compare
			if (itemType === '[object Function]') {
				if (item1.toString() !== item2.toString()) return false;
			} else {
				if (item1 !== item2) return false;
			}

		}
	};

	for ( var key in value ) {
		if ( other.hasOwnProperty(key) && value.hasOwnProperty(key) ) {
			if ( compare( value[key], other[key] ) === false ) return key;
		} else {
			return key;
		}
	}

	// If nothing failed, return true
	return true;

}

function isJsonString( str ) {

	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}

( function( $ ) {

	/*
	 * Site Identity Logo Width
	 */
	wp.customize( 'smvmt-settings[smvmt-header-responsive-logo-width]', function( setting ) {
		setting.bind( function( logo_width ) {
			if ( logo_width['desktop'] != '' || logo_width['tablet'] != '' || logo_width['mobile'] != '' ) {
				var dynamicStyle = '#masthead .site-logo-img .custom-logo-link img { max-width: ' + logo_width['desktop'] + 'px;} .smvmt-logo-svg{width: ' + logo_width['desktop'] + 'px;} @media( max-width: 768px ) { #masthead .site-logo-img .custom-logo-link img { max-width: ' + logo_width['tablet'] + 'px;} .smvmt-logo-svg{width: ' + logo_width['tablet'] + 'px; } } @media( max-width: 544px ) { .smvmt-header-break-point .site-branding img, .smvmt-header-break-point #masthead .site-logo-img .custom-logo-link img { max-width: ' + logo_width['mobile'] + 'px;} .smvmt-logo-svg{width: ' + logo_width['mobile'] + 'px; } }';
				smvmt_add_dynamic_css( 'smvmt-header-responsive-logo-width', dynamicStyle );
				var mobileLogoStyle = '.smvmt-header-break-point #masthead .site-logo-img .custom-mobile-logo-link img { max-width: ' + logo_width['tablet'] + 'px; } @media( max-width: 768px ) { .smvmt-header-break-point #masthead .site-logo-img .custom-mobile-logo-link img { max-width: ' + logo_width['tablet'] + 'px; }  @media( max-width: 544px ) { .smvmt-header-break-point #masthead .site-logo-img .custom-mobile-logo-link img { max-width: ' + logo_width['mobile'] + 'px; }';
				smvmt_add_dynamic_css( 'mobile-header-logo-width', mobileLogoStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );

	/*
	 * Full width layout
	 */
	wp.customize( 'smvmt-settings[site-content-width]', function( setting ) {
		setting.bind( function( width ) {
				var dynamicStyle = '@media (min-width: 554px) {';
				dynamicStyle += '.smvmt-container, .fl-builder #content .entry-header { max-width: ' + ( 40 + parseInt( width ) ) + 'px } ';
				dynamicStyle += '}';
				if (  jQuery( 'body' ).hasClass( 'smvmt-page-builder-template' ) ) {
					dynamicStyle += '@media (min-width: 554px) {';
					dynamicStyle += '.smvmt-page-builder-template .comments-area { max-width: ' + ( 40 + parseInt( width ) ) + 'px } ';
					dynamicStyle += '}';
				}

				smvmt_add_dynamic_css( 'site-content-width', dynamicStyle );

		} );
	} );

	/*
	 * Full width layout
	 */
	wp.customize( 'smvmt-settings[header-main-menu-label]', function( setting ) {
		setting.bind( function( label ) {
			if( $('button.main-header-menu-toggle .mobile-menu-wrap .mobile-menu').length > 0 ) {
				if ( label != '' ) {
					$('button.main-header-menu-toggle .mobile-menu-wrap .mobile-menu').text(label);
				} else {
					$('button.main-header-menu-toggle .mobile-menu-wrap').remove();
				}
			} else {
				var html = $('button.main-header-menu-toggle').html();
				if( '' != label ) {
					html += '<div class="mobile-menu-wrap"><span class="mobile-menu">'+ label +'</span> </div>';
				}
				$('button.main-header-menu-toggle').html( html )
			}
		} );
	} );

	/*
	 * Layout Body Background
	 */
	wp.customize( 'smvmt-settings[site-layout-outside-bg-obj]', function( value ) {
		value.bind( function( bg_obj ) {

			var dynamicStyle = 'body,.smvmt-separate-container { {{css}} }';

			smvmt_background_obj_css( wp.customize, bg_obj, 'site-layout-outside-bg-obj', dynamicStyle );
		} );
	} );

	/*
	 * Blog Custom Width
	 */
	wp.customize( 'smvmt-settings[blog-max-width]', function( setting ) {
		setting.bind( function( width ) {

			var dynamicStyle = '@media all and ( min-width: 921px ) {';

			if ( ! jQuery( 'body' ).hasClass( 'smvmt-woo-shop-archive' ) ) {
			dynamicStyle += '.blog .site-content > .smvmt-container,.archive .site-content > .smvmt-container{ max-width: ' + (  parseInt( width ) ) + 'px } ';
			}

			if (  jQuery( 'body' ).hasClass( 'smvmt-fluid-width-layout' ) ) {
				dynamicStyle += '.blog .site-content > .smvmt-container,.archive .site-content > .smvmt-container{ padding-left:20px; padding-right:20px; } ';
			}
				dynamicStyle += '}';
				smvmt_add_dynamic_css( 'blog-max-width', dynamicStyle );

		} );
	} );

	/*
	 * Single Blog Custom Width
	 */
	wp.customize( 'smvmt-settings[blog-single-max-width]', function( setting ) {
		setting.bind( function( width ) {

				var dynamicStyle = '@media all and ( min-width: 921px ) {';

				dynamicStyle += '.single-post .site-content > .smvmt-container{ max-width: ' + ( 40 + parseInt( width ) ) + 'px } ';

			if (  jQuery( 'body' ).hasClass( 'smvmt-fluid-width-layout' ) ) {
				dynamicStyle += '.single-post .site-content > .smvmt-container{ padding-left:20px; padding-right:20px; } ';
			}
				dynamicStyle += '}';
				smvmt_add_dynamic_css( 'blog-single-max-width', dynamicStyle );

		} );
	} );

	/*
	 * EDD Archive Custom Width
	 */
	wp.customize( 'smvmt-settings[edd-archive-max-width]', function( setting ) {
		setting.bind( function( width ) {

				var dynamicStyle = '.smvmt-edd-archive-page .site-content > .smvmt-container { max-width: ' + parseInt( width ) + 'px } ';

				smvmt_add_dynamic_css( 'edd-archive-max-width', dynamicStyle );

		} );
	} );

	/**
	 * Primary Width Option
	 */
	wp.customize( 'smvmt-settings[site-sidebar-width]', function( setting ) {
		setting.bind( function( width ) {

			if ( ! jQuery( 'body' ).hasClass( 'smvmt-no-sidebar' ) && width >= 15 && width <= 50 ) {

				var dynamicStyle = '@media (min-width: 769px) {';

				dynamicStyle += '#primary { width: ' + ( 100 - parseInt( width ) ) + '% } ';
				dynamicStyle += '#secondary { width: ' + width + '% } ';
				dynamicStyle += '}';

				smvmt_add_dynamic_css( 'site-sidebar-width', dynamicStyle );
			}

		} );
	} );

	/**
	 * Header Bottom Border
	 */
	wp.customize( 'smvmt-settings[header-main-sep]', function( setting ) {
		setting.bind( function( border ) {

			var dynamicStyle = 'body.smvmt-header-break-point .site-header { border-bottom-width: ' + border + 'px }';

			dynamicStyle += '.smvmt-desktop .main-header-bar {';
			dynamicStyle += 'border-bottom-width: ' + border + 'px';
			dynamicStyle += '}';

			smvmt_add_dynamic_css( 'header-main-sep', dynamicStyle );

		} );
	} );

	/**
	 * Small Footer Top Border
	 */
	wp.customize( 'smvmt-settings[footer-sml-divider]', function( value ) {
		value.bind( function( border_width ) {
			jQuery( '.smvmt-small-footer' ).css( 'border-top-width', border_width + 'px' );
		} );
	} );

	/**
	 * Footer Widget Top Border
	 */
	wp.customize( 'smvmt-settings[footer-adv-border-width]', function( value ) {
		value.bind( function( border_width ) {
			jQuery( '.footer-adv .footer-adv-overlay' ).css( 'border-top-width', border_width + 'px' );
		} );
	} );


	wp.customize( 'smvmt-settings[footer-adv-border-color]', function( value ) {
		value.bind( function( border_color ) {
			jQuery( '.footer-adv .footer-adv-overlay' ).css( 'border-top-color', border_color );
		} );
	} );


	/**
	 * Small Footer Top Border Color
	 */
	wp.customize( 'smvmt-settings[footer-sml-divider-color]', function( value ) {
		value.bind( function( border_color ) {
			jQuery( '.smvmt-small-footer' ).css( 'border-top-color', border_color );
		} );
	} );

	/**
	 * Button Border Radius
	 */
	wp.customize( 'smvmt-settings[theme-button-border-group]', function( setting ) {
		setting.bind( function( border ) {

			var dynamicStyle = '.menu-toggle,button,.smvmt-button,input#submit,input[type="button"],input[type="submit"],input[type="reset"] { border-radius: ' + ( parseInt( border ) ) + 'px } ';
			if (  jQuery( 'body' ).hasClass( 'woocommerce' ) ) {
				dynamicStyle += '.woocommerce a.button, .woocommerce button.button, .woocommerce .product a.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled] { border-radius: ' + ( parseInt( border ) ) + 'px } ';
			}
			smvmt_add_dynamic_css( 'button-radius', dynamicStyle );

		} );
	} );

	/**
	 * Header Bottom Border width
	 */
	wp.customize( 'smvmt-settings[header-main-sep]', function( value ) {
		value.bind( function( border ) {

			var dynamicStyle = ' body.smvmt-header-break-point .site-header { border-bottom-width: ' + border + 'px } ';

			dynamicStyle += '.smvmt-desktop .main-header-bar {';
			dynamicStyle += 'border-bottom-width: ' + border + 'px';
			dynamicStyle += '}';

			smvmt_add_dynamic_css( 'header-main-sep', dynamicStyle );

		} );
	} );

	/**
	 * Header Bottom Border color
	 */
	wp.customize( 'smvmt-settings[header-main-sep-color]', function( value ) {
		value.bind( function( color ) {
			if (color == '') {
				wp.customize.preview.send( 'refresh' );
			}

			if ( color ) {

				var dynamicStyle = ' .smvmt-desktop .main-header-bar { border-bottom-color: ' + color + '; } ';
					dynamicStyle += ' body.smvmt-header-break-point .site-header { border-bottom-color: ' + color + '; } ';

				smvmt_add_dynamic_css( 'header-main-sep-color', dynamicStyle );
			}

		} );
	} );

	/**
	 * Primary Toggle Button Color
	 */
	wp.customize( 'smvmt-settings[mobile-header-toggle-btn-style-color]', function( setting ) {
		setting.bind( function( toggle_button_color ) {
			if ( toggle_button_color != '' ) {
				if( jQuery( '.menu-toggle' ).hasClass( 'smvmt-mobile-menu-buttons-fill' ) ) {
					var dynamicStyle = '.smvmt-header-break-point .smvmt-mobile-menu-buttons-fill.menu-toggle { background: ' + toggle_button_color + '}';
				}
				else if( jQuery( '.menu-toggle' ).hasClass( 'smvmt-mobile-menu-buttons-outline' ) ) {
					var dynamicStyle = '.smvmt-header-break-point .smvmt-mobile-menu-buttons-outline.menu-toggle { border: 1px solid ' + toggle_button_color + '; color: ' + toggle_button_color + '}';
				}
				else {
					var dynamicStyle = '.smvmt-header-break-point .smvmt-mobile-menu-buttons-minimal.menu-toggle { color: ' + toggle_button_color + '}';
				}
				smvmt_add_dynamic_css( 'primary-toggle-button-color', dynamicStyle );
			}
			else{
				wp.customize.preview.send( 'refresh' );
			}
		});
	});


	smvmt_responsive_font_size( 'smvmt-settings[font-size-site-tagline]', '.site-header .site-description' );
	smvmt_responsive_font_size( 'smvmt-settings[font-size-site-title]', '.site-title' );

	smvmt_responsive_font_size( 'smvmt-settings[font-size-entry-title]', '.smvmt-single-post .entry-title, .page-title' );
	smvmt_responsive_font_size( 'smvmt-settings[font-size-archive-summary-title]', '.smvmt-archive-description .smvmt-archive-title' );
	smvmt_responsive_font_size( 'smvmt-settings[font-size-page-title]', 'body:not(.smvmt-single-post) .entry-title' );

	// Check if anchors should be loaded in the CSS for headings.
	if (true == smvmtCustomizer.includeAnchorsInHeadindsCss) {
		smvmt_responsive_font_size('smvmt-settings[font-size-h1]', 'h1, .entry-content h1, .entry-content h1 a');
		smvmt_responsive_font_size('smvmt-settings[font-size-h2]', 'h2, .entry-content h2, .entry-content h2 a');
		smvmt_responsive_font_size('smvmt-settings[font-size-h3]', 'h3, .entry-content h3, .entry-content h3 a');
		smvmt_responsive_font_size('smvmt-settings[font-size-h4]', 'h4, .entry-content h4, .entry-content h4 a');
		smvmt_responsive_font_size('smvmt-settings[font-size-h5]', 'h5, .entry-content h5, .entry-content h5 a');
		smvmt_responsive_font_size('smvmt-settings[font-size-h6]', 'h6, .entry-content h6, .entry-content h6 a');
	} else {
		smvmt_responsive_font_size('smvmt-settings[font-size-h1]', 'h1, .entry-content h1');
		smvmt_responsive_font_size('smvmt-settings[font-size-h2]', 'h2, .entry-content h2');
		smvmt_responsive_font_size('smvmt-settings[font-size-h3]', 'h3, .entry-content h3');
		smvmt_responsive_font_size('smvmt-settings[font-size-h4]', 'h4, .entry-content h4');
		smvmt_responsive_font_size('smvmt-settings[font-size-h5]', 'h5, .entry-content h5');
		smvmt_responsive_font_size('smvmt-settings[font-size-h6]', 'h6, .entry-content h6');
	}

	// paragraph margin bottom.
	wp.customize( 'smvmt-settings[para-margin-bottom]', function( value ) {
		value.bind( function( marginBottom ) {
			if ( marginBottom == '' ) {
				wp.customize.preview.send( 'refresh' );
			}

			if ( marginBottom ) {
				var dynamicStyle = ' p, .entry-content p { margin-bottom: ' + marginBottom + 'em; } ';
				smvmt_add_dynamic_css( 'para-margin-bottom', dynamicStyle );
			}

		} );
	} );

	if ( smvmtCustomizer.page_builder_button_style_css ) {
		if (true == smvmtCustomizer.includeAnchorsInHeadindsCss) {
			if ( 'color-typo' == smvmtCustomizer.elementor_default_color_font_setting || 'typo' == smvmtCustomizer.elementor_default_color_font_setting ) {
				smvmt_css('smvmt-settings[headings-line-height]', 'line-height', '.elementor-widget-heading h1.elementor-heading-title, .elementor-widget-heading h2.elementor-heading-title, .elementor-widget-heading h3.elementor-heading-title, .elementor-widget-heading h4.elementor-heading-title, .elementor-widget-heading h5.elementor-heading-title, .elementor-widget-heading h6.elementor-heading-title');
			}
			smvmt_css('smvmt-settings[headings-line-height]', 'line-height', 'h1, .entry-content h1, .entry-content h1 a, h2, .entry-content h2, .entry-content h2 a, h3, .entry-content h3, .entry-content h3 a, h4, .entry-content h4, .entry-content h4 a, h5, .entry-content h5, .entry-content h5 a, h6, .entry-content h6, .entry-content h6 a, .site-title, .site-title a');
		} else {
			if ( 'color-typo' == smvmtCustomizer.elementor_default_color_font_setting || 'typo' == smvmtCustomizer.elementor_default_color_font_setting ) {
				smvmt_css('smvmt-settings[headings-line-height]', 'line-height', '.elementor-widget-heading h1.elementor-heading-title, .elementor-widget-heading h2.elementor-heading-title, .elementor-widget-heading h3.elementor-heading-title, .elementor-widget-heading h4.elementor-heading-title, .elementor-widget-heading h5.elementor-heading-title, .elementor-widget-heading h6.elementor-heading-title');
			}
			smvmt_css('smvmt-settings[headings-line-height]', 'line-height', 'h1, .entry-content h1, h2, .entry-content h2, h3, .entry-content h3, h4, .entry-content h4, h5, .entry-content h5, h6, .entry-content h6, .site-title, .site-title a');
		}
	} else {
		if (true == smvmtCustomizer.includeAnchorsInHeadindsCss) {
			smvmt_css('smvmt-settings[headings-line-height]', 'line-height', 'h1, .entry-content h1, .entry-content h1 a, h2, .entry-content h2, .entry-content h2 a, h3, .entry-content h3, .entry-content h3 a, h4, .entry-content h4, .entry-content h4 a, h5, .entry-content h5, .entry-content h5 a, h6, .entry-content h6, .entry-content h6 a, .site-title, .site-title a');
		} else {
			smvmt_css('smvmt-settings[headings-line-height]', 'line-height', 'h1, .entry-content h1, h2, .entry-content h2, h3, .entry-content h3, h4, .entry-content h4, h5, .entry-content h5, h6, .entry-content h6, .site-title, .site-title a');
		}
	}

	// Check if anchors should be loaded in the CSS for headings.
	if (true == smvmtCustomizer.includeAnchorsInHeadindsCss) {
		smvmt_generate_outside_font_family_css('smvmt-settings[headings-font-family]', 'h1, .entry-content h1, .entry-content h1 a, h2, .entry-content h2, .entry-content h2 a, h3, .entry-content h3, .entry-content h3 a, h4, .entry-content h4, .entry-content h4 a, h5, .entry-content h5, .entry-content h5 a, h6, .entry-content h6, .entry-content h6 a, .site-title, .site-title a');
		smvmt_css('smvmt-settings[headings-font-weight]', 'font-weight', 'h1, .entry-content h1, .entry-content h1 a, h2, .entry-content h2, .entry-content h2 a, h3, .entry-content h3, .entry-content h3 a, h4, .entry-content h4, .entry-content h4 a, h5, .entry-content h5, .entry-content h5 a, h6, .entry-content h6, .entry-content h6 a, .site-title, .site-title a');
		smvmt_css('smvmt-settings[headings-text-transform]', 'text-transform', 'h1, .entry-content h1, .entry-content h1 a, h2, .entry-content h2, .entry-content h2 a, h3, .entry-content h3, .entry-content h3 a, h4, .entry-content h4, .entry-content h4 a, h5, .entry-content h5, .entry-content h5 a, h6, .entry-content h6, .entry-content h6 a, .site-title, .site-title a');
	} else {
		smvmt_generate_outside_font_family_css('smvmt-settings[headings-font-family]', 'h1, .entry-content h1, h2, .entry-content h2, h3, .entry-content h3, h4, .entry-content h4, h5, .entry-content h5, h6, .entry-content h6, .site-title, .site-title a');
		smvmt_css('smvmt-settings[headings-font-weight]', 'font-weight', 'h1, .entry-content h1, h2, .entry-content h2, h3, .entry-content h3, h4, .entry-content h4, h5, .entry-content h5, h6, .entry-content h6, .site-title, .site-title a');
		smvmt_css('smvmt-settings[headings-text-transform]', 'text-transform', 'h1, .entry-content h1, h2, .entry-content h2, h3, .entry-content h3, h4, .entry-content h4, h5, .entry-content h5, h6, .entry-content h6, .site-title, .site-title a');
	}


	// Footer Bar.
	smvmt_css( 'smvmt-settings[footer-color]', 'color', '.smvmt-small-footer' );
	smvmt_css( 'smvmt-settings[footer-link-color]', 'color', '.smvmt-small-footer a' );
	smvmt_css( 'smvmt-settings[footer-link-h-color]', 'color', '.smvmt-small-footer a:hover' );
	wp.customize( 'smvmt-settings[footer-bg-obj]', function( value ) {
		value.bind( function( bg_obj ) {

			var dynamicStyle = ' .smvmt-small-footer > .smvmt-footer-overlay { {{css}} }';

			smvmt_background_obj_css( wp.customize, bg_obj, 'footer-bg-obj', dynamicStyle );
		} );
	} );

	// Footer Widgets.
	smvmt_css( 'smvmt-settings[footer-adv-wgt-title-color]', 'color', '.footer-adv .widget-title, .footer-adv .widget-title a' );
	smvmt_css( 'smvmt-settings[footer-adv-text-color]', 'color', '.footer-adv' );
	smvmt_css( 'smvmt-settings[footer-adv-link-color]', 'color', '.footer-adv a' );
	smvmt_css( 'smvmt-settings[footer-adv-link-h-color]', 'color', '.footer-adv a:hover, .footer-adv .no-widget-text a:hover, .footer-adv a:focus, .footer-adv .no-widget-text a:focus' );
	wp.customize( 'smvmt-settings[footer-adv-bg-obj]', function( value ) {
		value.bind( function( bg_obj ) {

			var dynamicStyle = ' .footer-adv-overlay { {{css}} }';

			smvmt_background_obj_css( wp.customize, bg_obj, 'footer-adv-bg-obj', dynamicStyle );
		} );
	} );
	/*
	 * Woocommerce Shop Archive Custom Width
	 */
	wp.customize( 'smvmt-settings[shop-archive-max-width]', function( setting ) {
		setting.bind( function( width ) {

			var dynamicStyle = '@media all and ( min-width: 921px ) {';

			dynamicStyle += '.smvmt-woo-shop-archive .site-content > .smvmt-container{ max-width: ' + (  parseInt( width ) ) + 'px } ';

			if (  jQuery( 'body' ).hasClass( 'smvmt-fluid-width-layout' ) ) {
				dynamicStyle += '.smvmt-woo-shop-archive .site-content > .smvmt-container{ padding-left:20px; padding-right:20px; } ';
			}
				dynamicStyle += '}';
				smvmt_add_dynamic_css( 'shop-archive-max-width', dynamicStyle );

		} );
	} );

	//[1] Primary Menu Toggle Button Style.
	wp.customize( 'smvmt-settings[mobile-header-toggle-btn-style]', function( setting ) {
		setting.bind( function( icon_style ) {
			var buttons = $(document).find('.smvmt-mobile-menu-buttons .menu-toggle');
			buttons.removeClass('smvmt-mobile-menu-buttons-default smvmt-mobile-menu-buttons-fill smvmt-mobile-menu-buttons-outline');
			buttons.removeClass('smvmt-mobile-menu-buttons-default smvmt-mobile-menu-buttons-fill smvmt-mobile-menu-buttons-minimal');
			buttons.addClass( 'smvmt-mobile-menu-buttons-' + icon_style );
		} );
	} );

	//[1] Toggle Button Border Radius.
	wp.customize( 'smvmt-settings[mobile-header-toggle-btn-border-radius]', function( setting ) {
		setting.bind( function( border ) {

			var dynamicStyle = '.smvmt-header-break-point .main-header-bar .smvmt-button-wrap .menu-toggle { border-radius: ' + ( parseInt( border ) ) + 'px } ';
			smvmt_add_dynamic_css( 'mobile-header-toggle-btn-border-radius', dynamicStyle );

		} );
	} );

	/**
	 * Primary Submenu border
	 */
	wp.customize( 'smvmt-settings[primary-submenu-border]', function( value ) {
		value.bind( function( border ) {
			var color = wp.customize( 'smvmt-settings[primary-submenu-b-color]' ).get();

			if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {

				var dynamicStyle = '.smvmt-desktop .main-header-menu.submenu-with-border .sub-menu, .smvmt-desktop .main-header-menu.submenu-with-border .children';
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'   + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-color:'        + color + ';';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';

					dynamicStyle += '.smvmt-desktop .main-header-menu.submenu-with-border .sub-menu .sub-menu, .smvmt-desktop .main-header-menu.submenu-with-border .children .children';
					dynamicStyle += '{';
					dynamicStyle += 'top:-'   + border.top + 'px;';
					dynamicStyle += '}';

					// Submenu items goes outside?
					dynamicStyle += '@media (min-width: 769px){';
					dynamicStyle += '.main-header-menu .sub-menu li.smvmt-left-align-sub-menu:hover > ul, .main-header-menu .sub-menu li.smvmt-left-align-sub-menu.focus > ul';
					dynamicStyle += '{';
					dynamicStyle += 'margin-left:-'   + ( +border.left + +border.right ) + 'px;';
					dynamicStyle += '}';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'primary-submenu-border', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );
	/**
	 * Primary Submenu border COlor
	 */
	wp.customize( 'smvmt-settings[primary-submenu-b-color]', function( value ) {
		value.bind( function( color ) {
			var border = wp.customize( 'smvmt-settings[primary-submenu-border]' ).get();
			if ( '' != color ) {
				if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {

					var dynamicStyle = '.smvmt-desktop .main-header-menu.submenu-with-border .sub-menu, .smvmt-desktop .main-header-menu.submenu-with-border .children';
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'   + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-color:'        + color + ';';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';

					dynamicStyle += '.smvmt-desktop .main-header-menu.submenu-with-border .sub-menu .sub-menu, .smvmt-desktop .main-header-menu.submenu-with-border .children .children';
					dynamicStyle += '{';
					dynamicStyle += 'top:-'   + border.top + 'px;';
					dynamicStyle += '}';

					// Submenu items goes outside?
					dynamicStyle += '@media (min-width: 769px){';
					dynamicStyle += '.main-header-menu .sub-menu li.smvmt-left-align-sub-menu:hover > ul, .main-header-menu .sub-menu li.smvmt-left-align-sub-menu.focus > ul';
					dynamicStyle += '{';
					dynamicStyle += 'margin-left:-'   + ( +border.left + +border.right ) + 'px;';
					dynamicStyle += '}';
					dynamicStyle += '}';

					smvmt_add_dynamic_css( 'primary-submenu-border-color', dynamicStyle );
				}
			} else {
				wp.customize.preview.send( 'refresh' );
			}
		} );
	} );


	/**
	 * Primary Submenu border COlor
	 */
	wp.customize('smvmt-settings[primary-submenu-item-b-color]', function (value) {
		value.bind(function (color) {
			var insideBorder = wp.customize('smvmt-settings[primary-submenu-item-border]').get();
			if ('' != color) {
				if ( true == insideBorder ) {

					var dynamicStyle = '';

					dynamicStyle += '.smvmt-desktop .main-header-menu.submenu-with-border .sub-menu a, .smvmt-desktop .main-header-menu.submenu-with-border .children a';
					dynamicStyle += '{';
					dynamicStyle += 'border-bottom-width:' + ( ( true === insideBorder ) ? '1px;' : '0px;' );
					dynamicStyle += 'border-color:' + color + ';';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';


					smvmt_add_dynamic_css('primary-submenu-item-b-color', dynamicStyle);
				}
			} else {
				wp.customize.preview.send('refresh');
			}
		});
	});

	/**
	 * Primary Submenu border COlor
	 */
	wp.customize( 'smvmt-settings[primary-submenu-item-border]', function( value ) {
		value.bind( function( border ) {
			var color = wp.customize( 'smvmt-settings[primary-submenu-item-b-color]' ).get();

			if( true === border  ) {
				var dynamicStyle = '.smvmt-desktop .main-header-menu.submenu-with-border .sub-menu a, .smvmt-desktop .main-header-menu.submenu-with-border .children a';
					dynamicStyle += '{';
					dynamicStyle += 'border-bottom-width:' + ( ( true === border ) ? '1px;' : '0px;' );
					dynamicStyle += 'border-color:'        + color + ';';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'primary-submenu-item-border', dynamicStyle );
			} else {
				wp.customize.preview.send( 'refresh' );
			}

		} );
	} );

	smvmt_css( 'smvmt-settings[header-main-rt-section-button-text-color]', 'color', '.main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settings[header-main-rt-section-button-back-color]', 'background-color', '.main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settings[header-main-rt-section-button-text-h-color]', 'color', '.main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_css( 'smvmt-settings[header-main-rt-section-button-back-h-color]', 'background-color', '.main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_css( 'smvmt-settings[header-main-rt-section-button-border-radius]', 'border-radius', '.main-header-bar .smvmt-container .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button', 'px' );
	smvmt_css( 'smvmt-settings[header-main-rt-section-button-border-color]', 'border-color', '.main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button' );
	smvmt_css( 'smvmt-settings[header-main-rt-section-button-border-h-color]', 'border-color', '.main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button:hover' );
	smvmt_responsive_spacing( 'smvmt-settings[header-main-rt-section-button-padding]','.main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button', 'padding', ['top', 'right', 'bottom', 'left' ] );

	var ele_border_radius_selector = '';
	var ele_border_width_selector  = '';
	var ele_padding_selector       = '';

	if ( smvmtCustomizer.page_builder_button_style_css ) {
		if ( 'color-typo' == smvmtCustomizer.elementor_default_color_font_setting || 'color' == smvmtCustomizer.elementor_default_color_font_setting || 'font' == smvmtCustomizer.elementor_default_color_font_setting ) {
			ele_border_radius_selector = ', .elementor-button-wrapper .elementor-button.elementor-size-sm, .elementor-button-wrapper .elementor-button.elementor-size-xs, .elementor-button-wrapper .elementor-button.elementor-size-md, .elementor-button-wrapper .elementor-button.elementor-size-lg, .elementor-button-wrapper .elementor-button.elementor-size-xl, .elementor-button-wrapper .elementor-button';
			ele_border_width_selector = ', .elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';
			ele_padding_selector = ', .elementor-button-wrapper .elementor-button.elementor-size-sm, .elementor-button-wrapper .elementor-button.elementor-size-xs, .elementor-button-wrapper .elementor-button.elementor-size-md, .elementor-button-wrapper .elementor-button.elementor-size-lg, .elementor-button-wrapper .elementor-button.elementor-size-xl, .elementor-button-wrapper .elementor-button';
		}
	}

	smvmt_css( 'smvmt-settings[button-radius]', 'border-radius', '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' + ele_border_radius_selector, 'px' );

	/**
	 * Button border
	 */
	wp.customize( 'smvmt-settings[theme-button-border-group-border-size]', function( value ) {
		value.bind( function( border ) {
			if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {
				var dynamicStyle = '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + ele_border_width_selector;
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'  + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'theme-button-border-group-border-size', dynamicStyle );
			}
		} );
	} );

	smvmt_responsive_spacing( 'smvmt-settings[theme-button-padding]','.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .woocommerce a.button, .woocommerce button.button, .woocommerce .product a.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled], .wp-block-button .wp-block-button__link' + ele_padding_selector, 'padding', [ 'top', 'bottom' ] );

	smvmt_responsive_spacing( 'smvmt-settings[theme-button-padding]','.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .woocommerce a.button, .woocommerce button.button, .woocommerce .product a.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled], .wp-block-button .wp-block-button__link' + ele_padding_selector, 'padding', [ 'left', 'right' ] );

	/**
	 * Button border
	 */
	wp.customize( 'smvmt-settings[transparent-header-button-border-group]', function( value ) {
		value.bind( function( value ) {

			var optionValue = JSON.parse(value);
			var border =  optionValue['header-main-rt-trans-section-button-border-size'];

			if( '' != border.top || '' != border.right || '' != border.bottom || '' != border.left ) {
				var dynamicStyle = '.smvmt-theme-transparent-header .main-header-bar .button-custom-menu-item .smvmt-custom-button-link .smvmt-custom-button';
					dynamicStyle += '{';
					dynamicStyle += 'border-top-width:'  + border.top + 'px;';
					dynamicStyle += 'border-right-width:'  + border.right + 'px;';
					dynamicStyle += 'border-left-width:'   + border.left + 'px;';
					dynamicStyle += 'border-bottom-width:'   + border.bottom + 'px;';
					dynamicStyle += 'border-style: solid;';
					dynamicStyle += '}';

				smvmt_add_dynamic_css( 'header-main-rt-trans-section-button-border-size', dynamicStyle );
			}
		} );
	} );

	// Site Title - Font family
	smvmt_generate_outside_font_family_css( 'smvmt-settings[font-family-site-title]', '.site-title, .site-title a' );

	// Site Title - Font Weight
	smvmt_css( 'smvmt-settings[font-weight-site-title]', 'font-weight', '.site-title, .site-title a' );

	// Site Title - Font Size
	smvmt_responsive_font_size( 'smvmt-settings[font-size-site-title]', '.site-title, .site-title a' );

	// Site Title - Line Height
	smvmt_css( 'smvmt-settings[line-height-site-title]', 'line-height', '.site-title, .site-title a' );

	// Site Title - Text Transform
	smvmt_css( 'smvmt-settings[text-transform-site-title]', 'text-transform', '.site-title, .site-title a' );


	// Site tagline - Font family
	smvmt_generate_outside_font_family_css( 'smvmt-settings[font-family-site-tagline]', '.site-header .site-description' );

	// Site Tagline - Font Weight
	smvmt_css( 'smvmt-settings[font-weight-site-tagline]', 'font-weight', '.site-header .site-description' );

	// Site Tagline - Font Size
	smvmt_responsive_font_size( 'smvmt-settings[font-size-site-tagline]', '.site-header .site-description' );

	// Site Tagline - Line Height
	smvmt_css( 'smvmt-settings[line-height-site-tagline]', 'line-height', '.site-header .site-description' );

	// Site Tagline - Text Transform
	smvmt_css( 'smvmt-settings[text-transform-site-tagline]', 'text-transform', '.site-header .site-description' );

	if ( smvmtCustomizer.page_builder_button_style_css ) {

		var btn_color_ele = '';
		var btn_bg_color_ele = '';
		var btn_h_color_ele = '';
		var btn_bg_h_color_ele = '';
		var btn_border_color_ele = '';
		var btn_border_h_color_ele = '';

		if ( 'color-typo' == smvmtCustomizer.elementor_default_color_font_setting || 'color' == smvmtCustomizer.elementor_default_color_font_setting ) {
			// Theme Button - Text Color
			btn_color_ele = ',.elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';

			// Theme Button - Background Color
			btn_bg_color_ele = ',.elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';

			// Theme Button - Text Hover Color
			btn_h_color_ele = ',.elementor-button-wrapper .elementor-button:hover, .elementor-button-wrapper .elementor-button:focus';

			// Theme Button - Background Hover Color
			btn_bg_h_color_ele = ',.elementor-button-wrapper .elementor-button:hover, .elementor-button-wrapper .elementor-button:focus';

			// Theme Button - Border Color
			btn_border_color_ele = ', .elementor-button-wrapper .elementor-button, .elementor-button-wrapper .elementor-button:visited';

			// Theme Button - Border Hover Color
			btn_border_h_color_ele = ',.elementor-button-wrapper .elementor-button:hover, .elementor-button-wrapper .elementor-button:focus';
		}

		// Theme Button - Text Color
		smvmt_css( 'smvmt-settings[button-color]', 'color', '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + btn_color_ele );

		// Theme Button - Background Color
		smvmt_css( 'smvmt-settings[button-bg-color]', 'background-color', '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + btn_bg_color_ele );

		// Theme Button - Text Hover Color
		smvmt_css( 'smvmt-settings[button-h-color]', 'color', 'button:focus, .menu-toggle:hover, button:hover, .smvmt-button:hover, .button:hover, input[type=reset]:hover, input[type=reset]:focus, input#submit:hover, input#submit:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus, .wp-block-button .wp-block-button__link:hover, .wp-block-button .wp-block-button__link:focus' + btn_h_color_ele );

		// Theme Button - Background Hover Color
		smvmt_css( 'smvmt-settings[button-bg-h-color]', 'background-color', 'button:focus, .menu-toggle:hover, button:hover, .smvmt-button:hover, .button:hover, input[type=reset]:hover, input[type=reset]:focus, input#submit:hover, input#submit:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus, .wp-block-button .wp-block-button__link:hover, .wp-block-button .wp-block-button__link:focus' + btn_bg_h_color_ele );

		smvmt_css( 'smvmt-settings[theme-button-border-group-border-color]', 'border-color', '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .wp-block-button .wp-block-button__link' + btn_border_color_ele );

		// Theme Button - Border Hover Color
		smvmt_css( 'smvmt-settings[theme-button-border-group-border-h-color]', 'border-color', 'button:focus, .menu-toggle:hover, button:hover, .smvmt-button:hover, .button:hover, input[type=reset]:hover, input[type=reset]:focus, input#submit:hover, input#submit:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus, .wp-block-button .wp-block-button__link:hover, .wp-block-button .wp-block-button__link:focus' + btn_border_h_color_ele );

	} else {
		// Theme Button - Text Color
		smvmt_css( 'smvmt-settings[button-color]', 'color', '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

		// Theme Button - Background Color
		smvmt_css( 'smvmt-settings[button-bg-color]', 'background-color', '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

		// Theme Button - Border Color
		smvmt_css( 'smvmt-settings[button-bg-color]', 'border-color', '.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"]' );

		// Theme Button - Text Hover Color
		smvmt_css( 'smvmt-settings[button-h-color]', 'color', 'button:focus, .menu-toggle:hover, button:hover, .smvmt-button:hover, .button:hover, input[type=reset]:hover, input[type=reset]:focus, input#submit:hover, input#submit:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus' );

		// Theme Button - Background Hover Color
		smvmt_css( 'smvmt-settings[button-bg-h-color]', 'background-color', 'button:focus, .menu-toggle:hover, button:hover, .smvmt-button:hover, .button:hover, input[type=reset]:hover, input[type=reset]:focus, input#submit:hover, input#submit:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus' );

		smvmt_responsive_spacing( 'smvmt-settings[theme-button-padding]','.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .woocommerce a.button, .woocommerce button.button, .woocommerce .product a.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled]', 'padding', [ 'top', 'bottom' ] );
		smvmt_responsive_spacing( 'smvmt-settings[theme-button-padding]','.menu-toggle, button, .smvmt-button, .button, input#submit, input[type="button"], input[type="submit"], input[type="reset"], .woocommerce a.button, .woocommerce button.button, .woocommerce .product a.button, .woocommerce .woocommerce-message a.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button,.woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled]', 'padding', [ 'left', 'right' ] );
	}

} )( jQuery );
