<?php
/**
 * Theme Update
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

if ( ! class_exists( 'SMVMT_Theme_Update' ) ) {

	/**
	 * SMVMT_Theme_Update initial setup
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Theme_Update {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;


		/**
		 * Process All
		 *
		 * @since 2.0.0
		 * @var object Class object.
		 * @access public
		 */
		public static $process_all;

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
		 *  Constructor
		 */
		public function __construct() {

			// Theme Updates.
			if ( is_admin() ) {
				add_action( 'admin_init', __CLASS__ . '::init', 5 );
			} else {
				add_action( 'wp', __CLASS__ . '::init', 5 );
			}
			add_action( 'init', __CLASS__ . '::SMVMT_pro_compatibility' );
		}

		/**
		 * Implement theme update logic.
		 *
		 * @since 1.0.0
		 */
		public static function init() {

			do_action( 'SMVMT_update_before' );

			// Get auto saved version number.
			$saved_version = smvmt_get_option( 'theme-auto-version', false );

			// If there is no saved version in the database then return.
			if ( false === $saved_version ) {
				return;
			}

			// If equals then return.
			if ( version_compare( $saved_version, SMVMT_THEME_VERSION, '=' ) ) {
				return;
			}

			// Update to older version than 1.0.4 version.
			if ( version_compare( $saved_version, '1.0.4', '<' ) ) {
				self::v_1_0_4();
			}

			// Update to older version than 1.0.5 version.
			if ( version_compare( $saved_version, '1.0.5', '<' ) ) {
				self::v_1_0_5();
			}

			// Update to older version than 1.0.8 version.
			if ( version_compare( $saved_version, '1.0.8', '<' ) && version_compare( $saved_version, '1.0.4', '>' ) ) {
				self::v_1_0_8();
			}

			// Update to older version than 1.0.12 version.
			if ( version_compare( $saved_version, '1.0.12', '<' ) ) {
				self::v_1_0_12();
			}

			// Update to older version than 1.0.14 version.
			if ( version_compare( $saved_version, '1.0.14', '<' ) ) {
				self::v_1_0_14();
			}

			// Update smvmt meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.0.28', '<' ) ) {
				self::v_1_0_28();
			}

			// Update smvmt meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.1.0-beta.3', '<' ) ) {
				self::v_1_1_0_beta_3();
			}

			// Update smvmt meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.1.0-beta.4', '<' ) ) {
				self::v_1_1_0_beta_4();
			}

			// Update smvmt meta settings for Beaver Themer Backwards Compatibility.
			if ( version_compare( $saved_version, '1.2.2', '<' ) ) {
				self::v_1_2_2();
			}

			// Update smvmt Theme colors values same as Link color.
			if ( version_compare( $saved_version, '1.2.4', '<' ) ) {
				self::v_1_2_4();
			}

			// Update smvmt Google Fonts values with fallback font.
			if ( version_compare( $saved_version, '1.2.7', '<' ) ) {
				self::v_1_2_7();
			}

			// Update smvmt background image data.
			if ( version_compare( $saved_version, '1.3.0', '<' ) ) {
				self::v_1_3_0();
			}

			// Update smvmt setting for inherit site logo compatibility.
			if ( version_compare( $saved_version, '1.4.0-beta.3', '<' ) ) {
				self::v_1_4_0_beta_3();
			}

			if ( version_compare( $saved_version, '1.4.0-beta.4', '<' ) ) {
				self::v_1_4_0_beta_4();
			}

			if ( version_compare( $saved_version, '1.4.0-beta.5', '<' ) ) {
				self::v_1_4_0_beta_5();
			}

			if ( version_compare( $saved_version, '1.4.3-alpha.1', '<' ) ) {
				self::v_1_4_3_alpha_1();
			}

			if ( version_compare( $saved_version, '1.4.9', '<' ) ) {
				self::v_1_4_9();
			}

			if ( version_compare( $saved_version, '1.5.0-beta.4', '<' ) ) {
				self::v_1_5_0_beta_4();
			}

			if ( version_compare( $saved_version, '1.5.0-rc.1', '<' ) ) {
				self::v_1_5_0_rc_1();
			}

			if ( version_compare( $saved_version, '1.5.0', '<' ) ) {
				self::v_1_5_0_rc_3();
			}

			if ( version_compare( $saved_version, '1.5.1', '<' ) ) {
				self::v_1_5_1();
			}

			if ( version_compare( $saved_version, '1.5.2', '<' ) ) {
				self::v_1_5_2();
			}

			if ( version_compare( $saved_version, '1.6.0', '<' ) ) {
				self::v_1_6_0();
			}

			if ( version_compare( $saved_version, '1.6.1-alpha.3', '<' ) ) {
				self::v_1_6_1();
			}
			if ( version_compare( $saved_version, '2.0.0', '<' ) ) {
				self::v_2_0_0();
			}
		}

		/**
		 * Footer Widgets compatibilty for smvmt pro.
		 */
		public static function SMVMT_pro_compatibility() {

			if ( defined( 'SMVMT_THEME_VERSION' ) && version_compare( SMVMT_THEME_VERSION, '1.0.0-beta.6', '<' ) ) {
				remove_action( 'SMVMT_footer_content', 'SMVMT_advanced_footer_markup', 1 );
			}
		}

		/**
		 * Update options of older version than 1.0.4.
		 *
		 * @since 1.0.4
		 */
		public static function v_1_0_4() {

			$options = array(
				'font-size-body',
				'body-line-height',
				'font-size-site-title',
				'font-size-site-tagline',
				'font-size-entry-title',
				'font-size-page-title',
				'font-size-h1',
				'font-size-h2',
				'font-size-h3',
				'font-size-h4',
				'font-size-h5',
				'font-size-h6',

				// Addon Options.
				'footer-adv-wgt-title-font-size',
				'footer-adv-wgt-title-line-height',
				'footer-adv-wgt-content-font-size',
				'footer-adv-wgt-content-line-height',
				'above-header-font-size',
				'font-size-below-header-primary-menu',
				'font-size-below-header-dropdown-menu',
				'font-size-below-header-content',
				'font-size-related-post',
				'line-height-related-post',
				'title-bar-title-font-size',
				'title-bar-title-line-height',
				'title-bar-breadcrumb-font-size',
				'title-bar-breadcrumb-line-height',
				'line-height-page-title',
				'font-size-post-meta',
				'line-height-post-meta',
				'font-size-post-pagination',
				'line-height-h1',
				'line-height-h2',
				'line-height-h3',
				'line-height-h4',
				'line-height-h5',
				'line-height-h6',
				'font-size-footer-content',
				'line-height-footer-content',
				'line-height-site-title',
				'line-height-site-tagline',
				'font-size-primary-menu',
				'line-height-primary-menu',
				'font-size-primary-dropdown-menu',
				'line-height-primary-dropdown-menu',
				'font-size-widget-title',
				'line-height-widget-title',
				'font-size-widget-content',
				'line-height-widget-content',
				'line-height-entry-title',
			);

			$SMVMT_options = get_option( 'smvmt-settings', array() );

			if ( 0 < count( $SMVMT_options ) ) {
				foreach ( $options as $key ) {

					if ( array_key_exists( $key, $SMVMT_options ) && ! is_array( $SMVMT_options[ $key ] ) ) {

						$SMVMT_options[ $key ] = array(
							'desktop'      => $SMVMT_options[ $key ],
							'tablet'       => '',
							'mobile'       => '',
							'desktop-unit' => 'px',
							'tablet-unit'  => 'px',
							'mobile-unit'  => 'px',
						);
					}
				}
			}

			update_option( 'smvmt-settings', $SMVMT_options );
		}

		/**
		 * Update options of older version than 1.0.5.
		 *
		 * @since 1.0.5
		 */
		public static function v_1_0_5() {

			$SMVMT_old_options = get_option( 'smvmt-settings', array() );
			$SMVMT_new_options = get_option( SMVMT_THEME_SETTINGS, array() );

			// Merge old customizer options in new option.
			$SMVMT_options = wp_parse_args( $SMVMT_new_options, $SMVMT_old_options );

			// Update option.
			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );

			// Delete old option.
			delete_option( 'smvmt-settings' );
		}

		/**
		 * Update options of older version than 1.0.8.
		 *
		 * @since 1.0.8
		 */
		public static function v_1_0_8() {

			$options = array(
				'body-line-height',

				// Addon Options.
				'footer-adv-wgt-title-line-height',
				'footer-adv-wgt-content-line-height',
				'line-height-related-post',
				'title-bar-title-line-height',
				'title-bar-breadcrumb-line-height',
				'line-height-page-title',
				'line-height-post-meta',
				'line-height-h1',
				'line-height-h2',
				'line-height-h3',
				'line-height-h4',
				'line-height-h5',
				'line-height-h6',
				'line-height-footer-content',
				'line-height-site-title',
				'line-height-site-tagline',
				'line-height-primary-menu',
				'line-height-primary-dropdown-menu',
				'line-height-widget-title',
				'line-height-widget-content',
				'line-height-entry-title',
			);

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			if ( 0 < count( $SMVMT_options ) ) {
				foreach ( $options as $key ) {

					if ( array_key_exists( $key, $SMVMT_options ) && is_array( $SMVMT_options[ $key ] ) ) {

						if ( in_array( $SMVMT_options[ $key ]['desktop-unit'], array( '', 'em' ) ) ) {
							$SMVMT_options[ $key ] = $SMVMT_options[ $key ]['desktop'];
						} else {
							$SMVMT_options[ $key ] = '';
						}
					}
				}
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Update options of older version than 1.0.12.
		 *
		 * @since 1.0.12
		 */
		public static function v_1_0_12() {

			$options = array(
				'site-content-layout'         => 'plain-container',
				'single-page-content-layout'  => 'plain-container',
				'single-post-content-layout'  => 'content-boxed-container',
				'archive-post-content-layout' => 'content-boxed-container',
			);

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $SMVMT_options[ $key ] ) ) {
					$SMVMT_options[ $key ] = $value;
				}
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Update options of older version than 1.0.14.
		 *
		 * @since 1.0.14
		 * @return void
		 */
		public static function v_1_0_14() {

			$options = array(
				'footer-sml-divider'          => '4',
				'footer-sml-divider-color'    => '#fff',
				'footer-adv'                  => 'layout-4',
				'single-page-sidebar-layout'  => 'no-sidebar',
				'single-post-sidebar-layout'  => 'right-sidebar',
				'archive-post-sidebar-layout' => 'right-sidebar',
			);

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $SMVMT_options[ $key ] ) ) {
					$SMVMT_options[ $key ] = $value;
				}
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );

			update_option( '_SMVMT_pb_compatibility_offset', 1 );
			update_option( '_SMVMT_pb_compatibility_time', gmdate( 'Y-m-d H:i:s' ) );
		}

		/**
		 * Update page meta settings for all the themer layouts which are not already set.
		 * Default settings to previous versions was `no-sidebar` and `page-builder` through filters.
		 *
		 * @since  1.0.28
		 * @return void
		 */
		public static function v_1_0_28() {

			$query = array(
				'post_type'      => 'fl-theme-layout',
				'posts_per_page' => '-1',
				'no_found_rows'  => true,
				'post_status'    => 'any',
				'fields'         => 'ids',
			);

			// Execute the query.
			$posts = new WP_Query( $query );

			foreach ( $posts->posts as $id ) {

				$sidebar = get_post_meta( $id, 'site-sidebar-layout', true );

				if ( '' == $sidebar ) {
					update_post_meta( $id, 'site-sidebar-layout', 'no-sidebar' );
				}

				$content_layout = get_post_meta( $id, 'site-content-layout', true );

				if ( '' == $content_layout ) {
					update_post_meta( $id, 'site-content-layout', 'page-builder' );
				}
			}

		}

		/**
		 * Update options of older version than 1.1.0-beta.3.
		 *
		 * @since 1.1.0-beta.3
		 */
		public static function v_1_1_0_beta_3() {

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			if ( isset( $SMVMT_options['shop-grid'] ) ) {

				$SMVMT_options['shop-grids'] = array(
					'desktop' => $SMVMT_options['shop-grid'],
					'tablet'  => 2,
					'mobile'  => 1,
				);

				unset( $SMVMT_options['shop-grid'] );
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Update options of older version than 1.1.0-beta.3.
		 *
		 * Container Style
		 * Sidebar
		 * Grid
		 *
		 * @since 1.1.0-beta.3
		 */
		public static function v_1_1_0_beta_4() {

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			$options = array(
				'woocommerce-content-layout' => 'default',
				'woocommerce-sidebar-layout' => 'default',
				/* Shop */
				'shop-grids'                 => array(
					'desktop' => 3,
					'tablet'  => 2,
					'mobile'  => 1,
				),
				'shop-no-of-products'        => '9',
			);

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			foreach ( $options as $key => $value ) {
				if ( ! isset( $SMVMT_options[ $key ] ) ) {
					$SMVMT_options[ $key ] = $value;
				}
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Update options of older version than 1.2.2.
		 *
		 * Logo Width
		 *
		 * @since 1.2.2
		 */
		public static function v_1_2_2() {

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			if ( isset( $SMVMT_options['smvmt-header-logo-width'] ) && ! is_array( $SMVMT_options['smvmt-header-logo-width'] ) ) {
				$SMVMT_options['smvmt-header-responsive-logo-width'] = array(
					'desktop' => $SMVMT_options['smvmt-header-logo-width'],
					'tablet'  => '',
					'mobile'  => '',
				);
			}

			if ( isset( $SMVMT_options['blog-width'] ) ) {
				$SMVMT_options['shop-archive-width'] = $SMVMT_options['blog-width'];
			}

			if ( isset( $SMVMT_options['blog-max-width'] ) ) {
				$SMVMT_options['shop-archive-max-width'] = $SMVMT_options['blog-max-width'];
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Update Theme Color value same as Link Color for older version than 1.2.4.
		 *
		 * Theme Color update
		 *
		 * @since 1.2.4
		 */
		public static function v_1_2_4() {

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			if ( isset( $SMVMT_options['link-color'] ) ) {
				$SMVMT_options['theme-color'] = $SMVMT_options['link-color'];
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Update Google Fonts value with font categories
		 *
		 * Google Font Update
		 *
		 * @since 1.2.7
		 */
		public static function v_1_2_7() {

			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );
			$google_fonts  = SMVMT_Font_Families::get_google_fonts();

			foreach ( $SMVMT_options as $key => $value ) {

				if ( ! is_array( $value ) && ! empty( $value ) && ! is_bool( $value ) ) {

					if ( array_key_exists( $value, $google_fonts ) ) {
						$SMVMT_options[ $key ] = "'" . $value . "', " . $google_fonts[ $value ][1];
					}
				}
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Update options of older version than 1.3.0.
		 *
		 * Background options
		 *
		 * @since 1.3.0
		 */
		public static function v_1_3_0() {
			$SMVMT_options = get_option( SMVMT_THEME_SETTINGS, array() );

			$SMVMT_options['header-bg-obj'] = array(
				'background-color' => isset( $SMVMT_options['header-bg-color'] ) ? $SMVMT_options['header-bg-color'] : '',
			);

			$SMVMT_options['content-bg-obj'] = array(
				'background-color' => isset( $SMVMT_options['content-bg-color'] ) ? $SMVMT_options['content-bg-color'] : '#ffffff',
			);

			$SMVMT_options['footer-adv-bg-obj'] = array(
				'background-color'      => isset( $SMVMT_options['footer-adv-bg-color'] ) ? $SMVMT_options['footer-adv-bg-color'] : '',
				'background-image'      => isset( $SMVMT_options['footer-adv-bg-img'] ) ? $SMVMT_options['footer-adv-bg-img'] : '',
				'background-repeat'     => isset( $SMVMT_options['footer-adv-bg-repeat'] ) ? $SMVMT_options['footer-adv-bg-repeat'] : 'no-repeat',
				'background-position'   => isset( $SMVMT_options['footer-adv-bg-pos'] ) ? $SMVMT_options['footer-adv-bg-pos'] : 'center center',
				'background-size'       => isset( $SMVMT_options['footer-adv-bg-size'] ) ? $SMVMT_options['footer-adv-bg-size'] : 'cover',
				'background-attachment' => isset( $SMVMT_options['footer-adv-bg-attac'] ) ? $SMVMT_options['footer-adv-bg-attac'] : 'scroll',
			);

			$SMVMT_options['footer-bg-obj'] = array(
				'background-color'      => isset( $SMVMT_options['footer-bg-color'] ) ? $SMVMT_options['footer-bg-color'] : '',
				'background-image'      => isset( $SMVMT_options['footer-bg-img'] ) ? $SMVMT_options['footer-bg-img'] : '',
				'background-repeat'     => isset( $SMVMT_options['footer-bg-rep'] ) ? $SMVMT_options['footer-bg-rep'] : 'repeat',
				'background-position'   => isset( $SMVMT_options['footer-bg-pos'] ) ? $SMVMT_options['footer-bg-pos'] : 'center center',
				'background-size'       => isset( $SMVMT_options['footer-bg-size'] ) ? $SMVMT_options['footer-bg-size'] : 'auto',
				'background-attachment' => isset( $SMVMT_options['footer-bg-atch'] ) ? $SMVMT_options['footer-bg-atch'] : 'scroll',
			);

			// Site layout background image and color.
			$site_layout = isset( $SMVMT_options['site-layout'] ) ? $SMVMT_options['site-layout'] : '';
			switch ( $site_layout ) {
				case 'smvmt-box-layout':
						$SMVMT_options['site-layout-outside-bg-obj'] = array(
							'background-color'      => isset( $SMVMT_options['site-layout-outside-bg-color'] ) ? $SMVMT_options['site-layout-outside-bg-color'] : '',
							'background-image'      => isset( $SMVMT_options['site-layout-box-bg-img'] ) ? $SMVMT_options['site-layout-box-bg-img'] : '',
							'background-repeat'     => isset( $SMVMT_options['site-layout-box-bg-rep'] ) ? $SMVMT_options['site-layout-box-bg-rep'] : 'no-repeat',
							'background-position'   => isset( $SMVMT_options['site-layout-box-bg-pos'] ) ? $SMVMT_options['site-layout-box-bg-pos'] : 'center center',
							'background-size'       => isset( $SMVMT_options['site-layout-box-bg-size'] ) ? $SMVMT_options['site-layout-box-bg-size'] : 'cover',
							'background-attachment' => isset( $SMVMT_options['site-layout-box-bg-atch'] ) ? $SMVMT_options['site-layout-box-bg-atch'] : 'scroll',
						);
					break;

				case 'smvmt-padded-layout':
						$bg_color = isset( $SMVMT_options['site-layout-outside-bg-color'] ) ? $SMVMT_options['site-layout-outside-bg-color'] : '';
						$bg_image = isset( $SMVMT_options['site-layout-padded-bg-img'] ) ? $SMVMT_options['site-layout-padded-bg-img'] : '';

						$SMVMT_options['site-layout-outside-bg-obj'] = array(
							'background-color'      => empty( $bg_image ) ? $bg_color : '',
							'background-image'      => $bg_image,
							'background-repeat'     => isset( $SMVMT_options['site-layout-padded-bg-rep'] ) ? $SMVMT_options['site-layout-padded-bg-rep'] : 'no-repeat',
							'background-position'   => isset( $SMVMT_options['site-layout-padded-bg-pos'] ) ? $SMVMT_options['site-layout-padded-bg-pos'] : 'center center',
							'background-size'       => isset( $SMVMT_options['site-layout-padded-bg-size'] ) ? $SMVMT_options['site-layout-padded-bg-size'] : 'cover',
							'background-attachment' => '',
						);
					break;

				case 'smvmt-full-width-layout':
				case 'smvmt-fluid-width-layout':
				default:
								$SMVMT_options['site-layout-outside-bg-obj'] = array(
									'background-color' => isset( $SMVMT_options['site-layout-outside-bg-color'] ) ? $SMVMT_options['site-layout-outside-bg-color'] : '',
								);
					break;
			}

			update_option( SMVMT_THEME_SETTINGS, $SMVMT_options );
		}

		/**
		 * Mobile Header - Border new param introduced for Top, Right, Bottom and left border.
		 * Update options of older version than 1.4.0-beta.3.
		 *
		 * @since 1.4.0-beta.3
		 */
		public static function v_1_4_0_beta_3() {

			$theme_options     = get_option( 'smvmt-settings' );
			$mobile_logo_width = smvmt_get_option( 'mobile-header-logo-width' );

			if ( '' != $mobile_logo_width ) {
				$theme_options['smvmt-header-responsive-logo-width']['tablet'] = $mobile_logo_width;
			}

			$mobile_logo = ( isset( $theme_options['mobile-header-logo'] ) && '' !== $theme_options['mobile-header-logo'] ) ? $theme_options['mobile-header-logo'] : false;

			if ( '' != $mobile_logo ) {
				$theme_options['inherit-sticky-logo'] = false;
			}

			update_option( 'smvmt-settings', $theme_options );
		}

		/**
		 * Introduced different logo for mobile devices option
		 *
		 * @since 1.4.0-beta.4
		 */
		public static function v_1_4_0_beta_4() {

			$mobile_header_logo = smvmt_get_option( 'mobile-header-logo' );
			$theme_options      = get_option( 'smvmt-settings' );

			if ( '' != $mobile_header_logo ) {
				$theme_options['different-mobile-logo'] = true;
			}

			update_option( 'smvmt-settings', $theme_options );
		}

		/**
		 * Function to backward compatibility for version less than 1.4.0
		 *
		 * @since 1.4.0-beta.5
		 */
		public static function v_1_4_0_beta_5() {

			// Set default toggle button style.
			$theme_options = get_option( 'smvmt-settings' );

			if ( ! isset( $theme_options['mobile-header-toggle-btn-style'] ) ) {
				$theme_options['mobile-header-toggle-btn-style'] = 'fill';
			}

			$theme_options['hide-custom-menu-mobile'] = 0;

			update_option( 'smvmt-settings', $theme_options );

		}

		/**
		 * Function to backward compatibility for version less than 1.4.3
		 * Set the new option different-retina-logo to true for users who are already using a retina logo.
		 *
		 * @since 1.4.3-aplha.1
		 */
		public static function v_1_4_3_alpha_1() {

			$mobile_header_logo = smvmt_get_option( 'smvmt-header-retina-logo' );
			$theme_options      = get_option( 'smvmt-settings' );

			if ( '' != $mobile_header_logo ) {
				$theme_options['different-retina-logo'] = '1';
			}

			update_option( 'smvmt-settings', $theme_options );
		}

		/**
		 * Manage backwards compatibility when migrating to v1.4.9
		 *
		 * @since 1.4.9
		 * @return void
		 */
		public static function v_1_4_9() {
			$theme_options = get_option( 'smvmt-settings' );

			// Set flag to use anchors CSS selectors in the CSS for headings.
			if ( ! isset( $theme_options['include-headings-in-typography'] ) ) {
				$theme_options['include-headings-in-typography'] = true;
				update_option( 'smvmt-settings', $theme_options );
			}
		}

		/**
		 * Added Submenu Border options into theme from Addon
		 *
		 * @since 1.5.0-beta.4
		 *
		 * @return void
		 */
		public static function v_1_5_0_beta_4() {

			$border_disabled_values        = array(
				'top'    => '0',
				'bottom' => '0',
				'left'   => '0',
				'right'  => '0',
			);
			$inside_border_disabled_values = array(
				'bottom' => '0',
			);

			$border_enabled_values        = array(
				'top'    => '1',
				'bottom' => '1',
				'left'   => '1',
				'right'  => '1',
			);
			$inside_border_enabled_values = array(
				'bottom' => '1',
			);

			$theme_options  = get_option( 'smvmt-settings' );
			$submenu_border = isset( $theme_options['primary-submenu-border'] ) ? $theme_options['primary-submenu-border'] : true;

			// Primary Header.
			if ( $submenu_border ) {
				$theme_options['primary-submenu-border']      = $border_enabled_values;
				$theme_options['primary-submenu-item-border'] = $inside_border_enabled_values;
			} else {
				$theme_options['primary-submenu-border']      = $border_disabled_values;
				$theme_options['primary-submenu-item-border'] = $inside_border_disabled_values;
			}

			update_option( 'smvmt-settings', $theme_options );
		}

		/**
		 * Set flag 'submenu-below-header' to false to load fallback CSS to force menu load right after the container cropping logo and header.
		 *
		 * @see https://github.com/brainstormforce/smvmt/pull/820/
		 *
		 * @return void
		 */
		public static function v_1_5_0_rc_1() {
			$theme_options = get_option( 'smvmt-settings' );

			// Set flag to use anchors CSS selectors in the CSS for headings.
			if ( ! isset( $theme_options['submenu-below-header'] ) ) {
				$theme_options['submenu-below-header'] = false;
				update_option( 'smvmt-settings', $theme_options );
			}
		}

		/**
		 * Set Primary Header submenu border color 'primary-submenu-b-color' to '#eaeaea' for old users who doesn't set any color and set the theme color who install the fresh 1.5.0-rc.3 theme.
		 *
		 * @see https://github.com/brainstormforce/smvmt/pull/835
		 *
		 * @return void
		 */
		public static function v_1_5_0_rc_3() {

			$theme_options = get_option( 'smvmt-settings' );

			// Set the default #eaeaea sub menu border color who doesn't set any color.
			if ( ! isset( $theme_options['primary-submenu-b-color'] ) || empty( $theme_options['primary-submenu-b-color'] ) ) {
				$theme_options['primary-submenu-b-color'] = '#eaeaea';
			}

			// Set the primary sub menu animation to default for existing user.
			if ( ! isset( $theme_options['header-main-submenu-container-animation'] ) ) {
				$theme_options['header-main-submenu-container-animation'] = '';
			}

			update_option( 'smvmt-settings', $theme_options );

		}

		/**
		 * Change the Primary submenu option to be checkbpx rather than border selection.
		 *
		 * @return void
		 */
		public static function v_1_5_1() {
			$theme_options               = get_option( 'smvmt-settings', array() );
			$primary_submenu_otem_border = isset( $theme_options['primary-submenu-item-border'] ) ? $theme_options['primary-submenu-item-border'] : array();

			if ( ( is_array( $primary_submenu_otem_border ) && '0' != $primary_submenu_otem_border['bottom'] ) ) {
				$theme_options['primary-submenu-item-border'] = 1;
			} else {
				$theme_options['primary-submenu-item-border'] = 0;
			}
			if ( isset( $theme_options['primary-submenu-b-color'] ) && ! empty( $theme_options['primary-submenu-b-color'] ) ) {
				$theme_options['primary-submenu-item-b-color'] = $theme_options['primary-submenu-b-color'];
			}

			update_option( 'smvmt-settings', $theme_options );
		}

		/**
		 * Add same font variant as font weight for body and heading.
		 *
		 * @return void
		 */
		public static function v_1_5_2() {
			$theme_options = get_option( 'smvmt-settings', array() );
			if ( isset( $theme_options['body-font-weight'] ) && is_numeric( $theme_options['body-font-weight'] ) ) {
				$theme_options['body-font-variant'] = $theme_options['body-font-weight'];
			}
			if ( isset( $theme_options['headings-font-weight'] ) && is_numeric( $theme_options['headings-font-weight'] ) ) {
				$theme_options['headings-font-variant'] = $theme_options['headings-font-weight'];
			}

			update_option( 'smvmt-settings', $theme_options );
		}

		/**
		 * Disable transparent header in customizer if the transparent header addon was disabled.
		 *
		 * @return void
		 */
		public static function v_1_6_0() {
			return;
		}

		/**
		 * Add backward compatibility for Heading tags previous default values.
		 * Set Inline Logo & Site Title as false if user had not changed its value.
		 * Change default value for blog archive blog title.
		 *
		 * @return void
		 */
		public static function v_1_6_1() {
			$theme_options = get_option( 'smvmt-settings', array() );

			// If user was using a default value for h1, Set the default in the option.
			if ( ! isset( $theme_options['font-size-h1'] ) ) {
				$theme_options['font-size-h1'] = array(
					'desktop'      => '48',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}
			// If user was using a default value for h2, Set the default in the option.
			if ( ! isset( $theme_options['font-size-h2'] ) ) {
				$theme_options['font-size-h2'] = array(
					'desktop'      => '42',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}
			// If user was using a default value for h3, Set the default in the option.
			if ( ! isset( $theme_options['font-size-h3'] ) ) {
				$theme_options['font-size-h3'] = array(
					'desktop'      => '30',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}

			// If user was using a default value for h3, Set the default in the option.
			if ( ! isset( $theme_options['font-size-page-title'] ) ) {
				$theme_options['font-size-page-title'] = array(
					'desktop'      => '30',
					'tablet'       => '',
					'mobile'       => '',
					'desktop-unit' => 'px',
					'tablet-unit'  => 'px',
					'mobile-unit'  => 'px',
				);
			}

			// If inline-logo option was unset previously, set to to false as new default is `true`.
			if ( ! isset( $theme_options['logo-title-inline'] ) ) {
				$theme_options['logo-title-inline'] = 0;
			}

			update_option( 'smvmt-settings', $theme_options );
		}

		/**
		 * Flush bundled products After udpating to version 2.0.0
		 *
		 * @return void
		 */
		public static function v_2_0_0() {
			update_site_option( 'bsf_force_check_extensions', true );
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
SMVMT_Theme_Update::get_instance();
