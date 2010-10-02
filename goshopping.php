<?php
  /*
  Template Name: GoShopping
   * @package WordPress
   * @subpackage Default_Theme
   */
?>

<?php 

// Datafeed for goshopping
// Syntax: 
// Categorie | Producator | Model | Cod produs | Titlu produs | Descriere produs | URL produs | URL imagine produs | Pret produs | Moneda


$separator = " | ";
$currency = "RON";

$posts = get_posts('numberposts=-1&category=10');
if ($posts) {
  foreach ($posts as $p) {
    $id = $p->ID;
    $yes = get_post_meta($id, 'goshopping', true);
    if ($yes) {
      $category = $yes;
      $brand = '';
      $model = '';
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
      $category . ' ||| ' .
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