jQuery(document).ready(function($) {

/*----------------------------------------------------------------------------------*/
/*	Display post format meta boxes as needed
/*----------------------------------------------------------------------------------*/

	// Set up our array of post format objects and group trigger
	var postFormats = [
		{   'id' : 'audio',
			'option' : $('#zilla-metabox-post-audio'),
			'trigger' : $('#post-format-audio')
		},
		{
			'id' : 'video',
			'option' : $('#zilla-metabox-post-video'),
			'trigger' : $('#post-format-video')
		},
		{
			'id' : 'gallery',
			'option' : $('#zilla-metabox-post-gallery'),
			'trigger' : $('#post-format-gallery')
		},
		{
			'id' : 'link',
			'option' : $('#zilla-metabox-post-link'),
			'trigger' : $('#post-format-link')
		},
		{
			'id' : 'quote',
			'option' : $('#zilla-metabox-post-quote'),
			'trigger' : $('#post-format-quote')
		}
		],
		group = $('#post-formats-select input');

	// If format is check, show metabox
	for( var format in postFormats ) {
		if( postFormats[format].trigger.is(':checked') ) {
			postFormats[format].option.css('display', 'block');
		} else {
			postFormats[format].option.css('display', 'none');
		}
	}

	// New format selected, hide and show metaboxes
	group.change( function() {
		$that = $(this);

		for( var format in postFormats ) {
			if( $that.val() === postFormats[format].id) {
				postFormats[format].option.css('display', 'block');
			} else {
				postFormats[format].option.css('display', 'none');
			}
		}
	});

	/*----------------------------------------------------------------------------------*/
	/*  Display page template meta boxes as needed
	/*----------------------------------------------------------------------------------*/

	if($('#page_template').length){
		function zilla_toggle_page_templates(){
			$('[id^="zilla-metabox-page-template-"]').hide();
			$('#zilla-metabox-page-template-'+ $('#page_template').val().replace('.php', '')).show();
		}

		zilla_toggle_page_templates();
		$('#page_template').change(function(){
			zilla_toggle_page_templates();
		});
	}

});
