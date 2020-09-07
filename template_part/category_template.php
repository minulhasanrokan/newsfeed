<div class="clearfix"></div>
<section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <?php if (is_active_sidebar('cat1-2')):?>
              <?php dynamic_sidebar('cat1-2'); ?>
                <?php endif; ?>	         
				<div class="fashion_technology_area">
				<?php if (is_active_sidebar('cat-2')):?>
				<?php dynamic_sidebar('cat-2'); ?>
				<?php endif; ?>
				<?php if (is_active_sidebar('cat-3')):?>
				<?php dynamic_sidebar('cat-3'); ?>
				<?php endif; ?>
				</div>
                <?php if (is_active_sidebar('cat-4')):?>
              <?php dynamic_sidebar('cat-4'); ?>
          <?php endif; ?>
          
        </div>
      </div>
      <?php get_sidebar(); ?>
    </div>
  </section>