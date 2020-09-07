<?php get_header();?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="fashion_technology_area">
            <div style="width:100%;" class="fashion">
              <?php if(have_posts()): while (have_posts()): the_post(); ?>
                <h2 style="width: 100%;padding: 10px; margin: 0 auto"><?php the_title()?></h2>
                  <?php the_content()?>
                  
                  <div class="clearfix"></div> 
                   <?php endwhile;?>
                <?php else : get_template_part( 'template_part/404', 'newsfeed' );?>
               <?php endif;?>
               <?php wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </section>
  <?php get_footer();?>