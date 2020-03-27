<?php
/**
 * Lifter LMS Compatibility File.
 *
 * @package smvmt
 * @since 1.2.0
 */

// If plugin - 'Lifter LMS' not exist then return.
if ( ! class_exists( 'LifterLMS' ) ) {
	return;
}

/**
 * smvmt Lifter LMS Compatibility
 */
if ( ! class_exists( 'SMVMT_LifterLMS' ) ) :

	/**
	 * smvmt Lifter LMS Compatibility
	 *
	 * @since 1.2.0
	 */
	class SMVMT_LifterLMS {

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

			add_action( 'wp', array( $this, 'lifterlms_init' ), 1 );
			add_filter( 'llms_get_theme_default_sidebar', array( $this, 'add_sidebar' ) );
			add_action( 'after_setup_theme', array( $this, 'add_theme_support' ) );
			add_filter( 'smvmt_theme_assets', array( $this, 'add_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'add_dynamic_styles' ) );

			add_action( 'customize_register', array( $this, 'customize_register' ), 2 );

			add_filter( 'smvmt_theme_defaults', array( $this, 'theme_defaults' ) );

			// Sidebar Layout.
			add_filter( 'smvmt_page_layout', array( $this, 'sidebar_layout' ) );
			// Content Layout.
			add_filter( 'smvmt_get_content_layout', array( $this, 'content_layout' ) );

			add_action( 'lifterlms_before_main_content', array( $this, 'before_main_content_start' ) );
			add_action( 'lifterlms_after_main_content', array( $this, 'before_main_content_end' ) );

			// Grid.
			add_filter( 'lifterlms_loop_columns', array( $this, 'course_grid' ) );
			add_filter( 'llms_get_loop_list_classes', array( $this, 'course_responsive_grid' ), 999 );

			// Course builder custom fields.
			add_filter( 'llms_builder_register_custom_fields', array( $this, 'register_builder_fields' ) );

		}

		/**
		 * Remove LifterLMS Default actions
		 *
		 * @since 1.2.0
		 */
		public function lifterlms_init() {

			// Page Title.
			if ( is_courses() ) {
				$course_page_id      = get_option( 'lifterlms_shop_page_id' );
				$course_title        = get_post_meta( $course_page_id, 'site-post-title', true );
				$main_header_display = get_post_meta( $course_page_id, 'smvmt-main-header-display', true );
				$footer_layout       = get_post_meta( $course_page_id, 'footer-sml-layout', true );

				if ( 'disabled' === $course_title ) {
					add_filter( 'lifterlms_show_page_title', '__return_false' );
				}

				if ( 'disabled' === $main_header_display ) {
					remove_action( 'SMVMT_masthead', 'SMVMT_masthead_primary_template' );
				}

				if ( 'disabled' === $footer_layout ) {
					remove_action( 'smvmt_footer_content', 'smvmt_footer_small_footer_template', 5 );
				}
			}

			// Page Title.
			if ( is_memberships() ) {
				$membership_page_id  = get_option( 'lifterlms_memberships_page_id' );
				$membership_title    = get_post_meta( $membership_page_id, 'site-post-title', true );
				$main_header_display = get_post_meta( $membership_page_id, 'smvmt-main-header-display', true );
				$footer_layout       = get_post_meta( $membership_page_id, 'footer-sml-layout', true );

				if ( 'disabled' === $membership_title ) {
					add_filter( 'lifterlms_show_page_title', '__return_false' );
				}

				if ( 'disabled' === $main_header_display ) {
					remove_action( 'SMVMT_masthead', 'SMVMT_masthead_primary_template' );
				}

				if ( 'disabled' === $footer_layout ) {
					remove_action( 'smvmt_footer_content', 'smvmt_footer_small_footer_template', 5 );
				}
			}

			remove_action( 'lifterlms_before_main_content', 'lifterlms_output_content_wrapper', 10 );
			remove_action( 'lifterlms_after_main_content', 'lifterlms_output_content_wrapper_end', 10 );
			remove_action( 'lifterlms_sidebar', 'lifterlms_get_sidebar' );

			if ( is_lesson() ) {
				remove_action( 'lifterlms_single_lesson_after_summary', 'lifterlms_template_lesson_navigation', 20 );
				remove_action( 'SMVMT_entry_after', 'SMVMT_single_post_navigation_markup' );
				if ( 'yes' !== apply_filters( 'llms_blocks_is_post_migrated', get_post_meta( get_the_ID(), '_llms_blocks_migrated', true ), get_the_ID() ) ) {
					add_action( 'SMVMT_entry_after', 'lifterlms_template_lesson_navigation' );
				}
			}

			if ( is_quiz() ) {
				remove_action( 'SMVMT_entry_after', 'SMVMT_single_post_navigation_markup' );
			}

			if ( is_singular( 'llms_assignment' ) ) {
				remove_action( 'SMVMT_entry_after', 'SMVMT_single_post_navigation_markup' );
			}
			$lifter_certificate_post_type = get_post_type();
			if ( 'llms_certificate' === $lifter_certificate_post_type || 'llms_my_certificate' === $lifter_certificate_post_type ) {
				if ( ! is_admin() ) {
					add_filter( 'post_class', 'SMVMT_certificate_class' );

					/**
					 * Remove smvmt-article-single class in case of content-boxed and boxed layout.
					 *
					 * @since 2.3.3
					 * @param array $array is a array of classes.
					 * @return array
					 */
					function SMVMT_certificate_class( $array ) {
						$delete_class = array_search( 'smvmt-article-single', $array );
						if ( false !== $delete_class ) {
							unset( $array[ $delete_class ] );
						}
						return $array;
					}
				}
			}

			remove_action( 'lifterlms_single_course_after_summary', 'lifterlms_template_single_reviews', 100 );
			add_action( 'lifterlms_single_course_after_summary', array( $this, 'single_reviews' ), 100 );

			remove_action( 'lifterlms_student_dashboard_header', 'lifterlms_template_student_dashboard_title', 20 );
		}

		/**
		 * Register Customizer sections and panel for lifterlms
		 *
		 * @since 1.2.0
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function customize_register( $wp_customize ) {

			/**
			 * Register Sections & Panels
			 */
			require SMVMT_THEME_DIR . 'inc/compatibility/lifterlms/customizer/class-smvmt-liferlms-section-configs.php';

			/**
			 * Sections
			 */
			require SMVMT_THEME_DIR . 'inc/compatibility/lifterlms/customizer/sections/class-smvmt-lifter-container-configs.php';
			require SMVMT_THEME_DIR . 'inc/compatibility/lifterlms/customizer/sections/class-smvmt-lifter-sidebar-configs.php';
			require SMVMT_THEME_DIR . 'inc/compatibility/lifterlms/customizer/sections/layout/class-smvmt-lifter-general-configs.php';
		}

		/**
		 * Theme Defaults.
		 *
		 * @since 1.2.0
		 * @param array $defaults Array of options value.
		 * @return array
		 */
		public function theme_defaults( $defaults ) {

			// General.
			$defaults['llms-course-grid']     = array(
				'desktop' => 3,
				'tablet'  => 2,
				'mobile'  => 1,
			);
			$defaults['llms-membership-grid'] = array(
				'desktop' => 3,
				'tablet'  => 2,
				'mobile'  => 1,
			);

			// Container.
			$defaults['lifterlms-content-layout'] = 'plain-container';

			// Sidebar.
			$defaults['lifterlms-sidebar-layout']               = 'no-sidebar';
			$defaults['lifterlms-course-lesson-sidebar-layout'] = 'default';

			return $defaults;
		}

		/**
		 * This function handles the HTML output of the reviews and review form.
		 * If the option is enabled, the review form will be output,
		 * if not, nothing will happen. This function also checks to
		 * see if a user is allowed to review more than once.
		 *
		 * @since 1.2.0
		 */
		public function single_reviews() {

			/**
			 * Check to see if we are supposed to output the code at all
			 */
			if ( get_post_meta( get_the_ID(), '_llms_display_reviews', true ) ) {
				?>
				<div id="old_reviews">
				<h3><?php echo apply_filters( 'lifterlms_reviews_section_title', _e( 'What Others Have Said', 'smvmt' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h3>
				<?php
				$args        = array(
					'posts_per_page'   => get_post_meta( get_the_ID(), '_llms_num_reviews', true ),
					'post_type'        => 'llms_review',
					'post_status'      => 'publish',
					'post_parent'      => get_the_ID(),
					'suppress_filters' => true,
				);
				$posts_array = get_posts( $args );

				$styles = array(
					'background-color' => '#EFEFEF',
					'title-color'      => 'inherit',
					'text-color'       => 'inherit',
					'custom-css'       => '',
				);

				if ( has_filter( 'llms_review_custom_styles' ) ) {
					$styles = apply_filters( 'llms_review_custom_styles', $styles );
				}

				foreach ( $posts_array as $post ) {
					echo $styles['custom-css']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

					?>
					<div class="llms_review" style="background-color:<?php echo esc_attr( $styles['background-color'] ); ?>;">
						<h5 style="color:<?php echo esc_attr( $styles['title-color'] ); ?>;"><strong><?php echo esc_html( get_the_title( $post->ID ) ); ?></strong></h5>
						<?php /* translators: 1 Author Name. */ ?>
						<h6 style="color:<?php echo esc_attr( $styles['text-color'] ); ?>;"><?php echo esc_html( sprintf( __( 'By: %s', 'smvmt' ), get_the_author_meta( 'display_name', get_post_field( 'post_author', $post->ID ) ) ) ); ?></h6>
						<p style="color:<?php echo esc_attr( $styles['text-color'] ); ?>;"><?php echo get_post_field( 'post_content', $post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					</div>
					<?php
				}
				?>
				<hr>
				</div>
				<?php
			}

			/**
			 * Check to see if reviews are open
			 */
			if ( get_post_meta( get_the_ID(), '_llms_reviews_enabled', true ) && is_user_logged_in() ) {
				/**
				 * Look for previous reviews that we have written on this course.
				 *
				 * @var array
				 */
				$args        = array(
					'posts_per_page'   => 1,
					'post_type'        => 'llms_review',
					'post_status'      => 'publish',
					'post_parent'      => get_the_ID(),
					'author'           => get_current_user_id(),
					'suppress_filters' => true,
				);
				$posts_array = get_posts( $args );

				/**
				 * Check to see if we are allowed to write more than one review.
				 * If we are not, check to see if we have written a review already.
				 */
				if ( get_post_meta( get_the_ID(), '_llms_multiple_reviews_disabled', true ) && $posts_array ) {
					?>
					<div id="thank_you_box">
						<h2><?php echo apply_filters( 'llms_review_thank_you_text', __( 'Thank you for your review!', 'smvmt' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
					</div>
					<?php
				} else {
					?>
					<div class="review_box" id="review_box">
					<h3><?php esc_html_e( 'Write a Review', 'smvmt' ); ?></h3>
					<!--<form method="post" name="review_form" id="review_form">-->
						<input type="text" name="review_title" placeholder="<?php esc_attr_e( 'Review Title', 'smvmt' ); ?>" id="review_title">
						<h5 style="color:red; display:none" id="review_title_error"><?php esc_html_e( 'Review Title is required.', 'smvmt' ); ?></h5>
						<textarea name="review_text" placeholder="<?php esc_attr_e( 'Review Text', 'smvmt' ); ?>" id="review_text"></textarea>
						<h5 style="color:red; display:none" id="review_text_error"><?php esc_html_e( 'Review Text is required.', 'smvmt' ); ?></h5>
						<?php wp_nonce_field( 'submit_review', 'submit_review_nonce_code' ); ?>
						<input name="action" value="submit_review" type="hidden">
						<input name="post_ID" value="<?php echo get_the_ID(); ?>" type="hidden" id="post_ID">
						<input type="submit" class="button" value="<?php esc_attr_e( 'Leave Review', 'smvmt' ); ?>" id="llms_review_submit_button">
					<!--</form>	-->
					</div>
					<div id="thank_you_box" style="display:none;">
						<h2><?php echo apply_filters( 'llms_review_thank_you_text', __( 'Thank you for your review!', 'smvmt' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h2>
					</div>
					<?php
				}
			}
		}

		/**
		 * LLMS Grid.
		 *
		 * @since 1.2.0
		 * @param  number $grid Number of grid for course.
		 * @return number
		 */
		public function course_grid( $grid ) {

			$course_grid = smvmt_get_option( 'llms-course-grid' );
			if ( ! empty( $course_grid['desktop'] ) ) {
				return $course_grid['desktop'];
			}
			return $grid;
		}

		/**
		 * LLMS Resposive grid class.
		 *
		 * @since 1.2.0
		 * @param  array $classes Classes.
		 * @return array
		 */
		public function course_responsive_grid( $classes ) {

			$llms_grid = smvmt_get_option( 'llms-course-grid' );
			if ( in_array( 'llms-membership-list', $classes ) ) {
				$llms_grid = smvmt_get_option( 'llms-membership-grid' );

				if ( ! empty( $llms_grid['desktop'] ) ) {
					$default_class = array( 'cols-1', 'cols-2', 'cols-3', 'cols-4', 'cols-5', 'cols-6' );
					foreach ( $default_class as $class ) {
						$index = array_search( $class, $classes );
						if ( $index >= 0 ) {
							unset( $classes[ $index ] );
						}
					}
					$classes[] = 'cols-' . $llms_grid['desktop'];
				}
			}

			if ( ! empty( $llms_grid['tablet'] ) ) {
				$classes[] = 'llms-tablet-cols-' . $llms_grid['tablet'];
			}
			if ( ! empty( $llms_grid['mobile'] ) ) {
				$classes[] = 'llms-mobile-cols-' . $llms_grid['mobile'];
			}

			return $classes;
		}

		/**
		 * Enqueue styles
		 *
		 * @since 1.2.0
		 * @return void
		 */
		public function add_dynamic_styles() {

			/**
			 * - Variable Declaration
			 */
			$theme_color  = smvmt_get_option( 'theme-color' );
			$link_color   = smvmt_get_option( 'link-color', $theme_color );
			$text_color   = smvmt_get_option( 'text-color' );
			$link_h_color = smvmt_get_option( 'link-h-color' );

			$theme_forground_color = smvmt_get_foreground_color( $link_color );
			$btn_color             = smvmt_get_option( 'button-color' );
			if ( empty( $btn_color ) ) {
				$btn_color = $theme_forground_color;
			}

			$btn_h_color = smvmt_get_option( 'button-h-color' );
			if ( empty( $btn_h_color ) ) {
				$btn_h_color = smvmt_get_foreground_color( $link_h_color );
			}
			$btn_bg_color   = smvmt_get_option( 'button-bg-color', '', $link_color );
			$btn_bg_h_color = smvmt_get_option( 'button-bg-h-color', '', $link_h_color );

			$btn_border_radius = smvmt_get_option( 'button-radius' );
			$theme_btn_padding = smvmt_get_option( 'theme-button-padding' );

			$css_output = array(
				'a.llms-button-primary, .llms-button-secondary, .llms-button-action, button.llms-field-button, a.llms-field-button' => array(
					'color'            => $btn_color,
					'border-color'     => $btn_bg_color,
					'background-color' => $btn_bg_color,
				),
				'a.llms-button-primary, .llms-button-secondary, .llms-button-action, .llms-field-button, .llms-button-action.large' => array(
					'border-radius'  => smvmt_get_css_value( $btn_border_radius, 'px' ),
					'padding-top'    => smvmt_responsive_spacing( $theme_btn_padding, 'top', 'desktop' ),
					'padding-right'  => smvmt_responsive_spacing( $theme_btn_padding, 'right', 'desktop' ),
					'padding-bottom' => smvmt_responsive_spacing( $theme_btn_padding, 'bottom', 'desktop' ),
					'padding-left'   => smvmt_responsive_spacing( $theme_btn_padding, 'left', 'desktop' ),
				),
				'a.llms-button-primary:hover, a.llms-button-primary:focus, .llms-button-secondary:hover, .llms-button-secondary:focus, .llms-button-action:hover, .llms-button-action:focus, button.llms-field-button:hover, button.llms-field-button:focus, a.llms-field-button:hover, a.llms-field-button:focus' => array(
					'color'            => $btn_h_color,
					'border-color'     => $btn_bg_h_color,
					'background-color' => $btn_bg_h_color,
				),
				'nav.llms-pagination ul li a:focus, nav.llms-pagination ul li a:hover, nav.llms-pagination ul li span.current' => array(
					'background' => $link_color,
					'color'      => $btn_color,
				),
				'nav.llms-pagination ul, nav.llms-pagination ul li, .llms-instructor-info .llms-instructors .llms-author, .llms-instructor-info .llms-instructors .llms-author .avatar' => array(
					'border-color' => $link_color,
				),
				'.llms-progress .progress-bar-complete, .llms-instructor-info .llms-instructors .llms-author .avatar, h4.llms-access-plan-title, .llms-lesson-preview .llms-icon-free, .llms-access-plan .stamp, .llms-student-dashboard .llms-status.llms-active, .llms-student-dashboard .llms-status.llms-completed, .llms-student-dashboard .llms-status.llms-txn-succeeded, .color-full, body .llms-syllabus-wrapper .llms-section-title' => array(
					'background' => $link_color,
				),
				'.llms-lesson-preview.is-complete .llms-lesson-complete, .llms-lesson-preview.is-free .llms-lesson-complete, .llms-widget-syllabus .lesson-complete-placeholder.done, .llms-widget-syllabus .llms-lesson-complete.done, .single-llms_quiz .llms-quiz-results .llms-donut.passing, .llms-quiz-timer' => array(
					'color' => $link_color,
				),
				'.llms-quiz-timer'                  => array(
					'border-color' => $link_color,
				),
				'.single-llms_quiz .llms-quiz-results .llms-donut.passing svg path' => array(
					'stroke' => $link_color,
				),
				'h4.llms-access-plan-title, .llms-instructor-info .llms-instructors .llms-author .avatar, h4.llms-access-plan-title, .llms-lesson-preview .llms-icon-free, .llms-access-plan .stamp, .llms-student-dashboard .llms-status.llms-active, .llms-student-dashboard .llms-status.llms-completed, .llms-student-dashboard .llms-status.llms-txn-succeeded, body .llms-syllabus-wrapper .llms-section-title' => array(
					'color' => $theme_forground_color,
				),
				'body .progress-bar-complete:after' => array(
					'color' => $theme_forground_color,
				),
			);

			/* Parse CSS from array() */
			$css_output = smvmt_parse_css( $css_output );

			/**
			 * Global button CSS - Tablet.
			 */
			$css_global_button_tablet = array(
				'a.llms-button-primary, .llms-button-secondary, .llms-button-action, .llms-field-button, .llms-button-action.large' => array(
					'padding-top'    => smvmt_responsive_spacing( $theme_btn_padding, 'top', 'tablet' ),
					'padding-right'  => smvmt_responsive_spacing( $theme_btn_padding, 'right', 'tablet' ),
					'padding-bottom' => smvmt_responsive_spacing( $theme_btn_padding, 'bottom', 'tablet' ),
					'padding-left'   => smvmt_responsive_spacing( $theme_btn_padding, 'left', 'tablet' ),
				),
			);

			$css_output .= smvmt_parse_css( $css_global_button_tablet, '', '768' );

			/**
			 * Global button CSS - Mobile.
			 */
			$css_global_button_mobile = array(
				'a.llms-button-primary, .llms-button-secondary, .llms-button-action, .llms-field-button, .llms-button-action.large' => array(
					'padding-top'    => smvmt_responsive_spacing( $theme_btn_padding, 'top', 'mobile' ),
					'padding-right'  => smvmt_responsive_spacing( $theme_btn_padding, 'right', 'mobile' ),
					'padding-bottom' => smvmt_responsive_spacing( $theme_btn_padding, 'bottom', 'mobile' ),
					'padding-left'   => smvmt_responsive_spacing( $theme_btn_padding, 'left', 'mobile' ),
				),
			);

			$css_output .= smvmt_parse_css( $css_global_button_mobile, '', '544' );

			wp_add_inline_style( 'lifterlms-styles', apply_filters( 'smvmt_theme_lifterlms_dynamic_css', $css_output ) );

		}

		/**
		 * Add start of wrapper
		 *
		 * @since 1.2.0
		 * @return void
		 */
		public function before_main_content_start() {
			$site_sidebar = smvmt_page_layout();
			if ( 'left-sidebar' == $site_sidebar ) {
				get_sidebar();
			}
			?>
			<div id="primary" class="content-area primary">

				<?php smvmt_primary_content_top(); ?>

				<main id="main" class="site-main">
					<div class="smvmt-lifterlms-container">
			<?php
		}

		/**
		 * Add end of wrapper
		 *
		 * @since 1.2.0
		 * @return void
		 */
		public function before_main_content_end() {
			?>
					</div> <!-- .smvmt-lifterlms-container -->
				</main> <!-- #main -->

				<?php smvmt_primary_content_bottom(); ?>

			</div> <!-- #primary -->
			<?php
			$site_sidebar = smvmt_page_layout();
			if ( 'right-sidebar' == $site_sidebar ) {
				get_sidebar();
			}
		}

		/**
		 * Display LifterLMS Course and Lesson sidebars
		 * on courses and lessons in place of the sidebar returned by
		 * this function
		 *
		 * @since 1.2.0
		 * @param    string $id    default sidebar id (an empty string).
		 * @return   string
		 */
		public function add_sidebar( $id ) {
			$sidebar_id = 'sidebar-1'; // replace this with theme's sidebar ID.
			return $sidebar_id;
		}

		/**
		 * Declare explicit theme support for LifterLMS course and lesson sidebars
		 *
		 * @since 1.2.0
		 * @return   void
		 */
		public function add_theme_support() {
			add_theme_support( 'lifterlms' );
			add_theme_support( 'lifterlms-quizzes' );
			add_theme_support( 'lifterlms-sidebars' );
		}

		/**
		 * Add assets in theme
		 *
		 * @since 1.2.0
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 */
		public function add_styles( $assets ) {
			$assets['css']['smvmt-lifterlms'] = 'compatibility/lifterlms';
			return $assets;
		}

		/**
		 * LifterLMS Sidebar
		 *
		 * @since 1.2.0
		 * @param string $layout Layout type.
		 * @return string $layout Layout type.
		 */
		public function sidebar_layout( $layout ) {

			if ( ( is_lifterlms() ) || is_llms_account_page() || is_llms_checkout() ) {

				$llms_sidebar = smvmt_get_option( 'lifterlms-sidebar-layout' );
				if ( is_lesson() || is_course() ) {
					$llms_sidebar = smvmt_get_option( 'lifterlms-course-lesson-sidebar-layout' );
				}

				if ( 'default' !== $llms_sidebar ) {

					$layout = $llms_sidebar;
				}

				if ( is_courses() ) {
					$shop_page_id = get_option( 'lifterlms_shop_page_id' );
					$shop_sidebar = get_post_meta( $shop_page_id, 'site-sidebar-layout', true );
				} elseif ( is_memberships() ) {
					$membership_page_id = get_option( 'lifterlms_memberships_page_id' );
					$shop_sidebar       = get_post_meta( $membership_page_id, 'site-sidebar-layout', true );
				} elseif ( is_course_taxonomy() ) {
					$shop_sidebar = 'default';
				} else {
					$shop_sidebar = smvmt_get_option_meta( 'site-sidebar-layout', '', true );
				}

				if ( 'default' !== $shop_sidebar && ! empty( $shop_sidebar ) ) {
					$layout = $shop_sidebar;
				}
			}

			return $layout;
		}

		/**
		 * LifterLMS Container
		 *
		 * @since 1.2.0
		 * @param string $layout Layout type.
		 * @return string $layout Layout type.
		 */
		public function content_layout( $layout ) {

			if ( is_lifterlms() || is_llms_account_page() || is_llms_checkout() ) {

				$llms_layout = smvmt_get_option( 'lifterlms-content-layout' );

				if ( 'default' !== $llms_layout ) {

					$layout = $llms_layout;
				}

				if ( is_courses() ) {
					$shop_page_id = get_option( 'lifterlms_shop_page_id' );
					$shop_layout  = get_post_meta( $shop_page_id, 'site-content-layout', true );
				} elseif ( is_memberships() ) {
					$membership_page_id = get_option( 'lifterlms_memberships_page_id' );
					$shop_layout        = get_post_meta( $membership_page_id, 'site-content-layout', true );
				} elseif ( is_course_taxonomy() ) {
					$shop_layout = 'default';
				} else {
					$shop_layout = smvmt_get_option_meta( 'site-content-layout', '', true );
				}

				if ( 'default' !== $shop_layout && ! empty( $shop_layout ) ) {
					$layout = $shop_layout;
				}
			}

			return $layout;
		}

		/**
		 * Register theme postmeta fields with the LifterLMS Builder
		 *
		 * @since 1.3.3
		 * @param string $default_fields Default custom field definitions.
		 * @return string $default_fields Updated custom field definitions.
		 */
		public function register_builder_fields( $default_fields ) {
			$disable_fields   = array();
			$show_meta_field  = ! SMVMT_Meta_Boxes::is_bb_themer_layout();
			$disable_fields[] = array(
				'attribute' => 'smvmt-main-header-display',
				'id'        => 'smvmt-main-header-display',
				'label'     => esc_html__( 'Disable Primary Header', 'smvmt' ),
				'switch_on' => 'disabled',
				'type'      => 'switch',
			);
			if ( $show_meta_field ) {
				$disable_fields[] = array(
					'attribute' => 'site-post-title',
					'id'        => 'site-post-title',
					'label'     => esc_html__( 'Disable Title', 'smvmt' ),
					'switch_on' => 'disabled',
					'type'      => 'switch',
				);
			}
			if ( $show_meta_field && 'disabled' != smvmt_get_option( 'footer-adv' ) ) {
				$disable_fields[] = array(
					'attribute' => 'footer-adv-display',
					'id'        => 'footer-adv-display',
					'label'     => esc_html__( 'Disable Footer Widgets', 'smvmt' ),
					'switch_on' => 'disabled',
					'type'      => 'switch',
				);
			}
			if ( 'disabled' != smvmt_get_option( 'footer-sml-layout' ) ) {
				$disable_fields[] = array(
					'attribute' => 'footer-sml-layout',
					'id'        => 'footer-sml-layout',
					'label'     => esc_html__( 'Disable Footer Bar', 'smvmt' ),
					'switch_on' => 'disabled',
					'type'      => 'switch',
				);
			}
			$fields['smvmt_theme_settings'] = array(
				'title'      => __( 'Theme Settings', 'smvmt' ),
				'toggleable' => true,
				'fields'     => apply_filters(
					'smvmt_theme_lifterlms_settings',
					array(
						array(
							array(
								'attribute' => 'site-sidebar-layout',
								'id'        => 'site-sidebar-layout',
								'label'     => esc_html__( 'Sidebar', 'smvmt' ),
								'type'      => 'select',
								'options'   => array(
									'default'       => esc_html__( 'Customizer Setting', 'smvmt' ),
									'left-sidebar'  => esc_html__( 'Left Sidebar', 'smvmt' ),
									'right-sidebar' => esc_html__( 'Right Sidebar', 'smvmt' ),
									'no-sidebar'    => esc_html__( 'No Sidebar', 'smvmt' ),
								),
							),
							array(
								'attribute' => 'site-content-layout',
								'id'        => 'site-content-layout',
								'label'     => esc_html__( 'Content Layout', 'smvmt' ),
								'type'      => 'select',
								'options'   => array(
									'default'         => esc_html__( 'Customizer Setting', 'smvmt' ),
									'boxed-container' => esc_html__( 'Boxed', 'smvmt' ),
									'content-boxed-container' => esc_html__( 'Content Boxed', 'smvmt' ),
									'plain-container' => esc_html__( 'Full Width / Contained', 'smvmt' ),
									'page-builder'    => esc_html__( 'Full Width / Stretched', 'smvmt' ),
								),
							),
						),
						$disable_fields,
					)
				),
			);
			$default_fields['assignment']   = $fields;
			$default_fields['lesson']       = $fields;
			$default_fields['quiz']         = $fields;
			return $default_fields;
		}
	}

endif;

/**
 * Kicking this off by calling 'get_instance()' method
 */
if ( apply_filters( 'smvmt_enable_lifterlms_integration', true ) ) {
	SMVMT_LifterLMS::get_instance();
}
