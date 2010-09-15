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
		  
		  
			<div class="entry column span-18">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>				
			</div>
			
			<?php 
			  $subs = get_pages('child_of='.$post->ID);
			  if ($subs) { ?>
			    <div class="subpages">
		        Informatii aditionale: 
		        <ul class="inline-list">
		          <?php wp_list_pages('child_of='.$post->ID.'&title_li='); ?>
		        </ul>
		      </div>
			<?php } ?>
			
			<?php if ( is_page('despre-noi') || $post->post_parent == 331 || in_array( 331, $post->ancestors) ) { ?>
		    <div class="subpages">
		      Alte informatii: 
		      <ul class="inline-list">
		        <?php wp_list_pages('child_of=331&depth=1&title_li='); ?>
		      </ul>
		    </div>		    
			<?php } ?>
		</div>
		<?php endwhile; endif; ?>
		
		<?php if (comments_open()) {comments_template();}  ?>
		
	  <?php edit_post_link('Modificare pagina.', '<p>', '</p>'); ?>
	</div>    
	
	<?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>


