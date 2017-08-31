<?php

add_filter('jpeg_quality', function($arg){return 100;});
add_filter( 'wp_editor_set_quality', function($arg){return 100;} );

add_image_size('myphoto', 300,300, true);

if ( ! function_exists( 'huku_setup' ) ) :

function huku_setup() {
	
	//load_theme_textdomain( 'huku', get_template_directory() . '/languages' );
	
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'title-tag' );
	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'huku' ),
		'mobile' => __( 'Mobile Menu', 'huku' ),
	) );
	
	//add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // huku_setup
add_action( 'after_setup_theme', 'huku_setup' );


//==================================================


function huku_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'huku' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'huku_widgets_init' );


//==================================================


function huku_admin_scripts( $hook ) {
	wp_enqueue_style('huku-admin-css', get_template_directory_uri() . '/admin.css');
	wp_enqueue_script( 'huku-admin', get_template_directory_uri() . '/js/admin.js', array('jquery') );	
}
add_action('admin_enqueue_scripts', 'huku_admin_scripts');


function huku_login_scripts() {
	wp_enqueue_style('huku-login-css', get_template_directory_uri() . '/login.css');
}
add_action('login_enqueue_scripts', 'huku_login_scripts', 1); 

 
function huku_scripts() {
	wp_enqueue_style( 'huku-style', get_stylesheet_uri() );		

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( true ) {	
		wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/inc/fancybox/source/jquery.fancybox.css' );		
		wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/fancybox/source/jquery.fancybox.pack.js', array('jquery') );
		wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/inc/fancybox/source/helpers/jquery.fancybox-media.js', array('jquery') );
		
		wp_enqueue_style( 'fancybox-buttons', get_template_directory_uri() . '/inc/fancybox/source/helpers/jquery.fancybox-buttons.css' );
		wp_enqueue_script( 'fancybox-buttons', get_template_directory_uri() . '/inc/fancybox/source/helpers/jquery.fancybox-buttons.js', array('jquery') );
		
		wp_enqueue_style( 'fancybox-thumbs', get_template_directory_uri() . '/inc/fancybox/source/helpers/jquery.fancybox-thumbs.css' );
		wp_enqueue_script( 'fancybox-thumbs', get_template_directory_uri() . '/inc/fancybox/source/helpers/jquery.fancybox-thumbs.js', array('jquery') );	
		
		wp_enqueue_script( 'huku-fancybox', get_template_directory_uri() . '/inc/fancybox/huku-init.js', array('jquery') );	
        wp_enqueue_script( 'slider', get_template_directory_uri() . '/inc/jquery.bxslider/jquery.bxslider/jquery.bxslider.min.js', array('jquery') );			
	}
	
	wp_enqueue_script( 'mmenu', get_template_directory_uri() . '/js/mmenu.js', array('jquery') );
	
	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array('jquery'), '20140319', true );
	
	wp_localize_script( 'main', 'my_data', array(
		'base_url' => home_url(),
		'theme_url' => get_template_directory_uri(),
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));
}
add_action( 'wp_enqueue_scripts', 'huku_scripts' );


//==================================================


//add_action( 'wp_head' , 'add_typekit' );
//add_action( 'admin_head' , 'add_typekit' );

function add_typekit() { ?>
	<script src="https://use.typekit.net/gpp8xvm.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
<?php }


//==================================================

require_once('inc/de_DE.php');

require_once('inc/cmb2/init.php');

require_once('inc/admin.php');

require_once('inc/huku-options.php');

require_once('inc/template-tags.php');

require_once('inc/tinymce/config.php');

require_once('inc/huku-ga-datenschutz.php');

require_once('inc/ajax.php');

require_once('inc/kontakt-formular.php');

require_once('inc/anfahrt.php');

require_once('inc/skills.php');

require_once('inc/education.php');

require_once('inc/experience.php');

require_once('inc/portfolio.php');



//==================================================


function huku_help_text($contextual_help, $screen_id, $screen) {
	
	$screen->remove_help_tabs();
	
	$screen->add_help_tab( array(
		'id'       => 'my-plugin-default',
		'title'    => __( 'Default' ),
		'content'  => 'This is where I would provide tabbed help to the user on how everything in my admin panel works. Formatted HTML works fine in here too'
	));
	
	
}
//add_action('contextual_help', 'huku_help_text', 999, 3);



