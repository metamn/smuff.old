<div class="spacer">&nbsp;</div>


<div id="promo" class="block">  
  <div id="percent" class="column span-3 last">
    <span class="value">
      <a title="Vezi toate promotiile Smuff" href="<?php bloginfo('home'); ?>/category/meta/promotii/?view=3">%</a>
    </span>
  </div>
  <div class="column span-1 last arrow-vertical">
    <div class="arrow-right"></div>
  </div>
  
  <div id="items" class="column span-14 last">
    <div class="scrollable" id="promo-scroll">			        
        <div class="items">	
          <?php
            if ($promo_posts->have_posts()) {
              while ($promo_posts->have_posts()) : $promo_posts->the_post(); update_post_caches($posts); 
                $medium = false;
                include "product-thumb.php";
              endwhile; 
            }
          ?>               		        
	      </div>        
	    </div> <!-- scrollable -->
	    <div class="clearfix"></div>
      <div class="navi"></div>
  </div>   
  
  <div class="clearfix"></div>
  
  <h4 class="all-products-link">
    <a class="all-products-link" title="Vezi toate promotiile Smuff" href="<?php bloginfo('home'); ?>/category/meta/promotii/?view=3">
    Vezi toate promotiile Smuff &rarr;</a>
  </h4>
</div>


