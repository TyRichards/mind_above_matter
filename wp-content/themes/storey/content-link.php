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

	<?php
	$link = get_post_meta( $post->ID, '_zilla_link_url', true );
	if( $link ){ ?>
	<div class="entry-link">
		<a href="<?php echo esc_url( $link ); ?>"><?php echo esc_url( $link ); ?></a>
	</div>
	<?php } ?>

	<?php storey_the_content(); ?>

	<?php storey_post_footer(); ?>

<?php zilla_post_end(); ?>
<!--END .post-->
</article>
<?php zilla_post_after(); ?>
