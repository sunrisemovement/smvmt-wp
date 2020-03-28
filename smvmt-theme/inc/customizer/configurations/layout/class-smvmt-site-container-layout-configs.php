<?php
/**
 * General Options for smvmt Theme.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



if ( ! class_exists( 'SMVMT_Site_Container_Layout_Configs' ) ) {

	/**
	 * Register smvmt Site Container Layout Customizer Configurations.
	 */
	class SMVMT_Site_Container_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register smvmt Site Container Layout Customizer Configurations.
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
					'name'     => SMVMT_THEME_SETTINGS . '[site-content-layout-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'section'  => 'section-container-layout',
					'priority' => 50,
					'settings' => array(),
				),

				/**
				 * Option: Single Page Content Layout
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[site-content-layout]',
					'type'     => 'control',
					'default'  => smvmt_get_option( 'site-content-layout' ),
					'control'  => 'select',
					'section'  => 'section-container-layout',
					'priority' => 50,
					'title'    => __( 'Layout', 'smvmt' ),
					'choices'  => array(
						'boxed-container'         => __( 'Boxed', 'smvmt' ),
						'content-boxed-container' => __( 'Content Boxed', 'smvmt' ),
						'plain-container'         => __( 'Full Width / Contained', 'smvmt' ),
						'page-builder'            => __( 'Full Width / Stretched', 'smvmt' ),
					),
				),

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[single-page-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'single-page-content-layout' ),
					'section'  => 'section-container-layout',
					'title'    => __( 'Page Layout', 'smvmt' ),
					'priority' => 55,
					'choices'  => array(
						'default'                 => __( 'Default', 'smvmt' ),
						'boxed-container'         => __( 'Boxed', 'smvmt' ),
						'content-boxed-container' => __( 'Content Boxed', 'smvmt' ),
						'plain-container'         => __( 'Full Width / Contained', 'smvmt' ),
						'page-builder'            => __( 'Full Width / Stretched', 'smvmt' ),
					),
				),

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[single-post-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'single-post-content-layout' ),
					'section'  => 'section-container-layout',
					'priority' => 60,
					'title'    => __( 'Blog Post Layout', 'smvmt' ),
					'choices'  => array(
						'default'                 => __( 'Default', 'smvmt' ),
						'boxed-container'         => __( 'Boxed', 'smvmt' ),
						'content-boxed-container' => __( 'Content Boxed', 'smvmt' ),
						'plain-container'         => __( 'Full Width / Contained', 'smvmt' ),
						'page-builder'            => __( 'Full Width / Stretched', 'smvmt' ),
					),
				),

				/**
				 * Option: Archive Post Content Layout
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[archive-post-content-layout]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'archive-post-content-layout' ),
					'section'  => 'section-container-layout',
					'priority' => 65,
					'title'    => __( 'Archives Layout', 'smvmt' ),
					'choices'  => array(
						'default'                 => __( 'Default', 'smvmt' ),
						'boxed-container'         => __( 'Boxed', 'smvmt' ),
						'content-boxed-container' => __( 'Content Boxed', 'smvmt' ),
						'plain-container'         => __( 'Full Width / Contained', 'smvmt' ),
						'page-builder'            => __( 'Full Width / Stretched', 'smvmt' ),
					),
				),

				/**
				 * Option: Body Background
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[site-layout-outside-bg-obj]',
					'type'     => 'control',
					'control'  => 'smvmt-background',
					'default'  => smvmt_get_option( 'site-layout-outside-bg-obj' ),
					'section'  => 'section-colors-body',
					'priority' => 25,
					'title'    => __( 'Background', 'smvmt' ),
				),

			);

			$configurations = array_merge( $configurations, $_configs );

			// Learn More link if smvmt Pro is not activated.
			if ( ! defined( 'SMVMT_THEME_VERSION' ) ) {

				$config = array(

					/**
					 * Option: Divider
					 */

					array(
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-container-more-feature-divider]',
						'type'     => 'control',
						'default'  => smvmt_get_option( 'site-content-layout' ),
						'control'  => 'smvmt-divider',
						'section'  => 'section-container-layout',
						'priority' => 999,
						'settings' => array(),
					),

					array(
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-container-more-feature-description]',
						'type'     => 'control',
						'control'  => 'smvmt-description',
						'section'  => 'section-container-layout',
						'priority' => 999,
						'title'    => '',
						'help'     => '<p>' . __( 'More Options Available in smvmt Pro!', 'smvmt' ) . '</p><a href="' . smvmt_get_pro_url( 'https://smvmt.org/pro/', 'customizer', 'learn-more', 'upgrade-to-pro' ) . '" class="button button-secondary"  target="_blank" rel="noopener">' . __( 'Learn More', 'smvmt' ) . '</a>',
						'settings' => array(),
					),
				);

				$configurations = array_merge( $configurations, $config );
			}

			return $configurations;
		}
	}
}


new SMVMT_Site_Container_Layout_Configs();




