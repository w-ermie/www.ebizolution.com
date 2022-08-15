<?php
/**
 * Milu frontend functions
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output Hero background
 *
 * @return string the hero background markup
 */
function milu_get_hero_background() {

	$hero_bg_type = milu_get_inherit_mod( 'hero_background_type', apply_filters( 'milu_default_hero_background_type', 'featured-image' ) );

	if ( is_404() || 'none' === milu_get_inherit_mod( 'hero_layout' ) || 'none' === $hero_bg_type ) {
		return;
	}

	$post_id = milu_get_inherit_post_id();
	$overlay = milu_get_inherit_mod( 'hero_overlay' );
	$output = '';

	if ( 'image' === $hero_bg_type ) {

		$background_img = get_post_meta( $post_id, '_post_hero_background_img', true );
		$background_img_url = milu_get_url_from_attachment_id( $background_img, 'milu-XL' );
		$background_color = get_post_meta( $post_id, '_post_hero_background_color', true );
		$background_position = get_post_meta( $post_id, '_post_hero_background_position', true );
		$background_repeat = get_post_meta( $post_id, '_post_hero_background_repeat', true );
		$background_size = get_post_meta( $post_id, '_post_hero_background_size', true );
		$background_effect = ( get_post_meta( $post_id, '_post_hero_background_effect', true ) ) ? get_post_meta( $post_id, '_post_hero_background_effect', true ) : milu_get_theme_mod( 'post_header_effect' );

		$img_bg_args = array(
			'background_img' => $background_img,
			'background_color' => $background_color,
			'background_position' => $background_position,
			'background_repeat' => $background_repeat,
			'background_size' => $background_size,
			'background_effect' => $background_effect,
		);

		$output .= milu_background_img( $img_bg_args );

	} elseif ( 'video' === $hero_bg_type ) {

		$video_bg_url = get_post_meta( $post_id, '_post_hero_background_video_url', true );
		$video_image_fallback_id = ( get_post_meta( $post_id, '_post_hero_background_video_img', true ) ) ? get_post_meta( $post_id, '_post_hero_background_video_img', true )  : get_post_thumbnail_id( $post_id );

		$video_bg_args = array(
			'video_bg_url' => $video_bg_url,
			'video_bg_img' => $video_image_fallback_id,
		);

		$output .= milu_background_video( $video_bg_args, true );

	} elseif ( 'slideshow' === $hero_bg_type ) {

		$slideshow_img_ids = get_post_meta( $post_id, '_post_hero_slideshow_ids', true );

		$slideshow_args = array(
			'slideshow_img_ids' => $slideshow_img_ids,
			'slideshow_speed' => 4000,
		);

		$output .= milu_background_slideshow( $slideshow_args );

	} elseif ( 'revslider' === $hero_bg_type && class_exists( 'RevSlider' ) ) {

		$alias = get_post_meta( $post_id, '_post_hero_revslider_alias', true );

		$output .= do_shortcode( '[rev_slider ' . esc_attr( $alias ) . ']' );

	} else {

		if ( milu_is_home_as_blog() || 'featured-image' !== $hero_bg_type ) {

			$bg_img_id = milu_get_hero_image_id();

		} else {
			$bg_img_id = milu_get_featured_image_id( milu_get_inherit_post_id(), true );
		}

		$is_product_taxonomy = function_exists( 'is_product_taxonomy' ) ? is_product_taxonomy() : false;

		if ( $is_product_taxonomy ) {
			$cat = get_queried_object();
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );

			if ( $thumbnail_id ) {
				$bg_img_id = $thumbnail_id;
			}
		}

		$img_bg_args = array(
			'background_img' => $bg_img_id,
			'background_effect' => milu_get_inherit_mod( 'hero_background_effect' ),
		);

		$output .= milu_background_img( $img_bg_args );
	}

	/* Overlay */
	if ( 'none' !== $overlay && $output ) {

		$overlay_style = '';

		if ( 'custom' === $overlay ) {
			$overlay_color = milu_get_inherit_mod( 'hero_overlay_color' );
			$overlay_opacity = milu_get_inherit_mod( 'hero_overlay_opacity' );

			$overlay_style .= 'background-color:' . $overlay_color . ';';
			$overlay_style .= 'opacity:' . absint( $overlay_opacity ) / 100 . ';';
		}

		$output .= '<div id="hero-overlay" style="' . esc_attr( $overlay_style ) . '"></div>';
	}

	return $output;
}

