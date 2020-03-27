<?php
/**
 * Above Header - Typography Options for our theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.0.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'SMVMT_Customizer_Config_Base' ) ) {
	return;
}


if ( ! class_exists( 'SMVMT_Above_Header_Typo_Configs' ) ) {

	/**
	 * Register above header Configurations.
	 */
	class SMVMT_Above_Header_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Above Header Typo Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Font Family
				 */
				array(
					'name'      => 'above-header-font-family',
					'parent'    => SMVMT_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'  => 5,
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'control'   => 'smvmt-font',
					'font_type' => 'smvmt-font-family',
					'default'   => smvmt_get_option( 'above-header-font-family' ),
					'title'     => __( 'Family', 'smvmt-addon' ),
					'connect'   => SMVMT_THEME_SETTINGS . '[above-header-font-weight]',
				),

				/**
				 * Option: Font Size
				 */
				array(
					'name'        => 'above-header-font-size',
					'parent'      => SMVMT_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'    => 5,
					'transport'   => 'postMessage',
					'type'        => 'sub-control',
					'section'     => 'section-above-header',
					'control'     => 'smvmt-responsive',
					'default'     => smvmt_get_option( 'above-header-font-size' ),
					'title'       => __( 'Size', 'smvmt-addon' ),
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
					'name'              => 'above-header-font-weight',
					'parent'            => SMVMT_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'          => 5,
					'default'           => smvmt_get_option( 'above-header-font-weight' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'section'           => 'section-above-header',
					'control'           => 'smvmt-font',
					'font_type'         => 'smvmt-font-weight',
					'title'             => __( 'Weight', 'smvmt-addon' ),
					'connect'           => 'above-header-font-family',
				),

				/**
				 * Option: Text Transform
				 */
				array(
					'name'      => 'above-header-text-transform',
					'parent'    => SMVMT_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'priority'  => 5,
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'smvmt-addon' ),
					'default'   => smvmt_get_option( 'above-header-text-transform' ),
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'control'   => 'smvmt-select',
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt-addon' ),
						'none'       => __( 'None', 'smvmt-addon' ),
						'capitalize' => __( 'Capitalize', 'smvmt-addon' ),
						'uppercase'  => __( 'Uppercase', 'smvmt-addon' ),
						'lowercase'  => __( 'Lowercase', 'smvmt-addon' ),
					),
				),

				/**
				 * Option: Above Header Submenu Font Family
				 */
				array(
					'name'      => 'font-family-above-header-dropdown-menu',
					'parent'    => SMVMT_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'  => 5,
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'control'   => 'smvmt-font',
					'font_type' => 'smvmt-font-family',
					'title'     => __( 'Family', 'smvmt-addon' ),
					'default'   => smvmt_get_option( 'font-family-above-header-dropdown-menu' ),
					'connect'   => SMVMT_THEME_SETTINGS . '[font-weight-above-header-dropdown-menu]',
				),

				/**
				 * Option: Above Header Submenu Font Size
				 */
				array(
					'name'        => 'font-size-above-header-dropdown-menu',
					'parent'      => SMVMT_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'    => 5,
					'transport'   => 'postMessage',
					'type'        => 'sub-control',
					'section'     => 'section-above-header',
					'control'     => 'smvmt-responsive',
					'title'       => __( 'Size', 'smvmt-addon' ),
					'default'     => smvmt_get_option( 'font-size-above-header-dropdown-menu' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Above Header Submenu Font Weight
				 */
				array(
					'name'              => 'font-weight-above-header-dropdown-menu',
					'parent'            => SMVMT_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'          => 5,
					'type'              => 'sub-control',
					'section'           => 'section-above-header',
					'control'           => 'smvmt-font',
					'font_type'         => 'smvmt-font-weight',
					'default'           => smvmt_get_option( 'font-weight-above-header-dropdown-menu' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'smvmt-addon' ),
					'connect'           => 'font-family-above-header-dropdown-menu',
				),

				/**
				 * Option: Above Header Submenu Text Transform
				 */
				array(
					'name'      => 'text-transform-above-header-dropdown-menu',
					'parent'    => SMVMT_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'priority'  => 5,
					'type'      => 'sub-control',
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'title'     => __( 'Text Transform', 'smvmt-addon' ),
					'default'   => smvmt_get_option( 'text-transform-above-header-dropdown-menu' ),
					'control'   => 'smvmt-select',
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt-addon' ),
						'none'       => __( 'None', 'smvmt-addon' ),
						'capitalize' => __( 'Capitalize', 'smvmt-addon' ),
						'uppercase'  => __( 'Uppercase', 'smvmt-addon' ),
						'lowercase'  => __( 'Lowercase', 'smvmt-addon' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new SMVMT_Above_Header_Typo_Configs();
