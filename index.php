<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); 
?>
	<div id="blog" class="block">	  
    <div class="block">
      <div class="column span-18">&nbsp;
        something here is a must !!!!
      </div>
      <div class="column span-6 last">
        <?php include "home-menu.php" ?>
      </div>
    </div>	
	
	  <div id="content" class="block">
	    <?php if (have_posts()) : ?>
		    <?php while (have_posts()) : the_post(); ?>
		      <?php 
		        if (in_category(47)) {
		          $main_category = 47;
		          include "post-product.php";		          
		        } elseif (in_category(75)) {
		          $main_category = 75;
		          include "post-comment.php";
		        } elseif (in_category(76)) {
		          $main_category = 78;
		          include "post-tumblr.php";
		        } elseif (in_category(77)) {
		          $main_category = 78;
		          include "post-social.php";
		        } else {
		          $main_category = 47;
		          include "post-default.php";		          
		        }
		      ?>		  		       
		    <?php endwhile; ?>		    
        <?php wp_paginate(); ?>		    
	    <?php else :
        include "not-found.php";  		    
	    endif; ?>
	</div>
</div>

<?php get_footer(); ?>
