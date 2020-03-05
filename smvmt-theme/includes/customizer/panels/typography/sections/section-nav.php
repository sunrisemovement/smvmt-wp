<?php

Kirki::add_section( 'typography_nav', array(
    'title'          => esc_html__( 'Navigation', 'smmvmt-theme' ),
    'description'    => esc_html__( 'My section description.', 'smvmt-theme' ),
    'panel'          => 'smvmt_typography',
    'priority'       => 40,
) );

Kirki::add_field( 'smvmt_theme', [
	'type'        => 'typography',
	'settings'    => 'primary_nav_typography',
	'label'       => esc_html__( 'Primary Nav Typography', 'smvmt-theme' ),
	'section'     => 'typography_nav',
	'default'     => [
		'font-family'    => 'Roboto',
		'color'          => '#333333',
		'font-size'		 => '16px',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => ['.primary a', '.mobile-toggle'],
		],
	],
] );

Kirki::add_field( 'smvmt_theme', [
	'type'        => 'typography',
	'settings'    => 'secondary_nav_typography',
	'label'       => esc_html__( 'Secondary Nav Typography', 'smvmt-theme' ),
	'section'     => 'typography_nav',
	'default'     => [
		'font-family'    => 'Roboto',
		'color'          => '#333333',
		'font-size'		 => '16px',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => ['.secondary a'],
		],
	],
] );


Kirki::add_field( 'smvmt_theme', [
	'type'        => 'typography',
	'settings'    => 'super_nav_typography',
	'label'       => esc_html__( 'Super Nav Typography', 'smvmt-theme' ),
	'section'     => 'typography_nav',
	'default'     => [
		'font-family'    => 'Roboto',
		'color'          => '#aaa',
		'font-size'		 => '16px',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => ['.super a'],
		],
	],
] );