<div class='block'>
	<?php include 'c_subscribe-to-newsletter.php' ?>
</div>
  
<div id="bestsellers" class="bestsellers block"> 
    
  <div id="col-0" class="column span-2 last">    
    <h3 class='first'>B</h3>
    <h3>e</h3>
    <h3>s</h3>
    <h3>t</h3>
    <h3>s</h3>
    <h3>e</h3>
    <h3>l</h3>
    <h3>l</h3>
    <h3>e</h3>
    <h3>r</h3>
    <h3 class='last'>s</h3>        
  </div>
  
  
  <div class="column span-21 prepend-1 last">
    <div class="items">	
        <?php
          if ($top_sales->have_posts()) {
            $counter = 1;
            while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
							$medium = true;    
							if ($cat == 0 || $cat == 10) {
								$show_category = true;         
							} else {
								$show_category = false;         
							}
							include "product-thumb.php";              
              $counter += 1;
            endwhile; 
          }
        ?>       		        
	  </div>
  
  	<?php include 'search-enhanced.php' ?>
  </div>

</div>