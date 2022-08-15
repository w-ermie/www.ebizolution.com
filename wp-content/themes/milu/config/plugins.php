<?php
/**
 * Milu recommended plugins
 *
 * @package WordPress
 * @subpackage Milu
 * @since Milu 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//delete_user_meta( get_current_user_id(), 'tgmpa_dismissed_notice_tgmpa' );

/* Require TGM Plugin Activation class */
include_once( get_template_directory() . '/inc/admin/lib/class-tgm-plugin-activation.php' );

function wolf_theme_register_required_plugins() {

	$plugins = array(

		array(
			'name'    => esc_html__( 'WPBakery Page Builder', 'milu' ),
			'slug'   => 'js_composer',
			'source' => 'js_composer.zip',
			'required' => true,
		),

		array(
			'name'    => esc_html__( 'Slider Revolution', 'milu' ),
			'slug'   => 'revslider',
			'source'   => 'revslider.zip',
			'version' => '5.4.1',
		),

		array(
			'name'    => esc_html__( 'Wolf WPBakery Page Builder Extension', 'milu' ),
			'slug'   => 'wolf-visual-composer',
			'source'   => 'http://plugins.wolfthemes.com/wolf-visual-composer/wolf-visual-composer.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-visual-composer/wolf-visual-composer.zip',
			'required' => true,
		),

		array(
			'name'    => esc_html__( 'Wolf WPBPB Content Blocks', 'milu' ),
			'slug'   => 'wolf-vc-content-block',
			'source'   => 'http://plugins.wolfthemes.com/wolf-vc-content-block/wolf-vc-content-block.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-vc-content-block/wolf-vc-content-block.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf Portfolio', 'milu' ),
			'slug'   => 'wolf-portfolio',
			'source'   => 'http://plugins.wolfthemes.com/wolf-portfolio/wolf-portfolio.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-portfolio/wolf-portfolio.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf Share', 'milu' ),
			'slug'   => 'wolf-share',
			'source'   => 'http://plugins.wolfthemes.com/wolf-share/wolf-share.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-share/wolf-share.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf Twitter', 'milu' ),
			'slug'   => 'wolf-twitter',
			'source'   => 'http://plugins.wolfthemes.com/wolf-twitter/wolf-twitter.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-twitter/wolf-twitter.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf Instagram', 'milu' ),
			'slug'   => 'wolf-gram',
			'source'   => 'http://plugins.wolfthemes.com/wolf-gram/wolf-gram.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-gram/wolf-gram.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf Video Thumbnail Generator', 'milu' ),
			'slug'   => 'wolf-video-thumbnail-generator',
			'source'   => 'http://plugins.wolfthemes.com/wolf-video-thumbnail-generator/wolf-video-thumbnail-generator.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-video-thumbnail-generator/wolf-video-thumbnail-generator.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf Metaboxes', 'milu' ),
			'slug'   => 'wolf-metaboxes',
			'source'   => 'http://plugins.wolfthemes.com/wolf-metaboxes/wolf-metaboxes.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-metaboxes/wolf-metaboxes.zip',
		),

		array(
			'name' 	=> esc_html__( 'WooCommerce', 'milu' ),
			'slug' => 'woocommerce',
		),

		array(
			'name'    => esc_html__( 'Wolf WooCommerce Wishlist', 'milu' ),
			'slug'   => 'wolf-woocommerce-wishlist',
			'source'   => 'http://plugins.wolfthemes.com/wolf-woocommerce-wishlist/wolf-woocommerce-wishlist.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-woocommerce-wishlist/wolf-woocommerce-wishlist.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf WooCommerce Currency Switcher', 'milu' ),
			'slug'   => 'wolf-woocommerce-currency-switcher',
			'source'   => 'http://plugins.wolfthemes.com/wolf-woocommerce-currency-switcher/wolf-woocommerce-currency-switcher.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-woocommerce-currency-switcher/wolf-woocommerce-currency-switcher.zip',
		),

		array(
			'name'    => esc_html__( 'Wolf WooCommerce Quickview', 'milu' ),
			'slug'   => 'wolf-woocommerce-quickview',
			'source'   => 'http://plugins.wolfthemes.com/wolf-woocommerce-quickview/wolf-woocommerce-quickview.zip',
			'external_url' => 'http://plugins.wolfthemes.com/wolf-woocommerce-quickview/wolf-woocommerce-quickview.zip',
		),

		array(
			'name' 	=> esc_html__( 'WooCommerce Variation Swatches', 'milu' ),
			'slug' => 'variation-swatches-for-woocommerce',
		),

		array(
			'name' 	=> esc_html__( 'Contact Form 7', 'milu' ),
			'slug' => 'contact-form-7',
		),

		array(
			'name' => esc_html__( 'Envato Market Items Updater', 'milu' ),
			'slug' => 'envato-market',
			'source' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
			'external_url' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
		),

		array(
			'name' => esc_html__( 'One Click Demo Import', 'milu' ),
			'slug' => 'one-click-demo-import',
		),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'milu';

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id' => 'tgmpa',
		'default_path' => get_template_directory() . '/config/plugins/',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'wolf_theme_register_required_plugins' );