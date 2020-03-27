<?php
/**
 * smvmt Theme Customizer
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Customizer Loader
 */
if ( ! class_exists( 'SMVMT_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Customizer Configurations.
		 *
		 * @access Private
		 * @since 1.4.3
		 * @var Array
		 */
		private static $configuration;

		/**
		 * All groups parent-child relation array data.
		 *
		 * @access Public
		 * @since 2.0.0
		 * @var Array
		 */
		public static $group_configs = array();

		/**
		 * Customizer controls data.
		 *
		 * @access Public
		 * @since 2.0.0
		 * @var Array
		 */
		public $control_types = array();

		/**
		 * Customizer Dependency Array.
		 *
		 * @access Private
		 * @since 1.4.3
		 * @var array
		 */
		private static $dependency_arr = array();


		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {

			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init', array( $this, 'preview_init' ) );

			if ( is_admin() || is_customize_preview() ) {
				add_action( 'customize_register', array( $this, 'include_configurations' ), 2 );
				add_action( 'customize_register', array( $this, 'register_customizer_settings' ) );
			}

			add_action( 'customize_controls_enqueue_scripts', array( $this, 'controls_scripts' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'print_footer_scripts' ) );
			add_action( 'customize_register', array( $this, 'customize_register_panel' ), 2 );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_save_after', array( $this, 'customize_save' ) );
			add_action( 'wp_head', array( $this, 'preview_styles' ) );
		}

		/**
		 * Process and Register Customizer Panels, Sections, Settings and Controls.
		 *
		 * @param WP_Customize_Manager $wp_customize Reference to WP_Customize_Manager.
		 * @since 1.4.3
		 * @return void
		 */
		public function register_customizer_settings( $wp_customize ) {

			$configurations = $this->get_customizer_configurations( $wp_customize );

			foreach ( $configurations as $key => $config ) {
				$config = wp_parse_args( $config, $this->get_SMVMT_customizer_configuration_defaults() );

				switch ( $config['type'] ) {

					case 'panel':
						// Remove type from configuration.
						unset( $config['type'] );

						$this->register_panel( $config, $wp_customize );

						break;

					case 'section':
						// Remove type from configuration.
						unset( $config['type'] );

						$this->register_section( $config, $wp_customize );

						break;

					case 'sub-control':
						// Remove type from configuration.
						unset( $config['type'] );

						$this->register_sub_control_setting( $config, $wp_customize );

						break;

					case 'control':
						// Remove type from configuration.
						unset( $config['type'] );

						$this->register_setting_control( $config, $wp_customize );

						break;
				}
			}
		}

		/**
		 * Check if string is start with a string provided.
		 *
		 * @param string $string main string.
		 * @param string $start_string string to search.
		 * @since 2.0.0
		 * @return bool.
		 */
		public function starts_with( $string, $start_string ) {
			$len = strlen( $start_string );
			return ( substr( $string, 0, $len ) === $start_string );
		}

		/**
		 * Filter and return Customizer Configurations.
		 *
		 * @param WP_Customize_Manager $wp_customize Reference to WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Customizer Configurations for registering Sections/Panels/Controls.
		 */
		private function get_customizer_configurations( $wp_customize ) {
			if ( ! is_null( self::$configuration ) ) {
				return self::$configuration;
			}

			return apply_filters( 'SMVMT_customizer_configurations', array(), $wp_customize );
		}

		/**
		 * Return default values for the Customize Configurations.
		 *
		 * @since 1.4.3
		 * @return Array default values for the Customizer Configurations.
		 */
		private function get_SMVMT_customizer_configuration_defaults() {
			return apply_filters(
				'SMVMT_customizer_configuration_defaults',
				array(
					'priority'             => null,
					'title'                => null,
					'label'                => null,
					'name'                 => null,
					'type'                 => null,
					'description'          => null,
					'capability'           => null,
					'datastore_type'       => 'option', // theme_mod or option. Default option.
					'settings'             => null,
					'active_callback'      => null,
					'sanitize_callback'    => null,
					'sanitize_js_callback' => null,
					'theme_supports'       => null,
					'transport'            => null,
					'default'              => null,
					'selector'             => null,
					'smvmt_fields'           => array(),
				)
			);
		}

		/**
		 * Register Customizer Panel.
		 *
		 * @param Array                $config Panel Configuration settings.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return void
		 */
		private function register_panel( $config, $wp_customize ) {
			$wp_customize->add_panel( new SMVMT_WP_Customize_Panel( $wp_customize, smvmt_get_prop( $config, 'name' ), $config ) );
		}

		/**
		 * Register Customizer Section.
		 *
		 * @param Array                $config Panel Configuration settings.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return void
		 */
		private function register_section( $config, $wp_customize ) {

			$callback = smvmt_get_prop( $config, 'section_callback', 'SMVMT_WP_Customize_Section' );

			$wp_customize->add_section( new $callback( $wp_customize, smvmt_get_prop( $config, 'name' ), $config ) );
		}

		/**
		 * Register Customizer Control and Setting.
		 *
		 * @param Array                $control_config Panel Configuration settings.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 2.0.0
		 * @return void
		 */
		private function register_sub_control_setting( $control_config, $wp_customize ) {

			$sub_control_name = SMVMT_THEME_SETTINGS . '[' . smvmt_get_prop( $control_config, 'name' ) . ']';

			if ( isset( $wp_customize->get_control( $sub_control_name )->id ) ) {
				return;
			}

			$parent = smvmt_get_prop( $control_config, 'parent' );
			$tab    = smvmt_get_prop( $control_config, 'tab' );

			if ( empty( self::$group_configs[ $parent ] ) ) {
				self::$group_configs[ $parent ] = array();
			}

			if ( array_key_exists( 'tab', $control_config ) ) {
				self::$group_configs[ $parent ]['tabs'][ $tab ][] = $control_config;
			} else {
				self::$group_configs[ $parent ][] = $control_config;
			}

			$config = array(
				'name'              => $sub_control_name,
				'datastore_type'    => 'option',
				'transport'         => 'postMessage',
				'control'           => 'smvmt-hidden',
				'section'           => smvmt_get_prop( $control_config, 'section', 'title_tagline' ),
				'default'           => smvmt_get_prop( $control_config, 'default' ),
				'sanitize_callback' => smvmt_get_prop( $control_config, 'sanitize_callback', SMVMT_Customizer_Control_Base::get_sanitize_call( smvmt_get_prop( $control_config, 'control' ) ) ),
			);

			$wp_customize->add_setting(
				smvmt_get_prop( $config, 'name' ),
				array(
					'default'           => smvmt_get_prop( $config, 'default' ),
					'type'              => smvmt_get_prop( $config, 'datastore_type' ),
					'transport'         => smvmt_get_prop( $config, 'transport', 'refresh' ),
					'sanitize_callback' => smvmt_get_prop( $config, 'sanitize_callback', SMVMT_Customizer_Control_Base::get_sanitize_call( smvmt_get_prop( $config, 'control' ) ) ),
				)
			);

			$instance = SMVMT_Customizer_Control_Base::get_control_instance( smvmt_get_prop( $config, 'control' ) );

			if ( false !== $instance ) {
				$wp_customize->add_control(
					new $instance( $wp_customize, $sub_control_name, $config )
				);
			} else {
				$wp_customize->add_control( $sub_control_name, $config );
			}
		}

		/**
		 * Register Customizer Control and Setting.
		 *
		 * @param Array                $config Panel Configuration settings.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return void
		 */
		private function register_setting_control( $config, $wp_customize ) {

			if ( 'smvmt-settings-group' === $config['control'] ) {
				$callback = false;
			} else {
				$callback = smvmt_get_prop( $config, 'sanitize_callback', SMVMT_Customizer_Control_Base::get_sanitize_call( smvmt_get_prop( $config, 'control' ) ) );
			}

			$wp_customize->add_setting(
				smvmt_get_prop( $config, 'name' ),
				array(
					'default'           => smvmt_get_prop( $config, 'default' ),
					'type'              => smvmt_get_prop( $config, 'datastore_type' ),
					'transport'         => smvmt_get_prop( $config, 'transport', 'refresh' ),
					'sanitize_callback' => $callback,
				)
			);

			$instance = SMVMT_Customizer_Control_Base::get_control_instance( smvmt_get_prop( $config, 'control' ) );

			$config['label'] = smvmt_get_prop( $config, 'title' );
			$config['type']  = smvmt_get_prop( $config, 'control' );

			// For smvmt-font control font-weight and font-family is passed as param `font-type` which needs to be converted to `type`.
			if ( false !== smvmt_get_prop( $config, 'font-type', false ) ) {
				$config['type'] = smvmt_get_prop( $config, 'font-type', false );
			}

			if ( false !== $instance ) {
				$wp_customize->add_control(
					new $instance( $wp_customize, smvmt_get_prop( $config, 'name' ), $config )
				);
			} else {
				$wp_customize->add_control( smvmt_get_prop( $config, 'name' ), $config );
			}

			if ( smvmt_get_prop( $config, 'partial', false ) ) {

				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial(
						smvmt_get_prop( $config, 'name' ),
						array(
							'selector'            => smvmt_get_prop( $config['partial'], 'selector' ),
							'container_inclusive' => smvmt_get_prop( $config['partial'], 'container_inclusive' ),
							'render_callback'     => smvmt_get_prop( $config['partial'], 'render_callback' ),
						)
					);
				}
			}

			if ( false !== smvmt_get_prop( $config, 'required', false ) ) {
				$this->update_dependency_arr( smvmt_get_prop( $config, 'name' ), smvmt_get_prop( $config, 'required' ) );
			}

		}

		/**
		 * Update dependency in the dependency array.
		 *
		 * @param String $key name of the Setting/Control for which the dependency is added.
		 * @param Array  $dependency dependency of the $name Setting/Control.
		 * @since 1.4.3
		 * @return void
		 */
		private function update_dependency_arr( $key, $dependency ) {
			self::$dependency_arr[ $key ] = $dependency;
		}

		/**
		 * Get dependency Array.
		 *
		 * @since 1.4.3
		 * @return Array Dependencies discovered when registering controls and settings.
		 */
		private function get_dependency_arr() {
			return self::$dependency_arr;
		}

		/**
		 * Include Customizer Configuration files.
		 *
		 * @since 1.4.3
		 * @return void
		 */
		public function include_configurations() {
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/class-smvmt-customizer-config-base.php';

			/**
			 * Register Sections & Panels
			 */
			require SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-customizer-register-sections-panels.php';

			require SMVMT_THEME_DIR . 'inc/customizer/configurations/buttons/class-smvmt-customizer-button-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-site-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-header-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-site-identity-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-blog-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-blog-single-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-sidebar-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-site-container-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/layout/class-smvmt-footer-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/colors-background/class-smvmt-body-colors-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/colors-background/class-smvmt-footer-colors-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/colors-background/class-smvmt-advanced-footer-colors-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/typography/class-smvmt-archive-typo-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/typography/class-smvmt-body-typo-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/typography/class-smvmt-content-typo-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/typography/class-smvmt-header-typo-configs.php';
			require SMVMT_THEME_DIR . 'inc/customizer/configurations/typography/class-smvmt-single-typo-configs.php';

		}

		/**
		 * Print Footer Scripts
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function print_footer_scripts() {
			$output  = '<script type="text/javascript">';
			$output .= '
	        	wp.customize.bind(\'ready\', function() {
	            	wp.customize.control.each(function(ctrl, i) {
	                	var desc = ctrl.container.find(".customize-control-description");
	                	if( desc.length) {
	                    	var title 		= ctrl.container.find(".customize-control-title");
	                    	var li_wrapper 	= desc.closest("li");
	                    	var tooltip = desc.text().replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
	                    			return \'&#\'+i.charCodeAt(0)+\';\';
								});
	                    	desc.remove();
	                    	li_wrapper.append(" <i class=\'smvmt-control-tooltip dashicons dashicons-editor-help\'title=\'" + tooltip +"\'></i>");
	                	}
	            	});
	        	});';

			$output .= SMVMT_Fonts_Data::js();
			$output .= '</script>';

			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}

		/**
		 * Register custom section and panel.
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register_panel( $wp_customize ) {

			/**
			 * Register Extended Panel
			 */
			$wp_customize->register_panel_type( 'SMVMT_WP_Customize_Panel' );
			$wp_customize->register_section_type( 'SMVMT_WP_Customize_Section' );
			$wp_customize->register_section_type( 'SMVMT_WP_Customize_Separator' );

			require SMVMT_THEME_DIR . 'inc/customizer/extend-customizer/class-smvmt-wp-customize-panel.php';
			require SMVMT_THEME_DIR . 'inc/customizer/extend-customizer/class-smvmt-wp-customize-section.php';
			require SMVMT_THEME_DIR . 'inc/customizer/extend-customizer/class-smvmt-wp-customize-separator.php';
			require SMVMT_THEME_DIR . 'inc/customizer/customizer-controls.php';

			/**
			 * Add Controls
			 */

			SMVMT_Customizer_Control_Base::add_control(
				'color',
				array(
					'callback'          => 'WP_Customize_Color_Control',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_hex_color' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-sortable',
				array(
					'callback'          => 'SMVMT_Control_Sortable',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_multi_choices' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-radio-image',
				array(
					'callback'          => 'SMVMT_Control_Radio_Image',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_choices' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-slider',
				array(
					'callback'          => 'SMVMT_Control_Slider',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-responsive-slider',
				array(
					'callback'          => 'SMVMT_Control_Responsive_Slider',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_responsive_slider' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-responsive',
				array(
					'callback'          => 'SMVMT_Control_Responsive',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_responsive_typo' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-responsive-spacing',
				array(
					'callback'          => 'SMVMT_Control_Responsive_Spacing',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_responsive_spacing' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-divider',
				array(
					'callback'          => 'SMVMT_Control_Divider',
					'sanitize_callback' => '',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-heading',
				array(
					'callback'          => 'SMVMT_Control_Heading',
					'sanitize_callback' => '',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-hidden',
				array(
					'callback'          => 'SMVMT_Control_Hidden',
					'sanitize_callback' => '',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-link',
				array(
					'callback'          => 'SMVMT_Control_Link',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_link' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-color',
				array(
					'callback'          => 'SMVMT_Control_Color',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_alpha_color' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-description',
				array(
					'callback'          => 'SMVMT_Control_Description',
					'sanitize_callback' => '',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-background',
				array(
					'callback'          => 'SMVMT_Control_Background',
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_background_obj' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'image',
				array(
					'callback'          => 'WP_Customize_Image_Control',
					'sanitize_callback' => 'esc_url_raw',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-font',
				array(
					'callback'          => 'SMVMT_Control_Typography',
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'number',
				array(
					'sanitize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_number' ),
				)
			);
			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-border',
				array(
					'callback'         => 'SMVMT_Control_Border',
					'santize_callback' => 'sanitize_border',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-responsive-color',
				array(
					'callback'         => 'SMVMT_Control_Responsive_Color',
					'santize_callback' => 'sanitize_responsive_color',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-customizer-link',
				array(
					'callback'         => 'SMVMT_Control_Customizer_Link',
					'santize_callback' => array( 'SMVMT_Customizer_Sanitizes', 'sanitize_customizer_links' ),
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-settings-group',
				array(
					'callback' => 'SMVMT_Control_Settings_Group',
				)
			);

			SMVMT_Customizer_Control_Base::add_control(
				'smvmt-select',
				array(
					'callback'          => 'SMVMT_Control_Select',
					'sanitize_callback' => '',
				)
			);

			/**
			 * Helper files
			 */
			require SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-customizer-partials.php';
			require SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-customizer-callback.php';
			require SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-customizer-sanitizes.php';
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @since 1.0.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			/**
			 * Override Defaults
			 */
			require SMVMT_THEME_DIR . 'inc/customizer/override-defaults.php';

		}

		/**
		 * Customizer Controls
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function controls_scripts() {

			$js_prefix  = '.min.js';
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			if ( is_rtl() ) {
				$css_prefix = '.min-rtl.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'smvmt-color-alpha' );

			wp_enqueue_script( 'thickbox' );
			wp_enqueue_style( 'thickbox' );

			// Customizer Core.
			wp_enqueue_script( 'smvmt-customizer-controls-toggle-js', SMVMT_THEME_URI . 'assets/js/' . $dir . '/customizer-controls-toggle' . $js_prefix, array(), SMVMT_THEME_VERSION, true );

			// Extended Customizer Assets - Panel extended.
			wp_enqueue_style( 'smvmt-extend-customizer-css', SMVMT_THEME_URI . 'assets/css/' . $dir . '/extend-customizer' . $css_prefix, null, SMVMT_THEME_VERSION );
			wp_enqueue_script( 'smvmt-extend-customizer-js', SMVMT_THEME_URI . 'assets/js/' . $dir . '/extend-customizer' . $js_prefix, array(), SMVMT_THEME_VERSION, true );

			wp_enqueue_script( 'smvmt-customizer-dependency', SMVMT_THEME_URI . 'assets/js/' . $dir . '/customizer-dependency' . $js_prefix, array( 'smvmt-customizer-controls-js' ), SMVMT_THEME_VERSION, true );

			// Customizer Controls.
			wp_enqueue_style( 'smvmt-customizer-controls-css', SMVMT_THEME_URI . 'assets/css/' . $dir . '/customizer-controls' . $css_prefix, null, SMVMT_THEME_VERSION );
			wp_enqueue_script( 'smvmt-customizer-controls-js', SMVMT_THEME_URI . 'assets/js/' . $dir . '/customizer-controls' . $js_prefix, array( 'smvmt-customizer-controls-toggle-js' ), SMVMT_THEME_VERSION, true );

			$google_fonts = SMVMT_Font_Families::get_google_fonts();
			$string       = $this->generate_font_dropdown();

			$tmpl = '<div class="smvmt-field-settings-modal">
					<ul class="smvmt-fields-wrap">
					</ul>
			</div>';

			wp_localize_script(
				'smvmt-customizer-controls-toggle-js',
				'smvmt',
				apply_filters(
					'smvmt_theme_customizer_js_localize',
					array(
						'customizer' => array(
							'settings'         => array(
								'sidebars'     => array(
									'single'  => array(
										'single-post-sidebar-layout',
										'single-page-sidebar-layout',
									),
									'archive' => array(
										'archive-post-sidebar-layout',
									),
								),
								'container'    => array(
									'single'  => array(
										'single-post-content-layout',
										'single-page-content-layout',
									),
									'archive' => array(
										'archive-post-content-layout',
									),
								),
								'google_fonts' => $string,
							),
							'group_modal_tmpl' => $tmpl,
						),
						'theme'      => array(
							'option' => SMVMT_THEME_SETTINGS,
						),
						'config'     => $this->get_dependency_arr(),
					)
				)
			);
		}

		/**
		 * Generates HTML for font dropdown.
		 *
		 * @return string
		 */
		public function generate_font_dropdown() {

			ob_start();

			?>

			<option value="inherit"><?php esc_attr_e( 'Default System Font', 'smvmt' ); ?></option>
			<optgroup label="Other System Fonts">

			<?php

			$system_fonts = SMVMT_Font_Families::get_system_fonts();
			$google_fonts = SMVMT_Font_Families::get_google_fonts();

			foreach ( $system_fonts as $name => $variants ) {
				?>

				<option value="<?php echo esc_attr( $name ); ?>" ><?php echo esc_attr( $name ); ?></option>
				<?php
			}

			// Add Custom Font List Into Customizer.
			do_action( 'SMVMT_customizer_font_list', '' );

			?>
			<optgroup label="Google">

			<?php
			foreach ( $google_fonts as $name => $single_font ) {
				$variants = smvmt_get_prop( $single_font, '0' );
				$category = smvmt_get_prop( $single_font, '1' );

				?>
				<option value="<?php echo "'" . esc_attr( $name ) . "', " . esc_attr( $category ); ?>"><?php echo esc_attr( $name ); ?></option>

				<?php
			}

			return ob_get_clean();
		}

		/**
		 * Customizer Preview Init
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function preview_init() {

			// Update variables.
			SMVMT_Theme_Options::refresh();

			$js_prefix  = '.min.js';
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			wp_enqueue_script( 'smvmt-customizer-preview-js', SMVMT_THEME_URI . 'assets/js/' . $dir . '/customizer-preview' . $js_prefix, array( 'customize-preview' ), SMVMT_THEME_VERSION, null );

			$localize_array = array(
				'headerBreakpoint'                     => smvmt_header_break_point(),
				'includeAnchorsInHeadindsCss'          => SMVMT_Dynamic_CSS::anchors_in_css_selectors_heading(),
				'googleFonts'                          => SMVMT_Font_Families::get_google_fonts(),
				'page_builder_button_style_css'        => SMVMT_Dynamic_CSS::page_builder_button_style_css(),
				'elementor_default_color_font_setting' => SMVMT_Dynamic_CSS::elementor_default_color_font_setting(),
			);

			wp_localize_script( 'smvmt-customizer-preview-js', 'smvmtCustomizer', $localize_array );
		}

		/**
		 * Called by the customize_save_after action to refresh
		 * the cached CSS when Customizer settings are saved.
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function customize_save() {

			// Update variables.
			SMVMT_Theme_Options::refresh();

			if ( apply_filters( 'SMVMT_resize_logo', true ) ) {

				/* Generate Header Logo */
				$custom_logo_id = get_theme_mod( 'custom_logo' );

				add_filter( 'intermediate_image_sizes_advanced', 'SMVMT_Customizer::logo_image_sizes', 10, 2 );
				self::generate_logo_by_width( $custom_logo_id );
				remove_filter( 'intermediate_image_sizes_advanced', 'SMVMT_Customizer::logo_image_sizes', 10 );

			} else {
				// Regenerate the logo without custom image sizes.
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				self::generate_logo_by_width( $custom_logo_id );
			}

			do_action( 'SMVMT_customizer_save' );

		}

		/**
		 * Add logo image sizes in filter.
		 *
		 * @since 1.0.0
		 * @param array $sizes Sizes.
		 * @param array $metadata attachment data.
		 *
		 * @return array
		 */
		public static function logo_image_sizes( $sizes, $metadata ) {

			$logo_width = smvmt_get_option( 'smvmt-header-responsive-logo-width' );

			if ( is_array( $sizes ) && '' != $logo_width['desktop'] ) {
				$max_value              = max( $logo_width );
				$sizes['smvmt-logo-size'] = array(
					'width'  => (int) $max_value,
					'height' => 0,
					'crop'   => false,
				);
			}

			return $sizes;
		}

		/**
		 * Generate logo image by its width.
		 *
		 * @since 1.0.0
		 * @param int $custom_logo_id Logo id.
		 */
		public static function generate_logo_by_width( $custom_logo_id ) {
			if ( $custom_logo_id ) {

				$image = get_post( $custom_logo_id );

				if ( $image ) {
					$fullsizepath = get_attached_file( $image->ID );

					if ( false !== $fullsizepath || file_exists( $fullsizepath ) ) {

						if ( ! function_exists( 'wp_generate_attachment_metadata' ) ) {
							require_once ABSPATH . 'wp-admin/includes/image.php';
						}

						$metadata = wp_generate_attachment_metadata( $image->ID, $fullsizepath );

						if ( ! is_wp_error( $metadata ) && ! empty( $metadata ) ) {
							wp_update_attachment_metadata( $image->ID, $metadata );
						}
					}
				}
			}
		}

		/**
		 * Customizer Preview icon CSS
		 *
		 * @since 1.0.0
		 * @return void
		 */
		public function preview_styles() {
			if ( is_customize_preview() ) {
				echo '<style class="smvmt-custom-shortcut-edit-icons">
					.customize-partial-edit-shortcut-smvmt-settings-footer-adv {
						position: relative;
					    top: -1em;
					    left: -1.8em;
					}
					.customize-partial-edit-shortcut-smvmt-settings-breadcrumb-position .customize-partial-edit-shortcut-button{
						top: -0.5em;
					}
					.smvmt-small-footer-section-1 .smvmt-footer-widget-1-area .customize-partial-edit-shortcut,
					.smvmt-small-footer-section-2 .smvmt-footer-widget-2-area .customize-partial-edit-shortcut {
						position: absolute;
					    left: 47%;
					}
					.smvmt-small-footer-section-1.smvmt-small-footer-section-equally .smvmt-footer-widget-1-area .customize-partial-edit-shortcut,
					.smvmt-small-footer-section-2.smvmt-small-footer-section-equally .smvmt-footer-widget-2-area .customize-partial-edit-shortcut {
						position: absolute;
					    left: 42%;
					}
					.smvmt-small-footer-section-1.smvmt-small-footer-section-equally .smvmt-footer-widget-1-area .smvmt-no-widget-row .customize-partial-edit-shortcut-smvmt-settings-footer-sml-section-1 {
						position: absolute;
					    left: 1em;
					}
					.smvmt-small-footer-section-2.smvmt-small-footer-section-equally .smvmt-footer-widget-2-area .smvmt-no-widget-row .customize-partial-edit-shortcut-smvmt-settings-footer-sml-section-2 {
						left: 83.5%;
					}
					.smvmt-small-footer-section-1.smvmt-small-footer-section-equally .nav-menu .customize-partial-edit-shortcut-smvmt-settings-footer-sml-section-1 {
						position: absolute;
					    left: 1em;
					}
					.smvmt-small-footer-section-2.smvmt-small-footer-section-equally .nav-menu .customize-partial-edit-shortcut-smvmt-settings-footer-sml-section-2 {
						position: absolute;
					    left: 44.5%;
					}
					.smvmt-small-footer .smvmt-container .smvmt-small-footer-section-1 .footer-primary-navigation > .customize-partial-edit-shortcut,
					.smvmt-small-footer .smvmt-container .smvmt-small-footer-section-2 .footer-primary-navigation > .customize-partial-edit-shortcut{
						display: none;
					}
					.smvmt-small-footer .customize-partial-edit-shortcut-smvmt-settings-footer-sml-layout {
						    position: absolute;
						    top: 3%;
						    left: 10%;
					}
					.customize-partial-edit-shortcut button:hover {
						border-color: #fff;
					}
					.smvmt-main-header-bar-alignment .main-header-bar-navigation .customize-partial-edit-shortcut-button {
						display: none;
					}
				</style>';
				echo '<style class="smvmt-theme-custom-shortcut-edit-icons">
					.smvmt-replace-site-logo-transparent.smvmt-theme-transparent-header .customize-partial-edit-shortcut-smvmt-settings-transparent-header-logo,
					.smvmt-replace-site-logo-transparent.smvmt-theme-transparent-header .customize-partial-edit-shortcut-smvmt-settings-transparent-header-enable {
					    z-index: 6;
					}
				</style>';
			}
		}
	}
}

/**
 *  Kicking this off by calling 'get_instance()' method
 */
SMVMT_Customizer::get_instance();
