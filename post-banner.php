<div id="post-sponsor" class="post block default">
  <?php 
    $partners = query_posts2('posts_per_page=-1&cat=96');  
    if ($partners->have_posts()) {
      $random = rand(0, $partners->post_count);
      $counter = 0;
      while ($partners->have_posts()) : $partners->the_post(); update_post_caches($posts);
        if ($counter == $random) {
          $imgs = post_attachements($post->ID);
          $img = $imgs[1];        
          $large = wp_get_attachment_image_src($img->ID, 'large');  ?>
          
          <a href="<?php echo get_permalink($post) ?>" title="<?php echo $post->post_title ?>" alt="<?php $post->post_title ?>">
            <img class="pop-under" src="<?php echo $large[0] ?>" title="<?php $post->post_title ?>" alt="<?php $post->post_title ?>"/>
          </a>
            
        <?php }
        $counter += 1;
      endwhile;
    }
  ?>
</div>
