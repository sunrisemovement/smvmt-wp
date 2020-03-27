<?php
/**
 * Colors & Background Extension
 *
 * @package smvmt
 */

define( 'SMVMT_EXT_COLORS_DIR', SMVMT_THEME_DIR . 'inc/addons/colors-and-background/' );
define( 'SMVMT_EXT_COLORS_URI', SMVMT_THEME_URI . 'inc/addons/colors-and-background/' );

if ( ! class_exists( 'SMVMT_Ext_Colors_And_Background' ) ) {

	/**
	 * Colors & Background Initial Setup
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Ext_Colors_And_Background {

		/**
		 * Member Variable
		 *
		 * @var object instance
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
			require_once SMVMT_EXT_COLORS_DIR . 'classes/class-smvmt-ext-colors-loader.php';

			// Include front end files.
			if ( ! is_admin() ) {

				require_once SMVMT_EXT_COLORS_DIR . 'classes/dynamic-css/class-smvmt-addon-colors-dynamic-css.php';

				require_once SMVMT_EXT_COLORS_DIR . 'classes/dynamic-css/header-sections-dynamic.css.php';
			}

		}
	}

	/**
	 *  Kicking this off by calling 'get_instance()' method
	 */
	SMVMT_Ext_Colors_And_Background::get_instance();

}
