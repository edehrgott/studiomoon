<?php

function studiomoon_register_sidebars () {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Sidebar Primary',
		'id' => 'sidebar-primary',
		'description' => 'sidebar primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => 'Sidebar Secondary',
		'id' => 'sidebar-secondary',
		'description' => 'sidebar secondary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	add_action( 'widgets_init', 'studiomoon_register_sidebars' );

}

// register all scripts
function studiomoon_scripts() {
	   // theme requires jQuery
	   wp_enqueue_script( 'jquery' );
	   wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js' );
	   wp_register_script('hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js' );  
	   wp_register_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js' );
	   wp_register_script('studiomoon-local', get_template_directory_uri() . '/js/studiomoon-local.js' );
	   // enqueue the scripts
	   wp_enqueue_script( 'superfish' );
	   wp_enqueue_script( 'hoverIntent' );
	   wp_enqueue_script( 'flexslider' );	   
	   wp_enqueue_script( 'studiomoon-local' );
}

add_action( 'wp_enqueue_scripts', 'studiomoon_scripts' );

// custom styles
function studiomoon_register_styles() {
	wp_register_style( 'studiomoon-flexslider', get_template_directory_uri() . '/css/flexslider.css' );
	wp_register_style( 'studiomoon-custom', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'studiomoon-flexslider' );	   
	wp_enqueue_style( 'studiomoon-custom' );	
}

add_action( 'wp_enqueue_scripts', 'studiomoon_register_styles' );

// menus
function studiomoon_register_menus() {
	register_nav_menus(array('primary' => __('Primary Menu', 'studiomoon'),
							'sub-menu' => __('Sub Menu', 'studiomoon')));	
}

add_action( 'init', 'studiomoon_register_menus' );

// custom post type for clients
add_action('init', 'studiomoon_register_clients', 1); // Set priority to avoid plugin conflicts

function studiomoon_register_clients() { // A unique name for our function
 	$labels = array( // Used in the WordPress admin
		'name' => _x('Clients', 'post type general name'),
		'singular_name' => _x('Client', 'post type singular name'),
		'add_new' => _x('Add New', 'Client'),
		'add_new_item' => __('Add New Client'),
		'edit_item' => __('Edit Client'),
		'new_item' => __('New Clinet'),
		'view_item' => __('View Client'),
		'search_items' => __('Search Clients'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash')
	);
	$args = array(
		'labels' => $labels, // Set above
		'public' => true, // Make it publicly accessible
		'hierarchical' => false, // No parents and children here
		'menu_position' => 5, // Appear right below "Posts"
		'has_archive' => 'clients', // Activate the archive
		'supports' => array('title','editor','comments','thumbnail','custom-fields'),
		'taxonomies' => array('post_tag'),
	);
	register_post_type( 'studiomoon-clients', $args ); // Create the post type, use options above
}

// theme support
function studiomoon_theme_support() {
	   add_theme_support( 'automatic-feed-links' );
	   add_theme_support( 'post-thumbnails' );
	   add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery' ) );
}

add_action( 'after_setup_theme', 'studiomoon_theme_support' );

// i18n
function studiomoon_load_textdomain() {
	   load_theme_textdomain( 'studiomoon', get_template_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'studiomoon_load_textdomain' );

// Hide ACF menu item from the admin menu
function hide_admin_menu()
{
	global $current_user;
	get_currentuserinfo();
 
	if($current_user->user_login != 'tekpals')
	{
		echo '<style type="text/css">#toplevel_page_edit-post_type-acf{display:none;}</style>';
	}
}
 
add_action('admin_head', 'hide_admin_menu');

?>