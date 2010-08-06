<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<div id="page" class="block">
  <div id="content" class="column span-18">
	  <h2 class="center"><?php _e('Error 404 - Not Found', 'kubrick'); ?></h2>
	  <h4>Va cerem scuze, articolul cautat nu exista, sau a fost mutat la o alta adresa.
	    <br/>
	    Pentru a-l gasi puteti folosi motorul de cautare in partea dreapta, sau sa consultati 
	    <a href="<?php bloginfo('home'); ?>/arhiva">Arhiva Smuff</a>.  
	  </h4>
	  
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

	
