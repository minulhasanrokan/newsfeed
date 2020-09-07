<?php

function newsfeed_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->get_section( 'static_front_page' )->priority = 10;

	$newsfeed_home_section = $wp_customize->get_section( 'sidebar-widgets-online-shop-home' );
	if ( ! empty( $newsfeed_home_section ) ) {
		$newsfeed_home_section->panel = '';
		$newsfeed_home_section->title = esc_html__( 'Home Main Content Area ', 'online-shop' );
		$newsfeed_home_section->priority = 80;
	}
	$newsfeed_before_feature = $wp_customize->get_section( 'sidebar-widgets-online-shop-before-feature' );
	if ( ! empty( $newsfeed_before_feature ) ) {
		$newsfeed_before_feature->panel = 'online-shop-feature-panel';
		$newsfeed_before_feature->title = esc_html__( 'Before Feature ', 'online-shop' );
		$newsfeed_before_feature->priority = 80;
	}
	$newsfeed_before_feature = $wp_customize->get_section( 'sidebar-widgets-popup-widget-area' );
	if ( ! empty( $newsfeed_before_feature ) ) {
		$newsfeed_before_feature->panel = 'online-shop-header-top-panel';
		$newsfeed_before_feature->title = esc_html__( 'Popup Widget Area ', 'online-shop' );
		$newsfeed_before_feature->priority = 80;
	}
	/*sidebar-widgets-online-shop-header done in respected file*/
}
add_action( 'customize_register', 'newsfeed_customize_register' );



