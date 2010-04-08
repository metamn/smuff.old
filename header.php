<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<title>
		  <?php bloginfo('name') ?> &mdash; <?php bloginfo('description') ?>		  
		</title>

		<?php do_action( 'bp_head' ) ?>

		<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

    <!-- Blueprint -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/blueprint/print.css" type="text/css" media="print">	
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/smuff.css" type="text/css" media="screen" />
		<!-- S3 slider -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.s3slider.css" type="text/css" media="screen" />
		
		<!-- jQuery Tools -->
		<script type="text/javascript" src="http://cdn.jquerytools.org/1.1.2/full/jquery.tools.min.js"></script>
		<!-- S3 slider -->
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/s3Slider.js" ></script>
    <!-- scrollable -->
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tools.scrollable.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tools.scrollable.css" type="text/css" media="screen" />
    <!-- accordion -->
		<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tools.accordion.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tools.accordion.css" type="text/css" media="screen" />
    <!-- image hover tooltip -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.image.tooltip.js"></script>
    <!-- jquery table sorter -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.tablesorter.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.init.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tablesorter.css" type="text/css" media="screen" />
    <!-- tmblr slider -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/easySlider1.7.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.easyslider.css" type="text/css" media="screen" />
    
    <!-- jQuery Theme -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/smoothness/jquery-ui-1.7.2.custom.css" type="text/css" media="screen, projection">
		
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

		<?php wp_head(); ?>

	</head>
	<body>			  	
	  <div class="container"><!-- closed in the footer -->
	    
	    <div class="block">	      
	      <div id="header" class="column span-18">                 
          <div id="headlines" class="block">
	          <div id="logo" class="column span-8 last">
	            <h1>
	              <a href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?> -- <?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>
	              <span class="strapline"><?php bloginfo('description');?></span>			      
	           </h1>			      
			      </div>
			      <div id="main-name" class="column span-10 last">
			        <?php 
			          $page_name = "&nbsp;"; 
			          if (is_category()) {
                  $page_name = single_cat_title('', false);
                } elseif (is_single()) {
                    $cat_id = category_id(is_category(), is_single());
                    if (!($cat_id == 0)) {
                      $page_name = get_cat_name($cat_id); 
                    } 
                } elseif (is_home()) { 
                  $page_name = "Blog";
                }?>
			        <h1><?php echo $page_name ?></h1>
			      </div>
			    </div>
			    <div id="menu" class="last">
			      <ul class="inline-list">
		          <?php 
		            $cats = get_categories('child_of=47');
		            foreach ($cats as $c) { ?>
		              <li>
		                <a href="<?php echo get_category_link($c->term_id)?>?view=1" title="Toate produsele din <?php echo $c->name ?>"><?php echo $c->name ?></a>
		              </li>
		            <?php } ?>
		        </ul>
			    </div>			    
		    </div>		    
		    
	      <div id="cart" class="column span-6 last">
	        <?php echo nzshpcrt_shopping_basket(); ?>	          	        
	      </div>
	    </div>  	
	    
		
	  		
			
