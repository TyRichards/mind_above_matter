<?php

/*-------------------------------------------------------------------------------------

	Plugin Name: Custom Testimonial
	Plugin URI: http://www.themezilla.com
	Description: A widget for displaying a testimonial
	Version: 1.0.1
	Author: ThemeZilla
	Author URI: http://www.themezilla.com

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*  Create the widget
/*-----------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'zilla_testimonial_widget' );

function zilla_testimonial_widget() {
	register_widget( 'Zilla_Testimonial_Widget' );
}

/*-----------------------------------------------------------------------------------*/
/*  Widget class
/*-----------------------------------------------------------------------------------*/
class Zilla_Testimonial_Widget extends WP_Widget {

	/*-----------------------------------------------------------------------------------*/
	/*	Widget Default Settings
	/*-----------------------------------------------------------------------------------*/

	private $defaults = array(
		'quote' => '',
		'image' => '',
		'name' => '',
		'title' => ''
	);


	/*-----------------------------------------------------------------------------------*/
	/*	Widget Setup
	/*-----------------------------------------------------------------------------------*/

	function __construct() {
		parent::__construct(
			'Zilla_Testimonial_Widget',
			__( 'Custom Testimonial', 'zilla' ),
			array(
				'description' => __( 'A Themezilla widget for displaying a testimonial.', 'zilla'),
				'classname' => 'zilla-testimonial-widget'
			)
		);
	}


	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/

	function widget( $args, $instance ) {
		extract( $args );
		if( empty($instance) ) $instance = wp_parse_args( (array) $instance, $this->defaults );

		$output = '<blockquote class="zilla-testimonial-quote">'. $instance['quote'] .'</blockquote>';
		$output .= '<img src="'. esc_url( $instance['image'] ) .'" alt="" class="zilla-testimonial-image" />';
		$output .= '<p class="zilla-testimonial-name">'. esc_attr( $instance['name'] ) .'</p>';
		$output .= '<p class="zilla-testimonial-title">'. esc_attr( $instance['title'] ) .'</p>';

	    /* Display widget -------------------------------------------------------------*/
		echo $before_widget;

		if( !empty( $output ) )
			echo $output;

		echo $after_widget;
	}


	/*--------------------------------------------------------------------------------*/
	/*	Update Widget
	/*--------------------------------------------------------------------------------*/

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['quote'] = $new_instance['quote'];
		$instance['image'] = filter_var( $new_instance['image'], FILTER_SANITIZE_URL );
		$instance['name'] = filter_var( $new_instance['name'], FILTER_SANITIZE_STRING );
		$instance['title'] = filter_var( $new_instance['title'], FILTER_SANITIZE_STRING );

		return $instance;
	}


	/*------------------------------------------------------------------------------*/
	/*	Widget Settings (Displays the widget settings controls on the widget panel)
	/*------------------------------------------------------------------------------*/

	function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		/* Build our form fields --------------------------------------------------*/
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'quote' ); ?>"><?php _e('Quote:', 'zilla') ?></label>
			<textarea class="widefat" rows="5" id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>"><?php echo $instance['quote']; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image URL:', 'zilla') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo $instance['image']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Name:', 'zilla') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'zilla') ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<?php
	}
}
