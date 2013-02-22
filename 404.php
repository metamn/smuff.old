<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<div id="page" class="block">
  <div id="content" class="column span-18">
	  <h1>Pagina nu a fost gasita</h1>
	  <div class="notice">
	  	<p>Va cere m scuze, articolul cautat nu exista, sau a fost mutat la o alta adresa.</p>
	  </div>
	  
	  <?php include 'search-enhanced.php' ?>
	  
	  <h3>In continuare va prezentam toate articolele de pe Smuff</h3>
	  <ol>
	  <?php 
	    $allposts = get_posts('numberposts=-1&offset=0');
      foreach($allposts as $post) { ?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php } ?>
	  </ol>
	</div>    
	
	<?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>

	
