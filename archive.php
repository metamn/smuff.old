<?php get_header(); ?>

<?php 
  $view = '0';
  
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);	
	$subs = explode("&", $params);		  
	$tmp = explode("=", $subs[0]);
	$view = $tmp[1];
	
  switch ($view) {
    case '1':
      include "archive-shop.php";
      break;
    case '2':
      include "archive-all.php";
      break;    
    default:
      include "archive-blog.php";  
  }
?>


