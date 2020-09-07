<div class="related_post">
  <h2>Related Post <i class="fa fa-thumbs-o-up"></i></h2>
  <ul class="spost_nav wow fadeInDown animated">
  	<!--related post-->
  	<?php
	    $tags = wp_get_post_tags($post->ID);
	    if ($tags) {
	        $first_tag = $tags[0]->term_id;
	        $my_query = new WP_Query(array(
	                'tag__in' => array($first_tag),
	                'post__not_in' => array($post->ID),
	                'posts_per_page'=>3,
	                'caller_get_posts'=>1
	            ));
	        if( $my_query->have_posts() ) {
	            while ($my_query->have_posts()) : $my_query->the_post();
	     ?>
    <li>
      <div class="media"> <a class="media-left" href="<?php the_permalink();?>"> <img src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt=""> </a>
        <div class="media-body">
        	 <a class="catg_title" href="<?php the_permalink();?>"> <?php the_title();?>
   			</a> 
		</div>
      </div>
    </li>
    <?php
	    endwhile;
	    }
	    wp_reset_query();
	    }           
	 ?> 
  </ul>
</div>