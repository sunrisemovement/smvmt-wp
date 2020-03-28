<?php
/**
 * Styling Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       1.4.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Footer_Colors_Configs' ) ) {

	/**
	 * Register Footer Color Configurations.
	 */
	class SMVMT_Footer_Colors_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Footer Color Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {
			$_configs = array(

				/**
				 * Option: Color
				 */
				array(
					'name'     => 'footer-color',
					'type'     => 'sub-control',
					'tab'      => __( 'Normal', 'smvmt' ),
					'priority' => 5,
					'parent'   => SMVMT_THEME_SETTINGS . '[footer-bar-content-group]',
					'section'  => 'section-footer-small',
					'control'  => 'smvmt-color',
					'title'    => __( 'Text Color', 'smvmt' ),
					'default'  => '',
				),

				/**
				 * Option: Link Color
				 */
				array(
					'name'     => 'footer-link-color',
					'type'     => 'sub-control',
					'tab'      => __( 'Normal', 'smvmt' ),
					'priority' => 6,
					'parent'   => SMVMT_THEME_SETTINGS . '[footer-bar-content-group]',
					'section'  => 'section-footer-small',
					'control'  => 'smvmt-color',
					'default'  => '',
					'title'    => __( 'Link Color', 'smvmt' ),
				),

				/**
				 * Option: Link Hover Color
				 */
				array(
					'name'     => 'footer-link-h-color',
					'type'     => 'sub-control',
					'tab'      => __( 'Hover', 'smvmt' ),
					'priority' => 5,
					'parent'   => SMVMT_THEME_SETTINGS . '[footer-bar-content-group]',
					'section'  => 'section-footer-small',
					'control'  => 'smvmt-color',
					'title'    => __( 'Link Color', 'smvmt' ),
					'default'  => '',
				),

				/**
				 * Option: Footer Background
				 */
				array(
					'name'     => 'footer-bg-obj',
					'type'     => 'sub-control',
					'priority' => 7,
					'parent'   => SMVMT_THEME_SETTINGS . '[footer-bar-background-group]',
					'section'  => 'section-footer-small',
					'control'  => 'smvmt-background',
					'default'  => smvmt_get_option( 'footer-bg-obj' ),
					'label'    => __( 'Background', 'smvmt' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new SMVMT_Footer_Colors_Configs();


