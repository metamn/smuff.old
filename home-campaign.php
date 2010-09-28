<?php 
  if ($campaign->have_posts()) { ?>
    <center>
    <?php while ($campaign->have_posts()) : $campaign->the_post(); update_post_caches($posts); 
      $p = $post->post_content;
      $pa = explode('<p class="hidden campaign-banner">', $p);
      $pb = explode('</p>', $pa[$banner_id]);  
      echo $pb[0];      
    endwhile;?>
    </center>
<?php } ?>
