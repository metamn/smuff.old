<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
  <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
  <div class="entry span-16 last">
    <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
    <?php comments_template(); ?>              
  </div>
  <div class="share span-2 last">
    <?php include "share-twitter.php" ?>
    <br/>
    <?php if (function_exists('fbshare_manual')) echo fbshare_manual(); ?>
  </div>
</div>		    
		  
