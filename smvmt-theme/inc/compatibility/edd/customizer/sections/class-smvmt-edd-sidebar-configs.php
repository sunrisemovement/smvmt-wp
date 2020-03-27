<?php
/**
 * Easy Digital Downloads Sidebar Options for our theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 1.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Edd_Sidebar_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Edd_Sidebar_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt Easy Digital Downloads Sidebar Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-product-sidebar-layout-divider]',
					'section'  => 'section-sidebars',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Shop Page
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => smvmt_get_option( 'edd-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'Easy Digital Downloads', 'smvmt' ),
					'choices'  => array(
						'default'       => __( 'Default', 'smvmt' ),
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),

				/**
				 * Option: Single Product
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-single-product-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'edd-single-product-sidebar-layout' ),
					'section'  => 'section-sidebars',
					'priority' => 5,
					'title'    => __( 'EDD Single Product', 'smvmt' ),
					'choices'  => array(
						'default'       => __( 'Default', 'smvmt' ),
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new SMVMT_Edd_Sidebar_Configs();



