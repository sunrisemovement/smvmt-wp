<?php
/**
 * Template for Small Footer Layout 2
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

$section_1 = smvmt_get_small_footer( 'footer-sml-section-1' );
$section_2 = smvmt_get_small_footer( 'footer-sml-section-2' );
$sections  = 0;

if ( '' != $section_1 ) {
	$sections++;
}

if ( '' != $section_2 ) {
	$sections++;
}

switch ( $sections ) {

	case '2':
			$section_class = 'smvmt-small-footer-section-equally smvmt-col-md-6 smvmt-col-xs-12';
		break;

	case '1':
	default:
			$section_class = 'smvmt-small-footer-section-equally smvmt-col-xs-12';
		break;
}

?>

<div class="smvmt-small-footer footer-sml-layout-2">
	<div class="smvmt-footer-overlay">
		<div class="smvmt-container">
			<div class="smvmt-small-footer-wrap" >
					<div class="smvmt-row smvmt-flex">

					<?php if ( $section_1 ) : ?>
						<div class="smvmt-small-footer-section smvmt-small-footer-section-1 <?php echo esc_attr( $section_class ); ?>" >
							<?php
								echo $section_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</div>
				<?php endif; ?>

					<?php if ( $section_2 ) : ?>
						<div class="smvmt-small-footer-section smvmt-small-footer-section-2 <?php echo esc_attr( $section_class ); ?>" >
							<?php
								echo $section_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
						</div>
				<?php endif; ?>

					</div> <!-- .smvmt-row.smvmt-flex -->
			</div><!-- .smvmt-small-footer-wrap -->
		</div><!-- .smvmt-container -->
	</div><!-- .smvmt-footer-overlay -->
</div><!-- .smvmt-small-footer-->
