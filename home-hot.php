<div id="home-hot" class="block <?php echo $home_hot_klass ?>">
	<?php 
		$thumbs = array();
		
		if ($new_products) {
			while ($new_products->have_posts()) : $new_products->the_post(); update_post_caches($posts);
				$imgs = post_attachements($post->ID);
				$img = $imgs[0];
				$thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
				$large = wp_get_attachment_image_src($img->ID, 'large');
										
				$product_id = product_id($post->ID);
				if ($product_id) {
					// It is a product
					$product_price = product_price($post->ID);
					$product_discount = product_discount($product_id);
					if ($product_discount > 0) {
						$product_sale_price = $product_price - $product_discount;
					} else {
						$product_sale_price = '';
					}
					$product_name = product_name($product_id);
					$title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
				} else {
					// It is not a product
					$product_name = get_the_title();
					$product_price = '';
					$product_sale_price = '';
					$large = array();
					$large[] = get_bloginfo('stylesheet_directory') . '/img/dotted_bg.png';
					$thumb = array();
					$thumb[] = get_bloginfo('stylesheet_directory') . '/img/dotted_bg.png';
				}	
					$th = '<div class="item"><a class="tooltip2" title="' . $product_name . '" data-link="' . get_permalink() . '" data-image="' . $large[0] . '" data-excerpt="' . get_the_excerpt() . '" data-price="' . $product_price . '" data-sale-price="' . $product_sale_price . '" >';
					$th .= '<img src="'.$thumb[0].'" alt="'.$product_name.'" />';
					$th .= '<span class="tooltip-text">' . $product_name . '</span></a></div>';
					$thumbs[] = $th;  
			endwhile;
		}
	?>
	
	<div id="slider" class="column span-18 append-1">
		<div id="large-image">
			<a href="" title="" alt="">
				<img src="" title="" alt="" />
			</a>
		</div>
	
		<div id="large-image-title" class="block"> 
			<div id="text" class="column span-3 last">
				Nou!
			</div>
			<div id="info" class="column span-13 last">
				<div class="arrow-right"></div>
				<a href="" title="" alt="">
					<h3 id="title"></h3>
					<p id="excerpt"></p>
					<div id="price">
						<span class="price"></span> 
						<span class="old-price"></span>
						<span class="normal-price"></span> 
						<span class="lei"> Lei</span>
					</div>
				</a>
			</div>  
		</div>   
	</div>
 
	<div id="thumbs" class="column span-5 last">
		<div id="items">
			<?php if ($thumbs) { 
				foreach ($thumbs as $thumb) {
					echo $thumb;
				}
			} ?>
		</div>
	</div>
	
</div>

