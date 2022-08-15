<?php
/**
 * Milu header_image
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;


function milu_set_header_image_mods( $mods ) {

	/* Move header image setting here and rename the section title */
	$mods['header_image'] = array(
		'id' => 'header_image',
		'title' => esc_html__( 'Header Image', 'milu' ),
		'icon' => 'format-image',
		'options' => array(),
	);

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_header_image_mods' );