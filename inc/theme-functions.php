<?php

function request_data($origin = 'both'){
	if($origin == 'both'){
		if(file_exists(get_template_directory() . '/theme.json')){
			$request['local'] = json_decode(file_get_contents(get_template_directory() . '/theme.json'),true);
			$request['remote'] = json_decode(file_get_contents(base64_decode($request['local']['theme']['hash'])),true);
			return $request;
		}else{
			return false;
		}
	}else{
		if($origin == 'remote'){
			if(file_exists(get_template_directory() . '/theme.json')) {
				$request['local'] = json_decode(file_get_contents(get_template_directory() . '/theme.json'), true);
				$request['remote'] = json_decode(file_get_contents(base64_decode($request['local']['theme']['hash'])), true);
				if ($request['remote'] != null || $request['remote'] != ''){
					return $request['remote'];
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else if($origin == 'local'){
			if(file_exists(get_template_directory() . '/theme.json')){
				$request['local'] = json_decode(file_get_contents(get_template_directory() . '/theme.json'),true);
				return $request['local'];
			}else{
				return false;
			}
		}
	}
}

// Create Default Pages and Style.css
if (isset($_GET['activated']) && is_admin()){
	// Create Pages Declared on theme.json
	$pages = request_data('local')['pages'];
	foreach ($pages as $page){
		$new_page_title = $page['pageName'];
		$new_page_content = $page['pageContent'];
		$new_page_template = $page['pageTemplate'];
		$new_page_status = $page['pageStatus'];
		$new_page_author = $page['pageAuthorID'];

		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
			'post_type' => 'page',
			'post_title' => $new_page_title,
			'post_content' => $new_page_content,
			'post_status' => $new_page_status,
			'post_author' => $new_page_author,
		);
		//don't change the code bellow, unless you know what you're doing
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			if(!empty($new_page_template)){
				update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
			}
		}
	}
}

// Edit the style.css file
$file = get_template_directory() . '/style.css';
$line = trim(file($file)[1]);
if($line === "Theme Name: Sentapúa initial sketch"){
	$data = request_data('local');
	$style_file = fopen(get_template_directory() . "/style.css", "w") or die ("Não foi possivel abrir o arquivo theme.json ou style.css");
	$start = "/*\n";
	fwrite($style_file, $start);
	fwrite($style_file, 'Theme Name: ' . $data['themeName'] . PHP_EOL);
	fwrite($style_file, 'Theme URI: ' . $data['themeURI'] . PHP_EOL);
	fwrite($style_file, 'Author: ' . $data['author'] . PHP_EOL);
	fwrite($style_file, 'Author URI: ' . $data['authorURI'] . PHP_EOL);
	fwrite($style_file, 'Version: ' . $data['version'] . PHP_EOL);
	fwrite($style_file, 'Description: ' . $data['description'] . PHP_EOL);
	fwrite($style_file, 'License: ' . $data['license'] . PHP_EOL);
	fwrite($style_file, 'License URI: ' . $data['licenseURI'] . PHP_EOL);
	fwrite($style_file, 'Text Domain: ' . $data['textDomain'] . PHP_EOL);
	fwrite($style_file, 'Tags: ' . $data['tags'] . PHP_EOL);
	$end = "*/";
	fwrite($style_file, $end);
	fclose($style_file);
}

// Enqueues For Theme
function custom_enqueues(){
	$data = request_data('local')['enqueues'];
	// Styles
    foreach ($data['styles'] as $style){
    	if($style['fileAction'] == 'add'){
    		$file = get_template_directory_uri() . $style['fileFolder'] . $style['fileName'];
    		wp_enqueue_style($style['fileSlug'],$file,array(),$style['fileVersion'],$style['fileMedia']);
	    }else{
    		if($style['fileAction'] == 'remote'){
			    $file = $style['fileName'];
			    wp_enqueue_style($style['fileSlug'],$file);
		    }else if($style['fileAction'] == 'none' || $style['fileAction'] == 'remove' || $style['fileAction'] == 'deregister'){
				wp_deregister_style($style['fileName']);
		    }
	    }
    }
	if (is_singular() && comments_open() && get_option('thread_comments') ) {
		wp_enqueue_script('comment-reply');
	}
	// Javascript
	foreach ($data['javascript'] as $script){
    	if($script['fileAction'] == 'add'){
    		$file = get_template_directory_uri() . $script['fileFolder'] . $script['fileName'];
		    wp_enqueue_script( $script['fileSlug'], $file, array(), $script['fileVersion'],$script['fileFooter']);
	    }else{
    		if($script['fileAction'] == 'remote'){
    			$file = $script['fileName'];
			    wp_enqueue_script( $script['fileSlug'], $file);
		    }else if($script['fileAction'] == 'deregister' || $script['fileAction'] == 'none' || $script['fileAction'] == 'remove' || $script['fileAction'] == ''){
				wp_deregister_script($script['fileName']);
		    }
	    }
	}
}
add_action('wp_enqueue_scripts','custom_enqueues');

// Built-In Plugins for Theme
function theme_buildin_plugins(){
	$data = request_data('local')['buildInPlugins'];
	foreach ($data as $plugin){
		$pluginPath = get_template_directory() . '/inc/plugins/' . $plugin['pluginFolder'] . '/' . $plugin['pluginFile'];
        require_once $pluginPath;
	}
}