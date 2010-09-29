<?php include( dirname(__FILE__) . '/../core/core-header.php' ); ?>


<body>  	
  <div id="headerbar">	  
	  <a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></a>
	  <span class="strapline">
      <?php if (is_blog()) {
        $shop = '';
        $blog = 'active';
      } else {
        $shop = 'active';
        $blog = '';
      }?>
      <a class="<?php echo $shop?>" href="<?php bloginfo('home'); ?>" title="Magazinul Smuff">shop</a>
      &
      <a class="<?php echo $blog ?>" href="<?php bloginfo('home'); ?>/blog" title="Blogul Smuff">blog</a>
    </span>		  
	  <span class="headerbar-menu">
		  <a href="#info"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/jquery-icons-info.png"></a> 
		  <a href="<?php bloginfo('home'); ?>/cos-cumparaturi"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/jquery-icons-cart.png"></a>
		  <a href="#wptouch-search"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/jquery-icons-search.png"></a>
	  </span>
  </div>
  
  <!--[if lt IE 8]>
  <div id="ie" class="notice">
    <h4>Aceasta este versiunea mobila al siteului Smuff.</h4>  
    <p>Puteti face cumparaturi cu usurinta in schimb experienta ramane spartana.</p>
    <p>Pentru o experienta mai placuta va rugam folositi un browser modern: Internet Explorer 8+, Mozilla Firefox, Google Chrome sau Apple Safari</p>
  </div>  
  <![endif]-->
 
  
<?php wptouch_core_header_check_use(); ?>
