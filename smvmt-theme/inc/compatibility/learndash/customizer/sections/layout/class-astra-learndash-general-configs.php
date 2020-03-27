<?php
/**
 * LifterLMS General Options for our theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Learndash_General_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Learndash_General_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register LearnDash General Layout settings.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Display Serial Number
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[learndash-lesson-serial-number]',
					'section'  => 'section-learndash',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => smvmt_get_option( 'learndash-lesson-serial-number' ),
					'title'    => __( 'Display Serial Number', 'smvmt' ),
					'priority' => 25,
				),

				/**
				 * Option: Differentiate Rows
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[learndash-differentiate-rows]',
					'default'  => smvmt_get_option( 'learndash-differentiate-rows' ),
					'type'     => 'control',
					'control'  => 'checkbox',
					'section'  => 'section-learndash',
					'title'    => __( 'Differentiate Rows', 'smvmt' ),
					'priority' => 30,
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new SMVMT_Learndash_General_Configs();
