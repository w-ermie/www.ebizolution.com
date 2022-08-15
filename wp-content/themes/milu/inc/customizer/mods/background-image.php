<?php
/**
 * Milu background_image
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_background_image_mods( $mods ) {
	$mods['background_image'] = array(
		'icon' => 'format-image',
		'id' => 'background_image',
		'title' => esc_html__( 'Background Image', 'milu' ),
		'options' => array(),
	);

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_background_image_mods' );