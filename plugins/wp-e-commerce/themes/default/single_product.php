<?php
  global $wpsc_query, $wpdb;
  $image_width = get_option('single_view_image_width');
  $image_height = get_option('single_view_image_height');
?>

<div id='products_page_container' class="wrap wpsc_container">		
	<?php do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search ?>
	
	<div class="productdisplay">
	  <?php /** start the product loop here, this is single products view, so there should be only one */?>
		  <?php while (wpsc_have_products()) :  wpsc_the_product(); 
		    $product_id = wpsc_the_product_id();   
		  ?>
			  <div class="single_product_display product_view_<?php echo wpsc_the_product_id(); ?>">
				  <div class="textcol">
					<?php if(get_option('show_thumbnails')) :?>
					<div class="imagecol">
						<?php if(wpsc_the_product_thumbnail()) :?>
									<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_image($image_width, $image_height); ?>" />
								
						<?php else: ?> 
							<div class="item_no_image">
								<a href="<?php echo wpsc_the_product_permalink(); ?>">
								<span>No Image Available</span>
								</a>
							</div>
						<?php endif; ?> 
					</div>
					<?php endif; ?> 
		
					<div class="producttext">						  
					    <form class='product_form' enctype="multipart/form-data" action="<?php echo curPageURL(); ?>" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
					    
					      <?php 					        
					        $product_data['sku'] = get_product_meta($product_id, 'sku', true);
					        $delivery = product_delivery_time($product_data['sku']);
					      ?>
					    
					      <span class='delivery'>
		              <span>Livrare in <?php  echo $delivery ?></span>
		            </span>
		            
		            <div class='cart-operations'>
					      
					      <?php /** the variation group HTML and loop */?>
					      <div class="wpsc_variation_forms">
						      <?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
							      
								        <?php /** the variation HTML and loop */?>
								        <label class="select">
								        <select class='wpsc_select_variation' name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
								        <?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
									        <option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?> (<?php echo wpsc_the_variation_price(); ?>)</option>
								        <?php endwhile; ?>
								        </select> 
							          </label>
						      <?php endwhile; ?>
					      </div>
					      <?php /** the variation group HTML and loop ends here */?>
								
			          <!-- THIS IS THE QUANTITY OPTION MUST BE ENABLED FROM ADMIN SETTINGS -->
			          <?php if(wpsc_has_multi_adding()): ?>
			          <!--
				          <tr class='quantity'><td>
				            <label class='wpsc_quantity_update' for='wpsc_quantity_update[<?php echo wpsc_the_product_id(); ?>]'>Cantitate:</label>
				          </td><td class='right'>
				            <input type="text" id='wpsc_quantity_update' name="wpsc_quantity_update[<?php echo wpsc_the_product_id(); ?>]" size="2" value="1"/>
				            <input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
				            <input type="hidden" name="wpsc_update_quantity" value="true"/>
				          </td></tr>
				        -->
			          <?php endif ;?>
					
						    <span class="wpsc_product_price">
							    <?php if(wpsc_product_is_donation()) : ?>
								    <label for='donation_price_<?php echo wpsc_the_product_id(); ?>'><?php echo __('Donation', 'wpsc'); ?>:</label>
								    <input type='text' id='donation_price_<?php echo wpsc_the_product_id(); ?>' name='donation_price' value='<?php echo $wpsc_query->product['price']; ?>' size='6' />
								    <br />													
							    <?php else : ?>
								      <?php if(wpsc_product_on_special()) {
								        $klass = 'on-sale';
								      } else {
								        $klass = '';
								      } ?>
								      
								      <span class="price normal-price <?php echo $klass ?>">
								        <span id="product_price_<?php echo wpsc_the_product_id(); ?>" class="pricedisplay"><?php echo wpsc_the_product_price(); ?></span>
								         <?php if(wpsc_product_on_special()) : ?>
								          <span class="price oldprice <?php echo $klass ?>"><span class='oldprice'><?php echo wpsc_product_normal_price(); ?></span></span> 
								        <?php endif; ?>
								      </span>  
								      
								      
								      						
							      <?php endif; ?>
						    </span>
					      
					      <?php if(function_exists('wpsc_akst_share_link') && (get_option('wpsc_share_this') == 1)) {
						      echo wpsc_akst_share_link('return');
					      } ?>
					      
						   
					      <input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
					      <input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
							
					      <?php if(wpsc_product_is_customisable()) : ?>				
						      <input type="hidden" value="true" name="is_customisable"/>
					      <?php endif; ?>
					      
					      <!--
					      <tr class='stock'><td>
					        <label>Stoc:</label>
					      </td><td class='right'>
					        <?php                    
                    if ($stoc > 0) {
                      echo "Avem";
                    } else {
                      echo "Nu avem";
                    } 
                  ?>  
					      </td></tr>
					      -->
					      
					      
					      
					      
					      
					      										
					      <!-- END OF QUANTITY OPTION -->
					      
					      
					      <?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow') !='1')) : ?>
						      <?php if(wpsc_product_has_stock()) : ?>
							      <?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
								      <?php	$action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
								      <span class="add-to-cart-button">
								        <input class="wpsc_buy_button" type='button' value='<?php echo __('Buy Now', 'wpsc'); ?>' onclick='gotoexternallink("<?php echo $action; ?>")'>
								      </span>
							      <?php else: ?>
							        <span class="add-to-cart-button">
							          <span id="quantity">
								          <label class="select">
								            <select>
								            <?php for ($i = 1; $i <= 15; $i++) { ?>
								              <option><?php echo $i ?> buc.</option>
								            <?php } ?>
								            </select>
								          </label>
								        </span>
								        
								        <input type="submit" value="Adauga la cos" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
								        
								      </span>
							      <?php endif; ?>							  		
							     
							      <span class='checkout'>
							        <FORM>
                        <INPUT TYPE="BUTTON" class='checkout-button' VALUE="Cos cumparaturi" ONCLICK='gotoexternallink("<?php echo bloginfo(home) ?>/cos-cumparaturi")'>
                      </FORM>							        
							      </span> 
					            
					            
							      <span class='animation'>
							        <span class='wpsc_loading_animation'>
								        <img title="Loading" alt="Loading" src="<?php echo WPSC_URL ;?>/images/indicator.gif" class="loadingimage" />
								          Actualizare cos...
							        </span>
							        <span class='wpsc_cart_message'>
							        </span>
							      </span>							      
							      							
						      <?php else : ?>
							      <p class='soldout'><?php echo __('This product has sold out.', 'wpsc'); ?></p>
						      <?php endif ; ?>
					      <?php endif ; ?>
					      
					      
					     </div> <!-- cart operations -->
					      
					 
					</form>
					
					
	        <?php if(count($cart_messages) > 0) { ?>  
            <ul>
            <?php foreach((array)$cart_messages as $cart_message) { ?>
              <li><?php echo $cart_message; ?></li>
            <?php } ?>
            </ul>	
          <?php } ?>
          
          
					
					<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow')=='1')) : ?>
						<?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
					<?php endif ; ?>
					
					<?php echo wpsc_product_rater(); ?>
						
						
					<?php
						if(function_exists('gold_shpcrt_display_gallery')) :					
							echo gold_shpcrt_display_gallery(wpsc_the_product_id());
						endif;

						echo wpsc_also_bought(wpsc_the_product_id());
					?>					
					</div>
		
					<form onsubmit="submitform(this);return false;" action="<?php echo curPageURL(); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
					</form>
				</div>
			</div>
		</div>
		
		<?php echo wpsc_product_comments(); ?>
<?php endwhile; ?>
<?php /** end the product loop here */?>

		<?php
		if(function_exists('fancy_notifications')) {
			echo fancy_notifications();
		}
		?>
	

</div>
