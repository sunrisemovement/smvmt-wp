<?php
/**
 * Colors Single Options for our theme.
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
if ( ! class_exists( 'SMVMT_Customizer_Colors_Single' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class SMVMT_Customizer_Colors_Single extends SMVMT_Customizer_Config_Base {

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
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-entry-color]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-blog-single',
					'priority' => 12,
					'title'    => __( 'Color', 'smvmt-addon' ),
					'settings' => array(),
				),

				// Option: Single Post / Page Title Color.
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[entry-title-color]',
					'type'      => 'control',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'title'     => __( 'Post/Page Title Color', 'smvmt-addon' ),
					'section'   => 'section-blog-single',
					'priority'  => 12,
				),

			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Customizer_Colors_Single();
