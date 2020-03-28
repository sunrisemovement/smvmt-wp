<?php
/**
 * Styling Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.0.15
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Header_Typo_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Header_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Header Typography Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Site Title Font Size
				 */
				array(
					'name'        => 'font-size-site-title',
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[site-title-typography]',
					'section'     => 'title_tagline',
					'control'     => 'smvmt-responsive',
					'default'     => smvmt_get_option( 'font-size-site-title' ),
					'transport'   => 'postMessage',
					'priority'    => 9,
					'title'       => __( 'Size', 'smvmt' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),

				/**
				 * Option: Site Tagline Font Size
				 */
				array(
					'name'        => 'font-size-site-tagline',
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[site-tagline-typography]',
					'section'     => 'title_tagline',
					'control'     => 'smvmt-responsive',
					'default'     => smvmt_get_option( 'font-size-site-tagline' ),
					'transport'   => 'postMessage',
					'priority'    => 15,
					'title'       => __( 'Size', 'smvmt' ),
					'input_attrs' => array(
						'min' => 0,
					),
					'units'       => array(
						'px' => 'px',
						'em' => 'em',
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );

			return $configurations;
		}
	}
}

new SMVMT_Header_Typo_Configs();


