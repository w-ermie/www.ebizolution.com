<?php
/**
 * Milu template tags
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Edit post link
 */
function milu_edit_post_link( $echo = true ) {
	
	if ( ! is_user_logged_in() ) {
		return;
	}

	$output = '';

	ob_start();
	edit_post_link( esc_html__( 'Edit', 'milu' ), '<span class="meta-icon edit-pencil"></span>' );
	
	if ( is_user_logged_in() ) {
		$output = '<span class="custom-edit-link">' . ob_get_clean() . '</span>';
	}

	if ( $echo && $output ) {
		echo milu_kses( $output );
	}

	return $output;
}

/**
 * Get extra post meta
 *
 * Display comment count, likes, views and reading time
 */
function milu_get_extra_meta( $echo = true, $post_type = null ) {
	$output = '';

	$post_type = ( $post_type ) ? $post_type : get_post_type();

	$comments = milu_get_comments_count( false );

	if ( ! class_exists( 'Wolf_Custom_Post_Meta' ) && 0 === absint( $comments ) ) {
		return;
	}

	$output .= '<div class="post-extra-meta">';

	if ( class_exists( 'Wolf_Custom_Post_Meta' ) ) {

		$likes = wolf_custom_post_meta_get_likes();
		$views = wolf_custom_post_meta_get_views();
		$reading_time = wolf_custom_post_meta_get_post_reading_time();

		$display_meta = milu_list_to_array( milu_get_theme_mod( 'enable_custom_post_meta' ) );

		if ( 'post' !== $post_type ) {
			$display_meta = milu_list_to_array( milu_get_theme_mod( $post_type . '_enable_custom_post_meta' ) );
		}

		$post_enable_views = ( in_array( $post_type . '_enable_views', $display_meta ) );
		$post_enable_likes = ( in_array( $post_type . '_enable_likes', $display_meta ) );
		$post_enable_reading_time = ( in_array( $post_type . '_enable_reading_time', $display_meta ) );

		if ( $post_enable_likes ) {

			$output .= '<span class="post-meta post-likes wolf-like-this" data-post-id="' . esc_attr( get_the_ID() ) . '"><i class="fa fa-heart-o likes-icon meta-icon"></i>' . sprintf(
				wp_kses(
					__( '<span class="wolf-likes-count">%s</span> likes', 'milu' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				), $likes ) . '</span>';
		}

		if ( $post_enable_views ) {

			$output .= '<span class="post-meta post-views"><i class="meta-icon views-icon"></i>' . sprintf( esc_html__( '%s views', 'milu' ), $views ) . '</span>';
		}

		if ( $post_enable_reading_time ) {

			$output .= '<span class="post-meta post-reading-time"><i class="meta-icon reading-time-icon"></i>' . sprintf( esc_html__( '%s min', 'milu' ), $reading_time ) . '</span>';
		}
	}

	if ( 0 < get_comments_number() && comments_open() ) {
		$output .= '<span class="post-meta post-comments">
			<a class="scroll" href="' . esc_url( get_permalink() . '#comments' ) . '">
			<span class="meta-icon comments-icon"></span>' . sprintf( _n( '%s <span class="comment-text">comment</span>', '%s <span class="comment-text">comments</span>', $comments, 'milu' ), $comments ) . '</a>
		</span>';
	}

	$output .= '</div><!-- .post-extra-meta -->';

	if ( $echo ) {
		echo milu_kses( $output );
	}

	return $output;
}

/**
 * Get date
 *
 * @param bool $echo
 * @return string $date
 */
function milu_entry_date( $echo = true, $link = false, $post_id = null ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();
	$display_time = get_the_date( '', $post_id );
	$modified_display_time = get_the_modified_date( '', $post_id );

	if ( 'human_diff' === milu_get_theme_mod( 'date_format' ) ) {
		$display_time = sprintf( esc_html__( '%s ago', 'milu' ), human_time_diff( get_the_time( 'U', $post_id ), current_time( 'timestamp' ) ) );
		$modified_display_time = sprintf( esc_html__( '%s ago', 'milu' ), human_time_diff( get_the_modified_time( 'U', $post_id ), current_time( 'timestamp' ) ) );
	}

	$date = $display_time;

	if ( get_the_time( 'U', $post_id ) !== get_the_modified_time( 'U', $post_id ) ) {
		$time_string = '<time itemprop="datePublished" class="published" datetime="%1$s">%2$s</time><time itemprop="dateModified" class="updated" datetime="%3$s">%4$s</time>';
	} else {
		$time_string = '<time itemprop="datePublished" class="published updated" datetime="%1$s">%2$s</time>';
	}

	$_time = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c', $post_id ) ),
		esc_html( $display_time ),
		esc_attr( get_the_modified_date( 'c', $post_id ) ),
		esc_html( $modified_display_time )
	);

	if ( $link ) {
		$date = sprintf(
			'<span class="posted-on date"><a href="%1$s" rel="bookmark">%2$s</a></span>',
			esc_url( get_permalink() ),
			$_time
		);
	} else {
		$date = sprintf(
			'<span class="posted-on date">%2$s</span>',
			esc_url( get_permalink( $post_id ) ),
			$_time
		);
	}

	if ( $echo ) {
		echo apply_filters( 'milu_entry_date', milu_kses( $date ) );
	}

	return apply_filters( 'milu_entry_date', milu_kses( $date ) );
}

/**
 * Get comments count
 */
function milu_get_comments_count( $echo = true ) {

	if ( $echo ) {
		echo get_comments_number();
	}

	return get_comments_number();
}

/**
 * Get Author Avatar
 */
function milu_get_author_avatar( $size = 20 ) {
	
	$output = '<span class="author-meta">';
		$output .='<a class="author-link" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" rel="author">';
		$output .= get_avatar( get_the_author_meta( 'user_email' ), $size );
		$output .= '</a>';

	$output .= sprintf(
		'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'milu' ), get_the_author() ) ),
		apply_filters( 'milu_author_name_meta', milu_the_author( false ) )
	);

	$output .= '</span><!--.author-meta-->';

	echo milu_kses( $output );
}

/**
 * Get Author
 */
function milu_get_author() {

	$output = sprintf(
		'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s %4$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'milu' ), get_the_author() ) ),
		esc_html__( 'by', 'milu' ),
		milu_the_author( false )
	);

	echo milu_kses( $output );
}

/**
 * Get author instagram URL and username
 *
 * @return array
 */
function milu_get_author_instagram_username( $author_id = null ) {


	if ( ! $author_id ) {
		global $post;

		if ( ! is_object( $post ) ) {
			return;
		}

		$author_id = $post->post_author;
	}

	$author_instagram = get_the_author_meta( 'instagram', $author_id );

	if ( $author_instagram ) {
		if ( preg_match( '/instagram.com\/[a-zA-Z0-9_]+/', $author_instagram, $match) ) {
			$insta_username = str_replace( 'instagram.com/', '', $match[0] );
			return $insta_username;
		}
	}
}

/**
 * Display work meta for Portfolio "work" post type
 */
