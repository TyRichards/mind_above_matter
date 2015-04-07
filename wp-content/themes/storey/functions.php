<?php
/**
 * THEMENAME functions
 *
 * Sets up the theme and provides some helper functions.
 *
 * When using a child theme, you can override certain functions by
 * defining the function within the child theme's functions.php file.
 * It is better to override theme functions via a child theme than to
 * edit directly in this functions.php file. When things go wrong in this
 * file, they go really wrong
 *
 * @package Storey
 * @since 1.0
 */


/**
 * Set Max Content Width
 *
 * @since 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 650;

if( !function_exists( 'zilla_content_width' ) ) :
/**
 * Adjust the content_width for the full width page and single image
 * attachment templates.
 *
 * @since 1.0
 *
 * @return void
 */
function zilla_content_width() {
	if ( is_page_template( 'template-full-width.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 940;
	}
}
endif;
add_action( 'template_redirect', 'zilla_content_width' );


if ( !function_exists( 'zilla_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers various features supported
 * by THEMENAME
 *
 * @uses load_theme_textdoman() For translation support
 * @uses register_nav_menu() To add support for navigation menu
 * @uses add_theme_support() To add support for post-thumbnails and post-formats
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size
 * @uses add_image_size() To add additional image sizes
 *
 * @since 1.0
 *
 * @return void
 */
function zilla_theme_setup() {

	/* Load translation domain --------------------------------------------------*/
	load_theme_textdomain( 'zilla', get_template_directory() . '/languages' );

	/* Register WP 3.0+ Menus ---------------------------------------------------*/
	register_nav_menu( 'primary-menu', __('Primary Menu', 'zilla') );

	/* Configure WP 2.9+ Thumbnails ---------------------------------------------*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 730, 9999 ); // Normal post thumbnails
	// add_image_size( 'portfolio-admin-thumb', 35, 35, true ); // Used in the portfolio edit page

	/* Add support for post formats ---------------------------------------------*/
	 add_theme_support( 'post-formats', array( 'aside', 'audio', 'gallery', 'image', 'link', 'quote', 'video' ) );

	 /* Adds RSS feed links to <head> for posts and comments -----------------------*/
	 add_theme_support( 'automatic-feed-links' );
}
endif;
add_action( 'after_setup_theme', 'zilla_theme_setup' );


if ( !function_exists( 'zilla_sidebars_init' ) ) :
/**
 * Register the sidebars for the theme
 *
 * @since 1.0
 *
 * @uses register_sidebar() To add sidebar areas
 * @return void
 */
function zilla_sidebars_init() {
	register_sidebar(array(
		'name' => __('Main Sidebar', 'zilla'),
		'description' => __('Widget area for blog pages.', 'zilla'),
		'id' => 'sidebar-main',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Upper Home Page', 'zilla'),
		'description' => __('Widget area for the home page.', 'zilla'),
		'id' => 'upper-home-page',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Lower Home Page', 'zilla'),
		'description' => __('Widget area for the home page.', 'zilla'),
		'id' => 'lower-home-page',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));
}
endif;
add_action( 'widgets_init', 'zilla_sidebars_init' );


if ( !function_exists( 'zilla_excerpt_length' ) ) :
/**
 * Sets a custom excerpt length for portfolios
 *
 * @since 1.0
 *
 * @param int $length Excerpt length
 * @return int New excerpt length
 */
function zilla_excerpt_length($length) {
	if( get_post_type() == 'portfolio' )
		return 20;
	else
		return 55;
}
endif;
add_filter('excerpt_length', 'zilla_excerpt_length');


if ( !function_exists( 'zilla_excerpt_more' ) ) :
/**
 * Replaces [...] in excerpt string
 *
 * @since 1.0
 *
 * @param string $excerpt Existing excerpt
 * @return string
 */
function zilla_excerpt_more($excerpt) {
	return '&#8230;';
}
endif;
add_filter('excerpt_more', 'zilla_excerpt_more');


if ( !function_exists( 'zilla_wp_title' ) ) :
/**
 * Creates formatted and more specific title element for output based
 * on current view
 *
 * @since 1.0
 *
 * @param string $title Default title text
 * @param string $sep Optional separator
 * @return string Formatted title
 */
function zilla_wp_title( $title, $sep ) {
	if( !zilla_is_third_party_seo() ){
		global $paged, $page;

		if( is_feed() )
			return $title;

		$title .= get_bloginfo( 'name' );

		$site_description = get_bloginfo( 'description', 'display' );
		if( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		if( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __('Page %s', 'zilla'), max( $paged, $page ) );
	}
	return $title;
}
endif;
add_filter('wp_title', 'zilla_wp_title', 10, 2);


if ( !function_exists( 'zilla_enqueue_scripts' ) ) :
/**
 * Enqueues scripts and styles for front end
 *
 * @since 1.0
 *
 * @return void
 */
function zilla_enqueue_scripts() {
	/* Register our scripts -----------------------------------------------------*/
	wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.8.3.min.js', '', '2.8.3', false);
	wp_register_script('validation', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9', true);
	wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.7.4', true);
	wp_register_script('zillaMobileMenu', get_template_directory_uri() . '/js/jquery.zillamobilemenu.min.js', 'jquery', '0.1', true);
	wp_register_script('fitVids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0', true);
	wp_register_script('jPlayer', get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.4', true);
	wp_register_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', 'jquery', '2.0.1', true);
	wp_register_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', 'jquery', '3.1.8', true);
	wp_register_script('skrollr', get_template_directory_uri() . '/js/skrollr.min.js', '', '0.6.27', true);
	wp_register_script('lean-slider', get_template_directory_uri() . '/js/lean-slider.js', '', '1.0.1', true);
	wp_register_script('slidesjs', get_template_directory_uri() . '/js/jquery.slides.min.js', 'jquery', '3.0.4', true);
	wp_register_script('zilla-custom', get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'superfish', 'zillaMobileMenu', 'fitVids', 'jPlayer', 'isotope', 'imagesloaded', 'skrollr', 'lean-slider', 'slidesjs'), '', true);

	/* Enqueue our scripts ------------------------------------------------------*/
	wp_enqueue_script('modernizr');
	wp_enqueue_script('jquery');
	wp_enqueue_script('zillaMobileMenu');
	wp_enqueue_script('superfish');
	wp_enqueue_script('fitVids');
	wp_enqueue_script('jPlayer');
	wp_enqueue_script('zilla-custom');

	/* loads the javascript required for threaded comments ----------------------*/
	if( is_singular() && comments_open() && get_option( 'thread_comments') )
		wp_enqueue_script( 'comment-reply' );

	if( is_page_template('template-contact.php') )
		wp_enqueue_script('validation');

	/* Load our stylesheet ------------------------------------------------------*/
	$zilla_options = get_option('zilla_framework_options');
	wp_enqueue_style( $zilla_options['theme_name'], get_stylesheet_uri() );
	wp_enqueue_style('google-fonts-hind-theme', '//fonts.googleapis.com/css?family=Hind:300,400,500,600,700');
	wp_enqueue_style('google-fonts-merriweather-theme', '//fonts.googleapis.com/css?family=Merriweather:400,400italic');
}
endif;
add_action('wp_enqueue_scripts', 'zilla_enqueue_scripts');


if ( !function_exists( 'zilla_enqueue_admin_scripts' ) ) :
/**
 * Enqueues scripts for back end
 *
 * @since 1.0
 *
 * @return void
 */
function zilla_enqueue_admin_scripts() {
	wp_register_script( 'zilla-admin', get_template_directory_uri() . '/includes/js/jquery.custom.admin.js', 'jquery' );
	wp_enqueue_script( 'zilla-admin' );
}
endif;
add_action( 'admin_enqueue_scripts', 'zilla_enqueue_admin_scripts' );


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


if( !function_exists('zilla_post_meta_header') ) :
/**
 * Print HTML meta information for current post
 *
 * @since 1.0
 *
 * @return void
 */
function zilla_post_meta_header() {
?>
	<!--BEGIN .entry-meta-->
	<div class="entry-meta clearfix">
		<div class="author">
			<?php
			echo get_avatar( get_the_author_meta('email'), '85' );
			printf( '<span class="written-by">%1$s <a href="%2$s" title="%3$s" rel="author">%4$s</a></span>',
				__('Written by', 'zilla'),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __('View all posts by %s', 'zilla' ), get_the_author() ) ),
				get_the_author()
			);
			?>
			<?php edit_post_link( __('edit', 'zilla'), ' <span class="edit-post">(', ')</span>' ); ?><br>
			<span class="comment-count"><?php comments_popup_link(__('No Comments', 'zilla'), __('1 Comment', 'zilla'), __('% Comments', 'zilla')); ?></span>
			<div class="share-links">
				<?php
				echo '<a href="https://twitter.com/home?status='. urlencode( get_the_title() ) .'%20'. urlencode( get_the_permalink() ) .'" class="twitter" title="Share on Twitter" target="_blank">'; include( get_template_directory() .'/images/social/twitter.svg' ); echo '</a>';
				echo '<a href="https://www.facebook.com/sharer/sharer.php?u='. urlencode( get_the_permalink() ) .'" class="facebook" title="Share on Facebook" target="_blank">'; include( get_template_directory() .'/images/social/facebook.svg' ); echo '</a>';
				echo '<a href="https://plus.google.com/share?url='. urlencode( get_the_permalink() ) .'" class="google" title="Share on Google+" target="_blank">'; include( get_template_directory() .'/images/social/google-plus.svg' ); echo '</a>';
				echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url='. urlencode( get_the_permalink() ) .'&title='. urlencode( get_the_title() ) .'" class="linkedin" title="Share on LinkedIn" target="_blank">'; include( get_template_directory() .'/images/social/linkedin.svg' ); echo '</a>';
				if ( has_post_thumbnail() ) {
					$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
					$url = $thumb['0'];
					echo '<a href="https://pinterest.com/pin/create/button/?url='. urlencode( $url ) .'&media='. urlencode( get_the_title() ) .'" class="pinterest" title="Share on Pinterest" target="_blank">'; include( get_template_directory() .'/images/social/pinterest.svg' ); echo '</a>';
				}
				?>
			</div>
		</div>
	<!--END .entry-meta -->
	</div>
<?php
}
endif;

if( !function_exists('zilla_post_meta_footer') ) :
/**
 * Print HTML meta information for current post
 *
 * @since 1.0
 *
 * @return void
 */
function zilla_post_meta_footer() {
?>
	<!--BEGIN .entry-meta-->
	<div class="entry-meta">
		<span class="entry-categories"><?php _e('Posted in', 'zilla') ?> <?php the_category(', ') ?></span>
		<span class="entry-tags"><?php the_tags('|&nbsp;'.__('Tagged:', 'zilla').' ', ', ', ''); ?></span>
	<!--END .entry-meta-->
	</div>
<?php
}
endif;


if( ! function_exists( 'zilla_author_bio' ) ) :
/**
 * Display the author bio
 *
 * @package Storey
 * @since 1.0
 *
 * @return void
 */
function zilla_author_bio() {
?>
	<!--BEGIN .author-bio-->
	<div class="author-bio">
		<?php if( is_archive() ) { ?>
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 74 ); ?>
			</div><!-- .author-avatar -->
		<?php } ?>
		<div class="author-title"><?php _e('About the author', 'zilla') ?></div>
		<div class="author-description"><?php the_author_meta("description"); ?></div>
	<!--END .author-bio-->
	</div>
<?php
}
endif;


if( ! function_exists( 'zilla_paging_nav' ) ) :
/**
 * Display navigation to next/prev if needed
 *
 * @since 1.0
 *
 * @return void
 */
function zilla_paging_nav() {
	global $wp_query;

	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;
	?>

	<!--BEGIN .navigation .page-navigation -->
	<div class="navigation page-navigation block" role="navigation">
	<?php if( get_next_posts_link() ) { ?>
		<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'zilla')) ?></div>
	<?php } ?>

	<?php if( get_previous_posts_link() ) { ?>
		<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'zilla')) ?></div>
	<?php } ?>
	<!--END .navigation .page-navigation -->
	</div>

	<?php
}
endif;


