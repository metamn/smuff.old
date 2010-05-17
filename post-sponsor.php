<div id="sponsor">
  <?php 
    if (in_category(10)) {
      $sponsor =  get_sponsor_category(get_post_categories_array($post), $main_category);
    } else {
      $sponsor = get_sponsor_category2($main_category);
    }
    $args = array (
      'posts_per_page' => 1,
      'category__and' => array(96, $sponsor->cat_ID)
    );
    
    
    $sponsor_posts = query_posts2($args);     
    if ($sponsor_posts) {
      while ($sponsor_posts->have_posts()) : $sponsor_posts->the_post(); update_post_caches($posts);
        $imgs = post_attachements($post->ID);
        $img = $imgs[0];
        $medium = wp_get_attachment_image_src($img->ID, 'medium'); 
      ?>
      
      <p>In parteneriat cu</p>  
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
        <img src="<?php echo $medium[0] ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"/>
      </a>
    <?php 
      endwhile;
    }
  ?>
</div>  

