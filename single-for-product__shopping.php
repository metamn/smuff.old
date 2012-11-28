<div id="shopping">
	<?php 
		if (in_category(10)) {
			// $product_id = get_post_meta($post->ID, 'product_id', single);
			if ($product_id) {
				if ($product_stock != '-1') {
					echo wpsc_display_products_page('product_id='.$product_id); ?>
					
					<div id="wishlist" class="block">
						<?php 
						if (function_exists('wpfp_link')) { wpfp_link(); } ?>
					</div> <?php
				} else { ?>
					<div id="product-discontinued">
						<h3>Acest produs momentan<br/>nu este pe stoc.</h3>
						<p>Anunta-ma cand va fi disponibil.</p>
						<?php 
							$mailchimp_button = 'Anunta-ma';
							$mailchimp_param = $product_name;
							include 'mailchimp-direct.php'; 
						?>
					</div> <?php
				}
			}
		} else { ?>
			<div id="product-discontinued">
				<h3>Acest produs este discontinuat.</h3>
			</div> <?php
		} ?>
</div>