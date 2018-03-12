<?php
require 'inc/theme-functions.php';
theme_buildin_plugins();

function acf_adjustment() {
	echo '
	<style>
		.acf-columns-2 {
			margin: 0;
		}
	    .acf-column-2 {
			display: none !important;
	    } 
  	</style>
	';
}
add_action('admin_head', 'acf_adjustment');

if (!function_exists( 'starter_theme_setup' ) ) :
	function starter_theme_setup() {
		load_theme_textdomain( 'starter-theme', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'starter-theme' ),
			'menu-2' => esc_html__('Footer','starter-theme')
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'starter_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action('after_setup_theme','starter_theme_setup');

function starter_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'starter_theme_content_width', 960 );
}
add_action('after_setup_theme','starter_theme_content_width',0);

function starter_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'starter-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'starter-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'starter_theme_widgets_init' );

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

