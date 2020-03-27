<?php
/**
 * LearnDash Compatibility File.
 *
 * @package smvmt
 * @since 1.3.0
 */

// If plugin - 'LearnDash' not exist then return.
if ( ! class_exists( 'SFWD_LMS' ) ) {
	return;
}

/**
 * smvmt LearnDash Compatibility
 */
if ( ! class_exists( 'SMVMT_LearnDash' ) ) :

	/**
	 * smvmt LearnDash Compatibility
	 *
	 * @since 1.3.0
	 */
	class SMVMT_LearnDash {

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

			add_filter( 'smvmt_theme_assets', array( $this, 'add_styles' ) );
			add_filter( 'SMVMT_dynamic_theme_css', array( $this, 'add_dynamic_styles' ) );

			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );
			add_filter( 'smvmt_theme_defaults', array( $this, 'theme_defaults' ) );

			// Sidebar Layout.
			add_filter( 'smvmt_page_layout', array( $this, 'sidebar_layout' ) );
			// Content Layout.
			add_filter( 'smvmt_get_content_layout', array( $this, 'content_layout' ) );
		}

		/**
		 * Enqueue styles
		 *
		 * @param  String $dynamic_css          smvmt Dynamic CSS.
		 * @param  String $dynamic_css_filtered smvmt Dynamic CSS Filters.
		 * @since 1.3.0
		 * @return String Dynamic CSS.
		 */
		public function add_dynamic_styles( $dynamic_css, $dynamic_css_filtered = '' ) {

			$active_ld_theme = '';

			if ( is_callable( 'LearnDash_Theme_Register::get_active_theme_key' ) ) {
				$active_ld_theme = LearnDash_Theme_Register::get_active_theme_key();
			}

			if ( 'ld30' === $active_ld_theme ) {
				return $dynamic_css;
			}

			/**
			 * - Variable Declaration
			 */
			$link_color   = smvmt_get_option( 'link-color' );
			$theme_color  = smvmt_get_option( 'theme-color' );
			$text_color   = smvmt_get_option( 'text-color' );
			$link_h_color = smvmt_get_option( 'link-h-color' );

			$body_font_family = SMVMT_body_font_family();

			$link_forground_color  = smvmt_get_foreground_color( $link_color );
			$theme_forground_color = smvmt_get_foreground_color( $theme_color );
			$btn_color             = smvmt_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = $link_forground_color;
			}

			$btn_h_color = smvmt_get_option( 'button-h-color' );
			if ( empty( $btn_h_color ) ) {
				$btn_h_color = smvmt_get_foreground_color( $link_h_color );
			}
			$btn_bg_color   = smvmt_get_option( 'button-bg-color', '', $theme_color );
			$btn_bg_h_color = smvmt_get_option( 'button-bg-h-color', '', $link_h_color );

			$btn_border_radius = smvmt_get_option( 'button-radius' );

			$archive_post_title_font_size = smvmt_get_option( 'font-size-page-title' );

			$css_output = array(
				'body #learndash_lessons a, body #learndash_quizzes a, body .expand_collapse a, body .learndash_topic_dots a, body .learndash_topic_dots a > span, body #learndash_lesson_topics_list span a, body #learndash_profile a, body #learndash_profile a span' => array(
					'font-family' => smvmt_get_font_family( $body_font_family ),
				),
				'body #ld_course_list .btn, body a.btn-blue, body a.btn-blue:visited, body a#quiz_continue_link, body .btn-join, body .learndash_checkout_buttons input.btn-join[type="button"], body #btn-join, body .learndash_checkout_buttons input.btn-join[type="submit"], body .wpProQuiz_content .wpProQuiz_button2' => array(
					'color'            => $btn_color,
					'border-color'     => $btn_bg_color,
					'background-color' => $btn_bg_color,
					'border-radius'    => smvmt_get_css_value( $btn_border_radius, 'px' ),
				),
				'body #ld_course_list .btn:hover, body #ld_course_list .btn:focus, body a.btn-blue:hover, body a.btn-blue:focus, body a#quiz_continue_link:hover, body a#quiz_continue_link:focus, body .btn-join:hover, body .learndash_checkout_buttons input.btn-join[type="button"]:hover, body .btn-join:focus, body .learndash_checkout_buttons input.btn-join[type="button"]:focus, .wpProQuiz_content .wpProQuiz_button2:hover, .wpProQuiz_content .wpProQuiz_button2:focus, body #btn-join:hover, body .learndash_checkout_buttons input.btn-join[type="submit"]:hover, body #btn-join:focus, body .learndash_checkout_buttons input.btn-join[type="submit"]:focus' => array(
					'color'            => $btn_h_color,
					'border-color'     => $btn_bg_h_color,
					'background-color' => $btn_bg_h_color,
				),
				'body dd.course_progress div.course_progress_blue, body .wpProQuiz_content .wpProQuiz_time_limit .wpProQuiz_progress' => array(
					'background-color' => $theme_color,
				),
				'body #learndash_lessons a, body #learndash_quizzes a, body .expand_collapse a, body .learndash_topic_dots a, body .learndash_topic_dots a > span, body #learndash_lesson_topics_list span a, body #learndash_profile a, #learndash_profile .profile_edit_profile a, body #learndash_profile .expand_collapse a, body #learndash_profile a span, #lessons_list .list-count, #quiz_list .list-count' => array(
					'color' => $link_color,
				),
				'.learndash .notcompleted:before, #learndash_profile .notcompleted:before, .learndash_topic_dots ul .topic-notcompleted span:before, .learndash_navigation_lesson_topics_list .topic-notcompleted span:before, .learndash_navigation_lesson_topics_list ul .topic-notcompleted span:before, .learndash .topic-notcompleted span:before' => array(
					'color' => smvmt_hex_to_rgba( $text_color, .5 ),
				),
				'body .thumbnail.course .ld_course_grid_price, body .thumbnail.course .ld_course_grid_price.ribbon-enrolled, body #learndash_lessons #lesson_heading, body #learndash_profile .learndash_profile_heading, body #learndash_quizzes #quiz_heading, body #learndash_lesson_topics_list div > strong, body .learndash-pager span a, body #learndash_profile .learndash_profile_quiz_heading' => array(
					'background-color' => $theme_color,
					'color'            => $theme_forground_color,
				),
				'.learndash .completed:before, #learndash_profile .completed:before, .learndash_topic_dots ul .topic-completed span:before, .learndash_navigation_lesson_topics_list .topic-completed span:before, .learndash_navigation_lesson_topics_list ul .topic-completed span:before, .learndash .topic-completed span:before, body .list_arrow.lesson_completed:before' => array(
					'color' => $theme_color,
				),
				'body .thumbnail.course .ld_course_grid_price:before' => array(
					'border-top-color'   => smvmt_hex_to_rgba( $theme_color, .75 ),
					'border-right-color' => smvmt_hex_to_rgba( $theme_color, .75 ),
				),
				'body .wpProQuiz_loadQuiz, body .wpProQuiz_lock' => array(
					'border-color'     => smvmt_hex_to_rgba( $link_color, .5 ),
					'background-color' => smvmt_hex_to_rgba( $link_color, .1 ),
				),
				'#ld_course_list .entry-title' => array(
					'font-size' => smvmt_responsive_font( $archive_post_title_font_size, 'desktop' ),
				),
			);

			if ( ! smvmt_get_option( 'learndash-lesson-serial-number' ) ) {
				$css_output['body #course_list .list-count, body #lessons_list .list-count, body #quiz_list .list-count'] = array(
					'display' => 'none',
				);
				$css_output['body #course_list > div h4 > a, body #lessons_list > div h4 > a, body #quiz_list > div h4 > a, body #learndash_course_content .learndash_topic_dots ul > li a'] = array(
					'padding-left' => '.75em',
					'margin-left'  => 'auto',
				);
			}
			if ( ! smvmt_get_option( 'learndash-differentiate-rows' ) ) {
				$css_output['body #course_list > div:nth-of-type(odd), body #lessons_list > div:nth-of-type(odd), body #quiz_list > div:nth-of-type(odd), body #learndash_lesson_topics_list .learndash_topic_dots ul > li.nth-of-type-odd'] = array(
					'background' => 'none',
				);
			}

			/* Parse CSS from array() */
			$css_output = smvmt_parse_css( $css_output );

			$tablet_typography = array(
				'#ld_course_list .entry-title' => array(
					'font-size' => smvmt_responsive_font( $archive_post_title_font_size, 'tablet', 30 ),
				),
			);
			/* Parse CSS from array()*/
			$css_output .= smvmt_parse_css( $tablet_typography, '', '768' );

			$mobile_typography = array(
				'#ld_course_list .entry-title' => array(
					'font-size' => smvmt_responsive_font( $archive_post_title_font_size, 'mobile', 30 ),
				),
			);
			/* Parse CSS from array()*/
			$css_output .= smvmt_parse_css( $mobile_typography, '', '544' );

			$dynamic_css .= apply_filters( 'smvmt_theme_learndash_dynamic_css', $css_output );

			return $dynamic_css;
		}

		/**
		 * Register Customizer sections and panel for learndash.
		 *
		 * @since 1.3.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			$active_ld_theme = '';

			if ( is_callable( 'LearnDash_Theme_Register::get_active_theme_key' ) ) {
				$active_ld_theme = LearnDash_Theme_Register::get_active_theme_key();
			}

			/**
			 * Register Sections & Panels
			 */
			require SMVMT_THEME_DIR . 'inc/compatibility/learndash/customizer/class-smvmt-customizer-register-learndash-section.php';

			/**
			 * Sections
			 */
			require SMVMT_THEME_DIR . 'inc/compatibility/learndash/customizer/sections/class-smvmt-learndash-container-configs.php';
			require SMVMT_THEME_DIR . 'inc/compatibility/learndash/customizer/sections/class-smvmt-learndash-sidebar-configs.php';

			if ( 'ld30' !== $active_ld_theme ) {
				require SMVMT_THEME_DIR . 'inc/compatibility/learndash/customizer/sections/layout/class-smvmt-learndash-general-configs.php';
			}
		}

		/**
		 * Theme Defaults.
		 *
		 * @since 1.3.0
		 * @param array $defaults Array of options value.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			// General.
			$defaults['learndash-lesson-serial-number'] = false;
			$defaults['learndash-differentiate-rows']   = true;

			// Container.
			$defaults['learndash-content-layout'] = 'plain-container';

			// Sidebar.
			$defaults['learndash-sidebar-layout'] = 'default';

			return $defaults;
		}

		/**
		 * Add assets in theme
		 *
		 * @since 1.3.0
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 */
		public function add_styles( $assets ) {
			$assets['css']['smvmt-learndash'] = 'compatibility/learndash';
			return $assets;
		}

		/**
		 * LeanDash Sidebar
		 *
		 * @since 1.3.0
		 * @param string $layout Layout type.
		 * @return string $layout Layout type.
		 */
		public function sidebar_layout( $layout ) {

			if ( is_singular( 'sfwd-courses' ) || is_singular( 'sfwd-lessons' ) || is_singular( 'sfwd-topic' ) || is_singular( 'sfwd-quiz' ) || is_singular( 'sfwd-certificates' ) || is_singular( 'sfwd-assignment' ) ) {

				$learndash_sidebar = smvmt_get_option( 'learndash-sidebar-layout' );
				if ( 'default' !== $learndash_sidebar ) {
					$layout = $learndash_sidebar;
				}

				$sidebar = smvmt_get_option_meta( 'site-sidebar-layout', '', true );

				if ( 'default' !== $sidebar && ! empty( $sidebar ) ) {
					$layout = $sidebar;
				}
			}

			// When Learhdash shortoce is used on the Page.
			// Applied only to the pages which uses the learndash shortcode.
			global $learndash_shortcode_used;
			$post_type = get_post_type();
			if ( $learndash_shortcode_used && ! ( is_singular( 'sfwd-courses' ) || is_singular( 'sfwd-lessons' ) || is_singular( 'sfwd-topic' ) || is_singular( 'sfwd-quiz' ) || is_singular( 'sfwd-certificates' ) || is_singular( 'sfwd-assignment' ) ) ) {
				// Page Meta Sidebar.
				$layout = smvmt_get_option_meta( 'site-sidebar-layout', '', true );
				if ( empty( $layout ) ) {
					// Page Sidebar.
					$layout = smvmt_get_option( 'single-page-sidebar-layout' );
					// Default Site Sidebar.
					if ( 'default' == $layout || empty( $layout ) ) {
						// Get the global sidebar value.
						// NOTE: Here not used `true` in the below function call.
						$layout = smvmt_get_option( 'site-sidebar-layout' );
					}
				}
			}
			return $layout;
		}

		/**
		 * LeanDash Container
		 *
		 * @since 1.3.0
		 * @param string $layout Layout type.
		 * @return string $layout Layout type.
		 */
		public function content_layout( $layout ) {

			if ( is_singular( 'sfwd-courses' ) || is_singular( 'sfwd-lessons' ) || is_singular( 'sfwd-topic' ) || is_singular( 'sfwd-quiz' ) || is_singular( 'sfwd-certificates' ) || is_singular( 'sfwd-assignment' ) ) {

				$learndash_layout = smvmt_get_option( 'learndash-content-layout' );

				if ( 'default' !== $learndash_layout ) {
					$layout = $learndash_layout;
				}

				$learndash_layout = smvmt_get_option_meta( 'site-content-layout', '', true );

				if ( 'default' !== $learndash_layout && ! empty( $learndash_layout ) ) {
					$layout = $learndash_layout;
				}
			}

			return $layout;
		}
	}

endif;

if ( apply_filters( 'smvmt_enable_learndash_integration', true ) ) {

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	SMVMT_LearnDash::get_instance();
}
