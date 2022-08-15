<?php
/**
 * Milu frontend theme specific functions
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/*--------------------------------------------------------------------

	FONTS

----------------------------------------------------------------------*/

/**
 * Add custom fonts
 */
function milu_add_google_font( $google_fonts ) {

	$default_fonts = array(
		'Open Sans' =>  'Open+Sans:400,700,900',
		'Muli' =>  'Muli:400,700,900',
		'Montserrat' =>  'Montserrat:400,700,900',
		'Roboto' =>  'Roboto:400,700,900',
	);

	foreach ( $default_fonts as $key => $value ) {
		if ( ! isset( $google_fonts[ $key ] ) ) {
			$google_fonts[ $key ] = $value;
		}
	}

	return $google_fonts;
}
add_filter( 'milu_google_fonts', 'milu_add_google_font' );

/**
 * Added selector to menu_selectors
 *
 * @param array $selectors
 * @return array $selectors
 */
function milu_add_menu_selectors( $selectors ) {

	$selectors[] = '.category-filter ul li a';
	$selectors[] = '.cart-panel-buttons a';

	return $selectors;
}
add_filter( 'milu_menu_selectors', 'milu_add_menu_selectors' );
/**
 * Added selector to heading_family_selectors
 *
 * @param array $selectors
 * @return array $selectors
 */
function milu_add_heading_family_selectors( $selectors ) {

	$selectors[] = '.wvc-tabs-menu li a';
	$selectors[] = '.woocommerce-tabs ul.tabs li a';
	$selectors[] = '.wvc-process-number';
	$selectors[] = '.wvc-button';
	$selectors[] = '.wvc-svc-item-title';
	$selectors[] = '.button';
	$selectors[] = '.onsale, .category-label';
	$selectors[] = '.entry-post-grid_classic .sticky-post';
	$selectors[] = '.entry-post-metro .sticky-post';
	$selectors[] = 'input[type=submit], .wvc-mailchimp-submit';
	$selectors[] = '.nav-next,.nav-previous';
	$selectors[] = '.wvc-embed-video-play-button';
	$selectors[] = '.wvc-ati-title';
	$selectors[] = '.wvc-team-member-role';
	$selectors[] = '.wvc-svc-item-tagline';
	$selectors[] = '.entry-metro insta-username';
	$selectors[] = '.wvc-testimonial-cite';
	$selectors[] = '.theme-button-special';
	$selectors[] = '.theme-button-special-accent';
	$selectors[] = '.theme-button-special-accent-secondary';
	$selectors[] = '.theme-button-solid';
	$selectors[] = '.theme-button-outline';
	$selectors[] = '.theme-button-solid-accent';
	$selectors[] = '.theme-button-outline-accent';
	$selectors[] = '.theme-button-solid-accent-secondary';
	$selectors[] = '.theme-button-outline-accent-secondary';
	$selectors[] = '.theme-button-text';
	$selectors[] = '.theme-button-text-accent';
	$selectors[] = '.theme-button-text-accent-secondary';
	$selectors[] = '.wvc-wc-cat-title';
	$selectors[] = '.wvc-pricing-table-button a';
	$selectors[] = '.view-post';
	$selectors[] = '.wolf-gram-follow-button';
	$selectors[] = '.wvc-pie-counter';
	$selectors[] = '.work-meta-label';
	$selectors[] = '.comment-reply-link';
	$selectors[] = '.logo-text, .date-block';
	$selectors[] = '.menu-button-primary a, .menu-button-secondary a';
	$selectors[] = '.single-post-nav-item > a, .post-nav-title, .related-posts .entry-title';

	return $selectors;
}
add_filter( 'milu_heading_family_selectors', 'milu_add_heading_family_selectors' );

/**
 * Added selector to heading_family_selectors
 *
 * @param array $selectors
 * @return array $selectors
 */
function milu_add_milu_heading_selectors( $selectors ) {

	$selectors[] = '.wvc-tabs-menu li a';
	$selectors[] = '.woocommerce-tabs ul.tabs li a';
	$selectors[] = '.wvc-process-number';
	$selectors[] = '.wvc-svc-item-title';
	$selectors[] = '.wvc-wc-cat-title';
	$selectors[] = '.logo-text';
	$selectors[] = '.onsale, .category-label';
	$selectors[] = '.single-post-nav-item > a, .post-nav-title';

	return $selectors;
}
add_filter( 'milu_heading_selectors', 'milu_add_milu_heading_selectors' );

/*--------------------------------------------------------------------

	POST TYPES DISPLAY

----------------------------------------------------------------------*/

/**
 * Get available display options for posts
 *
 * @return array
 */
function milu_set_post_display_options() {

	return array(
		'grid' => esc_html__( 'Grid', 'milu' ),
		'masonry' => esc_html__( 'Masonry', 'milu' ),
		'standard' => esc_html__( 'Standard', 'milu' ),
	);
}
add_filter( 'milu_post_display_options', 'milu_set_post_display_options' );

/**
 * Get available display options for works
 *
 * @return array
 */
function milu_set_work_display_options() {

	return array(
		'grid' => esc_html__( 'Grid', 'milu' ),
		'metro' => esc_html__( 'Metro', 'milu' ),
		'masonry' => esc_html__( 'Masonry', 'milu' ),
		'parallax' => esc_html__( 'Parallax', 'milu' ),
	);
}
add_filter( 'milu_work_display_options', 'milu_set_work_display_options' );

/**
 * Get available display options for products
 *
 * @return array
 */
function milu_set_product_display_options() {

	return array(
		'grid' => esc_html__( 'Grid', 'milu' ),
		'metro' => esc_html__( 'Metro', 'milu' ),
	);
}
add_filter( 'milu_product_display_options', 'milu_set_product_display_options' );

/**
 * Set shop display
 *
 * @param string $string
 * @return string
 */
function milu_set_product_display( $string ) {

	return 'grid';
}
add_filter( 'milu_mod_product_display', 'milu_set_product_display', 40 );

/*--------------------------------------------------------------------

	THEME HOOKS

----------------------------------------------------------------------*/

/**
 * Login popup markup
 *
 * @param bool $bool
 * @return bool
 */
function milu_login_form_markup() {
	if ( function_exists( 'wvc_login_form' ) && class_exists( 'WooCommerce' ) ) {

		$skin_class = apply_filters( 'milu_login_form_container_class', 'wvc-font-dark' );
		?>
		<div id="loginform-overlay">
			<div id="loginform-overlay-inner">
				<div id="loginform-overlay-content" class="<?php echo esc_attr( $skin_class ); ?>">
					<a href="#" id="close-vertical-bar-menu-icon" class="close-panel-button close-loginform-button">X</a>
					<?php echo wvc_login_form(); ?>
				</div>
			</div>
		</div>
		<?php
	}
}
add_action( 'milu_body_start', 'milu_login_form_markup', 5 );

add_filter( 'wvc_login_form_submit_button_class', function( $class ) {
	$class = 'button theme-button-solid';

	return $class;
} );

add_filter( 'milu_proceed_to_checkout_button_class', function( $class ) {
	$class = 'checkout-button button theme-button-solid';

	return $class;
} );

add_filter( 'milu_site_footer_class', function( $class ) {
	return 'wvc-font-light wvc-parent-row ' . $class;
} );

/**
 * One Letter Logo filter
 */
function milu_filter_logo_output( $html ) {

	if ( milu_get_inherit_mod( 'one_letter_logo' ) ) {
		$html = '<div class="logo logo-is-text one-letter-logo"><a class="logo-text logo-link" href="' . esc_url( home_url( '/' ) ) . '" rel="home">';

		$html .= milu_get_inherit_mod( 'one_letter_logo' );

		$html .= '</a></div>';
	}

	return $html;

}
add_filter( 'milu_logo_html', 'milu_filter_logo_output' );

/**
 * Add currency switcher
 */
function milu_output_currency_switcher() {
	
	$cta_content = milu_get_inherit_mod( 'menu_cta_content_type', 'none' );

	$is_wc_page_child = is_page() && wp_get_post_parent_id( get_the_ID() ) == milu_get_woocommerce_shop_page_id() && milu_get_woocommerce_shop_page_id();
	$is_wc = milu_is_woocommerce_page() || is_singular( 'product' ) || $is_wc_page_child;

	if ( apply_filters( 'milu_force_display_nav_shop_icons', $is_wc ) ) { // can be disable just in case
		$cta_content = 'shop_icons';
	}

	if ( 'shop_icons' === $cta_content && function_exists( 'wwcs_currency_switcher' ) && milu_get_inherit_mod( 'currency_switcher' )  ) {
		echo '<div class="cta-item currenty-switcher">';
		wwcs_currency_switcher();
		echo '</div>';
	}
}
add_action( 'milu_secondary_menu', 'milu_output_currency_switcher', 100 );

/**
 * Overwrite standard post entry slider image size
 */
function milu_overwrite_entry_slider_img_size( $size ) {

	add_image_size( 'milu-slide', 847, 508, true );
	add_image_size( 'milu-masonry', 700, 1500, false );
}
add_action( 'after_setup_theme', 'milu_overwrite_entry_slider_img_size', 50 );

/*--------------------------------------------------------------------

	NAVIGATION

----------------------------------------------------------------------*/

/**
 * Set sticky menu scrollpoint
 *
 * @param int|string $int
 * @return int
 */
function milu_set_sticky_menu_scrollpoint( $int ) {

	$int = 200;

	return $int;
}
add_filter( 'milu_sticky_menu_scrollpoint', 'milu_set_sticky_menu_scrollpoint' );

/**
 * Add vertical menu location
 */
function milu_add_lateral_menu( $menus ) {

	$menus['vertical'] = esc_html__( 'Vertical Menu (optional)', 'milu' );

	return $menus;

}
add_filter( 'milu_menus', 'milu_add_lateral_menu' );

/**
 * Set mobile menu template
 *
 * @param string $string
 * @return string
 */
function milu_set_mobile_menu_template( $string ) {

	return 'content-mobile-alt';
}
add_filter( 'milu_mobile_menu_template', 'milu_set_mobile_menu_template' );

/**
 * Add mobile closer overlay
 */
function milu_add_mobile_panel_closer_overlay() {
	?>
	<div id="mobile-panel-closer-overlay" class="panel-closer-overlay toggle-mobile-menu"></div>
	<?php
}
add_action( 'milu_main_content_start', 'milu_add_mobile_panel_closer_overlay' );

/**
 * Mobile menu
 */
function milu_mobile_alt_menu() {
	?>
	<div id="mobile-menu-panel">
		<a href="#" id="close-mobile-menu-icon" class="close-panel-button toggle-mobile-menu">X</a>
		<div id="mobile-menu-panel-inner">
		<?php
			/**
			 * Menu
			 */
			milu_primary_mobile_navigation();
		?>
		</div><!-- .mobile-menu-panel-inner -->
	</div><!-- #mobile-menu-panel -->
	<?php
}
add_action( 'milu_body_start', 'milu_mobile_alt_menu' );

/**
 * Secondary navigation hook
 *
 * Display cart icons, social icons or secondary menu depending on cuzstimizer option
 */
function milu_output_mobile_complementary_menu( $context = 'desktop' ) {
	if ( 'mobile' === $context ) {
		$cta_content = milu_get_inherit_mod( 'menu_cta_content_type', 'none' );

		/**
		 * Force shop icons on woocommerce pages
		 */
		$is_wc_page_child = is_page() && wp_get_post_parent_id( get_the_ID() ) == milu_get_woocommerce_shop_page_id() && milu_get_woocommerce_shop_page_id();
		$is_wc = milu_is_woocommerce_page() || is_singular( 'product' ) || $is_wc_page_child;

		if ( apply_filters( 'milu_force_display_nav_shop_icons', $is_wc ) ) { // can be disable just in case
			$cta_content = 'shop_icons';
		}

		if ( 'shop_icons' === $cta_content ) {
			if ( milu_display_account_menu_item() ) : ?>
				<div class="account-container cta-item">
					<?php
						/**
						 * account icon
						 */
						milu_account_menu_item();
					?>
				</div><!-- .cart-container -->
			<?php endif;
			
			if ( milu_display_cart_menu_item() ) {
			?>
				<div class="cart-container cta-item">
					<?php
						/**
						 * Cart icon
						 */
						milu_cart_menu_item();
					?>
				</div><!-- .cart-container -->
			<?php
			}
		}
	}
}
add_action( 'milu_secondary_menu', 'milu_output_mobile_complementary_menu', 10, 1 );

/**
 * Sidepanel font class
 */
function milu_set_sidepanel_font_class( $class ) {

	if ( milu_get_inherit_mod( 'side_panel_bg_img' ) ) {
		$class .= ' wvc-font-light';
	} else {
		if ( 'light' === milu_get_color_tone( milu_get_inherit_mod( 'submenu_background_color' ) ) ) {
			$class .= ' wvc-font-dark';
		} else {
			$class .= ' wvc-font-light';
		}
	}

	return $class;
}
add_filter( 'milu_side_panel_class', 'milu_set_sidepanel_font_class' );

/**
 *  Enable side panel with overlay menu
 *
 * @param string $layouts
 * @return string $layouts
 */
function milu_set_excluded_side_panel_menu_layout( $layouts ) {

	$overlay_key = null;
	foreach ( $layouts as $key => $value ) {
		if ( 'overlay' === $value ) {
			$overlay_key = $key;
		}
	}

	if ( $overlay_key && isset( $layouts[ $overlay_key ] ) ) {
		unset( $layouts[ $overlay_key ] );
	}

	return $layouts;
}
add_filter( 'milu_excluded_side_panel_menu_layout', 'milu_set_excluded_side_panel_menu_layout', 40 );

/*--------------------------------------------------------------------

	THEME FILTERS

----------------------------------------------------------------------*/

/**
 * Add additional JS scripts and functions
 */
