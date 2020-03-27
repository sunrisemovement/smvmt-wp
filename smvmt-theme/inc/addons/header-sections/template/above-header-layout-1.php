<?php
/**
 * Above Header Layout 1
 *
 * This template generates markup required for the Above Header style 1
 *
 * @todo Update this template for Default Above Header Style
 *
 * @package smvmt
 */

$section_1 = SMVMT_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-1' );
$section_2 = SMVMT_Ext_Header_Sections_Markup::get_above_header_section( 'above-header-section-2' );


$value1 = smvmt_get_option( 'above-header-section-1' );
$value2 = smvmt_get_option( 'above-header-section-2' );
/**
 * Hide above header markup if:
 *
 * - User is not logged in. [AND]
 * - Sections 1 / 2 is set to none
 */
if ( empty( $section_1 ) && empty( $section_2 ) ) {
	return;
}
?>

<div class="smvmt-above-header-wrap smvmt-above-header-1" >
	<div class="smvmt-above-header">
		<?php do_action( 'smvmt_above_header_top' ); ?>
		<div class="smvmt-container">
			<div class="smvmt-flex smvmt-above-header-section-wrap">
				<?php if ( ! empty( $section_1 ) ) { ?>
					<div class="smvmt-above-header-section smvmt-above-header-section-1 smvmt-flex smvmt-justify-content-flex-start <?php echo esc_attr( $value1 ); ?>-above-header" >
						<?php echo $section_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>

				<?php if ( ! empty( $section_2 ) ) { ?>
					<div class="smvmt-above-header-section smvmt-above-header-section-2 smvmt-flex smvmt-justify-content-flex-end <?php echo esc_attr( $value2 ); ?>-above-header" >
						<?php echo $section_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php } ?>
			</div>
		</div><!-- .smvmt-container -->
		<?php do_action( 'smvmt_above_header_bottom' ); ?>
	</div><!-- .smvmt-above-header -->
</div><!-- .smvmt-above-header-wrap -->
