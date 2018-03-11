<?php

// Font Enqueues For Theme
function custom_enqueue_fonts(){
	wp_enqueue_style('gfonts','//fonts.googleapis.com/css?family=Raleway:300,400,700,900'); // Raleway Font
	wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'); // Font Awesome
}
add_action('wp_enqueue_scripts','custom_enqueue_fonts');