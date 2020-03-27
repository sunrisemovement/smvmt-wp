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
<?php SMVMT_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php SMVMT_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
<?php SMVMT_head_bottom(); ?>
</head>

<body <?php SMVMT_schema_body(); ?> <?php body_class(); ?>>

<?php SMVMT_body_top(); ?>
<?php wp_body_open(); ?>
<div
	<?php
	echo SMVMT_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>
>
	<a class="skip-link screen-reader-text" href="#content"><?php echo esc_html( SMVMT_default_strings( 'string-header-skip-link', false ) ); ?></a>

	<?php SMVMT_header_before(); ?>

	<?php SMVMT_header(); ?>

	<?php SMVMT_header_after(); ?>

	<?php SMVMT_content_before(); ?>

	<div id="content" class="site-content">

		<div class="smvmt-container">

		<?php SMVMT_content_top(); ?>
