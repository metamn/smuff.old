<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>


<?php 
		  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);	
		  $subs = explode("&", $params);
		  
		  $tmp = explode("=", $subs[0]);
		  $text = $tmp[1];
		  
		  $tmp = explode("=", $subs[1]);
		  $price = $tmp[1];
		  
		  $tmp = explode("=", $subs[2]);
		  $is_search = $tmp[1];
		  
		  $cats = "";
		  $i = 0;
		  foreach ($subs as $sub) {
		    if ($i > 2) {
		      $tmp = explode("=", $sub);
		      $cats .= $tmp[1] . ",";
		    }
		    $i = $i + 1;
		  }	  				  
?>

<div id="search-results" class="block">

  <div id="content" class="column span-18">
    
    <div class="block">    
      <?php if ($is_search) { ?>
      <div id="search-results-header">
        <h1>Rezultate cautare</h1>
        <table>
          <tr><td>Expresia cautata:</td><td>
            <?php if (!($text == '+')) { echo $text; }  ?>
          </td></tr>
          <tr><td>Cautare dupa pret:</td><td> <?php echo $price; ?></td></tr>
          <tr><td>Categorii produse:</td><td> 
            <?php
              $categories = array();  
              if ($cats) {
                $categories = explode(",", $cats);
                foreach ($categories as $cat) {
                  echo get_cat_name($cat) . ', ';
                }
              } 
            ?>
          </td></tr>
          <tr><td>Rezultate gasite:</td><td> <?php echo $wp_query->post_count;; ?></td></tr>
        </table>
      </div>
      <?php } ?>
      
      <div id="search-results-items">
        <?php if (have_posts()) { 
          $result_counter = 0;
          while (have_posts()) {
            the_post();            
            if (advanced_search($post, $price, $categories)) {
              include "product-thumb.php";
              $result_counter = $result_counter + 1;              
            }
          }
          if ($result_counter > 9) {
            wp_paginate();
          }
        } else {
          echo "<h4>Nu am gasit nici un rezultat. Va rugam incercati din nou.</h4>";
        } ?>	
      </div>      
   </div>
  </div>  
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>


	
