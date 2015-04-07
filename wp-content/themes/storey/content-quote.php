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
	$quote = get_post_meta( $post->ID, '_zilla_quote_quote', true );
	if( $quote ){ ?>
	<div class="entry-quote">
		<blockquote>
			<p>&#8220;<?php echo esc_html( $quote ); ?>&#8221;</p>
			<footer>
				<cite><?php if( !is_single() ) { ?><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>"><?php } ?>&mdash;<?php the_title(); ?><?php if( !is_single() ) { ?></a><?php } ?></cite>
			</footer>
		</blockquote>
	</div>
	<?php } ?>

	<?php storey_the_content(); ?>

	<?php storey_post_footer(); ?>

<?php zilla_post_end(); ?>
<!--END .post-->
</article>
<?php zilla_post_after(); ?>
