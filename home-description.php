<?php
  if (is_front_page()) { 
    $p = get_page_by_path('despre-noi');   
    $desc = $p->post_excerpt;
  } else if (is_category()) {
    $cat = category_id(true, false);
    $desc = category_description($cat);
  } else {
    $desc = '';
  }     
?>


<div id="home-description" class="block">
<div class='box'>
  <?php echo $desc ?>
</div> 
</div>
