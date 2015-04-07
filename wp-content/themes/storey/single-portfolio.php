<?php
/**
 * The template for showing the single portfolio view
 *
 * @package Storey
 * @since 1.0
 */

$theme_options = get_theme_mod('zilla_theme_options');

get_header(); ?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">
		<div class="inner">

		<?php while (have_posts()) : the_post(); ?>

			<?php zilla_post_before(); ?>
			<!--BEGIN .post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php zilla_post_start(); ?>

				<!--BEGIN .entry-content -->
				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages: ', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<!--END .entry-content -->
				</div>

				<?php
				$portfolio_custom_fields = array();
				$portfolio_custom_fields['display_gallery'] = get_post_meta( $post->ID, '_tzp_display_gallery', true );
				$portfolio_custom_fields['display_audio'] = get_post_meta( $post->ID, '_tzp_display_audio', true );
				$portfolio_custom_fields['display_video'] = get_post_meta( $post->ID, '_tzp_display_video', true );
				storey_portfolio_media_feature( $post->ID, $portfolio_custom_fields );
				storey_portfolio_media( $post->ID, $portfolio_custom_fields );
				?>

			<?php zilla_post_end(); ?>
			<!--END .post-->
			</article>
			<?php zilla_post_after(); ?>

		<?php endwhile; ?>

		</div>

		<div class="entry-navigation clearfix">
			<div class="previous"><?php previous_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>
			<div class="top"><a href="#"><span class="title"><?php _e( 'Top', 'zilla' ); ?></span><span class="arrow"></span></a></div>
			<div class="next"><?php next_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>
		</div>

	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>
