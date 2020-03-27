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

if ( ! class_exists( 'SMVMT_Single_Typo_Configs' ) ) {

	/**
	 * Customizer Single Typography Configurations.
	 *
	 * @since 1.4.3
	 */
	class SMVMT_Single_Typo_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Single Typography configurations.
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
					'name'     => SMVMT_THEME_SETTINGS . '[divider-section-single-post-typo]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-blog-single',
					'priority' => 13,
					'title'    => __( 'Typography', 'smvmt' ),
					'settings' => array(),
				),

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[blog-single-title-typo]',
					'type'      => 'control',
					'priority'  => 13,
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Post / Page Title', 'smvmt' ),
					'section'   => 'section-blog-single',
					'transport' => 'postMessage',
				),

				/**
				 * Option: Single Post / Page Title Font Size
				 */
				array(
					'name'        => 'font-size-entry-title',
					'parent'      => SMVMT_THEME_SETTINGS . '[blog-single-title-typo]',
					'section'     => 'section-blog-single',
					'type'        => 'sub-control',
					'control'     => 'smvmt-responsive',
					'default'     => smvmt_get_option( 'font-size-entry-title' ),
					'transport'   => 'postMessage',
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
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-sngle-blog-typography-more-feature-divider]',
						'type'     => 'control',
						'control'  => 'smvmt-divider',
						'section'  => 'section-blog-single',
						'priority' => 999,
						'settings' => array(),
					),

					/**
					 * Option: Learn More about Typography
					 */
					array(
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-sngle-blog-typography-more-feature-description]',
						'type'     => 'control',
						'control'  => 'smvmt-description',
						'section'  => 'section-blog-single',
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

new SMVMT_Single_Typo_Configs();


