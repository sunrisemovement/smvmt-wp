<?php
/**
 * Sticky Header Options for our theme.
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

if ( ! class_exists( 'SMVMT_Sticky_Header_Configs' ) ) {

	/**
	 * Register Sticky Header Customizer Configurations.
	 */
	class SMVMT_Sticky_Header_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Sticky Header Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_config = array(

				/**
				 * Option: Sticky Header Above Divider
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[divider-section-sticky-above-header]',
					'type'            => 'control',
					'control'         => 'smvmt-heading',
					'section'         => 'section-sticky-header',
					'title'           => __( 'Above Header Colors', 'smvmt-addon' ),
					'settings'        => array(),
					'priority'        => 60,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),

				/**
				 * Option: Sticky Header Above Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-above-header-colors]',
					'default'         => smvmt_get_option( 'sticky-header-above-header-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Header', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 60,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),
				/**
				 * Option: Sticky Header Above Menu Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-above-menus-colors]',
					'default'         => smvmt_get_option( 'sticky-header-above-menus-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Menu', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 60,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),
				/**
				 * Option: Sticky Header Above Menu Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-above-submenus-colors]',
					'default'         => smvmt_get_option( 'sticky-header-above-submenus-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Submenu', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 65,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),
				/**
				 * Option: Sticky Header Above Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-above-outside-item-colors]',
					'default'         => smvmt_get_option( 'sticky-header-above-outside-item-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Content', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 75,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),

				/**
				* Option: Sticky Header Primary Divider
				*/
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-sticky-primary-header]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Primary Header Colors', 'smvmt-addon' ),
					'settings' => array(),
					'priority' => 80,
				),

				/**
				 * Option: Sticky Header primary Color Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sticky-header-primary-header-colors]',
					'default'   => smvmt_get_option( 'sticky-header-primary-header-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Header', 'smvmt-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 85,
				),
				/**
				 * Option: Sticky Header primary Color Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sticky-header-primary-menus-colors]',
					'default'   => smvmt_get_option( 'sticky-header-primary-menus-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Menu', 'smvmt-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 90,
				),

				/**
				 * Option: Sticky Header primary Color Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sticky-header-primary-submenu-colors]',
					'default'   => smvmt_get_option( 'sticky-header-primary-submenu-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Submenu', 'smvmt-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 95,
				),

				/**
				 * Option: Sticky Header primary Color Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sticky-header-primary-outside-item-colors]',
					'default'   => smvmt_get_option( 'sticky-header-primary-outside-item-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Outside Item', 'smvmt-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 105,
				),

				/**
				 * Option: Sticky Header Below Divider
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[divider-section-sticky-below-header]',
					'type'            => 'control',
					'control'         => 'smvmt-heading',
					'section'         => 'section-sticky-header',
					'title'           => __( 'Below Header Colors', 'smvmt-addon' ),
					'settings'        => array(),
					'priority'        => 110,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),

				/**
				 * Option: Sticky Header Below Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-below-header-colors]',
					'default'         => smvmt_get_option( 'sticky-header-below-header-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Header', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 115,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),
				/**
				 * Option: Sticky Header Below Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-below-menus-colors]',
					'default'         => smvmt_get_option( 'sticky-header-below-menus-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Menu', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 120,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),
				/**
				 * Option: Sticky Header Below Submenu Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-below-submenus-colors]',
					'default'         => smvmt_get_option( 'sticky-header-below-submenus-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Submenu', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 125,
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),

				/**
				 * Option: Sticky Header Header Content Color Group
				 */
				array(
					'name'            => SMVMT_THEME_SETTINGS . '[sticky-header-below-header-content-colors]',
					'default'         => smvmt_get_option( 'sticky-header-below-header-content-colors' ),
					'type'            => 'control',
					'control'         => 'smvmt-settings-group',
					'title'           => __( 'Content', 'smvmt-addon' ),
					'section'         => 'section-sticky-header',
					'transport'       => 'postMessage',
					'priority'        => 135,
					'required'        => array(
						'conditions' => array(
							array(
								SMVMT_THEME_SETTINGS . '[below-header-section-1]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
							array(
								SMVMT_THEME_SETTINGS . '[below-header-section-2]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
						),
						'operator'   => 'OR',
					),
					'active_callback' => 'SMVMT_Sticky_Header_Configs::is_header_section_active',
				),
				/**
				 * Option: Stick Primary Header
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[header-main-stick]',
					'default'  => smvmt_get_option( 'header-main-stick' ),
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Stick Primary Header', 'smvmt-addon' ),
					'priority' => 10,
					'control'  => 'checkbox',
				),
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[different-sticky-logo]',
					'default'  => smvmt_get_option( 'different-sticky-logo' ),
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Different Logo for Sticky Header?', 'smvmt-addon' ),
					'priority' => 15,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Sticky header logo selector
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[sticky-header-logo]',
					'default'        => smvmt_get_option( 'sticky-header-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'section-sticky-header',
					'priority'       => 15,
					'title'          => __( 'Sticky Logo', 'smvmt-addon' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					'required'       => array( SMVMT_THEME_SETTINGS . '[different-sticky-logo]', '==', 1 ),
				),

				/**
				 * Option: Different retina logo
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[different-sticky-retina-logo]',
					'default'  => false,
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Different Logo for retina devices?', 'smvmt-addon' ),
					'priority' => 20,
					'control'  => 'checkbox',
					'required' => array( SMVMT_THEME_SETTINGS . '[different-sticky-logo]', '==', 1 ),
				),

				/**
				 * Option: Sticky header logo selector
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[sticky-header-retina-logo]',
					'default'        => smvmt_get_option( 'sticky-header-retina-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'section-sticky-header',
					'priority'       => 20,
					'title'          => __( 'Sticky Retina Logo', 'smvmt-addon' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					'required'       => array( SMVMT_THEME_SETTINGS . '[different-sticky-retina-logo]', '==', 1 ),
				),

				/**
				 * Option: Sticky header logo width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[sticky-header-logo-width]',
					'default'     => smvmt_get_option( 'sticky-header-logo-width' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'smvmt-responsive-slider',
					'section'     => 'section-sticky-header',
					'priority'    => 25,
					'title'       => __( 'Sticky Logo Width', 'smvmt-addon' ),
					'input_attrs' => array(
						'min'  => 50,
						'step' => 1,
						'max'  => 600,
					),
					'required'    => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[different-sticky-logo]', '==', 1 ),
							array( SMVMT_THEME_SETTINGS . '[different-sticky-retina-logo]', '==', 1 ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Shrink Primary Header
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[header-main-shrink]',
					'default'     => smvmt_get_option( 'header-main-shrink' ),
					'type'        => 'control',
					'section'     => 'section-sticky-header',
					'title'       => __( 'Enable Shrink Effect', 'smvmt-addon' ),
					'priority'    => 35,
					'control'     => 'checkbox',
					'description' => __( 'It will shrink the sticky header height, logo, and menu size. Sticky header will display in a compact size.', 'smvmt-addon' ),
				),

				/**
				 * Option: Hide on scroll
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[sticky-hide-on-scroll]',
					'default'  => smvmt_get_option( 'sticky-hide-on-scroll' ),
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Hide When Scrolling Down', 'smvmt-addon' ),
					'priority' => 35,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Enable disable mobile header
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[sticky-header-style]',
					'default'  => smvmt_get_option( 'sticky-header-style' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sticky-header',
					'priority' => 40,
					'title'    => __( 'Select Animation', 'smvmt-addon' ),
					'choices'  => array(
						'none'  => __( 'None', 'smvmt-addon' ),
						'slide' => __( 'Slide', 'smvmt-addon' ),
						'fade'  => __( 'Fade', 'smvmt-addon' ),
					),
					'required' => array( SMVMT_THEME_SETTINGS . '[sticky-hide-on-scroll]', '!=', 1 ),
				),

				/**
				 * Option: Sticky Header Display On
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[sticky-header-on-devices]',
					'default'  => smvmt_get_option( 'sticky-header-on-devices' ),
					'type'     => 'control',
					'section'  => 'section-sticky-header',
					'priority' => 50,
					'title'    => __( 'Enable On', 'smvmt-addon' ),
					'control'  => 'select',
					'choices'  => array(
						'desktop' => __( 'Desktop', 'smvmt-addon' ),
						'mobile'  => __( 'Mobile', 'smvmt-addon' ),
						'both'    => __( 'Desktop + Mobile', 'smvmt-addon' ),
					),
				),

				/**
				 * Option: Sticky Header Button Colors Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[sticky-header-button-color-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-sticky-header',
					'title'    => __( 'Header Button', 'smvmt-addon' ),
					'settings' => array(),
					'priority' => 55,
					'required' => array(
						array( SMVMT_THEME_SETTINGS . '[header-main-rt-section]', '==', 'button' ),
						array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					),
				),
				/**
				 * Group: Theme Button Colors Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sticky-header-button-color-group]',
					'default'   => smvmt_get_option( 'sticky-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Colors', 'smvmt-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 55,
					'required'  => array(
						array( SMVMT_THEME_SETTINGS . '[header-main-rt-section]', '==', 'button' ),
						array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					),
				),
				/**
				 * Group: Theme Button Border Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sticky-header-button-border-group]',
					'default'   => smvmt_get_option( 'sticky-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Border', 'smvmt-addon' ),
					'section'   => 'section-sticky-header',
					'transport' => 'postMessage',
					'priority'  => 55,
					'required'  => array(
						array( SMVMT_THEME_SETTINGS . '[header-main-rt-section]', '==', 'button' ),
						array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					),
				),

				/**
				* Option: Button Text Color
				*/
				array(
					'name'      => 'header-main-rt-sticky-section-button-text-color',
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'header-main-rt-sticky-section-button-text-color' ),
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[sticky-header-button-color-group]',
					'section'   => 'section-sticky-header',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'smvmt-addon' ),
				),

				/**
				* Option: Button Text Hover Color
				*/
				array(
					'name'      => 'header-main-rt-sticky-section-button-text-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-sticky-section-button-text-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[sticky-header-button-color-group]',
					'section'   => 'section-sticky-header',
					'tab'       => __( 'Hover', 'smvmt-addon' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'smvmt-addon' ),
				),

				/**
				* Option: Button Background Color
				*/
				array(
					'name'      => 'header-main-rt-sticky-section-button-back-color',
					'default'   => smvmt_get_option( 'header-main-rt-sticky-section-button-back-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[sticky-header-button-color-group]',
					'section'   => 'section-sticky-header',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'smvmt-addon' ),
				),

				/**
				* Option: Button Button Hover Color
				*/
				array(
					'name'      => 'header-main-rt-sticky-section-button-back-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-sticky-section-button-back-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[sticky-header-button-color-group]',
					'section'   => 'section-sticky-header',
					'tab'       => __( 'Hover', 'smvmt-addon' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'smvmt-addon' ),
				),
				// Option: Custom Menu Button Border.
				array(
					'type'           => 'control',
					'control'        => 'smvmt-responsive-spacing',
					'name'           => SMVMT_THEME_SETTINGS . '[header-main-rt-sticky-section-button-padding]',
					'section'        => 'section-sticky-header',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 55,
					'required'       => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'default'        => smvmt_get_option( 'header-main-rt-sticky-section-button-padding' ),
					'title'          => __( 'Padding', 'smvmt-addon' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt-addon' ),
						'right'  => __( 'Right', 'smvmt-addon' ),
						'bottom' => __( 'Bottom', 'smvmt-addon' ),
						'left'   => __( 'Left', 'smvmt-addon' ),
					),
				),

				/**
				* Option: Button Border Size
				*/
				array(
					'type'           => 'sub-control',
					'parent'         => SMVMT_THEME_SETTINGS . '[sticky-header-button-border-group]',
					'section'        => 'section-sticky-header',
					'control'        => 'smvmt-border',
					'name'           => 'header-main-rt-sticky-section-button-border-size',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 10,
					'default'        => smvmt_get_option( 'header-main-rt-sticky-section-button-border-size' ),
					'title'          => __( 'Width', 'smvmt-addon' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt-addon' ),
						'right'  => __( 'Right', 'smvmt-addon' ),
						'bottom' => __( 'Bottom', 'smvmt-addon' ),
						'left'   => __( 'Left', 'smvmt-addon' ),
					),
				),

				/**
				* Option: Button Border Color
				*/
				array(
					'name'      => 'header-main-rt-sticky-section-button-border-color',
					'default'   => smvmt_get_option( 'header-main-rt-sticky-section-button-border-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[sticky-header-button-border-group]',
					'section'   => 'section-sticky-header',
					'control'   => 'smvmt-color',
					'priority'  => 12,
					'title'     => __( 'Color', 'smvmt-addon' ),
				),

				/**
				* Option: Button Border Hover Color
				*/
				array(
					'name'      => 'header-main-rt-sticky-section-button-border-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-sticky-section-button-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[sticky-header-button-border-group]',
					'section'   => 'section-sticky-header',
					'control'   => 'smvmt-color',
					'priority'  => 14,
					'title'     => __( 'Hover Color', 'smvmt-addon' ),
				),

				/**
				* Option: Button Border Radius
				*/
				array(
					'name'        => 'header-main-rt-sticky-section-button-border-radius',
					'default'     => smvmt_get_option( 'header-main-rt-sticky-section-button-border-radius' ),
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[sticky-header-button-border-group]',
					'section'     => 'section-sticky-header',
					'control'     => 'smvmt-slider',
					'transport'   => 'postMessage',
					'priority'    => 16,
					'title'       => __( 'Border Radius', 'smvmt-addon' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
				),

			);

			return array_merge( $configurations, $_config );
		}

		/**
		 * Is Header Section addon active.
		 * Decide if the Above & Below option should be visible in Sticky Header depending on Header Section addon.
		 *
		 * @return boolean  True - If the option should be displayed, False - If the option should be hidden.
		 */
		public static function is_header_section_active() {
			return true;
		}

	}
}

new SMVMT_Sticky_Header_Configs();



