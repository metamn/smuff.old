<div id="home-sponsor" class="block last">
  <?php
    if (is_front_page()) {
            
      $partners = query_posts2('posts_per_page=5&cat=96');  
      if ($partners->have_posts()) {
        echo '<h3>Parteneri</h3>';
        echo '<center><ul>';
        while ($partners->have_posts()) : $partners->the_post(); update_post_caches($posts);
          $imgs = post_attachements($post->ID);
          $img = $imgs[0];        
          $medium = wp_get_attachment_image_src($img->ID, 'medium');  ?>
          <li>
          <a href="<?php echo get_permalink($post) ?>" title="<?php echo $post->post_title ?>" alt="<?php $post->post_title ?>">
            <img class="half-banner" src="<?php echo $medium[0] ?>" title="<?php $post->post_title ?>" alt="<?php $post->post_title ?>"/>
          </a>
          </li>  
        <?php endwhile; ?>
          <li><a href="<?php bloginfo('home'); ?>/despre-noi/parteneri">Cum devin partener Smuff?</a></li>
        </ul></center>
      <?php }
    } elseif (is_category()) {      
      $main_cat = page_name(is_category(), is_single());
      
      $sponsor = sponsor_post($main_cat);
      if ($sponsor) {
        $imgs = post_attachements($sponsor->ID);
        $img = $imgs[2];
        $klass = 'vertical-rectangle';
        if (!($img)) {
          $img = $img[3];
          $klass = 'wide-skyscraper';
        }
        $medium = wp_get_attachment_image_src($img->ID, 'medium');
        if ($medium) { ?>      
          <h3>Partener categorie</h3>
          <br/>
          <center>
          <a href="<?php echo get_permalink($sponsor) ?>" title="<?php echo $sponsor->post_title ?>" alt="<?php $sponsor->post_title ?>">
            <img class="<?php echo $klass ?>" src="<?php echo $medium[0] ?>" title="<?php $sponsor->post_title ?>" alt="<?php $sponsor->post_title ?>"/>
          </a>
          </center>
        <?php }
      } 
    } ?>
    
</div>
