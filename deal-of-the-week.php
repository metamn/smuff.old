<?php
  if ($dow_posts->have_posts()) {
    while ($dow_posts->have_posts()) : $dow_posts->the_post(); update_post_caches($posts); 
      $medium = true;
      
      $product_id = product_id($post->ID);
      $price = product_price($post->ID);
      $discount = product_discount($product_id);
      $percentage = intval($discount*100 / $price);
      
      $first_day_of_week = date('j', strtotime('Last Monday', time()));
      $last_day_of_week = date('j', strtotime('Next Sunday', time()));
      
      $m = array(
        'Ianuarie',
        'Februrie',
        'Martie',
        'Aprilie',
        'Mai',
        'Iunie',
        'Iulie',
        'August',
        'Septembrie',
        'Octombrie',
        'Noiemrie',
        'Decembrie',
      );
      $month = $m[intval(date('n')-1)]; 
      
      $week = date('W');
    ?>   
      
      <div id="dow" class="bestsellers block">
        <div id="text" class="column span-10 last">
          <h1>Promotia saptamanii &raquo;</h1>
          <h3><?php 
            echo $first_day_of_week . ' - ' . $last_day_of_week;
            echo ' ' . $month; 
            echo ' (saptamana ' . $week . ')'; ?> 
          </h3>
          <h1 id="sale">&mdash; <?php echo $percentage?>%</h1>
          <h3>+ livrare gratuita</h3>
        </div>
        <div id="product" class="column span-7 prepend-1 last">
          <?php  include "product-thumb.php"; ?>
        </div>
     <?php
       break;
       endwhile; 
      }
    ?>      
      </div> 
