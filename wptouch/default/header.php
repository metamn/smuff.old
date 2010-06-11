<?php include( dirname(__FILE__) . '/../core/core-header.php' ); ?>


<body>  	
  <div id="headerbar">
	  <div id="headerbar-title">
		  <a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a>
		  <span class="strapline"><?php bloginfo('description'); ?></span>
	  </div>
	  <div id="headerbar-menu">
		  <a href=""><img src="<?php bloginfo('stylesheet_directory'); ?>/img/jquery-icons-info.png"></a> 
		  <a href=""><img src="<?php bloginfo('stylesheet_directory'); ?>/img/jquery-icons-cart.png"></a>
		  <a href=""><img src="<?php bloginfo('stylesheet_directory'); ?>/img/jquery-icons-search.png"></a>
	  </div>
  </div>
<?php wptouch_core_header_check_use(); ?>
