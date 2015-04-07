<?php
/**
 * The template to display post content
 *
 * @package Storey
 * @since 1.0
 */

$theme_options = get_theme_mod('zilla_theme_options');

$terms = get_the_terms( $post->ID, 'portfolio-type' );
$term_list = '';
if( !empty($terms) ) {
	foreach( $terms as $term ) {
		$term_list .= 'term-'. $term->slug .' ';
	}
	$term_list = trim($term_list);
}

zilla_post_before(); ?>
<!--BEGIN .post -->
<article id="post-<?php the_ID(); ?>" <?php post_class( $term_list .' clearfix' ); ?>>
<?php zilla_post_start(); ?>

	<?php
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
	$url = $thumb['0'];
	?>
	<a href="<?php the_permalink(); ?>" class="entry-thumb" style="background-image:url('<?php echo $url; ?>');"></a>

	<div class="entry-content">
		<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="entry-excerpt"><?php the_excerpt(); ?></div>
		<a href="<?php the_permalink(); ?>" class="zilla-button medium accent round"><?php _e( 'View Case Study', 'zilla' ); ?></a>
	</div>

<?php zilla_post_end(); ?>
<!--END .post-->
</article>
<?php zilla_post_after(); ?>
