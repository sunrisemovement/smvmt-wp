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

if ( ! class_exists( 'SMVMT_Archive_Typo_Configs' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class SMVMT_Archive_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Archive Typography Customizer Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Blog Typography
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-typography-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-blog',
					'title'    => __( 'Typography', 'smvmt' ),
					'priority' => 135,
					'settings' => array(),
				),

				/**
				 * Option: Blog / Archive Typography
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[blog-content-archive-summary-typo]',
					'default'   => smvmt_get_option( 'blog-content-archive-summary-typo' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Archive Title', 'smvmt' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 140,
				),

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'default'   => smvmt_get_option( 'blog-content-blog-post-title-typo' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Post Title', 'smvmt' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 140,
				),

				/**
				 * Option: Blog - Post Title Font Size
				 */
				array(
					'name'        => 'font-size-page-title',
					'parent'      => SMVMT_THEME_SETTINGS . '[blog-content-blog-post-title-typo]',
					'section'     => 'section-blog',
					'type'        => 'sub-control',
					'control'     => 'smvmt-responsive',
					'transport'   => 'postMessage',
					'priority'    => 2,
					'default'     => smvmt_get_option( 'font-size-page-title' ),
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
				 * Option: Archive Summary Box Title Font Size
				 */
				array(
					'name'        => 'font-size-archive-summary-title',
					'parent'      => SMVMT_THEME_SETTINGS . '[blog-content-archive-summary-typo]',
					'section'     => 'section-blog',
					'type'        => 'sub-control',
					'control'     => 'smvmt-responsive',
					'transport'   => 'postMessage',
					'default'     => smvmt_get_option( 'font-size-archive-summary-title' ),
					'priority'    => 8,
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
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-blog-typography-more-feature-divider]',
						'type'     => 'control',
						'control'  => 'smvmt-divider',
						'section'  => 'section-blog',
						'priority' => 999,
						'settings' => array(),
					),

					/**
					 * Option: Learn More about Contant Typography
					 */
					array(
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-blog-typography-more-feature-description]',
						'type'     => 'control',
						'control'  => 'smvmt-description',
						'section'  => 'section-blog',
						'priority' => 999,
						'title'    => '',
						'help'     => '<p>' . __( 'More Options Available in smvmt Pro!', 'smvmt' ) . '</p><a href="' . smvmt_get_pro_url( 'https://smvmt.org/pro/', 'customizer', 'learn-more', 'upgrade-to-pro' ) . '" class="button button-secondary"  target="_blank" rel="noopener">' . __( 'Learn More', 'smvmt' ) . '</a>',
						'settings' => array(),
					),
				);

				$configurations = array_merge( $configurations, $_configs );
			}

			return $configurations;
		}
	}
}

new SMVMT_Archive_Typo_Configs();


