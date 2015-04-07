<?php if( is_active_sidebar( 'sidebar-main' ) ){ ?>
	<?php zilla_sidebar_before(); ?>
	<!--BEGIN #sidebar .sidebar-->
	<div id="sidebar" class="site-secondary sidebar" role="complementary">

		<?php
		zilla_sidebar_start();

		/* Widgetised Area */
		dynamic_sidebar( 'sidebar-main' );

		zilla_sidebar_end();
		?>

	<!--END #sidebar .site-secondary .sidebar-->
	</div>
	<?php zilla_sidebar_after(); ?>
<?php } ?>