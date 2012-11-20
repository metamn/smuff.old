<section id="hot">
	<?php 
		$thumbs = array();
		
		$thumbs_special = array();
		$thumbs_new = array();
		
		if ($special_posts) {
			while ($special_posts->have_posts()) : $special_posts->the_post(); update_post_caches($posts);
				$imgs = post_attachements($post->ID);
				$img = $imgs[0];
				$thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
				$large = wp_get_attachment_image_src($img->ID, 'large');

				$title = get_the_title();

				$th = '<div class="item"><a class="tooltip2" title="' . $title . '" data-link="' . get_permalink() . '" data-image="' . $large[0] . '" data-excerpt="' . get_the_excerpt() . '" data-price="" data-sale-price="" >';
				$th .= '<img src="' . $thumb[0] . '" alt="' . $title . '" />';
				$th .= '<h4 class="tooltip-text">' . $title . '</h4></a></div>';
				$thumbs_special[] = $th;
			endwhile;
		}
		
		
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
					$th .= '<h4 class="tooltip-text">' . $product_name . '</h4></a></div>';
					$thumbs_new[] = $th;  
			endwhile;
		}
	?>
	
	<div id="slider" clas="hot">
		<div id="large-image">
			<a href="" title="" alt="">
				<img src="" title="" alt="" />
			</a>
		</div>
	
		<div id="large-image-title"> 
			<div id="text">
				<h1>Nou!</h1>
			</div>
			<div id="info">
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
 
	<div id="thumbs">
		<div id="items" class="thumb">
			<?php 
				$thumbs = array_merge($thumbs_special, $thumbs_new);
			
				if ($thumbs) { 
					foreach ($thumbs as $thumb) { 
						echo $thumb;
					} 
				} ?>
		</div>
	</div>
	
	
	<div id="more">
		<h4>
			Vezi toate noutatiile Smuff
			<br/>
			(sau click aici)
		</h4>
	</div>
	
	<div id="noutati">
		<div id="items" class="hot">
			<?php 
				if ($thumbs) {
					$counter = 1;
					foreach ($thumbs as $thumb) { ?>
						<div class="item c<?php echo $counter ?>"> 
							<div id="large-image">
								<a href="" title="" alt="">
									<img src="" title="" alt="" />
								</a>
							</div>
						
							<div id="large-image-title"> 
								<div id="text">
									<h1>Nou!</h1>
								</div>
								<div id="info">
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
					<?php 
						$counter += 1;
					}
				}
			?>
		</div>
	</div>
	
</section>

