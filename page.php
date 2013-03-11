<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 

get_header(); 

?>

<section id="page">
  <article id="page-content">
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	  
	    <header id="article-title">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
        <h1 itemprop="name">
		      <?php the_title(); ?>
	      </h1>
	    </a>
	  </header>
		
		<div id="content">
		  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
		</div>
		
		<?php endwhile; endif; ?>
	</article>   
	
	<aside id="sidebar">
	</aside>
	  
</section>	
  
<?php get_footer(); ?>


