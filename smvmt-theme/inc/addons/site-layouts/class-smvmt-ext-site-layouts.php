<?php
/**
 * Site Layouts Extension
 *
 * @package smvmt
 */

define( 'SMVMT_EXT_SITE_LAYOUTS_DIR', SMVMT_THEME_DIR . 'inc/addons/site-layouts/' );
define( 'SMVMT_EXT_SITE_LAYOUTS_URL', SMVMT_THEME_URI . 'inc/addons/site-layouts/' );

if ( ! class_exists( 'SMVMT_Ext_Site_Layouts' ) ) {

	/**
	 * Above Header Initial Setup
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Ext_Site_Layouts {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

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
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			require_once SMVMT_EXT_SITE_LAYOUTS_DIR . 'classes/class-smvmt-ext-site-layouts-loader.php';
			require_once SMVMT_EXT_SITE_LAYOUTS_DIR . 'classes/class-smvmt-ext-site-layouts-markup.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once SMVMT_EXT_SITE_LAYOUTS_DIR . 'classes/dynamic.css.php';
			}

		}
	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	SMVMT_Ext_Site_Layouts::get_instance();

}
