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


