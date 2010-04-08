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
  </div>

   <div id="top-sales-content" class="column span-14 last">    
    <div id="s3slider">
      <?php if ($top_sales) { ?>
        <ul id="s3sliderContent">
        <?php 
          while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
            $imgs = post_attachements($post->ID);
            $img = $imgs[0];
            $large = wp_get_attachment_image_src($img->ID, 'large');
            $product_id = product_id($post->ID);
            $product_price = product_price($post->ID);
            $product_name = product_name($product_id);            
          ?>
          <li class="s3sliderImage">
            <img src="<?php echo $large[0] ?>" />            
            <span><?php echo $product_name ?></span>
          </li>
        <?php 
          endwhile; ?>
          <div class="clear s3sliderImage"></div>
        </ul>
      <?php } ?>
    </div>   
   </div>

</div>

