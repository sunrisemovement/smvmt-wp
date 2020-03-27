<?php
/**
 * Styling Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Body_Colors_Configs' ) ) {

	/**
	 * Register Body Color Customizer Configurations.
	 */
	class SMVMT_Body_Colors_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Body Color Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$_configs = array(

				/**
				 * Option: Text Color
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[text-color]',
					'default'  => '#3a3a3a',
					'type'     => 'control',
					'control'  => 'smvmt-color',
					'section'  => 'section-colors-body',
					'priority' => 5,
					'title'    => __( 'Text Color', 'smvmt' ),
				),

				/**
				 * Option: Theme Color
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[theme-color]',
					'type'     => 'control',
					'control'  => 'smvmt-color',
					'section'  => 'section-colors-body',
					'default'  => '#0274be',
					'priority' => 5,
					'title'    => __( 'Theme Color', 'smvmt' ),
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[link-color]',
					'section'  => 'section-colors-body',
					'type'     => 'control',
					'control'  => 'smvmt-color',
					'default'  => '#0274be',
					'priority' => 5,
					'title'    => __( 'Link Color', 'smvmt' ),
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[link-h-color]',
					'section'  => 'section-colors-body',
					'default'  => '#3a3a3a',
					'type'     => 'control',
					'control'  => 'smvmt-color',
					'priority' => 15,
					'title'    => __( 'Link Hover Color', 'smvmt' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-outside-bg-color]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-colors-body',
					'priority' => 20,
					'settings' => array(),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new SMVMT_Body_Colors_Configs();


