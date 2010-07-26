<div id="bestsellers" class="block"> 

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

  <div id="col-1" class="column span-7 prepend-1 last">
    <div class="items">	
        <?php
          if ($top_sales->have_posts()) {
            $counter = 0;
            while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
              if ($counter < 3) {   
                $medium = true;             
                include "product-thumb.php";              
              }
              $counter += 1;
            endwhile; 
          }
        ?>       		        
	  </div>
  </div>
  
  <div id="col-2" class="column span-7 prepend-1 last">
    <div class="items">	
        <?php
          if ($top_sales->have_posts()) {
            $counter = 0;
            while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
              if ($counter >= 3) {    
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

