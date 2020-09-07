<?php
//register menu
function newsfeed_register_menus() {
  register_nav_menus(
    array('top-bar-menu' => esc_html__( 'Top Bar Menu', 'newsfeed') )
  );
  register_nav_menus(
    array('header-menu' => esc_html__( 'Header Menu', 'newsfeed') )
  );
  register_nav_menus(
    array('footer-menu' => esc_html__( 'Footer Menu', 'newsfeed') )
  );
}
add_action( 'init', 'newsfeed_register_menus' );