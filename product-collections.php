<li>
  <?php
    // Get the collection category
    $category = get_categories('child_of=1695');
    foreach ($category as $c) {
      $category_slug = $c->slug;
      break;
    }
    
    // Construct the link
    $link = '/category/produse/' . $category_slug . '/?view=3';
    
    // Get the collection image
    $imgs = post_attachements($post->ID);
    
    // There are different image sizes
    if (!(isset($collection_banner_size))) {
    	$collection_banner_size = 0;
    }
    
    $img = $imgs[$collection_banner_size];
    $large = wp_get_attachment_image_src($img->ID, 'large');
  ?>
  
  
    <a href="<?php bloginfo('home'); ?><?php echo $link ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> 
      <img src="<?php echo $large[0] ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>  
    </a>
  
</li>
