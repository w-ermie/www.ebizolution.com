<?php
/**
 * Milu customizer blog mods
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_post_mods( $mods ) {

	$mods['blog'] = array(
		'id' => 'blog',
		'icon' => 'welcome-write-blog',
		'title' => esc_html__( 'Blog', 'milu' ),
		'options' => array(

			'post_layout' => array(
				'id' =>'post_layout',
				'label' => esc_html__( 'Blog Archive Layout', 'milu' ),
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

			'post_display' => array(
				'id' =>'post_display',
				'label' => esc_html__( 'Blog Archive Display', 'milu' ),
				'type' => 'select',
				'choices' => apply_filters( 'milu_post_display_options', array(
					'standard' => esc_html__( 'Standard', 'milu' ),
				) ),
			),

			'post_grid_padding' => array(
				'id' => 'post_grid_padding',
				'label' => esc_html__( 'Padding (for grid style display only)', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'yes' => esc_html__( 'Yes', 'milu' ),
					'no' => esc_html__( 'No', 'milu' ),
				),
				'transport' => 'postMessage',
			),

			'date_format' => array(
				'id' => 'date_format',
				'label' => esc_html__( 'Blog Date Format', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'' => esc_html__( 'Default', 'milu' ),
					'human_diff' => esc_html__( '"X Time ago"', 'milu' ),
				),
			),

			'post_pagination' => array(
				'id' => 'post_pagination',
				'label' => esc_html__( 'Blog Archive Pagination', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'standard_pagination' => esc_html__( 'Numeric Pagination', 'milu' ),
					'load_more' => esc_html__( 'Load More Button', 'milu' ),
				),
			),

			'post_excerpt_type' => array(
				'id' =>'post_excerpt_type',
				'label' => esc_html__( 'Blog Archive Post Excerpt Type', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'auto' => esc_html__( 'Auto', 'milu' ),
					'manual' => esc_html__( 'Manual', 'milu' ),
				),
				'description' => sprintf( milu_kses( __( 'Only for the "Standard" display type. To split your post manually, you can use the <a href="%s" target="_blank">"read more"</a> tag.', 'milu' ) ), 'https://codex.wordpress.org/Customizing_the_Read_More' ),
			),

			'post_single_layout' => array(
				'id' =>'post_single_layout',
				'label' => esc_html__( 'Single Post Layout', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Sidebar Right', 'milu' ),
					'sidebar-left' => esc_html__( 'Sidebar Left', 'milu' ),
					'no-sidebar' => esc_html__( 'No Sidebar', 'milu' ),
					'fullwidth' => esc_html__( 'Full width', 'milu' ),
				),
			),

			'post_author_box' => array(
				'id' =>'post_author_box',
				'label' => esc_html__( 'Single Post Author Box', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'yes' => esc_html__( 'Yes', 'milu' ),
					'no' => esc_html__( 'No', 'milu' ),
				),
			),

			'post_related_posts' => array(
				'id' =>'post_related_posts',
				'label' => esc_html__( 'Single Post Related Posts', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'yes' => esc_html__( 'Yes', 'milu' ),
					'no' => esc_html__( 'No', 'milu' ),
				),
			),

			'post_item_animation' => array(
				'label' => esc_html__( 'Blog Archive Item Animation', 'milu' ),
				'id' => 'post_item_animation',
				'type' => 'select',
				'choices' => milu_get_animations(),
			),

			'post_display_elements' => array(
				'id' => 'post_display_elements',
				'label' => esc_html__( 'Elements to show by default', 'milu' ),
				'type' => 'group_checkbox',
				'choices' => array(
					'show_thumbnail' => esc_html__( 'Thumbnail', 'milu' ),
					'show_date' => esc_html__( 'Date', 'milu' ),
					'show_text' => esc_html__( 'Text', 'milu' ),
					'show_category' => esc_html__( 'Category', 'milu' ),
					'show_author' => esc_html__( 'Author', 'milu' ),
					'show_tags' => esc_html__( 'Tags', 'milu' ),
					'show_extra_meta' => esc_html__( 'Extra Meta', 'milu' ),
				),
				'description' => esc_html__( 'Note that some options may be ignored depending on the post display.', 'milu' ),
			),
		),
	);

	if ( class_exists( 'Wolf_Custom_Post_Meta' ) ) {

		$mods['blog']['options'][] = array(
			'label' => esc_html__( 'Enable Custom Post Meta', 'milu' ),
			'id' => 'enable_custom_post_meta',
			'type' => 'group_checkbox',
			'choices' => array(
				'post_enable_views' => esc_html__( 'Views', 'milu' ),
				'post_enable_likes' => esc_html__( 'Likes', 'milu' ),
				'post_enable_reading_time' => esc_html__( 'Reading Time', 'milu' ),
			),
		);
	}


	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_post_mods' );