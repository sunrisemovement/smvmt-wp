<?php

Kirki::add_section( 'typography_headers', array(
    'title'          => esc_html__( 'Headers', 'smvmt-theme' ),
    'description'    => esc_html__( 'My section description.', 'smvmt-theme' ),
    'panel'          => 'smvmt_typography',
    'priority'       => 40,
) );

Kirki::add_field( 'smvmt_theme', [
	'type'        => 'typography',
	'settings'    => 'headers_typography',
	'label'       => esc_html__( 'Headers style', 'smvmt-theme' ),
	'section'     => 'typography_headers',
	'default'     => [
		'font-family'    => 'Roboto',
		'color'          => '#333333',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => ['h1', 'h2', 'h3', 'h4', 'h5', 'p.has-large-font-size'],
		],
	],
] );