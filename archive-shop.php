<?php
  $cat = category_id(true, false);
  $args = array (
    'posts_per_page' => 6,
    'category__and' => array(49, $cat)
  );
  $promo_posts = query_posts2($args);
  $args = array (
    'posts_per_page' => 5,
    'category__and' => array(50, $cat)
  );
  $top_sales = query_posts2($args);
  $news_posts = query_posts2('posts_per_page=3&cat=17');  
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
