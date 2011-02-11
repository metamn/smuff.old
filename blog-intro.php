<div class="column span-9 last">
<?php 
  $authors = array(1,3,4,5);  
  shuffle($authors);
  $i = 1;
  foreach ($authors as $auth) {
    $a = get_author_login_name($auth); ?>
    <div id="image-<?php echo $i ?>" class="avatar">
      <a href="<?php echo get_user_posts($a) ?>" title="<?php echo $a ?>">
      <?php userphoto($auth); ?>      
      </a>
    </div>
  <?php 
    $i += 1;
    if ($i == 4) {
      break;
    }
  }    
?>
</div>


<div id="lets" class="column span-9 last">
  <?php 
    $campaign = query_posts2('posts_per_page=1&cat=1043'); 
    $banner_id = 0; // which is a rectangle
    include "home-campaign.php"; 
  ?>
  
  <div id="season">
    <img src="<?php bloginfo('stylesheet_directory'); ?>/img/smuff-valentines-2010-sziv-3.jpg" />
  </div>
</div>


