<?php
/**
* Template Name: contact template
*
*/
?> 
<?php get_header();?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="contact_area">
            <h2><?php the_title();?></h2>
            <?php echo the_content();?>
          </div>
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </section>
    <?php get_footer();?>