<?php
/**
 * Theme configuration file
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

/**
 * Default Google fonts option
 */
function milu_set_default_google_font() {
	return 'Muli:400,600,800,900|Open+Sans:400,500,600,700|Montserrat:400,600,800,900';
}
add_filter( 'milu_default_google_fonts', 'milu_set_default_google_font' );

/**
 * Set color scheme
 *
 * Add csutom color scheme
 *
 * @param array $color_scheme
 * @param array $color_scheme
 */
function milu_set_color_schemes( $color_scheme ) {

	//unset( $color_scheme['default'] );

	$color_scheme['light'] = array(
		'label'  => esc_html__( 'Light', 'milu' ),
		'colors' => array(
			'#fff', // body_bg
			'#fff', // page_bg
			'#f7f7f7', // submenu_background_color
			'#0d0d0d', // submenu_font_color
			'#ffc050', // '#c3ac6d', // accent
			'#333333', // main_text_color
			'#4c4c4c', // secondary_text_color
			'#333333', // strong_text_color
			'#6272c7', // secondary accent
		)
	);

	$color_scheme['dark'] = array(
		'label'  => esc_html__( 'Dark', 'milu' ),
		'colors' => array(
			'#000000', // body_bg
			'#000000', // page_bg
			'#000000', // submenu_background_color
			'#ffffff', // submenu_font_color
			'#ffc050', // accent
			'#f4f4f4', // main_text_color
			'#ffffff', // secondary_text_color
			'#ffffff', // strong_text_color
			'#6272c7', // secondary accent
		)
	);

	return $color_scheme;
}
add_filter( 'milu_color_schemes', 'milu_set_color_schemes' );

/**
 * Add additional theme support
 */
function milu_additional_theme_support() {

	/**
	 * Enable WooCommerce support
	 */
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'milu_additional_theme_support' );

/**
 * Set default WordPress option
 */
function milu_set_default_wp_options() {

	update_option( 'thumbnail_size_w', 260 );
	update_option( 'thumbnail_size_h', 260 );
	update_option( 'thumbnail_crop', 1 );

	update_option( 'medium_size_w', 600 );
	update_option( 'medium_size_h', 600 );

	update_option( 'large_size_w', 1200 );
	update_option( 'large_size_h', 1024 );

	update_option( 'thread_comments_depth', 2 );
}
add_action( 'milu_default_wp_options_init', 'milu_set_default_wp_options' );

/**
 * Set mod files to include
 */
function milu_customizer_set_mod_files( $mod_files ) {
	$mod_files = array(
		'loading',
		'logo',
		'layout',
		'colors',
		'navigation',
		'socials',
		'fonts',
		'header',
		'header-image',
		'blog',
		'portfolio',
		'videos',
		'shop',
		'background-image',
		'footer',
		'footer-bg',
		'wvc',
		'extra',
	);

	return $mod_files;
}
add_filter( 'milu_customizer_mod_files', 'milu_customizer_set_mod_files' );