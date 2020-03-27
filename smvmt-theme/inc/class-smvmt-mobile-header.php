<?php
/**
 * smvmt Loop
 *
 * @package smvmt
 * @since 1.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'SMVMT_Mobile_Header' ) ) :

	/**
	 * SMVMT_Mobile_Header
	 *
	 * @since 1.4.0
	 */
	class SMVMT_Mobile_Header {

		/**
		 * Instance
		 *
		 * @since 1.4.0
		 *
		 * @access private
		 * @var object Class object.
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.4.0
		 *
		 * @return object initialized object of class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.4.0
		 */
		public function __construct() {
			add_action( 'SMVMT_header', array( $this, 'mobile_header_markup' ), 5 );
			add_action( 'body_class', array( $this, 'add_body_class' ) );
			add_filter( 'SMVMT_main_menu_toggle_classes', array( $this, 'menu_toggle_classes' ) );
			add_filter( 'walker_nav_menu_start_el', array( $this, 'toggle_button' ), 20, 4 );
			add_filter( 'SMVMT_walker_nav_menu_start_el', array( $this, 'toggle_button' ), 10, 4 );
		}

		/**
		 * Add submenu toggle button used for mobile devices.
		 *
		 * @since 1.6.9
		 *
		 * @param string   $item_output The menu item's starting HTML output.
		 * @param WP_Post  $item        Menu item data object.
		 * @param int      $depth       Depth of menu item. Used for padding.
		 * @param stdClass $args        An object of wp_nav_menu() arguments.
		 *
		 * @return String Menu item's starting markup.
		 */
		public function toggle_button( $item_output, $item, $depth, $args ) {
			// Add toggle button if menu is from smvmt.
			if ( true === is_object( $args ) ) {
				if ( isset( $args->theme_location ) &&
				( 'primary' === $args->theme_location ||
				'above_header_menu' === $args->theme_location ||
				'below_header_menu' === $args->theme_location )
				) {
					if ( isset( $item->classes ) && in_array( 'menu-item-has-children', $item->classes ) ) {
						$item_output = $this->menu_arrow_button_markup( $item_output, $item );
					}
				}
			} else {
				if ( isset( $item->post_parent ) && 0 === $item->post_parent ) {
					$item_output = $this->menu_arrow_button_markup( $item_output, $item );
				}
			}

			return $item_output;
		}

		/**
		 * Get Menu Arrow Button Mark up
		 *
		 * @param string  $item_output The menu item's starting HTML output.
		 * @param WP_Post $item        Menu item data object.
		 *
		 * @since 1.7.2
		 * @return string Menu item arrow button markup.
		 */
		public function menu_arrow_button_markup( $item_output, $item ) {
			$item_output  = apply_filters( 'SMVMT_toggle_button_markup', $item_output, $item );
			$item_output .= '<button ' . SMVMT_attr(
				'smvmt-menu-toggle',
				array(
					'role'          => 'button',
					'aria-expanded' => 'false',
				),
				$item
			) . '><span class="screen-reader-text">' . __( 'Menu Toggle', 'smvmt' ) . '</span></button>';

			return $item_output;
		}

		/**
		 * Header Cart Icon Class
		 *
		 * @param array $classes Default argument array.
		 *
		 * @since 1.4.0
		 * @return array;
		 */
		public function menu_toggle_classes( $classes ) {
			return ' smvmt-mobile-menu-buttons-' . smvmt_get_option( 'mobile-header-toggle-btn-style' ) . ' ';
		}

		/**
		 * Mobile Header Markup
		 *
		 * @return void
		 */
		public function mobile_header_markup() {
			$mobile_header_logo = smvmt_get_option( 'mobile-header-logo' );
			$different_logo     = smvmt_get_option( 'different-mobile-logo' );

			if ( '' !== $mobile_header_logo && '1' == $different_logo ) {
				add_filter( 'SMVMT_has_custom_logo', '__return_true' );
				add_filter( 'get_custom_logo', array( $this, 'SMVMT_mobile_header_custom_logo' ), 10, 2 );
				add_filter( 'smvmt_is_logo_attachment', array( $this, 'add_mobile_logo_svg_class' ), 10, 2 );
			}
		}

		/**
		 * Replace logo with Mobile Header logo.
		 *
		 * @param sting $html Size name.
		 * @param int   $blog_id Icon.
		 * @since 1.4.0
		 * @return string html markup of logo.
		 */
		public function SMVMT_mobile_header_custom_logo( $html, $blog_id ) {

			$mobile_header_logo = smvmt_get_option( 'mobile-header-logo' );

			$custom_logo_id = attachment_url_to_postid( $mobile_header_logo );

			$size = 'smvmt-mobile-header-logo-size';

			if ( is_customize_preview() ) {
				$size = 'full';
			}

			$logo = sprintf(
				'<a href="%1$s" class="custom-mobile-logo-link" rel="home" itemprop="url">%2$s</a>',
				esc_url( home_url( '/' ) ),
				wp_get_attachment_image(
					$custom_logo_id,
					$size,
					false,
					array(
						'class' => 'smvmt-mobile-header-logo',
					)
				)
			);

			return $html . $logo;

		}

		/**
		 * Add svg class to mobile logo.
		 *
		 * @param bool  $is_logo_attachment is attachment is logo image?.
		 * @param array $attachment attachment data.
		 * @since 2.1.0
		 * @return bool return if attachment is mobile logo image.
		 */
		public function add_mobile_logo_svg_class( $is_logo_attachment, $attachment ) {

			$mobile_header_logo = smvmt_get_option( 'mobile-header-logo' );
			$custom_logo_id     = attachment_url_to_postid( $mobile_header_logo );

			if ( $custom_logo_id === $attachment->ID ) {
				return true;
			}

			return $is_logo_attachment;
		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function add_body_class( $classes ) {

			/**
			 * Add class for header width
			 */
			$header_content_layout = smvmt_get_option( 'different-mobile-logo' );

			if ( '0' == $header_content_layout ) {
				$classes[] = 'smvmt-mobile-inherit-site-logo';
			}

			return $classes;
		}

	}

	/**
	 * Initialize class object with 'get_instance()' method
	 */
	SMVMT_Mobile_Header::get_instance();

endif;