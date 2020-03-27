<?php
/**
 * Below Header - Colors Options for our theme.
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

if ( ! class_exists( 'SMVMT_Below_Header_Colors_Bg_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	class SMVMT_Below_Header_Colors_Bg_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Header Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = SMVMT_Theme_Options::defaults();

			$_configs = array(

				/**
				 * Option: Background
				 */
				array(
					'name'      => 'below-header-bg-obj-responsive',
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-background-group]',
					'section'   => 'section-below-header',
					'type'      => 'sub-control',
					'control'   => 'smvmt-responsive-background',
					'transport' => 'postMessage',
					'required'  => array( SMVMT_THEME_SETTINGS . '[below-header-layout]', '!=', 'disabled' ),
					'default'   => $defaults['below-header-bg-obj-responsive'],
					'label'     => __( 'Background', 'smvmt-addon' ),
				),

				/**
				 * Option: Menu Color
				 */
				array(
					'name'       => 'below-header-menu-text-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 6,
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-menus-group]',
					'control'    => 'smvmt-responsive-color',
					'transport'  => 'postMessage',
					'default'    => $defaults['below-header-menu-text-color-responsive'],
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Menu Background Color
				 */
				array(
					'name'      => 'below-header-menu-bg-obj-responsive',
					'type'      => 'sub-control',
					'section'   => 'section-below-header',
					'priority'  => 7,
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'parent'    => SMVMT_THEME_SETTINGS . '[below-header-menus-group]',
					'control'   => 'smvmt-responsive-background',
					'transport' => 'postMessage',
					'default'   => $defaults['below-header-menu-bg-obj-responsive'],
					'label'     => __( 'Background', 'smvmt-addon' ),
				),

				/**
				 * Option: Menu Hover Color
				 */

				array(
					'name'       => 'below-header-menu-text-hover-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 8,
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-menus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-menu-text-hover-color-responsive'],
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check SMVMT_Control_Color is exist in the theme.
				/**
				 * Option: Menu Hover Background Color
				 */
				array(
					'name'       => 'below-header-menu-bg-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 9,
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-menus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-menu-bg-hover-color-responsive'],
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Active Menu Color
				 */
				array(
					'name'       => 'below-header-current-menu-text-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Active', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-menus-group]',
					'control'    => 'smvmt-responsive-color',
					'transport'  => 'postMessage',
					'default'    => $defaults['below-header-current-menu-text-color-responsive'],
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check SMVMT_Control_Color is exist in the theme.
				/**
				 * Option: Active Menu Background Color
				 */
				array(
					'name'       => 'below-header-current-menu-bg-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 11,
					'tab'        => __( 'Active', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-menus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-current-menu-bg-color-responsive'],
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[below-header-color-bg-dropdown-menu-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'title'    => __( 'Below Header Submenu', 'smvmt-addon' ),
					'settings' => array(),
				),

				// Check SMVMT_Control_Color is exist in the theme.

				/**
				 * Option: Submenu Color
				 */
				array(
					'name'       => 'below-header-submenu-text-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 9,
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-submenus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-submenu-text-color-responsive'],
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Background Color
				 */
				array(
					'name'       => 'below-header-submenu-bg-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 9,
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-submenus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-submenu-bg-color-responsive'],
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Hover Color
				 */
				array(
					'name'       => 'below-header-submenu-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-submenus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-submenu-hover-color-responsive'],
					'transport'  => 'postMessage',
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check SMVMT_Control_Color is exist in the theme.
				/**
				 * Option: Menu Hover Background Color
				 */
				array(
					'name'       => 'below-header-submenu-bg-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-submenus-group]',
					'control'    => 'smvmt-responsive-color',
					'transport'  => 'postMessage',
					'default'    => $defaults['below-header-submenu-bg-hover-color-responsive'],
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Submenu Active Color
				 */

				array(
					'name'       => 'below-header-submenu-active-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Active', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-submenus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-submenu-active-color-responsive'],
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				// Check SMVMT_Control_Color is exist in the theme.
				/**
				 * Option: Submenu Active Background Color
				 */
				array(
					'name'       => 'below-header-submenu-active-bg-color-responsive',
					'transport'  => 'postMessage',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'priority'   => 10,
					'tab'        => __( 'Active', 'smvmt-addon' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-submenus-group]',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-submenu-active-bg-color-responsive'],
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Text Color
				 */
				array(
					'name'       => 'below-header-text-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-text-color-responsive'],
					'transport'  => 'postMessage',
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-content-group]',
					'title'      => __( 'Text Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Normal', 'smvmt-addon' ),
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'       => 'below-header-link-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-link-color-responsive'],
					'transport'  => 'postMessage',
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-content-group]',
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Normal', 'smvmt-addon' ),
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'       => 'below-header-link-hover-color-responsive',
					'type'       => 'sub-control',
					'section'    => 'section-below-header',
					'control'    => 'smvmt-responsive-color',
					'default'    => $defaults['below-header-link-hover-color-responsive'],
					'parent'     => SMVMT_THEME_SETTINGS . '[below-header-content-group]',
					'transport'  => 'postMessage',
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'tab'        => __( 'Hover', 'smvmt-addon' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new SMVMT_Below_Header_Colors_Bg_Configs();
