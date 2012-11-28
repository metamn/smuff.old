	      
<?php 
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_name = product_name($product_id);
  $title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
  $product_stock = product_stock($product_id);
  
  $postid = $post->ID;
  
  $cat = category_id(false, true, $postid); 
?>

<article <?php post_class('product') ?> id="post-<?php the_ID(); ?>">
	<h1>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</h1>			    		      
	
	<div id="col-1">
		<?php 
			$imgs = post_attachements($post->ID);
			$img = $imgs[0];  
			$full = wp_get_attachment_image_src($img->ID, 'full');
			$large = wp_get_attachment_image_src($img->ID, 'large');    
		?>
		<div id="large-image">
			<a href="<?php echo $full[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>">
				<img class="large-image" src="<?php echo $large[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/>
			</a>
		</div>
		
		<?php
			if (count($imgs) > 6) {
				$klass = "force-scrollbar";
			} else {
				$klass = '';
			}
		?>	
		<div id="thumbs" class="<?php echo $klass ?>">
			<?php foreach ($imgs as $img) {
				$thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
				$large = wp_get_attachment_image_src($img->ID, 'full'); ?>
				<a data-image="<?php echo $large[0]?>"><img src="<?php echo $thumb[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/></a>
			<?php } ?> 
		</div>
	</div>    
  
  <div id="col-2">
		<?php include 'single-for-product__shopping.php' ?>
				
		<div id="shopping-info"> 
			<div class="tooltip">
				Cum cumpar? informatii despre pret, shopping, livrare, retur si garantie          
				<div class="tooltip-text">
					<ol>
						<li>Preturi corecte, servicii stabile si asistenta rapida.</li>
						<li>Shopping simplu fara procedura de inregistrare</li>
						<li>Livrare se face acasa sau la birou</li>
						<li>Plata se face la livrare, ramburs, sau prin OP</li>
						<li>Satisfactie sau returnare produs in 10 zile</li>
						<li>Garantie tehnica cel putin 1 an</li>
					</ol>
				</div>
			</div>             
		</div>      
	</div>
	
	
	<div id="post-content" class="accordion"> 
		<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
		
		<h3 id="comments">Comentarii</h3>
		<div id="comments" class="pane normal">
			<?php comments_template('', true); ?>
		</div>
		
		<span class="mobile">
			<h3 id="add-to-cart">Adauga la cos</h3>
			<div class="pane">
				<?php include 'single-for-product__shopping.php' ?>
				<?php include 'single-for-product__shopping-incentives.php' ?>
			</div>
		</span>
		
		<div id="facebook-like" class="block"> 
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=348406981918786";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-send="true" data-width="700" data-show-faces="true"></div>
		</div>
	</div>
			
	<div id="contact-info">
		<center>
			<h2>Aveti intrebari?</h2>
			<p>
				Suport online <br/> Luni-Vineri intre 9.00-17.00    
			</p>
			<h2>0740-456.127</h2>
			<!-- BEGIN Comm100 Live Chat Button Code --><div><div id="comm100_LiveChatDiv"></div><a href="http://www.comm100.com/livechat/" onclick="comm100_Chat();return false;" target="_blank" title = "Live Chat Live Help Software for Website"><img id="comm100_ButtonImage" src="http://chatserver.comm100.com/BBS.aspx?siteId=43909&planId=484" border="0px" alt="Live Chat Live Help Software for Website" /></a><script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=43909&planId=484"type="text/javascript"></script><div id="comm100_track" style="z-index:99;"><span style="font-size:10px; font-family:Arial, Helvetica, sans-serif;color:#555"><a href="http://www.comm100.com/livechat/" style="text-decoration:none;color:#555" target="_blank"><b>Live Chat Software</b></a> by <a href="http://www.comm100.com/" style="text-decoration:none;color:#009999;" target="_blank">Comm100</a></span></div></div><!-- End Comm100 Live Chat Button Code -->
		</center>
	</div>
</article>
			





<?php include 'c_subscribe-to-newsletter.php' ?>
			


<section id="post-shopping-2">			
	<?php include 'single-for-product__shopping.php' ?>
	
	<?php include 'single-for-product__shopping-incentives.php' ?>
</section>
 
  
<div id="other-products" class="accordion">  
	<section id="from-category" class="product-list">    
		<?php 
			$tag = page_name(is_category(), is_single(), null);            
		?>
		 
		<h2>Alte produse din categoria <?php echo $tag; ?></h2>
		<div class="pane">
		<?php 
			$specials = query_posts2('posts_per_page=6&cat='.$cat);
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
	</section>
  

    
	<section id="recommended" class="product-list">    
	 <?php
			$show_category = true;
			
			$related_posts = MRP_get_related_posts($postid, true);
			if ($related_posts) { 
				$counter = 1; ?>        
				<h2>Produse similare</h2>
				<div class="pane">
				<?php foreach ($related_posts as $post) {
					setup_postdata($post);
					$medium = true;
					include "product-thumb.php";
					$counter += 1;
				} ?>
				</div>
			<?php } 
		?>
	</section>


	<section id="search">
		<div id="title" class="desktop">
			<h3>Cautare cadouri</h3>
		</div>
		<h2 class="mobile">Cautare cadouri</h2>
		<div id="body">
			<?php include 'search-enhanced.php' ?>
		</div>
	</section>  
  
  
		
	<section id="promo" class="product-list">    
		<h2>Promotii si oferte</h2>
		<div class="pane">
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
		</div>
	</section>
  
  
	<section id="random" class="product-list">    
		<h2>Din mixerul Smuff</h2>
		<div class="pane">
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
	</section>  
</div>
  


