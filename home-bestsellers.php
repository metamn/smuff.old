<!--
<div id="announcement" class="block">
  <h4>Am facut mici schimbari la designul siteului Smuff. 
  <br/>
  Va rugam apasati CTRL+R (Refresh) pentru o experienta mai placuta. 
  Va multumim.</h4> 
</div>
-->


<?php 
  $cat = category_id(is_category(), is_single(), null);    
  $cat_name = '';
  if (!($cat == 0)) {
    $cat_name = ' din <b>'. get_cat_name($cat) . '</b>';
  } else {
    $cat_name = ' Smuff';
  } 
  //$wplogger->log( 'catname '.$cat_name );
  $title = 'Vezi toate noutatile' . $cat_name . ' &rarr;'; 
  $link_type = '3'; // 2=table view, 3=grid view
  echo '<h4 class="all-products-link">';
  echo '<a href="#noutati" id="new-products-link">' . $title . '</a>'; 
  echo '</h4>';
?>

<div id="noutati" class="hidden block"></div>


<?php //include 'c_summer-2012.php' ?>
<div class='block'><?php include 'c_subscribe-to-newsletter.php' ?></div>

  
<div id="bestsellers" class="bestsellers block"> 
    
  <div id="col-0" class="column span-2 last">    
    <h3 class='first'>B</h3>
    <h3>e</h3>
    <h3>s</h3>
    <h3>t</h3>
    <h3>s</h3>
    <h3>e</h3>
    <h3>l</h3>
    <h3>l</h3>
    <h3>e</h3>
    <h3>r</h3>
    <h3 class='last'>s</h3>        
  </div>
  
  
  <div id="col-1" class="column span-7 prepend-1 last">
    <div class="items">	
        <?php
          if ($top_sales->have_posts()) {
            $counter = 0;
            $count = $top_sales->post_count / 2;
            while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
              if ($counter < $count) {   
                $medium = true;    
                if ($cat == 0 || $cat == 10) {
                  $show_category = true;         
                } else {
                  $show_category = false;         
                }
                include "product-thumb.php";              
              }
              $counter += 1;
            endwhile; 
          }
        ?>       		        
	  </div>
  </div>
  
  <div id="col-2" class="column span-7 prepend-1 last">
    <div class="items">	
        <?php
          if ($top_sales->have_posts()) {
            $counter = 0;
            while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
              if($counter >= $count) {    
                $medium = true;            
                if ($cat == 0 || $cat == 10) {
                  $show_category = true;         
                } else {
                  $show_category = false;         
                }
                include "product-thumb.php";              
              }
              $counter += 1;
            endwhile; 
          }        
        ?>       		        
	  </div>
  </div>
  
  <?php 
    $cat = category_id(is_category(), is_single(), null);    
    $cat_name = '';
    if (!($cat == 0)) {
      $cat_name = ' din <b>'. get_cat_name($cat) . '</b>';
    } else {
      $cat_name = ' Smuff';
    } 
    //$wplogger->log( 'catname '.$cat_name );
    $title = 'Vezi toate cadourile' . $cat_name . ' &rarr;'; 
    $link_type = '3'; // 2=table view, 3=grid view
    echo '<h4 class="all-products-link">';
    include 'home-all-products-link.php'; 
    echo '</h4>';    
  ?>

</div>

