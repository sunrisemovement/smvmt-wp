<?php

Kirki::add_section( 'typography_branding', array(
    'title'          => esc_html__( 'Branding', 'smvmt-theme' ),
    'description'    => esc_html__( 'My section description.', 'smvmt-theme' ),
    'panel'          => 'smvmt_typography',
    'priority'       => 40,
) );

Kirki::add_field( 'smvmt_theme', [
	'type'        => 'typography',
	'settings'    => 'branding_typography',
	'label'       => esc_html__( 'Branding style', 'smvmt-theme' ),
	'section'     => 'typography_branding',
	'default'     => [
		'font-family'    => 'Roboto',
		'text-transform' => 'uppercase',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => ['.smvmt-branding__site-name'],
		],
	],
] );

Kirki::add_field( 'smvmt_theme', [
	'type'        => 'typography',
	'settings'    => 'tagline_typography',
	'label'       => esc_html__( 'Tagline style', 'smvmt-theme' ),
	'section'     => 'typography_branding',
	'default'     => [
		'font-family'    => 'Roboto',
		'text-transform' => 'uppercase',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => ['smvmt-branding__tagline'],
		],
	],
] );