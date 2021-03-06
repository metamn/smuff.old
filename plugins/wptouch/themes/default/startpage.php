<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>

<?php 
  // Multiple loops 
  // - only for content
  // - sidebar posts are queryied in sidebar
  $promo_posts = query_posts2('posts_per_page=8&cat=15');
  $top_sales = query_posts2('posts_per_page=6&cat=14');  
  $new_products = query_posts2('posts_per_page=6&cat=10');
  $news = query_posts2('posts_per_page=5&cat=22');
  $klass = "post";
?>


<div class="content startpage">
  <div id="menu">
    <ul class="inline-list">
      <?php 
        $cats = array("gadget", "gizmo", "lifestyle", "self-care", "eco", "ceasuri", "doar-copii");		            
        foreach ($cats as $cat) { 
          $c = get_category_by_slug($cat);
        ?>
          <li><a href="<?php echo get_category_link($c->term_id)?>?view=1" ><?php echo $c->name ?></a></li>
      <?php } ?>
    </ul>
  </div>	
  <div id="navigation">
    <ul class="inline-list">
      <li><a href="<?php bloginfo('home'); ?>/#noutati">Noutati</a></li>
      <li><a href="<?php bloginfo('home'); ?>/#bestsellers">Bestsellers</a></li>
      <li><a href="<?php bloginfo('home'); ?>/#promo">Promotii</a></li>
    </ul>
  </div>  
  <div class="clearer"></div>
   
  <div id="noutati">
    <h2>Noutati</h2>
    <?php if ($new_products) { 
      while ($new_products->have_posts()) : $new_products->the_post(); update_post_caches($posts); 
        include "product.php";
      endwhile; } ?>
    <p>
      <a class='ajax' href="<?php bloginfo('home'); ?>/category/produse/?view=2">Vezi toate produsele Smuff &rarr;</a>
    </p>    
  </div>
  <div id="bestsellers">
    <h2>Bestsellers</h2>
    <?php if ($top_sales) { 
      while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
        include "product.php";
      endwhile; } ?>
    <p>
      <a class='ajax' href="<?php bloginfo('home'); ?>/category/meta/produse-populare">Vezi toate produsele populare &rarr;</a>
    </p>
  </div>
  <div id="promo">
    <h2>Promotii</h2>
    <?php if ($promo_posts) { 
      while ($promo_posts->have_posts()) : $promo_posts->the_post(); update_post_caches($posts); 
        include "product.php";
      endwhile; } ?>
    <p>
      <a class='ajax' href="<?php bloginfo('home'); ?>/category/meta/promotii">Vezi toate promotiile &rarr;</a>
    </p>
  </div>
  <div id="stiri">
    <?php if ($news) { ?>
      <h2>Stiri</h2>
      <ul>
        <?php 
          while ($news->have_posts()) : $news->the_post(); update_post_caches($posts); ?>
            <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a>
             (
             <small><?php the_time('j M Y') ?> ora <?php the_time('G:i') ?></small>
             )
            </li>
          <?php endwhile; ?>
      </ul>
      <p>
        <a class='ajax' href="<?php bloginfo('home'); ?>/category/stiri">Vezi toate stirile Smuff &rarr;</a>
      </p>
    <?php } ?>    
  </div>
</div>

<!-- If it's ajax, we're not bringing in footer.php -->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>
