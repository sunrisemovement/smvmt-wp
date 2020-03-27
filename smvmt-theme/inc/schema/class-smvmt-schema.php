<?php
/**
 * Schema markup.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 2.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * smvmt Schema Markup.
 *
 * @since 2.1.3
 */
class SMVMT_Schema {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->include_schemas();

		add_action( 'wp', array( $this, 'setup_schema' ) );
	}

	/**
	 * Setup schema
	 *
	 * @since 2.1.3
	 */
	public function setup_schema() { }

	/**
	 * Include schema files.
	 *
	 * @since 2.1.3
	 */
	private function include_schemas() {
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-creativework-schema.php';
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-wpheader-schema.php';
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-wpfooter-schema.php';
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-wpsidebar-schema.php';
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-person-schema.php';
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-organization-schema.php';
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-site-navigation-schema.php';
		require_once SMVMT_THEME_DIR . 'inc/schema/class-smvmt-breadcrumb-schema.php';
	}

	/**
	 * Enabled schema
	 *
	 * @since 2.1.3
	 */
	protected function schema_enabled() {
		return apply_filters( 'smvmt_schema_enabled', true );
	}

}

new SMVMT_Schema();
