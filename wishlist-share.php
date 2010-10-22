<?php
  /*
  Template Name: Wishlist Share
   * @package WordPress
   * @subpackage Default_Theme
   */
   
  get_header(); 
?>

<?php 
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);	
  $subs = explode("=", $params);
  $wish = $subs[1];
  
  if ($wish) {
    $ids = get_option($wish);
    if ($ids) {
      foreach ($ids as $id) {
        $post = get_post($id);
        echo $post->post_title . '<br/>';
      }
    }
  } else {
    echo '<h4>Ooops, acest wishlist nu mai exista.</h4>';
  }
  
  
?>
