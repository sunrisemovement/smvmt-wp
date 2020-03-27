<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package smvmt
 * @since 1.0.0
 */

?>

<?php SMVMT_entry_before(); ?>

<article
	<?php
		echo smvmt_attr(
			'article-content',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>
	<?php SMVMT_entry_top(); ?>

	<header class="entry-header <?php SMVMT_entry_header_class(); ?>">

		<?php
		smvmt_the_title(
			sprintf(
				'<h2 class="entry-title" ' . smvmt_attr(
					'article-title-content',
					array(
						'class' => '',
					)
				) . '><a href="%s" rel="bookmark">',
				esc_url( get_permalink() )
			),
			'</a></h2>'
		);
		?>

	</header><!-- .entry-header -->

	<div class="entry-content clear"
	<?php
				echo smvmt_attr(
					'article-entry-content',
					array(
						'class' => '',
					)
				);
				?>
	>

		<?php SMVMT_entry_content_before(); ?>

		<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. */
						__( 'Continue reading %s', 'smvmt' ) . ' <span class="meta-nav">&rarr;</span>',
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				)
			);
			?>

		<?php SMVMT_entry_content_after(); ?>

		<?php
			wp_link_pages(
				array(
					'before'      => '<div class="page-links">' . esc_html( smvmt_default_strings( 'string-single-page-links-before', false ) ),
					'after'       => '</div>',
					'link_before' => '<span class="page-link">',
					'link_after'  => '</span>',
				)
			);
			?>
	</div><!-- .entry-content .clear -->

	<footer class="entry-footer">
		<?php SMVMT_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php SMVMT_entry_bottom(); ?>

</article><!-- #post-## -->

<?php SMVMT_entry_after(); ?>
