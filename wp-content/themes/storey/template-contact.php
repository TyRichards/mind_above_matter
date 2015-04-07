<?php
/**
 * Template Name: Contact
 *
 * Custom page template for displaying a contact form in page
 *
 * @package Storey
 * @since 1.0
 */

$opts = get_option('zilla_theme_options');

/* Edit the error messages here --------------------------------------------------*/
$nameError = __( 'Please enter your name.', 'zilla' );
$emailError = __( 'Please enter your email address.', 'zilla' );
$emailInvalidError = __( 'You entered an invalid email address.', 'zilla' );
$commentError = __( 'Please enter a message.', 'zilla' );
/*--------------------------------------------------------------------------------*/

$errorMessages = array();
if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$errorMessages['nameError'] = $nameError;
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$errorMessages['emailError'] = $emailError;
		$hasError = true;
	} else if ( !is_email( trim($_POST['email']) ) ) {
		$errorMessages['emailInvalidError'] = $emailInvalidError;
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$errorMessages['commentError'] = $commentError;
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = $opts['general_contact_email'];
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = '[Contact Form] From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		/* 	By default form will send from wordpress@yourdomain.com in order to work with
			 a number of web hosts' anti-spam measures. If you want the from field to be the
			 user sending the email, please uncomment the following line of code.
		*/
		// $headers[] = 'From: ' . $name . ' <' . $email . '>';
		$headers[] = 'Reply-To: ' . $email;

		wp_mail( $emailTo, $subject, $body, $headers );

		$emailSent = true;
	}

}

$theme_options = get_theme_mod('zilla_theme_options');
get_header(); ?>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#contactForm").validate({
				messages: {
					contactName: '<?php echo esc_js($nameError); ?>',
					email: {
						required: '<?php echo esc_js($emailError); ?>',
						email: '<?php echo esc_js($emailInvalidError); ?>'
					},
					comments: '<?php echo esc_js($commentError); ?>'
				}
			});
		});
	</script>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php zilla_page_before(); ?>
		<!--BEGIN .page-->
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php zilla_page_start(); ?>

			<!--BEGIN .entry-content -->
			<div class="entry-content">

			<?php if(isset($emailSent) && $emailSent == true) { ?>

				<div class="thanks">
					<p><?php _e('Thanks, your email was sent successfully.', 'zilla') ?></p>
				</div>

			<?php } else { ?>

				<?php the_content(); ?>

				<div class="contact-social">
					<?php
					if( isset($theme_options['facebook_url']) && $theme_options['facebook_url'] ){ echo '<a href="'. filter_var( $theme_options['facebook_url'], FILTER_SANITIZE_URL ) .'" class="facebook" title="Follow on Facebook">'; include( get_template_directory() .'/images/social/facebook.svg' ); echo '</a>'; }
					if( isset($theme_options['twitter_url']) && $theme_options['twitter_url'] ){ echo '<a href="'. filter_var( $theme_options['twitter_url'], FILTER_SANITIZE_URL ) .'" class="twitter" title="Follow on Twitter">'; include( get_template_directory() .'/images/social/twitter.svg' ); echo '</a>'; }
					if( isset($theme_options['linkedin_url']) && $theme_options['linkedin_url'] ){ echo '<a href="'. filter_var( $theme_options['linkedin_url'], FILTER_SANITIZE_URL ) .'" class="linkedin" title="Follow on LinkedIn">'; include( get_template_directory() .'/images/social/linkedin.svg' ); echo '</a>'; }
					if( isset($theme_options['behance_url']) && $theme_options['behance_url'] ){ echo '<a href="'. filter_var( $theme_options['behance_url'], FILTER_SANITIZE_URL ) .'" class="behance" title="Follow on Behance">'; include( get_template_directory() .'/images/social/behance.svg' ); echo '</a>'; }
					if( isset($theme_options['dribbble_url']) && $theme_options['dribbble_url'] ){ echo '<a href="'. filter_var( $theme_options['dribbble_url'], FILTER_SANITIZE_URL ) .'" class="dribbble" title="Follow on Dribbble">'; include( get_template_directory() .'/images/social/dribbble.svg' ); echo '</a>'; }
					if( isset($theme_options['pinterest_url']) && $theme_options['pinterest_url'] ){ echo '<a href="'. filter_var( $theme_options['pinterest_url'], FILTER_SANITIZE_URL ) .'" class="pinterest" title="Follow on Pinterest">'; include( get_template_directory() .'/images/social/pinterest.svg' ); echo '</a>'; }
					if( isset($theme_options['tumblr_url']) && $theme_options['tumblr_url'] ){ echo '<a href="'. filter_var( $theme_options['tumblr_url'], FILTER_SANITIZE_URL ) .'" class="tumblr" title="Follow on Tumblr">'; include( get_template_directory() .'/images/social/tumblr.svg' ); echo '</a>'; }
					?>
				</div>

				<?php if(isset($hasError) || isset($captchaError)) { ?>
					<p class="error"><?php _e('Sorry, an error occured.', 'zilla') ?><p>
				<?php } ?>

				<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
					<ul class="contactform">
						<li>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" placeholder="<?php _e('Your Name', 'zilla') ?>" />
							<?php if(isset($errorMessages['nameError'])) { ?>
								<span class="error"><?php echo $errorMessages['nameError']; ?></span>
							<?php } ?>
						</li>

						<li>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" placeholder="<?php _e('Email Address', 'zilla') ?>" />
							<?php if(isset($errorMessages['emailError'])) { ?>
								<span class="error"><?php echo $errorMessages['emailError']; ?></span>
							<?php } ?>
							<?php if(isset($errorMessages['emailInvalidError'])) { ?>
								<span class="error"><?php echo $errorMessages['emailInvalidError']; ?></span>
							<?php } ?>
						</li>

						<li class="textarea">
							<textarea name="comments" id="commentsText" rows="20" cols="30" class="required requiredField" placeholder="<?php _e('Message', 'zilla') ?>"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if(isset($errorMessages['commentError'])) { ?>
								<span class="error"><?php echo $errorMessages['commentError']; ?></span>
							<?php } ?>
						</li>

						<li class="buttons">
							<input type="hidden" name="submitted" id="submitted" value="true" />
							<button type="submit"><?php _e('Send Email', 'zilla') ?></button>
						</li>
					</ul>
				</form>
			<?php } ?>
			</div><!-- .entry-content -->

			<?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
            <!--BEGIN .entry-meta-->
			<div class="entry-meta">
				<?php edit_post_link( __('edit', 'zilla'), '<span class="edit-post">', '</span>' ); ?>
			<!--END .entry-meta-->
            </div>
            <?php endif; ?>

		<?php zilla_page_end(); ?>
		<!--END .page-->
		</article>
		<?php zilla_page_after(); ?>

		<?php endwhile; endif; ?>

	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>
