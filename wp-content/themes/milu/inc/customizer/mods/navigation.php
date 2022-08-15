<?php
/**
 * Milu navigation
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_navigation_mods( $mods ) {

	$mods['navigation'] = array(
		'id' => 'navigation',
		'icon' => 'menu',
		'title' => esc_html__( 'Navigation', 'milu' ),
		'options' => array(

			'menu_layout' => array(
				'id' => 'menu_layout',
				'label' => esc_html__( 'Main Menu Layout', 'milu' ),
				'type' => 'select',
				'default' => 'top-justify',
				'choices' => array(
					'top-right' => esc_html__( 'Top Right', 'milu' ),
					'top-justify' => esc_html__( 'Top Justify', 'milu' ),
					'top-justify-left' => esc_html__( 'Top Justify Left', 'milu' ),
					'centered-logo' => esc_html__( 'Centered', 'milu' ),
					'top-left' => esc_html__( 'Top Left', 'milu' ),
					'offcanvas' => esc_html__( 'Off Canvas', 'milu' ),
					'overlay' => esc_html__( 'Overlay', 'milu' ),
					'lateral' => esc_html__( 'Lateral', 'milu' ),
				),
			),

			'menu_width' => array(
				'id' => 'menu_width',
				'label' => esc_html__( 'Main Menu Width', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'wide' => esc_html__( 'Wide', 'milu' ),
					'boxed' => esc_html__( 'Boxed', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			'menu_style' => array(
				'id' =>'menu_style',
				'label' => esc_html__( 'Main Menu Style', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'semi-transparent-white' => esc_html__( 'Semi-transparent White', 'milu' ),
					'semi-transparent-black' => esc_html__( 'Semi-transparent Black', 'milu' ),
					'solid' => esc_html__( 'Solid', 'milu' ),
					'transparent' => esc_html__( 'Transparent', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			'menu_hover_style' => array(
				'id' => 'menu_hover_style',
				'label' => esc_html__( 'Main Menu Hover Style', 'milu' ),
				'type' => 'select',
				'choices' => apply_filters( 'milu_main_menu_hover_style_options', array(
					'none' => esc_html__( 'None', 'milu' ),
					'opacity' => esc_html__( 'Opacity', 'milu' ),
					'underline' => esc_html__( 'Underline', 'milu' ),
					'underline-centered' => esc_html__( 'Underline Centered', 'milu' ),
					'border-top' => esc_html__( 'Border Top', 'milu' ),
					'plain' => esc_html__( 'Plain', 'milu' ),
				) ),
				'transport' => 'postMessage',
			),

			'mega_menu_width' => array(
				'id' => 'mega_menu_width',
				'label' => esc_html__( 'Mega Menu Width', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'boxed' => esc_html__( 'Boxed', 'milu' ),
					'wide' => esc_html__( 'Wide', 'milu' ),
					'fullwidth' => esc_html__( 'Full Width', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			'menu_breakpoint' => array(
				'id' =>'menu_breakpoint',
				'label' => esc_html__( 'Main Menu Breakpoint', 'milu' ),
				'type' => 'text',
				'description' => esc_html__( 'Below each width would you like to display the mobile menu? 0 will always show the desktop menu and 99999 will always show the mobile menu.', 'milu' ),
			),

			'menu_sticky_type' => array(
				'id' =>'menu_sticky_type',
				'label' => esc_html__( 'Sticky Menu', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'none' => esc_html__( 'Disabled', 'milu' ),
					'soft' => esc_html__( 'Sticky on scroll up', 'milu' ),
					'hard' => esc_html__( 'Always sticky', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			/*'search_menu_item' => array(
				'label' => esc_html__( 'Search Menu Item', 'milu' ),
				'id' => 'search_menu_item',
				'type' => 'checkbox',
			),*/

			'menu_skin' => array(
				'id' => 'menu_skin',
				'label' => esc_html__( 'Sticky Menu Skin', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'light' => esc_html__( 'Light', 'milu' ),
					'dark' => esc_html__( 'Dark', 'milu' ),
				),
				'transport' => 'postMessage',
				'description' => esc_html__( 'Can be overwite on single page.', 'milu' ),
			),

			'menu_cta_content_type' => array(
				'id' => 'menu_cta_content_type',
				'label' => esc_html__( 'Additional Content', 'milu' ),
				'type' => 'select',
				'default' => 'icons',
				'choices' => apply_filters( 'milu_menu_cta_content_type_options', array(
					'search_icon' => esc_html__( 'Search Icon', 'milu' ),
					'secondary-menu' => esc_html__( 'Secondary Menu', 'milu' ),
					'none' => esc_html__( 'None', 'milu' ),
				) ),
			),
		)
	);

	$mods['navigation']['options']['menu_socials'] = array(
		'id' => 'menu_socials',
		'label' => esc_html__( 'Menu Socials', 'milu' ),
		'type' => 'text',
		'description' => esc_html__( 'The list of social services to display in the menu. (eg: facebook,twitter,instagram)', 'milu' ),
	);

	$mods['navigation']['options']['side_panel_position'] = array(
		'id' => 'side_panel_position',
		'label' => esc_html__( 'Side Panel', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'none' => esc_html__( 'None', 'milu' ),
			'right' => esc_html__( 'At Right', 'milu' ),
			'left' => esc_html__( 'At Left', 'milu' ),
		),
		'description' => esc_html__( 'Note that it will be disable with a vertical menu layout (offcanvas and lateral layout).', 'milu' ),
	);

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_navigation_mods' );