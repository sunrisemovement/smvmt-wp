<?php
/**
 * Content Spacing Options for our theme.
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

if ( ! class_exists( 'SMVMT_Learndash_Sidebar_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Learndash_Sidebar_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register LearnDash Sidebar settings.
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
					'name'     => SMVMT_THEME_SETTINGS . '[learndash-sidebar-layout-divider]',
					'type'     => 'control',
					'section'  => 'section-sidebars',
					'control'  => 'smvmt-divider',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: LearnDash
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[learndash-sidebar-layout]',
					'type'        => 'control',
					'control'     => 'select',
					'section'     => 'section-sidebars',
					'default'     => smvmt_get_option( 'learndash-sidebar-layout' ),
					'priority'    => 5,
					'title'       => __( 'LearnDash', 'smvmt' ),
					'description' => __( 'This layout will apply on all single course, lesson, topic and quiz.', 'smvmt' ),
					'choices'     => array(
						'default'       => __( 'Default', 'smvmt' ),
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new SMVMT_Learndash_Sidebar_Configs();
