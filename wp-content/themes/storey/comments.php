<?php
/**
 * The template for display Comments
 *
 * The area of the page that contains comments and comment form
 *
 * @package Storey
 * @since 1.0
 */

/* Password Protected? ----------------------------------------------------------*/
if( post_password_required() )
	return;
?>

<?php // Show the comment block only if comments are open, or if there are > 0 comments and comments are closed. ?>

<?php if ( (get_comments_number() !== '0' && comments_open() === false) || comments_open() ): ?>

<!-- BEGIN #comments -->
<div id="comments">
	<div class="comments-inner">
		<h2 class="comments-title"><?php comments_number(__('No Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></h2>
		<div class="share-links">
			<?php
			echo '<a href="https://twitter.com/home?status='. urlencode( get_the_title() ) .'%20'. urlencode( get_the_permalink() ) .'" class="twitter" title="Share on Twitter" target="_blank">'; include( get_template_directory() .'/images/social/twitter.svg' ); echo '</a>';
			echo '<a href="https://www.facebook.com/sharer/sharer.php?u='. urlencode( get_the_permalink() ) .'" class="facebook" title="Share on Facebook" target="_blank">'; include( get_template_directory() .'/images/social/facebook.svg' ); echo '</a>';
			echo '<a href="https://plus.google.com/share?url='. urlencode( get_the_permalink() ) .'" class="google" title="Share on Google+" target="_blank">'; include( get_template_directory() .'/images/social/google-plus.svg' ); echo '</a>';
			echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url='. urlencode( get_the_permalink() ) .'&title='. urlencode( get_the_title() ) .'" class="linkedin" title="Share on LinkedIn" target="_blank">'; include( get_template_directory() .'/images/social/linkedin.svg' ); echo '</a>';
			if ( has_post_thumbnail() ) {
				$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$url = $thumb['0'];
				echo '<a href="https://pinterest.com/pin/create/button/?url='. urlencode( $url ) .'&media='. urlencode( get_the_title() ) .'" class="pinterest" title="Share on Pinterest" target="_blank">'; include( get_template_directory() .'/images/social/pinterest.svg' ); echo '</a>';
			}
			?>
		</div>
	
<?php

/*-----------------------------------------------------------------------------------*/
/*  Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) :
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );

		$fields = array(
			'fields' => array(
				'author' =>
					'<p class="comment-form-author">' .
					'<label for="author">' . __( 'Name', 'domainreference' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
					'<input tabindex="2" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
					'" size="30"' . $aria_req . ' /></p>',

				'email' =>
					'<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
					'<input tabindex="3" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					'" size="30"' . $aria_req . ' /></p>',

				'url' =>
					'<p class="comment-form-url"><label for="url">' .
					__( 'Website', 'domainreference' ) . '</label>' .
					'<input tabindex="4" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
					'" size="30" /></p>'
			),
			'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . __('Leave your comment here...', 'zilla') . '" tabindex="1"></textarea></p>',
			'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'zilla' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'zilla' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
			'comment_notes_before' => '',
			'comment_notes_after' => '<a href="#" id="cancel-comment">' . __('Cancel', 'zilla') . '</a>',
			'title_reply' => '',
			'title_reply_to' => __('Leave a Reply to %s', 'zilla'),
			'cancel_reply_link' => __('Cancel Reply', 'zilla'),
			'label_submit' => __('Post Comment', 'zilla')
		);

		comment_form($fields);

	endif; // end if comments open check

/*-----------------------------------------------------------------------------------*/
/*	Display the Comments & Pings
/*-----------------------------------------------------------------------------------*/

	if ( have_comments() ) :

		/* Display Comments ---------------------------------------------------------*/
		if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>

			<ol class="commentlist">
				<?php wp_list_comments( 'type=comment&callback=zilla_comment' ); ?>
			</ol>

		<?php endif; // end normal comments

		/* Display Pings -------------------------------------------------------------*/
		if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>

			<h3 class="pings-title"><?php _e('Trackbacks for this post', 'zilla') ?></h3>

			<ol class="pinglist">
				<?php wp_list_comments( 'type=pings&callback=zilla_list_pings' ); ?>
			</ol>

		<?php endif; // end pings

		/* Display Comment Navigation -----------------------------------------------*/
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="comment-navigation" role="navigation">
				<div class="nav-previous">
					<?php previous_comments_link( sprintf( '&larr; %s', __('Older Comments', 'zilla') ) ); ?>
				</div>
				<div class="nav-next">
					<?php next_comments_link( sprintf( '%s &rarr; ', __('Newer Comments', 'zilla') ) ); ?>
				</div>
			</div>
		<?php endif; // end comment pagination check


/*-----------------------------------------------------------------------------------*/
/*	Deal with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
	elseif ( ! comments_open() && ! is_page() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="nocomments"><?php _e('Comments are closed.', 'zilla') ?></p>

	<?php endif; ?>
	
	<!-- END .comments-inner -->
	</div>
<!-- END #comments -->
</div>
<?php endif; ?>