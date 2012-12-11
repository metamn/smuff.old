<?php
  global $wpsc_cart, $wpdb, $wpsc_checkout, $wpsc_gateway, $wpsc_coupons;
  $wpsc_checkout = new wpsc_checkout();
  $wpsc_gateway = new wpsc_gateways();
  $wpsc_coupons = new wpsc_coupons($_SESSION['coupon_numbers']);
  if(wpsc_cart_item_count() > 0) :
?>


<div id="fb-root"></div>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '348406981918786', // App ID
			channelUrl : '//' + window.location.hostname + '/facebook-channel-url.php',
			status     : true, // check login status
			cookie     : true, // enable cookies to allow the server to access the session
			xfbml      : true  // parse XFBML
		});
		
		// listen for and handle auth.statusChange events
		FB.Event.subscribe('auth.statusChange', function(response) {
			if (response.authResponse) {
				// user has auth'd your app and is logged into Facebook
				FB.api('/me', function(me){
					if (me.name) {
						document.getElementById('auth-displayname').innerHTML = me.name;
						document.getElementById('wpsc_checkout_form_2').value = me.name;
						document.getElementById('wpsc_checkout_form_8').value = me.email;
					}
				})
				document.getElementById('auth-loggedout').style.display = 'none';
				document.getElementById('auth-loggedin').style.display = 'block';
				document.getElementById('checkout-form').style.display = 'block';
			} else {
				// user has not auth'd your app, or is not logged into Facebook
				document.getElementById('auth-loggedout').style.display = 'block';
				document.getElementById('auth-loggedin').style.display = 'none';
			}
		});
		
		// listen for and handle auth.login events
		FB.Event.subscribe('auth.login', function(response) {
			if (response.authResponse) {
				// user logs ins
				FB.api('/me', function(me) {
					if (me.email) {
						document.getElementById('wpsc_checkout_form_2').value = me.name;
						document.getElementById('wpsc_checkout_form_8').value = me.email;
					}	
				});
			}
		});
		
	};
	
	// Load the SDK Asynchronously
	(function(d){
		 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement('script'); js.id = id; js.async = true;
		 js.src = "//connect.facebook.net/en_US/all.js";
		 ref.parentNode.insertBefore(js, ref);
	 }(document));
</script>




<?php
    // Error messages for checkout
    if(count($_SESSION['wpsc_checkout_misc_error_messages']) > 0) {
	    echo "<div class='login_error'>\n\r";
	    foreach((array)$_SESSION['wpsc_checkout_misc_error_messages'] as $user_error ) {
		    echo $user_error."<br />\n";
	    }
	    echo "</div>\n\r";
    }
    $_SESSION['wpsc_checkout_misc_error_messages'] =array();
    
    // Error messages for invalid form fields
    while (wpsc_have_checkout_items()) : wpsc_the_checkout_item(); 
      if(wpsc_the_checkout_item_error() != ''): 
		    echo "<div class='login_error'>\n\r";
		    echo wpsc_the_checkout_item_error();
		    echo "</div>\n\r";
			endif;
    endwhile;
?>

<!--
<div id="announcement" class="block">
  <h4>Am facut mici schimbari la designul siteului Smuff. 
  <br/>
  Va rugam apasati CTRL+R (Refresh) pentru o experienta mai placuta. 
  Va multumim.</h4> 
</div>
-->