function milu_enqueue_additional_scripts() {
	
	$version = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? time() : milu_get_theme_version();

	if ( ! milu_is_wvc_activated() ) {

		wp_register_style( 'ionicons', get_template_directory_uri() . '/assets/css/lib/fonts/ionicons/ionicons.min.css', array(), milu_get_theme_version() );
		wp_register_style( 'elegant-icons', get_template_directory_uri() . '/assets/css/lib/fonts/elegant-icons/elegant-icons.min.css', array(), milu_get_theme_version() );
		wp_register_style( 'dripicons', get_template_directory_uri() . '/assets/css/lib/fonts/dripicons-v2/dripicons.min.css', array(), milu_get_theme_version() );

		wp_register_script( 'wvc-accordion', get_template_directory_uri() . '/assets/js/wc-accordion.js', array( 'jquery' ), $version, true );
	}

	wp_register_script( 'visible', get_template_directory_uri() . '/assets/js/lib/jquery.visible.min.js', array( 'jquery' ), '1.3.0', true );

	if ( is_singular( 'product' ) ) {
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'wvc-accordion' );
	}

	wp_enqueue_style( 'ionicons' );
	wp_enqueue_style( 'dripicons' );
	wp_enqueue_style( 'elegant-icons' );
	wp_enqueue_script( 'jquery-effects-core' );
	wp_enqueue_script( 'parallax-scroll' );
	wp_enqueue_script( 'milu-custom', get_template_directory_uri() . '/assets/js/t/milu.js', array( 'jquery' ), $version, true );

	if ( 'hard' === milu_get_inherit_mod( 'menu_sticky_type' ) ) {
		wp_localize_script(
				'wolftheme', 'WolfFrameworkJSParams', array(
				'menuOffsetDesktop' => 66,
				'menuOffsetMobile' => 66,
				'menuOffsetBreakpoint' => 66,
				'menuOffset' => 66,
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'milu_enqueue_additional_scripts', 40 );

/**
 * Add addictional post class
 *
 * @param array
 * @return array
 */
function milu_additional_post_classes( $classes ) {

	$post_id = get_the_ID();
	$post_type = get_post_type();
	$force_is_loop = apply_filters( 'milu_post_force_loop_class', false );
	$loop_condition = ( ! is_single() && ! is_search() ) || milu_is_portfolio() || milu_is_videos() || milu_is_blog() || $force_is_loop || ( is_search() && milu_is_woocommerce_page() );

	if ( $loop_condition ) {
		if ( in_array( $post_type, array( 'post', 'product', 'video', 'work' ) ) ) {
			$skin = milu_get_inherit_mod( $post_type . '_skin', '', $post_id );
			if ( $skin ) {
				$classes[] = 'entry-post-skin-' . $skin;
			}
		}


		if ( 'product' === $post_type ) {
			global $product;

			if ( $product->get_gallery_image_ids() ) {
				$classes[] = 'entry-product-has-gallery';
			}

		}

	} else if ( is_singular( 'product' ) ) {
		$skin = milu_get_inherit_mod( $post_type . '_skin', '', $post_id );
		if ( $skin ) {
			$classes[] = 'entry-post-skin-' . $skin;
		}
	}

	return $classes;
}
add_filter( 'post_class', 'milu_additional_post_classes' );

/**
 * Add addictional body class
 *
 * @param array
 * @return array
 */
function milu_additional_body_classes( $classes ) {

	$sticky_details_meta = milu_get_inherit_mod( 'product_sticky' ) && 'no' !== milu_get_inherit_mod( 'product_sticky' );
	$single_product_layout = milu_get_inherit_mod( 'product_single_layout' );

	if ( is_singular( 'product' ) && $sticky_details_meta && 'sidebar-right' !== $single_product_layout && 'sidebar-left' !== $single_product_layout ) {
		$classes[] = 'sticky-product-details';
	}

	if ( milu_get_theme_mod( 'custom_cursor' ) ) {
		$classes[] = 'custom-cursor-enabled';
	}

	if ( get_post_meta( milu_get_the_ID(), '_hero_mousewheel', true ) ) {
		$classes[] = 'hero-mousewheel';
	}

	if ( class_exists( 'Wolf_Share' ) ) {
		$classes[] = 'wolf-share';
	}

	if ( milu_get_inherit_mod( 'sticky_menu_transparent' ) ) {
		$classes[] = 'sticky-menu-transparent';
	}
	
	return $classes;

}
add_filter( 'body_class', 'milu_additional_body_classes' );

/**
 * Overwrite hamburger icon
 */
function milu_set_hamburger_icon( $html, $class, $title_attr ) {

	if ( 'toggle-side-panel' === $class ) {
		
		$title_attr = esc_html__( 'Side Panel', 'milu' );
	
	} else {
		$title_attr = esc_html__( 'Menu', 'milu' );
	}

	ob_start();
	?>
	<a class="hamburger-link <?php echo esc_attr( $class ); ?>" href="#" title="<?php echo esc_attr( $title_attr ); ?>">
		<span class="hamburger-icon">
			<span class="line line-first"></span>
			<span class="line line-second"></span>
			<span class="line line-third"></span>
			<span class="cross">
				<span></span>
				<span></span>
			</span>
		</span>
	</a>
	<?php
	$html = ob_get_clean();

	return $html;

}
add_filter( 'wolfthemes_hamburger_icon', 'milu_set_hamburger_icon', 10, 3 );

/**
 * Disable single post pagination
 *
 * @param bool $bool
 * @return bool
 */
add_filter( 'milu_disable_single_post_pagination', '__return_true' );

/**
 * Filter single work title
 *
 * @param string $string
 * @return string
 */
function milu_set_single_work_title( $string ) {

	return esc_html__( 'Details & Info', 'milu' );
}
add_filter( 'milu_single_work_title', 'milu_set_single_work_title', 40 );

/**
 * Excerpt more
 *
 * Add span to allow more CSS tricks
 *
 * @return string
 */
function milu_custom_more_text( $string ) {

	$text = '<small class="wvc-button-background-fill"></small><span>' . esc_html__( 'Continue reading', 'milu' ) . '</span>';

	return $text;
}
add_filter( 'milu_more_text', 'milu_custom_more_text', 40 );

/**
 * Set related posts text
 *
 * @param string $string
 * @return string
 */
function milu_set_related_posts_text( $text ) {

	return esc_html__( 'You May Also Like', 'milu' );
}
add_filter( 'milu_related_posts_text', 'milu_set_related_posts_text' );

/**
 * Overwrite standard post entry slider image size
 */
function milu_overwrite_img_sizes( $size ) {

	add_image_size( 'milu-slide', 847, 508, true );

}
add_action( 'after_setup_theme', 'milu_overwrite_img_sizes', 50 );

/**
 * Returns large
 */
function milu_set_large_metro_thumbnail_size() {
	return 'large';
}

/**
 * Filter metro thumnail size depending on row context
 */
function milu_optimize_metro_thumbnail_size( $atts ) {

	$column_type = isset( $atts['column_type'] ) ? $atts['column_type'] : null;
	$content_width = isset( $atts['content_width'] ) ? $atts['content_width'] : null;

	if ( 'column' === $column_type ) {
		if ( 'full' === $content_width || 'large' === $content_width ) {
			add_filter( 'milu_metro_thumbnail_size_name', 'milu_set_large_metro_thumbnail_size' );
		}
	}
}
add_action( 'wvc_add_row_filters', 'milu_optimize_metro_thumbnail_size', 10, 1 );

/* Remove metro thumbnail size filter */
add_action( 'wvc_remove_row_filters', function() {
	remove_filter( 'milu_metro_thumbnail_size_name', 'milu_set_large_metro_thumbnail_size' );
} );

/**
 * Filter post modules
 *
 * @param array $atts
 * @return array $atts
 */
function milu_filter_post_module_atts( $atts ) {

	$post_type = $atts['post_type'];
	$affected_post_types = array( 'work' );

	if ( in_array( $post_type, $affected_post_types ) ) {
		if ( isset( $atts[ $post_type . '_display' ] ) && 'offgrid' === $atts[ $post_type . '_display' ] ) {
			$atts['item_animation'] = '';
			$atts[ $post_type . '_layout' ] = 'standard';
		}
	}

	if ( isset( $atts[ $post_type . '_hover_effect' ] ) ) {

		if ( 'simple' === $atts[ $post_type . '_hover_effect' ] ) {
		}

		if ( 'zoom' === $atts[ $post_type . '_hover_effect' ] ) {
			$atts[ $post_type . '_layout' ] = 'overlay';
		}

		if ( 'slide' === $atts[ $post_type . '_hover_effect' ] ) {
			$atts[ $post_type . '_layout' ] = 'overlay';
		}

		if ( 'glitch' === $atts[ $post_type . '_hover_effect' ] ) {
		}

		if ( 'cursor' === $atts[ $post_type . '_hover_effect' ] ) {
			$atts[ 'overlay_text_color' ] = 'black';
		}
	}

	return $atts;
}
add_filter( 'milu_post_module_atts', 'milu_filter_post_module_atts' );

/**
 * No header post types
 */
function milu_filter_no_hero_post_types( $post_types ) {

	$post_types = array( 'attachment' );

	return $post_types;
}
add_filter( 'milu_no_header_post_types', 'milu_filter_no_hero_post_types', 40 );

/**
 * 
 */
function milu_show_shop_header_content_block_single_product( $bool ) {

	if ( is_singular( 'product' ) ) {
		$bool = true;
	}
	
	return $bool;
}
add_filter( 'milu_force_display_shop_after_header_block', 'milu_show_shop_header_content_block_single_product' );

/**
 * Read more text
 */
function milu_view_post_text( $string ) {
	return esc_html__( 'Read more', 'milu' );
}
add_filter( 'milu_view_post_text', 'milu_view_post_text' );

/**
 * Filter empty p tags in excerpt
 */
function milu_filter_excerpt_empty_p_tags( $excerpt ) {

	return str_replace( '<p></p>', '', $excerpt );

}
add_filter( 'get_the_excerpt', 'milu_filter_excerpt_empty_p_tags', 100 );

/**
 *  Set entry slider animation
 *
 * @param string $animation
 * @return string $animation
 */
function milu_set_entry_slider_animation( $animation ) {
	return 'slide';
}
add_filter( 'milu_entry_slider_animation', 'milu_set_entry_slider_animation', 40 );

/**
 * Search form placeholder
 */
function milu_set_searchform_placeholder( $string ) {
	return esc_attr_x( 'Search&hellip;', 'placeholder', 'milu' );
}
add_filter( 'milu_searchform_placeholder', 'milu_set_searchform_placeholder', 40 );
add_filter( 'milu_product_searchform_placeholder', 'milu_set_searchform_placeholder', 40 );

/**
 * Search form placeholder text
 */
function milu_searchform_placeholder_text( $string ) {
	return esc_html__( 'Type your search and hit enter&hellip;', 'milu' );
}
add_filter( 'milu_searchform_placeholder', 'milu_searchform_placeholder_text' );

/**
 * Add form in no result page
 */
function milu_add_no_result_form() {
	get_search_form();
}
add_action( 'milu_no_result_end', 'milu_add_no_result_form' );

/**
 *  Set smooth scroll speed
 *
 * @param string $speed
 * @return string $speed
 */
function milu_set_smooth_scroll_speed( $speed ) {
	return 1500;
}
add_filter( 'milu_smooth_scroll_speed', 'milu_set_smooth_scroll_speed' );
add_filter( 'wvc_smooth_scroll_speed', 'milu_set_smooth_scroll_speed' );

/**
 *  Set smooth scroll easing effect
 *
 * @param string $ease
 * @return string $ease
 */
function milu_set_smooth_scroll_ease( $ease ) {
	return 'easeInOutQuint';
}
add_filter( 'milu_smooth_scroll_ease', 'milu_set_smooth_scroll_ease' );
add_filter( 'wvc_smooth_scroll_ease', 'milu_set_smooth_scroll_ease' );
add_filter( 'wvc_fp_easing', 'milu_set_smooth_scroll_ease' );

/**
 *  Set smooth scroll speed
 *
 * @param string $speed
 * @return string $speed
 */
function milu_set_fp_anim_time( $speed ) {

	$speed = 1500;

	if ( is_page() || is_single() ) {
		if ( get_post_meta( milu_get_the_ID(), '_post_fullpage_animtime', true ) ) {
			$speed = absint( get_post_meta( milu_get_the_ID(), '_post_fullpage_animtime', true ) );
		}
	}

	return $speed;
}
add_filter( 'wvc_fp_animtime', 'milu_set_fp_anim_time', 40 );

/**
 * Filter lightbox settings
 */
function milu_filter_lightbox_settings( $settings ) {

	$settings['transitionEffect'] = 'fade';
	$settings['buttons'] = array(
		'zoom',
		'close',
	);

	return $settings;
}
add_filter( 'milu_fancybox_settings', 'milu_filter_lightbox_settings' );

/**
 * Save modal window content after import
 */
function milu_set_modal_window_content_after_import() {
	$post = get_page_by_title( 'Modal Window Content', OBJECT, 'wvc_content_block' );

	if ( $post && function_exists( 'wvc_update_option' ) ) {
		wvc_update_option( 'modal_window', 'content_block_id', $post->ID );
	}
}
add_action( 'pt-ocdi/after_import', 'milu_set_modal_window_content_after_import' );

/**
 * ADD META FIELD TO SEARCH QUERY
 *
 * @param string $field
 */
function milu_add_meta_field_to_search_query( $field ){
	
	if ( isset( $GLOBALS['added_meta_field_to_search_query'] ) ) {
		$GLOBALS['added_meta_field_to_search_query'][] = '\'' . $field . '\'';
		return;
	}

	$GLOBALS['added_meta_field_to_search_query'] = array();
	$GLOBALS['added_meta_field_to_search_query'][] = '\'' . $field . '\'';

	add_filter( 'posts_join', function( $join ) {
		global $wpdb;

		if ( is_search() ) {
			$join .= " LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id ";
		}

		return $join;
	} );

	add_filter( 'posts_groupby', function( $groupby ) {
		global $wpdb;

		if ( is_search() ) {    
			$groupby = "$wpdb->posts.ID";
		}

		return $groupby;
	} );

	add_filter( 'posts_search', function( $search_sql ) {
		global $wpdb;

		$search_terms = get_query_var( 'search_terms' );

		if ( ! empty( $search_terms ) ) {
			foreach ( $search_terms as $search_term ) {
				$old_or = "OR ({$wpdb->posts}.post_content LIKE '{$wpdb->placeholder_escape()}{$search_term}{$wpdb->placeholder_escape()}')";
				$new_or = $old_or . " OR ({$wpdb->postmeta}.meta_value LIKE '{$wpdb->placeholder_escape()}{$search_term}{$wpdb->placeholder_escape()}' AND {$wpdb->postmeta}.meta_key IN (" . implode(', ', $GLOBALS['added_meta_field_to_search_query']) . "))";
				$search_sql = str_replace( $old_or, $new_or, $search_sql );
			}
		}

		$search_sql = str_replace( " ORDER BY ", " GROUP BY $wpdb->posts.ID ORDER BY ", $search_sql );

		return $search_sql;
	} );
}
milu_add_meta_field_to_search_query( '_post_subheading' );

/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function milu_edit_color_scheme_css( $output, $colors ) {

	extract( $colors );

	$output = '';

	$secondary_accent_color = milu_get_inherit_mod( 'secondary_accent_color' );

	$overlay_accent_bg_color = vsprintf( 'rgba( %s, 0.95)', milu_hex_to_rgb( $accent_color ) );
	$border_color = vsprintf( 'rgba( %s, 0.03)', milu_hex_to_rgb( $strong_text_color ) );
	$overlay_panel_bg_color = vsprintf( 'rgba( %s, 0.95)', milu_hex_to_rgb( $submenu_background_color ) );
	$font_skin = ( 'light' === milu_get_color_scheme_option() ) ? 'dark' : 'light';
	
	$link_selector = '.link, p:not(.attachment) > a:not(.no-link-style):not(.button):not(.button-download):not(.added_to_cart):not(.button-secondary):not(.menu-link):not(.filter-link):not(.entry-link):not(.more-link):not(.wvc-image-inner):not(.wvc-button):not(.wvc-bigtext-link):not(.wvc-fittext-link):not(.ui-tabs-anchor):not(.wvc-icon-title-link):not(.wvc-icon-link):not(.wvc-social-icon-link):not(.wvc-team-member-social):not(.wolf-tweet-link):not(.author-link):not(.gallery-quickview)';
	$link_selector_after = '.link:after, p:not(.attachment) > a:not(.no-link-style):not(.button):not(.button-download):not(.added_to_cart):not(.button-secondary):not(.menu-link):not(.filter-link):not(.entry-link):not(.more-link):not(.wvc-image-inner):not(.wvc-button):not(.wvc-bigtext-link):not(.wvc-fittext-link):not(.ui-tabs-anchor):not(.wvc-icon-title-link):not(.wvc-icon-link):not(.wvc-social-icon-link):not(.wvc-team-member-social):not(.wolf-tweet-link):not(.author-link):not(.gallery-quickview):after';

	$output .= "/* Color Scheme */

	/* Body Background Color */
	body,
	.frame-border{
		background-color: $body_background_color;
	}

	/* Page Background Color */
	.site-header,
	.post-header-container,
	.content-inner,
	#logo-bar,
	.nav-bar,
	.loading-overlay,
	.no-hero #hero,
	.wvc-font-default,
	#topbar{
		background-color: $page_background_color;
	}

	/* Submenu color */
	#site-navigation-primary-desktop .mega-menu-panel,
	#site-navigation-primary-desktop ul.sub-menu,
	#mobile-menu-panel,
	.offcanvas-menu-panel,
	.lateral-menu-panel,
	.cart-panel,
	.wwcs-selector{
		background:$submenu_background_color;
	}

	.cart-panel{
		background:$submenu_background_color!important;
	}

	.panel-closer-overlay{
	}

	.overlay-menu-panel{
		background:$overlay_panel_bg_color;
	}

	/* Sub menu Font Color */
	.nav-menu-desktop li ul li:not(.menu-button-primary):not(.menu-button-secondary) .menu-item-text-container,
	.nav-menu-desktop li ul.sub-menu li:not(.menu-button-primary):not(.menu-button-secondary).menu-item-has-children > a:before,
	.nav-menu-desktop li ul li.not-linked > a:first-child .menu-item-text-container,
	.mega-menu-tagline-text,
	.wwcs-selector{
		color: $submenu_font_color;
	}
	
	.cart-panel,
	.cart-panel a,
	.cart-panel strong,
	.cart-panel b{
		color: $submenu_font_color!important;
	}

	#close-side-panel-icon{
		color: $submenu_font_color!important;
	}

	.nav-menu-vertical li a,
	.nav-menu-mobile li a,
	.nav-menu-vertical li.menu-item-has-children:before,
	.nav-menu-vertical li.page_item_has_children:before,
	.nav-menu-vertical li.active:before,
	.nav-menu-mobile li.menu-item-has-children:before,
	.nav-menu-mobile li.page_item_has_children:before,
	.nav-menu-mobile li.active:before{
		color: $submenu_font_color!important;
	}

	.lateral-menu-panel .wvc-icon:before{
		color: $submenu_font_color!important;
	}

	.nav-menu-desktop li ul.sub-menu li.menu-item-has-children > a:before{
		color: $submenu_font_color;
	}

	.cart-panel,
	.cart-panel a,
	.cart-panel strong,
	.cart-panel b{
		color: $submenu_font_color!important;
	}
	
	/* Accent Color */
	.accent{
		color:$accent_color;
	}

	.accent-color-is-black .wvc-font-color-light .accent{
		color:white;
	}

	.logo-text:after,
	.side-panel-logo-heading:after{
		background-color:$accent_color;
	}

	#milu-loading-point{
		color:$accent_color;
	}

	#back-to-top:hover{
		background:$accent_color!important;
	}

	#milu-cursor-dot{
		background-color:$accent_color;
	}

	blockquote:before{
		color:$accent_color!important;
	}
	
	.category-filter ul li a:after,
	.theme-heading:after,
	.highlight:after,
	.highlight-primary:after{
		background-color:$accent_color;
	}
	

	.highlight-secondary:after{
		background-color:$secondary_accent_color;
	}

	.no-results .search-form .search-submit {
		background-color:$secondary_accent_color;
}

	.wvc-single-image-overlay-title span:after,
	.work-meta-value a:hover{
		color:$accent_color;
	}

	.nav-menu li.sale .menu-item-text-container:before,
	.nav-menu-mobile li.sale .menu-item-text-container:before
	{
		background:$accent_color!important;
	}
	

	.entry-post-skin-light:not(.entry-post-standard).entry-video:hover .video-play-button {
 	border-left-color:$accent_color!important;
}

	.entry-post-standard .entry-thumbnail-overlay{
		/*background-color:$overlay_accent_bg_color;*/
	}

	.widget_price_filter .ui-slider .ui-slider-range,
	mark,
	p.demo_store,
	.woocommerce-store-notice{
		background-color:$accent_color;
	}

	.button-secondary{
		background-color:$accent_color;
		border-color:$accent_color;
	}

	.theme-button-solid-accent{
		background-color:$accent_color;
		border-color:$accent_color;
	}
	.theme-button-solid-accent-secondary{
		background-color:$secondary_accent_color;
		border-color:$secondary_accent_color;
	}

	.nav-menu li.menu-button-primary > a:first-child > .menu-item-inner,
	.theme-button-special-accent{
		background-image: linear-gradient(to right, " . milu_adjust_brightness( $accent_color, +0.2 ) . " 0%, " . milu_adjust_brightness( $accent_color, -0.05 ) . " 51%, " . milu_adjust_brightness( $accent_color, -0.15 ) . " 100%);
	}
	
	.nav-menu li.menu-button-secondary > a:first-child > .menu-item-inner,
	.theme-button-special-accent-secondary{
		background-image: linear-gradient(to right, " . milu_adjust_brightness( $secondary_accent_color, +0.2 ) . " 0%, " . milu_adjust_brightness( $secondary_accent_color, -0.05 ) . " 51%, " . milu_adjust_brightness( $secondary_accent_color, -0.15 ) . " 100%);
	}

	/*.theme-button-special-accent .wvc-button-background-fill{
		border-color:$accent_color;
	}*/

	.theme-button-outline-accent{
		border-color:$accent_color;
	}

	.theme-button-outline-accent:hover{
		background-color:$accent_color;
	}

	.theme-button-text-accent{
		color:$accent_color;
	}

	.theme-button-outline-accent-secondary{
		border-color:$secondary_accent_color;
	}

	.theme-button-outline-accent-secondary:hover{
		background-color:$secondary_accent_color;
	}

	.theme-button-text-accent-secondary{
		color:$secondary_accent_color;
	}

	.theme-button-text-accent:after{
		
	}

	.nav-menu-desktop li a span.menu-item-text-container:after, .nav-menu-vertical>li a span.menu-item-text-container:after{
		background-color:$secondary_accent_color!important;
	}

	.entry-post-standard .entry-title a:hover,
	.entry-post-standard .entry-meta a:hover,
	.entry-post-grid .entry-title a:hover,
	.entry-post-grid .entry-meta a:hover,
	.entry-post-masonry .entry-title a:hover,
	.entry-post-masonry .entry-meta a:hover{
		color:$accent_color!important;
	}

	.wolf-twitter-widget a.wolf-tweet-link:hover,
	.widget.widget_categories a:hover,
	.widget.widget_pages a:hover,
	.widget .tagcloud a:hover,
	.widget.widget_recent_comments a:hover,
	.widget.widget_recent_entries a:hover,
	.widget.widget_archive a:hover,
	.widget.widget_meta a:hover,
	.widget.widget_product_categories a:hover,
	.widget.widget_nav_menu a:hover,
	a.rsswidget:hover,
	.wvc-font-$font_skin .wolf-twitter-widget a.wolf-tweet-link:hover,
	.wvc-font-$font_skin .widget.widget_categories a:hover,
	.wvc-font-$font_skin .widget.widget_pages a:hover,
	.wvc-font-$font_skin .widget .tagcloud a:hover,
	.wvc-font-$font_skin .widget.widget_recent_comments a:hover,
	.wvc-font-$font_skin .widget.widget_recent_entries a:hover,
	.wvc-font-$font_skin .widget.widget_archive a:hover,
	.wvc-font-$font_skin .widget.widget_meta a:hover,
	.wvc-font-$font_skin .widget.widget_product_categories a:hover,
	.wvc-font-$font_skin .widget.widget_nav_menu a:hover,
	.wvc-font-$font_skin a.rsswidget:hover{
		color:$accent_color!important;
	}

	.group_table td a:hover{
		color:$accent_color;
	} 

	.fancybox-thumbs>ul>li:before{
		border-color:$accent_color;
	}

	.wvc-background-color-accent{
		background-color:$accent_color;
	}

	.accent-color-is-black .wvc-font-color-light .wvc_bar_color_filler{
		background-color:white!important;
	}

	.wvc-testimonial-avatar:after{
		color:$accent_color;
	}

	.wvc-highlight-accent{
		background-color:$accent_color;
		color:#fff;
	}

	.wvc-icon-background-color-accent{
		box-shadow:0 0 0 0 $accent_color;
		background-color:$accent_color;
		color:$accent_color;
		border-color:$accent_color;
	}

	.wvc-icon-background-color-accent .wvc-icon-background-fill{
		box-shadow:0 0 0 0 $accent_color;
		background-color:$accent_color;
	}

	.wvc-button-background-color-accent{
		background-color:$accent_color;
		color:$accent_color;
		border-color:$accent_color;
	}

	.wvc-button-background-color-accent .wvc-button-background-fill{
		box-shadow:0 0 0 0 $accent_color;
		background-color:$accent_color;
	}

	.wvc-svg-icon-color-accent svg * {
		stroke:$accent_color!important;
	}

	.wvc-one-page-nav-bullet-tip{
		background-color: $accent_color;
	}

	.wvc-one-page-nav-bullet-tip:before{
		border-color: transparent transparent transparent $accent_color;
	}

	.accent,
	.comment-reply-link,
	.bypostauthor .avatar{
		color:$accent_color;
	}

	.wvc-button-color-button-accent,
	.more-link,
	.buton-accent{
		background-color: $accent_color;
		border-color: $accent_color;
	}

	.wvc-ils-item-title:before {
		background-color: $accent_color!important;
	}

	.widget .tagcloud:before{
		 color:$accent_color;
	}

	.group_table td a:hover{
		color:$accent_color;
	}

	.added_to_cart, .button,
	.button-download,
	.more-link,
	.wvc-mailchimp-submit,
	input[type=submit]{
		background-color: $accent_color;
	}

	.wpcf7-button-accent-secondary:not(:hover){
		background-color: $secondary_accent_color;
	}
	
	/* WVC icons */
	.wvc-icon-color-accent{
		color:$accent_color;
	}

	.wvc-icon-background-color-accent{
		box-shadow:0 0 0 0 $accent_color;
		background-color:$accent_color;
		color:$accent_color;
		border-color:$accent_color;
	}

	.wvc-icon-background-color-accent .wvc-icon-background-fill{
		box-shadow:0 0 0 0 $accent_color;
		background-color:$accent_color;
	}

	#ajax-progress-bar,
	.cart-icon-product-count{
		background:$accent_color;
	}

	.background-accent{
		background: $accent_color!important;
	}
	
	.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current,
	.mejs-container .mejs-controls .mejs-time-rail .mejs-time-current, .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current{
	 	background: $accent_color!important;
	}

	.trigger{
		background-color: $accent_color!important;
		border : solid 1px $accent_color;
	}

	.bypostauthor .avatar {
		border: 3px solid $accent_color;
	}

	::selection {
		background: $accent_color;
	}
	::-moz-selection {
		background: $accent_color;
	}

	.spinner{
		color:$secondary_accent_color;
	}

	.ball-pulse > div,
	.ball-pulse-sync > div,
	.ball-scale > div,
	.ball-scale-random > div,
	.ball-rotate > div,
	.ball-clip-rotate > div,
	.ball-clip-rotate-pulse > div:first-child,
	.ball-beat > div,
	.ball-scale-multiple > div,
	.ball-pulse-rise > div,
	.ball-grid-beat > div,
	.ball-grid-pulse > div,
	.ball-spin-fade-loader > div,
	.ball-zig-zag > div,
	.ball-zig-zag-deflect > div,
	.line-scale > div,
	.line-scale-party > div,
	.line-scale-pulse-out > div,
	.line-scale-pulse-out-rapid > div,
	.line-spin-fade-loader > div {
		background:$secondary_accent_color;
	}
	
	.ball-clip-rotate-pulse > div:last-child,
	.ball-clip-rotate-multiple > div,
	.ball-scale-ripple > div,
	.ball-scale-ripple-multiple > div,
	.ball-triangle-path > div{
		border-color:$secondary_accent_color;
	}

	.ball-clip-rotate-multiple > div:last-child{
		border-color: $secondary_accent_color transparent $secondary_accent_color transparent;
	}

	/* Secondary accent color */

	.wvc-pricing-table-button a{
		background:$secondary_accent_color;
	}

		.wvc-text-color-secondary_accent{
			color:$secondary_accent_color;
		}

		.wolf .wvc-background-color-secondary_accent{
			background-color:$secondary_accent_color!important;
		}

		.wvc-highlight-secondary_accent{
			background-color:$secondary_accent_color;
			color:#fff;
		}

		.wvc-icon-background-color-secondary_accent{
			box-shadow:0 0 0 0 $secondary_accent_color;
			background-color:$secondary_accent_color;
			color:$secondary_accent_color;
			border-color:$secondary_accent_color;
		}

		.wvc-icon-background-color-secondary_accent .wvc-icon-background-fill{
			box-shadow:0 0 0 0 $secondary_accent_color;
			background-color:$secondary_accent_color;
		}

		.wvc-button-background-color-secondary_accent{
			background-color:$secondary_accent_color;
			color:$secondary_accent_color;
			border-color:$secondary_accent_color;
		}

		.wvc-button-background-color-secondary_accent .wvc-button-background-fill{
			box-shadow:0 0 0 0 $secondary_accent_color;
			background-color:$secondary_accent_color;
		}

		.wvc-svg-icon-color-secondary_accent svg * {
			stroke:$secondary_accent_color!important;
		}

		.wvc-button-color-button-secondary_accent{
			background-color: $secondary_accent_color;
			border-color: $secondary_accent_color;
		}
		
		/* WVC icons */
		.wvc-icon-color-secondary_accent{
			color:$secondary_accent_color;
		}

		.wvc-icon-background-color-secondary_accent{
			box-shadow:0 0 0 0 $secondary_accent_color;
			background-color:$secondary_accent_color;
			color:$secondary_accent_color;
			border-color:$secondary_accent_color;
		}

		.wvc-icon-background-color-secondary_accent .wvc-icon-background-fill{
			box-shadow:0 0 0 0 $secondary_accent_color;
			background-color:$secondary_accent_color;
		}

	/*********************
		WVC
	***********************/

	.wvc-it-label{
		color:$accent_color;
	}

	.wvc-icon-box.wvc-icon-type-circle .wvc-icon-no-custom-style.wvc-hover-fill-in:hover, .wvc-icon-box.wvc-icon-type-square .wvc-icon-no-custom-style.wvc-hover-fill-in:hover {
		-webkit-box-shadow: inset 0 0 0 1em $accent_color;
		box-shadow: inset 0 0 0 1em $accent_color;
		border-color: $accent_color;
	}

	.wvc-pricing-table-featured-text,
	.wvc-pricing-table-featured .wvc-pricing-table-button a{
		background: $accent_color;
	}

	.wvc-pricing-table-featured .wvc-pricing-table-price,
	.wvc-pricing-table-featured .wvc-pricing-table-currency {
		color: $accent_color;
	}
	
	.wvc-pricing-table-featured .wvc-pricing-table-price-strike:before {
		background-color: $accent_color;
	}

	.wvc-team-member-social-container a:hover{
		color: $accent_color;
	}

	/* Main Text Color */
	body,
	.wvc-font-$font_skin,
	.nav-label{
		color:$main_text_color;
	}

	.spinner-color, .sk-child:before, .sk-circle:before, .sk-cube:before{
		background-color: $secondary_accent_color!important;
	}
	
	/* Strong Text Color */
	a,strong,
	.products li .price,
	.products li .star-rating,
	.wr-print-button,
	table.cart thead, #content table.cart thead{
		color: $strong_text_color;
	}

	.bit-widget-container,
	.entry-link{
		color: $strong_text_color;
	}

	.single-product .entry-summary .woocommerce-Price-amount,
	.widget-title,
	.entry-post-standard .entry-title{
		color: $strong_text_color!important;
	}

	.wr-stars>span.wr-star-voted:before, .wr-stars>span.wr-star-voted~span:before{
		color: $strong_text_color!important;
	}

	/* Border Color */

	.widget-title,
	.woocommerce-tabs ul.tabs{
		border-bottom-color:$border_color;
	}

	.widget_layered_nav_filters ul li a{
		border-color:$border_color;
	}

	hr{
		background:$border_color;
	}
	";

	$link_selector_after = '.link:after, .underline:after, p:not(.attachment) > a:not(.no-link-style):not(.button):not(.button-download):not(.added_to_cart):not(.button-secondary):not(.menu-link):not(.filter-link):not(.entry-link):not(.more-link):not(.wvc-image-inner):not(.wvc-button):not(.wvc-bigtext-link):not(.wvc-fittext-link):not(.ui-tabs-anchor):not(.wvc-icon-title-link):not(.wvc-icon-link):not(.wvc-social-icon-link):not(.wvc-team-member-social):not(.wolf-tweet-link):not(.author-link):after';
	$link_selector_before = '.link:before, .underline:before, p:not(.attachment) > a:not(.no-link-style):not(.button):not(.button-download):not(.added_to_cart):not(.button-secondary):not(.menu-link):not(.filter-link):not(.entry-link):not(.more-link):not(.wvc-image-inner):not(.wvc-button):not(.wvc-bigtext-link):not(.wvc-fittext-link):not(.ui-tabs-anchor):not(.wvc-icon-title-link):not(.wvc-icon-link):not(.wvc-social-icon-link):not(.wvc-team-member-social):not(.wolf-tweet-link):not(.author-link):before';

	$output .= "

		$link_selector_after,
		$link_selector_before{
			background: $accent_color!important;
		}

		.category-filter ul li a:before{
		}

		.category-label{
		}

	
		/*.wvc-breadcrumb a:hover,
		.wvc-list a:hover{
			color:$accent_color!important;
		}*/

		.nav-menu li.menu-button-primary > a:first-child > .menu-item-inner:not(:hover){
			background:$accent_color!important;
		}

		.nav-menu li.menu-button-secondary > a:first-child > .menu-item-inner:not(:hover){
			background:$secondary_accent_color!important;
		}

		/*.nav-menu li.menu-button-primary > a:first-child > .menu-item-inner,
		.nav-menu li.menu-button-secondary > a:first-child > .menu-item-inner{
			border-color:$accent_color
		}*/

		.theme-heading:after{
			color:$accent_color;
		}

		input[type=text]:focus,
		input[type=search]:focus,
		input[type=tel]:focus,
		input[type=time]:focus,
		input[type=url]:focus,
		input[type=week]:focus,
		input[type=password]:focus,
		input[type=checkbox]:focus,
		input[type=color]:focus,
		input[type=date]:focus,
		input[type=datetime]:focus,
		input[type=datetime-local]:focus,
		input[type=email]:focus,
		input[type=month]:focus,
		input[type=number]:focus,
		select:focus,
		textarea:focus{
			border-color:$accent_color!important;
		}

		/* Button */
		

		.entry-mp-event .entry-container,
		.wvc-recipe-instructions o li:before,
		.wvc-recipe .wvc-recipe-counter-circle {
			background:$accent_color;
		}

		.accent-color-light .category-label{
		}

		.accent-color-dark .category-label{
		}

		.coupon .button:hover{
			background:$accent_color!important;
			border-color:$accent_color!important;
		}

		.menu-item-fill{
			background:$accent_color!important;
		}

		.audio-shortcode-container .mejs-container .mejs-controls > .mejs-playpause-button{
			background:$accent_color;
		}

		.menu-hover-style-h-underline .nav-menu-desktop li a span.menu-item-text-container:after{
			background-color:$accent_color!important;
		}


		ul.wvc-tabs-menu li.ui-tabs-active,
		ul.wvc-tabs-menu li.ui-tabs-active,
		ul.wvc-tabs-menu li:hover,
		ul.wvc-tabs-menu li:hover{
			box-shadow: inset 0 -3px 0 0 $accent_color!important;
		}

		.wvc-tabs-accent-color-secondary ul.wvc-tabs-menu li.ui-tabs-active,
		.wvc-tabs-accent-color-secondary ul.wvc-tabs-menu li.ui-tabs-active,
		.wvc-tabs-accent-color-secondary ul.wvc-tabs-menu li:hover,
		.wvc-tabs-accent-color-secondary ul.wvc-tabs-menu li:hover{
			box-shadow: inset 0 -3px 0 0 $secondary_accent_color!important;
		}

		.wvc-accordion-tab.ui-state-active .wvc-at-title-text,
		.wvc-accordion-tab:hover .wvc-at-title-text{
			color:$accent_color!important;
		}

		.wvc-accordion-accent-color-secondary .wvc-accordion-tab.ui-state-active .wvc-at-title-text,
		.wvc-accordion-accent-color-secondary .wvc-accordion-tab:hover .wvc-at-title-text{
			color:$secondary_accent_color!important;
		}
		
		/*.entry-product ins .woocommerce-Price-amount,
		.entry-single-product ins .woocommerce-Price-amount{
			color:$accent_color;
		}*/
	";

	$heading_selectors = apply_filters( 'milu_heading_selectors', milu_list_to_array( 'h1:not(.wvc-bigtext), h2:not(.wvc-bigtext), h3:not(.wvc-bigtext), h4:not(.wvc-bigtext), h5:not(.wvc-bigtext), .post-title, .entry-title, h2.entry-title > .entry-link, h2.entry-title, .widget-title, .wvc-counter-text, .wvc-countdown-period, .location-title, .logo-text, .wvc-interactive-links, .wvc-interactive-overlays, .heading-font' ) );

	$heading_selectors = milu_array_to_list( $heading_selectors );
	$output .= "$heading_selectors{text-rendering: auto;}";
	if ( preg_match( '/dark/', milu_get_theme_mod( 'color_scheme' ) ) ) {
		$output .= ".wvc-background-color-default.wvc-font-light{
			background-color:$page_background_color;
		}";
	}
	if ( preg_match( '/light/', milu_get_theme_mod( 'color_scheme' ) ) ) {
		$output .= ".wvc-background-color-default.wvc-font-dark{
			background-color:$page_background_color;
		}";
	}

	if ( is_singular( 'product' ) ) {
		$product_thumbnail_bg = sanitize_hex_color( milu_get_inherit_mod( 'product_bg_color', '', get_the_ID() ) );

		if ( $product_thumbnail_bg ) {
			$output .= ".woocommerce-product-gallery__wrapper,.zoomImg,.fancybox-content{background-color:$product_thumbnail_bg}";
		}
	}

	return $output;
}
add_filter( 'milu_color_scheme_output', 'milu_edit_color_scheme_css', 10, 2 );

