
<?php if (get_theme_mod('newsfeed-latestnews-display') == 'Yes') { ?>
<section id="newsSection">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <div class="latest_newsarea"> <span>
        <?php 
        $latestpostText = get_theme_mod('newsfeed-latestnew-display');
        if ($latestpostText != '') {
            echo $latestpostText;
        } else {
            echo "Edit this by going to your Dashboard -> Appearance -> Customise -> Latest Post Section";
        }
        ?>
      </span>
        <ul id="ticker01" class="news_sticker">
          <?php if(have_posts()): while (have_posts()): the_post(); ?>
          <li><a href="<?php the_permalink();?>"><img src="<?=wp_get_attachment_url( get_post_thumbnail_id()); ?>" alt=""><?php the_title();?></a></li>
          <?php endwhile;?>
          <?php endif;?>
        </ul>
        <?php get_template_part( 'template_part/sociallink', 'newsfeed' );?>
      </div>
    </div>
  </div>
</section>
<?php } ?>
