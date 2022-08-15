<?php
/**
 * Milu layout
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_layout_mods( $mods ) {

	$mods['layout'] = array(

		'id' => 'layout',
		'title' => esc_html__( 'Layout', 'milu' ),
		'icon' => 'layout',
		'options' => array(

			'site_layout' => array(
				'id' => 'site_layout',
				'label' => esc_html__( 'General', 'milu' ),
				'type' => 'radio_images',
				'default' => 'wide',
				'choices' => array(
					array(
						'key' => 'wide',
						'image' => get_parent_theme_file_uri( 'assets/img/customizer/site-layout/wide.png' ),
						'text' => esc_html__( 'Wide', 'milu' ),
					),

					array(
						'key' => 'boxed',
						'image' => get_parent_theme_file_uri( 'assets/img/customizer/site-layout/boxed.png' ),
						'text' => esc_html__( 'Boxed', 'milu' ),
					),

					array(
						'key' => 'frame',
						'image' => get_parent_theme_file_uri( 'assets/img/customizer/site-layout/frame.png' ),
						'text' => esc_html__( 'Frame', 'milu' ),
					),
				),
				'transport' => 'postMessage',
			),

			'button_style' => array(
				'id' => 'button_style',
				'label' => esc_html__( 'Button Shape', 'milu' ),
				'type' => 'select',
				'choices' => array(
					'standard' => esc_html__( 'Standard', 'milu' ),
					'square' => esc_html__( 'Square', 'milu' ),
					'round' => esc_html__( 'Round', 'milu' ),
				),
				'transport' => 'postMessage',
			),
		),
	);

	if ( class_exists( 'Wolf_Vc_Content_Block' ) && class_exists( 'Wolf_Visual_Composer' ) && defined( 'WPB_VC_VERSION' ) ) {

		$content_block_posts = get_posts( 'post_type="wvc_content_block"&numberposts=-1' );

		$content_blocks = array( '' => esc_html__( 'None', 'milu' ) );
		if ( $content_block_posts ) {
			foreach ( $content_block_posts as $content_block_options ) {
				$content_blocks[ $content_block_options->ID ] = $content_block_options->post_title;
			}
		} else {
			$content_blocks[0] = esc_html__( 'No Content Block Yet', 'milu' );
		}

		$mods['layout']['options']['after_header_block'] = array(
			'label'	=> esc_html__( 'Post-header Block', 'milu' ),
			'id'	=> 'after_header_block',
			'type'	=> 'select',
			'choices' => $content_blocks,
			'description' => esc_html__( 'A block to display below to header or in replacement of the header.', 'milu' ),
		);

		$mods['layout']['options']['before_footer_block'] = array(
			'label'	=> esc_html__( 'Pre-footer Block', 'milu' ),
			'id'	=> 'before_footer_block',
			'type'	=> 'select',
			'choices' => $content_blocks,
			'description' => esc_html__( 'A block to display above to footer or in replacement of the footer.', 'milu' ),
		);
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_layout_mods' );