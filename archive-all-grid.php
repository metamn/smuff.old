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
  <div id="content" class="column span-18 content">
    <div id='title' class='block'>
      <div id="left" class="column span-14 last">
        <h2>
          Toate cadourile<?php echo $cat_name; ?>
          <?php if (!($cat == 10)) { ?>
             (<span id="search-counter">...</span>)
          <?php } ?>
        </h2>
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
    
    <!--
    <div id="announcement" class="block">
      <h4>Am facut mici schimbari la designul siteului Smuff. 
      <br/>
      Va rugam apasati CTRL+R (Refresh) pentru o experienta mai placuta. 
      Va multumim.</h4> 
    </div>
    -->
    
    <?php if ($cat == 10) { ?>
      <div id="navigation" class="block">
        <?php if(function_exists('wp_paginate')) {
          wp_paginate();
        } ?>  
      </div>
    <?php } ?>
    
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
		  <?php else : 
        include "not-found.php";  
	    endif; ?>
	  </div>
	  <div class="clear"></div>	  
	  <span id="search-count" class="hidden"><?php echo $counter; ?></span>
	  <h4 class="all-products-link">
      <a class="all-products-link" title="Inapoi la inceputul paginii" href="#header">
      Inapoi la inceputul paginii &uarr;</a>
    </h4>
	  
	  <?php if ($cat == 10) { ?>
      <div id="navigation" class="block">
        <?php if(function_exists('wp_paginate')) {
          wp_paginate();
        } ?>  
      </div>
    <?php } ?>
  </div>
  
  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
