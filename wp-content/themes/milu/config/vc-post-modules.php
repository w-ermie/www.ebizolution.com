<?php
/**
 * WPBakery Page Builder post modules
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

if ( ! defined( 'ABSPATH' ) || ! class_exists( 'Wolf_Visual_Composer' ) || ! defined( 'WPB_VC_VERSION' ) ) {
	return;
}

$order_by_values = array(
	'',
	esc_html__( 'Date', 'milu' ) => 'date',
	esc_html__( 'ID', 'milu' ) => 'ID',
	esc_html__( 'Author', 'milu' ) => 'author',
	esc_html__( 'Title', 'milu' ) => 'title',
	esc_html__( 'Modified', 'milu' ) => 'modified',
	esc_html__( 'Random', 'milu' ) => 'rand',
	esc_html__( 'Comment count', 'milu' ) => 'comment_count',
	esc_html__( 'Menu order', 'milu' ) => 'menu_order',
);

$order_way_values = array(
	'',
	esc_html__( 'Descending', 'milu' ) => 'DESC',
	esc_html__( 'Ascending', 'milu' ) => 'ASC',
);

$shared_gradient_colors = ( function_exists( 'wvc_get_shared_gradient_colors' ) ) ? wvc_get_shared_gradient_colors() : array();
$shared_colors = ( function_exists( 'wvc_get_shared_colors' ) ) ? wvc_get_shared_colors() : array();

/**
 * Post Loop Module
 */
