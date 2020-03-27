<?php
/**
 * Styling Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.15
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Body_Typo_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Body_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Body Typography Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Body & Content Divider
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[divider-base-typo]',
					'type'      => 'control',
					'control'   => 'smvmt-heading',
					'section'   => 'section-body-typo',
					'priority'  => 4,
					'title'     => __( 'Body & Content', 'smvmt' ),
					'settings'  => array(),
					'separator' => false,
				),

				/**
				 * Option: Font Family
				 */

				array(
					'name'        => SMVMT_THEME_SETTINGS . '[body-font-family]',
					'type'        => 'control',
					'control'     => 'smvmt-font',
					'font-type'   => 'smvmt-font-family',
					'smvmt_inherit' => __( 'Default System Font', 'smvmt' ),
					'default'     => smvmt_get_option( 'body-font-family' ),
					'section'     => 'section-body-typo',
					'priority'    => 5,
					'title'       => __( 'Family', 'smvmt' ),
					'connect'     => SMVMT_THEME_SETTINGS . '[body-font-weight]',
					'variant'     => SMVMT_THEME_SETTINGS . '[body-font-variant]',
				),
				/**
				 * Option: Font Variant
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[body-font-variant]',
					'type'              => 'control',
					'control'           => 'smvmt-font',
					'font-type'         => 'smvmt-font-variant',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_variant' ),
					'default'           => smvmt_get_option( 'body-font-variant' ),
					'smvmt_inherit'       => __( 'Default', 'smvmt' ),
					'section'           => 'section-body-typo',
					'priority'          => 10,
					'title'             => __( 'Variants', 'smvmt' ),
					'variant'           => SMVMT_THEME_SETTINGS . '[body-font-family]',
				),

				/**
				 * Option: Font Weight
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[body-font-weight]',
					'type'              => 'control',
					'control'           => 'smvmt-font',
					'font-type'         => 'smvmt-font-weight',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => smvmt_get_option( 'body-font-weight' ),
					'smvmt_inherit'       => __( 'Default', 'smvmt' ),
					'section'           => 'section-body-typo',
					'priority'          => 15,
					'title'             => __( 'Weight', 'smvmt' ),
					'connect'           => SMVMT_THEME_SETTINGS . '[body-font-family]',
				),

				/**
				 * Option: Body Text Transform
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[body-text-transform]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-body-typo',
					'default'  => smvmt_get_option( 'body-text-transform' ),
					'priority' => 20,
					'title'    => __( 'Text Transform', 'smvmt' ),
					'choices'  => array(
						''           => __( 'Default', 'smvmt' ),
						'none'       => __( 'None', 'smvmt' ),
						'capitalize' => __( 'Capitalize', 'smvmt' ),
						'uppercase'  => __( 'Uppercase', 'smvmt' ),
						'lowercase'  => __( 'Lowercase', 'smvmt' ),
					),
				),

				/**
				 * Option: Body Font Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[font-size-body]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-body-typo',
					'default'     => smvmt_get_option( 'font-size-body' ),
					'priority'    => 10,
					'title'       => __( 'Size', 'smvmt' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
					),
				),

				/**
				 * Option: Body Line Height
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[body-line-height]',
					'type'              => 'control',
					'control'           => 'smvmt-slider',
					'section'           => 'section-body-typo',
					'default'           => '',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'priority'          => 25,
					'title'             => __( 'Line Height', 'smvmt' ),
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Paragraph Margin Bottom
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[para-margin-bottom]',
					'type'              => 'control',
					'control'           => 'smvmt-slider',
					'default'           => '',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'transport'         => 'postMessage',
					'section'           => 'section-body-typo',
					'priority'          => 25,
					'title'             => __( 'Paragraph Margin Bottom', 'smvmt' ),
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 0.5,
						'step' => 0.01,
						'max'  => 5,
					),
				),

				/**
				 * Option: Body & Content Divider
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[divider-headings-typo]',
					'type'      => 'control',
					'control'   => 'smvmt-heading',
					'section'   => 'section-content-typo',
					'priority'  => 3,
					'title'     => __( 'Headings ( H1 - H6 )', 'smvmt' ),
					'settings'  => array(),
					'separator' => false,
				),

				/**
				 * Option: Headings Font Family
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[headings-font-family]',
					'type'      => 'control',
					'control'   => 'smvmt-font',
					'font-type' => 'smvmt-font-family',
					'default'   => smvmt_get_option( 'headings-font-family' ),
					'title'     => __( 'Family', 'smvmt' ),
					'section'   => 'section-content-typo',
					'priority'  => 3,
					'connect'   => SMVMT_THEME_SETTINGS . '[headings-font-weight]',
					'variant'   => SMVMT_THEME_SETTINGS . '[headings-font-variant]',
				),

				/**
				 * Option: Font Variant
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[headings-font-variant]',
					'type'              => 'control',
					'control'           => 'smvmt-font',
					'font-type'         => 'smvmt-font-variant',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_variant' ),
					'default'           => smvmt_get_option( 'headings-font-variant' ),
					'smvmt_inherit'       => __( 'Default', 'smvmt' ),
					'section'           => 'section-content-typo',
					'priority'          => 3,
					'title'             => __( 'Variants', 'smvmt' ),
					'variant'           => SMVMT_THEME_SETTINGS . '[headings-font-family]',
				),

				/**
				 * Option: Headings Font Weight
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[headings-font-weight]',
					'type'              => 'control',
					'control'           => 'smvmt-font',
					'font-type'         => 'smvmt-font-weight',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'default'           => smvmt_get_option( 'headings-font-weight' ),
					'title'             => __( 'Weight', 'smvmt' ),
					'section'           => 'section-content-typo',
					'priority'          => 3,
					'connect'           => SMVMT_THEME_SETTINGS . '[headings-font-family]',
				),

				/**
				 * Option: Headings Text Transform
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[headings-text-transform]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-content-typo',
					'title'    => __( 'Text Transform', 'smvmt' ),
					'default'  => smvmt_get_option( 'headings-text-transform' ),
					'priority' => 3,
					'choices'  => array(
						''           => __( 'Inherit', 'smvmt' ),
						'none'       => __( 'None', 'smvmt' ),
						'capitalize' => __( 'Capitalize', 'smvmt' ),
						'uppercase'  => __( 'Uppercase', 'smvmt' ),
						'lowercase'  => __( 'Lowercase', 'smvmt' ),
					),
				),

				/**
				 * Option: Heading <H1> Line Height
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[headings-line-height]',
					'section'           => 'section-content-typo',
					'default'           => smvmt_get_option( 'headings-line-height' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'type'              => 'control',
					'control'           => 'smvmt-slider',
					'title'             => __( 'Line Height', 'smvmt' ),
					'transport'         => 'postMessage',
					'priority'          => 4,
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 1,
						'step' => 0.01,
						'max'  => 5,
					),
					'section'           => 'section-content-typo',
					'transport'         => 'postMessage',
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new SMVMT_Body_Typo_Configs();


