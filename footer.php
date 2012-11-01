<div id="facebook-like-box" class="block">
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=348406981918786";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

	<div class="fb-like-box" data-href="http://www.facebook.com/smuffgadget" data-width="950" data-height="550" data-show-faces="true" data-border-color="#cccccc" data-stream="false" data-header="false"></div>
</div>




<div id="home-tag-icons" class="block">
	<h3>Top categorii noi pe Smuff</h3>
  <ul class="inline-list">
    <li>
      <a title="Cadouri pentru smarthpone" href="<?php bloginfo('home')?>/tag/magazin-accesorii-apple">
        <img title="Cadouri pentru smarthpone" src="<?php bloginfo('stylesheet_directory')?>/img/icon-smartphone.png" />
        <h4>Smartphone</h4>  
      </a>      
    </li>
    
    <li>
      <a title="Cadouri audio video" href="<?php bloginfo('home')?>/tag/magazin-audio-video">
        <img title="Cadouri audio, video" src="<?php bloginfo('stylesheet_directory')?>/img/icon-audiovideo.png" />
        <h4>Audio & Video</h4>
      </a>      
    </li>
    
    <li>
      <a title="Cadouri sport si outdoor" href="<?php bloginfo('home')?>/tag/cadouri-sport">
        <img title="Cadouri sport si outdoor" src="<?php bloginfo('stylesheet_directory')?>/img/icon-sport.png" />
        <h4>Sport si outdoor</h4>
      </a>      
    </li>
    
    <li class="last">
      <a title="Cadouri pentru comfortul de acasa" href="<?php bloginfo('home')?>/tag/magazin-comfort-pentru-acasa">
        <img title="Cadouri pentru comfortul de acasa" src="<?php bloginfo('stylesheet_directory')?>/img/icon-homeimprovement.png" />
        <h4>Confortul de acasa</h4>
      </a>      
    </li>
  </ul>
</div>



<div id="footer-info" class="block">
  <div class="column span-10">
    <div id="contact">
      <?php 
        $p = get_page_by_path('despre-noi/contact');
        if ($p) { ?>
          <h3><?php echo $p->post_title; ?></h3>
          <p><?php echo $p->post_content; ?></p>
        <?php } ?>
    </div>
    
    <div id="company" class='accordion'>
      <?php 
        $p = get_page_by_path('despre-noi/date-firma');
        if ($p) { ?>
          <?php echo $p->post_content; ?>
        <?php } ?>
    </div>
  </div>
  
  <div class="column span-12 prepend-2 last">
    <div id="accordion-footer-info" class="accordion">
      <?php 
        $pages = array('despre-noi/cum-cumpar', 'despre-noi/business-2-business', 'despre-noi/afiliere', 'despre-noi/ajutor', 'despre-noi/protectia-consumatorilor', 'despre-noi');
        foreach ($pages as $page) {
          $p = get_page_by_path($page);
          if ($p) { ?>
            <h3><?php echo $p->post_title; ?></h3>
            <div class="pane">
              <?php echo $p->post_excerpt; ?>
              <p><a href="<?php echo get_page_link($p->ID); ?>">Detalii &rarr;</a></p>
            </div>  
          <?php }
        }?>      
    </div>    
  </div> 
</div>



<div id="footer" class="block">  
  <span>    
    &copy; 2006-2012 Smuff.ro. <a href="<?php bloginfo('home')?>/despre-noi/termeni-si-conditii">Toate drepturile rezervate</a>.
  </span>	
</div>



<div id="footer-subscribe" class="block">
  <div id="newsletter" class="column span-12">
    <div class="column span-10 last">
      <?php include 'mailchimp.php'; ?>
	  </div>
	  <div class="column span-2 last">	
    </div>
  </div>
  
  <?php 
    $title = get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description') . ' pe ';
  ?>
  
  <div id="social" class="column span-12 last">
		<div class="partners block">
		<?php 
			$p = get_page_by_path('despre-noi/parteneri/parteneri-online-mall-uri');
			if ($p) { echo $p->post_content; }
		?>
		</div>
  	
  	<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=348406981918786";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
  	<div class="fb-like" data-send="true" data-width="500" data-show-faces="true"></div>
  </div>
  
</div>  





  


<!-- GA for Ecommerce goes into transaction_result_functions.php -->
<?php if (!(is_page(429))) { ?>
<script type="text/javascript">
  
  // Init _gaq is in the header .......
  
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php } ?>

</div> <!-- content-container opened in header -->

<?php wp_footer(); ?>
	
</body>

</html>
