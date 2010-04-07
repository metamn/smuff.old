<?php 
  $cat_id = category_id(is_category(), is_single());  
  if ($cat_id) {
    $link = get_category_link($cat_id);
    $title = "Vezi toate produsele din categorie";
  } else {
    $link = get_category_link(47);
    $title = "Vezi toate produsele";
  }
  $link = $link . '?view=2';
?>
<a href="<?php echo $link ?>" alt="<?php echo $title?>"><?php echo $title?></a>            

