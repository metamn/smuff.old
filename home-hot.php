<div id="home-hot" class="block"> 

  <div id="home-hot-content" class="block">    
    <div id="hot-slider" class="slider column span-15 last">
      <?php if ($new_products) { ?>
        <ul>
        <?php 
          $thumbs = array();
          $i = 1;
          
          if ($special_posts) {
            while ($special_posts->have_posts()) : $special_posts->the_post(); update_post_caches($posts);
              $imgs = post_attachements($post->ID);
              //$random = rand(0, 2);
              //$img = $imgs[$random];
              $img = $imgs[0];
              $large = wp_get_attachment_image_src($img->ID, 'large');
              $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
              $thumbs[] = '<a class="hot-slider-link" rel="'.$i.'" title="'.get_the_title().'"><img src="'.$thumb[0].'" alt="'.get_the_title().'" /></a>';            
              $i += 1; ?>
              
              <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
                  <img src="<?php bloginfo('stylesheet_directory') ?>/img/home-hot-blank.jpg" rel="<?php echo $large[0] ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
                  <div id="home-hot-title" class="block"> 
                    <div id="text" class="column span-3 last">
                      Nou!
                    </div>
                    <div id="info" class="column span-13 last">
                      <div class="arrow-right"></div>
                      <table>
                        <tr>
                        <td><h3><?php the_title(); ?></h3></td>
                        <td>&nbsp;</td>
                        </tr>
                        <tr>
                        <td class="excerpt"><br/><?php the_excerpt(); ?></td>
                        <td>&nbsp;</td>
                        </tr>
                      </table>
                    </div>  
                  </div>               
                </a>
              </li>
                              
            <?php endwhile; 
          }
          
          while ($new_products->have_posts()) : $new_products->the_post(); update_post_caches($posts); 
            $imgs = post_attachements($post->ID);
            $img = $imgs[0];
            $large = wp_get_attachment_image_src($img->ID, 'large');
            $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
            $product_id = product_id($post->ID);
            $product_price = product_price($post->ID);
            $product_discount = product_discount($product_id);
            $product_sale_price = $product_price - $product_discount;
            $product_name = product_name($product_id);
            
            $title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
            
            $thumbs[] = '<a class="hot-slider-link" rel="'.$i.'" title="'.$product_name.'"><img src="'.$thumb[0].'" alt="'.$product_name.'" /></a>';            
            $i += 1;
          ?>
          <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
              <img src="<?php bloginfo('stylesheet_directory') ?>/img/home-hot-blank.jpg" rel="<?php echo $large[0] ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>"/>
              <div id="home-hot-title" class="block"> 
                <div id="text" class="column span-3 last">
                  Nou!
                </div>
                <div id="info" class="column span-13 last">
                  <div class="arrow-right"></div>
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
                </div>  
              </div>               
            </a>
          </li>
        <?php 
          endwhile; ?>          
        </ul>
      <?php } ?>
    </div>
    <div id="hot-slider-thumbs" class="column span-3 last">
      <?php if ($thumbs) { ?>
        <div class="hot-slider-thumb-menu-wrapper">
        <div class="hot-slider-thumb-menu">
        <?php foreach ($thumbs as $thumb) {
          echo $thumb;
        } ?>
        </div></div>  
      <?php } ?>
    </div>   
  </div>
    
  
</div>
