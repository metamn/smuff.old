<?php
  /*
  Template Name: Startpage
   * @package WordPress
   * @subpackage Default_Theme
   */

  get_header();
?>



<?php include 'c_banners.php' ?>

<?php 
  // Promo
  $promo_posts = query_posts2('posts_per_page=4&cat=15');
 
  $product_list = $promo_posts;
  $product_list_title = 'Reduceri';
  $product_list_id = 'sales';
  
  $show_category = false;
  $show_excerpt = false;
  include 'product-list.php';
?>

  
<?php include 'c_giftshopper.php' ?>
<?php include 'c_categories.php' ?>


<?php get_footer(); ?>
