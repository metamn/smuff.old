<?php
 //echo "<pre>".print_r($GLOBALS['wpsc_cart']->cart_items[0], true)."</pre>";
?>
<?php if(count($cart_messages) > 0) { ?>
  <p>
	<?php foreach((array)$cart_messages as $cart_message) { ?>
	  <span><?php echo $cart_message; ?></span><br />
	<?php } ?>
	</p>
<?php } ?>

<?php if(wpsc_cart_item_count() > 0): ?>
  <ul>
    <li><a href="<?php echo get_option('shopping_cart_url'); ?>"><?php echo wpsc_cart_item_count(); ?> produs(e)</a><li>
    <li><a href="<?php echo get_option('shopping_cart_url'); ?>"><?php echo wpsc_cart_total_widget(); ?></a></li>
  </ul>
  <h4><a href="<?php echo get_option('shopping_cart_url'); ?>">Finalizare comanda &rarr;</a></h4>
	
<?php else: ?>
	<ul>
	  <li><a href="">0 produse</a></li>
	  <li>0.00 RON</li>
	</ul>
	<h4><a href="">Creare cont &rarr;</a></h4>
	<h4><a href="">Intrare in cont &rarr;</a></h4>
<?php endif; ?>

<?php
wpsc_google_checkout();


?>
