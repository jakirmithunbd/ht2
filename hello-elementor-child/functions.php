<?php
/**
 * Recommended way to include parent theme styles.
 * (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
 *
 */  

 add_action( 'wp_enqueue_scripts', 'hello_elementor_child_style' );
  function hello_elementor_child_style() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css',array('parent-style'));
	wp_enqueue_style("slickslider-css", get_theme_file_uri('/assets/css/slick-slider.css'), array(), time());
	wp_enqueue_style("main_custom_style", get_theme_file_uri('/assets/css/custom-style.css'), array(), time());

	wp_enqueue_script('slick-js', get_theme_file_uri('/assets/js/slick.min.js'), array('jquery'), '1.0.0', true);
	wp_enqueue_script('scripts-js', get_theme_file_uri('/assets/js/scripts.js'), array('jquery', 'wp-util'), time(), true);
	$data = array(
		'site_url' => get_template_directory_uri(),
		'preloader' => '/wp-content/themes/hello-elementor-child/assets/images/ajax-loader.gif',
		'admin_ajax'   => admin_url('admin-ajax.php'),
	);
	wp_localize_script('scripts-js', 'ajax', $data);
}

/**
 * Your code goes below.
 */

define('THEME_INC_DIR', dirname(__FILE__) . '/inc/');


// Includes the general functions file for the current theme.
require_once(THEME_INC_DIR . 'cpt.php');
require_once(THEME_INC_DIR . 'breadcrumb.php');
require_once(THEME_INC_DIR . 'quality-shortcodes.php');
require_once(THEME_INC_DIR . 'quality-ajax.php');


function quality_add_svg_to_upload_mimes($upload_mimes)
{
	$upload_mimes['svg'] = 'image/svg+xml';
	$upload_mimes['svgz'] = 'image/svg+xml';
	return $upload_mimes;
}
add_filter('upload_mimes', 'quality_add_svg_to_upload_mimes', 10, 1);
