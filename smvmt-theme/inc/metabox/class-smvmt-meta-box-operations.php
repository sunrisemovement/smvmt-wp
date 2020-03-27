<?php
/**
 * smvmt Meta Box Operations
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
 * Meta Box
 */
if ( ! class_exists( 'SMVMT_Meta_Box_Operations' ) ) {

	/**
	 * Meta Box
	 */
	class SMVMT_Meta_Box_Operations {

		/**
		 * Instance
		 *
		 * @var $instance
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
			add_action( 'wp', array( $this, 'meta_hooks' ) );
		}

		/**
		 * Metabox Hooks
		 */
		public function meta_hooks() {

			if ( is_singular() ) {
				add_action( 'wp_head', array( $this, 'primary_header' ) );
				add_filter( 'smvmt_the_title_enabled', array( $this, 'post_title' ) );
				add_filter( 'body_class', array( $this, 'body_class' ) );
			}
		}

		/**
		 * Primary Header
		 */
		public function primary_header() {

			$display_header = get_post_meta( get_the_ID(), 'smvmt-main-header-display', true );

			$display_header = apply_filters( 'smvmt_main_header_display', $display_header );

			if ( 'disabled' == $display_header ) {

				remove_action( 'SMVMT_masthead', 'SMVMT_masthead_primary_template' );
			}
		}

		/**
		 * Disable Post / Page Title
		 *
		 * @param  boolean $defaults Show default post title.
		 * @return boolean           Status of default post title.
		 */
		public function post_title( $defaults ) {

			$title = get_post_meta( get_the_ID(), 'site-post-title', true );
			if ( 'disabled' == $title ) {
				$defaults = false;
			}

			return $defaults;
		}

		/**
		 * Add Body Classes
		 *
		 * @param  array $classes Body Classes Array.
		 * @return array
		 */
		public function body_class( $classes ) {

			$title = get_post_meta( get_the_ID(), 'site-post-title', true );

			if ( 'disabled' != $title ) {
				$classes[] = 'smvmt-normal-title-enabled';
			}

			return $classes;
		}
	}
}

/**
 * Kicking this off by calling 'get_instance()' method
 */
SMVMT_Meta_Box_Operations::get_instance();
