
<div id="collections" class="block">
  <div class="items">
    <?php
      if ($collections->have_posts()) {
        while ($collections->have_posts()) : $collections->the_post(); update_post_caches($posts);       
          include "product-collections.php";              
        endwhile; 
      }
    ?>  
  </div>
</div>