/**
 * Get hero font skin
 *
 * @return string
 */
function milu_get_header_font_tone() {

	$default_font_tone = ( preg_match( '/dark/', milu_get_theme_mod( 'color_scheme' ) ) ) ? 'light' : 'dark';
	$header_font_tone = ( milu_has_hero() ) ? 'light' : $default_font_tone;
	$header_font_tone = apply_filters( 'milu_default_hero_font_tone', $header_font_tone );

	if ( 'none' === milu_get_inherit_mod( 'hero_layout' ) && 'solid' !== milu_get_inherit_mod( 'menu_style' ) ) {
		$header_font_tone = 'light';
		$header_font_tone = apply_filters( 'milu_default_no_header_hero_font_tone', $header_font_tone );
	}

	if ( is_single() && post_password_required() && get_header_image() ) {
		$header_font_tone = 'light';
	}

	if ( get_post_meta( milu_get_inherit_post_id(), '_post_hero_font_tone', true ) ) {
		$header_font_tone = get_post_meta( milu_get_inherit_post_id(), '_post_hero_font_tone', true );
	}

	return apply_filters( 'milu_hero_font_tone', $header_font_tone );
}

/**
 * Get menu layout (top right, logo centered etc...)
 *
 * @return string
 */
function milu_get_menu_layout() {

	$menu_layout = milu_get_inherit_mod( 'menu_layout', 'top-right' );

	$post_types = apply_filters( 'milu_no_header_post_types', array( 'product', 'release', 'event', 'proof_gallery', 'attachment' ) );
	if ( is_single() && in_array( get_post_type(), $post_types ) && ! get_post_meta( get_the_ID(), '_post_menu_layout', true ) ) {
		if ( 'top-right-floating' === $menu_layout ) {
			$menu_layout = 'top-right';
		}
	}

	return apply_filters( 'milu_menu_layout', $menu_layout );
}

/**
 * Get menu style (transparent, solid etc...)
 *
 * @return string
 */
function milu_get_menu_style() {

	$menu_style = milu_get_inherit_mod( 'menu_style' );

	$post_types = apply_filters( 'milu_no_header_post_types', array( 'product', 'release', 'event', 'proof_gallery', 'attachment' ) );
	if ( is_single() && in_array( get_post_type(), $post_types ) && ! get_post_meta( get_the_ID(), '_post_menu_style', true ) ) {
		$menu_style = 'solid';
	}

	if ( is_single() && post_password_required() && get_header_image() ) {
		$menu_style = 'transparent';
	}

	if ( is_single() ) {
		$post_type = get_post_type();
		
		$post_menu_style_meta = get_post_meta( get_the_ID(), '_post_menu_style', true );

		if ( ! $post_menu_style_meta && 'none' === milu_get_inherit_mod( $post_type . '_hero_layout' ) ) {
			$menu_style = 'solid';
		}
	}

	return apply_filters( 'milu_menu_style', $menu_style );
}

/**
 * Get type of content in the menu call to action area (shop icons, social icons etc...)
 */
function milu_get_menu_cta_content_type() {

	$content_type = milu_get_inherit_mod( 'menu_cta_content_type', 'none' );

	return apply_filters( 'milu_menu_cta_content_type', $content_type );
}

/**
 * Get single post layout
 *
 * @return string $layout
 */
function milu_get_single_post_layout( $post_id = null, $default = 'default' ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();

	$single_post_layout = milu_get_theme_mod( 'post_single_layout' );
	$single_post_layout_meta = get_post_meta( $post_id, '_post_layout', true );

	if ( is_singular( 'artist' ) ) {
		$single_post_layout = milu_get_theme_mod( 'artist_single_layout' );
	}

	if ( $single_post_layout_meta && 'default' !== $single_post_layout_meta ) {
		$single_post_layout = $single_post_layout_meta;
	}

	/* Force full width layout on posts that use page builder */
	if ( is_singular( 'post' ) && milu_is_vc() && $single_post_layout_meta !== 'sidebar-left' && $single_post_layout_meta !== 'sidebar-right' ) {
		$single_post_layout = 'default';
	}

	return apply_filters( 'milu_single_post_layout', $single_post_layout );
}

