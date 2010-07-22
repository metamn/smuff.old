<div id="post-<?php the_ID(); ?>" class="post block default">
  <div id="post-body" class="column span-18">
    <?php 
      $comment_id = get_post_meta($post->ID, 'comment_id', true); 
      $comment = get_comment($comment_id);
      if ($comment) { ?>
        <div class="post-oneliner-header span-6">
          <a href="<?php echo get_category_link($main_category) ?>">#comentarii</a>          
        </div>
        <div class="post-oneliner-body span-12 last">
          <p class="comment-content">
            <?php echo $comment->comment_content ?>
          </p>          
        </div>
      <?php } ?>
  </div> 
  
  <div id="post-taxonomy" class="column span-6 last">
    <?php
      $post_id = $comment->comment_post_ID;
      $post = get_post($post_id); 
    ?>
    <p class="taxonomy-post-title">
      <a href="<?php echo get_permalink($post) ?>" title="Link pentru <?php echo $post->post_title ?>"><?php echo $post->post_title ?></a> 
    </p>
  </div>
  
  <div class="meta-and-share column span-18">
    <div class="meta span-6">
      <ul class="inline-list">
        <li><?php echo mysql2date("j-M-y", $comment->comment_date_gmt) ?>, </li>
        <li>
          <a href="<?php $comment->comment_author_url ?>" title="<?php echo $comment->comment_author ?>">
            <?php echo $comment->comment_author ?></a>
        </li>        
      </ul>
    </div>
    <div class="modify-post span-6 last">
      &nbsp;
    </div>
    <?php include "post-share.php" ?>
  </div>
  
  
   	          
</div>				     
