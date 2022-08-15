<?php
/**
 * Milu footer
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_footer_mods( $mods ) {

	$mods['footer'] = array(

		'id' => 'footer',
		'title' => esc_html__( 'Footer', 'milu' ),
		'icon' => 'welcome-widgets-menus',
		'options' => array(

			'footer_type' => array(
				'label' => esc_html__( 'Footer Type', 'milu' ),
				'id' => 'footer_type',
				'type' => 'select',
				'choices' => array(
		 			'standard' => esc_html__( 'Standard', 'milu' ),
					'uncover' => esc_html__( 'Uncover', 'milu' ),
					'hidden' => esc_html__( 'No Footer', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			array(
				'label' => esc_html__( 'Footer Width', 'milu' ),
				'id' => 'footer_layout',
				'type' => 'select',
				'choices' => array(
		 			'boxed' => esc_html__( 'Boxed', 'milu' ),
					'wide' => esc_html__( 'Wide', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			array(
				'label' => esc_html__( 'Foot Widgets Layout', 'milu' ),
				'id' => 'footer_widgets_layout',
				'type' => 'select',
				'choices' => array(
		 			'3-cols' => esc_html__( '3 Columns', 'milu' ),
					'4-cols' => esc_html__( '4 Columns', 'milu' ),
					'one-half-two-quarter' => esc_html__( '1 Half/2 Quarters', 'milu' ),
					'two-quarter-one-half' => esc_html__( '2 Quarters/1 Half', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			array(
				'label' => esc_html__( 'Bottom Bar Layout', 'milu' ),
				'id' => 'bottom_bar_layout',
				'type' => 'select',
				'choices' => array(
					'centered' => esc_html__( 'Centered', 'milu' ),
					'inline' => esc_html__( 'Inline', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			'footer_socials' => array(
				'id' => 'footer_socials',
				'label' => esc_html__( 'Socials', 'milu' ),
				'type' => 'text',
				'description' => esc_html__( 'The list of social services to display in the bottom bar. (eg: facebook,twitter,instagram)', 'milu' ),
			),

			'copyright' => array(
				'id' => 'copyright',
				'label' => esc_html__( 'Copyright Text', 'milu' ),
				'type' => 'text',
			),
		),
	);

	if ( class_exists( 'Wolf_Vc_Content_Block' ) ) {
		$mods['footer']['options']['footer_type']['description'] = sprintf(
			milu_kses(
				__( 'This is the default footer settings. You can leave the fields below empty and use a <a href="%s" target="_blank">content block</a> instead for more flexibility. See the customizer "Layout" tab or the page options below your text editor.', 'milu' )
			),
			'http://wlfthm.es/content-blocks'
		); 
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_footer_mods' );