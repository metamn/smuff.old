<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
  <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
  <div class="entry span-16 last">
    <?php the_content('<p class="serif">Detalii &rarr;</p>'); ?>
    <?php comments_template(); ?> 
    <?php edit_post_link('Modificare articol.', '<p>', '</p>'); ?>             
  </div>
  <div class="column span-16 last">      
    <?php include "post-meta-and-share.php" ?>	    				      
  </div>
</div>		    
		  
