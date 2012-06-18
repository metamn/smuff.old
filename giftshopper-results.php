<?php

  // Query products
  $products = query_posts2(array(
    'posts_per_page' => '20',
    'category_and' => $cats
  ));
  
  //print_r($products);
  
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
  
?>

<?php if (($nume == '') || (empty($cats))) { ?> 
  <div class="notice">
    <?php if ($nume == '') { ?>
      <p>
      Trebuie sa completati <strong>numele</strong> celui care se face lista.
      </p>
    <?php } ?>
    <?php if (empty($cats)) { ?>
      <p>
      Trebuie sa selectati macar <strong>un criteriu</strong> pentru a crea lista.
      </p>
    <?php } ?>
    <p>
      Inapoi la <a href="<?php bloginfo('home') ?>/giftshopper/?email=<?php echo $email?>&nume=<?php echo $nume?>">Giftshopper</a>
    </p>
  </div>
  <?php include 'giftshopper-form.php'; ?>

<?php } else { ?>
  <div id="products" class="bestsellers">
    <?php if ($products) {
      $prods = "";
      while ($products->have_posts()) : $products->the_post(); update_post_caches($posts); 
        $pr = product_price($post->ID);                      
        if ($pr >= $lower && $pr <= $higher) { 
          $prods .= $post->ID . '-';
          $medium = true; 
          include "product-thumb.php";
        }
      endwhile; ?>
      
      <?php if ($prods == '') { ?>
        <div class="notice">
          Nu am gasit nici un cadou incadrat in bugetul de <strong><?php echo $price?> RON</strong>.
          <br/>
          <a href="<?php bloginfo('home') ?>/giftshopper/?email=<?php echo $email?>&nume=<?php echo $nume?>">Va rugam incercati din nou</a>.
        </div>
      <?php } else { ?>      
        <div id="save">
          <input type="hidden" name="nume" value="<?php echo $nume ?>" />
          <input type="hidden" name="cats" value="<?php echo $cats ?>" />
          <input type="hidden" name="price" value="<?php echo $price ?>" />
          <input type="hidden" name="products" value="<?php echo $prods ?>" />
          <button type='submit' name="button" id="button" value="dosave">Salvare lista</button>
        </div>      
      <?php } ?>      
       
    <?php } else { ?>
      <div class="notice">
          Nu am gasit nici un cadou.
          <a href="<?php bloginfo('home') ?>/giftshopper/?email=<?php echo $email?>&nume=<?php echo $nume?>">Va rugam incercati din nou</a>.
      </div>
    <?php } ?>
  </div>
<?php } ?>
