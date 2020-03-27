<?php
/**
 * Breadcrumbs for smvmt theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'SMVMT_THEME_BREADCRUMBS_DIR', SMVMT_THEME_DIR . 'inc/addons/breadcrumbs/' );
define( 'SMVMT_THEME_BREADCRUMBS_URI', SMVMT_THEME_URI . 'inc/addons/breadcrumbs/' );

if ( ! class_exists( 'SMVMT_Breadcrumbs' ) ) {

	/**
	 * Breadcrumbs Initial Setup
	 *
	 * @since 1.7.0
	 */
	class SMVMT_Breadcrumbs {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			require_once SMVMT_THEME_BREADCRUMBS_DIR . 'class-smvmt-breadcrumbs-loader.php';
			require_once SMVMT_THEME_BREADCRUMBS_DIR . 'class-smvmt-breadcrumbs-markup.php';
			require_once SMVMT_THEME_BREADCRUMBS_DIR . 'class-smvmt-breadcrumb-trail.php';
			// Third Party plugins in the breadcrumb options.
			add_filter( 'SMVMT_breadcrumb_source_list', array( $this, 'SMVMT_breadcrumb_source_list_items' ) );

			// Include front end files.
			if ( ! is_admin() ) {
				require_once SMVMT_THEME_BREADCRUMBS_DIR . 'dynamic-css/dynamic.css.php';
			}
		}

		/**
		 * Third Party Breadcrumb option
		 *
		 * @param Array $options breadcrumb options array.
		 *
		 * @return Array breadcrumb options array.
		 * @since 1.0.0
		 */
		public function SMVMT_breadcrumb_source_list_items( $options ) {

			$breadcrumb_enable = is_callable( 'WPSEO_Options::get' ) ? WPSEO_Options::get( 'breadcrumbs-enable' ) : false;
			$wpseo_option      = get_option( 'wpseo_internallinks' ) ? get_option( 'wpseo_internallinks' ) : $breadcrumb_enable;
			if ( ! is_array( $wpseo_option ) ) {
				unset( $wpseo_option );
				$wpseo_option = array(
					'breadcrumbs-enable' => $breadcrumb_enable,
				);
			}

			if ( function_exists( 'yoast_breadcrumb' ) && true === $wpseo_option['breadcrumbs-enable'] ) {
				$options['yosmvmt-seo-breadcrumbs'] = 'Yoast SEO Breadcrumbs';
			}

			if ( function_exists( 'bcn_display' ) ) {
				$options['breadcrumb-navxt'] = 'Breadcrumb NavXT';
			}

			if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
				$options['rank-math'] = 'Rank Math';
			}

			return $options;
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	SMVMT_Breadcrumbs::get_instance();

}