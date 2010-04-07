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
  $promo_posts = query_posts2('posts_per_page=6&cat=49');
  $top_sales = query_posts2('posts_per_page=5&cat=50');
  $news_posts = query_posts2('posts_per_page=3&cat=17');
    
  $sticky_posts = query_posts2('posts_per_page=1&cat=103');
  if ($sticky_posts->have_posts()) {
    while ($sticky_posts->have_posts()) : $sticky_posts->the_post(); update_post_caches($posts); 
      $sticky_post = $post;
      break;            
    endwhile; 
  }       
?>


<div id="home" class="block">
  <div id="content" class="column span-18">    	  
    <?php include "home-all-products-link.php"; ?>            
    <?php include "home-promo.php"; ?> 
    <?php include "home-news.php"; ?>    
  </div>
  
  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
