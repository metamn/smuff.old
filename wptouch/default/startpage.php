<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>

<?php 
  // Multiple loops 
  // - only for content
  // - sidebar posts are queryied in sidebar
  $promo_posts = query_posts2('posts_per_page=8&cat=15');
  $top_sales = query_posts2('posts_per_page=6&cat=14');  
  $new_products = query_posts2('posts_per_page=6&cat=10');
?>


<div class="content startpage">
  <div id="menu">
    <ul class="inline-list">
      <?php 
        $cats = get_categories('child_of=10');
        foreach ($cats as $c) { ?>
          <li><a href="<?php echo get_category_link($c->term_id)?>?view=1" ><?php echo $c->name ?></a></li>
        <?php } ?>
    </ul>
  </div>	
  <div id="navigation">
    <ul class="inline-list">
      <li><a href="">Noutati</a></li>
      <li><a href="">Bestsellers</a></li>
      <li><a href="">Promotii</a></li>
    </ul>
  </div>
  
  <div class="clearer"></div>
  
  <div id="noutati">
    <h2>Noutati</h2>
    <?php 
      $products = $new_products;
      include "product.php";
    ?>
  </div>
  <div id="bestsellers">
    <h2>Bestsellers</h2>
    <?php 
      $products = $top_sales;
      include "product.php";
    ?>
  </div>
  <div id="promo">
    <h2>Promotii</h2>
    <?php 
      $products = $promo_posts;
      include "product.php";
    ?>
  </div>
</div>

<!-- If it's ajax, we're not bringing in footer.php -->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>
