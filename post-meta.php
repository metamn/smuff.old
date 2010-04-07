<div class="meta">      
  <ul class="inline-list">
    <li><?php the_time('j-M-y') ?>,</li>
    <li>
      <?php $author = get_the_author(); ?>
      <a href="<?php echo get_user_posts($author) ?>" title="Toate articolele create de <?php echo $author?>">
      <?php echo $author?></a>,
    </li>            
    <li><?php comments_popup_link('0', '1', '%'); ?><span class="ui-icon ui-icon-comment"/></span></li>
  </ul>
</div>
