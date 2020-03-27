<?php
/**
 * Advanced Header Extension
 *
 * @package smvmt
 */

define( 'SMVMT_EXT_HEADER_SECTIONS_DIR', SMVMT_THEME_DIR . 'inc/addons/header-sections/' );
define( 'SMVMT_EXT_HEADER_SECTIONS_URL', SMVMT_THEME_URI . 'inc/addons/header-sections/' );

if ( ! class_exists( 'SMVMT_Ext_Header_Sections' ) ) {

	/**
	 * Advanced Header Initial Setup
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Ext_Header_Sections {

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

			require_once SMVMT_EXT_HEADER_SECTIONS_DIR . 'classes/class-smvmt-ext-header-sections-loader.php';
			require_once SMVMT_EXT_HEADER_SECTIONS_DIR . 'classes/class-smvmt-ext-header-sections-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once SMVMT_EXT_HEADER_SECTIONS_DIR . 'classes/above-header-dynamic.css.php';
				require_once SMVMT_EXT_HEADER_SECTIONS_DIR . 'classes/below-header-dynamic.css.php';
			}
		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	SMVMT_Ext_Header_Sections::get_instance();
}
