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
		<div class="post" id="post-<?php the_ID(); ?>">
		  <h2><?php the_title(); ?></h2>  
		  
			<div class="entry block">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>							
			</div>
			
		</div>
		<?php endwhile; endif; ?>
	
   	
		<?php if (!(is_page(array(429, 430)))) { // no comments on the checkout page ?>
			<h3>Comentarii</h3>
			<div id="comments" class="block">
				<?php if (comments_open()) { comments_template(); } ?>
			</div>
		<?php } ?>
		
		<?php include 'c_subscribe-to-newsletter.php' ?>
	</div>   
	
	<?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>


