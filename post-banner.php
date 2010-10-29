<div id="post-sponsor" class="post block default">
  <?php 
    $partners = query_posts2('posts_per_page=5&cat=96,1151&orderby=rand');  
    if ($partners->have_posts()) {
      while ($partners->have_posts()) : $partners->the_post(); update_post_caches($posts);
        $link = get_post_meta($post->ID, 'Link', true);
        $imgs = post_attachements($post->ID);
        $img = $imgs[1];        
        $large = wp_get_attachment_image_src($img->ID, 'large');            
        if ($large) { ?>                    
          <center>
          <p><?php echo $post->post_title ?></p>
          <a target="_blank" href="<?php echo $link ?>" title="<?php echo $post->post_title ?>" alt="<?php $post->post_title ?>">
            <img class="pop-under" src="<?php echo $large[0] ?>" title="<?php $post->post_title ?>" alt="<?php $post->post_title ?>"/>
          </a>
          </center>            
        <?php } else {
          $big = get_post_meta($post->ID, 'parteneriat-large', true);
          if (!$big) {
            $big = get_post_meta($post->ID, 'parteneriat-1', true);
          }
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
                  <param name="movie" value="wp-content/themes/smuff/flash/<?php echo $big ?>" />
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
        break;
      endwhile;
    }
  ?>
</div>
