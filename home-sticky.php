<?php 
    if (is_front_page()) {      
      if ($sticky_post) { 
        $title = $sticky_post->post_title; ?>        
        <div id="sticky" class="item single-thumb">
          <span class="sticky-close">[ x ]</span>
          <h3>Anunt important!</h3>
          <hr/>
          <a href="<?php echo get_permalink($sticky_post->ID); ?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"><?php echo $title ?></a>                  
        </div>
      <?php }
    }  
?>
