<div id="dow" class="bestsellers block">
  <div id="text" class="column span-10 last">
    <h1>Promotia saptamanii &raquo;</h1>
    <h3>2-8 Iulie</h3>
    <h1 id="sale">&mdash; 33%</h1>
  </div>
  <div id="product" class="column span-7 prepend-1 last">
    <?php
      if ($dow_posts->have_posts()) {
        while ($dow_posts->have_posts()) : $dow_posts->the_post(); update_post_caches($posts); 
          $medium = true;    
          if ($cat == 0 || $cat == 10) {
            $show_category = true;         
          } else {
            $show_category = false;         
          }
          include "product-thumb.php"; 
          break;
        endwhile; 
      }
    ?>      
  </div>
</div> 