function milu_work_meta() {
	$post_id = get_the_ID();
	$client = get_post_meta( $post_id, '_work_client', true );
	$link = get_post_meta( $post_id, '_work_link', true );
	$skills = get_the_term_list( $post_id, 'work_type', '', esc_html__( ', ', 'milu' ), '' );
	$separator = apply_filters( 'milu_work_meta_separator', '&mdash;' );
	?>
	<ul>
	<?php if ( $skills ) : ?>
		<li class="work-meta work-categories">
			<i class="fa fa-tag"></i> <span class="work-meta-label"><?php esc_html_e( 'Category', 'milu' ); ?></span> <span class="work-meta-separator"><?php echo sanitize_text_field( $separator ); ?></span> <span class="work-meta-value"><?php echo milu_kses( $skills ); ?></span>
		</li>
	<?php endif; ?>

	<?php if ( $client ) : ?>
		<li class="work-meta work-client">
			<i class="fa fa-user-o"></i> <span class="work-meta-label"><?php esc_html_e( 'Client', 'milu' ); ?></span> <span class="work-meta-separator"><?php echo sanitize_text_field( $separator ); ?></span> <span class="work-meta-value"><?php echo sanitize_text_field( $client ); ?></span>
		</li>
	<?php endif; ?>

	<?php if ( $link ) :
		$link_text = mb_strimwidth( str_replace( 'http://', '', $link ), 0, 25, '...' );
	?>
		<li class="work-meta work-link">
			<i class="fa fa-link"></i> <span class="work-meta-label"><?php esc_html_e( 'Link', 'milu' ); ?></span> <span class="work-meta-separator"><?php echo sanitize_text_field( $separator ); ?></span> <span class="work-meta-value"><a href="<?php echo esc_url( $link ); ?>"><?php echo sanitize_text_field( $link_text ); ?></a></span>
		</li>
	<?php endif; ?>
	</ul>
	<?php
}

if ( ! function_exists( 'milu_the_work_meta' ) ) {
	/**
	 * Work Custom Fields
	 */
	function milu_the_work_meta() {
		$separator = apply_filters( 'milu_work_meta_separator', '&mdash;' );
		$excluded_meta = array( 'slide_template', 'wv_video_id', 'total_sales' );
		if ( $keys = get_post_custom_keys() ) {
			echo '<ul>';
			foreach ( (array) $keys as $key ) {
				$keyt = trim( $key );
	                        if ( is_protected_meta( $keyt, 'post' ) || in_array( $keyt, $excluded_meta ) ) {
	                                continue;
	                        }
					$values = array_map( 'trim', get_post_custom_values( $key ) );
					$value = implode( $values, ', ' );
				?>
				<li class="work-meta work-<?php echo sanitize_title_with_dashes( $key ); ?>">
					<span class="work-meta-label"><?php echo sanitize_text_field( $key ); ?></span>
					<span class="work-meta-separator"><?php echo sanitize_text_field( $separator ); ?></span>
					<span class="work-meta-value"><?php echo sanitize_text_field( $value ); ?></span>
				</li>
				<?php
			}
			echo '</ul>';
		}
	}
}

if ( ! function_exists( 'milu_the_author' ) ) {
	/**
	 * Get the author
	 *
	 * @param bool $echo
	 * @return string $author
	 */
	function milu_the_author( $echo = true ) {

		global $post;

		if ( ! is_object( $post ) )
			return;

		$author_id = $post->post_author;
		$author = get_the_author_meta( 'user_nicename', $author_id );

		if ( get_the_author_meta( 'nickname', $author_id ) ) {
			$author = get_the_author_meta( 'nickname', $author_id );
		}

		if ( get_the_author_meta( 'first_name', $author_id ) ) {
			$author = get_the_author_meta( 'first_name', $author_id );

			if ( get_the_author_meta( 'last_name', $author_id ) ) {
				$author .= ' ' .  get_the_author_meta( 'last_name', $author_id );
			}
		}

		if ( $echo ) {
			$author = sprintf( '<span class="vcard author"><span class="fn">%s</span></span>', $author );
			echo milu_kses( $author );
		}

		return $author;

	}
}

/**
 * Navigation search form
 */
function milu_nav_search_form() {

	$cta_content = milu_get_inherit_mod( 'menu_cta_content_type', 'search_icon' );
	$class = '';

	$type = ( 'shop_icons' === $cta_content ) ? 'shop' : 'blog';

	/**
	 * Force shop icons on woocommerce pages
	 */
	$is_wc_page_child = is_page() && wp_get_post_parent_id( get_the_ID() ) == milu_get_woocommerce_shop_page_id() && milu_is_woocommerce();
	$is_wc = milu_is_woocommerce_page() || is_singular( 'product' ) || $is_wc_page_child;

	if ( apply_filters( 'milu_force_display_nav_shop_icons', $is_wc ) ) {
		$type = 'shop';
		$class = 'live-search-form';
	}

	if ( apply_filters( 'milu_force_nav_search_product', $is_wc ) ) {
		$type = 'shop';
		$class = 'live-search-form';
	}

	if ( 'shop_icons' === milu_get_inherit_mod( 'menu_cta_content_type', 'search_product_icon' ) ) {
		$type = 'shop';
		$class = 'live-search-form';
	}

	if ( ! class_exists( 'WooCommerce' ) ) {
		$type = 'blog';
	}

	$type = apply_filters( 'milu_nav_search_form_type', $type );

	?>
	<div class="nav-search-form search-type-<?php echo milu_sanitize_html_classes( $type ); ?>">
		<div class="nav-search-form-container <?php echo esc_attr( $class ); ?>">
			<?php
				/**
				 * Output product or post search form
				 */
				if ( 'shop' === $type ) {
					if ( function_exists( 'get_product_search_form' ) ) {
						get_product_search_form();
					}
				} else {
					get_search_form();
				}
			?>
			<span id="nav-search-loader" class="fa search-form-loader fa-circle-o-notch fa-spin"></span>
			<span id="nav-search-close" class="toggle-search fa lnr-cross"></span>
		</div><!-- .nav-search-form-container -->
	</div><!-- .nav-search-form -->
	<?php
}

/**
 * Output logo
 */
function milu_logo( $echo = true ) {

	$output = '';

	$logo_svg = apply_filters( 'milu_logo_svg', milu_get_theme_mod( 'logo_svg' ) );
	$logo_light = apply_filters( 'milu_logo_light', milu_get_theme_mod( 'logo_light' ) );
	$logo_dark = apply_filters( 'milu_logo_dark', milu_get_theme_mod( 'logo_dark' ) );

	if ( $logo_svg || $logo_light || $logo_dark ) {

		$home_url = apply_filters( 'milu_logo_home_url', home_url( '/' ) );

		$output = '<div class="logo">
			<a href="' . esc_url( $home_url ) . '" rel="home" class="logo-link">';

				if ( $logo_svg ) {
					$output .= '<img src="' . esc_url( $logo_svg  ). '" alt="' . esc_attr( __( 'logo-svg', 'milu' ) ) . '" class="svg logo-img logo-svg">';
				} else {
					if ( $logo_light ) {
						$output .= '<img src="' . esc_url( $logo_light ) . '" alt="' . esc_attr( __( 'logo-light', 'milu' ) ) . '" class="logo-img logo-light">';
					}

					if ( $logo_dark ) {
						$output .= '<img src="' . esc_url( $logo_dark  ). '" alt="' . esc_attr( __( 'logo-dark', 'milu' ) ) . '" class="logo-img logo-dark">';
					}
				}

		$output .= '</a>
			</div><!-- .logo -->';
	} else {
		$output .= '<div class="logo logo-is-text"><a class="logo-text logo-link" href="' . esc_url( home_url( '/' ) ) . '" rel="home">';

		$output .= get_bloginfo( 'name' );

		$output .= '</a></div>';
	}

	$output = apply_filters( 'milu_logo_html', $output );

	if ( $echo && $output ) {
		echo milu_kses( $output );
	}

	return milu_kses( $output );
}

