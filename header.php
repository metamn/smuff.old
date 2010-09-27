<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<?php include "facebook-meta.php" ?>
		<title>		  		  
		  <?php wp_title(' pe ', true, 'right'); bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>
		</title> 
		
		
    <!-- Blueprint -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/blueprint/print.css" type="text/css" media="print">	
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/smuff-ie.css" type="text/css" media="screen, projection"><![endif]-->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/smuff.css" type="text/css" media="screen" />
		
		<!-- jQuery Tools 
		
		<script type="text/javascript" src="<?php bloginfo('home')?>/wp-includes/js/jquery/jquery.js"></script>
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tools.min.js"></script>
		
		
		-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script>!window.jQuery && document.write('<script src="/wp-includes/js/jquery/jquery.js"><\/script>')</script>
		<script type="text/javascript" src="http://cdn.jquerytools.org/1.2.3/all/jquery.tools.min.js"></script>
		<!-- S3 slider -->
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.sudoSlider.min.js" ></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.thumbslider.js" ></script>
    <!-- jquery table sorter -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tablesorter.min.js"></script>
    <!-- init all jquery functions -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.init.js"></script>
    
    
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tablesorter.css" type="text/css" media="screen" />    
    <!-- jQuery Theme -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/smoothness/jquery-ui-1.7.2.custom.css" type="text/css" media="screen, projection">
		<!-- scrollable -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tools.scrollable.css" type="text/css" media="screen" />
    <!-- accordion -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tools.accordion.css" type="text/css" media="screen" />
    <!-- slider -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.sudoslider.css" type="text/css" media="screen" />
    
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<?php wp_head(); ?>

	</head>
	
	<?php
      $is_blog = is_blog(); 
      if ($is_blog) {
        $shop = '';
        $blog = 'active';
        $opacity = 'opacity';
        $klass = 'blog';
      } else {
        $shop = 'active';
        $blog = '';
        $opacity = '';
        $klass = '';
	 } ?>
	
	<body class="<?php echo $klass ?>">			  	
	  
	  <div class="container"><!-- closed in the footer -->
	    
	    <div class="block">	      
	      <div id="header" class="column span-18"> 
	        <div id="tooltips" class="block">
	          <!--
	          <a href="http://smuff.ro/2010/08/05/test-2/">
	          Bine ati ajuns la noul Smuff! Va rugam consultati mica introducere despre schimbarile facute.
	          </a>
	          
	          <a href="http://www.letsdoitromania.ro/" target="_blank">
	            Sustinem proiectul Let's Do It Romania! Curatenie in toata tara. Intr-o singura zi!
	          </a>
	          -->
	        </div>                
          <div id="headlines" class="block">	          
	          <div id="logo" class="column span-10 last">
	            <h1>
	              <a class="tooltip" alt="<?php echo page_excerpt('despre-noi'); ?>" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?> -- <?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>
	              <span class="strapline">	                
	                <a class="tooltip <?php echo $shop?>" alt="<?php echo page_excerpt('magazinul-smuff'); ?>" href="<?php bloginfo('home'); ?>" title="Magazinul Smuff">shop</a>
	                 & 
	                <a class="tooltip <?php echo $blog ?>" alt="<?php echo page_excerpt('blogul-smuff'); ?>" href="<?php bloginfo('home'); ?>/blog" title="Blogul Smuff">blog</a>
	              </span>			      
	           </h1>			      
			      </div>
			      
			      
			      <div id="main-name" class="column span-8 last">			        
			        <h1><?php echo page_name(is_category(), is_single()) ?></h1>
			      </div>
			    </div>
			    <?php if (!($is_blog)) { ?>
			    <div id="menu" class="last">
			      <ul class="inline-list">
		          <?php 
		            $cats = array("gadget", "gizmo", "lifestyle", "self-care", "eco", "ceasuri", "doar-copii");		            
		            foreach ($cats as $cat) { 
		              $c = get_category_by_slug($cat);
		            ?>
		              <li>
		                <a class="tooltip" alt="<?php echo $c->description ?>" href="<?php echo get_category_link($c->term_id)?>?view=1" title="Toate produsele din <?php echo $c->name ?>"><?php echo $c->name ?></a>
		              </li>
		            <?php } ?>
		        </ul>
			    </div>			    
			    <?php } ?>
		    </div>		    
		    
	      <div id="cart" class="column span-6 last <?php echo $opacity ?>">
	        <!-- for WP-Supercache // see functions.php for the implementation --> 
	        <!--mfunc dynamic_shopping_cart() -->
	        <?php dynamic_shopping_cart(); ?>
	        <!--/mfunc-->	        
	      </div>
	    </div>  	
	    
		
	  		
			
