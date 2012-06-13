<?php

  //echo "params: $params";
  $counter = 0; // Apache
  //$counter = 1; // Nginx
  
  $split = explode("&", $params);
  
  $cats = array();
  $price = "";
  
  
  // Get categories
  foreach ($split as $s) {
    $val = explode("=", $s);
  
    if ($val[0] == 'price') {
      $price = $val[1];
    } else {
      $cats[] = $val[1];
    }
  }
  
  
  // Split price
  $lower = 0;
  $higher = 10000;
  if ($price) {
    $tmp = explode('-', $price);
    $lower = (int)$tmp[0];
    if (!$tmp[1]) {
      $tmp[1] = 10000;
    }
    $higher = (int)$tmp[1];    
  }
  
  /*
  echo "<br/> cats: ";
  print_r($cats);
  echo "<br/> price: $price";
  echo "<br/> lower: $lower";
  echo "<br/> higher: $higher";
  */
  
  
  // Query products
  $products = query_posts2(array(
    'numberposts' => '-1',
    'category_and' => $cats
  ));

?>


<div id="products">
  <?php if ($products) {
    while ($products->have_posts()) : $products->the_post(); update_post_caches($posts); 
      $price = product_price($post->ID);                      
      if ($price >= $lower && $price <= $higher) { ?>
        <h3><?php the_title(); ?></h3>
      <?php }
    endwhile; 
  } else { ?>
    <div class="notice">
        Nu am gasit nici un rezultat.
        <a href="<?php bloginfo('home') ?>/gitftshopper/">Va rugam incercati din nou</a>.
    </div>
  <?php } ?>
</div>
