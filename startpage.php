<?php
  /*
  Template Name: Startpage
   * @package WordPress
   * @subpackage Default_Theme
   */

  get_header();
?>

<?php 
  // Multiple loops 
  // - only for content
  // - sidebar posts are queryied in sidebar
  $promo_posts = query_posts2('posts_per_page=8&cat=49');
  $top_sales = query_posts2('posts_per_page=6&cat=50');  
  $new_products = query_posts2('posts_per_page=6&cat=47');
?>


<div id="home" class="block">
  <div class="block">
    <div id="content" class="column span-18">    	                
      <?php include "home-description.php"; ?> 
      <?php include "home-hot.php"; ?> 
      <?php include "home-bestsellers.php"; ?> 
      <?php include "home-promo.php"; ?>
      <?php include "home-ecosystem.php" ?>    
    </div>  
    <?php get_sidebar(); ?>
  </div>  
</div>

<?php get_footer(); ?>