/**
 * Single post WVC layout
 */
function milu_get_single_post_wvc_layout( $post_id = null ) {

	if ( is_singular( 'post' ) ) {

		if ( milu_is_vc() ) {
			
			$single_post_wvc_layout = '';
			$post_id = ( $post_id ) ? $post_id : get_the_ID();
			$single_post_layout_meta = get_post_meta( $post_id, '_post_layout', true );

			if ( 'sidebar-left' !== $single_post_layout_meta && 'sidebar-right' !== $single_post_layout_meta ) {
				
				$single_post_wvc_layout = 'wvc-single-post-fullwidth';
			
			} elseif ( 'sidebar-left' === $single_post_layout_meta || 'sidebar-right' === $single_post_layout_meta ) {

				$single_post_wvc_layout = 'wvc-single-post-sidebar';
			}

			return apply_filters( 'milu_single_post_wvc_layout', $single_post_wvc_layout );
		}
	}
}

/**
 * Get single video layout
 *
 * @return string $layout
 */
function milu_get_single_video_layout( $post_id = null, $default = 'default' ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();

	$single_post_layout = milu_get_theme_mod( 'video_single_layout' );

	if ( get_post_meta( $post_id, '_post_layout', true ) && 'default' !== get_post_meta( $post_id, '_post_layout', true ) ) {
		$single_post_layout = get_post_meta( $post_id, '_post_layout', true );
	}

	/* Force full width layout on posts that use page builder */
	if ( is_singular( 'video' ) && milu_is_vc() ) {
		$single_post_layout = 'default';
	}

	return apply_filters( 'milu_single_video_layout', $single_post_layout );
}

/**
 * Get single mp event layout
 *
 * @return string $layout
 */
function milu_get_single_mp_event_layout( $post_id = null, $default = 'default' ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();

	$single_post_layout = milu_get_theme_mod( 'mp_event_single_layout' );

	if ( get_post_meta( $post_id, '_post_layout', true ) && 'default' !== get_post_meta( $post_id, '_post_layout', true ) ) {
		$single_post_layout = get_post_meta( $post_id, '_post_layout', true );
	}

	/* Force full width layout on posts that use page builder */
	if ( is_singular( 'mp_event' ) && milu_is_vc() ) {
		$single_post_layout = 'default';
	}

	return apply_filters( 'milu_single_mp_event_layout', $single_post_layout );
}

/**
 * Get single mp column layout
 *
 * @return string $layout
 */
function milu_get_single_mp_column_layout( $post_id = null, $default = 'default' ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();

	$single_post_layout = milu_get_theme_mod( 'mp_column_single_layout' );

	if ( get_post_meta( $post_id, '_post_layout', true ) && 'default' !== get_post_meta( $post_id, '_post_layout', true ) ) {
		$single_post_layout = get_post_meta( $post_id, '_post_layout', true );
	}

	/* Force full width layout on posts that use page builder */
	if ( is_singular( 'mp_column' ) && milu_is_vc() ) {
		$single_post_layout = 'default';
	}

	return apply_filters( 'milu_single_mp_column_layout', $single_post_layout );
}

/**
 * Get single artist layout
 *
 * @return string $layout
 */
function milu_get_single_artist_layout( $post_id = null, $default = 'default' ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();

	$single_post_layout = milu_get_theme_mod( 'artist_single_layout' );

	if ( get_post_meta( $post_id, '_post_layout', true ) && 'default' !== get_post_meta( $post_id, '_post_layout', true ) ) {
		$single_post_layout = get_post_meta( $post_id, '_post_layout', true );
	}

	/* Force full width layout on posts that use page builder */
	if ( is_singular( 'artist' ) && milu_is_vc() ) {
		$single_post_layout = 'default';
	}

	return apply_filters( 'milu_single_artist_layout', $single_post_layout );
}

/**
 * Get hero image ID
 *
 * @return string URL
 */
function milu_get_hero_image_id() {

	if ( is_random_header_image() ) {

		$data = _get_random_header_data();

	} else {
		$data = get_theme_mod( 'header_image_data' );
	}

	$data = is_object( $data ) ? get_object_vars( $data ) : $data;
	$header_img_id = is_array( $data ) && isset( $data['attachment_id'] ) ? $data['attachment_id'] : false;

	return $header_img_id;
}

