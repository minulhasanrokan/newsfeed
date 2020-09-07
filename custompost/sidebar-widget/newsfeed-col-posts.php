<?php
if ( ! class_exists( 'newsfeed_Posts_Col' ) ) {
    class newsfeed_Posts_Col extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
	        'newsfeed_widget_title' => '',
	        'post_advanced_option' => 'recent',
	        'newsfeed_post_cat' => -1,
            'post_number' => 7,
            'orderby' => 'date',
            'order' => 'DESC',
	  

        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'newsfeed_posts_col',
                /*Widget name will appear in UI*/
                esc_html__('latest post', 'newsfeed'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show posts from selected category with advanced options', 'newsfeed' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
	        $newsfeed_widget_title = esc_attr( $instance['newsfeed_widget_title'] );
	        $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
	        $newsfeed_post_cat = esc_attr( $instance['newsfeed_post_cat'] );
	        $post_number = absint( $instance[ 'post_number' ] );
	        $orderby = esc_attr( $instance[ 'orderby' ] );
	        $order = esc_attr( $instance[ 'order' ] );
	        ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'newsfeed_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'newsfeed' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'newsfeed_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'newsfeed_widget_title' ) ); ?>" type="text" value="<?php echo $newsfeed_widget_title; ?>" />
            </p>
       
            <p class="post-cat post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('newsfeed_post_cat') ); ?>">
                    <?php esc_html_e('Select Category', 'newsfeed'); ?>
                </label>
                <?php
                $newsfeed_dropown_cat = array(
	                'show_option_none'   => false,
	                'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $newsfeed_post_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('newsfeed_post_cat'),
                    'id'                 => $this->get_field_id('newsfeed_post_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $newsfeed_dropown_cat );
                ?>
            </p>
          
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>">
			        <?php esc_html_e( 'Number of posts to show', 'newsfeed' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
			        <?php esc_html_e( 'Order by', 'newsfeed' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" >
			        <?php
			        $newsfeed_post_orderby = newsfeed_post_orderby();
			        foreach ( $newsfeed_post_orderby as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $orderby ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
			        <?php esc_html_e( 'Order by', 'newsfeed' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" >
			        <?php
			        $newsfeed_post_order = newsfeed_post_order();
			        foreach ( $newsfeed_post_order as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $order ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <hr />
            <p>
                <small><?php esc_html_e( 'Note: Some of the features only work in "Home main content area" due to minimum width in other areas.' ,'newsfeed'); ?></small>
            </p>
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $new_instance new arrays value
         * @param array $old_instance old arrays value
         * @return array
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
	        $instance[ 'newsfeed_widget_title' ] = ( isset( $new_instance['newsfeed_widget_title'] ) ) ? sanitize_text_field( $new_instance['newsfeed_widget_title'] ) : '';

	   
	   

	        $instance[ 'newsfeed_post_cat' ] = ( isset( $new_instance['newsfeed_post_cat'] ) ) ? absint( $new_instance['newsfeed_post_cat'] ) : '';
	        $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );

	   
	       

	        $newsfeed_post_orderby = newsfeed_post_orderby();
	        $instance[ 'orderby' ] = newsfeed_sanitize_choice_options( $new_instance[ 'orderby' ], $newsfeed_post_orderby, 'date' );

	        $newsfeed_post_order = newsfeed_post_order();
	        $instance[ 'order' ] = newsfeed_sanitize_choice_options( $new_instance[ 'order' ], $newsfeed_post_order, 'DESC' );

	      

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         * @access public
         * @since 1.0.0
         *
         * @param array $args widget setting
         * @param array $instance saved values
         * @return void
         *
         */
        public function widget($args, $instance) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
	        $newsfeed_post_cat = esc_attr( $instance['newsfeed_post_cat'] );
	        $newsfeed_widget_title = !empty( $instance['newsfeed_widget_title'] ) ? esc_attr( $instance['newsfeed_widget_title'] ) : get_cat_name($newsfeed_post_cat);
	        $newsfeed_widget_title = apply_filters( 'widget_title', $newsfeed_widget_title, $instance, $this->id_base );
	        $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
	        $post_number = absint( $instance[ 'post_number' ] );

	        $orderby = esc_attr( $instance[ 'orderby' ] );
	        $order = esc_attr( $instance[ 'order' ] );
	      


            /**
             * Filter the arguments for the Recent Posts widget.
             *
             * @since 1.0.0
             *
             * @see WP_Query
             *
             */
	        $sticky = get_option( 'sticky_posts' );
	        $query_args = array(
		        'posts_per_page' => $post_number,
		        'post_status'    => 'publish',
		        'post_type'      => 'post',
		        'no_found_rows'  => 1,
		        'order'          => $order,
		        'ignore_sticky_posts' => true,
		        'post__not_in' => $sticky
	        );
	        switch ( $post_advanced_option ) {

		        case 'cat' :
			        $query_args['cat'] = $newsfeed_post_cat;
			        break;

	        }

	        switch ( $orderby ) {

                case 'ID' :
		        case 'author' :
		        case 'title' :
		        case 'date' :
		        case 'modified' :
		        case 'rand' :
		        case 'comment_count' :
		        case 'menu_order' :
			        $query_args['orderby']  = $orderby;
			        break;

		        default :
			        $query_args['orderby']  = 'date';
	        }

            $newsfeed_featured_query = new WP_Query( $query_args );

            if ($newsfeed_featured_query->have_posts()) :
                echo $args['before_widget'];
	                echo $args['before_title'];
		            echo $newsfeed_widget_title;
		            echo $args['after_title'];
		            ?>
                    <div class="latest_post_container">
                      <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                       <ul class="latest_postnav">
                    <?php
	                $newsfeed_featured_index = 1;
	                while ( $newsfeed_featured_query->have_posts() ) :$newsfeed_featured_query->the_post();
		              

		                $newsfeed_list_classes = 'single-list';
		                $newsfeed_words = 21;
		                ?>
                        <li>
                           <div class="media"> <a href="<?php the_permalink(); ?>" class="media-left"><img alt="" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>"> </a>
                            <div class="media-body"> <a href="<?php the_permalink(); ?>" class="catg_title"><?php the_title();?></a> </div>
                          </div>
                        </li>              
		                <?php
		                $newsfeed_featured_index++;
	                endwhile; ?>
                    </ul>
                      <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
                    </div>          
                <!--featured entries-col-->
                <?php
                echo $args['after_widget'];
                // Reset the global $the_post as this query will have stomped on it
            endif;
	        wp_reset_postdata();
        }
    } // Class newsfeed_Posts_Col ends here
}

if ( ! class_exists( 'newsfeed_Posts' ) ) {
    class newsfeed_Posts extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
            'newsfeed_widget_title' => '',
            'post_advanced_option' => 'recent',
            'newsfeed_post_cat' => -1,
            'post_number' => 7,
            'orderby' => 'date',
            'order' => 'DESC',
          

        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'newsfeed_Posts',
                /*Widget name will appear in UI*/
                esc_html__('category post 1', 'newsfeed'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show posts from selected category with advanced options', 'newsfeed' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $newsfeed_widget_title = esc_attr( $instance['newsfeed_widget_title'] );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $newsfeed_post_cat = esc_attr( $instance['newsfeed_post_cat'] );
            $post_number = absint( $instance[ 'post_number' ] );
        
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );

         

    
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'newsfeed_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'newsfeed' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'newsfeed_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'newsfeed_widget_title' ) ); ?>" type="text" value="<?php echo $newsfeed_widget_title; ?>" />
            </p>
         
            <p class="post-cat post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('newsfeed_post_cat') ); ?>">
                    <?php esc_html_e('Select Category', 'newsfeed'); ?>
                </label>
                <?php
                $newsfeed_dropown_cat = array(
                    'show_option_none'   => false,
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $newsfeed_post_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('newsfeed_post_cat'),
                    'id'                 => $this->get_field_id('newsfeed_post_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $newsfeed_dropown_cat );
                ?>
            </p>
          
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>">
                    <?php esc_html_e( 'Number of posts to show', 'newsfeed' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
           
        
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'newsfeed' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" >
                    <?php
                    $newsfeed_post_orderby = newsfeed_post_orderby();
                    foreach ( $newsfeed_post_orderby as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $orderby ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'newsfeed' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" >
                    <?php
                    $newsfeed_post_order = newsfeed_post_order();
                    foreach ( $newsfeed_post_order as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $order ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <hr />
            <?php
        }

        /**
         * Function to Updating widget replacing old instances with new
         *
         */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance[ 'newsfeed_widget_title' ] = ( isset( $new_instance['newsfeed_widget_title'] ) ) ? sanitize_text_field( $new_instance['newsfeed_widget_title'] ) : '';
            $instance[ 'newsfeed_post_cat' ] = ( isset( $new_instance['newsfeed_post_cat'] ) ) ? absint( $new_instance['newsfeed_post_cat'] ) : '';
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $newsfeed_post_orderby = newsfeed_post_orderby();
            $instance[ 'orderby' ] = newsfeed_sanitize_choice_options( $new_instance[ 'orderby' ], $newsfeed_post_orderby, 'date' );

            $newsfeed_post_order = newsfeed_post_order();
            $instance[ 'order' ] = newsfeed_sanitize_choice_options( $new_instance[ 'order' ], $newsfeed_post_order, 'DESC' );

            return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         */
        public function widget($args, $instance) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $newsfeed_post_cat = esc_attr( $instance['newsfeed_post_cat'] );;
            $newsfeed_widget_title = !empty( $instance['newsfeed_widget_title'] ) ? esc_attr( $instance['newsfeed_widget_title'] ) : get_cat_name($newsfeed_post_cat);
            $newsfeed_widget_title = apply_filters( 'widget_title', $newsfeed_widget_title, $instance, $this->id_base );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );

            /**
             * Filter the arguments for the Recent Posts widget.
             *
             */
            $sticky = get_option( 'sticky_posts' );
            $query_args = array(
                'posts_per_page' => $post_number,
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'no_found_rows'  => 1,
                'order'          => $order,
                'ignore_sticky_posts' => true,
                'post__not_in' => $sticky
            );
            switch ( $post_advanced_option ) {

                case 'cat' :
                    $query_args['cat'] = $newsfeed_post_cat;
                    break;
            }

            switch ( $orderby ) {

                case 'ID' :
                case 'author' :
                case 'title' :
                case 'date' :
                case 'modified' :
                case 'rand' :
                case 'comment_count' :
                case 'menu_order' :
                    $query_args['orderby']  = $orderby;
                    break;

                default :
                    $query_args['orderby']  = 'date';
            }

            $newsfeed_featured_query = new WP_Query( $query_args );

            if ($newsfeed_featured_query->have_posts()) :
                echo $args['before_widget'];
                    echo $args['before_title'];
                    echo $newsfeed_widget_title;
                    echo $args['after_title'];
                    ?>
                      <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">
                    <?php
                    $newsfeed_featured_index = 1;
                    while ( $newsfeed_featured_query->have_posts()) :$newsfeed_featured_query->the_post();                        ?>
                        <li>
                            <figure class="bsbig_fig"> <a href="<?php the_permalink(); ?>" class="featured_img"> <img alt="" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>"> <span class="overlay"></span> </a>
                              <figcaption> <a href="<?php the_permalink(); ?>"><?php the_title();?></a> </figcaption>
                              <?php if (strlen("the_content()") > 300) { ?>
                                   <?php the_content(); ?>
                               <?php } if (strlen("the_content()") < 300) { ?>
                                   <?php echo substr(get_the_content(), 0, 300); ?>
                               <?php } ?>   
                            </figure>
                          </li>
         
                        <?php
                        break;
                    endwhile; ?>
                        </ul>
                    </div> 
                        <div class="single_post_content_right">
                        <ul class="spost_nav">
                    <?php
                    $newsfeed_featured_index = 1;
                    while ( $newsfeed_featured_query->have_posts()) :$newsfeed_featured_query->the_post();                        ?>
                        <li>
                            <div class="media wow fadeInDown"> <a href="<?php the_permalink(); ?>" class="media-left"> <img alt="" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>"> </a>
                              <div class="media-body"> <a href="<?php the_permalink(); ?>" class="catg_title"><?php the_title();?></a> </div>
                            </div>
                          </li>
         
                        <?php
                        
                    endwhile; ?>
                        </ul>
                    </div> 
                <!--featured entries-col-->
                <?php
                echo $args['after_widget'];
                // Reset the global $the_post as this query will have stomped on it
            endif;
            wp_reset_postdata();
        }
    } // Class newsfeed_Posts_Col ends here
}


if ( ! class_exists( 'newsfeed_cat_2' ) ) {
    class newsfeed_cat_2 extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
            'newsfeed_widget_title' => '',
            'post_advanced_option' => 'recent',
            'newsfeed_post_cat' => -1,
            'post_number' => 7,
            'orderby' => 'date',
            'order' => 'DESC',
  

        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'newsfeed_cat_2',
                /*Widget name will appear in UI*/
                esc_html__('category post 2', 'newsfeed'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show posts from selected category with advanced options', 'newsfeed' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $newsfeed_widget_title = esc_attr( $instance['newsfeed_widget_title'] );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $newsfeed_post_cat = esc_attr( $instance['newsfeed_post_cat'] );
            $post_number = absint( $instance[ 'post_number' ] );
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );
         

        
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'newsfeed_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'newsfeed' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'newsfeed_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'newsfeed_widget_title' ) ); ?>" type="text" value="<?php echo $newsfeed_widget_title; ?>" />
            </p>
           
            <p class="post-cat post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('newsfeed_post_cat') ); ?>">
                    <?php esc_html_e('Select Category', 'newsfeed'); ?>
                </label>
                <?php
                $newsfeed_dropown_cat = array(
                    'show_option_none'   => false,
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $newsfeed_post_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('newsfeed_post_cat'),
                    'id'                 => $this->get_field_id('newsfeed_post_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $newsfeed_dropown_cat );
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>">
                    <?php esc_html_e( 'Number of posts to show', 'newsfeed' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
           
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'newsfeed' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" >
                    <?php
                    $newsfeed_post_orderby = newsfeed_post_orderby();
                    foreach ( $newsfeed_post_orderby as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $orderby ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'newsfeed' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" >
                    <?php
                    $newsfeed_post_order = newsfeed_post_order();
                    foreach ( $newsfeed_post_order as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $order ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <hr />
            <p>
                <small><?php esc_html_e( 'Note: Some of the features only work in "Home main content area" due to minimum width in other areas.' ,'newsfeed'); ?></small>
            </p>
            <?php
        }

        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance[ 'newsfeed_widget_title' ] = ( isset( $new_instance['newsfeed_widget_title'] ) ) ? sanitize_text_field( $new_instance['newsfeed_widget_title'] ) : '';
            $instance[ 'newsfeed_post_cat' ] = ( isset( $new_instance['newsfeed_post_cat'] ) ) ? absint( $new_instance['newsfeed_post_cat'] ) : '';
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $newsfeed_post_orderby = newsfeed_post_orderby();
            $instance[ 'orderby' ] = newsfeed_sanitize_choice_options( $new_instance[ 'orderby' ], $newsfeed_post_orderby, 'date' );

            $newsfeed_post_order = newsfeed_post_order();
            $instance[ 'order' ] = newsfeed_sanitize_choice_options( $new_instance[ 'order' ], $newsfeed_post_order, 'DESC' );
        return $instance;
        }

        /**
         * Function to Creating widget front-end. This is where the action happens
         *
         */
        public function widget($args, $instance) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $newsfeed_post_cat = esc_attr( $instance['newsfeed_post_cat'] );
            $newsfeed_widget_title = !empty( $instance['newsfeed_widget_title'] ) ? esc_attr( $instance['newsfeed_widget_title'] ) : get_cat_name($newsfeed_post_cat);
            $newsfeed_widget_title = apply_filters( 'widget_title', $newsfeed_widget_title, $instance, $this->id_base );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );
           
            /**
             * Filter the arguments for the Recent Posts widget.
             *
             */
            $sticky = get_option( 'sticky_posts' );
            $query_args = array(
                'posts_per_page' => $post_number,
                'post_status'    => 'publish',
                'post_type'      => 'post',
                'no_found_rows'  => 1,
                'order'          => $order,
                'ignore_sticky_posts' => true,
                'post__not_in' => $sticky
            );
            switch ( $post_advanced_option ) {

                case 'cat' :
                    $query_args['cat'] = $newsfeed_post_cat;
                    break;

            
            }

            switch ( $orderby ) {

                case 'ID' :
                case 'author' :
                case 'title' :
                case 'date' :
                case 'modified' :
                case 'rand' :
                case 'comment_count' :
                case 'menu_order' :
                    $query_args['orderby']  = $orderby;
                    break;

                default :
                    $query_args['orderby']  = 'date';
            }

            $newsfeed_featured_query = new WP_Query( $query_args );

            if ($newsfeed_featured_query->have_posts()) :
                echo $args['before_widget'];
                    echo $args['before_title'];
                    echo $newsfeed_widget_title;
                    echo $args['after_title'];
                    ?>
                      <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">
                    <?php
                    $newsfeed_featured_index = 1;
                    while ( $newsfeed_featured_query->have_posts()) :$newsfeed_featured_query->the_post();                        ?>
                        <li>
                            <figure class="bsbig_fig"> <a href="<?php the_permalink(); ?>" class="featured_img"> <img alt="" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>"> <span class="overlay"></span> </a>
                              <figcaption> <a href="<?php the_permalink(); ?>"><?php the_title();?></a> </figcaption>
                              <?php if (strlen("the_content()") > 300) { ?>
                                   <?php the_content(); ?>
                               <?php } if (strlen("the_content()") < 300) { ?>
                                   <?php echo substr(get_the_content(), 0, 300); ?>
                               <?php } ?>   
                            </figure>
                          </li>
         
                        <?php
                        break;
                    endwhile; ?>
                        </ul>
                    </div> 
                        <div class="single_post_content_right">
                        <ul class="spost_nav">
                    <?php
                    $newsfeed_featured_index = 1;
                    while ( $newsfeed_featured_query->have_posts()) :$newsfeed_featured_query->the_post();                        ?>
                        <li>
                            <div class="media wow fadeInDown"> <a href="<?php the_permalink(); ?>" class="media-left"> <img alt="" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>"> </a>
                              <div class="media-body"> <a href="<?php the_permalink(); ?>" class="catg_title"><?php the_title();?></a> </div>
                            </div>
                          </li>
         
                        <?php
                        
                    endwhile; ?>
                        </ul>
                    </div> 
                <!--featured entries-col-->
                <?php
                echo $args['after_widget'];
                // Reset the global $the_post as this query will have stomped on it
            endif;
            wp_reset_postdata();
        }
    } // Class newsfeed_Posts_Col ends here
}