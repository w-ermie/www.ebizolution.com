<?php
/**
 * Milu header_settings
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_header_settings_mods( $mods ) {

	$mods['header_settings'] = array(

		'id' => 'header_settings',
		'title' => esc_html__( 'Header Layout', 'milu' ),
		'icon' => 'editor-table',
		'options' => array(

			'hero_layout' => array(
				'label'	=> esc_html__( 'Page Header Layout', 'milu' ),
				'id'	=> 'hero_layout',
				'type'	=> 'select',
				'choices' => array(
					'standard' => esc_html__( 'Standard', 'milu' ),
					'big' => esc_html__( 'Big', 'milu' ),
					'small' => esc_html__( 'Small', 'milu' ),
					'fullheight' => esc_html__( 'Full Height', 'milu' ),
					'none' => esc_html__( 'No header', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			'hero_background_effect' => array(
				'id' =>'hero_background_effect',
				'label' => esc_html__( 'Header Image Effect', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'parallax' => esc_html__( 'Parallax', 'milu' ),
					'zoomin' => esc_html__( 'Zoom', 'milu' ),
					'none' => esc_html__( 'None', 'milu' ),
				),
			),

			'hero_scrolldown_arrow' => array(
				'id' =>'hero_scrolldown_arrow',
				'label' => esc_html__( 'Scroll Down arrow', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'yes' => esc_html__( 'Yes', 'milu' ),
					'' => esc_html__( 'No', 'milu' ),
				),
			),

			array(
				'label'	=> esc_html__( 'Header Overlay', 'milu' ),
				'id'	=> 'hero_overlay',
				'type'	=> 'select',
				'choices' => array(
					'' => esc_html__( 'Default', 'milu' ),
					'custom' => esc_html__( 'Custom', 'milu' ),
					'none' => esc_html__( 'None', 'milu' ),
				),
			),

			array(
				'label'	=> esc_html__( 'Overlay Color', 'milu' ),
				'id'	=> 'hero_overlay_color',
				'type'	=> 'color',
				'value' 	=> '#000000',
			),

			array(
				'label'	=> esc_html__( 'Overlay Opacity (in percent)', 'milu' ),
				'id'	=> 'hero_overlay_opacity',
				'desc'	=> esc_html__( 'Adapt the header overlay opacity if needed', 'milu' ),
				'type'	=> 'text',
				'value'	=> 40,
			),
		),
	);

	if ( class_exists( 'Wolf_Vc_Content_Block' ) ) {
		$mods['header_settings']['options']['hero_layout']['description'] = sprintf(
			milu_kses(
				__( 'The header can be overwritten by a <a href="%s" target="_blank">content block</a> on all pages or on specific pages. See the customizer "Layout" tab or the page options below your text editor.', 'milu' )
			),
			'http://wlfthm.es/content-blocks'
		); 
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_header_settings_mods' );