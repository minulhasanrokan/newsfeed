<div style="float: left;" class="footer_bottom">
	<!--copy right customizer-->
  <?php if (get_theme_mod('newsfeed-footer-copyright-section-display') == 'Yes') { ?>
   <?php 
        $copyrightText = get_theme_mod('newsfeed-footer-copyright-section-text');
        if ($copyrightText != '') {
            echo wpautop($copyrightText);
        } else {
            echo "Edit this by going to your Dashboard -> Appearance -> Customise -> Copy Right Section";
        }
    ?>
  <?php } ?>
</div>