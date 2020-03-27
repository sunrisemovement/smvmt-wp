<?php
/**
 * The header for smvmt Theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package smvmt
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?><!DOCTYPE html>
<?php smvmt_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php smvmt_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
<?php smvmt_head_bottom(); ?>
</head>

<body <?php smvmt_schema_body(); ?> <?php body_class(); ?>>

<?php smvmt_body_top(); ?>
<?php wp_body_open(); ?>
<div
	<?php
	echo smvmt_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( smvmt_default_strings( 'string-header-skip-link', false ) ); ?></a>

	<?php smvmt_header_before(); ?>

	<?php smvmt_header(); ?>

	<?php smvmt_header_after(); ?>

	<?php smvmt_content_before(); ?>

	<div id="content" class="site-content">

		<div class="smvmt-container">

		<?php smvmt_content_top(); ?>
