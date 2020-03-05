<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing tags
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package smvmt
 * @subpackage smvmt theme
 * @since 1.0.0
 */

// Get ACF fields
$footer = get_field('footer_type');

?>

        <?php if ($footer !== 'none') { ?>
            <footer class="smvmt-footer <?php echo 'smvmt-footer--' . $footer; ?>">
            
            </footer>
        <?php } ?>

		<?php wp_footer(); ?>

	</body>
</html>
