<?php
/**
 * Footer Layout 4
 *
 * @package smvmt Addon
 * @since   smvmt 1.0.12
 */

/**
 * Hide advanced footer markup if:
 *
 * - User is not logged in. [AND]
 * - All widgets are not active.
 */
if ( ! is_user_logged_in() ) {
	if (
		! is_active_sidebar( 'advanced-footer-widget-1' ) &&
		! is_active_sidebar( 'advanced-footer-widget-2' ) &&
		! is_active_sidebar( 'advanced-footer-widget-3' ) &&
		! is_active_sidebar( 'advanced-footer-widget-4' )
	) {
		return;
	}
}

$classes[] = 'footer-adv';
$classes[] = 'footer-adv-layout-4';
$classes   = implode( ' ', $classes );
?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<div class="footer-adv-overlay">
		<div class="smvmt-container">
			<div class="smvmt-row">
				<div class="smvmt-col-lg-3 smvmt-col-md-3 smvmt-col-sm-12 smvmt-col-xs-12 footer-adv-widget footer-adv-widget-1" <?php echo wp_kses_post( apply_filters( 'SMVMT_sidebar_data_attrs', '', 'advanced-footer-widget-1' ) ); ?>>
					<?php smvmt_get_footer_widget( 'advanced-footer-widget-1' ); ?>
				</div>
				<div class="smvmt-col-lg-3 smvmt-col-md-3 smvmt-col-sm-12 smvmt-col-xs-12 footer-adv-widget footer-adv-widget-2" <?php echo wp_kses_post( apply_filters( 'SMVMT_sidebar_data_attrs', '', 'advanced-footer-widget-2' ) ); ?>>
					<?php smvmt_get_footer_widget( 'advanced-footer-widget-2' ); ?>
				</div>
				<div class="smvmt-col-lg-3 smvmt-col-md-3 smvmt-col-sm-12 smvmt-col-xs-12 footer-adv-widget footer-adv-widget-3" <?php echo wp_kses_post( apply_filters( 'SMVMT_sidebar_data_attrs', '', 'advanced-footer-widget-3' ) ); ?>>
					<?php smvmt_get_footer_widget( 'advanced-footer-widget-3' ); ?>
				</div>
				<div class="smvmt-col-lg-3 smvmt-col-md-3 smvmt-col-sm-12 smvmt-col-xs-12 footer-adv-widget footer-adv-widget-4" <?php echo wp_kses_post( apply_filters( 'SMVMT_sidebar_data_attrs', '', 'advanced-footer-widget-4' ) ); ?>>
					<?php smvmt_get_footer_widget( 'advanced-footer-widget-4' ); ?>
				</div>
			</div><!-- .smvmt-row -->
		</div><!-- .smvmt-container -->
	</div><!-- .footer-adv-overlay-->
</div><!-- .smvmt-theme-footer .footer-adv-layout-4 -->
