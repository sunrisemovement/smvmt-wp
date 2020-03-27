<?php
/**
 * Admin functions - Functions that add some functionality to WordPress admin panel
 *
 * @package smvmt
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Register menus
 */
if ( ! function_exists( 'SMVMT_register_menu_locations' ) ) {

	/**
	 * Register menus
	 *
	 * @since 1.0.0
	 */
	function SMVMT_register_menu_locations() {

		/**
		 * Menus
		 */
		register_nav_menus(
			array(
				'primary'     => __( 'Primary Menu', 'smvmt' ),
				'footer_menu' => __( 'Footer Menu', 'smvmt' ),
			)
		);
	}
}

add_action( 'init', 'SMVMT_register_menu_locations' );
