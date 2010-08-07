<?php 
  $news_posts = query_posts2('posts_per_page=5&cat=22');        
?>

<div id="sidebar" class="column span-6 last">
    <?php include "home-menu.php" ?>    
    <?php include "home-news.php" ?>
</div>
