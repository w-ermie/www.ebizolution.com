<?php
/**
 * Milu metaboxes
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Register metaboxes
 *
 * Pass a metabox array to generate metabox with the  Wolf Metaboxes plugin
 */
function milu_register_metabox() {

	$body_metaboxes = array(
		'site_settings' => array(
			'title' => esc_html__( 'Layout', 'milu' ),
			'page' => apply_filters( 'milu_site_settings_post_types', array( 'post', 'page', 'plugin', 'video', 'product', 'gallery', 'theme', 'work', 'show', 'release', 'wpm_playlist', 'event', 'artist', 'mp-event' ) ),

			'metafields' => array(

				array(
					'label'	=> '',
					'id'	=> '_post_subheading',
					'type'	=> 'text',
				),

				/*array(
					'label'	=> esc_html__( 'Scroll to second row on mousewheel down.', 'milu' ),
					'id'	=> '_hero_mousewheel',
					'type'	=> 'checkbox',
				),*/

				array(
					'label'	=> esc_html__( 'Content Background Color', 'milu' ),
					'id'	=> '_post_content_inner_bg_color',
					'type'	=> 'colorpicker',
					'desc' => esc_html__( 'If you use the page builder and set your row background setting to "no background", you may want to change the overall content background color.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Content Background Image', 'milu' ),
					'id'	=> '_post_content_inner_bg_img',
					'type'	=> 'image',
					'desc' => esc_html__( 'If you use the page builder and set your row background setting to "no background", you may want to change the overall content background image.', 'milu' ),
				),

				array(
					'label' => esc_html__( 'Loading Animation Type', 'milu' ),
					'id' => '_post_loading_animation_type',
					'type' => 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
			 			'none' => esc_html__( 'None', 'milu' ),
			 			'overlay' => esc_html__( 'Simple Overlay', 'milu' ),
			 			'logo' => esc_html__( 'Overlay with Logo', 'milu' ),
			 			'spinner-loader1' => esc_html__( 'Rotating plane', 'milu' ),
						'spinner-loader2' => esc_html__( 'Double Pulse', 'milu' ),
						'spinner-loader3' => esc_html__( 'Wave', 'milu' ),
						'spinner-loader4' => esc_html__( 'Wandering cubes', 'milu' ),
						'spinner-loader5' => esc_html__( 'Pulse', 'milu' ),
						'spinner-loader6' => esc_html__( 'Chasing dots', 'milu' ),
						'spinner-loader7' => esc_html__( 'Three bounce', 'milu' ),
						'spinner-loader8' => esc_html__( 'Circle', 'milu' ),
						'spinner-loader9' => esc_html__( 'Cube grid', 'milu' ),
						'spinner-loader10' => esc_html__( 'Classic Loader', 'milu' ),
						'spinner-loader11' => esc_html__( 'Folding cube', 'milu' ),
						'spinner-loader12' => esc_html__( 'Ball Pulse', 'milu' ),
						'spinner-loader13' => esc_html__( 'Ball Grid Pulse', 'milu' ),
						'spinner-loader15' => esc_html__( 'Ball Clip Rotate Pulse', 'milu' ),
						'spinner-loader16' => esc_html__( 'Ball Clip Rotate Pulse Multiple', 'milu' ),
						'spinner-loader17' => esc_html__( 'Ball Pulse Rise', 'milu' ),
						'spinner-loader19' => esc_html__( 'Ball Zigzag', 'milu' ),
						'spinner-loader20' => esc_html__( 'Ball Zigzag Deflect', 'milu' ),
						'spinner-loader21' => esc_html__( 'Ball Triangle Path', 'milu' ),
						'spinner-loader22' => esc_html__( 'Ball Scale', 'milu' ),
						'spinner-loader23' => esc_html__( 'Ball Line Scale', 'milu' ),
						'spinner-loader24' => esc_html__( 'Ball Line Scale Party', 'milu' ),
						'spinner-loader25' => esc_html__( 'Ball Scale Multiple', 'milu' ),
						'spinner-loader26' => esc_html__( 'Ball Pulse Sync', 'milu' ),
						'spinner-loader27' => esc_html__( 'Ball Beat', 'milu' ),
						'spinner-loader28' => esc_html__( 'Ball Scale Ripple Multiple', 'milu' ),
						'spinner-loader29' => esc_html__( 'Ball Spin Fade Loader', 'milu' ),
						'spinner-loader30' => esc_html__( 'Line Spin Fade Loader', 'milu' ),
						'spinner-loader31' => esc_html__( 'Pacman', 'milu' ),
						'spinner-loader32' => esc_html__( 'Ball Grid Beat ', 'milu' ),
					),
				),

				// array(
				// 	'label'	=> esc_html__( 'Body Background', 'milu' ),
				// 	'id'	=> '_post_body_background_img',
				// 	'type'	=> 'image',
				// ),

				// array(
				// 	'label'	=> esc_html__( 'Body Background Position', 'milu' ),
				// 	'id'	=> '_post_body_background_img_position',
				// 	'type' => 'select',
				// 	'choices' => array(
				// 		'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
				// 		'center top' => esc_html__( 'center top', 'milu' ),
				// 		'center center' => esc_html__( 'center center', 'milu' ),
				// 		'left top'  => esc_html__( 'left top', 'milu' ),
				// 		'right top'  => esc_html__( 'right top', 'milu' ),
				// 		'center bottom' => esc_html__( 'center bottom', 'milu' ),
				// 		'left bottom'  => esc_html__( 'left bottom', 'milu' ),
				// 		'right bottom'  => esc_html__( 'right bottom', 'milu' ),
				// 		'left center'  => esc_html__( 'left center', 'milu' ),
				// 		'right center' => esc_html__( 'right center', 'milu' ),
				// 	),
				// ),
				// array(
				// 	'label'	=> esc_html__( 'Body Background Attachment', 'milu' ),
				// 	'id'	=> '_post_body_background_img_attachment',
				// 	'type' => 'select',
				// 	'choices' => array(
				// 		'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
				// 		'scroll' => esc_html__( 'Scroll', 'milu' ),
				// 		'fixed' => esc_html__( 'Fixed', 'milu' ),
				// 	),
				// ),

				array(
					'label'	=> esc_html__( 'Accent Color', 'milu' ),
					'id'	=> '_post_accent_color',
					'type'	=> 'colorpicker',
					'desc' => esc_html__( 'It will overwrite the main accent color set in the customizer.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Secondary Accent Color', 'milu' ),
					'id'	=> '_post_secondary_accent_color',
					'type'	=> 'colorpicker',
					'desc' => esc_html__( 'It will overwrite the secondary accent color set in the customizer.', 'milu' ),
				),
			),
		),
	);

	$content_blocks = array(
			'' => '&mdash; ' . esc_html__( 'None', 'milu' ) . ' &mdash;',
	);

	if ( class_exists( 'Wolf_Visual_Composer' ) && class_exists( 'Wolf_Vc_Content_Block' ) && defined( 'WPB_VC_VERSION' ) ) {
		// Content block option
		$content_block_posts = get_posts( 'post_type="wvc_content_block"&numberposts=-1' );

		$content_blocks = array(
			'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
			'none' => esc_html__( 'None', 'milu' ),
		);
		if ( $content_block_posts ) {
			foreach ( $content_block_posts as $content_block_options ) {
				$content_blocks[ $content_block_options->ID ] = $content_block_options->post_title;
			}
		} else {
			$content_blocks[0] = esc_html__( 'No Content Block Yet', 'milu' );
		}

		$body_metaboxes['site_settings']['metafields'][] = array(
			'label'	=> esc_html__( 'Post-header Block', 'milu' ),
			'id'	=> '_post_after_header_block',
			'type'	=> 'select',
			'choices' => $content_blocks,
		);

		$body_metaboxes['site_settings']['metafields'][] = array(
			'label'	=> esc_html__( 'Pre-footer Block', 'milu' ),
			'id'	=> '_post_before_footer_block',
			'type'	=> 'select',
			'choices' => $content_blocks,
		);

	}

	$header_metaboxes = array(
		'header_settings' => array(
			'title' => esc_html__( 'Header', 'milu' ),
			'page' => apply_filters( 'milu_header_settings_post_types', array( 'post', 'page', 'plugin', 'video', 'gallery', 'theme', 'work', 'show', 'release', 'wpm_playlist', 'event', 'artist', 'mp-event' ) ),

			'metafields' => array(

				array(
					'label'	=> esc_html__( 'Header Layout', 'milu' ),
					'id'	=> '_post_hero_layout',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'standard' => esc_html__( 'Standard', 'milu' ),
						'big' => esc_html__( 'Big', 'milu' ),
						'small' => esc_html__( 'Small', 'milu' ),
						'fullheight' => esc_html__( 'Full Height', 'milu' ),
						'none' => esc_html__( 'No Header', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Title Font Family', 'milu' ),
					'id'	=> '_post_hero_title_font_family',
					'type'	=> 'font_family',
				),

				array(
					'label'	=> esc_html__( 'Font Transform', 'milu' ),
					'id'	=> '_post_hero_title_font_transform',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'uppercase' => esc_html__( 'Uppercase', 'milu' ),
						'none' => esc_html__( 'None', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Big Text', 'milu' ),
					'id'	=> '_post_hero_title_bigtext',
					'type'	=> 'checkbox',
					'desc' => esc_html__( 'Enable "Big Text" for the title?', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Background Type', 'milu' ),
					'id'	=> '_post_hero_background_type',
					'type'	=> 'select',
					'choices' => array(
						'featured-image' => esc_html__( 'Featured Image', 'milu' ),
						'image' => esc_html__( 'Image', 'milu' ),
						'video' => esc_html__( 'Video', 'milu' ),
						'slideshow' => esc_html__( 'Slideshow', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Slideshow Images', 'milu' ),
					'id'	=> '_post_hero_slideshow_ids',
					'type'	=> 'multiple_images',
					'dependency' => array( 'element' => '_post_hero_background_type', 'value' => array( 'slideshow' ) ),
				),

				array(
					'label'	=> esc_html__( 'Background', 'milu' ),
					'id'	=> '_post_hero_background',
					'type'	=> 'background',
					'dependency' => array( 'element' => '_post_hero_background_type', 'value' => array( 'image' ) ),
				),

				array(
					'label'	=> esc_html__( 'Background Effect', 'milu' ),
					'id'	=> '_post_hero_background_effect',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'zoomin' => esc_html__( 'Zoom', 'milu' ),
						'parallax' => esc_html__( 'Parallax', 'milu' ),
						'none' => esc_html__( 'None', 'milu' ),
					),
					'dependency' => array( 'element' => '_post_hero_background_type', 'value' => array( 'image' ) ),
				),

				array(
					'label'	=> esc_html__( 'Video URL', 'milu' ),
					'id'	=> '_post_hero_background_video_url',
					'type'	=> 'video',
					'dependency' => array( 'element' => '_post_hero_background_type', 'value' => array( 'video' ) ),
					'desc' => esc_html__( 'A mp4 or YouTube URL. The featured image will be used as image fallback when the video cannot be displayed.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Overlay', 'milu' ),
					'id'	=> '_post_hero_overlay',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'custom' => esc_html__( 'Custom', 'milu' ),
						'none' => esc_html__( 'None', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Overlay Color', 'milu' ),
					'id'	=> '_post_hero_overlay_color',
					'type'	=> 'colorpicker',
					//'value' 	=> '#000000',
					'dependency' => array( 'element' => '_post_hero_overlay', 'value' => array( 'custom' ) ),
				),

				array(
					'label'	=> esc_html__( 'Overlay Opacity (in percent)', 'milu' ),
					'id'	=> '_post_hero_overlay_opacity',
					'desc'	=> esc_html__( 'Adapt the header overlay opacity if needed', 'milu' ),
					'type'	=> 'int',
					'placeholder'	=> 40,
					'dependency' => array( 'element' => '_post_hero_overlay', 'value' => array( 'custom' ) ),
				),

			),
		),
	);

	$menu_metaboxes = array(
			'menu_settings' => array(
				'title' => esc_html__( 'Menu', 'milu' ),
				'page' => apply_filters( 'milu_menu_settings_post_types', array( 'post', 'page', 'plugin', 'video', 'product', 'gallery', 'theme', 'work', 'show', 'release', 'wpm_playlist', 'event', 'artist', 'mp-event' ) ),

			'metafields' => array(

				array(
					'label'	=> esc_html__( 'Menu Font Tone', 'milu' ),
					'id'	=> '_post_hero_font_tone',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'light' => esc_html__( 'Light', 'milu' ),
						'dark' => esc_html__( 'Dark', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Menu Layout', 'milu' ),
					'id'	=> '_post_menu_layout',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						//'top-logo' => esc_html__( 'Top Logo', 'milu' ),
						'top-right' => esc_html__( 'Top Right', 'milu' ),
						'top-justify' => esc_html__( 'Top Justify', 'milu' ),
						'top-justify-left' => esc_html__( 'Top Justify Left', 'milu' ),
						'centered-logo' => esc_html__( 'Centered', 'milu' ),
						'top-left' => esc_html__( 'Top Left', 'milu' ),
						//'offcanvas' => esc_html__( 'Off Canvas', 'milu' ),
						 'overlay' => esc_html__( 'Overlay', 'milu' ),
						//'lateral' => esc_html__( 'Lateral', 'milu' ),
						'none' => esc_html__( 'No Menu', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Menu Width', 'milu' ),
					'id'	=> '_post_menu_width',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'wide' => esc_html__( 'Wide', 'milu' ),
						'boxed' => esc_html__( 'Boxed', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Megamenu Width', 'milu' ),
					'id'	=> '_post_mega_menu_width',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'boxed' => esc_html__( 'Boxed', 'milu' ),
						'wide' => esc_html__( 'Wide', 'milu' ),
						'fullwidth' => esc_html__( 'Full Width', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Menu Style', 'milu' ),
					'id'	=> '_post_menu_style',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'solid' => esc_html__( 'Solid', 'milu' ),
						'semi-transparent-white' => esc_html__( 'Semi-transparent White', 'milu' ),
						'semi-transparent-black' => esc_html__( 'Semi-transparent Black', 'milu' ),
						'transparent' => esc_html__( 'Transparent', 'milu' ),
						//'none' => esc_html__( 'No Menu', 'milu' ),
					),
				),

				/*array(
					'label'	=> esc_html__( 'Menu Skin', 'milu' ),
					'id'	=> '_post_menu_skin',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'light' => esc_html__( 'Light', 'milu' ),
						'dark' => esc_html__( 'Dark', 'milu' ),
						//'none' => esc_html__( 'No Menu', 'milu' ),
					),
				),*/

				'menu_sticky_type' => array(
					'id' =>'_post_menu_sticky_type',
					'label' => esc_html__( 'Sticky Menu', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'none' => esc_html__( 'Disabled', 'milu' ),
						'soft' => esc_html__( 'Sticky on scroll up', 'milu' ),
						'hard' => esc_html__( 'Always sticky', 'milu' ),
					),
				),

				'sticky_menu_transparent' => array(
					'id' => '_post_sticky_menu_transparent',
					'label' => esc_html__( 'Transparent Sticky Menu', 'milu' ),
					'type' => 'checkbox',
				),

				// array(
				// 	'label'	=> esc_html__( 'Sticky Menu Skin', 'milu' ),
				// 	'id'	=> '_post_menu_skin',
				// 	'type'	=> 'select',
				// 	'choices' => array(
				// 		'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
				// 		'light' => esc_html__( 'Light', 'milu' ),
				// 		'dark' => esc_html__( 'Dark', 'milu' ),
				// 		//'none' => esc_html__( 'No Menu', 'milu' ),
				// 	),
				// ),

				array(
					'id' => '_post_menu_cta_content_type',
					'label' => esc_html__( 'Additional Content', 'milu' ),
					'type' => 'select',
					'default' => 'icons',
					'choices' => array_merge(
						array(
							'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						),
						apply_filters( 'milu_menu_cta_content_type_options', array(
							'search_icon' => esc_html__( 'Search Icon', 'milu' ),
							'secondary-menu' => esc_html__( 'Secondary Menu', 'milu' ),
						) ),
						array( 'none' => esc_html__( 'None', 'milu' ) )
					),
				),

				// array(
				// 	'id' => '_post_show_nav_player',
				// 	'label' => esc_html__( 'Show Navigation Player', 'milu' ),
				// 	'type' => 'select',
				// 	'choices' => array(
				// 		'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
				// 		'yes' => esc_html__( 'Yes', 'milu' ),
				// 		'no' => esc_html__( 'No', 'milu' ),
				// 	),
				// ),

				array(
					'id' => '_post_side_panel_position',
					'label' => esc_html__( 'Side Panel', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'none' => esc_html__( 'None', 'milu' ),
						'right' => esc_html__( 'At Right', 'milu' ),
						'left' => esc_html__( 'At Left', 'milu' ),
					),
					'desc' => esc_html__( 'Note that it will be disable with a vertical menu layout (overlay, offcanvas etc...).', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Side Panel Background', 'milu' ),
					'id'	=> '_post_side_panel_bg_img',
					'type'	=> 'image',
				),

				array(
					'id' => '_post_logo_visibility',
					'label' => esc_html__( 'Logo Visibility', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'always' => esc_html__( 'Always', 'milu' ),
						'sticky_menu' => esc_html__( 'When menu is sticky only', 'milu' ),
						'hidden' => esc_html__( 'Hidden', 'milu' ),
					),
				),

				array(
					'id' => '_post_menu_items_visibility',
					'label' => esc_html__( 'Menu Items Visibility', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'show' => esc_html__( 'Visible', 'milu' ),
						'hidden' => esc_html__( 'Hidden', 'milu' ),
					),
					'desc' => esc_html__( 'If, for some reason, you need to hide the menu items but leave the logo, additional content and side panel.', 'milu' ),
				),

				'menu_breakpoint' => array(
					'id' =>'_post_menu_breakpoint',
					'label' => esc_html__( 'Mobile Menu Breakpoint', 'milu' ),
					'type' => 'text',
					'desc' => esc_html__( 'Use this field if you want to overwrite the mobile menu breakpoint.', 'milu' ),
				),
			),
		)
	);

	$footer_metaboxes = array(
		'footer_settings' => array(
				'title' => esc_html__( 'Footer', 'milu' ),
				'page' => apply_filters( 'milu_menu_settings_post_types', array( 'post', 'page', 'plugin', 'video', 'product', 'gallery', 'theme', 'work', 'show', 'release', 'wpm_playlist', 'event' ) ),

			'metafields' => array(
				array(
					'label'	=> esc_html__( 'Page Footer', 'milu' ),
					'id'	=> '_post_footer_type',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'hidden' => esc_html__( 'No Footer', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Hide Bottom Bar', 'milu' ),
					'id'	=> '_post_bottom_bar_hidden',
					'type'	=> 'select',
					'choices' => array(
						'' => esc_html__( 'No', 'milu' ),
						'yes' => esc_html__( 'Yes', 'milu' ),
					),
				),
			),
		)
	);

	/************** Post options ******************/

	$product_options = array();
	$product_options[] = esc_html__( 'WooCommerce not installed', 'milu' );

	if ( class_exists( 'WooCommerce' ) ) {
		$product_posts = get_posts( 'post_type="product"&numberposts=-1' );

		$product_options = array();
		if ( $product_posts ) {
			
			$product_options[] = esc_html__( 'Not linked', 'milu' );
			
			foreach ( $product_posts as $product ) {
				$product_options[ $product->ID ] = $product->post_title;
			}
		} else {
			$product_options[ esc_html__( 'No product yet', 'milu' ) ] = 0;
		}
	}

	$post_metaboxes = array(
		'post_settings' => array(
			'title' => esc_html__( 'Post', 'milu' ),
			'page' => array( 'post' ),
			'metafields' => array(

				array(
					'label'	=> esc_html__( 'Font Color Tone', 'milu' ),
					'id'	=> '_post_post_skin',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'light' => esc_html__( 'Dark', 'milu' ),
						'dark' => esc_html__( 'Light', 'milu' ),
					),
					'desc'	=> esc_html__( 'The font color tone of the post in the loop.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Secondary Featured Image', 'milu' ),
					'id'	=> '_post_secondary_featured_image',
					'type'	=> 'image',
					'desc' => esc_html__( 'If set, this image will be used as featured image for the grid layouts.', 'milu' ),
				),
				
				array(
					'label'	=> esc_html__( 'Post Layout', 'milu' ),
					'id'	=> '_post_layout',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'sidebar-right' => esc_html__( 'Sidebar Right', 'milu' ),
						'sidebar-left' => esc_html__( 'Sidebar Left', 'milu' ),
						'no-sidebar' => esc_html__( 'No Sidebar', 'milu' ),
						'fullwidth' => esc_html__( 'Full width', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Feature a Product', 'milu' ),
					'id'	=> '_post_wc_product_id',
					'type'	=> 'select',
					'choices' => $product_options,
					'desc'	=> esc_html__( 'A "Shop Now" buton will be displayed in the metro layout.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Hide Featured Image in Post', 'milu' ),
					'id'	=> '_post_hide_single_post_featured_image',
					'type'	=> 'checkbox',
				),
			),
		),
	);

	/************** Product options ******************/
	$product_metaboxes = array(

		'product_options' => array(
			'title' => esc_html__( 'Product', 'milu' ),
			'page' => array( 'product' ),
			'metafields' => array(

				array(
					'label'	=> esc_html__( 'Font Color Tone', 'milu' ),
					'id'	=> '_post_product_skin',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'light' => esc_html__( 'Dark', 'milu' ),
						'dark' => esc_html__( 'Light', 'milu' ),
					),
					'desc'	=> esc_html__( 'The font color tone of the post in the loop.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Background color', 'milu' ),
					'id'	=> '_post_product_bg_color',
					'type'	=> 'colorpicker',
					'desc'	=> esc_html__( 'The background color of the post in the loop. Useful only if you featured image is a transparent PNG image.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Label', 'milu' ),
					'id'	=> '_post_product_label',
					'type'	=> 'text',
					'placeholder' => esc_html__( '-30%', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Layout', 'milu' ),
					'id'	=> '_post_product_single_layout',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'standard' => esc_html__( 'Standard', 'milu' ),
						'sidebar-right' => esc_html__( 'Sidebar Right', 'milu' ),
						'sidebar-left' => esc_html__( 'Sidebar Left', 'milu' ),
						'fullwidth' => esc_html__( 'Full Width', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Size Chart Image', 'milu' ),
					'id'	=> '_post_wc_product_size_chart_img',
					'type'	=> 'image',
					'desc' => esc_html__( 'You can set a size chart image in the product category options. You can overwrite the category size chart for this product by uploading another image here.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Hide Size Chart Image', 'milu' ),
					'id'	=> '_post_wc_product_hide_size_chart_img',
					'type'	=> 'checkbox',
				),

				array(
					'label'	=> esc_html__( 'Menu Font Tone', 'milu' ),
					'id'	=> '_post_hero_font_tone',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'light' => esc_html__( 'Light', 'milu' ),
						'dark' => esc_html__( 'Dark', 'milu' ),
					),
					'desc' => esc_html__( 'By default the menu style is set to "solid" on single product page. If you change the menu style, you may need to adujst the menu color tone here.', 'milu' ),
				),

				'menu_sticky_type' => array(
					'id' =>'_post_product_sticky',
					'label' => esc_html__( 'Stacked Images', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'yes' => esc_html__( 'Yes', 'milu' ),
						'no' => esc_html__( 'No', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Disable Image Zoom', 'milu' ),
					'id'	=> '_post_product_disable_easyzoom',
					'type'	=> 'checkbox',
					'desc' => esc_html__( 'Disable image zoom on this product if it\'s enabled in the customizer.', 'milu' ),
				),
			),
		),
	);

	/************** Product options ******************/

	$product_options = array();
	$product_options[] = esc_html__( 'WooCommerce not installed', 'milu' );

	if ( class_exists( 'WooCommerce' ) ) {
		$product_posts = get_posts( 'post_type="product"&numberposts=-1' );

		$product_options = array();
		if ( $product_posts ) {
			
			$product_options[] = esc_html__( 'Not linked', 'milu' );
			
			foreach ( $product_posts as $product ) {
				$product_options[ $product->ID ] = $product->post_title;
			}
		} else {
			$product_options[ esc_html__( 'No product yet', 'milu' ) ] = 0;
		}
	}

	// if ( class_exists( 'Wolf_Playlist_Manager' ) ) {
	// 	// Player option
	// 	$playlist_posts = get_posts( 'post_type="wpm_playlist"&numberposts=-1' );

	// 	$playlist = array( '' => esc_html__( 'None', 'milu' ) );
	// 	if ( $playlist_posts ) {
	// 		foreach ( $playlist_posts as $playlist_options ) {
	// 			$playlist[ $playlist_options->ID ] = $playlist_options->post_title;
	// 		}
	// 	} else {
	// 		$playlist[0] = esc_html__( 'No Playlist Yet', 'milu' );
	// 	}

	// 	$product_metaboxes['product_options']['metafields'][] = array(
	// 		'label'	=> esc_html__( 'Playlist', 'milu' ),
	// 		'id'	=> '_post_product_playlist_id',
	// 		'type'	=> 'select',
	// 		'choices' => $playlist,
	// 		'desc' => esc_html__( 'It will overwrite the single player.', 'milu' ),
	// 	);

	// 	$product_metaboxes['product_options']['metafields'][] = array(
	// 		'label'	=> esc_html__( 'Playlist Skin', 'milu' ),
	// 		'id'	=> '_post_product_playlist_skin',
	// 		'type'	=> 'select',
	// 		'choices' => array(
	// 			'dark' => esc_html__( 'Dark', 'milu' ),
	// 			'light' => esc_html__( 'Light', 'milu' ),
	// 		),
	// 	);
	// }

	/************** Portfolio options ******************/
	$work_metaboxes = array(

		'work_options' => array(
			'title' => esc_html__( 'Work', 'milu' ),
			'page' => array( 'work' ),
			'metafields' => array(

				array(
					'label'	=> esc_html__( 'Font Color Tone', 'milu' ),
					'id'	=> '_post_work_skin',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'light' => esc_html__( 'Dark', 'milu' ),
						'dark' => esc_html__( 'Light', 'milu' ),
					),
					'desc'	=> esc_html__( 'The font color tone of the post in the loop.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Client', 'milu' ),
					'id'	=> '_work_client',
					'type'	=> 'text',
				),

				array(
					'label'	=> esc_html__( 'Link', 'milu' ),
					'id'		=> '_work_link',
					'type'	=> 'text',
				),

				array(
					'label'	=> esc_html__( 'Width', 'milu' ),
					'id'	=> '_post_width',
					'type'	=> 'select',
					'choices' => array(
						'standard' => esc_html__( 'Standard', 'milu' ),
						'wide' => esc_html__( 'Wide', 'milu' ),
						'fullwidth' => esc_html__( 'Full Width', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Layout', 'milu' ),
					'id'	=> '_post_layout',
					'type'	=> 'select',
					'choices' => array(
						'centered' => esc_html__( 'Centered', 'milu' ),
						'sidebar-right' => esc_html__( 'Excerpt & Info at Right', 'milu' ),
						'sidebar-left' => esc_html__( 'Excerpt & Info at Left', 'milu' ),
					),
				),

				array(
					'label'	=> esc_html__( 'Excerpt & Info Position', 'milu' ),
					'id'	=> '_post_work_info_position',
					'type'	=> 'select',
					'choices' => array(
						'after' => esc_html__( 'After Content', 'milu' ),
						'before' => esc_html__( 'Before Content', 'milu' ),
						'none' => esc_html__( 'Hidden', 'milu' ),
					),
					'dependency' => array( 'element' => '_post_layout', 'value' => array( 'centered' ) ),
				),

				// array(
				// 	'label'	=> esc_html__( 'Featured', 'milu' ),
				// 	'id'	=> '_post_featured',
				// 	'type'	=> 'checkbox',
				// 	'desc'	=> esc_html__( 'The featured image will be display bigger in the "metro" layout.', 'milu' ),
				// ),
			),
		),
	);

	/************** Video options ******************/
	$video_metaboxes = array(
		'video_settings' => array(
			'title' => esc_html__( 'Video', 'milu' ),
			'page' => array( 'video' ),
			'metafields' => array(

				array(
					'label'	=> esc_html__( 'Font Color Tone', 'milu' ),
					'id'	=> '_post_video_skin',
					'type'	=> 'select',
					'choices' => array(
						'' => '&mdash; ' . esc_html__( 'Default', 'milu' ) . ' &mdash;',
						'light' => esc_html__( 'Dark', 'milu' ),
						'dark' => esc_html__( 'Light', 'milu' ),
					),
					'desc'	=> esc_html__( 'The font color tone of the post in the loop.', 'milu' ),
				),

				array(
					'label'	=> esc_html__( 'Layout', 'milu' ),
					'id'	=> '_post_layout',
					'type'	=> 'select',
					'choices' => array(
						'' => esc_html__( 'Default', 'milu' ),
						'standard' => esc_html__( 'Standard', 'milu' ),
						'sidebar-right' => esc_html__( 'Sidebar Right', 'milu' ),
						'sidebar-left' => esc_html__( 'Sidebar Left', 'milu' ),
						'fullwidth' => esc_html__( 'Full Width', 'milu' ),
					),
				),
			),
		),
	);

	/************** One pager options ******************/
	$one_page_metaboxes = array(
		'one_page_settings' => array(
			'title' => esc_html__( 'One-Page', 'milu' ),
			'page' => array( 'post', 'page', 'work', 'product', 'release' ),
			'metafields' => array(
				array(
					'label'	=> esc_html__( 'One-Page Navigation', 'milu' ),
					'id'	=> '_post_one_page_menu',
					'type'	=> 'select',
					'choices' => array(
						'' => esc_html__( 'No', 'milu' ),
						'replace_main_nav' => esc_html__( 'Yes', 'milu' ),
					),
					'desc'	=> milu_kses( __( 'Activate to replace the main menu by a one-page scroll navigation. <strong>NB: Every row must have a unique name set in the row settings "Advanced" tab.</strong>', 'milu' ) ),
				),
				array(
					'label'	=> esc_html__( 'One-Page Bullet Navigation', 'milu' ),
					'id'	=> '_post_scroller',
					'type'	=> 'checkbox',
					'desc'	=> milu_kses( __( 'Activate to create a section scroller navigation. <strong>NB: Every row must have a unique name set in the row settings "Advanced" tab.</strong>', 'milu' ) ),
				),
				array(
					'label'	=> sprintf( esc_html__( 'Enable %s animations', 'milu' ), 'fullPage' ),
					'id'	=> '_post_fullpage',
					'type'	=> 'select',
					'choices' => array(
						'' => esc_html__( 'No', 'milu' ),
						'yes' => esc_html__( 'Yes', 'milu' ),
					),
					'desc' => esc_html__( 'Activate to enable advanced scroll animations between sections. Some of your row setting may be disabled to suit the global page design.', 'milu' ),
				),

				array(
					'label'	=> sprintf( esc_html__( '%s animation transition', 'milu' ), 'fullPage' ),
					'id'	=> '_post_fullpage_transition',
					'type'	=> 'select',
					'choices' => array(
						'mix' => esc_html__( 'Special', 'milu' ),
						'parallax' => esc_html__( 'Parallax', 'milu' ),
						'fade' => esc_html__( 'Fade', 'milu' ),
						'zoom' => esc_html__( 'Zoom', 'milu' ),
						'curtain' => esc_html__( 'Curtain', 'milu' ),
						'slide' => esc_html__( 'Slide', 'milu' ),
					),
					'dependency' => array( 'element' => '_post_fullpage', 'value' => array( 'yes' ) ),
				),

				array(
					'label'	=> sprintf( esc_html__( '%s animation duration', 'milu' ), 'fullPage' ),
					'id'	=> '_post_fullpage_animtime',
					'type'	=> 'text',
					'placeholder' => 1000,
					'dependency' => array( 'element' => '_post_fullpage', 'value' => array( 'yes' ) ),
				),
			),
		),
	);

	$all_metaboxes = array_merge(
		apply_filters( 'milu_body_metaboxes', $body_metaboxes ),
		apply_filters( 'milu_post_metaboxes', $post_metaboxes ),
		apply_filters( 'milu_product_metaboxes', $product_metaboxes ),
		apply_filters( 'milu_work_metaboxes', $work_metaboxes ),
		apply_filters( 'milu_video_metaboxes', $video_metaboxes ),
		apply_filters( 'milu_header_metaboxes', $header_metaboxes ),
		apply_filters( 'milu_menu_metaboxes', $menu_metaboxes ),
		apply_filters( 'milu_footer_metaboxes', $footer_metaboxes )
	);

	if ( class_exists( 'Wolf_Visual_Composer' ) && defined( 'WPB_VC_VERSION' ) ) {
		$all_metaboxes = $all_metaboxes + apply_filters( 'milu_one_page_metaboxes', $one_page_metaboxes );
	}

	if ( class_exists( 'Wolf_Metaboxes' ) ) {
		new Wolf_Metaboxes( apply_filters( 'milu_metaboxes', $all_metaboxes ) );
	}
}
milu_register_metabox();