<?php
/**
 * Container Options for smvmt theme.
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

if ( ! class_exists( 'SMVMT_Learndash_Container_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Learndash_Container_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register LearnDash Container settings.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[learndash-content-divider]',
					'type'     => 'control',
					'section'  => 'section-container-layout',
					'control'  => 'smvmt-divider',
					'priority' => 68,
					'settings' => array(),
				),

				/**
				 * Option: Shop Page
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[learndash-content-layout]',
					'type'        => 'control',
					'control'     => 'select',
					'section'     => 'section-container-layout',
					'default'     => smvmt_get_option( 'learndash-content-layout' ),
					'priority'    => 68,
					'title'       => __( 'LearnDash Layout', 'smvmt' ),
					'description' => __( 'Will be applied to All Single Courses, Topics, Lessons and Quizzes. Does not work on pages created with LearnDash shortcodes.', 'smvmt' ),
					'choices'     => array(
						'default'                 => __( 'Default', 'smvmt' ),
						'boxed-container'         => __( 'Boxed', 'smvmt' ),
						'content-boxed-container' => __( 'Content Boxed', 'smvmt' ),
						'plain-container'         => __( 'Full Width / Contained', 'smvmt' ),
						'page-builder'            => __( 'Full Width / Stretched', 'smvmt' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new SMVMT_Learndash_Container_Configs();