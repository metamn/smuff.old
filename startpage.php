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
    'posts_per_page' => 15,
    'cat' => 10
  ));
  
  
  // Bestsellers
  $args = array();
  $args['posts_per_page'] = '6';
  
  $t = get_term_by('slug', 'cele-mai-vandute-saptamana-trecuta', 'category');
  $args['category__and'] = array(14, $t->term_id);
  $top_sales_last_week = query_posts2($args);
  
  $t = get_term_by('slug', 'cele-mai-vandute-luna-trecuta', 'category');
  $args['category__and'] = array(14, $t->term_id);
  $top_sales_last_month = query_posts2($args);
  
  $t = get_term_by('slug', 'cele-mai-vandute-in-ultimele-trei-luni', 'category');
  $args['category__and'] = array(14, $t->term_id);
  $top_sales_last_three_months = query_posts2($args);
  
  
  // Promo
  $promo_posts = query_posts2('posts_per_page=8&cat=15');
  
  
  // Anouncements
  $anouncements = query_posts2('posts_per_page=1&cat=1317');
 ?>



<?php 

  // Banners, news, campaigns
  $product_list = $anouncements;
  $product_list_title = '';
  $product_list_id = 'anouncements';
  $image_size = 'large';
  include 'product-list.php';

  
  // New products
  $product_list = $new_products;
  $product_list_title = 'Noutati';
  $product_list_id = 'new-products';
  $image_size = 'medium';
  include 'product-list.php';
  
  
  // Bestsellers
  echo "<section id='bestsellers'>";
    $product_list = $top_sales_last_week;
    $product_list_title = 'Ultima saptamana';
    $product_list_id = 'bestsellers-last-week';
    include 'product-list.php';
    
    $product_list = $top_sales_last_month;
    $product_list_title = 'Ultima luna';
    $product_list_id = 'bestsellers-last-month';
    include 'product-list.php';
    
    $product_list = $top_sales_last_three_months;
    $product_list_title = 'Ultimele trei luni';
    $product_list_id = 'bestsellers-last-three-months';
    include 'product-list.php';
  echo "</section>";
  
  
  // Sales
  $product_list = $promo_posts;
  $product_list_title = 'Reduceri';
  $product_list_id = 'sales';
  $image_size = 'thumbnail';
  include 'product-list.php';
?>


<?php get_footer(); ?>
