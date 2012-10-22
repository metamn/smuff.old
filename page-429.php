<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 
 
get_header(); 

?>

<div id="page" class="block checkout-final">
  <div id="content" class="column span-18">
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
		  <h2><?php the_title(); ?></h2>
		  
		  
			<div class="entry block">
				<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>							
			</div>
			
		</div>
		<?php endwhile; endif; ?>
		
		
        
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
        
	</div>    
	
	<?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>


