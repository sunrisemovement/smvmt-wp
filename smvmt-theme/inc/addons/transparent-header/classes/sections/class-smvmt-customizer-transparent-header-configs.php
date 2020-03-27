<?php
/**
 * Transparent Header Options for our theme.
 *
 * @package     smvmt Addon
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 1.4.3
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
if ( ! class_exists( 'SMVMT_Customizer_Transparent_Header_Configs' ) ) {

	/**
	 * Register Transparent Header Customizer Configurations.
	 */
	class SMVMT_Customizer_Transparent_Header_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Transparent Header Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$defaults = SMVMT_Theme_Options::defaults();

			$_configs = array(

				/**
				 * Option: Enable Transparent Header
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[transparent-header-enable]',
					'default'  => smvmt_get_option( 'transparent-header-enable' ),
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Enable on Complete Website', 'smvmt' ),
					'priority' => 20,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Disable Transparent Header on Archive Pages
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[transparent-header-disable-archive]',
					'default'     => smvmt_get_option( 'transparent-header-disable-archive' ),
					'type'        => 'control',
					'section'     => 'section-transparent-header',
					'required'    => array( SMVMT_THEME_SETTINGS . '[transparent-header-enable]', '==', '1' ),
					'title'       => __( 'Disable on 404, Search & Archives?', 'smvmt' ),
					'description' => __( 'This setting is generally not recommended on special pages such as archive, search, 404, etc. If you would like to enable it, uncheck this option', 'smvmt' ),
					'priority'    => 25,
					'control'     => 'checkbox',
				),

				/**
				 * Option: Disable Transparent Header on Archive Pages
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[transparent-header-disable-index]',
					'default'     => smvmt_get_option( 'transparent-header-disable-index' ),
					'type'        => 'control',
					'section'     => 'section-transparent-header',
					'required'    => array( SMVMT_THEME_SETTINGS . '[transparent-header-enable]', '==', '1' ),
					'title'       => __( 'Disable on Blog page?', 'smvmt' ),
					'description' => __( 'Blog Page is when Latest Posts are selected to be displayed on a particular page.', 'smvmt' ),
					'priority'    => 25,
					'control'     => 'checkbox',
				),

				/**
				 * Option: Disable Transparent Header on Your latest posts index Page
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[transparent-header-disable-latest-posts-index]',
					'default'     => smvmt_get_option( 'transparent-header-disable-latest-posts-index' ),
					'type'        => 'control',
					'section'     => 'section-transparent-header',
					'required'    => array( SMVMT_THEME_SETTINGS . '[transparent-header-enable]', '==', '1' ),
					'title'       => __( 'Disable on Latest Posts Page?', 'smvmt' ),
					'description' => __( "Latest Posts page is your site's front page when the latest posts are displayed on the home page.", 'smvmt' ),
					'priority'    => 25,
					'control'     => 'checkbox',
				),

				/**
				 * Option: Disable Transparent Header on Pages
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[transparent-header-disable-page]',
					'default'  => smvmt_get_option( 'transparent-header-disable-page' ),
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'required' => array( SMVMT_THEME_SETTINGS . '[transparent-header-enable]', '==', '1' ),
					'title'    => __( 'Disable on Pages?', 'smvmt' ),
					'priority' => 25,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Disable Transparent Header on Posts
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[transparent-header-disable-posts]',
					'default'  => smvmt_get_option( 'transparent-header-disable-posts' ),
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'required' => array( SMVMT_THEME_SETTINGS . '[transparent-header-enable]', '==', '1' ),
					'title'    => __( 'Disable on Posts?', 'smvmt' ),
					'priority' => 25,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Transparent Header Styling
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-transparent-display]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-transparent-header',
					'priority' => 26,
					'settings' => array(),
				),

				/**
				 * Option: Sticky Header Display On
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[transparent-header-on-devices]',
					'default'  => smvmt_get_option( 'transparent-header-on-devices' ),
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'priority' => 27,
					'title'    => __( 'Enable On', 'smvmt' ),
					'control'  => 'select',
					'choices'  => array(
						'desktop' => __( 'Desktop', 'smvmt' ),
						'mobile'  => __( 'Mobile', 'smvmt' ),
						'both'    => __( 'Desktop + Mobile', 'smvmt' ),
					),
				),

				/**
				 * Option: Transparent Header Styling
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-transparent-styling]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-transparent-header',
					'priority' => 28,
					'settings' => array(),
				),

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[different-transparent-logo]',
					'default'  => smvmt_get_option( 'different-transparent-logo', false ),
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Different Logo for Transparent Header?', 'smvmt' ),
					'priority' => 30,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Transparent header logo selector
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[transparent-header-logo]',
					'default'        => smvmt_get_option( 'transparent-header-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'section-transparent-header',
					'required'       => array( SMVMT_THEME_SETTINGS . '[different-transparent-logo]', '==', true ),
					'priority'       => 30,
					'title'          => __( 'Logo', 'smvmt' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					'partial'        => array(
						'selector'            => '.smvmt-replace-site-logo-transparent .site-branding .site-logo-img',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Different retina logo
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[different-transparent-retina-logo]',
					'default'  => false,
					'type'     => 'control',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Different Logo For Retina Devices?', 'smvmt' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[different-transparent-logo]', '==', true ),
					'priority' => 30,
					'control'  => 'checkbox',
				),

				/**
				 * Option: Transparent header logo selector
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[transparent-header-retina-logo]',
					'default'        => smvmt_get_option( 'transparent-header-retina-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'section-transparent-header',
					'required'       => array( SMVMT_THEME_SETTINGS . '[different-transparent-retina-logo]', '==', true ),
					'priority'       => 30,
					'title'          => __( 'Retina Logo', 'smvmt' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
				),

				/**
				 * Option: Transparent header logo width
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[transparent-header-logo-width]',
					'default'     => smvmt_get_option( 'transparent-header-logo-width' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'smvmt-responsive-slider',
					'section'     => 'section-transparent-header',
					'required'    => array( SMVMT_THEME_SETTINGS . '[different-transparent-logo]', '==', true ),
					'priority'    => 30,
					'title'       => __( 'Logo Width', 'smvmt' ),
					'input_attrs' => array(
						'min'  => 50,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Transparent Header Border Styling
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-transparent-border-styling]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-transparent-header',
					'priority' => 30,
					'settings' => array(),
				),

				/**
				 * Option: Bottom Border Size
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[transparent-header-main-sep]',
					'default'     => smvmt_get_option( 'transparent-header-main-sep' ),
					'type'        => 'control',
					'transport'   => 'postMessage',
					'control'     => 'smvmt-slider',
					'section'     => 'section-transparent-header',
					'priority'    => 30,
					'title'       => __( 'Bottom Border Size', 'smvmt' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Bottom Border Color
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-main-sep-color]',
					'default'   => '',
					'type'      => 'control',
					'transport' => 'postMessage',
					'control'   => 'smvmt-color',
					'section'   => 'section-transparent-header',
					'priority'  => 30,
					'title'     => __( 'Bottom Border Color', 'smvmt' ),
				),

				/**
				 * Option: Transparent Header Styling
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[divider-sec-transparent-styling]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-transparent-header',
					'title'    => __( 'Colors & Background', 'smvmt' ),
					'priority' => 35,
					'settings' => array(),
				),

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-background-colors]',
					'default'   => smvmt_get_option( 'transparent-header-background-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Background', 'smvmt' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 35,
				),

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-colors]',
					'default'   => smvmt_get_option( 'transparent-header-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Site Title', 'smvmt' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 35,
				),

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-colors-menu]',
					'default'   => smvmt_get_option( 'transparent-header-colors-menu' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Menu', 'smvmt' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 35,
				),

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-colors-submenu]',
					'default'   => smvmt_get_option( 'transparent-header-colors-submenu' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Submenu', 'smvmt' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 35,
				),

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[transparent-header-colors-content]',
					'default'   => smvmt_get_option( 'transparent-header-colors-content' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt' ),
					'section'   => 'section-transparent-header',
					'transport' => 'postMessage',
					'priority'  => 35,
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Customizer_Transparent_Header_Configs();
