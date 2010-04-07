<div id="home-news" class="block">
  <h3>Stiri</h3>
  <?php include "home-sticky.php" ?>
  <?php 
    if ($news_posts->have_posts()) {
    while ($news_posts->have_posts()) : $news_posts->the_post(); update_post_caches($posts); ?>
      <div id="item" class="column span-6 last">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a>
        <hr/>
        <span class="date"><?php the_time('j M Y') ?> ora <?php the_time('G:i') ?></span>
      </div>  
    <?php endwhile; }
  ?>
</div>




