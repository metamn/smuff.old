<?php
  $cat = category_id(true, false, null);
  $args = array (
    'posts_per_page' => 8,
    'category__and' => array(15, $cat)
  );
  $promo_posts = query_posts2($args);
  
  $args = array (
    'posts_per_page' => 6,
    'category__and' => array(715, $cat) /* 14 */
  );
  $top_sales = query_posts2($args);  
  
  $args = array (
    'posts_per_page' => 6,
    'category__and' => array(10, $cat)
  );
  $new_products = query_posts2($args);
  
  // deal of the week  
  $dow_posts = query_posts2('posts_per_page=1&cat=2135');
?>

<div id="home" class="block">  
  <div id="content" class="column span-18">   
    <?php if ($new_products->have_posts()) {
        include "home-hot.php";
      } else {
        echo '<h2>&nbsp;</h2><h2>Inca nu sunt produse in aceasta categorie</h2>';
      }?>     
           
    <?php if ($top_sales->have_posts()) { include "home-bestsellers.php"; } ?> 
    <?php if ($promo_posts->have_posts()) { include "home-promo.php"; }  ?>
    <?php include "home-ecosystem.php" ?>        
  </div>  
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
