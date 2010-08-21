<?php
  $dbhost = 'localhost';
  $dbuser = 'cs';
  $dbpass = '';
  $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');


  // [post-slug] => view_number
  $imp = array();
  mysql_select_db('arigato_wordpress');
  $query = mysql_query("SELECT `post`,`sayac_toplam` FROM `wp_sayfa_sayac_21`"); 
  while ($sayfa = mysql_fetch_array($query)) {
    $q = mysql_query("SELECT `ID`,`post_name` FROM `wp_posts` WHERE `ID`=".$sayfa[0]); 
    $post = mysql_fetch_array($q);
    $imp[$post[1]] = $sayfa[1];    
  }
  //print_r($imp);


  // make the changes
  mysql_select_db('ujsmuff');
  foreach ($imp as $key => $value) {
    $s = sprintf("SELECT ID, post_name FROM wp_cp53mf_posts WHERE post_name='%s'", $key);
    $q = mysql_query($s);
    $r = mysql_fetch_array($q);
    
    // update
    $value = round($value * 1.25);
    $sql = mysql_query("UPDATE `ujsmuff`.`wp_cp53mf_postmeta` SET `meta_value` = " .$value." WHERE `meta_key`='views' AND `wp_cp53mf_postmeta`.`post_id` = " . $r[0]);
    echo $r[1] . ' ' . $sql . "\n\r";
    
    // echo new values
    $q2 = mysql_query("SELECT * FROM `wp_cp53mf_postmeta` WHERE `meta_key`='views' AND `post_id`=".$r[0]); 
    $r2 = mysql_fetch_array($q2);
    echo $r[1] . ' => ' .$r2[3] . "\n\r";        
  }
  
  
  
  mysql_close($conn);
  
  
?>

