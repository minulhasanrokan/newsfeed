<?php
//all support
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
//furute image
add_theme_support( 'post-thumbnails' );

    function newsfeed_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Online Shop, use a find and replace
         * to change 'newsfeed' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'newsfeed', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
        * Enable support for custom logo.
        *
        *  @since Online Shop 1.0.0
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 70,
            'width'       => 290,
            'flex-height' => true,
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 240, 172, true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'newsfeed' ),
            'top-menu' => esc_html__( 'Top Menu ( Support First Level Only )', 'newsfeed' ),
            'special-menu' => esc_html__( 'Special Menu ( Display Beside Primary Menu)', 'newsfeed' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'newsfeed_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // This theme styles the visual editor with editor-style.css to match the theme style.
	    add_editor_style();

        // Adding excerpt for page
	    add_post_type_support( 'page', 'excerpt' );

	

	    
    }

add_action( 'after_setup_theme', 'newsfeed_setup' );



