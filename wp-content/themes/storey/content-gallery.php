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

	<?php if( !is_single() ){ ?>
	<div class="entry-gallery">
		<?php echo storey_post_gallery( $post->ID, 'full' ); ?>
	</div>
	<?php } ?>

	<?php storey_post_header(); ?>

	<?php if( is_single() ){ ?>
	<div class="entry-gallery">
		<?php echo storey_post_gallery( $post->ID, 'full' ); ?>
	</div>
	<?php } ?>

	<?php storey_the_content(); ?>

	<?php storey_post_footer(); ?>

<?php zilla_post_end(); ?>
<!--END .post-->
</article>
<?php zilla_post_after(); ?>
