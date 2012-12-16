<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();


    // On special posts insert more data
    // - summer sale 2012, 50% off
    if (is_single(4721)) {
    	$specials = query_posts2('posts_per_page=-1&cat=15');
    }
?>


	<div id="single" class="block">
	  <div id="content" class="column span-18">
	  	
	    <?php if (is_blog()) { ?>
	      <div id="blog-intro" class="block">
          <?php include "blog-intro.php" ?>
        </div>
	    <?php } ?>
      <div id="post" class="block">
	      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
	      
	        <?php 	          
	          if ((in_category(10)) || (in_category(2237))) { //2221
	            include "single-for-product.php";
	          } else {
	          	if (in_category('colectii')) {
	          		include "single-for-groups.php";
	          	} else {
								include "single-for-post.php";
								include "navigation.php";
							}
	          }
	        ?>      
	        	

	      <?php endwhile; else: ?>
		      <p>Va cerem scuze, articolul cautat nu exista.</p>
        <?php endif; ?>
      </div>
	  </div>
	
	  <?php 
	    if (in_category(10)) {
	      get_sidebar(); 
	    } else {
	      include "sidebar-blog.php";
	    }
	  ?>
	    
  </div>	
  
  <?php get_footer(); ?>
