<div id="footer-subscribe" class="block">
  <div id="newsletter" class="column span-12 block">
    <div class="column span-10 last">
      <?php include 'mailchimp.php'; ?>
	  </div>
	  <div class="column span-2 last">	
	    <a href="http://feeds.feedburner.com/smuff" title="Inscriere la feed-ul smuff.ro" rel="alternate" type="application/rss+xml">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/img/feedburner.png" alt="feedburner" /></a>
    </div>
  </div>
  
  <?php 
    $title = get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description') . ' pe ';
  ?>
  
  <div id="social" class="column span-12 last">
    Ne puteti urmari si prin
    <br/>
   
    <a href="http://www.facebook.com/smuffgadget" title="<?php echo $title ?> Facebook" alt="<?php echo $title ?> Facebook">
      <img title="<?php echo $title ?> Facebook" alt="<?php echo $title ?> Facebook" src="<?php bloginfo('stylesheet_directory'); ?>/img/facebook.jpg"></a>
    <!--
    <a href="http://gadgetoman.smuff.ro/" title="<?php echo $title ?> Tumblr" alt="<?php echo $title ?> Tumblr">
      <img title="<?php echo $title ?> Tumblr" alt="<?php echo $title ?> Tumblr" src="<?php bloginfo('stylesheet_directory'); ?>/img/tumblr.png"></a>
    -->
    <a href="http://twitter.com/smuff_ro" title="<?php echo $title ?> Twitter" alt="<?php echo $title ?> Twitter">
      <img title="<?php echo $title ?> Twitter" alt="<?php echo $title ?> Twitter" src="<?php bloginfo('stylesheet_directory'); ?>/img/twitter_t_logo.png"></a>
    <!--
    <a target="_blank" href="http://www.youtube.com/user/smuffro" title="<?php echo $title ?> Youtube" alt="<?php echo $title ?> Youtube">
      <img title="<?php echo $title ?> Youtube" alt="<?php echo $title ?> Youtube" class="youtube" src="<?php bloginfo('stylesheet_directory'); ?>/img/youtube.png" /></a>
    -->
    <a href="http://pinterest.com/baloghami/smuff-ro/" title="<?php echo $title ?> Pinterest" alt="<?php echo $title ?> Pinterest">
      <img title="<?php echo $title ?> Pinterest" alt="<?php echo $title ?> Pinterest" src="<?php bloginfo('stylesheet_directory'); ?>/img/pinterest.png"></a>
    <a href="http://feeds.feedburner.com/smuff" title="<?php echo $title ?> RSS" alt="<?php echo $title ?> RSS">
      <img title="<?php echo $title ?> RSS" alt="<?php echo $title ?> RSS" src="<?php bloginfo('stylesheet_directory'); ?>/img/rss.png" /></a>    
  </div>
</div>  
  
