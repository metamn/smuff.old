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
          $large = wp_get_attachment_image_src($img->ID, 'large');            
          if ($large) { ?>                    
            <center>
            <p><?php echo $post->post_title ?></p>
            <a href="<?php echo get_permalink($post) ?>" title="<?php echo $post->post_title ?>" alt="<?php $post->post_title ?>">
              <img class="pop-under" src="<?php echo $large[0] ?>" title="<?php $post->post_title ?>" alt="<?php $post->post_title ?>"/>
            </a>
            </center>            
          <?php } else {
            $big = get_post_meta($post->ID, 'parteneriat-large', true);
            $w = 950;
            $h = 396;
            if ($big) { ?>
              <center>
              <p><?php echo $post->post_title ?></p>
                <code>
                  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
			                  id="<?php echo $big ?>"
			                  class="flashmovie"
			                  width="<?php echo $w ?>"
			                  height="<?php echo $h ?>">
	                  <param name="movie" value="wp-content/themes/smuff/flash/<?php echo $bif ?>" />
	                  <!--[if !IE]>-->
	                  <object	type="application/x-shockwave-flash"
			                  data="wp-content/themes/smuff/flash/<?php echo $big ?>"
			                  name="fm_am_950x396_434923483"
			                  width="<?php echo $w ?>"
			                  height="<?php echo $h ?>">
	                  <!--<![endif]-->
	                  <!--[if !IE]>-->
	                  </object>
	                  <!--<![endif]-->
                  </object></code>
              </center>    
            <?php }
          }
        }
        $counter += 1;
      endwhile;
    }
  ?>
</div>
