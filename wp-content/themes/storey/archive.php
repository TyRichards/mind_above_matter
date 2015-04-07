<?php
/**
 * The template for displaying the Archive pages.
 *
 * @package Storey
 * @since 1.0
 */

get_header(); ?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('content', get_post_format() ); ?>

		<?php endwhile; ?>

		<?php zilla_paging_nav(); ?>

	<?php else : ?>

			<?php get_template_part('content', 'none'); ?>

	<?php endif; ?>

	<!--END #primary .site-main-->
	</div>

	<?php get_sidebar(); ?>

<?php get_footer(); ?>