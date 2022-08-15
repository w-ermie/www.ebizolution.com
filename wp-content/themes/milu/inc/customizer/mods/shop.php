<?php
/**
 * Milu shop
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

function milu_set_product_mods( $mods ) {

	if ( class_exists( 'WooCommerce' ) ) {
		$mods['shop'] = array(
			'id' => 'shop',
			'title' => esc_html__( 'Shop', 'milu' ),
			'icon' => 'cart',
			'options' => array(

				'product_layout' => array(
					'id' => 'product_layout',
					'label' => esc_html__( 'Products Layout', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'standard' => esc_html__( 'Standard', 'milu' ),
						'sidebar-right' => esc_html__( 'Sidebar at right', 'milu' ),
						'sidebar-left' => esc_html__( 'Sidebar at left', 'milu' ),
						'fullwidth' => esc_html__( 'Full width', 'milu' ),
					),
					'transport' => 'postMessage',
				),

				'product_display' => array(
					'id' =>'product_display',
					'label' => esc_html__( 'Products Archive Display', 'milu' ),
					'type' => 'select',
					'choices' => apply_filters( 'milu_product_display_options', array(
						'grid_classic' => esc_html__( 'Grid', 'milu' ),
					) ),
				),
				'product_single_layout' => array(
					'id' => 'product_single_layout',
					'label' => esc_html__( 'Single Product Layout', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'standard' => esc_html__( 'Standard', 'milu' ),
						'sidebar-right' => esc_html__( 'Sidebar at right', 'milu' ),
						'sidebar-left' => esc_html__( 'Sidebar at left', 'milu' ),
						'fullwidth' => esc_html__( 'Full Width', 'milu' ),
					),
					'transport' => 'postMessage',
				),

				'product_columns' => array(
					'id' => 'product_columns',
					'label' => esc_html__( 'Columns', 'milu' ),
					'type' => 'select',
					'choices' => array(
						'default' => esc_html__( 'Auto', 'milu' ),
						3 => 3,
						2 => 2,
						4 => 4,
						6 => 6,
					),
				),

				'product_item_animation' => array(
					'label' => esc_html__( 'Shop Archive Item Animation', 'milu' ),
					'id' => 'product_item_animation',
					'type' => 'select',
					'choices' => milu_get_animations(),
				),

				'product_zoom' => array(
					'label' => esc_html__( 'Single Product Zoom', 'milu' ),
					'id' => 'product_zoom',
					'type' => 'checkbox',
				),

				'related_products_carousel' => array(
					'label' => esc_html__( 'Related Products Carousel', 'milu' ),
					'id' => 'related_products_carousel',
					'type' => 'checkbox',
				),

				'cart_menu_item' => array(
					'label' => esc_html__( 'Add a "Cart" Menu Item', 'milu' ),
					'id' => 'cart_menu_item',
					'type' => 'checkbox',
				),

				'account_menu_item' => array(
					'label' => esc_html__( 'Add a "Account" Menu Item', 'milu' ),
					'id' => 'account_menu_item',
					'type' => 'checkbox',
				),

				'shop_search_menu_item' => array(
					'label' => esc_html__( 'Search Menu Item', 'milu' ),
					'id' => 'shop_search_menu_item',
					'type' => 'checkbox',
				),

				'products_per_page' => array(
					'label' => esc_html__( 'Products per Page', 'milu' ),
					'id' => 'products_per_page',
					'type' => 'text',
					'placeholder' => 12,
				),
			),
		);
	}

	if ( class_exists( 'Wolf_WooCommerce_Wishlist' ) && class_exists( 'WooCommerce' ) ) {
		$mods['shop']['options']['wishlist_menu_item'] = array(
				'label' => esc_html__( 'Wishlist Menu Item', 'milu' ),
				'id' => 'wishlist_menu_item',
				'type' => 'checkbox',
		);
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_set_product_mods' );