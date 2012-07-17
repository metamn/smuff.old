<?php
  if ( ($dow_posts) && ($dow_posts->have_posts())) {
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
      
      $week = date('W'); ?>   
            
      <div id="dow" class="bestsellers block">        
        <div class="block">          
          <div id="product">
            <?php  include "product-thumb.php"; ?>
          </div>
        </div>
        <div id="text">
          <h4 id="title"><a href="" title="Promotia saptamanii pe Smuff">
            Promotia<br/>saptamanii
          </a></h4>
          <h4 id="week"><?php 
            echo $first_day_of_week . ' - ' . $last_day_of_week;
            echo ' ' . $month . '<br/>'; 
            echo 'saptamana #' . $week; ?> 
          </h4>
          <h4 id="offer"><strong>&mdash; <?php echo $percentage ?>%</strong> <br/> + livrare gratuita</h4>
          <h4 id="whatis">
            <a href="" title="Promotia saptamanii pe Smuff">Ce este?</a>
          </h4>
          <div id="star">
            <img src="<?php bloginfo('stylesheet_directory')?>/img/dow-star.png">
          </div>       
        </div>          
      </div>
<?php
    break;
    endwhile; 
  }    
?>      
      
      

