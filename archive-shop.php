<?php
  $cat = category_id(true, false);
  $args = array (
    'posts_per_page' => 8,
    'category__and' => array(15, $cat)
  );
  $promo_posts = query_posts2($args);
  
  $args = array (
    'posts_per_page' => 6,
    'category__and' => array(14, $cat)
  );
  $top_sales = query_posts2($args);  
  
  $args = array (
    'posts_per_page' => 6,
    'category__and' => array(10, $cat)
  );
  $new_products = query_posts2($args);
?>

<div id="home" class="block">  
  <div id="content" class="column span-18">
    <?php include "home-description.php"; ?>
    <?php include "home-hot.php"; ?> 
    <?php include "home-bestsellers.php"; ?> 
    <?php include "home-promo.php"; ?>
    <?php include "home-ecosystem.php" ?> 
  </div>  
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
