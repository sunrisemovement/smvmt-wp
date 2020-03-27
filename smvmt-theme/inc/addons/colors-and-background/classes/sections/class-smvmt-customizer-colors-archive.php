<?php
/**
 * Blog Pro General Options for our theme.
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
if ( ! class_exists( 'SMVMT_Customizer_Colors_Archive' ) ) {

	/**
	 * Register General Customizer Configurations.
	 */
	class SMVMT_Customizer_Colors_Archive extends SMVMT_Customizer_Config_Base {

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
				 * Option: Blog Color Section heading
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[blog-color-heading-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-blog',
					'title'    => __( 'Colors and Background', 'smvmt-addon' ),
					'priority' => 125,
					'settings' => array(),
				),

				/**
				 * Option: Blog / Archive Color Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'default'   => smvmt_get_option( 'blog-content-color-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt-addon' ),
					'section'   => 'section-blog',
					'transport' => 'postMessage',
					'priority'  => 130,
				),

				// Option: Divider.
				array(
					'control'  => 'smvmt-divider',
					'default'  => '',
					'name'     => 'divider-blog-archive',
					'type'     => 'sub-control',
					'parent'   => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'  => 'section-blog',
					'title'    => __( 'Archive Summary Box', 'smvmt-addon' ),
					'tab'      => __( 'Normal', 'smvmt-addon' ),
					'section'  => 'section-blog',
					'priority' => 11,
					'settings' => array(),
				),

				// Option: Archive Summary Box Background Color.
				array(
					'name'        => 'archive-summary-box-bg-color',
					'default'     => '',
					'tab'         => __( 'Normal', 'smvmt-addon' ),
					'priority'    => 11,
					'type'        => 'sub-control',
					'parent'      => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'     => 'section-blog',
					'transport'   => 'postMessage',
					'control'     => 'smvmt-color',
					'title'       => __( 'Background Color', 'smvmt-addon' ),
					'description' => __( 'This background color will not work on full-width layout.', 'smvmt-addon' ),
				),

				// Option: Archive Summary Box Title Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'priority'  => 11,
					'parent'    => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'   => 'section-blog',
					'control'   => 'smvmt-color',
					'transport' => 'postMessage',
					'name'      => 'archive-summary-box-title-color',
					'default'   => '',
					'title'     => __( 'Title Color', 'smvmt-addon' ),
				),

				// Option: Archive Summary Box Description Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'priority'  => 11,
					'parent'    => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'   => 'section-blog',
					'control'   => 'smvmt-color',
					'transport' => 'postMessage',
					'name'      => 'archive-summary-box-text-color',
					'default'   => '',
					'title'     => __( 'Description Color', 'smvmt-addon' ),
				),

				// Option: Blog / Archive Post Title Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'priority'  => 10,
					'parent'    => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'   => 'section-blog',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => 'page-title-color',
					'title'     => __( 'Post Title Color', 'smvmt-addon' ),
				),

				// Option: Post Meta Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'priority'  => 10,
					'parent'    => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'   => 'section-blog',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => 'post-meta-color',
					'title'     => __( 'Meta Color', 'smvmt-addon' ),
				),

				// Option: Post Meta Link Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Normal', 'smvmt-addon' ),
					'priority'  => 10,
					'parent'    => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'   => 'section-blog',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => 'post-meta-link-color',
					'title'     => __( 'Meta Link Color', 'smvmt-addon' ),
				),

				// Option: Post Meta Link Hover Color.
				array(
					'type'      => 'sub-control',
					'tab'       => __( 'Hover', 'smvmt-addon' ),
					'priority'  => 12,
					'parent'    => SMVMT_THEME_SETTINGS . '[blog-content-color-group]',
					'section'   => 'section-blog',
					'control'   => 'smvmt-color',
					'default'   => '',
					'transport' => 'postMessage',
					'name'      => 'post-meta-link-h-color',
					'title'     => __( 'Meta Link Color', 'smvmt-addon' ),
				),
			);

			return array_merge( $configurations, $_configs );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
new SMVMT_Customizer_Colors_Archive();
