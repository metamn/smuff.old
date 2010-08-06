<div id="archive-blog" class="block">  
  <div id="content" class="column span-18 content">
    
    <div id="blog-intro" class="block">
      <?php include "blog-intro.php" ?>
    </div>
  
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post();  ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <h2>
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
          <div class="entry">
					   <?php the_content('Read the rest of this entry &raquo;'); ?>
				  </div>
				  <p class="postmetadata">
				  <span class="date"><?php the_time('j M Y') ?> <?php the_time('G:i') ?></span>, de <?php the_author(); ?>
          <br/>
				  <?php the_tags('Etichete: ', ', ', '<br />'); ?> 
				  Categorii: <?php the_category(', ') ?> | 
				  <?php edit_post_link('Modificare', '', ' | '); ?>  
				  <?php comments_popup_link('Fara comentarii &rarr;', '1 comentariu &rarr;', '% comentarii &rarr;'); ?></p>
        </div>        
      <?php endwhile; 
      wp_paginate();
      ?>		  
		<?php else : 
      include "not-found.php";  
	  endif; ?>
  </div>
  
  <?php include "sidebar-blog.php" ?>

</div>

<?php get_footer(); ?>
