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
  <a href="http://www.letsdoitromania.ro" target="_blank"><img title="Curatenie in toata tara. Intr-o singura zi!" src="http://www.letsdoitromania.ro/wp-content/uploads/2010/06/bannerBlog-albastru.png" border="0" alt="" /></a>
</div>

