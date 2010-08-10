<?php 
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_discount = product_discount($product_id);
  $product_sale_price = $product_price - $product_discount;
  $product_stock = product_stock($product_id);
  $imgs = post_attachements($post->ID);
  $img = $imgs[0];  
  $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');         
?>
<div id="product" class="<?php echo $klass?>">
  <div class='image calendar'>
    <a href="<?php the_permalink(); ?>">
      <img src="<?php echo $thumb[0]?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
    </a>
  </div>
  <div class='text'>
    <a class="h2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </div>         
  <div class='meta'>
    <table>
        <tr>
          <?php if ($product_discount > 0) { ?>                  
            <td><span class="price"><?php echo $product_sale_price; ?></span>  RON</td>
            <td><span class="old-price"><?php echo $product_price; ?></span></td>                          			    
          <?php } else { ?>
            <td><span class="normal-price"><?php echo $product_price; ?></span> RON</td>                              
            <td>&nbsp;</td>
          <?php } ?>
          <td><span class="delivery">Livrare: <?php echo product_delivery_time($product_stock) ?></span></td>
        </tr>              
      </table>
  </div>
  <div class="clearer"></div>
</div>      
      
