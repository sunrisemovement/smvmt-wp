<?php
/**
 * Easy Digital Downloads Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Edd_Single_Product_Layout_Configs' ) ) {


	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Edd_Single_Product_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt-Easy Digital Downloads Shop Cart Layout Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Cart upsells
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[disable-edd-single-product-nav]',
					'section'  => 'section-edd-single',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => smvmt_get_option( 'disable-edd-single-product-nav' ),
					'title'    => __( 'Disable Product Navigation', 'smvmt' ),
					'priority' => 10,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

new SMVMT_Edd_Single_Product_Layout_Configs();
