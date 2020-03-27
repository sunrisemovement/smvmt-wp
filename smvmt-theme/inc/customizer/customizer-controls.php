<?php
/**
 * smvmt Theme Customizer Controls.
 *
 * @package     smvmt
 * @author      smvmt
 * @copyright   Copyright (c) 2020, smvmt
 * @link        https://wpsmvmt.com/
 * @since       smvmt 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$control_dir = SMVMT_THEME_DIR . 'inc/customizer/custom-controls';

require $control_dir . '/class-smvmt-customizer-control-base.php';
require $control_dir . '/sortable/class-smvmt-control-sortable.php';
require $control_dir . '/radio-image/class-smvmt-control-radio-image.php';
require $control_dir . '/slider/class-smvmt-control-slider.php';
require $control_dir . '/responsive-slider/class-smvmt-control-responsive-slider.php';
require $control_dir . '/responsive/class-smvmt-control-responsive.php';
require $control_dir . '/typography/class-smvmt-control-typography.php';
require $control_dir . '/responsive-spacing/class-smvmt-control-responsive-spacing.php';
require $control_dir . '/divider/class-smvmt-control-divider.php';
require $control_dir . '/heading/class-smvmt-control-heading.php';
require $control_dir . '/hidden/class-smvmt-control-hidden.php';
require $control_dir . '/link/class-smvmt-control-link.php';
require $control_dir . '/color/class-smvmt-control-color.php';
require $control_dir . '/description/class-smvmt-control-description.php';
require $control_dir . '/background/class-smvmt-control-background.php';
require $control_dir . '/responsive-color/class-smvmt-control-responsive-color.php';
require $control_dir . '/border/class-smvmt-control-border.php';
require $control_dir . '/customizer-link/class-smvmt-control-customizer-link.php';
require $control_dir . '/settings-group/class-smvmt-control-settings-group.php';
require $control_dir . '/select/class-smvmt-control-select.php';
