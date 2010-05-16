<?php
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_discount = product_discount($product_id);
  $product_sale_price = $product_price - $product_discount;
  $product_stock = product_stock($product_id);
  $imgs = post_attachements($post->ID);
  $img = $imgs[0];  
  $medium = wp_get_attachment_image_src($img->ID, 'medium'); 
?>


<div id="post-<?php the_ID(); ?>" class="post block default">
  <div id="post-body" class="column span-18">
    <div class="column span-18">
      <div id="post-title" class="column span-14 last">
        <h1>
          <a href="<?php the_permalink() ?>" rel="bookmark" title="Link pentru <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>      
      </div>
      <div id="post-price" class="column span-4 last">
        <p>
         <?php if ($product_discount > 0) { ?>
          <span class="price"><?php echo $product_sale_price; ?></span>  RON
          <br/>
          <span class="old-price"><?php echo $product_price; ?></span>    
        <?php } else { ?>
          <div class="price-spacer">
            <span class="normal-price"><?php echo $product_price; ?></span> RON
          </div>
        <?php } ?>
        </p>
      </div>
    </div>
    
    <div id="post-data" class="entry block">      
      <div id="post-image">				            
        <a href="<?php the_permalink() ?>" rel="bookmark" title="Link pentru <?php the_title_attribute(); ?>">
        <img src="<?php echo $medium[0]?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" /></a>
      </div>
      
      <div id="post-excerpt">
        <?php echo product_excerpt($post->post_content); ?>
        <p>
          <a href="<?php the_permalink() ?>#more-<?php echo $post->ID ?>">Detalii &rarr;</a>
        </p>
      </div>                                    
    </div> 
    
    <?php include "post-meta-and-share.php" ?>					      
  </div>  
  <div id="post-sidebar" class="column span-6 last">       
    <?php include "post-taxonomy.php" ?>
    <?php include "post-sponsor.php" ?>			          
  </div>
</div>				     
