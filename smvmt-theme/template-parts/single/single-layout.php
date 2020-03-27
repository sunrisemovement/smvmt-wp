<?php
/**
 * Template for Single post
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

?>

<div <?php SMVMT_blog_layout_class( 'single-layout-1' ); ?>>

	<?php SMVMT_single_header_before(); ?>

	<header class="entry-header <?php SMVMT_entry_header_class(); ?>">

		<?php SMVMT_single_header_top(); ?>

		<?php SMVMT_blog_post_thumbnail_and_title_order(); ?>

		<?php SMVMT_single_header_bottom(); ?>

	</header><!-- .entry-header -->

	<?php SMVMT_single_header_after(); ?>

	<div class="entry-content clear"
	<?php
				echo SMVMT_attr(
					'article-entry-content-single-layout',
					array(
						'class' => '',
					)
				);
				?>
	>

		<?php SMVMT_entry_content_before(); ?>

		<?php the_content(); ?>

		<?php
			SMVMT_edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'smvmt' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>

		<?php SMVMT_entry_content_after(); ?>

		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . esc_html( SMVMT_default_strings( 'string-single-page-links-before', false ) ),
					'after'       => '</div>',
					'link_before' => '<span class="page-link">',
					'link_after'  => '</span>',
				)
			);
			?>
	</div><!-- .entry-content .clear -->
</div>
