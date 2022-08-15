<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Milu
 * @version 1.0.2
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<section class="comments-container content-section">
	<div id="comments" class="comments-area">
		<?php
		// You can start editing here -- including this comment!
		if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					$comments_number = get_comments_number();
					if ( '1' === $comments_number ) {
						/* translators: %s: post title */
						printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'milu' ), get_the_title() );
					} else {
						printf(
							/* translators: 1: number of comments, 2: post title */
							_nx(
								'%1$s Reply to &ldquo;%2$s&rdquo;',
								'%1$s Replies to &ldquo;%2$s&rdquo;',
								$comments_number,
								'comments title',
								'milu'
							),
							number_format_i18n( $comments_number ),
							get_the_title()
						);
					}
				?>
			</h2>

			<div class="comment-list">
				<?php
					wp_list_comments( array(
						'walker' => new Milu_Walker_Comment(),
						'style'       => 'ul',
						'short_ping'  => true,
					) );
				?>
			</ol>
			<?php
				/**
				 * Comment Pagination
				 */
				the_comments_pagination();

		endif; // Check for have_comments().
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'milu' ); ?></p>
		<?php
		endif;
		comment_form( array(
			'title_reply' => esc_html__( 'Leave a Comment', 'milu' ),
		) );
		?>
	</div><!-- #comments -->
</section><!-- .comments-container-->