/**
 * Get the first embed video URL to use as video background
 *
 * Supports self hosted video and youtube
 */
function milu_entry_video_background( $post_id = null ) {

	$post_id = ( $post_id ) ? $post_id : get_the_ID();

	if ( milu_get_first_url( $post_id ) ) {

		$video_url = milu_get_first_url( $post_id );

		$img_src = get_the_post_thumbnail_url( $post_id, 'large' );

		if ( preg_match( '#youtu#', $video_url, $match ) ) {

			echo milu_youtube_video_bg( $video_url, $img_src );

		} elseif ( preg_match( '#.vimeo#', $video_url, $match ) ) {

			echo milu_vimeo_bg( $video_url );

		} elseif ( preg_match( '#.mp4#', $video_url, $match ) ) {

			echo milu_video_bg( $video_url );
		}
	}
}

/**
 * Display social networks in author bio box
 */
function milu_author_socials( $author_id = null ) {

	if ( ! $author_id ) {
		$author_id = get_the_author_meta( 'ID' );
	}

	$name = get_the_author_meta( 'user_nicename', $author_id );
	$website = get_the_author_meta( 'user_url', $author_id );

	if ( function_exists( 'wvc_get_team_member_socials' ) ) {

		$services = wvc_get_team_member_socials();

		foreach ( $services as $service ) {

			$link = get_the_author_meta( $service );
			$icon_slug = $service;

			$title_attr = sprintf( esc_html__( 'Visit %s\'s %s profile', 'milu' ),
					$name, ucfirst( $service ) );

			if ( 'email' === $service ) {
				$icon_slug = 'envelope';
				$title_attr = sprintf( esc_html__( 'Send an email to %s', 'milu' ), $name );
			}

			if ( $link ) {
				echo '<a target="_blank" title="' . esc_attr( $title_attr ) . '" href="'. esc_url( $link ) .'" class="author-link hastip"><i class="fa fa-' . $icon_slug . '"></i></a>';
			}
		}
	} else {
		
		$googleplus = get_the_author_meta( 'googleplus', $author_id );
		$twitter = get_the_author_meta( 'twitter', $author_id );
		$facebook = get_the_author_meta( 'facebook', $author_id );

		if ( $facebook ) {
			echo '<a target="_blank" title="' . esc_attr( sprintf( __( 'Visit %s\'s Facebook profile', 'milu' ), $name ) ). '" href="'. esc_url( $facebook ) .'" class="author-link"><i class="fa fa-facebook"></i></a>';
		}

		if ( $twitter ) {
		}

		if ( $googleplus ) {
			echo '<a target="_blank" title="' . esc_attr( sprintf( __( 'Visit %s\'s Google+ profile', 'milu' ), $name ) ). '" href="'. esc_url( $googleplus ) .'" class="author-link hastip"><i class="fa fa-google"></i></a>';
		}
	}

	if ( $website ) {
		echo '<a target="_blank" title="' . esc_attr( sprintf( __( 'Visit %s\'s website', 'milu' ), $name ) ). '" href="'. esc_url( $website ) .'" class="author-link hastip"><i class="fa fa-link"></i></a>';
	}
}

/**
 * Template tag to display the loader
 */
function milu_spinner() {

	$loading_logo = milu_get_inherit_mod( 'loading_logo' );
	$loading_logo_animation = milu_get_inherit_mod( 'loading_logo_animation' );
	$loading_animation_type = milu_get_inherit_mod( 'loading_animation_type' );

	$show_logo = apply_filters( 'milu_display_loading_logo', ( $loading_logo && 'logo' === $loading_animation_type ) );

	if ( 'none' === $loading_animation_type ) {
		return;
	}
	?>
	<div class="loader">
	<?php if ( $show_logo ) : ?>
		<?php ob_start(); ?>
		<img class="loading-logo <?php echo sanitize_html_class( $loading_logo_animation ); ?>" src="<?php echo esc_url( $loading_logo ); ?>" alt="<?php esc_attr_e( 'loading logo', 'milu' ); ?>">
		<?php echo apply_filters( 'milu_loading_logo', ob_get_clean() ); ?>
	<?php else : ?>
		<?php get_template_part( apply_filters( 'milu_spinners_folder', 'components/spinner/' ) . $loading_animation_type ) ?>
	<?php endif; ?>
	</div><!-- #loader.loader -->
	<?php
}

/**
 * Search icon menu item
 */
function milu_search_menu_item( $echo = false ) {

	ob_start();
	?>
		<span title="<?php esc_attr_e( 'Search', 'milu' ); ?>" class="search-item-icon toggle-search"></span>
	<?php
	$search_item = ob_get_clean();

	if ( $echo ) {
		echo apply_filters( 'milu_search_menu_item_html', $search_item );
	}

	return apply_filters( 'milu_search_menu_item_html', $search_item );
}

if ( ! function_exists( 'milu_account_menu_item' ) ) {
	/**
	 * Account menu item
	 */
	function milu_account_menu_item( $echo = true ) {

		if ( ! function_exists( 'wc_get_page_id' ) ) {
			return;
		}

		$label = esc_html__( 'Sign In or Register', 'milu' );
		$class = 'account-item-icon';

		if ( is_user_logged_in() ) {
			$label = esc_html__( 'My account', 'milu' );
			$class .= ' account-item-icon-user-logged-in';
		} else {
			$label = esc_html__( 'Sign In or Register', 'milu' );
			$class .= ' account-item-icon-user-not-logged-in';
		}

		if ( WP_DEBUG ) {
			$class .= ' account-item-icon-user-not-logged-in';
		}

		$account_url = get_permalink( wc_get_page_id( 'myaccount' ) );

		ob_start();
		?>
			<a class="<?php echo milu_sanitize_html_classes( $class ); ?>" href="<?php echo esc_url( $account_url ); ?>" title="<?php echo esc_attr( $label ); ?>">
			</a>
		<?php
		$account_item = ob_get_clean();

		if ( $echo ) {
			echo apply_filters( 'milu_account_menu_item_html', $account_item );
		}

		return apply_filters( 'milu_account_menu_item_html', $account_item );
	}
}

if ( ! function_exists( 'milu_cart_menu_item' ) ) {
	/**
	 * Cart menu item
	 */
	function milu_cart_menu_item( $echo = true ) {

		if ( ! function_exists( 'wc_get_cart_url' ) ) {
			return;
		}

		$product_count = WC()->cart->get_cart_contents_count();

		ob_start();
		?>
			<a href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'Cart', 'milu' ); ?>" class="cart-item-icon toggle-cart">
				<span class="cart-icon-product-count"><?php echo absint( $product_count ); ?></span>
			</a>
		<?php
		$cart_item = ob_get_clean();

		if ( $echo ) {
			echo apply_filters( 'milu_cart_menu_item_html', $cart_item );
		}

		return apply_filters( 'milu_cart_menu_item_html', $cart_item );
	}
}

/**
 * Cart menu item for mobile menu
 */
