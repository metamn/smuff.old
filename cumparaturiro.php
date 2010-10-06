<?php
  /*
  Template Name: Cumparaturiro
   * @package WordPress
   * @subpackage Default_Theme
   */
?>

<?php 

// Datafeed for cumparaturi.ro
// Syntax: http://www.cumparaturi.ro/intrebari/detalii-feed-pentru-cumparaturi-ro-18.html 
// 218|Masini de spalat|LG|Masina de spalat LG F1222ND|F1222ND|1874.58|RON cu TVA|Disponibil|2 ani|http://www.lgshop.ro/masini-de-spalat/masina-de-spalat-lg-f1222nd.html|http://www.lgshop.ro/pictures/f1222nd.jpg|Cod Produs: F1222ND
//Direct Drive Fara vibratii sau zgomot Un motor mult mai stabil este mult mai durabil etc etc... ....Dimensiuni: 842 x 600 x 440; Caracteristici: Afisaj Led;


$separator = "|";
$currency = "RON cu TVA";

$posts = get_posts('numberposts=-1&category=10');
if ($posts) {
  foreach ($posts as $p) {
    $id = $p->ID;
    $yes = get_post_meta($id, 'cumparaturi', true);
    if ($yes) {
      $product_id = get_post_meta($id, 'product_id', true);      
      $category = $yes;
      $brand = "";
      $brand = get_post_meta($id, 'brand', true);
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
      $stoc = "disponibil in stoc";
      $garantie = "1 an";
            
      print      
      $product_id . $separator .
      $category . $separator .
      $brand . $separator .
      $title . $separator .
      $product_id . $separator .
      $price . $separator .
      $currency . $separator .
      $stoc . $separator .
      $garantie . $separator .
      $url . $separator .
      $image . $separator .
      $description . "\n";
    }
  }
}


?>
