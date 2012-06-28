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
    
    echo strpos($subs[0], 'page');
    
    // Eliminate pagination on nginx
    $index = 0;
    if (!(strpos($subs[0], 'page') === false)) {
      $index +=1 ;
    }
    
    $tmp = explode("=", $subs[$index]);
    $text = $tmp[1];
    $index +=1;
    
    $tmp = explode("=", $subs[$index]);
    $price = $tmp[1];
    $index +=1;
    
    $tmp = explode("=", $subs[$index]);
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

  // deal of the week  
  $dow_posts = query_posts2('posts_per_page=1&cat=15');

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
            <td><span id="search-counter">...</span></td></tr>           
          </table>
        </div>
        
        <!--
        <div id="announcement" class="block">
          <h4>Am facut mici schimbari la designul siteului Smuff. 
          <br/>
          Va rugam apasati CTRL+R (Refresh) pentru o experienta mai placuta. 
          Va multumim.</h4> 
        </div>
        -->
        
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
                  $i = 1;
                  while (have_posts()) : the_post();
                    if (advanced_search($post, $price, $categories)) { 
                      $medium = true;
                      $show_category = true;
                      include "product-thumb.php";    
                      
                      if ($i == 7) { include 'deal-of-the-week.php';}
                      $i++;
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
                    
                    if ($counter == 7) { include 'deal-of-the-week.php';}
                  }
                endwhile;
                ?>
              </div>
              <div class="clear"></div>	  
              <h4 class="all-products-link">
                <a class="all-products-link" title="Inapoi la inceputul paginii" href="#header">
                Inapoi la inceputul paginii &uarr;</a>
              </h4>            
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


	
