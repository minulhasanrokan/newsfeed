<div class="col-lg-8 col-md-8 col-sm-8">
  <div class="slick_slider">
    <?php if(have_posts()): while (have_posts()): the_post(); ?>
    <div class="single_iteam"> <a href="<?php the_permalink();?>"> <img src="<?=wp_get_attachment_url( get_post_thumbnail_id()); ?>" alt=""></a>
      <div class="slider_article">
        <h2><a class="slider_tittle" href="<?php the_permalink();?>"><?php the_title();?></a></h2>
        <?php if (strlen("the_content()") > 200) { ?>
           <?php the_content(); ?>
       <?php } if (strlen("the_content()") < 200) { ?>
           <?php echo substr(get_the_content(), 0, 200); ?>
       <?php } ?>  
      </div>
    </div>
    <?php endwhile;?>
    <?php endif;?>
    <?php wp_reset_postdata(); ?>
  </div>
</div>
</div>