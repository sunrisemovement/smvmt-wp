<?php
/**
 * Heading Colors for smvmt theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 2.1.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'SMVMT_THEME_HEADING_COLORS_DIR', SMVMT_THEME_DIR . 'inc/addons/heading-colors/' );
define( 'SMVMT_THEME_HEADING_COLORS_URI', SMVMT_THEME_URI . 'inc/addons/heading-colors/' );

if ( ! class_exists( 'SMVMT_Heading_Colors' ) ) {

	/**
	 * Heading Initial Setup
	 *
	 * @since 2.1.4
	 */
	class SMVMT_Heading_Colors {

		/**
		 * Constructor function that initializes required actions and hooks
		 */
		public function __construct() {

			require_once SMVMT_THEME_HEADING_COLORS_DIR . 'class-smvmt-heading-colors-loader.php';

			// Include front end files.
			if ( ! is_admin() ) {
				require_once SMVMT_THEME_HEADING_COLORS_DIR . 'dynamic-css/dynamic.css.php';
			}
		}
	}

	/**
	 *  Kicking this off by creating an object.
	 */
	new SMVMT_Heading_Colors();

}
