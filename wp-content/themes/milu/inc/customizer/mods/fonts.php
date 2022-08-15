<?php
/**
 * Milu customizer font mods
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Set color schemes
 */
function milu_set_font_mods( $mods ) {

	/**
	 * Get Google Fonts from Font loader
	 */
	$_fonts = apply_filters( 'milu_mods_fonts', milu_get_google_fonts_options() );

	$font_choices = array( 'default' => esc_html__( 'Default', 'milu' ) );

	foreach ( $_fonts as $key => $value ) {
		$font_choices[ $key ] = $key;
	}

	$mods['fonts'] = array(
		'id' => 'fonts',
		'title' => esc_html__( 'Fonts', 'milu' ),
		'icon' => 'editor-textcolor',
		'options' => array(),
	);

	$mods['fonts']['options']['body_font_name'] = array(
		'label' => esc_html__( 'Body Font Name', 'milu' ),
		'id' => 'body_font_name',
		'type' => 'select',
		'choices' => $font_choices,
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['body_font_size'] = array(
		'label' => esc_html__( 'Body Font Size', 'milu' ),
		'id' => 'body_font_size',
		'type' => 'text',
		'transport' => 'postMessage',
		'description' => esc_html__( 'Don\'t ommit px. Leave empty to use the default font size.', 'milu' ),
	);

	/*************************Menu****************************/

	$mods['fonts']['options']['menu_font_name'] = array(
		'id' => 'menu_font_name',
		'label' => esc_html__( 'Menu Font', 'milu' ),
		'type' => 'select',
		'choices' => $font_choices,
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['menu_font_weight'] = array(
		'label' => esc_html__( 'Menu Font Weight', 'milu' ),
		'id' => 'menu_font_weight',
		'type' => 'text',
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['menu_font_transform'] = array(
		'id' => 'menu_font_transform',
		'label' => esc_html__( 'Menu Font Transform', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'none' => esc_html__( 'None', 'milu' ),
			'uppercase' => esc_html__( 'Uppercase', 'milu' ),
			'lowercase' => esc_html__( 'Lowercase', 'milu' ),
		),
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['menu_font_letter_spacing'] = array(
		'label' => esc_html__( 'Menu Letter Spacing (omit px)', 'milu' ),
		'id' => 'menu_font_letter_spacing',
		'type' => 'int',
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['menu_font_style'] = array(
		'id' => 'menu_font_style',
		'label' => esc_html__( 'Menu Font Style', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'normal' => esc_html__( 'Normal', 'milu' ),
			'italic' => esc_html__( 'Italic', 'milu' ),
			'oblique' => esc_html__( 'Oblique', 'milu' ),
		),
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['submenu_font_name'] = array(
		'id' => 'submenu_font_name',
		'label' => esc_html__( 'Submenu Font', 'milu' ),
		'type' => 'select',
		'choices' => $font_choices,
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['submenu_font_weight'] = array(
		'label' => esc_html__( 'Submenu Font Weight', 'milu' ),
		'id' => 'submenu_font_weight',
		'type' => 'text',
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['submenu_font_transform'] = array(
		'id' => 'submenu_font_transform',
		'label' => esc_html__( 'Submenu Font Transform', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'none' => esc_html__( 'None', 'milu' ),
			'uppercase' => esc_html__( 'Uppercase', 'milu' ),
			'lowercase' => esc_html__( 'Lowercase', 'milu' ),
		),
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['submenu_font_style'] = array(
		'id' => 'submenu_font_style',
		'label' => esc_html__( 'Submenu Font Style', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'normal' => esc_html__( 'Normal', 'milu' ),
			'italic' => esc_html__( 'Italic', 'milu' ),
			'oblique' => esc_html__( 'Oblique', 'milu' ),
		),
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['submenu_font_letter_spacing'] = array(
		'label' => esc_html__( 'Submenu Letter Spacing (omit px)', 'milu' ),
		'id' => 'submenu_font_letter_spacing',
		'type' => 'int',
		'transport' => 'postMessage',
	);

	/*************************Heading****************************/

	$mods['fonts']['options']['heading_font_name'] = array(
		'id' => 'heading_font_name',
		'label' => esc_html__( 'Heading Font', 'milu' ),
		'type' => 'select',
		'choices' => $font_choices,
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['heading_font_weight'] = array(
		'label' => esc_html__( 'Heading Font weight', 'milu' ),
		'id' => 'heading_font_weight',
		'type' => 'text',
		'description' => esc_html__( 'For example: "400" is normal, "700" is bold.The available font weights depend on the font.', 'milu' ),
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['heading_font_transform'] = array(
		'id' => 'heading_font_transform',
		'label' => esc_html__( 'Heading Font Transform', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'none' => esc_html__( 'None', 'milu' ),
			'uppercase' => esc_html__( 'Uppercase', 'milu' ),
			'lowercase' => esc_html__( 'Lowercase', 'milu' ),
		),
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['heading_font_style'] = array(
		'id' => 'heading_font_style',
		'label' => esc_html__( 'Heading Font Style', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'normal' => esc_html__( 'Normal', 'milu' ),
			'italic' => esc_html__( 'Italic', 'milu' ),
			'oblique' => esc_html__( 'Oblique', 'milu' ),
		),
		'transport' => 'postMessage',
	);

	$mods['fonts']['options']['heading_font_letter_spacing'] = array(
		'label' => esc_html__( 'Heading Letter Spacing (omit px)', 'milu' ),
		'id' => 'heading_font_letter_spacing',
		'type' => 'int',
		'transport' => 'postMessage',
	);

	return $mods;

}
add_filter( 'milu_customizer_mods', 'milu_set_font_mods', 10 );