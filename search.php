<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>


<?php 
  try {
    $error = false;
    
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
  } catch (Exception $e) {
    $error = true;
  }	 
   		
  $fullsearch = true; 				  
?>

<div id="search-results" class="block">

  <div id="content" class="column span-18">
    
    <div class="block">    
      
      <?php if ($error) {      
        include "404.php";      
       } else { ?>
      
        <div id="search-results-header">
          <h1>Rezultate cautare</h1>
          <table>
            <tr><td>Expresia cautata:</td><td>
              <?php if ($text == '+') {
                echo "Toate produsele";
              } else { 
                echo $text; 
                $fullsearch = false;
              } ?>
            </td></tr>
            <tr><td>Cautare dupa pret:</td><td> 
              <?php if ($price == "0-100000") {
                echo "Cautare fara pret";
              } else { 
                echo $price; 
                $fullsearch = false;
              } ?>
            </td></tr> 
            <tr><td>Numar rezultate:</td>
            <td><span id="counter">...</span></td></tr>           
          </table>
        </div>
        
        <div id="search-results-items">
          <?php if ($fullsearch) {          
            if (have_posts()) { ?>  
              <div id="navigation" class="block">
                <?php if(function_exists('wp_paginate')) {
                  wp_paginate();
                } ?>  
              </div>
            
              <div id="search-results" class="bestsellers">    
                <?php 
                  $counter = $wp_query->found_posts;
                  while (have_posts()) : the_post();
                    if (advanced_search($post, $price, $categories)) { 
                      $medium = true;
                      $show_category = true;
                      include "product-thumb.php";    
                    }
                  endwhile; ?>
              </div>              
              <div class="clear"></div>
            
              <div id="navigation" class="block">
	              <?php if(function_exists('wp_paginate')) {
                  wp_paginate();
                } ?>
              </div>              
            <?php } else {
              echo "<h4>Nu am gasit nici un rezultat. Va rugam incercati din nou.</h4>";
            } 
           
           } else { 
            
            $allsearch = &new WP_Query("s=$s&showposts=-1");
            if ($allsearch->have_posts()) { ?> 
            
              <div id="search-results" class="bestsellers">
                <?php
                $counter = 0;
                while ($allsearch->have_posts()) : $allsearch->the_post(); update_post_caches($posts);
                  if (advanced_search($post, $price, $categories)) {
                    $medium = true;
                    $show_category = true;
                    include "product-thumb.php";
                    $counter += 1;
                  }
                endwhile;
                ?>
              </div>
              <div class="clear"></div>              
           	<?php }
           } ?>
        <span id="search-count" class="hidden"><?php echo $counter; ?></span>           
        </div>      
     <?php } ?>
   </div>
  </div>  
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>


	
