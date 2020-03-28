<?php
/**
 * Styling Options for Astra Theme.
 *
 * @package     Astra
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://smvmt.org/
 * @since       1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'SMVMT_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'SMVMT_Site_Layout_Configuration' ) ) {

	/**
	 * Register Site Layout Customizer Configurations.
	 */
	class SMVMT_Site_Layout_Configuration extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Site Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Site Layout
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[site-layout]',
					'default'  => smvmt_get_option( 'site-layout' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-container-layout',
					'priority' => 5,
					'title'    => __( 'Site Layout', 'smvmt-addon' ),
					'choices'  => array(
						'smvmt-full-width-layout'  => __( 'Full Width', 'smvmt-addon' ),
						'smvmt-box-layout'         => __( 'Max Width', 'smvmt-addon' ),
						'smvmt-padded-layout'      => __( 'Padded', 'smvmt-addon' ),
						'smvmt-fluid-width-layout' => __( 'Fluid', 'smvmt-addon' ),
					),
				),

				/**
				 * Option: Padded Layout Custom Width
				 */
				array(
					'name'              => SMVMT_THEME_SETTINGS . '[site-layout-padded-width]',
					'default'           => 1200,
					'type'              => 'control',
					'control'           => 'smvmt-slider',
					'transport'         => 'postMessage',
					'section'           => 'section-container-layout',
					'priority'          => 15,
					'title'             => __( 'Width', 'smvmt-addon' ),
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number_n_blank' ),
					'required'          => array( SMVMT_THEME_SETTINGS . '[site-layout]', '==', 'smvmt-padded-layout' ),
					'suffix'            => '',
					'input_attrs'       => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),

				/**
				 * Option: Box Width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[site-layout-box-width]',
					'default'     => 1200,
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'smvmt-slider',
					'section'     => 'section-container-layout',
					'priority'    => 25,
					'title'       => __( 'Max Width', 'smvmt-addon' ),
					'suffix'      => '',
					'required'    => array( SMVMT_THEME_SETTINGS . '[site-layout]', '==', 'smvmt-box-layout' ),
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),

				/**
				 * Option: Padded Layout Custom Width
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[site-layout-padded-pad]',
					'default'        => smvmt_get_option( 'site-layout-padded-pad' ),
					'type'           => 'control',
					'transport'      => 'postMessage',
					'control'        => 'smvmt-responsive-spacing',
					'section'        => 'section-container-layout',
					'priority'       => 20,
					'title'          => __( 'Space Outside Body', 'smvmt-addon' ),
					'required'       => array( SMVMT_THEME_SETTINGS . '[site-layout]', '==', 'smvmt-padded-layout' ),
					'linked_choices' => true,
					'unit_choices'   => array( 'px', 'em', '%' ),
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt-addon' ),
						'right'  => __( 'Right', 'smvmt-addon' ),
						'bottom' => __( 'Bottom', 'smvmt-addon' ),
						'left'   => __( 'Left', 'smvmt-addon' ),
					),
				),

				/**
				 * Option: Box Top & Bottom Margin
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[site-layout-box-tb-margin]',
					'default'     => 0,
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'smvmt-slider',
					'section'     => 'section-container-layout',
					'priority'    => 30,
					'title'       => __( 'Top & Bottom Margin', 'smvmt-addon' ),
					'required'    => array( SMVMT_THEME_SETTINGS . '[site-layout]', '==', 'smvmt-box-layout' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Layout: Fluid layout
				 */

				/**
				 * Option: Page Left & Right Padding
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[site-layout-fluid-lr-padding]',
					'default'     => 25,
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'smvmt-slider',
					'section'     => 'section-container-layout',
					'priority'    => 35,
					'title'       => __( 'Left & Right Padding', 'smvmt-addon' ),
					'required'    => array( SMVMT_THEME_SETTINGS . '[site-layout]', '==', 'smvmt-fluid-width-layout' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 200,
					),
				),

				/**
				 * Option: Body Background
				 *
				 * NOTE: We have added below field for backward compatibility.
				 * If plugin is updated before the theme update then this filed will be visible.
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[site-layout-outside-bg-obj]',
					'default'   => smvmt_get_option( 'site-layout-outside-bg-obj' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'control'   => 'smvmt-background',
					'section'   => 'section-colors-body',
					'priority'  => 25,
					'label'     => __( 'Background', 'smvmt-addon' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new SMVMT_Site_Layout_Configuration();


