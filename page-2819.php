<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 
 
get_header(); 

?>

<div id="page" class="block wishlist">
  <div id="content" class="block">
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


