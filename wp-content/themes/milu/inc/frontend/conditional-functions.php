<?php
/**
 * Milu conditional functions
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Check if we can display the sidepanel
 */
function milu_can_display_sidepanel() {
	$menu_panel_mod = milu_get_theme_mod( 'side_panel_position' );
	$menu_panel_meta = get_post_meta( milu_get_inherit_post_id(), '_post_side_panel_position', true );
	$excluded_menu_layout = apply_filters( 'milu_excluded_side_panel_menu_layout', array( 'offcanvas', 'lateral', 'overlay' ) );

	$bool = true;

	if ( ! is_active_sidebar( 'sidebar-side-panel' ) ) {
		$bool = false;
	}

	if ( ( 'none' === $menu_panel_mod || ! $menu_panel_mod ) && ! $menu_panel_meta ) {
		$bool = false;
	}

	/* Be sure to not display the side panel if metabox option is set to none */
	if ( 'none' === $menu_panel_meta ) {
		$bool = false;
	}

	if ( in_array( milu_get_inherit_mod( 'menu_layout' ), $excluded_menu_layout ) ) {
		$bool = false;
	}

	return apply_filters( 'milu_display_sidepanel', $bool );
}

/**
 * Check if we should display the search menu item
 */
function milu_display_shop_search_menu_item() {
	return milu_get_theme_mod( 'shop_search_menu_item' );
}

/**
 * Check if we should display the cart menu item
 */
function milu_display_cart_menu_item() {
	return milu_is_woocommerce() && milu_get_theme_mod( 'cart_menu_item' );
}

/**
 * Check if we should display the account menu item
 */
function milu_display_account_menu_item() {
	return milu_is_woocommerce() && milu_get_theme_mod( 'account_menu_item' );
}

/**
 * Check if we should display the wishlist menu item
 */
function milu_display_wishlist_menu_item() {
	return milu_is_wishlist() && milu_get_theme_mod( 'wishlist_menu_item' );
}

/**
 * Check if there is a main menu to display
 *
 * @return bool
 */
function milu_is_main_menu() {
	$has_menu = has_nav_menu( 'primary' );
	$has_logo = milu_get_theme_mod( 'logo_svg' ) || milu_get_theme_mod( 'logo_light' ) || milu_get_theme_mod( 'logo_dark' );
	return $has_menu || $has_logo;
}

/**
 * Is Woocommerce activated?
 *
 * @return bool
 */
function milu_is_woocommerce() {
	return ( class_exists( 'WooCommerce' ) );
}

/**
 * Is Wolf Woocommerce Wishlist activated?
 *
 * @return bool
 */
function milu_is_wishlist() {
	return ( class_exists( 'Wolf_WooCommerce_Wishlist' ) && class_exists( 'WooCommerce' ) );
}

/**
 * Check if we are on a woocommerce page
 *
 * @return bool
 */
function milu_is_woocommerce_page() {

	if ( class_exists( 'WooCommerce' ) ) {

		if ( is_woocommerce() ) {
			return true;
		}

		if ( is_shop() ) {
			return true;
		}

		if ( is_checkout() || is_order_received_page() ) {
			return true;
		}

		if ( is_cart() ) {
			return true;
		}

		if ( is_account_page() ) {
			return true;
		}

		if ( function_exists( 'wolf_wishlist_get_page_id' ) && is_page( wolf_wishlist_get_page_id() ) ) {
			return true;
		}
	}
}

/**
 * Check if we're on a post archive page
 *
 * Used for pagination to know if you can use the standard pagination links
 */
function milu_is_post_type_archive( $post_type = null ) {

	$is_blog = milu_is_blog();
	$is_portfolio = milu_is_portfolio();
	$is_shop = ( function_exists( 'is_shop' ) ) ? is_shop() : false;

	return $is_blog || $is_portfolio || $is_shop;
}

/**
 * Check if WPBakery Page Builder Extension is used on this page
 *
 * @param
 * @return
 */
function milu_is_vc() {

	if ( function_exists( 'wvc_is_vc' ) ) {
		return wvc_is_vc();
	}
}

/**
 * Check if we are in the customizer previes
 *
 * @return bool
 */
function milu_is_customizer() {

	global $wp_customize;
	if ( isset( $wp_customize ) ) {
		return true;
	}
}

/**
 * Check if a hero background is set
 *
 * @return bool
 */
