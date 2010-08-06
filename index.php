<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); 
?>
	<div id="blog" class="block">	  
    <div class="block">
      <div id="blog-intro" class="column span-18">&nbsp;
        <?php include "blog-intro.php" ?>
      </div>
      <div class="column span-6 last opacity">
        <?php include "home-menu.php" ?>
      </div>
    </div>	
	
	  <div id="content" class="block">
	    <?php if (have_posts()) : ?>
		    <?php while (have_posts()) : the_post(); ?>
		      <?php 
		        if (in_category(10)) { //produse
		          $main_category = 10;
		          include "post-product.php";		          
		        } elseif (in_category(39)) { //comment
		          $main_category = 39;
		          include "post-comment.php";
		        } elseif (in_category(26)) { //tumblr
		          $main_category = 26; //post
		          include "post-tumblr.php";
		        } elseif (in_category(18)) { //social
		          $main_category = 18;
		          include "post-social.php";
		        } else {
		          $main_category = 22; // Stiri
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
