<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Jobtex
 * @since Jobtex 1.0
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
<div id="comments" class="comments-area <?php echo trim( (!have_comments())?'no-comment':'' ); ?>">
	<?php if ( have_comments() ) : ?>
			<div class="box-comment">
	        <h3 class="comments-title"><?php comments_number( esc_html__('0 Comments', 'jobtex'), esc_html__('1 Comment', 'jobtex'), esc_html__('% Comments', 'jobtex') ); ?></h3>
			<?php jobtex_comment_nav(); ?>
			<ol class="comment-list">
				<?php wp_list_comments('callback=jobtex_list_comment'); ?>
			</ol><!-- .comment-list -->

			<?php jobtex_comment_nav(); ?>
		</div>	
	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'jobtex' ); ?></p>
	<?php endif; ?>

	<?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                        'title_reply'=> esc_html__('Leave a Comment','jobtex'),
                        'comment_field' => '<div class="form-group space-comment">
                        						<label>'.esc_html__('Your Comment', 'jobtex').'</label>
                                                <textarea rows="7" id="comment" placeholder="'.esc_attr__('Comment', 'jobtex').'" class="form-control" required="required" name="comment"'.$aria_req.'></textarea>
                                            </div>',
                        'fields' => apply_filters(
                        	'comment_form_default_fields',
	                    		array(
	                                'author' => '<div class="row"><div class="col-sm-6 col-12"><div class="form-group ">
	                                			<label>'.esc_html__('Your Name', 'jobtex').'</label>
	                                            <input type="text" name="author" placeholder="'.esc_attr__('Name', 'jobtex').'" class="form-control" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
	                                            </div></div>',
	                                'email' => ' <div class="col-sm-6 col-12"><div class="form-group ">
	                                			<label>'.esc_html__('Your Email', 'jobtex').'</label>
	                                            <input id="email"  name="email" placeholder="'.esc_attr__('Email', 'jobtex').'" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
	                                            </div></div>',
	                                'Website' => ' <div class="col-12 col-sm-4 d-none"><div class="form-group ">
	                                            <input id="website" name="website" placeholder="'.esc_attr__('Website', 'jobtex').'" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" ' . $aria_req . ' />
	                                            </div></div></div>',
	                            )
							),
	                        'label_submit' => esc_html__('Submit Comment', 'jobtex'),
							'comment_notes_before' => '',
							'comment_notes_after' => '',
							'title_reply_before' => '<h4 class="title comment-reply-title">',
							'title_reply_after'  => '</h4>',
							'class_submit' => 'btn btn-theme'
                        );
    ?>

	<?php jobtex_comment_form($comment_args); ?>
</div><!-- .comments-area --> 