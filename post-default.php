
<div id="post-<?php the_ID(); ?>" class="post block default">
  <div id="post-body" class="column span-18">
    <h2>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="Link pentru <?php the_title_attribute(); ?>"><?php the_title(); ?></a>      
    </h2>      
    
    <div class="entry">
      <?php 
        the_content('Detalii &rarr;');        
      ?>
    </div> 					      
    
    <?php include "post-meta-and-share.php" ?>
  </div>
  
  <?php include "post-taxonomy.php" ?>
  
			          
</div>				     
