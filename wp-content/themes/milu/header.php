<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until the main cotent
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	/**
	 * milu_body_start
	 *
	 * Used to add a top anchor or other usefull stuff
	 *
	 * @see in/frontend/hooks.php milu_output_top_anchor functions
	 */
	do_action( 'milu_body_start' );

	/**
	 * wolf_body_start
	 *
	 * Hook dedicated to plugins
	 * Allow plugins to add content right after the body tag
	 */
	do_action( 'wolf_body_start' );
?>
<div class="site-container">
	<div id="page" class="hfeed site">
		<div id="page-content">

		<header id="masthead" class="site-header clearfix" itemscope itemtype="http://schema.org/WPHeader">

			<!-- <p class="site-name" itemprop="headline"><?//php bloginfo( 'name' ); ?></p>.site-name -->
			<!-- <p class="site-description" itemprop="description"><?//php bloginfo( 'description' ); ?></p>.site-description -->

			<div id="header-content">
				<?php
					/**
					 * Main Navigation hook
					 *
					 * @see inc/frontend/hooks/navigation.php
					 */
					do_action( 'milu_main_navigation' );
				?>
			</div><!-- #header-content -->

		</header><!-- #masthead -->

		<div id="main" class="site-main clearfix">
			<?php
				/**
				 * milu_main_content_start
				 *
				 * Used to add stuff that will be included in the main content area
				 *
				 * @see in/frontend/hooks.php
				 */
				do_action( 'milu_main_content_start' );
			?>
			<div class="site-content">
				<?php
					/**
					 * Hero
					 *
					 * milu_hero hook
					 *
					 * @see inc/frontend/hooks.php milu_output_hero function
					 */
					// do_action( 'milu_hero' );
				?>
				<?php
					/**
					 * milu_after_header_block hook
					 */
					do_action( 'milu_after_header_block' );
				?>
				<div class="content-inner section wvc-row">
					<div class="content-wrapper">