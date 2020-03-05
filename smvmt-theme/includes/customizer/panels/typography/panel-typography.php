<?php

$directory = get_stylesheet_directory() . '/includes/customizer/panels/typography';

Kirki::add_panel( 'smvmt_typography', array(
    'priority'    => 30,
    'title'       => esc_html__( 'Typography', 'smvmt' ),
    'description' => esc_html__( 'My panel description', 'smvmt' ),
) );

require_once( $directory . '/sections/section-branding.php');
require_once( $directory . '/sections/section-headers.php');
require_once( $directory . '/sections/section-paragraph.php');
require_once( $directory . '/sections/section-nav.php');