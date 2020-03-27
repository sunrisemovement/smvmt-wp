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
 * smvmt Breadcrumb Schema Markup.
 *
 * @since 2.1.3
 */
class SMVMT_Breadcrumb_Schema extends SMVMT_Schema {

	/**
	 * Setup schema
	 *
	 * @since 2.1.3
	 */
	public function setup_schema() {
		add_action( 'wp', array( $this, 'disable_schema_before_title' ), 20 );
	}

	/**
	 * Disable Schema for Before Title option of Breadcrumb Position.
	 *
	 * @since 2.1.3
	 *
	 * @return void
	 */
	public function disable_schema_before_title() {
		$breadcrumb_position = smvmt_get_option( 'breadcrumb-position' );
		$breadcrumb_source   = smvmt_get_option( 'select-breadcrumb-source' );

		if ( ( 'SMVMT_entry_top' === $breadcrumb_position && ( 'default' === $breadcrumb_source || empty( $breadcrumb_source ) ) ) || ( true !== $this->schema_enabled() ) ) {
			add_filter( 'SMVMT_breadcrumb_trail_args', array( $this, 'breadcrumb_schema' ) );
		}
	}

	/**
	 * Disable schema by passing false to the 'schema' param to the filter.
	 *
	 * @since 2.1.3
	 *
	 * @param  array $args An array of default values.
	 *
	 * @return array       Updated schema param.
	 */
	public function breadcrumb_schema( $args ) {
		$args['schema'] = false;

		return $args;
	}

	/**
	 * Enabled schema
	 *
	 * @since 2.1.3
	 */
	protected function schema_enabled() {
		return apply_filters( 'SMVMT_breadcrumb_schema_enabled', parent::schema_enabled() );
	}

}

new SMVMT_Breadcrumb_Schema();
