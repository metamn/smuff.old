<?php
  global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons;
  $wpsc_checkout = new wpsc_checkout();
  $wpsc_gateway = new wpsc_gateways();
  $wpsc_coupons = new wpsc_coupons($_SESSION['coupon_numbers']);
?>

<?php if(wpsc_cart_item_count() > 0) { ?>
  <div id="cart-content">
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
          <img src="<?php echo wpsc_cart_item_image(110,110); ?>" alt="<?php echo wpsc_cart_item_name(); ?>" title="<?php echo wpsc_cart_item_name(); ?>" />
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
    
    <div id="delivery">
      <div>Metoda de livrare</div>
      <div id="select-text" class="double">
        <label class="select">
          <select>
            <option>Va rugam selectati metoda de livrare</option>
            <option>Posta Romana, cu plata la livrare 4-6 zilei</option>
            <option>Fan Courier, cu plata la livrare 24 ore</option>
            <option>Fan Courier, cu plata prin transfer bancar in avans 1-2 zile</option>
          </select>
        </label>
      </div>
      
      <div id="select-value" class="last">0.00 RON</div>  
    </div>
    
    <div id="coupon">
      <div id="coupon-text">
        Cod promotional:
        <br/>
        <span>(Daca aveti)</span>
      </div>
      <div id="coupon-form"  class="double">
        <form  method='post' action="<?php echo get_option('shopping_cart_url'); ?>">				
		      <input class="coupon" type='text' name='coupon_num' id='coupon_num' value='<?php echo $wpsc_cart->coupons_name; ?>' />
		      <input type='submit' value="<?php echo __('Recalculeaza') ?>" />		
			  </form>
			</div>
			<div id="coupon-value" class="last">0.00 RON</div>
    </div>
    
    <div id="total">
	    2,456.00 RON
	    <span id="tva">Total cu TVA</span>
    </div>
  </div>
    
<?php } else { ?>
  
  <div id="empty-cart">
    <p>
      Cosul Tau este gol golut. <a href="<?php bloginfo('home') ?>">Aici te poti intoarce la cumparaturi.</a>
    </p>
  </div>	

<?php } ?>


