<?php
/**
 * Template part for displaying the author box heading
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */
if ( is_author() ) {
	$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
	$author_id = $author->ID;
} else {
	$author_id = get_the_author_meta( 'ID' );
}
?>
<section class="author-box-container author-hero">
	<div class="author-box clearfix">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email', $author_id ), apply_filters( 'milu_author_heading_avatar_size', 80 ) ); ?>
		</div><!-- .author-avatar -->
		<h1 class="author-name">
			<span itemprop="name"><?php the_author_meta( 'display_name', $author_id ); ?></span>
		</h1>
		<div class="author-description" itemprop="author" itemscope itemtype="https://schema.org/Person">
			<p>
				<?php the_author_meta( 'description', $author_id ); ?>
			</p>
			<p class="author-socials">
				<?php milu_author_socials( $author_id ); ?>
			</p>
		</div><!-- .author-description -->
	</div><!-- .author-box -->
</section><!-- .author-box-container -->