	      
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
        </div>
      </div>
      <?php if ($img_count > 4) { ?>
        <div class="clearfix"></div>
        <div class="navi"></div>			          
      <?php } ?>
      
      
    </div>
    
    <div id="post-meta" class="column span-6 last">
      <div id="post-shopping" class="box">
        <?php //include "shop-form.php" ?>
        <?php 
          $product_id = get_post_meta($post->ID, 'product_id', single);
          if ($product_id) {        
            echo wpsc_display_products_page('product_id='.$product_id);         
          }      
        ?>
      </div>
      <div id="post-operations" class="box">         
         <?php edit_post_link('Modificare articol', '<span class="ui-icon ui-icon-document"/></span>', '<hr/>'); ?>
         <table>
          <tr>
            <td><?php include "share-twitter.php" ?></td>
            <td><?php include "share-facebook.php" ?></td>
            <!--<td><?php include "share-facebook-like.php" ?></td>-->
          </tr>
          </table>           
      </div>
      <div id="post-sponsor">        
        In parteneriat cu
        <br/>  
        <?php 
          $main_cat = page_name(false, true, $post->ID);          
          $sponsor = sponsor_post($main_cat);
          if ($sponsor) {
            $link = get_post_meta($sponsor->ID, 'Link', true);
            $imgs = post_attachements($sponsor->ID);
            $img = $imgs[0];
            $medium = wp_get_attachment_image_src($img->ID, 'medium'); ?>
                        
            <a target="_blank" href="<?php echo $link ?>" title="<?php echo $sponsor->post_title ?>" alt="<?php $sponsor->post_title ?>">
              <img class="half-banner" src="<?php echo $medium[0] ?>" title="<?php $sponsor->post_title ?>" alt="<?php $sponsor->post_title ?>"/>
            </a>
          <?php } else { ?>
            <a href="<?php bloginfo('home')?>/<?php echo get_page_uri(2277)?>" title="Cum devin partener Smuff?">
              <img class="half-banner" src="<?php bloginfo('stylesheet_directory')?>/img/empty-logo.jpg" /></a>      
          <?php } ?>              
      </div>      
    </div>
  </div>
 

  <div class="entry">
    <div id="accordion">
      <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
        
      <h3>Comentarii</h3>
      <div class="pane">
        <?php comments_template('', true); ?>
      </div>
      
      <h3>Informatii technice despre acest articol</h3>
      <div class="pane">
        <ul>
          <li>Adresa trackback: <a href="<?php trackback_url(); ?>"><?php trackback_url(); ?></a></li>
          <li><?php post_comments_feed_link('Urmarire articol prin RSS'); ?></li>
          <li>Numar vizualizari articol: <?php if(function_exists('the_views')) { the_views(); } ?>  </li>
          <li>Creat <?php the_time('l, j F Y') ?> ora <?php the_time('G:i') ?> de <?php the_author() ?></li>
          <li>Categorii: <?php the_category(', ') ?></li>
          <li><?php the_tags('Etichete: ', ', ', ''); ?></li>
          <?php edit_post_link('Modificare articol.', '<p>', '</p>'); ?>
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
            $medium = false;
            include "product-thumb.php";
          }
        } 
      ?>
  </div>
  <div class='clearfix'></div>
  
</div>

