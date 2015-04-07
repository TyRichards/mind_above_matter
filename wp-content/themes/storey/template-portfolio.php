<?php
/**
 * Template Name: Portfolio
 * Description: A portfolio page template for displaying portfolio posts
 *
 * @package Storey
 * @since 1.0
 */

get_header();

$query = zilla_portfolio_template_query();
?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">
	<?php while (have_posts()) : the_post(); ?>

		<div class="portfolio-container layout-2col">
			<?php if( $query->have_posts() ) : ?>

				<?php while( $query->have_posts() ) : $query->the_post(); ?>

					<?php get_template_part('content', 'portfolio-2col' ); ?>

				<?php endwhile; ?>

			<?php endif; ?>
			<?php wp_reset_query(); ?>
		</div>

	<?php endwhile; ?>
	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>
