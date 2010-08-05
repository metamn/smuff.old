<?php 
  $authors = array(1,3,4,5);  
  shuffle($authors);
  $i = 1;
  foreach ($authors as $author) {
    $a = get_author_login_name($author); ?>
    <div id="image-<?php echo $i ?>" class="avatar">
      <a href="<?php echo get_user_posts($a) ?>" title="<?php echo $a ?>">
      <?php the_author_image($author); ?>
      </a>
    </div>
  <?php 
    $i += 1;
    if ($i == 4) {
      break;
    }
  }    
?>


