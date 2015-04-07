<?php
/**
 * Template Name: Archives
 *
 * Custom template for display summary of archives
 *
 * @package Storey
 * @since 1.0
 */
get_header(); ?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php zilla_page_before(); ?>
		<!--BEGIN .page -->
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php zilla_page_start(); ?>

			<!--BEGIN .entry-content -->
			<div class="entry-content">
				<?php the_content(__('Read more...', 'zilla')); ?>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<!--END .entry-content -->
			</div>

			<!--BEGIN .archive-lists -->
			<div class="archive-lists">

				<h4><?php _e('Last 30 Posts', 'zilla') ?></h4>

				<ul>
				<?php $archive_30 = get_posts('numberposts=30');
				foreach($archive_30 as $post) : ?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
				<?php endforeach; ?>
				</ul>

				<h4><?php _e('Archives by Month', 'zilla') ?></h4>

				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>

				<h4><?php _e('Archives by Subject', 'zilla') ?></h4>

				<ul>
			 		<?php wp_list_categories( 'title_li=' ); ?>
				</ul>

			<!--END .archive-lists -->
			</div>

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

		<?php endwhile; else: ?>

			<?php get_template_part('content', 'none'); ?>

	<?php endif; ?>
	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>