if ( !function_exists( 'zilla_comment' ) ) :
/**
 * Custom comment HTML output
 *
 * @since 1.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 */
function zilla_comment($comment, $args, $depth) {

	$isByAuthor = false;

	if($comment->comment_author_email == get_the_author_meta('email')) {
		$isByAuthor = true;
	}

	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<div id="comment-<?php comment_ID(); ?>">

			<?php echo get_avatar( $comment, 60 ); ?>

			<div class="comment-content">
				<div class="comment-author">
					<?php printf(__('<cite class="fn">%s</cite> ', 'zilla'), get_comment_author_link()) ?> <?php if($isByAuthor) { ?><span class="author-tag"><?php _e('(Author)', 'zilla') ?></span><?php } ?>
					<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('at %1$s %2$s', 'zilla'), get_comment_time(), get_comment_date()) ?></a><?php edit_comment_link(__('(Edit)', 'zilla'),'  ','') ?></span>
				</div>

				<div class="comment-body">
					<?php if ($comment->comment_approved == '0') : ?>
						<em class="moderation"><?php _e('Your comment is awaiting moderation.', 'zilla') ?></em><br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div>

				<div class="comment-footer">
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>

		</div>
<?php
}
endif;


if ( !function_exists( 'zilla_list_pings' ) ) :
/**
 * Separate pings from comments
 *
 * @since 1.0
 *
 * @param $comment
 * @param $args
 * @param $depth
 * @return void
 */
