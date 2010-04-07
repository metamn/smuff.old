
<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> 
  <h3><?php echo $product_name; ?></h3>
  <?php the_excerpt(); ?>
  <span class="price"><?php echo $product_price; ?></span>    
</a>    


