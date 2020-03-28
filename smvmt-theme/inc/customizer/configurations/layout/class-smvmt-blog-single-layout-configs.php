<?php
/**
 * Bottom Footer Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Blog_Single_Layout_Configs' ) ) {

	/**
	 * Register Blog Single Layout Configurations.
	 */
	class SMVMT_Blog_Single_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Blog Single Layout Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Single Post Content Width
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-single-width]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-blog-single',
					'default'  => smvmt_get_option( 'blog-single-width' ),
					'priority' => 5,
					'title'    => __( 'Content Width', 'smvmt' ),
					'choices'  => array(
						'default' => __( 'Default', 'smvmt' ),
						'custom'  => __( 'Custom', 'smvmt' ),
					),
					'partial'  => array(
						'selector'            => '.smvmt-single-post .site-content .smvmt-container .content-area .entry-title',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[blog-single-max-width]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'section'     => 'section-blog-single',
					'transport'   => 'postMessage',
					'default'     => 1200,
					'required'    => array( SMVMT_THEME_SETTINGS . '[blog-single-width]', '===', 'custom' ),
					'priority'    => 5,
					'title'       => __( 'Custom Width', 'smvmt' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[smvmt-styling-section-blog-single-width]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-blog-single',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Display Post Structure
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-single-post-structure]',
					'type'     => 'control',
					'control'  => 'smvmt-sortable',
					'section'  => 'section-blog-single',
					'default'  => smvmt_get_option( 'blog-single-post-structure' ),
					'priority' => 5,
					'title'    => __( 'Structure', 'smvmt' ),
					'choices'  => array(
						'single-image'      => __( 'Featured Image', 'smvmt' ),
						'single-title-meta' => __( 'Title & Blog Meta', 'smvmt' ),
					),
				),

				/**
				 * Option: Single Post Meta
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-single-meta]',
					'type'     => 'control',
					'control'  => 'smvmt-sortable',
					'default'  => smvmt_get_option( 'blog-single-meta' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[blog-single-post-structure]', 'contains', 'single-title-meta' ),
					'section'  => 'section-blog-single',
					'priority' => 5,
					'title'    => __( 'Meta', 'smvmt' ),
					'choices'  => array(
						'comments' => __( 'Comments', 'smvmt' ),
						'category' => __( 'Category', 'smvmt' ),
						'author'   => __( 'Author', 'smvmt' ),
						'date'     => __( 'Publish Date', 'smvmt' ),
						'tag'      => __( 'Tag', 'smvmt' ),
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;

		}
	}
}


new SMVMT_Blog_Single_Layout_Configs();





