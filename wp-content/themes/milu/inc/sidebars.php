<?php
/**
 * Milu sidebars
 *
 * Register default sidebar for the theme with the milu_sidebars_init function
 * This function can be overwritten in a child theme
 *
 * @package WordPress
 * @subpackage Milu
 * @since 1.0.0
 * @version 1.0.2
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register blog and page sidebar and footer widget area.
 */
function milu_sidebars_init() {

	/* Blog Sidebar */
	register_sidebar(
		array(
			'name'          		=> esc_html__( 'Blog Sidebar', 'milu' ),
			'id'            		=> 'sidebar-main',
			'description'		=> esc_html__( 'Add widgets here to appear in your blog sidebar.', 'milu' ),
			'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  		=> '</div></aside>',
			'before_title' 	 	=> '<h3 class="widget-title">',
			'after_title'  	 	=> '</h3>',
		)
	);

	if ( class_exists( 'Wolf_Visual_Composer' ) && defined( 'WPB_VC_VERSION' ) ) {
		/* Page Sidebar */
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Page Sidebar', 'milu' ),
				'id'            		=> 'sidebar-page',
				'description'		=> esc_html__( 'Add widgets here to appear in your page sidebar.', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="clearfix widget %2$s"><div class="widget-content">',
				'after_widget'		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	if ( apply_filters( 'milu_allow_side_panel', true ) ) {
		/* Side Panel Sidebar */
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Side Panel Sidebar', 'milu' ),
				'id'            		=> 'sidebar-side-panel',
				'description'		=> esc_html__( 'Add widgets here to appear in your side panel if enabled.', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title' 	 	=> '<h3 class="widget-title">',
				'after_title'  	 	=> '</h3>',
			)
		);
	}

	/* Footer Sidebar */
	register_sidebar(
		array(
			'name'          		=> esc_html__( 'Footer Widget Area', 'milu' ),
			'id'            		=> 'sidebar-footer',
			'description'		=> esc_html__( 'Add widgets here to appear in your footer.', 'milu' ),
			'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'		=> '</div></aside>',
			'before_title'  		=> '<h3 class="widget-title">',
			'after_title'   		=> '</h3>',
		)
	);

	/* Discography Siderbar */
	if ( class_exists( 'Wolf_Discography' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Discography Sidebar', 'milu' ),
				'id'            		=> 'sidebar-discography',
				'description'   		=> esc_html__( 'Appears on the discography pages if a layout with sidebar is set', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	/* Videos Siderbar */
	if ( class_exists( 'Wolf_Videos' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Videos Sidebar', 'milu' ),
				'id'            		=> 'sidebar-videos',
				'description'   		=> esc_html__( 'Appears on the videos pages if a layout with sidebar is set', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	/* Albums Siderbar */
	if ( class_exists( 'Wolf_Albums' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Albums Sidebar', 'milu' ),
				'id'            		=> 'sidebar-albums',
				'description'   		=> esc_html__( 'Appears on the albums pages if a layout with sidebar is set', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	/* Photos Siderbar */
	if ( class_exists( 'Wolf_Photos' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Photo Sidebar', 'milu' ),
				'id'            		=> 'sidebar-attachment',
				'description'   		=> esc_html__( 'Appears before the image details on single photo pages', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Photo Sidebar Secondary', 'milu' ),
				'id'            		=> 'sidebar-attachment-secondary',
				'description'   		=> esc_html__( 'Appears after the image details on single photo pages', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	/* Events Siderbar */
	if ( class_exists( 'Wolf_Events' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Events Sidebar', 'milu' ),
				'id'            		=> 'sidebar-events',
				'description'   		=> esc_html__( 'Appears on the events pages if a layout with sidebar is set', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	/* Events Siderbar */
	if ( class_exists( 'Mp_Time_Table' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Timetable Event Sidebar', 'milu' ),
				'id'            		=> 'sidebar-mp-event',
				'description'   		=> esc_html__( 'Appears on the single event pages if a layout with sidebar is set', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);

		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Timetable Column Sidebar', 'milu' ),
				'id'            		=> 'sidebar-mp-column',
				'description'   		=> esc_html__( 'Appears on the single column pages if a layout with sidebar is set', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	/* Artists Siderbar */
	if ( class_exists( 'Wolf_Artists' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Artists Sidebar', 'milu' ),
				'id'            		=> 'sidebar-artists',
				'description'   		=> esc_html__( 'Appears on the artists pages if a layout with sidebar is set', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}

	/* Woocommerce Siderbar */
	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar(
			array(
				'name'          		=> esc_html__( 'Shop Sidebar', 'milu' ),
				'id'            		=> 'sidebar-shop',
				'description'   		=> esc_html__( 'Add widgets here to appear in your shop page if a sidebar is visible.', 'milu' ),
				'before_widget' 	=> '<aside id="%1$s" class="widget %2$s"><div class="widget-content">',
				'after_widget'  		=> '</div></aside>',
				'before_title'  		=> '<h3 class="widget-title">',
				'after_title'   		=> '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'milu_sidebars_init' );