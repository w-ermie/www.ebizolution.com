<?php
/**
 * The product content displayed in the loop for the "grid" display
 *
 * The grid display contains only hooks so we can do whatever we want in it
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$classes = array();

/* Related product default class */
if ( is_singular( 'product' ) ) {
	$classes = array( 'entry-product entry-product-metro', 'entry-columns-default' );
} else {
	$columns = milu_get_theme_mod( 'product_columns', 'default' );
	$classes = array( $columns );
}

$template_args = get_query_var( 'template_args' );
?>
<article <?php milu_post_attr( $classes ); ?>>
	<div class="entry-box">
		<div class="entry-outer">
			<div class="entry-container">
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop_item.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item', $template_args );

				/**
				 * Hook: woocommerce_before_shop_loop_item_title.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );

				/**
				 * Hook: woocommerce_shop_loop_item_title.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * Hook: woocommerce_after_shop_loop_item_title.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );

				/**
				 * Hook: woocommerce_after_shop_loop_item.
				 *
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item', $template_args );
				?>
			</div><!-- .entry-container -->
		</div><!-- .entry-outer -->
	</div><!-- .entry-box -->
</article><!-- #post-## -->