<?php

//get post cetagory
if ( !function_exists('newsfeed_list_post_category') ) :
    function newsfeed_list_post_category( $post_id = 0 ) {

        if( 0 == $post_id ){
            global $post;
            $post_id = $post->ID;
        }
        $categories = get_the_category($post_id);
        $separator = '&nbsp;';
        $output = '';
        if($categories) {
            echo '<span class="cat-links">';
            foreach($categories as $category) {
	            $output .= '<a class="at-cat-item-'.esc_attr($category->term_id).'" href="'.esc_url( get_category_link( $category->term_id ) ).'"  rel="category tag">'.esc_html( $category->cat_name ).'</a>'.$separator;
            }
            echo '</span>';
            echo trim($output, $separator);
        }
    }
endif;
//get post orderby
if ( !function_exists('newsfeed_post_orderby') ) :
	function newsfeed_post_orderby() {
		$newsfeed_post_orderby =  array(
			'none' => esc_html__( 'None', 'online-shop' ),
			'ID' => esc_html__( 'ID', 'online-shop' ),
			'author' => esc_html__( 'Author', 'online-shop' ),
			'title' => esc_html__( 'Title', 'online-shop' ),
			'date' => esc_html__( 'Date', 'online-shop' ),
			'modified' => esc_html__( 'Modified Date', 'online-shop' ),
			'rand' => esc_html__( 'Random', 'online-shop' ),
			'comment_count' => esc_html__( 'Comment Count', 'online-shop' ),
			'menu_order' => esc_html__( 'Menu Order', 'online-shop' )
		);
		return apply_filters( 'newsfeed_post_orderby', $newsfeed_post_orderby );
	}
endif;
//get post order
if ( !function_exists('newsfeed_post_order') ) :
	function newsfeed_post_order() {
		$newsfeed_post_order =  array(
			'ASC' => esc_html__( 'ASC', 'online-shop' ),
			'DESC' => esc_html__( 'DESC', 'online-shop' )
        );
		return apply_filters( 'newsfeed_post_order', $newsfeed_post_order );
	}
endif;





