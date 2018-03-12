<?php

// Font Enqueues For Theme
function custom_enqueues(){
	wp_deregister_script('jquery');
	//
	wp_enqueue_style('gfonts','//fonts.googleapis.com/css?family=Raleway:300,400,700,900'); // Raleway Font
	wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); // Font Awesome
	wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/app.min.css',array(),'1.0.0','all');
	//
	wp_enqueue_script( 'app-main-javascript', get_template_directory_uri() . '/assets/js/app.min.js', array(), '1.0.0', true );
}
add_action('wp_enqueue_scripts','custom_enqueues');