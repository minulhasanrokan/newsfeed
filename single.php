<?php get_header();?>
  <section id="contentSection">
    <div class="row">
      <?php if(have_posts()): while (have_posts()): the_post(); ?>
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
            <h1><?php the_title();?></h1>
            <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?php the_author_posts_link();?></a> <span><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></span></div>
            <div class="single_page_content"> <img style="width: 100%;" class="img-center" src="<?=wp_get_attachment_url( get_post_thumbnail_id() ); ?>" alt="">
              <?php the_content();?>
            </div>
            <!--dispaly display comment section-->
            <?php get_template_part( 'template_part/comments', 'newsfeed' ); ?>
            <!--dispaly related post-->
            <?php get_template_part( 'template_part/relatedpost', 'newsfeed' ); ?>
          </div>
        </div>
      </div>
      <?php endwhile;?>
      <?php endif;?>
      <?php wp_reset_postdata(); ?>
      <?php get_sidebar(); ?>
    </div>
  </section>
  <?php get_footer();?>