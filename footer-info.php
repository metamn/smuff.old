
<div id="footer-info" class="block">
  <div class="column span-10">
    <div id="contact">
      <?php 
        $p = get_page_by_path('contact');
        if ($p) { ?>
          <h3><?php echo $p->post_title; ?></h3>
          <p><?php echo $p->post_content; ?></p>
        <?php } ?>
    </div>
    
    <div id="company">
      <?php 
        $p = get_page_by_path('date-firma');
        if ($p) { ?>
          <?php echo $p->post_content; ?>
        <?php } ?>
    </div>
  </div>
  
  <div class="column span-12 prepend-2 last">
    <div id="accordion-footer-info" class="accordion">
      <?php 
        $pages = array('cum-cumpar', 'business-2-business', 'afiliere', 'ajutor', 'protectia-consumatorilor', 'despre-noi');
        foreach ($pages as $page) {
          $p = get_page_by_path($page);
          if ($p) { ?>
            <h3><?php echo $p->post_title; ?></h3>
            <div class="pane">
              <?php echo $p->post_excerpt; ?>
              <p><a href="<?php echo get_page_link($p->ID); ?>">Detalii &rarr;</a></p>
            </div>  
          <?php }
        }?>      
    </div>    
  </div> 
</div>
