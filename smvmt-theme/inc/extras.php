<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'wp_head', 'SMVMT_pingback_header' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function SMVMT_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

/**
 * Schema for <body> tag.
 */
if ( ! function_exists( 'smvmt_schema_body' ) ) :

	/**
	 * Adds schema tags to the body classes.
	 *
	 * @since 1.0.0
	 */
	function smvmt_schema_body() {

		if ( true !== apply_filters( 'smvmt_schema_enabled', true ) ) {
			return;
		}

		// Check conditions.
		$is_blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;

		// Set up default itemtype.
		$itemtype = 'WebPage';

		// Get itemtype for the blog.
		$itemtype = ( $is_blog ) ? 'Blog' : $itemtype;

		// Get itemtype for search results.
		$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;
		// Get the result.
		$result = apply_filters( 'smvmt_schema_body_itemtype', $itemtype );

		// Return our HTML.
		echo apply_filters( 'smvmt_schema_body', "itemtype='https://schema.org/" . esc_attr( $result ) . "' itemscope='itemscope'" ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'smvmt_body_classes' ) ) {

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @since 1.0.0
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	function smvmt_body_classes( $classes ) {

		if ( wp_is_mobile() ) {
			$classes[] = 'smvmt-header-break-point';
		} else {
			$classes[] = 'smvmt-desktop';
		}

		if ( smvmt_is_amp_endpoint() ) {
			$classes[] = 'smvmt-amp';
		}

		// Apply separate container class to the body.
		$content_layout = smvmt_get_content_layout();
		if ( 'content-boxed-container' == $content_layout ) {
			$classes[] = 'smvmt-separate-container';
		} elseif ( 'boxed-container' == $content_layout ) {
			$classes[] = 'smvmt-separate-container smvmt-two-container';
		} elseif ( 'page-builder' == $content_layout ) {
			$classes[] = 'smvmt-page-builder-template';
		} elseif ( 'plain-container' == $content_layout ) {
			$classes[] = 'smvmt-plain-container';
		}
		// Sidebar location.
		$page_layout = 'smvmt-' . smvmt_page_layout();
		$classes[]   = esc_attr( $page_layout );

		// Current smvmt verion.
		$classes[] = esc_attr( 'smvmt-' . SMVMT_THEME_VERSION );

		$menu_item    = smvmt_get_option( 'header-main-rt-section' );
		$outside_menu = smvmt_get_option( 'header-display-outside-menu' );

		if ( 'none' !== $menu_item && $outside_menu ) {
			$classes[] = 'smvmt-header-custom-item-outside';
		} else {
			$classes[] = 'smvmt-header-custom-item-inside';
		}

		/**
		 * Add class for header width
		 */
		$header_content_layout = smvmt_get_option( 'header-main-layout-width' );

		if ( 'full' == $header_content_layout ) {
			$classes[] = 'smvmt-full-width-primary-header';
		}

		return $classes;
	}
}

add_filter( 'body_class', 'smvmt_body_classes' );


/**
 * smvmt Pagination
 */
