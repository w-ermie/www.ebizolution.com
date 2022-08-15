<?php
/**
 * Milu loading
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_loading_mods( $mods ) {

	$mods['loading'] = array(

		'id' => 'loading',
		'title' => esc_html__( 'Loading', 'milu' ),
		'icon' => 'update',
		'options' => array(

			array(
				'label' => esc_html__( 'Loading Animation Type', 'milu' ),
				'id' => 'loading_animation_type',
				'type' => 'select',
				'choices' => array(
					'spinner' => esc_html__( 'Spinner', 'milu' ),
		 			'none' => esc_html__( 'None', 'milu' ),
				),
			),
		),
	);
	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_loading_mods' );