
<?php if(wpsc_cart_item_count() > 0): ?>  
  <ul>
    <li><a href="<?php echo get_option('shopping_cart_url'); ?>"><?php echo wpsc_cart_item_count(); ?> produs(e)</a><li>
    <li><a href="<?php echo get_option('shopping_cart_url'); ?>"><?php echo wpsc_cart_total_widget(); ?></a></li>
    <li><a href="<?php echo get_option('shopping_cart_url'); ?>">Finalizare comanda &rarr;</a></li>
  </ul>
  <?php if(count($cart_messages) > 0) { ?>  
    <p>
    <?php foreach((array)$cart_messages as $cart_message) { ?>
      <span><?php echo $cart_message; ?></span>
    <?php } ?>
    </p>	
  <?php } ?>
	
<?php else: ?>
	<ul>
	  <li><a href="<?php echo get_option('shopping_cart_url'); ?>">0 produse</a></li>
	  <li>0.00 RON</li>
	</ul>	
<?php endif; ?>


