<?php
/**
 * Milu Customizer function
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get default color skin
 *
 * Get old option name if empty
 *
 * @return string
 */
function milu_get_color_scheme_option() {
	return apply_filters( 'milu_color_scheme_option', get_theme_mod( 'color_scheme', get_theme_mod( 'skin', 'default' ) ) );
}

/**
 * Deregister background and header settings to add it later where we want them
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function milu_customize_deregister( $wp_customize ) {
	$wp_customize->remove_control( 'background_color' );
	$wp_customize->remove_control( 'header_textcolor' );
}
add_action( 'customize_register', 'milu_customize_deregister', 11 );


if ( ! function_exists( 'milu_get_color_scheme' ) ) {
	/**
	 * Retrieves the current Milu color scheme.
	 *
	 * Create your own milu_get_color_scheme() function to override in a child theme.
	 *
	 * @return array An associative array of either the current or default color scheme HEX values.
	 */
	function milu_get_color_scheme() {
		$color_scheme_option = milu_get_color_scheme_option();
		$color_schemes = milu_get_color_schemes();

		if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
			return $color_schemes[ $color_scheme_option ]['colors'];
		} else {
			return $color_schemes['default']['colors'];
		}
	}
}

if ( ! function_exists( 'milu_get_color_scheme_choices' ) ) {
	/**
	 * Retrieves an array of color scheme choices registered for Milu.
	 *
	 * Create your own milu_get_color_scheme_choices() function to override
	 * in a child theme.
	 *
	 * @return array Array of color schemes.
	 */
	function milu_get_color_scheme_choices() {
		$color_schemes = milu_get_color_schemes();
		$color_scheme_control_options = array();

		foreach ( $color_schemes as $color_scheme => $value ) {
			$color_scheme_control_options[ $color_scheme ] = $value['label'];
		}

		return $color_scheme_control_options;
	}
}

if ( ! function_exists( 'milu_sanitize_color_scheme' ) ) {
	/**
	 * Handles sanitization for Milu color schemes.
	 *
	 * Create your own milu_sanitize_color_scheme() function to override
	 * in a child theme.
	 *
	 * @param string $value Color scheme name value.
	 * @return string Color scheme name.
	 */
	function milu_sanitize_color_scheme( $value ) {
		$color_schemes = milu_get_color_scheme_choices();

		if ( ! array_key_exists( $value, $color_schemes ) ) {
			return 'default';
		}

		return $value;
	}
}

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 */
function milu_customize_control_js() {

	wp_enqueue_style( 'milu-customizer-style', get_template_directory_uri() . '/assets/css/customizer.css' );

	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : milu_get_theme_version();
	wp_enqueue_script( 'milu-customize-color-scheme-control', get_template_directory_uri() . '/inc/customizer/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), $version, true );
	wp_localize_script( 'milu-customize-color-scheme-control', 'colorScheme', milu_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'milu_customize_control_js' );

/**
 * Enqueue customizer preview script
 */
function milu_customize_preview_js() {

	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : milu_get_theme_version();
	wp_enqueue_script( 'milu-customize-preview', get_template_directory_uri() . '/inc/customizer/js/customize-preview.js', array( 'jquery', 'customize-preview' ), $version, true );
}
add_action( 'customize_preview_init', 'milu_customize_preview_js' );

/**
 * Convert hex color to rgb
 *
 * @param string $hex
 * @return string
 */
function milu_hex_to_rgb( $hex ) {
	$hex = str_replace( '#', '', $hex );

	if ( strlen( $hex ) == 3 ) {
		$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex,0,1 ) );
		$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex,1,1 ) );
		$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex,2,1 ) );
	} else {
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );
	return implode( ',', $rgb ); // returns the rgb values separated by commas
}

/**
 * Set customizer tab icons
 */
function milu_set_customizer_tabs_icons() {

	$mods = milu_customizer_get_mods();

	$css = '';

	foreach ( $mods as $key => $value) {

		if ( isset( $value['icon'] ) && isset( $value['id'] ) ) {

			$section_id = $value['id'];
			$icon_slug = $value['icon'];

			$css .= '
				#accordion-section-' . $section_id . ' .accordion-section-title:before{
					position:relative;
					font-family:Dashicons;
					content : "' . milu_get_dashicon_css_unicode( $icon_slug ) . '";
					position: relative;
					top: 2px;
					margin-left: 5px;
					left: -6px;
					line-height: inherit;
					font-weight: normal;
				}
			';
		}
	}

	if ( ! SCRIPT_DEBUG ) {
		$css = milu_compact_css( $css );
	}

	wp_add_inline_style( 'milu-customizer-style', $css );
}
add_action( 'customize_controls_enqueue_scripts', 'milu_set_customizer_tabs_icons' );

/**
 * Get dashicon CSS unicod from slug
 */
function milu_get_dashicon_css_unicode( $icon_slug ) {

	$dashicons_array = array(
		'admin-customizer' => '\f540',
		'welcome-write-blog' => '\f119',
		'welcome-view-site' => '\f115',
		'welcome-widgets-menus' => '\f116',
		'menu' => '\f333',
		'layout' => '\f538',
		'editor-video' => '\f219',
		'update' => '\f463',
		'portfolio' => '\f322',
		'images-alt' => '\f232',
		'images-alt2' => '\f233',
		'cart' => '\f174',
		'calendar' => '\f145',
		'calendar-alt' => '\f508',
		'editor-textcolor' => '\f215',
		'arrow-down-alt' => '\f346',
		'format-image' => '\f128',
		'camera' => '\f306',
		'media-spreadsheet' => '\f495',
		'format-audio' => '\f127',
		'album' => '\f514',
		'minus' => '\f460',
		'editor-table' => '\f535',
		'visibility' => '\f177',
		'share' => '\f237',
		'admin-users' => '\f110',
		'plus-alt' => '\f502',
		'arrow-left-alt2' => '\f341',
	);

	if ( isset( $dashicons_array[ $icon_slug ] ) ) {
		return $dashicons_array[ $icon_slug ];
	}
}