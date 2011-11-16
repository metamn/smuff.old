<div id="random-posts">
<h3>Flashback</h3>
<?php 
    if ($random_posts) {
      while ($random_posts->have_posts()) : $random_posts->the_post(); update_post_caches($posts); 
        $medium = false;
        include "product-thumb.php";
      endwhile;
    }
  ?>   
</div>
