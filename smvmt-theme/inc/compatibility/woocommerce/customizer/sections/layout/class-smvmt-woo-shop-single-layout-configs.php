<?php
/**
 * WooCommerce Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Woo_Shop_Single_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Woo_Shop_Single_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt-WooCommerce Shop Single Layout Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				* Option: Disable Breadcrumb
				*/
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[single-product-breadcrumb-disable]',
					'section'  => 'section-woo-shop-single',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => smvmt_get_option( 'single-product-breadcrumb-disable' ),
					'title'    => __( 'Disable Breadcrumb', 'smvmt' ),
					'priority' => 16,
				),

				/**
				 * Option: Disable Transparent Header on WooCommerce Product pages
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[transparent-header-disable-woo-products]',
					'default'  => smvmt_get_option( 'transparent-header-disable-woo-products' ),
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Disable on WooCommerce Product Pages?', 'smvmt' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[transparent-header-enable]', '==', '1' ),
					'priority' => 26,
					'control'  => 'checkbox',
				),
			);

			return array_merge( $configurations, $_configs );

		}
	}
}

new SMVMT_Woo_Shop_Single_Layout_Configs();


