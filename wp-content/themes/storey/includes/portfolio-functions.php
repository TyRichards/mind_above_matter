<?php

// Prevent Zilla Portfolio CSS from loading
if( !defined('TZP_DISABLE_CSS') ) define('TZP_DISABLE_CSS', TRUE);

// Remove filters on the content that adds portfolio content to the_content output
remove_filter('the_content', 'tzp_add_portfolio_post_meta');
remove_filter('the_content', 'tzp_add_portfolio_post_media');

/**
* Add meta field to general portfolio settings fields
*
* @param  int $post_id the post id
* @return void
*/
function zilla_render_portfolio_settings_fields( $post_id ) { ?>
	<div class="tzp-field">
		<div class="tzp-left">
			<p><?php _e('Featured on Home Page:', 'zilla'); ?></p>
		</div>
		<div class="tzp-right">
			<ul class="tzp-inline-checkboxes">
				<li>
				<input type="checkbox" name="_zilla_agency_featured_portfolio" id="_zilla_agency_featured_portfolio"<?php checked( 1, get_post_meta( $post_id, '_zilla_agency_featured_portfolio', true) ); ?> />
				<label for='_zilla_agency_featured_portfolio'><?php _e('Feature Portfolio', 'zilla'); ?></label>
				</li>
			</ul>
			<p class='tzp-desc howto'><?php _e('Should this portfolio be featured on the home page?', 'zilla'); ?></p>
		</div>
	</div>
	<div class="tzp-field">
		<div class="tzp-left">
			<p><?php _e('Portfolio Project Media:', 'zilla-portfolio'); ?></p>
		</div>
		<div class="tzp-right">
			<?php
			$display_gallery = get_post_meta( $post_id, '_tzp_display_gallery', true );
			$display_audio = get_post_meta( $post_id, '_tzp_display_audio', true );
			$display_video = get_post_meta( $post_id, '_tzp_display_video', true );
			?>
			<ul class="tzp-inline-checkboxes">
				<li>
					<input type="checkbox" name="_tzp_display_gallery" id="_tzp_display_gallery"<?php checked( 1, $display_gallery ); ?> data-related-metabox-id="tzp-portfolio-metabox-gallery" />
					<label for="_tzp_display_gallery"><?php _e('Display Gallery', 'zilla-portfolio'); ?></label>
				</li>
				<li>
					<input type="checkbox" name="_tzp_display_audio" id="_tzp_display_audio"<?php checked( 1, $display_audio ); ?> data-related-metabox-id="tzp-portfolio-metabox-audio" />
					<label for="_tzp_display_audio"><?php _e('Display Audio', 'zilla-portfolio'); ?></label>
				</li>
				<li>
					<input type="checkbox" name="_tzp_display_video" id="_tzp_display_video"<?php checked( 1, $display_video ); ?> data-related-metabox-id="tzp-portfolio-metabox-video" />
					<label for="_tzp_display_video"><?php _e('Display Video', 'zilla-portfolio'); ?></label>
				</li>
			</ul>
			<p class='tzp-desc howto'><?php _e('Select the media formats that should be displayed.', 'zilla-portfolio'); ?></p>
		</div>
	</div>
<?php }
remove_action( 'tzp_portfolio_settings_meta_box_fields', 'tzp_render_portfolio_settings_fields', 10 );
add_action( 'tzp_portfolio_settings_meta_box_fields', 'zilla_render_portfolio_settings_fields', 10 );

/**
* Add the new meta fields to the array of values to be saved
*
* @param  array $array Array of the fields to be sanitized and saved
* @return array        The updated array
*/
function zilla_save_added_portfolio_post_meta( $array ) {
	unset($array['_tzp_portfolio_url']);
    unset($array['_tzp_portfolio_date']);
    unset($array['_tzp_portfolio_client']);
	$array['_zilla_agency_featured_portfolio'] = 'checkbox';
	return $array;
}
add_filter( 'tzp_metabox_fields_save', 'zilla_save_added_portfolio_post_meta' );

if ( !function_exists( 'zilla_add_portfolio_to_rss' ) ) :
/**
* Adds portfolios to RSS feed
*
* @since 1.0
*
* @param obj $request
* @return obj Updated request
*/
function zilla_add_portfolio_to_rss( $request ) {
	if (isset($request['feed']) && !isset($request['post_type']))
		$request['post_type'] = array('post', 'portfolio');

	return $request;
}
endif;
add_filter('request', 'zilla_add_portfolio_to_rss');

if( ! function_exists( 'zilla_set_archive_order' ) ) :
/**
* Set the order for portfolio type taxonomy archives
*
* @param  obj $query the query object
* @return void
*/
function zilla_set_archive_order($query) {
	if ( $query->is_tax( 'portfolio-type' ) && $query->is_main_query() ) {
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );
	}
}
endif;
add_action('pre_get_posts', 'zilla_set_archive_order');

if( ! function_exists( 'zilla_portfolio_template_query' ) ) :
/**
* Get the query used in portfolio templates
*
* @return obj WP_Query
*/
function zilla_portfolio_template_query( $posts_per_page = -1, $exclude = array() ) {
	$args = array(
		'post_type' => 'portfolio',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => $posts_per_page,
		'update_post_meta_cache' => false,
		'post__not_in' => $exclude
	);
	return new WP_Query($args);
}
endif;


if( ! function_exists( 'zilla_portfolio_template_ID_query' ) ) :
/**
* Get the query used in portfolio templates
*
* @return obj WP_Query
*/
function zilla_portfolio_template_ID_query() {
	$the_query = new WP_Query(array(
	    'post_type'  => 'page',  /* overrides default 'post' */
	    'meta_key'   => '_wp_page_template',
	    'meta_value' => 'template-portfolio.php',
	    'posts_per_page' => 1
	));
	
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			return $the_query->post->ID;
		}
	} else {
		return false;
	}	
}
endif;

if( ! function_exists( 'zilla_portfolio_featured_query' ) ) :
/**
* Get the query used in portfolio templates
*
* @return obj WP_Query
*/
function zilla_portfolio_featured_query( $posts_per_page = -1, $exclude = array() ) {
	$args = array(
		'post_type' => 'portfolio',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => $posts_per_page,
		'update_post_meta_cache' => false,
		'post__not_in' => $exclude,
		'meta_key' => '_zilla_agency_featured_portfolio',
		'meta_value' => '1'
	);
	return new WP_Query($args);
}
endif;

if( ! function_exists( 'zilla_portfolio_archive_query' ) ) :
/**
* Show all portfolios on portfolio archive
*
* @param  obj $query the query object
*/
function zilla_portfolio_archive_query( $query ) {
	if( !is_admin() && $query->is_main_query() && is_post_type_archive( 'portfolio' ) ) {
		$query->set( 'posts_per_page', '-1' );
	}
}
endif;
add_action( 'pre_get_posts', 'zilla_portfolio_archive_query' );
