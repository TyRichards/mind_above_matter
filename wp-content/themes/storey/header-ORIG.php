<?php
/**
 * The Header template for our theme
 *
 * @package Storey
 * @since 1.0
 */

$theme_options = get_theme_mod('zilla_theme_options');
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<!-- A ThemeZilla design (http://www.themezilla.com) - Proudly powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php zilla_meta_head(); ?>

	<!-- Title -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
	<?php zilla_head(); ?>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>
<?php zilla_body_start(); ?>

	<!-- BEGIN #container -->
	<div id="container" class="hfeed site">

		<?php
		if( is_home() || is_archive() || is_search() ){
			$post = get_post( get_option( 'page_for_posts' ) );
		}

		$header_image = '';
		$featured_id = '';
		
		// If the portfolio page has the same slug as the portfolio archive, show the featured image from the page.
		if (is_post_type_archive('portfolio') && zilla_portfolio_template_ID_query()) {
			$featured_id = zilla_portfolio_template_ID_query();
		} else if (isset($post->ID)) {
			$featured_id = $post->ID;
		}
		
		// Get the featured image url
		if( isset($featured_id) && has_post_thumbnail( $featured_id ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $featured_id ), 'full' );
			$header_image = $image[0];
		}
		?>

		<?php zilla_header_before(); ?>
		<!-- BEGIN #masthead .site-header -->
		<header id="masthead" class="site-header<?php echo $header_image ? ' has-image' : ''; ?>" role="banner">
		<?php zilla_header_start(); ?>
			<?php if ( $header_image ) { ?>
				<div class="site-header-bg-img" style="background-image:url('<?php echo esc_url( $header_image ); ?>');"></div>
			<?php } ?>
			<div class="header-area">
				<div class="inner clearfix">

					<!-- BEGIN #logo .site-logo-->
					<div id="logo" class="site-logo">
						<?php /*
						If "plain text logo" is set in theme options then use text
						if a logo url has been set in theme options then use that
						if none of the above then use the default logo.png */
						if ( isset($theme_options['general_text_logo']) && $theme_options['general_text_logo']) { ?>
							<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php } elseif ( isset($theme_options['general_custom_logo']) && $theme_options['general_custom_logo']) { ?>
							<a href="<?php echo home_url(); ?>">
								<?php 
									if ($header_image && isset($theme_options['general_custom_logo_light']) && $theme_options['general_custom_logo_light']) {
										$logo_src = $theme_options['general_custom_logo_light'];
									} else {
										$logo_src = $theme_options['general_custom_logo'];
									}
								?>
								<img <?php if (isset($theme_options['retina_logo']) && $theme_options['retina_logo']) { echo 'onload="this.width/=2;this.onload=null;"'; } ?> src="<?php echo $logo_src; ?>" alt="<?php bloginfo( 'name' ); ?>"/>
							</a>
						<?php } else { ?>
							<a href="<?php echo home_url(); ?>">
								<?php if ($header_image) { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/storey-logo-light.png" alt="<?php bloginfo( 'name' ); ?>" width="130" height="75" />
								<?php } else { ?>
									<img src="<?php echo get_template_directory_uri(); ?>/images/storey-logo-dark.png" alt="<?php bloginfo( 'name' ); ?>" width="130" height="75" />
								<?php } ?>
							</a>
						<?php } ?>
					<!-- END #logo .site-logo-->
					</div>

					<?php zilla_nav_before(); ?>
					<!-- BEGIN #primary-navigation -->
					<nav id="primary-navigation" class="site-navigation" role="navigation">
					<?php if( has_nav_menu( 'primary-menu' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'primary-menu',
							'menu_id' => 'primary-menu',
							'menu_class' => 'primary-menu zilla-sf-menu',
							'container' => ''
						) );
					} ?>
					<!-- END #primary-navigation -->
					</nav>
					<?php zilla_nav_after(); ?>
					
					<!-- changed template to customize theme for Paradox client -->
					<?php if( is_page_template( 'template-home-home-home.php' ) ){ ?>
						<div class="header-content <?php echo $header_image ? 'with-thumbnail' : 'no-thumbnail'; ?>">
							<?php if( have_posts() ) : while (have_posts()) : the_post(); ?>
								<div data-start="opacity:1;" data-top-bottom="opacity:0;">
									<?php the_content(); ?>
								</div>
							<?php endwhile; endif; wp_reset_query(); ?>
						</div>
					<?php }
					else if( is_single() || is_page() || is_home() || is_post_type_archive('portfolio') ){
						?>
						<div class="header-content <?php echo $header_image ? 'with-thumbnail' : 'no-thumbnail'; ?>">
							<div data-start="opacity:1;" data-100-top="opacity:0;">								
								<h1 class="page-title"><?php echo get_the_title( $featured_id ); ?></h1>
								
								<?php 
								$subtitle = get_post_meta( $featured_id, '_zilla_page_subtitle', true );
								if( $subtitle ){ ?>
								<p class="lead"><?php echo $subtitle; ?></p>
								<?php } ?>
								<?php if( is_singular( 'portfolio' ) ) { ?>
								<div class="entry-categories">
									<ul>
										<?php
										$terms = get_the_terms( $post->ID, 'portfolio-type' );
										if( !empty($terms) ) {
											foreach( $terms as $term ) {
												echo '<li><a href="'. get_term_link( $term ) .'">'. $term->name .'</a></li>';
											}
										}
										?>
									</ul>
								</div>
								<?php } else if( is_singular( 'post') ) { ?>
									<p class="lead"><?php
										echo get_the_category_list(' ');
										if(get_the_tag_list()) {
											?><?php echo get_the_tag_list(' ',' ','');
										}?></p>
								<?php }
									if( is_page_template( 'template-portfolio.php' ) || is_post_type_archive('portfolio') ){
									$terms = get_terms( 'portfolio-type', array('hierarchical' => false) );
									if( count($terms) ){
										echo '<div class="entry-categories"><ul class="portfolio-type-nav">';
										echo '<li><a href="#" data-filter="*" class="active">'. __( 'All', 'zilla' ) .'</a></li>';
										foreach( $terms as $term ) {
											$output = '<li><a href="'. get_term_link($term) .'" data-filter=".term-'. $term->slug .'">'. $term->name .'</a>';
											echo $output .'</li>';
										}
										echo '</ul></div>';
									}
								} ?>
							</div>
						</div>
					<?php }
					else if( is_archive() || is_search() && !is_post_type_archive('portfolio')){
						?>
						<div class="header-content <?php echo $header_image ? 'with-thumbnail' : 'no-thumbnail'; ?>">
							<div data-start="opacity:1;" data-100-top="opacity:0;">
								<h1 class="page-title"><?php
									if ( is_tax( 'portfolio-type' ) ) {
										_e( 'Archives', 'zilla' );
									} else {
										_e( 'Blog', 'zilla' );
									}
								?></h1>
								<p class="lead archive-meta">
								<?php
									$blog_url = get_permalink( $post->ID );
									if ( is_tax( 'portfolio-type' ) ) {
										_e( 'Portfolio Items Tagged', 'zilla' );
										echo ' <a href="'. $blog_url .'" class="close"><span>&#215;</span> '. single_term_title( '', false ) .'</a>';
									} else {
										if( is_category() ) {
											_e( 'Articles in Category', 'zilla' );
											echo ' <a href="'. $blog_url .'" class="close"><span>&#215;</span> '. single_cat_title( '', false ) .'</a>';
										} elseif( is_tag() ) {
											_e( 'Articles Tagged', 'zilla' );
											echo ' <a href="'. $blog_url .'" class="close"><span>&#215;</span> '. single_tag_title( '', false ) .'</a>';
										} elseif( is_search() ) {
											_e( 'Your Search Results for', 'zilla' );
											echo ' <a href="'. $blog_url .'" class="close"><span>&#215;</span> '. get_search_query() .'</a>';
										} elseif( is_author() ) {
											_e( 'Articles by Author', 'zilla' );
											echo ' <a href="'. $blog_url .'" class="close"><span>&#215;</span> '. get_the_author() .'</a>';
										} else {
											_e('Archives', 'zilla');
										}
									}
								?>
								</p>
							</div>
						</div>
					<?php }
					
					else if( is_404() ) {
						?>
						<div class="header-content <?php echo $header_image ? 'with-thumbnail' : 'no-thumbnail'; ?>">
							<div data-start="opacity:1;" data-100-top="opacity:0;">
								<h1 class="page-title"><?php _e('Error 404 ', 'zilla'); ?></h1>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php zilla_header_end(); ?>
		<!--END #masthead .site-header-->
		</header>
		<?php zilla_header_after(); ?>

		<div class="site-content-wrap">
			<!--BEGIN #content .site-content-->
			<div id="content" class="site-content">
			<?php zilla_content_start(); ?>