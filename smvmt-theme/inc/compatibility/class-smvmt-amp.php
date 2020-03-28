<?php
/**
 * AMP Compatibility.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2018, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * smvmt BB Ultimate Addon Compatibility
 */
if ( ! class_exists( 'SMVMT_AMP' ) ) :

	/**
	 * Class SMVMT_AMP
	 */
	class SMVMT_AMP {

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
			add_action( 'wp', array( $this, 'SMVMT_amp_init' ) );
		}

		/**
		 * Init smvmt Amp Compatibility.
		 * This adds required actions and filters only if AMP endpoinnt is detected.
		 *
		 * @since 1.7.0
		 * @return void
		 */
		public function SMVMT_amp_init() {

			// bail if AMP endpoint is not detected.
			if ( ! smvmt_is_amp_endpoint() ) {
				return;
			}

			add_filter( 'SMVMT_nav_toggle_data_attrs', array( $this, 'add_nav_toggle_attrs' ) );
			add_filter( 'SMVMT_search_slide_toggle_data_attrs', array( $this, 'add_search_slide_toggle_attrs' ) );
			add_filter( 'SMVMT_search_field_toggle_data_attrs', array( $this, 'add_search_field_toggle_attrs' ) );
			add_action( 'wp_footer', array( $this, 'render_amp_states' ) );
			add_filter( 'smvmt_attr_smvmt-main-header-bar-alignment', array( $this, 'nav_menu_wrapper' ) );
			add_filter( 'smvmt_attr_smvmt-menu-toggle', array( $this, 'menu_toggle_button' ), 20, 3 );
			add_filter( 'smvmt_theme_dynamic_css', array( $this, 'dynamic_css' ) );
			add_filter( 'SMVMT_toggle_button_markup', array( $this, 'toggle_button_markup' ), 20, 2 );
			add_filter( 'smvmt_schema_body', array( $this, 'body_id' ) );
		}

		/**
		 * Add ID to body to toggleClasses on AMP actions.
		 *
		 * @since 1.7.0
		 * @param String $schema markup returned from theme.
		 * @return String
		 */
		public function body_id( $schema ) {
			return $schema . 'id="smvmt-body"';
		}

		/**
		 * Dynamic CSS used for AMP pages.
		 * This should be changed to main CSS in next versions, replacing JavaScript based interactions with pure CSS alternatives.
		 *
		 * @since 1.7.0
		 * @param String $compiled_css Dynamic CSS received to  be enqueued on page.
		 *
		 * @return String Updated dynamic CSS with AMP specific changes.
		 */
		public function dynamic_css( $compiled_css ) {
			$css = array(
				'.smvmt-mobile-menu-buttons'                 => array(
					'text-align'              => 'right',
					'-js-display'             => 'flex',
					'display'                 => '-webkit-box',
					'display'                 => '-webkit-flex',
					'display'                 => '-moz-box',
					'display'                 => '-ms-flexbox',
					'display'                 => 'flex',
					'-webkit-box-pack'        => 'end',
					'-webkit-justify-content' => 'flex-end',
					'-moz-box-pack'           => 'end',
					'-ms-flex-pack'           => 'end',
					'justify-content'         => 'flex-end',
					'-webkit-align-self'      => 'center',
					'-ms-flex-item-align'     => 'center',
					'align-self'              => 'center',
				),

				'.site-header .main-header-bar-wrap .site-branding' => array(
					'display'             => '-webkit-box',
					'display'             => '-webkit-flex',
					'display'             => '-moz-box',
					'display'             => '-ms-flexbox',
					'display'             => 'flex',
					'-webkit-box-flex'    => '1',
					'-webkit-flex'        => '1',
					'-moz-box-flex'       => '1',
					'-ms-flex'            => '1',
					'flex'                => '1',
					'-webkit-align-self'  => 'center',
					'-ms-flex-item-align' => 'center',
					'align-self'          => 'center',
				),

				'.smvmt-main-header-bar-alignment.toggle-on .main-header-bar-navigation' => array(
					'display' => 'block',
				),

				'.main-navigation'                         => array(
					'display' => 'block',
					'width'   => '100%',
				),

				'.main-header-menu > .menu-item > a'       => array(
					'padding'             => '0 20px',
					'display'             => 'inline-block',
					'width'               => '100%',
					'border-bottom-width' => '1px',
					'border-style'        => 'solid',
					'border-color'        => '#eaeaea',
				),

				'.smvmt-main-header-bar-alignment.toggle-on' => array(
					'display'                   => 'block',
					'width'                     => '100%',
					'-webkit-box-flex'          => '1',
					'-webkit-flex'              => 'auto',
					'-moz-box-flex'             => '1',
					'-ms-flex'                  => 'auto',
					'flex'                      => 'auto',
					'-webkit-box-ordinal-group' => '5',
					'-webkit-order'             => '4',
					'-moz-box-ordinal-group'    => '5',
					'-ms-flex-order'            => '4',
					'order'                     => '4',
				),

				'.main-header-menu .menu-item'             => array(
					'width'      => '100%',
					'text-align' => 'left',
					'border-top' => '0',
				),

				'.header-main-layout-1 .main-navigation'   => array(
					'padding' => '0',
				),

				'.main-header-bar-navigation'              => array(
					'width'  => '-webkit-calc( 100% + 40px)',
					'width'  => 'calc( 100% + 40px)',
					'margin' => '0 -20px',
				),

				'.main-header-bar .main-header-bar-navigation .main-header-menu' => array(
					'border-top-width' => '1px',
					'border-style'     => 'solid',
					'border-color'     => '#eaeaea',
				),

				'.main-header-bar .main-header-bar-navigation .page_item_has_children > .smvmt-menu-toggle, .main-header-bar .main-header-bar-navigation .menu-item-has-children > .smvmt-menu-toggle' => array(
					'display'                 => 'inline-block',
					'position'                => 'absolute',
					'font-size'               => 'inherit',
					'top'                     => '-1px',
					'right'                   => '20px',
					'cursor'                  => 'pointer',
					'-webkit-font-smoothing'  => 'antialiased',
					'-moz-osx-font-smoothing' => 'grayscale',
					'padding'                 => '0 0.907em',
					'font-weight'             => 'normal',
					'line-height'             => 'inherit',
					'-webkit-transition'      => 'all .2s',
					'transition'              => 'all .2s',
				),

				'.main-header-bar-navigation .menu-item-has-children > a:after' => array(
					'content' => 'none',
				),

				'.main-header-bar .main-header-bar-navigation .page_item_has_children > .smvmt-menu-toggle::before, .main-header-bar .main-header-bar-navigation .menu-item-has-children > .smvmt-menu-toggle::before' => array(
					'font-weight'     => 'bold',
					'content'         => '"\e900"',
					'font-family'     => 'smvmt',
					'text-decoration' => 'inherit',
					'display'         => 'inline-block',
				),
				'.smvmt-button-wrap .menu-toggle.toggled .menu-toggle-icon:before' => array(
					'content' => "\e5cd",
				),

			);

			$parse_css = $compiled_css . smvmt_parse_css( $css, '', smvmt_header_break_point() );

			// Move all header-break-point css from class based css to media query based CSS.
			$SMVMT_break_point_navigation = array(
				'.smvmt-amp .smvmt-mobile-menu-buttons'        => array(
					'text-align'              => 'right',
					'-js-display'             => 'flex',
					'display'                 => '-webkit-box',
					'display'                 => '-webkit-flex',
					'display'                 => '-moz-box',
					'display'                 => '-ms-flexbox',
					'display'                 => 'flex',
					'-webkit-box-pack'        => 'end',
					'-webkit-justify-content' => 'flex-end',
					'-moz-box-pack'           => 'end',
					'-ms-flex-pack'           => 'end',
					'justify-content'         => 'flex-end',
					'-webkit-align-self'      => 'center',
					'-ms-flex-item-align'     => 'center',
					'align-self'              => 'center',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .main-header-bar .smvmt-search-icon' => array(
					'margin-right' => '1em',
				),
				'.smvmt-theme.smvmt-header-custom-item-inside .main-header-bar .main-header-bar-navigation .smvmt-search-icon' => array(
					'display' => 'none',
				),
				'.smvmt-theme.smvmt-header-custom-item-inside .main-header-bar .smvmt-search-menu-icon .search-field, .smvmt-theme.smvmt-header-custom-item-inside .main-header-bar .smvmt-search-menu-icon.smvmt-inline-search .search-field' => array(
					'width'         => '100%',
					'padding-right' => '5.5em',
				),
				'.smvmt-theme.smvmt-header-custom-item-inside .main-header-bar .smvmt-search-menu-icon .search-submit' => array(
					'display'       => 'block',
					'position'      => 'absolute',
					'height'        => '100%',
					'top'           => '0',
					'right'         => '0',
					'padding'       => '0 1em',
					'border-radius' => '0',
				),
				'.smvmt-theme.smvmt-header-custom-item-inside .main-header-bar .smvmt-search-menu-icon .search-form' => array(
					'padding'  => '0',
					'display'  => 'block',
					'overflow' => 'hidden',
				),
				'.smvmt-amp .entry-content .alignwide'       => array(
					'margin-left'  => 'auto',
					'margin-right' => 'auto',
				),
				'.smvmt-amp .main-navigation'                => array(
					'padding-left' => '0',
				),
				'.smvmt-amp .main-navigation ul li a, .smvmt-amp .main-navigation ul .button-custom-menu-item a' => array(
					'padding'             => '0 20px',
					'display'             => 'inline-block',
					'width'               => '100%',
					'border-bottom-width' => '1px',
					'border-style'        => 'solid',
					'border-color'        => '#eaeaea',
				),
				'.smvmt-amp .main-navigation ul.children li a, .smvmt-amp .main-navigation ul.sub-menu li a' => array(
					'padding-left' => '30px',
				),
				'.smvmt-amp .main-navigation ul.children li a:before, .smvmt-amp .main-navigation ul.sub-menu li a:before' => array(
					'content'         => '""',
					'font-family'     => '"smvmt"',
					'font-size'       => '0.65em',
					'text-decoration' => 'inherit',
					'display'         => 'inline-block',
					'transform'       => 'translate(0, -2px) rotateZ(270deg)',
					'margin-right'    => '5px',
				),
				'.smvmt-amp .main-navigation ul.children li li a, .smvmt-amp .main-navigation ul.sub-menu li li a' => array(
					'padding-left' => '40px',
				),
				'.smvmt-amp .main-navigation ul.children li li li a, .smvmt-amp .main-navigation ul.sub-menu li li li a' => array(),
				'.smvmt-amp .main-navigation ul.children li li li li a, .smvmt-amp .main-navigation ul.sub-menu li li li li a' => array(
					'padding-left' => '60px',
				),
				'.smvmt-amp .smvmt-header-custom-item'         => array(
					'background-color' => '#f9f9f9',
				),
				'.smvmt-amp .main-header-menu'               => array(
					'background-color' => '#f9f9f9',
				),
				'.smvmt-amp .main-header-menu ul'            => array(
					'background-color' => '#f9f9f9',
					'position'         => 'static',
					'opacity'          => '1',
					'visibility'       => 'visible',
					'border'           => '0',
					'width'            => 'auto',
				),
				'.smvmt-amp .main-header-menu ul li.smvmt-left-align-sub-menu:hover > ul, .smvmt-amp .main-header-menu ul li.smvmt-left-align-sub-menu.focus > ul' => array(
					'left' => '0',
				),
				'.smvmt-amp .main-header-menu li.smvmt-sub-menu-goes-outside:hover > ul, .smvmt-amp .main-header-menu li.smvmt-sub-menu-goes-outside.focus > ul' => array(
					'left' => '0',
				),
				'.smvmt-amp .submenu-with-border .sub-menu'  => array(
					'border' => '0',
				),
				'.smvmt-amp .user-select'                    => array(
					'clear' => 'both',
				),
				'.smvmt-amp .smvmt-mobile-menu-buttons'        => array(
					'display'             => 'block',
					'-webkit-align-self'  => 'center',
					'-ms-flex-item-align' => 'center',
					'align-self'          => 'center',
				),
				'.smvmt-amp .main-header-bar-navigation'     => array(
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => 'auto',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => 'auto',
					'flex'             => 'auto',
				),
				'.smvmt-amp .smvmt-main-header-bar-alignment'  => array(
					'display'                   => 'block',
					'width'                     => '100%',
					'-webkit-box-flex'          => '1',
					'-webkit-flex'              => 'auto',
					'-moz-box-flex'             => '1',
					'-ms-flex'                  => 'auto',
					'flex'                      => 'auto',
					'-webkit-box-ordinal-group' => '5',
					'-webkit-order'             => '4',
					'-moz-box-ordinal-group'    => '5',
					'-ms-flex-order'            => '4',
					'order'                     => '4',
				),
				'.smvmt-amp .smvmt-mobile-menu-buttons'        => array(
					'text-align'              => 'right',
					'display'                 => '-webkit-box',
					'display'                 => '-webkit-flex',
					'display'                 => '-moz-box',
					'display'                 => '-ms-flexbox',
					'display'                 => 'flex',
					'-webkit-box-pack'        => 'end',
					'-webkit-justify-content' => 'flex-end',
					'-moz-box-pack'           => 'end',
					'-ms-flex-pack'           => 'end',
					'justify-content'         => 'flex-end',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .site-description' => array(
					'text-align' => 'center',
				),
				'.smvmt-amp .smvmt-mobile-header-stack.smvmt-logo-title-inline .site-description' => array(
					'text-align' => 'left',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-primary-menu-disabled .smvmt-mobile-menu-buttons' => array(
					'display' => 'none',
				),
				'.smvmt-amp .smvmt-hide-custom-menu-mobile .smvmt-masthead-custom-menu-items' => array(
					'display' => 'none',
				),
				'.smvmt-amp .smvmt-mobile-header-inline .site-branding' => array(
					'text-align'     => 'left',
					'padding-bottom' => '0',
				),
				'.smvmt-amp .smvmt-mobile-header-inline.header-main-layout-3 .site-branding' => array(
					'text-align' => 'right',
				),
				'.smvmt-amp .site-header .main-header-bar-wrap .site-branding' => array(
					'-js-display'         => 'flex',
					'display'             => '-webkit-box',
					'display'             => '-webkit-flex',
					'display'             => '-moz-box',
					'display'             => '-ms-flexbox',
					'display'             => 'flex',
					'-webkit-box-flex'    => '1',
					'-webkit-flex'        => '1',
					'-moz-box-flex'       => '1',
					'-ms-flex'            => '1',
					'flex'                => '1',
					'-webkit-align-self'  => 'center',
					'-ms-flex-item-align' => 'center',
					'align-self'          => 'center',
				),
				'.smvmt-amp ul li.smvmt-masthead-custom-menu-items a' => array(
					'padding' => '0',
					'width'   => 'auto',
					'display' => 'initial',
				),
				'.smvmt-amp li.smvmt-masthead-custom-menu-items' => array(
					'padding-left'  => '20px',
					'padding-right' => '20px',
					'margin-bottom' => '1em',
					'margin-top'    => '1em',
				),
				'.smvmt-amp .smvmt-site-identity'              => array(
					'width' => '100%',
				),
				'.smvmt-amp .main-header-bar-navigation .page_item_has_children > a:after, .smvmt-amp .main-header-bar-navigation .menu-item-has-children > a:after' => array(
					'display' => 'none',
				),
				'.smvmt-amp .main-header-bar'                => array(
					'display'     => 'block',
					'line-height' => '3',
				),
				'.smvmt-main-header-bar-alignment .main-header-bar-navigation' => array(
					'line-height' => '3',
					'display'     => 'none',
				),
				'.smvmt-amp .main-header-bar .toggled-on .main-header-bar-navigation' => array(
					'line-height' => '3',
					'display'     => 'none',
				),
				'.smvmt-amp .main-header-bar .main-header-bar-navigation .children, .smvmt-amp .main-header-bar .main-header-bar-navigation .sub-menu' => array(
					'line-height' => '3',
				),
				'.smvmt-amp .main-header-bar .main-header-bar-navigation .page_item_has_children .sub-menu, .smvmt-amp .main-header-bar .main-header-bar-navigation .menu-item-has-children .sub-menu' => array(
					'display' => 'none',
				),
				'.smvmt-amp .main-header-bar .main-header-bar-navigation .menu-item-has-children .dropdown-open+ul.sub-menu' => array(
					'display' => 'block',
				),
				'.smvmt-amp .main-header-bar .main-header-bar-navigation .page_item_has_children > .smvmt-menu-toggle, .smvmt-amp .main-header-bar .main-header-bar-navigation .menu-item-has-children > .smvmt-menu-toggle' => array(
					'display'                => 'inline-block',
					'position'               => 'absolute',
					'font-size'              => 'inherit',
					'top'                    => '-1px',
					'right'                  => '20px',
					'cursor'                 => 'pointer',
					'webkit-font-smoothing'  => 'antialiased',
					'moz-osx-font-smoothing' => 'grayscale',
					'padding'                => '0 0.907em',
					'font-weight'            => 'normal',
					'line-height'            => 'inherit',
					'transition'             => 'all 0.2s',
				),
				'.smvmt-amp .main-header-bar .main-header-bar-navigation .page_item_has_children > .smvmt-menu-toggle::before, .smvmt-amp .main-header-bar .main-header-bar-navigation .menu-item-has-children > .smvmt-menu-toggle::before' => array(
					'font-weight'     => 'bold',
					'content'         => '""',
					'font-family'     => '"smvmt"',
					'text-decoration' => 'inherit',
					'display'         => 'inline-block',
				),
				'.smvmt-amp .main-header-bar .main-header-bar-navigation .smvmt-submenu-expanded > .smvmt-menu-toggle::before' => array(
					'-webkit-transform' => 'rotateX(180deg)',
					'transform'         => 'rotateX(180deg)',
				),
				'.smvmt-amp .main-header-bar .main-header-bar-navigation .main-header-menu' => array(
					'border-top-width' => '1px',
					'border-style'     => 'solid',
					'border-color'     => '#eaeaea',
				),
				'.smvmt-theme.smvmt-header-custom-item-inside .smvmt-search-menu-icon' => array(
					'position'          => 'relative',
					'display'           => 'block',
					'right'             => 'auto',
					'visibility'        => 'visible',
					'opacity'           => '1',
					'-webkit-transform' => 'none',
					'-ms-transform'     => 'none',
					'transform'         => 'none',
				),
				'.smvmt-amp .main-navigation'                => array(
					'display' => 'block',
					'width'   => '100%',
				),
				'.smvmt-amp .main-navigation ul > li:first-child' => array(
					'border-top' => '0',
				),
				'.smvmt-amp .main-navigation ul ul'          => array(
					'left'  => 'auto',
					'right' => 'auto',
				),
				'.smvmt-amp .main-navigation li'             => array(
					'width' => '100%',
				),
				'.smvmt-amp .main-navigation .widget'        => array(
					'margin-bottom' => '1em',
				),
				'.smvmt-amp .main-navigation .widget li'     => array(
					'width' => 'auto',
				),
				'.smvmt-amp .main-navigation .widget:last-child' => array(
					'margin-bottom' => '0',
				),
				'.smvmt-amp .main-header-bar-navigation'     => array(
					'width'  => '-webkit-calc( 100% + 40px)',
					'width'  => 'calc(100% + 40px )',
					'margin' => '0 -20px',
				),
				'.smvmt-amp .main-header-menu ul ul'         => array(
					'top' => '0',
				),
				'.smvmt-amp .smvmt-has-mobile-header-logo .custom-logo-link, .smvmt-amp .smvmt-has-mobile-header-logo .smvmt-logo-svg' => array(
					'display' => 'none',
				),
				'.smvmt-amp .smvmt-has-mobile-header-logo .custom-mobile-logo-link' => array(
					'display' => 'inline-block',
				),
				'.smvmt-theme.smvmt-mobile-inherit-site-logo .smvmt-has-mobile-header-logo .custom-logo-link, .smvmt-theme.smvmt-mobile-inherit-site-logo .smvmt-has-mobile-header-logo .smvmt-logo-svg' => array(
					'display' => 'block',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-menu-buttons' => array(
					'-webkit-box-ordinal-group' => '3',
					'-webkit-order'             => '2',
					'-moz-box-ordinal-group'    => '3',
					'-ms-flex-order'            => '2',
					'order'                     => '2',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .main-header-bar-navigation' => array(
					'-webkit-box-ordinal-group' => '4',
					'-webkit-order'             => '3',
					'-moz-box-ordinal-group'    => '4',
					'-ms-flex-order'            => '3',
					'order'                     => '3',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-masthead-custom-menu-items' => array(
					'-webkit-box-ordinal-group' => '2',
					'-webkit-order'             => '1',
					'-moz-box-ordinal-group'    => '2',
					'-ms-flex-order'            => '1',
					'order'                     => '1',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .header-main-layout-2 .smvmt-masthead-custom-menu-items' => array(
					'text-align' => 'center',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-inline .site-branding, .smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-inline .smvmt-mobile-menu-buttons' => array(
					'-js-display' => 'flex',
					'display'     => '-webkit-box',
					'display'     => '-webkit-flex',
					'display'     => '-moz-box',
					'display'     => '-ms-flexbox',
					'display'     => 'flex',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside.smvmt-header-custom-item-outside .header-main-layout-2 .smvmt-mobile-menu-buttons' => array(
					'padding-bottom' => '0',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-inline .smvmt-site-identity' => array(
					'width' => '100%',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-inline.header-main-layout-3 .smvmt-site-identity' => array(
					'width' => 'auto',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-inline.header-main-layout-2 .site-branding' => array(
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => '1 1 auto',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => '1 1 auto',
					'flex'             => '1 1 auto',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-inline .site-branding' => array(
					'text-align' => 'left',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-inline .site-title' => array(
					'-webkit-box-pack'        => 'left',
					'-webkit-justify-content' => 'left',
					'-moz-box-pack'           => 'left',
					'-ms-flex-pack'           => 'left',
					'justify-content'         => 'left',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .header-main-layout-2 .smvmt-mobile-menu-buttons' => array(
					'padding-bottom' => '1em',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .main-header-container, .smvmt-amp .smvmt-mobile-header-inline .main-header-container' => array(
					'-js-display' => 'flex',
					'display'     => '-webkit-box',
					'display'     => '-webkit-flex',
					'display'     => '-moz-box',
					'display'     => '-ms-flexbox',
					'display'     => 'flex',
				),
				'.smvmt-amp .header-main-layout-1 .site-branding' => array(
					'padding-right' => '1em',
				),
				'.smvmt-amp .header-main-layout-1 .main-header-bar-navigation' => array(
					'text-align' => 'left',
				),
				'.smvmt-amp .header-main-layout-1 .main-navigation' => array(
					'padding-left' => '0',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-masthead-custom-menu-items' => array(
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => '1 1 100%',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => '1 1 100%',
					'flex'             => '1 1 100%',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .site-branding' => array(
					'padding-left'     => '0',
					'padding-right'    => '0',
					'padding-bottom'   => '1em',
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => '1 1 100%',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => '1 1 100%',
					'flex'             => '1 1 100%',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-masthead-custom-menu-items, .smvmt-amp .smvmt-mobile-header-stack .site-branding, .smvmt-amp .smvmt-mobile-header-stack .site-title, .smvmt-amp .smvmt-mobile-header-stack .smvmt-site-identity' => array(
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
					'text-align'              => 'center',
				),
				'.smvmt-amp .smvmt-mobile-header-stack.smvmt-logo-title-inline .site-title' => array(
					'text-align' => 'left',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-mobile-menu-buttons' => array(
					'-webkit-box-flex'        => '1',
					'-webkit-flex'            => '1 1 100%',
					'-moz-box-flex'           => '1',
					'-ms-flex'                => '1 1 100%',
					'flex'                    => '1 1 100%',
					'text-align'              => 'center',
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
				),
				'.smvmt-amp .smvmt-mobile-header-stack.header-main-layout-3 .main-header-container' => array(
					'flex-direction' => 'initial',
				),
				'.smvmt-amp .header-main-layout-2 .smvmt-mobile-menu-buttons' => array(
					'-js-display'             => 'flex',
					'display'                 => '-webkit-box',
					'display'                 => '-webkit-flex',
					'display'                 => '-moz-box',
					'display'                 => '-ms-flexbox',
					'display'                 => 'flex',
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
				),
				'.smvmt-amp .header-main-layout-2 .main-header-bar-navigation, .smvmt-amp .header-main-layout-2 .widget' => array(
					'text-align' => 'left',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .header-main-layout-3 .main-header-bar .smvmt-search-icon' => array(
					'margin-right' => 'auto',
					'margin-left'  => '1em',
				),
				'.smvmt-amp .header-main-layout-3 .main-header-bar .smvmt-search-menu-icon.slide-search .search-form' => array(
					'right' => 'auto',
					'left'  => '0',
				),
				'.smvmt-amp .header-main-layout-3.smvmt-mobile-header-inline .smvmt-mobile-menu-buttons' => array(
					'-webkit-box-pack'        => 'start',
					'-webkit-justify-content' => 'flex-start',
					'-moz-box-pack'           => 'start',
					'-ms-flex-pack'           => 'start',
					'justify-content'         => 'flex-start',
				),
				'.smvmt-amp .header-main-layout-3 li .smvmt-search-menu-icon' => array(
					'left' => '0',
				),
				'.smvmt-amp .header-main-layout-3 .site-branding' => array(
					'padding-left'            => '1em',
					'-webkit-box-pack'        => 'end',
					'-webkit-justify-content' => 'flex-end',
					'-moz-box-pack'           => 'end',
					'-ms-flex-pack'           => 'end',
					'justify-content'         => 'flex-end',
				),
				'.smvmt-amp .header-main-layout-3 .main-navigation' => array(
					'padding-right' => '0',
				),
				'.smvmt-amp .header-main-layout-1 .site-branding' => array(
					'padding-right' => '1em',
				),
				'.smvmt-amp .header-main-layout-1 .main-header-bar-navigation' => array(
					'text-align' => 'left',
				),
				'.smvmt-amp .header-main-layout-1 .main-navigation' => array(
					'padding-left' => '0',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-masthead-custom-menu-items' => array(
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => '1 1 100%',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => '1 1 100%',
					'flex'             => '1 1 100%',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .site-branding' => array(
					'padding-left'     => '0',
					'padding-right'    => '0',
					'padding-bottom'   => '1em',
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => '1 1 100%',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => '1 1 100%',
					'flex'             => '1 1 100%',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-masthead-custom-menu-items, .smvmt-amp .smvmt-mobile-header-stack .site-branding, .smvmt-amp .smvmt-mobile-header-stack .site-title, .smvmt-amp .smvmt-mobile-header-stack .smvmt-site-identity' => array(
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
					'text-align'              => 'center',
				),
				'.smvmt-amp .smvmt-mobile-header-stack.smvmt-logo-title-inline .site-title' => array(
					'text-align' => 'left',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-mobile-menu-buttons' => array(
					'flex'                    => '1 1 100%',
					'text-align'              => 'center',
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
				),
				'.smvmt-amp .smvmt-mobile-header-stack.header-main-layout-3 .main-header-container' => array(
					'flex-direction' => 'initial',
				),
				'.smvmt-amp .header-main-layout-2 .smvmt-mobile-menu-buttons' => array(
					'display'                 => '-webkit-box',
					'display'                 => '-webkit-flex',
					'display'                 => '-moz-box',
					'display'                 => '-ms-flexbox',
					'display'                 => 'flex',
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
				),
				'.smvmt-amp .header-main-layout-2 .main-header-bar-navigation, .smvmt-amp .header-main-layout-2 .widget' => array(
					'text-align' => 'left',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .header-main-layout-3 .main-header-bar .smvmt-search-icon' => array(
					'margin-right' => 'auto',
					'margin-left'  => '1em',
				),
				'.smvmt-amp .header-main-layout-3 .main-header-bar .smvmt-search-menu-icon.slide-search .search-form' => array(
					'right' => 'auto',
					'left'  => '0',
				),
				'.smvmt-amp .header-main-layout-3.smvmt-mobile-header-inline .smvmt-mobile-menu-buttons' => array(
					'-webkit-box-pack'        => 'start',
					'-webkit-justify-content' => 'flex-start',
					'-moz-box-pack'           => 'start',
					'-ms-flex-pack'           => 'start',
					'justify-content'         => 'flex-start',
				),
				'.smvmt-amp .header-main-layout-3 li .smvmt-search-menu-icon' => array(
					'left' => '0',
				),
				'.smvmt-amp .header-main-layout-3 .site-branding' => array(
					'padding-left'            => '1em',
					'-webkit-box-pack'        => 'end',
					'-webkit-justify-content' => 'flex-end',
					'-moz-box-pack'           => 'end',
					'-ms-flex-pack'           => 'end',
					'justify-content'         => 'flex-end',
				),
				'.smvmt-amp .header-main-layout-3 .main-navigation' => array(
					'padding-right' => '0',
				),
				'.smvmt-amp .smvmt-header-widget-area .widget' => array(
					'margin'  => '0.5em 0',
					'display' => 'block',
				),
				'.smvmt-amp .main-header-bar'                => array(
					'border' => '0',
				),
				'.smvmt-amp .nav-fallback-text'              => array(
					'float' => 'none',
				),
				'.smvmt-amp .site-header'                    => array(
					'border-bottom-color' => '#eaeaea',
					'border-bottom-style' => 'solid',
				),
				'.smvmt-amp .smvmt-header-custom-item'         => array(
					'border-top' => '1px solid #eaeaea',
				),
				'.smvmt-amp .smvmt-header-custom-item .smvmt-masthead-custom-menu-items' => array(
					'padding-left'  => '20px',
					'padding-right' => '20px',
					'margin-bottom' => '1em',
					'margin-top'    => '1em',
				),
				'.smvmt-amp .smvmt-header-custom-item .widget:last-child' => array(
					'margin-bottom' => '1em',
				),
				'.smvmt-header-custom-item-inside.smvmt-amp .button-custom-menu-item .menu-link' => array(
					'display' => 'block',
				),
				'.smvmt-header-custom-item-inside.smvmt-amp .button-custom-menu-item' => array(
					'padding-left'  => '0',
					'padding-right' => '0',
					'margin-top'    => '0',
					'margin-bottom' => '0',
				),
				'.smvmt-header-custom-item-inside.smvmt-amp .button-custom-menu-item .smvmt-custom-button-link' => array(
					'display' => 'none',
				),
				'.smvmt-header-custom-item-inside.smvmt-amp .button-custom-menu-item .menu-link' => array(
					'display' => 'block',
				),
				'.smvmt-amp .woocommerce-custom-menu-item .smvmt-cart-menu-wrap' => array(
					'width'          => '2em',
					'height'         => '2em',
					'font-size'      => '1.4em',
					'line-height'    => '2',
					'vertical-align' => 'middle',
					'text-align'     => 'right',
				),
				'.smvmt-amp .main-header-menu .woocommerce-custom-menu-item .smvmt-cart-menu-wrap' => array(
					'height'      => '3em',
					'line-height' => '3',
					'text-align'  => 'left',
				),
				'.smvmt-amp #smvmt-site-header-cart .widget_shopping_cart' => array(
					'display' => 'none',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .smvmt-site-header-cart' => array(
					'order'       => 'initial',
					'line-height' => '3',
					'padding'     => '0 1em 1em 0',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-3 .smvmt-site-header-cart' => array(
					'padding' => '0 0 1em 1em',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu.smvmt-header-custom-item-outside .smvmt-site-header-cart' => array(
					'padding' => '0',
				),
				'.smvmt-amp .smvmt-masthead-custom-menu-items.woocommerce-custom-menu-item' => array(
					'margin-bottom' => '0',
					'margin-top'    => '0',
				),
				'.smvmt-amp .smvmt-masthead-custom-menu-items.woocommerce-custom-menu-item .smvmt-site-header-cart' => array(
					'padding' => '0',
				),
				'.smvmt-amp .smvmt-masthead-custom-menu-items.woocommerce-custom-menu-item .smvmt-site-header-cart a' => array(
					'border'  => 'none',
					'display' => 'inline-block',
				),
				'.smvmt-amp .smvmt-edd-site-header-cart .widget_edd_cart_widget, .smvmt-amp .smvmt-edd-site-header-cart .smvmt-edd-header-cart-info-wrap' => array(
					'display' => 'none',
				),
				'.smvmt-amp div.smvmt-masthead-custom-menu-items.edd-custom-menu-item' => array(
					'padding' => '0',
				),
				'.smvmt-theme.smvmt-header-custom-item-inside .main-header-bar .smvmt-search-menu-icon .search-form' => array(
					'visibility' => 'visible',
					'opacity'    => '1',
					'position'   => 'relative',
					'right'      => 'auto',
					'top'        => 'auto',
					'transform'  => 'none',
				),
				'.smvmt-theme.smvmt-header-custom-item-outside .smvmt-mobile-header-stack .main-header-bar .smvmt-search-icon' => array(
					'margin' => '0',
				),
				'.smvmt-amp .main-header-bar .smvmt-search-menu-icon.slide-search .search-form' => array(
					'right' => '0',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .main-header-bar .smvmt-search-menu-icon.slide-search .search-form' => array(
					'right' => '-1em',
				),
				'.smvmt-safari-browser-less-than-11.smvmt-woocommerce-cart-menu.smvmt-header-break-point .header-main-layout-2 .main-header-container' => array(
					'display' => 'flex',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .site-branding, .smvmt-amp .smvmt-mobile-header-stack .smvmt-mobile-menu-buttons' => array(
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
					'text-align'              => 'center',
					'padding-bottom'          => '0',
				),
				'.smvmt-amp .main-header-menu .sub-menu'     => array(
					'box-shadow' => 'none',
				),
				'.smvmt-amp .submenu-with-border .sub-menu a' => array(
					'border-width' => '1px',
				),
				'.smvmt-amp .submenu-with-border .sub-menu > li:last-child > a' => array(
					'border-width' => '1px',
				),
			);
			$parse_css                   .= smvmt_parse_css( $SMVMT_break_point_navigation, '', smvmt_header_break_point() );

			// 768px
			$SMVMT_medium_break_point_navigation = array(
				'.smvmt-amp .footer-sml-layout-2 .smvmt-small-footer-section-2' => array(
					'margin-top' => '1em',
				),
			);

			$parse_css .= smvmt_parse_css( $SMVMT_medium_break_point_navigation, '768' );

			// 544px
			$SMVMT_small_break_point_navigation = array(
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-1.smvmt-mobile-header-stack.smvmt-no-menu-items .smvmt-site-header-cart, .smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-3.smvmt-mobile-header-stack.smvmt-no-menu-items .smvmt-site-header-cart' => array(
					'padding-right' => '0',
					'padding-left'  => '0',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-1.smvmt-mobile-header-stack .main-header-bar, .smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-3.smvmt-mobile-header-stack .main-header-bar' => array(
					'text-align' => 'center',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-1.smvmt-mobile-header-stack .smvmt-site-header-cart, .smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-3.smvmt-mobile-header-stack .smvmt-site-header-cart' => array(
					'display' => 'inline-block',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-1.smvmt-mobile-header-stack .smvmt-mobile-menu-buttons, .smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-3.smvmt-mobile-header-stack .smvmt-mobile-menu-buttons' => array(
					'display' => 'inline-block',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-2.smvmt-mobile-header-inline .site-branding' => array(
					'flex' => 'auto',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-3.smvmt-mobile-header-stack .site-branding' => array(
					'flex' => '0 0 100%',
				),
				'.smvmt-theme.smvmt-woocommerce-cart-menu .header-main-layout-3.smvmt-mobile-header-stack .main-header-container' => array(
					'display'                 => '-webkit-box',
					'display'                 => '-webkit-flex',
					'display'                 => '-moz-box',
					'display'                 => '-ms-flexbox',
					'display'                 => 'flex',
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-mobile-menu-buttons' => array(
					'width' => '100%',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .site-branding, .smvmt-amp .smvmt-mobile-header-stack .smvmt-mobile-menu-buttons' => array(
					'-webkit-box-pack'        => 'center',
					'-webkit-justify-content' => 'center',
					'-moz-box-pack'           => 'center',
					'-ms-flex-pack'           => 'center',
					'justify-content'         => 'center',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .main-header-bar-wrap .site-branding' => array(
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => '1 1 auto',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => '1 1 auto',
					'-webkit-box-flex' => '1',
					'-webkit-flex'     => '1 1 auto',
					'-moz-box-flex'    => '1',
					'-ms-flex'         => '1 1 auto',
					'flex'             => '1 1 auto',
				),
				'.smvmt-amp .smvmt-mobile-header-stack .smvmt-mobile-menu-buttons' => array(
					'padding-top' => '0.8em',
				),
				'.smvmt-amp .smvmt-mobile-header-stack.header-main-layout-2 .smvmt-mobile-menu-buttons' => array(
					'padding-top' => '0.8em',
				),
				'.smvmt-amp .smvmt-mobile-header-stack.header-main-layout-1 .site-branding' => array(
					'padding-bottom' => '0',
				),
				'.smvmt-header-custom-item-outside.smvmt-amp .smvmt-mobile-header-stack .smvmt-masthead-custom-menu-items' => array(
					'padding'    => '0.8em 1em 0 1em',
					'text-align' => 'center',
					'width'      => '100%',
				),
				'.smvmt-header-custom-item-outside.smvmt-amp .smvmt-mobile-header-stack.header-main-layout-3 .smvmt-mobile-menu-buttons, .smvmt-header-custom-item-outside.smvmt-amp .smvmt-mobile-header-stack.header-main-layout-3 .smvmt-masthead-custom-menu-items' => array(
					'padding-top' => '0.8em',
				),
				// 768px
				'.smvmt-amp .footer-sml-layout-2 .smvmt-small-footer-section-2' => array(
					'margin-top' => '1em',
				),
			);

			$parse_css .= smvmt_parse_css( $SMVMT_small_break_point_navigation, '544' );

			return $parse_css;
		}

		/**
		 * Add AMP attributes to the nav menu wrapper.
		 *
		 * @since 1.7.0
		 * @param Array $attr HTML attributes to be added to the nav menu wrapper.
		 *
		 * @return Array updated HTML attributes.
		 */
		public function nav_menu_wrapper( $attr ) {
			$attr['[class]']         = '( smvmtAmpMenuExpanded ? \'smvmt-main-header-bar-alignment toggle-on\' : \'smvmt-main-header-bar-alignment\' )';
			$attr['aria-expanded']   = 'false';
			$attr['[aria-expanded]'] = '(smvmtAmpMenuExpanded ? \'true\' : \'false\')';

			return $attr;
		}

		/**
		 * Set AMP State for eeach sub menu toggle.
		 *
		 * @since 1.7.0
		 * @param String  $item_output HTML markup for the menu item.
		 * @param  WP_Post $item Post object for the navigation menu.
		 *
		 * @return String HTML MArkup for the menu including the AML State.
		 */
		public function toggle_button_markup( $item_output, $item ) {
			$item_output .= '<amp-state id="smvmtNavMenuItemExpanded' . esc_attr( $item->ID ) . '"><script type="application/json">false</script></amp-state>';

			return $item_output;
		}

		/**
		 * Add AMP attribites to the toggle button to add `.smvmt-submenu-expanded` class to parent li.
		 *
		 * @since 1.7.0
		 * @param array  $attr Optional. Extra attributes to merge with defaults.
		 * @param string $context    The context, to build filter name.
		 * @param array  $args       Optional. Custom data to pass to filter.
		 *
		 * @return Array updated HTML attributes.
		 */
		public function menu_toggle_button( $attr, $context, $args ) {
			$attr['[class]'] = '( smvmtNavMenuItemExpanded' . $args->ID . ' ? \' smvmt-menu-toggle dropdown-open\' : \'smvmt-menu-toggle\')';
			$attr['on']      = 'tap:AMP.setState( { smvmtNavMenuItemExpanded' . $args->ID . ': ! smvmtNavMenuItemExpanded' . $args->ID . ' } )';

			return $attr;
		}

		/**
		 * Add amp states to the dom.
		 */
		public function render_amp_states() {
			echo '<amp-state id="smvmtAmpMenuExpanded">';
			echo '<script type="application/json">false</script>';
			echo '</amp-state>';
		}

		/**
		 * Add search slide data attributes.
		 *
		 * @param string $input the data attrs already existing in the nav.
		 *
		 * @return string
		 */
		public function add_search_slide_toggle_attrs( $input ) {
			$input .= ' on="tap:AMP.setState( { smvmtAmpSlideSearchMenuExpanded: ! smvmtAmpSlideSearchMenuExpanded } )" ';
			$input .= ' [class]="( smvmtAmpSlideSearchMenuExpanded ? \'smvmt-search-menu-icon slide-search smvmt-dropdown-active\' : \'smvmt-search-menu-icon slide-search\' )" ';
			$input .= ' aria-expanded="false" [aria-expanded]="smvmtAmpSlideSearchMenuExpanded ? \'true\' : \'false\'" ';

			return $input;
		}

		/**
		 * Add search slide data attributes.
		 *
		 * @param string $input the data attrs already existing in the nav.
		 *
		 * @return string
		 */
		public function add_search_field_toggle_attrs( $input ) {
			$input .= ' on="tap:AMP.setState( { smvmtAmpSlideSearchMenuExpanded: smvmtAmpSlideSearchMenuExpanded } )" ';

			return $input;
		}

		/**
		 * Add the nav toggle data attributes.
		 *
		 * @param string $input the data attrs already existing in nav toggle.
		 *
		 * @return string
		 */
		public function add_nav_toggle_attrs( $input ) {
			$input .= ' on="tap:AMP.setState( { smvmtAmpMenuExpanded: ! smvmtAmpMenuExpanded } ),smvmt-body.toggleClass(class=smvmt-main-header-nav-open)" ';
			$input .= ' [class]="\'menu-toggle main-header-menu-toggle  smvmt-mobile-menu-buttons-minimal\' + ( smvmtAmpMenuExpanded ? \' toggled\' : \'\' )" ';
			$input .= ' aria-expanded="false" ';
			$input .= ' [aria-expanded]="smvmtAmpMenuExpanded ? \'true\' : \'false\'" ';

			return $input;
		}

	}
endif;

/**
* Kicking this off by calling 'get_instance()' method
*/
SMVMT_AMP::get_instance();
