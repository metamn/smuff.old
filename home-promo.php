<?php ?>
<div id="promo-block" class="block">

  <div id="top-sold" class="column span-7 prepend-2 last">
    <h3>
      Bestsellers      
    </h3>
    <div class="items">	
        <?php
          if ($new_products->have_posts()) {
            while ($new_products->have_posts()) : $new_products->the_post(); update_post_caches($posts); 
              include "home-sales-thumb.php";              
            endwhile; 
          }
        ?>       		        
	  </div>
  </div>
  
  <div id="sales" class="column span-7 prepend-2  last">
    <h3>Promotii</h3>
    <div class="items">	
        <?php
          if ($promo_posts->have_posts()) {
            while ($promo_posts->have_posts()) : $promo_posts->the_post(); update_post_caches($posts); 
              include "home-sales-thumb.php";              
            endwhile; 
          }
        ?>       		        
	  </div>
  </div>
    
  
</div>


