<?php
/**
 * Contains methods for customizing the theme customization screen.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since Broadcast 1.0
 */

add_action('customize_register', 'zilla_customize_register');
function zilla_customize_register($wp_customize) {

	class Zilla_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea style="width:100%" rows="8" <?php $this->link(); ?>><<?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	/* General Options --- */
	$wp_customize->add_section(
		'zilla_general_options',
		array(
			'title' => __( 'General Options', 'zilla' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'description' => __('Control and configure the general setup of your theme. Upload your preferred logo and custom footer content', 'zilla')
		)
	);

	$wp_customize->add_setting(
		'zilla_theme_options[general_text_logo]',
		array(
			'default' => '0',
			'sanitize_callback' => 'zilla_sanitize_checkbox'
		)
	);

	$wp_customize->add_control( 'zilla_general_text_logo',
		array(
			'label' => __( 'Plain Text Logo', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_text_logo]',
			'type' => 'checkbox'
		)
	);

	$wp_customize->add_setting(
		'zilla_theme_options[general_custom_logo]',
		array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'zilla_general_custom_logo',
		array(
			'label' => __( 'Logo Upload', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_custom_logo]'
		)
	));
	
	$wp_customize->add_setting(
		'zilla_theme_options[general_custom_logo_light]',
		array(
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'zilla_general_custom_logo_light',
		array(
			'label' => __( 'Light Logo Upload (for use on pages with featured image)', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_custom_logo_light]'
		)
	));
	
	$wp_customize->add_setting(
    'zilla_theme_options[footer_logo]',
	    array(
	    	'default' => false,
	    	'sanitize_callback' => 'zilla_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control( 'zilla_footer_logo', array(
		'label' => __( 'Use the light version of the logo in the footer', 'zilla' ),
		'section' => 'zilla_general_options',
		'settings' => 'zilla_theme_options[footer_logo]',
		'type' => 'checkbox'
	));
	
	$wp_customize->add_setting(
    'zilla_theme_options[retina_logo]',
	    array(
	    	'default' => false,
	    	'sanitize_callback' => 'zilla_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control( 'zilla_retina_logo', array(
		'label' => __( 'Retina Logo (image @2x)', 'zilla' ),
		'section' => 'zilla_general_options',
		'settings' => 'zilla_theme_options[retina_logo]',
		'type' => 'checkbox'
	));

	$wp_customize->add_setting(
		'zilla_theme_options[general_custom_favicon]',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'zilla_general_custom_favicon',
		array(
			'label' => __( 'Favicon Upload', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_custom_favicon]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[general_contact_email]',
		array(
			'type' => 'option',
			'sanitize_callback' => 'zilla_sanitize_text'
		)
	);

	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'zilla_general_contact_email',
		array(
			'label' => __( 'Contact Form Email Address', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_contact_email]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[general_footer_content]',
		array(
			'default' => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
	);

	$wp_customize->add_control( new Zilla_Customize_Textarea_Control(
		$wp_customize,
		'zilla_general_footer_content',
		array(
			'label' => __( 'Footer Content', 'zilla' ),
			'section' => 'zilla_general_options',
			'settings' => 'zilla_theme_options[general_footer_content]',
			)
		));

	/* Style Options --- */
	$wp_customize->add_section(
		'zilla_style_options',
		array(
			'title' => __( 'Style Options', 'zilla' ),
			'priority' => 10,
			'capability' => 'edit_theme_options',
			'description' => __('Give your site a custom coat of paint by updating these style options.', 'zilla')
		)
	);

	$wp_customize->add_setting(
		'zilla_theme_options[style_link_color]',
		array(
			'default' => '#2b9fd9',
			'transport' => 'postMessage',
			'sanitize_callback' => 'zilla_sanitize_text'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'zilla_style_link_color',
		array(
			'label' => __( 'Link Color', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_link_color]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[style_link_color_hover]',
		array(
			'default' => '#07608c',
			'transport' => 'postMessage',
			'sanitize_callback' => 'zilla_sanitize_text'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'zilla_style_link_color_hover',
		array(
			'label' => __( 'Link Hover Color', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_link_color_hover]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[style_accent_color]',
		array(
			'default' => '#f2bf24',
			'transport' => 'postMessage',
			'sanitize_callback' => 'zilla_sanitize_text'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'zilla_style_accent_color',
		array(
			'label' => __( 'Accent Color', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_accent_color]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[style_accent_color_hover]',
		array(
			'default' => '#e8a623',
			'transport' => 'postMessage',
			'sanitize_callback' => 'zilla_sanitize_text'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'zilla_style_accent_color_hover',
		array(
			'label' => __( 'Accent Hover Color', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_accent_color_hover]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[style_hero_bg_color]',
		array(
			'default' => '#2b2e33',
			'transport' => 'postMessage',
			'sanitize_callback' => 'zilla_sanitize_text'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'zilla_style_hero_bg_color',
		array(
			'label' => __( 'Header & Footer Background Color', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_hero_bg_color]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[style_footer_bg]',
		array(
	 		'default' => '',
	 		'sanitize_callback' => 'zilla_sanitize_text'
	 	)
	);

	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'zilla_style_footer_bg',
		array(
			'label' => __( 'Footer Background Image', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_footer_bg]'
		)
	));

	$wp_customize->add_setting(
		'zilla_theme_options[style_custom_css]',
		array(
			'default' => '',
			'sanitize_callback' => 'wp_filter_nohtml_kses'
		)
	);

	$wp_customize->add_control( new Zilla_Customize_Textarea_Control(
		$wp_customize,
		'zilla_style_custom_css',
		array(
			'label' => __( 'Custom CSS', 'zilla' ),
			'section' => 'zilla_style_options',
			'settings' => 'zilla_theme_options[style_custom_css]',
		)
	));

	/* Social Options --- */
	$wp_customize->add_section(
			'zilla_social_options',
			array(
					'title' => __( 'Social Options', 'zilla' ),
					'priority' => 10,
					'capability' => 'edit_theme_options',
					'description' => __('Add info about your social accounts and they will appear in the footer.', 'zilla')
			)
	);

	$wp_customize->add_setting( 'zilla_theme_options[facebook_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_facebook_url',
			array(
					'label' => __( 'Facebook URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[facebook_url]',
					'priority' => 2
			)
	));

	$wp_customize->add_setting( 'zilla_theme_options[googleplus_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_googleplus_url',
			array(
					'label' => __( 'Google+ URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[googleplus_url]',
					'priority' => 2
			)
	));	

	$wp_customize->add_setting( 'zilla_theme_options[twitter_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_twitter_url',
			array(
					'label' => __( 'Twitter URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[twitter_url]',
					'priority' => 3
			)
	));

	$wp_customize->add_setting( 'zilla_theme_options[linkedin_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_linkedin_url',
			array(
					'label' => __( 'LinkedIn URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[linkedin_url]',
					'priority' => 4
			)
	));

	$wp_customize->add_setting( 'zilla_theme_options[behance_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_behance_url',
			array(
					'label' => __( 'Behance URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[behance_url]',
					'priority' => 5
			)
	));

	$wp_customize->add_setting( 'zilla_theme_options[dribbble_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_dribbble_url',
			array(
					'label' => __( 'Dribbble URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[dribbble_url]',
					'priority' => 6
			)
	));

	$wp_customize->add_setting( 'zilla_theme_options[pinterest_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_pinterest_url',
			array(
					'label' => __( 'Pinterest URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[pinterest_url]',
					'priority' => 7
			)
	));

	$wp_customize->add_setting( 'zilla_theme_options[tumblr_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_tumblr_url',
			array(
					'label' => __( 'Tumblr URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[tumblr_url]',
					'priority' => 9
			)
	));
	
	$wp_customize->add_setting( 'zilla_theme_options[instagram_url]', array('default' => '', 'sanitize_callback' => 'esc_url_raw') );
	$wp_customize->add_control( new WP_Customize_Control(
			$wp_customize,
			'zilla_instagram_url',
			array(
					'label' => __( 'Instagram URL', 'zilla' ),
					'section' => 'zilla_social_options',
					'settings' => 'zilla_theme_options[instagram_url]',
					'priority' => 10
			)
	));


	if( $wp_customize->is_preview() && ! is_admin() )
		add_action('wp_footer', 'zilla_live_preview', 21);
}

/**
* This outputs the javascript needed to automate the live settings preview.
*
*/
function zilla_live_preview() {
	?>
		<script type="text/javascript">
		( function( $ ) {

			wp.customize( 'zilla_theme_options[general_custom_logo]', function( value ) {
				value.bind( function( newval ) {
					$('#logo img').attr('src', newval);
				});
			});

			wp.customize( 'zilla_theme_options[style_link_color]', function( value ) {
				value.bind( function( newval ) {
					$('#content > a, #content p > a, #content span:not(.written-by) > a, #content cite > a, #content ol > a, #content ul > a, #content form > a, .comment-count a, .entry-link a').css('color', newval );
					$('#content > a, #content p > a, #content span:not(.written-by) > a, #content cite > a, #content ol > a, #content ul > a, #content form > a, .comment-count a, .entry-link a').hover(function() {}, function() {
						$(this).css('color', newval );
					});
					$('.zilla-button.link').css('background-color', newval );
					$('.zilla-button.link').hover(function() {
						
					}, function() {
						$(this).css('background-color', newval );
					});
				});
			});

			wp.customize( 'zilla_theme_options[style_link_color_hover]', function( value ) {
				value.bind( function( newval ) {
					$('#content > a:hover, #content p > a:hover, #content span:not(.written-by) > a:hover, #content cite > a:hover, #content ol > a:hover, #content ul > a:hover, #content form > a:hover, .comment-count a:hover, .entry-link a:hover').css('color', newval );
					$('#content > a, #content p > a, #content span:not(.written-by) > a, #content cite > a, #content ol > a, #content ul > a, #content form > a, .comment-count a, .entry-link a').hover(function(){
						$(this).css('color', newval );
					},function() {

					});
					$('.zilla-button.link:hover').css('background-color', newval );
					$('.zilla-button.link').hover(function(){
						$(this).css('background-color', newval );
					}, function() {

					});
				});
			});

			wp.customize( 'zilla_theme_options[style_accent_color]', function( value ) {
				value.bind( function( newval ) {
					$('button, input[type="submit"], .zilla-button.accent').css('background-color', newval );
					$('button, input[type="submit"]').hover(function(){

					}, function() {
						$(this).css('background-color', newval );
					});
				});
			});

			wp.customize( 'zilla_theme_options[style_accent_color_hover]', function( value ) {
				value.bind( function( newval ) {
					$('button:hover, input[type="submit"]:hover, .zilla-button.accent:hover').css('background-color', newval );
					$('button, input[type="submit"], .zilla-button.accent').hover(function(){
						$(this).css('background-color', newval );
					},function() {

					});
				});
			});

			wp.customize( 'zilla_theme_options[style_hero_bg_color]', function( value ) {
				value.bind( function( newval ) {
					$('.page-template-template-home-php .site-header,.site-header.has-image,.site-footer').css('background-color', newval );
				} );
			} );

		} )( jQuery );
	</script>
	<?php
}

/**
* This will output the custom WordPress settings to the live theme's WP head.
*/
function header_output() {

	$theme_options = get_theme_mod('zilla_theme_options');

	if( empty($theme_options) )
		return;


	/* Output the favicon */
	if( array_key_exists( 'general_custom_favicon', $theme_options ) && $theme_options['general_custom_favicon'] != '' ) {
		echo '<link rel="shortcut icon" href="'. $theme_options['general_custom_favicon'] .'" />' . "\n";
	}
	?>

	<!--Custom CSS-->
	<style type="text/css">
		<?php
		/* Link Colour */
	  if( array_key_exists( 'style_link_color', $theme_options ) && $theme_options['style_link_color'] != '' && $theme_options['style_link_color'] != '#2b9fd9' ) {
	    $textelement = array('#content a');
      foreach($textelement as $e) {
        generate_css($e, 'color', 'style_link_color');
      }
      $btnelement = array('.zilla-button.link, .entry-meta .zilla-button.link');
      foreach($btnelement as $e) {
        generate_css($e, 'background-color', 'style_link_color');
      }
	  }
	  /* Link Hover Colour */
	  if( array_key_exists( 'style_link_color_hover', $theme_options ) && $theme_options['style_link_color_hover'] != '' && $theme_options['style_link_color_hover'] != '#07608c' ) {
	    $textelement = array('#content a:hover');
      foreach($textelement as $e) {
        generate_css($e, 'color', 'style_link_color_hover');
      }
      $btnelement = array('.zilla-button.link:hover, .entry-meta .zilla-button.link:hover');
      foreach($btnelement as $e) {
        generate_css($e, 'background-color', 'style_link_color_hover');
      }
	  }
	  /* Accent Colour */
	  if( array_key_exists( 'style_accent_color', $theme_options ) && $theme_options['style_accent_color'] != '' && $theme_options['style_accent_color'] != '#f2bf24' ) {
	    $element = array('button', 'input[type="submit"]', '.comment-form #submit', '.zilla-button.accent', '.zilla-button.accent:visited');
      foreach($element as $e) {
        generate_css($e, 'background-color', 'style_accent_color');
      }
	  }
	  /* Accent Hover Colour */
	  if( array_key_exists( 'style_accent_color_hover', $theme_options ) && $theme_options['style_accent_color_hover'] != '' && $theme_options['style_accent_color_hover'] != '#e8a623' ) {
	    $element = array('button:hover', 'input[type="submit"]:hover', '.comment-form #submit:hover', '.zilla-button.accent:hover');
      foreach($element as $e) {
        generate_css($e, 'background-color', 'style_accent_color_hover');
      }
	  }
	  /* Header & Footer Background */
	  if( array_key_exists( 'style_hero_bg_color', $theme_options ) && $theme_options['style_hero_bg_color'] != '' && $theme_options['style_hero_bg_color'] != '#2b2e33' ) {
	    $element = array('.page-template-template-home-php .site-header', '.site-header.has-image', '.site-footer');
      foreach($element as $e) {
        generate_css($e, 'background-color', 'style_hero_bg_color');
      }
	  }
		/* Output Custom CSS */
	  if( array_key_exists( 'style_custom_css', $theme_options ) && $theme_options['style_custom_css'] != '' ) {
	    echo $theme_options['style_custom_css'];
	  }
	?>
	</style>
	<!--/Custom CSS-->

	<?php
}

/**
 * This will generate a line of CSS for use in header output. If the setting
 * ($mod_name) has no defined value, the CSS will not be output.
 * @uses get_theme_mod()
 * @param string $selector CSS selector
 * @param string $style The name of the CSS *property* to modify
 * @param string $mod_name The name of the 'theme_mod' option to fetch
 * @param string $prefix Optional. Anything that needs to be output before the CSS property
 * @param string $postfix Optional. Anything that needs to be output after the CSS property
 * @param bool $echo Optional. Whether to print directly to the page (default: true).
 * @return string Returns a single line of CSS with selectors and a property.
 * @since MyTheme 1.0
 */

function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
	$return = '';
	$mods = get_theme_mod('zilla_theme_options');
	$mod = $mods[$mod_name];
	if ( !empty( $mod ) ) {
		 $return = sprintf('%s{ %s:%s; } ',
				$selector,
				$style,
				$prefix.$mod.$postfix
		 );
		 if ( $echo ) {
				echo $return;
		 }
	}
	return $return;
}
// Output custom CSS to live site
add_action( 'wp_head' , 'header_output' );


function zilla_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}
function zilla_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}