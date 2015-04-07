<?php
/**
 * The main template file
 *
 * @package Storey
 * @since 1.0
 */
get_header(); ?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main clearfix" role="main">
	<?php if( have_posts() ) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('content', get_post_format() ); ?>

		<?php endwhile; ?>

	<?php else : ?>

		<?php get_template_part('content', 'none'); ?>

	<?php endif; ?>

	<!--END #primary .site-main-->
	</div>

	<?php get_sidebar(); ?>

	<!-- END #content .site-content hack -->
	</div>

	<div class="entry-navigation clearfix">
		<div class="previous"><?php next_posts_link( '<span class="title">Older Entries</span><span class="arrow"></span>' ); ?></div>
		<div class="top"><a href="#"><span class="title"><?php _e( 'Top', 'zilla' ); ?></span><span class="arrow"></span></a></div>
		<div class="next"><?php previous_posts_link( '<span class="title">Newer Entries</span><span class="arrow"></span>' ); ?></div>
	</div>

	<div>

<?php get_footer(); ?>
