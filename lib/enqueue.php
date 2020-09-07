<?php
function newsfeed_enqueue_style() {
	//css.....
    wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/css/bootstrap.min.css'));
    wp_enqueue_style('font-awesome', get_theme_file_uri('/assets/css/font-awesome.min.css'));
    wp_enqueue_style('animate', get_theme_file_uri('/assets/css/animate.css'));
    wp_enqueue_style('font', get_theme_file_uri('/assets/css/font.css'));
    wp_enqueue_style('li-scroller', get_theme_file_uri('/assets/css/li-scroller.css'));
    wp_enqueue_style('slick', get_theme_file_uri('/assets/css/slick.css'));
    wp_enqueue_style('fancybox', get_theme_file_uri('/assets/css/jquery.fancybox.css'));
    wp_enqueue_style('theme', get_theme_file_uri('/assets/css/theme.css'));
    wp_enqueue_style('style', get_theme_file_uri('/assets/css/style.css'));
    wp_enqueue_style('mainstyle', get_theme_file_uri('/style.css'));
    //jss.......
    wp_enqueue_script('jquery-min', get_theme_file_uri('/assets/js/jquery.min.js'), array(), '1.0', true);
    wp_enqueue_script('wow-min', get_theme_file_uri('/assets/js/wow.min.js'), array(), '1.0', true);
    wp_enqueue_script('bootstrap-min-js', get_theme_file_uri('/assets/js/bootstrap.min.js'), array(), '1.0', true);
    wp_enqueue_script('slickmin', get_theme_file_uri('/assets/js/slick.min.js'), array(), '1.0', true);
    wp_enqueue_script('jquery.li-scroller', get_theme_file_uri('/assets/js/jquery.li-scroller.1.0.js'), array(), '1.0', true);
    wp_enqueue_script('jquery.newsTicker', get_theme_file_uri('/assets/js/jquery.newsTicker.min.js'), array(), '1.0', true);
    wp_enqueue_script('jquery.fancybox.pack', get_theme_file_uri('/assets/js/jquery.fancybox.pack.js'), array(), '1.0', true);
    wp_enqueue_script('custom', get_theme_file_uri('/assets/js/custom.js'), array(), '1.0', true);
    wp_enqueue_script('newsfeed-themecustomizer', get_template_directory_uri().'/assets/js/coustomizer.js',array(), '1.0.0.0',  true );

}
add_action( 'wp_enqueue_scripts', 'newsfeed_enqueue_style');
//extra css and js
function my_doctor_enqueue()
{
  wp_enqueue_style('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('adminscript', get_template_directory_uri() .'/js/script.js', null, null, true);
}
add_action('admin_enqueue_scripts', 'my_doctor_enqueue');

function newsfeed_customizer_live_preview()
{
    wp_enqueue_media();
    wp_enqueue_script( 
          'newsfeed-themecustomizer', get_template_directory_uri().'/assets/js/coustomizer.js',array( 'jquery','customize-preview' ), '',  true );
}
add_action( 'customize_preview_init', 'newsfeed_customizer_live_preview' );
