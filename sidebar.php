<?php 
  if (is_front_page()) {
    $sidebar_posts = query_posts2('posts_per_page=5&cat=47');
    $news_posts = query_posts2('posts_per_page=3&cat=17');
    
    $sticky_posts = query_posts2('posts_per_page=1&cat=103');
    if ($sticky_posts->have_posts()) {
      while ($sticky_posts->have_posts()) : $sticky_posts->the_post(); update_post_caches($posts); 
        $sticky_post = $post;
        break;            
      endwhile; 
    }       
  } else {
    $cat = category_id(true, false);
    $sidebar_posts = query_posts2('posts_per_page=5&cat=' . $cat);
  }        
?>

<div id="sidebar" class="column span-6 last">
    <?php include "home-menu.php" ?>
    <?php include "home-sticky.php" ?>
    <?php include "home-news.php" ?>
</div>
