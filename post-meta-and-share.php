<div class="meta-and-share">
  <div class="meta block">
    <ul class="inline-list">
      <li><?php the_time('j M Y') ?>,</li>
      <li>
        <?php $author = get_the_author(); ?>
        <a href="<?php echo get_user_posts($author) ?>" title="Toate articolele create de <?php echo $author?>">
        <?php echo $author?></a>,
      </li>            
      <li><?php comments_popup_link('0', '1', '%'); ?> comentarii, </li>
      <li><?php if(function_exists('the_views')) { the_views(); } ?> vizite </li>
      <li class="twitter opacity-3"><?php include "share-twitter.php" ?></li>
      <li class="facebook facebook-share opacity-3"><?php include "share-facebook.php" ?></li>      
    </ul>
  </div>       
</div>
