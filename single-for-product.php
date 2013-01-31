	      
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
	
	<div id="left-column">
	  <div id="large-image">
	    <?php 
			  $imgs = post_attachements($post->ID);
			  $img = $imgs[0];  
			  $full = wp_get_attachment_image_src($img->ID, 'full');
			  $large = wp_get_attachment_image_src($img->ID, 'large');    
		  ?>
		
			<img class="large-image" src="<?php echo $large[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/>
	  </div>
	  
	  <div id="description"> 
		  <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
		
		  <h3 id="comments">Comentarii</h3>
		  <div id="comments" class="pane normal">
			  <?php comments_template('', true); ?>
		  </div>
		
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
	
	</div>		      
	
	<div id="right-column">
	
	  <?php include 'single-for-product__shopping.php' ?>
	  
	  
		<div id="thumbs">
			<?php 
			  $counter = 1;
			  foreach ($imgs as $img) { 
				  $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
				  $large = wp_get_attachment_image_src($img->ID, 'full'); ?>
				
				  <div id="thumb" class="c<?php echo $counter ?>">
				    <img src="<?php echo $thumb[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>" data-image="<?php echo $large[0]?>"/>				
				  </div>
			    <?php 
			      $counter += 1;
			      if ($counter == 7) { /*break;*/ }
			} ?> 
		</div>
	</div>    
  
	
	<div id="shopping">
		<?php include 'single-for-product__shopping.php' ?>
				
		<?php include 'single-for-product__shopping-incentives.php' ?>
		
		<div id="contact-info">
		  <center>
			  <h2>Aveti intrebari?</h2>
			  <p>
				  Suport online <br/> Luni-Vineri intre 9.00-17.00    
			  </p>
			  <h2>0740-456.127</h2>
		  </center>
	  </div>	     
	</div>
</article>
			


<?php include 'c_subscribe-to-newsletter.php' ?>
			
  

<section id="from-category">    
	<?php 
		$tag = page_name(is_category(), is_single(), null);            
	?>
	 
	<h2>Alte produse din categoria <?php echo $tag; ?></h2>
	<div id="products">
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
  

    
<section id="recommended">    
 <?php
		$show_category = true;
		
		$related_posts = MRP_get_related_posts($postid, true);
		if ($related_posts) { 
			$counter = 1; ?>        
			<h2>Produse similare</h2>
			<div id="products">
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
	<div id="body" class="pane">
		<?php include 'search-enhanced.php' ?>
	</div>
</section>  
  
  
		
<section id="promo">    
	<h2>Promotii si oferte</h2>
	<div id="products">
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
	<div id="products">
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

  