function milu_has_hero() {

	if ( function_exists( 'is_product_category' ) && is_product_category() && get_term_meta( get_queried_object()->term_id, 'thumbnail_id', true ) ) {
		return true;
	}

	$post_type = get_post_type();
	$hero_bg_type = milu_get_inherit_mod( 'hero_background_type', 'featured-image' );

	$no_hero_post_types = apply_filters( 'milu_no_header_post_types', array( 'product', 'release', 'event', 'proof_gallery', 'attachment' ) );

	if ( is_single() && in_array( $post_type, $no_hero_post_types ) ) {
		return false;
	}

	if ( milu_is_home_as_blog() && get_header_image() ) {
		return true;

	} elseif ( milu_get_hero_background() ) {
		return true;
	}

	if ( 'transparent' === milu_get_inherit_mod( 'menu_style' ) && 'none' === milu_get_inherit_mod( 'hero_layout' ) ) {
		return true;
	}
}

/**
 * Check if we're on a portfolio page
 *
 * @return bool
 */
function milu_is_portfolio() {

	return function_exists( 'wolf_portfolio_get_page_id' ) && is_page( wolf_portfolio_get_page_id() ) || is_tax( 'work_type' );
}

/**
 * Check if we're on a albums page
 *
 * @return bool
 */
function milu_is_albums() {

	return function_exists( 'wolf_albums_get_page_id' ) && is_page( wolf_albums_get_page_id() ) || is_tax( 'gallery_type' );
}

/**
 * Check if we're on a photos page
 *
 * @return bool
 */
function milu_is_photos() {

	if ( function_exists( 'milu_is_photos_page' ) ) {
		return milu_is_photos_page();
	}
}

/**
 * Check if we're on a videos page
 *
 * @return bool
 */
function milu_is_videos() {

	return function_exists( 'wolf_videos_get_page_id' ) && is_page( wolf_videos_get_page_id() ) || is_tax( 'video_type' ) || is_tax( 'video_tag' );
}

/**
 * Check if we're on a events page
 *
 * @return bool
 */
function milu_is_events() {

	return function_exists( 'wolf_events_get_page_id' ) && is_page( wolf_events_get_page_id() ) || is_tax( 'we_artist' );
}

/**
 * Check if we're on a artists page
 *
 * @return bool
 */
function milu_is_artists() {

	return function_exists( 'wolf_artists_get_page_id' ) && is_page( wolf_artists_get_page_id() ) || is_tax( 'artist_genre' );
}


/**
 * Check if we're on a plugins page
 *
 * @return bool
 */
function milu_is_plugins() {

	return function_exists( 'wolf_plugins_get_page_id' ) && is_page( wolf_plugins_get_page_id() ) || is_tax( 'plugin_cat' ) || is_tax( 'plugin_tag' );
}

/**
 * Check if we're on a themes page
 *
 * @return bool
 */
function milu_is_themes() {

	return function_exists( 'wolf_themes_get_page_id' ) && is_page( wolf_themes_get_page_id() ) || is_tax( 'themes_cat' ) || is_tax( 'themes_tag' );
}

/**
 * Check if we're on a discography page
 *
 * @return bool
 */
function milu_is_discography() {

	return function_exists( 'wolf_discography_get_page_id' ) && is_page( wolf_discography_get_page_id() ) || is_tax( 'label' ) || is_tax( 'band' );
}

/**
 * Do masonry
 *
 * @return bool
 */
function milu_do_masonry() {

	$blog_masonry_display = array( 'masonry', 'metro', 'metro_modern' );
	$portfolio_masonry_display = array( 'masonry', 'metro' );

	$return = false;

	if ( milu_is_blog() ) {

		$return = in_array( milu_get_theme_mod( 'post_display' ), $blog_masonry_display );

	} elseif ( milu_is_portfolio() ) {

		$return = in_array( milu_get_theme_mod( 'work_display' ), $portfolio_masonry_display );
	}

	return $return;
}

/**
 * Do packery (metro layout)
 *
 * @return bool
 */
function milu_do_packery() {

	if ( milu_is_blog() ) {

		return 'metro' === milu_get_theme_mod( 'post_display' ) || 'metro_modern' === milu_get_theme_mod( 'post_display' );

	} elseif ( milu_is_portfolio() ) {

		return 'metro' === milu_get_theme_mod( 'work_display' );

	} elseif ( milu_is_albums() ) {

		return 'metro' === milu_get_theme_mod( 'gallery_display' );
	}
}

/**
 * Is AJAX navigation enabled?
 *
 * @return bool
 */
function milu_do_ajax_nav() {

	$ajax_mod = milu_get_theme_mod( 'ajax_nav' );
	return apply_filters( 'milu_do_ajax_nav', $ajax_mod );
}

/**
 * Check if post format is status, aside, quote or link
 *
 * @return bool
 */
function milu_is_short_post_format() {

	$short_format = array( 'aside', 'status', 'quote', 'link' );

	return in_array( get_post_format(), $short_format );
}

/**
 * Check if we need to display the sidebar depending on context
 *
 * @return bool
 */
