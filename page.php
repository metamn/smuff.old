<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<div id="page" class="block">
  <div id="content" class="column span-18">
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		  <h2><?php the_title(); ?></h2>
		  
		  <?php if ( is_page('despre-noi') || $post->post_parent == 331 || in_array( 331, $post->ancestors) ) { ?>
		    <ul class="inline-list">
		      <?php wp_list_pages('child_of=331&title_li='); ?>
		    </ul>
			<?php } ?>
			
			<div class="entry column span-18">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>				
			</div>
		</div>
		<?php endwhile; endif; ?>
		
		<?php if (comments_open()) {comments_template();}  ?>
		
	  <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
	</div>    
	
	<?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>


