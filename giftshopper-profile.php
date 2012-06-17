<?php
  
  $name = '';
  if ($profile) {
    $name = "pentru <span class='highlight'>$profile->name</span>";
  }

?>

<h3>Cadoul perfect <span id="name"><?php echo $name?></span></h3>
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
          <dd>
            <?php 
              if ($categories) {
                $childrens = get_categories("child_of=" . $c);
                $children_ids = array();
                foreach ($childrens as $children) {
                  $children_ids[] = $children->term_id;
                }
                $output = "";                
                foreach ($categories as $cat) {
                  if (in_array($cat, $children_ids)) {
                    $output .=  '<br/>' . get_the_category_by_ID($cat);
                  }
                }
                if ($output == "") { $output = "---"; }
                echo $output;
              } else {
                echo "---";
              }
            ?>
          </dd>
        </dt>
      <?php
      $counter += 1; 
    } ?>
  <dt id="step-budget">Buget</dt>
  <dd>
    <?php if ($profile->price) {
      echo $profile->price;
    } else {
      echo "---";
    } ?>
  </dd>
</dl>
