<?php
if ( ! class_exists( 'Online_Shop_Posts_Col' ) ) {
    class Online_Shop_Posts_Col extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
	        'online_shop_widget_title' => '',
	        'post_advanced_option' => 'recent',
	        'online_shop_post_cat' => -1,
	        'online_shop_post_tag' => -1,
            'post_number' => 7,
            'column_number' => 4,
            'display_type' => 'column',
            'orderby' => 'date',
            'order' => 'DESC',
	        'view_all_option' => 'disable',
	        'all_link_text' => '',
	        'all_link_url' => '',
	        'enable_prev_next' => 1,
	        'online_shop_img_size' => 'large'
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'online_shop_posts_col',
                /*Widget name will appear in UI*/
                esc_html__('latest post', 'online-shop'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show posts from selected category with advanced options', 'online-shop' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
	        $online_shop_widget_title = esc_attr( $instance['online_shop_widget_title'] );
	        $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
	        $online_shop_post_cat = esc_attr( $instance['online_shop_post_cat'] );
	        $online_shop_post_tag = esc_attr( $instance['online_shop_post_tag'] );
	        $post_number = absint( $instance[ 'post_number' ] );
	        $column_number = absint( $instance[ 'column_number' ] );
	        $display_type = esc_attr( $instance[ 'display_type' ] );
	        $orderby = esc_attr( $instance[ 'orderby' ] );
	        $order = esc_attr( $instance[ 'order' ] );
	        $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
	        $all_link_text = esc_attr( $instance['all_link_text'] );
	        $all_link_url = esc_url( $instance['all_link_url'] );
	        $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
	        $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

	        $choices = online_shop_get_image_sizes_options();
	        ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_widget_title' ) ); ?>" type="text" value="<?php echo $online_shop_widget_title; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_advanced_option' ) ); ?>"><?php esc_html_e( 'Show', 'online-shop' ); ?></label>
                <select class="widefat at-post-advanced-option" id="<?php echo esc_attr( $this->get_field_id( 'post_advanced_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_advanced_option' ) ); ?>" >
			        <?php
			        $post_advanced_options = online_shop_post_advanced_options();
			        foreach ( $post_advanced_options as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $post_advanced_option ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p class="post-cat post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_post_cat') ); ?>">
                    <?php esc_html_e('Select Category', 'online-shop'); ?>
                </label>
                <?php
                $online_shop_dropown_cat = array(
	                'show_option_none'   => false,
	                'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $online_shop_post_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('online_shop_post_cat'),
                    'id'                 => $this->get_field_id('online_shop_post_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $online_shop_dropown_cat );
                ?>
            </p>
            <p class="post-tag post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_post_tag') ); ?>">
			        <?php esc_html_e('Select Tag', 'online-shop'); ?>
                </label>
		        <?php
		        $online_shop_dropown_cat = array(
			        'show_option_none'   => false,
			        'orderby'            => 'name',
			        'order'              => 'asc',
			        'show_count'         => 1,
			        'hide_empty'         => 1,
			        'echo'               => 1,
			        'selected'           => $online_shop_post_tag,
			        'hierarchical'       => 1,
			        'name'               => $this->get_field_name('online_shop_post_tag'),
			        'id'                 => $this->get_field_name('online_shop_post_tag'),
			        'class'              => 'widefat',
			        'taxonomy'           => 'post_tag',
			        'hide_if_empty'      => false,
		        );
		        wp_dropdown_categories( $online_shop_dropown_cat );
		        ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>">
			        <?php esc_html_e( 'Number of posts to show', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Column Number', 'online-shop' ); ?></label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>" >
			        <?php
			        $online_shop_widget_column_numbers = online_shop_widget_column_number();
			        foreach ( $online_shop_widget_column_numbers as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>">
                    <?php esc_html_e( 'Display Type', 'online-shop' ); ?>
                </label>
                <select class="widefat at-display-select" id="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_type' ) ); ?>" >
			        <?php
			        $online_shop_widget_display_types = online_shop_widget_display_type();
			        foreach ( $online_shop_widget_display_types as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $display_type ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
			        <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" >
			        <?php
			        $online_shop_post_orderby = online_shop_post_orderby();
			        foreach ( $online_shop_post_orderby as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $orderby ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
			        <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" >
			        <?php
			        $online_shop_post_order = online_shop_post_order();
			        foreach ( $online_shop_post_order as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $order ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <hr /><!--view all link separate-->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>">
			        <?php esc_html_e( 'View all options', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_all_option' ) ); ?>" >
			        <?php
			        $online_shop_adv_link_options = online_shop_adv_link_options();
			        foreach ( $online_shop_adv_link_options as $key => $value ){
				        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $view_all_option ); ?>><?php echo esc_html( $value );?></option>
				        <?php
			        }
			        ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>">
			        <?php esc_html_e( 'All Link Text', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_text' ) ); ?>" type="text" value="<?php echo $all_link_text; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>">
			        <?php esc_html_e( 'All Link Url', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_url' ) ); ?>" type="text" value="<?php echo $all_link_url; ?>" />
            </p>
            <hr />
            <p class="at-enable-prev-next">
                <input id="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'enable_prev_next' ) ); ?>" type="checkbox" <?php checked( 1 == $enable_prev_next ? $instance['enable_prev_next'] : 0); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>"><?php esc_html_e( 'Enable Prev - Next on Carousel Column', 'online-shop' ); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>">
			        <?php esc_html_e( 'Normal Featured Post Image', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_img_size' ) ); ?>">
			        <?php
			        foreach( $choices as $key => $online_shop_column_array ){
				        echo ' <option value="'.esc_attr( $key ).'" '.selected( $online_shop_img_size, $key, 0). '>'.esc_attr( $online_shop_column_array ).'</option>';
			        }
			        ?>
                </select>
            </p>
            <p>
                <small><?php esc_html_e( 'Note: Some of the features only work in "Home main content area" due to minimum width in other areas.' ,'online-shop'); ?></small>
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
	        $instance[ 'online_shop_widget_title' ] = ( isset( $new_instance['online_shop_widget_title'] ) ) ? sanitize_text_field( $new_instance['online_shop_widget_title'] ) : '';

	        $post_advanced_options = online_shop_post_advanced_options();
	        $instance[ 'post_advanced_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'post_advanced_option' ], $post_advanced_options, 'recent' );

	        $instance[ 'online_shop_post_cat' ] = ( isset( $new_instance['online_shop_post_cat'] ) ) ? absint( $new_instance['online_shop_post_cat'] ) : '';
	        $instance[ 'online_shop_post_tag' ] = ( isset( $new_instance['online_shop_post_tag'] ) ) ? absint( $new_instance['online_shop_post_tag'] ) : '';
	        $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
	        $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );

	        $online_shop_widget_display_types = online_shop_widget_display_type();
	        $instance[ 'display_type' ] = online_shop_sanitize_choice_options( $new_instance[ 'display_type' ], $online_shop_widget_display_types, 'column' );

	        $online_shop_post_orderby = online_shop_post_orderby();
	        $instance[ 'orderby' ] = online_shop_sanitize_choice_options( $new_instance[ 'orderby' ], $online_shop_post_orderby, 'date' );

	        $online_shop_post_order = online_shop_post_order();
	        $instance[ 'order' ] = online_shop_sanitize_choice_options( $new_instance[ 'order' ], $online_shop_post_order, 'DESC' );

	        $online_shop_link_options = online_shop_adv_link_options();
	        $instance[ 'view_all_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'view_all_option' ], $online_shop_link_options, 'disable' );

	        $instance[ 'all_link_text' ] = sanitize_text_field( $new_instance[ 'all_link_text' ] );
	        $instance[ 'all_link_url' ] = esc_url_raw( $new_instance[ 'all_link_url' ] );
	        $instance[ 'enable_prev_next' ] = isset($new_instance['enable_prev_next'])? 1 : 0;

	        $online_shop_img_size = online_shop_get_image_sizes_options();
	        $instance[ 'online_shop_img_size' ] = online_shop_sanitize_choice_options( $new_instance[ 'online_shop_img_size' ], $online_shop_img_size, 'large' );

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
	        $online_shop_post_cat = esc_attr( $instance['online_shop_post_cat'] );
	        $online_shop_post_tag = esc_attr( $instance['online_shop_post_tag'] );
	        $online_shop_widget_title = !empty( $instance['online_shop_widget_title'] ) ? esc_attr( $instance['online_shop_widget_title'] ) : get_cat_name($online_shop_post_cat);
	        $online_shop_widget_title = apply_filters( 'widget_title', $online_shop_widget_title, $instance, $this->id_base );
	        $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
	        $post_number = absint( $instance[ 'post_number' ] );
	        $column_number = absint( $instance[ 'column_number' ] );
	        $display_type = esc_attr( $instance[ 'display_type' ] );
	        $orderby = esc_attr( $instance[ 'orderby' ] );
	        $order = esc_attr( $instance[ 'order' ] );
	        $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
	        $all_link_text = esc_html( $instance[ 'all_link_text' ] );
	        $all_link_url = esc_url( $instance[ 'all_link_url' ] );
	        $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
	        $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

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
			        $query_args['cat'] = $online_shop_post_cat;
			        break;

		        case 'tag' :
			        $query_args['tag'] = $online_shop_post_tag;
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

            $online_shop_featured_query = new WP_Query( $query_args );

            if ($online_shop_featured_query->have_posts()) :
                echo $args['before_widget'];
	                echo $args['before_title'];
		            echo $online_shop_widget_title;
		            echo $args['after_title'];
		            ?>
                    <div class="latest_post_container">
                      <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                       <ul class="latest_postnav">
                    <?php
	                $online_shop_featured_index = 1;
	                while ( $online_shop_featured_query->have_posts() ) :$online_shop_featured_query->the_post();
		                $thumb = $online_shop_img_size;
		                $online_shop_list_classes = 'single-list';
		                $online_shop_words = 21;
		                ?>
                        <li>
                           <div class="media"> <a href="<?php the_permalink(); ?>" class="media-left"><img alt="" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>"> </a>
                            <div class="media-body"> <a href="<?php the_permalink(); ?>" class="catg_title"><?php the_title();?></a> </div>
                          </div>
                        </li>              
		                <?php
		                $online_shop_featured_index++;
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
    } // Class Online_Shop_Posts_Col ends here
}

if ( ! class_exists( 'Online_Shop_Posts' ) ) {
    class Online_Shop_Posts extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
            'online_shop_widget_title' => '',
            'post_advanced_option' => 'recent',
            'online_shop_post_cat' => -1,
            'online_shop_post_tag' => -1,
            'post_number' => 7,
            'column_number' => 4,
            'display_type' => 'column',
            'orderby' => 'date',
            'order' => 'DESC',
            'view_all_option' => 'disable',
            'all_link_text' => '',
            'all_link_url' => '',
            'enable_prev_next' => 1,
            'online_shop_img_size' => 'large'
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'Online_Shop_Posts',
                /*Widget name will appear in UI*/
                esc_html__('category post 1', 'online-shop'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show posts from selected category with advanced options', 'online-shop' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $online_shop_widget_title = esc_attr( $instance['online_shop_widget_title'] );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $online_shop_post_cat = esc_attr( $instance['online_shop_post_cat'] );
            $online_shop_post_tag = esc_attr( $instance['online_shop_post_tag'] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $display_type = esc_attr( $instance[ 'display_type' ] );
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );
            $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
            $all_link_text = esc_attr( $instance['all_link_text'] );
            $all_link_url = esc_url( $instance['all_link_url'] );
            $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
            $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

            $choices = online_shop_get_image_sizes_options();
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_widget_title' ) ); ?>" type="text" value="<?php echo $online_shop_widget_title; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_advanced_option' ) ); ?>"><?php esc_html_e( 'Show', 'online-shop' ); ?></label>
                <select class="widefat at-post-advanced-option" id="<?php echo esc_attr( $this->get_field_id( 'post_advanced_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_advanced_option' ) ); ?>" >
                    <?php
                    $post_advanced_options = online_shop_post_advanced_options();
                    foreach ( $post_advanced_options as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $post_advanced_option ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p class="post-cat post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_post_cat') ); ?>">
                    <?php esc_html_e('Select Category', 'online-shop'); ?>
                </label>
                <?php
                $online_shop_dropown_cat = array(
                    'show_option_none'   => false,
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $online_shop_post_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('online_shop_post_cat'),
                    'id'                 => $this->get_field_id('online_shop_post_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $online_shop_dropown_cat );
                ?>
            </p>
            <p class="post-tag post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_post_tag') ); ?>">
                    <?php esc_html_e('Select Tag', 'online-shop'); ?>
                </label>
                <?php
                $online_shop_dropown_cat = array(
                    'show_option_none'   => false,
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $online_shop_post_tag,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('online_shop_post_tag'),
                    'id'                 => $this->get_field_name('online_shop_post_tag'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'post_tag',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $online_shop_dropown_cat );
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>">
                    <?php esc_html_e( 'Number of posts to show', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Column Number', 'online-shop' ); ?></label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>" >
                    <?php
                    $online_shop_widget_column_numbers = online_shop_widget_column_number();
                    foreach ( $online_shop_widget_column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>">
                    <?php esc_html_e( 'Display Type', 'online-shop' ); ?>
                </label>
                <select class="widefat at-display-select" id="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_type' ) ); ?>" >
                    <?php
                    $online_shop_widget_display_types = online_shop_widget_display_type();
                    foreach ( $online_shop_widget_display_types as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $display_type ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" >
                    <?php
                    $online_shop_post_orderby = online_shop_post_orderby();
                    foreach ( $online_shop_post_orderby as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $orderby ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" >
                    <?php
                    $online_shop_post_order = online_shop_post_order();
                    foreach ( $online_shop_post_order as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $order ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <hr /><!--view all link separate-->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>">
                    <?php esc_html_e( 'View all options', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_all_option' ) ); ?>" >
                    <?php
                    $online_shop_adv_link_options = online_shop_adv_link_options();
                    foreach ( $online_shop_adv_link_options as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $view_all_option ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>">
                    <?php esc_html_e( 'All Link Text', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_text' ) ); ?>" type="text" value="<?php echo $all_link_text; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>">
                    <?php esc_html_e( 'All Link Url', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_url' ) ); ?>" type="text" value="<?php echo $all_link_url; ?>" />
            </p>
            <hr />
            <p class="at-enable-prev-next">
                <input id="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'enable_prev_next' ) ); ?>" type="checkbox" <?php checked( 1 == $enable_prev_next ? $instance['enable_prev_next'] : 0); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>"><?php esc_html_e( 'Enable Prev - Next on Carousel Column', 'online-shop' ); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>">
                    <?php esc_html_e( 'Normal Featured Post Image', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_img_size' ) ); ?>">
                    <?php
                    foreach( $choices as $key => $online_shop_column_array ){
                        echo ' <option value="'.esc_attr( $key ).'" '.selected( $online_shop_img_size, $key, 0). '>'.esc_attr( $online_shop_column_array ).'</option>';
                    }
                    ?>
                </select>
            </p>
            <p>
                <small><?php esc_html_e( 'Note: Some of the features only work in "Home main content area" due to minimum width in other areas.' ,'online-shop'); ?></small>
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
            $instance[ 'online_shop_widget_title' ] = ( isset( $new_instance['online_shop_widget_title'] ) ) ? sanitize_text_field( $new_instance['online_shop_widget_title'] ) : '';

            $post_advanced_options = online_shop_post_advanced_options();
            $instance[ 'post_advanced_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'post_advanced_option' ], $post_advanced_options, 'recent' );

            $instance[ 'online_shop_post_cat' ] = ( isset( $new_instance['online_shop_post_cat'] ) ) ? absint( $new_instance['online_shop_post_cat'] ) : '';
            $instance[ 'online_shop_post_tag' ] = ( isset( $new_instance['online_shop_post_tag'] ) ) ? absint( $new_instance['online_shop_post_tag'] ) : '';
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );

            $online_shop_widget_display_types = online_shop_widget_display_type();
            $instance[ 'display_type' ] = online_shop_sanitize_choice_options( $new_instance[ 'display_type' ], $online_shop_widget_display_types, 'column' );

            $online_shop_post_orderby = online_shop_post_orderby();
            $instance[ 'orderby' ] = online_shop_sanitize_choice_options( $new_instance[ 'orderby' ], $online_shop_post_orderby, 'date' );

            $online_shop_post_order = online_shop_post_order();
            $instance[ 'order' ] = online_shop_sanitize_choice_options( $new_instance[ 'order' ], $online_shop_post_order, 'DESC' );

            $online_shop_link_options = online_shop_adv_link_options();
            $instance[ 'view_all_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'view_all_option' ], $online_shop_link_options, 'disable' );

            $instance[ 'all_link_text' ] = sanitize_text_field( $new_instance[ 'all_link_text' ] );
            $instance[ 'all_link_url' ] = esc_url_raw( $new_instance[ 'all_link_url' ] );
            $instance[ 'enable_prev_next' ] = isset($new_instance['enable_prev_next'])? 1 : 0;

            $online_shop_img_size = online_shop_get_image_sizes_options();
            $instance[ 'online_shop_img_size' ] = online_shop_sanitize_choice_options( $new_instance[ 'online_shop_img_size' ], $online_shop_img_size, 'large' );

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
            $online_shop_post_cat = esc_attr( $instance['online_shop_post_cat'] );
            $online_shop_post_tag = esc_attr( $instance['online_shop_post_tag'] );
            $online_shop_widget_title = !empty( $instance['online_shop_widget_title'] ) ? esc_attr( $instance['online_shop_widget_title'] ) : get_cat_name($online_shop_post_cat);
            $online_shop_widget_title = apply_filters( 'widget_title', $online_shop_widget_title, $instance, $this->id_base );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $display_type = esc_attr( $instance[ 'display_type' ] );
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );
            $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
            $all_link_text = esc_html( $instance[ 'all_link_text' ] );
            $all_link_url = esc_url( $instance[ 'all_link_url' ] );
            $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
            $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

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
                    $query_args['cat'] = $online_shop_post_cat;
                    break;

                case 'tag' :
                    $query_args['tag'] = $online_shop_post_tag;
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

            $online_shop_featured_query = new WP_Query( $query_args );

            if ($online_shop_featured_query->have_posts()) :
                echo $args['before_widget'];
                    echo $args['before_title'];
                    echo $online_shop_widget_title;
                    echo $args['after_title'];
                    ?>
                      <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">
                    <?php
                    $online_shop_featured_index = 1;
                    while ( $online_shop_featured_query->have_posts()) :$online_shop_featured_query->the_post();                        ?>
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
                    $online_shop_featured_index = 1;
                    while ( $online_shop_featured_query->have_posts()) :$online_shop_featured_query->the_post();                        ?>
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
    } // Class Online_Shop_Posts_Col ends here
}



if ( ! class_exists( 'newsfeed_cat_2' ) ) {
    class newsfeed_cat_2 extends WP_Widget {

        /*defaults values for fields*/
        private $defaults = array(
            'online_shop_widget_title' => '',
            'post_advanced_option' => 'recent',
            'online_shop_post_cat' => -1,
            'online_shop_post_tag' => -1,
            'post_number' => 7,
            'column_number' => 4,
            'display_type' => 'column',
            'orderby' => 'date',
            'order' => 'DESC',
            'view_all_option' => 'disable',
            'all_link_text' => '',
            'all_link_url' => '',
            'enable_prev_next' => 1,
            'online_shop_img_size' => 'large'
        );

        function __construct() {
            parent::__construct(
            /*Base ID of your widget*/
                'newsfeed_cat_2',
                /*Widget name will appear in UI*/
                esc_html__('category post 2', 'online-shop'),
                /*Widget description*/
                array( 'description' => esc_html__( 'Show posts from selected category with advanced options', 'online-shop' ), )
            );
        }

        /*Widget Backend*/
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults);
            $online_shop_widget_title = esc_attr( $instance['online_shop_widget_title'] );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $online_shop_post_cat = esc_attr( $instance['online_shop_post_cat'] );
            $online_shop_post_tag = esc_attr( $instance['online_shop_post_tag'] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $display_type = esc_attr( $instance[ 'display_type' ] );
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );
            $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
            $all_link_text = esc_attr( $instance['all_link_text'] );
            $all_link_url = esc_url( $instance['all_link_url'] );
            $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
            $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

            $choices = online_shop_get_image_sizes_options();
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>">
                    <?php esc_html_e( 'Title', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_widget_title' ) ); ?>" type="text" value="<?php echo $online_shop_widget_title; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_advanced_option' ) ); ?>"><?php esc_html_e( 'Show', 'online-shop' ); ?></label>
                <select class="widefat at-post-advanced-option" id="<?php echo esc_attr( $this->get_field_id( 'post_advanced_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_advanced_option' ) ); ?>" >
                    <?php
                    $post_advanced_options = online_shop_post_advanced_options();
                    foreach ( $post_advanced_options as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $post_advanced_option ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p class="post-cat post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_post_cat') ); ?>">
                    <?php esc_html_e('Select Category', 'online-shop'); ?>
                </label>
                <?php
                $online_shop_dropown_cat = array(
                    'show_option_none'   => false,
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $online_shop_post_cat,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('online_shop_post_cat'),
                    'id'                 => $this->get_field_id('online_shop_post_cat'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'category',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $online_shop_dropown_cat );
                ?>
            </p>
            <p class="post-tag post-select">
                <label for="<?php echo esc_attr( $this->get_field_id('online_shop_post_tag') ); ?>">
                    <?php esc_html_e('Select Tag', 'online-shop'); ?>
                </label>
                <?php
                $online_shop_dropown_cat = array(
                    'show_option_none'   => false,
                    'orderby'            => 'name',
                    'order'              => 'asc',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'echo'               => 1,
                    'selected'           => $online_shop_post_tag,
                    'hierarchical'       => 1,
                    'name'               => $this->get_field_name('online_shop_post_tag'),
                    'id'                 => $this->get_field_name('online_shop_post_tag'),
                    'class'              => 'widefat',
                    'taxonomy'           => 'post_tag',
                    'hide_if_empty'      => false,
                );
                wp_dropdown_categories( $online_shop_dropown_cat );
                ?>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>">
                    <?php esc_html_e( 'Number of posts to show', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo $post_number; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>"><?php esc_html_e( 'Column Number', 'online-shop' ); ?></label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'column_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'column_number' ) ); ?>" >
                    <?php
                    $online_shop_widget_column_numbers = online_shop_widget_column_number();
                    foreach ( $online_shop_widget_column_numbers as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $column_number ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>">
                    <?php esc_html_e( 'Display Type', 'online-shop' ); ?>
                </label>
                <select class="widefat at-display-select" id="<?php echo esc_attr( $this->get_field_id( 'display_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_type' ) ); ?>" >
                    <?php
                    $online_shop_widget_display_types = online_shop_widget_display_type();
                    foreach ( $online_shop_widget_display_types as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $display_type ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" >
                    <?php
                    $online_shop_post_orderby = online_shop_post_orderby();
                    foreach ( $online_shop_post_orderby as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $orderby ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>">
                    <?php esc_html_e( 'Order by', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" >
                    <?php
                    $online_shop_post_order = online_shop_post_order();
                    foreach ( $online_shop_post_order as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $order ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <hr /><!--view all link separate-->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>">
                    <?php esc_html_e( 'View all options', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'view_all_option' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_all_option' ) ); ?>" >
                    <?php
                    $online_shop_adv_link_options = online_shop_adv_link_options();
                    foreach ( $online_shop_adv_link_options as $key => $value ){
                        ?>
                        <option value="<?php echo esc_attr( $key )?>" <?php selected( $key, $view_all_option ); ?>><?php echo esc_html( $value );?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>">
                    <?php esc_html_e( 'All Link Text', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_text' ) ); ?>" type="text" value="<?php echo $all_link_text; ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>">
                    <?php esc_html_e( 'All Link Url', 'online-shop' ); ?>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'all_link_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'all_link_url' ) ); ?>" type="text" value="<?php echo $all_link_url; ?>" />
            </p>
            <hr />
            <p class="at-enable-prev-next">
                <input id="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'enable_prev_next' ) ); ?>" type="checkbox" <?php checked( 1 == $enable_prev_next ? $instance['enable_prev_next'] : 0); ?> />
                <label for="<?php echo esc_attr( $this->get_field_id( 'enable_prev_next' ) ); ?>"><?php esc_html_e( 'Enable Prev - Next on Carousel Column', 'online-shop' ); ?></label>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>">
                    <?php esc_html_e( 'Normal Featured Post Image', 'online-shop' ); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'online_shop_img_size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'online_shop_img_size' ) ); ?>">
                    <?php
                    foreach( $choices as $key => $online_shop_column_array ){
                        echo ' <option value="'.esc_attr( $key ).'" '.selected( $online_shop_img_size, $key, 0). '>'.esc_attr( $online_shop_column_array ).'</option>';
                    }
                    ?>
                </select>
            </p>
            <p>
                <small><?php esc_html_e( 'Note: Some of the features only work in "Home main content area" due to minimum width in other areas.' ,'online-shop'); ?></small>
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
            $instance[ 'online_shop_widget_title' ] = ( isset( $new_instance['online_shop_widget_title'] ) ) ? sanitize_text_field( $new_instance['online_shop_widget_title'] ) : '';

            $post_advanced_options = online_shop_post_advanced_options();
            $instance[ 'post_advanced_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'post_advanced_option' ], $post_advanced_options, 'recent' );

            $instance[ 'online_shop_post_cat' ] = ( isset( $new_instance['online_shop_post_cat'] ) ) ? absint( $new_instance['online_shop_post_cat'] ) : '';
            $instance[ 'online_shop_post_tag' ] = ( isset( $new_instance['online_shop_post_tag'] ) ) ? absint( $new_instance['online_shop_post_tag'] ) : '';
            $instance[ 'post_number' ] = absint( $new_instance[ 'post_number' ] );
            $instance[ 'column_number' ] = absint( $new_instance[ 'column_number' ] );

            $online_shop_widget_display_types = online_shop_widget_display_type();
            $instance[ 'display_type' ] = online_shop_sanitize_choice_options( $new_instance[ 'display_type' ], $online_shop_widget_display_types, 'column' );

            $online_shop_post_orderby = online_shop_post_orderby();
            $instance[ 'orderby' ] = online_shop_sanitize_choice_options( $new_instance[ 'orderby' ], $online_shop_post_orderby, 'date' );

            $online_shop_post_order = online_shop_post_order();
            $instance[ 'order' ] = online_shop_sanitize_choice_options( $new_instance[ 'order' ], $online_shop_post_order, 'DESC' );

            $online_shop_link_options = online_shop_adv_link_options();
            $instance[ 'view_all_option' ] = online_shop_sanitize_choice_options( $new_instance[ 'view_all_option' ], $online_shop_link_options, 'disable' );

            $instance[ 'all_link_text' ] = sanitize_text_field( $new_instance[ 'all_link_text' ] );
            $instance[ 'all_link_url' ] = esc_url_raw( $new_instance[ 'all_link_url' ] );
            $instance[ 'enable_prev_next' ] = isset($new_instance['enable_prev_next'])? 1 : 0;

            $online_shop_img_size = online_shop_get_image_sizes_options();
            $instance[ 'online_shop_img_size' ] = online_shop_sanitize_choice_options( $new_instance[ 'online_shop_img_size' ], $online_shop_img_size, 'large' );

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
            $online_shop_post_cat = esc_attr( $instance['online_shop_post_cat'] );
            $online_shop_post_tag = esc_attr( $instance['online_shop_post_tag'] );
            $online_shop_widget_title = !empty( $instance['online_shop_widget_title'] ) ? esc_attr( $instance['online_shop_widget_title'] ) : get_cat_name($online_shop_post_cat);
            $online_shop_widget_title = apply_filters( 'widget_title', $online_shop_widget_title, $instance, $this->id_base );
            $post_advanced_option = esc_attr( $instance[ 'post_advanced_option' ] );
            $post_number = absint( $instance[ 'post_number' ] );
            $column_number = absint( $instance[ 'column_number' ] );
            $display_type = esc_attr( $instance[ 'display_type' ] );
            $orderby = esc_attr( $instance[ 'orderby' ] );
            $order = esc_attr( $instance[ 'order' ] );
            $view_all_option = esc_attr( $instance[ 'view_all_option' ] );
            $all_link_text = esc_html( $instance[ 'all_link_text' ] );
            $all_link_url = esc_url( $instance[ 'all_link_url' ] );
            $enable_prev_next = esc_attr( $instance['enable_prev_next'] );
            $online_shop_img_size = esc_attr( $instance['online_shop_img_size'] );

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
                    $query_args['cat'] = $online_shop_post_cat;
                    break;

                case 'tag' :
                    $query_args['tag'] = $online_shop_post_tag;
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

            $online_shop_featured_query = new WP_Query( $query_args );

            if ($online_shop_featured_query->have_posts()) :
                echo $args['before_widget'];
                    echo $args['before_title'];
                    echo $online_shop_widget_title;
                    echo $args['after_title'];
                    ?>
                      <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">
                    <?php
                    $online_shop_featured_index = 1;
                    while ( $online_shop_featured_query->have_posts()) :$online_shop_featured_query->the_post();                        ?>
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
                    $online_shop_featured_index = 1;
                    while ( $online_shop_featured_query->have_posts()) :$online_shop_featured_query->the_post();                        ?>
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
    } // Class Online_Shop_Posts_Col ends here
}