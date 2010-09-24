<div id="post-<?php the_ID(); ?>" class="post block default">
  <div id="post-body" class="column span-18">
    <?php 
      $content = explode('<!--more-->', $post->post_content);      
    ?>
    <div class="post-oneliner-header span-6">
      <a href="<?php echo get_category_link($main_category) ?>">#international</a>
      <br/>
      <div class="tumblr-media">
        <?php echo $content[0]; ?>
      </div>
    </div>
    <div class="entry span-12 last">
      <div class="tumblr">
        <h3><a class="title" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
        <?php echo $content[1]; ?>
      </div>
      <!-- not dry, post-meta-share cannot be used here -->
      <div class="meta-and-share">
        <div class="meta block">
          <?php include "post-meta-and-share.php" ?>	
        </div>                   
      </div>        
    </div> 					          
  </div>
  
  <div id="post-sidebar" class="column span-6 last">       
    <?php include "post-taxonomy.php" ?>
    <?php include "post-sponsor.php" ?>			           
  </div>
  
			          
</div>				
