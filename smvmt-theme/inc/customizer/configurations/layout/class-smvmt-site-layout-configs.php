<?php
/**
 * Site Layout Option for smvmt Theme.
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

if ( ! class_exists( 'SMVMT_Site_Layout_Configs' ) ) {

	/**
	 * Register Site Layout Customizer Configurations.
	 */
	class SMVMT_Site_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Site Layout Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				array(
					'name'        => SMVMT_THEME_SETTINGS . '[site-content-width]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'default'     => 1200,
					'section'     => 'section-container-layout',
					'priority'    => 10,
					'title'       => __( 'Width', 'smvmt' ),
					'required'    => array( SMVMT_THEME_SETTINGS . '[site-layout]', '==', 'smvmt-full-width-layout' ),
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 768,
						'step' => 1,
						'max'  => 1920,
					),
				),
			);

			return array_merge( $configurations, $_configs );
		}

	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Site_Layout_Configs();
