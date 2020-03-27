<?php
/**
 * Helper class for font settings.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Font info class for System and Google fonts.
 */
if ( ! class_exists( 'SMVMT_Fonts_Data' ) ) :

	/**
	 * Fonts Data
	 */
	final class SMVMT_Fonts_Data {

		/**
		 * Localize Fonts
		 */
		public static function js() {

			$system = wp_json_encode( SMVMT_Font_Families::get_system_fonts() );
			$google = wp_json_encode( SMVMT_Font_Families::get_google_fonts() );
			$custom = wp_json_encode( SMVMT_Font_Families::get_custom_fonts() );
			if ( ! empty( $custom ) ) {
				return 'var AstFontFamilies = { system: ' . $system . ', custom: ' . $custom . ', google: ' . $google . ' };';
			} else {
				return 'var AstFontFamilies = { system: ' . $system . ', google: ' . $google . ' };';
			}
		}
	}

endif;

