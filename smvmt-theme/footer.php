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
			<?php SMVMT_content_bottom(); ?>

			</div> <!-- smvmt-container -->

		</div><!-- #content -->

		<?php SMVMT_content_after(); ?>

		<?php SMVMT_footer_before(); ?>

		<?php SMVMT_footer(); ?>

		<?php SMVMT_footer_after(); ?>

	</div><!-- #page -->

	<?php SMVMT_body_bottom(); ?>

	<?php wp_footer(); ?>

	</body>
</html>
