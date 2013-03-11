<?php
  global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons;
  $wpsc_checkout = new wpsc_checkout();
  $wpsc_gateway = new wpsc_gateways();
  $wpsc_coupons = new wpsc_coupons($_SESSION['coupon_numbers']);
?>

<?php if(wpsc_cart_item_count() > 0) { ?>
  <div id="cart-content">
    <div id="image" class="header">Imagine produs</div>
    <div id="name" class="header">Nume produs</div>
    <div id="quantity" class="header">Cantitate</div>
    <div id="price" class="header">Pret</div>
    <div id="remove" class="header">Operatii</div>
    
    <?php while (wpsc_have_cart_items()) : wpsc_the_cart_item(); ?>	
      <?php 
        // Getting the original post item for the product
        $product_id = wpsc_cart_item_product_id();
        $post_id = post_id($product_id);
        
        $stock = product_stock($product_id);
        if ($stock > 0) { $delivery = $stock; }	   
        
        $link = get_permalink($post_id);
      ?>	
      <p id="separator"></p>
      <div id="image">
        <a href="<?php echo $link ?>">
          <img src="<?php echo wpsc_cart_item_image(128,128); ?>" alt="<?php echo wpsc_cart_item_name(); ?>" title="<?php echo wpsc_cart_item_name(); ?>" />
        </a>
      </div>
  
      <div id="name">
        <h3>
          <a href="<?php echo $link ?>"><?php echo wpsc_cart_item_name(); ?></a>
        </h3>
      </div>
      
      <div id="quantity">
        <form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
		      <input type="text" name="quantity" size="2" value="<?php echo wpsc_cart_item_quantity(); ?>" />
		      <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
		      <input type="hidden" name="wpsc_update_quantity" value="true" />
		      <input type="submit" value="<?php echo __('Actualizare', 'wpsc'); ?>" name="submit" />
	      </form>
      </div>
      
      <div id="price">
        <p><?php echo wpsc_cart_item_price(); ?></p>
      </div>
      
      <div id="remove">
        <form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
		      <input type="hidden" name="quantity" value="0" />
		      <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
		      <input type="hidden" name="wpsc_update_quantity" value="true" />
		      <input type="submit" value="Renunta" name="remove" />
	      </form>
      </div>
      
    <?php endwhile; ?>
    
    <p id="separator"></p>
    <div id="total">
      2,346.00 RON
    </div>
  </div>
  
  
  
  <div id="cart-footer">
    <div id="coupon">
      <p>Daca aveti un cod promotional introduceti aici:</p>
      <form  method='post' action="<?php echo get_option('shopping_cart_url'); ?>">				
		    <input class="coupon" type='text' name='coupon_num' id='coupon_num' value='<?php echo $wpsc_cart->coupons_name; ?>' />
		    <input type='submit' value="<?php echo __('Recalculeaza') ?>" />		
			</form>
    </div>
    
    <div id="delivery">
      <p>Metoda de livrare</p>
        <ul>
          <li>
            <span>Posta Romana, cu plata la livrare 4-6 zile</span>
            <span>8.00 RON</span>
          </li>
          <li>
            <span>Fan Courier, cu plata la livrare 24 ore</span>
            <span>19.00 RON</span>
          </li>
          <li>
            <span>Fan Courier, cu plata prin transfer bancar in avans 1-2 zile</span>
            <span>17.00 RON</span>
          </li>
		    </ul>
    </div>
    
    <div id="total">
      <ul>
	      <li>
          <span>Transport</span>
          <span>19.00 RON</span>
	      </li>
	      <li>
          <span>Cod cupon</span>
          <span>30.00 RON</span>
	      </li>
	      <li>
	        <span>Total cu TVA</span>
	        <span>456 RON</span>
	      </li>
      </ul>
    </div>
  </div>
    
<?php } else { ?>
  
  <div id="empty-cart">
    <p>
      Cosul Tau este gol golut. <a href="<?php bloginfo('home') ?>">Aici te poti intoarce la cumparaturi.</a>
    </p>
  </div>	

<?php } ?>