/**
 * Additional styles
 */
function milu_output_additional_styles() {

	$output = '';

	/* Content inner background */
	$c_ci_bg_color = milu_get_inherit_mod( 'content_inner_bg_color' );
	$c_ci_bg_img = milu_get_inherit_mod( 'content_inner_bg_img' );

	if ( $c_ci_bg_color ) {
		$output .= ".content-inner{
	background-color: $c_ci_bg_color;
}";
	}

	if ( $c_ci_bg_img ) {
		$output .= ".content-inner{
	background-image:url(" . milu_get_url_from_attachment_id( $c_ci_bg_img, 'full' ) ." );
	background-repeat: no-repeat;
    background-position: center 0;
    background-size: cover;}";
	}

	/* Product thumbnail padding */
	$p_t_padding = milu_get_inherit_mod( 'product_thumbnail_padding' );

	if ( $p_t_padding ) {
		$p_t_padding = milu_sanitize_css_value( $p_t_padding );
		$output .= ".entry-product-masonry .product-thumbnail-container,
.entry-product-grid .product-thumbnail-container,
.wwcq-product-quickview-container .product-images .slide-content img{
	padding: $p_t_padding;
}";
	}

	$output .= '.wolf-share-buttons-container:before{
	content: "' . esc_html__( 'Share', 'milu' ) . ':";
}';

	if ( ! SCRIPT_DEBUG ) {
		$output = milu_compact_css( $output );
	}

	wp_add_inline_style( 'milu-style', $output );
}
add_action( 'wp_enqueue_scripts', 'milu_output_additional_styles', 999 );

