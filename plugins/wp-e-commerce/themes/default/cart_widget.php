<?php if(wpsc_cart_item_count() > 0): 
  $url = get_option('shopping_cart_url');
?>  
  <ul>
    <li><a href="<?php echo $url ?>"><?php echo wpsc_cart_item_count() ?> produs(e)</a></li>
    <li><a href="<?php echo $url ?>"><?php echo wpsc_cart_total_widget(); ?></a></li>
    <li id="checkout"><a href="<?php echo $url ?>">Finalizare comanda &rarr;</a></li>
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
	  <li><a href="<?php echo get_option('shopping_cart_url'); ?>">0 produse</a></li>
	  <li>0.00 RON</li>
	</ul>	
<?php endif; ?>






