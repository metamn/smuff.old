<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 

get_header(); 

?>

<div id="page" class="block">
  <div id="content" class="column span-18">
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<?php include 'single-post-or-page.php'; ?>
		
		<?php endwhile; endif; ?>
	</div>   
	
	<?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>


