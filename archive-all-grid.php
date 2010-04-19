<?php
// get all posts, not just 10/page
  $cat = category_id(true, false);    
  $all_posts = query_posts2('posts_per_page=-1&cat='.$cat);
  
?>

<div id="archive-all" class="block">  
  <div id="content" class="column span-18 content">
    <div id='title' class='block'>
      <div id="left" class="column span-14 last">
        <h2>Toate produsele</h2>
      </div>
      <div id="right" class="column span-4 last">
        Lista | 
        <?php 
          $title = 'Tabela';
          $link_type = '2'; // 2=table view, 3=grid view
          include "home-all-products-link.php";
        ?>
      </div>
    </div>
    
    <?php if ($all_posts->have_posts()) : ?>
      <div id="archive-all-grid" class="block">
      <?php while ($all_posts->have_posts()) : $all_posts->the_post(); update_post_caches($posts); 
		    $product_id = product_id($post->ID);
        $product_price = product_price($post->ID);
        $product_name = product_name($product_id); 
        $product_stoc = product_stock($product_id);
        $imgs = post_attachements($post->ID);
        $img = $imgs[0];  
        $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
		  ?>
		    <div id="item" class="column span-6 last">
		      <?php include "product-thumb.php"?>
		    </div>
		  <?php endwhile; ?>
		  <p class="alignright">
		    <?php echo $all_posts->post_count . ' produse. ' ?>
		    <a href="#archive-all">[ &uarr; Top ]</a>
		  </p>		  	  
		<?php else : 
      include "not-found.php";  
	  endif; ?>
  </div>
  
  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
