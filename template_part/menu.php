<header id="header">
    <div class="row">
      <div  class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <nav style="margin: 0 auto;" class="navbar navbar-inverse" role="navigation">
              <!--Top Bar menu-->
                <?php
                  wp_nav_menu( array(
                      'theme_location'    => 'header-menu',
                      'depth'             => 2,
                      'container'         => 'div',
                      'container_class'   => 'collapse navbar-collapse',
                      'container_id'      => 'bs-example-navbar-collapse-1',
                      'menu_class'        => 'nav navbar-nav',
                      'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                      'walker'            => new WP_Bootstrap_Navwalker(),
                      'items_wrap'          => '<ul class="nav navbar-nav main_nav">%3$s</ul>',
                  ) );
                ?>
            </nav>
          </div>
          <div class="header_top_right">
            <!--current date-->
            <p><?php echo date("l , F, j, Y"); ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
          <div class="logo_area"><a href="index.html" class="logo">
            <?php
              $custom_logo_id = get_theme_mod( 'custom_logo' );
              $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
              if ( has_custom_logo() ) {
                    the_custom_logo();
              } else {
                      echo '<h4>'. get_bloginfo( 'name' ) .'</h4>';
            ?>
            <p>
              <?php echo bloginfo( 'description' ); ?>
            </p>
            <?php
                }
            ?>
          </a>
          </div>
          <!--banner image widgets-->
          <?php if (is_active_sidebar('banner-1')):?>
              <?php dynamic_sidebar('banner-1'); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </header>
  <section class="sticky" id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="<?php echo get_home_url(); ?>"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
        </ul>
        <!--main/primary menu-->
        <?php
          wp_nav_menu( array(
              'theme_location'    => 'header-menu',
              'depth'             => 2,
              'container'         => 'div',
              'container_class'   => 'collapse navbar-collapse',
              'container_id'      => 'bs-example-navbar-collapse-1',
              'menu_class'        => 'nav navbar-nav',
              'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
              'walker'            => new WP_Bootstrap_Navwalker(),
              'items_wrap'          => '<ul class="nav navbar-nav main_nav">%3$s</ul>',
          ) );
          ?>
    </nav>
  </section>