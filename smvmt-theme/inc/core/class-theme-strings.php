<?php
/**
 * smvmt Theme Strings
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

/**
 * Default Strings
 */
if ( ! function_exists( 'smvmt_default_strings' ) ) {

	/**
	 * Default Strings
	 *
	 * @since 1.0.0
	 * @param  string  $key  String key.
	 * @param  boolean $echo Print string.
	 * @return mixed        Return string or nothing.
	 */
	function smvmt_default_strings( $key, $echo = true ) {

		$defaults = apply_filters(
			'smvmt_default_strings',
			array(

				// Header.
				'string-header-skip-link'                => __( 'Skip to content', 'smvmt' ),

				// 404 Page Strings.
				'string-404-sub-title'                   => __( 'It looks like the link pointing here was faulty. Maybe try searching?', 'smvmt' ),

				// Search Page Strings.
				'string-search-nothing-found'            => __( 'Nothing Found', 'smvmt' ),
				'string-search-nothing-found-message'    => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'smvmt' ),
				'string-full-width-search-message'       => __( 'Start typing and press enter to search', 'smvmt' ),
				'string-full-width-search-placeholder'   => __( 'Search &hellip;', 'smvmt' ),
				'string-header-cover-search-placeholder' => __( 'Search &hellip;', 'smvmt' ),
				'string-search-input-placeholder'        => __( 'Search &hellip;', 'smvmt' ),

				// Comment Template Strings.
				'string-comment-reply-link'              => __( 'Reply', 'smvmt' ),
				'string-comment-edit-link'               => __( 'Edit', 'smvmt' ),
				'string-comment-awaiting-moderation'     => __( 'Your comment is awaiting moderation.', 'smvmt' ),
				'string-comment-title-reply'             => __( 'Leave a Comment', 'smvmt' ),
				'string-comment-cancel-reply-link'       => __( 'Cancel Reply', 'smvmt' ),
				'string-comment-label-submit'            => __( 'Post Comment &raquo;', 'smvmt' ),
				'string-comment-label-message'           => __( 'Type here..', 'smvmt' ),
				'string-comment-label-name'              => __( 'Name*', 'smvmt' ),
				'string-comment-label-email'             => __( 'Email*', 'smvmt' ),
				'string-comment-label-website'           => __( 'Website', 'smvmt' ),
				'string-comment-closed'                  => __( 'Comments are closed.', 'smvmt' ),
				'string-comment-navigation-title'        => __( 'Comment navigation', 'smvmt' ),
				'string-comment-navigation-next'         => __( 'Newer Comments', 'smvmt' ),
				'string-comment-navigation-previous'     => __( 'Older Comments', 'smvmt' ),

				// Blog Default Strings.
				'string-blog-page-links-before'          => __( 'Pages:', 'smvmt' ),
				'string-blog-meta-author-by'             => __( 'By ', 'smvmt' ),
				'string-blog-meta-leave-a-comment'       => __( 'Leave a Comment', 'smvmt' ),
				'string-blog-meta-one-comment'           => __( '1 Comment', 'smvmt' ),
				'string-blog-meta-multiple-comment'      => __( '% Comments', 'smvmt' ),
				'string-blog-navigation-next'            => __( 'Next Page', 'smvmt' ) . ' <span class="smvmt-right-arrow">&rarr;</span>',
				'string-blog-navigation-previous'        => '<span class="smvmt-left-arrow">&larr;</span> ' . __( 'Previous Page', 'smvmt' ),

				// Single Post Default Strings.
				'string-single-page-links-before'        => __( 'Pages:', 'smvmt' ),
				/* translators: 1: Post type label */
				'string-single-navigation-next'          => __( 'Next %s', 'smvmt' ) . ' <span class="smvmt-right-arrow">&rarr;</span>',
				/* translators: 1: Post type label */
				'string-single-navigation-previous'      => '<span class="smvmt-left-arrow">&larr;</span> ' . __( 'Previous %s', 'smvmt' ),

				// Content None.
				'string-content-nothing-found-message'   => __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'smvmt' ),

			)
		);

		if ( is_rtl() ) {
			$defaults['string-blog-navigation-next']     = __( 'Next Page', 'smvmt' ) . ' <span class="smvmt-left-arrow">&larr;</span>';
			$defaults['string-blog-navigation-previous'] = '<span class="smvmt-right-arrow">&rarr;</span> ' . __( 'Previous Page', 'smvmt' );

			/* translators: 1: Post type label */
			$defaults['string-single-navigation-next'] = __( 'Next %s', 'smvmt' ) . ' <span class="smvmt-left-arrow">&larr;</span>';
			/* translators: 1: Post type label */
			$defaults['string-single-navigation-previous'] = '<span class="smvmt-right-arrow">&rarr;</span> ' . __( 'Previous %s', 'smvmt' );
		}

		$output = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';

		/**
		 * Print or return
		 */
		if ( $echo ) {
			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output;
		}
	}
}
