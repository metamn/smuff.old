<?php 
  if ($news_posts->have_posts()) { ?>
    
    <div id="home-news" class="block">
    <h3>Stiri</h3>    
    <?php while ($news_posts->have_posts()) : $news_posts->the_post(); update_post_caches($posts); ?>
      <div id="item" class="column span-5 last">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a>
        <hr/>
        <span class="date"><?php the_time('j M Y') ?> ora <?php the_time('G:i') ?></span>
      </div>  
    <?php endwhile;?>
    </div>
    
<?php } ?>



