<?php
/**
 * Milu Page Builder
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_wvc_mods( $mods ) {

	if ( class_exists( 'Wolf_Visual_Composer' ) ) {
		$mods['blog']['options']['newsletter'] = array(
			'id' =>'newsletter_form_single_blog_post',
			'label' => esc_html__( 'Add newsletter form below single post', 'milu' ),
			'type' => 'checkbox',
			'description' => esc_html__( 'Display a newsletter sign up form at the bottom of each blog post.', 'milu' ),
		);
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_wvc_mods' );