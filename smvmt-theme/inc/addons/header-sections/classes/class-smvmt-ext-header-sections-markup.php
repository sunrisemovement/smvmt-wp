<?php
/**
 * Advanced Header Markup
 *
 * @package smvmt
 */

if ( ! class_exists( 'SMVMT_Ext_Header_Sections_Markup' ) ) {

	/**
	 * Advanced Header Markup Initial Setup
	 *
	 * @since 1.0.0
	 */
	class SMVMT_Ext_Header_Sections_Markup {

		/**
		 * Member Varible
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

			add_action( 'smvmt_masthead_toggle_buttons', array( $this, 'smvmt_masthead_toggle_buttons_primary' ), 10 );
			add_action( 'smvmt_masthead_content', array( $this, 'enable_primary_menu_button' ), 8 );
			add_action( 'smvmt_masthead_content', array( $this, 'below_above_header_content' ), 9 );
			add_filter( 'smvmt_masthead_get_menu_items', array( $this, 'smvmt_masthead_get_menu_items' ) );

			/**
			* Merge Above / Below Header into Primary menu for responsive devices
			*/
			add_filter( 'wp_page_menu_args', array( $this, 'merge_custom_page_menu_header_sections' ), 10, 2 );
			add_filter( 'wp_nav_menu_items', array( $this, 'merge_custom_nav_menu_header_sections' ), 9, 2 );

			/* Add Body Classes */
			add_filter( 'body_class', array( $this, 'body_classes' ), 10, 1 );
			add_filter( 'smvmt_header_class', array( $this, 'header_classes' ), 10, 1 );

			add_filter( 'smvmt_above_header_merged_responsive', array( $this, 'above_header_merged_disable' ) );
			add_filter( 'smvmt_below_header_merged_responsive', array( $this, 'below_header_merged_disable' ) );

			// Above Header markup control.
			add_filter( 'smvmt_above_header_disable', array( $this, 'above_header_disable' ) );
			// Below Header markup control.
			add_filter( 'smvmt_below_header_disable', array( $this, 'below_header_disable' ) );

			/* Register Menu Location & Widget*/
			add_action( 'init', array( $this, 'register_menu_locations_widgets' ) );

			/* Add HTML Markup Above Header */
			add_action( 'smvmt_masthead', array( $this, 'above_header_html_markup_loader' ), 9 );
			add_action( 'smvmt_above_header_toggle_buttons', array( $this, 'above_header_toggle_button' ), 10 );

			/* Add HTML Markup Below Header */
			add_action( 'smvmt_masthead', array( $this, 'below_header_html_markup_loader' ), 11 );
			add_action( 'smvmt_below_header_toggle_buttons', array( $this, 'below_header_toggle_button' ), 11 );

			add_action( 'smvmt_get_css_files', array( $this, 'add_styles' ) );
			add_action( 'smvmt_get_js_files', array( $this, 'add_scripts' ) );
			add_action( 'smvmt_get_fonts', array( $this, 'add_fonts' ), 1 );

			/**
			* Metabox setup
			*/
			add_filter( 'smvmt_meta_box_options', array( $this, 'add_options' ) );
			add_action( 'smvmt_meta_box_markup_disable_sections_after_primary_header', array( $this, 'add_options_markup' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );

		}

		/**
		 * Load page builder scripts and styles.
		 *
		 * @access public
		 * @return void
		 */
		public function load_scripts() {

			$above_menu_animation = smvmt_get_option( 'above-header-submenu-container-animation' );
			$below_menu_animation = smvmt_get_option( 'below-header-submenu-container-animation' );

			if ( ! empty( $above_menu_animation ) || ! empty( $below_menu_animation ) ) {
				wp_enqueue_style( 'smvmt-menu-animation' );
			}
		}

		/**
		 * Header toggle buttons
		 *
		 * => Used in files:
		 *
		 * /header.php
		 *
		 * @since 1.0.0
		 */
		public function smvmt_masthead_toggle_buttons_primary() {
			$disable_primary_navigation = smvmt_get_option( 'disable-primary-nav' );
			$custom_header_section      = smvmt_get_option( 'header-main-rt-section' );
			$above_header               = $this->smvmt_above_header_enabled();
			$below_header               = $this->smvmt_below_header_enabled();
			$merged_above_header        = $this->smvmt_above_header_merged_enabled();
			$merged_below_header        = $this->smvmt_below_header_merged_enabled();

			$display_outside_menu   = smvmt_get_option( 'header-display-outside-menu' );
			$above_header_on_mobile = smvmt_get_option( 'above-header-on-mobile' );
			$below_header_on_mobile = smvmt_get_option( 'below-header-on-mobile' );

			if ( $disable_primary_navigation && ( 'none' == $custom_header_section || ( 'none' != $custom_header_section && $display_outside_menu ) ) && ( $above_header || $below_header ) && ( $merged_above_header || $merged_below_header ) && ( $above_header_on_mobile || $below_header_on_mobile ) ) {
				$menu_title          = trim( apply_filters( 'smvmt_main_menu_toggle_label', smvmt_get_option( 'header-main-menu-label' ) ) );
				$menu_icon           = apply_filters( 'smvmt_main_menu_toggle_icon', 'menu-toggle-icon' );
				$menu_label_class    = '';
				$screen_reader_title = __( 'Main Menu', 'smvmt-addon' );
				if ( '' !== $menu_title ) {
					$menu_label_class    = 'smvmt-menu-label';
					$screen_reader_title = $menu_title;
				}

				$menu_label_class = apply_filters( 'smvmt_main_menu_toggle_classes', $menu_label_class );
				?>
			<div class="smvmt-button-wrap">
			<button type="button" class="menu-toggle main-header-menu-toggle <?php echo esc_attr( $menu_label_class ); ?>" aria-controls='primary-menu' aria-expanded='false'>
				<span class="screen-reader-text"><?php echo esc_html( $screen_reader_title ); ?></span>
				<span class="<?php echo esc_attr( $menu_icon ); ?>"></span>
				<?php if ( '' != $menu_title ) { ?>

					<div class="mobile-menu-wrap">
						<span class="mobile-menu"><?php echo esc_html( $menu_title ); ?></span>
					</div>

				<?php } ?>
			</button>
		</div>
				<?php
			}
		}

		/**
		 * Header toggle buttons
		 *
		 * @since 1.0.0
		 */
		public function enable_primary_menu_button() {
			$disable_primary_navigation = smvmt_get_option( 'disable-primary-nav' );
			$custom_header_section      = smvmt_get_option( 'header-main-rt-section' );
			$above_header               = $this->smvmt_above_header_enabled();
			$below_header               = $this->smvmt_below_header_enabled();

			$above_header_on_mobile = smvmt_get_option( 'above-header-on-mobile' );
			$below_header_on_mobile = smvmt_get_option( 'below-header-on-mobile' );

			if ( $disable_primary_navigation && 'none' == $custom_header_section && ( $above_header || $below_header ) && ( $above_header_on_mobile || $below_header_on_mobile ) ) {
				add_filter( 'smvmt_enable_mobile_menu_buttons', '__return_true' );
			}
		}


		/**
		 * Header Sections content if Primary Menu and Custom menu items are disabled
		 *
		 * @since 1.0.0
		 */
		public function below_above_header_content() {
			$disable_primary_navigation = smvmt_get_option( 'disable-primary-nav' );
			$custom_header_section      = smvmt_get_option( 'header-main-rt-section' );
			$above_header               = $this->smvmt_above_header_enabled();
			$below_header               = $this->smvmt_below_header_enabled();

			$above_header_on_mobile = smvmt_get_option( 'above-header-on-mobile' );
			$below_header_on_mobile = smvmt_get_option( 'below-header-on-mobile' );

			if ( $disable_primary_navigation && 'none' == $custom_header_section && ( $above_header || $below_header ) && ( $above_header_on_mobile || $below_header_on_mobile ) ) {

				add_filter( 'smvmt_enable_mobile_menu_buttons', '__return_true' );

				$above_header_markup = $this->smvmt_get_above_header_items();
				$below_header_markup = $this->smvmt_get_below_header_items();
				?>
				<div class="main-header-bar-navigation smvmt-header-sections-navigation">
					<nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" class="smvmt-flex-grow-1 navigation-accessibility" aria-label="<?php esc_attr_e( 'Site Navigation', 'smvmt-addon' ); ?>">

							<?php do_action( 'smvmt_merge_header_before_menu' ); ?>

							<?php echo $above_header_markup . $below_header_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

							<?php do_action( 'smvmt_merge_header_after_menu' ); ?>
					</div>
				<?php
			}
		}

		/**
		 * Header Sections content if Primary Menu  disabled and Custom menu item is not none
		 *
		 * @since 1.0.0
		 * @param  array $items Nav menu item array.
		 */
		public function smvmt_masthead_get_menu_items( $items ) {
			$disable_primary_navigation = smvmt_get_option( 'disable-primary-nav' );
			$custom_header_section      = smvmt_get_option( 'header-main-rt-section' );
			$above_header               = $this->smvmt_above_header_enabled();
			$below_header               = $this->smvmt_below_header_enabled();

			$display_outside_menu   = smvmt_get_option( 'header-display-outside-menu' );
			$above_header_on_mobile = smvmt_get_option( 'above-header-on-mobile' );
			$below_header_on_mobile = smvmt_get_option( 'below-header-on-mobile' );

			if ( ( $above_header || $below_header ) && ( $above_header_on_mobile || $below_header_on_mobile ) ) {
				if ( $disable_primary_navigation && ( 'none' != $custom_header_section && ! $display_outside_menu ) ) {
					$above_header_markup = $this->smvmt_get_above_header_items();
					$below_header_markup = $this->smvmt_get_below_header_items();
					$items               = $above_header_markup . $below_header_markup . $items;
				} elseif ( $disable_primary_navigation && 'none' != $custom_header_section && $display_outside_menu ) {
					// Disable Primary menu,
					// Custom Menu Item & Take custom menu item outside enabled,
					// Merge Above Header menu with primary menu in responsive,
					// Merge Below Header menu with primary menu in responsive.
					// for all above condition add a primary menu wrapper class to the Above Header & Below Header menu.
					$above_header_markup = $this->smvmt_get_above_header_items();
					$below_header_markup = $this->smvmt_get_below_header_items();

					$nav_wrap       = apply_filters(
						'smvmt_merge_header_custom_menu_item_wrap',
						'<div class="main-header-bar-navigation smvmt-header-sections-navigation">
						<nav itemtype="https://schema.org/SiteNavigationElement" itemscope="itemscope" id="site-navigation" class="smvmt-flex-grow-1 navigation-accessibility" aria-label="' . esc_attr__( 'Site Navigation', 'smvmt-addon' ) . '">'
					);
					$nav_wrap_close = apply_filters( 'smvmt_merge_header_before_custom_menu_item', '</div></nav>' );

					$items = $nav_wrap . $above_header_markup . $below_header_markup . $nav_wrap_close . $items;
				}
			}
			return $items;
		}

		/**
		 * Header Custom Menu Item
		 *
		 * => Used in files:
		 *
		 * /header.php
		 *
		 * @since 1.0.0
		 * @param  array $items Nav menu item array.
		 * @param  array $args  Nav menu item arguments array.
		 * @return array       Modified menu item array.
		 */
		public function merge_custom_nav_menu_header_sections( $items, $args ) {

			if ( isset( $args->theme_location ) ) {

				if ( 'primary' === $args->theme_location ) {
					$above_header_markup = $this->smvmt_get_above_header_items();
					if ( $above_header_markup ) {
						$items .= $above_header_markup;
					}
					$below_header_markup = $this->smvmt_get_below_header_items();
					if ( $below_header_markup ) {
						$items .= $below_header_markup;
					}
				}
			}

			return $items;

		}

		/**
		 * Header Custom Menu Item
		 *
		 * => Used in files:
		 *
		 * /header.php
		 *
		 * @since 1.0.0
		 * @param  array $args Array of arguments.
		 * @return array       Modified menu item array.
		 */
		public function merge_custom_page_menu_header_sections( $args ) {

			if ( isset( $args['theme_location'] ) ) {

				if ( 'primary' === $args['theme_location'] ) {
					$markup              = '';
					$above_header_markup = $this->smvmt_get_above_header_items();
					if ( $above_header_markup ) {
						$markup .= $above_header_markup;
					}

					$below_header_markup = $this->smvmt_get_below_header_items();
					if ( $below_header_markup ) {
						$markup .= $below_header_markup;
					}
					if ( $above_header_markup || $below_header_markup ) {
						$args['after'] = $markup . $args['after'];
					}
				}
			}

			return $args;
		}

		/**
		 * Custom Above Header Menu Item Markup
		 *
		 * => Used in hooks:
		 *
		 * @see smvmt_masthead_get_menu_items
		 * @see smvmt_masthead_custom_nav_menu_items
		 *
		 * @since 1.0.0
		 */
		public function smvmt_get_above_header_items() {
			if ( function_exists( 'ubermenu_automatic_integration_filter' ) ) {
				remove_filter( 'wp_nav_menu_args', 'ubermenu_automatic_integration_filter', 1000 );
			}
			$markup = '';

			// Above Header Menu nmerged with Primary Menu for resonsive devices.
			$above_header_menu_args = array(
				'theme_location' => 'above_header_menu',
				'container'      => false,
				'fallback_cb'    => false,
				'echo'           => true,
				'items_wrap'     => '<div class="smvmt-above-header-menu-items"> %3$s </div>',
			);

			$mobile_menu_style = smvmt_get_option( 'mobile-menu-style' );

			// If menu style is no toggle, remove item wrap div from above header menu.
			if ( 'no-toggle' == $mobile_menu_style ) {
				$above_header_menu_args['items_wrap'] = '%3$s';
			}

			$above_header_on_mobile = smvmt_get_option( 'above-header-on-mobile' );

			$above_header_enabled     = $this->smvmt_above_header_enabled();
			$above_header_layout      = smvmt_get_option( 'above-header-layout' );
			$above_header_layout_meta = smvmt_get_option_meta( 'smvmt-above-header-display' );

			// Above Header is merged with primary menu.
			if ( $this->smvmt_above_header_merged_enabled() && $above_header_on_mobile ) {
				ob_start();

				if ( has_nav_menu( 'above_header_menu' ) ) {

					if ( $above_header_enabled ) {

						$above_section_1 = smvmt_get_option( 'above-header-section-1' );
						$above_section_2 = smvmt_get_option( 'above-header-section-2' );

						if ( ( 'menu' === $above_section_1 && 'above-header-layout-1' === $above_header_layout ) || ( 'menu' === $above_section_2 && 'above-header-layout-1' === $above_header_layout ) || ( 'menu' === $above_section_1 && 'above-header-layout-2' === $above_header_layout ) ) {

								wp_nav_menu( $above_header_menu_args );
						}
					}
				}
				$markup = ob_get_clean();
			}
			if ( function_exists( 'ubermenu_automatic_integration_filter' ) ) {
				add_filter( 'wp_nav_menu_args', 'ubermenu_automatic_integration_filter', 1000 );
			}
			return apply_filters( 'smvmt_get_above_header_items', $markup );
		}

		/**
		 * Custom Below Header Menu Item Markup
		 *
		 * => Used in hooks:
		 *
		 * @see smvmt_masthead_get_menu_items
		 * @see smvmt_masthead_custom_nav_menu_items
		 *
		 * @since 1.0.0
		 */
		public function smvmt_get_below_header_items() {
			if ( function_exists( 'ubermenu_automatic_integration_filter' ) ) {
				remove_filter( 'wp_nav_menu_args', 'ubermenu_automatic_integration_filter', 1000 );
			}
			$markup                 = '';
			$below_header_on_mobile = smvmt_get_option( 'below-header-on-mobile' );

			$below_header_enabled     = $this->smvmt_below_header_enabled();
			$below_header_layout      = smvmt_get_option( 'below-header-layout' );
			$below_header_layout_meta = smvmt_get_option_meta( 'smvmt-below-header-display' );
			// Menu arguments.
			$below_header_menu_args = array(
				'theme_location' => 'below_header_menu',
				'container'      => false,
				'fallback_cb'    => false,
				'echo'           => true,
				'items_wrap'     => '<ul class="smvmt-below-header-menu-items"> %3$s </ul>',
			);

			$mobile_menu_style = smvmt_get_option( 'mobile-menu-style' );

			// If menu style is no toggle, remove item wrap div from above header menu.
			if ( 'no-toggle' == $mobile_menu_style ) {
				$below_header_menu_args['items_wrap'] = '%3$s';
			}

			if ( $this->smvmt_below_header_merged_enabled() && $below_header_on_mobile ) {
				ob_start();

					$below_section_1 = smvmt_get_option( 'below-header-section-1' );
					$below_section_2 = smvmt_get_option( 'below-header-section-2' );
				if ( $below_header_enabled ) {
					if ( has_nav_menu( 'below_header_menu' ) ) {

						if ( ( 'menu' === $below_section_1 && 'below-header-layout-1' === $below_header_layout ) || ( 'menu' === $below_section_2 && 'below-header-layout-1' === $below_header_layout ) || ( 'menu' === $below_section_1 && 'below-header-layout-2' === $below_header_layout ) ) {

								wp_nav_menu( $below_header_menu_args );
						}
					}
					?>

					<div class="smvmt-below-header-custom-menu-items smvmt-container">
					<?php
					// Left sections.
					if ( 'menu' !== $below_section_1 ) {
						self::get_below_header_section( 'below-header-section-1' );
					}
					// Right sections.
					if ( 'menu' !== $below_section_2 && 'below-header-layout-1' === $below_header_layout ) {
						self::get_below_header_section( 'below-header-section-2' );
					}
					?>
					</div>
					<?php
				}
				$markup = ob_get_clean();
			}
			if ( function_exists( 'ubermenu_automatic_integration_filter' ) ) {
				add_filter( 'wp_nav_menu_args', 'ubermenu_automatic_integration_filter', 1000 );
			}
			return apply_filters( 'smvmt_get_below_header_items', $markup );
		}

		/**
		 * Check option if above header merge is enabled.
		 *
		 * @param bool $is_merged Is menu should merge.
		 * @since 1.0.4
		 * @return bool
		 */
		public function above_header_merged_disable( $is_merged ) {

			$is_merged = smvmt_get_option( 'above-header-merge-menu' );

			return $is_merged;
		}

		/**
		 * Check option if below header merge is enabled.
		 *
		 * @param bool $is_merged Is menu should merge.
		 * @since 1.0.4
		 * @return bool
		 */
		public function below_header_merged_disable( $is_merged ) {

			$is_merged = smvmt_get_option( 'below-header-merge-menu' );

			return $is_merged;
		}

		/**
		 * Load Above Header markup IF enabled from Advanced HEaders
		 *
		 * @since 1.0.0
		 * @return bool
		 */
		public function above_header_disable() {
			// Check if Advanced Headers is active
			// if ( SMVMT_Ext_Extension::is_active( 'advanced-headers' ) ) {
			// 	// Above Header meta from the Advanced Headers.
			// 	$above_header = SMVMT_Ext_Advanced_Headers_Loader::smvmt_advanced_headers_layout_option( 'above-header-enabled' );
			// 	// Above Header layout from the customizer.
			// 	$above_header_layout = smvmt_get_option( 'above-header-layout' );

			// 	if ( 'disabled' != $above_header_layout && ( SMVMT_Ext_Advanced_Headers_Markup::advanced_header_enabled() && ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) ) ) {
			// 		return false;
			// 	} elseif ( 'enabled' != $above_header && 'disabled' != $above_header_layout && SMVMT_Ext_Advanced_Headers_Markup::advanced_header_enabled() ) {
			// 		return true;
			// 	}
			// }
			return false;
		}

		/**
		 * Load Below Header markup IF enabled from Advanced HEaders
		 *
		 * @since 1.0.0
		 * @return bool
		 */
		public function below_header_disable() {
			// Check if Advanced Headers is active
			// if ( SMVMT_Ext_Extension::is_active( 'advanced-headers' ) ) {
			// 	// Below Header meta from the Advanced Headers.
			// 	$below_header = SMVMT_Ext_Advanced_Headers_Loader::smvmt_advanced_headers_layout_option( 'below-header-enabled' );
			// 	// Below Header layout from the customizer.
			// 	$below_header_layout = smvmt_get_option( 'below-header-layout' );

			// 	if ( 'disabled' != $below_header_layout && ( SMVMT_Ext_Advanced_Headers_Markup::advanced_header_enabled() && ( is_front_page() && 'posts' == get_option( 'show_on_front' ) ) ) ) {
			// 		return false;
			// 	} elseif ( 'enabled' != $below_header && 'disabled' != $below_header_layout && SMVMT_Ext_Advanced_Headers_Markup::advanced_header_enabled() ) {
			// 		return true;
			// 	}
			// }
			return false;
		}

		/**
		 * Add Body Classes
		 *
		 * @param array $classes Body Class Array.
		 * @return array
		 */
		public function body_classes( $classes ) {
			// Apply Above Below header layout class to the body.
			$above_header_on_mobile = smvmt_get_option( 'above-header-on-mobile' );
			$below_header_on_mobile = smvmt_get_option( 'below-header-on-mobile' );

			$below_header_enabled       = $this->smvmt_below_header_enabled();
			$below_header_hover_bg      = smvmt_get_option( 'below-header-menu-bg-hover-color-responsive' );
			$below_header_active_bg     = smvmt_get_option( 'below-header-current-menu-bg-color-responsive' );
			$below_header_menu_bg_color = smvmt_get_option( 'below-header-menu-bg-obj-responsive' );
			$below_header_menu_bg_color = array( $below_header_menu_bg_color['desktop']['background-color'], $below_header_menu_bg_color['tablet']['background-color'], $below_header_menu_bg_color['mobile']['background-color'] );

			$below_hover_bg_count  = count( array_filter( $below_header_hover_bg ) );
			$below_active_bg_count = count( array_filter( $below_header_active_bg ) );
			$below_header_bg_count = count( array_filter( $below_header_menu_bg_color ) );

			if ( $below_header_enabled && 0 == $below_hover_bg_count && 0 == $below_active_bg_count && 0 == $below_header_bg_count ) {
				$classes[] = 'below-header-nav-padding-support';
			}

			// Apply Above Header header layout class to the body.
			$above_header_enabled   = $this->smvmt_above_header_enabled();
			$above_header_hover_bg  = smvmt_get_option( 'above-header-menu-h-bg-color-responsive' );
			$above_header_active_bg = smvmt_get_option( 'above-header-menu-active-bg-color-responsive' );

			$above_header_menu_bg_color     = smvmt_get_option( 'above-header-menu-bg-obj-responsive' );
			$above_header_menu_bg_color     = array( $above_header_menu_bg_color['desktop']['background-color'], $above_header_menu_bg_color['tablet']['background-color'], $above_header_menu_bg_color['mobile']['background-color'] );
			$above_hover_bg_count           = count( array_filter( $above_header_hover_bg ) );
			$above_active_bg_count          = count( array_filter( $above_header_active_bg ) );
			$above_header_menu_bg_color_cnt = count( array_filter( $above_header_menu_bg_color ) );

			if ( $above_header_enabled && 0 == $above_hover_bg_count && 0 == $above_active_bg_count && 0 == $above_header_menu_bg_color_cnt ) {
				$classes[] = 'above-header-nav-padding-support';
			}

			if ( ! $above_header_on_mobile ) {
				$classes[] = 'smvmt-above-header-hide-on-mobile';
			}

			if ( ! $below_header_on_mobile ) {
				$classes[] = 'smvmt-below-header-hide-on-mobile';
			}

			return $classes;
		}

		/**
		 * Add Header Classes
		 *
		 * @param array $classes Header Class Array.
		 * @return array
		 */
		public function header_classes( $classes ) {
				// Apply Above header layout class to the header.
				$above_header_enabled = $this->smvmt_above_header_enabled();

				$above_header_layout = smvmt_get_option( 'above-header-layout' );
				$above_header_swap   = smvmt_get_option( 'above-header-swap-mobile' );
				$above_header_merge  = smvmt_get_option( 'above-header-merge-menu' );

			if ( $above_header_enabled ) {
					$classes[] = 'smvmt-above-header-enabled';
				if ( $this->smvmt_above_header_merged_enabled() && $this->smvmt_above_header_has_menu() ) {
					$classes[] = 'smvmt-above-header-merged-responsive';
				} else {
					$classes[] = 'smvmt-above-header-section-separated';
				}
			}

			if ( $above_header_enabled && $above_header_swap && 'above-header-layout-1' === $above_header_layout ) {
				$classes[] = 'smvmt-swap-above-header-sections';
			}

				// Apply Below header layout class to the header.
				$below_header_enabled = $this->smvmt_below_header_enabled();
			if ( $below_header_enabled ) {
					$classes[] = 'smvmt-below-header-enabled';
				if ( $this->smvmt_below_header_merged_enabled() && $this->smvmt_below_header_has_menu() ) {
					$classes[] = 'smvmt-below-header-merged-responsive';
				} else {
					$classes[] = 'smvmt-below-header-section-separated';
				}
			}

			$below_header_layout = smvmt_get_option( 'below-header-layout' );
			$below_header_swap   = smvmt_get_option( 'below-header-swap-mobile' );
			$below_header_merge  = smvmt_get_option( 'below-header-merge-menu' );

			if ( $below_header_enabled && $below_header_swap && ! $below_header_merge && 'below-header-layout-1' === $below_header_layout ) {
				$classes[] = 'smvmt-swap-below-header-sections';
			}

			// Apply Above / Below header mobile align class.
			$classes[] = 'smvmt-above-header-mobile-' . smvmt_get_option( 'above-header-menu-align' );
			$classes[] = 'smvmt-below-header-mobile-' . smvmt_get_option( 'below-header-menu-align' );

			return $classes;
		}

		/**
		 * Above Header status
		 */
		public function smvmt_above_header_enabled() {
			$above_header_layout = smvmt_get_option( 'above-header-layout' );
			$above_header_meta   = smvmt_get_option_meta( 'smvmt-above-header-display' );
			if ( ! apply_filters( 'smvmt_above_header_disable', false ) && 'disabled' != $above_header_layout && 'disabled' != $above_header_meta ) {
				return true;
			}
			return false;
		}

		/**
		 * Above Header has menu
		 */
		public function smvmt_above_header_has_menu() {
			$above_header_layout = smvmt_get_option( 'above-header-layout' );
			$above_section_1     = smvmt_get_option( 'above-header-section-1' );
			$above_section_2     = smvmt_get_option( 'above-header-section-2' );
			if ( ( ( 'above-header-layout-1' == $above_header_layout && ( 'menu' == $above_section_1 || 'menu' == $above_section_2 ) ) || ( 'above-header-layout-2' == $above_header_layout && 'menu' == $above_section_1 ) ) ) {
				return true;
			}
			return false;
		}

		/**
		 * Below Header has menu
		 */
		public function smvmt_below_header_has_menu() {
			$below_header_layout = smvmt_get_option( 'below-header-layout' );
			$below_section_1     = smvmt_get_option( 'below-header-section-1' );
			$below_section_2     = smvmt_get_option( 'below-header-section-2' );
			if ( ( ( 'below-header-layout-1' == $below_header_layout && ( 'menu' == $below_section_1 || 'menu' == $below_section_2 ) ) || ( 'below-header-layout-2' == $below_header_layout && 'menu' == $below_section_1 ) ) ) {
				return true;
			}
			return false;
		}

		/**
		 * Below Header status
		 */
		public function smvmt_below_header_enabled() {
			$below_header_layout = smvmt_get_option( 'below-header-layout' );
			$below_header_meta   = smvmt_get_option_meta( 'smvmt-below-header-display' );
			if ( ! apply_filters( 'smvmt_below_header_disable', false ) && 'disabled' != $below_header_layout && 'disabled' != $below_header_meta ) {
				return true;
			}
			return false;
		}

		/**
		 * Above Header Merge status
		 */
		public function smvmt_above_header_merged_enabled() {
			return apply_filters( 'smvmt_above_header_merged_responsive', true );
		}

		/**
		 * Below Header Merge status
		 */
		public function smvmt_below_header_merged_enabled() {
			return apply_filters( 'smvmt_below_header_merged_responsive', true );
		}

		/**
		 * Function to get Above Header Section
		 *
		 * @param string $option Above Header Menu Option.
		 * @return mixed
		 */
		public static function get_above_header_section( $option ) {

			$value  = smvmt_get_option( $option );
			$output = '';

			if ( 'above-header-section-1' == $option ) {
				$above_header_widget = 'above-header-widget-1';
			}

			if ( 'above-header-section-2' == $option ) {
				$above_header_widget = 'above-header-widget-2';
			}

			switch ( $value ) {

				case 'search':
				case 'text-html':
					$sections = smvmt_get_dynamic_header_content( $option );

					if ( is_array( $sections ) && 0 < count( $sections ) ) {
						foreach ( $sections as $key => $value ) {
							$output .= '<div class="user-select">';
							$output .= $value;
							$output .= '</div> <!-- .user-select -->';
						}
					}
					break;

				case 'menu':
									$output .= self::above_header_menu( $option );
					break;

				case 'widget':
									$output .= '<div class="above-header-widget">';
									ob_start();
									smvmt_get_sidebar( $above_header_widget );
									$output .= ob_get_clean();
									$output .= '</div> <!-- .above-header-widget -->';
					break;

				default:
									$output = apply_filters( 'smvmt_get_dynamic_header_content', '', $option, $value );
					break;
			}

			return $output;
		}

		/**
		 * Function to get Above Header Menu
		 *
		 * @param string $option Above Header Menu Option.
		 * @return mixed
		 */
		public static function above_header_menu( $option ) {

			/**
			 * Filter the classes(array) for Above Header Menu (<ul>).
			 *
			 * @since  1.6.0
			 * @var Array
			 */
			$above_header_menu_classes = apply_filters( 'smvmt_above_header_menu_classes', array( 'smvmt-above-header-menu', 'smvmt-nav-menu', 'smvmt-flex' ) );

			// Menu Animation.
			$menu_animation = smvmt_get_option( 'above-header-submenu-container-animation' );
			if ( ! empty( $menu_animation ) ) {
				$above_header_menu_classes[] = 'smvmt-menu-animation-' . esc_html( $menu_animation );
			}

			if ( 'above-header-section-2' == $option ) {
				$above_header_menu_classes[] = 'smvmt-justify-content-flex-end';
				$above_header_menu_id        = 'smvmt-above-header-navigation-section-2';
			} else {
				$above_header_menu_classes[] = 'smvmt-justify-content-flex-start';
				$above_header_menu_id        = 'smvmt-above-header-navigation-section-1';
			}

			// Submenu with border class.
			$above_header_menu_classes[] = 'submenu-with-border';

			ob_start();

			do_action( 'smvmt_above_header_toggle_buttons' );

			if ( has_nav_menu( 'above_header_menu' ) ) {

				/**
				 * Fires before the Above Header Menu
				 *
				 * @since 1.4.0
				 */
				do_action( 'smvmt_above_header_before_menu' );

				wp_nav_menu(
					array(
						'container'       => 'div',
						'container_class' => 'smvmt-above-header-navigation navigation-accessibility',
						'container_id'    => $above_header_menu_id,
						'theme_location'  => 'above_header_menu',
						'id'              => 'above_header-menu',
						'menu_class'      => esc_attr( implode( ' ', $above_header_menu_classes ) ),
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);

				/**
				 * Fires after the Above Header Menu
				 *
				 * @since 1.4.0
				 */
				do_action( 'smvmt_above_header_after_menu' );

			} else {
				if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {
					?>
					<a href="<?php echo esc_url( admin_url( '/nav-menus.php?action=locations' ) ); ?>"><?php esc_html_e( 'Assign Above Header Menu', 'smvmt-addon' ); ?> </a>
						<?php
				}
			}

			return ob_get_clean();
		}

		/**
		 * Get Below Header Section
		 *
		 * @param string $section Below Header Section.
		 * @param string $layout  Below Header Layout.
		 * @return void
		 */
		public static function get_below_header_section( $section, $layout = '' ) {

			$section_class = $section . ' smvmt-flex smvmt-justify-content-center';
			/**
			 * Filter the classes(array) for Below Header Menu (<ul>).
			 *
			 * @since  1.6.0
			 * @var Array
			 */
			$below_header_menu_classes = apply_filters( 'smvmt_below_header_menu_classes', array( 'smvmt-below-header-menu', 'smvmt-nav-menu', 'smvmt-flex' ) );

			// Menu Animation.
			$menu_animation = smvmt_get_option( 'below-header-submenu-container-animation' );
			if ( ! empty( $menu_animation ) ) {
				$below_header_menu_classes[] = 'smvmt-menu-animation-' . esc_html( $menu_animation );
			}

			if ( 'below-header-1' == $layout ) {

				$section_class               = $section . ' smvmt-flex smvmt-justify-content-flex-start';
				$below_header_menu_classes[] = 'smvmt-justify-content-flex-start';

				if ( 'below-header-section-2' == $section ) {
					$section_class               = $section . ' smvmt-flex smvmt-justify-content-flex-end';
					$below_header_menu_classes[] = 'smvmt-justify-content-flex-end';
				}
			} else {
				$below_header_menu_classes[] = 'smvmt-justify-content-center';
			}

			$value = smvmt_get_option( $section );
			if ( 'below-header-section-1' == $section ) {
				$below_header_widget  = 'below-header-widget-1';
				$below_header_menu_id = 'smvmt-below-header-navigation-section-1';
			}
			if ( 'below-header-section-2' == $section ) {
				$below_header_widget  = 'below-header-widget-2';
				$below_header_menu_id = 'smvmt-below-header-navigation-section-2';
			}
			// Submenu with border class.
			$below_header_menu_classes[] = 'submenu-with-border';

			switch ( $value ) {
				case 'menu':
					echo '<div class="smvmt-below-header-navigation ' . esc_attr( $section_class ) . '">';

						do_action( 'smvmt_below_header_toggle_buttons' );

					if ( has_nav_menu( 'below_header_menu' ) ) {

						/**
						 * Fires before the Below Header Menu
						 *
						 * @since 1.4.0
						 */
						do_action( 'smvmt_below_header_before_menu' );

						wp_nav_menu(
							array(
								'container'       => 'nav',
								'container_class' => 'smvmt-below-header-actual-nav navigation-accessibility',
								'container_id'    => $below_header_menu_id,
								'theme_location'  => 'below_header_menu',
								'menu_id'         => 'below_header-menu',
								'menu_class'      => esc_attr( implode( ' ', $below_header_menu_classes ) ),
							)
						);

						/**
						 * Fires after the Below Header Menu
						 *
						 * @since 1.4.0
						 */
						do_action( 'smvmt_below_header_after_menu' );

					} else {
						if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {
							echo '<a href="' . esc_url( admin_url( '/nav-menus.php?action=locations' ) ) . '">' . esc_html__( 'Assign Below Header Menu', 'smvmt-addon' ) . '</a>';
						}
					}
					echo '</div>';

					break;

				case 'search':
				case 'text-html':
						$sections = smvmt_get_dynamic_header_content( $section );

					if ( is_array( $sections ) && 0 < count( $sections ) ) {
						echo '<div class="below-header-user-select ' . esc_attr( $section_class ) . '">';
						foreach ( $sections as $key => $value ) {
							echo '<div class="user-select">';
							echo $value; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							echo '</div>';
						}
						echo '</div>';
					}

					break;

				case 'widget':
						echo '<div class="below-header-widget below-header-user-select ' . esc_attr( $section_class ) . '">';
								smvmt_get_sidebar( $below_header_widget );
						echo '</div>';

					break;

				default:
					$output = apply_filters( 'smvmt_get_dynamic_header_content', '', $section, $value );
					if ( ! empty( $output ) ) {
						echo '<div class="below-header-user-select ' . esc_attr( $section_class ) . '">';
						echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						echo '</div>';
					}
			}
		}

		/**
		 * Enqueue Font Family
		 */
		public function add_fonts() {
			// Below Header.
			$below_header_enabled = $this->smvmt_below_header_enabled();
			$above_header_enabled = $this->smvmt_above_header_enabled();
			if ( ! $below_header_enabled && ! $above_header_enabled ) {
				return;
			}

			$font_family_primary = smvmt_get_option( 'font-family-below-header-primary-menu' );
			$font_weight_primary = smvmt_get_option( 'font-weight-below-header-primary-menu' );
			SMVMT_Fonts::add_font( $font_family_primary, $font_weight_primary );

			$font_family_dropdown = smvmt_get_option( 'font-family-below-header-dropdown-menu' );
			$font_weight_dropdown = smvmt_get_option( 'font-weight-below-header-dropdown-menu' );
			SMVMT_Fonts::add_font( $font_family_dropdown, $font_weight_dropdown );

			$font_family_content = smvmt_get_option( 'font-family-below-header-content' );
			$font_weight_content = smvmt_get_option( 'font-weight-below-header-content' );
			SMVMT_Fonts::add_font( $font_family_content, $font_weight_content );

			// Above Header.
			$above_header_font_family = smvmt_get_option( 'above-header-font-family' );
			$above_header_font_weight = smvmt_get_option( 'above-header-font-weight' );
			SMVMT_Fonts::add_font( $above_header_font_family, $above_header_font_weight );

			// Above Sub Menu Header.
			$above_header_sub_menu_font_family = smvmt_get_option( 'font-family-above-header-dropdown-menu' );
			$above_header_sub_menu_font_weight = smvmt_get_option( 'font-weight-above-header-dropdown-menu' );
			SMVMT_Fonts::add_font( $above_header_sub_menu_font_family, $above_header_sub_menu_font_weight );
		}

		/**
		 * Register menus
		 */
		public function register_menu_locations_widgets() {

			register_nav_menus(
				array(
					'above_header_menu' => __( 'Above Header Menu', 'smvmt-addon' ),
					'below_header_menu' => __( 'Below Header Menu', 'smvmt-addon' ),
				)
			);

			// Set up our array of widgets.
			$widgets = array(
				'above-header-widget-1' => array(
					'name' => __( 'Above Header First Widget', 'smvmt-addon' ),
				),
				'above-header-widget-2' => array(
					'name' => __( 'Above Header Second Widget', 'smvmt-addon' ),
				),
				'below-header-widget-1' => array(
					'name' => __( 'Below Header First Widget', 'smvmt-addon' ),
				),
				'below-header-widget-2' => array(
					'name' => __( 'Below Header Second Widget', 'smvmt-addon' ),
				),
			);

			// Loop through them to create our widget areas.
			foreach ( $widgets as $widget => $id ) {
				register_sidebar(
					apply_filters(
						'smvmt_' . $widget . '_init',
						array(
							'name'          => esc_html( $id['name'] ),
							'id'            => esc_html( $widget ),
							'before_widget' => '<div id="%1$s" class="widget %2$s">',
							'after_widget'  => '</div>',
							'before_title'  => '<h2 class="widget-title">',
							'after_title'   => '</h2>',
						)
					)
				);
			}
		}

		/**
		 * Below Header Header markup loader
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @since 1.0.0
		 */
		public function below_header_html_markup_loader() {
			$below_header_enabled = $this->smvmt_below_header_enabled();
			$below_header_layout  = smvmt_get_option( 'below-header-layout' );

			if ( ! $below_header_enabled ) {
				return;
			}

			add_filter( 'smvmt_enable_mobile_menu_buttons', '__return_true' );

			// Add markup.
			smvmt_get_template( 'header-sections/template/' . esc_attr( $below_header_layout ) . '.php' );
		}

		/**
		 * Toggle Button
		 */
		public function below_header_toggle_button() {

			if ( ! apply_filters( 'smvmt_enable_below_header_mobile_menu_button', true ) ) {
				return;
			}

			$below_header_enabled = $this->smvmt_below_header_enabled();
			$below_header_merged  = $this->smvmt_below_header_merged_enabled();
			// Add filter to enable the menu buttons.
			add_filter( 'smvmt_enable_mobile_menu_buttons', '__return_true' );
			$below_header_toggle_class = apply_filters( 'smvmt_below_header_menu_toggle_classes', array() );

			if ( ! $below_header_merged && $below_header_enabled && has_nav_menu( 'below_header_menu' ) ) {

				$below_menu_title = smvmt_get_option( 'below-header-menu-label' );
				?>
				<div class="smvmt-button-wrap">
					<span class="screen-reader-text"><?php esc_html_e( 'Below Header', 'smvmt-addon' ); ?></span>
					<button class="menu-toggle menu-below-header-toggle <?php echo esc_attr( implode( ' ', $below_header_toggle_class ) ); ?>" ><span class="<?php echo esc_attr( apply_filters( 'smvmt_below_header_menu_toggle_icon', 'menu-toggle-icon' ) ); ?>"></span>
					<?php if ( '' !== $below_menu_title ) { ?>
						<span class="mobile-menu-wrap"><span class="mobile-menu"><?php echo esc_html( $below_menu_title ); ?></span></span>
					<?php } ?>
					</button>
				</div>
				<?php
			}
		}

		/**
		 * Above Header Markup loader
		 */
		public function above_header_html_markup_loader() {
			$above_header_enabled = $this->smvmt_above_header_enabled();
			$above_header_layout  = smvmt_get_option( 'above-header-layout' );

			if ( ! $above_header_enabled ) {
				return;
			}

			add_filter( 'smvmt_enable_mobile_menu_buttons', '__return_true' );

			smvmt_get_template( 'header-sections/template/' . esc_attr( $above_header_layout ) . '.php' );
		}

		/**
		 * Below Header Toggle Button
		 */
		public function above_header_toggle_button() {
			if ( ! apply_filters( 'smvmt_enable_above_header_mobile_menu_button', true ) ) {
				return;
			}

			$above_header_enabled = $this->smvmt_above_header_enabled();
			$above_header_merged  = $this->smvmt_above_header_merged_enabled();

			add_filter( 'smvmt_enable_mobile_menu_buttons', '__return_true' );
			$above_header_toggle_class = apply_filters( 'smvmt_above_header_menu_toggle_classes', array() );

			if ( ! $above_header_merged && $above_header_enabled && has_nav_menu( 'above_header_menu' ) ) {
				$above_menu_title = smvmt_get_option( 'above-header-menu-label' );
				?>
				<div class="smvmt-button-wrap">
					<span class="screen-reader-text"><?php esc_html_e( 'Above Header', 'smvmt-addon' ); ?></span>
					<button class="menu-toggle menu-above-header-toggle <?php echo esc_attr( implode( ' ', $above_header_toggle_class ) ); ?>" ><span class="<?php echo esc_attr( apply_filters( 'smvmt_above_header_menu_toggle_icon', 'menu-toggle-icon' ) ); ?>"></span>
					<?php if ( '' !== $above_menu_title ) { ?>
						<span class="mobile-menu-wrap"><span class="mobile-menu"><?php echo esc_html( $above_menu_title ); ?></span></span>
					<?php } ?>
					</button>
				</div>
				<?php
			}
		}

		/**
		 * Add Styles
		 */
		public function add_styles() {

			$below_header_layout      = smvmt_get_option( 'below-header-layout' );
			$below_header_meta        = smvmt_get_option_meta( 'smvmt-below-header-display' );
			$above_header_layout      = smvmt_get_option( 'above-header-layout' );
			$above_header_layout_meta = smvmt_get_option_meta( 'smvmt-above-header-display' );

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = SMVMT_EXT_HEADER_SECTIONS_URL . 'assets/css/';
			$path = SMVMT_EXT_HEADER_SECTIONS_DIR . 'assets/css/';
			$rtl  = '';

			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			/* Directory and Extension */
			$file_prefix = $rtl . '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = $rtl;
				$dir_name    = 'unminified';
			}

			$css_uri = $uri . $dir_name . '/';
			$css_dir = $path . $dir_name . '/';

			if ( defined( 'SMVMT_THEME_HTTP2' ) && SMVMT_THEME_HTTP2 ) {
				$gen_path = $css_uri;
			} else {
				$gen_path = $css_dir;
			}

			/*** End Path Logic */

			SMVMT_Minify::add_css( $gen_path . 'style' . $file_prefix . '.css' );

			if ( 'disabled' != $below_header_layout && 'disabled' != $below_header_meta ) {
				/* Add style.css */
				SMVMT_Minify::add_css( $gen_path . 'below-header-style' . $file_prefix . '.css' );
				if ( 'disabled' == $below_header_layout ) {
					return;
				}

				SMVMT_Minify::add_css( $gen_path . $below_header_layout . $file_prefix . '.css' );
			}

			if ( 'disabled' != $above_header_layout && 'disabled' != $above_header_layout_meta ) {
				SMVMT_Minify::add_css( $gen_path . 'above-header-style' . $file_prefix . '.css' );
			}

		}

		/**
		 * Add Scripts
		 */
		public function add_scripts() {

			$below_header_layout      = smvmt_get_option( 'below-header-layout' );
			$below_header_meta        = smvmt_get_option_meta( 'smvmt-below-header-display' );
			$above_header_layout      = smvmt_get_option( 'above-header-layout' );
			$above_header_layout_meta = smvmt_get_option_meta( 'smvmt-above-header-display' );

			/*** Start Path Logic */

			/* Define Variables */
			$uri  = SMVMT_EXT_HEADER_SECTIONS_URL . 'assets/js/';
			$path = SMVMT_EXT_HEADER_SECTIONS_DIR . 'assets/js/';

			/* Directory and Extension */
			$file_prefix = '.min';
			$dir_name    = 'minified';

			if ( SCRIPT_DEBUG ) {
				$file_prefix = '';
				$dir_name    = 'unminified';
			}

			$js_uri = $uri . $dir_name . '/';
			$js_dir = $path . $dir_name . '/';

			if ( defined( 'SMVMT_THEME_HTTP2' ) && SMVMT_THEME_HTTP2 ) {
				$gen_path = $js_uri;
			} else {
				$gen_path = $js_dir;
			}

			/*** End Path Logic */

			if ( 'disabled' != $below_header_layout && 'disabled' != $below_header_meta ) {
				SMVMT_Minify::add_dependent_js( 'smvmt-theme-js' );
				SMVMT_Minify::add_js( $gen_path . 'smvmt-below-header' . $file_prefix . '.js' );
			}

			if ( 'disabled' != $above_header_layout && 'disabled' != $above_header_layout_meta ) {
				SMVMT_Minify::add_js( $gen_path . 'smvmt-above-header' . $file_prefix . '.js' );
			}
		}

		/**
		 * Add Meta Options
		 *
		 * @param array $meta_option Page Meta.
		 * @return array
		 */
		public function add_options( $meta_option ) {
			$meta_option['smvmt-below-header-display'] = array(
				'sanitize' => 'FILTER_DEFAULT',
				'default'  => smvmt_get_option( 'smvmt-below-header-display' ),
			);
			$meta_option['smvmt-above-header-display'] = array(
				'sanitize' => 'FILTER_DEFAULT',
				'default'  => '',
			);
			return $meta_option;
		}

		/**
		 * Below Header Meta Field markup
		 *
		 * Loads appropriate template file based on the style option selected in options panel.
		 *
		 * @param array $meta Page Meta.
		 * @since 1.0.0
		 */
		public function add_options_markup( $meta ) {

			// Above Header.
			$above_header        = ( isset( $meta['smvmt-above-header-display']['default'] ) ) ? $meta['smvmt-above-header-display']['default'] : 'default';
			$above_header_layout = smvmt_get_option( 'above-header-layout' );
			$show_meta_field     = ! smvmt_check_is_bb_themer_layout();

			if ( $show_meta_field && 'disabled' != $above_header_layout ) {
				?>
			<div class="smvmt-above-header-display-option-wrap">
				<input type="checkbox" id="smvmt-above-header-display" name="smvmt-above-header-display" value="disabled" <?php checked( $above_header, 'disabled' ); ?> />
				<label for="smvmt-above-header-display"><?php esc_html_e( 'Disable Above Header', 'smvmt-addon' ); ?></label> <br />
			</div>
				<?php
			}

			// Below Header.
			$below_header_layout = smvmt_get_option( 'below-header-layout' );
			if ( $show_meta_field && 'disabled' != $below_header_layout ) {
				$below_header = ( isset( $meta['smvmt-below-header-display']['default'] ) ) ? $meta['smvmt-below-header-display']['default'] : 'default';
				?>
			<div class="smvmt-below-header-display-option-wrap">
				<input type="checkbox" id="smvmt-below-header-display" name="smvmt-below-header-display" value="disabled" <?php checked( $below_header, 'disabled' ); ?> />
				<label for="smvmt-below-header-display"><?php esc_html_e( 'Disable Below Header', 'smvmt-addon' ); ?></label> <br />
			</div>
				<?php
			}
		}
	}
}

/**
*  Kicking this off by calling 'get_instance()' method
*/
SMVMT_Ext_Header_Sections_Markup::get_instance();
