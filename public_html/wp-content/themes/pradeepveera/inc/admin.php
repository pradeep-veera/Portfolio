<?php


// Aktualisierungsmeldung für Nicht-Admins unterdrücken
if ( !current_user_can('create_users') ) {
	add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );
}



// Admin Menü-Punkte entfernen
function remove_menus(){
	
	if (current_user_can('create_users')) return; // nicht für Admins
  
	//remove_menu_page( 'index.php' );                  //Dashboard
	//remove_menu_page( 'edit.php' );                   //Posts
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' );
	remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
	
	//remove_menu_page( 'upload.php' );                 //Media
	//remove_menu_page( 'edit.php?post_type=page' );    //Pages
	remove_menu_page( 'edit-comments.php' );          //Comments
	remove_menu_page( 'themes.php' );                 //Appearance
	remove_menu_page( 'plugins.php' );                //Plugins
	remove_menu_page( 'users.php' );                  //Users
	remove_menu_page( 'tools.php' );                  //Tools
	remove_menu_page( 'options-general.php' );        //Settings
	
	remove_menu_page( 'wpcf7' );        				//Contact Form 7
	remove_menu_page( 'wpseo_dashboard' );        		//SEO
	
}
add_action( 'admin_menu', 'remove_menus' );




function remove_admin_bar_links() {
	if (current_user_can('create_users')) return; // nicht für Admins
    global $wp_admin_bar;
	//print_r($wp_admin_bar);
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    //$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    //$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    //$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    //$wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    //$wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    //$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    //$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    //$wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    //$wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
	$wp_admin_bar->remove_menu('wpseo-menu');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );



function remove_footer_admin () {
echo '<p>Pradeep Veera</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');




function wpse126301_dashboard_columns() {
    add_screen_option(
        'layout_columns',
        array(
            'max'     => 2,
            'default' => 1
        )
    );
}
//add_action( 'admin_head-index.php', 'wpse126301_dashboard_columns' );