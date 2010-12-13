<?php 
    $cat = category_id(is_category(), is_single(), null);    
    $cat_name = '';
    if (!($cat == 0)) {
      $cat_name = ' din <b>'. get_cat_name($cat) . '</b>';
    } else {
      $cat_name = ' Smuff';
    } 
    //$wplogger->log( 'catname '.$cat_name );
    $title = 'Vezi toate produsele' . $cat_name . ' &rarr;'; 
    $link_type = '3'; // 2=table view, 3=grid view
    echo '<h4 class="all-products-link">';
    include "home-all-products-link.php"; 
    echo '</h4>';
  ?>
  

<div id="bestsellers" class="block"> 
    
  <div id="col-0" class="column span-2 last">    
    <!--
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
    -->
    <h3 class='first'>O</h3>
    <h3>f</h3>
    <h3>e</h3>
    <h3>r</h3>
    <h3>t</h3>
    <h3>a</h3>
    <h3>&nbsp;</h3>
    <h3>d</h3>
    <h3>e</h3>
    <h3>&nbsp;</h3>
    <h3>C</h3>
    <h3>r</h3>
    <h3>a</h3>
    <h3>c</h3>
    <h3>i</h3>
    <h3>u</h3>
    <h3 class='last'>n</h3>
  </div>
  
  <div id="info" class="column span-15 prepend-1 last">
    <p>
      Stim ca timpul este foarte pretios, si <a href="http://www.smuff.ro/category/cu-ce-ocazie/craciun/?view=3">aici am adunat pe o singura pagina</a> toate produsele pe care le livram rapid pana Craciun astfel incat sub brad sa daruiti cele mai speciale cadouri celor dragi.
      <br/>
      Toate celelalte produse din magazin se livreaza cu confirmare telefonica anterioara.
    </p>
    <p>
      <a href="http://www.smuff.ro/special/craciun-2010/">La fiecare comanda noi punem un cadou.</a> 
      Surpriza este ca nimeni nu stie care dintre acestea va fi al lui. Speram sa va placa, speram sa va bucurati mult de Gadgeturile Smuff.
    </p>    
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
              if ($counter >= $count) {    
                $medium = true;            
                include "product-thumb.php";              
              }
              $counter += 1;
            endwhile; 
          }
        ?>       		        
	  </div>
  </div>
  
  <?php 
      $cat_name = get_cat_name(715);
      $title = 'Vezi toate produsele pentru ' . $cat_name . ' &rarr;'; 
      $link_type = '3'; // 2=table view, 3=grid view
      echo '<h4 class="all-products-link">';
      include "home-all-products-link.php"; 
      echo '</h4>';
    ?>

</div>

