<?php
/**
 * Above Header Layout 2
 *
 * This template generates markup required for the Above Header style 2
 *
 * @todo Update this template for Default Above Header Style
 *
 * @package smvmt
 */

$section = SMVMT_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-1' );
$value1  = smvmt_get_option( 'above-header-section-1' );
/**
 * Hide above header markup if:
 *
 * - User is not logged in. [AND]
 * - Sections 1 is set to none
 */
if ( empty( $section ) ) {
	return;
}
?>

<div class="smvmt-above-header-wrap above-header-2" >
	<div class="smvmt-above-header">
		<?php do_action( 'smvmt_above_header_top' ); ?>
		<div class="smvmt-container">
			<div class="smvmt-flex smvmt-above-header-section-wrap">
		<?php if ( $section ) { ?>
					<div class="smvmt-above-header-section smvmt-above-header-section-1 smvmt-flex smvmt-justify-content-center <?php echo esc_attr( $value1 ); ?>-above-header" >
						<?php echo $section; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>
			</div>
		</div><!-- .smvmt-container -->
		<?php do_action( 'smvmt_above_header_bottom' ); ?>
	</div><!-- .smvmt-above-header -->
</div><!-- .smvmt-above-header-wrap -->
