<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'SMVMT_Admin_Settings' ) ) {

	/**
	 * smvmt Admin Settings
	 */
	class SMVMT_Admin_Settings {

		/**
		 * Menu page title
		 *
		 * @since 1.0
		 * @var array $menu_page_title
		 */
		public static $menu_page_title = 'smvmt Theme';

		/**
		 * Page title
		 *
		 * @since 1.0
		 * @var array $page_title
		 */
		public static $page_title = 'smvmt';

		/**
		 * Plugin slug
		 *
		 * @since 1.0
		 * @var array $plugin_slug
		 */
		public static $plugin_slug = 'smvmt';

		/**
		 * Default Menu position
		 *
		 * @since 1.0
		 * @var array $default_menu_position
		 */
		public static $default_menu_position = 'themes.php';

		/**
		 * Parent Page Slug
		 *
		 * @since 1.0
		 * @var array $parent_page_slug
		 */
		public static $parent_page_slug = 'general';

		/**
		 * Current Slug
		 *
		 * @since 1.0
		 * @var array $current_slug
		 */
		public static $current_slug = 'general';

		/**
		 * Starter Templates Slug
		 *
		 * @since 2.3.2
		 * @var array $starter_templates_slug
		 */
		public static $starter_templates_slug = 'smvmt-sites';

		/**
		 * Constructor
		 */
		public function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );
		}

		/**
		 * Admin settings init
		 */
		public static function init_admin_settings() {
			self::$menu_page_title = apply_filters( 'SMVMT_menu_page_title', __( 'smvmt Options', 'smvmt' ) );
			self::$page_title      = apply_filters( 'SMVMT_page_title', __( 'smvmt', 'smvmt' ) );
			self::$plugin_slug     = self::get_theme_page_slug();

			add_action( 'admin_enqueue_scripts', __CLASS__ . '::register_scripts' );

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], self::$plugin_slug ) !== false ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended

				add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles_scripts' );

				// Let extensions hook into saving.
				do_action( 'SMVMT_admin_settings_scripts' );

				self::save_settings();
			}

			add_action( 'customize_controls_enqueue_scripts', __CLASS__ . '::customizer_scripts' );

		}

		/**
		 * Theme options page Slug getter including White Label string.
		 *
		 * @since 2.1.0
		 * @return string Theme Options Page Slug.
		 */
		public static function get_theme_page_slug() {
			return apply_filters( 'smvmt_theme_page_slug', self::$plugin_slug );
		}

		/**
		 * Save All admin settings here
		 */
		public static function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Let extensions hook into saving.
			do_action( 'SMVMT_admin_settings_save' );
		}

		/**
		 * Load the scripts and styles in the customizer controls.
		 *
		 * @since 1.2.1
		 */
		public static function customizer_scripts() {
			$color_palettes = wp_json_encode( smvmt_color_palette() );
			wp_add_inline_script( 'wp-color-picker', 'jQuery.wp.wpColorPicker.prototype.options.palettes = ' . $color_palettes . ';' );
		}

		/**
		 * Register admin scripts.
		 *
		 * @param String $hook Screen name where the hook is fired.
		 * @return void
		 */
		public static function register_scripts( $hook ) {
			$js_prefix  = '.min.js';
			$css_prefix = '.min.css';
			$dir        = 'minified';
			if ( SCRIPT_DEBUG ) {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				$dir        = 'unminified';
			}

			if ( is_rtl() ) {
				$css_prefix = '-rtl.min.css';
				if ( SCRIPT_DEBUG ) {
					$css_prefix = '-rtl.css';
				}
			}

			/**
			 * Filters the Admin JavaScript handles added
			 *
			 * @since v1.4.10
			 *
			 * @param array array of the javascript handles.
			 */
			$js_handle = apply_filters( 'SMVMT_admin_script_handles', array( 'jquery', 'wp-color-picker' ) );

			// Add customize-base handle only for the Customizer Preview Screen.
			if ( true === is_customize_preview() ) {
				$js_handle[] = 'customize-base';
			}

			wp_register_script( 'smvmt-color-alpha', SMVMT_THEME_URI . 'assets/js/' . $dir . '/wp-color-picker-alpha' . $js_prefix, $js_handle, SMVMT_THEME_VERSION, true );

			if ( in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
				$post_types = get_post_types( array( 'public' => true ) );
				$screen     = get_current_screen();
				$post_type  = $screen->id;

				if ( in_array( $post_type, (array) $post_types ) ) {
					echo '<style class="smvmt-meta-box-style">
						.block-editor-page #side-sortables #SMVMT_settings_meta_box select { min-width: 84%; padding: 3px 24px 3px 8px; height: 20px; }
						.block-editor-page #normal-sortables #SMVMT_settings_meta_box select { min-width: 200px; }
						.block-editor-page .edit-post-meta-boxes-area #poststuff #SMVMT_settings_meta_box h2.hndle { border-bottom: 0; }
						.block-editor-page #SMVMT_settings_meta_box .components-base-control__field, .block-editor-page #SMVMT_settings_meta_box .block-editor-page .transparent-header-wrapper, .block-editor-page #SMVMT_settings_meta_box .adv-header-wrapper, .block-editor-page #SMVMT_settings_meta_box .stick-header-wrapper, .block-editor-page #SMVMT_settings_meta_box .disable-section-meta div { margin-bottom: 8px; }
						.block-editor-page #SMVMT_settings_meta_box .disable-section-meta div label { vertical-align: inherit; }
						.block-editor-page #SMVMT_settings_meta_box .post-attributes-label-wrapper { margin-bottom: 4px; }
						#side-sortables #SMVMT_settings_meta_box select { min-width: 100%; }
						#normal-sortables #SMVMT_settings_meta_box select { min-width: 200px; }
					</style>';
				}
			}
			/* Add CSS for the Submenu for BSF plugins added in Appearance Menu */

			if ( ! is_customize_preview() ) {
				echo '<style class="smvmt-menu-appearance-style">
					#menu-appearance a[href^="edit.php?post_type=smvmt-"]:before,
					#menu-appearance a[href^="themes.php?page=smvmt-"]:before,
					#menu-appearance a[href^="edit.php?post_type=SMVMT_"]:before,
					#menu-appearance a[href^="edit-tags.php?taxonomy=bsf_custom_fonts"]:before,
					#menu-appearance a[href^="themes.php?page=custom-typekit-fonts"]:before,
					#menu-appearance a[href^="edit.php?post_type=bsf-sidebar"]:before {
					    content: "\21B3";
					    margin-right: 0.5em;
					    opacity: 0.5;
					}
				</style>';

				wp_register_script( 'smvmt-admin-settings', SMVMT_THEME_URI . 'inc/assets/js/smvmt-admin-menu-settings.js', array( 'jquery', 'wp-util', 'updates' ), SMVMT_THEME_VERSION, false );

				$localize = array(
					'ajaxUrl'                            => admin_url( 'admin-ajax.php' ),
					'btnActivating'                      => __( 'Activating Importer Plugin ', 'smvmt' ) . '&hellip;',
					'smvmtSitesLink'                     => admin_url( 'themes.php?page=' ),
					'smvmtSitesLinkTitle'                => __( 'See Library &#187;', 'smvmt' ),
					'recommendedPluiginActivatingText'   => __( 'Activating', 'smvmt' ) . '&hellip;',
					'recommendedPluiginDeactivatingText' => __( 'Deactivating', 'smvmt' ) . '&hellip;',
					'recommendedPluiginActivateText'     => __( 'Activate', 'smvmt' ),
					'recommendedPluiginDeactivateText'   => __( 'Deactivate', 'smvmt' ),
					'recommendedPluiginSettingsText'     => __( 'Settings', 'smvmt' ),
				);

				wp_localize_script( 'smvmt-admin-settings', 'smvmt', apply_filters( 'smvmt_theme_js_localize', $localize ) );
			}
		}

		/**
		 * Enqueues the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.0
		 */
		public static function styles_scripts() {

			// Styles.
			if ( is_rtl() ) {
				wp_enqueue_style( 'smvmt-admin-settings-rtl', SMVMT_THEME_URI . 'inc/assets/css/smvmt-admin-menu-settings-rtl.css', array(), SMVMT_THEME_VERSION );
			} else {
				wp_enqueue_style( 'smvmt-admin-settings', SMVMT_THEME_URI . 'inc/assets/css/smvmt-admin-menu-settings.css', array(), SMVMT_THEME_VERSION );
			}

			wp_register_script( 'smvmt-admin-settings', SMVMT_THEME_URI . 'inc/assets/js/smvmt-admin-menu-settings.js', array( 'jquery', 'wp-util', 'updates' ), SMVMT_THEME_VERSION, false );

			$localize = array(
				'ajaxUrl'                            => admin_url( 'admin-ajax.php' ),
				'btnActivating'                      => __( 'Activating Importer Plugin ', 'smvmt' ) . '&hellip;',
				'smvmtSitesLink'                     => admin_url( 'themes.php?page=' ),
				'smvmtSitesLinkTitle'                => __( 'See Library &#187;', 'smvmt' ),
				'recommendedPluiginActivatingText'   => __( 'Activating', 'smvmt' ) . '&hellip;',
				'recommendedPluiginDeactivatingText' => __( 'Deactivating', 'smvmt' ) . '&hellip;',
				'recommendedPluiginActivateText'     => __( 'Activate', 'smvmt' ),
				'recommendedPluiginDeactivateText'   => __( 'Deactivate', 'smvmt' ),
				'recommendedPluiginSettingsText'     => __( 'Settings', 'smvmt' ),
			);
			wp_localize_script( 'smvmt-admin-settings', 'smvmt', apply_filters( 'smvmt_theme_js_localize', $localize ) );

			// Script.
			wp_enqueue_script( 'smvmt-admin-settings' );

			if ( ! file_exists( WP_PLUGIN_DIR . '/smvmt-sites/smvmt-sites.php' ) && is_plugin_inactive( 'smvmt-pro-sites/smvmt-pro-sites.php' ) ) {
				// For starter site plugin popup detail "Details &#187;" on smvmt Options page.
				wp_enqueue_script( 'plugin-install' );
				wp_enqueue_script( 'thickbox' );
				wp_enqueue_style( 'thickbox' );
			}
		}


		/**
		 * Get and return page URL
		 *
		 * @param string $menu_slug Menu name.
		 * @since 1.0
		 * @return  string page url
		 */
		public static function get_page_url( $menu_slug ) {

			$parent_page = self::$default_menu_position;

			if ( strpos( $parent_page, '?' ) !== false ) {
				$query_var = '&page=' . self::$plugin_slug;
			} else {
				$query_var = '?page=' . self::$plugin_slug;
			}

			$parent_page_url = admin_url( $parent_page . $query_var );

			$url = $parent_page_url . '&action=' . $menu_slug;

			return esc_url( $url );
		}

		/**
		 * Add main menu
		 *
		 * @since 1.0
		 */
		public static function add_admin_menu() {

			$parent_page    = self::$default_menu_position;
			$page_title     = self::$menu_page_title;
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug;
			$page_menu_func = __CLASS__ . '::menu_callback';

			if ( apply_filters( 'SMVMT_dashboard_admin_menu', true ) ) {
				add_theme_page( $page_title, $page_title, $capability, $page_menu_slug, $page_menu_func );
			} else {
				do_action( 'asta_register_admin_menu', $parent_page, $page_title, $capability, $page_menu_slug, $page_menu_func );
			}
		}

		/**
		 * Menu callback
		 *
		 * @since 1.0
		 */
		public static function menu_callback() {

			$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

			$active_tab   = str_replace( '_', '-', $current_slug );
			$current_slug = str_replace( '-', '_', $current_slug );

			$ast_icon           = apply_filters( 'SMVMT_page_top_icon', true );
			$ast_visit_site_url = apply_filters( 'SMVMT_site_url', 'https://wpsmvmt.com' );
			$ast_wrapper_class  = apply_filters( 'SMVMT_welcome_wrapper_class', array( $current_slug ) );

			?>
			<div class="smvmt-menu-page-wrapper wrap smvmt-clear <?php echo esc_attr( implode( ' ', $ast_wrapper_class ) ); ?>">
					<div class="smvmt-theme-page-header">
						<div class="smvmt-container smvmt-flex">
							<div class="smvmt-theme-title">
								<a href="<?php echo esc_url( $ast_visit_site_url ); ?>" target="_blank" rel="noopener" >
								<?php if ( $ast_icon ) { ?>
									<img src="<?php echo esc_url( SMVMT_THEME_URI . 'inc/assets/images/smvmt.svg' ); ?>" class="smvmt-theme-icon" alt="<?php echo esc_attr( self::$page_title ); ?> " >
									<span class="smvmt-theme-version"><?php echo esc_html( SMVMT_THEME_VERSION ); ?></span>
								<?php } ?>
								<?php do_action( 'SMVMT_welcome_page_header_title' ); ?>
								</a>
							</div>

							<?php do_action( 'smvmt_header_right_section' ); ?>

						</div>
					</div>

				<?php do_action( 'SMVMT_menu_' . esc_attr( $current_slug ) . '_action' ); ?>
			</div>
			<?php
		}

		/**
		 * Include general page
		 *
		 * @since 1.0
		 */
		public static function general_page() {
			require_once SMVMT_THEME_DIR . 'inc/core/view-general.php';
		}

		/**
		 * Include Welcome page right starter sites content
		 *
		 * @since 1.2.4
		 */
		public static function SMVMT_welcome_page_starter_sites_section() {
			return;
		}

		/**
		 * Include Welcome page right side knowledge base content
		 *
		 * @since 1.2.4
		 */
		public static function SMVMT_welcome_page_knowledge_base_scetion() {
			return;
		}

		/**
		 * Include Welcome page right side smvmt community content
		 *
		 * @since 1.2.4
		 */
		public static function SMVMT_welcome_page_community_scetion() {
			return;
		}

		/**
		 * Include Welcome page right side Five Star Support
		 *
		 * @since 1.2.4
		 */
		public static function SMVMT_welcome_page_five_star_scetion() {
			return;
		}

		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		public static function SMVMT_welcome_page_content() {
			return;
		}

		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		public static function SMVMT_available_plugins() {

			$SMVMT_addon_tagline = apply_filters(
				'SMVMT_available_plugins',
				sprintf(
					/* translators: %1s smvmt Theme */
					__( 'Extend %1s with free plugins!', 'smvmt' ),
					smvmt_get_theme_name()
				)
			);

			$recommended_plugins = apply_filters(
				'SMVMT_recommended_plugins',
				array(
					'smvmt-import-export'           =>
						array(
							'plugin-name'        => 'Import / Export Customizer Settings',
							'plugin-init'        => 'smvmt-import-export/smvmt-import-export.php',
							'settings-link'      => '',
							'settings-link-text' => 'Settings',
						),
					'reset-smvmt-customizer'        =>
						array(
							'plugin-name'        => 'smvmt Customizer Reset',
							'plugin-init'        => 'reset-smvmt-customizer/class-smvmt-theme-customizer-reset.php',
							'settings-link'      => admin_url( 'customize.php' ),
							'settings-link-text' => 'Settings',
						),

					'customizer-search'             =>
					array(
						'plugin-name'        => 'Customizer Search',
						'plugin-init'        => 'customizer-search/customizer-search.php',
						'settings-link'      => admin_url( 'customize.php' ),
						'settings-link-text' => 'Settings',
					),

					'smvmt-bulk-edit'               =>
					array(
						'plugin-name'        => 'smvmt Bulk Edit',
						'plugin-init'        => 'smvmt-bulk-edit/smvmt-bulk-edit.php',
						'settings-link'      => '',
						'settings-link-text' => 'Settings',
					),

					'smvmt-widgets'                 =>
					array(
						'plugin-name'        => 'smvmt Widgets',
						'plugin-init'        => 'smvmt-widgets/smvmt-widgets.php',
						'settings-link'      => admin_url( 'widgets.php' ),
						'settings-link-text' => 'Settings',
					),

					'custom-fonts'                  =>
					array(
						'plugin-name'        => 'Custom Fonts',
						'plugin-init'        => 'custom-fonts/custom-fonts.php',
						'settings-link'      => admin_url( 'edit-tags.php?taxonomy=bsf_custom_fonts' ),
						'settings-link-text' => 'Settings',
					),

					'custom-typekit-fonts'          =>
						array(
							'plugin-name'        => 'Custom Typekit Fonts',
							'plugin-init'        => 'custom-typekit-fonts/custom-typekit-fonts.php',
							'settings-link'      => admin_url( 'themes.php?page=custom-typekit-fonts' ),
							'settings-link-text' => 'Settings',
						),

					'sidebar-manager'               =>
					array(
						'plugin-name'        => 'Sidebar Manager',
						'plugin-init'        => 'sidebar-manager/sidebar-manager.php',
						'settings-link'      => admin_url( 'edit.php?post_type=bsf-sidebar' ),
						'settings-link-text' => 'Settings',
					),

					'ultimate-addons-for-gutenberg' =>
						array(
							'plugin-name'        => 'Ultimate Addons for Gutenberg',
							'plugin-init'        => 'ultimate-addons-for-gutenberg/ultimate-addons-for-gutenberg.php',
							'settings-link'      => admin_url( 'options-general.php?page=uag' ),
							'settings-link-text' => 'Settings',
							'display'            => function_exists( 'register_block_type' ),
						),
				)
			);

			if ( apply_filters( 'SMVMT_show_free_extend_plugins', true ) ) {
				?>

				<div class="postbox">
					<h2 class="hndle smvmt-normal-cusror smvmt-addon-heading smvmt-flex"><span><?php echo esc_html( $SMVMT_addon_tagline ); ?></span>
					</h2>
						<div class="smvmt-addon-list-section">
							<?php
							if ( ! empty( $recommended_plugins ) ) :
								?>
								<div>
									<ul class="smvmt-addon-list">
										<?php
										foreach ( $recommended_plugins as $slug => $plugin ) {

											// If display condition for the plugin does not meet, skip the plugin from displaying.
											if ( isset( $plugin['display'] ) && false === $plugin['display'] ) {
												continue;
											}

											$plugin_active_status = '';
											if ( is_plugin_active( $plugin['plugin-init'] ) ) {
												$plugin_active_status = ' active';
											}

											echo '<li ' . smvmt_attr(
												'smvmt-recommended-plugin-' . esc_attr( $slug ),
												array(
													'id' => esc_attr( $slug ),
													'class' => 'smvmt-recommended-plugin' . $plugin_active_status,
													'data-slug' => $slug,
												)
											) . '>';

												echo '<a href="' . esc_url( self::build_worg_plugin_link( $slug ) ) . '" target="_blank">';
													echo esc_html( $plugin['plugin-name'] );
												echo '</a>';

												echo '<div class="smvmt-addon-link-wrapper">';

											if ( ! is_plugin_active( $plugin['plugin-init'] ) ) {

												if ( file_exists( WP_CONTENT_DIR . '/plugins/' . $plugin['plugin-init'] ) ) {
													echo '<a ' . smvmt_attr(
														'smvmt-activate-recommended-plugin',
														array(
															'data-slug' => $slug,
															'href' => '#',
															'data-init' => $plugin['plugin-init'],
															'data-settings-link' => esc_url( $plugin['settings-link'] ),
															'data-settings-link-text' => $plugin['settings-link-text'],
														)
													) . '>';

													esc_html_e( 'Activate', 'smvmt' );

													echo '</a>';

												} else {

													echo '<a ' . smvmt_attr(
														'smvmt-install-recommended-plugin',
														array(
															'data-slug' => $slug,
															'href' => '#',
															'data-init' => $plugin['plugin-init'],
															'data-settings-link' => esc_url( $plugin['settings-link'] ),
															'data-settings-link-text' => $plugin['settings-link-text'],
														)
													) . '>';

													esc_html_e( 'Activate', 'smvmt' );

													echo '</a>';
												}
											} else {

												echo '<a ' . smvmt_attr(
													'smvmt-deactivate-recommended-plugin',
													array(
														'data-slug' => $slug,
														'href' => '#',
														'data-init' => $plugin['plugin-init'],
														'data-settings-link' => esc_url( $plugin['settings-link'] ),
														'data-settings-link-text' => $plugin['settings-link-text'],
													)
												) . '>';

												esc_html_e( 'Deactivate', 'smvmt' );

												echo '</a>';

												if ( '' !== $plugin['settings-link'] ) {

													echo '<a ' . smvmt_attr(
														'smvmt-recommended-plugin-links',
														array(
															'data-slug' => $slug,
															'href' => $plugin['settings-link'],
														)
													) . '>';

													echo esc_html( $plugin['settings-link-text'] );

													echo '</a>';
												}
											}

												echo '</div>';

											echo '</li>';
										}
										?>
									</ul>
								</div>
								<?php endif; ?>
						</div>
				</div>

				<?php
			}

		}

		/**
		 * Build plugin's page URL on WordPress.org
		 * https://wordpress.org/plugins/{plugin-slug}
		 *
		 * @since 1.6.9
		 * @param String $slug plugin slug.
		 * @return String Plugin URL on WordPress.org
		 */
		private static function build_worg_plugin_link( $slug ) {
			return esc_url( trailingslashit( 'https://wordpress.org/plugins/' . $slug ) );
		}

		/**
		 * Required Plugin Activate
		 *
		 * @since 1.2.4
		 */
		public static function required_plugin_activate() {

			if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'No plugin specified', 'smvmt' ),
					)
				);
			}

			$plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

			$activate = activate_plugin( $plugin_init, '', false, true );

			if ( '/smvmt-sites/smvmt-sites.php' === $plugin_init ) {
				self::get_starter_templates_slug();
			}

			if ( is_wp_error( $activate ) ) {
				wp_send_json_error(
					array(
						'success'               => false,
						'message'               => $activate->get_error_message(),
						'starter_template_slug' => self::$starter_templates_slug,
					)
				);
			}

			wp_send_json_success(
				array(
					'success'               => true,
					'message'               => __( 'Plugin Successfully Activated', 'smvmt' ),
					'starter_template_slug' => self::$starter_templates_slug,
				)
			);
		}

		/**
		 * Required Plugin Activate
		 *
		 * @since 1.2.4
		 */
		public static function required_plugin_deactivate() {

			if ( ! current_user_can( 'install_plugins' ) || ! isset( $_POST['init'] ) || ! $_POST['init'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
				wp_send_json_error(
					array(
						'success' => false,
						'message' => __( 'No plugin specified', 'smvmt' ),
					)
				);
			}

			$plugin_init = ( isset( $_POST['init'] ) ) ? esc_attr( $_POST['init'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

			$deactivate = deactivate_plugins( $plugin_init, '', false );

			if ( is_wp_error( $deactivate ) ) {
				wp_send_json_error(
					array(
						'success' => false,
						'message' => $deactivate->get_error_message(),
					)
				);
			}

			wp_send_json_success(
				array(
					'success' => true,
					'message' => __( 'Plugin Successfully Deactivated', 'smvmt' ),
				)
			);

		}

		/**
		 * Check compatible theme version.
		 *
		 * @since 1.2.4
		 */
		public static function min_addon_version_message() {

			$SMVMT_global_options = get_option( 'smvmt-settings' );

			if ( isset( $SMVMT_global_options['smvmt-addon-auto-version'] ) && defined( 'SMVMT_THEME_VERSION' ) ) {

				if ( version_compare( $SMVMT_global_options['smvmt-addon-auto-version'], '1.2.1' ) < 0 ) {

					// If addon is not updated & White Label for Addon is added then show the white labelewd pro name.
					$SMVMT_addon_name        = smvmt_get_addon_name();
					$update_SMVMT_addon_link = smvmt_get_pro_url( 'https://wpsmvmt.com/?p=25258', 'smvmt-dashboard', 'update-to-smvmt-pro', 'welcome-page' );
					if ( class_exists( 'SMVMT_Ext_White_Label_Markup' ) ) {
						$plugin_data = SMVMT_Ext_White_Label_Markup::$branding;
						if ( ! empty( $plugin_data['smvmt-pro']['name'] ) ) {
							$update_SMVMT_addon_link = '';
						}
					}

					$class   = 'smvmt-notice smvmt-notice-error';
					$message = sprintf(
						/* translators: %1$1s: Addon Name, %2$2s: Minimum Required version of the smvmt Addon */
						__( 'Update to the latest version of %1$2s to make changes in settings below.', 'smvmt' ),
						( ! empty( $update_SMVMT_addon_link ) ) ? '<a href=' . esc_url( $update_SMVMT_addon_link ) . ' target="_blank" rel="noopener">' . $SMVMT_addon_name . '</a>' : $SMVMT_addon_name
					);

					printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
				}
			}
		}

		/**
		 * smvmt Header Right Section Links
		 *
		 * @since 1.2.4
		 */
		public static function top_header_right_section() {

			$allowed_html = array(
				'svg'  => array(
					'width'   => array(),
					'height'  => array(),
					'xmlns'   => array(),
					'viewBox' => array(),
				),
				'path' => array(
					'fill' => array(),
					'd'    => array(),
				),
			);
		}
	}

	new SMVMT_Admin_Settings();
}
