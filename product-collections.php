<div class="item">
  <?php
    // Get the collection category
    $category = get_categories('child_of=1695');
    foreach ($c as $category) {
      $category_slug = $c->slug;
      break;
    }
    
    // Construct the link
    $link = '/category/meta/colectii/' + $category_slug + '/?view=3';
    
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
  
  <div id="body">
    <?php the_content() ?>
  </div>
</div>
