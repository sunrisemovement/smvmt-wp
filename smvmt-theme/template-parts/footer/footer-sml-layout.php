<?php
/**
 * Template for Small Footer Layout 1
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

$section_1 = smvmt_get_small_footer( 'footer-sml-section-1' );
$section_2 = smvmt_get_small_footer( 'footer-sml-section-2' );

?>

<div class="smvmt-small-footer footer-sml-layout-1">
	<div class="smvmt-footer-overlay">
		<div class="smvmt-container">
			<div class="smvmt-small-footer-wrap" >
				<?php if ( $section_1 ) : ?>
					<div class="smvmt-small-footer-section smvmt-small-footer-section-1" >
						<?php
							echo $section_1; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				<?php endif; ?>

				<?php if ( $section_2 ) : ?>
					<div class="smvmt-small-footer-section smvmt-small-footer-section-2" >
						<?php
							echo $section_2; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
					</div>
				<?php endif; ?>

			</div><!-- .smvmt-row .smvmt-small-footer-wrap -->
		</div><!-- .smvmt-container -->
	</div><!-- .smvmt-footer-overlay -->
</div><!-- .smvmt-small-footer-->
