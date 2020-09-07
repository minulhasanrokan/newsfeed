<footer id="footer">
    <div class="footer_top">
      <div class="row">
        <!--footer fliket image widgets-->
          <?php if (is_active_sidebar('footer-1')):?>
              <?php dynamic_sidebar('footer-1'); ?>
          <?php endif; ?>
        <!--footer tag widgets-->
          <?php if (is_active_sidebar('footer-2')):?>
              <?php dynamic_sidebar('footer-2'); ?>
          <?php endif; ?>
        <!--footer contact info widgets-->
          <?php if (is_active_sidebar('footer-3')):?>
              <?php dynamic_sidebar('footer-3'); ?>
          <?php endif; ?>
      </div>
    </div>
    <!--copy right template-->
    <?php get_template_part( 'template_part/copyright', 'newsfeed' ); ?>
  </footer>
</div>
<?php wp_footer();?>
</body>
</html>