<?php
/**
 * Template Name: Home
 *
 * The template for the Homepage
 *
 * @package Storey
 * @since 1.0
 */
get_header(); ?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">

		<!-- customer area added by Paradox -->
		<div class="inner clearfix">
			<div class="zilla-one-half">
				<img src="<?php the_field('home_body_image'); ?>" alt="Mind Above Matter" class="alignnone size-full"/>
			</div>
			<div class="zilla-one-half zilla-column-last">
				<?php the_field('home_body_copy'); ?>				
			</div>		
		</div>

		<?php if ( is_active_sidebar( 'upper-home-page' ) ){ ?>
		<div class="upper-home-page widget-count-<?php echo zilla_count_sidebar_widgets( 'upper-home-page' ); ?>">
			<div class="inner clearfix">
				<?php dynamic_sidebar( 'upper-home-page' ); ?>
			</div>
		</div>
		<?php } ?>

		<?php
		$query = zilla_portfolio_featured_query();
		if( $query->have_posts() ) : ?>

			<div class="home-portfolio-slider-wrap clearfix">
				<div class="home-portfolio-slider-thumbs">
					<?php while( $query->have_posts() ) : $query->the_post(); ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<?php
							$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
							$url = $thumb['0'];
							?>
							<a href="<?php the_permalink(); ?>" class="entry-thumb" style="background-image:url('<?php echo $url; ?>');"></a>
						<?php } ?>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_query(); ?>
				<div class="home-portfolio-slider">
					<?php while( $query->have_posts() ) : $query->the_post(); ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
								<?php
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
								$url = $thumb['0'];
								?>
								<img src="<?php echo $url; ?>" class="entry-thumb"/>
								<div class="entry-content">
									<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<div class="entry-excerpt"><?php the_excerpt(); ?></div>
									<div class="entry-categories"><?php echo get_the_term_list( $post->ID, 'portfolio-type', '', ' ' ); ?></div>
									<a href="<?php the_permalink(); ?>" class="zilla-button medium accent round"><?php _e( 'View Case Study', 'zilla' ); ?></a>
								</div>
							</article>
						<?php } ?>
					<?php endwhile; ?>
				</div>
				<div class="home-portfolio-slider-nav"></div>
			</div>

		<?php endif; ?>

		<?php if ( is_active_sidebar( 'lower-home-page' ) ){ ?>
		<div class="lower-home-page widget-count-<?php echo zilla_count_sidebar_widgets( 'lower-home-page' ); ?>">
			<div class="inner clearfix">
				<?php dynamic_sidebar( 'lower-home-page' ); ?>
			</div>
		</div>
		<?php } ?>

	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>
