<?php
/**
 * Contact Form 7 Compatibility File.
 *
 * @package smvmt
 */

// If plugin - 'Contact Form 7' not exist then return.
if ( ! class_exists( 'WPCF7' ) ) {
	return;
}

/**
 * smvmt Contact Form 7 Compatibility
 */
if ( ! class_exists( 'SMVMT_Contact_Form_7' ) ) :

	/**
	 * smvmt Contact Form 7 Compatibility
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Contact_Form_7 {

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
		 * Constructor
		 */
		public function __construct() {
			add_action( 'wpcf7_enqueue_styles', array( $this, 'add_styles' ) );
		}

		/**
		 * Add assets in theme
		 *
		 * @since 1.0.0
		 */
		public function add_styles() {
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			if ( is_rtl() ) {
				$file_prefix .= '-rtl';
			}

			$css_file = SMVMT_THEME_URI . 'assets/css/' . $dir_name . '/compatibility/contact-form-7' . $file_prefix . '.css';

			wp_enqueue_style( 'smvmt-contact-form-7', $css_file, array(), SMVMT_THEME_VERSION, 'all' );
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
SMVMT_Contact_Form_7::get_instance();
