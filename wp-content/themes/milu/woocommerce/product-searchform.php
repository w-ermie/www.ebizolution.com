<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$s = ( isset( $_GET['s'] ) ) ? esc_attr( $_GET['s'] ) : '';
?>

<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<input type="search" class="search-field" placeholder="<?php echo apply_filters( 'milu_product_searchform_placeholder', esc_attr_x( 'Search Products&hellip;', 'placeholder', 'milu' ) ); ?>" value="<?php echo esc_attr( $s ); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'milu' ); ?>" />
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'milu' ); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>
