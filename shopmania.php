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

$offset = 0;
while ($offset >= 0) {
  $posts = get_posts('numberposts=&category=10&offset='.$offset);
  if ($posts) {
    foreach ($posts as $p) {
      $id = $p->ID;
      $yes = get_post_meta($id, 'shopmania', true);
      if ($yes) {
        $category = $yes;
        $brand = get_post_meta($id, 'brand', true);
        $model = get_post_meta($id, 'model', true);
        $product_id = get_post_meta($id, 'product_id', true);
        $title = product_name($product_id);
        
        $description = product_excerpt($p->post_content);
        $description = html_to_text($description);
        $description = replace_not_in_tags("\n", "<BR />", $description);
		    $description = str_replace("\n", " ", $description);
		    $description = str_replace("\r", "", $description);
        
        $url = get_permalink($id);
        
        $imgs = post_attachements($id);
        $img = $imgs[0];  
        $medium = wp_get_attachment_image_src($img->ID, 'medium'); 
        $image = $medium[0];
        
        $price = product_price($id);
              
        echo
        $category . $separator .
        $brand . $separator .
        $model . $separator .
        $product_id . $separator .
        $title . $separator .
        $description . $separator .
        $url . $separator .
        $image . $separator .
        $price . $separator .
        $currency . "\n";
        
        flush();
      }
    }
    $offset += 10;
  } else {
    $offset = -1;
  }
}


?>
