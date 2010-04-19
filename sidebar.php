<?php 
  $news_posts = query_posts2('posts_per_page=3&cat=17');        
?>

<div id="sidebar" class="column span-6 last">
    <?php include "home-menu.php" ?>    
    <?php include "home-news.php" ?>
</div>
