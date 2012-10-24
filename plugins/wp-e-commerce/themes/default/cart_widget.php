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
  } ?>  
  <ul>
    <li>
      <a href="<?php echo $url ?>"><strong><?php echo $cart ?></strong><?php echo $cart_text ?> in cos, <strong><?php echo wpsc_cart_total_widget(); ?></strong></a>
    </li>    
    <li id="wishlist">
    	<a href="<?php bloginfo('home')?>/wishlist"><strong><?php echo $wishlist ?></strong><?php echo $wishlist_text ?> in wishlist</a>
    </li>
  <?php if(count($cart_messages) > 0) { ?>  
    <?php foreach((array)$cart_messages as $cart_message) { ?>
      <li id="message"><?php echo $cart_message; ?></li>
    <?php } ?>
  <?php } ?>
		<li>0740-456.127</li>
		<li><a href="#footer-info">Informatii</a></li>
	</ul>
	
	
<?php else: ?>
	
	<ul class='emptycart'>
	  <li><a href="<?php echo get_option('shopping_cart_url'); ?>"><strong>0</strong> cadouri in cos</a></li>
	  <li id="wishlist"><a href="<?php bloginfo('home')?>/wishlist"><strong><?php echo $wishlist ?></strong><?php echo $wishlist_text ?> in wishlist</a></li>
	  <li>0740-456.127</li>
	  <li><a href="#footer-info">Informatii</a></li>
	</ul>	

<?php endif; ?>






