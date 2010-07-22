<?php
global $wpsc_query, $wpdb;
?>

<!-- Adapted from shop theme single_product.php -->	
<!-- Do not use pagination in Admin/Settings !!!! -->



<?php while (wpsc_have_products()) :  wpsc_the_product(); ?>
  
  <?php if(wpsc_the_product_id() == $product_id) { ?>
	  <div class="single_product_display product_view_<?php echo wpsc_the_product_id(); ?>">
		  <div>
			  <div>						
				  <form class='product_form' enctype="multipart/form-data" action="<?php bloginfo('home'); ?>/cos-cumparaturi" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
					
					<?php /** the variation group HTML and loop */?>
					<div class="wpsc_variation_forms">
						<?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
							
								<label class="shop_form variation" for="<?php echo wpsc_vargrp_form_id(); ?>">Variatii:</label>
								<?php /** the variation HTML and loop */?>
								<select class='wpsc_select_variation shop_form' name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
								<?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
									<option value="<?php echo wpsc_the_variation_id(); ?>"  <?php echo wpsc_the_variation_out_of_stock(); ?> ><?php echo wpsc_the_variation_name(); ?></option>
								<?php endwhile; ?>
								</select> 
							
						<?php endwhile; ?>
					</div>
					<?php /** the variation group HTML and loop ends here */?>
									
					
					<!-- THIS IS THE QUANTITY OPTION MUST BE ENABLED FROM ADMIN SETTINGS -->
					<?php if(wpsc_has_multi_adding()): ?>
						<label class='wpsc_quantity_update shop_form quantity' for='wpsc_quantity_update'><?php echo TXT_WPSC_QUANTITY; ?>:</label>
						
						<input type="text" id='wpsc_quantity_update' class="shop_form quantity" name="wpsc_quantity_update" size="2" value="1"/>
						<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
						<input type="hidden" name="wpsc_update_quantity" value="true"/>
					<?php endif ;?>
					
					<div class="wpsc_product_price">
					  <?php if(wpsc_product_is_donation()) : ?>
						  <label for='donation_price_<?php echo wpsc_the_product_id(); ?>'><?php echo TXT_WPSC_DONATION; ?>:</label>
						  <input type='text' id='donation_price_<?php echo wpsc_the_product_id(); ?>' name='donation_price' value='<?php echo $wpsc_query->product['price']; ?>' size='6' />
						  <br />
					
					
					  <?php else : ?>
						  <?php if(wpsc_product_on_special()) : ?>
							  <span class='oldprice'>Pret vechi:</span> 
							  <span class="oldprice-value"><?php echo wpsc_product_normal_price(); ?></span><br />
						  <?php endif; ?>
						    <span id="product_price_<?php echo wpsc_the_product_id(); ?>" class="shop_form pricedisplay"><?php echo wpsc_the_product_price(); ?></span>
						    <b><?php echo TXT_WPSC_PRICE; ?>:</b><br/>
						  <?php if(wpsc_product_has_multicurrency()) : ?>
							  <?php echo wpsc_display_product_multicurrency(); ?>
						  <?php endif; ?>
						  <?php if(get_option('display_pnp') == 1) : ?>
							  <span class="pricedisplay"><?php echo wpsc_product_postage_and_packaging(); ?></span><?php echo TXT_WPSC_PNP; ?>:  <br />
						  <?php endif; ?>						
					  <?php endif; ?>
					</div>
						
					<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
					<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
							
					<?php if(wpsc_product_is_customisable()) : ?>				
						<input type="hidden" value="true" name="is_customisable"/>
					<?php endif; ?>
					
					<label class="shop_form stoc">Stoc:</label>
					<?php
            $stoc = product_stock($product_id); 
            if ($stoc > 0) {
              echo "Avem";
            } else {
              echo "Nu avem";
            } 
          ?>
          <br/>
          <label class="shop_form livrare">Livrare:</label>
          <?php echo product_delivery_time($stoc) ?> 
					
					<!-- END OF QUANTITY OPTION -->
					<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow') !='1')) : ?>
						<?php if(wpsc_product_has_stock()) : ?>
							<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
										<?php	$action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
										<input class="wpsc_buy_button" type='button' value='Adauga la cos' onclick='gotoexternallink("<?php echo $action; ?>")'>
										<?php else: ?>
									<input type='submit' class='add-button' id='product_<?php echo wpsc_the_product_id(); ?>_submit_button' class='add-button' name='Buy'  value="Adauga la cos" />

										<?php endif; ?>
														
							
						<?php else : ?>
							<p class='soldout'><?php echo TXT_WPSC_PRODUCTSOLDOUT; ?></p>
						<?php endif ; ?>
					<?php endif ; ?>
					</form>
					
					<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow') =='1')) : ?>
						<?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
					<?php endif ; ?>
					
					<?php echo wpsc_product_rater(); ?>
						
						
					<?php
						if(function_exists('gold_shpcrt_display_gallery')) :
					
							echo gold_shpcrt_display_gallery(wpsc_the_product_id());
						endif;
					?>
				</div>
		
				<form onsubmit="submitform(this);return false;" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
					<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
					<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
				</form>
			</div>			
	  
  <?php } endwhile; ?>
  
	<?php
	if(function_exists('fancy_notifications')) {
		echo fancy_notifications();
	}
	?>
</div>		