function zilla_list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
	<?php
}
endif;


if ( !function_exists( 'zilla_gallery' ) ) :
/**
 * Print the HTML for galleries
 *
 * @since Storey 1.0
 *
 * @param int $id ID of the post
 * @param string $imagesize Optional size of image
 * @param string $layout Optional layout format
 * @param int/string $imagesize the image size
 * @return void
 */
function zilla_gallery( $postid, $imagesize = '', $layout = 'stacked' ) {

	$image_ids_raw = get_post_meta($postid, '_zilla_image_ids', true);

	if( $image_ids_raw != '' ) {
		// custom gallery created
		$image_ids = explode(',', $image_ids_raw);
		$orderby = 'post__in';
		$post_parent = null;
	} else {
		// pull all images attached to post
		$image_ids = '';
		$orderby = 'menu_order';
		$post_parent = $postid;
	}

	// get the gallery images
	$args = array(
		'include' => $image_ids,
		'numberposts' => -1,
		'orderby' => $orderby,
		'order' => 'ASC',
		'post_type' => 'attachment',
		'post_parent' => $post_parent,
		'post_mime_type' => 'image',
		'post_status' => 'null'
	);
	$attachments = get_posts($args);

	if( !empty($attachments) ) {
		echo "<!--BEGIN #zilla-gallery-$postid -->\n<ul id='zilla-gallery-$postid' class='zilla-gallery $layout'>";

		foreach( $attachments as $attachment ) {
			$src = wp_get_attachment_image_src( $attachment->ID, $imagesize );
			$caption = $attachment->post_excerpt;
			$caption = ($caption) ? "<span class='slide-caption'>$caption</span>" : '';
			$alt = ( !empty($attachment->post_content) ) ? $attachment->post_content : $attachment->post_title;
	            echo "<li><img height='$src[2]' width='$src[1]' src='$src[0]' alt='$alt' />$caption</li>";
		}

		echo '</ul>';

		if( $layout != 'stacked' ) {
			echo '<div class="zilla-slider-nav">';
				echo '<a href="#" id="zilla-slide-prev-'. $postid .'" class="zilla-slide-prev">' . __('Previous', 'zilla') . '</a>';
				echo '<a href="#" id="zilla-slide-next-'. $postid .'" class="zilla-slide-next">' . __('Next', 'zilla') . '</a>';
			echo '</div>';
		}
	}
}
endif;


