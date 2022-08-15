<?php
/**
 * Milu Socials
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_socials_mods( $mods ) {

	if ( function_exists( 'wvc_get_socials' ) ) {

		$socials = wvc_get_socials();

		$mods['socials'] = array(
			'id' => 'socials',
			'title' => esc_html__( 'Social Networks', 'milu' ),
			'icon' => 'share',
			'options' => array(),
		);

		foreach ( $socials as $social ) {
			$mods['socials']['options'][ $social ] = array(
				'id' => $social,
				'label' => ucfirst( $social ),
				'type' => 'text',
			);
		}
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_socials_mods' );