function milu_cart_menu_item_mobile( $echo = true ) {

	if ( ! function_exists( 'wc_get_page_id' ) ) {
		return;
	}

	$cta_content = milu_get_inherit_mod( 'menu_cta_content_type', 'search_icon' );

	if ( 'shop_icons' !== $cta_content ) {
		return;
	}

	$product_count = WC()->cart->get_cart_contents_count();
	ob_start();
	?>
		<a href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_attr_e( 'Cart', 'milu' ); ?>" class="cart-item-mobile toggle-cart-mobile">
			<span class="cart-label-mobile"><?php esc_html_e( 'Cart', 'milu' ); ?>
			<span class="cart-icon-product-count"><?php echo absint( $product_count ); ?></span>
			</span>
		</a>
	<?php
	$cart_item = ob_get_clean();

	if ( $echo ) {
		echo apply_filters( 'milu_cart_menu_item_mobile_html', $cart_item );
	}

	return apply_filters( 'milu_cart_menu_item_mobile_html', $cart_item );
}

if ( ! function_exists( 'milu_wishlist_menu_item' ) ) {
	/**
	 * Wishlist menu item
	 */
	function milu_wishlist_menu_item( $echo = true ) {

		if ( ! function_exists( 'wolf_get_wishlist_url' ) ) {
			return;
		}

		$wishlist_url = wolf_get_wishlist_url();
		ob_start();
		?>
			<a href="<?php echo esc_url( $wishlist_url ); ?>" title="<?php esc_attr_e( 'My Wishlist', 'milu' ); ?>" class="wishlist-item-icon"></a>
		<?php
		$wishlist_item = ob_get_clean();

		if ( $echo ) {
			echo apply_filters( 'milu_wishlist_menu_item_html', $wishlist_item );
		}

		return apply_filters( 'milu_wishlist_menu_item_html', $wishlist_item );
	}
}

if ( ! function_exists( 'milu_cart_panel' ) ) {
/**
 * Cart menu item
 */
function milu_cart_panel() {

	if ( ! function_exists( 'WC' ) ) {
		return;
	}

	$cart_url = wc_get_cart_url();
	$checkout_url = wc_get_checkout_url();
	$items = WC()->cart->get_cart();

	ob_start();
	?>
		<div class="cart-panel">
			<ul class="cart-item-list">
				<?php if ( $items ) : ?>
					<?php foreach ( $items as $cart_item_key => $cart_item ) : ?>
						<?php
							$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
							$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
							<li class="cart-item-list-item clearfix">
								<span class="cart-item-image">
									<?php $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

										if ( ! $product_permalink ) {
											echo milu_kses( $thumbnail );
										} else {
											printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
										} ?>
								</span>
								<span class="cart-item-details">
									<span class="cart-item-title">
										<?php
											if ( ! $product_permalink ) {
												echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
											} else {
												echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
											}
										?>
									</span>
									<span class="cart-item-price">
										<?php echo esc_attr( $cart_item['quantity'] ); ?> x
										<?php
											echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
										?>
									</span>

								</span>
							</li>
						<?php endif; // endif visible ?>
					<?php endforeach; ?>

					<li class="cart-panel-subtotal">
						<span class="cart-subtotal-label">
							<?php esc_html_e( 'Subtotal', 'milu' ); ?>:
						</span>
						<span class="cart-subtotal">
							<?php echo WC()->cart->get_cart_subtotal(); ?>
						</span>
					</li>
					<li class="cart-panel-buttons">
						<a href="<?php echo wc_get_cart_url(); ?>">
							<i class="fa cart-panel-cart-icon"></i>
							<?php esc_html_e( 'View Cart', 'milu' ) ?>
						</a>
						<a href="<?php echo wc_get_checkout_url(); ?>">
							<i class="fa cart-panel-checkout-icon"></i>
							<?php esc_html_e( 'Checkout', 'milu' ); ?>
						</a>
					</li>
				<?php else : ?>
					<li class="cart-panel-no-product"><?php esc_html_e( 'No product in cart yet.', 'milu' ); ?></li>
				<?php endif; ?>
			</ul><!-- .cart-item-list -->
		</div><!-- .cart-panel -->
	<?php
	$cart_item = ob_get_clean();

	return $cart_item;
}
} // end function check

/**
 * Get audio embed content
 */
function milu_get_audio_embed_content( $embed = true ) {
	$audio = null;

	$pattern = get_shortcode_regex();
	$first_url = milu_get_first_url();

	$shortcodes = array(
		'audio',
		'playlist',
		'wolf_jplayer_playlist',
		'wolf_playlist',
		'wvc_playlist',
		'wvc_audio',
		'wvc_audio_embed',
		'mixcloud',
		'reverbnation',
		'soundcloud',
		'spotify',
	);

	if ( milu_is_audio_embed_post() ) {

		if ( $embed ) {
			$audio = wp_oembed_get( $first_url );
		} else {
			$audio = $first_url;
		}

	} else {
		foreach ( $shortcodes as $shortcode ) {
			if ( milu_shortcode_preg_match( $shortcode ) ) {
				$match = milu_shortcode_preg_match( $shortcode );
				if ( $embed ) {
					$audio = do_shortcode( $match[0] );
				} else {
					$audio = $match[0];
				}
				break;
			}
		}
	}

	return $audio;
}

/**
 * Output primary desktop navigation
 */
function milu_primary_desktop_navigation() {
	get_template_part( 'components/menu/menu', 'desktop' );
}

/**
 * Output primary vertical navigation
 */
function milu_primary_vertical_navigation() {
	get_template_part( 'components/menu/menu', 'vertical' );
}

/**
 * Output secondary desktop navigation
 */
function milu_secondary_desktop_navigation() {
	get_template_part( 'components/menu/menu', 'secondary' );
}

/**
 * Output primary mobile navigation
 */
function milu_primary_mobile_navigation() {
	get_template_part( 'components/menu/menu', 'mobile' );
}

/**
 * Hamburger icon
 */
function milu_hamburger_icon( $class = 'toggle-mobile-menu' ) {

	if ( 'toggle-side-panel' === $class ) {
		$title_attr = esc_html__( 'Side Panel', 'milu' );
	} else {
		$title_attr = esc_html__( 'Menu', 'milu' );
	}

	ob_start();
	?>
	<a class="hamburger-icon <?php echo esc_attr( $class ); ?>" href="#" title="<?php echo esc_attr( $title_attr ); ?>">
		<span class="line line-1"></span>
		<span class="line line-2"></span>
		<span class="line line-3"></span>
	</a>
	<?php
	$html = ob_get_clean();

	echo apply_filters( 'wolfthemes_hamburger_icon', wp_kses( $html, array(
		'a' => array(
			'class' => array(),
			'href' => array(),
			'title' => array(),
		),
		'span' => array(
			'class' => array(),
		),
	) ), $class, $title_attr );
}

/**
 * Returns page title outside the loop
 *
 * @return string
 */
