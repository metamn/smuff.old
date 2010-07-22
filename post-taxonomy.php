<ul class="taxonomy">
  <?php echo display_post_categories(get_post_categories_array($post), $main_category)?>
</ul>

<div class="tags">
  <?php the_tags('<span class="ui-icon ui-icon-tag"/></span> ',', ','')  ?>
</div>

<div id="author">
  <?php 
    $author = get_the_author(); 
    $gravatar = get_avatar(get_the_author_meta('user_email'), '64','');
  ?>
  <p>Articol creat de <?php echo $author ?></p>
  <a href="<?php echo get_user_posts($author) ?>" title="Articol creat de <?php echo $author ?>">
    <?php echo $gravatar ?></a>
</div>
  
