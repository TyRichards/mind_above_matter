<?php
/**
 * The template for showing our footer
 *
 * @package Storey
 * @since 1.0
 */
$theme_options = get_theme_mod('zilla_theme_options');
?>

			<?php zilla_content_end(); ?>
			<!-- END #content .site-content-->
			</div>
		</div>

		<?php zilla_footer_before(); ?>
		<!-- BEGIN #footer -->
		<footer id="footer" class="site-footer" role="contentinfo">
		<?php zilla_footer_start(); ?>
			<?php if ( isset($theme_options['style_footer_bg']) && $theme_options['style_footer_bg']) { ?>
				<div class="site-footer-bg-img-wrap">
					<div class="site-footer-bg-img" style="background-image:url('<?php echo esc_url( $theme_options['style_footer_bg'] ); ?>');"></div>
				</div>
			<?php } ?>
			<div class="inner clearfix">
				<div class="creds">
					<a href="http://www.jointcommission.org/" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/Joint-Commission-new.png"/>
					</a>
					<a href="http://www.bbb.org/fort-worth/business-reviews/psychiatrists-and-psychiatric-services/mind-above-matter-llc-in-burleson-tx-235976480" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/images/BBB-new.png" />
					</a>
					<a href="https://www.uschamber.com/americas-small-business-summit-2015/dream-big-award" target="_blank" style="display:block; text-align:center; padding-top:10px;">
						<img src="<?php echo get_template_directory_uri(); ?>/images/blue-ribbon.png" width="225" height="134"/>
					</a>					
				</div>

				<!-- BEGIN #logo .site-logo-->
				<div class="site-logo">
					<?php /*
					If "plain text logo" is set in theme options then use text
					if a logo url has been set in theme options then use that
					if none of the above then use the default logo.png */
					if (isset($theme_options['general_text_logo']) && $theme_options['general_text_logo']) { ?>
						<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
					<?php } elseif (isset($theme_options['general_custom_logo']) && $theme_options['general_custom_logo']) { ?>
						<a href="<?php echo home_url(); ?>">
							<?php 
								if (isset($theme_options['footer_logo']) && $theme_options['footer_logo'] && isset($theme_options['general_custom_logo_light']) && $theme_options['general_custom_logo_light']) {
									$logo_src = $theme_options['general_custom_logo_light'];
								} else {
									$logo_src = $theme_options['general_custom_logo'];
								}
							?>
							<img <?php if (isset($theme_options['retina_logo']) && $theme_options['retina_logo']) { echo 'onload="this.width/=2;this.onload=null;"'; } ?> src="<?php echo $logo_src; ?>" alt="<?php bloginfo( 'name' ); ?>"/>
						</a>
					<?php } else { ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" width="150" height="50" /></a>
					<?php } ?>
				<!-- END #logo .site-logo-->
				</div>

				<p class="site-tagline"><?php bloginfo( 'description' ); ?></p>
				
				<div class="footer-content">					
					<!-- A client-centered facility promoting growth and healing through collaborative efforts.<br/> -->

					<?php dynamic_sidebar('footer-menu'); ?>
					<strong>Burleson:</strong> 2915 S Burleson Blvd. Burleson, TX 76028 | Fax: (817) 289-5699<br/>	
					<strong>Keller:</strong> 4232 Heritage Trace Pkwy. Keller, TX 76244 | Fax: (817) 289-5674<br/>	
				</div>
				<?php // if ( isset($theme_options['general_footer_content']) && $theme_options['general_footer_content']) { ?>
				<!-- <div class="footer-content"><?php echo $theme_options['general_footer_content']; ?></div> -->
				<?php // } ?>

				<div class="social">
					<?php
					if( isset($theme_options['facebook_url']) && $theme_options['facebook_url'] ){ echo '<a href="'. filter_var( $theme_options['facebook_url'], FILTER_SANITIZE_URL ) .'" class="facebook" title="Follow on Facebook">'; include( get_template_directory() .'/images/social/facebook.svg' ); echo '</a>'; }
					if( isset($theme_options['twitter_url']) && $theme_options['twitter_url'] ){ echo '<a href="'. filter_var( $theme_options['twitter_url'], FILTER_SANITIZE_URL ) .'" class="twitter" title="Follow on Twitter">'; include( get_template_directory() .'/images/social/twitter.svg' ); echo '</a>'; }
					if( isset($theme_options['linkedin_url']) && $theme_options['linkedin_url'] ){ echo '<a href="'. filter_var( $theme_options['linkedin_url'], FILTER_SANITIZE_URL ) .'" class="linkedin" title="Follow on LinkedIn">'; include( get_template_directory() .'/images/social/linkedin.svg' ); echo '</a>'; }
					if( isset($theme_options['behance_url']) && $theme_options['behance_url'] ){ echo '<a href="'. filter_var( $theme_options['behance_url'], FILTER_SANITIZE_URL ) .'" class="behance" title="Follow on Behance">'; include( get_template_directory() .'/images/social/behance.svg' ); echo '</a>'; }
					if( isset($theme_options['dribbble_url']) && $theme_options['dribbble_url'] ){ echo '<a href="'. filter_var( $theme_options['dribbble_url'], FILTER_SANITIZE_URL ) .'" class="dribbble" title="Follow on Dribbble">'; include( get_template_directory() .'/images/social/dribbble.svg' ); echo '</a>'; }
					if( isset($theme_options['pinterest_url']) && $theme_options['pinterest_url'] ){ echo '<a href="'. filter_var( $theme_options['pinterest_url'], FILTER_SANITIZE_URL ) .'" class="pinterest" title="Follow on Pinterest">'; include( get_template_directory() .'/images/social/pinterest.svg' ); echo '</a>'; }
					if( isset($theme_options['tumblr_url']) && $theme_options['tumblr_url'] ){ echo '<a href="'. filter_var( $theme_options['tumblr_url'], FILTER_SANITIZE_URL ) .'" class="tumblr" title="Follow on Tumblr">'; include( get_template_directory() .'/images/social/tumblr.svg' ); echo '</a>'; }
					if( isset($theme_options['instagram_url']) && $theme_options['instagram_url'] ){ echo '<a href="'. filter_var( $theme_options['instagram_url'], FILTER_SANITIZE_URL ) .'" class="instagram" title="Follow on Instagram">'; include( get_template_directory() .'/images/social/instagram.svg' ); echo '</a>'; }	
					if( isset($theme_options['googleplus_url']) && $theme_options['googleplus_url'] ){ echo '<a href="'. filter_var( $theme_options['googleplus_url'], FILTER_SANITIZE_URL ) .'" class="google-plus" title="Follow on Google+">'; include( get_template_directory() .'/images/social/google-plus.svg' ); echo '</a>'; }										
					?>					
				</div>				

			</div>
		<?php zilla_footer_end(); ?>
		<!-- END #footer -->
		</footer>
		<?php zilla_footer_after(); ?>

	<!-- END #container .hfeed .site -->
	</div>

	<!-- Theme Hook -->
	<?php wp_footer(); ?>
	<?php zilla_body_end(); ?>

	<!-- <?php echo 'Ran '. $wpdb->num_queries .' queries '. timer_stop(0, 2) .' seconds'; ?> -->
<!--END body-->
</body>
<!--END html-->
</html>