/*--------------------------------------------------------------------

	POST HOOKS

----------------------------------------------------------------------*/

/**
 * Redefine post standard hook
 */
function milu_remove_loop_post_default_hooks() {
	
	remove_action( 'milu_before_post_content_standard_title', 'milu_output_post_content_standard_date' );
	remove_action( 'milu_post_content_standard_title', 'milu_output_post_content_standard_title' );
	remove_action( 'milu_after_post_content_standard', 'milu_output_post_content_standard_meta' );

	remove_action( 'milu_before_post_content_grid_title', 'milu_output_post_content_grid_date' );
	remove_action( 'milu_before_post_content_grid_title', 'milu_output_post_content_grid_media' );
	remove_action( 'milu_post_content_grid_title', 'milu_output_post_grid_title' );

	remove_action( 'milu_before_post_content_masonry_title', 'milu_output_post_content_grid_date' );
	remove_action( 'milu_before_post_content_masonry_title', 'milu_output_post_content_grid_media' );
	remove_action( 'milu_post_content_masonry_title', 'milu_output_post_grid_title' );

	remove_action( 'milu_after_post_content_grid', 'milu_output_post_content_grid_meta' );
	remove_action( 'milu_after_post_content_masonry', 'milu_output_post_content_grid_meta' );

	remove_action( 'milu_after_post_content_grid_title', 'milu_output_post_content_grid_excerpt' );
	remove_action( 'milu_after_post_content_masonry_title', 'milu_output_post_content_grid_excerpt' );
	add_action( 'milu_before_post_content_standard_title', 'milu_overwrite_post_standard_title', 10, 2 );

	add_action( 'milu_before_post_content_masonry', 'milu_output_post_content_grid_custom_media', 10, 2 );
	add_action( 'milu_before_post_content_masonry_title', 'milu_output_post_content_grid_open_tag', 10, 1 );

	add_action( 'milu_before_post_content_grid', 'milu_output_post_content_grid_custom_media', 10, 2 );
	add_action( 'milu_before_post_content_grid', 'milu_output_post_content_grid_summary_open_tag', 10, 2 );
	add_action( 'milu_post_content_grid_title', 'milu_overwrite_post_standard_title', 10, 2 );
	add_action( 'milu_after_post_content_grid_title', 'milu_overwrite_post_content_grid_excerpt', 10, 2 );

	add_action( 'milu_post_content_masonry_title', 'milu_overwrite_post_standard_title', 10, 2 );

	add_action( 'milu_after_post_content_masonry_title', 'milu_overwrite_post_content_grid_excerpt', 10, 2 );

	add_action( 'milu_after_post_content_grid', 'milu_output_post_content_grid_summary_close_tag', 10, 1 );
	add_action( 'milu_after_post_content_masonry', 'milu_output_post_content_grid_summary_close_tag', 10, 1 );
}
add_action( 'init', 'milu_remove_loop_post_default_hooks' );

/**
 * Post open tag
 */
function milu_output_post_content_grid_summary_open_tag( $post_display_elements ) {
	?>
	<div class="entry-summary">
		<div class="entry-summary-inner">
	<?php
}

/**
 * Post open tag
 */
function milu_output_post_content_grid_summary_close_tag( $post_display_elements ) {
	?>
		</div><!-- .entry-summary-inner -->
	</div><!-- .entry-summary -->
	<?php
}

/**
 * Post Media
 */
function milu_output_post_content_grid_custom_media( $post_display_elements, $display ) {
	$show_thumbnail = ( in_array( 'show_thumbnail', $post_display_elements ) );
	$show_category = ( in_array( 'show_category', $post_display_elements ) );
	$post_id = get_the_ID();
	$secondary_featured_image_id = get_post_meta( $post_id, '_post_secondary_featured_image', true );
	$thumbnail_id = ( $secondary_featured_image_id ) ? $secondary_featured_image_id : get_post_thumbnail_id();
	?>
	<?php if ( $show_thumbnail ) : ?>
		<?php if ( milu_has_post_thumbnail() || milu_is_instagram_post( $post_id ) ) : ?>
			<div class="entry-image">
				<?php if ( $show_category ) : ?>
					<a class="category-label" href="<?php echo milu_get_first_category_url(); ?>"><?php echo milu_get_first_category(); ?></a>
				<?php endif; ?>
				<?php
					if (  'masonry' === $display ) {

						if ( $secondary_featured_image_id ) {

							echo wp_get_attachment_image( $secondary_featured_image_id, 'milu-masonry' );

						} else {
							echo milu_post_thumbnail( 'milu-masonry' );
						}	

					} else {
						?>
						<div class="entry-cover">
							<?php
								echo milu_background_img(
									array(
										'background_img' => $thumbnail_id,
										'background_img_size' => 'medium',
									)
								);
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

/**
 * Re-assign post masonry open hook
 */
function milu_output_post_content_grid_open_tag( $post_display_elements ) {
	$show_date = ( in_array( 'show_date', $post_display_elements ) );
	$show_thumbnail = ( in_array( 'show_thumbnail', $post_display_elements ) );
	?>
	<div class="entry-summary">
		<div class="entry-summary-inner">
	<?php
}

/**
 * Post Text
 */
function milu_overwrite_post_content_grid_excerpt( $post_display_elements, $post_excerpt_length, $display = 'grid' ) {

	$show_text = ( in_array( 'show_text', $post_display_elements ) );

	if ( 'metro' === $display ) {
		$post_excerpt_length = 5;
	}
	?>
	<?php if ( $show_text ) : ?>
		<div class="entry-excerpt">
			<?php do_action( 'milu_post_' . $display . '_excerpt', $post_excerpt_length ); ?>
		</div><!-- .entry-excerpt -->
	<?php endif; ?>
	<?php
}

/**
 * Redefine single post hook
 */
function milu_remove_single_post_default_hooks() {

	/**
	 * Remove default Hooks
	 */
	remove_action( 'milu_post_content_start', 'milu_add_custom_post_meta' );
	remove_action( 'milu_post_content_end', 'milu_ouput_single_post_taxonomy' );
	remove_action( 'milu_related_post_content', 'milu_output_related_post_content' );


	/**
	 * Add new hooks
	 */
	add_action( 'milu_post_content_before', 'milu_output_single_post_featured_image' );
	add_action( 'milu_post_content_before', 'milu_output_single_post_meta', 10, 1 );

}
add_action( 'init', 'milu_remove_single_post_default_hooks' );

/**
 * Output single post meta
 */
function milu_output_single_post_meta() {
	?>
	<div class="entry-meta">
		<span class="entry-date">
			<?php milu_entry_date( true, true ); ?>
		</span>
			<?php milu_get_author_avatar(); ?>
		<span class="entry-category-list">
			<?php echo apply_filters( 'milu_entry_category_list_icon', '<span class="meta-icon category-icon"></span>' ); ?>
			<?php echo get_the_term_list( get_the_ID(), 'category', '', esc_html__( ', ', 'milu' ), '' ) ?>
		</span>
		<?php milu_entry_tags(); ?>
		<?php milu_get_extra_meta(); ?>
		<?php milu_edit_post_link(); ?>
	</div><!-- .entry-meta -->
	<?php
}

/**
 * Single Post Featured Image
 */
function milu_output_single_post_featured_image() {

	if ( milu_get_inherit_mod( 'hide_single_post_featured_image' ) ) {
		return;
	}

	?><div class="single-featured-image"><?php
	the_post_thumbnail( 'large' );
	?></div><?php

}

add_filter( 'milu_entry_tag_list_separator', function() {
	return ', ';
} );

/**
 * Output single post pagination
 */
function milu_output_custom_single_post_pagination() {

	if ( ! is_singular( 'post' ) || 'no' === milu_get_inherit_mod( 'single_post_nav' ) ) {
		return; // event are ordered by custom date so it's better to hide the pagination
	}

	global $post;
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous || ! is_single() || 'wvc_content_block' === get_post_type() ) {
		return;
	}

	$prev_post = get_previous_post();
	$next_post = get_next_post();

	$prev_post_id = ( is_object( $prev_post ) && isset( $prev_post->ID ) ) ? $prev_post->ID : null;
	$next_post_id = ( is_object( $next_post ) && isset( $next_post->ID ) ) ? $next_post->ID : null;

	$prev_post_featured_img_id = ( $prev_post_id ) ? get_post_thumbnail_id( $prev_post_id ) : null;
	$next_post_featured_img_id = ( $next_post_id ) ? get_post_thumbnail_id( $next_post_id ) : null;

	$index_class = 'nav-index';
	$prev_class = 'nav-previous';
	$next_class = 'nav-next';
	?>
	<nav class="milu-single-post-pagination clearfix">
		<?php if ( $prev_post ) : ?>
			<div class="single-post-nav-item post-previous">
				<a href="<?php echo esc_url( get_permalink( $prev_post_id ) ); ?>" class="post-nav-link-overlay"></a>
				<div class="entry-cover">
						<?php echo milu_background_img( array( 'background_img' => $prev_post_featured_img_id ) ); ?></div>
				<div class="post-nav-content">
					<div class="post-nav-summary">
						<?php if ( milu_get_first_category( $prev_post_id ) ) : ?>
							<div class="post-nav-category"><?php echo milu_get_first_category( $prev_post_id ); ?></div>
						<?php endif; ?>
						<div class="post-nav-title"><?php echo get_the_title( $prev_post_id ); ?></div>
						<span class="post-nav-entry-date">
							<?php milu_entry_date( true, '', $prev_post_id ); ?>
						</span>
					</div>
				</div>
				<?php previous_post_link( '%link', '<span class="nav-label">' . esc_html__( 'Previous Article', 'milu' ) . ' </span>' ); ?>
			</div><!-- .nav-previous -->
		<?php endif; ?>
		<?php if ( $next_post ) : ?>
			<div class="single-post-nav-item post-next">
				<a href="<?php echo esc_url( get_permalink( $next_post_id ) ); ?>" class="post-nav-link-overlay"></a>
				<div class="entry-cover">
					<?php echo milu_background_img( array( 'background_img' => $next_post_featured_img_id ) ); ?>
					</div>
				<div class="post-nav-content">
					<div class="post-nav-summary">
						<?php if ( milu_get_first_category( $next_post_id ) ) : ?>
							<div class="post-nav-category"><?php echo milu_get_first_category( $next_post_id ); ?></div>
						<?php endif; ?>
						<div class="post-nav-title"><?php echo get_the_title( $next_post_id ); ?></div>
						<span class="post-nav-entry-date">
							<?php milu_entry_date( true, '', $next_post_id ); ?>
						</span>
					</div>
				</div>
				<?php next_post_link( '%link', '<span class="nav-label">' . esc_html__( 'Next Article', 'milu' ) . ' </span>' ); ?>
			</div><!-- .nav-next -->
		<?php endif; ?>
	</nav><!-- .single-post-pagination -->
	<?php
}
add_action( 'milu_post_content_after', 'milu_output_custom_single_post_pagination', 14 );

/**
 * Output related posts
 */
function milu_overwrite_related_post_content() {
	?>
	<div class="entry-related-post">
		<a href="<?php the_permalink() ?>" class="entry-related-post-img-link">
			<?php the_post_thumbnail( apply_filters( 'milu_related_post_thumbnail_size', 'thumbnail' ) ); ?>
		</a>
		<div class="entry-related-post-summary">
			<a href="<?php the_permalink() ?>" class="entry-related-post-title-link">
				<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
			</a>
			<!-- <a class="entry-related-post-category" href="<?php //echo milu_get_first_category_url(); ?>"><?php //echo milu_get_first_category(); ?></a> -->
			<span class="entry-related-post-entry-date">
				<?php milu_entry_date(); ?>
			</span>
		</div><!-- .entry-summary -->
	</div><!-- .entry-box -->
	<?php
}
add_action( 'milu_related_post_content', 'milu_overwrite_related_post_content' );

/**
 * Add post meta before title
 */
function milu_overwrite_post_standard_title( $post_display_elements, $display ) {

	if ( '' == get_post_format() || 'video' === get_post_format() || 'gallery' === get_post_format() || 'image' === get_post_format() || 'audio' === get_post_format() || 'grid' === $display || 'masonry' === $display ) {
		the_title( '<h2 class="entry-title"><a class="entry-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	}

	echo '<header class="entry-meta">';

	if ( in_array( 'show_date', $post_display_elements ) && '' == get_post_format() || 'video' === get_post_format() || 'gallery' === get_post_format() || 'image' === get_post_format() || 'audio' === get_post_format() || 'grid' === $display || 'masonry' === $display ) { ?>
		<span class="entry-date">
			<?php milu_entry_date( true, true ); ?>
		</span>
	<?php
	}

	$show_author = ( in_array( 'show_author', $post_display_elements ) );
	$show_category = ( in_array( 'show_category', $post_display_elements ) );
	$show_tags = ( in_array( 'show_tags', $post_display_elements ) );
	$show_extra_meta = ( in_array( 'show_extra_meta', $post_display_elements ) );
	?>
	<?php if ( ( $show_author || $show_extra_meta || $show_category || milu_edit_post_link( false ) ) && 'grid' === $display || 'masonry' === $display || ( ! milu_is_short_post_format() && 'standard' === $display ) ) : ?>
			
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
		<?php endif; ?>
	<?php
	echo '</header>';
}

add_filter( 'milu_author_heading_avatar_size', function() {
	return 150;
} );

add_filter( 'milu_author_box_avatar_size', function() {
	return 150;
} );

/**
 * Post excerpt read more
 */
function milu_output_post_grid_classic_excerpt_read_more() {
	?>
	<p class="post-grid-read-more-container"><a href="<?php the_permalink(); ?>" class="<?php echo esc_attr( apply_filters( 'milu_more_link_button_class', 'more-link' ) ); ?>"><small class="wvc-button-background-fill"></small><span><?php esc_html_e( 'Read more', 'milu' ); ?></span></a></p>
	<?php
}
add_action( 'milu_post_grid_excerpt', 'milu_output_post_grid_classic_excerpt_read_more', 44 );
add_action( 'milu_post_masonry_excerpt', 'milu_output_post_grid_classic_excerpt_read_more', 44 );
add_action( 'milu_post_search_excerpt', 'milu_output_post_grid_classic_excerpt_read_more', 44 );

/*--------------------------------------------------------------------

	WVC FILTERS

----------------------------------------------------------------------*/

/**
 * Add custom elements to theme
 *
 * @param array $elements
 * @return  array $elements
 */
function milu_add_available_wvc_elements( $elements ) {

	if ( class_exists( 'WooCommerce' ) ) {
		$elements[] = 'wc-searchform';
		$elements[] = 'login-form';
		$elements[] = 'product-presentation';
	}

	if ( class_exists( 'Wolf_Videos' ) ) {
		$elements[] = 'video-switcher';
	}

	return $elements;
}
add_filter( 'wvc_element_list', 'milu_add_available_wvc_elements', 44 );

/**
 * Filter heading attribute
 *
 * @param array $atts
 * @return array $atts
 */
function woltheme_filter_heading_atts( $atts ) {
	if ( isset( $atts['style'] ) ) {
		$atts['el_class'] = $atts['el_class'] . ' ' . $atts['style'];
	}

	return $atts;
}
add_filter( 'wvc_heading_atts', 'woltheme_filter_heading_atts' );

/**
 * Remove some params
 */
function milu_remove_vc_params() {

	if ( function_exists( 'vc_remove_param' ) ) {
		
		vc_remove_param( 'wvc_product_index', 'product_text_align' );
		vc_remove_param( 'wvc_video_index', 'video_preview' );

		vc_remove_param( 'wvc_work_index', 'caption_text_alignment' );
		vc_remove_param( 'wvc_work_index', 'overlay_color' );
		vc_remove_param( 'wvc_work_index', 'overlay_custom_color' );
		vc_remove_param( 'wvc_work_index', 'overlay_text_color' );
		vc_remove_param( 'wvc_work_index', 'overlay_text_custom_color' );
		vc_remove_param( 'wvc_work_index', 'overlay_opacity' );
		vc_remove_param( 'wvc_work_index', 'caption_v_align' );
		
		vc_remove_param( 'wvc_interactive_links', 'align' );
		vc_remove_param( 'wvc_interactive_links', 'display' );
		vc_remove_param( 'wvc_interactive_overlays', 'align' );
		vc_remove_param( 'wvc_interactive_overlays', 'display' );

		vc_remove_param( 'wvc_team_member', 'layout' );
		vc_remove_param( 'wvc_team_member', 'alignment' );
		vc_remove_param( 'wvc_team_member', 'v_alignment' );

		vc_remove_param( 'wvc_testimonial_slider', 'text_alignment' );
	}
}
add_action( 'init', 'milu_remove_vc_params' );

/**
 * Post slider button text markup
 */
add_filter( 'wvc_last_posts_big_slide_button_text', function( $text ) {
	return '<span>' . $text . '</span>';
} );

/**
 * Interactive links
 */
add_filter( 'wvc_interactive_links_align', function( $value ) {
	return 'center';
}, 44 );

add_filter( 'wvc_interactive_links_display', function( $value ) {
	return 'block';
}, 100 );

/**
 * Set release taxonomy before string
 */
function milu_set_breadcrump_delimiter( $string ) {

	return ' <i class="fa dripicons-arrow-thin-right"></i> ';

}
add_filter( 'wvc_breadcrumb_delimiter', 'milu_set_breadcrump_delimiter' );

/**
 * Filter fullPage Transition
 *
 * @return array
 */
function milu_set_fullpage_transition( $transition ) {

	if ( is_page() || is_single() ) {
		if ( get_post_meta( wvc_get_the_ID(), '_post_fullpage', true ) ) {
			$transition = get_post_meta( wvc_get_the_ID(), '_post_fullpage_transition', true );
		}
	}

	return $transition;
}
add_filter( 'wvc_fp_transition_effect', 'milu_set_fullpage_transition' );

/**
 * Add style option to tabs element
 */
function milu_add_vc_accordion_and_tabs_options() {
	if ( function_exists( 'vc_add_params' ) ) {
		vc_add_params(
			'vc_tabs',
			array(
				array(
					'heading' => esc_html__( 'Background', 'milu' ),
					'param_name' => 'background',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Solid', 'milu' ) => 'solid',
						esc_html__( 'Transparent', 'milu' ) => 'transparent',
					),
					'weight' => 1000,
				),
				array(
					'heading' => esc_html__( 'Accent Color', 'milu' ),
					'param_name' => 'accent_color',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Primary', 'milu' ) => 'primary',
						esc_html__( 'Secondary', 'milu' ) => 'secondary',
					),
					'weight' => 1000,
				),
			)
		);
	}

	if ( function_exists( 'vc_add_params' ) ) {
		vc_add_params(
			'vc_accordion',
			array(
				array(
					'heading' => esc_html__( 'Background', 'milu' ),
					'param_name' => 'background',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Solid', 'milu' ) => 'solid',
						esc_html__( 'Transparent', 'milu' ) => 'transparent',
					),
					'weight' => 1000,
				),
				array(
					'heading' => esc_html__( 'Accent Color', 'milu' ),
					'param_name' => 'accent_color',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Primary', 'milu' ) => 'primary',
						esc_html__( 'Secondary', 'milu' ) => 'secondary',
					),
					'weight' => 1000,
				),
			)
		);
	}
}
add_action( 'init', 'milu_add_vc_accordion_and_tabs_options' );

