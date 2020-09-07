<?php
// css and js style file include
require_once(get_template_directory().'/lib/enqueue.php'); 
//theme support
require_once(get_template_directory().'/lib/themeSupport.php'); 
//pagination function
require_once(get_template_directory().'/lib/pagination.php'); 
//menu 
require_once(get_template_directory().'/lib/menu.php'); 
//bootstrap walker
require_once(get_template_directory().'/lib/class-wp-bootstrap-navwalker.php'); 
//customizer
require_once(get_template_directory().'/lib/customizer.php'); 
//customizer section
new newsfeed_customizer();
//custom widgets
require_once(get_template_directory().'/lib/customwidget.php'); 
//widgets
require_once(get_template_directory().'/lib/widgets.php'); 


/*
* file for additional functions files
*/
require_once ('custompost/functions.php');


/*
* file for sidebar and widgets
*/
require_once ('custompost/sidebar-widget/newsfeed-col-posts.php');