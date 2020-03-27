<?php
/**
 * smvmt functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package smvmt
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'SMVMT_THEME_VERSION', '2.3.4' );
define( 'SMVMT_THEME_SETTINGS', 'smvmt-settings' );
define( 'SMVMT_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'SMVMT_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

/**
 * Setup helper functions of smvmt.
 */
require_once SMVMT_THEME_DIR . 'inc/core/class-smvmt-theme-options.php';
require_once SMVMT_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once SMVMT_THEME_DIR . 'inc/core/common-functions.php';

/**
 * Update theme
 */
require_once SMVMT_THEME_DIR . 'inc/theme-update/class-smvmt-theme-update.php';
require_once SMVMT_THEME_DIR . 'inc/theme-update/smvmt-update-functions.php';
require_once SMVMT_THEME_DIR . 'inc/theme-update/class-smvmt-theme-background-updater.php';
require_once SMVMT_THEME_DIR . 'inc/theme-update/class-smvmt-pb-compatibility.php';


/**
 * Fonts Files
 */
require_once SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-font-families.php';
if ( is_admin() ) {
	require_once SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-fonts-data.php';
}

require_once SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-fonts.php';

require_once SMVMT_THEME_DIR . 'inc/core/class-smvmt-walker-page.php';
require_once SMVMT_THEME_DIR . 'inc/core/class-smvmt-enqueue-scripts.php';
require_once SMVMT_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once SMVMT_THEME_DIR . 'inc/class-smvmt-dynamic-css.php';

/**
 * Custom template tags for this theme.
 */
require_once SMVMT_THEME_DIR . 'inc/core/class-smvmt-attr.php';
require_once SMVMT_THEME_DIR . 'inc/template-tags.php';

require_once SMVMT_THEME_DIR . 'inc/widgets.php';
require_once SMVMT_THEME_DIR . 'inc/core/theme-hooks.php';
require_once SMVMT_THEME_DIR . 'inc/admin-functions.php';
require_once SMVMT_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once SMVMT_THEME_DIR . 'inc/extras.php';
require_once SMVMT_THEME_DIR . 'inc/blog/blog-config.php';
require_once SMVMT_THEME_DIR . 'inc/blog/blog.php';
require_once SMVMT_THEME_DIR . 'inc/blog/single-blog.php';
/**
 * Markup Files
 */
require_once SMVMT_THEME_DIR . 'inc/template-parts.php';
require_once SMVMT_THEME_DIR . 'inc/class-smvmt-loop.php';
require_once SMVMT_THEME_DIR . 'inc/class-smvmt-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once SMVMT_THEME_DIR . 'inc/class-smvmt-after-setup-theme.php';

// Required files.
require_once SMVMT_THEME_DIR . 'inc/core/class-smvmt-admin-helper.php';

require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-schema.php';

if ( is_admin() ) {

	/**
	 * Admin Menu Settings
	 */
	require_once SMVMT_THEME_DIR . 'inc/core/class-smvmt-admin-settings.php';
	require_once SMVMT_THEME_DIR . 'inc/lib/notices/class-smvmt-notices.php';

	/**
	 * Metabox additions.
	 */
	require_once SMVMT_THEME_DIR . 'inc/metabox/class-smvmt-meta-boxes.php';
}

require_once SMVMT_THEME_DIR . 'inc/metabox/class-smvmt-meta-box-operations.php';


/**
 * Customizer additions.
 */
require_once SMVMT_THEME_DIR . 'inc/customizer/class-smvmt-customizer.php';


/**
 * Compatibility
 */
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-jetpack.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/woocommerce/class-smvmt-woocommerce.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/edd/class-smvmt-edd.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/lifterlms/class-smvmt-lifterlms.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/learndash/class-smvmt-learndash.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-beaver-builder.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-bb-ultimate-addon.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-contact-form-7.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-visual-composer.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-site-origin.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-gravity-forms.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-bne-flyout.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-ubermeu.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-divi-builder.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-amp.php';
require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-yoast-seo.php';
require_once SMVMT_THEME_DIR . 'inc/addons/transparent-header/class-smvmt-ext-transparent-header.php';
require_once SMVMT_THEME_DIR . 'inc/addons/breadcrumbs/class-smvmt-breadcrumbs.php';
require_once SMVMT_THEME_DIR . 'inc/addons/heading-colors/class-smvmt-heading-colors.php';
require_once SMVMT_THEME_DIR . 'inc/addons/header-sections/class-smvmt-ext-header-sections.php';
require_once SMVMT_THEME_DIR . 'inc/addons/colors-and-background/class-smvmt-ext-colors-and-background.php';
require_once SMVMT_THEME_DIR . 'inc/addons/site-layouts/class-smvmt-ext-site-layouts.php';
require_once SMVMT_THEME_DIR . 'inc/addons/sticky-header/class-smvmt-ext-sticky-header.php';


require_once SMVMT_THEME_DIR . 'inc/class-smvmt-filesystem.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
	require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-elementor.php';
	require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-elementor-pro.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymus functions.
if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	require_once SMVMT_THEME_DIR . 'inc/compatibility/class-smvmt-beaver-themer.php';
}

/**
 * Load deprecated functions
 */
require_once SMVMT_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once SMVMT_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once SMVMT_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';
