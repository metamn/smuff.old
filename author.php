
<?php
	global $wp_query;
	$curauth = $wp_query->get_queried_object();	
	get_header();
?>

<div id="author" class="block">   
  
  <div id="content" class="column span-18 content">    
    <div id="blog-intro" class="block">
      <?php include "blog-intro.php" ?>
    </div>
    
    <div id="info" class="block">
      <div id="gravatar" class="column span-4 last">      
         <?php 
          //the_author_image($author); 
          userphoto($curauth);
          ?>         
      </div>
      <div id="bio" class="column span-14 last">
        <?php echo $curauth->user_description; ?>        
        <div class="user-info">
	        Contact: <strong><a href="mailto:<?php echo antispambot($curauth->user_email); ?>">e-mail</a></strong>
	        &nbsp;
	        Website: <strong><a href="<?php echo $curauth->user_url?>"><?php echo $curauth->user_url?></a></strong>
        </div>
      </div>      
    </div>      
    
    <a href="<?php echo get_author_posts_url( $author, ''); ?>">
      <h2>Articole create de <?php echo $curauth->nickname ?></h2>
    </a>
    
    <?php if (have_posts()) : ?>
      <div class="items">
      <?php while (have_posts()) : the_post();  ?>
        <?php 
          $imgs = post_attachements($post->ID);
          $img = $imgs[0];
          $medium = wp_get_attachment_image_src($img->ID, 'medium');
        ?>
        <div class="item block">          
          <div id="image" class="column span-4 last"> 
            <?php if ($medium[0]) { ?>
              <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
                <img src="<?php echo $medium[0] ?>" title="<?php the_title() ?>"/>            
              </a>
            <?php } else { ?>
              &nbsp;
            <?php } ?>
          </div>
          <div id="title" class="column span-14 last">
            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
              <h4><?php the_title() ?></h4>
            </a>
            <ul class="inline-list">
              <li><?php the_time('j-M-y') ?>,</li>                        
              <li><?php comments_popup_link('0', '1', '%'); ?> comentarii, </li>
              <li><?php if(function_exists('the_views')) { the_views(); } ?> vizualizari</li>
            </ul>
          </div>
        </div>       
      <?php endwhile; ?>
      <?php wp_paginate(); ?>
      </div>		       
		<?php else : 
      include "not-found.php";  
	  endif; ?>
  </div>  
  <?php include "sidebar-blog.php" ?>
</div>
<?php get_footer(); ?>






