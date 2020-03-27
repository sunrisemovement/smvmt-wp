<?php
/**
 * Below Header - Typpography Options for our theme.
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

if ( ! class_exists( 'SMVMT_Below_Header_Typo_Configs' ) ) {

	/**
	 * Register below header Configurations.
	 */
	class SMVMT_Below_Header_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Below Header Typo Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Below Header Menu Font Family
				 */

				array(
					'name'      => 'font-family-below-header-primary-menu',
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
					'control'   => 'smvmt-font',
					'font_type' => 'smvmt-font-family',
					'default'   => smvmt_get_option( 'font-family-below-header-primary-menu' ),
					'title'     => __( 'Family', 'smvmt-addon' ),
					'connect'   => SMVMT_THEME_SETTINGS . '[font-weight-below-header-primary-menu]',
				),

				/**
				 * Option: Below Header Menu Font Size
				 */
				array(
					'name'        => 'font-size-below-header-primary-menu',
					'transport'   => 'postMessage',
					'parent'      => SMVMT_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'title'       => __( 'Size', 'smvmt-addon' ),
					'type'        => 'sub-control',
					'section'     => 'section-below-header',
					'control'     => 'smvmt-responsive',
					'default'     => smvmt_get_option( 'font-size-below-header-primary-menu' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Below Header Menu Font Weight
				 */
				array(
					'name'              => 'font-weight-below-header-primary-menu',
					'parent'            => SMVMT_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'type'              => 'sub-control',
					'control'           => 'smvmt-font',
					'section'           => 'section-below-header',
					'font_type'         => 'smvmt-font-weight',
					'default'           => smvmt_get_option( 'font-weight-below-header-primary-menu' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'title'             => __( 'Weight', 'smvmt-addon' ),
					'connect'           => 'font-family-below-header-primary-menu',
				),

				/**
				 * Option: Below Header Menu Text Transform
				 */
				array(
					'name'      => 'text-transform-below-header-primary-menu',
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-menu-typography-styling]',
					'type'      => 'sub-control',
					'control'   => 'smvmt-select',
					'section'   => 'section-below-header',
					'title'     => __( 'Text Transform', 'smvmt-addon' ),
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'text-transform-below-header-primary-menu' ),
					'choices'   => array(
						''           => __( 'Inherit', 'smvmt-addon' ),
						'none'       => __( 'None', 'smvmt-addon' ),
						'capitalize' => __( 'Capitalize', 'smvmt-addon' ),
						'uppercase'  => __( 'Uppercase', 'smvmt-addon' ),
						'lowercase'  => __( 'Lowercase', 'smvmt-addon' ),
					),
				),

				/**
				 * Option: Below Header Submenu Font Family
				 */
				array(
					'name'      => 'font-family-below-header-dropdown-menu',
					'type'      => 'sub-control',
					'control'   => 'smvmt-font',
					'section'   => 'section-below-header',
					'font_type' => 'smvmt-font-family',
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'     => __( 'Family', 'smvmt-addon' ),
					'default'   => smvmt_get_option( 'font-family-below-header-dropdown-menu' ),
					'connect'   => SMVMT_THEME_SETTINGS . '[font-weight-below-header-dropdown-menu]',
				),

				/**
				 * Option: Below Header Submenu Font Size
				 */
				array(
					'name'        => 'font-size-below-header-dropdown-menu',
					'transport'   => 'postMessage',
					'type'        => 'sub-control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-below-header',
					'parent'      => SMVMT_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'       => __( 'Size', 'smvmt-addon' ),
					'default'     => smvmt_get_option( 'font-size-below-header-dropdown-menu' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Below Header Submenu Font Weight
				 */
				array(
					'name'              => 'font-weight-below-header-dropdown-menu',
					'type'              => 'sub-control',
					'control'           => 'smvmt-font',
					'section'           => 'section-below-header',
					'font_type'         => 'smvmt-font-weight',
					'default'           => smvmt_get_option( 'font-weight-below-header-dropdown-menu' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'parent'            => SMVMT_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'             => __( 'Weight', 'smvmt-addon' ),
					'connect'           => 'font-family-below-header-dropdown-menu',
				),

				/**
				 * Option: Below Header Submenu Text Transform
				 */
				array(
					'name'      => 'text-transform-below-header-dropdown-menu',
					'transport' => 'postMessage',
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-submenu-typography-styling]',
					'title'     => __( 'Text Transform', 'smvmt-addon' ),
					'default'   => smvmt_get_option( 'text-transform-below-header-dropdown-menu' ),
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
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
				 * Option: Below Header Content Font Family
				 */

				array(
					'name'      => 'font-family-below-header-content',
					'default'   => smvmt_get_option( 'font-family-below-header-content' ),
					'type'      => 'sub-control',
					'control'   => 'smvmt-font',
					'section'   => 'section-below-header',
					'font_type' => 'smvmt-font-family',
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'     => __( 'Family', 'smvmt-addon' ),
					'connect'   => 'font-weight-below-header-content',
				),

				/**
				 * Option: Below Header Content Font Size
				 */
				array(
					'name'        => 'font-size-below-header-content',
					'type'        => 'sub-control',
					'transport'   => 'postMessage',
					'default'     => smvmt_get_option( 'font-size-below-header-content' ),
					'parent'      => SMVMT_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'       => __( 'Size', 'smvmt-addon' ),
					'control'     => 'smvmt-responsive',
					'section'     => 'section-below-header',
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Below Header Content Font Weight
				 */
				array(
					'name'              => 'font-weight-below-header-content',
					'default'           => smvmt_get_option( 'font-weight-below-header-content' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_font_weight' ),
					'type'              => 'sub-control',
					'control'           => 'smvmt-font',
					'section'           => 'section-below-header',
					'font_type'         => 'smvmt-font-weight',
					'parent'            => SMVMT_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'             => __( 'Weight', 'smvmt-addon' ),
					'connect'           => 'font-family-below-header-content',
				),

				/**
				 * Option: Below Header Content Text Transform
				 */
				array(
					'name'      => 'text-transform-below-header-content',
					'type'      => 'sub-control',
					'control'   => 'smvmt-select',
					'section'   => 'section-below-header',
					'default'   => smvmt_get_option( 'text-transform-below-header-content' ),
					'transport' => 'postMessage',
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-content-typography-styling]',
					'title'     => __( 'Text Transform', 'smvmt-addon' ),
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

new SMVMT_Below_Header_Typo_Configs();


