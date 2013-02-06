<?php   

  // Parameters
  // - $image_size: string, 'large', 'medium', 'thumbnail'. Default is medium
  // - show_excerpt: boolean, if the excerpt is shown or not. Default is true
  // - show_category: boolean, if the product main category is shown or not. Default is true
  // - show_price: boolean, to show the product price. Default is true
  // - show_percentage: boolean, to show the discount in %. Default is false
  // - counter: the numeric id of the product when displayed as a list
  
  // All posts will be treated the same. If this is not a product the price and category won't be shown
  
  
  if (!(isset($image_size))) {
    $image_size = 'medium';
  }
  $imgs = post_attachements($post->ID);
  $img = $imgs[0];
  $thumb = wp_get_attachment_image_src($img->ID, $image_size);  
  
  if (!(isset($show_percentage))) {
    $show_percentage = false;
  }
      
  if (!(isset($show_excerpt))) {
    $show_excerpt = true;
  }
 
  if (!(isset($show_price))) {
    $show_price = true;
  }
  
  if (!(isset($show_category))) {
    $show_category = true;
  }
  
  
  $klass = '';
  $product_id = product_id($post->ID);
  
  if ($product_id) {
    $product_price = product_price($post->ID);
    $product_discount = product_discount($product_id);
    $product_sale_price = $product_price - $product_discount;
    if ($product_discount > 0) {
      $product_sale_percentage = round($product_discount * 100 / $product_price);
      if ($show_percentage) {
        $klass = 'on-sale';
      }
    }
    
    $product_name = product_name($product_id);
  } else {
    $product_name = get_the_title();
  }
  $title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
  
  
  if ($show_category) {
    $main_cat = post_main_category(get_post_categories_array($post), 10);  
    $category = $main_cat->cat_name;
    $category_link = get_category_link( $main_cat->cat_ID );
  }
  
  
  // Each product will be numbered with a CSS class
  $kounter = '';
  if (isset($counter)) {
  	$kounter = 'c' . $counter;
  }
  
 
?>

<article id="product" class="<?php echo $kounter ?> <?php echo $klass ?>">  
  
  <?php if (isset($thumb[0])) { ?>
    <div id="image">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> 
        <img src="<?php echo $thumb[0] ?>" title="<?php echo $title; ?>" alt="<?php echo $title; ?>"/>  
      </a>
    </div>
  <?php } ?>
  
  
  <div id="title">
    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
      <h3><?php echo $product_name; ?></h3> 
    </a>
  </div>
  
  <?php if ($show_excerpt) { ?>
    <div id="excerpt">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
       <?php the_excerpt(); ?> 
      </a>
    </div>
  <?php } ?>
  
  <?php if ( ($show_price) && (in_category(10)) ) { ?>
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
  <?php } ?>
  
  <?php if ( ($show_category) && (in_category(10)) ) { ?>
    <div id="category">
      <a class="<?php echo $main_cat->category_nicename ?>" href="<?php echo $category_link ?>" title="Vezi toate cadourile din <?php echo $category ?>">
      <?php echo $category ?></a>
    </div>
  <?php } ?>
  
  <?php if (($show_percentage) && ($product_discount > 0)) { ?>
    <div id="percentage">
      <span>&mdash;<?php echo $product_sale_percentage ?>%</span>
    </div>
  <?php } ?>
</article>	
