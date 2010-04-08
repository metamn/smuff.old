<div id="top-sales" class="block"> 

  <div id="top-sales-title" class="column span-4 last"> 
    <div class="block"> 
      <div id="text" class="column span-3 last">
        Hot!
      </div>
      <div class="column span-1 last arrow-vertical">
        <div class="arrow-right"></div>
      </div>  
    </div>
    
    <div id="thumbs" class="block">
      <?php if ($top_sales) { ?>
        <ul class="items">
        <?php 
          $counter = 0;
          while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
            $imgs = post_attachements($post->ID);
            $img = $imgs[0];
            $medium = wp_get_attachment_image_src($img->ID, 'medium');
            $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
            $product_id = product_id($post->ID);
            $product_price = product_price($post->ID);
            $product_name = product_name($product_id);
            
            if ($counter == 0) {
              $first_post = $post;
              $counter = 1;
            }
          ?>
          <li>
            <img class="small-image" src="<?php echo $thumb[0] ?>" title="<?php echo $product_name ?>" rev="info-<?php echo $product_id ?>" rel="<?php echo $medium[0]?>"/>
            <div class="info" id="info-<?php echo $product_id ?>">
              <?php include "home-top-sold-thumb.php" ?>
            </div>
          </li>
        <?php 
          endwhile; 
      }?>
    </div>
  </div>

   <div id="top-sales-content" class="column span-14 last">
    <?php if ($first_post) { ?>      
      <!-- wrapper element for the large image -->
      <div id="large-image">
        <?php 
          $imgs = post_attachements($post->ID);
          $img = $imgs[0];
          $medium = wp_get_attachment_image_src($img->ID, 'medium');
          $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
          $product_id = product_id($post->ID);
          $product_price = product_price($post->ID);
          $product_name = product_name($product_id);    
        ?>	
        <img class="large-image" src="<?php echo $medium[0] ?>" title="Click pentru detalii"/>
        <div id="info" class="info">
          <?php include "home-top-sold-thumb.php" ?>
        </div>
      </div>
     <?php } ?>   
   </div>

</div>