/**
 * Filter tabs shortcode attribute
 */
function milu_add_vc_tabs_params( $params ) {

	if ( isset( $params['background'] ) ) {
		$params['el_class'] = $params['el_class'] . ' wvc-tabs-background-' . $params['background'] . ' wvc-tabs-accent-color-' . $params['accent_color'];
	}

	return $params;
}
add_filter( 'shortcode_atts_vc_tabs', 'milu_add_vc_tabs_params' );

/**
 * Filter accordion shortcode attribute
 */
function milu_add_vc_accordion_params( $params ) {

	if ( isset( $params['background'] ) ) {
		$params['el_class'] = $params['el_class'] . ' wvc-accordion-background-' . $params['background'] . ' wvc-accordion-accent-color-' . $params['accent_color'];
	}

	return $params;
}
add_filter( 'shortcode_atts_vc_accordion', 'milu_add_vc_accordion_params' );

/*--------------------------------------------------------------------

	WC FILTERS

----------------------------------------------------------------------*/

/**
 * Quickview product excerpt lenght
 */
add_filter( 'wwcqv_excerpt_length', function() {
	return 28;
} );

/**
 * After quickview summary hook
 */
add_action( 'wwcqv_product_summary', function() {
	?>
	<div class="single-add-to-wishlist">
		<span class="single-add-to-wishlist-label"><?php esc_html_e( 'Wishlist', 'milu' ); ?></span>
		<?php milu_add_to_wishlist(); ?>
	</div><!-- .single-add-to-wishlist -->
	<?php
}, 20 );



/**
 * Display sale label condition
 *
 * @param bool $bool
 * @return bool
 */
function milu_do_show_sale_label( $bool ) {

	if ( get_post_meta( get_the_ID(), '_post_product_label', true ) ) {
		$bool = true;
	}

	return $bool;
}
add_filter( 'milu_show_sale_label', 'milu_do_show_sale_label' );

/**
 * Sale label text
 *
 * @param string $string
 * @return string
 */
function milu_sale_label( $string ) {

	if ( get_post_meta( get_the_ID(), '_post_product_label', true ) ) {

		$style = '';

		$string = '<span' . $style . ' class="onsale">' . esc_attr( get_post_meta( get_the_ID(), '_post_product_label', true ) ) . '</span>';
	}

	return $string;
}
add_filter( 'woocommerce_sale_flash', 'milu_sale_label' );

/**
 * Product quickview button
 *
 * @param string $string
 * @return string
 */
function milu_output_product_quickview_button() {

	if ( function_exists( 'wolf_quickview_button' ) ) {
		wolf_quickview_button();
	}
}
add_filter( 'milu_product_quickview_button', 'milu_output_product_quickview_button' );

/**
 * Product wishlist button
 *
 * @param string $string
 * @return string
 */
function milu_output_product_wishlist_button() {

	if ( function_exists( 'wolf_add_to_wishlist' ) ) {
		wolf_add_to_wishlist();
	}
}
add_filter( 'milu_add_to_wishlist_button', 'milu_output_product_wishlist_button' );

/**
 * Product Add to cart button
 *
 * @param string $string
 * @return string
 */
function milu_output_product_add_to_cart_button() {

	global $product;

	if ( $product->is_type( 'variable' ) ) {

		echo '<a class="product-quickview-button" href="' . esc_url( get_permalink() ) . '"><span class="fa quickview-product-add-to-cart-icon" title="' . esc_attr( __( 'Select option', 'milu' ) ). '"></span></a>';

	} elseif ( $product->is_type( 'external' ) || $product->is_type( 'grouped' ) ) {

		echo '<a class="product-quickview-button" href="' . esc_url( get_permalink() ) . '"><span class="fa quickview-product-add-to-cart-icon" title="' . esc_attr( __( 'View product', 'milu' ) ). '"></span></a>';

	} else {

		echo milu_add_to_cart(
			get_the_ID(),
			'quickview-product-add-to-cart product-quickview-button',
			'<span class="fa quickview-product-add-to-cart-icon" title="' . esc_attr( __( 'Add to cart', 'milu' ) ). '"></span>'
		);
	}
}
add_filter( 'milu_product_add_to_cart_button', 'milu_output_product_add_to_cart_button' );

/**
 * Product more button
 *
 * @param string $string
 * @return string
 */
function milu_output_product_more_button() {

	?>
	<a class="product-quickview-button product-more-button" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'More details', 'milu' ) ?>"><span class="fa ion-android-more-vertical"></span></a>
	<?php
}
add_filter( 'milu_product_more_button', 'milu_output_product_more_button' );

/*--------------------------------------------------------------------

	WC HOOKS

----------------------------------------------------------------------*/

/**
 * Product Size Chart Image
 */
function milu_product_size_chart_img() {
	
	$hide_sizechart = get_post_meta( get_the_ID(), '_post_wc_product_hide_size_chart_img', true );
	
	if ( $hide_sizechart || ! is_singular( 'product' ) ) {
		return;
	}

	global $post;
	$sc_img = null;
	$terms = get_the_terms( $post, 'product_cat' );

	foreach ( $terms as $term ) {

		$sizechart_id = absint( get_term_meta( $term->term_id, 'sizechart_id', true ) );

		if ( $sizechart_id ) {
			$sc_img = $sizechart_id;
		}
	}

	if ( get_post_meta( get_the_ID(), '_post_wc_product_size_chart_img', true ) ) {
		$sc_img = get_post_meta( get_the_ID(), '_post_wc_product_size_chart_img', true );
	}

	if ( is_single() && $sc_img ) {
		$href = milu_get_url_from_attachment_id( $sc_img, 'milu-XL' );
		?>
		<div class="size-chart-img">
			<a href="<?php echo esc_url( $href ); ?>" class="lightbox"><?php esc_html_e( 'Size Chart', 'milu' ); ?></a>
		</div>
		<?php
	}
}
add_action( 'woocommerce_single_product_summary', 'milu_product_size_chart_img', 25 );

/**
 * WC gallery image size overwrite
 */
add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
	return array( 100, 137 );
}, 40 );

/**
 * Category thumbnail fields.
 */
function milu_add_category_fields() {
	?>
	<div class="form-field term-thumbnail-wrap">
		<label><?php esc_html_e( 'Size Chart', 'milu' ); ?></label>
		<div id="sizechart_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
		<div style="line-height: 60px;">
			<input type="hidden" id="product_cat_sizechart_img_id" name="product_cat_sizechart_img_id" />
			<button type="button" id="upload_sizechart_image_button" class="upload_sizechart_image_button button"><?php esc_html_e( 'Upload/Add image', 'milu' ); ?></button>
				<button type="button" id="remove_sizechart_image_button" class="remove_sizechart_image_button button" style="display:none;"><?php esc_html_e( 'Remove image', 'milu' ); ?></button>
		</div>
		<script type="text/javascript">
			if ( ! jQuery( '#product_cat_sizechart_img_id' ).val() ) {
				jQuery( '#remove_sizechart_image_button' ).hide();
			}
			var sizechart_frame;

			jQuery( document ).on( 'click', '#upload_sizechart_image_button', function( event ) {

				event.preventDefault();
				if ( sizechart_frame ) {
					sizechart_frame.open();
					return;
				}
				sizechart_frame = wp.media.frames.downloadable_file = wp.media({
					title: '<?php esc_html_e( 'Choose an image', 'milu' ); ?>',
					button: {
						text: '<?php esc_html_e( 'Use image', 'milu' ); ?>'
					},
					multiple: false
				} );
				sizechart_frame.on( 'select', function() {
					var attachment           = sizechart_frame.state().get( 'selection' ).first().toJSON();
					var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

					jQuery( '#product_cat_sizechart_img_id' ).val( attachment.id );
					jQuery( '#sizechart_img' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
					jQuery( '#remove_sizechart_image_button' ).show();
				} );
				sizechart_frame.open();
			} );

			jQuery( document ).on( 'click', '#remove_sizechart_image_button', function() {
				jQuery( '#sizechart_img' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
				jQuery( '#product_cat_sizechart_img_id' ).val( '' );
				jQuery( '#remove_sizechart_image_button' ).hide();
				return false;
			} );

			jQuery( document ).ajaxComplete( function( event, request, options ) {
				if ( request && 4 === request.readyState && 200 === request.status
					&& options.data && 0 <= options.data.indexOf( 'action=add-tag' ) ) {

					var res = wpAjax.parseAjaxResponse( request.responseXML, 'ajax-response' );
					if ( ! res || res.errors ) {
						return;
					}
					jQuery( '#sizechart_img' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#product_cat_sizechart_img_id' ).val( '' );
					jQuery( '#remove_sizechart_image_button' ).hide();
					jQuery( '#display_type' ).val( '' );
					return;
				}
			} );

		</script>
		<div class="clear"></div>
	</div>
	<?php
}
add_action( 'product_cat_add_form_fields', 'milu_add_category_fields', 100 );

/**
* Edit category thumbnail field.
*
* @param mixed $term Term (category) being edited
*/
function milu_edit_category_fields( $term ) {

	$sizechart_id = absint( get_term_meta( $term->term_id, 'sizechart_id', true ) );

	if ( $sizechart_id ) {
		$image = wp_get_attachment_thumb_url( $sizechart_id );
	} else {
		$image = wc_placeholder_img_src();
	}
	?>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Size Chart', 'milu' ); ?></label></th>
		<td>
			<div id="sizechart_img" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="product_cat_sizechart_img_id" name="product_cat_sizechart_img_id" value="<?php echo absint( $sizechart_id ); ?>" />
				<button type="button" id="upload_sizechart_image_button" class="upload_sizechart_image_button button"><?php esc_html_e( 'Upload/Add image', 'milu' ); ?></button>
				<button type="button" id="remove_sizechart_image_button" class="remove_sizechart_image_button button" style="display:none;"><?php esc_html_e( 'Remove image', 'milu' ); ?></button>
			</div>
			<script type="text/javascript">
				if ( jQuery( '#product_cat_sizechart_img_id' ).val() ) {
					jQuery( '#remove_sizechart_image_button' ).show();
				}
				var sizechart_frame;

				jQuery( document ).on( 'click', '#upload_sizechart_image_button', function( event ) {

					event.preventDefault();
					if ( sizechart_frame ) {
						sizechart_frame.open();
						return;
					}
					sizechart_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( 'Choose an image', 'milu' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Use image', 'milu' ); ?>'
						},
						multiple: false
					} );
					sizechart_frame.on( 'select', function() {
						var attachment           = sizechart_frame.state().get( 'selection' ).first().toJSON();
						var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

						jQuery( '#product_cat_sizechart_img_id' ).val( attachment.id );
						jQuery( '#sizechart_img' ).find( 'img' ).attr( 'src', attachment_thumbnail.url );
						jQuery( '#remove_sizechart_image_button' ).show();
					} );
					sizechart_frame.open();
				} );

				jQuery( document ).on( 'click', '#remove_sizechart_image_button', function() {
					jQuery( '#sizechart_img' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#product_cat_sizechart_img_id' ).val( '' );
					jQuery( '#remove_sizechart_image_button' ).hide();
					return false;
				} );

			</script>
			<div class="clear"></div>
		</td>
	</tr>
	<?php
}
add_action( 'product_cat_edit_form_fields', 'milu_edit_category_fields', 100 );

/**
* save_category_fields function.
*
* @param mixed  $term_id Term ID being saved
* @param mixed  $tt_id
* @param string $taxonomy
*/
function milu_save_category_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
	
	if ( isset( $_POST['product_cat_sizechart_img_id'] ) && 'product_cat' === $taxonomy ) {
		update_woocommerce_term_meta( $term_id, 'sizechart_id', absint( $_POST['product_cat_sizechart_img_id'] ) );
	}
}
add_action( 'created_term', 'milu_save_category_fields', 10, 3 );
add_action( 'edit_term', 'milu_save_category_fields', 10, 3 );

/**
 * Single Product Subheading
 */
function milu_add_single_product_subheading() {

	$subheading = get_post_meta( get_the_ID(), '_post_subheading', true );

	if ( is_single() && $subheading ) {
		?>
		<div class="product-subheading">
			<?php echo sanitize_text_field( $subheading ); ?>
		</div>
		<?php
	}

}
add_action( 'woocommerce_single_product_summary', 'milu_add_single_product_subheading', 6 );
add_action( 'wwcqv_product_summary', 'milu_add_single_product_subheading', 6 );

/**
 * Redefine product hook
 */
function milu_remove_loop_item_default_wc_hooks() {
	
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash' );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail' );
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
	remove_action( 'woocommerce_after_shop_loop_item', 'www_output_add_to_wishlist_button', 15 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );

	add_action( 'woocommerce_before_shop_loop_item', 'milu_wc_loop_thumbnail', 10, 1 );
	add_action( 'woocommerce_after_shop_loop_item', 'milu_wc_loop_summary' );
}
add_action( 'woocommerce_init', 'milu_remove_loop_item_default_wc_hooks' );

