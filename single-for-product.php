	      
<?php 
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_name = product_name($product_id);
  $title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
  $product_stock = product_stock($product_id);
  
  $postid = $post->ID;
  
  $cat = category_id(false, true, $postid); 
?>

<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
  <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>			    
  <div id="top-section" class="block">			      
    <div id="post-images" class="column span-18">
      <?php 
        $imgs = post_attachements($post->ID);
        $img = $imgs[0];  
        $full = wp_get_attachment_image_src($img->ID, 'full');
        $large = wp_get_attachment_image_src($img->ID, 'large');    
      ?>
      <div id="large-image">
        <a href="<?php echo $full[0]?>" class="product-zoom" title="<?php echo $title ?>" alt="<?php echo $title ?>">
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
    
    <div id="post-meta" class="column span-5 prepend-1 last">
      <div id="post-shopping" class="block">
        <?php 
          if (in_category(10)) {
          	// $product_id = get_post_meta($post->ID, 'product_id', single);
						if ($product_id) {
							if ($product_stock != '-1') {
								echo wpsc_display_products_page('product_id='.$product_id); ?>
								
								<div id="wishlist" class="block">
									<?php 
									if (function_exists('wpfp_link')) { wpfp_link(); } ?>
								</div> <?php
          		} else { ?>
          			<div id="product-discontinued">
									<h3>Acest produs momentan<br/>nu este pe stoc.</h3>
									<p>Anunta-ma cand va fi disponibil.</p>
									<?php 
										$mailchimp_button = 'Anunta-ma';
										$mailchimp_param = $product_name;
										include 'mailchimp-direct.php'; 
									?>
								</div> <?php
							}
						}
					} else { ?>
						<div id="product-discontinued">
							<h3>Acest produs este discontinuat.</h3>
						</div> <?php
        	} ?>
      </div>
      
      <div id="shopping-info" class="block"> 
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
 
    
	<div class="block">
		<div id="post-content" class="column span-18">
			<div id="post-operations" class="block">                
				<table>
					<tr>          
						<td>
							<div class="twitter-button">
								<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
								<div>
									 <a href="http://twitter.com/share" class="twitter-share-button"
											data-url="<?php the_permalink(); ?>"
											data-via="smuff_ro"
											data-text="<?php the_title() ?> de pe <?php bloginfo('name')?>"
											data-related="anywhere:The Javascript API"
											data-count="horizontal">Tweet</a>
								</div>
							</div>
						</td>
						<td>
							<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&show_faces=true&layout=button_count&action=like&colorscheme=light&width=100&height=21" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:100px; height:21px;"></iframe>
						</td>
						<td><?php echo do_shortcode('[pinit]'); ?></td>
						<td><g:plusone size="medium"></g:plusone></td>
					</tr>
				</table>    
			</div>
				
			<?php include 'c_subscribe-to-newsletter.php' ?>
	
			<div id="accordion" class="accordion block">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
					
				<h3 id="comments">Comentarii</h3>
				<div class="pane normal">
					<?php comments_template('', true); ?>
				</div>
			</div>
			
			<div id="post-shopping2" class="block">
				<div id="post-shopping" class="block">
					<?php 
						if (in_category(10)) {
							// $product_id = get_post_meta($post->ID, 'product_id', single);
							if ($product_id) {
								if ($product_stock != '-1') {
									echo wpsc_display_products_page('product_id='.$product_id); ?>
									
									<div id="wishlist" class="block">
										<?php 
										if (function_exists('wpfp_link')) { wpfp_link(); } ?>
									</div> <?php
								} else { ?>
									<div id="product-discontinued">
										<h3>Acest produs momentan<br/>nu este pe stoc.</h3>
										<p>Anunta-ma cand va fi disponibil.</p>
										<?php 
											$mailchimp_button = 'Anunta-ma';
											include 'mailchimp-direct.php'; 
										?>
									</div> <?php
								}
							}
						} else { ?>
							<div id="product-discontinued">
								<h3>Acest produs este discontinuat.</h3>
							</div> <?php
						} 
					?>
				</div>
				
				<div id="shopping-incentives">
					<h4>Preturi accesibile</h4>
					<p>
						La Smuff toate preturile sunt corecte.  
					</p>
					
					<h4>Shopping rapid</h4>
					<p>
						Fara procedura de inregistrare, numai cu un singur click.            
					</p>
					
					<h4>Plata la livrare</h4>
					<p>
						Plata ramburs cand aveti deja produsul in mana.
					</p>
					
					<h4>10 zile drept de retur</h4>
					<p>
						Fara intrebari din partea noastra.
					</p>
					
					<h4>Garantie minim 1 an</h4>
					<p>
						Service Express sau schimb cu un produs NOU.
					</p>        
				</div>
				   
			</div>
			
			<div class="block">
				<?php include 'c_subscribe-to-new-products.php' ?>
			</div> 
		</div>
		
		<div id="contact-info" class="column span-5 prepend-1 last">
			<center>
				<h2>Aveti intrebari?</h2>
				<p>
					Suport online <br/> Luni-Vineri intre 9.00-17.00    
				</p>
				<h2>0740-456127</h2>
				<!-- BEGIN Comm100 Live Chat Button Code --><div><div id="comm100_LiveChatDiv"></div><a href="http://www.comm100.com/livechat/" onclick="comm100_Chat();return false;" target="_blank" title = "Live Chat Live Help Software for Website"><img id="comm100_ButtonImage" src="http://chatserver.comm100.com/BBS.aspx?siteId=43909&planId=484" border="0px" alt="Live Chat Live Help Software for Website" /></a><script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=43909&planId=484"type="text/javascript"></script><div id="comm100_track" style="z-index:99;"><span style="font-size:10px; font-family:Arial, Helvetica, sans-serif;color:#555"><a href="http://www.comm100.com/livechat/" style="text-decoration:none;color:#555" target="_blank"><b>Live Chat Software</b></a> by <a href="http://www.comm100.com/" style="text-decoration:none;color:#009999;" target="_blank">Comm100</a></span></div></div><!-- End Comm100 Live Chat Button Code -->
			</center>
		</div>
  </div>
 
  
  <div id="from-category" class="bestsellers block">    
    <?php 
      $tag = page_main_name();            
    ?>
     
    <h2>Alte produse din categoria <?php echo $tag; ?></h2>
    <?php 
      $specials = query_posts2('posts_per_page=4&cat='.$cat);
      if ($specials) {
        if ($specials->have_posts()) {
          $counter = 1;
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
  </div>
  

    
  <div id="recommended" class="bestsellers block">    
     <?php
     		$show_category = true;
     		
        $related_posts = MRP_get_related_posts($postid, true);
        if ($related_posts) { 
        	$counter = 1; ?>        
          <h2>Produse similare</h2>
          <?php foreach ($related_posts as $post) {
            setup_postdata($post);
            $medium = true;
            include "product-thumb.php";
            $counter += 1;
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
        	$counter = 1;
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
        	$counter = 1;
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
  </div>  
  
  <div class='clearfix'></div>
  
  
</div>

