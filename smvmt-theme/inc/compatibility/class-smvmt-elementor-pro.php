<?php
/**
 * Elementor Compatibility File.
 *
 * @package smvmt
 */

namespace Elementor;

// If plugin - 'Elementor' not exist then return.
if ( ! class_exists( '\Elementor\Plugin' ) || ! class_exists( 'ElementorPro\Modules\ThemeBuilder\Module' ) ) {
	return;
}

namespace ElementorPro\Modules\ThemeBuilder\ThemeSupport;

use Elementor\TemplateLibrary\Source_Local;
use ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager;
use ElementorPro\Modules\ThemeBuilder\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * smvmt Elementor Compatibility
 */
if ( ! class_exists( 'SMVMT_Elementor_Pro' ) ) :

	/**
	 * smvmt Elementor Compatibility
	 *
	 * @since 1.2.7
	 */
	class SMVMT_Elementor_Pro {

		/**
		 * Member Variable
		 *
		 * @var object instance
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @since 1.2.7
		 * @return object Class object.
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
		 * @since 1.2.7
		 */
		public function __construct() {
			// Add locations.
			add_action( 'elementor/theme/register_locations', array( $this, 'register_locations' ) );

			// Override theme templates.
			add_action( 'SMVMT_header', array( $this, 'do_header' ), 0 );
			add_action( 'SMVMT_footer', array( $this, 'do_footer' ), 0 );
			add_action( 'SMVMT_template_parts_content_top', array( $this, 'do_template_parts' ), 0 );

			add_action( 'SMVMT_entry_content_404_page', array( $this, 'do_template_part_404' ), 0 );

			add_filter( 'post_class', array( $this, 'render_post_class' ), 99 );
			// Override post meta.
			add_action( 'wp', array( $this, 'override_meta' ), 0 );
		}

		/**
		 * Register Locations
		 *
		 * @since 1.2.7
		 * @param object $manager Location manager.
		 * @return void
		 */
		public function register_locations( $manager ) {
			$manager->register_all_core_location();
		}

		/**
		 * Template Parts Support
		 *
		 * @since 1.2.7
		 * @return void
		 */
		public function do_template_parts() {
			// Is Archive?
			$did_location = Module::instance()->get_locations_manager()->do_location( 'archive' );
			if ( $did_location ) {
				// Search and default.
				remove_action( 'SMVMT_template_parts_content', array( \SMVMT_Loop::get_instance(), 'template_parts_search' ) );
				remove_action( 'SMVMT_template_parts_content', array( \SMVMT_Loop::get_instance(), 'template_parts_default' ) );

				// Remove pagination.
				remove_action( 'smvmt_pagination', 'SMVMT_number_pagination' );
				remove_action( 'SMVMT_entry_after', 'SMVMT_single_post_navigation_markup' );

				// Content.
				remove_action( 'SMVMT_entry_content_single', 'SMVMT_entry_content_single_template' );
			}

			// IS Single?
			$did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
			if ( $did_location ) {
				remove_action( 'SMVMT_page_template_parts_content', array( \SMVMT_Loop::get_instance(), 'template_parts_page' ) );
				remove_action( 'SMVMT_template_parts_content', array( \SMVMT_Loop::get_instance(), 'template_parts_post' ) );
				remove_action( 'SMVMT_template_parts_content', array( \SMVMT_Loop::get_instance(), 'template_parts_comments' ), 15 );
				remove_action( 'SMVMT_page_template_parts_content', array( \SMVMT_Loop::get_instance(), 'template_parts_comments' ), 15 );
			}
		}

		/**
		 * Override 404 page
		 *
		 * @since 1.2.7
		 * @return void
		 */
		public function do_template_part_404() {
			if ( is_404() ) {

				// Is Single?
				$did_location = Module::instance()->get_locations_manager()->do_location( 'single' );
				if ( $did_location ) {
					remove_action( 'SMVMT_entry_content_404_page', 'SMVMT_entry_content_404_page_template' );
				}
			}
		}

		/**
		 * Override sidebar, title etc with post meta
		 *
		 * @since 1.2.7
		 * @return void
		 */
		public function override_meta() {

			// don't override meta for `elementor_library` post type.
			if ( 'elementor_library' == get_post_type() ) {
				return;
			}

			// Override post meta for single pages.
			$documents_single = Module::instance()->get_conditions_manager()->get_documents_for_location( 'single' );
			if ( $documents_single ) {
				foreach ( $documents_single as $document ) {
					$this->override_with_post_meta( $document->get_post()->ID );
				}
			}

			// Override post meta for archive pages.
			$documents_archive = Module::instance()->get_conditions_manager()->get_documents_for_location( 'archive' );
			if ( $documents_archive ) {
				foreach ( $documents_archive as $document ) {
					$this->override_with_post_meta( $document->get_post()->ID );
				}
			}
		}

		/**
		 * Override sidebar, title etc with post meta
		 *
		 * @since 1.2.7
		 * @param  integer $post_id  Post ID.
		 * @return void
		 */
		public function override_with_post_meta( $post_id = 0 ) {
			// Override! Page Title.
			$title = get_post_meta( $post_id, 'site-post-title', true );
			if ( 'disabled' === $title ) {

				// Archive page.
				add_filter( 'smvmt_the_title_enabled', '__return_false', 99 );

				// Single page.
				add_filter( 'smvmt_the_title_enabled', '__return_false' );
				remove_action( 'smvmt_archive_header', 'smvmt_archive_page_info' );
			}

			// Override! Sidebar.
			$sidebar = get_post_meta( $post_id, 'site-sidebar-layout', true );
			if ( '' === $sidebar ) {
				$sidebar = 'default';
			}

			if ( 'default' !== $sidebar ) {
				add_filter(
					'smvmt_page_layout',
					function( $page_layout ) use ( $sidebar ) {
						return $sidebar;
					}
				);
			}

			// Override! Content Layout.
			$content_layout = get_post_meta( $post_id, 'site-content-layout', true );
			if ( '' === $content_layout ) {
				$content_layout = 'default';
			}

			if ( 'default' !== $content_layout ) {
				add_filter(
					'smvmt_get_content_layout',
					function( $layout ) use ( $content_layout ) {
						return $content_layout;
					}
				);
			}

			// Override! Footer Bar.
			$footer_layout = get_post_meta( $post_id, 'footer-sml-layout', true );
			if ( '' === $footer_layout ) {
				$footer_layout = 'default';
			}

			if ( 'disabled' === $footer_layout ) {
				add_filter(
					'ast_footer_sml_layout',
					function( $is_footer ) {
						return 'disabled';
					}
				);
			}

			// Override! Footer Widgets.
			$footer_widgets = get_post_meta( $post_id, 'footer-adv-display', true );
			if ( '' === $footer_widgets ) {
				$footer_widgets = 'default';
			}

			if ( 'disabled' === $footer_widgets ) {
				add_filter(
					'SMVMT_advanced_footer_disable',
					function() {
						return true;
					}
				);
			}

			// Override! Header.
			$main_header_display = get_post_meta( $post_id, 'smvmt-main-header-display', true );
			if ( '' === $main_header_display ) {
				$main_header_display = 'default';
			}

			if ( 'disabled' === $main_header_display ) {
				remove_action( 'SMVMT_masthead', 'SMVMT_masthead_primary_template' );
				add_filter(
					'ast_main_header_display',
					function( $display_header ) {
						return 'disabled';
					}
				);
			}
		}

		/**
		 * Header Support
		 *
		 * @since 1.2.7
		 * @return void
		 */
		public function do_header() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'header' );
			if ( $did_location ) {
				remove_action( 'SMVMT_header', 'SMVMT_header_markup' );
			}
		}

		/**
		 * Footer Support
		 *
		 * @since 1.2.7
		 * @return void
		 */
		public function do_footer() {
			$did_location = Module::instance()->get_locations_manager()->do_location( 'footer' );
			if ( $did_location ) {
				remove_action( 'SMVMT_footer', 'SMVMT_footer_markup' );
			}
		}

		/**
		 * Remove theme post's default classes when Elementor's template builder is activated.
		 *
		 * @param  array $classes Post Classes.
		 * @return array
		 * @since  1.4.9
		 */
		public function render_post_class( $classes ) {
			$post_class = array( 'elementor-post elementor-grid-item', 'elementor-portfolio-item' );
			$result     = array_intersect( $classes, $post_class );

			if ( count( $result ) > 0 ) {
				$classes = array_diff(
					$classes,
					array(
						// smvmt common grid.
						'smvmt-col-xs-1',
						'smvmt-col-xs-2',
						'smvmt-col-xs-3',
						'smvmt-col-xs-4',
						'smvmt-col-xs-5',
						'smvmt-col-xs-6',
						'smvmt-col-xs-7',
						'smvmt-col-xs-8',
						'smvmt-col-xs-9',
						'smvmt-col-xs-10',
						'smvmt-col-xs-11',
						'smvmt-col-xs-12',
						'smvmt-col-sm-1',
						'smvmt-col-sm-2',
						'smvmt-col-sm-3',
						'smvmt-col-sm-4',
						'smvmt-col-sm-5',
						'smvmt-col-sm-6',
						'smvmt-col-sm-7',
						'smvmt-col-sm-8',
						'smvmt-col-sm-9',
						'smvmt-col-sm-10',
						'smvmt-col-sm-11',
						'smvmt-col-sm-12',
						'smvmt-col-md-1',
						'smvmt-col-md-2',
						'smvmt-col-md-3',
						'smvmt-col-md-4',
						'smvmt-col-md-5',
						'smvmt-col-md-6',
						'smvmt-col-md-7',
						'smvmt-col-md-8',
						'smvmt-col-md-9',
						'smvmt-col-md-10',
						'smvmt-col-md-11',
						'smvmt-col-md-12',
						'smvmt-col-lg-1',
						'smvmt-col-lg-2',
						'smvmt-col-lg-3',
						'smvmt-col-lg-4',
						'smvmt-col-lg-5',
						'smvmt-col-lg-6',
						'smvmt-col-lg-7',
						'smvmt-col-lg-8',
						'smvmt-col-lg-9',
						'smvmt-col-lg-10',
						'smvmt-col-lg-11',
						'smvmt-col-lg-12',
						'smvmt-col-xl-1',
						'smvmt-col-xl-2',
						'smvmt-col-xl-3',
						'smvmt-col-xl-4',
						'smvmt-col-xl-5',
						'smvmt-col-xl-6',
						'smvmt-col-xl-7',
						'smvmt-col-xl-8',
						'smvmt-col-xl-9',
						'smvmt-col-xl-10',
						'smvmt-col-xl-11',
						'smvmt-col-xl-12',

						// smvmt Blog / Single Post.
						'smvmt-article-post',
						'smvmt-article-single',
						'smvmt-separate-posts',
						'remove-featured-img-padding',
						'smvmt-featured-post',

						// smvmt Woocommerce.
						'smvmt-product-gallery-layout-vertical',
						'smvmt-product-gallery-layout-horizontal',
						'smvmt-product-gallery-with-no-image',

						'smvmt-product-tabs-layout-vertical',
						'smvmt-product-tabs-layout-horizontal',

						'smvmt-qv-disabled',
						'smvmt-qv-on-image',
						'smvmt-qv-on-image-click',
						'smvmt-qv-after-summary',

						'smvmt-woo-hover-swap',

						'box-shadow-0',
						'box-shadow-0-hover',
						'box-shadow-1',
						'box-shadow-1-hover',
						'box-shadow-2',
						'box-shadow-2-hover',
						'box-shadow-3',
						'box-shadow-3-hover',
						'box-shadow-4',
						'box-shadow-4-hover',
						'box-shadow-5',
						'box-shadow-5-hover',
					)
				);
			}

			return $classes;
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	SMVMT_Elementor_Pro::get_instance();

endif;
