<?php
/**
 * Milu photos
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_attachment_mods( $mods ) {

	if ( class_exists( 'Wolf_Photos' ) ) {
		$mods['photos'] = array(
			'priority' => 45,
			'id' => 'photos',
			'title' => esc_html__( 'Stock Photos', 'milu' ),
			'icon' => 'camera',
			'options' => array(

				'attachment_layout' => array(
					'id' => 'attachment_layout',
					'label' => esc_html__( 'Layout', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'standard' => esc_html__( 'Standard', 'milu' ),
						'fullwidth' => esc_html__( 'Full width', 'milu' ),
					),
					'transport' => 'postMessage',
				),

				'attachment_display' => array(
					'id' =>'attachment_display',
					'label' => esc_html__( 'Photos Display', 'milu' ),
					'type' => 'select',
					'choices' => apply_filters( 'milu_attachment_display_options', array(
						'grid' => esc_html__( 'Grid', 'milu' ),
					) ),
				),

				'attachment_grid_padding' => array(
					'id' => 'attachment_grid_padding',
					'label' => esc_html__( 'Padding', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'yes' => esc_html__( 'Yes', 'milu' ),
						'no' => esc_html__( 'No', 'milu' ),
					),
					'transport' => 'postMessage',
				),

				'attachment_author' => array(
					'id' => 'attachment_author',
					'label' => esc_html__( 'Display Author on Single Page', 'milu' ),
					'type' => 'checkbox',
				),

				'attachment_likes' => array(
					'id' => 'attachment_likes',
					'label' => esc_html__( 'Display Likes', 'milu' ),
					'type' => 'checkbox',
				),

				'attachment_multiple_sizes_download' => array(
					'id' => 'attachment_multiple_sizes_download',
					'label' => esc_html__( 'Allow multiple sizes options for downloadable photos.', 'milu' ),
					'type' => 'checkbox',
				),

				'attachments_per_page' => array(
					'label' => esc_html__( 'Photos per Page', 'milu' ),
					'id' => 'attachments_per_page',
					'type' => 'text',
				),

				'attachments_pagination' => array(
					'id' => 'attachments_pagination',
					'label' => esc_html__( 'Pagination Type', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'infinitescroll' => esc_html__( 'Infinite Scroll', 'milu' ),
						'numbers' => esc_html__( 'Numbers', 'milu' ),
					),
					'transport' => 'postMessage',
				),
			),
		);
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_attachment_mods' );