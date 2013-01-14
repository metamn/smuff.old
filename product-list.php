<?php

  // Parameters
  // - product_list: a list of products to show
  // - product_list_id: the css id of the section
  // - product_list_title : the visible title of the section. If empty the title won't be shown
  
  // - and all parameters from product_thumb.php;

  if ($product_list) {
    if ($product_list->have_posts()) {
      
      if (empty($product_list_id)) {
        $product_list_id = 'products';
      } ?>
        
      <section id="<?php echo $product_list_id ?>">
        
        <?php if (isset($product_list_title)) { ?>
          <header id="title">
            <h2><?php echo $product_list_title ?></h2>
          </header>
        <?php } ?>
        
        <div id="body">
          <div id="items">
            <?php 
              $counter = 1;
              while ($product_list->have_posts()) : $product_list->the_post(); update_post_caches($posts); 
                include "product-thumb.php";
                $counter += 1;
              endwhile; 
            ?>
          </div>
        </div>
      
      </section>  
    <?php
    }
  
  } 

?>
