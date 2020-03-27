<?php
/**
 * Content Spacing Options for our theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Lifter_Sidebar_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Lifter_Sidebar_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt-LifterLMS Sidebar Customizer Configurations.
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
					'name'     => SMVMT_THEME_SETTINGS . '[lifterlms-course-lesson-sidebar-layout-divider]',
					'section'  => 'section-sidebars',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Shop Page
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[lifterlms-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'priority' => 5,
					'default'  => smvmt_get_option( 'lifterlms-sidebar-layout' ),
					'title'    => __( 'LifterLMS', 'smvmt' ),
					'choices'  => array(
						'default'       => __( 'Default', 'smvmt' ),
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),

				/**
				 * Option: LifterLMS Course/Lesson
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[lifterlms-course-lesson-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => smvmt_get_option( 'lifterlms-course-lesson-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'LifterLMS Course/Lesson', 'smvmt' ),
					'choices'  => array(
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

new SMVMT_Lifter_Sidebar_Configs();
