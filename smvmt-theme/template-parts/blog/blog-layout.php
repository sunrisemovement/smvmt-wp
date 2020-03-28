<?php
/**
 * Template for Blog
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://smvmt.org/
 * @since       smvmt 1.0.0
 */

?>
<div <?php SMVMT_blog_layout_class( 'blog-layout-1' ); ?>>

	<div class="post-content smvmt-col-md-12">

		<?php SMVMT_blog_post_thumbnail_and_title_order(); ?>

		<div class="entry-content clear"
			<?php
				echo smvmt_attr(
					'article-entry-content-blog-layout',
					array(
						'class' => '',
					)
				);
				?>
		>

			<?php SMVMT_entry_content_before(); ?>

			<?php smvmt_the_excerpt(); ?>

			<?php SMVMT_entry_content_after(); ?>

			<?php
				wp_link_pages(
					array(
						'before'      => '<div class="page-links">' . esc_html( smvmt_default_strings( 'string-blog-page-links-before', false ) ),
						'after'       => '</div>',
						'link_before' => '<span class="page-link">',
						'link_after'  => '</span>',
					)
				);
				?>
		</div><!-- .entry-content .clear -->
	</div><!-- .post-content -->

</div> <!-- .blog-layout-1 -->
