<?php
/**
 * Template for Primary Header
 *
 * The header layout 2 for smvmt Theme. ( No of sections - 1 [ Section 1 limit - 3 )
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

?>

<div class="main-header-bar-wrap">
	<div <?php echo SMVMT_attr( 'main-header-bar' ); ?>>
		<?php SMVMT_main_header_bar_top(); ?>
		<div class="smvmt-container">

			<div class="smvmt-flex main-header-container">
				<?php SMVMT_masthead_content(); ?>
			</div><!-- Main Header Container -->
		</div><!-- smvmt-row -->
		<?php SMVMT_main_header_bar_bottom(); ?>
	</div> <!-- Main Header Bar -->
</div> <!-- Main Header Bar Wrap -->
