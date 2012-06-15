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
  

<?php } else { ?>
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
          <a href="<?php bloginfo('home') ?>/giftshopper/">Va rugam incercati din nou</a>.
      </div>
    <?php } ?>
  </div>
<?php } ?>
