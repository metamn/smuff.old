<?php
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_stock = product_stock($product_id);
  $imgs = post_attachements($post->ID);
  $img = $imgs[0];  
  $medium = wp_get_attachment_image_src($img->ID, 'medium'); 
?>

<div class="block">
  <div id="post-price-strip" class="column span-18">
    <div class="column span-14 last">&nbsp;</div>
    <div class="column span-4 last post-price">&nbsp;</div>
  </div>
  <div class="column span-6 last">&nbsp;</div>
</div>

<div id="post-<?php the_ID(); ?>" class="post block default">
  <div id="post-body" class="column span-18">
    <div class="column span-18">
      <div class="span-14 last">
        <h1>
          <a href="<?php the_permalink() ?>" rel="bookmark" title="Link pentru <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>      
      </div>
      <div class="post-price span-4 last">
        <p>
          <?php echo $product_price ?> RON
        </p>
      </div>
    </div>
    
    <div class="entry block">
      <div class="image">				            
        <a href="<?php the_permalink() ?>" rel="bookmark" title="Link pentru <?php the_title_attribute(); ?>">
        <img src="<?php echo $medium[0]?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" /></a>
      </div>        
        
      <div class="excerpt">
        <?php echo product_excerpt($post->post_content); ?>
        <p>
          <a href="<?php the_permalink() ?>#more-<?php echo $post->ID ?>">Detalii &rarr;</a>
        </p>
      </div>              
    </div> 
    
    <?php include "post-meta-and-share.php" ?>					      
  </div>  
  <?php include "post-taxonomy.php" ?>			          
</div>				     
