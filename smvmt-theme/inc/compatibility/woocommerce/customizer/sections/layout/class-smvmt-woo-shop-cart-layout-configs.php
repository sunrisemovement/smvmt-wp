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

if ( ! class_exists( 'SMVMT_Woo_Shop_Cart_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Woo_Shop_Cart_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt-WooCommerce Shop Cart Layout Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Cart upsells
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[enable-cart-upsells]',
					'section'  => 'section-woo-shop-cart',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => smvmt_get_option( 'enable-cart-upsells' ),
					'title'    => __( 'Enable Upsells', 'smvmt' ),
					'priority' => 10,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new SMVMT_Woo_Shop_Cart_Layout_Configs();
