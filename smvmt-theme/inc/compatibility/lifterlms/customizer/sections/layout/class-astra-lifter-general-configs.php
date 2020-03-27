<?php
/**
 * LifterLMS General Options for our theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Lifter_General_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Lifter_General_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt-LifterLMS General Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Course Columns
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[llms-course-grid]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive-slider',
					'section'     => 'section-lifterlms',
					'default'     => array(
						'desktop' => 3,
						'tablet'  => 2,
						'mobile'  => 1,
					),
					'title'       => __( 'Course Columns', 'smvmt' ),
					'priority'    => 0,
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),

				/**
				 * Option: Membership Columns
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[llms-membership-grid]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive-slider',
					'section'     => 'section-lifterlms',
					'default'     => array(
						'desktop' => 3,
						'tablet'  => 2,
						'mobile'  => 1,
					),
					'title'       => __( 'Membership Columns', 'smvmt' ),
					'priority'    => 0,
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new SMVMT_Lifter_General_Configs();
