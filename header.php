<?php if (is_page('facebook')) {
  include "facebook-header.php";
} else { ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml" <?php language_attributes(); ?> >
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		
		<?php include "facebook-meta.php" ?>
		
		<meta name="google-site-verification" content="3NvL8OPM6rq9nvaT31vA5p2qAjbmwaMGFxQaVv9w0PQ" />
		<META name="y_key" content="694535270b47ea68">
		
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
		
    <!-- Blueprint -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/blueprint/print.css" type="text/css" media="print">	
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->
    <!--[if lt IE 8]><link rel="stylesheet" href="css/blueprint/smuff-ie.css" type="text/css" media="screen, projection"><![endif]-->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/smuff.css?refresh=20121001" type="text/css" media="screen" />
		
		<!--
		- JS cannot be put in foooter !!!!!!!!!!!!!!
		- there must be two JQueries, one for me the other for WPEC
		-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script>!window.jQuery && document.write('<script src="/wp-includes/js/jquery/jquery.js"><\/script>')</script>
    
    <!-- jQuery Tools -->	
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


    <!-- Init GA to be able to add custom variables -->
		<script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-1587157-1']);
      _gaq.push(['_trackPageview']);
      
      // The rest is in the footer and jquery.init.js 
    </script>

    <!-- init all jquery functions -->
    <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.init.js?refresh=20120612"></script>
		
		
		
		
    <!-- tablesorter -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tablesorter.css" type="text/css" media="screen" />    
    <!-- jQuery Theme -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/smoothness/jquery-ui-1.7.2.custom.css" type="text/css" media="screen, projection">
		<!-- accordion -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tools.accordion.css" type="text/css" media="screen" />
    <!-- scrollable -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.tools.scrollable.css" type="text/css" media="screen" />
    <!-- slider -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.sudoslider.css" type="text/css" media="screen" />
    <!-- jqzoom
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/jqzoom.css" type="text/css" media="screen" />
    -->
    
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts RSS Feed', 'buddypress' ) ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> <?php _e( 'Blog Posts Atom Feed', 'buddypress' ) ?>" href="<?php bloginfo('atom_url'); ?>" />

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		
		
		<?php wp_head(); ?>
	
		
    
	</head>
	
	
	 <body <?php body_class(); ?>> 
	  <div id="background-image-container"></div>		
	  
	  <div id="ajax-url" data-url="<?php echo admin_url('admin-ajax.php'); ?>" data-loading="<?php bloginfo('stylesheet_directory')?>/assets/ajax-loader.gif" class="hidden"></div>	  	
	  
	  <div class="container"><!-- closed in the footer -->
	    <div class="block">	      
	      <div id="header" class="column span-18"> 
	        <div id="tooltips" class="block">
	          <!--
	          <a href="http://smuff.ro/2010/08/05/test-2/">
	          Bine ati ajuns la noul Smuff! Va rugam consultati mica introducere despre schimbarile facute.
	          </a>
	          -->
	        </div>                
          <div id="headlines" class="block">	          
	          <div id="logo" class="column span-10 last">
	            <h1>
	              <a class="tooltip" alt="<?php echo page_excerpt('despre-noi'); ?>" href="<?php bloginfo('home'); ?>" title="<?php bloginfo('name'); ?> -- <?php bloginfo('description'); ?>"><?php bloginfo('name'); ?></a>
	              <span class="strapline">	                
	                <a class="tooltip <?php echo $shop?>" alt="<?php echo page_excerpt('despre-noi/magazinul-smuff'); ?>" href="<?php bloginfo('home'); ?>" title="Smuff -- cadouri premium">inseamna cadouri</a>	                
	              </span>			      
	           </h1>			      
			      </div>
			      
			      
			      <div id="main-name" class="column span-8 last">			        
			        <h1>
			        <?php 
			          $tag = single_tag_title("", false);
			          if ($tag) {
			            $tag2 = str_replace('magazin ', '', $tag);
			            echo ucfirst($tag2);
			          } else {
			            echo page_name(is_category(), is_single(), null);
			          }			        
			         ?>
			        </h1>
			      </div>
			    </div>
			    
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
		            <li class="all-products-link"><a href="<?php bloginfo('home'); ?>/category/produse/?view=3">Toate<br/>cadourile</a></li>
		        </ul>
			    </div>			    
			    
		    </div>		    
		    
		    <?php if (is_page(430)) { ?>
		      <div id="pricing-policy" class="column span-6 last">
	          <h2>Politica de preturi</h2>
	          <p>
	            La Smuff practicam cele mai bune preturi.
	          </p>
	          <p>
	            Click aici pentru informatii.
	          </p>
	        </div>
		    <?php } else { ?>		    
	        <div id="cart" class="column span-6 last">
	          <?php dynamic_shopping_cart(); ?>          
	        </div>
	      <?php } ?>
	    </div>  	
	    
<?php } //facebook header ?> 		
	  		
			
