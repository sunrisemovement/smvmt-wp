<?php
/**
 * smvmt Theme Customizer Configuration Base.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.4.3
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'SMVMT_Customizer_Config_Base' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Customizer_Config_Base {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'SMVMT_customizer_configurations', array( $this, 'register_configuration' ), 30, 2 );
		}

		/**
		 * Base Method for Registering Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			return $configurations;
		}

		/**
		 * Section Description
		 *
		 * @since 1.4.3
		 *
		 * @param  array $args Description arguments.
		 * @return mixed       Markup of the section description.
		 */
		public function section_get_description( $args ) {

			// Return if white labeled.
			if ( class_exists( 'SMVMT_Ext_White_Label_Markup' ) ) {
				if ( ! empty( SMVMT_Ext_White_Label_Markup::$branding['smvmt']['name'] ) ) {
					return '';
				}
			}

			// Description.
			$content  = '<div class="smvmt-section-description">';
			$content .= wp_kses_post( smvmt_get_prop( $args, 'description' ) );

			// Links.
			if ( smvmt_get_prop( $args, 'links' ) ) {
				$content .= '<ul>';
				foreach ( $args['links'] as $index => $link ) {

					if ( smvmt_get_prop( $link, 'attrs' ) ) {

						$content .= '<li>';

						// Attribute mapping.
						$attributes = ' target="_blank" ';
						foreach ( smvmt_get_prop( $link, 'attrs' ) as $attr => $attr_value ) {
							$attributes .= ' ' . $attr . '="' . esc_attr( $attr_value ) . '" ';
						}
						$content .= '<a ' . $attributes . '>' . esc_html( smvmt_get_prop( $link, 'text' ) ) . '</a></li>';

						$content .= '</li>';
					}
				}
				$content .= '</ul>';
			}

			$content .= '</div><!-- .smvmt-section-description -->';

			return $content;
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Customizer_Config_Base();
