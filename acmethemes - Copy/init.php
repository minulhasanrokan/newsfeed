<?php
if( !function_exists('online_shop_file_directory') ){

    function online_shop_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ) {
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

if( !function_exists('online_shop_is_null_or_empty') ){
	function online_shop_is_null_or_empty( $str ){
		return ( !isset($str) || trim($str)==='' );
	}
}

/*
* file for customizer theme options
*/
require_once online_shop_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require_once online_shop_file_directory('acmethemes/functions.php');



/*
* files for hooks
*/
require_once online_shop_file_directory('acmethemes/hooks/tgm.php');

require_once online_shop_file_directory('acmethemes/hooks/front-page.php');

require_once online_shop_file_directory('acmethemes/hooks/slider-selection.php');







/*
* file for sidebar and widgets
*/
require_once online_shop_file_directory('acmethemes/sidebar-widget/acme-col-posts.php');




