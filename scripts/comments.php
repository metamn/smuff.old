<?php
  $dbhost = 'localhost';
  $dbuser = 'cs';
  $dbpass = '';
  
  $conn = mysql_connect($dbhost, $dbuser, $dbpass, true) or die ('Error connecting to mysql');
  
  

  // get old comment count
  // [post-slug] => comment count
  $imp = array();
  mysql_select_db('arigato_wordpress');
  $sql = mysql_query("SELECT `comment_post_ID`, COUNT(*) as \"Nr\" FROM `wp_comments` GROUP BY `comment_post_ID`");
  while ($old = mysql_fetch_array($sql)) {
    $q = mysql_query("SELECT `ID`,`post_name` FROM `wp_posts` WHERE `ID`=".$old[0]); 
    $post = mysql_fetch_array($q);
    $imp[$post[1]] = $old[1];    
  }
  //print_r($imp);

  
  mysql_select_db('ujsmuff');
  foreach ($imp as $key => $value) {
    $s = sprintf("SELECT ID, post_name FROM wp_cp53mf_posts WHERE post_name='%s'", $key);
    $q = mysql_query($s);
    $r = mysql_fetch_array($q);
    
    $comm = mysql_query("SELECT `comment_post_ID` FROM `wp_cp53mf_comments` WHERE `comment_post_ID`=".$r[0]);
    if (mysql_num_rows($comm) == $value) {
      echo $key . ' OK';
    } else {       
      echo $key . ' needs update: ' . mysql_num_rows($comm) . ' > ' . $value . "\n\r";
      
      mysql_query("DELETE FROM `ujsmuff`.`wp_cp53mf_comments` WHERE `wp_cp53mf_comments`.`comment_ID` =".$r[0]);
      //echo "deleted ..." . mysql_affected_rows() . "\n\r";
      
      $s1 = sprintf("SELECT ID, post_name FROM arigato_wordpress.wp_posts WHERE post_name LIKE '%s'", $key);
      $q1 = mysql_query($s1);
      $r1 = mysql_fetch_array($q1);
      
      
      $old = mysql_query("SELECT * FROM arigato_wordpress.wp_comments WHERE comment_post_ID=".$r1[0]);
      echo "updates for " . $r1[0] . ' are ' . mysql_num_rows($old) . "\n\r";
      
      while ($o = mysql_fetch_array($old)) {
        mysql_query("INSERT INTO ujsmuff.wp_cp53mf_comments (
          comment_ID, 
          comment_post_ID, 
          comment_author, 
          comment_author_email, 
          comment_author_url, 
          comment_author_IP, 
          comment_date, 
          comment_date_gmt, 
          comment_content, 
          comment_karma, 
          comment_approved, 
          comment_agent, 
          comment_type, 
          comment_parent, 
          user_id              
        ) VALUES (
          NULL,
          '$r[0]',
          '$o[2]',
          '$o[3]',
          '$o[4]',
          '$o[5]',
          '$o[6]',
          '$o[7]',
          '$o[8]',
          '$o[9]',
          '$o[10]',
          '$o[11]',
          '$o[12]',
          0,
          0
        )");
        echo "added ... " . mysql_affected_rows() . "\n\r";
        echo mysql_error() . "\n\r";
      } 
                       
    }    
    echo "\n\r";
  }
  
      
  
  mysql_close($conn);
  
?>
