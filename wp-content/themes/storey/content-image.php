<?php
/**
 * The template to display post content
 *
 * @package Storey
 * @since 1.0
 */

$theme_options = get_theme_mod('zilla_theme_options');

zilla_post_before(); ?>
<!--BEGIN .post -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php zilla_post_start(); ?>

	<?php storey_post_header(); ?>

	<?php if ( is_single() && has_post_thumbnail() ) { ?>
		<div class="entry-thumbnail">
			<a title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'zilla' ), the_title_attribute( 'echo=0' ) ) ); ?>" href="<?php the_permalink(); ?>" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div>
	<?php } ?>

	<?php storey_the_content(); ?>

	<?php storey_post_footer(); ?>

<?php zilla_post_end(); ?>
<!--END .post-->
</article>
<?php zilla_post_after(); ?>
