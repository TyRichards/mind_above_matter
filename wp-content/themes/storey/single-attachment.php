<?php
/**
 * The template for showing the single post view
 *
 * @package Storey
 * @since 1.0
 */
get_header(); ?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main clearfix" role="main">

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('content', get_post_format() ); ?>

			<?php
			zilla_comments_before();
			comments_template('', true);
			zilla_comments_after();
			?>

		<?php endwhile; ?>

	<!--END #primary .site-main-->
	</div>

	<!-- END #content .site-content hack -->
	</div>

	<div class="entry-navigation clearfix">
		<div class="previous"><?php previous_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>
		<div class="top"><a href="#"><span class="title"><?php _e( 'Top', 'zilla' ); ?></span><span class="arrow"></span></a></div>
		<div class="next"><?php next_post_link( '%link', '<span class="title">%title</span><span class="arrow"></span>' ); ?></div>
	</div>

	<div>

<?php get_footer(); ?>
