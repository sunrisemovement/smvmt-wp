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

if ( ! class_exists( 'SMVMT_Sidebar_Layout_Configs' ) ) {

	/**
	 * Register smvmt Sidebar Layout Configurations.
	 */
	class SMVMT_Sidebar_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt Sidebar Layout Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Default Sidebar Position
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[site-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => smvmt_get_option( 'site-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'Default Layout', 'smvmt' ),
					'choices'  => array(
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[single-page-sidebar-layout-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-sidebars',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Page
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[single-page-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-sidebars',
					'default'  => smvmt_get_option( 'single-page-sidebar-layout' ),
					'priority' => 5,
					'title'    => __( 'Pages', 'smvmt' ),
					'choices'  => array(
						'default'       => __( 'Default', 'smvmt' ),
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),

				/**
				 * Option: Blog Post
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[single-post-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'single-post-sidebar-layout' ),
					'section'  => 'section-sidebars',
					'priority' => 5,
					'title'    => __( 'Blog Posts', 'smvmt' ),
					'choices'  => array(
						'default'       => __( 'Default', 'smvmt' ),
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),

				/**
				 * Option: Blog Post Archive
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[archive-post-sidebar-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'archive-post-sidebar-layout' ),
					'section'  => 'section-sidebars',
					'priority' => 5,
					'title'    => __( 'Archives', 'smvmt' ),
					'choices'  => array(
						'default'       => __( 'Default', 'smvmt' ),
						'no-sidebar'    => __( 'No Sidebar', 'smvmt' ),
						'left-sidebar'  => __( 'Left Sidebar', 'smvmt' ),
						'right-sidebar' => __( 'Right Sidebar', 'smvmt' ),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-sidebar-width]',
					'type'     => 'control',
					'section'  => 'section-sidebars',
					'control'  => 'smvmt-divider',
					'priority' => 10,
					'settings' => array(),
				),

				/**
				 * Option: Primary Content Width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[site-sidebar-width]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'default'     => 30,
					'section'     => 'section-sidebars',
					'priority'    => 15,
					'title'       => __( 'Sidebar Width', 'smvmt' ),
					'suffix'      => '%',
					'input_attrs' => array(
						'min'  => 15,
						'step' => 1,
						'max'  => 50,
					),
				),

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[site-sidebar-width-description]',
					'type'     => 'control',
					'control'  => 'smvmt-description',
					'section'  => 'section-sidebars',
					'priority' => 15,
					'title'    => '',
					'help'     => __( 'Sidebar width will apply only when one of the above sidebar is set.', 'smvmt' ),
					'settings' => array(),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}


new SMVMT_Sidebar_Layout_Configs();





