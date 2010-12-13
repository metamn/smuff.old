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
  $promo_posts = query_posts2('posts_per_page=8&cat=15');
  $top_sales = query_posts2('posts_per_page=6&cat=715');  /* 14 */
  $new_products = query_posts2('posts_per_page=15&cat=10');
  
  $special_posts = query_posts2('posts_per_page=1&cat=1318');
?>


<div id="home" class="block">
  <div class="block">
    <div id="content" class="column span-18">         	                      
      <?php if ($new_products->have_posts()) {
          include "home-hot.php";
        } else {
          echo '<h2>&nbsp;</h2><h2>Inca nu sunt produse in magazin.</h2>';
        }?>        
      <?php if ($top_sales->have_posts()) { include "home-bestsellers.php"; } ?> 
      <?php if ($promo_posts->have_posts()) { include "home-promo.php"; }  ?>
      <?php include "home-ecosystem.php" ?>    
    </div>  
    <?php get_sidebar(); ?>
  </div>  
</div>

<?php get_footer(); ?>