<table class="productcart">
	<tr class="firstrow">
		<td class='firstcol'></td>
		<td class='productname'><?php echo __('Produs'); ?></td>
		<td><?php echo __('Cantitate'); ?></td>
		<!--
		<?php if(wpsc_uses_shipping()): ?>
			<td><?php echo __('Livrare'); ?></td>
		<?php endif; ?>
		-->
		<td>Pret</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	
	<?php 
	  $wishlist = array();
	  $wishlist_title = array();
	?>
	<?php while (wpsc_have_cart_items()) : wpsc_the_cart_item(); ?>	
	  <?php 
	    // Getting the original post item for the product
	    $product_id = wpsc_cart_item_product_id();
	    $post_id = post_id($product_id);
	    
	    $stock = product_stock($product_id);
	    if ($stock > 0) { $delivery = $stock; }	   
	    
	    $link = get_permalink($post_id);
	    array_push($wishlist, $link . '?wpfpaction=add&postid=' . $post_id);     
	    array_push($wishlist_title, wpsc_cart_item_name());
	  ?>		
		<tr class="product_row">
			<td class="firstcol">
			  <a href="<?php echo $link ?>">
			    <img src="<?php echo wpsc_cart_item_image(128,128); ?>" alt="<?php echo wpsc_cart_item_name(); ?>" title="<?php echo wpsc_cart_item_name(); ?>" />
        </a>			   
			</td>
			<td class="productname firstcol">
			  <h4>
			    <a href="<?php echo $link ?>"><?php echo wpsc_cart_item_name(); ?></a>
			  </h4>
			</td>
			<td>
				<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
					<input type="text" name="quantity" size="2" value="<?php echo wpsc_cart_item_quantity(); ?>" />
					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
					<input type="hidden" name="wpsc_update_quantity" value="true" />
					<input type="submit" value="<?php echo __('Actualizare', 'wpsc'); ?>" name="submit" />
				</form>
			</td>
			<!--
			<?php if(wpsc_uses_shipping()): ?>
			<td><span class="pricedisplay" id='shipping_<?php echo wpsc_the_cart_item_key(); ?>'><?php echo wpsc_cart_item_shipping(); ?></span></td>
			<?php endif; ?>
			-->
			<td>
			  <h4>
			    <strong>
			    <span class="pricedisplay"><?php echo wpsc_cart_item_price(); ?></span>
			    </strong>
			  </h4>
			</td>
			
			<td>
				<form action="<?php echo get_option('shopping_cart_url'); ?>" method="post" class="adjustform">
					<input type="hidden" name="quantity" value="0" />
					<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>" />
					<input type="hidden" name="wpsc_update_quantity" value="true" />
					<button class='remove_button' type="submit"><span><?php echo __('Renunta'); ?></span></button>
				</form>
			</td>
		</tr>
	<?php endwhile; ?>
	
	<?php if(wpsc_uses_coupons()): ?>		
		<?php if(wpsc_coupons_error()): ?>
			<tr>
			  <td>&nbsp;</td>
			  <td colspan=4><div class="login_error"><?php echo __('Cuponul nu este valid'); ?></div></td>
			</tr>
		<?php endif; ?>
		<tr class="coupon">
			<td>&nbsp;</td>
			<td>
				<p>Daca aveti un cod promotional introduceti aici:</p>
			</td>
			<td  align='left'>
				<form  method='post' action="<?php echo get_option('shopping_cart_url'); ?>">				
					<input class="coupon" type='text' name='coupon_num' id='coupon_num' value='<?php echo $wpsc_cart->coupons_name; ?>' />
			</td>
			<td  colspan="2">
			  <input type='submit' value="<?php echo __('Recalculeaza') ?>" />		
				</form>
			</td>
		</tr>
		<?php endif; ?>	
	
	<!-- cant get cart total ...
	<tr class="subtotal">
	<td></td>
	<td>Subtotal</td>
	<td></td>
	<td>12 RON</td>
	<td></td>
	</tr>
	-->	
	</table>
	
	
	<?php if(isset($_SESSION['nocamsg']) && isset($_GET['noca']) && $_GET['noca'] == 'confirm'): ?>
		<p class='validation-error'><?php echo $_SESSION['nocamsg']; ?></p>
	<?php endif; ?>
	<?php if($_SESSION['categoryAndShippingCountryConflict'] != '') : ?>
		<p class='validation-error'><?php echo $_SESSION['categoryAndShippingCountryConflict']; ?></p>
	<?php
		$_SESSION['categoryAndShippingCountryConflict'] = '';
	endif;
	
	if($_SESSION['WpscGatewayErrorMessage'] != '') :
	?>
		<p class='validation-error'><?php echo $_SESSION['WpscGatewayErrorMessage']; ?></p>
	<?php
	endif;
	?>
	
		
		
	<?php 
	// Shipping module
	  do_action('wpsc_before_shipping_of_shopping_cart'); ?>
	
	<div id='wpsc_shopping_cart_container'>
	<?php if(wpsc_uses_shipping()) : ?>		
		<table class="shipping">						
			<?php if (wpsc_have_morethanone_shipping_quote()) :?>
				<?php while (wpsc_have_shipping_methods()) : wpsc_the_shipping_method(); ?>
						<?php if (!wpsc_have_shipping_quotes()) { continue; } // Don't display shipping method if it doesn't have at least one quote ?>						
						<?php $cnt = 0; ?>
						<?php while (wpsc_have_shipping_quotes()) : wpsc_the_shipping_quote();	?>
						  <tr><td class="c1"></td>
						  <?php if ($cnt == 0) { 
						    $cnt += 1;
						    echo '<td class="c2"><strong>Metoda de livrare</strong></td>';
						  } else { 
						    echo '<td class="c2"></td>';
						  } ?>							  
							<td class="c3"><?php echo wpsc_shipping_quote_name(); ?></td>
							<td class="c4"><?php echo wpsc_shipping_quote_value(); ?></td>
							<td class="c5">
								<?php if(wpsc_have_morethanone_shipping_methods_and_quotes()): ?>
									<input type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>' <?php echo wpsc_shipping_quote_selected_state(); ?>  onclick='switchmethod("<?php echo wpsc_shipping_quote_name(); ?>", "<?php echo wpsc_shipping_method_internal_name(); ?>")' value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
								<?php else: ?>
									<input <?php echo wpsc_shipping_quote_selected_state(); ?> disabled='disabled' type='radio' id='<?php echo wpsc_shipping_quote_html_id(); ?>'  value='<?php echo wpsc_shipping_quote_value(true); ?>' name='shipping_method' />
										<?php wpsc_update_shipping_single_method(); ?>
								<?php endif; ?>
							</td>
							</tr>
						<?php endwhile; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			
			<?php wpsc_update_shipping_multiple_methods(); ?>			
			<?php if (!wpsc_have_shipping_quote()) : // No valid shipping quotes ?>
				</table>
				</div>
				<?php return; ?>
			<?php endif; ?>
		</table>
	<?php endif;  ?>
	
	<table class="total">
	<?php if(wpsc_cart_tax(false) > 0) : ?>
		<tr>
			<td class="c1"></td>
			<td class="c2">
				<?php echo wpsc_display_tax_label(true); ?>
			</td>
			<td class="c3">
				<span id="checkout_tax" class="pricedisplay checkout-tax"><?php echo wpsc_cart_tax(); ?></span>
			</td>
		</tr>
	<?php endif; ?>
	
	<!--
	<?php if(wpsc_uses_shipping()) : ?>
		<tr class="total_price total_shipping">
			<td colspan="3">
				<?php echo __('Total Shipping', 'wpsc'); ?>
			</td>
			<td colspan="2">
				<span id="checkout_shipping" class="pricedisplay checkout-shipping"><?php echo wpsc_cart_shipping(); ?></span>
				</td>
		</tr>
	<?php endif; ?>
  -->
  
	  <?php if(wpsc_uses_coupons() && (wpsc_coupon_amount(false) > 0)): ?>
	  <tr class="discount">
		  <td>&nbsp;</td>
		  <td>
			  <?php echo __('Discount', 'wpsc'); ?>
		  </td>
		  <td>
			  <span id="coupons_amount" class="pricedisplay"><?php echo wpsc_coupon_amount(); ?></span>
	    </td>
   	</tr>
	  <?php endif ?>

		
	
	<tr>
		<td class="c1"></td>
		<td class="c2">
		  <h4><strong>Total cu TVA</strong></h4>
		</td>
		<td class="c3">
			<h4><strong><span id='checkout_total' class="pricedisplay checkout-total"><?php echo wpsc_cart_total(); ?></span></strong></h4>
		</td>
	</tr>	
	</table>
	
	


  <?php do_action('wpsc_before_form_of_shopping_cart'); ?>	
  <!--
	<div id="announcement" class="block">
    <h4>Am facut mici schimbari la designul siteului Smuff. 
    <br/>
    Va rugam apasati CTRL+R (Refresh) pentru o experienta mai placuta. 
    Va multumim.</h4> 
  </div>
  -->
	   
  <div id="checkout" class="block">
  	
		<form name='wpsc_checkout_forms' class='wpsc_checkout_forms' action='' method='post' enctype="multipart/form-data">	
					 
			<div id="order-by-phone" class="col column span-7 append-1">
				<h2>Comenzi prin telefon</h2>
				<h2 id="tel">0740-456127</h2>          
			</div>
			
			<div id="form" class="col column span-14 last">	    
				<h2>Finalizare comanda in 10 secunde</h2>
				
				<div id="checkout-form" class="<?php echo $checkout_klass ?>">
					<table class='wpsc_checkout_table'>
						<?php while (wpsc_have_checkout_items()) : wpsc_the_checkout_item(); ?>
							<?php if(wpsc_is_shipping_details()) : ?>
									
							<?php endif; ?>
		
							<?php if(wpsc_checkout_form_is_header() == true) : ?>
									
							<?php else: ?>
								<?php if((!wpsc_uses_shipping()) && $wpsc_checkout->checkout_item->unique_name == 'shippingstate'): ?>
								<?php else : ?>
										<tr <?php echo wpsc_the_checkout_item_error_class();?>>
										<td colspan=2>
											<label for='<?php echo wpsc_checkout_form_element_id(); ?>'>
											<?php echo wpsc_checkout_form_name();?>
											</label>
											<br/>
											<?php echo wpsc_checkout_form_field();?>				
											<?php if(wpsc_the_checkout_item_error() != ''): ?>
												<p class='validation-error'><?php echo wpsc_the_checkout_item_error(); ?></p>		    
											<?php endif; ?>
											
											<?php if (wpsc_checkout_form_element_id() == "wpsc_checkout_form_22") { ?>			              
												<br/><br/> 
												<div id="checkout-button" class="checkout-button-1">
													<?php //exit('<pre>'.print_r($wpsc_gateway->wpsc_gateways[0]['name'], true).'</pre>');
													 if(count($wpsc_gateway->wpsc_gateways) == 1 && $wpsc_gateway->wpsc_gateways[0]['name'] == 'Noca'){}else{?>
														<input type='hidden' value='submit_checkout' name='wpsc_action' />
														<input type='submit' value='Trimite comanda acum' name='submit' class='make_purchase' />
													<?php } ?>
												</div>
												
												<h4 id="checkout-personal-data">Date personale &rarr;</h4>
												<br/>
												<h4 id="checkout-billing-data">Date facturare &rarr;</h4>
											<?php } ?>
											
										</td>
										</tr>
		
								<?php endif; ?>		
							<?php endif; ?>		
						<?php endwhile; ?>		    
				
						<?php if (get_option('display_find_us') == '1') : ?>
						<tr>
							<td>How did you find us:</td>
							<td>
								<select name='how_find_us'>
									<option value='Word of Mouth'>Word of mouth</option>
									<option value='Advertisement'>Advertising</option>
									<option value='Internet'>Internet</option>
									<option value='Customer'>Existing Customer</option>
								</select>
							</td>
						</tr>
						<?php endif; ?>		
						<tr>
							<td colspan='2' class='wpsc_gateway_container'>
					
							<?php  //this HTML displays activated payment gateways?>
								
								<?php if(wpsc_gateway_count() > 1): // if we have more than one gateway enabled, offer the user a choice ?>
									<h3><?php echo __('Select a payment gateway', 'wpsc');?></h3>
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
						
						<tr>
							<td>
								
								<p class="termeni">
									Prin trimiterea comenzii va exprimati acordul cu 
									<a class='thickbox' target='_blank' href='<?php echo site_url('?termsandconds=true&amp;width=360&amp;height=400'); ?>' class='termsandconds'>Termenii si conditiile magazinului Smuff.</a>
								</p>
								<input type='hidden' value='yes' name='agree' />	
								
								<div id="checkout-button" class="checkout-button-2">
									<?php //exit('<pre>'.print_r($wpsc_gateway->wpsc_gateways[0]['name'], true).'</pre>');
									 if(count($wpsc_gateway->wpsc_gateways) == 1 && $wpsc_gateway->wpsc_gateways[0]['name'] == 'Noca'){}else{?>
										<input type='hidden' value='submit_checkout' name='wpsc_action' />
										<input type='submit' value='Trimite comanda acum' name='submit' class='make_purchase' />
									<?php } ?>	
								</div>
							</td>
						</tr>
					</table>	
				</div>
				
				<div id="login">
					<?php if(!is_user_logged_in()) {
						
						global $current_user;
						get_currentuserinfo(); 
						
						$checkout_klass = '';
						
						?>
						
						<div id="account" class="box">	
							<ul class="loginlist">
								<li id="smuff-account"><a href="<?php echo wp_login_url(get_option('shopping_cart_url'))?>" alt="Intrare / inregistrare cont" title="Intrare / inregistrare cont">Intrare in cont / Inregistrare cont Smuff</a></li>
								<li id="facebook-connect">
									<div id="auth-loggedout">
										<div class="fb-login-button" scope="email,user_birthday">Conectare cu Facebook</div>
									</div>
									<div id="auth-loggedin" style="display:none">
										<strong><span id="auth-displayname"></span></strong>, esti conectat cu Smuff prin Facebook.
									</div>
								</li>
								<li id="wishlist">
									<div id="wishlist-body">
										<?php 
											$favorite_post_ids = wpfp_get_users_favorites();	      
											if ($favorite_post_ids) { ?>
												<!-- Aveti <?php echo count($favorite_post_ids) ?> produs(e) in wishlist. -->
											<?php } 
										
											$post_ids = "";	        
											foreach ($wishlist as $post) {
												$post_ids .= $post .',';	          
											}
											// the last item is not added to the cart ...
											// ... so we always add a fake item to be the last	        
											$post_ids .= "http://localhost/smuff/2012/04/02/griffin-husa-de-supravietuire-pentru-iphone-44s-si-ipad-23/?wpfpaction=add&postid=4147,";	      
											
											$post_titles = "";	        
											foreach ($wishlist_title as $post) {
												$post_titles .= $post .'|';	          
											}
											$post_titles .= "Am completat wishlistul Dvs. cu success!|";
										?>	        
										<div id="add-to-wishlist" class="block">          
											<a rev="<?php echo $post_titles ?>" rel="<?php echo $post_ids ?>" href="<?php bloginfo('home')?>/wishlist">
												<img src="<?php bloginfo('stylesheet_directory'); ?>/img/heart.png" />
												<span id="text">Adaugare produse la Wishlist</span>
											</a>
										</div>
									</div>								
								</li>
							</ul>
						</div>
						
					<?php } else { 
						if (is_user_logged_in()) {
		
							$current_user = wp_get_current_user();
							if ( !($current_user instanceof WP_User) ) return; 
							
							$checkout_klass = 'active';
							
							?>
							
							
							<?php if (check_profile_info($current_user->ID)) { ?>
								<!--
								<p class="termeni">
								Prin trimiterea comenzii va exprimati acordul cu 
									<a class='thickbox' target='_blank' href='<?php echo site_url('?termsandconds=true&amp;width=360&amp;height=400'); ?>' class='termsandconds'>Termenii si conditiile magazinului Smuff.</a>
								</p>
								<p>
									 <button type='submit' name='submit' class='make_purchase'>Datele sunt ok. <br/>Trimit comanda</button>
								</p>
								-->
							<?php } else { ?>
								<p class="termeni">
									Datele de livrare/facturare nu sunt complete. Trebuie sa le completati o singura data <a href="http://www.smuff.ro/cont-cumparaturi/?edit_profile=true">aici.</a> 
								</p>
							<?php } ?>
							
							<div id="account" class="box">
								<ul class="info">
									<li>Nume utilizator: <?php echo $current_user->display_name ?></li>              
								</ul>
								<ul class="links">
									<li><a href="<?php bloginfo('home') ?>/cont-cumparaturi/">Istoric comenzi</a></li>
									<li><a href="<?php bloginfo('home') ?>/cont-cumparaturi/?edit_profile=true">Detalii facturare/livrare</a></li>
									<li><a href="<?php echo wp_logout_url(get_bloginfo('url')); ?>">Iesire din cont</a></li>
									<li><a href="<?php bloginfo('home') ?>/wp-admin/profile.php">Modificare cont utilizator</a></li>
								</ul>
							</div>          
						<?php } 
					} ?>   
	  		</div>
		</form>
	</div> <!-- checkout -->
	<div class="clear"></div>
	
	<div id="other-operations" class="block">
		<div id="back-to-shopping" class="column span-7 append-1">
			<script>
					document.write('<a href="' + document.referrer + '">&larr; Inapoi la cumparaturi</a>');
			</script>
		</div>
	</div>
	<div class="clear"></div>	    
	
</div>
<?php else: ?>  
  <h4>Cosul Tau este gol golut. <a href="<?php bloginfo('home') ?>">Aici te poti intoarce la cumparaturi.</a></h4>	
<?php endif;
do_action('wpsc_bottom_of_shopping_cart');
?>
