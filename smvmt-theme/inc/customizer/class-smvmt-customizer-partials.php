<?php
/**
 * Customizer Partial.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer Partials
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'SMVMT_Customizer_Partials' ) ) {

	/**
	 * Customizer Partials initial setup
	 */
	class SMVMT_Customizer_Partials {

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function __construct() { }

		/**
		 * Render Partial Site Tagline
		 *
		 * @since 1.0.0
		 *
		 * @return mixed
		 */
		public function render_partial_site_tagline() {

			$site_tagline = smvmt_get_option( 'display-site-tagline' );

			if ( true == $site_tagline ) {
				return get_bloginfo( 'description', 'display' );
			}
		}

		/**
		 * Render Partial Site Tagline
		 *
		 * @since 1.0.0
		 *
		 * @return mixed
		 */
		public function render_partial_site_title() {

			$site_title = smvmt_get_option( 'display-site-title' );

			if ( true == $site_title ) {
				return get_bloginfo( 'name', 'display' );
			}
		}

		/**
		 * Render Partial Header Right Section HTML
		 *
		 * @since 1.0.0
		 *
		 * @return mixed
		 */
		public function render_header_main_rt_section_html() {

			$right_section_html = smvmt_get_option( 'header-main-rt-section-html' );

			return do_shortcode( $right_section_html );
		}

		/**
		 * Render Partial Text Custom Menu Item
		 *
		 * @since 1.0.0
		 *
		 * @return mixed
		 */
		public function render_header_main_rt_section_button_text() {
			$custom_button_text = smvmt_get_option( 'header-main-rt-section-button-text' );

			return do_shortcode( $custom_button_text );
		}

		/**
		 * Render Partial Text Header Site Title & Tagline
		 *
		 * @since 2.2.0
		 *
		 * @return mixed
		 */
		public function render_header_site_title_tagline() {
			$display_site_title   = smvmt_get_option( 'display-site-title' );
			$display_site_tagline = smvmt_get_option( 'display-site-tagline' );

			$html = smvmt_get_site_title_tagline( $display_site_title, $display_site_tagline );

			return do_shortcode( $html );
		}

		/**
		 * Render Partial Footer Section 1 Credit
		 *
		 * @since 1.0.0
		 *
		 * @return mixed
		 */
		public function render_footer_sml_section_1_credit() {

			$output = smvmt_get_small_footer_custom_text( 'footer-sml-section-1-credit' );
			return do_shortcode( $output );
		}

		/**
		 * Render Partial Footer Section 2 Credit
		 *
		 * @since 1.0.0
		 *
		 * @return mixed
		 */
		public function render_footer_sml_section_2_credit() {

			$output = smvmt_get_small_footer_custom_text( 'footer-sml-section-2-credit' );
			return do_shortcode( $output );
		}
	}
}