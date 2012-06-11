<?php 
  $wishlist = 0;
  $favorite_post_ids = wpfp_get_users_favorites();  
  if ($favorite_post_ids) {
    $wishlist = count($favorite_post_ids);
  }
  
  $wishlist_text = " cadouri";
  if ($wishlist == 1) {
    $wishlist_text = " cadou";
  }
?>


<?php if(wpsc_cart_item_count() > 0): 
  $url = get_option('shopping_cart_url');  
  
  $cart = wpsc_cart_item_count();
  
  $cart_text = " cadouri";
  if ($cart == 1) {
    $cart_text = " cadou";
  }
?>  
  <ul>
    <li>
      <a href="<?php echo $url ?>"><?php echo $cart ?><?php echo $cart_text ?> in cos, </a>
      <a href="<?php echo $url ?>"><?php echo wpsc_cart_total_widget(); ?></a>
    </li>    
    <li id="checkout"><a href="<?php echo $url ?>">Finalizare comanda &rarr;</a></li>
    <li id="wishlist"><a href="<?php bloginfo('home')?>/wishlist"><?php echo $wishlist ?><?php echo $wishlist_text ?> in wishlist &rarr;</a></li>
  </ul>  
  <?php if(count($cart_messages) > 0) { ?>  
    <ul>
    <?php foreach((array)$cart_messages as $cart_message) { ?>
      <li><?php echo $cart_message; ?></li>
    <?php } ?>
    </ul>	
  <?php } ?>
	
<?php else: ?>
	<ul class='emptycart'>
	  <li><a href="<?php echo get_option('shopping_cart_url'); ?>">0 produse in cos</a></li>
	  <li id="wishlist"><a href="<?php bloginfo('home')?>/wishlist"><?php echo $wishlist ?><?php echo $wishlist_text ?> in wishlist &rarr;</a></li>
	</ul>	
<?php endif; ?>






