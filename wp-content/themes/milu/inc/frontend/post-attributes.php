<?php
/**
 * Milu post class functions
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'milu_post_classes' ) ) {
	/**
	 * Add specific class to the post depending on context
	 *
	 * @version 1.0.2
	 * @param array $classes
	 * @return array $classes
	 */
	function milu_post_classes( $classes ) {

		if ( ! is_admin() ) {
			
			$post_id = get_the_ID();
			$post_type = get_post_type();
			$post_format = ( get_post_format() ) ? get_post_format() : 'standard';
			$post_display = apply_filters( 'milu_post_display', milu_get_theme_mod( $post_type . '_display', 'grid' ) );
				$post_item_animation = apply_filters( 'milu_post_item_animation', milu_get_theme_mod( $post_type . '_item_animation' ) );
			
			$module_layout = 'layout-' . apply_filters( 'milu_post_module_layout', milu_get_theme_mod( $post_type . '_layout', 'standard' ) );
			
			$post_columns = 'columns-' . apply_filters( 'milu_post_columns', milu_get_theme_mod( $post_type . '_columns', 'default' ) );

			$classes[] = 'entry';
			$classes[] = 'clearfix';

			$force_loop_class = apply_filters( 'milu_post_force_loop_class', false );

			$loop_condition = ( ! is_single() && ! is_search() ) || milu_is_photos() || $force_loop_class || ( is_search() && milu_is_woocommerce_page() );

			if ( $loop_condition ) {
				$not_grid = array( 'masonry_horizontal', 'list', 'list_minimal', 'metro', 'metro_modern', 'mosaic', 'standard', 'standard_modern', 'lateral', 'offgrid', 'metro_overlay_quickview', 'metro_modern_alt', 'parallax' );

				if ( ! in_array( $post_display, $not_grid ) ) {
					$classes[] = 'entry-grid';

					$classes[] = 'entry-' . $post_columns;

				}

				$classes[] = 'entry-' . $post_type . '-module-' . $module_layout;

				$featured = get_post_meta( get_the_ID(), '_post_featured', true );

				if ( $featured ) {
					$classes[] = 'featured';
				}

				if ( is_sticky() ) { // force sticky class for posts outside the loop
					$classes[] = 'sticky';
				}

				if ( has_post_thumbnail() ) {

					$img_dominant_colot = milu_get_image_dominant_color( get_post_thumbnail_id() );
					$img_color_tone = milu_get_color_tone( $img_dominant_colot, 180 );

					$classes[] = 'thumbnail-color-tone-' . $img_color_tone;
				}
				if ( has_post_thumbnail() && ! $featured  ) {
					$image_data = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$image_width = $image_data[1];
					$image_height = $image_data[2];

					if ( $image_height > $image_width ) {
						$classes[] = 'metro-portrait';
					}

					if ( $image_width > $image_height ) {
						if ( ( $image_width / $image_height ) > 1.6 ) {
							$classes[] = 'metro-landscape';
						}
					}
				}

				$product_id = get_post_meta( get_the_ID(), '_post_wc_product_id', true );
				if ( 'post' === $post_type && $product_id && 'publish' == get_post_status( $product_id ) ) {
					$classes[] = 'featured-product';
				}

				/* Dead simple dump regexez to check the type of first URL in post if any */

				/* Audio embed */
				if ( milu_is_audio_embed_post() ) {
					$classes[] = 'is-audio-embed';
				}

				/* MixCloud */
				if ( preg_match( '/mixcloud/', milu_get_first_url( $post_id ) ) ) {
					$classes[] = 'is-mixcloud';
				}

				/* ReverbNation */
				if ( preg_match( '/reverbnation/', milu_get_first_url( $post_id ) ) ) {
					$classes[] = 'is-reverbnation';
				}

				/* Soundcloud */
				if ( preg_match( '/soundcloud/', milu_get_first_url( $post_id ) ) ) {
					$classes[] = 'is-soundcloud';
				}

				/* Spotify */
				if ( preg_match( '/spotify/', milu_get_first_url( $post_id ) ) ) {
					$classes[] = 'is-spotify';
				}

				/* Self Hosted video */
				if ( preg_match( '/.mp4/', milu_get_first_url( $post_id ) ) ) {
					$classes[] = 'is-mp4';
				}

				/* Instagram */
				if ( preg_match( '/instagr/', milu_get_first_url( $post_id ) ) ) {
					$classes[] = 'is-instagram';
				}

				/* Twitter */
				if ( preg_match( '/twitter/', milu_get_first_url( $post_id ) ) ) {
					$classes[] = 'is-twitter';
				}

				/* Vimeo */
				if ( preg_match( '/vimeo/', milu_get_first_video_url( $post_id ) ) ) {
					$classes[] = 'is-vimeo';
				}

				/* Youtube */
				if ( preg_match( '/youtu/', milu_get_first_video_url( $post_id ) ) ) {
					$classes[] = 'is-youtube';
				}

				/* Wolf Playlist */
				if ( milu_shortcode_preg_match( 'wvc_audio_embed' ) ) {
					$classes[] = 'is-wvc-audio-embed';
				}

				/* Wolf Playlist */
				if ( milu_shortcode_preg_match( 'wolf_playlist' ) || milu_shortcode_preg_match( 'wvc_playlist' ) ) {
					$classes[] = 'is-wolf-playlist';
				}

				/* WP Playlist */
				if ( milu_shortcode_preg_match( 'playlist' ) ) {
					$classes[] = 'is-wp-playlist';
				}

				/* WolfjPlayer Playlist */
				if ( milu_shortcode_preg_match( 'wolf_jplayer_playlist' ) ) {
					$classes[] = 'is-wolf-jplayer';
				}

				if ( milu_is_audio_embed_post()
					|| milu_shortcode_preg_match( 'wvc_audio_embed' )
					|| milu_shortcode_preg_match( 'wolf_playlist' )
					|| milu_shortcode_preg_match( 'playlist' )
					|| milu_shortcode_preg_match( 'wolf_jplayer_playlist' )
				) {
					$classes[] = 'has-audio-player';
				}

				/* Audio shortcode */
				if ( milu_is_single_audio_player() ) {
					$classes[] = 'is-single-audio';
				}

				/* Short post format: link, quote, aside, status */
				if ( milu_is_short_post_format() ) {
					$classes[] = 'is-short-post-format';
				}

				/* No post thumbnail */
				if ( ! milu_has_post_thumbnail() ) {
					$classes[] = 'no-post-thumbnail';
				}

				/* Event class */
				if ( 'event' === $post_type ) {
					$sold_out = get_post_meta( $post_id, '_wolf_event_soldout', true );
					$cancelled = get_post_meta( $post_id, '_wolf_event_cancel', true );

					if ( $sold_out ) $classes[] = 'sold-out';
					if ( $cancelled ) $classes[] = 'cancelled';
				}

				$classes[] = 'entry-' . $post_type;
				
				$classes[] = 'entry-' . $post_display;
				
				$classes[] = 'entry-' . $post_type . '-' . $post_display; // default display
				
				if ( $post_item_animation && 'none' !== $post_item_animation ) {
				}

			} elseif ( is_search() && ! milu_is_woocommerce_page() ) {

				$classes[] = 'entry-search';
				$classes[] = 'entry-grid';
				$classes[] = 'entry-masonry';
				$classes[] = 'entry-post-masonry';
				$classes[] = 'entry-excerpt';
				$classes[] = 'entry-columns-default';

				if ( $post_item_animation ) {
				}

			} elseif ( is_single() && ! is_singular( 'product' ) ) {
				$classes[] = 'entry-single';
				$classes[] = 'entry-single-' . $post_type;

				if ( ! has_post_thumbnail() ) {
					$classes[] = 'entry-single-no-featured-image';
				}
			}
		}

		return array_unique( $classes );
	}
	add_filter( 'post_class', 'milu_post_classes' );
}

