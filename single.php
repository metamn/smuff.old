<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>


<div id="single" class="block">
	<div id="content" class="block">
		
		<div id="post" class="block">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
			
				<?php include "single-for-product.php"; ?>      

			<?php endwhile; else: ?>
				<p>Va cerem scuze, articolul cautat nu exista.</p>
			<?php endif; ?>
		</div>
	</div>    
</div>	

<?php get_footer(); ?>
