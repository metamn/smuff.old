<div id="home-campaign">
<?php 
  if ($campaign->have_posts()) { ?>
    <center>
    <?php while ($campaign->have_posts()) : $campaign->the_post(); update_post_caches($posts); 
      $imgs = post_attachements($post->ID);
      $link = get_post_meta($post->ID, 'Link', true);
      $title = $post->post_title;
      
      $banner = sponsor_banner($post->ID, $imgs, array(3,2,0));
      if ($banner) {                    
        if (!(strpos($banner, "http://") === false)) { ?>
          
          <a target="_blank" href="<?php echo $link ?>" title="<?php echo $title ?>" alt="<?php $title ?>">
            <img class="" src="<?php echo $banner ?>" title="<?php $title ?>" alt="<?php $title ?>"/>
          </a>
          
        <?php } else { 
          $w = 120;
          $h = 600;
        ?>
        
          <code>
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
                id="<?php echo $banner ?>"
                class="flashmovie"
                width="<?php echo $w ?>"
                height="<?php echo $h ?>">
            <param name="movie" value="wp-content/themes/smuff/flash/<?php echo $banner ?>" />
            <!--[if !IE]>-->
            <object	type="application/x-shockwave-flash"
                data="wp-content/themes/smuff/flash/<?php echo $banner ?>"
                name="fm_am_950x396_434923483"
                width="<?php echo $w ?>"
                height="<?php echo $h ?>">
            <!--<![endif]-->
            <!--[if !IE]>-->
            </object>
            <!--<![endif]-->
          </object></code>
        
        <?php }
      } else {
        // keeping compatibility with smuff charity campaigns
        $p = $post->post_content;
        $pa = explode('<p class="hidden campaign-banner">', $p);
        $pb = explode('</p>', $pa[$banner_id]);  
        echo $pb[0];      
      }      
    
    break;
    endwhile;?>
    </center>
<?php } ?>
</div>
