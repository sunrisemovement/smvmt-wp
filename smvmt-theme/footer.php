<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package smvmt
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
			<?php smvmt_content_bottom(); ?>

			</div> <!-- smvmt-container -->

		</div><!-- #content -->

		<?php smvmt_content_after(); ?>

		<?php smvmt_footer_before(); ?>

		<?php smvmt_footer(); ?>

		<?php smvmt_footer_after(); ?>

	</div><!-- #page -->

	<?php smvmt_body_bottom(); ?>

	<?php wp_footer(); ?>

	</body>
</html>
