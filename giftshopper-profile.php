<h3>Cadoul perfect <span id="name"></span></h3>
<dl>
  <?php 
      $counter = 1;
      foreach ($steps as $c) {  ?>          
        <dt id="step-<?php echo $counter ?>">            
          <?php 
            if ($counter == 5 ) {
              echo "Ce il face fericit?";
            } else {
              echo get_the_category_by_ID($c);
            } ?>
          <dd>&mdash;</dd>
        </dt>
      <?php
      $counter += 1; 
    } ?>
  <dt id="step-budget">Buget</dt>
  <dd>&mdash;</dd>
</dl>
