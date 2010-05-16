<div id="sponsor">
  <?php 
    if (in_category(10)) {
      $sponsor =  get_sponsor_category(get_post_categories_array($post), $main_category);
    } else {
      $sponsor = get_sponsor_category2($main_category);
    } 
  ?>
  
  <?php if ($sponsor) { ?>
    <p>In parteneriat cu <?php echo $sponsor->cat_ID ?></p>
  <?php } ?>  
</div>  

