<?php
/**
 * smvmt Theme Customizer Configuration Base.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.4.3
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'SMVMT_Customizer_Button_Configs' ) ) {

	/**
	 * Register Button Customizer Configurations.
	 */
	class SMVMT_Customizer_Button_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Button Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[button-color-styling-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-buttons',
					'title'    => __( 'Colors and Border', 'smvmt' ),
					'priority' => 17,
					'settings' => array(),
				),
				/**
				 * Group: Theme Button Colors Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[theme-button-color-group]',
					'default'   => smvmt_get_option( 'theme-button-color-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Color', 'smvmt' ),
					'section'   => 'section-buttons',
					'transport' => 'postMessage',
					'priority'  => 18,
				),

				/**
				 * Group: Theme Button Border Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[theme-button-border-group]',
					'default'   => smvmt_get_option( 'theme-button-border-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Border', 'smvmt' ),
					'section'   => 'section-buttons',
					'transport' => 'postMessage',
					'priority'  => 19,
				),

				/**
				 * Option: Button Color
				 */
				array(
					'name'    => 'button-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Normal', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Text Color', 'smvmt' ),
				),

				/**
				 * Option: Button Hover Color
				 */
				array(
					'name'    => 'button-h-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Hover', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Text Color', 'smvmt' ),
				),

				/**
				 * Option: Button Background Color
				 */
				array(
					'name'    => 'button-bg-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Normal', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Background Color', 'smvmt' ),
				),

				/**
				 * Option: Button Background Hover Color
				 */
				array(
					'name'    => 'button-bg-h-color',
					'default' => '',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[theme-button-color-group]',
					'section' => 'section-buttons',
					'tab'     => __( 'Hover', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Background Color', 'smvmt' ),
				),

				/**
				 * Option: Global Button Border Size
				 */
				array(
					'type'           => 'sub-control',
					'parent'         => SMVMT_THEME_SETTINGS . '[theme-button-border-group]',
					'section'        => 'section-buttons',
					'control'        => 'smvmt-border',
					'name'           => 'theme-button-border-group-border-size',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 10,
					'default'        => smvmt_get_option( 'theme-button-border-group-border-size' ),
					'title'          => __( 'Width', 'smvmt' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt' ),
						'right'  => __( 'Right', 'smvmt' ),
						'bottom' => __( 'Bottom', 'smvmt' ),
						'left'   => __( 'Left', 'smvmt' ),
					),
				),

				/**
				 * Option: Global Button Border Color
				 */
				array(
					'name'      => 'theme-button-border-group-border-color',
					'default'   => smvmt_get_option( 'theme-button-border-group-border-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[theme-button-border-group]',
					'section'   => 'section-buttons',
					'control'   => 'smvmt-color',
					'priority'  => 12,
					'title'     => __( 'Color', 'smvmt' ),
				),

				/**
				 * Option: Global Button Border Hover Color
				 */
				array(
					'name'      => 'theme-button-border-group-border-h-color',
					'default'   => smvmt_get_option( 'theme-button-border-group-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[theme-button-border-group]',
					'section'   => 'section-buttons',
					'control'   => 'smvmt-color',
					'priority'  => 14,
					'title'     => __( 'Hover Color', 'smvmt' ),
				),

				/**
				 * Option: Global Button Radius
				 */
				array(
					'name'        => 'button-radius',
					'default'     => smvmt_get_option( 'button-radius' ),
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[theme-button-border-group]',
					'section'     => 'section-buttons',
					'control'     => 'smvmt-slider',
					'title'       => __( 'Border Radius', 'smvmt' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Button Padding Section
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[button-padding-styling-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-buttons',
					'title'    => __( 'Spacing', 'smvmt' ),
					'priority' => 30,
					'settings' => array(),
				),

				/**
				 * Option: Theme Button Padding
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[theme-button-padding]',
					'default'        => smvmt_get_option( 'theme-button-padding' ),
					'type'           => 'control',
					'control'        => 'smvmt-responsive-spacing',
					'section'        => 'section-buttons',
					'title'          => __( 'Padding', 'smvmt' ),
					'linked_choices' => true,
					'transport'      => 'postMessage',
					'unit_choices'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt' ),
						'right'  => __( 'Right', 'smvmt' ),
						'bottom' => __( 'Bottom', 'smvmt' ),
						'left'   => __( 'Left', 'smvmt' ),
					),
					'priority'       => 35,
				),

				/**
				 * Option: Primary Header Button Colors Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[primary-header-button-color-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-primary-menu',
					'title'    => __( 'Header Button', 'smvmt' ),
					'settings' => array(),
					'priority' => 17,
					'required' => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Primary Header Button Colors Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[primary-header-button-color-group]',
					'default'   => smvmt_get_option( 'primary-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Colors', 'smvmt' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 18,
					'required'  => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Primary Header Button Border Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[primary-header-button-border-group]',
					'default'   => smvmt_get_option( 'primary-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Border', 'smvmt' ),
					'section'   => 'section-primary-menu',
					'transport' => 'postMessage',
					'priority'  => 19,
					'required'  => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),

				/**
				* Option: Button Text Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-text-color',
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'header-main-rt-section-button-text-color' ),
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Normal', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'smvmt' ),
				),

				/**
				* Option: Button Text Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-text-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-section-button-text-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Hover', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'smvmt' ),
				),

				/**
				* Option: Button Background Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-back-color',
					'default'   => smvmt_get_option( 'header-main-rt-section-button-back-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Normal', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'smvmt' ),
				),

				/**
				* Option: Button Button Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-back-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-section-button-back-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[primary-header-button-color-group]',
					'section'   => 'section-primary-menu',
					'tab'       => __( 'Hover', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'smvmt' ),
				),

				// Option: Custom Menu Button Border.
				array(
					'type'           => 'control',
					'control'        => 'smvmt-responsive-spacing',
					'name'           => SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-padding]',
					'section'        => 'section-primary-menu',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 20,
					'required'       => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'default'        => smvmt_get_option( 'header-main-rt-section-button-padding' ),
					'title'          => __( 'Padding', 'smvmt' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt' ),
						'right'  => __( 'Right', 'smvmt' ),
						'bottom' => __( 'Bottom', 'smvmt' ),
						'left'   => __( 'Left', 'smvmt' ),
					),
				),

				/**
				* Option: Button Border Size
				*/
				array(
					'type'           => 'sub-control',
					'parent'         => SMVMT_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'        => 'section-primary-menu',
					'control'        => 'smvmt-border',
					'name'           => 'header-main-rt-section-button-border-size',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 10,
					'default'        => smvmt_get_option( 'header-main-rt-section-button-border-size' ),
					'title'          => __( 'Width', 'smvmt' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt' ),
						'right'  => __( 'Right', 'smvmt' ),
						'bottom' => __( 'Bottom', 'smvmt' ),
						'left'   => __( 'Left', 'smvmt' ),
					),
				),

				/**
				* Option: Button Border Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-border-color',
					'default'   => smvmt_get_option( 'header-main-rt-section-button-border-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'   => 'section-primary-menu',
					'control'   => 'smvmt-color',
					'priority'  => 12,
					'title'     => __( 'Color', 'smvmt' ),
				),

				/**
				* Option: Button Border Hover Color
				*/
				array(
					'name'      => 'header-main-rt-section-button-border-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-section-button-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'   => 'section-primary-menu',
					'control'   => 'smvmt-color',
					'priority'  => 14,
					'title'     => __( 'Hover Color', 'smvmt' ),
				),

				/**
				* Option: Button Border Radius
				*/
				array(
					'name'        => 'header-main-rt-section-button-border-radius',
					'default'     => smvmt_get_option( 'header-main-rt-section-button-border-radius' ),
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[primary-header-button-border-group]',
					'section'     => 'section-primary-menu',
					'control'     => 'smvmt-slider',
					'transport'   => 'postMessage',
					'priority'    => 16,
					'title'       => __( 'Border Radius', 'smvmt' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Transparent Header Button Colors Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[transparent-header-button-color-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Header Button', 'smvmt' ),
					'settings' => array(),
					'priority' => 40,
					'required' => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Transparent Header Button Colors Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'default'   => smvmt_get_option( 'transparent-header-button-color-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Colors', 'smvmt' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 40,
					'required'  => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),
				/**
				 * Group: Transparent Header Button Border Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'default'   => smvmt_get_option( 'transparent-header-button-border-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Border', 'smvmt' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 40,
					'required'  => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
				),

				/**
				* Option: Button Text Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-text-color',
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'header-main-rt-trans-section-button-text-color' ),
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Normal', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'smvmt' ),
				),

				/**
				* Option: Button Text Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-text-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-trans-section-button-text-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Hover', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Text Color', 'smvmt' ),
				),

				/**
				* Option: Button Background Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-back-color',
					'default'   => smvmt_get_option( 'header-main-rt-trans-section-button-back-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Normal', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'smvmt' ),
				),

				/**
				* Option: Button Button Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-back-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-trans-section-button-back-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[transparent-header-button-color-group]',
					'section'   => 'section-transparent-header',
					'tab'       => __( 'Hover', 'smvmt' ),
					'control'   => 'smvmt-color',
					'priority'  => 10,
					'title'     => __( 'Background Color', 'smvmt' ),
				),

				// Option: Custom Menu Button Border.
				array(
					'type'           => 'control',
					'control'        => 'smvmt-responsive-spacing',
					'name'           => SMVMT_THEME_SETTINGS . '[header-main-rt-trans-section-button-padding]',
					'section'        => 'section-transparent-header',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 40,
					'required'       => array( SMVMT_THEME_SETTINGS . '[header-main-rt-section-button-style]', '===', 'custom-button' ),
					'default'        => smvmt_get_option( 'header-main-rt-trans-section-button-padding' ),
					'title'          => __( 'Padding', 'smvmt' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt' ),
						'right'  => __( 'Right', 'smvmt' ),
						'bottom' => __( 'Bottom', 'smvmt' ),
						'left'   => __( 'Left', 'smvmt' ),
					),
				),

				/**
				* Option: Button Border Size
				*/
				array(
					'type'           => 'sub-control',
					'parent'         => SMVMT_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'section'        => 'section-transparent-header',
					'control'        => 'smvmt-border',
					'name'           => 'header-main-rt-trans-section-button-border-size',
					'transport'      => 'postMessage',
					'linked_choices' => true,
					'priority'       => 10,
					'default'        => smvmt_get_option( 'header-main-rt-trans-section-button-border-size' ),
					'title'          => __( 'Width', 'smvmt' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt' ),
						'right'  => __( 'Right', 'smvmt' ),
						'bottom' => __( 'Bottom', 'smvmt' ),
						'left'   => __( 'Left', 'smvmt' ),
					),
				),

				/**
				* Option: Button Border Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-border-color',
					'default'   => smvmt_get_option( 'header-main-rt-trans-section-button-border-color' ),
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'control'   => 'smvmt-color',
					'priority'  => 12,
					'title'     => __( 'Color', 'smvmt' ),
				),

				/**
				* Option: Button Border Hover Color
				*/
				array(
					'name'      => 'header-main-rt-trans-section-button-border-h-color',
					'default'   => smvmt_get_option( 'header-main-rt-trans-section-button-border-h-color' ),
					'transport' => 'postMessage',
					'type'      => 'sub-control',
					'parent'    => SMVMT_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'control'   => 'smvmt-color',
					'priority'  => 14,
					'title'     => __( 'Hover Color', 'smvmt' ),
				),

				/**
				* Option: Button Border Radius
				*/
				array(
					'name'        => 'header-main-rt-trans-section-button-border-radius',
					'default'     => smvmt_get_option( 'header-main-rt-trans-section-button-border-radius' ),
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[transparent-header-button-border-group]',
					'section'     => 'section-transparent-header',
					'control'     => 'smvmt-slider',
					'transport'   => 'postMessage',
					'priority'    => 16,
					'title'       => __( 'Border Radius', 'smvmt' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 100,
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
new SMVMT_Customizer_Button_Configs();
