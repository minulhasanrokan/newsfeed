<?php
function newsfeed_regester_widgets(){
	//banner image widgets 
	register_sidebar( array(
		'name'          => esc_html__( 'Header Banner Image', 'newsfedd'),
		'id'            => 'banner-1',
		'description'   => esc_html__( 'Header Banner Image Widgets in this area will be shown on page header.', 'newsfedd' ),
		'before_widget' => '<div class="add_banner">',
		'after_widget'  => '</div>',
	) );
	//Footer fliker image Widgets.....
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Fliker Image Widgets', 'newsfedd'),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Footer Fliker Image Widgets in this area will be shown on page footer.', 'newsfedd' ),
		'before_title'  => '<h2>',
        'after_title'   => '</h2>',
		'before_widget' => '<div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInLeftBig">',
		'after_widget'  => '</div></div>',
	) );
	//Footer Tag Widgets.....
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Category Widgets', 'newsfedd'),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Footer Category Widgets Widgets in this area will be shown on page footer.', 'newsfedd' ),
		'before_title'  => '<h2>',
        'after_title'   => '</h2>',
		'before_widget' => '<div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInDown"><ul class="tag_nav">',
		'after_widget'  => '</ul></div></div>',
	) );
	//footer contact info widgets
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Contact Info Widgets', 'newsfedd'),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Footer Contact Info Widgets in this area will be shown on page footer.', 'newsfedd' ),
		'before_title'  => '<h2>',
        'after_title'   => '</h2>',
		'before_widget' => '<div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInRightBig">',
		'after_widget'  => '</div></div>',
	) );
	//resent post widgets
	register_sidebar( array(
		'name'          => esc_html__( 'resent post widgets', 'newsfedd'),
		'id'            => 'post-1',
		'description'   => esc_html__( 'resent post widgets in this area will be shown on page side bar.', 'newsfedd' ),
		'before_title'  => '<h2><span>',
        'after_title'   => '</span></h2>',
        'before_widget' => '<ul class="spost_nav">',
		'after_widget'  => '</ul>',
	) );
	//Sponsor image widgets
	register_sidebar( array(
		'name'          => esc_html__( 'Sponsor Image widgets', 'newsfedd'),
		'id'            => 'sponsor-1',
		'description'   => esc_html__( 'Sponsor Image widgets in this area will be shown on page side bar.', 'newsfedd' ),
		'before_title'  => '<h2><span>',
        'after_title'   => '</span></h2>',
        'before_widget' => '<div class="single_sidebar wow fadeInDown">',
		'after_widget'  => '</div>',
	) );
	//cetagory widgets
	register_sidebar( array(
		'name'          => esc_html__( 'cetagory widgets', 'newsfedd'),
		'id'            => 'cat-1',
		'description'   => esc_html__( 'cetagory widgets in this area will be shown on page side bar.', 'newsfedd' ),
		'before_title'  => '<h2><span>',
        'after_title'   => '</span></h2>',
        'before_widget' => '<div class="single_sidebar wow fadeInDown">',
		'after_widget'  => '</div>',
	) );
	//Page link widgets
	register_sidebar( array(
		'name'          => esc_html__( 'Page link widgets', 'newsfedd'),
		'id'            => 'page-1',
		'description'   => esc_html__( 'Page link widgets in this area will be shown on page side bar.', 'newsfedd' ),
		'before_title'  => '<h2><span>',
        'after_title'   => '</span></h2>',
        'before_widget' => '<div class="single_sidebar wow fadeInDown">',
		'after_widget'  => '</div>',
	) );
	//latest post widgets widgets
	register_sidebar( array(
		'name'          => esc_html__( 'latest post widgets', 'newsfedd'),
		'id'            => 'latest-1',
		'description'   => esc_html__( 'latest post widgets in this area will be shown on page side bar.', 'newsfedd' ),
		'before_title'  => '<h2><span>',
        'after_title'   => '</span></h2>',
        'before_widget' => '<div style="z-index: 0; overflow:hidden;" class="col-lg-4 col-md-4 col-sm-4"><div class="latest_post">',
		'after_widget'  => '  </div></div>',
	) );
		//category 1 widgets 
	register_sidebar( array(
		'name'          => esc_html__( 'category 1 widgets', 'newsfedd'),
		'id'            => 'cat1-2',
		'description'   => esc_html__( 'category 1 widgets  in this area will be shown on  home page.', 'newsfedd' ),
		'before_title'  => '<h2><span>',
        'after_title'   => '</span></h2>',
        'before_widget' => '<div class="single_post_content">',
		'after_widget'  => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'category 2 widgets', 'newsfedd'),
		'id'            => 'cat-2',
		'description'   => esc_html__( 'category 2 widgets  in this area will be shown on  home page.', 'newsfedd' ),
		'before_title'  => '<h2><span>',
        'after_title'   => '</span></h2>',
        'before_widget' => '<div class="fashion">
              <div class="single_post_content">',
		'after_widget'  => '</div></div>',
	) );	
}
add_action( 'widgets_init', 'newsfeed_regester_widgets' );




if ( ! function_exists( 'newsfeed_sanitize_choice_options' ) ) :
	function newsfeed_sanitize_choice_options( $value, $choices, $default ) {
		$input = esc_attr( $value );
		$output = array_key_exists( $input, $choices ) ? $input : $default;
		return $output;
	}
endif;



function newsfeed_widget_init(){

	/*custom post Widgets*/
	register_widget( 'newsfeed_Posts_Col' );
	register_widget( 'newsfeed_Posts' );
	register_widget( 'newsfeed_cat_2' );

	
	}
add_action('widgets_init', 'newsfeed_widget_init');
