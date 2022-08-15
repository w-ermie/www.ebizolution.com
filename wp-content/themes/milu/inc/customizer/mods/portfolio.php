<?php
/**
 * Milu customizer blog mods
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_work_mods( $mods ) {

	if ( class_exists( 'Wolf_Portfolio' ) ) {

		$mods['portfolio'] = array(
			'id' => 'portfolio',
			'icon' => 'portfolio',
			'title' => esc_html__( 'Portfolio', 'milu' ),
			'options' => array(

				'work_layout' => array(
					'id' =>'work_layout',
					'label' => esc_html__( 'Portfolio Layout', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'standard' => esc_html__( 'Standard', 'milu' ),
						'fullwidth' => esc_html__( 'Full width', 'milu' ),
					),
				),

				'work_display' => array(
					'id' =>'work_display',
					'label' => esc_html__( 'Portfolio Display', 'milu' ),
					'type' => 'select',
					'choices' => apply_filters( 'milu_work_display_options', array(
						'grid' => esc_html__( 'Grid', 'milu' ),
					) ),
				),

				'work_grid_padding' => array(
					'id' => 'work_grid_padding',
					'label' => esc_html__( 'Padding (for grid style display only)', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'yes' => esc_html__( 'Yes', 'milu' ),
						'no' => esc_html__( 'No', 'milu' ),
					),
					'transport' => 'postMessage',
				),

				'work_item_animation' => array(
					'label' => esc_html__( 'Portfolio Post Animation', 'milu' ),
					'id' => 'work_item_animation',
					'type' => 'select',
					'choices' => milu_get_animations(),
				),

				'work_pagination' => array(
					'id' => 'work_pagination',
					'label' => esc_html__( 'Portfolio Archive Pagination', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'none' => esc_html__( 'None', 'milu' ),
						'standard_pagination' => esc_html__( 'Numeric Pagination', 'milu' ),
						'load_more' => esc_html__( 'Load More Button', 'milu' ),
					),
					'description' => esc_html__( 'You must set a number of posts per page below. The category filter will not be disabled.', 'milu' ),
				),

				'works_per_page' => array(
					'label' => esc_html__( 'Works per Page', 'milu' ),
					'id' => 'works_per_page',
					'type' => 'text',
					'placeholder' => 6,
				),
			),
		);
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_work_mods' );