<?php get_header(); ?>

<?php 
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);		
	$subs = explode("&", $params);	
	$tmp = explode("=", $subs[0]);  // for apache
	#$tmp = explode("=", $subs[1]); // for nginx
	$view = $tmp[1];
	
	if ($view == '') {
		$view = 'magazine';
	}

  switch ($view) {
  	case 'magazine':
      include "archive-magazine.php";
      break; 
    case 'grid':
      include "archive-grid.php";
      break;    
    default:
    	include "archive-magazine.php";        
  }
?>



