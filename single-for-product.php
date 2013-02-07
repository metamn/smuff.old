	      
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
	
	<div id="left-column">
	  <div id="large-image">
	    <?php 
			  $imgs = post_attachements($post->ID);
			  $img = $imgs[0];  
			  $full = wp_get_attachment_image_src($img->ID, 'full');
			  $large = wp_get_attachment_image_src($img->ID, 'large');    
		  ?>
		
			<img class="large-image" src="<?php echo $large[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/>
			<span id="more">(Click pentru mai multe imagini)</span>
	  </div>
	  
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
			
			<div id="close">
	      <span>inapoi</span>
	    </div>
		</div>
	  
	  <div id="description"> 
		  <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
		
		  <h3 id="comments">Comentarii</h3>
		  <div id="comments" class="pane normal">
			  <?php comments_template('', true); ?>
		  </div>
	  </div>
	  
	  
	  <div id="shopping-for-large-image">
	    <h1>
		    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	    </h1>
	
	    <div id="shopping-cart">
	      <?php include 'single-for-product__shopping.php' ?>
	    </div>
	    
	    <div id="product-description">
	    </div>
	    
	    <div id="share">
	      
	    </div>
	  </div>
	
	</div>		      
	
	<div id="right-column">
	  <h1>
		  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	  </h1>
	
	  <div id="shopping-cart">
	    <?php include 'single-for-product__shopping.php' ?>
	  </div>
	  
	  <div id="product-description">
	  </div>
	  
	  <div id="share">
	    
	  </div>
	</div>    
</article>
			




    
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
				$show_excerpt = false;
			  $show_category = false;
				include "product-thumb.php";
				$counter += 1;
				if ($counter == 5) { break; }
			} ?>
			</div>
		<?php } 
	?>
</section>


		
<section id="promo">    
	<h2>Propunerea Smuff</h2>
	<div id="products">
	<?php       
		$specials = query_posts2('posts_per_page=2&cat=15&orderby=rand');
		if ($specials) {
			if ($specials->have_posts()) {
				$counter = 1;
				while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
					if (in_category(10)) {
						
						include "product-thumb.php";
						$counter += 1;
					}                    
				endwhile; 
			}		      
		}      
	?>
	
	<?php       
		$specials = query_posts2('posts_per_page=2&cat=10&orderby=rand');
		if ($specials) {
			if ($specials->have_posts()) {
				while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
					if (in_category(10)) {
						
						include "product-thumb.php";
						$counter += 1;
					}                    
				endwhile; 
			}		      
		}      
	?>
	</div>
</section>
  
  


  