function milu_output_post_title() {

	if ( is_author() && class_exists( 'Wolf_Photos' ) ) {
		
		get_template_part( 'components/post/author', 'heading' );
		rewind_posts();
	
	} elseif ( milu_get_post_title() ) {

		$title = milu_get_post_title();
		$title_inline_style = '';
		$title_class = 'post-title entry-title';

		/* Big text & custom header font */
		if ( is_single() || is_page() ) {

			$bigtext = get_post_meta( get_the_ID(), '_post_hero_title_bigtext', true );
			$font_family = get_post_meta( get_the_ID(), '_post_hero_title_font_family', true );
			$font_transform = get_post_meta( get_the_ID(), '_post_hero_title_font_transform', true );

			if ( $bigtext ) {
				$title_class .= ' wvc-bigtext';
			}

			if ( $font_family ) {
				$title_inline_style .= 'font-family:' . esc_attr( $font_family ) . ';';
			}

			if ( $font_transform ) {
				$title_class .= ' text-transform-' . esc_attr( $font_transform );
			}
		}

		$output = '<h1 itemprop="name" style="' . milu_esc_style_attr( $title_inline_style ) . '" class="' . milu_sanitize_html_classes( $title_class ) . '"><span>' . sanitize_text_field( apply_filters( 'milu_page_title', $title ) ) . '</span></h1>';

		echo milu_kses( $output );
	}
}
add_action( 'milu_hero_title', 'milu_output_post_title' );

/**
 * Returns page title outside the loop
 *
 * @return string
 */
function milu_get_post_title() {

	$title = get_the_title();

	if ( milu_is_home_as_blog() ) {
		$title = get_bloginfo( 'description' );
	}

	/* Main condition not 404 and not woocommerce page */
	if ( ! is_404() && ! milu_is_woocommerce_page() ) {

	 	if ( milu_is_blog() ) {
			
			if ( is_category() ) {

				$title = single_cat_title( '', false );

			} elseif ( is_tag() ) {

				$title = single_tag_title( '', false );

			} elseif ( is_author() ) {
				
				$title = get_the_author();

			} elseif ( is_day() ) {

				$title = get_the_date();

			} elseif ( is_month() ) {

				$title = get_the_date( 'F Y' );

			} elseif ( is_year() ) {

				$title = get_the_date( 'Y' );

			/* is blog index */
			} elseif ( milu_is_blog_index() && ! milu_is_home_as_blog() ) {

				$title = get_the_title( get_option( 'page_for_posts' ) );
			}

		} elseif ( is_tax() ) {
			
			$queried_object = get_queried_object();

			if ( is_object( $queried_object ) && isset( $queried_object->name ) ) {
				$title = $queried_object->name;
			}

		} elseif ( isset( $_GET['s'] ) && isset( $_GET['post_type'] ) && 'attachment' === $_GET['post_type'] ) {

			$s = esc_attr( $_GET['s'] );

			$title = sprintf( esc_html__( 'Search results for %s', 'milu' ), '<span class="search-query-text">&quot;' . esc_html( $s ) . '&quot;</span>' );

		} elseif ( is_single() ) {
			
			$title = get_the_title();
		}

	} elseif ( milu_is_woocommerce_page() ) { // shop title

		if ( is_shop() || is_product_taxonomy() ) {
			
			$title = ( function_exists( 'woocommerce_page_title' ) ) ? woocommerce_page_title( false ) : '';
		
		} else {
			$title = get_the_title();
		}
	}

	if ( is_search() ) {

		$s = ( isset( $_GET['s'] ) ) ? esc_attr( $_GET['s'] ) : '';

		$title = sprintf( esc_html__( 'Search results for %s', 'milu' ), '<span class="search-query-text">&quot;' . $s . '&quot;</span>' );
	}

	return $title;
}

/**
 * Return the subheading of a post
 *
 * @param int $post_id
 * @return string
 */
function milu_get_the_subheading( $post_id = null ) {

	if ( ! $post_id ) {
		$post_id = milu_get_the_ID();
	}

	if ( milu_is_woocommerce_page() ) {
		if ( is_shop() || is_product_taxonomy() ) {
			$post_id = ( function_exists( 'milu_get_woocommerce_shop_page_id' ) ) ? milu_get_woocommerce_shop_page_id() : false;
		}
	}

	return get_post_meta( $post_id, '_post_subheading', true );
}

/**
 * Fire add to wishlist function
 *
 * If Wolf WooCommerce Wishlist is installed, it will output the add to wishlist button
 */
function milu_add_to_wishlist() {
	if ( function_exists( 'wolf_add_to_wishlist' ) ) {
		wolf_add_to_wishlist();
	}
}

/**
 * Display slideshow background
 *
 * @param array $args
 * @return string $output
 */
function milu_entry_slider( $args = array() ) {

	extract( wp_parse_args( $args, array(
		'slideshow_image_size' => 'milu-slide',
		'slideshow_img_ids' => '',
		'slideshow_speed' => 4000,
	) ) );

	$output = '';

	if ( '' == $slideshow_img_ids ) {

		$slideshow_img_ids = milu_get_post_gallery_ids();
	}

	$slideshow_img_ids = milu_list_to_array( $slideshow_img_ids );

	if ( array() != $slideshow_img_ids ) {

		$slideshow_img_ids = array_slice( $slideshow_img_ids, 0, 3 ); // first 3 ids only

		$output .= '<div data-slideshow-speed="' . absint( $slideshow_speed ) . '" class="entry-slider flexslider"><ul class="slides">';

		foreach ( $slideshow_img_ids as $image_id ) {

			$output .= '<li class="slide">';
			$output .= wp_get_attachment_image( $image_id, $slideshow_image_size );
			$output .= '</li>';
		}

		$output .= '</ul></div>';
	}

	return $output;
}

/**
 * Filter password form
 */
function milu_get_the_password_form( $output ) {

	global $post;
	$post = get_post( $post );
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form clearfix" method="post">
	<p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'milu' ) . '</p>
	<p><label for="' . $label . '">' . esc_html__( 'Password:', 'milu' ) . '</label> <input name="post_password" id="' . $label . '" type="password"> <input class="password-submit" type="submit" name="Submit" value="' . esc_attr_x( 'Enter', 'post password form', 'milu' ) . '" /></p></form>
	';

	return $output;
}
add_filter( 'the_password_form', 'milu_get_the_password_form' );

/**
 * Excerpt more
 * Render "Read more" link text differenttly depending on post format
 *
 * @return string
 */
function milu_more_text() {

	$text = '<span>' . esc_html__( 'Continue reading', 'milu' ) . '</span>';

	return apply_filters( 'milu_more_text', $text );
}

/**
 * Output "more" button
 */
function milu_more_button() {

	return '<a rel="bookmark" class="' . apply_filters( 'milu_more_link_button_class', 'more-link' ) . '" href="'. get_permalink() . '">' . milu_more_text() . '</a>';
}

/**
 * Add custom class to the more link
 *
 * @param string $link
 * @param string $text
 */
function milu_add_more_link_class( $link, $text ) {

	return str_replace(
		'more-link',
		apply_filters( 'milu_more_link_button_class', 'more-link' ),
		$link
	);
}
add_action( 'the_content_more_link', 'milu_add_more_link_class', 10, 2 );

/**
 * Get exceprt lenght
 */
function milu_get_excerpt_lenght() {
	return absint( apply_filters( 'milu_excerpt_length', 14 ) );
}

/**
 * Excerpt length hook
 * Set the number of character to display in the excerpt
 *
 * @param int $length
 * @return int
 */
function milu_excerpt_length( $length ) {

	if ( is_single() ) {
		$lenght = 999999;
	} else {
		$lenght = milu_get_excerpt_lenght();
	}

	return $length;
}
add_filter( 'excerpt_length', 'milu_excerpt_length' );

/**
 * Excerpt "more" link
 *
 * @param string $more
 * @return string
 */
function milu_excerpt_more( $more ) {

	return '...<p>' . milu_more_button() . '</p>';
}
add_filter( 'excerpt_more', 'milu_excerpt_more' );

