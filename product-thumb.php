<?php   
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_discount = product_discount($product_id);
  $product_sale_price = $product_price - $product_discount;
  $product_name = product_name($product_id);
  $imgs = post_attachements($post->ID);
  $img = $imgs[0];
  if ($medium) {
    $thumb = wp_get_attachment_image_src($img->ID, 'medium');  
  } else {
    $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');  
  }    
?>

<div class="item product-thumb">    
  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> 
    <img src="<?php echo $thumb[0] ?>" title="<?php echo $product_name; ?>" alt="<?php echo $product_name; ?>"/>  
  </a>
  <div class="text">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
      <h4><?php echo $product_name; ?></h4>
      <?php the_excerpt(); ?>      
      <?php if ($product_discount > 0) { ?>
        <span class="price"><?php echo $product_sale_price; ?> RON</span>
        <span class="old-price"><?php echo $product_price; ?></span>    
      <?php } else { ?>
        <span class="normal-price"><?php echo $product_price; ?></span> RON
      <?php } ?>
    </a>
  </div>  
</div>	
