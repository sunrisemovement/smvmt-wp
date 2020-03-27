<?php
/**
 * Above Header - Layout Options for our theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       1.0.0
 */

// Block direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bail if Customizer config base class does not exist.
if ( ! class_exists( 'SMVMT_Customizer_Config_Base' ) ) {
	return;
}


if ( ! class_exists( 'SMVMT_Above_Header_Configs' ) ) {

	/**
	 * Register Header Layout Customizer Configurations.
	 */
	class SMVMT_Above_Header_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Header Layout Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$sections = apply_filters(
				'smvmt_header_section_elements',
				array(
					''          => __( 'None', 'smvmt-addon' ),
					'menu'      => __( 'Menu', 'smvmt-addon' ),
					'search'    => __( 'Search', 'smvmt-addon' ),
					'text-html' => __( 'Text / HTML', 'smvmt-addon' ),
					'widget'    => __( 'Widget', 'smvmt-addon' ),
				),
				'above-header'
			);

			$_config = array(

				/**
				 * Option: Above Header Layout
				 */

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-layout]',
					'section'  => 'section-above-header',
					'type'     => 'control',
					'control'  => 'smvmt-radio-image',
					'default'  => smvmt_get_option( 'above-header-layout' ),
					'priority' => 1,
					'title'    => __( 'Layout', 'smvmt-addon' ),
					'choices'  => array(
						'disabled'              => array(
							'label' => __( 'Disabled', 'smvmt-addon' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"> <g> <g> <path fill="#0085BA" d="M116.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.956,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.657,80.796,116.701,80.796z M3.799,1.979 c-0.979,0-1.773,0.797-1.773,1.774v73.494c0,0.979,0.795,1.772,1.773,1.772h112.902c0.979,0,1.773-0.797,1.773-1.772V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/> </g> </g> <path fill="#0085BA" d="M60.25,19.5c-11.581,0-21,9.419-21,21c0,11.578,9.419,21,21,21c11.578,0,21-9.422,21-21 C81.25,28.919,71.828,19.5,60.25,19.5z M42.308,40.5c0-9.892,8.05-17.942,17.942-17.942c4.412,0,8.452,1.6,11.578,4.249 L46.557,52.078C43.908,48.952,42.308,44.912,42.308,40.5z M60.25,58.439c-4.385,0-8.407-1.579-11.526-4.201l25.265-25.265 c2.622,3.12,4.201,7.141,4.201,11.526C78.189,50.392,70.142,58.439,60.25,58.439z"/> </svg>',
						),
						'above-header-layout-1' => array(
							'label' => __( 'Layout 1', 'smvmt-addon' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"><g><path fill="#0085BA" d="M116.701,80.797H3.799c-1.958,0-3.549-1.593-3.549-3.55V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.957,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.658,80.797,116.701,80.797z M3.799,1.979 c-0.979,0-1.775,0.795-1.775,1.774v73.494c0,0.979,0.796,1.774,1.775,1.774h112.902c0.979,0,1.773-0.795,1.773-1.774V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g><line fill="none" stroke="#0085BA" stroke-miterlimit="10" x1="0.25" y1="21.342" x2="119.535" y2="21.342"/><g><g><path fill="#0085BA" d="M116.701,80.797H3.799c-1.958,0-3.549-1.593-3.549-3.55V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.957,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.658,80.797,116.701,80.797z M3.799,1.979 c-0.979,0-1.775,0.795-1.775,1.774v73.494c0,0.979,0.796,1.774,1.775,1.774h112.902c0.979,0,1.773-0.795,1.773-1.774V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g></g><g><g><g><path fill="#0085BA" d="M61.41,13.6H14.52c-0.98,0-1.774-0.794-1.774-1.774s0.794-1.774,1.774-1.774h46.89 c0.98,0,1.773,0.794,1.773,1.774S62.389,13.6,61.41,13.6z"/></g></g><g><ellipse fill="#0085BA" cx="79.872" cy="11.826" rx="2.228" ry="2.188"/><ellipse fill="#0085BA" cx="88.422" cy="11.826" rx="2.228" ry="2.188"/><ellipse fill="#0085BA" cx="96.974" cy="11.826" rx="2.227" ry="2.188"/><ellipse fill="#0085BA" cx="105.525" cy="11.826" rx="2.229" ry="2.188"/></g></g></svg>',
						),
						'above-header-layout-2' => array(
							'label' => __( 'Layout 2', 'smvmt-addon' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"><g><path fill="#0085BA" d="M116.701,80.797H3.799c-1.958,0-3.549-1.593-3.549-3.55V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.957,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.658,80.797,116.701,80.797z M3.799,1.979 c-0.979,0-1.775,0.795-1.775,1.774v73.494c0,0.979,0.796,1.774,1.775,1.774h112.902c0.979,0,1.773-0.795,1.773-1.774V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g><line fill="none" stroke="#0085BA" stroke-miterlimit="10" x1="0.25" y1="21.342" x2="119.535" y2="21.342"/><g><g><path fill="#0085BA" d="M116.701,80.797H3.799c-1.958,0-3.549-1.593-3.549-3.55V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.957,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.658,80.797,116.701,80.797z M3.799,1.979 c-0.979,0-1.775,0.795-1.775,1.774v73.494c0,0.979,0.796,1.774,1.775,1.774h112.902c0.979,0,1.773-0.795,1.773-1.774V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g></g><g><g><g><path fill="#0085BA" d="M83.695,13.6h-46.89c-0.98,0-1.774-0.794-1.774-1.774s0.794-1.774,1.774-1.774h46.89 c0.98,0,1.773,0.794,1.773,1.774S84.674,13.6,83.695,13.6z"/></g></g></g></svg>',
						),
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-layout-section-1-divider]',
					'type'     => 'control',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'control'  => 'smvmt-divider',
					'section'  => 'section-above-header',
					'title'    => __( 'Section 1', 'smvmt-addon' ),
					'priority' => 5,
					'settings' => array(),
				),

				/**
				 *  Section: Section
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-section-1]',
					'default'  => smvmt_get_option( 'above-header-section-1' ),
					'type'     => 'control',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'control'  => 'select',
					'section'  => 'section-above-header',
					'priority' => 35,
					'choices'  => $sections,
				),

				/**
				 * Option: Text/HTML
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-section-1-html]',
					'section'   => 'section-above-header',
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'above-header-section-1-html' ),
					'priority'  => 50,
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'text-html' ),
						),
					),
					'partial'   => array(
						'selector'            => '.smvmt-above-header-section-1 .user-select  .smvmt-custom-html',
						'container_inclusive' => false,
						'render_callback'     => array( 'SMVMT_Customizer_Header_Sections_Partials', '_render_above_header_section_1_html' ),
					),
					'title'     => __( 'Text/HTML', 'smvmt-addon' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-layout-section-2-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '==', 'above-header-layout-1' ),
					'section'  => 'section-above-header',
					'title'    => __( 'Section 2', 'smvmt-addon' ),
					'priority' => 55,
					'settings' => array(),
				),

				/**
				 * Option: Section 2
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-section-2]',
					'type'     => 'control',
					'control'  => 'select',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '==', 'above-header-layout-1' ),
					'section'  => 'section-above-header',
					'priority' => 60,
					'default'  => smvmt_get_option( 'above-header-section-2' ),
					'choices'  => $sections,
				),

				/**
				 * Option: Text/HTML
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-section-2-html]',
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'section'   => 'section-above-header',
					'default'   => smvmt_get_option( 'above-header-section-2-html' ),
					'priority'  => 75,
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'text-html' ),
						),
					),
					'partial'   => array(
						'selector'            => '.smvmt-above-header-section-2 .user-select .smvmt-custom-html',
						'container_inclusive' => false,
						'render_callback'     => array( 'SMVMT_Customizer_Header_Sections_Partials', '_render_above_header_section_2_html' ),
					),
					'title'     => __( 'Text/HTML', 'smvmt-addon' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[section-smvmt-above-header-border]',
					'type'     => 'control',
					'control'  => 'smvmt-divider',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'section'  => 'section-above-header',
					'priority' => 80,
					'settings' => array(),
				),

				/**
				 * Option: Above Header Height
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[above-header-height]',
					'section'     => 'section-above-header',
					'priority'    => 84,
					'transport'   => 'postMessage',
					'title'       => __( 'Height', 'smvmt-addon' ),
					'default'     => 40,
					'required'    => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'suffix'      => '',
					'input_attrs' => array(
						'min'  => 30,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Above Header Bottom Border
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[above-header-divider]',
					'section'     => 'section-above-header',
					'priority'    => 85,
					'transport'   => 'postMessage',
					'required'    => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'default'     => smvmt_get_option( 'above-header-divider' ),
					'title'       => __( 'Bottom Border', 'smvmt-addon' ),
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Above Header Bottom Border Color
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-divider-color]',
					'type'      => 'control',
					'control'   => 'smvmt-color',
					'transport' => 'postMessage',
					'default'   => '',
					'required'  => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'section'   => 'section-above-header',
					'priority'  => 90,
					'title'     => __( 'Bottom Border Color', 'smvmt-addon' ),
				),

				/**
				 * Option: Header Styling
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-typography-menu-styling-heading]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'section'  => 'section-above-header',
					'title'    => __( 'Typography', 'smvmt-addon' ),
					'priority' => 132,
					'settings' => array(),
					'required' => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Above Header Menu Typography Styling
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-typography-menu-styling]',
					'default'   => smvmt_get_option( 'above-header-typography-menu-styling' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Menu', 'smvmt-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 132,
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Above Header Submenu Typography Styling
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-typography-submenu-styling]',
					'default'   => smvmt_get_option( 'above-header-typography-submenu-styling' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Submenu', 'smvmt-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 132,
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Header Styling
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-colors-and-background]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
					'section'  => 'section-above-header',
					'title'    => __( 'Colors and background', 'smvmt-addon' ),
					'priority' => 131,
					'settings' => array(),
				),

				/**
				 * Option: Above Header Content Section Styling
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-background-styling]',
					'default'   => smvmt_get_option( 'above-header-background-styling' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Background', 'smvmt-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 131,
					'required'  => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '!=', 'disabled' ),
				),

				/**
				 * Option: Above Header Menus Styling
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-menu-colors]',
					'default'   => smvmt_get_option( 'above-header-menu-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Menu', 'smvmt-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 131,
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Above Header Menus Styling
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-submenu-colors]',
					'default'   => smvmt_get_option( 'above-header-submenu-colors' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Submenu', 'smvmt-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 131,
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Above Header Content Section Styling
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-content-section-styling]',
					'default'   => smvmt_get_option( 'above-header-content-section-styling' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt-addon' ),
					'section'   => 'section-above-header',
					'transport' => 'postMessage',
					'priority'  => 131,
					'required'  => array(
						'conditions' => array(
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-1]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
							array(
								SMVMT_THEME_SETTINGS . '[above-header-section-2]',
								'==',
								array( 'search', 'widget', 'text-html', 'edd' ),
							),
						),
						'operator'   => 'OR',
					),
				),

				/**
				 * Option: Above Header Submenu Border Divier
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-submenu-border-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'title'    => __( 'Submenu', 'smvmt-addon' ),
					'required' => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
					'section'  => 'section-above-header',
					'priority' => 95,
					'settings' => array(),
				),

				/**
				 * Option: Submenu Container Animation
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-submenu-container-animation]',
					'default'  => smvmt_get_option( 'above-header-submenu-container-animation' ),
					'type'     => 'control',
					'control'  => 'select',
					'section'  => 'section-above-header',
					'priority' => 95,
					'title'    => __( 'Submenu Container Animation', 'smvmt-addon' ),
					'required' => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
					'choices'  => array(
						''           => __( 'Default', 'smvmt-addon' ),
						'slide-down' => __( 'Slide Down', 'smvmt-addon' ),
						'slide-up'   => __( 'Slide Up', 'smvmt-addon' ),
						'fade'       => __( 'Fade', 'smvmt-addon' ),
					),
				),

				/**
				 * Option: Submenu Border
				 */
				array(
					'name'           => SMVMT_THEME_SETTINGS . '[above-header-submenu-border]',
					'type'           => 'control',
					'control'        => 'smvmt-border',
					'transport'      => 'postMessage',
					'required'       => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
					'section'        => 'section-above-header',
					'default'        => smvmt_get_option( 'above-header-submenu-border' ),
					'title'          => __( 'Container Border', 'smvmt-addon' ),
					'linked_choices' => true,
					'priority'       => 95,
					'choices'        => array(
						'top'    => __( 'Top', 'smvmt-addon' ),
						'right'  => __( 'Right', 'smvmt-addon' ),
						'bottom' => __( 'Bottom', 'smvmt-addon' ),
						'left'   => __( 'Left', 'smvmt-addon' ),
					),
				),

				/**
				 * Option: Submenu Border Color
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-submenu-border-color]',
					'type'      => 'control',
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
					'control'   => 'smvmt-color',
					'default'   => smvmt_get_option( 'above-header-submenu-border-color' ),
					'priority'  => 95,
					'transport' => 'postMessage',
					'section'   => 'section-above-header',
					'title'     => __( 'Border Color', 'smvmt-addon' ),
				),

				/**
				 * Option: Submenu Divider
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-submenu-item-border]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'transport' => 'postMessage',
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
					'section'   => 'section-above-header',
					'default'   => smvmt_get_option( 'above-header-submenu-item-border' ),
					'title'     => __( 'Submenu Divider', 'smvmt-addon' ),
					'priority'  => 95,
				),

				/**
				 * Option: Submenu Border Color
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-submenu-item-b-color]',
					'type'      => 'control',
					'required'  => array(
						SMVMT_THEME_SETTINGS . '[above-header-submenu-item-border]',
						'==',
						true,
					),
					'control'   => 'smvmt-color',
					'default'   => smvmt_get_option( 'above-header-submenu-item-b-color' ),
					'priority'  => 95,
					'transport' => 'postMessage',
					'section'   => 'section-above-header',
					'title'     => __( 'Divider Color', 'smvmt-addon' ),
				),

				/**
				 * Option: Mobile Menu Label Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-mobile-menu-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'required' => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '!=', '' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '!=', '' ),
						),
						'operator'   => 'OR',
					),

					'section'  => 'section-above-header',
					'title'    => __( 'Mobile Header', 'smvmt-addon' ),
					'priority' => 100,
					'settings' => array(),
				),

				/**
				 * Option: Display Above Header on Mobile
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-on-mobile]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => smvmt_get_option( 'above-header-on-mobile' ),
					'section'  => 'section-above-header',
					'title'    => __( 'Display on Mobile Devices', 'smvmt-addon' ),
					'priority' => 101,
				),

				/**
				 * Option: Merged with primary header menu
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[above-header-merge-menu]',
					'default'     => smvmt_get_option( 'above-header-merge-menu' ),
					'type'        => 'control',
					'control'     => 'checkbox',
					'required'    => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '==', 'menu' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '==', 'menu' ),
						),
						'operator'   => 'OR',
					),
					'section'     => 'section-above-header',
					'title'       => __( 'Merge Menu on Mobile Devices', 'smvmt-addon' ),
					'description' => __( 'You can merge menu with primary menu in mobile devices by enabling this option.', 'smvmt-addon' ),
					'priority'    => 101,
				),

				/**
				 * Option: Swap section on mobile devices
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-swap-mobile]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'required' => array( SMVMT_THEME_SETTINGS . '[above-header-layout]', '==', 'above-header-layout-1' ),
					'section'  => 'section-above-header',
					'default'  => smvmt_get_option( 'above-header-section-swap-mobile' ),
					'title'    => __( 'Swap Sections on Mobile Devices', 'smvmt-addon' ),
					'priority' => 101,
				),

				/**
				 * Option: Mobile Menu Alignment
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[above-header-menu-align]',
					'default'  => smvmt_get_option( 'above-header-menu-align' ),
					'section'  => 'section-above-header',
					'priority' => 101,
					'title'    => __( 'Layout', 'smvmt-addon' ),
					'type'     => 'control',
					'control'  => 'smvmt-radio-image',
					'required' => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-section-1]', '!=', '' ),
							array( SMVMT_THEME_SETTINGS . '[above-header-section-2]', '!=', '' ),
						),
						'operator'   => 'OR',
					),
					'choices'  => array(
						'inline' => array(
							'label' => __( 'Inline', 'smvmt-addon' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="60.5px" height="81px" viewBox="0 0 60.5 81" enable-background="new 0 0 60.5 81" xml:space="preserve"><g><g><g><path fill="#0085BA" d="M51.602,12.975H40.884c-0.493,0-0.892-0.429-0.892-0.959c0-0.529,0.396-0.959,0.892-0.959h10.718 c0.496,0,0.896,0.432,0.896,0.959C52.496,12.546,52.098,12.975,51.602,12.975z"/></g></g><g><g><path fill="#0085BA" d="M51.602,17.205H40.884c-0.493,0-0.892-0.429-0.892-0.959c0-0.529,0.396-0.959,0.892-0.959h10.718 c0.496,0,0.896,0.432,0.896,0.959C52.496,16.775,52.098,17.205,51.602,17.205z"/></g></g><g><g><path fill="#0085BA" d="M51.602,21.435H40.884c-0.493,0-0.892-0.429-0.892-0.959c0-0.529,0.396-0.959,0.892-0.959h10.718 c0.496,0,0.896,0.432,0.896,0.959C52.496,21.004,52.098,21.435,51.602,21.435z"/></g></g></g><g><path fill="#0085BA" d="M25.504,20.933c0,1.161-0.794,2.099-1.773,2.099H9.777c-0.979,0-1.773-0.938-1.773-2.099V11.56 c0-1.16,0.795-2.1,1.773-2.1H23.73c0.979,0,1.772,0.94,1.772,2.1L25.504,20.933L25.504,20.933z"/></g><g><path fill="#0085BA" d="M56.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h52.902 c1.956,0,3.549,1.592,3.549,3.549v73.494C60.25,79.204,58.657,80.796,56.701,80.796z M3.799,1.979 c-0.979,0-1.773,0.797-1.773,1.774v73.494c0,0.979,0.795,1.774,1.773,1.774h52.902c0.979,0,1.773-0.797,1.773-1.774V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g></svg>',
						),
						'stack'  => array(
							'label' => __( 'Stack', 'smvmt-addon' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="60.5px" height="81px" viewBox="0 0 60.5 81" enable-background="new 0 0 60.5 81" xml:space="preserve"><g><path fill="#0085BA" d="M56.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h52.902 c1.956,0,3.549,1.592,3.549,3.549v73.494C60.25,79.204,58.657,80.796,56.701,80.796z M3.799,1.979 c-0.979,0-1.773,0.797-1.773,1.774v73.494c0,0.979,0.795,1.774,1.773,1.774h52.902c0.979,0,1.773-0.797,1.773-1.774V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g><g><g><g><path fill="#0085BA" d="M35.607,29.821H24.889c-0.493,0-0.892-0.429-0.892-0.959c0-0.529,0.396-0.959,0.892-0.959h10.718 c0.496,0,0.896,0.432,0.896,0.959C36.502,29.392,36.104,29.821,35.607,29.821z"/></g></g><g><g><path fill="#0085BA" d="M35.607,34.051H24.889c-0.493,0-0.892-0.429-0.892-0.959c0-0.529,0.396-0.959,0.892-0.959h10.718 c0.496,0,0.896,0.432,0.896,0.959C36.502,33.621,36.104,34.051,35.607,34.051z"/></g></g><g><g><path fill="#0085BA" d="M35.607,38.281H24.889c-0.493,0-0.892-0.429-0.892-0.959c0-0.529,0.396-0.959,0.892-0.959h10.718 c0.496,0,0.896,0.432,0.896,0.959C36.502,37.85,36.104,38.281,35.607,38.281z"/></g></g></g><g><path fill="#0085BA" d="M39,20.933c0,1.161-0.794,2.099-1.773,2.099H23.273c-0.979,0-1.773-0.938-1.773-2.099V11.56 c0-1.16,0.795-2.1,1.773-2.1h13.954c0.979,0,1.771,0.94,1.771,2.1L39,20.933L39,20.933z"/></g></svg>',
						),
					),
				),

				/**
				 * Option: Mobile Menu Label
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[above-header-menu-label]',
					'type'      => 'control',
					'control'   => 'text',
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[above-header-on-mobile]', '==', true ),
							array( SMVMT_THEME_SETTINGS . '[above-header-merge-menu]', '!=', true ),
						),
					),
					'section'   => 'section-above-header',
					'default'   => smvmt_get_option( 'above-header-menu-label' ),
					'transport' => 'postMessage',
					'priority'  => 101,
					'title'     => __( 'Menu Label', 'smvmt-addon' ),
				),
			);

			return array_merge( $configurations, $_config );
		}

	}
}

new SMVMT_Above_Header_Configs();
