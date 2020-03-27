<?php
/**
 * Heading Colors Options for smvmt theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 2.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Heading_Colors_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Heading_Colors_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt Heading Colors Settings.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 2.1.4
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				// Option: Base Heading Color.
				array(
					'default'   => '',
					'type'      => 'control',
					'control'   => 'smvmt-color',
					'transport' => 'postMessage',
					'priority'  => 18,
					'name'      => SMVMT_THEME_SETTINGS . '[heading-base-color]',
					'title'     => __( 'Heading Color ( H1 - H6 )', 'smvmt' ),
					'section'   => 'section-colors-body',
				),

				/**
				 * Heading Typography starts here - h1 - h3
				 */

				/**
				 * Option: Heading <H1> Font Family
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[font-family-h1]',
					'type'      => 'control',
					'control'   => 'smvmt-font',
					'font-type' => 'smvmt-font-family',
					'default'   => smvmt_get_option( 'font-family-h1' ),
					'title'     => __( 'Family', 'smvmt' ),
					'section'   => 'section-content-typo',
					'priority'  => 5,
					'connect'   => SMVMT_THEME_SETTINGS . '[font-weight-h1]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Font Weight
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[font-weight-h1]',
					'type'              => 'control',
					'control'           => 'smvmt-font',
					'font-type'         => 'smvmt-font-weight',
					'title'             => __( 'Weight', 'smvmt' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => smvmt_get_option( 'font-weight-h1' ),
					'section'           => 'section-content-typo',
					'priority'          => 7,
					'connect'           => SMVMT_THEME_SETTINGS . '[font-family-h1]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Text Transform
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[text-transform-h1]',
					'section'   => 'section-content-typo',
					'default'   => smvmt_get_option( 'text-transform-h1' ),
					'title'     => __( 'Text Transform', 'smvmt' ),
					'type'      => 'control',
					'control'   => 'select',
					'priority'  => 8,
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt' ),
						'none'       => __( 'None', 'smvmt' ),
						'capitalize' => __( 'Capitalize', 'smvmt' ),
						'uppercase'  => __( 'Uppercase', 'smvmt' ),
						'lowercase'  => __( 'Lowercase', 'smvmt' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H1> Line Height
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[line-height-h1]',
					'section'           => 'section-content-typo',
					'default'           => '',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'type'              => 'control',
					'control'           => 'smvmt-slider',
					'title'             => __( 'Line Height', 'smvmt' ),
					'transport'         => 'postMessage',
					'priority'          => 8,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Font Family
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[font-family-h2]',
					'type'      => 'control',
					'control'   => 'smvmt-font',
					'font-type' => 'smvmt-font-family',
					'title'     => __( 'Family', 'smvmt' ),
					'default'   => smvmt_get_option( 'font-family-h2' ),
					'section'   => 'section-content-typo',
					'priority'  => 10,
					'connect'   => SMVMT_THEME_SETTINGS . '[font-weight-h2]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Font Weight
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[font-weight-h2]',
					'type'              => 'control',
					'control'           => 'smvmt-font',
					'font-type'         => 'smvmt-font-weight',
					'title'             => __( 'Weight', 'smvmt' ),
					'section'           => 'section-content-typo',
					'default'           => smvmt_get_option( 'font-weight-h2' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'priority'          => 12,
					'connect'           => SMVMT_THEME_SETTINGS . '[font-family-h2]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Text Transform
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[text-transform-h2]',
					'section'   => 'section-content-typo',
					'default'   => smvmt_get_option( 'text-transform-h2' ),
					'title'     => __( 'Text Transform', 'smvmt' ),
					'type'      => 'control',
					'control'   => 'select',
					'transport' => 'postMessage',
					'priority'  => 13,
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt' ),
						'none'       => __( 'None', 'smvmt' ),
						'capitalize' => __( 'Capitalize', 'smvmt' ),
						'uppercase'  => __( 'Uppercase', 'smvmt' ),
						'lowercase'  => __( 'Lowercase', 'smvmt' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H2> Line Height
				 */

				array(
					'name'              => SMVMT_THEME_SETTINGS . '[line-height-h2]',
					'section'           => 'section-content-typo',
					'type'              => 'control',
					'control'           => 'smvmt-slider',
					'default'           => '',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'transport'         => 'postMessage',
					'title'             => __( 'Line Height', 'smvmt' ),
					'priority'          => 14,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Font Family
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[font-family-h3]',
					'type'      => 'control',
					'control'   => 'smvmt-font',
					'font-type' => 'smvmt-font-family',
					'default'   => smvmt_get_option( 'font-family-h3' ),
					'title'     => __( 'Family', 'smvmt' ),
					'section'   => 'section-content-typo',
					'priority'  => 15,
					'connect'   => SMVMT_THEME_SETTINGS . '[font-weight-h3]',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Font Weight
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[font-weight-h3]',
					'type'              => 'control',
					'control'           => 'smvmt-font',
					'font-type'         => 'smvmt-font-weight',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => smvmt_get_option( 'font-weight-h3' ),
					'title'             => __( 'Weight', 'smvmt' ),
					'section'           => 'section-content-typo',
					'priority'          => 17,
					'connect'           => SMVMT_THEME_SETTINGS . '[font-family-h3]',
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Text Transform
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[text-transform-h3]',
					'type'      => 'control',
					'section'   => 'section-content-typo',
					'title'     => __( 'Text Transform', 'smvmt' ),
					'default'   => smvmt_get_option( 'text-transform-h3' ),
					'transport' => 'postMessage',
					'control'   => 'select',
					'priority'  => 18,
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt' ),
						'none'       => __( 'None', 'smvmt' ),
						'capitalize' => __( 'Capitalize', 'smvmt' ),
						'uppercase'  => __( 'Uppercase', 'smvmt' ),
						'lowercase'  => __( 'Lowercase', 'smvmt' ),
					),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Heading <H3> Line Height
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[line-height-h3]',
					'type'              => 'control',
					'control'           => 'smvmt-slider',
					'section'           => 'section-content-typo',
					'title'             => __( 'Line Height', 'smvmt' ),
					'transport'         => 'postMessage',
					'default'           => '',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'priority'          => 19,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'transport'         => 'postMessage',
				),

				/**
				 * Option: Button Typography Section
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[button-typography-styling-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-buttons',
					'title'    => __( 'Typography', 'smvmt' ),
					'priority' => 25,
					'settings' => array(),
				),

				/**
				 * Option: Button Typography Heading
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[button-text-typography]',
					'default'   => smvmt_get_option( 'button-text-typography' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Button Text', 'smvmt' ),
					'section'   => 'section-buttons',
					'transport' => 'postMessage',
					'priority'  => 25,
				),

				/**
				 * Option: Button Font Family
				 */
				array(
					'name'      => 'font-family-button',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[button-text-typography]',
					'section'   => 'section-buttons',
					'control'   => 'smvmt-font',
					'font_type' => 'smvmt-font-family',
					'title'     => __( 'Family', 'smvmt' ),
					'default'   => smvmt_get_option( 'font-family-button' ),
					'connect'   => SMVMT_THEME_SETTINGS . '[font-weight-button]',
					'priority'  => 1,
				),

				/**
				 * Option: Button Font Size
				 */
				array(
					'name'        => 'font-size-button',
					'transport'   => 'postMessage',
					'title'       => __( 'Size', 'smvmt' ),
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[button-text-typography]',
					'section'     => 'section-buttons',
					'control'     => 'smvmt-responsive',
					'default'     => smvmt_get_option( 'font-size-button' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Button Font Weight
				 */
				array(
					'name'              => 'font-weight-button',
					'type'              => 'sub-control',
					'parent'            => SMVMT_THEME_SETTINGS . '[button-text-typography]',
					'section'           => 'section-buttons',
					'control'           => 'smvmt-font',
					'font_type'         => 'smvmt-font-weight',
					'title'             => __( 'Weight', 'smvmt' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => smvmt_get_option( 'font-weight-button' ),
					'connect'           => 'font-family-button',
					'priority'          => 2,
				),

				/**
				 * Option: Button Text Transform
				 */
				array(
					'name'      => 'text-transform-button',
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'text-transform-button' ),
					'title'     => __( 'Text Transform', 'smvmt' ),
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[button-text-typography]',
					'section'   => 'section-buttons',
					'control'   => 'smvmt-select',
					'priority'  => 3,
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt' ),
						'none'       => __( 'None', 'smvmt' ),
						'capitalize' => __( 'Capitalize', 'smvmt' ),
						'uppercase'  => __( 'Uppercase', 'smvmt' ),
						'lowercase'  => __( 'Lowercase', 'smvmt' ),
					),
				),

				/**
				 * Option: Theme Button Line Height
				 */
				array(
					'name'              => 'theme-btn-line-height',
					'control'           => 'smvmt-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => smvmt_get_option( 'theme-btn-line-height' ),
					'parent'            => SMVMT_THEME_SETTINGS . '[button-text-typography]',
					'section'           => 'section-buttons',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Line Height', 'smvmt' ),
					'suffix'            => '',
					'priority'          => 4,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Theme Button Line Height
				 */
				array(
					'name'              => 'theme-btn-letter-spacing',
					'control'           => 'smvmt-slider',
					'transport'         => 'postMessage',
					'type'              => 'sub-control',
					'default'           => '',
					'parent'            => SMVMT_THEME_SETTINGS . '[button-text-typography]',
					'section'           => 'section-buttons',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'title'             => __( 'Letter Spacing', 'smvmt' ),
					'suffix'            => '',
					'priority'          => 5,
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),

			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new SMVMT_Heading_Colors_Configs();
