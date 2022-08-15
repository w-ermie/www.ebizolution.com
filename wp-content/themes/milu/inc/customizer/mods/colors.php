<?php
/**
 * Milu customizer color mods
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Set color schemes
 */
function milu_set_colors_mods( $mods ) {

	$color_scheme = milu_get_color_scheme();

	$mods['colors'] = array(
		'id' => 'colors',
		'icon' => 'admin-customizer',
		'title' => esc_html__( 'Colors', 'milu' ),
		'options' => array(
			array(
				'label' => esc_html__( 'Color scheme', 'milu' ),
				'id' => 'color_scheme',
				'type' => 'select',
				'choices'  => milu_get_color_scheme_choices(),
				'transport' => 'postMessage',
			),

			'body_background_color' => array(
				'id' => 'body_background_color',
				'label' => esc_html__( 'Body Background Color', 'milu' ),
				'type' => 'color',
				'transport' => 'postMessage',
				'default' => $color_scheme[0],
			),

			'page_background_color' => array(
				'id' => 'page_background_color',
				'label' => esc_html__( 'Page Background Color', 'milu' ),
				'type' => 'color',
				'transport' => 'postMessage',
				'default' => $color_scheme[1],
			),

			'submenu_background_color' => array(
				'id' => 'submenu_background_color',
				'label' => esc_html__( 'Submenu Background Color', 'milu' ),
				'type' => 'color',
				'transport' => 'postMessage',
				'default' => $color_scheme[2],
			),

			array(
				'id' => 'submenu_font_color',
				'label' => esc_html__( 'Submenu Font Color', 'milu' ),
				'type' => 'color',
				'transport' => 'postMessage',
				'default' => $color_scheme[3],
			),

			'accent_color' => array(
				'id' => 'accent_color',
				'label' => esc_html__( 'Accent Color', 'milu' ),
				'type' => 'color',
				'transport' => 'postMessage',
				'default' => $color_scheme[4],
			),
			array(
				'id' => 'main_text_color',
				'label' => esc_html__( 'Main Text Color', 'milu' ),
				'type' => 'color',
				'transport' => 'postMessage',
				'default' => $color_scheme[5],
			),
			array(
				'id' => 'strong_text_color',
				'label' => esc_html__( 'Strong Text Color', 'milu' ),
				'type' => 'color',
				'transport' => 'postMessage',
				'default' => $color_scheme[7],
				'description' => esc_html__( 'Heading, "strong" tags etc...', 'milu' ),
			),
		),
	);

	return $mods;

}
add_filter( 'milu_customizer_mods', 'milu_set_colors_mods' );