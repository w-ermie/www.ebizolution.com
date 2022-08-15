<?php
/**
 * Milu events
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_artist_mods( $mods ) {

	if ( class_exists( 'Wolf_Artists' ) ) {
		$mods['wolf_artists'] = array(
			'priority' => 45,
			'id' => 'wolf_artists',
			'title' => esc_html__( 'Artists', 'milu' ),
			'icon' => 'admin-users',
			'options' => array(

				'artist_layout' => array(
					'id' => 'artist_layout',
					'label' => esc_html__( 'Layout', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'standard' => esc_html__( 'Standard', 'milu' ),
						'fullwidth' => esc_html__( 'Full width', 'milu' ),
						'sidebar-right' => esc_html__( 'Sidebar at right', 'milu' ),
						'sidebar-left' => esc_html__( 'Sidebar at left', 'milu' ),
					),
					'transport' => 'postMessage',
					'description' => esc_html__( 'For "Sidebar" layouts, the sidebar will be visible if it contains widgets.', 'milu' ),
				),

				'artist_display' => array(
					'id' => 'artist_display',
					'label' => esc_html__( 'Display', 'milu' ),
					'type' => 'select',
					'choices' => apply_filters( 'milu_artist_display_options', array(
						'list' => esc_html__( 'List', 'milu' ),
					) ),
				),

				'artist_grid_padding' => array(
					'id' => 'artist_grid_padding',
					'label' => esc_html__( 'Padding', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'yes' => esc_html__( 'Yes', 'milu' ),
						'no' => esc_html__( 'No', 'milu' ),
					),
					'transport' => 'postMessage',
				),

				'artist_pagination' => array(
					'id' => 'artist_pagination',
					'label' => esc_html__( 'Artists Archive Pagination', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'none' => esc_html__( 'None', 'milu' ),
						'standard_pagination' => esc_html__( 'Numeric Pagination', 'milu' ),
						'load_more' => esc_html__( 'Load More Button', 'milu' ),
					),
					'description' => esc_html__( 'You must set a number of posts per page below. The category filter will not be disabled.', 'milu' ),
				),

				'artists_per_page' => array(
					'label' => esc_html__( 'Artists per Page', 'milu' ),
					'id' => 'artists_per_page',
					'type' => 'text',
					'placeholder' => 6,
				),
			),
		);
	}

	return $mods;

}
add_filter( 'milu_customizer_mods', 'milu_set_artist_mods' );