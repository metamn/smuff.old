<?php 
  $news_posts = query_posts2('posts_per_page=5&cat=22');   
  $campaign = query_posts2('posts_per_page=1&cat=1043');    
  $banner_id = 1; // the first banner which is a skyscraper  1043
?>

<div id="sidebar" class="column span-6 last">
    <?php include "home-menu.php" ?>   
    
    <?php if (is_single()) {?>
    <div id="post-sponsor">
      <center>
        In parteneriat cu
        <br/>  
        <?php 
          $main_cat = page_name(is_category(), is_single());
          
          $sponsor = sponsor_post($main_cat);
          if ($sponsor) {
            $imgs = post_attachements($sponsor->ID);
            $img = $imgs[0];
            $medium = wp_get_attachment_image_src($img->ID, 'medium'); ?>
                        
            <a href="<?php echo get_permalink($sponsor) ?>" title="<?php echo $sponsor->post_title ?>" alt="<?php $sponsor->post_title ?>">
              <img class="half-banner" src="<?php echo $medium[0] ?>" title="<?php $sponsor->post_title ?>" alt="<?php $sponsor->post_title ?>"/>
            </a>
          <?php } else { ?>
            <a href="<?php bloginfo('home')?>/<?php echo get_page_uri(2277)?>" title="Cum devin partener Smuff?">
              <img class="half-banner" src="<?php bloginfo('stylesheet_directory')?>/img/empty-logo.jpg" /></a>      
          <?php } ?>      
      </center>
    </div>
    <?php } ?>
    
    <?php 
      if (is_page(430)) {
        include "shoutbox.php";
      }      
    ?>
    
    <?php include "home-news.php" ?>
    
    <?php include "home-campaign.php" ?>
       
    <?php include "home-banners.php" ?>
</div>


