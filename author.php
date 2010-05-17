
<?php
	global $wp_query;
	$curauth = $wp_query->get_queried_object();	
	get_header();
?>

<div id="author" class="block">  
  
  <div id="content" class="column span-18 content">
    <a href="<?php echo get_author_posts_url( $author, ''); ?>">
      <h2>Articole create de <?php echo $curauth->nickname ?></h2>
    </a>
    
    <div id="info" class="block">
      <div id="gravatar" class="column span-4 last">      
        <?php echo get_avatar( $curauth->user_email, '80' ); ?>
      </div>
      <div id="bio" class="column span-14 last">
        <?php echo $curauth->user_description; ?>        
        <div class="user-info">
	        Contact: <strong><a href="mailto:<?php echo antispambot($curauth->user_email); ?>">e-mail</a></strong>
	        <br/>
	        Website: <strong><a href="<?php echo $curauth->user_url?>"><?php echo $curauth->user_url?></a></strong>
        </div>
      </div>      
    </div>      
    
    <?php if (have_posts()) : ?>
      <ul class='author-archive'>
      <?php while (have_posts()) : the_post();  ?>
        <li>        
          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        </li>        
      <?php endwhile; ?>
      <?php wp_paginate(); ?>		 
      </ul> 
		<?php else : 
      include "not-found.php";  
	  endif; ?>
  </div>  
  <?php include "sidebar-blog.php" ?>
</div>
<?php get_footer(); ?>






