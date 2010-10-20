<?php 
  $news_posts = query_posts2('posts_per_page=5&cat=22');   
  $campaign = query_posts2('posts_per_page=1&cat=1043');  
  $promo_posts = query_posts2('posts_per_page=3&cat=15&orderby=rand'); 
  $banner_id = 1; // the first banner which is a skyscraper  1043
?>

<div id="sidebar" class="column span-6 last">
    <?php include "home-menu.php" ?>   
    
    <?php 
      if (is_page(430) || in_category(10)) { ?>
        
        <div id="contact-info">
          <center>
            <h2>0740-456127</h2>
            <p>
              Suport online Luni-Vineri intre 9.00-17.00    
            </p>
            <!-- BEGIN Comm100 Live Chat Button Code --><div><div id="comm100_LiveChatDiv"></div><a href="http://www.comm100.com/livechat/" onclick="comm100_Chat();return false;" target="_blank" title = "Live Chat Live Help Software for Website"><img id="comm100_ButtonImage" src="http://chatserver.comm100.com/BBS.aspx?siteId=43909&planId=484" border="0px" alt="Live Chat Live Help Software for Website" /></a><script src="http://chatserver.comm100.com/js/LiveChat.js?siteId=43909&planId=484"type="text/javascript"></script><div id="comm100_track" style="z-index:99;"><span style="font-size:10px; font-family:Arial, Helvetica, sans-serif;color:#555"><a href="http://www.comm100.com/livechat/" style="text-decoration:none;color:#555" target="_blank"><b>Live Chat Software</b></a> by <a href="http://www.comm100.com/" style="text-decoration:none;color:#009999;" target="_blank">Comm100</a></span></div></div><!-- End Comm100 Live Chat Button Code -->
          </center>
        </div>
        
        <div id="similar-buys">
          <h3>Promotii Smuff</h3>
          <p class="intro">Acestea sunt produsele in oferta actuala la Smuff. Adaugati orice produs secundar (langa ce aveti in cos acum) si livrarea pentru acestea va fi GRATUITA!</p>
          <?php 
            if ($promo_posts) {
              while ($promo_posts->have_posts()) : $promo_posts->the_post(); update_post_caches($posts); 
                $medium = false;
                include "product-thumb.php";
              endwhile;
            }
          ?>
          
        </div>
        
      <?php } else {
        include "home-news.php";
        include "home-campaign.php";
        include "home-banners.php";
      }     
    ?>
    
        
</div>


