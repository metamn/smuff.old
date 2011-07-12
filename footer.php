
<?php include "footer-info.php" ?>
<?php include "footer-subscribe.php" ?>		

<div class='spacer'>&nbsp;</div>
<div id="footer" class="block">  
  <p>    
    &copy; 2006-2011 Smuff.ro. <a href="<?php echo get_page_link(466);?>">Toate drepturile rezervate</a>.
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