/**
 * Filter previous comments link
 */
function milu_comments_link_prev_class( $atts ) {

	return 'class="pagination-icon-prev"';
}
add_filter( 'previous_comments_link_attributes', 'milu_comments_link_prev_class' );

/**
 * Filter next comments link
 */
function milu_comments_link_next_class( $atts ) {
	return 'class="pagination-icon-next"';
}
add_filter( 'next_comments_link_attributes', 'milu_comments_link_next_class' );

/**
 * Get one page menu
 */
function milu_one_page_menu( $context = 'desktop', $vertical = false ) {

	if ( ! is_page() ) {
		return;
	}

	$output = '';

	global $post;

	$content = $post->post_content;
	$pattern = get_shortcode_regex();

	if ( preg_match_all( '/'. $pattern .'/s', $content, $matches )
		&& array_key_exists( 2, $matches )
		&& in_array( 'vc_row', $matches[2] )
	) {

		$rows = $matches[0];
		$output .= '<div class="menu-one-page-menu-container">';

		if ( 'mobile' === $context ) {
			$output .= '<ul id="site-navigation-primary-mobile" class="nav-menu nav-menu-mobile">';
		} else {

			$menu_class = ( $vertical ) ? 'nav-menu-vertical' : 'nav-menu-desktop';

			$output .= '<ul id="site-navigation-primary-desktop" class="nav-menu ' . esc_attr( $menu_class ) . '">';
		}

		$scroll_link_class = ( milu_do_fullpage() ) ? 'wvc-fp-nav' : 'scroll';

		foreach ( $rows as $row ) {

			$reg_ex = apply_filters( 'milu_row_name_reg_ex', '[a-zA-ZŽžšŠÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçČčÌÍÎÏìíîïÙÚÛÜùúûüÿÑñйА-яц一-龯0-9 #!?$@.;&-]+' );

			/* Is there a section name attr? */
			if ( preg_match( '/row_name="' . $reg_ex . '"/', $row, $match_row_name ) ) {

				if ( isset( $match_row_name[0] ) ) {
					$row_name = str_replace( array( 'row_name="', '"' ), '', $match_row_name[0] );
					$anchor = sanitize_title( $row_name );
					$output .= '<li class="menu-item menu-item-type-custom menu-item-object-custom">';
					
					$output .= '<a href="#' . esc_attr( $anchor ) . '" class="menu-link ' . esc_attr( $scroll_link_class ) . '">';
					
					$output .= '<span class="menu-item-inner">';
					$output .= '<span class="menu-item-text-container" itemprop="name">';
					$output .= $row_name;
					$output .= '</span>';
					$output .= '</span>';
					$output .= '</a>';
					$output .= '</li>';
				}
			}
		}
		$output .= '</ul></div>';
	}

	return $output;
}

if ( ! function_exists( 'milu_entry_tags' ) ) {
	/**
	 * Get the entry tags
	 */
	function milu_entry_tags( $echo = true ) {

		$output = '';

		if ( get_the_tag_list() ) {
			ob_start();
			?>
			<span class="entry-tags-list">
				<?php echo apply_filters( 'milu_entry_tag_list_icon', '<span class="meta-icon hashtag"></span>' ); ?>
				<?php echo get_the_tag_list( '', apply_filters( 'milu_entry_tag_list_separator', ' ' ) ); ?>
			</span>
			<?php
			$output = ob_get_clean();

			if ( $echo ) {
				echo wp_kses( $output, array(
					'span' => array(
						'class' => array(),
					),
					'a' => array(
						'class' => array(),
						'href' => array(),
						'rel' => array(),
					),
				) );
			}

			return $output;
		}
	}
}

if ( ! function_exists( 'milu_post_thumbnail' ) ) {
	/**
	 * Post thumbnail
	 *
	 * @param string size
	 * @return string image
	 */
	function milu_post_thumbnail( $size = '', $post_id = null ) {

		$thumbnail = get_the_post_thumbnail( '', $size );

		if ( ! $thumbnail && milu_is_instagram_post( $post_id ) ) {
			$thumbnail = milu_get_instagram_image( milu_get_first_url( $post_id ) );
		}

		return $thumbnail;
	}
}

if ( ! function_exists( 'milu_justified_post_thumbnail' ) ) {
	/**
	 * Post thumbnail
	 */
	function milu_justified_post_thumbnail( $size = 'milu-photo', $post_id = '', $echo = true ) {

		$thumbnail = '';
		$post_id = ( $post_id ) ? $post_id : get_post_thumbnail_id();
		$src = wp_get_attachment_image_src( $post_id, $size );
		$src = $src[0];
		$image_alt = get_post_meta( $post_id, '_wp_attachment_image_alt', true);

		$metadata = wp_get_attachment_metadata( $post_id );
		$width = '';
		$height = '';

		if ( isset( $metadata['sizes'][ $size ] ) ) {
			$width = $metadata['sizes'][ $size ]['width'];
			$height = $metadata['sizes'][ $size ]['height'];
		}

		ob_start(); ?>
		<img
			class="lazy-hidden"
			width="<?php echo esc_attr( $width ); ?>"
			height="<?php echo esc_attr( $height ); ?>"
			src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/blank.gif' ); ?>"
			title="<?php echo esc_attr( get_the_title() ); ?>"
			alt="<?php echo esc_attr( $image_alt  ); ?>"
			data-src="<?php echo esc_url( $src ); ?>"
		>
		<?php
		$thumbnail = ob_get_clean();

		if ( $echo ) {
			echo milu_kses( $thumbnail );
		}

		return $thumbnail;
	}
}

/**
 * Metro entry title
 *
 * Use for the metro_modern_alt only ATM
 */
function milu_post_grid_entry_title( $title = null ) {
	
	if ( ! $title ) {
		$title = get_the_title();
	}

	$format = get_post_format();
	$the_permalink = ( 'link' === $format && milu_get_first_url() ) ? milu_get_first_url() : get_the_permalink();
	
	$product_id = get_post_meta( get_the_ID(), '_post_wc_product_id', true );
	if ( $product_id && 'publish' == get_post_status( $product_id ) ) {
		$format = 'product';
	}

	if ( ! milu_is_short_post_format() && 'product' !== $format ) : ?>
		<span class="date-label">
			<?php if ( is_sticky() ) : ?>
				<?php esc_html_e( 'Featured', 'milu' ); ?>
			<?php else : ?>
				<?php milu_entry_date(); ?>
			<?php endif; ?>
		</span>
	<?php endif; ?>
	<span class="entry-summary">
		<?php if ( 'video' === $format  ) : ?>
			<?php if ( milu_get_first_video_url() ) : ?>
				<a href="<?php echo milu_get_first_video_url(); ?>" class="post-play-video-icon lightbox-video">
			<?php endif; ?>
			<span class="format-label"><?php esc_html_e( 'Watch', 'milu' ); ?></span>
			<?php if ( milu_get_first_video_url() ) : ?>
				</a>
			<?php endif; ?>
			<br>
		<?php elseif ( 'audio' === $format  ) : ?>
			<?php if ( milu_get_first_mp3_url() ) : ?>
				<a title="<?php esc_attr_e( 'Play audio', 'milu' ); ?>" href="<?php echo milu_get_first_mp3_url(); ?>" class="post-play-audio-icon loop-post-play-button">
			<?php endif; ?>
			<span class="format-label"><?php esc_html_e( 'Listen', 'milu' ); ?></span>
			<?php if ( milu_get_first_mp3_url() ) : ?>
				</a>
				<audio class="loop-post-player-audio" id="<?php echo esc_attr( uniqid( 'loop-post-player-audio-' ) ); ?>" src="<?php echo esc_url( milu_get_first_mp3_url() ); ?> "></audio>
			<?php endif; ?>
			<br>

		<?php elseif ( 'product' === $format  ) :
			$product = wc_get_product( $product_id );
			$permalink = get_permalink( $product->get_id() );
			$price = $product->get_price_html();
			$button_class = apply_filters( 'milu_post_product_button', 'button post-product-button' );
		?>
			<a href="<?php echo esc_url( $the_permalink ); ?>">
				<h2 class="entry-title"><?php echo milu_kses( $title ); ?></h2>
			</a>
			<?php if ( $price ) : ?>
				<span class="post-product-price">
					<?php echo milu_kses( $price ); ?>
				</span>
			<?php endif; ?>
			<a class="<?php echo milu_sanitize_html_classes( $button_class ); ?>" href="<?php echo esc_url( $permalink ); ?>"><?php esc_html_e( 'Shop Now', 'milu' ); ?></a>
		<?php endif; ?>
		<?php if ( 'product' !== $format ) : ?>
			<a href="<?php echo esc_url( $the_permalink ); ?>">
				<h2 class="entry-title"><?php echo milu_kses( $title ); ?></h2>
				<?php if ( ! milu_is_short_post_format() && 'video' !== $format && 'audio' !== $format ) : ?>
					<span class="view-post"><?php esc_html_e( 'View post', 'milu' ); ?></span>
				<?php endif; ?>
			</a>
		<?php endif ?>
	</span>
	<?php
}

