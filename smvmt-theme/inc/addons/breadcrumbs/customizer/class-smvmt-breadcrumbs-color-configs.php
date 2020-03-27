<?php
/**
 * Colors - Breadcrumbs Options for theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 1.7.0
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
 * @since 1.7.0
 */
if ( ! class_exists( 'SMVMT_Breadcrumbs_Color_Configs' ) ) {

	/**
	 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
	 */
	class SMVMT_Breadcrumbs_Color_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Colors and Background - Breadcrumbs Options Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.7.0
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = SMVMT_Theme_Options::defaults();

			$_configs = array(

				/**
				 * Option: Divider
				 * Option: breadcrumb color Section divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[section-breadcrumb-color-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-breadcrumb',
					'title'    => __( 'Colors', 'smvmt' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'priority' => 72,
					'settings' => array(),
				),

				/*
				 * Breadcrumb Color
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[section-breadcrumb-color]',
					'default'   => smvmt_get_option( 'section-breadcrumb-color' ),
					'type'      => 'control',
					'required'  => array( SMVMT_THEME_SETTINGS . '[breadcrumb-position]', '!=', 'none' ),
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt' ),
					'section'   => 'section-breadcrumb',
					'transport' => 'postMessage',
					'priority'  => 72,
				),

				array(
					'name'       => 'breadcrumb-bg-color',
					'type'       => 'sub-control',
					'default'    => smvmt_get_option( 'breadcrumb-bg-color' ),
					'parent'     => SMVMT_THEME_SETTINGS . '[section-breadcrumb-color]',
					'section'    => 'section-breadcrumb',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'smvmt' ),
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Background Color', 'smvmt' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 5,
				),

				array(
					'name'       => 'breadcrumb-active-color-responsive',
					'default'    => smvmt_get_option( 'breadcrumb-active-color-responsive' ),
					'type'       => 'sub-control',
					'parent'     => SMVMT_THEME_SETTINGS . '[section-breadcrumb-color]',
					'section'    => 'section-breadcrumb',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'smvmt' ),
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Text Color', 'smvmt' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 10,
				),

				array(
					'name'       => 'breadcrumb-text-color-responsive',
					'default'    => smvmt_get_option( 'breadcrumb-text-color-responsive' ),
					'type'       => 'sub-control',
					'parent'     => SMVMT_THEME_SETTINGS . '[section-breadcrumb-color]',
					'section'    => 'section-breadcrumb',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'smvmt' ),
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Color', 'smvmt' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 15,
				),

				array(
					'name'       => 'breadcrumb-hover-color-responsive',
					'default'    => smvmt_get_option( 'breadcrumb-hover-color-responsive' ),
					'type'       => 'sub-control',
					'parent'     => SMVMT_THEME_SETTINGS . '[section-breadcrumb-color]',
					'section'    => 'section-breadcrumb',
					'transport'  => 'postMessage',
					'tab'        => __( 'Hover', 'smvmt' ),
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Link Color', 'smvmt' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 20,
				),

				array(
					'name'       => 'breadcrumb-separator-color',
					'default'    => smvmt_get_option( 'breadcrumb-separator-color' ),
					'type'       => 'sub-control',
					'parent'     => SMVMT_THEME_SETTINGS . '[section-breadcrumb-color]',
					'section'    => 'section-breadcrumb',
					'transport'  => 'postMessage',
					'tab'        => __( 'Normal', 'smvmt' ),
					'control'    => 'smvmt-responsive-color',
					'title'      => __( 'Separator Color', 'smvmt' ),
					'responsive' => true,
					'rgba'       => true,
					'priority'   => 25,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Breadcrumbs_Color_Configs();
