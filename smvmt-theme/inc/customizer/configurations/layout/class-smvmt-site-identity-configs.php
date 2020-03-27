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

if ( ! class_exists( 'SMVMT_Site_Identity_Configs' ) ) {

	/**
	 * Register smvmt Customizerr Site identity Customizer Configurations.
	 */
	class SMVMT_Site_Identity_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt Customizerr Site identity Customizer Configurations.
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
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-site-identity-logo]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'title_tagline',
					'title'    => __( 'Site Logo', 'smvmt' ),
					'priority' => 2,
					'settings' => array(),
				),

				/**
				 * Option: Different retina logo
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[different-retina-logo]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'section'  => 'title_tagline',
					'title'    => __( 'Different Logo For Retina Devices?', 'smvmt' ),
					'default'  => false,
					'priority' => 5,
				),
				/**
				 * Option: Retina logo selector
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[smvmt-header-retina-logo]',
					'default'        => smvmt_get_option( 'smvmt-header-retina-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'title_tagline',
					'required'       => array( SMVMT_THEME_SETTINGS . '[different-retina-logo]', '!=', 0 ),
					'priority'       => 5,
					'title'          => __( 'Retina Logo', 'smvmt' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				),

				/**
				 * Option: Inherit Desktop logo
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[different-mobile-logo]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => false,
					'section'  => 'title_tagline',
					'title'    => __( 'Different Logo For Mobile Devices?', 'smvmt' ),
					'priority' => 5,
				),

				/**
				 * Option: Mobile header logo
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[mobile-header-logo]',
					'default'        => smvmt_get_option( 'mobile-header-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'required'       => array( SMVMT_THEME_SETTINGS . '[different-mobile-logo]', '==', '1' ),
					'section'        => 'title_tagline',
					'priority'       => 5,
					'title'          => __( 'Mobile Logo (optional)', 'smvmt' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				),

				/**
				 * Option: Logo Width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[smvmt-header-responsive-logo-width]',
					'type'        => 'control',
					'control'     => 'smvmt-responsive-slider',
					'section'     => 'title_tagline',
					'transport'   => 'postMessage',
					'default'     => array(
						'desktop' => '',
						'tablet'  => '',
						'mobile'  => '',
					),
					'priority'    => 5,
					'title'       => __( 'Logo Width', 'smvmt' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[smvmt-site-logo-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'title'    => __( 'Site Icon', 'smvmt' ),
					'section'  => 'title_tagline',
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 * Option: Display Title
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[display-site-title]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'default'   => smvmt_get_option( 'display-site-title' ),
					'section'   => 'title_tagline',
					'title'     => __( 'Display Site Title', 'smvmt' ),
					'priority'  => 7,
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.main-header-bar .site-branding .smvmt-site-title-wrap',
						'container_inclusive' => false,
						'render_callback'     => array( 'SMVMT_Customizer_Partials', 'render_header_site_title_tagline' ),
					),
				),

				/**
				 * Option: Display Tagline
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[display-site-tagline]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'display-site-tagline' ),
					'section'   => 'title_tagline',
					'title'     => __( 'Display Site Tagline', 'smvmt' ),
					'partial'   => array(
						'selector'            => '.main-header-bar .site-branding .smvmt-site-title-wrap',
						'container_inclusive' => false,
						'render_callback'     => array( 'SMVMT_Customizer_Partials', 'render_header_site_title_tagline' ),
					),
				),

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[logo-title-inline]',
					'default'  => smvmt_get_option( 'logo-title-inline' ),
					'type'     => 'control',
					'required' => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[display-site-title]', '==', true ),
							array( SMVMT_THEME_SETTINGS . '[display-site-tagline]', '==', true ),
						),
						'operator'   => 'OR',
					),
					'control'  => 'checkbox',
					'section'  => 'title_tagline',
					'title'    => __( 'Inline Logo & Site Title', 'smvmt' ),
					'priority' => 7,
				),

				/**
				 * Option: Divider
				*/
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[smvmt-site-icon-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'title'    => __( 'Site Title', 'smvmt' ),
					'section'  => 'title_tagline',
					'priority' => 6,
					'settings' => array(),
				),
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[site-title-typography]',
					'default'   => smvmt_get_option( 'site-title-typography' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Typography', 'smvmt' ),
					'section'   => 'title_tagline',
					'transport' => 'postMessage',
					'priority'  => 9,
					'required'  => array(
						SMVMT_THEME_SETTINGS . '[display-site-title]',
						'==',
						true,
					),
				),
				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[smvmt-site-title-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'title_tagline',
					'title'    => __( 'Site Tagline', 'smvmt' ),
					'priority' => 9,
					'settings' => array(),
				),
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[site-tagline-typography]',
					'default'   => smvmt_get_option( 'site-tagline-typography' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Typography', 'smvmt' ),
					'section'   => 'title_tagline',
					'transport' => 'postMessage',
					'priority'  => 16,
					'required'  => array(
						SMVMT_THEME_SETTINGS . '[display-site-tagline]',
						'==',
						true,
					),
				),
			);

			$configurations = array_merge( $configurations, $_configs );
			return $configurations;

		}
	}
}


new SMVMT_Site_Identity_Configs();





