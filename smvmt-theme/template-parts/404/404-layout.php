<?php
/**
 * Template for 404
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

?>
<div class="smvmt-404-layout-1">

	<?php smvmt_the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header><!-- .page-header -->' ); ?>

	<div class="page-content">

		<div class="page-sub-title">
			<?php echo esc_html( SMVMT_default_strings( 'string-404-sub-title', false ) ); ?>
		</div>

		<div class="smvmt-404-search">
			<?php the_widget( 'WP_Widget_Search' ); ?>
		</div>

	</div><!-- .page-content -->
</div>
