<?php
  /*
  Template Name: Partnerlist
   * @package WordPress
   * @subpackage Default_Theme
   */

  get_header();
?>

<?php 
  $partners = query_posts2('posts_per_page=-1&cat=96');    
?>

<div id="page" class="partners block">
  <div id="content" class="column span-18">
	  
	  <!-- display normal content of the page -->
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
			
		</div>
		<?php endwhile; endif; ?>
		
		<?php if (comments_open()) {comments_template();}  ?>
		
	  <?php edit_post_link('Modificare pagina.', '<p>', '</p>'); ?>
		
		
		<!-- display sponsor list -->
		<?php if ($partners->have_posts()) : ?>
		  <br/>
		  <br/>
      <h3>Lista partenerilor Smuff</h3>
      <table id="partners-table" class="tablesorter">
      <thead><tr>
        <th class="no-sort">Partener</th>
        <th class="header">Inceput</th>
        <th class="header">Sfarsit</th>
        <th class="header">Categorie</th>        
      </tr></thead>
      <tbody>
		  <?php while ($partners->have_posts()) : $partners->the_post(); update_post_caches($posts); 
		    $imgs = post_attachements($post->ID);
        $img = $imgs[0];  
        $medium = wp_get_attachment_image_src($img->ID, 'medium'); 
		  ?>
			  <tr>
			    <td>
			      <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		          <img class="half-banner" src="<?php echo $medium[0]?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>"/></a>
		      </td>
		      <td><?php the_time('j M Y') ?></td>
		      <td><?php 
		        $endtime = get_post_meta($post->ID, 'parteneriat-sfarsit', true);
		        if ($endtime) {
		          $split = explode('-', $endtime);
		          $m = (int)$split[1];
		          $d = (int)$split[2];
		          $y = (int)$split[0];
		          $time = mktime(0, 0, 0, $m, $d, $y);
		          echo date('j M Y', $time);
		        }
		      ?></td>
		      <td>
		        <?php 
		          $sponsor = get_sponsor_category3(get_post_categories_array($post), 96);		          
		          echo $sponsor;
		        ?>
		      </td>
			  </tr>
			<?php endwhile; ?>
			</tbody>
		  </table>
		  <p class="alignright"><a href="#partners-table">[ &uarr; Top ]</a></p>
		<?php endif; ?>	
				
	</div>    
	
	<?php get_sidebar(); ?>	    
</div>	


<?php get_footer(); ?>
