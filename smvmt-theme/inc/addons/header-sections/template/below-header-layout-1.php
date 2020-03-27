<?php
/**
 * Below Header Layout 2
 *
 * Inline Layout
 *
 * @package smvmt
 */

?>
<div class="smvmt-below-header-wrap smvmt-below-header-1">
	<div class="smvmt-below-header">
		<?php do_action( 'smvmt_below_header_top' ); ?>
		<div class="smvmt-container">
			<div class="smvmt-flex smvmt-below-header-section-wrap">

				<?php SMVMT_Ext_Header_Sections_Markup::get_below_header_section( 'below-header-section-1', 'below-header-1' ); ?>
				<?php SMVMT_Ext_Header_Sections_Markup::get_below_header_section( 'below-header-section-2', 'below-header-1' ); ?>

			</div>
		</div>
		<?php do_action( 'smvmt_below_header_bottom' ); ?>
	</div><!-- .smvmt-below-header -->
</div><!-- .smvmt-below-header-wrap -->
