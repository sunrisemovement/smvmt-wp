<?php
/**
 * Typography - Breadcrumbs Options for theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 1.7.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'SMVMT_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.7.0
 */
if ( ! class_exists( 'SMVMT_Breadcrumbs_Typo_Configs' ) ) {

	/**
	 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
	 */
	class SMVMT_Breadcrumbs_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.7.0
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = SMVMT_Theme_Options::defaults();

			$_configs = array(

				/**
				 * Option: Divider
				 * Option: breadcrumb Typography Section divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[section-breadcrumb-typography-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-breadcrumb',
					'title'    => __( 'Typography', 'smvmt' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'priority' => 73,
					'settings' => array(),
				),

				/*
				 * Breadcrumb Typography
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'default'   => smvmt_get_option( 'section-breadcrumb-typo' ),
					'type'      => 'control',
					'required'  => array( SMVMT_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt' ),
					'section'   => 'section-breadcrumb',
					'transport' => 'postMessage',
					'priority'  => 73,
				),

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'breadcrumb-font-family',
					'default'   => smvmt_get_option( 'breadcrumb-font-family' ),
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'   => 'section-breadcrumb',
					'control'   => 'smvmt-font',
					'font_type' => 'smvmt-font-family',
					'title'     => __( 'Family', 'smvmt' ),
					'connect'   => 'breadcrumb-font-weight',
					'priority'  => 5,
				),

				/**
				 * Option: Font Size
				 */
				array(
					'name'        => 'breadcrumb-font-size',
					'control'     => 'smvmt-responsive',
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'     => 'section-breadcrumb',
					'default'     => smvmt_get_option( 'breadcrumb-font-size' ),
					'transport'   => 'postMessage',
					'title'       => __( 'Size', 'smvmt' ),
					'priority'    => 10,
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Font Weight
				 */
				array(
					'name'              => 'breadcrumb-font-weight',
					'control'           => 'smvmt-font',
					'type'              => 'sub-control',
					'parent'            => SMVMT_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'           => 'section-breadcrumb',
					'font_type'         => 'smvmt-font-weight',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => smvmt_get_option( 'breadcrumb-font-weight' ),
					'title'             => __( 'Weight', 'smvmt' ),
					'connect'           => 'breadcrumb-font-family',
					'priority'          => 15,
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'breadcrumb-text-transform',
					'control'   => 'smvmt-select',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'   => 'section-breadcrumb',
					'default'   => smvmt_get_option( 'breadcrumb-text-transform' ),
					'title'     => __( 'Text Transform', 'smvmt' ),
					'transport' => 'postMessage',
					'priority'  => 20,
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt' ),
						'none'       => __( 'None', 'smvmt' ),
						'capitalize' => __( 'Capitalize', 'smvmt' ),
						'uppercase'  => __( 'Uppercase', 'smvmt' ),
						'lowercase'  => __( 'Lowercase', 'smvmt' ),
					),
				),

				/**
				 * Option: Line Height
				 */
				array(
					'name'              => 'breadcrumb-line-height',
					'control'           => 'smvmt-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => '',
					'parent'            => SMVMT_THEME_SETTINGS . '[section-breadcrumb-typo]',
					'section'           => 'section-breadcrumb',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'smvmt' ),
					'suffix'            => '',
					'priority'          => 25,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Breadcrumbs_Typo_Configs();
