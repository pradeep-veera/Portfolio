<?php

// Register Custom Post Type
function referenz_post_type() {

	$labels = array(
		'name'                => 'Referenzen',
		'singular_name'       => 'Referenz',
		'menu_name'           => 'Referenzen',
		'name_admin_bar'      => 'Referenzen',
		'parent_item_colon'   => 'Übergeordnete Referenz:',
		'all_items'           => 'Alle Referenzen',
		'add_new_item'        => 'Neue Referenz hinzufügen',
		'add_new'             => 'Neu hinzufügen',
		'new_item'            => 'Neue Referenz',
		'edit_item'           => 'Referenz bearbeiten',
		'update_item'         => 'Referenz aktualisieren',
		'view_item'           => 'Referenz anschauen',
		'search_items'        => 'Referenz suchen',
		'not_found'           => 'nicht gefunden',
		'not_found_in_trash'  => 'nicht gefunden im Papierkorb',
	);
	$args = array(
		'label'               => 'Referenz',
		'description'         => 'Referenzen',
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', ),
		'hierarchical'        => true,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-index-card',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => false,
		'has_archive'         => false,		
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'rewrite'             => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'referenz', $args );

}
add_action( 'init', 'referenz_post_type', 0 );


//==================================================


// Register Custom Taxonomy
function referenz_taxonomy() {

	$labels = array(
		'name'                       => 'Referenz-Kategorien',
		'singular_name'              => 'Referenz-Kategorie',
		'menu_name'                  => 'Referenz-Kategorien',
		'all_items'                  => 'Alle Referenz-Kategorien',
		'parent_item'                => 'Parent Item',
		'parent_item_colon'          => 'Parent Item:',
		'new_item_name'              => 'Neue Referenz-Kategorie',
		'add_new_item'               => 'Neue Referenz-Kategorie hinzufügen',
		'edit_item'                  => 'Referenz-Kategorie bearbeiten',
		'update_item'                => 'Referenz-Kategorie aktualisieren',
		'view_item'                  => 'Referenz-Kategorie anschauen',
		'separate_items_with_commas' => 'Separate items with commas',
		'add_or_remove_items'        => 'Add or remove items',
		'choose_from_most_used'      => 'Choose from the most used',
		'popular_items'              => 'Popular Items',
		'search_items'               => 'Search Items',
		'not_found'                  => 'Not Found',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
	);
	register_taxonomy( 'referenzen', array( 'referenz' ), $args );

}
add_action( 'init', 'referenz_taxonomy', 0 );


//==================================================


add_shortcode('referenzen', 'sc_show_referenzen');

function sc_show_referenzen() {
	
	$atts = shortcode_atts( array(
		'cat' => false
	), $atts, 'referenzen' );
	
		
	$cats = get_terms(array(
		'referenzen'	
	), 
	array(
		'orderby'           => 'slug', 
		'order'             => 'ASC',
		'hide_empty'        => true		
	));
	
	$output = '<div class="referenz-liste">';
	
	foreach ( $cats as $cat ) {
		
		$output .= '<h2>'. $cat->name .'</h2>';
		$output .= '<div class="referenzen">';
		
		$referenzen = get_posts(array(
			'posts_per_page'   => -1,		
			'tax_query' => array(
				array(
					'taxonomy' => 'referenzen',
					'field'    => 'term_id',
					'terms'    => $cat->term_id,
				),
			),
			'orderby'          => 'menu_order',
			'order'            => 'ASC',		
			'post_type'        => 'referenz',		
			'post_status'      => 'publish'		
		));
		
		foreach ( $referenzen as $referenz ) {
			$output .= '<div class="referenz">';
			$output .= '	<div class="name">'. $referenz->post_title .'</div>';
			$output .= '	<div class="image">'. (has_post_thumbnail($referenz->ID) ? wp_get_attachment_image( get_post_thumbnail_id($referenz->ID), 'medium' ) : '') .'</div>';
			$output .= '	<div class="content">' . wpautop( $referenz->post_content ) . '</div>';
			$output .= '</div>';
		}
		
		$output .= '</div>';
	}
	
	$output .= '</div>';
	
	return $output;
	
}


//==================================================





//==================================================





//==================================================