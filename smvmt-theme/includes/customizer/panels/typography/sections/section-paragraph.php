<?php

Kirki::add_section( 'typography_paragraph', array(
    'title'          => esc_html__( 'Paragraph', 'smvmt-theme' ),
    'description'    => esc_html__( 'My section description.', 'smvmt-theme' ),
    'panel'          => 'smvmt_typography',
    'priority'       => 40,
) );

Kirki::add_field( 'smvmt_theme', [
	'type'        => 'typography',
	'settings'    => 'paragraph_typography',
	'label'       => esc_html__( 'Paragraph style', 'smvmt-theme' ),
	'section'     => 'typography_paragraph',
	'default'     => [
		'font-family'    => 'Roboto',
		'color'          => '#333333',
	],
	'priority'    => 10,
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => ['p', 'a', '.footer'],
		],
	],
] );