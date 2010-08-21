<?php
  $dbhost = 'localhost';
  $dbuser = 'cs';
  $dbpass = '';
  
  $arigato = mysql_connect($dbhost, $dbuser, $dbpass, true) or die ('Error connecting to mysql');
  $smuff = mysql_connect($dbhost, $dbuser, $dbpass, true) or die ('Error connecting to mysql');
  

  // get old comment count
  // [post-slug] => comment count
  $imp = array();
  mysql_select_db('arigato_wordpress', $arigato);
  $sql = mysql_query("SELECT `comment_post_ID`, COUNT(*) as \"Nr\" FROM `wp_comments` GROUP BY `comment_post_ID`", $arigato);
  while ($old = mysql_fetch_array($sql)) {
    $q = mysql_query("SELECT `ID`,`post_name` FROM `wp_posts` WHERE `ID`=".$old[0], $arigato); 
    $post = mysql_fetch_array($q);
    $imp[$post[1]] = $old[1];    
  }
  print_r($imp);

  mysql_select_db('ujsmuff', $smuff);
  foreach ($imp as $key => $value) {
    $s = sprintf("SELECT ID, post_name FROM wp_cp53mf_posts WHERE post_name='%s'", $key);
    $q = mysql_query($s, $smuff);
    $r = mysql_fetch_array($q);
    
    $comm = mysql_query("SELECT `comment_post_ID` FROM `wp_cp53mf_comments` WHERE `comment_post_ID`=".$r[0], $smuff);
    if (mysql_num_rows($comm) == $value) {
      echo $key . ' OK';
    } else {       
      echo $key . ' needs update: ' . mysql_num_rows($comm) . ' > ' . $value . "\n\r";
      
      mysql_query("DELETE FROM `wp_cp53mf_comments` WHERE `comment_post_ID`=".$r[0], $smuff);
      
      $s1 = sprintf("SELECT ID, post_name FROM wp_posts WHERE post_name='%s'", $key);
      $q1 = mysql_query($s1, $arigato);
      $r1 = mysql_fetch_array($q1);      
      $res = mysql_query("INSERT INTO ujsmuff.wp_cp53mf_comments SELECT * FROM arigato_wordpress.wp_comments WHERE `comment_post_ID`=".$r1[0]);
      echo "adding ... " . $res . "\n\r";
      //$new = mysql_query("SELECT * FROM wp_comments WHERE `comment_post_ID`=".$r1[0], $arigato);
      //echo 'new records to be added: ' . mysql_num_rows($new) . "\n\r";
      //while ($n = mysql_fetch_array($new)) {
      //  echo '$n = ' .$n[1] . "\n\t";
      //  echo 'adding ' . mysql_query("INSERT INTO wp_cp53mf_comments VALUES ". $n, $smuff) . "\n\r"; 
      //}
      
    }
    
    echo "\n\r";
  }
  
  mysql_close($arigato);
  mysql_close($smuff);
  
?>
