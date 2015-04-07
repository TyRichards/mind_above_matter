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
		<div class="portfolio-container layout-2col">
			<?php if (have_posts()) : ?>
		
				<?php while (have_posts()) : the_post(); ?>
		
					<?php get_template_part('content', 'portfolio-2col' ); ?>
		
				<?php endwhile; ?>
		
			<?php endif; ?>
		</div>
	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>