<?php
  /*
  Template Name: Startpage
   * @package WordPress
   * @subpackage Default_Theme
   */

  get_header();
?>



<?php 

  // New
  $new_products = query_posts2( array(
    'posts_per_page' => 1,
    'cat' => 10
  ));
  
  $product_list = $new_products;
  $product_list_title = 'Noutati';
  $product_list_id = 'new-products';
  include 'product-list.php';



  // Promo
  $promo_posts = query_posts2('posts_per_page=4&cat=15');
 
  $product_list = $promo_posts;
  $product_list_title = 'Reduceri';
  $product_list_id = 'sales';
  
  $show_category = false;
  include 'product-list.php';
?>

  
<?php include 'c_giftshopper.php' ?>



<section id="subscribe">
  <div id="body">
    <?php include 'c_subscribe-to-newsletter.php' ?>
  </div>
</section>


<?php get_footer(); ?>
