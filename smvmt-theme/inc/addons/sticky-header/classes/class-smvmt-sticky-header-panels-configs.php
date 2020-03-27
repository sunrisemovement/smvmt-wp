<?php
/**
 * Sticky Header - Panels & Sections
 *
 * @package smvmt
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'SMVMT_Customizer_Config_Base' ) ) {
	return;
}

if ( ! class_exists( 'SMVMT_Sticky_Header_Panels_Configs' ) ) {

	/**
	 * Register Sticky Header Customizer Configurations.
	 */
	class SMVMT_Sticky_Header_Panels_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Sticky Header Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_config = array(

				array(
					'name'     => 'section-sticky-header',
					'title'    => __( 'Sticky Header', 'smvmt-addon' ),
					'panel'    => 'panel-header-group',
					'priority' => 31,
					'type'     => 'section',
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new SMVMT_Sticky_Header_Panels_Configs();
