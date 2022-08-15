<?php
/**
 * Milu customizer logo mods
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Set color schemes
 */
function milu_set_logo_mods( $mods ) {

	$mods['logo'] = array(
		'id' => 'logo',
		'title' => esc_html__( 'Logo', 'milu' ),
		'icon' => 'visibility',
		'description' => sprintf(
			wp_kses(
				__( 'Your theme recommends a logo size of <strong>%d &times; %d</strong> pixels and set the maximum width to <strong>%d</strong> below.', 'milu' ),
				array(
					'strong' => array(),
				)
			),
			360, 160, 180
		),
		'options' => array(

			'logo_dark' => array(
				'id' => 'logo_dark',
				'label' => esc_html__( 'Logo - Dark Version', 'milu' ),
				'type' => 'image',
			),

			'logo_light' => array(
				'id' => 'logo_light',
				'label' => esc_html__( 'Logo - Light Version', 'milu' ),
				'type' => 'image',
			),

			'logo_max_width' => array(
				'id' => 'logo_max_width',
				'label' => esc_html__( 'Logo Max Width (don\'t ommit px )', 'milu' ),
				'type' => 'text',
			),

			'logo_visibility' => array(
				'id' => 'logo_visibility',
				'label' => esc_html__( 'Visibility', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'always' => esc_html__( 'Always', 'milu' ),
					'sticky_menu' => esc_html__( 'When menu is sticky only', 'milu' ),
				),
				'transport' => 'postMessage',
			),
		),
	);

	return $mods;

}
add_filter( 'milu_customizer_mods', 'milu_set_logo_mods' );