<?php
/**
 * Bottom Footer Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Blog_Layout_Configs' ) ) {

	/**
	 * Register Blog Layout Customizer Configurations.
	 */
	class SMVMT_Blog_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Blog Layout Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[smvmt-styling-section-blog-width]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-blog',
					'priority' => 60,
					'settings' => array(),
				),

				/**
				 * Option: Blog Content Width
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-width]',
					'default'  => smvmt_get_option( 'blog-width' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-blog',
					'priority' => 50,
					'title'    => __( 'Content Width', 'smvmt' ),
					'choices'  => array(
						'default' => __( 'Default', 'smvmt' ),
						'custom'  => __( 'Custom', 'smvmt' ),
					),
				),

				/**
				 * Option: Enter Width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[blog-max-width]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'section'     => 'section-blog',
					'transport'   => 'postMessage',
					'default'     => 1200,
					'priority'    => 50,
					'required'    => array( SMVMT_THEME_SETTINGS . '[blog-width]', '===', 'custom' ),
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
					'name'     => SMVMT_THEME_SETTINGS . '[smvmt-styling-section-blog-width-end]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-blog',
					'priority' => 50,
					'settings' => array(),
				),

				/**
				 * Option: Blog Post Content
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-post-content]',
					'section'  => 'section-blog',
					'title'    => __( 'Post Content', 'smvmt' ),
					'default'  => smvmt_get_option( 'blog-post-content' ),
					'type'     => 'control',
					'control'  => 'select',
					'priority' => 75,
					'choices'  => array(
						'full-content' => __( 'Full Content', 'smvmt' ),
						'excerpt'      => __( 'Excerpt', 'smvmt' ),
					),
				),

				/**
				 * Option: Display Post Structure
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-post-structure]',
					'default'  => smvmt_get_option( 'blog-post-structure' ),
					'type'     => 'control',
					'control'  => 'smvmt-sortable',
					'section'  => 'section-blog',
					'priority' => 50,
					'title'    => __( 'Post Structure', 'smvmt' ),
					'choices'  => array(
						'image'      => __( 'Featured Image', 'smvmt' ),
						'title-meta' => __( 'Title & Blog Meta', 'smvmt' ),
					),
				),

				/**
				 * Option: Display Post Meta
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-meta]',
					'type'     => 'control',
					'control'  => 'smvmt-sortable',
					'section'  => 'section-blog',
					'default'  => smvmt_get_option( 'blog-meta' ),
					'priority' => 50,
					'required' => array( SMVMT_THEME_SETTINGS . '[blog-post-structure]', 'contains', 'title-meta' ),
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


new SMVMT_Blog_Layout_Configs();





