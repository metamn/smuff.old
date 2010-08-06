<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
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
	          echo "product > " . in_category(10);
	          if (in_category(10)) {
	            include "single-for-product.php";
	          } else {
	            include "single-for-post.php";
	          }
	        ?>      
	        <?php include "navigation.php"; ?>	

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