/**
 * Returns the content for dtandard post layout without the featured media if any
 */
function milu_content( $more_text ) {
	global $post;

	$the_content = '';

	if ( ! is_single() && $post->post_excerpt || is_search() ) {
		
		$the_content = get_the_excerpt();
	
	} else {

		$media_to_filter = '';
		$content = get_the_content( $more_text );

		if ( milu_is_instagram_post() ) {
			$media_to_filter = milu_get_first_url();
		}

		if ( milu_is_video_post() ) {
			$media_to_filter = milu_get_first_video_url();
		}

		if ( $media_to_filter ) {

			$content = str_replace( $media_to_filter, '', $content );
		}

		$the_content = apply_filters( 'the_content', $content );
	}

	return $the_content;
}

/*=======================
 * Post Content Standard hook
 =======================*/

/**
 * Post Sticky Label
 */
function milu_output_post_content_standard_sticky_label() {

	if ( is_sticky() && ! is_paged() ) {
		echo '<span class="sticky-post" title="' . esc_attr( __( 'Featured', 'milu' ) ) . '"></span>';
	}
}
add_action( 'milu_before_post_content_standard', 'milu_output_post_content_standard_sticky_label' );

/**
 * Post Media
 */
function milu_output_post_content_standard_media( $post_display_elements ) {

	if ( in_array( 'show_thumbnail', $post_display_elements ) || 'link' === get_post_format() ) {
		if ( milu_featured_media() ) { ?>
			<div class="entry-media">
				<?php echo milu_featured_media(); ?>
			</div>
		<?php }
	}
}
add_action( 'milu_before_post_content_standard_title', 'milu_output_post_content_standard_media', 10, 1 );

/**
 * Post Date
 */
function milu_output_post_content_standard_date( $post_display_elements ) {
	if ( in_array( 'show_date', $post_display_elements ) && '' == get_post_format() || 'video' === get_post_format() || 'gallery' === get_post_format() || 'image' === get_post_format() || 'audio' === get_post_format() ) { ?>
		<span class="entry-date">
			<?php milu_entry_date( true, true ); ?>
		</span>
	<?php
	}
}
add_action( 'milu_before_post_content_standard_title', 'milu_output_post_content_standard_date', 10, 1 );

/**
 * Post title
 */
