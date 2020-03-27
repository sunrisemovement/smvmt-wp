<?php
/**
 * Sticky Header - Above Header Colors Options for our theme.
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

if ( ! class_exists( 'SMVMT_Sticky_Above_Header_Colors_Bg_Configs' ) ) {

	/**
	 * Register Sticky Header Above Header ColorsCustomizer Configurations.
	 */
	class SMVMT_Sticky_Above_Header_Colors_Bg_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Sticky Header Colors Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = SMVMT_Theme_Options::defaults();
			$_config  = array(

				array(
					'name'       => 'sticky-above-header-bg-color-responsive',
					'default'    => $defaults['sticky-above-header-bg-color-responsive'],
					'type'       => 'sub-control',
					'priority'   => 6,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-header-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'required'   => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
				),

				/**
				 * Option: Primary Menu Color
				 */
				array(
					'name'       => 'sticky-above-header-menu-color-responsive',
					'default'    => $defaults['sticky-above-header-menu-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'priority'   => 6,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link / Text Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),
				/**
				 * Option: Menu Background Color
				 */
				array(
					'name'       => 'sticky-above-header-menu-bg-color-responsive',
					'default'    => $defaults['sticky-above-header-menu-bg-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'priority'   => 7,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Menu Hover Color
				 */
				array(
					'name'       => 'sticky-above-header-menu-h-color-responsive',
					'default'    => $defaults['sticky-above-header-menu-h-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'priority'   => 6,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Active / Hover Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),
				/**
				 * Option: Menu Link / Hover Background Color
				 */
				array(
					'name'       => 'sticky-above-header-menu-h-a-bg-color-responsive',
					'default'    => $defaults['sticky-above-header-menu-h-a-bg-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'priority'   => 7,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Active / Hover Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Primary Menu Color
				 */
				array(
					'name'       => 'sticky-above-header-submenu-color-responsive',
					'default'    => $defaults['sticky-above-header-submenu-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'priority'   => 9,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link / Text Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),
				/**
				 * Option: SubMenu Background Color
				 */
				array(
					'name'       => 'sticky-above-header-submenu-bg-color-responsive',
					'default'    => $defaults['sticky-above-header-submenu-bg-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'priority'   => 10,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Menu Hover Color
				 */
				array(
					'name'       => 'sticky-above-header-submenu-h-color-responsive',
					'default'    => $defaults['sticky-above-header-submenu-h-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'priority'   => 9,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Active / Hover Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: SubMenu Link / Hover Background Color
				 */
				array(
					'name'       => 'sticky-above-header-submenu-h-a-bg-color-responsive',
					'default'    => $defaults['sticky-above-header-submenu-h-a-bg-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'priority'   => 10,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Active / Hover Background Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				* Option: Content Section Text color.
				*/
				array(
					'name'       => 'sticky-above-header-content-section-text-color-responsive',
					'default'    => $defaults['sticky-above-header-content-section-text-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'priority'   => 18,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-outside-item-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Text Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-1]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-2]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
						),
						'operator'   => 'OR',
					),
				),
				/**
				 * Option: Content Section Link color.
				 */
				array(
					'name'       => 'sticky-above-header-content-section-link-color-responsive',
					'default'    => $defaults['sticky-above-header-content-section-link-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Normal', 'smvmt-addon' ),
					'priority'   => 19,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-outside-item-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-1]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-2]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Content Section Link Hover color.
				 */
				array(
					'name'       => 'sticky-above-header-content-section-link-h-color-responsive',
					'default'    => $defaults['sticky-above-header-content-section-link-h-color-responsive'],
					'type'       => 'sub-control',
					'tab'        => __( 'Hover', 'smvmt-addon' ),
					'priority'   => 20,
					'parent'     => SMVMT_THEME_SETTINGS . '[sticky-header-above-outside-item-colors]',
					'section'    => 'section-sticky-header',
					'transport'  => 'postMessage',
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Color', 'smvmt-addon' ),
					'responsive' => true,
					'rgba'       => true,
					'required'   => array(
						'conditions' => array(
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-1]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-2]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
						),
						'operator'   => 'OR',
					),
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new SMVMT_Sticky_Above_Header_Colors_Bg_Configs();



