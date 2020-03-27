<?php
/**
 * Breadcrumbs for smvmt theme.
 *
 * @package     smvmt
 * @author      Brainstorm Force
 * @copyright   Copyright (c) 2020, Brainstorm Force
 * @link        https://www.brainstormforce.com
 * @since       smvmt 1.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'SMVMT_Breadcrumbs_Markup' ) ) {

	/**
	 * Breadcrumbs Markup Initial Setup
	 *
	 * @since 1.8.0
	 */
	class SMVMT_Breadcrumbs_Markup {

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
		 *  Constructor
		 */
		public function __construct() {

			add_action( 'wp', array( $this, 'SMVMT_breadcumb_template' ) );
		}

		/**
		 * smvmt Breadcrumbs Template
		 *
		 * Loads template based on the style option selected in options panel for Breadcrumbs.
		 *
		 * @since 1.8.0
		 *
		 * @return void
		 */
		public function SMVMT_breadcumb_template() {

			$breadcrumb_position = smvmt_get_option( 'breadcrumb-position' );

			$breadcrumb_enabled = false;

			if ( is_singular() ) {
				$breadcrumb_enabled = get_post_meta( get_the_ID(), 'smvmt-breadcrumbs-content', true );
			}

			if ( 'disabled' !== $breadcrumb_enabled && $breadcrumb_position && 'none' !== $breadcrumb_position && ! ( ( is_home() || is_front_page() ) && ( 'SMVMT_entry_top' === $breadcrumb_position ) ) ) {
				if ( self::SMVMT_breadcrumb_rules() ) {
					if ( ( is_archive() || is_search() ) && 'SMVMT_entry_top' === $breadcrumb_position ) {
						add_action( 'SMVMT_before_archive_title', array( $this, 'SMVMT_hook_breadcrumb_position' ), 15 );
					} else {
						add_action( $breadcrumb_position, array( $this, 'SMVMT_hook_breadcrumb_position' ), 15 );
					}
				}
			}
		}

		/**
		 * smvmt Hook Breadcrumb Position
		 *
		 * Hook breadcrumb to position of selected option
		 *
		 * @since 1.8.0
		 *
		 * @return void
		 */
		public function SMVMT_hook_breadcrumb_position() {
			$breadcrumb_position = smvmt_get_option( 'breadcrumb-position' );

			if ( $breadcrumb_position && 'smvmt_header_markup_after' === $breadcrumb_position ) {
				echo '<div class="main-header-bar smvmt-header-breadcrumb">
							<div class="smvmt-container">';
			}
			smvmt_get_breadcrumb();
			if ( $breadcrumb_position && 'smvmt_header_markup_after' === $breadcrumb_position ) {
				echo '	</div>
					</div>';
			}
		}

		/**
		 * smvmt Breadcrumbs Rules
		 *
		 * Checks the rules defined for displaying Breadcrumb on different pages.
		 *
		 * @since 1.8.0
		 *
		 * @return boolean
		 */
		public static function SMVMT_breadcrumb_rules() {

			// Display Breadcrumb default true.
			$display_breadcrumb = true;

			if ( is_front_page() && '1' == smvmt_get_option( 'breadcrumb-disable-home-page' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_home() && '1' == smvmt_get_option( 'breadcrumb-disable-blog-posts-page' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_search() && '1' == smvmt_get_option( 'breadcrumb-disable-search' ) ) {
				$display_breadcrumb = false;
			}

			if ( ( is_archive() ) && '1' == smvmt_get_option( 'breadcrumb-disable-archive' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_page() && '1' == smvmt_get_option( 'breadcrumb-disable-single-page' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_single() && '1' == smvmt_get_option( 'breadcrumb-disable-single-post' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_singular() && '1' == smvmt_get_option( 'breadcrumb-disable-singular' ) ) {
				$display_breadcrumb = false;
			}

			if ( is_404() && '1' == smvmt_get_option( 'breadcrumb-disable-404-page' ) ) {
				$display_breadcrumb = false;
			}

			return apply_filters( 'SMVMT_breadcrumb_enabled', $display_breadcrumb );
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
SMVMT_Breadcrumbs_Markup::get_instance();
