<?php 
  $cat_id = category_id(is_category(), is_single());  
  if ($cat_id) {
    $link = get_category_link($cat_id);    
  } else {
    $link = get_category_link(10);    
  }
  $link = $link . '?view=' . $link_type;
?>
<a href="<?php echo $link ?>" alt="<?php echo $title?>"><?php echo $title?></a>            

