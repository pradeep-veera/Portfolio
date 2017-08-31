<?php

add_action('admin_head', 'huku_mce_modifications');
function huku_mce_modifications() {
	
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_editor_style();
		add_filter( 'tiny_mce_before_init', 'huku_mce_init_config', 9999 );
		//add_filter( 'mce_external_plugins', 'huku_load_tinymce_plugin', 9999 );
	}
}


//===================================================


function huku_mce_init_config( $init ) {
	
	
	
	/* Buttons
		huku_menu = eigene Plugin
		wp_page = Seitenumbruch
		wp_more = More-Tag
	*/
	
	$init['toolbar1'] = 'bold,italic,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,alignjustify,link,unlink,undo,redo,wp_adv,wp_fullscreen';
	$init['toolbar2'] = 'formatselect,styleselect,pastetext,removeformat,charmap,outdent,indent,wp_more';
	$init['toolbar3'] = '';
	$init['toolbar4'] = '';
		
	
	// Styles
	$style_formats = array(
		
		array(  
			'title' => 'Blöcke', 
			'items' => array(
				array(
					'title' => 'Content-Block both',
					'block' => 'div',
					'selector' => 'div',						
					'classes' => 'content-block',
					'wrapper' => true,
					'merge_siblings' => false
				),	

			),
		),
	); 
	//$init['style_formats'] = json_encode( $style_formats );
	
	
	//$init['valid_children '] = "-p[img]";
	$init['end_container_on_empty_block '] = true;
	//$init['forced_root_block'] = 'p';
	//$init['convert_newlines_to_brs '] = true;
	$init['remove_linebreaks '] = false;
	
	
	//print_r($init);
	
	return $init;    
} 


//===================================================


function huku_load_tinymce_plugin( $plugin_array ) {
	$plugin_array['huku_tinymce'] = get_template_directory_uri() .'/inc/tinymce/huku-tinymce.js';
	return $plugin_array;
}


//===================================================

//===================================================

//===================================================

//===================================================

//===================================================

//===================================================

//===================================================





