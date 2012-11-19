<html>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="google-site-verification" content="3NvL8OPM6rq9nvaT31vA5p2qAjbmwaMGFxQaVv9w0PQ" />
		<META name="y_key" content="694535270b47ea68">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>		  		  
		  <?php 
		    $title = wp_title('', false, 'right');
		    $subs = explode("&#8212;", $title);
		    
		    if ($subs[0]) {
		      echo $subs[0] . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
		    } else {
		      if ($title) {
		        echo $title . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
		      } else {
            echo get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
		      }
		      
		    }
		  ?>
		</title> 
	
    <link href="<?php bloginfo('stylesheet_directory'); ?>/assets/screen.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/print.css" media="print" rel="stylesheet" type="text/css" />
		<!--[if IE]>
				<link href="<?php bloginfo('stylesheet_directory'); ?>/assets/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<![endif]-->
		
		
		<!--
			- JS cannot be put in foooter !!!!!!!!!!!!!!
			- there must be two JQueries, one for me the other for WPEC -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script>!window.jQuery && document.write('<script src="/wp-includes/js/jquery/jquery.js"><\/script>')</script>
    

    <!-- Init GA to be able to add custom variables -->
		<script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-1587157-1']);
      _gaq.push(['_trackPageview']);
      
      // The rest is in the footer and jquery.init.js 
    </script>

    <!-- init all jquery functions -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/assets/jquery.init.js?refresh=20121119"></script>
		<link href='http://fonts.googleapis.com/css?family=Coda|Oxygen|Oswald:400,700|Nothing+You+Could+Do' rel='stylesheet' type='text/css'>
		
		<?php wp_head(); ?>
    
	</head>
	
	
	 <body <?php body_class(); ?>> 
	  <div id="background-image-container"></div>		
	  
	  <div id="ajax-url" data-url="<?php echo admin_url('admin-ajax.php'); ?>" data-theme-url="<?php bloginfo('stylesheet_directory')?>" class="hidden"></div>	  	
	  
	  
	  <div class="container"><!-- closed in the footer -->
	    
	    <header id="header">
	    	<div id="cart" class="desktop">
					<?php dynamic_shopping_cart(); ?>          
				</div>
				<div id="cart" class="mobile">
					<ul>
						<li>Cos</li>
						<li>Info</li>
					</ul>
				</div>
				
	    	<hgroup>
	    		<div id="logo">
						<a alt="<?php echo page_excerpt('despre-noi'); ?>" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?> -- <?php bloginfo('description'); ?>">
							<h1><?php bloginfo('name'); ?></h1>
						</a>
					</div>
					
					<div id="strapline">
						<a alt="<?php echo page_excerpt('despre-noi'); ?>" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?> -- <?php bloginfo('description'); ?>">
							<h2><?php bloginfo('description'); ?></h2>
						</a>
					</div>
					
	    		<div id="page-name">			        
						<h1><?php echo page_main_name(); ?></h1>
					</div>
	    	</hgroup>
	    	
	    	<nav>
					<ul>
						<?php 
							$cats = array("gadget", "gizmo", "lifestyle", "self-care", "eco", "ceasuri", "doar-copii");		            
							foreach ($cats as $cat) { 
								$c = get_category_by_slug($cat);
							?>
								<li>
									<a alt="<?php echo $c->description ?>" href="<?php echo get_category_link($c->term_id)?>" title="Toate produsele din <?php echo $c->name ?>"><?php echo $c->name ?></a>
								</li>
							<?php } ?>
							<li class="all-products-link"><a href="<?php bloginfo('home'); ?>/category/produse/?view=grid">Toate cadourile &rarr;</a></li>
					</ul>
			  </nav>		
	    </header>
	  		
			