/**
 * Get featured image ID
 *
 * Get the featured image of the current post or a given post
 * Get the header image ID if no featured image is found if the second parameter is set to true
 *
 * @param int $post_id
 * @param bool $fallback
 * @return int
 */
function milu_get_featured_image_id( $post_id = null, $fallback = false ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();

	if ( get_post_thumbnail_id( $post_id ) ) {
		return get_post_thumbnail_id( $post_id );
	}

	if ( milu_get_hero_image_id() && $fallback ) {
		return milu_get_hero_image_id();
	}
}

/**
 * Returns an array of post gallery containing ids and attachment titles
 *
 * Used to generate json array to open lightbox
 */
function milu_get_gallery_params() {

	$array = array();

	if ( milu_get_post_gallery_ids() ) {

		$milu_get_post_gallery_ids = milu_list_to_array( milu_get_post_gallery_ids() );

		foreach ( $milu_get_post_gallery_ids as $attachment_id ) {

			$attachment = get_post( $attachment_id );

			if ( $attachment ) {
				$src = esc_url( milu_get_url_from_attachment_id( $attachment_id, 'milu-XL' ) );
				$title = wptexturize( $attachment->post_title );
				$caption = wptexturize( $attachment->post_excerpt );

				$array[] = array(
					'src' => $src,
					'opts' => array(
						'caption' => $caption,
					),
				);
			}
		}
	}

	return $array;
}

/**
 * Get first category of the post if any
 *
 * @param int $post_id
 */
function milu_get_first_category( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( 'post' === get_post_type() ) {
		$category = get_the_category();
		if ( $category ) {
			return $category[0]->name;
		}
	}
}

/**
 * Get first category URL of the post if any
 *
 * @param int $post_id
 */
function milu_get_first_category_url( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( 'post' === get_post_type() ) {
		$category = get_the_category();
		if ( $category ) {
			return get_category_link( $category[0]->cat_ID );
		}
	}
}

/**
 * Get hero image
 *
 * @return string URL
 */
function milu_get_hero_image( $args ) {

	extract( wp_parse_args( $args, array(
		'in_loop' => true,
		'size' => 'large',
		'effect' => '',
	) ) );

	$post_id = ( $in_loop ) ?  get_the_ID() : milu_get_inherit_post_id();

	if ( has_post_thumbnail( $post_id ) ) {

		return get_the_post_thumbnail( $post_id, $size, array( 'class' => "cover $effect" ) );

	} elseif ( get_header_image() ) {
		$src = get_header_image();

		return "<img src='$src' class='cover $effect' alt='header-image'>";
	}
}

/**
 * Get hero image src
 *
 * used?
 *
 * @return string URL
 */
function milu_get_hero_image_src( $in_loop = true ) {

	$post_id = ( $in_loop ) ?  get_the_ID() : milu_get_inherit_post_id();

	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail_url( $post_id, '%SLUG-XL%' );
	} elseif ( get_header_image() ) {
		return get_header_image();
	}
}

/**
 * Return the first URL in the post if an URL is found else return permalink
 *
 * @return string
 */
function milu_get_first_url( $post_id = null ) {

	if ( is_search() || milu_is_woocommerce_page() ) {
		return;
	}

	if ( ! $post_id ) {
		$post_id = milu_get_the_ID();
	}

	if ( ! $post_id ) {
		return;
	}

	$post_content = get_post_field( 'post_content', $post_id );

	if ( $post_content ) {
		$has_url = preg_match( '/(http:|https:)?\/\/[a-zA-Z0-9\/.?&=_-]+/', $post_content, $match );
		$link = ( $has_url ) ? $match[0] : false;

		return esc_url_raw( $link );
	}
}

/**
 * Return the first video URL in the post if a video URL is found
 *
 * @return string
 */