function milu_output_post_content_standard_title() {

	if ( '' == get_post_format() || 'video' === get_post_format() || 'gallery' === get_post_format() || 'image' === get_post_format() || 'audio' === get_post_format() ) {
		the_title( '<h2 class="entry-title"><a class="entry-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}
}
add_action( 'milu_post_content_standard_title', 'milu_output_post_content_standard_title' );

/**
 * Post Text
 */
function milu_output_post_content_standard_excerpt( $post_display_elements, $post_excerpt_type ) {
	if ( in_array( 'show_text', $post_display_elements ) ) {
		if ( ! milu_is_short_post_format() ) { ?>
			<div class="entry-summary clearfix">
				<?php
					
					/**
					 * The excerpt
					 */
					do_action( 'milu_the_excerpt', $post_excerpt_type );

					wp_link_pages( array(
						'before'      => '<div class="clear"></div><div class="page-links clearfix">' . esc_html__( 'Pages:', 'milu' ),
						'after'       => '</div>',
						'link_before' => '<span class="page-number">',
						'link_after'  => '</span>',
					) );
				?>
			</div>
		<?php }
	}
}
add_action( 'milu_after_post_content_standard_title', 'milu_output_post_content_standard_excerpt', 10, 2 );

/**
 * Post meta
 */
function milu_output_post_content_standard_meta( $post_display_elements ) {
	$show_author = ( in_array( 'show_author', $post_display_elements ) );
	$show_category = ( in_array( 'show_category', $post_display_elements ) );
	$show_tags = ( in_array( 'show_tags', $post_display_elements ) );
	$show_extra_meta = ( in_array( 'show_extra_meta', $post_display_elements ) );
	?>
	<?php if ( ( $show_author || $show_extra_meta || $show_category || milu_edit_post_link( false ) ) && ! milu_is_short_post_format() ) : ?>
			<footer class="entry-meta">
				<?php if ( $show_author ) : ?>
					<?php milu_get_author_avatar(); ?>
				<?php endif; ?>
				<?php if ( $show_category ) : ?>
					<span class="entry-category-list">
						<?php echo apply_filters( 'milu_entry_category_list_icon', '<span class="meta-icon category-icon"></span>' ); ?>
						<?php echo get_the_term_list( get_the_ID(), 'category', '', esc_html__( ', ', 'milu' ), '' ) ?>
					</span>
				<?php endif; ?>
				<?php if ( $show_tags ) : ?>
					<?php milu_entry_tags(); ?>
				<?php endif; ?>
				<?php if ( $show_extra_meta ) : ?>
					<?php milu_get_extra_meta(); ?>
				<?php endif; ?>
				<?php milu_edit_post_link(); ?>
			</footer><!-- .entry-meta -->
		<?php endif; ?>
	<?php
}
add_action( 'milu_after_post_content_standard', 'milu_output_post_content_standard_meta', 10, 1 );

/*=======================
 * Post Content Masonry hook
 =======================*/

/**
 * Post Media
 */
function milu_output_post_content_grid_media( $post_display_elements = array(), $display = null ) {
	$show_thumbnail = ( in_array( 'show_thumbnail', $post_display_elements ) );
	$show_category = ( in_array( 'show_category', $post_display_elements ) );
	?>
	<?php if ( $show_thumbnail ) : ?>
		<?php if ( milu_has_post_thumbnail() || milu_is_instagram_post() ) : ?>
			<div class="entry-image">
				<?php if ( $show_category ) : ?>
					<a class="category-label" href="<?php echo milu_get_first_category_url(); ?>"><?php echo milu_get_first_category(); ?></a>
				<?php endif; ?>
				<?php
					if ( is_sticky() && ! is_paged() ) {
						echo '<span class="sticky-post" title="' . esc_attr( __( 'Featured', 'milu' ) ) . '"></span>';
					}
				?>
				<?php
					if (  'masonry' === $display ) {

						echo milu_post_thumbnail( 'milu-masonry' ); 

					} else {
						?>
						<div class="entry-cover">
							<?php
								echo milu_background_img( array( 'background_img_size' => 'medium', ) );
							?>
						</div><!-- entry-cover -->
						<?php
					}
				?>
			</div><!-- .entry-image -->
		<?php endif; ?>
	<?php endif; ?>
	<?php
}
add_action( 'milu_before_post_content_grid_title', 'milu_output_post_content_grid_media', 10, 2 );
add_action( 'milu_before_post_content_masonry_title', 'milu_output_post_content_grid_media', 10, 2 );


/**
 * Post Media
 */
function milu_output_post_content_metro_media( $post_display_elements, $display = 'metro' ) {
	$show_category = ( in_array( 'show_category', $post_display_elements ) );
	?>
	<div class="entry-image">
		<div class="entry-cover">
			<?php

				/**
				 * Post thumbnail
				 */
				
				$metro_size = apply_filters( 'milu_metro_thumbnail_size', 'milu-photo' );

				if ( $featured || milu_is_latest_post() || 'image' === get_post_format() ) {
					$metro_size = 'large';
				}

				$size = ( milu_is_gif( get_post_thumbnail_id() ) ) ? 'full' : $metro_size;
				echo milu_background_img( array( 'background_img_size' => $size, ) );
			?>
		</div><!-- .entry-cover -->
		<div class="entry-post-metro-overlay"></div>
	</div><!-- .entry-image -->
	<?php if ( $show_category && 'metro' === $display ) : ?>
		<a class="category-label" href="<?php echo milu_get_first_category_url(); ?>"><?php echo milu_get_first_category(); ?></a>
	<?php endif; ?>
	<?php
}
add_action( 'milu_before_post_content_metro_title', 'milu_output_post_content_metro_media', 10, 2 );

/**
 * Post Metro inner open tag
 */
function milu_output_post_content_metro_inner_open_tag( $post_display_elements ) {
	?>
	<div class="entry-inner">
	<?php
}
add_action( 'milu_before_post_content_metro_title', 'milu_output_post_content_metro_inner_open_tag', 10, 1 );

/**
 * Post Date
 */
function milu_output_post_content_grid_date( $post_display_elements, $display = 'grid' ) {
	$show_date = ( in_array( 'show_date', $post_display_elements ) );
	$show_category = ( in_array( 'show_category', $post_display_elements ) );
	?>
	
	<div class="entry-summary">
		<div class="entry-summary-inner">
			<?php if ( ! is_sticky() && $show_date ) : ?>
				<span class="entry-date">
					<?php milu_entry_date(); ?>
				</span>
			<?php endif;
}
add_action( 'milu_before_post_content_grid_title', 'milu_output_post_content_grid_date', 10, 1 );
add_action( 'milu_before_post_content_masonry_title', 'milu_output_post_content_grid_date', 10, 1 );
add_action( 'milu_before_post_content_metro_title', 'milu_output_post_content_grid_date', 10, 2 );

/**
 * Post title
 */
function milu_output_post_grid_title( $post_display_elements ) {
	$show_thumbnail = ( in_array( 'show_thumbnail', $post_display_elements ) );
	?>
	<h2 class="entry-title">
		<?php if ( ! milu_has_post_thumbnail() || ! $show_thumbnail ) : ?>
			<?php
				if ( is_sticky() && ! is_paged() ) {
					echo '<span class="sticky-post" title="' . esc_attr( __( 'Featured', 'milu' ) ) . '"></span>';
				}
			?>
		<?php endif; ?>
		<?php the_title(); ?>
	</h2>
	<?php
}
add_action( 'milu_post_content_grid_title', 'milu_output_post_grid_title' );
add_action( 'milu_post_content_masonry_title', 'milu_output_post_grid_title' );
add_action( 'milu_post_content_metro_title', 'milu_output_post_grid_title' );

/**
 * Post Text
 */
function milu_output_post_content_grid_excerpt( $post_display_elements, $post_excerpt_length, $display = 'grid' ) {

	$show_text = ( in_array( 'show_text', $post_display_elements ) );
	$show_thumbnail = ( in_array( 'show_thumbnail', $post_display_elements ) );
	$show_category = ( in_array( 'show_category', $post_display_elements ) );

	if ( 'metro' === $display ) {
		$post_excerpt_length = 5;
	}
	?>
	<?php if ( $show_text ) : ?>
		<div class="entry-excerpt">
			<?php do_action( 'milu_post_' . $display . '_excerpt', $post_excerpt_length ); ?>
		</div><!-- .entry-excerpt -->
	<?php endif; ?>
	<?php if ( $show_category && ( ! milu_has_post_thumbnail() || ! $show_thumbnail ) ) : ?>
		<div class="entry-category-list">
			<?php echo get_the_term_list( get_the_ID(), 'category', esc_html__( 'In', 'milu' ) . ' ', esc_html__( ', ', 'milu' ), '' ) ?>
		</div>
	<?php endif; ?>
	<?php
}
add_action( 'milu_after_post_content_grid_title', 'milu_output_post_content_grid_excerpt', 10, 3 );
add_action( 'milu_after_post_content_masonry_title', 'milu_output_post_content_grid_excerpt', 10, 3 );
add_action( 'milu_after_post_content_metro_title', 'milu_output_post_content_grid_excerpt', 10, 3 );

/**
 * Post meta
 */
function milu_output_post_content_grid_meta( $post_display_elements ) {
	$show_author = ( in_array( 'show_author', $post_display_elements ) );
	$show_tags = ( in_array( 'show_tags', $post_display_elements ) );
	$show_extra_meta = ( in_array( 'show_extra_meta', $post_display_elements ) );
	?>
	</div><!-- .entry-summary-inner -->
		<?php if ( $show_author || $show_tags || $show_extra_meta || milu_edit_post_link( false ) ) : ?>
			<div class="entry-meta">
				<?php if ( $show_author ) : ?>
					<?php milu_get_author_avatar(); ?>
				<?php endif; ?>
				<?php if ( $show_tags ) : ?>
					<?php milu_entry_tags(); ?>
				<?php endif; ?>
				<?php if ( $show_extra_meta ) : ?>
					<?php milu_get_extra_meta(); ?>
				<?php endif; ?>
				<?php milu_edit_post_link(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</div><!-- .entry-summary -->
	<?php
}
add_action( 'milu_after_post_content_grid', 'milu_output_post_content_grid_meta', 10, 1 );
add_action( 'milu_after_post_content_masonry', 'milu_output_post_content_grid_meta', 10, 1 );
add_action( 'milu_after_post_content_metro', 'milu_output_post_content_grid_meta', 10, 1 );

/**
 * Post Metro inner close tag
 */
function milu_output_post_content_metro_inner_close_tag( $post_display_elements ) {
	?>
	</div><!-- .entry-inner -->
	<?php
}
add_action( 'milu_after_post_content_metro', 'milu_output_post_content_metro_inner_close_tag', 10, 1 );