if ( !function_exists( 'zilla_media_player' ) ) :
/**
 * Print HTML for audio post format media
 *
 * @since Storey 1.0
 *
 * @param int $postid Post ID
 * @param int $width Width of the media area
 * @param int $height Height of the media area
 * @return void
 */
function zilla_media_player($postid, $width = 600, $player_type = 'video') {
	$height = 450;

	if( $player_type == 'video' ) {
		$m4v = get_post_meta($postid, '_zilla_video_m4v', true);
		$ogv = get_post_meta($postid, '_zilla_video_ogv', true);
		$poster = get_post_meta($postid, '_zilla_video_poster_url', true);
		$media_data = array(
			"ancestor" => '#jp-container-' . $postid,
			"m" => $m4v,
			"o" => $ogv,
			"p" => $poster
		);
	} else {
		$mp3 = get_post_meta($postid, '_zilla_audio_mp3', TRUE);
		$ogg = get_post_meta($postid, '_zilla_audio_ogg', TRUE);
		$poster = get_post_meta($postid, '_zilla_audio_poster_url', TRUE);
		$media_data = array(
			"ancestor" => '#jp-container-' . $postid,
			"m" => $mp3,
			"o" => $ogg,
			"p" => $poster
		);

	}

?>

    <div id="jquery-jplayer-<?php echo $player_type . '-' . $postid; ?>" class="jp-jplayer" data-player-type="<?php echo esc_attr($player_type); ?>" data-media-info=<?php echo esc_attr(json_encode($media_data)); ?>></div>

	<div id="jp-container-<?php echo $postid; ?>" class="jp-<?php echo $player_type; ?>">
		<div id="jp-<?php echo $player_type; ?>-interface-<?php echo esc_attr($postid); ?>" class="jp-interface">
			<ul class="jp-controls">
				<li><a href="#" class="jp-play" tabindex="1" title="play">play</a></li>
				<li><a href="#" class="jp-pause" tabindex="1" title="pause">pause</a></li>
			</ul>
			<div class="jp-progress">
				<div class="jp-seek-bar">
					<div class="jp-play-bar"></div>
				</div>
			</div>
		</div>
	</div>
    <?php
}
endif;

