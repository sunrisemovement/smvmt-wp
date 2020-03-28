<?php
/**
 * WooCommerce Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Woo_Shop_Layout_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Woo_Shop_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt-WooCommerce Shop Layout Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Shop Columns
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[shop-grids]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive-slider',
					'section'     => 'woocommerce_product_catalog',
					'default'     => array(
						'desktop' => 4,
						'tablet'  => 3,
						'mobile'  => 2,
					),
					'priority'    => 11,
					'title'       => __( 'Shop Columns', 'smvmt' ),
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),

				/**
				 * Option: Products Per Page
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[shop-no-of-products]',
					'type'        => 'control',
					'section'     => 'woocommerce_product_catalog',
					'title'       => __( 'Products Per Page', 'smvmt' ),
					'default'     => smvmt_get_option( 'shop-no-of-products' ),
					'control'     => 'number',
					'priority'    => 15,
					'input_attrs' => array(
						'min'  => 1,
						'step' => 1,
						'max'  => 100,
					),
				),

				/**
				 * Option: Single Post Meta
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[shop-product-structure]',
					'type'     => 'control',
					'control'  => 'smvmt-sortable',
					'section'  => 'woocommerce_product_catalog',
					'default'  => smvmt_get_option( 'shop-product-structure' ),
					'priority' => 15,
					'title'    => __( 'Shop Product Structure', 'smvmt' ),
					'choices'  => array(
						'title'      => __( 'Title', 'smvmt' ),
						'price'      => __( 'Price', 'smvmt' ),
						'ratings'    => __( 'Ratings', 'smvmt' ),
						'short_desc' => __( 'Short Description', 'smvmt' ),
						'add_cart'   => __( 'Add To Cart', 'smvmt' ),
						'category'   => __( 'Category', 'smvmt' ),
					),
				),

				/**
				 * Option: Shop Archive Content Width
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[shop-archive-width]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'woocommerce_product_catalog',
					'default'  => smvmt_get_option( 'shop-archive-width' ),
					'priority' => 10,
					'title'    => __( 'Shop Archive Content Width', 'smvmt' ),
					'choices'  => array(
						'default' => __( 'Default', 'smvmt' ),
						'custom'  => __( 'Custom', 'smvmt' ),
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[shop-archive-max-width]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'section'     => 'woocommerce_product_catalog',
					'default'     => 1200,
					'priority'    => 10,
					'required'    => array( SMVMT_THEME_SETTINGS . '[shop-archive-width]', '===', 'custom' ),
					'title'       => __( 'Custom Width', 'smvmt' ),
					'transport'   => 'postMessage',
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}

new SMVMT_Woo_Shop_Layout_Configs();

