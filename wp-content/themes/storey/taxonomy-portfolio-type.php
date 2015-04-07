<?php
/**
 * The template for displaying the portfolio type archives
 *
 * @package Storey
 * @since 1.0
 */

get_header();
?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">
		<?php
		/*$terms = get_terms( 'portfolio-type', array('hierarchical' => false) );
		if( count($terms) ){
			echo '<ul class="portfolio-type-nav">';
			//echo '<li><a href="#" data-filter="*">'. __( 'All', 'zilla' ) .'</a></li>';
			foreach( $terms as $term ) {
				$output = '<li><a href="'. get_term_link($term) .'" data-filter=".term-'. $term->slug .'"'. (is_tax( 'portfolio-type', $term ) ? ' class="active"' : '') .'>'. $term->name .'</a>';
				echo $output .'</li>';
			}
			echo '</ul>';
		}*/
		?>

		<div class="portfolio-container layout-2col">
			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part('content', 'portfolio-2col' ); ?>

			<?php endwhile; ?>
		</div>

	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>
