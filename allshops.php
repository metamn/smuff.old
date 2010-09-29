<?php
  /*
  Template Name: Allshops
   * @package WordPress
   * @subpackage Default_Theme
   */
?>

<?php 

// Datafeed for Allshops
// Syntax: 
// Telefoane Mobile|LG||12345|LG KE800|Aici este descrierea produsului...|http://www.example.com/product.php?id=12345|http://www.example.com/images/12345.jpg|156.00|RON

$separator = ";";
$currency = "1";

$posts = get_posts('numberposts=-1&category=10');
if ($posts) {
  foreach ($posts as $p) {
    $id = $p->ID;
    $yes = get_post_meta($id, 'allshops', true);
    if ($yes) {
      $category_id = "1";
      $tag = "";
      $discount = "";
      
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
            
      print
      base64_encode($category_id) . $separator .  
      base64_encode($category) . $separator .
      base64_encode($title) . $separator .
      base64_encode($product_id) . $separator .
      base64_encode($description) . $separator .
      base64_encode($image) . $separator .
      base64_encode($category) . $separator .
      base64_encode($tag) . $separator .
      base64_encode($tag) . $separator .
      base64_encode($tag) . $separator .
      base64_encode($brand) . $separator .
      base64_encode($price) . $separator .
      base64_encode($discount) . $separator . 
      base64_encode($currency) . $separator . 
      base64_encode($url) . $separator . "\n\r";
    }
  }
}


?>
