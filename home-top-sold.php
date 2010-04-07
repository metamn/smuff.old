<h3>Top vanzari</h3>

<?php 
  $first_post = true;
  if ($top_sales) {
  while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
   if ($first_post) {
    $first_post = false; ?>
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
    <!-- root element for the items -->
    <div class="items">
    <ul class="inline-list"> 
      <li>
        <img class="small-image" src="<?php echo $thumb[0] ?>" title="<?php echo $product_name ?>" rev="info-<?php echo $product_id ?>" rel="<?php echo $medium[0]?>"/>
        <div class="info" id="info-<?php echo $product_id ?>">
          <?php include "home-top-sold-thumb.php" ?>
        </div>
      </li>   
   <?php } else {
      $imgs = post_attachements($post->ID);
      $img = $imgs[0];
      $medium = wp_get_attachment_image_src($img->ID, 'medium');
      $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
      $product_id = product_id($post->ID);
      $product_price = product_price($post->ID);
      $product_name = product_name($product_id); ?>
      <li>
        <img class="small-image" src="<?php echo $thumb[0] ?>" title="<?php echo $product_name ?>" rev="info-<?php echo $product_id ?>" rel="<?php echo $medium[0]?>"/>
        <div class="info" id="info-<?php echo $product_id ?>">
          <?php include "home-top-sold-thumb.php" ?>
        </div>
      </li>   
   <?php } 
  endwhile; } ?>
  </ul>
  </div> 


