<div id="bestsellers" class="block"> 

  <div id="col-1" class="column span-9 last">
    <h3>
      Bestsellers      
    </h3>
    <div class="items">	
        <?php
          if ($top_sales->have_posts()) {
            $counter = 0;
            while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
              if ($counter > 1) {   
                $medium = true;             
                include "product-thumb.php";              
              }
              $counter += 1;
            endwhile; 
          }
        ?>       		        
	  </div>
  </div>
  
  <div id="col-2" class="column span-9 last">
    <div class="items">	
        <?php
          if ($top_sales->have_posts()) {
            $counter = 0;
            while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
              if ($counter <= 1) {    
                $medium = true;            
                include "product-thumb.php";              
              }
              $counter += 1;
            endwhile; 
          }
        ?>       		        
	  </div>
  </div>

</div>

