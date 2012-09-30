<?php 
  //$news_posts = query_posts2('posts_per_page=5&cat=22');   
  //$campaign = query_posts2('posts_per_page=5&cat=1151,1043&orderby=rand');  // gets a random Partners/campaigns + News/Smuff features
  //$promo_posts = query_posts2('posts_per_page=3&cat=15&orderby=rand'); 
  $banner_id = 1; // the first banner which is a skyscraper  1043
  
  //$random_posts = query_posts2('posts_per_page=7&cat=10&orderby=rand');  
?>

<div id="sidebar" class="column span-6 last">        
    <?php if (is_page(430)) { ?>
    
      <?php include "shopping-incentives.php" ?>	
      <div class="clear"></div>
      
	    <div id="announcement" class="block">
        <h4>Am facut mici schimbari la designul siteului Smuff. 
        <br/>
        Va rugam apasati CTRL+R (Refresh) pentru o experienta mai placuta. 
        Va multumim.</h4> 
      </div>
      
      <div id="comments">
        <?php 
          $args = array(
            "label_submit" => 'Trimite sugestii',
            "logged_in_as" => '',
            "title_reply" => '',
            "comment_notes_after" => '',
            "comment_notes_before" => '',
            "fields" => array(
              "author" => '<input id="author" name="author" type="hidden" value="checkout_suggestions"/>',
              "email" => '<input id="email" name="email" type="hidden" value="checkout_suggestions@aaa.ro"/>'
            ),
            "comment_field" => '<br/><p class="comment-form-comment"><label for="comment">' . _x( 'Am sugestii despre cumparaturi pentru Smuff', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
          );
          comment_form($args); 
        ?>
      </div>
    
    <?php } else if (is_single()) { ?>
      
      <?php include "home-menu.php" ?>   
    
      <div id="searchform">
        <?php get_search_form(); ?>
      </div>  
      
      <div id="contact-info">
        <center>
          <h2>Aveti intrebari?</h2>
          <p>
            Suport online <br/> Luni-Vineri intre 9.00-17.00    
          </p>
          <h2>0740-456127</h2>
          <!-- BEGIN Comm100 Live Chat Button Code --><div><div id="comm100_LiveChatDiv"></div><a href="http://www.comm100.com/livechat/" onclick="comm100_Chat();return false;" target="_blank" title = "Live Chat Live Help Software for Website"><img id="comm100_ButtonImage" src="http://chatserver.comm100.com/BBS.aspx?siteId=43909&planId=484" border="0px" alt="Live Chat Live Help Software for Website" /></a><script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=43909&planId=484"type="text/javascript"></script><div id="comm100_track" style="z-index:99;"><span style="font-size:10px; font-family:Arial, Helvetica, sans-serif;color:#555"><a href="http://www.comm100.com/livechat/" style="text-decoration:none;color:#555" target="_blank"><b>Live Chat Software</b></a> by <a href="http://www.comm100.com/" style="text-decoration:none;color:#009999;" target="_blank">Comm100</a></span></div></div><!-- End Comm100 Live Chat Button Code -->
        </center>
      </div>
    
    <?php } else { ?>
    
      <?php include "home-menu.php" ?>   
    
      <div id="searchform">
        <?php get_search_form(); ?>
      </div>
      
      <!--
      <div id="giftshopper">
        <a href="" title="Personalizare cadouri cu GiftShopper">
          <img id="id1" src="<?php bloginfo('stylesheet_directory'); ?>/img/giftshopper.jpg" title="Personalizare cadouri cu GiftShopper" />
          <img id="id2" src="<?php bloginfo('stylesheet_directory'); ?>/img/hands.jpg" title="Personalizare cadouri cu GiftShopper" />
          <h1 id="id1">Personalizare</h1>
          <h1 id="id2">cadouri cu</h1>
          <h1 id="id3">GiftShopper</h1>
          </h1>
        </a>
      </div>
      -->
      
      <div id="fatboy-campaign">
      	<a href="http://www.smuff.ro/despre-noi/marele-concurs-pentru-marele-fatboy/">
      		<img src="<?php bloginfo('stylesheet_directory'); ?>/img/fatboy.png" />
      	</a>
      </div>
      
      <?php 
        include "home-tags.php";
      ?>
    
    <?php } ?>
        
</div>

