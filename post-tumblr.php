<div id="post-<?php the_ID(); ?>" class="post block default">
  <div id="post-body" class="column span-18">
    <?php 
      $content = explode('<br/>', $post->post_content);
    ?>
    <div class="post-oneliner-header span-6">
      <a href="<?php echo get_category_link($main_category) ?>">#tumblr</a>
      <br/>
      <div class="tumblr-media">
        <?php echo $content[0]; ?>
      </div>
    </div>
    <div class="entry tumblr span-12 last">
      <a href="<?php the_permalink() ?>" title="Link direct la sursa articol"><?php echo $content[2]; ?></a>
      <!-- not dry, post-meta-share cannot be used here -->
      <div class="meta-and-share">
        <div class="meta span-4">
          <?php include "post-meta.php" ?>	
        </div>
        <div class="modify-post span-4 last">
          &nbsp;
          <?php edit_post_link('Modificare &rarr;', '', ''); 	?>
        </div>
        <div class="share span-4 last">
          <div class="facebook opacity-3 span-2 last">
            <?php if (function_exists('fbshare_manual')) echo fbshare_manual(); ?> 
          </div>
          <div class="twitter opacity-3 span-2 last">
            <?php include "share-twitter.php" ?>
          </div>
        </div>     
      </div>        
    </div> 					          
  </div>
  
  <div id="post-sidebar" class="column span-6 last">       
    <?php include "post-taxonomy.php" ?>
    <?php include "post-sponsor.php" ?>			           
  </div>
  
			          
</div>				
