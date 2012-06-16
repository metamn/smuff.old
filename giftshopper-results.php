<?php

  // Query products  
  $products = query_posts2(array(
    'posts_per_page' => '10',
    'category_and' => $cats
  ));
  
?>

<?php if (($name == '') || (empty($cats))) { ?> 
  <div class="notice">
    <p>
    Trebuie sa selectati macar o categorie si sa completati numele celui
    care se face lista.
    </p>
    <p>
      Inapoi la <a href="<?php bloginfo('home')?>/giftshopper">Giftshopper</a>
    </p>
  </div>
  <?php include 'giftshopper-form.php'; ?>

<?php } else { ?>
  <div id="products">
    <?php if ($products) {
      $prods = "";
      while ($products->have_posts()) : $products->the_post(); update_post_caches($posts); 
        $price = product_price($post->ID);                      
        if ($price >= $lower && $price <= $higher) { ?>
          <h3><?php 
            the_title(); 
            $prods .= $post->ID . '-';
          ?></h3>
        <?php }
      endwhile; 
    } else { ?>
      <div class="notice">
          Nu am gasit nici un rezultat.
          <a href="<?php bloginfo('home') ?>/giftshopper/">Va rugam incercati din nou</a>.
      </div>
    <?php } ?>
  </div>
  
  <div id="save">
    <input type="hidden" name="nume" value="<?php echo $nume ?>" />
    <input type="hidden" name="cats" value="<?php echo $cats ?>" />
    <input type="hidden" name="price" value="<?php echo $price ?>" />
    <input type="hidden" name="products" value="<?php echo $prods ?>" />
    <button type='submit' name="button" id="button" value="dosave">Salvare lista</button>
  </div>
<?php } ?>
