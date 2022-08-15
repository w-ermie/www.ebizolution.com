<?php
/**
 * Milu extra
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_extra_mods( $mods ) {

	$mods['extra'] = array(

		'id' => 'extra',
		'title' => esc_html__( 'Extra', 'milu' ),
		'icon' => 'plus-alt',
		'options' => array(
			array(
				'label'	=> esc_html__( 'Enable Scroll Animations on Mobile (not recommended)', 'milu' ),
				'id'	=> 'enable_mobile_animations',
				'type'	=> 'checkbox',
			),
			array(
				'label'	=> esc_html__( 'Enable Parallax on Mobile (not recommended)', 'milu' ),
				'id'	=> 'enable_mobile_parallax',
				'type'	=> 'checkbox',
			),
		),
	);
	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_extra_mods' );