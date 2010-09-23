<?php
  /*
  Template Name: Shopmania
   * @package WordPress
   * @subpackage Default_Theme
   */
?>

<?php 

// Datafeed for shopmania
// Syntax: 
// Telefoane Mobile|LG||12345|LG KE800|Aici este descrierea produsului...|http://www.example.com/product.php?id=12345|http://www.example.com/images/12345.jpg|156.00|RON

$separator = "|";
$currency = "RON";

$posts = get_posts('numberposts=-1&category=10');
if ($posts) {
  foreach ($posts as $p) {
    $id = $p->ID;
    $yes = get_post_meta($id, 'shopmania', true);
    if ($yes) {
      $category = 'uncategorized';
      $brand = get_post_meta($id, 'brand', true);
      $product_id = get_post_meta($id, 'product_id', true);
      $title = product_name($product_id);
      $description = product_excerpt($p->post_content);
      $url = get_permalink($id);
      $imgs = post_attachements($id);
      $img = $imgs[0];  
      $medium = wp_get_attachment_image_src($img->ID, 'medium'); 
      $image = $medium[0];
      $price = product_price($id);
            
      print
      $category . $separator .
      $brand . $separator .
      $product_id . $separator .
      $title . $separator .
      $description . $separator .
      $url . $separator .
      $image . $separator .
      $price . $separator .
      $currency . "\n";
    }
  }
}


?>
