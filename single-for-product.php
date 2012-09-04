	      
<?php 
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_name = product_name($product_id);
  $title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
  
  $postid = $post->ID;
  
  $cat = category_id(false, true, $postid); 
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
        <a href="<?php echo $large[0]?>" class="product-zoom" title="<?php echo $title ?>" alt="<?php echo $title ?>">
          <img class="large-image" src="<?php echo $large[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/>
        </a>
      </div>
      <div id="single-scroll" class="scrollable">
        <div class="items">
        <?php $img_count = 0; ?>
        <?php foreach ($imgs as $img) {
          $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
          $large = wp_get_attachment_image_src($img->ID, 'full'); ?>
          <div class="item">
            <img class="small-image" src="<?php echo $thumb[0]?>" rev="<?php echo $large[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/>
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
        
        <div id="wishlist">
          <?php if (function_exists('wpfp_link')) { wpfp_link(); } ?>
        </div>
      </div>
      
      <div id="shopping-info" class="box"> 
        <ul>                
          <li id="tooltip-trigger" class="shopping-info">
            Cum cumpar? informatii despre pret, shopping, livrare, retur si garantie          
          </li>
          <div id="tooltip-content">
            <ul>
              <li>Preturi corecte, servicii stabile si asistenta rapida.</li>
              <li>Shopping simplu fara procedura de inregistrare</li>
              <li>Livrare se face acasa sau la birou</li>
              <li>Plata se face la livrare, ramburs, sau prin OP</li>
              <li>Satisfactie sau returnare produs in 10 zile</li>
              <li>Garantie tehnica cel putin 1 an</li>
            </ul>
            <span id="tooltip-close">X inchide</span>
          </div>          
        </ul>               
      </div>      
       
    </div>
  </div>
 
  <!--
  <div id="announcement" class="block">
    <h4>Am facut mici schimbari la designul siteului Smuff. 
    <br/>
    Va rugam apasati CTRL+R (Refresh) pentru o experienta mai placuta. 
    Va multumim.</h4> 
  </div>
  -->

  <div class="entry">
    <div class="block">
      <div id="post-operations" class="column span-18 last">                
        <table>
          <tr>          
            <td><?php include "share-twitter.php" ?></td>
            <td><?php include "share-facebook-like.php" ?></td>
            <td><?php include "share-facebook.php" ?></td>
            <td><?php include "share-pinterest.php" ?></td>
            <td><g:plusone size="medium"></g:plusone></td>
          </tr>
        </table>                     
      </div>
      
      <!--
      <div id="post-sponsor" class="column span-6 last">      
        <span class="text">In parteneriat cu</span>
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
      --> 
    </div>
    
    
    <div id="accordion" class="block">
      <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
        
      <h3 id="comments">Comentarii</h3>
      <div class="pane normal">
        <?php comments_template('', true); ?>
      </div>
      
      <!--
      <h3>Alte informatii</h3>
      <div class="pane normal">
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
      -->
    </div>
    
    <div id="post-shopping2" class="block">
      <div id="post-shopping" class="box">
        <?php //include "shop-form.php" ?>
        <?php 
          $product_id = get_post_meta($post->ID, 'product_id', single);
          if ($product_id) {        
            echo wpsc_display_products_page('product_id='.$product_id);         
          }      
        ?>
      </div>
      
      <?php include "shopping-incentives.php"; ?>    
    </div> 
  </div>
  
  
  
  <!--
  <div id="cadouri" class="block">
    <h3>Produse oferite cadou</h3>
    <p>
      La fiecare comanda pana <b>1 ianuarie</b> noi punem un cadou, unul dintre cele prezentate aici.
      <br/>
      Surpriza este ca nimeni nu stie care dintre acestea va fi al lui. Speram sa va placa, speram sa va bucurati mult de Gadgeturile Smuff.
    </p>
    <?php 
      $specials = query_posts2('posts_per_page=-1&cat=1318');
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
  
  -->
  
  
  
  <?php 
    $collections = query_posts2( array( 'category__and' => array( 22, 1695 ) ) );
    if ($collections->have_posts()) { include "home-collections.php"; }
  ?>
  
  <div id="from-category" class="bestsellers block">    
    <?php 
      $tag = page_name(is_category(), is_single(), null);            
    ?>
     
    <h2>Alte produse din categoria <?php echo $tag; ?></h2>
    <?php 
      $specials = query_posts2('posts_per_page=4&cat='.$cat);
      if ($specials) {
        if ($specials->have_posts()) {
          $counter = 0;
          while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
            if (in_category(10)) {
              $medium = true;
              include "product-thumb.php";
             
              $counter += 1;
            }                    
          endwhile; 
        }		      
      }
    ?>
    
    <h4 class="all-products-link">
      <?php 
        $title = 'Vezi toate cadourile ' . $tag . ' &rarr;'; 
        $link_type = '3'; // 2=table view, 3=grid view 
        include "home-all-products-link.php"; 
      ?>
    </h4>    
  </div>
  
  
  
  <?php 
    // deal of the week  
    //$dow_posts = query_posts2('posts_per_page=1&cat=2135');    
    
    // gift of the week  
    //$gow_posts = query_posts2('posts_per_page=1&cat=2163');
     
    include 'c_summer-2012.php' ?>
  
  
    
  <div id="recommended" class="bestsellers block">    
     <?php
        $related_posts = MRP_get_related_posts($postid, true);
        if ($related_posts) { ?>        
          <h2>Produse similare</h2>
          <?php foreach ($related_posts as $post) {
            setup_postdata($post);
            $medium = true;
            include "product-thumb.php";
          }
        } 
      ?>
  </div>
  
  
  
  <div id="promos" class="bestsellers block">    
    <h2>Promotii si oferte</h2>
    <?php       
      $specials = query_posts2('posts_per_page=4&cat=15&orderby=rand');
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
    
    <h4 class="all-products-link">
      <a class="all-products-link" title="Vezi toate promotiile Smuff" href="<?php bloginfo('home'); ?>/category/meta/promotii/?view=3">
      Vezi toate promotiile Smuff &rarr;</a>
    </h4>
  </div>
  
  
  <div id="random" class="bestsellers block">    
    <h2>Din mixerul Smuff</h2>
    <?php       
      $specials = query_posts2('posts_per_page=6&cat=10&orderby=rand');
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
    
    <h4 class="all-products-link">
      <a class="all-products-link" title="Vezi toate cadourile Smuff" href="<?php bloginfo('home'); ?>/category/produse/?view=3">
      Vezi toate cadourile Smuff &rarr;</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a class="all-products-link" title="Inapoi la inceputul paginii" href="#header">
      Inapoi la inceputul paginii &uarr;</a>
    </h4>
  </div>  
  
  <div class='clearfix'></div>
  
  
</div>

