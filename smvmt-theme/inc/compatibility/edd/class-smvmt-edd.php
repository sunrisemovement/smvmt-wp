<?php
/**
 * Easy Digital Downloads Compatibility File.
 *
 * @link https://easydigitaldownloads.com/
 *
 * @package smvmt
 */

// If plugin - 'Easy_Digital_Downloads' not exist then return.
if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
	return;
}

/**
 * smvmt Easy Digital Downloads Compatibility
 */
if ( ! class_exists( 'SMVMT_Edd' ) ) :

	/**
	 * smvmt Easy Digital Downloads Compatibility
	 *
	 * @since 1.5.5
	 */
	class SMVMT_Edd {

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

			require_once SMVMT_THEME_DIR . 'inc/compatibility/edd/edd-common-functions.php';

			add_filter( 'smvmt_theme_defaults', array( $this, 'theme_defaults' ) );
			// Register Store Sidebars.
			add_action( 'widgets_init', array( $this, 'store_widgets_init' ), 15 );
			// Replace Edd Store Sidebars.
			add_filter( 'smvmt_get_sidebar', array( $this, 'replace_store_sidebar' ) );
			// Edd Sidebar Layout.
			add_filter( 'smvmt_page_layout', array( $this, 'store_sidebar_layout' ) );
			// Edd Content Layout.
			add_filter( 'smvmt_get_content_layout', array( $this, 'store_content_layout' ) );

			add_filter( 'body_class', array( $this, 'edd_products_item_class' ) );
			add_filter( 'post_class', array( $this, 'edd_single_product_class' ) );
			add_filter( 'post_class', array( $this, 'render_post_class' ), 99 );

			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );

			add_filter( 'smvmt_theme_assets', array( $this, 'add_styles' ) );
			add_filter( 'wp_enqueue_scripts', array( $this, 'add_inline_scripts' ) );
			add_filter( 'SMVMT_dynamic_theme_css', array( $this, 'add_inline_styles' ) );

			add_action( 'wp', array( $this, 'edd_initialization' ) );
			add_action( 'init', array( $this, 'edd_set_defaults_initialization' ) );

			// Add Cart option in dropdown.
			add_filter( 'smvmt_header_section_elements', array( $this, 'header_section_elements' ) );

			// Add Cart icon in Menu.
			add_filter( 'smvmt_get_dynamic_header_content', array( $this, 'smvmt_header_cart' ), 10, 3 );

			add_filter( 'SMVMT_single_post_navigation', array( $this, 'edd_single_post_navigation' ) );
		}

		/**
		 * Disable EDD style only for the first time
		 *
		 * @return void
		 */
		public function edd_set_defaults_initialization() {

			$smvmt_theme_options = get_option( 'smvmt-settings' );
			$edd_settings        = get_option( 'edd_settings' );

			// Set flag to set the EDD style disable only once for the very first time.
			if ( ! isset( $smvmt_theme_options['smvmt-edd-disable-styles'] ) ) {
				$smvmt_theme_options['smvmt-edd-disable-styles'] = true;
				$edd_settings['disable_styles']                = true;
				update_option( 'smvmt-settings', $smvmt_theme_options );
				update_option( 'edd_settings', $edd_settings );
			}

		}

		/**
		 * Single Product Navigation
		 *
		 * @param array $args single products navigation arguments.
		 *
		 * @return array $args single products navigation arguments.
		 */
		public function edd_single_post_navigation( $args ) {
			$is_edd_single_product_page        = smvmt_is_edd_single_product_page();
			$disable_single_product_navigation = smvmt_get_option( 'disable-edd-single-product-nav' );
			if ( $is_edd_single_product_page && ! $disable_single_product_navigation ) {
				$next_post = get_next_post();
				$prev_post = get_previous_post();

				$next_text = false;
				if ( $next_post ) {
					$next_text = sprintf(
						'%s <span class="smvmt-right-arrow">&rarr;</span>',
						$next_post->post_title
					);
				}

				$prev_text = false;
				if ( $prev_post ) {
					$prev_text = sprintf(
						'<span class="smvmt-left-arrow">&larr;</span> %s',
						$prev_post->post_title
					);
				}

				$args['prev_text'] = $prev_text;
				$args['next_text'] = $next_text;
			} elseif ( $is_edd_single_product_page && $disable_single_product_navigation ) {
				$args['prev_text'] = false;
				$args['next_text'] = false;
			}

			return $args;
		}

		/**
		 * EDD Initialization
		 *
		 * @return void
		 */
		public function edd_initialization() {
			$is_edd_archive_page        = smvmt_is_edd_archive_page();
			$is_edd_single_product_page = smvmt_is_edd_single_product_page();

			if ( $is_edd_archive_page ) {
				add_action( 'SMVMT_template_parts_content', array( $this, 'edd_content_loop' ) );
				remove_action( 'SMVMT_template_parts_content', array( SMVMT_Loop::get_instance(), 'template_parts_default' ) );

				// Add edd wrapper.
				add_action( 'SMVMT_template_parts_content_top', array( $this, 'SMVMT_edd_templat_part_wrap_open' ), 25 );
				add_action( 'SMVMT_template_parts_content_bottom', array( $this, 'SMVMT_edd_templat_part_wrap_close' ), 5 );

				// Remove closing and ending div 'smvmt-row'.
				remove_action( 'SMVMT_template_parts_content_top', array( SMVMT_Loop::get_instance(), 'SMVMT_templat_part_wrap_open' ), 25 );
				remove_action( 'SMVMT_template_parts_content_bottom', array( SMVMT_Loop::get_instance(), 'SMVMT_templat_part_wrap_close' ), 5 );
			}
			if ( $is_edd_single_product_page ) {
				remove_action( 'SMVMT_template_parts_content', array( SMVMT_Loop::get_instance(), 'template_parts_post' ) );

				add_action( 'SMVMT_template_parts_content', array( $this, 'edd_single_template' ) );

			}
		}


		/**
		 * Add wrapper for edd archive pages
		 *
		 * @return void
		 */
		public function SMVMT_edd_templat_part_wrap_open() {
			?>
				<div class="smvmt-edd-container">
			<?php
		}

		/**
		 * Add end of wrapper for edd archive pages
		 */
		public function SMVMT_edd_templat_part_wrap_close() {
			?>
				</div> <!-- .smvmt-edd-container -->
			<?php
		}

		/**
		 * Edd Single Product template
		 */
		public function edd_single_template() {

			SMVMT_entry_before();
			?>

			<div <?php post_class(); ?>>

				<?php SMVMT_entry_top(); ?>

				<?php SMVMT_entry_content_single(); ?>

				<?php SMVMT_entry_bottom(); ?>

			</div><!-- #post-## -->

			<?php
			SMVMT_entry_after();
		}

		/**
		 * Add Cart icon markup
		 *
		 * @param Array $options header options array.
		 *
		 * @return Array header options array.
		 * @since 1.5.5
		 */
		public function header_section_elements( $options ) {

			$options['edd'] = __( 'Easy Digital Downloads', 'smvmt' );

			return $options;
		}

		/**
		 * Add wrapper to the edd archive content template
		 *
		 * @return void
		 */
		public function edd_content_loop() {
			?>
			<div <?php post_class(); ?>>
				<?php
				/**
				 * Edd Archive Page Product Content Sorting
				 */
				do_action( 'SMVMT_edd_archive_product_content' );
				?>
			</div>
			<?php
		}



		/**
		 * Remove theme post's default classes when EDD archive.
		 *
		 * @param  array $classes Post Classes.
		 * @return array
		 * @since  1.5.5
		 */
		public function render_post_class( $classes ) {
			$post_class = array( 'smvmt-edd-archive-article' );
			$result     = array_intersect( $classes, $post_class );

			if ( count( $result ) > 0 ) {
				$classes = array_diff(
					$classes,
					array(
						// smvmt common grid.
						'smvmt-col-sm-12',
						'smvmt-col-md-8',
						'smvmt-col-md-6',
						'smvmt-col-md-12',

						// smvmt Blog / Single Post.
						'smvmt-article-post',
						'smvmt-article-single',
						'smvmt-separate-posts',
						'remove-featured-img-padding',
						'smvmt-featured-post',
					)
				);
			}
			return $classes;
		}

		/**
		 * Add Cart icon markup
		 *
		 * @param String $output Markup.
		 * @param String $section Section name.
		 * @param String $section_type Section selected option.
		 * @return Markup String.
		 *
		 * @since 1.5.5
		 */
		public function smvmt_header_cart( $output, $section, $section_type ) {

			if ( 'edd' === $section_type && apply_filters( 'SMVMT_edd_header_cart_icon', true ) ) {

				$output = $this->edd_mini_cart_markup();
			}

			return $output;
		}

		/**
		 * Easy Digital DOwnloads mini cart markup markup
		 *
		 * @since 1.5.5
		 * @return html
		 */
		public function edd_mini_cart_markup() {
			$class = '';
			if ( edd_is_checkout() ) {
				$class = 'current-menu-item';
			}

			$cart_menu_classes = apply_filters( 'SMVMT_edd_cart_in_menu_class', array( 'smvmt-menu-cart-with-border' ) );

			ob_start();
			?>
			<div class="smvmt-edd-site-header-cart <?php echo esc_attr( implode( ' ', $cart_menu_classes ) ); ?>">
				<div class="smvmt-edd-site-header-cart-wrap <?php echo esc_attr( $class ); ?>">
					<?php $this->smvmt_get_edd_cart(); ?>
				</div>
				<?php if ( ! edd_is_checkout() ) { ?>
				<div class="smvmt-edd-site-header-cart-widget">
					<?php
					the_widget( 'edd_cart_widget', 'title=' );
					?>
				</div>
				<?php } ?>
			</div>
			<?php
			return ob_get_clean();
		}

		/**
		 * Cart Link
		 * Displayed a link to the cart including the number of items present and the cart total
		 *
		 * @return void
		 * @since  1.5.5
		 */
		public function smvmt_get_edd_cart() {

			$view_shopping_cart = apply_filters( 'SMVMT_edd_view_shopping_cart_title', __( 'View your shopping cart', 'smvmt' ) );
			$edd_cart_link      = apply_filters( 'SMVMT_edd_cart_link', edd_get_checkout_uri() );
			?>
			<a class="smvmt-edd-cart-container" href="<?php echo esc_url( $edd_cart_link ); ?>" title="<?php echo esc_attr( $view_shopping_cart ); ?>">

						<?php
						do_action( 'SMVMT_edd_header_cart_icons_before' );

						if ( apply_filters( 'SMVMT_edd_default_header_cart_icon', true ) ) {
							?>
							<div class="smvmt-edd-cart-menu-wrap">
								<span class="count">
									<?php
									if ( apply_filters( 'SMVMT_edd_header_cart_total', true ) ) {
										$cart_items = count( edd_get_cart_contents() );
										echo esc_html( $cart_items );
									}
									?>
								</span>
							</div>
							<?php
						}

						do_action( 'SMVMT_edd_header_cart_icons_after' );

						?>
			</a>
			<?php
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since 1.5.5
		 */
		public function add_styles( $assets ) {
			$assets['css']['smvmt-edd'] = 'compatibility/edd';
			return $assets;
		}

		/**
		 * Add inline style
		 *
		 * @since 1.5.5
		 */
		public function add_inline_scripts() {

			// Inline js for EDD Cart updates.
			wp_add_inline_script(
				'edd-ajax',
				"jQuery( document ).ready( function($) {
					/**
					 * smvmt - Easy Digital Downloads Cart Quantity & Total Amount
					 */
					var cartQuantity = jQuery('.smvmt-edd-site-header-cart-wrap .count'),
						iconQuantity = jQuery('.smvmt-edd-site-header-cart-wrap .smvmt-icon'),
						cartTotalAmount = jQuery('.smvmt-edd-site-header-cart-wrap .smvmt-edd-header-cart-total');

					jQuery('body').on('edd_cart_item_added', function( event, response ) {
						cartQuantity.html( response.cart_quantity );
						iconQuantity.attr('data-cart-total', response.cart_quantity );
						cartTotalAmount.html( response.total );
					});

					jQuery('body').on('edd_cart_item_removed', function( event, response ) {
						cartQuantity.html( response.cart_quantity );
						iconQuantity.attr('data-cart-total', response.cart_quantity );
						cartTotalAmount.html( response.total );
					});
				});"
			);

		}

		/**
		 * Dynamic CSS
		 *
		 * @param  string $dynamic_css          smvmt Dynamic CSS.
		 * @param  string $dynamic_css_filtered smvmt Dynamic CSS Filters.
		 * @since 1.5.5
		 * @return string $dynamic_css
		 */
		public function add_inline_styles( $dynamic_css, $dynamic_css_filtered = '' ) {

			/**
			 * - Variable Declaration
			 */

			$site_content_width    = smvmt_get_option( 'site-content-width', 1200 );
			$edd_archive_width     = smvmt_get_option( 'edd-archive-width' );
			$edd_archive_max_width = smvmt_get_option( 'edd-archive-max-width' );
			$css_output            = '';

			$theme_color  = smvmt_get_option( 'theme-color' );
			$link_color   = smvmt_get_option( 'link-color', $theme_color );
			$text_color   = smvmt_get_option( 'text-color' );
			$link_h_color = smvmt_get_option( 'link-h-color' );

			$btn_color = smvmt_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = smvmt_get_foreground_color( $theme_color );
			}

			$btn_h_color = smvmt_get_option( 'button-h-color' );
			if ( empty( $btn_h_color ) ) {
				$btn_h_color = smvmt_get_foreground_color( $link_h_color );
			}
			$btn_bg_color   = smvmt_get_option( 'button-bg-color', $theme_color );
			$btn_bg_h_color = smvmt_get_option( 'button-bg-h-color', $link_h_color );

			$btn_border_radius = smvmt_get_option( 'button-radius' );

			$cart_h_color = smvmt_get_foreground_color( $link_h_color );

			$css_output = array(
				/**
				 * Cart in menu
				 */
				'.smvmt-edd-site-header-cart a'          => array(
					'color' => esc_attr( $text_color ),
				),

				'.smvmt-edd-site-header-cart a:focus, .smvmt-edd-site-header-cart a:hover, .smvmt-edd-site-header-cart .current-menu-item a' => array(
					'color' => esc_attr( $link_color ),
				),

				'.smvmt-edd-cart-menu-wrap .count, .smvmt-edd-cart-menu-wrap .count:after' => array(
					'border-color' => esc_attr( $link_color ),
					'color'        => esc_attr( $link_color ),
				),

				'.smvmt-edd-cart-menu-wrap:hover .count' => array(
					'color'            => esc_attr( $cart_h_color ),
					'background-color' => esc_attr( $link_color ),
				),
				// Loading effect color.
				'a.edd-add-to-cart.white .edd-loading, .edd-discount-loader.edd-loading, .edd-loading-ajax.edd-loading' => array(
					'border-left-color' => esc_attr( $cart_h_color ),
				),

				'.smvmt-edd-site-header-cart .widget_edd_cart_widget .cart-total' => array(
					'color' => esc_attr( $link_color ),
				),

				'.smvmt-edd-site-header-cart .widget_edd_cart_widget .edd_checkout a, .widget_edd_cart_widget .edd_checkout a' => array(
					'color'            => $btn_h_color,
					'border-color'     => $btn_bg_h_color,
					'background-color' => $btn_bg_h_color,
					'border-radius'    => smvmt_get_css_value( $btn_border_radius, 'px' ),
				),
				'.site-header .smvmt-edd-site-header-cart .smvmt-edd-site-header-cart-widget .edd_checkout a, .site-header .smvmt-edd-site-header-cart .smvmt-edd-site-header-cart-widget .edd_checkout a:hover' => array(
					'color' => $btn_color,
				),
				'.below-header-user-select .smvmt-edd-site-header-cart .widget, .smvmt-above-header-section .smvmt-edd-site-header-cart .widget a, .below-header-user-select .smvmt-edd-site-header-cart .widget_edd_cart_widget a' => array(
					'color' => $text_color,
				),
				'.below-header-user-select .smvmt-edd-site-header-cart .widget_edd_cart_widget a:hover, .smvmt-above-header-section .smvmt-edd-site-header-cart .widget_edd_cart_widget a:hover, .below-header-user-select .smvmt-edd-site-header-cart .widget_edd_cart_widget a.remove:hover, .smvmt-above-header-section .smvmt-edd-site-header-cart .widget_edd_cart_widget a.remove:hover' => array(
					'color' => esc_attr( $link_color ),
				),
				'.widget_edd_cart_widget a.edd-remove-from-cart:hover:after' => array(
					'color'            => esc_attr( $link_color ),
					'border-color'     => esc_attr( $link_color ),
					'background-color' => esc_attr( '#ffffff' ),
				),
			);

			/* Parse CSS from array() */
			$css_output = smvmt_parse_css( $css_output );

			/* Easy Digital DOwnloads Shop Archive width */
			if ( 'custom' === $edd_archive_width ) :
				// Easy Digital DOwnloads shop archive custom width.
				$site_width  = array(
					'.smvmt-edd-archive-page .site-content > .smvmt-container' => array(
						'max-width' => smvmt_get_css_value( $edd_archive_max_width, 'px' ),
					),
				);
				$css_output .= smvmt_parse_css( $site_width, '769' );

			else :
				// Easy Digital DOwnloads shop archive default width.
				$site_width = array(
					'.smvmt-edd-archive-page .site-content > .smvmt-container' => array(
						'max-width' => smvmt_get_css_value( $site_content_width + 40, 'px' ),
					),
				);

				/* Parse CSS from array()*/
				$css_output .= smvmt_parse_css( $site_width, '769' );
			endif;

			$dynamic_css .= apply_filters( 'smvmt_theme_edd_dynamic_css', $css_output );

			return $dynamic_css;
		}

		/**
		 * Theme Defaults.
		 *
		 * @param array $defaults Array of options value.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			// Container.
			$defaults['edd-content-layout'] = 'plain-container';

			// // Sidebar.
			$defaults['edd-sidebar-layout']                = 'no-sidebar';
			$defaults['edd-single-product-sidebar-layout'] = 'default';

			// Edd Archive.
			$defaults['edd-archive-grids'] = array(
				'desktop' => 4,
				'tablet'  => 3,
				'mobile'  => 2,
			);

			$defaults['edd-archive-product-structure'] = array(
				'image',
				'category',
				'title',
				'price',
				'add_cart',
			);

			$defaults['edd-archive-add-to-cart-button-text'] = __( 'Add To Cart', 'smvmt' );
			$defaults['edd-archive-variable-button']         = 'button';
			$defaults['edd-archive-variable-button-text']    = __( 'View Details', 'smvmt' );

			$defaults['edd-archive-width']              = 'default';
			$defaults['edd-archive-max-width']          = 1200;
			$defaults['disable-edd-single-product-nav'] = false;

			return $defaults;
		}


		/**
		 * Add products item class to the body
		 *
		 * @param Array $classes product classes.
		 *
		 * @return array.
		 */
		public function edd_products_item_class( $classes = '' ) {

			$is_edd_archive_page = smvmt_is_edd_archive_page();

			if ( $is_edd_archive_page ) {
				$shop_grid = smvmt_get_option( 'edd-archive-grids' );
				$classes[] = 'columns-' . $shop_grid['desktop'];
				$classes[] = 'tablet-columns-' . $shop_grid['tablet'];
				$classes[] = 'mobile-columns-' . $shop_grid['mobile'];

				$classes[] = 'smvmt-edd-archive-page';
			}

			return $classes;
		}

		/**
		 * Add class on single product page
		 *
		 * @param Array $classes product classes.
		 *
		 * @return array.
		 */
		public function edd_single_product_class( $classes ) {

			$is_edd_archive_page = smvmt_is_edd_archive_page();

			if ( $is_edd_archive_page ) {
				$classes[] = 'smvmt-edd-archive-article';
			}

			return $classes;
		}

		/**
		 * Store widgets init.
		 */
		public function store_widgets_init() {
			register_sidebar(
				apply_filters(
					'SMVMT_edd_sidebar_init',
					array(
						'name'          => esc_html__( 'Easy Digital Downloads Sidebar', 'smvmt' ),
						'id'            => 'smvmt-edd-sidebar',
						'description'   => __( 'This sidebar will be used on Product archive, Cart, Checkout and My Account pages.', 'smvmt' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				)
			);
			register_sidebar(
				apply_filters(
					'SMVMT_edd_single_product_sidebar_init',
					array(
						'name'          => esc_html__( 'EDD Single Product Sidebar', 'smvmt' ),
						'id'            => 'smvmt-edd-single-product-sidebar',
						'description'   => __( 'This sidebar will be used on EDD Single Product page.', 'smvmt' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				)
			);
		}

		/**
		 * Assign shop sidebar for store page.
		 *
		 * @param String $sidebar Sidebar.
		 *
		 * @return String $sidebar Sidebar.
		 */
		public function replace_store_sidebar( $sidebar ) {

			$is_edd_page                = smvmt_is_edd_page();
			$is_edd_single_product_page = smvmt_is_edd_single_product_page();

			if ( $is_edd_page && ! $is_edd_single_product_page ) {
				$sidebar = 'smvmt-edd-sidebar';
			} elseif ( $is_edd_single_product_page ) {
				$sidebar = 'smvmt-edd-single-product-sidebar';
			}

			return $sidebar;
		}

		/**
		 * Easy Digital Downloads Container
		 *
		 * @param String $sidebar_layout Layout type.
		 *
		 * @return String $sidebar_layout Layout type.
		 */
		public function store_sidebar_layout( $sidebar_layout ) {

			$is_edd_page                = smvmt_is_edd_page();
			$is_edd_single_product_page = smvmt_is_edd_single_product_page();
			$is_edd_archive_page        = smvmt_is_edd_archive_page();

			if ( $is_edd_page ) {

				$edd_sidebar = smvmt_get_option( 'edd-sidebar-layout' );

				if ( 'default' !== $edd_sidebar ) {

					$sidebar_layout = $edd_sidebar;
				}

				if ( $is_edd_single_product_page ) {
					$edd_single_product_sidebar = smvmt_get_option( 'edd-single-product-sidebar-layout' );

					if ( 'default' !== $edd_single_product_sidebar ) {
						$sidebar_layout = $edd_single_product_sidebar;
					} else {
						$sidebar_layout = smvmt_get_option( 'site-sidebar-layout' );
					}

					$page_id            = get_the_ID();
					$edd_sidebar_layout = get_post_meta( $page_id, 'site-sidebar-layout', true );
				} elseif ( $is_edd_archive_page ) {
					$edd_sidebar_layout = smvmt_get_option( 'edd-sidebar-layout' );
				} else {
					$edd_sidebar_layout = smvmt_get_option_meta( 'site-sidebar-layout', '', true );
				}

				if ( 'default' !== $edd_sidebar_layout && ! empty( $edd_sidebar_layout ) ) {
					$sidebar_layout = $edd_sidebar_layout;
				}
			}

			return $sidebar_layout;
		}
		/**
		 * Easy Digital Downloads Container
		 *
		 * @param String $layout Layout type.
		 *
		 * @return String $layout Layout type.
		 */
		public function store_content_layout( $layout ) {

			$is_edd_page         = smvmt_is_edd_page();
			$is_edd_single_page  = smvmt_is_edd_single_page();
			$is_edd_archive_page = smvmt_is_edd_archive_page();

			if ( $is_edd_page ) {

				$edd_layout = smvmt_get_option( 'edd-content-layout' );

				if ( 'default' !== $edd_layout ) {

					$layout = $edd_layout;
				}

				if ( $is_edd_single_page ) {
					$page_id         = get_the_ID();
					$edd_page_layout = get_post_meta( $page_id, 'site-content-layout', true );
				} elseif ( $is_edd_archive_page ) {
					$edd_page_layout = smvmt_get_option( 'edd-content-layout' );
				} else {
					$edd_page_layout = smvmt_get_option_meta( 'site-content-layout', '', true );
				}

				if ( 'default' !== $edd_page_layout && ! empty( $edd_page_layout ) ) {
					$layout = $edd_page_layout;
				}
			}

			return $layout;
		}

		/**
		 * Register Customizer sections and panel for Easy Digital Downloads.
		 *
		 * @since 1.5.5
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			/**
			 * Register Sections & Panels
			 */
			require SMVMT_THEME_DIR . 'inc/compatibility/edd/customizer/class-smvmt-customizer-register-edd-section.php';

			/**
			 * Sections
			 */
			require SMVMT_THEME_DIR . 'inc/compatibility/edd/customizer/sections/class-smvmt-edd-container-configs.php';
			require SMVMT_THEME_DIR . 'inc/compatibility/edd/customizer/sections/class-smvmt-edd-sidebar-configs.php';
			require SMVMT_THEME_DIR . 'inc/compatibility/edd/customizer/sections/layout/class-smvmt-edd-archive-layout-configs.php';
			require SMVMT_THEME_DIR . 'inc/compatibility/edd/customizer/sections/layout/class-smvmt-edd-single-product-layout-configs.php';

		}

	}

endif;

if ( apply_filters( 'smvmt_enable_edd_integration', true ) ) {
	SMVMT_Edd::get_instance();
}
