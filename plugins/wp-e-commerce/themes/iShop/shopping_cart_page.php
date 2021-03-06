<?php
global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons;
$wpsc_checkout = new wpsc_checkout();
$wpsc_gateway = new wpsc_gateways();
$wpsc_coupons = new wpsc_coupons($_SESSION['coupon_numbers']);
//echo "<pre>".print_r($wpsc_cart,true)."</pre>";
if(wpsc_cart_item_count() > 0) :
?>
<p><?php echo TXT_WPSC_REVIEW_YOUR_ORDER; ?></p>

<p>
  Campurile marcate cu * sunt obligatorii.
</p>

<p>
  Daca doriti factura pe firma va rugam completati campurile Cod Unic de Inregistrare, Nr. Registru, Banca si IBAN.
</p>


<table class="productcart">
	<tr class="firstrow">
		<td class='firstcol'></td>
		<td><?php echo TXT_WPSC_PRODUCT; ?></td>
		<td><?php echo TXT_WPSC_QUANTITY; ?></td>
		<td><?php echo TXT_WPSC_PRICE; ?></td>
		<td></td>
	</tr>
	<?php while (wpsc_have_cart_items()) : wpsc_the_cart_item();
	  
	  // Getting the original post item for the product
	  $product_id = wpsc_cart_item_product_id();
	  $post_id = post_id($product_id);
	  $link = get_permalink($post_id); ?>  
		
		<tr class="product_row">
			<td class="firstcol">
			  <a href="<?php echo $link ?>">
			    <img src='<?php echo wpsc_cart_item_image(48,48); ?>' alt='<?php echo wpsc_cart_item_name(); ?>' title='<?php echo wpsc_cart_item_name(); ?>' /></a>
			</td>
			<td class="firstcol">
			<a href="<?php echo $link ?>"><?php echo wpsc_cart_item_name(); ?></a>
			</td>
			<td>
				<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
					<input type="text" id="update_quantity" name="quantity" size="2" value="<?php echo wpsc_cart_item_quantity(); ?>"/>
					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
					<input type="hidden" id="update_quantity_button" name="wpsc_update_quantity" value="true"/>
					<input type="submit" value="<?php echo TXT_WPSC_APPLY; ?>" name="submit"/>
				</form>
			</td>
			<td><?php echo wpsc_cart_item_price(); ?></td>
			<td>
			
				<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
					<input type="hidden" name="quantity" value="0"/>
					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
					<input type="hidden" name="wpsc_update_quantity" value="true"/>
					<button class='remove_button' type="submit"><span><?php echo TXT_WPSC_REMOVE; ?></span></button>
				</form>
			</td>
		</tr>
	<?php endwhile; ?>
	
	<?php //this HTML displays coupons if there are any active coupons to use ?>
  <?php //exit('<pre>'.print_r($wpsc_coupons, true).'</pre>'); ?>
	<?php if(wpsc_uses_coupons()): ?>		
		<?php if(wpsc_coupons_error()): ?>
			<tr><td><?php echo TXT_WPSC_COUPONSINVALID; ?></td></tr>
		<?php endif; ?>
		<tr class="coupon">
			<td colspan="2">Cod promotie :</td>
			<td  colspan="2" align='left'>
			<form  method='post' action="<?php echo get_option('shopping_cart_url'); ?>">
				<input type='text' id="coupon_code" name='coupon_num' id='coupon_num' value='<?php echo $wpsc_cart->coupons_name; ?>' />
			</td>
			<td>
				<input type='submit' value='Trimitere cod' />
			</form>
			</td>
		</tr>
	<?php endif; ?>	
	
	<?php  //this HTML dispalys the calculate your order HTML	?>
	<?php if(isset($_SESSION['nocamsg']) && isset($_GET['noca']) && $_GET['noca'] == 'confirm'): ?>
		<p class='validation-error'><?php echo $_SESSION['nocamsg']; ?></p>
	<?php endif; ?>
	<?php if($_SESSION['categoryAndShippingCountryConflict'] != '') : ?>
		<p class='validation-error'><?php echo $_SESSION['categoryAndShippingCountryConflict']; ?></p>
	<?php
	endif;
	if($_SESSION['WpscGatewayErrorMessage'] != '') :
	?>
		<p class='validation-error'><?php echo $_SESSION['WpscGatewayErrorMessage']; ?></p>
	<?php
	endif;
	?>
	
	<tr class="shipping">
	  <td colspan=2>Livrare :</td>
	  <td>	    
	    <input type="radio" name="shipping_method" id="checkout_shipping" value="8">
	      Posta Romana, cu plata la livrare: 8.00 RON
	    <br/>
	    <input type="radio" name="shipping_method" id="checkout_shipping" value="23">
	      Fan Curier, cu plata la livrare: 23.00 RON
	    <br/>
	    <input type="radio" name="shipping_method" id="checkout_shipping" value="18" checked="checked">
	      Fan Curier, cu plata prin transfer bancar: 18.00 RON
	    <br/>
	    <input type="radio" name="shipping_method" id="checkout_shipping" value="0">
	      Ridicare din sediu Tg. Mures: 0.00 RON  	  
	   <br/><br/>
	   * Toate preturile au TVA inclus	   
	  </td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	  <?php if(wpsc_uses_coupons() && (wpsc_coupon_amount(false) > 0)): ?>
	    <tr>	  
	    <td colspan=3><?php echo TXT_WPSC_COUPONS; ?></td>
	    <td><?php echo wpsc_coupon_amount(); ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>		
	  <?php endif ?>	
    <tr class="total_price">	  
    <td colspan=3><?php echo TXT_WPSC_TOTALPRICE; ?></td>
    <?php 
      $total = 18.00 + wpsc_cart_total();      
    ?>
    <td><span class="checkout_total_price"><?php echo $total . ".00 RON" ?></span>
      <input type="hidden" name="checkout_original_price" value="<?php echo wpsc_cart_total(); ?>" />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
	</table>  
	<?php do_action('wpsc_before_form_of_shopping_cart'); ?>
		
		
		
			
	<form class='wpsc_checkout_forms' action='' method='post' enctype="multipart/form-data">
	
	   <?php 
	   /**  
	    * Both the registration forms and the checkout details forms must be in the same form element as they are submitted together, you cannot have two form elements submit together without the use of JavaScript.
	   */
	   ?>

	 <?php if(!is_user_logged_in() && get_option('users_can_register') && get_option('require_register')) : ?>
		<h2><?php _e('Not yet a member?');?></h2>
		<p><?php _e('In order to buy from us, you\'ll need an account. Joining is free and easy. All you need is a username, password and valid email address.');?></p>
		<?php	if(count($_SESSION['wpsc_checkout_user_error_messages']) > 0) : ?>
			<div class="login_error"> 
				<?php		  
				foreach($_SESSION['wpsc_checkout_user_error_messages'] as $user_error ) {
				  echo $user_error."<br />\n";
				}
				$_SESSION['wpsc_checkout_user_error_messages'] = array();
				?>			
		  </div>
		<?php endif; ?>
		
		
	  <fieldset class='wpsc_registration_form'>
			<label><?php _e('Username'); ?>:</label><input type="text" name="log" id="log" value="" size="20"/>
			<label><?php _e('Password'); ?>:</label><input type="password" name="pwd" id="pwd" value="" size="20" />
			<label><?php _e('E-mail'); ?>:</label><input type="text" name="user_email" id="user_email" value="<?php echo attribute_escape(stripslashes($user_email)); ?>" size="20" />
		</fieldset>
	<?php endif; ?>

  <div class="spacer2">&nbsp;</div>
	<h3><?php echo TXT_WPSC_CONTACTDETAILS; ?></h3>
	<?php/* echo TXT_WPSC_CREDITCARDHANDY; <br /> */?>	
	<?php
	  if(count($_SESSION['wpsc_checkout_misc_error_messages']) > 0) {
			echo "<div class='login_error'>\n\r";
			foreach((array)$_SESSION['wpsc_checkout_misc_error_messages'] as $user_error ) {
				echo $user_error."<br />\n";
			}
			echo "</div>\n\r";
		}
		$_SESSION['wpsc_checkout_misc_error_messages'] =array();
	?>
	<table class='wpsc_checkout_table'>
		<?php while (wpsc_have_checkout_items()) : wpsc_the_checkout_item(); ?>
			<?php if(wpsc_is_shipping_details()) : ?>
					<tr>
						<td colspan ='2'>
							<br />
							<input type='checkbox' value='true' name='shippingSameBilling' id='shippingSameBilling' />
							<label for='shippingSameBilling'>Adresa de livrare este acelasi ca adresa de facturare?</label>						
							<br/>
							<input type='checkbox' value='true' name='contactBefore' id='contactBefore' />
							<label for='contactBefore'>Doriti sa fiti contactat telefonic de catre curierat inainte de livrare?</label>
							<br/><br/>
						</td>
					</tr>
					<br/>
			<?php endif; ?>

		  <?php if(wpsc_checkout_form_is_header() == true) : ?>
		  		<tr <?php echo wpsc_the_checkout_item_error_class();?>>
			<td <?php if(wpsc_is_shipping_details()) echo "class='wpsc_shipping_forms'"; ?> colspan='2'>
				<h4>
					<?php echo wpsc_checkout_form_name();?>
				</h4>
			</td>
				</tr>
		  <?php else: ?>
		  <?php if((!wpsc_uses_shipping()) && $wpsc_checkout->checkout_item->unique_name == 'shippingstate'): ?>
		  <?php else : ?>
		  		<tr <?php echo wpsc_the_checkout_item_error_class();?>>
			<td>
				<label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
				<?php echo wpsc_checkout_form_name();?>:
				</label>
			</td>
			<td>
				<?php echo wpsc_checkout_form_field();?>
				
		    <?php if(wpsc_the_checkout_item_error() != ''): ?>
		    <p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>
		    
			<?php endif; ?>
			</td>
			</tr>
			<?php endif; ?>
		
			<?php endif; ?>
		
		<?php endwhile; ?>
		
		
		
		<tr>
			<td colspan='2'>
			
			<?php  //this HTML displays activated payment gateways?>
			  
				<?php if(wpsc_gateway_count() > 1): // if we have more than one gateway enabled, offer the user a choice ?>
					<h3><?php echo TXT_WPSC_SELECTGATEWAY;?></h3>
					<?php while (wpsc_have_gateways()) : wpsc_the_gateway(); ?>
						<div class="custom_gateway">
							<?php if(wpsc_gateway_internal_name() == 'noca'){ ?>
								<label><input type="radio" id='noca_gateway' value="<?php echo wpsc_gateway_internal_name();?>" <?php echo wpsc_gateway_is_checked(); ?> name="custom_gateway" class="custom_gateway"/><?php echo wpsc_gateway_name();?></label>
							<?php }else{ ?>
								<label><input type="radio" value="<?php echo wpsc_gateway_internal_name();?>" <?php echo wpsc_gateway_is_checked(); ?> name="custom_gateway" class="custom_gateway"/><?php echo wpsc_gateway_name();?></label>
							<?php } ?>

							
							<?php if(wpsc_gateway_form_fields()): ?> 
								<table class='<?php echo wpsc_gateway_form_field_style();?>'>
									<?php echo wpsc_gateway_form_fields();?> 
								</table>		
							<?php endif; ?>			
						</div>
					<?php endwhile; ?>
				<?php else: // otherwise, there is no choice, stick in a hidden form ?>
					<?php while (wpsc_have_gateways()) : wpsc_the_gateway(); ?>
						<input name='custom_gateway' value='<?php echo wpsc_gateway_internal_name();?>' type='hidden' />
						
							<?php if(wpsc_gateway_form_fields()): ?> 
								<table>
									<?php echo wpsc_gateway_form_fields();?> 
								</table>		
							<?php endif; ?>	
					<?php endwhile; ?>				
				<?php endif; ?>				
				
			</td>
		</tr>
		
		<input type="hidden" id="checkout_shipping_price" name="how_find_us" value='filled_by_ajax' />
		
		<?php if(get_option('terms_and_conditions') != '') : ?>
		<tr>
			<td colspan='2'>
     			 <input type='checkbox' value='yes' name='agree' /> <?php echo TXT_WPSC_TERMS1;?><a class='thickbox' target='_blank' href='<?php
      echo get_option('siteurl')."?termsandconds=true&amp;width=360&amp;height=400'"; ?>' class='termsandconds'><?php echo TXT_WPSC_TERMS2;?></a>
   		   </td>
 	   </tr>
		<?php endif; ?>	
		<tr>
			<td colspan='2'>
				<?php if(get_option('terms_and_conditions') == '') : ?>
					<input type='hidden' value='yes' name='agree' />
				<?php endif; ?>	
				<?php //exit('<pre>'.print_r($wpsc_gateway->wpsc_gateways[0]['name'], true).'</pre>');
				 if(count($wpsc_gateway->wpsc_gateways) == 1 && $wpsc_gateway->wpsc_gateways[0]['name'] == 'Noca'){}else{?>
					<input type='hidden' value='submit_checkout' name='wpsc_action' />
					<input type='submit' value='<?php echo TXT_WPSC_MAKEPURCHASE;?>' name='submit' class='make_purchase' />
				<?php }/* else: ?>
				
				<br /><strong><?php echo TXT_WPSC_PLEASE_LOGIN;?></strong><br />
				<?php echo TXT_WPSC_IF_JUST_REGISTERED;?>
				</td>
				<?php endif;  */?>				
			</td>
		</tr>
	</table>
</form>
<?php
else:
	echo TXT_WPSC_BUYPRODUCTS;
endif;
do_action('wpsc_bottom_of_shopping_cart');
?>
