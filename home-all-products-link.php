<?php 
  $cat_id = category_id(is_category(), is_single(), null);  
  if ($cat_id) {
    $link = get_category_link($cat_id);    
  } else {
    $link = get_category_link(10);    
  }
  $link = $link . '?view=' . $link_type;
?>

<a class="all-products-link" href="<?php echo $link ?>" alt="<?php echo $title?>"><?php echo $title?></a>            

