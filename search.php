<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>


<?php 
  try {
    $error = false;
    
    $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);	
    $subs = explode("&", $params);
    
   
    $price = array();
    $delivery = array();
    $meta = array();
    $categories = array();
    $text = '';
    
    foreach ($subs as $k => $v) {
    	$item = explode("=", $v);
    	$key = sanitize_text_field($item[0]);
    	$value = sanitize_text_field($item[1]);
    	
    	switch ($key) {
    		case 'price':
    			$price[] = $value;
    			break;
    		case 'delivery':
    			$delivery[] = $value;
    			break;
    		case 'meta':
    			$meta[] = $value;
    			break;
    		case 'category':
    			$categories[] = $value;
    			break;
    		case 's2':
    			$text = $value;
    			break;
    	}
    }
    
  } catch (Exception $e) {
    $error = true;
  }	  	

	if ($error) {      
		include "404.php";      
	} else { 
    include "archive-grid.php";	
	} 
?>


	