/**
 * WC loop thumbnail
 */
function milu_wc_loop_thumbnail( $template_args ) {

	extract( wp_parse_args( $template_args, array(
		'display' => '',
		'layout' => 'standard',
	) ) );

	$product_thumbnail_size = ( 'metro' === $display ) ? 'milu-metro' : 'woocommerce_thumbnail';
	$product_thumbnail_size = apply_filters( 'milu_' . $display . '_thumbnail_size_name', $product_thumbnail_size );
	$product_thumbnail_size = ( milu_is_gif( get_post_thumbnail_id() ) ) ? 'full' : $product_thumbnail_size;
	$product_thumbnail_bg = sanitize_hex_color( milu_get_inherit_mod( 'product_bg_color', '', get_the_ID() ) );
	?>
	<div class="product-box">
			<?php if ( 'standard' !== $layout ) : ?>
				<div class="product-bg" style="background-color:<?php echo esc_attr( $product_thumbnail_bg ) ?>;"></div>
			<?php endif; ?>
		<a class="entry-link-mask" href="<?php the_permalink(); ?>"></a>
		<div class="product-thumbnail-container clearfix">
			<?php if ( 'standard' === $layout ) : ?>
				<div class="product-bg" style="background-color:<?php echo esc_attr( $product_thumbnail_bg ) ?>;"></div>
			<?php endif; ?>
			<div class="product-thumbnail-inner">
				<?php woocommerce_show_product_loop_sale_flash(); ?>
				<?php echo woocommerce_get_product_thumbnail( $product_thumbnail_size ); ?>
				<?php milu_woocommerce_second_product_thumbnail( $product_thumbnail_size ); ?>
				
			</div><!-- .product-thumbnail-inner -->
		</div><!-- .product-thumbnail-container -->
	<?php
}

function milu_wc_loop_summary() {
	?>
	<div class="product-summary clearfix">
		<div class="product-caption">
			<?php woocommerce_template_loop_product_link_open(); ?>
				
				<?php woocommerce_template_loop_product_title(); ?>
				<?php
					/**
					 * After title
					 */
					do_action( 'milu_after_shop_loop_item_title' );
				?>
			<?php woocommerce_template_loop_product_link_close(); ?>
			<?php woocommerce_template_loop_price(); ?>
		</div>
		<div class="product-actions">
			<?php
				/**
				 * Quickview button
				 */
				do_action( 'milu_product_quickview_button' );
			
				/**
				 * Wishlist button
				 */
				do_action( 'milu_add_to_wishlist_button' );
				/**
				 * Add to cart button
				 */
				do_action( 'milu_product_add_to_cart_button' );
			?>
		</div><!-- .product-actions -->
	</div><!-- .product-summary -->

	</div><!-- .product-box -->
	<?php
}

/**
 * Product stacked images + sticky details
 */
function milu_single_product_sticky_layout() {

	if ( ! milu_get_inherit_mod( 'product_sticky' ) || 'no' === milu_get_inherit_mod( 'product_sticky' ) ) {
		return;
	}

	/* Remove default images */
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

	global $product;

	$product_id = $product->get_id();

	echo '<div class="images">';

	woocommerce_show_product_sale_flash();
	/**
	 * If gallery
	 */
	$attachment_ids = $product->get_gallery_image_ids();

	if ( is_array( $attachment_ids ) && ! empty( $attachment_ids ) ) {

		echo '<ul>';

		if ( has_post_thumbnail( $product_id ) ) {

			$caption = get_post_field( 'post_excerpt', get_post_thumbnail_id( $post_thumbnail_id ) );
			?>
			<li class="stacked-image">
				<a class="lightbox" data-fancybox="wc-stacked-images-<?php echo absint( $product_id ); ?>" href="<?php echo get_the_post_thumbnail_url( $product_id, 'full' ); ?>" data-caption="<?php echo esc_attr( $caption ); ?>">
					<?php echo milu_kses( $product->get_image( 'large' ) ); ?>
				</a>
			</li>
			<?php
		}

		foreach ( $attachment_ids as $attachment_id ) {
			if ( wp_attachment_is_image( $attachment_id ) ) {

				$caption = get_post_field( 'post_excerpt', $attachment_id );
				?>
				<li class="stacked-image">
					<a class="lightbox" data-fancybox="wc-stacked-images-<?php echo absint( $product_id ); ?>" href="<?php echo wp_get_attachment_url( $attachment_id, 'full' ); ?>" data-caption="<?php echo esc_attr( $caption ); ?>">
						<?php echo wp_get_attachment_image( $attachment_id, 'large' ); ?>
					</a>
				</li>
				<?php
			}
		}

		echo '</ul>';

	/**
	 * If featured image only
	 */
	} elseif ( has_post_thumbnail( $product_id ) ) {
		?>
		<span class="stacked-image">
			<a class="lightbox" data-fancybox="wc-stacked-images-<?php echo absint( $product_id ); ?>" href="<?php echo get_the_post_thumbnail_url( $product_id, 'full' ); ?>">
				<?php echo milu_kses( $product->get_image( 'large' ) ); ?>
			</a>
		</span>
		<?php
	/**
	 * Placeholder
	 */
	} else {
		
		$html  = '<span class="woocommerce-product-gallery__image--placeholder">';
		$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'milu' ) );
		$html .= '</span>';

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
	}

	echo '</div>';
}
add_action( 'woocommerce_before_single_product_summary', 'milu_single_product_sticky_layout' );



add_action( 'milu_wc_before_add_to_cart_quantity_input', function() {
	echo '<span class="wt-quantity-plus"></span>';
} );

add_action( 'milu_wc_after_add_to_cart_quantity_input', function() {
	echo '<span class="wt-quantity-minus"></span>';
} );

/**
 * Filter WC tab
 *
 * Replace tabs by accordion
 */
function milu_filter_wc_tabs( $markup, $tabs ) {
	if ( ! empty( $tabs ) ) : ?>
		<?php ob_start(); ?>
		<div class="woocommerce-tabs">
			<div id="wvc-wc-accordion" class="wvc-accordion tabs-container">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<h2 class="wvc-accordion-tab"><a href="#"><span class="wvc-at-title-container"><span class="wvc-at-title-text"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span></span></a></h2>
					<div class="wvc-clearfix" ><div class="wbp_wrapper"><?php call_user_func( $tab['callback'], $key, $tab ); ?>
					</div><!--.wbp_wrapper--></div><!--.wvc-text-block-->
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif;
	return ob_get_clean();
}
add_filter( 'milu_wc_tabs', 'milu_filter_wc_tabs', 10, 2 );


/*--------------------------------------------------------------------

	PLUGIN SETTINGS

----------------------------------------------------------------------*/

/**
 * Set portfolio template folder
 */
function milu_set_portfolio_template_url( $template_url ) {

	return 'portfolio/';
}
add_filter( 'wolf_portfolio_template_url', 'milu_set_portfolio_template_url' );

/**
 * Add custom fields in work meta
 */
add_action( 'milu_work_meta', function() {
	milu_the_work_meta();
}, 15 );

add_filter( 'milu_work_meta_separator', function() {
	return ' &bull; ';
} );

/**
 * Set videos template folder
 */
function milu_set_videos_template_url( $template_url ) {

	return 'videos/';
}
add_filter( 'wolf_videos_template_url', 'milu_set_videos_template_url' );

/**
 * Set video display
 *
 * @param string $string
 * @return string
 */
function milu_set_video_display( $string ) {

	return 'grid';
}
add_filter( 'milu_mod_video_display', 'milu_set_video_display', 44 );

/*--------------------------------------------------------------------

	MODS

----------------------------------------------------------------------*/

/**
 * Remove unused mods
 */
