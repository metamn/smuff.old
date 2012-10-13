<?php  
  $cat = category_id(true, false, null);    
  
  if ($cat == 10) {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $all_posts = new WP_Query('posts_per_page=30&cat=10&paged=' . $paged);
    $cat_name = '';
  } else {
    $all_posts = new WP_Query('posts_per_page=-1&cat='.$cat);  
    $cat_name = ' din '. get_cat_name($cat);
  }
?>

<div id="archive-all" class="block">  
  <div id="content" class="block">
		<div id="archive-header" class="block">
			<h1>
				Toate cadourile<?php echo $cat_name; ?>
				<?php if (!($cat == 10)) { ?>
					 (<span id="search-counter">...</span>)
				<?php } ?>
			</h1>
    
			<?php if ($cat == 10) { ?>
				<div id="navigation" class="block">
					<?php if(function_exists('wp_paginate')) {
						wp_paginate();
					} ?>  
				</div>
			<?php } ?>
		</div>
    
    <?php include 'search-enhanced.php' ?>
    
    
    <div id="archive-all-grid" class="bestsellers block">
      <?php if ($all_posts->have_posts()) : 
        $counter = 1;
        while ($all_posts->have_posts()) : $all_posts->the_post(); update_post_caches($posts); 
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
		      
		      if ($counter == 10) {                      
            // deal of the week  
            //$dow_posts = query_posts2('posts_per_page=1&cat=2135');     
            //include 'c_summer-2012.php';
          }
		    endwhile; 
		  ?>		  
		  <?php else : 
        include "not-found.php";  
	    endif; ?>
	  </div>
	  <div class="clear"></div>	  
	  
	  <?php include 'search-enhanced.php' ?>
	  
	  <div id="archive-header" class="block">
			<h1>
				Toate cadourile<?php echo $cat_name; ?>
				<?php if (!($cat == 10)) { ?>
					 (<span id="search-counter">...</span>)
				<?php } ?>
			</h1>
    
			<?php if ($cat == 10) { ?>
				<div id="navigation" class="block">
					<?php if(function_exists('wp_paginate')) {
						wp_paginate();
					} ?>  
				</div>
			<?php } ?>
		</div>
    
	  
  </div>
  

</div>

<?php get_footer(); ?>
