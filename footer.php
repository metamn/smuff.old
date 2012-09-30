<?php include "home-icons.php" ?>
<?php include "footer-info.php" ?>
<?php include "footer-subscribe.php" ?>		

<div class='spacer'>&nbsp;</div>
<div id="footer" class="block">  
  <p>    
    &copy; 2006-2012 Smuff.ro. <a href="<?php bloginfo('home')?>/despre-noi/termeni-si-conditii">Toate drepturile rezervate</a>.
  </p>	
  <p class="partners">
  <?php 
    $p = get_page_by_path('despre-noi/parteneri/parteneri-online-mall-uri');
    if ($p) { echo $p->post_content; }
  ?>
  </p>
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
