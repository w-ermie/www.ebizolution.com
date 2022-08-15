<?php
/**
 * Milu footer_bg
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_footer_bg_mods( $mods ) {

	$mods['footer_bg'] = array(
		'id' =>'footer_bg',
		'label' => esc_html__( 'Footer Background', 'milu' ),
		'background' => true,
		'font_color' => true,
		'icon' => 'format-image',
	);

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_footer_bg_mods' );