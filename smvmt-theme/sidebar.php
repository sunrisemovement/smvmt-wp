<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package smvmt
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$sidebar = apply_filters( 'smvmt_get_sidebar', 'sidebar-1' );

echo '<div ';
	echo smvmt_attr(
		'sidebar',
		array(
			'id'    => 'secondary',
			'class' => join( ' ', smvmt_get_secondary_class() ),
			'role'  => 'complementary',
		)
	);
	echo '>';
	?>

	<div class="sidebar-main" <?php echo apply_filters( 'smvmt_sidebar_data_attrs', '', $sidebar ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

		<?php smvmt_sidebars_before(); ?>

		<?php if ( is_active_sidebar( $sidebar ) ) : ?>

			<?php dynamic_sidebar( $sidebar ); ?>

		<?php endif; ?>

		<?php smvmt_sidebars_after(); ?>

	</div><!-- .sidebar-main -->
</div><!-- #secondary -->
