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
 * smvmt Fonts
 */
final class SMVMT_Fonts {

	/**
	 * Get fonts to generate.
	 *
	 * @since 1.0.0
	 * @var array $fonts
	 */
	private static $fonts = array();

	/**
	 * Adds data to the $fonts array for a font to be rendered.
	 *
	 * @since 1.0.0
	 * @param string $name The name key of the font to add.
	 * @param array  $variants An array of weight variants.
	 * @return void
	 */
	public static function add_font( $name, $variants = array() ) {

		if ( 'inherit' == $name ) {
			return;
		}
		if ( ! is_array( $variants ) ) {
			// For multiple variant selectons for fonts.
			$variants = explode( ',', str_replace( 'italic', 'i', $variants ) );
		}

		if ( is_array( $variants ) ) {
			$key = array_search( 'inherit', $variants );
			if ( false !== $key ) {

				unset( $variants[ $key ] );

				if ( ! in_array( 400, $variants ) ) {
					$variants[] = 400;
				}
			}
		} elseif ( 'inherit' == $variants ) {
			$variants = 400;
		}

		if ( isset( self::$fonts[ $name ] ) ) {
			foreach ( (array) $variants as $variant ) {
				if ( ! in_array( $variant, self::$fonts[ $name ]['variants'] ) ) {
					self::$fonts[ $name ]['variants'][] = $variant;
				}
			}
		} else {
			self::$fonts[ $name ] = array(
				'variants' => (array) $variants,
			);
		}
	}

	/**
	 * Get Fonts
	 */
	public static function get_fonts() {

		do_action( 'smvmt_get_fonts' );
		return apply_filters( 'smvmt_add_fonts', self::$fonts );
	}

	/**
	 * Renders the <link> tag for all fonts in the $fonts array.
	 *
	 * @since 1.0.16 Added the filter 'SMVMT_render_fonts' to support custom fonts.
	 * @since 1.0.0
	 * @return void
	 */
	public static function render_fonts() {

		$font_list = apply_filters( 'SMVMT_render_fonts', self::get_fonts() );

		$google_fonts = array();
		$font_subset  = array();

		$system_fonts = SMVMT_Font_Families::get_system_fonts();

		foreach ( $font_list as $name => $font ) {
			if ( ! empty( $name ) && ! isset( $system_fonts[ $name ] ) ) {

				// Add font variants.
				$google_fonts[ $name ] = $font['variants'];

				// Add Subset.
				$subset = apply_filters( 'smvmt_font_subset', '', $name );
				if ( ! empty( $subset ) ) {
					$font_subset[] = $subset;
				}
			}
		}

		$google_font_url = self::google_fonts_url( $google_fonts, $font_subset );
		wp_enqueue_style( 'smvmt-google-fonts', $google_font_url, array(), SMVMT_THEME_VERSION, 'all' );
	}

	/**
	 * Google Font URL
	 * Combine multiple google font in one URL
	 *
	 * @link https://shellcreeper.com/?p=1476
	 * @param array $fonts      Google Fonts array.
	 * @param array $subsets    Font's Subsets array.
	 *
	 * @return string
	 */
	public static function google_fonts_url( $fonts, $subsets = array() ) {

		/* URL */
		$base_url  = '//fonts.googleapis.com/css';
		$font_args = array();
		$family    = array();

		// This is deprecated filter hook.
		$fonts = apply_filters( 'SMVMT_google_fonts', $fonts );

		$fonts = apply_filters( 'SMVMT_google_fonts_selected', $fonts );

		/* Format Each Font Family in Array */
		foreach ( $fonts as $font_name => $font_weight ) {
			$font_name = str_replace( ' ', '+', $font_name );
			if ( ! empty( $font_weight ) ) {
				if ( is_array( $font_weight ) ) {
					$font_weight = implode( ',', $font_weight );
				}
				$font_family = explode( ',', $font_name );
				$font_family = str_replace( "'", '', smvmt_get_prop( $font_family, 0 ) );
				$family[]    = trim( $font_family . ':' . rawurlencode( trim( $font_weight ) ) );
			} else {
				$family[] = trim( $font_name );
			}
		}

		/* Only return URL if font family defined. */
		if ( ! empty( $family ) ) {

			/* Make Font Family a String */
			$family = implode( '|', $family );

			/* Add font family in args */
			$font_args['family'] = $family;

			/* Add font subsets in args */
			if ( ! empty( $subsets ) ) {

				/* format subsets to string */
				if ( is_array( $subsets ) ) {
					$subsets = implode( ',', $subsets );
				}

				$font_args['subset'] = rawurlencode( trim( $subsets ) );
			}

			$font_args['display'] = smvmt_get_fonts_display_property();

			return add_query_arg( $font_args, $base_url );
		}

		return '';
	}
}