function milu_get_first_video_url( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$content = get_post_field( 'post_content', $post_id );

	$has_video_url =
	preg_match( '#(https|http)?://(?:\www.)?\youtube.com/watch\?v=([A-Za-z0-9\-_]+)#', $content, $match )
	|| preg_match( '#(https|http)?://(?:\www.)?\youtu.be/([A-Za-z0-9\-_]+)#', $content, $match )
	|| preg_match( '#(https|http)?://vimeo\.com/([0-9]+)#', $content, $match )
	|| preg_match( '#(https|http)?://blip.tv/.*#', $content, $match )
	|| preg_match( '#(https|http)?://(www\.)?dailymotion\.com/.*#', $content, $match )
	|| preg_match( '#(https|http)?://dai.ly/.*#', $content, $match )
	|| preg_match( '#(https|http)?://(www\.)?hulu\.com/watch/.*#', $content, $match )
	|| preg_match( '#(https|http)?://(www\.)?viddler\.com/.*#', $content, $match )
	|| preg_match( '#(https|http)?://qik.com/.*#', $content, $match )
	|| preg_match( '#(https|http)?://revision3.com/.*#', $content, $match )
	|| preg_match( '#(https|http)?://wordpress.tv/.*#', $content, $match )
	|| preg_match( '#(https|http)?://(www\.)?funnyordie\.com/videos/.*#', $content, $match )
	|| preg_match( '#(https|http)?://(www\.)?flickr\.com/.*#', $content, $match )
	|| preg_match( '#(https|http)?://flic.kr/.*#', $content, $match )
	|| preg_match( '/(http:|https:)?\/\/[a-zA-Z0-9\/.?&=_-]+.mp4/', $content, $match );

	$video_url = ( $has_video_url ) ? esc_url( $match[0] ) : null;

	return $video_url;
}

/**
 * Return the first mp3 URL in the post if a video URL is found
 *
 * @return string
 */
function milu_get_first_mp3_url( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$content = get_post_field( 'post_content', $post_id );

	$has_mp3_url =
	
	preg_match( '#(https|http)?:\/\/(?:\www.)?[a-zA-Z0-9.\/_-]+.mp3#', $content, $match );

	$mp3_url = ( $has_mp3_url && isset( $match[0] ) ) ? esc_url( $match[0] ) : null;

	return $mp3_url;
}

/**
 * Return the first quote of the post else the title
 */
function milu_get_first_quote( $post_id ) {

	global $post;
	$content = preg_replace( '/\s+/', ' ', $post->post_content );
	$has_quote = preg_match( '#<blockquote>(.*?)</blockquote>#', $content, $match );
	$quote = ( $has_quote ) ? $match[1] : get_the_title();

	return wp_kses( $quote, array(
		'a' => array(
			'href' => array(),
			'class' => array(),
			'id' => array(),
			'target' => array(),
		),
		'cite' => array(
			'class' => array(),
			'id' => array(),
		),
		'p' => array(
			'class' => array(),
			'id' => array(),
		),
	) );
}

/**
 * Avoid page jump when clicking on more link
 *
 * @param string $link
 * @return string $link
 */
function milu_remove_more_jump_link( $link )  {
	$offset = strpos( $link, '#more-' );
	if ( $offset ) { $end = strpos( $link, '"',$offset ); }
	if ( $end ) { $link = substr_replace( $link, '', $offset, $end-$offset ); }
	return $link;
}
add_filter( 'the_content_more_link', 'milu_remove_more_jump_link' );

/**
 * Get blog index ID
 */
function milu_get_blog_index_id() {
	if ( get_option( 'page_for_posts' ) ) {
		return absint( get_option( 'page_for_posts' ) );
	}
}

/**
 * Get blog URL
 */
