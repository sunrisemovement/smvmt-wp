<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package smvmt
 * @subpackage smvmt theme
 * @since 1.0.0
 */

get_header(); ?>

<main class="smvmt-main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div class="smvmt-container">
        <h2><?php the_title(); ?>
    </div>

    <?php the_content(); ?>

    <?php endwhile; endif; ?>
    
</main>

<?php get_footer();
