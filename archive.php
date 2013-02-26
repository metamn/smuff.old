<?php get_header(); ?>

<?php  
	
	$args = array();
	
	// Pagination
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$args['paged'] = $paged;
	$args['posts_per_page'] = '30';

  $cat = category_id(true, false, null); 
  if ($cat == 10) {
  	$meta_names = '';
  	$category_names = '';
  	$query_text = '';
  	
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
		
		// - search text
		if (!empty($text)) {
			$args['s'] = $text;
			$query_text = ' "' . $text . '" ';
		}
		
		// - price and delivery
		if ( !empty($price) || !empty($delivery)) {
			$args['meta_key'] = 'product_id'; // for getting the product ids
			global $price; // to pass variables
			global $delivery;
			add_filter('posts_where', 'custom_search'); // see in functions.php
		}
		
		// - price text 
		$price_text = '';
		if (!empty($price)) {
			$price_text = ' cu pretul intre ';
			foreach ($price as $p ) {
				$price_text .= $p;
				$price_text .= ' si ';
			}
			$price_text = rtrim($price_text, ' si ');
			$price_text .= ' lei ';
		}
		
		
		
		// - delivery text
		if (!empty($delivery)) {
			$delivery_text = ' cu livrare in  ';
			foreach ($delivery as $d ) {
				switch ($d) {
					case '1':
						$delivery_text .= '1-2 zile';
						break;
					case '2':
						$delivery_text .= '2-4 zile';
						break;	
					case 'not-set':
						$delivery_text .= '5-7 zile';
						break;
				}
				$delivery_text .= ' si ';
			}
		}
    $delivery_text = rtrim($delivery_text, ' si ');
    
    $wp_query = new WP_Query($args);
		if ( !empty($price) || !empty($delivery)) {
			remove_filter( 'posts_where', 'custom_search' );
		}
		
    $cat_name = $query_text . $meta_names . $price_text . $delivery_text . $category_names;
  } else {
  	// Single category or tag
  	$args['cat'] = $cat;
    $wp_query = new WP_Query($args);  
    $cat_name = ' in '. get_cat_name($cat);
  }
  
  
?>

<section itemscope itemtype="http://schema.org/CollectionPage" id="archive">  
	<hgroup>
	  
	  <header>
	    <a href="" title="<?php echo $cat_name ?>">
		    <h2>
			    <?php 
				    $found_posts = $wp_query->found_posts;
				    if ($found_posts == 1) {
					    $cadouri = ' cadou ';
				    } else {
					    $cadouri = ' cadouri ';
				    }
			    ?>
			    <?php echo $found_posts . $cadouri . $cat_name; ?>
		    </h2>
		  </a>
		  <span itemprop="url" class="hidden"><?php echo curPageURL2() ?></span>
		  <span itemprop="name" class="hidden"><?php echo $cat_name ?></span>
		</header>
	
	  	
		<?php include 'c_filters.php' ?>
			
	</hgroup>
	
	<?php 
		$ok = $wp_query->have_posts();
		if ($ok) { ?>
			<div itemscope itemtype="http://schema.org/ImageGallery" id="products">
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
							
							$show_excerpt = false;
							include "product-thumb.php";
							$counter += 1;
						} 
					endwhile; 
				?>		 
			</div>
		
	<?php } else { ?>
		<div id="no-search-results">
			<div class="notice">
				<h3>Nu am gasit nici un cadou.</h3>
				<p>Va rugam folositi motorul de cautare de mai jos.
				<br/>Cu cat alegeti mai multe criterii de cautare rezultatele vor fi mai putine.</p>
			</div>
		</div>	
	<?php } ?>
	
	
	<?php include 'c_categories.php' ?>
		
</section>

<?php get_footer(); ?>
