<?php 
  if ($nume !== '') {
    $list = gsh_get_list($email, $nume);
    if ($list) {
      $profile = $list[0];
      $categories = explode('-', $profile->categories);
    }
  }
?>

<div id="nav">
  <ul class="inline-list">
    <?php 
      $counter = 1;
      foreach ($steps as $c) { 
        if ($counter == 1) { 
          $klass = 'active';
        } else {
          $klass = '';
        } ?>
        <li id="step-<?php echo $counter ?>" class="<?php echo $klass; ?>">
          <?php echo get_the_category_by_ID($c); ?> 
          <span>></span>
        </li>
      <?php
      $counter += 1; 
    } ?>
    <li id="step-<?php echo $counter ?>">Ce il face fericit?
      <span>></span>
    </li>
    <li id="step-budget">Buget</li>
  </ul>     
</div>

<div id="steps">    
  <?php 
    $counter = 1;
    $steps[] = 10;
    foreach ($steps as $c) {
      if ($counter == 1) { 
        $klass = 'active';
      } else {
        $klass = '';
      }
    
      $childrens = get_categories("child_of=" . $c); ?>
      <div id="step-<?php echo $counter ?>" class="step <?php echo $klass; ?>">
         
        <?php if ($counter == 1 ) { ?>
          <div id="name">
          
            <?php if ($profile) { 
              $val = $profile->name;
              $place = $val; 
            } else {
              $val = '';
              $place = "Numele persoanei pentru care construiti cadoul perfect";
            } ?>
            
            <?php if ($nume != '') {
              $val = $nume;
              $place = $val;
            } ?>
          
            <input id="name" name="nume" type="text" value="<?php echo $val ?>" placeholder="<?php echo $place ?>"/>
          </div>
        <?php } ?>
        
        <ul>                  
          <?php foreach ($childrens as $ch) { 
            $checked = '';
            if ($profile) {
              if (in_array($ch->term_id, $categories)) {
                $checked = 'checked';
              }
            }          
          ?>
            <li>
              <?php if (in_array($c, $checkboxes)) { ?>
                <input <?php echo $checked ?> type="checkbox" name="<?php echo $c ?>" value="<?php echo $ch->term_id ?>" alt="<?php echo $ch->name ?>" /> <?php echo $ch->name ?>
              <?php } else { ?>
                <input <?php echo $checked ?> type="radio" name="<?php echo $c ?>" value="<?php echo $ch->term_id ?>" alt="<?php echo $ch->name ?>" /> <?php echo $ch->name ?>
              <?php } ?>                              
            </li>
          <?php } ?>
        </ul>
        
        <ul id="move" class="inline-list">
          <?php if (!($counter == 1)) { ?>
            <li id="prev">&larr;</li>
          <?php } ?>
            <li id="next">&rarr;</li>
        </ul>
      </div>
  <?php $counter += 1; } ?>
  <div id="step-budget" class="step">
    <ul>
      <?php 
        $prices = array("0-100", "100-250", "250-350", "350");
        foreach ($prices as $p) { 
          $checked = '';
          if ($profile) {
            if ($p == $profile->price) {
              $checked = "checked";
            }
          } ?>
          <li><input id="search-price" type="radio" name="price" value="<?php echo $p ?>" <?php echo $checked ?> alt="<?php echo $p ?>"/><?php echo $p ?></li>
        <?php }       ?>
    </ul>
  </div>
  <div class="clear"></div>
  
  <button type="submit" name="button" id="button" value="dosearch">Cautare cadouri</button>
</div>


