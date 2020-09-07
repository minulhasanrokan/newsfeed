<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title></title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--[if lt IE 9]>
<script src="../assets/js/html5shiv.min.js"></script>
<script src="../assets/js/respond.min.js"></script>
<![endif]-->
<?php
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
          wp_enqueue_script( 'comment-reply' );
      }
?>
<?php wp_head();?>
</head>
<body <?php body_class(); ?> style="margin-top: -20PX;">
<?php wp_body_open(); ?>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <?php get_template_part( 'template_part/menu', 'newsfeed' ); ?>
  <!-- latest post section-->