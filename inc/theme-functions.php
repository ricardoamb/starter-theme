<?php

// Font Enqueues For Theme
function custom_enqueues(){
	wp_enqueue_style('gfonts','//fonts.googleapis.com/css?family=Raleway:300,400,700,900'); // Raleway Font
	wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); // Font Awesome
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery','//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js',array(),'3.3.1',true);
}
add_action('wp_enqueue_scripts','custom_enqueues');