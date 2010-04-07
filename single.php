<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

	<div id="single" class="block">
	  <div id="content" class="column span-18">
      <?php include "home-all-products-link.php"; ?>    
    
      <div id="post" class="block">
	      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
	      
	        <?php 
	          if (in_category(47)) {
	            include "single-product.php";
	          } else {
	            include "single-post.php";
	          }
	        ?>      
	        <?php include "navigation.php"; ?>	

	      <?php endwhile; else: ?>
		      <p>Va cerem scuze, articolul cautat nu exista.</p>
        <?php endif; ?>
      </div>
	  </div>
	
	  <?php get_sidebar(); ?>
	    
  </div>	
  
  <?php get_footer(); ?>