vc_map(
	array(
		'name' => esc_html__( 'Posts', 'milu' ),
		'description' => esc_html__( 'Display your posts using the theme layouts', 'milu' ),
		'base' => 'wvc_post_index',
		'category' => esc_html__( 'Content' , 'milu' ),
		'icon' => 'fa fa-th',
		'weight' => 999,
		'params' =>
		//array_merge(
			array(

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Index ID', 'milu' ),
					'value' => 'index-' . rand( 0,99999 ),
					'param_name' => 'el_id',
					'description' => esc_html__( 'A unique identifier for the post module (required).', 'milu' ),
				),

				array(
					'param_name' => 'post_display',
					'heading' => esc_html__( 'Post Display', 'milu' ),
					'type' => 'dropdown',
					'value' => array_flip( apply_filters( 'milu_post_display_options', array(
						'standard' => esc_html__( 'Standard', 'milu' ),
					) ) ),
					'std' => 'grid',
					'admin_label' => true,
				),

				array(
					'param_name' => 'post_metro_pattern',
					'heading' => esc_html__( 'Metro Pattern', 'milu' ),
					'type' => 'dropdown',
					'value' => milu_get_metro_patterns(),
					'std' => 'auto',
					'dependency' => array( 'element' => 'post_display', 'value' => array( 'metro_modern_alt', 'metro' ) ),
					'admin_label' => true,
				),

				array(
					'param_name' => 'post_alternate_thumbnail_position',
					'heading' => esc_html__( 'Alternate thumbnail position', 'milu' ),
					'type' => 'checkbox',
					'dependency' => array(
						'element' => 'post_display',
						'value' => array( 'lateral' )
					),
				),

				array(
					'param_name' => 'post_module',
					'heading' => esc_html__( 'Module', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Grid', 'milu' ) => 'grid',
						esc_html__( 'Carousel', 'milu' ) => 'carousel',
					),
					'admin_label' => true,
					'dependency' => array(
						'element' => 'post_display',
						'value' => array( 'grid', 'grid_classic', 'grid_modern' ),
					),
				),

				array(
					'param_name' => 'post_excerpt_length',
					'heading' => esc_html__( 'Post Excerpt Lenght', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Shorten', 'milu' ) => 'shorten',
						esc_html__( 'Full', 'milu' ) => 'full',
					),
					'dependency' => array(
						'element' => 'post_display',
						'value' => array( 'masonry' ),
					),
				),

				array(
					'param_name' => 'post_display_elements',
					'heading' => esc_html__( 'Elements', 'milu' ),
					'type' => 'checkbox',
					'value' => array(
						esc_html__( 'Thumbnail', 'milu' ) => 'show_thumbnail',
						esc_html__( 'Date', 'milu' ) => 'show_date',
						esc_html__( 'Text', 'milu' ) => 'show_text',
						esc_html__( 'Category', 'milu' ) => 'show_category',
						esc_html__( 'Author', 'milu' ) => 'show_author',
						esc_html__( 'Tags', 'milu' ) => 'show_tags',
						esc_html__( 'Extra Meta', 'milu' ) => 'show_extra_meta',
					),
					'std' => 'show_thumbnail,show_date,show_text,show_author,show_category',
					// 'dependency' => array(
					// 	'element' => 'post_display',
					// 	'value' => array( 'masonry', 'grid_classic', 'grid_modern', 'mosaic', 'metro', 'standard' ),
					// ),
					'description' => esc_html__( 'Note that some options may be ignored depending on the post display.', 'milu' ),
					'admin_label' => true,
				),

				array(
					'param_name' => 'post_excerpt_type',
					'heading' => esc_html__( 'Post Excerpt Type', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Auto', 'milu' ) => 'auto',
						esc_html__( 'Manual', 'milu' ) => 'manual',
					),
					'description' => sprintf(
						wp_kses_post( __( 'When using the manual excerpt, you must split your post using a "<a href="%s">More Tag</a>".', 'milu' ) ),
						esc_url( 'https://en.support.wordpress.com/more-tag/' )
					),
					'dependency' => array(
						'element' => 'post_display',
						'value' => array( 'standard', 'standard_modern' ),
					),
				),

				array(
					'param_name' => 'grid_padding',
					'heading' => esc_html__( 'Padding', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Yes', 'milu' ) => 'yes',
						esc_html__( 'No', 'milu' ) => 'no',
					),
					'admin_label' => true,
					'dependency' => array(
						'element' => 'post_display',
						'value_not_equal_to' => array( 'standard', 'standard_modern', 'masonry_modern', 'offgrid' ),
						// value_not_equal_to
					),
				),

				// array(
				// 	'heading' => esc_html__( 'Category Filter', 'milu' ),
				// 	'param_name' => 'post_category_filter',
				// 	'type' => 'checkbox',
				// 	'admin_label' => true,
				// ),

				array(
					'param_name' => 'pagination',
					'heading' => esc_html__( 'Pagination', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'None', 'milu' ) => 'none',
						esc_html__( 'Load More', 'milu' ) => 'load_more',
						esc_html__( 'Numeric Pagination', 'milu' ) => 'standard_pagination',
						esc_html__( 'Link to Blog Archives', 'milu' ) => 'link_to_blog',
					),
					'admin_label' => true,
					//'dependency' => array( 'element' => 'post_module', 'value' => array( 'grid' ) ),
				),

				array(
					'heading' => esc_html__( 'Animation', 'milu' ),
					'param_name' => 'item_animation',
					'type' => 'dropdown',
					'value' => array_flip( milu_get_animations() ),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Posts Per Page', 'milu' ),
					'param_name' => 'posts_per_page',
					'type' => 'wvc_textfield',
					'value' => get_option( 'posts_per_page' ),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
					'param_name' => 'inline_style',
					'type' => 'wvc_textfield',
					//'admin_label' => true,
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Offset', 'milu' ),
					'param_name' => 'offset',
					'description' => esc_html__( 'The amount of posts that should be skipped in the beginning of the query. If an offset is set, sticky posts will be ignored.', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
					'admin_label' => true,
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Ignore Sticky Posts', 'milu' ),
					'param_name' => 'ignore_sticky_posts',
					'description' => esc_html__( 'It will still include the sticky posts but it will not prioritize them in the query.', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Exclude Sticky Posts', 'milu' ),
					'description' => esc_html__( 'It will still exclude the sticky posts.', 'milu' ),
					'param_name' => 'exclude_sticky_posts',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Category', 'milu' ),
					'param_name' => 'category',
					'description' => esc_html__( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-category, other-category', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Category by ID', 'milu' ),
					'param_name' => 'category_exclude',
					'description' => esc_html__( 'Exclude only one or several categories. Paste category ID(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( '456, 756', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Tags', 'milu' ),
					'param_name' => 'tag',
					'description' => esc_html__( 'Include only one or several tags. Paste tag slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-tag, other-tag', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Tags by ID', 'milu' ),
					'param_name' => 'tag_exclude',
					'description' => esc_html__( 'Exclude only one or several tags. Paste tag ID(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( '456, 756', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'milu' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Select how to sort retrieved posts. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Sort order', 'milu' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Designates the ascending or descending order. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Post IDs', 'milu' ),
					'description' => esc_html__( 'By default, your last posts will be displayed. You can choose the posts you want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'include_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Post IDs', 'milu' ),
					'description' => esc_html__( 'You can choose the posts you don\'t want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'exclude_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'param_name' => 'columns',
					'heading' => esc_html__( 'Columns', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Auto', 'milu' ) => 'default',
						esc_html__( 'Two', 'milu' ) => 2,
						esc_html__( 'Three', 'milu' ) => 3,
						esc_html__( 'Four', 'milu' ) => 4,
						esc_html__( 'Five', 'milu' ) => 5,
						esc_html__( 'Six', 'milu' ) => 6,
						esc_html__( 'One', 'milu' ) => 1,
					),
					'std' => 'default',
					'admin_label' => true,
					'description' => esc_html__( 'By default, columns are set automatically depending on the container\'s width. Set a column count here to overwrite the default behavior.', 'milu' ),
					'dependency' => array(
						'element' => 'post_display',
						'value_not_equal_to' => array( 'standard', 'standard_modern', 'lateral', 'list' ),
					),
					'group' => esc_html__( 'Extra', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Extra class name', 'milu' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'milu' ),
					'group' => esc_html__( 'Extra', 'milu' ),
				),
			),
			//),

			// 	array(
			// 		'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
			// 		'param_name' => 'inline_style',
			// 		'type' => 'wvc_textfield',
			// 		//'admin_label' => true,
			// 	),
			// ),
		//)
	)
);
class WPBakeryShortCode_Wvc_Post_Index extends WPBakeryShortCode {}

if ( class_exists( 'WooCommerce' ) ) {

/**
 * Product Loop Module
 */
vc_map(
	array(
		'name' => esc_html__( 'Products', 'milu' ),
		'description' => esc_html__( 'Display your pages using the theme layouts', 'milu' ),
		'base' => 'wvc_product_index',
		'category' => esc_html__( 'Content' , 'milu' ),
		'icon' => 'fa fa-th',
		'weight' => 999,
		'params' =>
		//array_merge(
			array(

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'ID', 'milu' ),
					'value' => 'items-' . rand( 0,99999 ),
					'param_name' => 'el_id',
				),

				array(
					'param_name' => 'product_display',
					'heading' => esc_html__( 'Product Display', 'milu' ),
					'type' => 'dropdown',
					'value' => array_flip( apply_filters( 'milu_product_display_options', array(
						'grid_classic' => esc_html__( 'Classic', 'milu' ),
					) ) ),
					'std' => 'grid_classic',
					'admin_label' => true,
				),

				array(
					'param_name' => 'product_metro_pattern',
					'heading' => esc_html__( 'Metro Pattern', 'milu' ),
					'type' => 'dropdown',
					'value' => milu_get_metro_patterns(),
					'std' => 'pattern-1',
					'dependency' => array( 'element' => 'product_display', 'value' => array( 'metro', 'metro_overlay_quickview' ) ),
					'admin_label' => true,
				),

				array(
					'param_name' => 'product_text_align',
					'heading' => esc_html__( 'Product Text Alignement', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						'' => '',
						esc_html__( 'Center', 'milu' ) => 'center',
						esc_html__( 'Left', 'milu' ) => 'left',
						esc_html__( 'Right', 'milu' ) => 'right',
					),
					//'std' => '',
					'admin_label' => true,
					'dependency' => array( 'element' => 'product_display', 'value' => array( 'grid_classic' ) ),
				),

				array(
					'param_name' => 'product_meta',
					'heading' => esc_html__( 'Type', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'All', 'milu' ) => 'all',
						esc_html__( 'Featured', 'milu' ) => 'featured',
						esc_html__( 'On Sale', 'milu' ) => 'onsale',
						esc_html__( 'Best Selling', 'milu' ) => 'best_selling',
						esc_html__( 'Top Rated', 'milu' ) => 'top_rated',
					),
					'admin_label' => true,
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Category', 'milu' ),
					'param_name' => 'product_cat',
					'description' => esc_html__( 'Include only one or several categories. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-category, other-category', 'milu' ),
					'admin_label' => true,
				),

				array(
					'param_name' => 'product_module',
					'heading' => esc_html__( 'Module', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Grid', 'milu' ) => 'grid',
						esc_html__( 'Carousel', 'milu' ) => 'carousel',
					),
					'admin_label' => true,
					//'dependency' => array( 'element' => 'work_layout', 'value' => array( 'overlay', 'flip-box' ) ),
				),

				array(
					'param_name' => 'grid_padding',
					'heading' => esc_html__( 'Padding', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Yes', 'milu' ) => 'yes',
						esc_html__( 'No', 'milu' ) => 'no',
					),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Animation', 'milu' ),
					'param_name' => 'item_animation',
					'type' => 'dropdown',
					'value' => array_flip( milu_get_animations() ),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Posts Per Page', 'milu' ),
					'param_name' => 'posts_per_page',
					'type' => 'wvc_textfield',
					'placeholder' => get_option( 'posts_per_page' ),
					'description' => esc_html__( 'Leave empty to display all post at once.', 'milu' ),
					'std' => get_option( 'posts_per_page' ),
					'admin_label' => true,
				),

				array(
					'param_name' => 'pagination',
					'heading' => esc_html__( 'Pagination', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'None', 'milu' ) => 'none',
						esc_html__( 'Load More', 'milu' ) => 'load_more',
						esc_html__( 'Numeric Pagination', 'milu' ) => 'standard_pagination',
						esc_html__( 'Link to Category', 'milu' ) => 'link_to_shop_category',
						esc_html__( 'Link to Shop Archive', 'milu' ) => 'link_to_shop',
					),
					'admin_label' => true,
					'dependency' => array( 'element' => 'product_module', 'value' => array( 'grid', 'metro' ) ),
				),

				array(
					'param_name' => 'product_category_link_id',
					'heading' => esc_html__( 'Category', 'milu' ),
					'type' => 'dropdown',
					'value' => milu_get_product_cat_dropdown_options(),
					'dependency' => array( 'element' => 'pagination', 'value' => array( 'link_to_shop_category' ) ),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
					'param_name' => 'inline_style',
					'type' => 'wvc_textfield',
					//'admin_label' => true,
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Offset', 'milu' ),
					'param_name' => 'offset',
					'description' => esc_html__( 'The amount of posts that should be skipped in the beginning of the query. If an offset is set, sticky posts will be ignored.', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
					'admin_label' => true,
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'milu' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Select how to sort retrieved products. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Sort order', 'milu' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Designates the ascending or descending order. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Post IDs', 'milu' ),
					'description' => esc_html__( 'By default, your last posts will be displayed. You can choose the posts you want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'include_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Post IDs', 'milu' ),
					'description' => esc_html__( 'You can choose the posts you don\'t want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'exclude_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'param_name' => 'columns',
					'heading' => esc_html__( 'Columns', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Auto', 'milu' ) => 'default',
						esc_html__( 'Two', 'milu' ) => 2,
						esc_html__( 'Three', 'milu' ) => 3,
						esc_html__( 'Four', 'milu' ) => 4,
						esc_html__( 'Five', 'milu' ) => 5,
						esc_html__( 'Six', 'milu' ) => 6,
						esc_html__( 'One', 'milu' ) => 1,
					),
					'std' => 'default',
					'admin_label' => true,
					'description' => esc_html__( 'By default, columns are set automatically depending on the container\'s width. Set a column count here to overwrite the default behavior.', 'milu' ),
					'dependency' => array(
						'element' => 'product_display',
						'value_not_equal_to' => array( 'metro_overlay_quickview' ),
					),
					'group' => esc_html__( 'Extra', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Extra class name', 'milu' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'milu' ),
					'group' => esc_html__( 'Extra', 'milu' ),
				),
			),
			//),

			// 	array(
			// 		'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
			// 		'param_name' => 'inline_style',
			// 		'type' => 'wvc_textfield',
			// 		//'admin_label' => true,
			// 	),
			// ),
		//)
	)
);

class WPBakeryShortCode_Wvc_Product_Index extends WPBakeryShortCode {}

} // end WC check

if ( class_exists( 'Wolf_Videos' ) ) {
/**
 * Videos Loop Module
 */
vc_map(
	array(
		'name' => esc_html__( 'Videos', 'milu' ),
		'description' => esc_html__( 'Display your videos using the theme layouts', 'milu' ),
		'base' => 'wvc_video_index',
		'category' => esc_html__( 'Content' , 'milu' ),
		'icon' => 'fa fa-th',
		'weight' => 999,
		'params' =>
		//array_merge(
			array(

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Index ID', 'milu' ),
					'value' => 'index-' . rand( 0,99999 ),
					'param_name' => 'el_id',
					'description' => esc_html__( 'A unique identifier for the post module (required).', 'milu' ),
				),

				array(
					'heading' => esc_html__( 'Show video on hover', 'milu' ),
					'param_name' => 'video_preview',
					'type' => 'checkbox',
					'admin_label' => true,
					'value' => 'yes',
					'dependency' => array( 'element' => 'video_module', 'value' => array( 'grid' ) ),
				),

				array(
					'param_name' => 'video_module',
					'heading' => esc_html__( 'Module', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Grid', 'milu' ) => 'grid',
						esc_html__( 'Carousel', 'milu' ) => 'carousel',
					),
					'admin_label' => true,
					//'dependency' => array( 'element' => 'video_display', 'value' => array( 'grid' ) ),
				),

				array(
					'param_name' => 'grid_padding',
					'heading' => esc_html__( 'Padding', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Yes', 'milu' ) => 'yes',
						esc_html__( 'No', 'milu' ) => 'no',
					),
					'admin_label' => true,
				),

				array(
					'param_name' => 'video_onclick',
					'heading' => esc_html__( 'On Click', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Open Video in Lightbox', 'milu' ) => 'lightbox',
						esc_html__( 'Go to the Video Page', 'milu' ) => 'default',
					),
					'admin_label' => true,
					//'dependency' => array( 'element' => 'video_display', 'value' => array( 'grid' ) ),
				),

				array(
					'heading' => esc_html__( 'Category Filter', 'milu' ),
					'param_name' => 'video_category_filter',
					'type' => 'checkbox',
					'admin_label' => true,
					'description' => esc_html__( 'The pagination will be disabled.', 'milu' ),
					'dependency' => array( 'element' => 'video_module', 'value' => array( 'grid' ) ),
				),

				array(
					'heading' => esc_html__( 'Filter Text Alignement', 'milu' ),
					'param_name' => 'video_category_filter_text_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Center', 'milu' ) => 'center',
						esc_html__( 'Left', 'milu' ) => 'left',
						esc_html__( 'Right', 'milu' ) => 'right',
					),
					'dependency' => array(
						'element' => 'video_category_filter',
						'value' => array( 'true' ),
					),
				),

				array(
					'heading' => esc_html__( 'Animation', 'milu' ),
					'param_name' => 'item_animation',
					'type' => 'dropdown',
					'value' => array_flip( milu_get_animations() ),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Number of Posts', 'milu' ),
					'param_name' => 'posts_per_page',
					'type' => 'wvc_textfield',
					//'placeholder' => get_option( 'posts_per_page' ),
					'description' => esc_html__( 'Leave empty to display all post at once.', 'milu' ),
					//'std' => '-1',
					'admin_label' => true,
				),

				array(
					'param_name' => 'pagination',
					'heading' => esc_html__( 'Pagination', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'None', 'milu' ) => 'none',
						esc_html__( 'Load More', 'milu' ) => 'load_more',
						esc_html__( 'Numeric Pagination', 'milu' ) => 'standard_pagination',
						esc_html__( 'Link to Video Archives', 'milu' ) => 'link_to_videos',
					),
					// 'dependency' => array(
					// 	'element' => 'video_category_filter',
					// 	'not_equal_to' => array( true )
					// ),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
					'param_name' => 'inline_style',
					'type' => 'wvc_textfield',
					//'admin_label' => true,
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Include Category', 'milu' ),
					'param_name' => 'video_type_include',
					'description' => esc_html__( 'Enter one or several categories. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-category, other-category', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Category', 'milu' ),
					'param_name' => 'video_type_exclude',
					'description' => esc_html__( 'Enter one or several categories. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-category, other-category', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Include Tag', 'milu' ),
					'param_name' => 'video_tag_include',
					'description' => esc_html__( 'Enter one or several tags. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-tag, other-tag', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Tag', 'milu' ),
					'param_name' => 'video_tag_exclude',
					'description' => esc_html__( 'Enter one or several tags. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-tag, other-tag', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Offset', 'milu' ),
					'description' => esc_html__( '.', 'milu' ),
					'param_name' => 'offset',
					'description' => esc_html__( 'The amount of posts that should be skipped in the beginning of the query.', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'milu' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Select how to sort retrieved posts. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Sort order', 'milu' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Designates the ascending or descending order. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Post IDs', 'milu' ),
					'description' => esc_html__( 'By default, your last posts will be displayed. You can choose the posts you want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'include_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Post IDs', 'milu' ),
					'description' => esc_html__( 'You can choose the posts you don\'t want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'exclude_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'param_name' => 'columns',
					'heading' => esc_html__( 'Columns', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Auto', 'milu' ) => 'default',
						esc_html__( 'Two', 'milu' ) => 2,
						esc_html__( 'Three', 'milu' ) => 3,
						esc_html__( 'Four', 'milu' ) => 4,
						esc_html__( 'Five', 'milu' ) => 5,
						esc_html__( 'Six', 'milu' ) => 6,
						esc_html__( 'One', 'milu' ) => 1,
					),
					'std' => 'default',
					'admin_label' => true,
					'description' => esc_html__( 'By default, columns are set automatically depending on the container\'s width. Set a column count here to overwrite the default behavior.', 'milu' ),
					'dependency' => array(
						'element' => 'post_display',
						'value_not_equal_to' => array( 'standard', 'standard_modern' ),
					),
					'group' => esc_html__( 'Extra', 'milu' ),
				),
			),
			//),

			// 	array(
			// 		'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
			// 		'param_name' => 'inline_style',
			// 		'type' => 'wvc_textfield',
			// 		//'admin_label' => true,
			// 	),
			// ),
		//)
	)
);

class WPBakeryShortCode_Wvc_Video_Index extends WPBakeryShortCode {}
} // end Videos plugin check

if ( class_exists( 'Wolf_Portfolio' ) ) {

/**
 * Work Loop Module
 */
vc_map(
	array(
		'name' => esc_html__( 'Works', 'milu' ),
		'description' => esc_html__( 'Display your works using the theme layouts', 'milu' ),
		'base' => 'wvc_work_index',
		'category' => esc_html__( 'Content' , 'milu' ),
		'icon' => 'fa fa-th',
		'weight' => 999,
		'params' =>
		//array_merge(
			array(

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Index ID', 'milu' ),
					'value' => 'index-' . rand( 0,99999 ),
					'param_name' => 'el_id',
					'description' => esc_html__( 'A unique identifier for the post module (required).', 'milu' ),
				),

				array(
					'param_name' => 'work_display',
					'heading' => esc_html__( 'Work Display', 'milu' ),
					'type' => 'dropdown',
					'value' => array_flip( apply_filters( 'milu_work_display_options', array(
						'grid' => esc_html__( 'Grid', 'milu' ),
					) ) ),
					'admin_label' => true,
				),

				array(
					'param_name' => 'work_metro_pattern',
					'heading' => esc_html__( 'Metro Pattern', 'milu' ),
					'type' => 'dropdown',
					'value' => milu_get_metro_patterns(),
					'std' => 'auto',
					'dependency' => array( 'element' => 'work_display', 'value' => array( 'metro' ) ),
					'admin_label' => true,
				),

				array(
					'param_name' => 'work_module',
					'heading' => esc_html__( 'Module', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Grid', 'milu' ) => 'grid',
						esc_html__( 'Carousel', 'milu' ) => 'carousel',
					),
					'admin_label' => true,
					'dependency' => array(
						'element' => 'work_display',
						'value' => array( 'grid' )
					),
				),

				array(
					'param_name' => 'work_thumbnail_size',
					'heading' => esc_html__( 'Thumbnail Size', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Default Thumbnail', 'milu' ) => 'standard',
						esc_html__( 'Landscape', 'milu' ) => 'landscape',
						esc_html__( 'Square', 'milu' ) => 'square',
						esc_html__( 'Portrait', 'milu' ) => 'portrait',
					),
					'admin_label' => true,
					'dependency' => array(
						'element' => 'work_display',
						'value' => array( 'grid' ),
						// value_not_equal_to
					),
				),

				array(
					'param_name' => 'work_layout',
					'heading' => esc_html__( 'Layout', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Classic', 'milu' ) => 'standard',
						esc_html__( 'Overlay', 'milu' ) => 'overlay',
						//esc_html__( 'Flip Box', 'milu' ) => 'flip-box',
					),
					'admin_label' => true,
					'dependency' => array(
						'element' => 'work_display',
						'value_not_equal_to' => array( 'list_minimal', 'text-background', 'parallax' )
					),
				),

				array(
					'param_name' => 'grid_padding',
					'heading' => esc_html__( 'Padding', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Yes', 'milu' ) => 'yes',
						esc_html__( 'No', 'milu' ) => 'no',
					),
					'admin_label' => true,
					'dependency' => array( 'element' => 'work_layout', 'value' => array( 'overlay', 'flip-box' ) ),
				),

				/*array(
					'heading' => esc_html__( 'Caption Text Alignement', 'milu' ),
					'param_name' => 'caption_text_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Left', 'milu' ) => 'left',
						esc_html__( 'Center', 'milu' ) => 'center',
						esc_html__( 'Right', 'milu' ) => 'right',
					),
					'dependency' => array(
						'element' => 'work_display',
						'value_not_equal_to' => array( 'list_minimal', 'text-background' )
					),
				),

				array(
					'heading' => esc_html__( 'Caption Vertical Alignement', 'milu' ),
					'param_name' => 'caption_v_align',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Bottom', 'milu' ) => 'bottom',
						esc_html__( 'Middle', 'milu' ) => 'middle',
						esc_html__( 'Top', 'milu' ) => 'top',
					),
					'dependency' => array(
						'element' => 'work_display',
						'value_not_equal_to' => array( 'list_minimal', 'text-background' )
					),
				),*/

				/*array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Overlay Color', 'milu' ),
					'param_name' => 'overlay_color',
					'value' => array_merge(
							array( esc_html__( 'Auto', 'milu' ) => 'auto', ),
							$shared_gradient_colors,
							$shared_colors,
							array( esc_html__( 'Custom color', 'milu' ) => 'custom', )
					),
					'std' => apply_filters( 'wvc_default_item_overlay_color', 'black' ),
					'description' => esc_html__( 'Select an overlay color.', 'milu' ),
					'param_holder_class' => 'wvc_colored-dropdown',
					'dependency' => array( 'element' => 'work_layout', 'value' => array( 'overlay', 'flip-box' ) ),
				),

				// Overlay color
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Overlay Custom Color', 'milu' ),
					'param_name' => 'overlay_custom_color',
					//'value' => '#000000',
					'dependency' => array( 'element' => 'overlay_color', 'value' => array( 'custom' ), ),
				),*/

				// Overlay opacity
				/*array(
					'type' => 'wvc_numeric_slider',
					'heading' => esc_html__( 'Overlay Opacity in Percent', 'milu' ),
					'param_name' => 'overlay_opacity',
					'description' => '',
					'value' => 40,
					'min' => 5,
					'max' => 100,
					'step' => 5,
					'std' => apply_filters( 'wvc_default_item_overlay_opacity', 40 ),
					'dependency' => array( 'element' => 'work_layout', 'value' => array( 'overlay', 'flip-box' ), ),
				),*/

			/*	array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Overlay Text Color', 'milu' ),
					'param_name' => 'overlay_text_color',
					'value' => array_merge(
						$shared_colors,
						$shared_gradient_colors,
						array( esc_html__( 'Custom color', 'milu' ) => 'custom', )
					),
					'std' => apply_filters( 'wvc_default_item_overlay_text_color', 'white' ),
					'description' => esc_html__( 'Select an overlay color.', 'milu' ),
					'param_holder_class' => 'wvc_colored-dropdown',
					'dependency' => array( 'element' => 'work_layout', 'value' => array( 'overlay', 'flip-box' ) ),
				),*/

				// Overlay color
				/*array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Overlay Custom Text Color', 'milu' ),
					'param_name' => 'overlay_text_custom_color',
					//'value' => '#000000',
					'dependency' => array( 'element' => 'overlay_text_color', 'value' => array( 'custom' ), ),
				),*/

				array(
					'heading' => esc_html__( 'Category Filter', 'milu' ),
					'param_name' => 'work_category_filter',
					'type' => 'checkbox',
					'description' => esc_html__( 'The pagination will be disabled.', 'milu' ),
					'admin_label' => true,
					'dependency' => array(
						'element' => 'work_display',
						'value_not_equal_to' => array( 'list_minimal', 'text-background', 'parallax' )
					),
				),

				array(
					'heading' => esc_html__( 'Filter Text Alignement', 'milu' ),
					'param_name' => 'work_category_filter_text_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Center', 'milu' ) => 'center',
						esc_html__( 'Left', 'milu' ) => 'left',
						esc_html__( 'Right', 'milu' ) => 'right',
					),
					'dependency' => array(
						'element' => 'work_category_filter',
						'value' => array( 'true' ),
					),
				),

				array(
					'heading' => esc_html__( 'Animation', 'milu' ),
					'param_name' => 'item_animation',
					'type' => 'dropdown',
					'value' => array_flip( milu_get_animations() ),
					'admin_label' => true,
				),

				array(
					'heading' => esc_html__( 'Number of Posts', 'milu' ),
					'param_name' => 'posts_per_page',
					'type' => 'wvc_textfield',
					//'placeholder' => get_option( 'posts_per_page' ),
					'description' => esc_html__( 'Leave empty to display all post at once.', 'milu' ),
					//'std' => '-1',
					'admin_label' => true,
				),

				array(
					'param_name' => 'pagination',
					'heading' => esc_html__( 'Pagination', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'None', 'milu' ) => 'none',
						esc_html__( 'Load More', 'milu' ) => 'load_more',
						esc_html__( 'Link to Portfolio', 'milu' ) => 'link_to_portfolio',
					),
					'admin_label' => true,
					'dependency' => array( 'element' => 'work_module', 'value' => array( 'grid' ) ),
				),

				array(
					'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
					'param_name' => 'inline_style',
					'type' => 'wvc_textfield',
					//'admin_label' => true,
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Include Category', 'milu' ),
					'param_name' => 'work_type_include',
					'description' => esc_html__( 'Enter one or several categories. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-category, other-category', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Category', 'milu' ),
					'param_name' => 'work_type_exclude',
					'description' => esc_html__( 'Enter one or several categories. Paste category slug(s) separated by a comma', 'milu' ),
					'placeholder' => esc_html__( 'my-category, other-category', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Offset', 'milu' ),
					'description' => esc_html__( '.', 'milu' ),
					'param_name' => 'offset',
					'description' => esc_html__( 'The amount of posts that should be skipped in the beginning of the query.', 'milu' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Order by', 'milu' ),
					'param_name' => 'orderby',
					'value' => $order_by_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Select how to sort retrieved posts. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Sort order', 'milu' ),
					'param_name' => 'order',
					'value' => $order_way_values,
					'save_always' => true,
					'description' => sprintf( wp_kses_post( __( 'Designates the ascending or descending order. More at %s.', 'milu' ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Post IDs', 'milu' ),
					'description' => esc_html__( 'By default, your last posts will be displayed. You can choose the posts you want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'include_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Exclude Post IDs', 'milu' ),
					'description' => esc_html__( 'You can choose the posts you don\'t want to display by entering a list of IDs separated by a comma.', 'milu' ),
					'param_name' => 'exclude_ids',
					'group' => esc_html__( 'Query', 'milu' ),
				),

				array(
					'param_name' => 'columns',
					'heading' => esc_html__( 'Columns', 'milu' ),
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Auto', 'milu' ) => 'default',
						esc_html__( 'Two', 'milu' ) => 2,
						esc_html__( 'Three', 'milu' ) => 3,
						esc_html__( 'Four', 'milu' ) => 4,
						esc_html__( 'Five', 'milu' ) => 5,
						esc_html__( 'Six', 'milu' ) => 6,
						esc_html__( 'One', 'milu' ) => 1,
					),
					'std' => 'default',
					'admin_label' => true,
					'description' => esc_html__( 'By default, columns are set automatically depending on the container\'s width. Set a column count here to overwrite the default behavior.', 'milu' ),
					'dependency' => array(
						'element' => 'post_display',
						'value_not_equal_to' => array( 'standard', 'standard_modern' ),
					),
					'group' => esc_html__( 'Extra', 'milu' ),
				),

				array(
					'type' => 'wvc_textfield',
					'heading' => esc_html__( 'Extra class name', 'milu' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'milu' ),
					'group' => esc_html__( 'Extra', 'milu' ),
				),
			),
			//),

			// 	array(
			// 		'heading' => esc_html__( 'Additional CSS inline style', 'milu' ),
			// 		'param_name' => 'inline_style',
			// 		'type' => 'wvc_textfield',
			// 		//'admin_label' => true,
			// 	),
			// ),
		//)
	)
);

class WPBakeryShortCode_Wvc_Work_Index extends WPBakeryShortCode {}
} // end Portfolio plugin check