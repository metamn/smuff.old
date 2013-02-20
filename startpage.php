<?php
  /*
  Template Name: Startpage
   * @package WordPress
   * @subpackage Default_Theme
   */

  get_header();
?>


<section id="campaigns">
  <nav id="navigation">
    <h3 class="outline">Navigare</h3>
    <ul>
      <li id="left"></li>
      <li id="right"></li>
    </ul>
  </nav>
  
  <header id="title">
    <h2>Campanii</h2>
  </header>
</section>


<?php 
  // Promo
  $promo_posts = query_posts2('posts_per_page=4&cat=15');
 
  $product_list = $promo_posts;
  $product_list_title = 'Reduceri';
  $product_list_id = 'sales';
  
  $show_category = false;
  include 'product-list.php';
?>

  
<?php include 'c_giftshopper.php' ?>



<?php get_footer(); ?>
