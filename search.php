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
            $allsearch = &new WP_Query("s=$s&showposts=200");
            $allsearch2 = &new WP_Query("s=$s&showposts=200&offset=200");
            $allsearch3 = &new WP_Query("s=$s&showposts=200&offset=400");
            
            if ($allsearch->have_posts()) { ?>             
              <div id="advanced-search-link" class="block">
                <h3><a href="<?php bloginfo('home'); ?>/cautare-avansata" title="Cautare avansata" alt="Cautare avansata">
                Am gasit <em><span id="counter">...</span></em> produse. 
                Pentru o cautare mai avansata click aici &rarr;</a>
                </h3>
              </div>              
              
              <div id="search-results" class="bestsellers">                
                
                <?php 
                $counter = 0;
                while ($allsearch->have_posts()) : $allsearch->the_post(); update_post_caches($posts); 
                  if (advanced_search($post, $price, $categories)) { 
                    $medium = true;
                    include "product-thumb.php";                        
                    $counter += 1;
                  }
                endwhile; 
                ?>
                
                <?php
                while ($allsearch2->have_posts()) : $allsearch2->the_post(); update_post_caches($posts); 
                  if (advanced_search($post, $price, $categories)) { 
                    $medium = true;
                    include "product-thumb.php";                        
                    $counter += 1;
                  }
                endwhile; 
                ?>
                
                <?php 
                while ($allsearch3->have_posts()) : $allsearch3->the_post(); update_post_caches($posts); 
                  if (advanced_search($post, $price, $categories)) { 
                    $medium = true;
                    include "product-thumb.php";                        
                    $counter += 1;
                  }
                endwhile; 
                ?>
              </div>
              
              <div class="clear"></div>
              <span id="search-count" class="hidden"><?php echo $counter; ?></span>
              <div id="advanced-search-link" class="block">
                <h3><a href="<?php bloginfo('home'); ?>/cautare-avansata" title="Cautare avansata" alt="Cautare avansata">
                Am gasit <em><?php echo $counter; ?></em> produse. 
                Pentru o cautare mai avansata click aici &rarr;</a>
                </h3>
              </div> 
              <center>
                <a class="all-products-link" title="Inapoi la inceputul paginii" href="#header">
      Inapoi la inceputul paginii &uarr;</a>
              </center>                   
              
            <?php } else {
              echo "<h4>Nu am gasit nici un rezultat. Va rugam incercati din nou.</h4>";
            } ?>	
        </div> 
     
     <?php } ?>   
           
   </div>
  </div>  
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>


	
