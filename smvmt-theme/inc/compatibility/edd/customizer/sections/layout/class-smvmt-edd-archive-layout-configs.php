<?php
/**
 * Easy Digital Downloads Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Edd_Archive_Layout_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Edd_Archive_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt-Easy Digital Downloads Shop Layout Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.5.5
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Shop Columns
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[edd-archive-grids]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive-slider',
					'section'     => 'section-edd-archive',
					'default'     => array(
						'desktop' => 4,
						'tablet'  => 3,
						'mobile'  => 2,
					),
					'priority'    => 10,
					'title'       => __( 'Archive Columns', 'smvmt' ),
					'input_attrs' => array(
						'step' => 1,
						'min'  => 1,
						'max'  => 6,
					),
				),

				/**
				 * Option: EDD Archive Post Meta
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-archive-product-structure]',
					'type'     => 'control',
					'control'  => 'smvmt-sortable',
					'section'  => 'section-edd-archive',
					'default'  => smvmt_get_option( 'edd-archive-product-structure' ),
					'priority' => 30,
					'title'    => __( 'Product Structure', 'smvmt' ),
					'choices'  => array(
						'image'      => __( 'Image', 'smvmt' ),
						'category'   => __( 'Category', 'smvmt' ),
						'title'      => __( 'Title', 'smvmt' ),
						'price'      => __( 'Price', 'smvmt' ),
						'short_desc' => __( 'Short Description', 'smvmt' ),
						'add_cart'   => __( 'Add To Cart', 'smvmt' ),
					),
				),

				/**
				 * Option: Add to Cart button text
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-archive-add-to-cart-button-text]',
					'type'     => 'control',
					'control'  => 'text',
					'section'  => 'section-edd-archive',
					'default'  => smvmt_get_option( 'edd-archive-add-to-cart-button-text' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[edd-archive-product-structure]', 'contains', 'add_cart' ),
					'priority' => 31,
					'title'    => __( 'Cart Button Text', 'smvmt' ),
				),

				/**
				 * Option: Variable product button
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-archive-variable-button]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-edd-archive',
					'default'  => smvmt_get_option( 'edd-archive-variable-button' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[edd-archive-product-structure]', 'contains', 'add_cart' ),
					'priority' => 31,
					'title'    => __( 'Variable Product Button', 'smvmt' ),
					'choices'  => array(
						'button'  => __( 'Button', 'smvmt' ),
						'options' => __( 'Options', 'smvmt' ),
					),
				),

				/**
				 * Option: Variable product button text
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-archive-variable-button-text]',
					'type'     => 'control',
					'control'  => 'text',
					'section'  => 'section-edd-archive',
					'default'  => smvmt_get_option( 'edd-archive-variable-button-text' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[edd-archive-variable-button]', '==', 'button' ),
					'priority' => 31,
					'title'    => __( 'Variable Product Button Text', 'smvmt' ),
				),

				/**
				 * Option: Easy Digital Downloads Shop Archive Content Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-archive-width-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-edd-archive',
					'priority' => 220,
					'settings' => array(),
				),

				/**
				 * Option: Archive Content Width
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[edd-archive-width]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-edd-archive',
					'default'  => smvmt_get_option( 'edd-archive-width' ),
					'priority' => 220,
					'title'    => __( 'Archive Content Width', 'smvmt' ),
					'choices'  => array(
						'default' => __( 'Default', 'smvmt' ),
						'custom'  => __( 'Custom', 'smvmt' ),
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[edd-archive-max-width]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'section'     => 'section-edd-archive',
					'default'     => 1200,
					'priority'    => 225,
					'required'    => array( SMVMT_THEME_SETTINGS . '[edd-archive-width]', '===', 'custom' ),
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

new SMVMT_Edd_Archive_Layout_Configs();

