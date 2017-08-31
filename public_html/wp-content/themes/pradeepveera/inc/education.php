<?php 
 
 // Register Custom Post Type
function education_post_type() {

	$labels = array(
		'name'                  => 'Education',
		'singular_name'         => 'Education',
		'menu_name'             => 'Education',
		'name_admin_bar'        => 'Education',
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
		'label'                 => 'Education',
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
	register_post_type( 'education', $args );

}
add_action( 'init', 'education_post_type', 0 );

add_action( 'cmb2_init', 'education_custom_box' );

function education_custom_box() {
	
	$prefix = 'education_';
	
	$cmb_demo = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => 'Details',
		'object_types'  => array( 'education', ), // Post type		
		'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		'cmb_styles' => true, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );		

	$cmb_demo->add_field( array(
		'name'       => 'Year',
		'id'         => $prefix . 'year',
		'type'       => 'text',
	) );	 

}	
 
 
add_shortcode('education', 'get_education'); 
function get_education(){

    $args = array(
    	'orderby'          => 'date',
    	'order'            => 'DESC',
    	'post_type'        => 'education',
    	'post_status'      => 'publish',
    );
    $items = get_posts( $args );
    $output = '<ul class="educations ">';
    foreach($items as $item){
		$year = get_post_meta( $item->ID, 'education_year', true ) ? get_post_meta( $item->ID, 'education_year', true ) : false;
        $output .='<li class="education">';
        $output .=' <div class="education-name">';
		$output .='<span class="glyphicon glyphicon-education"></span>';
        $output .=      $item->post_title;
        $output .=' </div>';
        $output .='<div class="education-level">';
        $output .= 		$item->post_content;
        $output .='</div>';
		if($year):
		$output .='<div class="year">';
		$output .= $year;
		$output .='</div>';	
		endif;
        $output .='</li> <!--education-->' ;   
    }
    $output .= '</ul> <!-- educations -->';
    return $output;
} 

?>