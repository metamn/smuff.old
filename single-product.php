	      
<?php 
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
  <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>			    
  <div id="top-section" class="block">			      
    <div id="post-images" class="column span-12 last">
      <?php 
        $imgs = post_attachements($post->ID);
        $img = $imgs[0];  
        $large = wp_get_attachment_image_src($img->ID, 'full');                			        
      ?>
      <div id="large-image">
        <img class="large-image" src="<?php echo $large[0]?>" />
      </div>
      <div id="single-scroll" class="scrollable">
        <div class="items">
        <?php $img_count = 0; ?>
        <?php foreach ($imgs as $img) {
          $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
          $large = wp_get_attachment_image_src($img->ID, 'full'); ?>
          <div class="item">
            <img class="small-image" src="<?php echo $thumb[0]?>" rev="<?php echo $large[0]?>"/>
          </div>
        <?php 
          $img_count = $img_count + 1;
        } ?>
          <div class="item">
            &nbsp;
          </div>
        </div>
      </div>
      <?php if ($img_count > 4) { ?>
        <div class="clearfix"></div>
        <div class="navi"></div>			          
      <?php } ?>
    </div>
    
    <div class="column span-6 last">
      <div id="post-shopping" class="box">
        <?php include "shop-form.php" ?>
      </div>
      <div id="post-operations" class="box">         
         <?php edit_post_link('Modificare articol', '<span class="ui-icon ui-icon-document"/></span>', '<hr/>'); ?>
         <?php include "share-twitter.php" ?>
      </div>
    </div>
  </div>

  <div class="entry">
    <div id="accordion">
      <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
        
      <h3>Comentarii</h3>
      <div class="pane">
        <?php comments_template(); ?>
      </div>
      
      <h3>Informatii technice despre acest articol</h3>
      <div class="pane">
        <ul>
          <li>Adresa trackback: <a href="<?php trackback_url(); ?>"><?php trackback_url(); ?></a></li>
          <li><?php post_comments_feed_link('Urmarire articol prin RSS'); ?></li>
          <li>Numar vizualizari articol: <?php if(function_exists('the_views')) { the_views(); } ?>  </li>
          <li>Creat <?php the_time('l, j F Y') ?> ora <?php the_time('G:i') ?> de <?php the_author() ?></li>
        </ul>
      </div>
    </div>
  </div>
  
    
  <div id="recommended">    
     <?php
        $related_posts = MRP_get_related_posts($post->ID, true);
        if ($related_posts) { ?>        
          <h3>Produse similare</h3>
          <?php foreach ($related_posts as $post) {
            setup_postdata($post);
            $product_id = product_id($post->ID);
            $product_price = product_price($post->ID);
            $product_name = product_name($product_id); 
            $product_stoc = product_stock($product_id);
            $imgs = post_attachements($post->ID);
            $img = $imgs[0];  
            $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
            include "product-thumb.php";
          }
        } 
      ?>
  </div>
  <div class='clearfix'></div>
  
</div>

