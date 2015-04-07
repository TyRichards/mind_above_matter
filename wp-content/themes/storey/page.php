<?php
/**
 * The template for displaying default layout pages
 *
 * @package Storey
 * @since 1.0
 */
get_header(); ?>

	<!--BEGIN #primary .site-main-->
	<div id="primary" class="site-main" role="main">
	<?php while (have_posts()) : the_post(); ?>

		<?php zilla_page_before(); ?>
		<!--BEGIN .page-->
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
		<?php zilla_page_start(); ?>

			<!--BEGIN .entry-content -->
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'zilla').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<!--END .entry-content -->
			</div>

			<?php if ( current_user_can( 'edit_post', $post->ID ) ): ?>
            <!--BEGIN .entry-meta-->
			<div class="entry-meta">
				<?php edit_post_link( __('edit', 'zilla'), '<span class="edit-post">', '</span>' ); ?>
			<!--END .entry-meta-->
            </div>
            <?php endif; ?>

			<?php
			zilla_comments_before();
			comments_template('', true);
			zilla_comments_after();
			?>

		<?php zilla_page_end(); ?>
		<!--END .page-->
		</article>
		<?php zilla_page_after(); ?>

	<?php endwhile; ?>
	<!--END #primary .site-main-->
	</div>

<?php get_footer(); ?>
