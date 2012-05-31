<div class="meta-and-share">
  <div class="meta block">
    <ul class="inline-list">
      <li><?php the_time('j M Y') ?>,</li>
      <li>
        <?php $author = get_the_author(); ?>
        <a href="<?php echo get_user_posts($author) ?>" title="Toate articolele create de <?php echo $author?>">
        <?php echo $author?></a>,
      </li>            
      
    </ul>
    <table>
      <tr>          
        <td class="twitter opacity-3"><?php include "share-twitter.php" ?></td>
        <td class="facebook opacity-3"><?php include "share-facebook-like.php" ?></td>
        <td class="facebook opacity-3"><?php include "share-facebook.php" ?></td>
        <td class="google google-share opacity-3"><g:plusone size="medium"></g:plusone></td>
      </tr>
    </table>
   
  </div>       
</div>
