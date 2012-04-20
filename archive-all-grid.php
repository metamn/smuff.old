<?php
  // get all posts, not just 10/page
  $cat = category_id(true, false, null);    
  $all_posts = query_posts2('posts_per_page=-1&cat='.$cat);  
  $cat_name = '';
  if (!($cat == 10)) {
    $cat_name = ' din '. get_cat_name($cat);
  }
?>

<div id="archive-all" class="block">  
  <div id="content" class="column span-18 content">
    <div id='title' class='block'>
      <div id="left" class="column span-14 last">
        <h2>Toate produsele<?php echo $cat_name; ?></h2>
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
        while ($all_posts->have_posts()) : $all_posts->the_post(); update_post_caches($posts); 
		      $medium = true;        
          if (in_category(10)) { 
		        include "product-thumb.php";
		      } 
		    endwhile; 
		  ?>		
	    <p class="alignright">
	      <?php echo $all_posts->post_count . ' produse. ' ?>
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
