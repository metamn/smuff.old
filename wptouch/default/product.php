<div id="products">
  <?php if ($products) { ?>
    <?php 
      while ($products->have_posts()) : $products->the_post(); update_post_caches($posts); 
        $product_id = product_id($post->ID);
        $product_price = product_price($post->ID);
        $product_discount = product_discount($product_id);
        $product_sale_price = $product_price - $product_discount;
        $product_stock = product_stock($product_id);
        $imgs = post_attachements($post->ID);
        $img = $imgs[0];  
        $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');         
      ?>
      <div id="product">
        <div class='image'>
          <img src="<?php echo $thumb[0]?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
        </div>
        <div class='text'>
          <a class="h2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <br/>          
          <?php if ($product_discount > 0) { ?>
            <span class="price"><?php echo $product_sale_price; ?></span>  RON
            <br/>
            <span class="old-price"><?php echo $product_price; ?></span>    
          <?php } else { ?>
            <span class="normal-price"><?php echo $product_price; ?></span> RON            
          <?php } ?>             
          <span class="delivery">Livrare: <?php echo product_delivery_time($product_stoc) ?></span> 
        </div>
        <div class='meta'>
          <?php if ($wptouch_settings['post-cal-thumb'] != 'calendar-icons') { ?><span class="lead"><?php _e("Written on", "wptouch"); ?></span> <?php echo get_the_time('M') ?> <?php echo get_the_time('j') ?>, <?php echo get_the_time('Y') ?><?php if (!bnc_show_author()) { echo '<br />';} ?><?php } ?>
			    <?php if (bnc_show_author()) { ?><span class="lead"><?php _e("De", "wptouch"); ?></span> <?php the_author(); ?><br /><?php } ?>
			    <?php if (bnc_show_categories()) { echo('<span class="lead">' . __( 'In', 'wptouch' ) . ':</span> '); the_category(', '); echo('<br />'); } ?> 
			    <?php if (bnc_show_tags() && get_the_tags()) { the_tags('<span class="lead">' . __( 'Etichete', 'wptouch' ) . ':</span> ', ', ', ''); } ?>
        </div>
      </div>
      <div class="clearer"></div>
      <?php endwhile; ?>
  <?php } ?>
</div>
