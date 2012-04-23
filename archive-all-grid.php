<?php
  // get all posts, not just 10/page
  $cat = category_id(true, false, null);    
  $all_posts = query_posts2('posts_per_page=200&cat='.$cat);  
  $all_posts2 = &new WP_Query("posts_per_page=200&offset=200&cat=".$cat);
  $all_posts3 = &new WP_Query("posts_per_page=200&offset=400&cat=".$cat);            
  
  $cat_name = '';
  if (!($cat == 10)) {
    $cat_name = ' din '. get_cat_name($cat);
  }
?>

<div id="archive-all" class="block">  
  <div id="content" class="column span-18 content">
    <div id='title' class='block'>
      <div id="left" class="column span-14 last">
        <h2>Toate cadourile<?php echo $cat_name; ?></h2>
      </div>
      <div id="right" class="column span-4 last">
        Lista | 
        <?php 
          $title = 'Tabela';
          $link_type = '2'; // 2=table view, 3=grid view
          include "home-all-products-link.php";
        ?>
      </div>
    </div>
    
    <div id="archive-all-grid" class="bestsellers block">
      <?php if ($all_posts->have_posts()) : 
        $counter = 0;
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
		    endwhile; 
		  ?>		  
		  
		  <?php while ($all_posts2->have_posts()) : $all_posts2->the_post(); update_post_caches($posts); 
	      $medium = true;        
        if (in_category(10)) { 
	        include "product-thumb.php";
	        $counter += 1;
	      } 
	    endwhile; ?> 
		  
		  <?php while ($all_posts3->have_posts()) : $all_posts3->the_post(); update_post_caches($posts); 
	      $medium = true;        
        if (in_category(10)) { 
	        include "product-thumb.php";
	        $counter += 1;
	      } 
	    endwhile; ?> 
		  
		  
	    <p class="alignright">
	      <?php echo $counter . ' produse. ' ?>
	      <a href="#archive-all">[ &uarr; Top ]</a>
	    </p>		  	  
		  <?php else : 
        include "not-found.php";  
	    endif; ?>
	  </div>
  </div>
  
  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