function milu_display_sidebar() {
	global $wp_customize;

	$post_id = milu_get_the_ID();

	$is_customizer = ( isset( $wp_customize ) ) ? true : false;

	$is_right_post_type = ! is_singular( 'show' );

	$blog_layout = milu_is_blog() && ( 'sidebar-left' === milu_get_theme_mod( 'post_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'post_layout' ) );

	$shop_layout = ! is_singular( 'product' ) && milu_is_woocommerce_page() && ( 'sidebar-left' === milu_get_theme_mod( 'product_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'product_layout' ) );

	$product_layout = is_singular( 'product' ) && ( 'sidebar-left' === milu_get_inherit_mod( 'single_product_layout' ) || 'sidebar-right' === milu_get_inherit_mod( 'single_product_layout' ) );

	$disco_layout = milu_is_discography() && ( 'sidebar-left' === milu_get_theme_mod( 'release_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'release_layout' ) );

	$videos_layout = milu_is_videos() && ( 'sidebar-left' === milu_get_theme_mod( 'video_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'video_layout' ) );

	$portfolio_layout = milu_is_portfolio() && ( 'sidebar-left' === milu_get_theme_mod( 'work_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'work_layout' ) );

	$albums_layout = milu_is_albums() && ( 'sidebar-left' === milu_get_theme_mod( 'gallery_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'gallery_layout' ) );

	$events_layout = milu_is_events() && ( 'sidebar-left' === milu_get_theme_mod( 'event_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'event_layout' ) );

	$artists_layout = milu_is_artists() && ( 'sidebar-left' === milu_get_theme_mod( 'artist_layout' ) || 'sidebar-right' === milu_get_theme_mod( 'artist_layout' ) );

	$single_post_layout = milu_get_single_post_layout( $post_id );
	$is_single_sidebar = is_singular( 'post' ) && ( ( 'sidebar-left' === $single_post_layout ) || ( 'sidebar-right' === $single_post_layout ) );

	$single_video_layout = milu_get_single_video_layout( $post_id );
	$is_single_video_sidebar = is_singular( 'video' ) && ( ( 'sidebar-left' === $single_video_layout ) || ( 'sidebar-right' === $single_video_layout ) && ! milu_is_vc() );

	$single_artist_layout = milu_get_single_artist_layout( $post_id );
	$is_single_artist_sidebar = is_singular( 'artist' ) && ( ( 'sidebar-left' === $single_artist_layout ) || ( 'sidebar-right' === $single_artist_layout ) && ! milu_is_vc() );

	$single_mp_event_layout = milu_get_single_mp_event_layout( $post_id );
	$is_single_mp_event_sidebar = is_singular( 'mp-event' ) && ( ( 'sidebar-left' === $single_mp_event_layout ) || ( 'sidebar-right' === $single_mp_event_layout ) );

	$single_mp_column_layout = milu_get_single_mp_column_layout( $post_id );
	$is_single_mp_column_sidebar = is_singular( 'mp-column' ) && ( ( 'sidebar-left' === $single_mp_column_layout ) || ( 'sidebar-right' === $single_mp_column_layout ) );

	if ( $is_right_post_type ) {
		return $blog_layout || $portfolio_layout || $product_layout || $events_layout || $artists_layout || $shop_layout || $is_customizer || $is_single_sidebar || $is_single_video_sidebar || $is_single_artist_sidebar || $disco_layout || $videos_layout || $albums_layout || $is_single_mp_event_sidebar || $is_single_mp_column_sidebar;
	}
}

/**
 * Check if the default template is used on the current page
 *
 * @return bool
 */
function milu_is_default_template() {
	return ( ! milu_is_vc() && 'page.php' == basename( get_page_template() ) );
}

/**
 * Filter is WVC condition
 */
function milu_wvc_is_vc_page( $bool ) {

	if ( milu_is_blog() || is_search() && ! is_single() ) {
		$bool = false;
	}

	$is_videos_page = function_exists( 'wolf_videos_get_page_id' ) && is_page( wolf_videos_get_page_id() );
	$is_discography_page = function_exists( 'wolf_discography_get_page_id' ) && is_page( wolf_discography_get_page_id() );
	$is_albums_page = function_exists( 'wolf_albums_get_page_id' ) && is_page( wolf_albums_get_page_id() );
	$is_events_page = function_exists( 'wolf_events_get_page_id' ) && is_page( wolf_events_get_page_id() );
	$is_portfolio_page = function_exists( 'wolf_portfolio_get_page_id' ) && is_page( wolf_portfolio_get_page_id() );

	if ( $is_videos_page || $is_discography_page || $is_albums_page || $is_events_page ) {
		$bool = false;
	}

	return $bool;
}
add_filter( 'wvc_is_vc', 'milu_wvc_is_vc_page' );

/**
 * Check if the browser is edge
 *
 * @return bool
 */
function milu_is_edge() {
	global $is_edge;

	return $is_edge;
}

/**
 * Check if the browser is iOS
 *
 * @return bool
 */
function milu_is_iphone() {
	global $is_iphone;

	return $is_iphone;
}

/**
 * Check if we must display a "one-^page" menu
 *
 * @return bool
 */
function milu_do_onepage_menu() {

	if ( is_search() ) {
		return;
	}

	$post_id = get_the_ID();

	$is_wvc = ( class_exists( 'Wolf_Visual_Composer' ) && defined( 'WPB_VC_VERSION' ) );
	$meta = get_post_meta( $post_id, '_post_one_page_menu', true );

	return $is_wvc && $meta;
}

/**
 * Check if easy zoom is enabled on product single page
 *
 * @return boo 
 */
function milu_do_single_product_easyzoom() {

	$bool = milu_get_theme_mod( 'product_zoom' );

	if ( get_post_meta( milu_get_the_ID(), '_post_product_disable_easyzoom', true ) ) {
		$bool = false;
	}

	return apply_filters( 'milu_single_product_zoom', $bool );
}

/**
 * Check if post has Instagram embed
 *
 * @return bool
 */
function milu_is_instagram_post( $post_id = null ) {

	return preg_match( '/instagr/', milu_get_first_url( $post_id ) ) && 'image' === get_post_format( $post_id );
}

/**
 * Check if post has video embed
 *
 * @return bool
 */
function milu_is_video_post( $post_id = null ) {
	return milu_get_first_video_url( $post_id ) && 'video' === get_post_format( $post_id );
}


/**
 * Post thumbnail
 *
 * @return bool
 */
function milu_has_post_thumbnail() {

	return ( milu_post_thumbnail( '', false ) ) ? true : false;
}

/**
 * Check if post has Mixcloud, ReverbNation, SoundCloud or Spotify embed player
 *
 * @return bool
 */
function milu_is_audio_embed_post( $post_id = null ) {
	return preg_match( '/mixcloud/', milu_get_first_url( $post_id ) )
		|| preg_match( '/reverbnation/', milu_get_first_url( $post_id ) )
		|| preg_match( '/soundcloud/', milu_get_first_url( $post_id ) )
		|| preg_match( '/spotify/', milu_get_first_url( $post_id ) );
}

/**
 * Check if single audio player
 *
 * @return bool
 */
function milu_is_single_audio_player() {
	return milu_shortcode_preg_match( 'audio' ) || milu_shortcode_preg_match( 'wvc_audio' );
}

/**
 * Check if single audio player
 *
 * @return bool
 */
function milu_is_playlist_audio_player( $post_id = null ) {
	return milu_is_audio_embed_post( $post_id ) || milu_shortcode_preg_match( 'wvc_audio_embed' ) || milu_shortcode_preg_match( 'wolf_playlist' ) || milu_shortcode_preg_match( 'wvc_playlist' ) || milu_shortcode_preg_match( 'playlist' ) || milu_shortcode_preg_match( 'wolf_jplayer_playlist' );
}

/**
 * Is image a gif?
 *
 * @param int $attachment_id
 * @return bool
 */
function milu_is_gif( $attachment_id ) {

	$ext = strtolower( pathinfo( milu_get_url_from_attachment_id( $attachment_id ), PATHINFO_EXTENSION ) );

	if ( 'gif' === $ext ) {
		return true;
	}
}

/**
 * Is latest post?
 *
 * @param int $post_id
 * @return bool
 */
function milu_is_latest_post( $post_type = 'post', $post_id = null ) {

	$post_id = ( $post_id ) ? abdint( $post_id ) : get_the_ID();
	$latest_post_id = null;
	
	if ( $post_type === 'post' ) {
		
		$args = array(
			'posts_per_page' => 1,
			'post_type' => 'post',
			'post__in'  => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1,
		);

	} else {

		$args = array(
			'numberposts' => 1,
			'post_type' => $post_type,
		);
	}

	$args['meta_key'] = '_thumbnail_id';

	$recent_posts = wp_get_recent_posts( $args, ARRAY_A );

	if ( is_array( $recent_posts ) && isset( $recent_posts[0] ) ) {
		if ( isset( $recent_posts[0]['ID'] ) ) {
			$latest_post_id = absint( $recent_posts[0]['ID'] );
		}
	}

	return ( $post_id === $latest_post_id );
}

/**
 * Do fullPage?
 */
function milu_do_fullpage() {
	return ( function_exists( 'wvc_do_fullpage' ) && wvc_do_fullpage() );
}

/**
 * Maintenance
 */
function milu_is_maintenance_page() {
	
	$wolf_maintenance_settings = get_option( 'wolf_maintenance_settings' );
	$maintenance_page_id = ( isset( $wolf_maintenance_settings[ 'page_id' ] ) ) ? $wolf_maintenance_settings[ 'page_id' ] : null;

	if ( is_page( $maintenance_page_id ) ) {
		return true;
	}
}