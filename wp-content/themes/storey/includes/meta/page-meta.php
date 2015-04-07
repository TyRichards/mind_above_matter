<?php

/**
 * Create the Page meta boxes
 */

add_action('add_meta_boxes', 'zilla_metabox_pages');
function zilla_metabox_pages() {

	$meta_box = array(
		'id' => 'zilla-metabox-page-settings',
		'title' =>  __('Page Settings', 'zilla'),
		'description' => __('', 'zilla'),
		'page' => 'page',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' =>  __('Page Subtitle', 'zilla'),
				'desc' => __('Enter a subtitle for this page.', 'zilla'),
				'id' => '_zilla_page_subtitle',
				'type' => 'text',
				'std' => ''
			)
		)
	);
    zilla_add_meta_box( $meta_box );

}
