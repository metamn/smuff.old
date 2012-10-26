<?php  

	echo '<br/>';
	print_r($price);
	
	echo '<br/>';
	print_r($delivery);
	
	echo '<br/>';
	print_r($meta);
	
	echo '<br/>';
	print_r($categories);
	
	echo '<br/>';
	print_r($text);

  $cat = category_id(true, false, null); 
  if ($cat == 10) {
  	$args = array();
  	$meta_names = '';
  	$category_names = '';
  	
  	// Handle the search query
  	// - meta
  	if (!empty($meta)) {
  		$args['category__and'] = $meta;
  		
  		foreach ($meta as $c) {
  			switch ($c) {
  				case 10:
  					$meta_names .= ' noi,';
  					break;
  				case 14:
  					$meta_names .= ' cele mai vandute,';
  					break;
  				case 15:
  					$meta_names .= ' cu pret redus,';
  					break;
  			}
  		}
  		$meta_names = rtrim($meta_names, ',');
  	}
  	
  	// - categories
  	if (!empty($categories)) {
  		$args['category__in'] = $categories;
  	
  		if (count($categories) > 1) {
  			 $category_names = ' din categoriile';
  		} else {
  			$category_names = ' din categoria';
  		}
  		foreach ($categories as $c) {
  			$category_names .= ' ' . get_cat_name($c) . ',';
  		}
  		$category_names = rtrim($category_names, ',');
  	} else {  	
			// - add "Produse" as a default category
			// - this will make "Toate cadourile" work
			$args['cat'] = 10;
		}
  	
  	// Pagination
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args['paged'] = $paged;
    $args['posts_per_page'] = '30';
    
    print_r($args);
    
    $wp_query = new WP_Query($args);
    $cat_name = $meta_names . $category_names;
  } else {
  	// Single category or tag
    $wp_query = new WP_Query('posts_per_page=-1&cat='.$cat);  
    $cat_name = ' din '. get_cat_name($cat);
  }
  
  
?>

<div id="archive-all" class="block">  
  <div id="content" class="block">
  	
		<div id="archive-header" class="block">
			<h1>
				<?php echo $wp_query->found_posts; ?> cadouri <?php echo $cat_name; ?>
			</h1>
					
			<div id="navigation" class="block">
				<?php if(function_exists('wp_paginate')) {
					wp_paginate();
				} ?>  
			</div>
		</div>
		
		<?php 
  		$ok = $wp_query->have_posts();
  		if ($ok) { 
  		
  			include 'search-enhanced.php' ?>
				
				<div id="archive-all-grid" class="bestsellers block">
				<?php
						$counter = 1;
						while ($wp_query->have_posts()) : $wp_query->the_post(); update_post_caches($posts); 
							$medium = true;        
							if (in_category(10)) { 
								if ($cat == 0 || $cat == 10) {
									$show_category = true;         
								} else {
									$show_category = false;         
								}
								include "product-thumb.php";
								$counter += 1;
							} 
						endwhile; 
					?>		 
				</div>
				<div class="clear"></div>	  
	  
	      <?php include 'search-enhanced.php' ?>
	  
				<div id="archive-header" class="block">
					<h1>
						Toate cadourile<?php echo $cat_name; ?>
					</h1>
							
					<div id="navigation" class="block">
						<?php if(function_exists('wp_paginate')) {
							wp_paginate();
						} ?>  
					</div>
				</div>
			
		<?php } else { ?>
			<div id="no-search-results" class="notice block">
				<h3>Nu am gasit nici un cadou.</h3>
				<p>Va rugam folositi motorul de cautare de mai jos.
				<br/>Cu cat alegeti mai multe criterii de cautare rezultatele vor fi mai putine.</p>
			</div>			
			<?php include 'search-enhanced.php' ?>
		<?php } ?>
		
  </div>
  

</div>

<?php get_footer(); ?>
