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

	<?php echo storey_print_audio_html( $post->ID ); ?>

	<?php storey_the_content(); ?>

	<?php storey_post_footer(); ?>

<?php zilla_post_end(); ?>
<!--END .post-->
</article>
<?php zilla_post_after(); ?>
