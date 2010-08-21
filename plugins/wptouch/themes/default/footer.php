<div id="footer">

  <div id="wptouch-search" class="post"> 
 		<div id="wptouch-search-inner">
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
				<input type="text" value="Cautare..." onfocus="if (this.value == 'Cautare...') {this.value = ''}" name="s" id="s" /> 
				<input name="submit" type="hidden" tabindex="1" value="Search"  />
			</form>
		</div>
	</div>
	
	<div id="info" class="post">
	  <p><?php echo page_excerpt('despre-noi'); ?></p>	  
	  <p>
	    <?php 
        $p = get_page_by_path('contact');
        if ($p) { ?>
          <h3><?php echo $p->post_title; ?></h3>
          <p>
            <?php echo $p->post_content; ?>
            <br/>
            <a href="http://twitter.com/smuff_ro">Twitter</a> &bull; 
            <a href="http://www.facebook.com/pages/smuffro-magazin-gadget-gizmo/213629083432">Facebook</a> &bull; 
            <a href="http://smuff.tumblr.com/">Tumblr</a>
          </p>
      <?php } ?>
    </p>
    <p>
      <?php 
        $pages = array('despre-noi/cum-cumpar', 'despre-noi/business-2-business', 'despre-noi/afiliere', 'despre-noi/ajutor', 'despre-noi/protectia-consumatorilor', 'despre-noi');
        foreach ($pages as $page) {
          $p = get_page_by_path($page);
          if ($p) { ?>
            <a href="<?php echo get_page_link($p->ID); ?>"><?php echo $p->post_title; ?></a> &bull; 
          <?php }
      }?>
    </p>
	</div>

  
	<center>
		<div id="wptouch-switch-link">
			<?php wptouch_core_footer_switch_link(); ?>
		</div>
	</center>
	
	
	<?php if ( !bnc_wptouch_is_exclusive() ) { wp_footer(); } ?>
</div>

<?php wptouch_get_stats(); 
// WPtouch theme designed and developed by Dale Mugford and Duane Storey for BraveNewCode.com
// If you modify it for yourself, please keep the link credit *visible* in the footer (and keep the WordPress credit, too!) that's all we ask folks.
?>
</body>
</html>
