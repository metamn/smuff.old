<?php ?>
<div id="promo-block" class="block">
    
  <div id="promo" class="column span-15"> 
    <div class="scrollable" id="promo-scroll">			        
      <div class="items">	
        <?php
          if ($promo_posts->have_posts()) {
            $counter = 0;
            while ($promo_posts->have_posts()) : $promo_posts->the_post(); update_post_caches($posts); 
              if ($counter == 3) {
                include "home-sticky.php";
              } else {
                include "home-sales-thumb.php";
              }
              $counter = $counter + 1;
            endwhile; 
          }
        ?>       		        
	    </div>        
	  </div> <!-- scrollable -->
    <div class="navi"></div>
        
    
        
           
  </div>     

  <div class="column span-1 last arrow-vertical">
    <div class="arrow-left"></div>
  </div>
  <div id="percent" class="column span-2 last">
    %
  </div>
</div>


