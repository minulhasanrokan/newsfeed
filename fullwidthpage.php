<?php
/**
 * Template Name: Cover Template
 * Template Post Type:  page
 */
?>
<?php get_header();?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="left_content">
          <div class="fashion_technology_area">
            <div style="width:100%;" class="fashion">
              <?php if(have_posts()): while (have_posts()): the_post(); ?>
                <h2 style="width: 100%; text-align: center;background: gray;padding: 10px; margin: 0 auto"><?php the_title()?></h2>
                  <?php the_content()?>
                  
                  <div class="clearfix"></div> 
                   <?php endwhile;?>
                <?php else : get_template_part( 'template_part/404', 'newsfeed' );?>
               <?php endif;?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php get_footer();?>