if ( !function_exists( 'zilla_count_sidebar_widgets' ) ) :
/**
 * Counts the number of widgets in a sidebar
 *
 * @since Storey 1.0
 *
 * @param mixed $sidebar_id Sidebar ID
 * @param boolean $echo Should the result be echoed (true) or returned (false)
 * @return int
 */
function zilla_count_sidebar_widgets( $sidebar_id, $echo = false ) {
    $the_sidebars = wp_get_sidebars_widgets();
    if( !isset( $the_sidebars[$sidebar_id] ) )
        return 0;

    if( $echo )
        echo count( $the_sidebars[$sidebar_id] );
    else
        return count( $the_sidebars[$sidebar_id] );
}
endif;

if ( !function_exists( 'zilla_body_class' ) ) :
/**
 * Add custom classes to the body class
 *
 * @since Storey 1.0
 *
 * @param array $classes
 * @return array
 */
function zilla_body_class( $classes ) {
	if( !is_active_sidebar( 'sidebar-main' ) ){
		$classes[] = 'no-sidebar';
	}
	return $classes;
}
endif;
add_filter( 'body_class', 'zilla_body_class' );

/*-----------------------------------------------------------------------------------*/
/*	Add Styles to TinyMCE
/*-----------------------------------------------------------------------------------*/

// Callback function to insert 'styleselect' into the $buttons array
function zilla_mce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'zilla_mce_buttons');

if ( !function_exists( 'zilla_mce_formats' ) ) :
function zilla_mce_formats( $init_array ) {  
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Lead Paragraph',  
			'selector' => 'p',  
			'classes' => 'lead'
		)
	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	return $init_array;
}
endif;
add_filter( 'tiny_mce_before_init', 'zilla_mce_formats' );

// Add Google Font to Editor
function my_theme_add_editor_styles() {
    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Hind:300,400,500,600,700' );
    add_editor_style( $font_url );
}
add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );

// Add Editor Stylesheet
function zilla_add_editor_styles() {
    add_editor_style( get_stylesheet_directory_uri() . '/includes/css/editor-style.css' );
}
add_action( 'after_setup_theme', 'zilla_add_editor_styles' );

/*-----------------------------------------------------------------------------------*/
/*	Include the framework
/*-----------------------------------------------------------------------------------*/

$tempdir = get_template_directory();
require_once($tempdir .'/framework/init.php');
require_once($tempdir .'/includes/init.php');

?>
