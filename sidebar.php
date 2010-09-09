<?php 
  $news_posts = query_posts2('posts_per_page=5&cat=22');        
?>

<div id="sidebar" class="column span-6 last">
    <?php include "home-menu.php" ?>   
    <?php include "home-news.php" ?>
    <center>
      <a href="http://www.letsdoitromania.ro" target="_blank"> <img title="Curatenie in toata tara. Intr-o singura zi!" src="http://www.letsdoitromania.ro/wp-content/uploads/2010/02/160.gif" border="0" alt="Let’s Do It, Romania!" /></a>
    </center>
    <?php include "home-banners.php" ?>
</div>


