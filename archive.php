<?php get_header(); ?>

<?php 
  $view = '0';
    
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);		
	$subs = explode("&", $params);		  	
	$tmp = explode("=", $subs[0]);  // for apache
	#$tmp = explode("=", $subs[1]); // for nginx
	$view = $tmp[1];
	
  switch ($view) {
    case '1':
      include "archive-shop.php";
      break;
    case '2':
      include "archive-all-table.php";
      break;    
    case '3':
      include "archive-all-grid.php";
      break;
    default:
      if (is_blog()) {
        include "archive-blog.php";
      } else {
        include "archive-shop.php";  
      }      
  }
?>


