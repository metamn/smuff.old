<div id="home-hot" class="block"> 

  <div id="home-hot-content" class="block">    
    <div id="s3slider">
      <?php if ($new_products) { ?>
        <ul id="s3sliderContent">
        <?php 
          while ($new_products->have_posts()) : $new_products->the_post(); update_post_caches($posts); 
            $imgs = post_attachements($post->ID);
            $img = $imgs[0];
            $large = wp_get_attachment_image_src($img->ID, 'large');
            $product_id = product_id($post->ID);
            $product_price = product_price($post->ID);
            $product_discount = product_discount($product_id);
            $product_sale_price = $product_price - $product_discount;
            $product_name = product_name($product_id);            
          ?>
          <li class="s3sliderImage">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
              <img src="<?php echo $large[0] ?>" title="<?php echo $product_name; ?>" alt="<?php echo $product_name; ?>"/>            
              <span>
                <table>
                  <tr>
                    <td><h3><?php echo $product_name ?></h3></td>
                    <?php if ($product_discount > 0) { ?>
                      <td class="small"><p class="price"><?php echo $product_sale_price; ?></p> RON</td>
                    <?php } else { ?>
                      <td class="small"><p class="normal-price"><?php echo $product_price; ?></p> RON</td>                     
                    <?php } ?>
                  </tr>
                  <tr>
                    <td class="excerpt"><?php the_excerpt(); ?></td>
                    <?php if ($product_discount > 0) { ?>
                      <td class="old-price small"><?php echo $product_price; ?> RON</td>
                    <?php } else { ?>
                      <td></td>
                    <?php } ?>
                  </tr>    
                </table>                                                              
              </span>
            </a>
          </li>
        <?php 
          endwhile; ?>
          <div class="clear s3sliderImage"></div>
        </ul>
      <?php } ?>
    </div>   
  </div>
  
  <div id="home-hot-title" class="block"> 
    <div class="block"> 
      <div id="text" class="column span-3 last">
        Hot!
      </div>
      <div class="column span-1 last arrow-vertical">
        <div class="arrow-right"></div>
      </div>  
    </div>    
  </div>

</div>
