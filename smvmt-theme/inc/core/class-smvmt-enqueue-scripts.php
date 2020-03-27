<?php
/**
 * Loader Functions
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Enqueue Scripts
 */
if ( ! class_exists( 'SMVMT_Enqueue_Scripts' ) ) {

	/**
	 * Theme Enqueue Scripts
	 */
	class SMVMT_Enqueue_Scripts {

		/**
		 * Class styles.
		 *
		 * @access public
		 * @var $styles Enqueued styles.
		 */
		public static $styles;

		/**
		 * Class scripts.
		 *
		 * @access public
		 * @var $scripts Enqueued scripts.
		 */
		public static $scripts;

		/**
		 * Constructor
		 */
		public function __construct() {

			add_action( 'smvmt_get_fonts', array( $this, 'add_fonts' ), 1 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 1 );
			add_action( 'enqueue_block_editor_assets', array( $this, 'gutenberg_assets' ) );
			add_filter( 'admin_body_class', array( $this, 'admin_body_class' ) );
			add_action( 'wp_print_footer_scripts', array( $this, 'SMVMT_skip_link_focus_fix' ) );
		}

		/**
		 * Fix skip link focus in IE11.
		 *
		 * This does not enqueue the script because it is tiny and because it is only for IE11,
		 * thus it does not warrant having an entire dedicated blocking script being loaded.
		 *
		 * @link https://git.io/vWdr2
		 * @link https://github.com/WordPress/twentynineteen/pull/47/files
		 * @link https://github.com/ampproject/amphtml/issues/18671
		 */
		public function SMVMT_skip_link_focus_fix() {
			// Skip printing script on AMP content, since accessibility fix is covered by AMP framework.
			if ( smvmt_is_amp_endpoint() ) {
				return;
			}

			// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
			?>
			<script>
			/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
			</script>
			<?php
		}

		/**
		 * Admin body classes.
		 *
		 * Body classes to be added to <body> tag in admin page
		 *
		 * @param String $classes body classes returned from the filter.
		 * @return String body classes to be added to <body> tag in admin page
		 */
		public function admin_body_class( $classes ) {
			$content_layout = smvmt_get_content_layout();
			if ( 'content-boxed-container' == $content_layout ) {
				$classes .= ' smvmt-separate-container';
			} elseif ( 'boxed-container' == $content_layout ) {
				$classes .= ' smvmt-separate-container smvmt-two-container';
			} elseif ( 'page-builder' == $content_layout ) {
				$classes .= ' smvmt-page-builder-template';
			} elseif ( 'plain-container' == $content_layout ) {
				$classes .= ' smvmt-plain-container';
			}

			$classes .= ' smvmt-' . smvmt_page_layout();

			return $classes;
		}

		/**
		 * List of all assets.
		 *
		 * @return array assets array.
		 */
		public static function theme_assets() {

			$default_assets = array(

				// handle => location ( in /assets/js/ ) ( without .js ext).
				'js'  => array(
					'smvmt-theme-js' => 'style',
				),

				// handle => location ( in /assets/css/ ) ( without .css ext).
				'css' => array(
					'smvmt-theme-css' => 'style',
				),
			);

			return apply_filters( 'smvmt_theme_assets', $default_assets );
		}

		/**
		 * Add Fonts
		 */
		public function add_fonts() {

			$font_family  = smvmt_get_option( 'body-font-family' );
			$font_weight  = smvmt_get_option( 'body-font-weight' );
			$font_variant = smvmt_get_option( 'body-font-variant' );

			SMVMT_Fonts::add_font( $font_family, $font_weight );
			SMVMT_Fonts::add_font( $font_family, $font_variant );

			// Render headings font.
			$heading_font_family  = smvmt_get_option( 'headings-font-family' );
			$heading_font_weight  = smvmt_get_option( 'headings-font-weight' );
			$heading_font_variant = smvmt_get_option( 'headings-font-variant' );

			SMVMT_Fonts::add_font( $heading_font_family, $heading_font_weight );
			SMVMT_Fonts::add_font( $heading_font_family, $heading_font_variant );
		}

		/**
		 * Enqueue Scripts
		 */
		public function enqueue_scripts() {

			if ( false === self::enqueue_theme_assets() ) {
				return;
			}

			/* Directory and Extension */
			$file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';
			$dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';

			$js_uri  = SMVMT_THEME_URI . 'assets/js/' . $dir_name . '/';
			$css_uri = SMVMT_THEME_URI . 'assets/css/' . $dir_name . '/';

			/**
			 * IE Only Js and CSS Files.
			 */
			// Flexibility.js for flexbox IE10 support.
			wp_enqueue_script( 'smvmt-flexibility', $js_uri . 'flexibility' . $file_prefix . '.js', array(), SMVMT_THEME_VERSION, false );
			wp_add_inline_script( 'smvmt-flexibility', 'flexibility(document.documentElement);' );
			wp_script_add_data( 'smvmt-flexibility', 'conditional', 'IE' );

			// Polyfill for CustomEvent for IE.
			wp_register_script( 'smvmt-customevent', $js_uri . 'custom-events-polyfill' . $file_prefix . '.js', array(), SMVMT_THEME_VERSION, false );

			// All assets.
			$all_assets = self::theme_assets();
			$styles     = $all_assets['css'];
			$scripts    = $all_assets['js'];

			if ( is_array( $styles ) && ! empty( $styles ) ) {
				// Register & Enqueue Styles.
				foreach ( $styles as $key => $style ) {

					$dependency = array();

					// Add dynamic CSS dependency for all styles except for theme's style.css.
					if ( 'smvmt-theme-css' !== $key && class_exists( 'SMVMT_Cache_Base' ) ) {
						if ( ! SMVMT_Cache_Base::inline_assets() ) {
							$dependency[] = 'smvmt-theme-dynamic';
						}
					}

					// Generate CSS URL.
					$css_file = $css_uri . $style . $file_prefix . '.css';

					// Register.
					wp_register_style( $key, $css_file, $dependency, SMVMT_THEME_VERSION, 'all' );

					// Enqueue.
					wp_enqueue_style( $key );

					// RTL support.
					wp_style_add_data( $key, 'rtl', 'replace' );
				}
			}

			// Fonts - Render Fonts.
			SMVMT_Fonts::render_fonts();

			/**
			 * Inline styles
			 */

			add_filter( 'SMVMT_dynamic_theme_css', array( 'SMVMT_Dynamic_CSS', 'return_output' ) );
			add_filter( 'SMVMT_dynamic_theme_css', array( 'SMVMT_Dynamic_CSS', 'return_meta_output' ) );

			// Submenu Container Animation.
			$menu_animation = smvmt_get_option( 'header-main-submenu-container-animation' );

			$rtl = ( is_rtl() ) ? '-rtl' : '';

			if ( ! empty( $menu_animation ) ) {
				if ( class_exists( 'SMVMT_Cache' ) ) {
					SMVMT_Cache::add_css_file( SMVMT_THEME_DIR . 'assets/css/' . $dir_name . '/menu-animation' . $rtl . $file_prefix . '.css' );
				} else {
					wp_register_style( 'smvmt-menu-animation', $css_uri . 'menu-animation' . $file_prefix . '.css', null, SMVMT_THEME_VERSION, 'all' );
					wp_enqueue_style( 'smvmt-menu-animation' );
				}
			}

			if ( ! class_exists( 'SMVMT_Cache' ) ) {
				$theme_css_data = apply_filters( 'SMVMT_dynamic_theme_css', '' );
				wp_add_inline_style( 'smvmt-theme-css', $theme_css_data );
			}

			if ( smvmt_is_amp_endpoint() ) {
				return;
			}

			// Comment assets.
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			if ( is_array( $scripts ) && ! empty( $scripts ) ) {
				// Register & Enqueue Scripts.
				foreach ( $scripts as $key => $script ) {

					// Register.
					wp_register_script( $key, $js_uri . $script . $file_prefix . '.js', array(), SMVMT_THEME_VERSION, true );

					// Enqueue.
					wp_enqueue_script( $key );
				}
			}

			$SMVMT_localize = array(
				'break_point' => smvmt_header_break_point(),    // Header Break Point.
				'isRtl'       => is_rtl(),
			);

			wp_localize_script( 'smvmt-theme-js', 'smvmt', apply_filters( 'smvmt_theme_js_localize', $SMVMT_localize ) );
		}

		/**
		 * Trim CSS
		 *
		 * @since 1.0.0
		 * @param string $css CSS content to trim.
		 * @return string
		 */
		public static function trim_css( $css = '' ) {

			// Trim white space for faster page loading.
			if ( ! empty( $css ) ) {
				$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
				$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
				$css = str_replace( ', ', ',', $css );
			}

			return $css;
		}

		/**
		 * Enqueue Gutenberg assets.
		 *
		 * @since 1.5.2
		 *
		 * @return void
		 */
		public function gutenberg_assets() {
			/* Directory and Extension */
			$rtl = '';
			if ( is_rtl() ) {
				$rtl = '-rtl';
			}

			$css_uri = SMVMT_THEME_URI . 'inc/assets/css/block-editor-styles' . $rtl . '.css';

			wp_enqueue_style( 'smvmt-block-editor-styles', $css_uri, false, SMVMT_THEME_VERSION, 'all' );

			// Render fonts in Gutenberg layout.
			SMVMT_Fonts::render_fonts();

			wp_add_inline_style( 'smvmt-block-editor-styles', apply_filters( 'SMVMT_block_editor_dynamic_css', Gutenberg_Editor_CSS::get_css() ) );
		}

		/**
		 * Function to check if enqueuing of smvmt assets are disabled.
		 *
		 * @since 2.1.0
		 * @return boolean
		 */
		public static function enqueue_theme_assets() {
			return apply_filters( 'SMVMT_enqueue_theme_assets', true );
		}

	}

	new SMVMT_Enqueue_Scripts();
}
