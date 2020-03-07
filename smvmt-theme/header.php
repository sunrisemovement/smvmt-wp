<?php
/**
 * Header file for smvmt theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package smvmt
 * @subpackage smvmt theme
 * @since 1.0.0
 */

// Get ACF Settings for page
$header = get_field('header_type');

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

        <title><?php the_title(); ?></title>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<?php
		wp_body_open();
		
		if ($header !== 'none') { ?>

        <header class="smvmt-header <?php echo 'smvmt-header--' . $header; ?>">

			<div class="smvmt-container smvmt-container--nav">

				<a class="smvmt-branding" href="<?php echo site_url(); ?>">
					<span class="smvmt-branding__site-name">Sunrise Movement</span>
				</a>

				<?php wp_nav_menu([
					'menu' => 'primary',
					'container' => 'nav',
					'menu_class' => 'smvmt-nav'
				]); ?>

			</div>

		</header>
		
		<?php } ?>
