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
  
  // products filed under 'Nou-2' are excluded!
  $new_products = query_posts2( array(
    'posts_per_page' => 15,
    'cat' => 10,
    'category__not_in' => array(1694)
  ));
  
  
  $top_sales = query_posts2('posts_per_page=6&cat=14');  /* 14 */
  
  
  $promo_posts = query_posts2('posts_per_page=8&cat=15');
  
  // deal of the week  
  //$dow_posts = query_posts2('posts_per_page=1&cat=2135'); /* 2135, 2101 */
  
  // gift of the week  
  //$gow_posts = query_posts2('posts_per_page=1&cat=2163'); /* 2135, 2101 */
  
  // - Special posts are put first on HOT
  $special_posts = query_posts2('posts_per_page=1&cat=1317');
  
  // - Collections are put in between Hot & Bestsellers
  // - Collections are items who are filed under Stiri + Collections category
  $collections = query_posts2( array( 'category__and' => array( 22, 1695 ) ) );
?>


<div id="home" class="block">
  <div class="block">
    <div id="content" class="column span-18">   
    
    
    	<?php 
    		$collection_banner_size = 0;
    		if ($collections->have_posts()) { include "home-collections.php"; } ?>
    	
      <?php if ($new_products->have_posts()) {
          include "home-hot.php";
        } else {
          echo '<h2>&nbsp;</h2><h2>Inca nu sunt produse in magazin.</h2>';
        }?>        
   
      <?php if ($top_sales->have_posts()) { include "home-bestsellers.php"; } ?> 
      <?php if ($promo_posts->have_posts()) { include "home-promo.php"; }  ?>

      
    </div>  
    <?php get_sidebar(); ?>
  </div>  
</div>

<?php get_footer(); ?>
