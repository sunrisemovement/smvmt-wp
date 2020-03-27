<?php
/**
 * Styling Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Adv_Footer_Colors_Configs' ) ) {

	/**
	 * Register Advanced Footer Color Customizer Configurations.
	 */
	class SMVMT_Advanced_Footer_Colors_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Advanced Footer Color Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$_configs = array(

				/**
				 * Option: Footer Widget Color & Background Section heading
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[footer-widget-color-background-heading-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-footer-adv',
					'title'    => __( 'Colors & Background', 'smvmt' ),
					'priority' => 46,
					'settings' => array(),
					'required' => array( SMVMT_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
				),

				/**
				 * Option: Footer Bar Content Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-widget-background-group]',
					'default'   => smvmt_get_option( 'footer-widget-background-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Background', 'smvmt' ),
					'section'   => 'section-footer-adv',
					'transport' => 'postMessage',
					'priority'  => 46,
					'required'  => array( SMVMT_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
				),

				/**
				 * Option: Footer Bar Content Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-widget-content-group]',
					'default'   => smvmt_get_option( 'footer-widget-content-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt' ),
					'section'   => 'section-footer-adv',
					'transport' => 'postMessage',
					'priority'  => 46,
					'required'  => array( SMVMT_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
				),

				/**
				 * Option: Widget Title Color
				 */
				array(
					'name'    => 'footer-adv-wgt-title-color',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Normal', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Title Color', 'smvmt' ),
					'default' => '',
				),

				/**
				 * Option: Text Color
				 */
				array(
					'name'    => 'footer-adv-text-color',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Normal', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Text Color', 'smvmt' ),
					'default' => '',
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'    => 'footer-adv-link-color',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Normal', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Link Color', 'smvmt' ),
					'default' => '',
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'    => 'footer-adv-link-h-color',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[footer-widget-content-group]',
					'section' => 'section-footer-adv',
					'tab'     => __( 'Hover', 'smvmt' ),
					'control' => 'smvmt-color',
					'title'   => __( 'Link Color', 'smvmt' ),
					'default' => '',
				),

				/**
				 * Option: Footer widget Background
				 */
				array(
					'name'    => 'footer-adv-bg-obj',
					'type'    => 'sub-control',
					'parent'  => SMVMT_THEME_SETTINGS . '[footer-widget-background-group]',
					'section' => 'section-footer-adv',
					'control' => 'smvmt-background',
					'default' => smvmt_get_option( 'footer-adv-bg-obj' ),
					'label'   => __( 'Background', 'smvmt' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new SMVMT_Advanced_Footer_Colors_Configs();


