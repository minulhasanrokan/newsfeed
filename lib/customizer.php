<?php
// logo customizer section
function newsfeed_custom_logo_setup() {
 $defaults = array(
 'height'      => 45,
 'width'       => 286,
 'flex-height' => true,
 'flex-width'  => true,
 'header-text' => array( 'site-title', 'site-description' ),
 );
 add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'newsfeed_custom_logo_setup' );


// coustomizer section
class newsfeed_customizer { 
    public function __construct() {
        add_action( 'customize_register', array( $this, 'register_customize_sections' ) );
    }
    public function register_customize_sections( $wp_customize ) {
    	//copyright
        $this->newsfeed_copyright_section( $wp_customize );
        //latest news section
        $this->newsfeed_latestnews_section( $wp_customize );
        //social link
        $this->newsfeed_sociallink_section( $wp_customize );
        //post by category
        //$this->newsfeed_post_section( $wp_customize );
    }
    //copyright option data
    public function newsfeed_copyright_custom_option($input) {
        return ( $input === "No" ) ? "No" : "Yes";
    }
     //copyright text data 
    public function newsfeed_copyright_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //latest news  option data
    public function newsfeed_latestnews_custom_option($input) {
        return ( $input === "No" ) ? "No" : "Yes";
    }
     //latest news text data 
    public function newsfeed_latestnews_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
     //social facebook text data 
    public function newsfeed_facebook_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social twitter text data 
    public function newsfeed_twitter_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social flickr text data 
    public function newsfeed_flickr_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social pinterest text data 
    public function newsfeed_pinterest_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social googleplus text data 
    public function newsfeed_googleplus_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social vimeo text data 
    public function newsfeed_vimeo_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social youtube text data 
    public function newsfeed_youtube_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social mail text data 
    public function newsfeed_mail_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
     public function newsfeed_post_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    //social mail text data 
    public function newsfeed_post_custom_post_type($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }


    //copy right
    private function newsfeed_copyright_section( $wp_customize ) {
        $wp_customize->add_section('newsfeed-footer-copyright-section', array(
            'title' => 'Copy Right Section',
            'priority' => 3,
            'description' => __('The Copy Right Section is only displayed on the Footer.', 'newsfeed'),
        ));
        //copy right option setting
        $wp_customize->add_setting('newsfeed-footer-copyright-section-display', array(
            'default' => 'No',
            'sanitize_callback' => array( $this, 'newsfeed_copyright_custom_option' )
        ));
        //copy right option control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed-copy-right', array(
            'label' => 'Display Copy Right Section?',
            'section' => 'newsfeed-footer-copyright-section',
            'settings' => 'newsfeed-footer-copyright-section-display',
            'type' => 'select',
            'choices' => array('No' => 'No', 'Yes' => 'Yes')
        )));
        //copy right text setting
        $wp_customize->add_setting('newsfeed-footer-copyright-section-text', array(
            'default' => 'Copy Right Section',
            'sanitize_callback' => array( $this, 'newsfeed_copyright_custom_text' )
        ));
        //copy right text control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed-copy-right-text', array(
            'label' => 'Copy Right Section Text',
            'section' => 'newsfeed-footer-copyright-section',
            'settings' => 'newsfeed-footer-copyright-section-text',
            'type' => 'textarea'
        )));
    }
    //latest news section
    private function newsfeed_latestnews_section( $wp_customize ) {
        $wp_customize->add_section('newsfeed-latestnews-section', array(
            'title' => 'Latest News Section',
            'priority' => 0,
            'description' => __('Latest News Section is only displayed on the page header.', 'newsfeed'),
        ));
        //clatest news setting
        $wp_customize->add_setting('newsfeed-latestnews-display', array(
            'default' => 'No',
            'sanitize_callback' => array( $this, 'newsfeed_latestnews_custom_option' )
        ));
        //latest news option control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed-latestnews', array(
            'label' => 'Display Latest News Section?',
            'section' => 'newsfeed-latestnews-section',
            'settings' => 'newsfeed-latestnews-display',
            'type' => 'select',
            'choices' => array('No' => 'No', 'Yes' => 'Yes')
        )));
        //latest news text setting
        $wp_customize->add_setting('newsfeed-latestnew-display', array(
            'default' => 'Latest News Section',
            'sanitize_callback' => array( $this, 'newsfeed_latestnews_custom_text' )
        ));
        //latest news control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_latestnews_custom_text', array(
            'label' => 'Latest news',
            'section' => 'newsfeed-latestnews-section',
            'settings' => 'newsfeed-latestnew-display',
            'type' => 'textarea'
        )));
    } 
    //Social Link  section
    private function newsfeed_sociallink_section( $wp_customize ) {
        $wp_customize->add_section('newsfeed-Social-section', array(
            'title' => 'Social Link Section',
            'priority' => 0,
            'description' => __('Social Link Section is only displayed on the page header.', 'newsfeed'),
        ));
        //Social Link facebook text setting
        $wp_customize->add_setting('newsfeed-facebook-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_facebook_custom_text' )
        ));
        //Social Link facebook control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_facebook_custom_text', array(
            'label' => 'Input facebook link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-facebook-display',
            'type' => 'url'
        )));
        //Social Link twitter text setting
        $wp_customize->add_setting('newsfeed-twitter-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_twitter_custom_text' )
        ));
        //Social Link twitter control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_twitter_custom_text', array(
            'label' => 'Input twitter link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-twitter-display',
            'type' => 'url'
        )));
        //Social Link flickr text setting
        $wp_customize->add_setting('newsfeed-flickr-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_flickr_custom_text' )
        ));
        //Social Link flickr control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_flickr_custom_text', array(
            'label' => 'Input flickr link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-flickr-display',
            'type' => 'url'
        )));
        //Social Link pinterest text setting
        $wp_customize->add_setting('newsfeed-pinterest-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_pinterest_custom_text' )
        ));
        //Social Link pinterest control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_pinterest_custom_text', array(
            'label' => 'Input pinterest link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-pinterest-display',
            'type' => 'url'
        )));
        //Social Link googleplus text setting
        $wp_customize->add_setting('newsfeed-latestnew-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_googleplus_custom_text' )
        ));
        //Social Link googleplus control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_googleplus_custom_text', array(
            'label' => 'Input googleplus link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-googleplus-display',
            'type' => 'url'
        )));
        //Social Link vimeo text setting
        $wp_customize->add_setting('newsfeed-vimeo-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_vimeo_custom_text' )
        ));
        //Social Link vimeo control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_vimeo_custom_text', array(
            'label' => 'Input vimeo link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-vimeo-display',
            'type' => 'url'
        )));
        //Social Link youtube text setting
        $wp_customize->add_setting('newsfeed-youtube-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_youtube_custom_text' )
        ));
        //Social Link youtube control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_youtube_custom_text', array(
            'label' => 'Input youtube link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-youtube-display',
            'type' => 'url'
        )));
        //Social Link mail text setting
        $wp_customize->add_setting('newsfeed-mail-display', array(
            'default' => '#',
            'sanitize_callback' => array( $this, 'newsfeed_mail_custom_text' )
        ));
        //Social Link mail control
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'newsfeed_mail_custom_text', array(
            'label' => 'Input mail link',
            'section' => 'newsfeed-Social-section',
            'settings' => 'newsfeed-mail-display',
            'type' => 'url'
        )));
    }
}