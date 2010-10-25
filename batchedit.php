<?php
  /*
  Template Name: Batchedit
   * @package WordPress
   * @subpackage Default_Theme
   */

get_header();

?>




<?php
  echo "running ..." . '<br/>';
  $posts = get_posts('numberposts=-1&category=10');
  if ($posts) {
    foreach ($posts as $p) {
      setup_postdata($p);
      echo 'Post: ' . $p->post_title . '<br/>';
      
      $descr = $p->post_content;
      $items = explode("<h3>Intrebari frecvente</h3>", $descr);
      // cut faq;
      $cut = explode("<h3>Opiniile cumparatorilor</h3>", $items[1]);
      // cut opinii text
      $opinions = str_replace("<em>Numai utilizatorii inregistrati pot exprima opiniile.</em>", "", $cut[1]); 
      $rest = "<h3>Opiniile cumparatorilor</h3>" . $opinions;
      // Assembly final output
      $final = $items[0] . $rest;
      
      // update post
      $update = array();
      $update['ID'] = $p->ID;
      $update['post_content'] = $final;
      
      echo "Result: " . wp_update_post($update) . '<br/><br/>';      
    }
  }
  echo "done!";
?>
