<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 
 $klass = '';
 if (is_page(429)) { // Finalizare comanda  
  $randoms = query_posts2('posts_per_page=10&cat=10&orderby=rand');
  $klass = "checkout-final";
 } 
 
 $page_name = wp_title('', false, '');
 $to_replace = array(' ', '.', '_');
 $page_name = str_replace($to_replace, '', $page_name);
 $page_name = 'page-' . strtolower($page_name);
 
 $collections = query_posts2( array( 'category__and' => array( 22, 1695 ) ) ); 
 

get_header(); ?>

<div id="page" class="block <?php echo $page_name ?> <?php echo $klass ?>">
  <div id="content" class="column span-18">
  	
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		  <h2><?php the_title(); ?></h2>
		  
		  
			<div class="entry block">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>							
			</div>
			
			<?php
			// collections     
			$collection_banner_size = 0;
			if ($collections->have_posts()) { include "home-collections.php"; }
			?>
			
			
			<?php if (!(is_page(array(429, 430, 2819)))) { //No additional info on the last shopping pages ?>
			
			  <?php 
			    $subs = get_pages('child_of='.$post->ID);
			    if ($subs) { ?>
			      <div class="subpages">
		          Informatii aditionale: 
		          <ul class="inline-list">
		            <?php wp_list_pages('child_of='.$post->ID.'&title_li='); ?>
		          </ul>
		        </div>
			  <?php } ?>
			
			  <?php if ( is_page('despre-noi') || $post->post_parent == 331 || in_array( 331, $post->ancestors) ) { ?>
		      <div class="subpages">
		        Alte informatii: 
		        <ul class="inline-list">
		          <?php wp_list_pages('child_of=331&depth=1&title_li='); ?>
		        </ul>
		      </div>		    
			  <?php } ?>
			
			<?php } ?>
			
			
			
			
		</div>
		<?php endwhile; endif; ?>
		
		

    <?php 
      if (is_page(429)) { ?>
        
        <div id="subscribe" class="block box">
          <div id="share" class="column subscribe span-5 last">
            <p>Aratati shoppingul prietenilor!</p>
            <?php 
              $products = get_transaction_products($_GET["sessionid"]);
              $i = 0;
              if ($products) {
                foreach ($products as $product) {
                  if ($product) {
                    $post_id = post_id($product);
                    $p = get_post($post_id); 
                    $imgs = post_attachements($p->ID);
                    $img = $imgs[0];
                    $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');
                    
                    if ($i <=0) { ?>  
                      <img src="<?php bloginfo('stylesheet_directory'); ?>/img/facebook.jpg" title="Share pe Facebook">
                    <?php } else { ?>
                      <div class="spacerx">&nbsp</div>
                    <?php } ?>
                    <a name="fb_share" type="box_count" href="javascript:void(window.open('http://www.facebook.com/sharer.php?u=<?php echo get_permalink($post_id) ?>&t=<?php echo $p->post_title ?>', 'Share pe Facebook', 'width=640,height=480'))">                    
                      <img src="<?php echo $thumb[0] ?>" title="Share <?php echo $p->post_title?> pe Facebook">
                    </a>
                    <br/>
                    <?php 
                    $i += 1;
                  }                
                }
              }              
            ?>
          </div>
          
          <div id="newsletter" class="column subscribe span-7 last">
            <p>Doriti sa va notificam cand apar noi produse pe Smuff?</p>
            <!-- Begin MailChimp Signup Form -->
            <form action="http://smuff.us5.list-manage.com/subscribe/post?u=95ca3987b6e9b0c1d25211911&amp;id=4622c90106" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">	
	            <input class="text" type="email" name="EMAIL"  value="" id="mce-EMAIL" placeholder="Adresa Dvs. de email" required>
	            <br/>
	            <input class="button" type="submit" value="Inscriere la newsletter" name="subscribe" id="mc-embedded-subscribe" >
            </form>
          </div>
          
          <div id="feedback" class="column subscribe span-3 prepend-2 last">   
            <p>Spuneti-ne opinia despre Smuff!</p>         
            <img class="pointer" src="<?php bloginfo('stylesheet_directory'); ?>/img/heart.png" title="Asteptam parerea Dvs. despre experienta Smuff" />            
          </div>
        </div>
        
        
        <div id="partner">
          <!--
          <center>
          <a href="http://bit.ly/bXkaYK" target="_blank" title="Skimania">
            <img src="<?php bloginfo('home') ?>/wp-content/uploads/2010/11/Skimaniac-Full-Banner-468×601.jpg" />
          </a>
          </center>
          -->
        </div>
        
        
        <div id="comments" class="block hidden">
          <?php if (comments_open()) {comments_template();} ?>
        </div>
        
        <?php if ($randoms) { ?>
          <div id="recommended" class="after-sales bestsellers block">
            <h2>Produse similare</h2>
            <p>Cei care au cumparat acest produs au mai cumparat si produsele:</p>
            <?php while ($randoms->have_posts()) : $randoms->the_post(); update_post_caches($posts); 
              $medium = true;
              include "product-thumb.php";
            endwhile; ?>
          </div>
        <?php }
      }
    ?>
    
   		
		<?php 
		  if (!(is_page(array(429, 430)))) { // no comments on the checkout page
		    if (comments_open()) {comments_template();}  
		  }		  
		?>
		
		<?php 
    // deal of the week  
    //$dow_posts = query_posts2('posts_per_page=1&cat=2135');     
    
    // gift of the week  
    //$gow_posts = query_posts2('posts_per_page=1&cat=2163');
    
    //include 'c_summer-2012.php' ?>
		
		
	  <?php edit_post_link('Modificare pagina.', '<p>', '</p>'); ?>
	</div>    
	
	<?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>


