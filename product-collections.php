<div class="item">
  <?php
    // Get the collection category
    $category = get_categories('child_of=1152');
    foreach ($category as $c) {
      $category_slug = $c->slug;
      break;
    }
    
    // Construct the link
    $link = '/category/produse/' . $category_slug . '/?view=3';
    
    // Get the collection image
    $imgs = post_attachements($post->ID);
    $img = $imgs[0];
    $large = wp_get_attachment_image_src($img->ID, 'large');
  ?>
  
  <div id="image">
    <a href="<?php bloginfo('home'); ?><?php echo $link ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"> 
      <img src="<?php echo $large[0] ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>  
    </a>
  </div>
  <div id="title">
    <h3><a href="<?php bloginfo('home'); ?><?php echo $link ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
      <?php the_title(); ?></a></h3> 
  </div>
 
</div>
