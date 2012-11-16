<?php   
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_discount = product_discount($product_id);
  $product_sale_price = $product_price - $product_discount;
  $product_name = product_name($product_id);
  $imgs = post_attachements($post->ID);
  $img = $imgs[0];
  if ($medium) {
    $thumb = wp_get_attachment_image_src($img->ID, 'medium');  
  } else {
    $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail');  
  }    
  $title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
  
  if ($show_category) {
    $main_cat = post_main_category(get_post_categories_array($post), 10);  
    $category = $main_cat->cat_name;
    $category_link = get_category_link( $main_cat->cat_ID );
  }
  
  $kounter = '';
  if (isset($counter)) {
  	$kounter = 'c' . $counter;
  }
?>

<div class="item <?php echo $kounter ?>">    
  <?php if ($product_id) { ?>
  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> 
    <img src="<?php echo $thumb[0] ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>"/>  
  </a>
  <div id="text">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
      <h4><?php echo $product_name; ?></h4>
      <?php the_excerpt(); ?>  
    </a>
  </div>
  
  <div id="price">
  	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
		<?php if ($product_discount > 0) { ?>
			<span class="price"><?php echo $product_sale_price; ?> Lei</span>
			<span class="old-price"><?php echo $product_price; ?></span>    
		<?php } else { ?>
			<span class="normal-price"><?php echo $product_price; ?></span> Lei
		<?php } ?>
		</a>
	</div>
  
  <?php if ($show_category) { ?>
    <div id="category">
      <a class="<?php echo $main_cat->category_nicename ?>" href="<?php echo $category_link ?>" title="Vezi toate cadourile din <?php echo $category ?>">
      <?php echo $category ?></a>
    </div>
  <?php } ?>
  
  <?php } else { ?>
    <div id="text">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
      <h4><?php the_title(); ?></h4>
      <?php the_excerpt(); ?>            
    </a>
    </div>
  <?php } ?>  
</div>	
