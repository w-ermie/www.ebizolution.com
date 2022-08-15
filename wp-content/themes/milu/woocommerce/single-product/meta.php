<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$sku = '';

if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
	ob_start(); ?>
	<span class="sku_wrapper detail-container"><span class="detail-label"><?php esc_html_e( 'SKU', 'milu' ); ?></span> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'milu' ); ?></span></span>
	<?php
	$sku = ob_get_clean();
}

$category = wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in detail-container"><span class="detail-label">' . _n( 'Category', 'Categories', count( $product->get_category_ids() ), 'milu' ) . '</span>', '</span>' );

$tags = wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as detail-container"><span class="detail-label">' . _n( 'Tag', 'Tags', count( $product->get_tag_ids() ), 'milu' ) . '</span>', '</span>' );

if ( $sku || $category || $tags ) {
	echo '<hr>'; // add separator if we got product meta
}

?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php echo milu_kses( $sku ); ?>
	<?php echo milu_kses( $category ); ?>
	<?php echo milu_kses( $tags ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
</div><!-- .product_meta -->

<?php if ( milu_is_wishlist() && apply_filters( 'milu_show_single_product_wishlist_button', true ) ) : // backward compat ?>
	<hr>
	<div class="single-add-to-wishlist">
		<span class="single-add-to-wishlist-label"><?php esc_html_e( 'Wishlist', 'milu' ); ?></span>
		<?php milu_add_to_wishlist(); ?>
	</div><!-- .single-add-to-wishlist -->
<?php endif; ?>

