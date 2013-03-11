<?php
  global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons;
  $wpsc_checkout = new wpsc_checkout();
  $wpsc_gateway = new wpsc_gateways();
  $wpsc_coupons = new wpsc_coupons($_SESSION['coupon_numbers']);
?>

<?php if(wpsc_cart_item_count() > 0) { ?>
  <div id="cart-content">
    <div id="image" class="header">
    </div>
    <div id="name" class="header">
    </div>
    <div id="quantity" class="header">
      Cantitate
    </div>
    <div id="price" class="header">
      Pret
    </div>
    <div id="remove" class="header">
    </div>
    
    <?php while (wpsc_have_cart_items()) : wpsc_the_cart_item(); ?>	
      <?php 
        // Getting the original post item for the product
        $product_id = wpsc_cart_item_product_id();
        $post_id = post_id($product_id);
        
        $stock = product_stock($product_id);
        if ($stock > 0) { $delivery = $stock; }	   
        
        $link = get_permalink($post_id);
      ?>	
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
      
      <div id="remove" class="header">
        <form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
		      <input type="hidden" name="quantity" value="0" />
		      <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
		      <input type="hidden" name="wpsc_update_quantity" value="true" />
		      <button class='remove_button' type="submit"><span><?php echo __('Renunta'); ?></span></button>
	      </form>
      </div>
      
    <?php endwhile; ?>
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
        <?php while (wpsc_have_shipping_quotes()) : wpsc_the_shipping_quote();	?>
			    <li>
			      <span id="name"><?php echo wpsc_shipping_quote_name(); ?></span>
			      <span id="value""><?php echo wpsc_shipping_quote_value(); ?></span>
			      <span id="form">
				      <?php if(wpsc_have_morethanone_shipping_methods_and_quotes()): ?>
					      <input type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>' <?php echo wpsc_shipping_quote_selected_state(); ?>  onclick='switchmethod("<?php echo wpsc_shipping_quote_name(); ?>", "<?php echo wpsc_shipping_method_internal_name(); ?>")' value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
				      <?php else: ?>
					      <input <?php echo wpsc_shipping_quote_selected_state(); ?> disabled='disabled' type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>'  value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
						      <?php wpsc_update_shipping_single_method(); ?>
				      <?php endif; ?>
				    </span>
				   </li>
		    <?php endwhile; ?>
		    </ul>
    </div>
    
    <div id="total">
      <ul>
        <li><?php echo wpsc_display_tax_label(true); ?><?php echo wpsc_cart_tax(); ?></li>
        <li>
          <?php if(wpsc_uses_coupons() && (wpsc_coupon_amount(false) > 0)): ?>
			      <?php echo __('Discount', 'wpsc'); ?>
		        <?php echo wpsc_coupon_amount(); ?>
	        <?php endif ?>
	      </li>
	      <li>
	        Total cu TVA <?php echo wpsc_cart_total(); ?>
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


