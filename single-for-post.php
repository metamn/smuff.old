<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
  <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
  <div class="entry span-16 last">
    <?php 
    	if (in_category(2237)) { // 2221 in localhost ?>
    		<div class="notice">
    			<h3>Acest produs nu se mai vinde pe Smuff</h3>
    		</div>
    		<?php 
    		
    		// Discontinued product
    		$imgs = post_attachements($post->ID);
        foreach ($imgs as $img) {
          $large = wp_get_attachment_image_src($img->ID, 'full'); ?>
          <div class="item">
            <img src="<?php echo $large[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/>
          </div><?php 
        }          
    	}
    
    	the_content('<p class="serif">Detalii &rarr;</p>');
    	if (!is_single(4721)) {
    		comments_template();
    		edit_post_link('Modificare articol.', '<p>', '</p>'); 
    	} ?>             
  </div>
  <div class="column span-16 last">      
    <?php include "post-meta-and-share.php" ?>	    				      
  </div>
</div>
<div class="clear"></div>

<?php
// On special posts insert more data
    // - summer sale 2012, 50% off
    if (is_single(4721)) { ?>
    	
    	<div id="promos" class="bestsellers block">
		        <h2>Produse cu reducere</h2>
		        <?php 
		          if ($specials) {
		            if ($specials->have_posts()) {
                  while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
                    if (in_category(10)) {
                      $medium = true;
                      include "product-thumb.php";
                    }                    
                  endwhile; 
                }		      
		          }
     		    ?>
     		   </div>
    
    <?php }?>
