
<div class="social_area">
  <ul class="social_nav">
    <!--facebook social link-->
    <li class="facebook"><a href="<?php 
        $facebook = get_theme_mod('newsfeed-facebook-display');
        if ($facebook != '') {
            echo esc_url($facebook);
        } ?>"> </a></li>
    <!--twitter social link-->
    <li class="twitter"><a href="<?php 
        $twitter = get_theme_mod('newsfeed-twitter-display');
        if ($twitter != '') {
            echo esc_url($twitter);
        }  ?>"></a></li>
    <!--flickr social link-->
    <li class="flickr"><a href="<?php 
        $flickr = get_theme_mod('newsfeed-flickr-display');
        if ($flickr != '') {
            echo esc_url($flickr);
        } ?>">
    </a></li>
    <!--pinterest social link-->
    <li class="pinterest"><a href="<?php 
        $pinterest = get_theme_mod('newsfeed-pinterest-display');
        if ($pinterest != '') {
            echo esc_url($pinterest);
        } ?>">
    </a></li>
    <!--googleplus social link-->
    <li class="googleplus"><a href="<?php 
        $googleplus = get_theme_mod('newsfeed-latestnew-display');
        if ($googleplus != '') {
            echo esc_url($googleplus);
        } ?>">
    </a></li>
    <!--vimeo social link-->
    <li class="vimeo"><a href="<?php 
        $vimeo = get_theme_mod('newsfeed-vimeo-display');
        if ($vimeo != '') {
            echo esc_url($vimeo);
        } ?>"></a></li>
    <!--youtube social link-->
    <li class="youtube"><a href="<?php 
        $youtube = get_theme_mod('newsfeed-youtube-display');
        if ($youtube != '') {
            echo esc_url($youtube);
        } ?>"></a></li>
    <!--mail social link-->
    <li class="mail"><a href="<?php 
        $mail = get_theme_mod('newsfeed-mail-display');
        if ($mail != '') {
            echo esc_url($mail);
        }?>"></a></li>
  </ul>
</div>
