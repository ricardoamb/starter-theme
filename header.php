<!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
<?php
	if (!function_exists('_wp_render_title_tag')){
		function theme_slug_render_title(){
?>
            <title><?php wp_title('|',true,'right');?></title>
<?php
		}
		add_action('wp_head','theme_slug_render_title');
	}
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'starter-theme' ); ?></a>

    <?php get_template_part('inc/template-parts/content','header');?>

    <div id="content" class="site-content container-fluid">
        <div class="row">
