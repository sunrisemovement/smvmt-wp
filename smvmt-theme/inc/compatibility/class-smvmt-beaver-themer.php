<?php
/**
 * Beaver Themer Compatibility File.
 *
 * @package smvmt
 */

// If plugin - 'Beaver Themer' not exist then return.
if ( ! class_exists( 'FLThemeBuilderLoader' ) || ! class_exists( 'FLThemeBuilderLayoutData' ) ) {
	return;
}

/**
 * smvmt Beaver Themer Compatibility
 */
if ( ! class_exists( 'SMVMT_Beaver_Themer' ) ) :

	/**
	 * smvmt Beaver Themer Compatibility
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Beaver_Themer {

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
			add_action( 'after_setup_theme', array( $this, 'header_footer_support' ) );
			add_action( 'wp', array( $this, 'theme_header_footer_render' ) );
			add_filter( 'fl_theme_builder_part_hooks', array( $this, 'register_part_hooks' ) );
			add_filter( 'post_class', array( $this, 'render_post_class' ), 99 );
			add_action( 'fl_theme_builder_before_render_content', array( $this, 'builder_before_render_content' ), 10, 1 );
			add_action( 'fl_theme_builder_after_render_content', array( $this, 'builder_after_render_content' ), 10, 1 );
		}

		/**
		 * Builder Template Content layout set as Full Width / Stretched
		 *
		 * @param  string $layout Content Layout.
		 * @return string
		 * @since  1.0.2
		 */
		public function builder_template_content_layout( $layout ) {

			$ids       = FLThemeBuilderLayoutData::get_current_page_content_ids();
			$post_type = get_post_type();

			if ( 'fl-theme-layout' == $post_type ) {
				remove_action( 'SMVMT_entry_after', 'SMVMT_single_post_navigation_markup' );
			}

			if ( empty( $ids ) && 'fl-theme-layout' != $post_type ) {
				return $layout;
			}

			return 'page-builder';
		}

		/**
		 * Remove theme post's default classes
		 *
		 * @param  array $classes Post Classes.
		 * @return array
		 * @since  1.0.2
		 */
		public function render_post_class( $classes ) {

			$post_class = array( 'fl-post-grid-post', 'fl-post-gallery-post', 'fl-post-feed-post' );
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

				add_filter( 'SMVMT_post_link_enabled', '__return_false' );
			}

			return $classes;
		}

		/**
		 * Function to add Theme Support
		 *
		 * @since 1.0.0
		 */
		public function header_footer_support() {

			add_theme_support( 'fl-theme-builder-headers' );
			add_theme_support( 'fl-theme-builder-footers' );
			add_theme_support( 'fl-theme-builder-parts' );
		}

		/**
		 * Function to update Atra header/footer with Beaver template
		 *
		 * @since 1.0.0
		 */
		public function theme_header_footer_render() {

			// Get the header ID.
			$header_ids = FLThemeBuilderLayoutData::get_current_page_header_ids();

			// If we have a header, remove the theme header and hook in Theme Builder's.
			if ( ! empty( $header_ids ) ) {
				remove_action( 'smvmt_header', 'smvmt_header_markup' );
				add_action( 'smvmt_header', 'FLThemeBuilderLayoutRenderer::render_header' );
			}

			// Get the footer ID.
			$footer_ids = FLThemeBuilderLayoutData::get_current_page_footer_ids();

			// If we have a footer, remove the theme footer and hook in Theme Builder's.
			if ( ! empty( $footer_ids ) ) {
				remove_action( 'smvmt_footer', 'smvmt_footer_markup' );
				add_action( 'smvmt_footer', 'FLThemeBuilderLayoutRenderer::render_footer' );
			}

			// BB Themer Support.
			$template_ids = FLThemeBuilderLayoutData::get_current_page_content_ids();

			if ( ! empty( $template_ids ) ) {

				$template_id   = $template_ids[0];
				$template_type = get_post_meta( $template_id, '_fl_theme_layout_type', true );

				if ( 'archive' === $template_type || 'singular' === $template_type || '404' === $template_type ) {

					$sidebar = get_post_meta( $template_id, 'site-sidebar-layout', true );

					if ( 'default' !== $sidebar ) {
						add_filter(
							'smvmt_page_layout',
							function( $page_layout ) use ( $sidebar ) {

								return $sidebar;
							}
						);
					}

					$content_layout = get_post_meta( $template_id, 'site-content-layout', true );
					if ( 'default' !== $content_layout ) {
						add_filter(
							'smvmt_get_content_layout',
							function( $layout ) use ( $content_layout ) {

								return $content_layout;
							}
						);
					}

					$main_header_display = get_post_meta( $template_id, 'smvmt-main-header-display', true );
					if ( 'disabled' === $main_header_display ) {

						if ( 'archive' === $template_type ) {
							remove_action( 'SMVMT_masthead', 'SMVMT_masthead_primary_template' );
						} else {
							add_filter(
								'ast_main_header_display',
								function( $display_header ) {

									return 'disabled';
								}
							);
						}
					}

					$footer_layout = get_post_meta( $template_id, 'footer-sml-layout', true );
					if ( 'disabled' === $footer_layout ) {

						add_filter(
							'ast_footer_sml_layout',
							function( $is_footer ) {

								return 'disabled';
							}
						);
					}

					// Override! Footer Widgets.
					$footer_widgets = get_post_meta( $template_id, 'footer-adv-display', true );
					if ( 'disabled' === $footer_widgets ) {
						add_filter(
							'SMVMT_advanced_footer_disable',
							function() {
								return true;
							}
						);
					}
				}
			}
		}

		/**
		 * Function to smvmt theme parts
		 *
		 * @since 1.0.0
		 */
		public function register_part_hooks() {

			return array(
				array(
					'label' => 'Page',
					'hooks' => array(
						'smvmt_body_top'    => __( 'Before Page', 'smvmt' ),
						'smvmt_body_bottom' => __( 'After Page', 'smvmt' ),
					),
				),
				array(
					'label' => 'Header',
					'hooks' => array(
						'smvmt_header_before' => __( 'Before Header', 'smvmt' ),
						'smvmt_header_after'  => __( 'After Header', 'smvmt' ),
					),
				),
				array(
					'label' => 'Content',
					'hooks' => array(
						'smvmt_primary_content_top'    => __( 'Before Content', 'smvmt' ),
						'smvmt_primary_content_bottom' => __( 'After Content', 'smvmt' ),
					),
				),
				array(
					'label' => 'Footer',
					'hooks' => array(
						'smvmt_footer_before' => __( 'Before Footer', 'smvmt' ),
						'smvmt_footer_after'  => __( 'After Footer', 'smvmt' ),
					),
				),
				array(
					'label' => 'Sidebar',
					'hooks' => array(
						'smvmt_sidebars_before' => __( 'Before Sidebar', 'smvmt' ),
						'smvmt_sidebars_after'  => __( 'After Sidebar', 'smvmt' ),
					),
				),
				array(
					'label' => 'Posts',
					'hooks' => array(
						'loop_start'                 => __( 'Loop Start', 'smvmt' ),
						'SMVMT_entry_top'            => __( 'Before Post', 'smvmt' ),
						'SMVMT_entry_content_before' => __( 'Before Post Content', 'smvmt' ),
						'SMVMT_entry_content_after'  => __( 'After Post Content', 'smvmt' ),
						'SMVMT_entry_bottom'         => __( 'After Post', 'smvmt' ),
						'SMVMT_comments_before'      => __( 'Before Comments', 'smvmt' ),
						'SMVMT_comments_after'       => __( 'After Comments', 'smvmt' ),
						'loop_end'                   => __( 'Loop End', 'smvmt' ),
					),
				),
			);
		}

		/**
		 * Function to theme before render content
		 *
		 * @param int $post_id Post ID.
		 * @since 1.0.28
		 */
		public function builder_before_render_content( $post_id ) {

			?>
			<?php if ( 'left-sidebar' === smvmt_page_layout() ) : ?>

				<?php get_sidebar(); ?>

			<?php endif ?>

			<div id="primary" <?php smvmt_primary_class(); ?>>
			<?php
		}

		/**
		 * Function to theme after render content
		 *
		 * @param int $post_id Post ID.
		 * @since 1.0.28
		 */
		public function builder_after_render_content( $post_id ) {

			?>
			</div><!-- #primary -->

			<?php if ( 'right-sidebar' === smvmt_page_layout() ) : ?>

				<?php get_sidebar(); ?>

			<?php endif ?>

			<?php
		}

	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
SMVMT_Beaver_Themer::get_instance();
