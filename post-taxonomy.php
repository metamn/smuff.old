<div id="post-taxonomy" class="column span-6 last">    
  <ul class="taxonomy">
    <?php echo display_post_categories(get_post_categories_array($post), $main_category)?>
  </ul>
  <div class="tags">
    <?php the_tags('<span class="ui-icon ui-icon-tag"/></span> ',', ','')  ?>
  </div>
</div>
