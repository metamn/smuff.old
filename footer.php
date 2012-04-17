
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


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script>!window.jQuery && document.write('<script src="/wp-includes/js/jquery/jquery.js"><\/script>')</script>
		<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.3/all/jquery.tools.min.js"></script>
		<!-- S3 slider -->
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.sudoSlider.min.js" ></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.thumbslider.js" ></script>
    <!-- jquery table sorter -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tablesorter.min.js"></script>
    <!-- jqzoom -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jqzoom.pack.1.0.1.js"></script>
    
    <script type="text/javascript" src="http://apis.google.com/js/plusone.js">
      {lang: 'ro'}
    </script>

    <!-- init all jquery functions -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.init.js"></script>


<!-- GA for Ecommerce goes into transaction_result_functions.php -->
<?php if (!(is_page(429))) { ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1587157-1']);
  _gaq.push(['_trackPageview']);

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
