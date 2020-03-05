<?php
/**
 * smvmt theme functions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package smvmt
 * @subpackage smvmt theme
 * @since 1.0.0
 */

/**
 * Setup theme support
 */
function smvmt_theme_support() {
    add_theme_support( 'post-thumbnails' );
    
    add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
    );
    
    load_theme_textdomain( 'smvmt-theme' );

    add_theme_support( 'align-wide' );

}

add_action( 'after_setup_theme', 'smvmt_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function smvmt_theme_register_styles() {

	wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), '1.0.0' );
	//wp_enqueue_style( 'smvmt-style', get_template_directory_uri() . '/assets/bundle.css', array(), '1.0.0' );

}

add_action( 'wp_enqueue_scripts', 'smvmt_theme_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function smvmt_theme_register_scripts() {

    //wp_enqueue_script( 'smvmt-theme-js', get_template_directory_uri() . '/assets/bundle.js', array(), '1.0.0', true );

}

add_action( 'wp_enqueue_scripts', 'smvmt_theme_register_scripts' );

add_filter('show_admin_bar', '__return_false');

/**
 * Register ACF Fields
 */

function smvmt_theme_register_field_groups() {
	if ( function_exists('acf_add_local_field_group') ) {
		include_once get_template_directory() . '/includes/acf/field-groups.php';
	}
}

add_action('acf/init', 'smvmt_theme_register_field_groups');

/*------------------------------------*\
	Includes
\*------------------------------------*/

// customizer settings
require_once get_stylesheet_directory() . '/includes/customizer/customizer.php';

