<?php 
  if (is_front_page()) {
    $sidebar_posts = query_posts2('posts_per_page=5&cat=47');
  } else {
    $cat = category_id(true, false);
    $sidebar_posts = query_posts2('posts_per_page=5&cat=' . $cat);
  }        
?>

<div id="sidebar" class="column span-6 last">
    <?php include "home-menu.php" ?>
    
    <?php if (is_single()) { ?>
      <div id="new-items" class="box">
        <h2>Produse <span class="highlight-title">similare</span></h2>            
      </div>
      <div class="arrow"><div class="arrow-bottom"></div></div>
      <div id="new-items-list" class="box">  
        <?php 
        $related_posts = MRP_get_related_posts($post->ID, true);
        if ($related_posts) {
          foreach ($related_posts as $post) {
            setup_postdata($post);
            include "home-sales-thumb.php";
          }
        }
        ?>
      </div>    
    <?php } else { ?>
      <div id="new-items" class="box">
        <h2>Produse <span class="highlight-title">noi</span></h2>            
      </div>
      <div class="arrow"><div class="arrow-bottom"></div></div>
      <div id="new-items-list" class="box">
        <?php           
          if ($sidebar_posts->have_posts()) {
            while ($sidebar_posts->have_posts()) : $sidebar_posts->the_post(); update_post_caches($posts); 
              include "home-sales-thumb.php";              
            endwhile; 
          }
        ?>          
      </div>
          
    <?php } ?>
</div>