if ( ! function_exists( 'SMVMT_number_pagination' ) ) {

	/**
	 * smvmt Pagination
	 *
	 * @since 1.0.0
	 * @return void            Generate & echo pagination markup.
	 */
	function SMVMT_number_pagination() {
		global $numpages;
		$enabled = apply_filters( 'smvmt_pagination_enabled', true );

		if ( isset( $numpages ) && $enabled ) {
			ob_start();
			echo "<div class='smvmt-pagination'>";
			the_posts_pagination(
				array(
					'prev_text'    => smvmt_default_strings( 'string-blog-navigation-previous', false ),
					'next_text'    => smvmt_default_strings( 'string-blog-navigation-next', false ),
					'taxonomy'     => 'category',
					'in_same_term' => true,
				)
			);
			echo '</div>';
			$output = ob_get_clean();
			echo apply_filters( 'smvmt_pagination_markup', $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

add_action( 'smvmt_pagination', 'SMVMT_number_pagination' );

/**
 * Return or echo site logo markup.
 */
if ( ! function_exists( 'SMVMT_logo' ) ) {

	/**
	 * Return or echo site logo markup.
	 *
	 * @since 1.0.0
	 * @param  boolean $echo Echo markup.
	 * @return mixed echo or return markup.
	 */
	function SMVMT_logo( $echo = true ) {

		$display_site_tagline = smvmt_get_option( 'display-site-tagline' );
		$display_site_title   = smvmt_get_option( 'display-site-title' );

		$html = '';

		$has_custom_logo = apply_filters( 'SMVMT_has_custom_logo', has_custom_logo() );

		// Site logo.
		if ( $has_custom_logo ) {

			if ( apply_filters( 'SMVMT_replace_logo_width', true ) ) {
				add_filter( 'wp_get_attachment_image_src', 'SMVMT_replace_header_logo', 10, 4 );
			}

			$html .= '<span class="site-logo-img">';
			$html .= get_custom_logo();
			$html .= '</span>';

			if ( apply_filters( 'SMVMT_replace_logo_width', true ) ) {
				remove_filter( 'wp_get_attachment_image_src', 'SMVMT_replace_header_logo', 10 );
			}
		}

		$html .= smvmt_get_site_title_tagline( $display_site_title, $display_site_tagline );

		$html = apply_filters( 'SMVMT_logo', $html, $display_site_title, $display_site_tagline );

		/**
		 * Echo or Return the Logo Markup
		 */
		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $html;
		}
	}
}

/**
 * Return or echo site logo markup.
 *
 * @since 2.2.0
 * @param boolean $display_site_title Site title enable or not.
 * @param boolean $display_site_tagline Site tagline enable or not.
 *
 * @return string return markup.
 */
function smvmt_get_site_title_tagline( $display_site_title, $display_site_tagline ) {
	$html = '';

	if ( ! apply_filters( 'SMVMT_disable_site_identity', false ) ) {

		// Site Title.
		$tag = 'span';
		if ( is_home() || is_front_page() ) {
			$tag = 'h1';
		}

		/**
		 * Filters the site title output.
		 *
		 * @since 1.4.9
		 *
		 * @param string the HTML output for Site Title.
		 */
		// Site Title.
		$site_title_markup = apply_filters(
			'SMVMT_site_title_output',
			sprintf(
				'<%1$s %4$s>
				<a href="%2$s" rel="home" %5$s >
					%3$s
				</a>
			</%1$s>',
				/**
				* Filters the tags for site title.
				*
				* @since 1.3.1
				*
				* @param string $tags string containing the HTML tags for Site Title.
				*/
				apply_filters( 'SMVMT_site_title_tag', $tag ),
				/**
				* Filters the href for the site title.
				*
				* @since 1.4.9
				*
				* @param string site title home url
				*/
				esc_url( apply_filters( 'SMVMT_site_title_href', home_url( '/' ) ) ),
				/**
				* Filters the site title.
				*
				* @since 1.4.9
				*
				* @param string site title
				*/
				apply_filters( 'SMVMT_site_title', get_bloginfo( 'name' ) ),
				smvmt_attr(
					'site-title',
					array(
						'class' => 'site-title',
					)
				),
				smvmt_attr(
					'site-title-link',
					array()
				)
			)
		);

		// Site Description.
		/**
		 * Filters the site description markup.
		 *
		 * @since 1.4.9
		 *
		 * @param string the HTML output for Site Title.
		 */
		$site_tagline_markup = apply_filters(
			'SMVMT_site_description_markup',
			sprintf(
				'<%1$s class="site-description" itemprop="description">
				%2$s
			</%1$s>',
				/**
				* Filters the tags for site tagline.
				*
				* @since 1.8.5
				*/
				apply_filters( 'SMVMT_site_tagline_tag', 'p' ),
				/**
				* Filters the site description.
				*
				* @since 1.4.9
				*
				* @param string site description
				*/
				apply_filters( 'SMVMT_site_description', get_bloginfo( 'description' ) )
			)
		);

		if ( $display_site_title || $display_site_tagline ) {
			/* translators: 1: Site Title Markup, 2: Site Tagline Markup */
			$html .= sprintf(
				'<div class="smvmt-site-title-wrap">
						%1$s
						%2$s
					</div>',
				( $display_site_title ) ? $site_title_markup : '',
				( $display_site_tagline ) ? $site_tagline_markup : ''
			);
		}
	}
	return $html;
}

/**
 * Return the selected sections
 */
if ( ! function_exists( 'smvmt_get_dynamic_header_content' ) ) {

	/**
	 * Return the selected sections
	 *
	 * @since 1.0.0
	 * @param  string $option Custom content type. E.g. search, text-html etc.
	 * @return array         Array of Custom contents.
	 */
	function smvmt_get_dynamic_header_content( $option ) {

		$output  = array();
		$section = smvmt_get_option( $option );

		switch ( $section ) {

			case 'search':
					$output[] = smvmt_get_search( $option );
				break;

			case 'text-html':
					$output[] = smvmt_get_custom_html( $option . '-html' );
				break;

			case 'widget':
					$output[] = smvmt_get_custom_widget( $option );
				break;

			case 'button':
					$output[] = smvmt_get_custom_button( $option . '-button-text', $option . '-button-link-option', $option . '-button-style' );
				break;

			default:
					$output[] = apply_filters( 'smvmt_get_dynamic_header_content', '', $option, $section );
				break;
		}

		return apply_filters( 'smvmt_get_dynamic_header_content_final', $output );
	}
}


/**
 * Adding Wrapper for Search Form.
 */
if ( ! function_exists( 'smvmt_get_search' ) ) {

	/**
	 * Adding Wrapper for Search Form.
	 *
	 * @since 1.0.0
	 * @param  string $option   Search Option name.
	 * @return mixed Search HTML structure created.
	 */
	function smvmt_get_search( $option = '' ) {
		ob_start();
		?>
		<div class="smvmt-search-menu-icon slide-search" <?php echo apply_filters( 'SMVMT_search_slide_toggle_data_attrs', '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>id="smvmt-search-form" role="search" tabindex="-1">
			<div class="smvmt-search-icon">
				<a class="slide-search smvmt-search-icon" aria-label="Search icon link" href="#">
					<span class="screen-reader-text"><?php esc_html_e( 'Search', 'smvmt' ); ?></span>
				</a>
			</div>
			<?php smvmt_get_search_form(); ?>
		</div>
		<?php
		$search_html = ob_get_clean();

		return apply_filters( 'smvmt_get_search', $search_html, $option );
	}
}

/**
 * Get custom HTML added by user.
 */
if ( ! function_exists( 'smvmt_get_custom_html' ) ) {

	/**
	 * Get custom HTML added by user.
	 *
	 * @since 1.0.0
	 * @param  string $option_name Option name.
	 * @return String TEXT/HTML added by user in options panel.
	 */
	function smvmt_get_custom_html( $option_name = '' ) {

		$custom_html         = '';
		$custom_html_content = smvmt_get_option( $option_name );

		if ( ! empty( $custom_html_content ) ) {
			$custom_html = '<div class="smvmt-custom-html">' . do_shortcode( $custom_html_content ) . '</div>';
		} elseif ( current_user_can( 'edit_theme_options' ) ) {
			$custom_html = '<a href="' . esc_url( admin_url( 'customize.php?autofocus[control]=' . SMVMT_THEME_SETTINGS . '[' . $option_name . ']' ) ) . '">' . __( 'Add Custom HTML', 'smvmt' ) . '</a>';
		}

		return $custom_html;
	}
}

/**
 * Get custom Button.
 */
if ( ! function_exists( 'smvmt_get_custom_button' ) ) {

	/**
	 * Get custom HTML added by user.
	 *
	 * @since 1.0.0
	 * @param string $button_text Button Text.
	 * @param string $button_options Button Link.
	 * @param string $button_style Button Style.
	 * @return String Button added by user in options panel.
	 */
	function smvmt_get_custom_button( $button_text = '', $button_options = '', $button_style = '' ) {

		$custom_html    = '';
		$button_classes = '';
		$button_text    = smvmt_get_option( $button_text );
		$button_style   = smvmt_get_option( $button_style );
		$outside_menu   = smvmt_get_option( 'header-display-outside-menu' );

		$header_button = smvmt_get_option( $button_options );
		$new_tab       = ( $header_button['new_tab'] ? 'target="_blank"' : 'target="_self"' );
		$link_rel      = ( ! empty( $header_button['link_rel'] ) ? 'rel="' . esc_attr( $header_button['link_rel'] ) . '"' : '' );

		$button_classes    = ( 'theme-button' === $button_style ? 'smvmt-button' : 'smvmt-custom-button' );
		$outside_menu_item = apply_filters( 'SMVMT_convert_link_to_button', $outside_menu );

		if ( '1' == $outside_menu_item ) {
			$custom_html = '<a class="smvmt-custom-button-link" href="' . esc_url( do_shortcode( $header_button['url'] ) ) . '" ' . $new_tab . ' ' . $link_rel . '><div class=' . esc_attr( $button_classes ) . '>' . esc_attr( do_shortcode( $button_text ) ) . '</div></a>';
		} else {
			$custom_html  = '<a class="smvmt-custom-button-link" href="' . esc_url( do_shortcode( $header_button['url'] ) ) . '" ' . $new_tab . ' ' . $link_rel . '><div class=' . esc_attr( $button_classes ) . '>' . esc_attr( do_shortcode( $button_text ) ) . '</div></a>';
			$custom_html .= '<a class="menu-link" href="' . esc_url( do_shortcode( $header_button['url'] ) ) . '" ' . $new_tab . ' ' . $link_rel . '>' . esc_attr( do_shortcode( $button_text ) ) . '</a>';
		}

		return $custom_html;
	}
}

/**
 * Get Widget added by user.
 */
if ( ! function_exists( 'smvmt_get_custom_widget' ) ) {

	/**
	 * Get custom widget added by user.
	 *
	 * @since  1.0.1.1
	 * @param  string $option_name Option name.
	 * @return Widget added by user in options panel.
	 */
	function smvmt_get_custom_widget( $option_name = '' ) {

		ob_start();

		if ( 'header-main-rt-section' == $option_name ) {
			$widget_id = 'header-widget';
		}
		if ( 'footer-sml-section-1' == $option_name ) {
			$widget_id = 'footer-widget-1';
		} elseif ( 'footer-sml-section-2' == $option_name ) {
			$widget_id = 'footer-widget-2';
		}

		echo '<div class="smvmt-' . esc_attr( $widget_id ) . '-area"' . apply_filters( 'smvmt_sidebar_data_attrs', '', $widget_id ) . '>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				smvmt_get_sidebar( $widget_id );
		echo '</div>';

		return ob_get_clean();
	}
}

/**
 * Function to get Small Left/Right Footer
 */
if ( ! function_exists( 'smvmt_get_small_footer' ) ) {

	/**
	 * Function to get Small Left/Right Footer
	 *
	 * @since 1.0.0
	 * @param string $section   Sections of Small Footer.
	 * @return mixed            Markup of sections.
	 */
	function smvmt_get_small_footer( $section = '' ) {

		$small_footer_type = smvmt_get_option( $section );
		$output            = null;

		switch ( $small_footer_type ) {
			case 'menu':
					$output = smvmt_get_small_footer_menu();
				break;

			case 'custom':
					$output = smvmt_get_small_footer_custom_text( $section . '-credit' );
				break;

			case 'widget':
					$output = smvmt_get_custom_widget( $section );
				break;
		}

		return $output;
	}
}

/**
 * Function to get Small Footer Custom Text
 */
if ( ! function_exists( 'smvmt_get_small_footer_custom_text' ) ) {

	/**
	 * Function to get Small Footer Custom Text
	 *
	 * @since 1.0.14
	 * @param string $option Custom text option name.
	 * @return mixed         Markup of custom text option.
	 */
	function smvmt_get_small_footer_custom_text( $option = '' ) {

		$output = $option;

		if ( '' != $option ) {
			$output = smvmt_get_option( $option );
			$output = str_replace( '[current_year]', date_i18n( 'Y' ), $output );
			$output = str_replace( '[site_title]', '<span class="smvmt-footer-site-title">' . get_bloginfo( 'name' ) . '</span>', $output );

			$theme_author = apply_filters(
				'smvmt_theme_author',
				array(
					'theme_name'       => __( 'smvmt WordPress Theme', 'smvmt' ),
					'theme_author_url' => 'https://wpsmvmt.com/',
				)
			);

			$output = str_replace( '[theme_author]', '<a href="' . esc_url( $theme_author['theme_author_url'] ) . '">' . $theme_author['theme_name'] . '</a>', $output );
		}

		return do_shortcode( $output );
	}
}

/**
 * Function to get Footer Menu
 */
if ( ! function_exists( 'smvmt_get_small_footer_menu' ) ) {

	/**
	 * Function to get Footer Menu
	 *
	 * @since 1.0.0
	 * @return html
	 */
	function smvmt_get_small_footer_menu() {

		ob_start();

		if ( has_nav_menu( 'footer_menu' ) ) {
			wp_nav_menu(
				array(
					'container'       => 'div',
					'container_class' => 'footer-primary-navigation',
					'theme_location'  => 'footer_menu',
					'menu_class'      => 'nav-menu',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 1,
				)
			);
		} else {
			if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {
				?>
					<a href="<?php echo esc_url( admin_url( '/nav-menus.php?action=locations' ) ); ?>"><?php esc_html_e( 'Assign Footer Menu', 'smvmt' ); ?></a>
				<?php
			}
		}

		return ob_get_clean();
	}
}

/**
 * Function to get site Header
 */
if ( ! function_exists( 'smvmt_header_markup' ) ) {

	/**
	 * Site Header - <header>
	 *
	 * @since 1.0.0
	 */
	function smvmt_header_markup() {

		do_action( 'smvmt_header_markup_before' );
		?>

		<header
			<?php
				echo smvmt_attr(
					'header',
					array(
						'id'    => 'masthead',
						'class' => join( ' ', smvmt_get_header_classes() ),
					)
				);
			?>
		>

			<?php SMVMT_masthead_top(); ?>

			<?php SMVMT_masthead(); ?>

			<?php SMVMT_masthead_bottom(); ?>

		</header><!-- #masthead -->

		<?php
		do_action( 'smvmt_header_markup_after' );

	}
}

add_action( 'smvmt_header', 'smvmt_header_markup' );

/**
 * Function to get site title/logo
 */
if ( ! function_exists( 'SMVMT_site_branding_markup' ) ) {

	/**
	 * Site Title / Logo
	 *
	 * @since 1.0.0
	 */
	function SMVMT_site_branding_markup() {
		?>

		<div class="site-branding">
			<div
			<?php
				echo smvmt_attr(
					'site-identity',
					array(
						'class' => 'smvmt-site-identity',
					)
				);
			?>
			>
				<?php SMVMT_logo(); ?>
			</div>
		</div>

		<!-- .site-branding -->
		<?php
	}
}

add_action( 'SMVMT_masthead_content', 'SMVMT_site_branding_markup', 8 );

/**
 * Function to get Toggle Button Markup
 */
if ( ! function_exists( 'SMVMT_toggle_buttons_markup' ) ) {

	/**
	 * Toggle Button Markup
	 *
	 * @since 1.0.0
	 */
	function SMVMT_toggle_buttons_markup() {
		$disable_primary_navigation = smvmt_get_option( 'disable-primary-nav' );
		$custom_header_section      = smvmt_get_option( 'header-main-rt-section' );
		$hide_custom_menu_mobile    = smvmt_get_option( 'hide-custom-menu-mobile', false );
		$above_header_merge         = smvmt_get_option( 'above-header-merge-menu' );
		$above_header_on_mobile     = smvmt_get_option( 'above-header-on-mobile' );
		$below_header_merge         = smvmt_get_option( 'below-header-merge-menu' );
		$below_header_on_mobile     = smvmt_get_option( 'below-header-on-mobile' );
		$menu_bottons               = true;

		if ( ( $disable_primary_navigation && 'none' == $custom_header_section ) || ( $disable_primary_navigation && true == $hide_custom_menu_mobile ) ) {
			$menu_bottons = false;
			if ( ( true == $above_header_on_mobile && true == $above_header_merge ) || ( true == $below_header_on_mobile && true == $below_header_merge ) ) {
				$menu_bottons = true;
			}
		}

		if ( apply_filters( 'smvmt_enable_mobile_menu_buttons', $menu_bottons ) ) {
			?>
		<div class="smvmt-mobile-menu-buttons">

			<?php SMVMT_masthead_toggle_buttons_before(); ?>

			<?php SMVMT_masthead_toggle_buttons(); ?>

			<?php SMVMT_masthead_toggle_buttons_after(); ?>

		</div>
			<?php
		}
	}
}

add_action( 'SMVMT_masthead_content', 'SMVMT_toggle_buttons_markup', 9 );

/**
 * Function to get Primary navigation menu
 */
if ( ! function_exists( 'SMVMT_primary_navigation_markup' ) ) {

	/**
	 * Site Title / Logo
	 *
	 * @since 1.0.0
	 */
	function SMVMT_primary_navigation_markup() {

		$disable_primary_navigation = smvmt_get_option( 'disable-primary-nav' );
		$custom_header_section      = smvmt_get_option( 'header-main-rt-section' );

		if ( $disable_primary_navigation ) {

			$display_outside = smvmt_get_option( 'header-display-outside-menu' );

			if ( 'none' != $custom_header_section && ! $display_outside ) {

				echo '<div class="main-header-bar-navigation smvmt-header-custom-item smvmt-flex smvmt-justify-content-flex-end">';
				/**
				 * Fires before the Primary Header Menu navigation.
				 * Disable Primary Menu is checked
				 * Last Item in Menu is not 'none'.
				 * Take Last Item in Menu outside is unchecked.
				 *
				 * @since 1.4.0
				 */
				do_action( 'SMVMT_main_header_custom_menu_item_before' );

				echo SMVMT_masthead_get_menu_items(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				/**
				 * Fires after the Primary Header Menu navigation.
				 * Disable Primary Menu is checked
				 * Last Item in Menu is not 'none'.
				 * Take Last Item in Menu outside is unchecked.
				 *
				 * @since 1.4.0
				 */
				do_action( 'SMVMT_main_header_custom_menu_item_after' );

				echo '</div>';

			}
		} else {

			$submenu_class = apply_filters( 'primary_submenu_border_class', ' submenu-with-border' );

			// Menu Animation.
			$menu_animation = smvmt_get_option( 'header-main-submenu-container-animation' );
			if ( ! empty( $menu_animation ) ) {
				$submenu_class .= ' smvmt-menu-animation-' . esc_attr( $menu_animation ) . ' ';
			}

			/**
			 * Filter the classes(array) for Primary Menu (<ul>).
			 *
			 * @since  1.5.0
			 * @var Array
			 */
			$primary_menu_classes = apply_filters( 'SMVMT_primary_menu_classes', array( 'main-header-menu', 'smvmt-nav-menu', 'smvmt-flex', 'smvmt-justify-content-flex-end', $submenu_class ) );

			// Fallback Menu if primary menu not set.
			$fallback_menu_args = array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'main-navigation',
				'container'      => 'div',

				'before'         => '<ul class="' . esc_attr( implode( ' ', $primary_menu_classes ) ) . '">',
				'after'          => '</ul>',
				'walker'         => new SMVMT_Walker_Page(),
			);

			$items_wrap  = '<nav ';
			$items_wrap .= smvmt_attr(
				'site-navigation',
				array(
					'id'         => 'site-navigation',
					'class'      => 'smvmt-flex-grow-1 navigation-accessibility',
					'aria-label' => esc_attr__( 'Site Navigation', 'smvmt' ),
				)
			);
			$items_wrap .= '>';
			$items_wrap .= '<div class="main-navigation">';
			$items_wrap .= '<ul id="%1$s" class="%2$s">%3$s</ul>';
			$items_wrap .= '</div>';
			$items_wrap .= '</nav>';

			// Primary Menu.
			$primary_menu_args = array(
				'theme_location'  => 'primary',
				'menu_id'         => 'primary-menu',
				'menu_class'      => esc_attr( implode( ' ', $primary_menu_classes ) ),
				'container'       => 'div',
				'container_class' => 'main-header-bar-navigation',
				'items_wrap'      => $items_wrap,
			);

			if ( has_nav_menu( 'primary' ) ) {
				// To add default alignment for navigation which can be added through any third party plugin.
				// Do not add any CSS from theme except header alignment.
				echo '<div ' . smvmt_attr( 'smvmt-main-header-bar-alignment' ) . '>';
					wp_nav_menu( $primary_menu_args );
				echo '</div>';
			} else {

				echo '<div ' . smvmt_attr( 'smvmt-main-header-bar-alignment' ) . '>';
					echo '<div class="main-header-bar-navigation">';
						echo '<nav ';
						echo smvmt_attr(
							'site-navigation',
							array(
								'id' => 'site-navigation',
							)
						);
						echo ' class="smvmt-flex-grow-1 navigation-accessibility" aria-label="' . esc_attr__( 'Site Navigation', 'smvmt' ) . '">';
							wp_page_menu( $fallback_menu_args );
						echo '</nav>';
					echo '</div>';
				echo '</div>';
			}
		}

	}
}

add_action( 'SMVMT_masthead_content', 'SMVMT_primary_navigation_markup', 10 );

/**
 * Add CSS classes from wp_nav_menu the wp_page_menu()'s menu items.
 * This will help avoid targeting wp_page_menu and wp_nav_manu separately in CSS/JS.
 *
 * @since 1.6.9
 * @param array   $css_class    An array of CSS classes to be applied
 *                              to each list item.
 * @param WP_Post $page         Page data object.
 * @param int     $depth        Depth of page, used for padding.
 * @param array   $args         An array of arguments.
 * @param int     $current_page ID of the current page.
 * @return Array CSS classes with added menu class `menu-item`
 */
function SMVMT_page_css_class( $css_class, $page, $depth, $args, $current_page ) {
	$css_class[] = 'menu-item';

	if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
		$css_class[] = 'menu-item-has-children';
	}

	if ( ! empty( $current_page ) ) {
		$_current_page = get_post( $current_page );

		if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
			$css_class[] = 'current-menu-ancestor';
		}

		if ( $page->ID == $current_page ) {
			$css_class[] = 'current-menu-item';
		} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
			$css_class[] = 'current-menu-parent';
		}
	} elseif ( get_option( 'page_for_posts' ) == $page->ID ) {
		$css_class[] = 'current-menu-parent';
	}

	return $css_class;
}

add_filter( 'page_css_class', 'SMVMT_page_css_class', 20, 5 );

/**
 * Function to get site Footer
 */
if ( ! function_exists( 'smvmt_footer_markup' ) ) {

	/**
	 * Site Footer - <footer>
	 *
	 * @since 1.0.0
	 */
	function smvmt_footer_markup() {
		?>

		<footer
			<?php
				echo smvmt_attr(
					'footer',
					array(
						'id'    => 'colophon',
						'class' => join( ' ', smvmt_get_footer_classes() ),
					)
				);
			?>
		>

			<?php smvmt_footer_content_top(); ?>

			<?php smvmt_footer_content(); ?>

			<?php smvmt_footer_content_bottom(); ?>

		</footer><!-- #colophon -->
		<?php
	}
}

add_action( 'smvmt_footer', 'smvmt_footer_markup' );

/**
 * Function to get Header Breakpoint
 */
if ( ! function_exists( 'smvmt_header_break_point' ) ) {

	/**
	 * Function to get Header Breakpoint
	 *
	 * @since 1.4.0 Added Mobile Header Breakpoint option from customizer.
	 * @since 1.0.0
	 * @return number
	 */
	function smvmt_header_break_point() {
		$mobile_header_brakpoint = smvmt_get_option( 'mobile-header-breakpoint', 921 );
		return absint( apply_filters( 'smvmt_header_break_point', $mobile_header_brakpoint ) );
	}
}

/**
 * Function to get Body Font Family
 */
if ( ! function_exists( 'smvmt_body_font_family' ) ) {

	/**
	 * Function to get Body Font Family
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function smvmt_body_font_family() {

		$font_family = smvmt_get_option( 'body-font-family' );

		// Body Font Family.
		if ( 'inherit' == $font_family ) {
			$font_family = '-apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen-Sans, Ubuntu, Cantarell, Helvetica Neue, sans-serif';
		}

		return apply_filters( 'smvmt_body_font_family', $font_family );
	}
}

/**
 * Function to get Edit Post Link
 */
if ( ! function_exists( 'SMVMT_edit_post_link' ) ) {

	/**
	 * Function to get Edit Post Link
	 *
	 * @since 1.0.0
	 * @param string $text      Anchor Text.
	 * @param string $before    Anchor Text.
	 * @param string $after     Anchor Text.
	 * @param int    $id           Anchor Text.
	 * @param string $class     Anchor Text.
	 * @return void
	 */
	function SMVMT_edit_post_link( $text, $before = '', $after = '', $id = 0, $class = 'post-edit-link' ) {

		if ( apply_filters( 'SMVMT_edit_post_link', false ) ) {
			edit_post_link( $text, $before, $after, $id, $class );
		}
	}
}

/**
 * Function to get Header Classes
 */
if ( ! function_exists( 'smvmt_header_classes' ) ) {

	/**
	 * Function to get Header Classes
	 *
	 * @since 1.0.0
	 */
	function smvmt_header_classes() {
		echo 'class="' . esc_attr( join( ' ', smvmt_get_header_classes() ) ) . '"';
	}
}

/**
 * Return classnames for <header> element.
 *
 * @since 2.1.0
 * @return Array classnames for the <header>
 */
function smvmt_get_header_classes() {
		$classes                       = array( 'site-header' );
		$menu_logo_location            = smvmt_get_option( 'header-layouts' );
		$mobile_header_alignment       = smvmt_get_option( 'header-main-menu-align' );
		$primary_menu_disable          = smvmt_get_option( 'disable-primary-nav' );
		$primary_menu_custom_item      = smvmt_get_option( 'header-main-rt-section' );
		$logo_title_inline             = smvmt_get_option( 'logo-title-inline' );
		$mobile_header_logo            = smvmt_get_option( 'mobile-header-logo' );
		$mobile_header_order           = smvmt_get_option( 'mobile-header-order' );
		$different_mobile_header_order = smvmt_get_option( 'different-mobile-logo' );
		$hide_custom_menu_mobile       = smvmt_get_option( 'hide-custom-menu-mobile', false );
		$menu_mobile_target            = smvmt_get_option( 'mobile-header-toggle-target', 'icon' );
		$submenu_container_animation   = smvmt_get_option( 'header-main-submenu-container-animation' );

	if ( '' !== $submenu_container_animation ) {
		$classes[] = 'smvmt-primary-submenu-animation-' . $submenu_container_animation;
	}

	if ( $menu_logo_location ) {
		$classes[] = $menu_logo_location;
	}

	if ( $primary_menu_disable ) {

		$classes[] = 'smvmt-primary-menu-disabled';

		if ( 'none' == $primary_menu_custom_item ) {
			$classes[] = 'smvmt-no-menu-items';
		}
	} else {
		$classes[] = 'smvmt-primary-menu-enabled';
	}

		// Add class if Mobile Header Logo is set.
	if ( '' !== $mobile_header_logo && '1' == $different_mobile_header_order ) {
		$classes[] = 'smvmt-has-mobile-header-logo';
	}

		// Add class if Inline Logo & Site Title.
	if ( $logo_title_inline ) {
		$classes[] = 'smvmt-logo-title-inline';
	}

	if ( '1' == $hide_custom_menu_mobile ) {
		$classes[] = 'smvmt-hide-custom-menu-mobile';
	}

	$classes[] = 'smvmt-menu-toggle-' . $menu_mobile_target;

	$classes[] = 'smvmt-mobile-header-' . $mobile_header_alignment;

	$classes = array_unique( apply_filters( 'smvmt_header_class', $classes ) );

	$classes = array_map( 'sanitize_html_class', $classes );

	return apply_filters( 'smvmt_get_header_classes', $classes );
}

/**
 * Function to get Footer Classes
 */
if ( ! function_exists( 'smvmt_footer_classes' ) ) {

	/**
	 * Function to get Footer Classes
	 *
	 * @since 1.0.0
	 */
	function smvmt_footer_classes() {
		echo 'class="' . esc_attr( join( ' ', smvmt_get_footer_classes() ) ) . '"';
	}
}

/**
 * Return classnames for <footer> element.
 *
 * @since 2.1.0
 * @return Array classnames for the <footer>
 */
function smvmt_get_footer_classes() {
	$classes = array_unique( apply_filters( 'smvmt_footer_class', array( 'site-footer' ) ) );
	$classes = array_map( 'sanitize_html_class', $classes );

	return apply_filters( 'smvmt_get_footer_classes', $classes );
}

/**
 * Function to Add Header Breakpoint Style
 */
if ( ! function_exists( 'smvmt_header_breakpoint_style' ) ) {

	/**
	 * Function to Add Header Breakpoint Style
	 *
	 * @param  string $dynamic_css          smvmt Dynamic CSS.
	 * @param  string $dynamic_css_filtered smvmt Dynamic CSS Filters.
	 * @since 1.5.2 Remove ob_start, ob_get_clean and .main-header-bar-wrap::before{content} for our .smvmt-header-break-point class
	 * @since 1.0.0
	 */
	function smvmt_header_breakpoint_style( $dynamic_css, $dynamic_css_filtered = '' ) {

		// Header Break Point.
		$header_break_point = smvmt_header_break_point();

		$smvmt_header_width = smvmt_get_option( 'header-main-layout-width' );

		/* Width for Header */
		if ( 'content' != $smvmt_header_width ) {
			$genral_global_responsive = array(
				'#masthead .smvmt-container, .smvmt-header-breadcrumb .smvmt-container' => array(
					'max-width'     => '100%',
					'padding-left'  => '35px',
					'padding-right' => '35px',
				),
			);
			$padding_below_breakpoint = array(
				'#masthead .smvmt-container, .smvmt-header-breadcrumb .smvmt-container' => array(
					'padding-left'  => '20px',
					'padding-right' => '20px',
				),
			);

			/* Parse CSS from array()*/
			$dynamic_css .= smvmt_parse_css( $genral_global_responsive );
			$dynamic_css .= smvmt_parse_css( $padding_below_breakpoint, '', $header_break_point );

			// trim white space for faster page loading.
			$dynamic_css .= SMVMT_Enqueue_Scripts::trim_css( $dynamic_css );
		}

		return $dynamic_css;
	}
}

add_filter( 'SMVMT_dynamic_theme_css', 'smvmt_header_breakpoint_style' );

/**
 * Function to filter comment form's default fields
 */
if ( ! function_exists( 'SMVMT_comment_form_default_fields_markup' ) ) {

	/**
	 * Function filter comment form's default fields
	 *
	 * @since 1.0.0
	 * @param array $fields Array of comment form's default fields.
	 * @return array        Comment form fields.
	 */
	function SMVMT_comment_form_default_fields_markup( $fields ) {

		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = ( $req ? " aria-required='true'" : '' );

		$fields['author'] = '<div class="smvmt-comment-formwrap smvmt-row"><p class="comment-form-author smvmt-col-xs-12 smvmt-col-sm-12 smvmt-col-md-4 smvmt-col-lg-4">' .
					'<label for="author" class="screen-reader-text">' . esc_html( smvmt_default_strings( 'string-comment-label-name', false ) ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" placeholder="' . esc_attr( smvmt_default_strings( 'string-comment-label-name', false ) ) . '" size="30"' . $aria_req . ' /></p>';
		$fields['email']  = '<p class="comment-form-email smvmt-col-xs-12 smvmt-col-sm-12 smvmt-col-md-4 smvmt-col-lg-4">' .
					'<label for="email" class="screen-reader-text">' . esc_html( smvmt_default_strings( 'string-comment-label-email', false ) ) . '</label><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
					'" placeholder="' . esc_attr( smvmt_default_strings( 'string-comment-label-email', false ) ) . '" size="30"' . $aria_req . ' /></p>';
		$fields['url']    = '<p class="comment-form-url smvmt-col-xs-12 smvmt-col-sm-12 smvmt-col-md-4 smvmt-col-lg-4"><label for="url">' .
					'<label for="url" class="screen-reader-text">' . esc_html( smvmt_default_strings( 'string-comment-label-website', false ) ) . '</label><input id="url" name="url" type="text" value="' . esc_url( $commenter['comment_author_url'] ) .
					'" placeholder="' . esc_attr( smvmt_default_strings( 'string-comment-label-website', false ) ) . '" size="30" /></label></p></div>';

		return apply_filters( 'SMVMT_comment_form_default_fields_markup', $fields );
	}
}

add_filter( 'comment_form_default_fields', 'SMVMT_comment_form_default_fields_markup' );

/**
 * Function to filter comment form arguments
 */
if ( ! function_exists( 'SMVMT_comment_form_default_markup' ) ) {

	/**
	 * Function filter comment form arguments
	 *
	 * @since 1.0.0
	 * @param array $args   Comment form arguments.
	 * @return array
	 */
	function SMVMT_comment_form_default_markup( $args ) {
		/**
		 * Filter to enabled smvmt comment for all Post Types where the commnets are enabled.
		 *
		 * @since 1.5.0
		 *
		 * @return bool
		 */
		$all_post_type_support = apply_filters( 'SMVMT_comment_form_all_post_type_support', false );
		if ( 'post' == get_post_type() || $all_post_type_support ) {
			$args['id_form']           = 'smvmt-commentform';
			$args['title_reply']       = smvmt_default_strings( 'string-comment-title-reply', false );
			$args['cancel_reply_link'] = smvmt_default_strings( 'string-comment-cancel-reply-link', false );
			$args['label_submit']      = smvmt_default_strings( 'string-comment-label-submit', false );
			$args['comment_field']     = '<div class="smvmt-row comment-textarea"><fieldset class="comment-form-comment"><div class="comment-form-textarea smvmt-col-lg-12"><label for="comment" class="screen-reader-text">' . esc_html( smvmt_default_strings( 'string-comment-label-message', false ) ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr( smvmt_default_strings( 'string-comment-label-message', false ) ) . '" cols="45" rows="8" aria-required="true"></textarea></div></fieldset></div>';
		}
		return apply_filters( 'SMVMT_comment_form_default_markup', $args );

	}
}

add_filter( 'comment_form_defaults', 'SMVMT_comment_form_default_markup' );


/**
 * Function to filter comment form arguments
 */
if ( ! function_exists( 'SMVMT_404_page_layout' ) ) {

	/**
	 * Function filter comment form arguments
	 *
	 * @since 1.0.0
	 * @param array $layout     Comment form arguments.
	 * @return array
	 */
	function SMVMT_404_page_layout( $layout ) {

		if ( is_404() ) {
			$layout = 'no-sidebar';
		}

		return apply_filters( 'SMVMT_404_page_layout', $layout );
	}
}

add_filter( 'smvmt_page_layout', 'SMVMT_404_page_layout', 10, 1 );

/**
 * Return current content layout
 */
if ( ! function_exists( 'smvmt_get_content_layout' ) ) {

	/**
	 * Return current content layout
	 *
	 * @since 1.0.0
	 * @return boolean  content layout.
	 */
	function smvmt_get_content_layout() {

		$value = false;

		if ( is_singular() ) {

			// If post meta value is empty,
			// Then get the POST_TYPE content layout.
			$content_layout = smvmt_get_option_meta( 'site-content-layout', '', true );

			if ( empty( $content_layout ) ) {

				$post_type = get_post_type();

				if ( 'post' === $post_type || 'page' === $post_type ) {
					$content_layout = smvmt_get_option( 'single-' . get_post_type() . '-content-layout' );
				}

				if ( 'default' == $content_layout || empty( $content_layout ) ) {

					// Get the GLOBAL content layout value.
					// NOTE: Here not used `true` in the below function call.
					$content_layout = smvmt_get_option( 'site-content-layout', 'full-width' );
				}
			}
		} else {

			$content_layout = '';
			$post_type      = get_post_type();

			if ( 'post' === $post_type ) {
				$content_layout = smvmt_get_option( 'archive-' . get_post_type() . '-content-layout' );
			}

			if ( is_search() ) {
				$content_layout = smvmt_get_option( 'archive-post-content-layout' );
			}

			if ( 'default' == $content_layout || empty( $content_layout ) ) {

				// Get the GLOBAL content layout value.
				// NOTE: Here not used `true` in the below function call.
				$content_layout = smvmt_get_option( 'site-content-layout', 'full-width' );
			}
		}

		return apply_filters( 'smvmt_get_content_layout', $content_layout );
	}
}

/**
 * Display Blog Post Excerpt
 */
if ( ! function_exists( 'smvmt_the_excerpt' ) ) {

	/**
	 * Display Blog Post Excerpt
	 *
	 * @since 1.0.0
	 */
	function smvmt_the_excerpt() {

		$excerpt_type = apply_filters( 'SMVMT_excerpt_type', smvmt_get_option( 'blog-post-content' ) );

		do_action( 'smvmt_the_excerpt_before', $excerpt_type );

		if ( 'full-content' === $excerpt_type ) {
			the_content();
		} else {
			the_excerpt();
		}

		do_action( 'smvmt_the_excerpt_after', $excerpt_type );
	}
}

/**
 * Display Sidebars
 */
if ( ! function_exists( 'smvmt_get_sidebar' ) ) {
	/**
	 * Get Sidebar
	 *
	 * @since 1.0.1.1
	 * @param  string $sidebar_id   Sidebar Id.
	 * @return void
	 */
	function smvmt_get_sidebar( $sidebar_id ) {
		if ( is_active_sidebar( $sidebar_id ) ) {
			dynamic_sidebar( $sidebar_id );
		} elseif ( current_user_can( 'edit_theme_options' ) ) {
			?>
			<div class="widget smvmt-no-widget-row">
				<p class='no-widget-text'>
					<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
						<?php esc_html_e( 'Add Widget', 'smvmt' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
	}
}

/**
 * Get Footer widgets
 */
if ( ! function_exists( 'smvmt_get_footer_widget' ) ) {

	/**
	 * Get Footer Default Sidebar
	 *
	 * @param  string $sidebar_id   Sidebar Id..
	 * @return void
	 */
	function smvmt_get_footer_widget( $sidebar_id ) {

		if ( is_active_sidebar( $sidebar_id ) ) {
			dynamic_sidebar( $sidebar_id );
		} elseif ( current_user_can( 'edit_theme_options' ) ) {

			global $wp_registered_sidebars;
			$sidebar_name = '';
			if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
				$sidebar_name = $wp_registered_sidebars[ $sidebar_id ]['name'];
			}
			?>
			<div class="widget smvmt-no-widget-row">
				<h2 class='widget-title'><?php echo esc_html( $sidebar_name ); ?></h2>

				<p class='no-widget-text'>
					<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
						<?php esc_html_e( 'Click here to assign a widget for this area.', 'smvmt' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
	}
}

/**
 * smvmt entry header class.
 */
if ( ! function_exists( 'SMVMT_entry_header_class' ) ) {

	/**
	 * smvmt entry header class
	 *
	 * @since 1.0.15
	 */
	function SMVMT_entry_header_class() {

		$post_id                    = smvmt_get_post_id();
		$classes                    = array();
		$title_markup               = smvmt_the_title( '', '', $post_id, false );
		$thumb_markup               = smvmt_get_post_thumbnail( '', '', false );
		$post_meta_markup           = SMVMT_single_get_post_meta( '', '', false );
		$blog_single_post_structure = smvmt_get_option( 'blog-single-post-structure' );

		if ( ! $blog_single_post_structure || ( 'single-image' === smvmt_get_prop( $blog_single_post_structure, 0 ) && empty( $thumb_markup ) && 'single-title-meta' !== smvmt_get_prop( $blog_single_post_structure, 1 ) ) ) {
			$classes[] = 'smvmt-header-without-markup';
		} elseif ( empty( $title_markup ) && empty( $thumb_markup ) && ( is_page() || empty( $post_meta_markup ) ) ) {
			$classes[] = 'smvmt-header-without-markup';
		} else {

			if ( empty( $title_markup ) ) {
				$classes[] = 'smvmt-no-title';
			}

			if ( empty( $thumb_markup ) ) {
				$classes[] = 'smvmt-no-thumbnail';
			}

			if ( is_page() || empty( $post_meta_markup ) ) {
				$classes[] = 'smvmt-no-meta';
			}
		}

		$classes = array_unique( apply_filters( 'SMVMT_entry_header_class', $classes ) );
		$classes = array_map( 'sanitize_html_class', $classes );

		echo esc_attr( join( ' ', $classes ) );
	}
}

/**
 * smvmt get post thumbnail image.
 */
if ( ! function_exists( 'smvmt_get_post_thumbnail' ) ) {

	/**
	 * smvmt get post thumbnail image
	 *
	 * @since 1.0.15
	 * @param string  $before Markup before thumbnail image.
	 * @param string  $after  Markup after thumbnail image.
	 * @param boolean $echo   Output print or return.
	 * @return string|void
	 */
	function smvmt_get_post_thumbnail( $before = '', $after = '', $echo = true ) {

		$output = '';

		$check_is_singular = is_singular();

		$featured_image = true;

		if ( $check_is_singular ) {
			$is_featured_image = smvmt_get_option_meta( 'smvmt-featured-img' );
		} else {
			$is_featured_image = smvmt_get_option( 'smvmt-featured-img' );
		}

		if ( 'disabled' === $is_featured_image ) {
			$featured_image = false;
		}

		$featured_image = apply_filters( 'SMVMT_featured_image_enabled', $featured_image );

		$blog_post_thumb   = smvmt_get_option( 'blog-post-structure' );
		$single_post_thumb = smvmt_get_option( 'blog-single-post-structure' );

		if ( ( ( ! $check_is_singular && in_array( 'image', $blog_post_thumb ) ) || ( is_single() && in_array( 'single-image', $single_post_thumb ) ) || is_page() ) && has_post_thumbnail() ) {

			if ( $featured_image && ( ! ( $check_is_singular ) || ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) ) ) {

				$post_thumb = apply_filters(
					'SMVMT_featured_image_markup',
					get_the_post_thumbnail(
						get_the_ID(),
						apply_filters( 'SMVMT_post_thumbnail_default_size', 'large' ),
						apply_filters( 'SMVMT_post_thumbnail_itemprop', '' )
					)
				);

				if ( '' != $post_thumb ) {
					$output .= '<div class="post-thumb-img-content post-thumb">';
					if ( ! $check_is_singular ) {
						$output .= apply_filters(
							'SMVMT_blog_post_featured_image_link_before',
							'<a ' . smvmt_attr(
								'article-image-url',
								array(
									'class' => '',
									'href'  => esc_url( get_permalink() ),
								)
							) . ' >'
						);
					}
					$output .= $post_thumb;
					if ( ! $check_is_singular ) {
						$output .= apply_filters( 'SMVMT_blog_post_featured_image_link_after', '</a>' );
					}
					$output .= '</div>';
				}
			}
		}

		if ( ! $check_is_singular ) {
			$output = apply_filters( 'SMVMT_blog_post_featured_image_after', $output );
		}

		$output = apply_filters( 'smvmt_get_post_thumbnail', $output, $before, $after );

		if ( $echo ) {
			echo $before . $output . $after; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $before . $output . $after;
		}
	}
}

/**
 * Function to check if it is Internet Explorer
 */
if ( ! function_exists( 'smvmt_check_is_ie' ) ) :

	/**
	 * Function to check if it is Internet Explorer.
	 *
	 * @return true | false boolean
	 */
	function smvmt_check_is_ie() {

		$is_ie = false;

		if ( ! empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
			$ua = htmlentities( $_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8' );
			if ( strpos( $ua, 'Trident/7.0' ) !== false ) {
				$is_ie = true;
			}
		}

		return apply_filters( 'smvmt_check_is_ie', $is_ie );
	}

endif;


/**
 * Replace heade logo.
 */
if ( ! function_exists( 'SMVMT_replace_header_logo' ) ) :

	/**
	 * Replace header logo.
	 *
	 * @param array  $image Size.
	 * @param int    $attachment_id Image id.
	 * @param sting  $size Size name.
	 * @param string $icon Icon.
	 *
	 * @return array Size of image
	 */
	function SMVMT_replace_header_logo( $image, $attachment_id, $size, $icon ) {

		$custom_logo_id = get_theme_mod( 'custom_logo' );

		if ( ! is_customize_preview() && $custom_logo_id == $attachment_id && 'full' == $size ) {

			$data = wp_get_attachment_image_src( $attachment_id, 'smvmt-logo-size' );

			if ( false != $data ) {
				$image = $data;
			}
		}

		return apply_filters( 'SMVMT_replace_header_logo', $image );
	}

endif;

/**
 * Function to check if it is Internet Explorer
 */
if ( ! function_exists( 'SMVMT_replace_header_attr' ) ) :

	/**
	 * Replace header logo.
	 *
	 * @param array  $attr Image.
	 * @param object $attachment Image obj.
	 * @param sting  $size Size name.
	 *
	 * @return array Image attr.
	 */
	function SMVMT_replace_header_attr( $attr, $attachment, $size ) {

		if ( ! isset( $attachment ) ) {
			return $attr;
		}

		$custom_logo_id     = get_theme_mod( 'custom_logo' );
		$is_logo_attachment = ( $custom_logo_id == $attachment->ID ) ? true : false;

		if ( apply_filters( 'smvmt_is_logo_attachment', $is_logo_attachment, $attachment ) ) {

			if ( ! is_customize_preview() ) {
				$attach_data = wp_get_attachment_image_src( $attachment->ID, 'smvmt-logo-size' );

				if ( isset( $attach_data[0] ) ) {
					$attr['src'] = $attach_data[0];
				}
			}

			$file_type      = wp_check_filetype( $attr['src'] );
			$file_extension = $file_type['ext'];

			if ( 'svg' == $file_extension ) {
				$attr['width']    = '100%';
				$attr['height']   = '100%';
				$existing_classes = isset( $attr['class'] ) ? $attr['class'] : '';
				$attr['class']    = $existing_classes . ' smvmt-logo-svg';
			}
		}

		if ( apply_filters( 'smvmt_is_retina_logo_attachment', $is_logo_attachment, $attachment ) ) {

			$diff_retina_logo = smvmt_get_option( 'different-retina-logo' );

			if ( '1' == $diff_retina_logo ) {

				$retina_logo = smvmt_get_option( 'smvmt-header-retina-logo' );

				$attr['srcset'] = '';

				if ( apply_filters( 'SMVMT_main_header_retina', true ) && '' !== $retina_logo ) {
					$cutom_logo     = wp_get_attachment_image_src( $custom_logo_id, 'full' );
					$cutom_logo_url = $cutom_logo[0];

					if ( smvmt_check_is_ie() ) {
						// Replace header logo url to retina logo url.
						$attr['src'] = $retina_logo;
					}

					$attr['srcset'] = $cutom_logo_url . ' 1x, ' . $retina_logo . ' 2x';
				}
			}
		}

		return apply_filters( 'SMVMT_replace_header_attr', $attr );
	}

endif;

add_filter( 'wp_get_attachment_image_attributes', 'SMVMT_replace_header_attr', 10, 3 );

/**
 * smvmt Color Palletes.
 */
if ( ! function_exists( 'smvmt_color_palette' ) ) :

	/**
	 * smvmt Color Palletes.
	 *
	 * @return array Color Palletes.
	 */
	function smvmt_color_palette() {

		$color_palette = array(
			'#000000',
			'#ffffff',
			'#dd3333',
			'#dd9933',
			'#eeee22',
			'#81d742',
			'#1e73be',
			'#8224e3',
		);

		return apply_filters( 'smvmt_color_palettes', $color_palette );
	}

endif;

if ( ! function_exists( 'smvmt_get_theme_name' ) ) :

	/**
	 * Get theme name.
	 *
	 * @return string Theme Name.
	 */
	function smvmt_get_theme_name() {

		$theme_name = __( 'smvmt', 'smvmt' );

		return apply_filters( 'smvmt_theme_name', $theme_name );
	}

endif;

if ( ! function_exists( 'SMVMT_strposa' ) ) :

	/**
	 * Strpos over an array.
	 *
	 * @since  1.2.4
	 * @param  String  $haystack The string to search in.
	 * @param  Array   $needles  Array of needles to be passed to strpos().
	 * @param  integer $offset   If specified, search will start this number of characters counted from the beginning of the string. If the offset is negative, the search will start this number of characters counted from the end of the string.
	 *
	 * @return bool            True if haystack if part of any of the $needles.
	 */
	function SMVMT_strposa( $haystack, $needles, $offset = 0 ) {

		if ( ! is_array( $needles ) ) {
			$needles = array( $needles );
		}

		foreach ( $needles as $query ) {

			if ( strpos( $haystack, $query, $offset ) !== false ) {
				// stop on first true result.
				return true;
			}
		}

		return false;
	}

endif;

if ( ! function_exists( 'smvmt_get_addon_name' ) ) :

	/**
	 * Get Addon name.
	 *
	 * @return string Addon Name.
	 */
	function smvmt_get_addon_name() {

		$pro_name = __( 'smvmt Pro', 'smvmt' );
		// If addon is not updated & White Label added for Addon then show the updated addon name.
		if ( class_exists( 'SMVMT_Ext_White_Label_Markup' ) ) {

			$plugin_data = SMVMT_Ext_White_Label_Markup::$branding;

			if ( '' != $plugin_data['smvmt-pro']['name'] ) {
				$pro_name = $plugin_data['smvmt-pro']['name'];
			}
		}

		return apply_filters( 'smvmt_addon_name', $pro_name );
	}
endif;

if ( ! function_exists( 'smvmt_get_prop' ) ) :

	/**
	 * Get a specific property of an array without needing to check if that property exists.
	 *
	 * Provide a default value if you want to return a specific value if the property is not set.
	 *
	 * @since  1.2.7
	 * @access public
	 * @author Gravity Forms - Easiest Tool to Create Advanced Forms for Your WordPress-Powered Website.
	 * @link  https://www.gravityforms.com/
	 *
	 * @param array  $array   Array from which the property's value should be retrieved.
	 * @param string $prop    Name of the property to be retrieved.
	 * @param string $default Optional. Value that should be returned if the property is not set or empty. Defaults to null.
	 *
	 * @return null|string|mixed The value
	 */
	function smvmt_get_prop( $array, $prop, $default = null ) {

		if ( ! is_array( $array ) && ! ( is_object( $array ) && $array instanceof ArrayAccess ) ) {
			return $default;
		}

		if ( isset( $array[ $prop ] ) ) {
			$value = $array[ $prop ];
		} else {
			$value = '';
		}

		return empty( $value ) && null !== $default ? $default : $value;
	}

endif;

/**
 * Build list of attributes into a string and apply contextual filter on string.
 *
 * The contextual filter is of the form `smvmt_attr_{context}_output`.
 *
 * @since 1.6.2
 * @credits - Genesis Theme By StudioPress.
 *
 * @param string $context    The context, to build filter name.
 * @param array  $attributes Optional. Extra attributes to merge with defaults.
 * @param array  $args       Optional. Custom data to pass to filter.
 * @return string String of HTML attributes and values.
 */
function smvmt_attr( $context, $attributes = array(), $args = array() ) {
	return SMVMT_Attr::get_instance()->smvmt_attr( $context, $attributes, $args );
}

/**
 * Return affiliate id.
 *
 * @since 1.6.9
 *
 * @return int affiliate id.
 */
function SMVMT_filter_ninja_forms_affiliate_id() {
	return 1115254;
};

add_filter( 'ninja_forms_affiliate_id', 'SMVMT_filter_ninja_forms_affiliate_id' );

/**
 * Change upgrade link for wpforms.
 *
 * @return String updated upgrade link.
 */
function SMVMT_wpforms_upgrade_link() {
	return 'https://shareasale.com/r.cfm?b=834775&u=1115254&m=64312&urllink=&afftrack=';
}

add_filter( 'wpforms_upgrade_link', 'SMVMT_wpforms_upgrade_link' );

/**
 * Added referal ID to social snap upgrade link.
 *
 * @param string $link social snap upgrade link.
 * @return String social snap upgrade link
 */
function SMVMT_filter_socialsnap_upgrade_link( $link ) {
	return 'https://socialsnap.com/?ref=352';
}

add_filter( 'socialsnap_upgrade_link', 'SMVMT_filter_socialsnap_upgrade_link' );

/**
 * Update GiveWP's "Add-ons" link.
 *
 * This allows affiliates to change the link according to their needs.
 */
function SMVMT_givewp_upgrade_link() {
	$menu_slug = 'edit.php?post_type=give_forms';

	// Remove existing page.
	remove_submenu_page( $menu_slug, 'give-addons' );

	// Add affiliate link to GiveWP.com.
	global $submenu;

	$submenu[ $menu_slug ][] = array( 'Add-ons', 'install_plugins', 'https://givewp.com/ref/412' ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}

add_action( 'admin_menu', 'SMVMT_givewp_upgrade_link', 9999999 );

/**
 * Get instance of WP_Filesystem.
 *
 * @since 2.1.0
 *
 * @return WP_Filesystem
 */
function SMVMT_filesystem() {
	return SMVMT_Filesystem::instance();
}
