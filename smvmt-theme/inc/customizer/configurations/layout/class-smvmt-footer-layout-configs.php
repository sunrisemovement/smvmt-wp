<?php
/**
 * Bottom Footer Options for smvmt Theme.
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

if ( ! class_exists( 'SMVMT_Footer_Layout_Configs' ) ) {

	/**
	 * Register Footer Layout Configurations.
	 */
	class SMVMT_Footer_Layout_Configs extends SMVMT_Customizer_Config_Base {

		/**
		 * Register Footer Layout Configurations.
		 *
		 * @param Array                $configurations smvmt Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array smvmt Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$_configs = array(

				/**
				 * Option: Footer Bar Layout
				 */

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[footer-sml-layout]',
					'type'     => 'control',
					'control'  => 'smvmt-radio-image',
					'default'  => smvmt_get_option( 'footer-sml-layout' ),
					'section'  => 'section-footer-small',
					'priority' => 5,
					'title'    => __( 'Layout', 'smvmt' ),
					'choices'  => array(
						'disabled'            => array(
							'label' => __( 'Disabled', 'smvmt' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"> <g> <g> <path fill="#0085BA" d="M116.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.956,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.657,80.796,116.701,80.796z M3.799,1.979 c-0.979,0-1.773,0.797-1.773,1.774v73.494c0,0.979,0.795,1.772,1.773,1.772h112.902c0.979,0,1.773-0.797,1.773-1.772V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/> </g> </g> <path fill="#0085BA" d="M60.25,19.5c-11.581,0-21,9.419-21,21c0,11.578,9.419,21,21,21c11.578,0,21-9.422,21-21 C81.25,28.919,71.828,19.5,60.25,19.5z M42.308,40.5c0-9.892,8.05-17.942,17.942-17.942c4.412,0,8.452,1.6,11.578,4.249 L46.557,52.078C43.908,48.952,42.308,44.912,42.308,40.5z M60.25,58.439c-4.385,0-8.407-1.579-11.526-4.201l25.265-25.265 c2.622,3.12,4.201,7.141,4.201,11.526C78.189,50.392,70.142,58.439,60.25,58.439z"/> </svg>',
						),
						'footer-sml-layout-1' => array(
							'label' => __( 'Footer Bar Layout 1', 'smvmt' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"><g><path fill="#0085BA" d="M3.799,0.204h112.902c1.958,0,3.549,1.593,3.549,3.55v73.494c0,1.957-1.592,3.549-3.549,3.549H3.799 c-1.957,0-3.549-1.592-3.549-3.549V3.754C0.25,1.797,1.842,0.204,3.799,0.204z M116.701,79.021c0.979,0,1.774-0.795,1.774-1.773 l0.001-73.494c0-0.979-0.797-1.774-1.775-1.774H3.799c-0.979,0-1.773,0.795-1.773,1.774v73.494c0,0.979,0.795,1.773,1.773,1.773 H116.701z"/></g><line fill="none" stroke="#0085BA" stroke-miterlimit="10" x1="120.25" y1="58.659" x2="0.965" y2="58.659"/><g><g><path fill="#0085BA" d="M26.805,64.475h66.89c0.98,0,1.774,0.628,1.774,1.4s-0.794,1.4-1.774,1.4h-66.89 c-0.98,0-1.773-0.628-1.773-1.4C25.031,65.102,25.826,64.475,26.805,64.475z"/></g></g><g><ellipse fill="#0085BA" cx="72.604" cy="72.174" rx="2.146" ry="2.108"/><ellipse fill="#0085BA" cx="64.37" cy="72.174" rx="2.147" ry="2.108"/><ellipse fill="#0085BA" cx="56.132" cy="72.174" rx="2.145" ry="2.108"/><ellipse fill="#0085BA" cx="47.896" cy="72.174" rx="2.146" ry="2.108"/></g></svg>',
						),
						'footer-sml-layout-2' => array(
							'label' => __( 'Footer Bar Layout 2', 'smvmt' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"><g><path fill="#0085BA" d="M120.25,3.754v73.494c0,1.957-1.592,3.549-3.549,3.549H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.754 c0-1.957,1.591-3.55,3.549-3.55h112.902C118.658,0.204,120.25,1.797,120.25,3.754z M116.701,79.021 c0.979,0,1.773-0.795,1.773-1.773V3.754c0-0.979-0.795-1.774-1.773-1.774H3.799c-0.979,0-1.775,0.795-1.775,1.774l0.001,73.494 c0,0.979,0.796,1.773,1.774,1.773H116.701z"/></g><g><g><path fill="#0085BA" d="M120.25,3.754v73.494c0,1.957-1.592,3.549-3.549,3.549H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.754 c0-1.957,1.591-3.55,3.549-3.55h112.902C118.658,0.204,120.25,1.797,120.25,3.754z M116.701,79.021 c0.979,0,1.773-0.795,1.773-1.773V3.754c0-0.979-0.795-1.774-1.773-1.774H3.799c-0.979,0-1.775,0.795-1.775,1.774l0.001,73.494 c0,0.979,0.796,1.773,1.774,1.773H116.701z"/></g></g><g><g><g><path fill="#0085BA" d="M63.184,69.175c0,0.979-0.793,1.774-1.773,1.774h-46.89c-0.98,0-1.774-0.795-1.774-1.774 S13.54,67.4,14.521,67.4h46.89C62.389,67.4,63.184,68.194,63.184,69.175z"/></g></g><g><ellipse fill="#0085BA" cx="79.872" cy="69.175" rx="2.228" ry="2.188"/><ellipse fill="#0085BA" cx="88.422" cy="69.175" rx="2.229" ry="2.188"/><ellipse fill="#0085BA" cx="96.974" cy="69.175" rx="2.227" ry="2.188"/><ellipse fill="#0085BA" cx="105.525" cy="69.175" rx="2.229" ry="2.188"/></g></g><line fill="none" stroke="#0085BA" stroke-miterlimit="10" x1="120.25" y1="58.659" x2="0.965" y2="58.659"/></svg>',
						),
					),
					'partial'  => array(
						'selector'            => '.smvmt-small-footer',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[section-smvmt-small-footer-layout-info]',
					'control'  => 'smvmt-divider',
					'type'     => 'control',
					'required' => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
					'section'  => 'section-footer-small',
					'priority' => 10,
					'settings' => array(),
				),

				/**
				 *  Section: Section 1
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[footer-sml-section-1]',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'footer-sml-section-1' ),
					'type'     => 'control',
					'required' => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
					'section'  => 'section-footer-small',
					'priority' => 15,
					'title'    => __( 'Section 1', 'smvmt' ),
					'choices'  => array(
						''       => __( 'None', 'smvmt' ),
						'custom' => __( 'Text', 'smvmt' ),
						'widget' => __( 'Widget', 'smvmt' ),
						'menu'   => __( 'Footer Menu', 'smvmt' ),
					),
					'partial'  => array(
						'selector'            => '.smvmt-small-footer .smvmt-container .smvmt-footer-widget-1-area .smvmt-no-widget-row, .smvmt-small-footer .smvmt-container .smvmt-small-footer-section-1 .footer-primary-navigation .nav-menu',
						'container_inclusive' => false,
					),
				),
				/**
				 * Option: Section 1 Custom Text
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-sml-section-1-credit]',
					'default'   => smvmt_get_option( 'footer-sml-section-1-credit' ),
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'section'   => 'section-footer-small',
					'required'  => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[footer-sml-section-1]', '==', array( 'custom' ) ),
						),
					),
					'priority'  => 20,
					'title'     => __( 'Section 1 Custom Text', 'smvmt' ),
					'choices'   => array(
						''       => __( 'None', 'smvmt' ),
						'custom' => __( 'Custom Text', 'smvmt' ),
						'widget' => __( 'Widget', 'smvmt' ),
						'menu'   => __( 'Footer Menu', 'smvmt' ),
					),
					'partial'   => array(
						'selector'            => '.smvmt-small-footer .smvmt-container .smvmt-small-footer-section.smvmt-small-footer-section-1:has(> .smvmt-footer-site-title)',
						'container_inclusive' => false,
						'render_callback'     => array( 'SMVMT_Customizer_Partials', 'render_footer_sml_section_1_credit' ),
					),
				),

				/**
				 * Option: Section 2
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[footer-sml-section-2]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'footer-sml-section-2' ),
					'required' => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
					'section'  => 'section-footer-small',
					'priority' => 25,
					'title'    => __( 'Section 2', 'smvmt' ),
					'choices'  => array(
						''       => __( 'None', 'smvmt' ),
						'custom' => __( 'Text', 'smvmt' ),
						'widget' => __( 'Widget', 'smvmt' ),
						'menu'   => __( 'Footer Menu', 'smvmt' ),
					),
					'partial'  => array(
						'selector'            => '.smvmt-small-footer .smvmt-container .smvmt-footer-widget-2-area .smvmt-no-widget-row, .smvmt-small-footer .smvmt-container .smvmt-small-footer-section-2 .footer-primary-navigation .nav-menu',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Section 2 Custom Text
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-sml-section-2-credit]',
					'type'      => 'control',
					'control'   => 'textarea',
					'transport' => 'postMessage',
					'default'   => smvmt_get_option( 'footer-sml-section-2-credit' ),
					'section'   => 'section-footer-small',
					'priority'  => 30,
					'required'  => array( SMVMT_THEME_SETTINGS . '[footer-sml-section-2]', '==', 'custom' ),
					'title'     => __( 'Section 2 Custom Text', 'smvmt' ),
					'partial'   => array(
						'selector'            => '.smvmt-small-footer-section-2',
						'container_inclusive' => false,
						'render_callback'     => array( 'SMVMT_Customizer_Partials', 'render_footer_sml_section_2_credit' ),
					),
					'partial'   => array(
						'selector'            => '.smvmt-small-footer .smvmt-container .smvmt-small-footer-section.smvmt-small-footer-section-2:has(> .smvmt-footer-site-title)',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[section-smvmt-small-footer-typography]',
					'control'  => 'smvmt-divider',
					'type'     => 'control',
					'section'  => 'section-footer-small',
					'required' => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
					'priority' => 35,
					'settings' => array(),
				),

				/**
				 * Option: Footer Top Border
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[footer-sml-divider]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'default'     => smvmt_get_option( 'footer-sml-divider' ),
					'section'     => 'section-footer-small',
					'priority'    => 40,
					'required'    => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
					'title'       => __( 'Border Size', 'smvmt' ),
					'transport'   => 'postMessage',
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Footer Top Border Color
				 */

				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-sml-divider-color]',
					'section'   => 'section-footer-small',
					'default'   => '#7a7a7a',
					'type'      => 'control',
					'control'   => 'smvmt-color',
					'required'  => array( SMVMT_THEME_SETTINGS . '[footer-sml-divider]', '>=', 1 ),
					'priority'  => 45,
					'title'     => __( 'Border Color', 'smvmt' ),
					'transport' => 'postMessage',
				),

				/**
				 * Option: Footer Bar Color & Background Section heading
				 */
				array(
					'name'     => SMVMT_THEME_SETTINGS . '[footer-bar-color-background-heading-divider]',
					'type'     => 'control',
					'control'  => 'smvmt-heading',
					'section'  => 'section-footer-small',
					'title'    => __( 'Colors & Background', 'smvmt' ),
					'priority' => 46,
					'settings' => array(),
					'required' => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
				),

				/**
				 * Option: Footer Bar Content Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-bar-background-group]',
					'default'   => smvmt_get_option( 'footer-bar-background-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Background', 'smvmt' ),
					'section'   => 'section-footer-small',
					'transport' => 'postMessage',
					'priority'  => 47,
					'required'  => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
				),

				/**
				 * Option: Footer Bar Content Group
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-bar-content-group]',
					'default'   => smvmt_get_option( 'footer-bar-content-group' ),
					'type'      => 'control',
					'control'   => 'smvmt-settings-group',
					'title'     => __( 'Content', 'smvmt' ),
					'section'   => 'section-footer-small',
					'transport' => 'postMessage',
					'priority'  => 47,
					'required'  => array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
				),

				/**
				 * Option: Header Width
				 */

				array(
					'name'     => SMVMT_THEME_SETTINGS . '[footer-layout-width]',
					'type'     => 'control',
					'control'  => 'select',
					'default'  => smvmt_get_option( 'footer-layout-width' ),
					'section'  => 'section-footer-small',
					'required' => array(
						'conditions' => array(
							array( SMVMT_THEME_SETTINGS . '[site-layout]', '!=', 'smvmt-box-layout' ),
							array( SMVMT_THEME_SETTINGS . '[site-layout]', '!=', 'smvmt-fluid-width-layout' ),
							array( SMVMT_THEME_SETTINGS . '[footer-sml-layout]', '!=', 'disabled' ),
						),
					),
					'priority' => 35,
					'title'    => __( 'Width', 'smvmt' ),
					'choices'  => array(
						'full'    => __( 'Full Width', 'smvmt' ),
						'content' => __( 'Content Width', 'smvmt' ),
					),
				),

				/**
				 * Option: Footer Widgets Layout Layout
				 */
				array(
					'name'    => SMVMT_THEME_SETTINGS . '[footer-adv]',
					'type'    => 'control',
					'control' => 'smvmt-radio-image',
					'default' => smvmt_get_option( 'footer-adv' ),
					'title'   => __( 'Layout', 'smvmt' ),
					'section' => 'section-footer-adv',
					'choices' => array(
						'disabled' => array(
							'label' => __( 'Disable', 'smvmt' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"> <g> <g> <path fill="#0085BA" d="M116.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.956,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.657,80.796,116.701,80.796z M3.799,1.979 c-0.979,0-1.773,0.797-1.773,1.774v73.494c0,0.979,0.795,1.772,1.773,1.772h112.902c0.979,0,1.773-0.797,1.773-1.772V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/> </g> </g> <path fill="#0085BA" d="M60.25,19.5c-11.581,0-21,9.419-21,21c0,11.578,9.419,21,21,21c11.578,0,21-9.422,21-21 C81.25,28.919,71.828,19.5,60.25,19.5z M42.308,40.5c0-9.892,8.05-17.942,17.942-17.942c4.412,0,8.452,1.6,11.578,4.249 L46.557,52.078C43.908,48.952,42.308,44.912,42.308,40.5z M60.25,58.439c-4.385,0-8.407-1.579-11.526-4.201l25.265-25.265 c2.622,3.12,4.201,7.141,4.201,11.526C78.189,50.392,70.142,58.439,60.25,58.439z"/> </svg>',
						),
						'layout-4' => array(
							'label' => __( 'Layout 4', 'smvmt' ),
							'path'  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" role="img" id="Layer_1" x="0px" y="0px" width="120.5px" height="81px" viewBox="0 0 120.5 81" enable-background="new 0 0 120.5 81" xml:space="preserve"><g><g><g><g><path fill="#0085BA" d="M116.701,80.796H3.799c-1.957,0-3.549-1.592-3.549-3.549V3.753c0-1.957,1.592-3.549,3.549-3.549h112.902 c1.956,0,3.549,1.592,3.549,3.549v73.494C120.25,79.204,118.657,80.796,116.701,80.796z M3.799,1.979 c-0.979,0-1.773,0.797-1.773,1.774v73.494c0,0.979,0.795,1.772,1.773,1.772h112.902c0.979,0,1.773-0.797,1.773-1.772V3.753 c0-0.979-0.795-1.774-1.773-1.774H3.799z"/></g></g></g></g><g><path fill="#0085BA" d="M28.064,70c0,1.657-1.354,3-3.023,3H12.458c-1.669,0-3.023-1.343-3.023-3V58.25c0-1.656,1.354-3,3.023-3 h12.583c1.67,0,3.023,1.344,3.023,3V70z"/></g><g><path fill="#0085BA" d="M55.731,70c0,1.657-1.354,3-3.023,3H40.125c-1.669,0-3.023-1.343-3.023-3V58.25c0-1.656,1.354-3,3.023-3 h12.583c1.67,0,3.023,1.344,3.023,3V70z"/></g><g><path fill="#0085BA" d="M83.397,70c0,1.657-1.354,3-3.023,3H67.791c-1.669,0-3.022-1.343-3.022-3V58.25c0-1.656,1.354-3,3.022-3 h12.583c1.67,0,3.023,1.344,3.023,3V70z"/></g><g><path fill="#0085BA" d="M111.064,70c0,1.657-1.354,3-3.023,3H95.458c-1.669,0-3.022-1.343-3.022-3V58.25c0-1.656,1.354-3,3.022-3 h12.583c1.67,0,3.023,1.344,3.023,3V70z"/></g><g><rect x="0.607" y="48" fill="#0085BA" width="119.285" height="1"/></g></svg>',
						),
					),
					'partial' => array(
						'selector'            => '.footer-adv .smvmt-container',
						'container_inclusive' => false,
					),
				),

				/**
				 * Option: Footer Top Border
				 */
				array(
					'name'        => SMVMT_THEME_SETTINGS . '[footer-adv-border-width]',
					'type'        => 'control',
					'control'     => 'smvmt-slider',
					'transport'   => 'postMessage',
					'section'     => 'section-footer-adv',
					'default'     => smvmt_get_option( 'footer-adv-border-width' ),
					'priority'    => 40,
					'required'    => array( SMVMT_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
					'title'       => __( 'Top Border Size', 'smvmt' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Footer Top Border Color
				 */
				array(
					'name'      => SMVMT_THEME_SETTINGS . '[footer-adv-border-color]',
					'section'   => 'section-footer-adv',
					'title'     => __( 'Top Border Color', 'smvmt' ),
					'type'      => 'control',
					'transport' => 'postMessage',
					'control'   => 'smvmt-color',
					'default'   => smvmt_get_option( 'footer-adv-border-color' ),
					'required'  => array( SMVMT_THEME_SETTINGS . '[footer-adv]', '!=', 'disabled' ),
					'priority'  => 45,
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
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-footer-widget-more-feature-divider]',
						'type'     => 'control',
						'control'  => 'smvmt-divider',
						'section'  => 'section-footer-adv',
						'priority' => 999,
						'settings' => array(),
					),

					/**
					 * Option: Learn More about Footer Widget
					 */
					array(
						'name'     => SMVMT_THEME_SETTINGS . '[smvmt-footer-widget-more-feature-description]',
						'type'     => 'control',
						'control'  => 'smvmt-description',
						'section'  => 'section-footer-adv',
						'priority' => 999,
						'label'    => '',
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


new SMVMT_Footer_Layout_Configs();





