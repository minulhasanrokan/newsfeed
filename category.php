<?php get_header();?>
<!--slider-->
<?php if ( is_home() && ! is_front_page() ) { ?>
  <?php get_template_part( 'template_part/slider', 'newsfeed' ); ?>
<!--latest post-->
<?php get_template_part( 'sidebar-Latest-post', 'newsfeed' ); ?>
<!--home page template part-->
  <?php get_template_part( 'template_part/category_template', 'newsfeed' ); ?>

<?php } else{?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="fashion_technology_area">
            <div style="width:100%;" class="fashion">
              <?php if(have_posts()): while (have_posts()): the_post(); ?>
                  <div class="post-box">
                      <div class="inner-post-box">
                          <div class="image-box col-md-5">
                              <a href="<?php the_permalink();?>">
                                  <img class="img-responsive transition7s" title="" alt="" class="wp-post-image" src="<?=wp_get_attachment_url( get_post_thumbnail_id()); ?>" style="width:100%; height:210px;">
                              </a>
                          </div>
                          <div class="col-md-7 content">
                              <h3><a href="<?php the_permalink();?>"> <?php the_title();?>  </a></h3>
                              <div class="text-des">
                                  <?php if (strlen("the_content()") > 300) { ?>
                                         <?php the_content(); ?>
                                     <?php } if (strlen("the_content()") < 300) { ?>
                                         <?php echo substr(get_the_content(), 0, 300); ?>
                                     <?php } ?>  
                              </div>
                          </div>
                          <div class="post-info clearfix">
                              <div class="pull-left">
                              <a class="btn btn-primary transition7s" href="<?php the_permalink();?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></a>
                              </div>
                              <div class="pull-right">
                              <a class="btn btn-primary transition7s" href="<?php the_permalink();?>">Read More</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="clearfix"></div> 
                   <?php endwhile;?>
                   <style type="text/css">
                     .navigation{
                      margin-bottom: 20px;
                     }
                   </style>
                   <?php newsfeed_posts_nav(); ?>
                <?php else : get_template_part( 'template_part/404', 'newsfeed' );?>
               <?php endif;?>
            </div>
          </div>
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </section>
<?php }?>
  <?php get_footer();?>
