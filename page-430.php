<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<div id="page" class="block page-coscumparaturi">
  <div id="content" class="column span-24 last">
  
    
    <div id="pricing-policy-details" class="block hidden">
      Describe here the pricing policy ........
      <div id="close">[x] inchide</div>
    </div>
  
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>		  
			  <div class="entry block">
				  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>							
			  </div>
		  </div>
		<?php endwhile; endif; ?>
	</div>    
</div>	
  
<?php get_footer(); ?>


