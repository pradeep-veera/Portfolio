<?php 
 
 // Register Custom Post Type
function skill_post_type() {

	$labels = array(
		'name'                  => 'Skill',
		'singular_name'         => 'Skill',
		'menu_name'             => 'Skill',
		'name_admin_bar'        => 'Skill',
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => 'Skill',
		'description'           => __( 'Post Type Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              =>  array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
        'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'skill', $args );

}
add_action( 'init', 'skill_post_type', 0 );
 
add_shortcode('skill', 'get_skill'); 
function get_skill(){

    $args = array(
		'posts_per_page'   => '-1',
    	'orderby'          => 'date',
    	'order'            => 'DESC',
    	'post_type'        => 'skill',
    	'post_status'      => 'publish',
    );
    $items = get_posts( $args );
    $output ='<ul class="skills">';              
    foreach ($items as $item){

        $output .='<li class="skill">';
        $output .='<div class="skill-name">';
        $output .= $item->post_title;
        $output .='</div>';   
        $output .='<div class="skill-level">';
		$output .= '<div class ="percent" style="width:'.$item->post_content.'px">';
        $output .= 		$item->post_content;
		$output .= '</div>';		
        $output .='</div>';	
		$output .='</li>';    
    } 
    $output .= '</ul> <!-- skills -->';
    return $output;		
} 



?>