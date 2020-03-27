<?php
/**
 * Styling Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.15
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Content_Typo_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Content_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Content Typography Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Heading 1 (H1) Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-h1]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-content-typo',
					'priority' => 4,
					'title'    => __( 'Heading 1', 'smvmt' ),
					'settings' => array(),
				),

				/**
				 * Option: Heading 1 (H1) Font Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[font-size-h1]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-content-typo',
					'default'     => smvmt_get_option( 'font-size-h1' ),
					'transport'   => 'postMessage',
					'priority'    => 6,
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
				 * Option: Heading 2 (H2) Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-h2]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-content-typo',
					'priority' => 9,
					'title'    => __( 'Heading 2', 'smvmt' ),
					'settings' => array(),
				),

				/**
				 * Option: Heading 2 (H2) Font Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[font-size-h2]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-content-typo',
					'default'     => smvmt_get_option( 'font-size-h2' ),
					'transport'   => 'postMessage',
					'priority'    => 11,
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
				 * Option: Heading 3 (H3) Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-h3]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-content-typo',
					'priority' => 15,
					'title'    => __( 'Heading 3', 'smvmt' ),
					'settings' => array(),
				),

				/**
				 * Option: Heading 3 (H3) Font Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[font-size-h3]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-content-typo',
					'priority'    => 16,
					'default'     => smvmt_get_option( 'font-size-h3' ),
					'transport'   => 'postMessage',
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
				 * Option: Heading 4 (H4) Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-h4]',
					'type'     => 'control',
					'title'    => __( 'Heading 4', 'smvmt' ),
					'section'  => 'section-content-typo',
					'control'  => 'smvmt-heading',
					'priority' => 20,
					'settings' => array(),
				),

				/**
				 * Option: Heading 4 (H4) Font Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[font-size-h4]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-content-typo',
					'default'     => smvmt_get_option( 'font-size-h4' ),
					'transport'   => 'postMessage',
					'priority'    => 21,
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
				 * Option: Heading 5 (H5) Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-h5]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-content-typo',
					'priority' => 25,
					'title'    => __( 'Heading 5', 'smvmt' ),
					'settings' => array(),
				),

				/**
				 * Option: Heading 5 (H5) Font Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[font-size-h5]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-content-typo',
					'default'     => smvmt_get_option( 'font-size-h5' ),
					'transport'   => 'postMessage',
					'priority'    => 26,
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
				 * Option: Heading 6 (H6) Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-h6]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'title'    => __( 'Heading 6', 'smvmt' ),
					'section'  => 'section-content-typo',
					'priority' => 30,
					'settings' => array(),
				),

				/**
				 * Option: Heading 6 (H6) Font Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[font-size-h6]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive',
					'section'     => 'section-content-typo',
					'default'     => smvmt_get_option( 'font-size-h6' ),
					'transport'   => 'postMessage',
					'priority'    => 31,
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

			// Learn More link if smvmt Pro is not activated.
			if ( ! defined( 'SMVMT_THEME_VERSION' ) ) {

				$_configs = array(
					/**
					 * Option: Divider
					 */
					array(
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-content-typography-more-feature-divider]',
						'type'     => 'control',
						'control'  => 'smvmt-divider',
						'section'  => 'section-content-typo',
						'priority' => 999,
						'settings' => array(),
					),

					/**
					 * Option: Learn More about Contant Typography
					 */
					array(
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-content-typography-more-feature-description]',
						'type'     => 'control',
						'control'  => 'smvmt-description',
						'section'  => 'section-content-typo',
						'priority' => 999,
						'title'    => '',
						'help'     => '<p>' . __( 'More Options Available in smvmt Pro!', 'smvmt' ) . '</p><a href="' . smvmt_get_pro_url( 'https://wpsmvmt.com/pro/', 'customizer', 'learn-more', 'upgrade-to-pro' ) . '" class="button button-secondary"  target="_blank" rel="noopener">' . __( 'Learn More', 'smvmt' ) . '</a>',
						'settings' => array(),
					),
				);

				$configurations = array_merge( $configurations, $_configs );

			}

			return $configurations;
		}
	}
}

new SMVMT_Content_Typo_Configs();