/**
 * Add post animation post data attributes
 */
function milu_post_animation_data_attr( $post_attrs, $post_id ) {

	$post_type = get_post_type( $post_id );
	
	$post_item_animation = apply_filters( 'milu_post_item_animation', milu_get_theme_mod( $post_type . '_item_animation' ) );
	
	if ( $post_item_animation && 'none' !== $post_item_animation ) {

		wp_enqueue_style( 'aos' );
		wp_enqueue_script( 'aos' );

		$post_attrs['data-aos'] = $post_item_animation;
		
		if ( function_exists( 'wvc_do_fullpage' ) && wvc_do_fullpage() ) {
			$post_attrs['data-aos-once'] = 'false';
		} else {
			$post_attrs['data-aos-once'] = 'true';
		}
	}

	return $post_attrs;
}
add_filter( 'milu_post_attrs', 'milu_post_animation_data_attr', 10, 2 );

/**
 * Filter old animations name
 *
 * @param string
 * @return string
 */
function milu_animation_fallback( $post_item_animation ) {

	$post_item_animation = str_replace(
		array(
			'fadeIn',
			'fadeInDown',
			'fadeInDownBig',
			'fadeInLeft',
			'fadeInLeftBig',
			'fadeInRight',
			'fadeInRightBig',
			'fadeInUp',
			'fadeInUpBig',
			'bounceInDown',
			'bounceInLeft',
			'bounceInRight',
			'bounceInUp',
			'flipInX',
			'flipInY',
			'zoomIn',
		),
		array(
			'fade',
			'fade-down',
			'fade-down',
			'fade-left',
			'fade-left',
			'fade-right',
			'fade-right',
			'fade-up',
			'fade-up',
			'zoom-in-down',
			'zoom-in-left',
			'zoom-in-right',
			'zoom-in-up',
			'flip-up',
			'flip-left',
			'zoom-in',
		),
		$post_item_animation
	);

	return $post_item_animation;
}
add_filter( 'milu_post_item_animation', 'milu_animation_fallback', 40 );