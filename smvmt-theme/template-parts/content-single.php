<?php
/**
 * Template part for displaying single posts.
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
		echo SMVMT_attr(
			'article-single',
			array(
				'id'    => 'post-' . get_the_id(),
				'class' => join( ' ', get_post_class() ),
			)
		);
		?>
>

	<?php SMVMT_entry_top(); ?>

	<?php SMVMT_entry_content_single(); ?>

	<?php SMVMT_entry_bottom(); ?>

</article><!-- #post-## -->

<?php SMVMT_entry_after(); ?>