function milu_remove_mods( $mods ) {

	unset( $mods['layout']['options']['button_style'] );
	unset( $mods['layout']['options']['site_layout'] );
	
	unset( $mods['fonts']['options']['body_font_size'] );

	unset( $mods['wolf_videos']['options']['video_display'] );

	unset( $mods['shop']['options']['product_display'] );

	unset( $mods['navigation']['options']['menu_hover_style'] );
	unset( $mods['navigation']['options']['menu_layout']['choices']['lateral'] );
	unset( $mods['navigation']['options']['menu_layout']['choices']['offcanvas'] );
	unset( $mods['navigation']['options']['menu_skin'] );

	unset( $mods['header_settings']['options']['hero_scrolldown_arrow'] );

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_remove_mods', 20 );

/**
 * Spinners folder
 */
add_filter( 'milu_spinners_folder', function() {
	return 'components/spinners/';
} );

/**
 * Add mods
 */
function milu_add_mods( $mods ) {

	$color_scheme = milu_get_color_scheme();

	/*$mods['layout']['options']['custom_cursor'] = array(
		'id' => 'custom_cursor',
		'label' => esc_html__( 'Custom Cursor', 'milu' ),
		'type' => 'select',
		'choices' => array(
			'' => esc_html__( 'Disabled', 'milu' ),
 			'enabled' => esc_html__( 'Enabled', 'milu' ),
		),
	);*/

	$mods['logo']['options']['one_letter_logo'] = array(
		'id' => 'one_letter_logo',
		'label' => esc_html__( 'One Letter Logo', 'milu' ),
		'type' => 'text',
		'description' => esc_html__( 'Enter just one letter to generate a navigation logo automatically.', 'milu' ),
	);

	$mods['colors']['options']['secondary_accent_color'] = array(
		'id' => 'secondary_accent_color',
		'label' => esc_html__( 'Secondary Accent Color', 'milu' ),
		'type' => 'color',
		'transport' => 'postMessage',
		'default' => $color_scheme[8],
	);

	$mods['loading'] = array(

		'id' => 'loading',
		'title' => esc_html__( 'Loading', 'milu' ),
		'icon' => 'update',
		'options' => array(

			array(
				'label' => esc_html__( 'Loading Animation Type', 'milu' ),
				'id' => 'loading_animation_type',
				'type' => 'select',
				'choices' => array(
					'none' => esc_html__( 'None', 'milu' ),
		 			'overlay' => esc_html__( 'Simple Overlay', 'milu' ),
		 			'logo' => esc_html__( 'Overlay with Logo', 'milu' ),
		 			'spinner-loader1' => esc_html__( 'Rotating plane', 'milu' ),
					'spinner-loader2' => esc_html__( 'Double Pulse', 'milu' ),
					'spinner-loader3' => esc_html__( 'Wave', 'milu' ),
					'spinner-loader4' => esc_html__( 'Wandering cubes', 'milu' ),
					'spinner-loader5' => esc_html__( 'Pulse', 'milu' ),
					'spinner-loader6' => esc_html__( 'Chasing dots', 'milu' ),
					'spinner-loader7' => esc_html__( 'Three bounce', 'milu' ),
					'spinner-loader8' => esc_html__( 'Circle', 'milu' ),
					'spinner-loader9' => esc_html__( 'Cube grid', 'milu' ),
					'spinner-loader10' => esc_html__( 'Classic Loader', 'milu' ),
					'spinner-loader11' => esc_html__( 'Folding cube', 'milu' ),
					'spinner-loader12' => esc_html__( 'Ball Pulse', 'milu' ),
					'spinner-loader13' => esc_html__( 'Ball Grid Pulse', 'milu' ),
					'spinner-loader15' => esc_html__( 'Ball Clip Rotate Pulse', 'milu' ),
					'spinner-loader16' => esc_html__( 'Ball Clip Rotate Pulse Multiple', 'milu' ),
					'spinner-loader17' => esc_html__( 'Ball Pulse Rise', 'milu' ),
					'spinner-loader19' => esc_html__( 'Ball Zigzag', 'milu' ),
					'spinner-loader20' => esc_html__( 'Ball Zigzag Deflect', 'milu' ),
					'spinner-loader21' => esc_html__( 'Ball Triangle Path', 'milu' ),
					'spinner-loader22' => esc_html__( 'Ball Scale', 'milu' ),
					'spinner-loader23' => esc_html__( 'Ball Line Scale', 'milu' ),
					'spinner-loader24' => esc_html__( 'Ball Line Scale Party', 'milu' ),
					'spinner-loader25' => esc_html__( 'Ball Scale Multiple', 'milu' ),
					'spinner-loader26' => esc_html__( 'Ball Pulse Sync', 'milu' ),
					'spinner-loader27' => esc_html__( 'Ball Beat', 'milu' ),
					'spinner-loader28' => esc_html__( 'Ball Scale Ripple Multiple', 'milu' ),
					'spinner-loader29' => esc_html__( 'Ball Spin Fade Loader', 'milu' ),
					'spinner-loader30' => esc_html__( 'Line Spin Fade Loader', 'milu' ),
					'spinner-loader31' => esc_html__( 'Pacman', 'milu' ),
					'spinner-loader32' => esc_html__( 'Ball Grid Beat ', 'milu' ),
				),
			),

			'loading_logo' => array(
				'id' => 'loading_logo',
				'description' => esc_html__( 'The loading animation will be disabled if you upload a loading logo.', 'milu' ),
				'label' => esc_html__( 'Optional Loading Logo', 'milu' ),
				'type' => 'image',
			),

			array(
				'label' => esc_html__( 'Loading Logo Animation', 'milu' ),
				'id' => 'loading_logo_animation',
				'type' => 'select',
				'choices' => array(
					'none'	 => esc_html__( 'None', 'milu' ),
		 			'pulse' => esc_html__( 'Pulse', 'milu' ),
				),
			),

			/*'loading_text' => array(
				'label' => esc_html__( 'Loading Text', 'milu' ),
				'id' => 'loading_text',
				'description' => esc_html__( 'For the overlay with text loading animation. By default, the site title will be used', 'milu' ),
				'label' => esc_html__( 'Loading Text', 'milu' ),
			),*/

			/*'loading_logo_svg' => array(
				'type' => 'image',
				'label' => esc_html__( 'Loading Logo SVG', 'milu' ),
				'id' => 'loading_logo_svg',
				'description' => esc_html__( 'The glitch logo loading animation effect need both a PNG and SVG version of your logo image.', 'milu' ),
			),*/

			/*array(
				'label' => esc_html__( 'Loading Logo Animation', 'milu' ),
				'id' => 'loading_logo_animation',
				'type' => 'select',
				'choices' => array(
					'none'	 => esc_html__( 'None', 'milu' ),
		 			'pulse' => esc_html__( 'Pulse', 'milu' ),
				),
			),*/
		),
	);

	$mods['blog']['options']['post_skin'] = array(
		'label'	=> esc_html__( 'Color Tone in Loop', 'milu' ),
		'id'	=> 'post_skin',
		'type'	=> 'select',
		'choices' => array(
			'dark' => esc_html__( 'Dark', 'milu' ),
			'light' => esc_html__( 'Light', 'milu' ),
		),
	);

	$mods['blog']['options']['single_post_nav'] = array(
		'label'	=> esc_html__( 'Prev/Next Post Pagination', 'milu' ),
		'id'	=> 'single_post_nav',
		'type'	=> 'select',
		'choices' => array(
			'yes' => esc_html__( 'Yes', 'milu' ),
			'no' => esc_html__( 'No', 'milu' ),
		),
	);

	$mods['blog']['options']['single_post_nav'] = array(
		'label'	=> esc_html__( 'Prev/Next Post Pagination', 'milu' ),
		'id'	=> 'single_post_nav',
		'type'	=> 'select',
		'choices' => array(
			'yes' => esc_html__( 'Yes', 'milu' ),
			'no' => esc_html__( 'No', 'milu' ),
		),
	);

	$mods['blog']['options']['post_hero_layout'] = array(
		'label'	=> esc_html__( 'Single Post Header Layout', 'milu' ),
		'id'	=> 'post_hero_layout',
		'type'	=> 'select',
		'choices' => array(
			'' => esc_html__( 'Default', 'milu' ),
			'standard' => esc_html__( 'Standard', 'milu' ),
			'big' => esc_html__( 'Big', 'milu' ),
			'small' => esc_html__( 'Small', 'milu' ),
			'fullheight' => esc_html__( 'Full Height', 'milu' ),
			'none' => esc_html__( 'No header', 'milu' ),
		),
	);

	$mods['blog']['options']['hide_single_post_featured_image'] = array(
		'label'	=> esc_html__( 'Hide Featured Image in Post', 'milu' ),
		'id'	=> 'hide_single_post_featured_image',
		'type'	=> 'checkbox',
	);


	$mods['navigation']['options']['hero_font_tone'] = array(
		'label'	=> esc_html__( 'Default font tone', 'milu' ),
		'id'	=> 'hero_font_tone',
		'type'	=> 'select',
		'choices' => array(
			'' => esc_html__( 'Default', 'milu' ),
			'dark' => esc_html__( 'Dark', 'milu' ),
			'light' => esc_html__( 'Light', 'milu' ),
		),
		'transport' => 'postMessage',
	);

	$mods['navigation']['options']['side_panel_bg_img'] = array(
		'label'	=> esc_html__( 'Side Panel Background', 'milu' ),
		'id'	=> 'side_panel_bg_img',
		'type'	=> 'image',
	);

	if ( isset( $mods['wolf_videos'] ) ) {

		$mods['wolf_videos']['options']['video_skin'] = array(
			'label'	=> esc_html__( 'Color Tone in Loop', 'milu' ),
			'id'	=> 'video_skin',
			'type'	=> 'select',
			'choices' => array(
				'dark' => esc_html__( 'Dark', 'milu' ),
				'light' => esc_html__( 'Light', 'milu' ),
			),
		);

		$mods['wolf_videos']['options']['video_hero_layout'] = array(
			'label'	=> esc_html__( 'Single Video Header Layout', 'milu' ),
			'id'	=> 'video_hero_layout',
			'type'	=> 'select',
			'choices' => array(
				'' => esc_html__( 'Default', 'milu' ),
				'standard' => esc_html__( 'Standard', 'milu' ),
				'big' => esc_html__( 'Big', 'milu' ),
				'small' => esc_html__( 'Small', 'milu' ),
				'fullheight' => esc_html__( 'Full Height', 'milu' ),
				'none' => esc_html__( 'No header', 'milu' ),
			),
		);

		$mods['wolf_videos']['options']['video_category_filter'] = array(
			'id' => 'video_category_filter',
			'label' => esc_html__( 'Category filter (not recommended with a lot of videos)', 'milu' ),
			'type' => 'checkbox',
		);

		$mods['wolf_videos']['options']['products_per_page'] = array(
			'label' => esc_html__( 'Videos per Page', 'milu' ),
			'id' => 'videos_per_page',
			'type' => 'text',
		);

		$mods['wolf_videos']['options']['video_pagination'] = array(
			'id' =>'video_pagination',
			'label' => esc_html__( 'Video Archive Pagination', 'milu' ),
			'type' => 'select',
			'choices' => array(
				'standard_pagination' => esc_html__( 'Numeric Pagination', 'milu' ),
				'load_more' => esc_html__( 'Load More Button', 'milu' ),
			),
		);

		$mods['wolf_videos']['options']['video_display_elements'] = array(
			'id' => 'video_display_elements',
			'label' => esc_html__( 'Post meta to show in single video page', 'milu' ),
			'type' => 'group_checkbox',
			'choices' => array(
				'show_date' => esc_html__( 'Date', 'milu' ),
				'show_author' => esc_html__( 'Author', 'milu' ),
				'show_category' => esc_html__( 'Category', 'milu' ),
				'show_tags' => esc_html__( 'Tags', 'milu' ),
				'show_extra_meta' => esc_html__( 'Extra Meta', 'milu' ),
			),
			'description' => esc_html__( 'Note that some options may be ignored depending on the post display.', 'milu' ),
		);

		if ( class_exists( 'Wolf_Custom_Post_Meta' ) ) {

			$mods['wolf_videos']['options'][] = array(
				'label' => esc_html__( 'Enable Custom Post Meta', 'milu' ),
				'id' => 'video_enable_custom_post_meta',
				'type' => 'group_checkbox',
				'choices' => array(
					'video_enable_views' => esc_html__( 'Views', 'milu' ),
					'video_enable_likes' => esc_html__( 'Likes', 'milu' ),
				),
			);
		}
	}

	if ( isset( $mods['portfolio'] ) ) {
		$mods['portfolio']['options']['work_hero_layout'] = array(
			'label'	=> esc_html__( 'Single Work Header Layout', 'milu' ),
			'id'	=> 'work_hero_layout',
			'type'	=> 'select',
			'choices' => array(
				'' => esc_html__( 'Default', 'milu' ),
				'standard' => esc_html__( 'Standard', 'milu' ),
				'big' => esc_html__( 'Big', 'milu' ),
				'small' => esc_html__( 'Small', 'milu' ),
				'fullheight' => esc_html__( 'Full Height', 'milu' ),
				'none' => esc_html__( 'No header', 'milu' ),
			),
		);
	}

	if ( isset( $mods['shop'] ) && class_exists( 'WooCommerce' ) ) {
		
		$mods['shop']['options']['product_skin'] = array(
			'label'	=> esc_html__( 'Color Tone in Loop', 'milu' ),
			'id'	=> 'product_skin',
			'type'	=> 'select',
			'choices' => array(
				'dark' => esc_html__( 'Dark', 'milu' ),
				'light' => esc_html__( 'Light', 'milu' ),
			),
		);

		$mods['shop']['options']['product_bg_color'] = array(
			'label'	=> esc_html__( 'Product Background Color in Loop', 'milu' ),
			'id'	=> 'product_bg_color',
			'type'	=> 'color',
		);

		if ( class_exists( 'Wolf_WooCommerce_Currency_Switcher' ) ) {
			$mods['shop']['options']['currency_switcher'] = array(
				'label'	=> esc_html__( 'Add Currency Switcher to Menu', 'milu' ),
				'id'	=> 'currency_switcher',
				'type'	=> 'checkbox',
			);
		}
		
		$mods['shop']['options']['product_sticky'] = array(
			'label'	=> esc_html__( 'Stacked Images with Sticky Product Details', 'milu' ),
			'id'	=> 'product_sticky',
			'type'	=> 'checkbox',
			'description' => esc_html__( 'Not compatible with sidebar layouts.', 'milu' ),
		);
	}

	return $mods;
}
add_filter( 'milu_customizer_mods', 'milu_add_mods', 40 );

/*--------------------------------------------------------------------

	CUSTOM FUNCTIONS

----------------------------------------------------------------------*/

/**
 * Custom calendar date format
 */
function milu_custom_date( $date = '' ) {

	$date = ( $date ) ? $date :  get_the_date( 'Y/m/d' );

	list( $year, $monthnbr, $day ) = explode( '/', $date );
	$search = array( '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12' );
	$replace = array( esc_html__( 'Jan', 'milu' ), esc_html__( 'Feb', 'milu' ), esc_html__( 'Mar', 'milu' ), esc_html__( 'Apr', 'milu' ), esc_html__( 'May', 'milu' ), esc_html__( 'Jun', 'milu' ), esc_html__( 'Jul', 'milu' ), esc_html__( 'Aug', 'milu' ), esc_html__( 'Sep', 'milu' ), esc_html__( 'Oct', 'milu' ), esc_html__( 'Nov', 'milu' ), esc_html__( 'Dec', 'milu' ) );
	$month = str_replace( $search, $replace, $monthnbr );
	
	$output = '<div class="date-format-custom wvc-bigtext"><span class="custom-date-day">' . $day . '</span><span class="custom-date-month">' . $month . '</span>';

	if ( 1 < absint( date( 'Y' ) ) - $year ) {
		$output .= '<span class="custom-date-year">' . $year . '</span>';
	}

	$output .= '</div>';

	return $output;
}

/*--------------------------------------------------------------------

	DEFAULT MODS & SETTINGS

----------------------------------------------------------------------*/

/**
 * Filter WVC theme accent color
 *
 * @param string $color
 * @return string $color
 */
function milu_set_wvc_secondary_theme_accent_color( $color ) {
	return milu_get_inherit_mod( 'secondary_accent_color' );
}
add_filter( 'wvc_theme_secondary_accent_color', 'milu_set_wvc_theme_secondary_accent_color' );

/**
 * Add theme secondary accent color to shared colors
 *
 * @param array $colors
 * @return array $colors
 */
function milu_wvc_add_secondary_accent_color_option( $colors ) {

	$colors = array( esc_html__( 'Theme Secondary Accent Color', 'milu' ) => 'secondary_accent' ) + $colors;

	return $colors;
}
add_filter( 'wvc_shared_colors', 'milu_wvc_add_secondary_accent_color_option' );

/**
 * Filter WVC shared color hex
 *
 * @param array $colors
 * @return array $colors
 */
function milu_add_secondary_accent_color_hex( $colors ) {
	
	$secondary_accent_color = milu_get_inherit_mod( 'secondary_accent_color' );

	if ( $secondary_accent_color ) {
		$colors['secondary_accent'] = apply_filters( 'wvc_secondary_theme_accent_color', $secondary_accent_color );
	}

	return $colors;
}
add_filter( 'wvc_shared_colors_hex', 'milu_add_secondary_accent_color_hex' );

/**
 *  Set default icon font
 *
 * @param string $shape
 * @return string $shape
 */
function milu_set_default_icon_font( $shape ) {
	return 'dripicons';
}
add_filter( 'wvc_default_icon_font', 'milu_set_default_icon_font', 40 );

/**
 *  Set default item overlay color
 *
 * @param string $color
 * @return string $color
 */
function milu_set_default_item_overlay_color( $color ) {
	return 'auto';
}
add_filter( 'wvc_default_item_overlay_color', 'milu_set_default_item_overlay_color' );

function milu_set_default_hero_font_tone( $tone ) {
	return milu_get_inherit_mod( 'hero_font_tone', 'dark' );
}
add_filter( 'milu_default_no_header_hero_font_tone', 'milu_set_default_hero_font_tone' );

/**
 *  Set default item overlay text color
 *
 * @param string $color
 * @return string $color
 */
function milu_set_item_overlay_text_color( $color ) {
	return 'white';
}
add_filter( 'wvc_default_item_overlay_text_color', 'milu_set_item_overlay_text_color' );

/**
 *  Set default item overlay opacity
 *
 * @param int $color
 * @return int $color
 */
function milu_set_item_overlay_opacity( $opacity ) {
	return 1;
}
add_filter( 'wvc_default_item_overlay_opacity', 'milu_set_item_overlay_opacity' );

/**
 * Excerpt length hook
 * Set the number of character to display in the excerpt
 *
 * @param int $length
 * @return int
 */
function milu_overwrite_excerpt_length( $length ) {

	return 23;
}
add_filter( 'milu_excerpt_length', 'milu_overwrite_excerpt_length' );

/**
 *  Set menu skin
 *
 * @param string $skin
 * @return string $skin
 */
function milu_set_menu_skin( $skin ) {
	return 'light';
}

/**
 * Excerpt length hook
 * Set the number of character to display in the excerpt
 *
 * @param int $length
 * @return int
 */
function milu_overwrite_sticky_menu_height( $length ) {

	return 66;
}
add_filter( 'milu_sticky_menu_height', 'milu_overwrite_sticky_menu_height' );

/**
 * Set menu hover effect
 *
 * @param string $string
 * @return string
 */
function milu_set_menu_hover_style( $string ) {
	return 'opacity';
}
add_filter( 'milu_mod_menu_hover_style', 'milu_set_menu_hover_style' );

/**
 * Standard row width
 */
add_filter( 'wvc_row_standard_width', function( $string ) {
	return '1400px';
}, 40 );

add_filter( 'wvc_row_small_width', function( $string ) {
	return '960px';
}, 40 );

/**
 * Load more pagination hash change
 */
add_filter( 'milu_loadmore_pagination_hashchange', function( $size ) {
	return false;
}, 40 );

/**
 *  Set embed video title
 *
 * @param string $title
 * @return string $title
 */
function wvc_set_embed_video_title( $title ) {

	return esc_html__( '&mdash; %s', 'milu' );
}
add_filter( 'wvc_embed_video_title', 'wvc_set_embed_video_title', 40 );

/**
 *  Set embed video title
 *
 * @param string $title
 * @return string $title
 */
function milu_set_default_video_opener_button( $title ) {

	return '<span class="video-opener" data-aos="fade" data-aos-once="true"></span>';
}
add_filter( 'wvc_default_video_opener_button', 'milu_set_default_video_opener_button', 40 );

/**
 *  Set default pie chart line width
 *
 * @param string $width
 * @return string $width
 */
function wvc_set_default_pie_chart_line_width( $width ) {
	return 15;
}
add_filter( 'wvc_default_pie_chart_line_width', 'wvc_set_default_pie_chart_line_width', 40 );



/**
 *  Set default button shape
 *
 * @param string $shape
 * @return string $shape
 */
function milu_set_default_wvc_button_shape( $shape ) {
	return 'rounded';
}
add_filter( 'wvc_default_button_shape', 'milu_set_default_wvc_button_shape', 40 );

/**
 *  Set default button shape
 *
 * @param string $shape
 * @return string $shape
 */
function milu_set_default_theme_button_shape( $shape ) {
	return 'round';
}
add_filter( 'milu_mod_button_style', 'milu_set_default_theme_button_shape', 40 );

/**
 * Default font weight
 */
add_filter( 'wvc_button_default_font_weight', function( $font_weight ) {
	return 700;
} );

/**
 *  Set default team member v align
 *
 * @param string $string
 * @return string $string
 */
function wvc_set_default_team_member_text_vertical_alignement( $string ) {

	return 'bottom';
}
add_filter( 'wvc_default_team_member_text_vertical_alignement', 'wvc_set_default_team_member_text_vertical_alignement', 40 );

/**
 *  Set default heading layout
 *
 * @param string $layout
 * @return string $layout
 */
function wvc_set_default_team_member_layout( $layout ) {
	return 'overlay';
}
add_filter( 'wvc_default_team_member_layout', 'wvc_set_default_team_member_layout', 40 );

/**
 *  Set default team member socials_args
 *
 * @param string $args
 * @return string $args
 */
function wvc_set_default_team_member_socials_args( $args ) {

	$args['background_style'] = 'rounded';
	$args['background_color'] = 'white';
	$args['custom_color'] = '#000000';
	$args['size'] = 'fa-1x';

	return $args;
}
add_filter( 'wvc_team_member_socials_args', 'wvc_set_default_team_member_socials_args', 40 );

/**
 *  Set default team member title font size
 *
 * @param string $font_size
 * @return string $font_size
 */
function wvc_set_default_team_member_font_size( $font_size ) {
	return 24;
}
add_filter( 'wvc_default_team_member_title_font_size', 'wvc_set_default_team_member_font_size', 40 );
add_filter( 'wvc_default_single_image_title_font_size', 'wvc_set_default_team_member_font_size', 40 );

/**
 *  Set default heading font size
 *
 * @param int $font_size
 * @return int $font_size
 */
function wvc_set_default_custom_heading_font_size( $font_size ) {
	return 32;
}
add_filter( 'wvc_default_custom_heading_font_size', 'wvc_set_default_custom_heading_font_size', 40 );
add_filter( 'wvc_default_advanced_slide_title_font_size', 'wvc_set_default_custom_heading_font_size', 40 );

/**
 *  Set default heading font family
 *
 * @param string $font_family
 * @return string $font_family
 */
function milu_set_default_custom_heading_font_family( $font_family ) {
	return 'Staatliches';
}
add_filter( 'wvc_default_bigtext_font_family', 'milu_set_default_custom_heading_font_family', 40 );

/**
 *  Set default heading font weight
 *
 * @param string $font_weight
 * @return string $font_weight
 */
function milu_set_default_custom_heading_font_weight( $font_weight ) {
	return '';
}
add_filter( 'wvc_default_advanced_slide_title_font_weight', 'milu_set_default_custom_heading_font_weight', 40 );
add_filter( 'wvc_default_custom_heading_font_weight', 'milu_set_default_custom_heading_font_weight', 40 );
add_filter( 'wvc_default_bigtext_font_weight', 'milu_set_default_custom_heading_font_weight', 40 );
add_filter( 'wvc_default_cta_font_weight', 'milu_set_default_custom_heading_font_weight', 40 );
add_filter( 'wvc_default_pie_font_weight', 'milu_set_default_custom_heading_font_weight', 40 );

/**
 *  Set default heading font size
 *
 * @param string $font_size
 * @return string $font_size
 */
function wvc_set_default_cta_font_size( $font_size ) {
	return 22;
}
add_filter( 'wvc_default_cta_font_size', 'wvc_set_default_cta_font_size', 40 );

/**
 * Post Slider color tone
 */
function milu_add_post_slider_color_block() {
	?>
	<div class="wvc-big-slide-color-block" style="background-color:<?php echo wvc_color_brightness( wvc_get_image_dominant_color( get_post_thumbnail_id() ), 10 ); ?>"></div>
	<?php
}
add_action( 'wvc_post_big_slide_start', 'milu_add_post_slider_color_block' );

/*--------------------------------------------------------------------

	BUTTONS

----------------------------------------------------------------------*/

/**
 * Custom button types
 */
function milu_custom_button_types() {
	return array(
		esc_html__( 'Custom', 'milu' ) => 'default',
		esc_html__( 'Special Accent', 'milu' ) => 'theme-button-special-accent',
		esc_html__( 'Special Secondary Accent', 'milu' ) => 'theme-button-special-accent-secondary',
		esc_html__( 'Solid Accent', 'milu' ) => 'theme-button-solid-accent',
		esc_html__( 'Outline Accent', 'milu' ) => 'theme-button-outline-accent',
		esc_html__( 'Solid Accent Secondary', 'milu' ) => 'theme-button-solid-accent-secondary',
		esc_html__( 'Outline Accent Secondary', 'milu' ) => 'theme-button-outline-accent-secondary',
		esc_html__( 'Simple Text Accent', 'milu' ) => 'theme-button-text-accent',
		esc_html__( 'Simple Text Accent Secondary', 'milu' ) => 'theme-button-text-accent-secondary',
		esc_html__( 'Special', 'milu' ) => 'theme-button-special',
		esc_html__( 'Solid', 'milu' ) => 'theme-button-solid',
		esc_html__( 'Outline', 'milu' ) => 'theme-button-outline',
		esc_html__( 'Simple Text', 'milu' ) => 'theme-button-text',
	);
}

/**
 * Primary Special buttons class
 *
 * @param string $string
 * @return string
 */
function milu_set_primary_special_button_class( $class ) {

	$milu_button_class = 'theme-button-solid';

	$class = $milu_button_class . ' wvc-button wvc-button-size-sm';

	return $class;
}
add_filter( 'wvc_last_posts_big_slide_button_class', 'milu_set_primary_special_button_class' );

/**
 * Primary Special buttons class
 *
 * @param string $string
 * @return string
 */
function milu_set_primary_special_button_outline( $class ) {

	$milu_button_class = 'theme-button-text';

	$class = $milu_button_class . ' wvc-button wvc-button-size-sm';

	return $class;
}
add_filter( 'milu_loadmore_button_class', 'milu_set_primary_special_button_outline' );

/**
 * Primary Outline buttons class
 *
 * @param string $string
 * @return string
 */
function milu_set_primary_button_class( $class ) {

	$milu_button_class = 'theme-button-solid';

	$class = $milu_button_class . ' wvc-button wvc-button-size-sm';

	return $class;
}
add_filter( 'milu_404_button_class', 'milu_set_primary_button_class' );
add_filter( 'milu_single_event_buy_ticket_button_class', 'milu_set_primary_button_class' );

/**
 * Event ticket button class
 *
 * @param string $string
 * @return string
 */
function milu_set_single_add_to_cart_button_class( $class ) {

	$class = 'single_add_to_cart_button button theme-button-solid-accent';

	return $class;
}
add_filter( 'milu_single_add_to_cart_button_class', 'milu_set_single_add_to_cart_button_class', 40 );

/**
 * Main buttons class
 *
 * @param string $string
 * @return string
 */
function milu_set_alt_button_class( $class ) {

	$milu_button_class = 'theme-button-solid';

	$class = $milu_button_class . ' wvc-button wvc-button-size-xs';

	return $class;
}
add_filter( 'milu_release_button_class', 'milu_set_alt_button_class' );

/**
 * Text buttons class
 *
 * @param string $string
 * @return string
 */
function milu_set_more_link_button_class( $class ) {

	$milu_button_class = 'theme-button-text';

	$class = $milu_button_class . ' wvc-button wvc-button-size-xs';

	return $class;
}
add_filter( 'milu_more_link_button_class', 'milu_set_more_link_button_class' );
add_filter( 'wvc_showcase_vertical_carousel_button_class', 'milu_set_more_link_button_class' );

/**
 * Author box buttons class
 *
 * @param string $string
 * @return string
 */
function milu_set_author_box_button_class( $class ) {

	$class = ' wvc-button wvc-button-size-xs theme-button-text';

	return $class;
}
add_filter( 'milu_author_page_link_button_class', 'milu_set_author_box_button_class' );

/**
 * Add button dependencies
 */
function milu_add_button_dependency_params() {

	if ( ! class_exists( 'WPBMap' ) || ! class_exists( 'Wolf_Visual_Composer' ) || ! defined( 'WVC_OK' ) || ! WVC_OK ) {
		return;
	}

	$param = WPBMap::getParam( 'vc_button', 'color' );
	$param['dependency'] = array(
		'element' => 'button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'vc_button', $param );

	$param = WPBMap::getParam( 'vc_button', 'shape' );
	$param['dependency'] = array(
		'element' => 'button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'vc_button', $param );

	$param = WPBMap::getParam( 'vc_button', 'hover_effect' );
	$param['dependency'] = array(
		'element' => 'button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'vc_button', $param );

	$param = WPBMap::getParam( 'vc_cta', 'btn_color' );
	$param['dependency'] = array(
		'element' => 'btn_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'vc_cta', $param );

	$param = WPBMap::getParam( 'vc_cta', 'btn_shape' );
	$param['dependency'] = array(
		'element' => 'btn_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'vc_cta', $param );

	$param = WPBMap::getParam( 'vc_cta', 'btn_hover_effect' );
	$param['dependency'] = array(
		'element' => 'btn_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'vc_cta', $param );

	$param = WPBMap::getParam( 'wvc_advanced_slide', 'b1_color' );
	$param['dependency'] = array(
		'element' => 'b1_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'wvc_advanced_slide', $param );

	$param = WPBMap::getParam( 'wvc_advanced_slide', 'b1_shape' );
	$param['dependency'] = array(
		'element' => 'b1_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'wvc_advanced_slide', $param );

	$param = WPBMap::getParam( 'wvc_advanced_slide', 'b1_hover_effect' );
	$param['dependency'] = array(
		'element' => 'b1_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'wvc_advanced_slide', $param );

	$param = WPBMap::getParam( 'wvc_advanced_slide', 'b2_color' );
	$param['dependency'] = array(
		'element' => 'b2_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'wvc_advanced_slide', $param );

	$param = WPBMap::getParam( 'wvc_advanced_slide', 'b2_shape' );
	$param['dependency'] = array(
		'element' => 'b2_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'wvc_advanced_slide', $param );

	$param = WPBMap::getParam( 'wvc_advanced_slide', 'b2_hover_effect' );
	$param['dependency'] = array(
		'element' => 'b2_button_type',
		'value' => 'default',
	);
	vc_update_shortcode_param( 'wvc_advanced_slide', $param );
}
add_action( 'init', 'milu_add_button_dependency_params', 15 );

add_filter( 'wvc_default_testimonial_slider_text_alignment', function() {
	return 'left';
} , 100 );

/**
 *  Add milu background effect
 *
 * @param string $effects
 * @return string $effects
 */
function milu_add_wvc_custom_background_effect( $effects ) {
	
	if ( function_exists( 'vc_add_param' ) ) {
		vc_add_param(
			'rev_slider_vc',
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Preloader Background', 'milu' ),
				'param_name' => 'preloader_bg',
			)
		);
	}
}
add_action( 'init', 'milu_add_wvc_custom_background_effect' );

/**
 *  Add work gallery
 *
 * @param string $effects
 * @return string $effects
 */
function milu_add_work_gallery_param( $effects ) {
	
	if ( function_exists( 'vc_add_param' ) ) {
		vc_add_param(
			'wvc_work_index',
			array(
				'type' => 'checkbox',
				'heading' => esc_html__( 'Use as gallery', 'milu' ),
				'param_name' => 'work_is_gallery',
				'desc' => esc_html__( 'The first gallery in the posts will open directly in a lightbox.', 'milu' ),
			)
		);
	}
}
add_action( 'init', 'milu_add_work_gallery_param' );

/**
 * Filter button attribute
 *
 * @param array $atts
 * @return array $atts
 */
function woltheme_filter_button_atts( $atts ) {
	if ( isset( $atts['button_type'] ) && 'default' !== $atts['button_type'] ) {
		$atts['shape'] = '';
		$atts['color'] = '';
		$atts['hover_effect'] = '';
		$atts['el_class'] .= ' ' . $atts['button_type'];
	}

	return $atts;
}
add_filter( 'wvc_button_atts', 'woltheme_filter_button_atts' );

/**
 * Filter audio button attribute
 *
 * @param array $atts
 * @return array $atts
 */
function woltheme_filter_audio_button_atts( $atts ) {
	if ( isset( $atts['btn_button_type'] ) && 'default' !== $atts['btn_button_type'] ) {
		$atts['shape'] = '';
		$atts['color'] = '';
		$atts['hover_effect'] = '';
		$atts['el_class'] .= ' ' . $atts['btn_button_type'];
	}

	return $atts;
}
add_filter( 'wvc_audio_button_atts', 'woltheme_filter_audio_button_atts' );

add_filter( 'wvc_revslider_container_class', function( $class, $atts ) {

	if ( isset( $atts['preloader_bg'] ) && 'true' === $atts['preloader_bg'] ) {
		$class .= ' wvc-preloader-bg';
	}

	return $class;

}, 10, 2 );

/**
 * Filter CTA button attribute
 *
 * @param array $atts the shortcode atts we get
 * @param array $btn_params the button attribute to filter
 * @return array $btn_params
 */
function woltheme_filter_cta_button_atts( $btn_params, $atts ) {
	if ( isset( $atts['btn_button_type'] ) && 'default' !== $atts['btn_button_type'] ) {
		$btn_params['shape'] = '';
		$btn_params['color'] = '';
		$btn_params['hover_effect'] = '';
		$btn_params['el_class'] .= ' ' . $atts['btn_button_type'];
	}

	return $btn_params;
}
add_filter( 'wvc_cta_button_atts', 'woltheme_filter_cta_button_atts', 10, 2 );

/**
 * Filter advanced slider button 1 attribute
 *
 * @param array $atts the shortcode atts we get
 * @param array $b1_params the button attribute to filter
 * @return array $b1_params
 */
function woltheme_filter_b1_button_atts( $b1_params, $atts ) {
	if ( isset( $atts['b1_button_type'] ) && 'default' !== $atts['b1_button_type'] ) {
		$b1_params['shape'] = '';
		$b1_params['color'] = '';
		$b1_params['hover_effect'] = '';
		$b1_params['el_class'] .= ' ' . $atts['b1_button_type'];
	}

	return $b1_params;
}
add_filter( 'wvc_advanced_slider_b1_button_atts', 'woltheme_filter_b1_button_atts', 10, 2 );

/**
 * Filter advanced slider button 1 attribute
 *
 * @param array $atts the shortcode atts we get
 * @param array $b2_params the button attribute to filter
 * @return array $b2_params
 */
function woltheme_filter_b2_button_atts( $b2_params, $atts ) {
	if ( isset( $atts['b2_button_type'] ) && 'default' !== $atts['b2_button_type'] ) {
		$b2_params['shape'] = '';
		$b2_params['color'] = '';
		$b2_params['hover_effect'] = '';
		$b2_params['el_class'] .= ' ' . $atts['b2_button_type'];
	}

	return $b2_params;
}
add_filter( 'wvc_advanced_slider_b2_button_atts', 'woltheme_filter_b2_button_atts', 10, 2 );

/**
 * Add theme button option to Button element
 */
function milu_add_theme_buttons() {

	if ( function_exists( 'vc_add_params' ) ) {
		vc_add_params(
			'vc_button',
			array(
				array(
					'heading' => esc_html__( 'Button Type', 'milu' ),
					'param_name' => 'button_type',
					'type' => 'dropdown',
					'value' => milu_custom_button_types(),
					'weight' => 1000,
				),
			)
		);

		vc_add_params(
			'vc_cta',
			array(
				array(
					'heading' => esc_html__( 'Button Type', 'milu' ),
					'param_name' => 'btn_button_type',
					'type' => 'dropdown',
					'value' => milu_custom_button_types(),
					'weight' => 10,
					'group' => esc_html__( 'Button', 'milu' ),
				),
			)
		);

		vc_add_params(
			'wvc_audio_button',
			array(
				array(
					'heading' => esc_html__( 'Button Type', 'milu' ),
					'param_name' => 'btn_button_type',
					'type' => 'dropdown',
					'value' => milu_custom_button_types(),
					'weight' => 10,
				),
			)
		);

		vc_add_params(
			'wvc_advanced_slide',
			array(
				array(
					'heading' => esc_html__( 'Button Type', 'milu' ),
					'param_name' => 'b1_button_type',
					'type' => 'dropdown',
					'value' => milu_custom_button_types(),
					'weight' => 10,
					'group' => esc_html__( 'Button 1', 'milu' ),
					'dependency' => array(
						'element' => 'add_button_1',
						'value' => array( 'true' ),
					),
				),
			)
		);

		vc_add_params(
			'wvc_advanced_slide',
			array(
				array(
					'heading' => esc_html__( 'Button Type', 'milu' ),
					'param_name' => 'b2_button_type',
					'type' => 'dropdown',
					'value' => milu_custom_button_types(),
					'weight' => 10,
					'group' => esc_html__( 'Button 2', 'milu' ),
					'dependency' => array(
						'element' => 'add_button_2',
						'value' => array( 'true' ),
					),
				),
			)
		);

		vc_add_params(
			'vc_custom_heading',
			array(
				array(
					'heading' => esc_html__( 'Style', 'milu' ),
					'param_name' => 'style',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Default', 'milu' ) => '',
						esc_html__( 'Theme Style', 'milu' ) => 'theme-heading',
					),
					'weight' => 10,
				),
			)
		);

		vc_add_params(
			'wvc_product_index',
			array(
				array(
					'heading' => esc_html__( 'Layout', 'milu' ),
					'param_name' => 'product_layout',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Standard', 'milu' ) => 'standard',
						esc_html__( 'Overlay', 'milu' ) => 'overlay',
						esc_html__( 'Label', 'milu' ) => 'label',
					),
					'weight' => 10,
				),
			)
		);

		vc_add_params(
			'wvc_work_index',
			array(
				array(
					'heading' => esc_html__( 'Filter Alignement', 'milu' ),
					'param_name' => 'work_category_filter_text_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Centered', 'milu' ) => 'center',
						esc_html__( 'Spread', 'milu' ) => 'spread',
					),
					'dependency' => array(
						'element' => 'work_category_filter',
						'value' => array( 'true' ),
					),
				),
			)
		);

		vc_add_params(
			'wvc_video_index',
			array(
				array(
					'heading' => esc_html__( 'Filter Alignement', 'milu' ),
					'param_name' => 'video_category_filter_text_alignment',
					'type' => 'dropdown',
					'value' => array(
						esc_html__( 'Centered', 'milu' ) => 'center',
						esc_html__( 'Spread', 'milu' ) => 'spread',
					),
					'dependency' => array(
						'element' => 'video_category_filter',
						'value' => array( 'true' ),
					),
				),
			)
		);
	}
}
add_action( 'init', 'milu_add_theme_buttons' );

/*--------------------------------------------------------------------

	CUSTOM WVC ELEMENT

----------------------------------------------------------------------*/

if ( defined( 'WVC_OK' ) ) {
	
	$wvc_custom_heading_params = array();

	if ( function_exists( 'wvc_heading_params' ) && function_exists( 'vc_map_integrate_shortcode' ) ) {

		$wvc_custom_heading_params = vc_map_integrate_shortcode( wvc_heading_params(),
		'',
		'',
		array(
			'exclude' => array(
				'add_background',
				'background_img',
				'background_position',
				'background_repeat',
				'background_size',
			),
		) );

		if ( is_array( $wvc_custom_heading_params ) && ! empty( $wvc_custom_heading_params ) ) {
			foreach ( $wvc_custom_heading_params as $key => $param ) {
				if ( is_array( $param ) && ! empty( $param ) ) {

					if ( 'responsive' == $param['param_name'] ) {
						$wvc_custom_heading_params[ $key ]['std'] = 'no';
					}

					if ( 'font_size' == $param['param_name'] ) {
						$wvc_custom_heading_params[ $key ]['std'] = 24;
					}
				}
			}
		}
	}
}