<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 

get_header(); 

?>

<section id="page">
  <header id="title">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
      <h1 itemprop="name">
	      <?php the_title(); ?>
      </h1>
    </a>
	</header>
  
  <article>
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
	
		<?php endwhile; endif; ?>
	</article>   
	
	<aside id="sidebar">
	  sidebar ....
	</aside>
	  
</section>	
  
<?php get_footer(); ?>


