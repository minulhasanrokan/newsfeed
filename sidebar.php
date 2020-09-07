<div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <!--populer post display-->
            <?php if (is_active_sidebar('post-1')):?>
              <?php dynamic_sidebar('post-1'); ?>
            <?php endif; ?>
          </div>
          <!-- sponser add image-->
          <style type="text/css">
                .image{
                  width: 100% !important;
                }
          </style>
          <?php if (is_active_sidebar('Sponsor-1')):?>
              <?php dynamic_sidebar('Sponsor-1'); ?>
          <?php endif; ?>
          <!--category -->
          <?php if (is_active_sidebar('cat-1')):?>
              <?php dynamic_sidebar('cat-1'); ?>
          <?php endif; ?>
          <!--page link-->
         <?php if (is_active_sidebar('page-1')):?>
              <?php dynamic_sidebar('page-1'); ?>
          <?php endif; ?>
        </aside>
      </div>