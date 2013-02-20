<html>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta name="google-site-verification" content="3NvL8OPM6rq9nvaT31vA5p2qAjbmwaMGFxQaVv9w0PQ" />
		<META name="y_key" content="694535270b47ea68">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		
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
		
		<!--[if lt IE 9]>
    <script src="<?php bloginfo('stylesheet_directory'); ?>/assets/html5shiv.js"></script>
    <![endif]-->
    <!--[if (lt IE 9) & (!IEMobile)]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
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
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/assets/jquery.init.js?refresh=20121129"></script>
    
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Coda|Oswald:400,700">
		
		
		<?php wp_head(); ?>
    
	</head>
	
	
	 <body <?php body_class(); ?>> 
	  <div id="above-container"></div>		
	  
	  <div id="ajax-url" data-url="<?php echo admin_url('admin-ajax.php'); ?>" data-theme-url="<?php bloginfo('stylesheet_directory')?>" class="hidden"></div>	  	
	  
	  
	  <div class="container"><!-- closed in the footer -->
	    
	    <header id="header">
				<hgroup>
				  <a alt="<?php echo page_excerpt('despre-noi'); ?>" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?> -- <?php bloginfo('description'); ?>">
					  <div id="logo"></div> 
				  </a>
					
					
					<div id="strapline">
						<a alt="<?php echo page_excerpt('despre-noi'); ?>" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?> -- <?php bloginfo('description'); ?>">
							<h2><?php bloginfo('description'); ?></h2>
						</a>
					</div>
	    	</hgroup>
	    	
	    	<div id="search">
		      <input type="text" name="search" value="">
		      <input type="submit" name="submit" value="">
		    </div>
	    	
	    	<nav id="menu">
					<ul>
						<?php 
							$cats = array("gadget", "lifestyle", "doar-copii", "produse", "wtf");		            
							foreach ($cats as $cat) { 
								$c = get_category_by_slug($cat);
							?>
								<li id="<?php echo $cat ?>">
									<a alt="<?php echo $c->description ?>" href="<?php echo get_category_link($c->term_id)?>" title="Toate produsele din <?php echo $c->name ?>"><?php echo $c->name ?></a>
								</li>
							<?php } ?>
							
							
							<li id="separator"></li>
							
							
							<li class="cart"><a href="">Cosul meu (0)</a></li>
              <li class="cart"><a href="">Contul meu</a></li>
              <li id="info" class="cart">Informatii</li>
					</ul>
			  </nav>	
			  
			  
			  
			  <nav id="menu-info">
			  
			    
			    <div id="contact">
			      <h3>Contacteaza-ne</h3>
			      <ul>
			        <li>0740-456.127</li>
			        <li>shop @ smuff.ro</li>
			        <li class="separator"></li>
			        <li><a href="">Despre noi</a></li>
              <li><a href="">Termeni si conditii</a></li>
			      </ul>
			    </div>
			    
			    <div class="shopping-info">
			      <h3>Cum cumpar?</h3>
			      <ul>
		          <li>
		            <h4>Shopping rapid</h4>
		            <p>
			            Fara procedura de inregistrare, numai cu un singur click.            
		            </p>
		          </li>
		          <li>
		            <h4>Plata la livrare</h4>
		            <p>
			            Plata ramburs cand aveti deja produsul in mana.
		            </p>
		          </li>
			      </ul>
			    </div>
			    
			     <div class="shopping-info">
			      <h3>&nbsp;</h3>
			      <ul>
		          <li>
		            <h4>10 zile drept de retur</h4>
		            <p>
			            Money back, fara intrebari din partea noastra.
		            </p>
		          </li>
		          <li>
		            <h4>Garantie minim 1 an</h4>
		            <p>
			            Service Express sau schimb cu un produs NOU.
		            </p>
		          </li>
			      </ul>
			    </div>
			    
			    <div id="close">
			      <span></span>
			    </div>
			    
			  </nav>
			  
			  
			  
			 
	    </header>
	  		
			