function milu_get_blog_url() {
	if ( get_option( 'page_for_posts' ) ) {
		return esc_url( get_permalink( get_option( 'page_for_posts' ) ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get events page_id
 */
function milu_get_portfolio_page_id() {
	if ( function_exists( 'wolf_portfolio_get_page_id' ) ) {
		return wolf_portfolio_get_page_id();
	}
}

/**
 * Get portfolio URL
 */
function milu_get_portfolio_url() {
	if ( function_exists( 'wolf_portfolio_get_page_id' ) ) {
		return esc_url( get_permalink( wolf_portfolio_get_page_id() ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get shop URL
 */
function milu_get_shop_url() {
	if ( function_exists( 'wc_get_page_id' ) ) {
		return esc_url( get_permalink( wc_get_page_id( 'shop' ) ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get events page_id
 */
function milu_get_events_page_id() {
	if ( function_exists( 'wolf_events_get_page_id' ) ) {
		return wolf_events_get_page_id();
	}
}

/**
 * Get events URL
 */
function milu_get_events_url() {
	if ( function_exists( 'wolf_events_get_page_id' ) ) {
		return esc_url( get_permalink( wolf_events_get_page_id() ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get albums URL
 */
function milu_get_albums_url() {
	if ( function_exists( 'wolf_albums_get_page_id' ) ) {
		return esc_url( get_permalink( wolf_albums_get_page_id() ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get discography page_id
 */
function milu_get_discography_page_id() {
	if ( function_exists( 'wolf_discography_get_page_id' ) ) {
		return wolf_discography_get_page_id();
	}
}

/**
 * Get discography URL
 */
function milu_get_discography_url() {
	if ( function_exists( 'wolf_discography_get_page_id' ) ) {
		return esc_url( get_permalink( wolf_discography_get_page_id() ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get videos page_id
 */
function milu_get_videos_page_id() {
	if ( function_exists( 'wolf_videos_get_page_id' ) ) {
		return wolf_videos_get_page_id();
	}
}

/**
 * Get videos URL
 */
function milu_get_videos_url() {
	if ( function_exists( 'wolf_videos_get_page_id' ) ) {
		return esc_url( get_permalink( wolf_videos_get_page_id() ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get artists URL
 */
function milu_get_artists_url() {
	if ( function_exists( 'wolf_artists_get_page_link' ) ) {
		return esc_url( get_permalink( wolf_artists_get_page_link() ) );
	} else {
		return esc_url( home_url( '/' ) );
	}
}

/**
 * Get artists page_id
 */
function milu_get_artists_page_id() {
	if ( function_exists( 'wolf_artists_get_page_id' ) ) {
		return wolf_artists_get_page_id();
	}
}

/**
 * Get post type name
 */
function milu_get_post_type_name() {
	$post = get_queried_object();
	$post_type = get_post_type_object( get_post_type( $post ) );

	return $post_type->labels->singular_name;
}

/**
 * Get placeholder URL
 */
function milu_get_placeholder_url() {
	$rand = rand( 1, 1084 );
	return 'https://unsplash.it/800/800/?image=' . $rand;
}

/**
 * Get instagram image url from link
 */
function milu_get_instagram_image_url( $post_id = null ) {
	
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$remote_url = 'https://api.instagram.com/oembed/?url=' . milu_get_first_url( $post_id );
	$response = wp_remote_get( $remote_url );
	if ( ! is_wp_error( $response ) && is_array( $response ) ) {
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		$thumbnail_url = ( is_object( $data ) && isset( $data->thumbnail_url ) ) ? $data->thumbnail_url : null;

		return esc_url( $thumbnail_url );
	}
}

/**
 * Get instagram image from link
 */
function milu_get_instagram_image( $post_id = null, $link = true ) {

	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	$remote_url = 'https://api.instagram.com/oembed/?url=' . milu_get_first_url( $post_id );
	$response = wp_remote_get( $remote_url );
	if ( ! is_wp_error( $response ) && is_array( $response ) ) {
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		$thumbnail_url = ( is_object( $data ) && isset( $data->thumbnail_url ) ) ? $data->thumbnail_url : null;
		$title = ( is_object( $data ) && isset( $data->title ) ) ? $data->title : null;

		if ( $thumbnail_url ) {
			return '<a class="instagram-image" href="' . esc_url( milu_get_first_url( $post_id ) ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '" target="_blank">
			<img src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr( $title ) . '">
		</a>';
		}
	}
}

/**
 * Get gallery IDs
 *
 * Get the attachement IDs of gallery in a post
 * We try to match the first "images" attributes to get the list of IDs from VC
 * Else, get the first "ids" attribute content from a gallery shortcode
 * Else get the gallery the WP way with get_post_gallery
 *
 * @param int $post_id
 * @return string the IDs list
 */
function milu_get_post_gallery_ids() {

	$ids = '';
	$post_id = get_the_ID();
	$content = get_post_field( 'post_content', $post_id );
	if ( preg_match( '/images="[0-9 ,]+"/', $content, $match ) ) {

		if ( isset( $match[0] ) ) {
			if ( preg_match( '/[0-9, ]+/', $match[0], $match ) ) {
				if ( isset( $match[0] ) ) {
					$ids = $match[0];
				}
			}
		}
	} elseif ( preg_match( '/ids="[0-9 ,]+"/', $content, $match ) ) {

		if ( isset( $match[0] ) ) {
			if ( preg_match( '/[0-9, ]+/', $match[0], $match ) ) {
				if ( isset( $match[0] ) ) {
					$ids = $match[0];
				}
			}
		}
	} elseif ( get_post_gallery( $post_id, false ) ) {

		$gallery = get_post_gallery( $post_id, false );

		if ( $gallery && isset( $gallery['ids'] ) ) {

			$ids = $gallery['ids'];
		
		} else {

			$ids_array = array();
			$args = array( 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image',
				'numberposts' => -1, 
				'post_status' => null, 
				'post_parent' => $post_id
			);

			$attached_images = get_posts( $args );

			foreach ( $attached_images as $image ) {
				$ids_array[] = $image->ID;
			}

			$ids = milu_array_to_list( $ids_array );
		}
	}

	return $ids;
}

/**
 * Get first gallery image count
 * @param int $post_id
 * @return int
 */
function milu_get_first_gallery_image_count() {

	if ( milu_get_post_gallery_ids() ) {
		return absint( count( milu_list_to_array( milu_get_post_gallery_ids() ) ) );
	}
}

/**
 * Filter YT and Vimeo oembed URL
 *
 * Add custom arguments to YT and Vimeo videos URLs
 *
 * @param string $provider
 * @param string $url
 * @param array $args
 * @return string $provider The URL with the added args
 */
function milu_oembed_add_args( $provider, $url, $args ) {

	if ( strpos( $provider, 'vimeo.com' ) ) {
		$provider = add_query_arg( array(
			'api' => '1',
			'title' => '0',
			'portrait' => '0',
			'badge' => '0',
			'byline' => '0',
			'color' => str_replace( '#', '', apply_filters( 'milu_vimeo_accent_color', milu_get_inherit_mod( 'accent_color' ) ) ),
		), $provider );
	}

	if ( strpos( $provider, 'youtu' ) ) {
		$provider = add_query_arg( array(
			'wmode' => 'transparent'
		), $provider );
	}
	
	return $provider;
}
add_filter( 'oembed_fetch_url', 'milu_oembed_add_args', 10, 3 );

/**
 * Force parallax on mobile option filter
 *
 * @param bool $bool
 * @return bool $bool
 */
function milu_parallax_mobile( $bool ) {

	if ( milu_get_theme_mod( 'enable_mobile_parallax' ) ) {
		$bool = false;
	}

	return $bool;
}
add_filter( 'milu_parallax_no_ios', 'milu_parallax_mobile', 40 );
add_filter( 'milu_parallax_no_android', 'milu_parallax_mobile', 40 );
add_filter( 'milu_parallax_no_small_screen', 'milu_parallax_mobile', 40 );
add_filter( 'wvc_parallax_no_ios', 'milu_parallax_mobile', 40 );
add_filter( 'wvc_parallax_no_android', 'milu_parallax_mobile', 40 );
add_filter( 'wvc_parallax_no_small_screen', 'milu_parallax_mobile', 40 );

/**
 * Force animation on mobile option filter
 *
 * @param bool $bool
 * @return bool $bool
 */
function milu_animation_mobile( $bool ) {

	if ( milu_get_theme_mod( 'enable_mobile_animations' ) ) {
		$bool = true;
	}

	return $bool;
}
add_filter( 'milu_force_animation_mobile', 'milu_animation_mobile', 40 );
add_filter( 'wvc_force_animation_mobile', 'milu_animation_mobile', 40 );

/**
 * Overwrite lightbox
 *
 * @param string $lightbox
 * @return string $lightbox
 */
function milu_overwrite_lightbox( $lightbox ) {
	return 'fancybox';
}
add_filter( 'wvc_lightbox', 'milu_overwrite_lightbox', 40 );

/**
 * Site footer class
 */
function milu_set_site_footer_tone_class( $class ) {

	$body_bg_color = milu_get_theme_mod( 'body_background_color' );

	if ( $body_bg_color ) {
		$class .= 'site-footer-dark';
	}

	return $class;
}
add_filter( 'milu_site_footer_class', 'milu_set_site_footer_tone_class' );