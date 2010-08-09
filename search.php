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
        </table>
      </div>
      
      
      <div id="search-results-items">
        <?php 
          $allsearch = &new WP_Query("s=$s&showposts=-1"); 
          if ($allsearch->have_posts()) { 
            $counter = 1;
            while ($allsearch->have_posts()) : $allsearch->the_post(); update_post_caches($posts); 
              if (advanced_search($post, $price, $categories)) { 
                $klass = 'col-' .($counter % 3);
                $counter += 1; ?>
                <div id="item" class="column span-6 last <?php echo $klass ?>">
                  <?php include "product-thumb.php"; ?>                        
                </div>
              <?php }
            endwhile;                     
          } else {
            echo "<h4>Nu am gasit nici un rezultat. Va rugam incercati din nou.</h4>";
          } ?>	
      </div>      
   </div>
  </div>  
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>


	
