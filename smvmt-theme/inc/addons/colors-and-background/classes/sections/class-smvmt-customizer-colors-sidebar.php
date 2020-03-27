<?php
/**
 * Colors Sidebar Options for our theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.4.3
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'SMVMT_Customizer_Config_Base' ) ) {
	return;
}

/**
 * Customizer Sanitizes
 *
 * @since 1.4.3
 */
if ( ! class_exists( 'SMVMT_Customizer_Colors_Sidebar' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class SMVMT_Customizer_Colors_Sidebar extends SMVMT_Customizer_Config_Base {

		/**
		 * Register General Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: SideBar Color & Background Section heading
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[sidebar-color-background-heading-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-sidebars',
					'title'    => __( 'Colors & Background', 'smvmt-addon' ),
					'priority' => 23,
					'settings' => array(),
				),

				/**
				 * Option: SideBar Background Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sidebar-background-group]',
					'default'   => smvmt_get_option( 'sidebar-background-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Background', 'smvmt-addon' ),
					'section'   => 'section-sidebars',
					'transport' => 'postMessage',
					'priority'  => 23,
				),

				/**
				 * Option: SideBar Content Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[sidebar-content-group]',
					'default'   => smvmt_get_option( 'sidebar-content-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt-addon' ),
					'section'   => 'section-sidebars',
					'transport' => 'postMessage',
					'priority'  => 23,
				),

				// Option: Sidebar Background.
				array(
					'control'  => 'smvmt-background',
					'name'     => 'sidebar-bg-obj',
					'type'     => 'sub-control',
					'priority' => 7,
					'parent'   => SMVMT_THEME_SETTINGS . '[sidebar-background-group]',
					'section'  => 'section-sidebars',
					'default'  => smvmt_get_option( 'sidebar-bg-obj' ),
					'label'    => __( 'Background', 'smvmt-addon' ),
				),

				// Option: Widget Title Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'priority'  => 8,
					'parent'    => SMVMT_THEME_SETTINGS . '[sidebar-content-group]',
					'section'   => 'section-sidebars',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => 'sidebar-widget-title-color',
					'title'     => __( 'Title Color', 'smvmt-addon' ),
				),

				// Option: Text Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'priority'  => 9,
					'parent'    => SMVMT_THEME_SETTINGS . '[sidebar-content-group]',
					'section'   => 'section-sidebars',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => 'sidebar-text-color',
					'title'     => __( 'Text Color', 'smvmt-addon' ),
				),

				// Option: Link Color.
				array(
					'type'     => 'sub-control',
					'tab'      => __( 'Normal', 'smvmt-addon' ),
					'priority' => 10,
					'parent'   => SMVMT_THEME_SETTINGS . '[sidebar-content-group]',
					'section'  => 'section-sidebars',
					'control'  => 'smvmt-color',
					'default'  => '',
					'name'     => 'sidebar-link-color',
					'title'    => __( 'Link Color', 'smvmt-addon' ),
				),

				// Option: Link Hover Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Hover', 'smvmt-addon' ),
					'priority'  => 11,
					'parent'    => SMVMT_THEME_SETTINGS . '[sidebar-content-group]',
					'section'   => 'section-sidebars',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => 'sidebar-link-h-color',
					'title'     => __( 'Link Color', 'smvmt-addon' ),
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Customizer_Colors_Sidebar();
