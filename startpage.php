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
    'posts_per_page' => 7,
    'cat' => 10
  ));
  
  
  // Bestsellers
  $args = array();
  $args['posts_per_page'] = '6';
  
  $t = get_term_by('slug', 'cele-mai-vandute-saptamana-trecuta', 'category');
  $args['category__and'] = array(8, $t->term_id);
  $top_sales_last_week = query_posts2($args);
  
  $t = get_term_by('slug', 'cele-mai-vandute-luna-trecuta', 'category');
  $args['category__and'] = array(8, $t->term_id);
  $top_sales_last_month = query_posts2($args);
  
  $t = get_term_by('slug', 'cele-mai-vandute-in-ultimele-trei-luni', 'category');
  $args['category__and'] = array(8, $t->term_id);
  $top_sales_last_three_months = query_posts2($args);
  
  
  // Promo
  $promo_posts = query_posts2('posts_per_page=7&cat=15');
  
  
  // Anouncements
  $anouncements = query_posts2('posts_per_page=1&cat=1317');
 ?>
 
 
 <nav id="startpage-main-menu" class='tab'>
  <ul>
    <li><h2 id="new-products">Noutati</h2></li>
    <li><h2 id="bestsellers">Cele mai vandute</h2></li>
    <li><h2 id="sales">Reduceri</h2></li>
  </ul>
 </nav>



<?php 

  /*
  // Banners, news, campaigns
  $product_list = $anouncements;
  $product_list_title = '';
  $product_list_id = 'anouncements';
  $image_size = 'large';
  include 'product-list.php';
  */
  
  
  
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
    $product_list_id = 'bestsellers';
    include 'product-list.php';
    
    $product_list = $top_sales_last_month;
    $product_list_title = 'Ultima luna';
    $product_list_id = 'bestsellers';
    include 'product-list.php';
    
    $product_list = $top_sales_last_three_months;
    $product_list_title = 'Ultimele trei luni';
    $product_list_id = 'bestsellers';
    include 'product-list.php';
  echo "</section>";
  
  
  // Sales
  $product_list = $promo_posts;
  $product_list_title = 'Reduceri';
  $product_list_id = 'sales';
  include 'product-list.php';
?>


<?php get_footer(); ?>
