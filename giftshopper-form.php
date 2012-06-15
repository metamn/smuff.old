<?php
  // The categories upon the gift quiz is built
  $steps = array(670, 686, 704, 726);
  // Which categories are checkboxes?
  $checkboxes = array(686, 726, 10);
?>
<div id="form" class="column span-17">
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
      $cats[] = 10;
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
              <input id="name" name="nume" type="text" value="" placeholder="Numele persoanei pentru care construiti cadoul perfect"/>
            </div>
          <?php } ?>
          
          <ul>                  
            <?php foreach ($childrens as $ch) { ?>
              <li>
                <?php if (in_array($c, $checkboxes)) { ?>
                  <input type="checkbox" name="<?php echo $c ?>" value="<?php echo $ch->term_id ?>" alt="<?php echo $ch->name ?>" /> <?php echo $ch->name ?>
                <?php } else { ?>
                  <input type="radio" name="<?php echo $c ?>" value="<?php echo $ch->term_id ?>" alt="<?php echo $ch->name ?>" /> <?php echo $ch->name ?>
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
        <li><input id="search-price" type="radio" name="price" value="0-100" alt="< 100 RON"/>< 100 RON</li>
        <li><input id="search-price" type="radio" name="price" value="100-250" alt="100 - 250 RON" />100 - 250 RON</li>
        <li><input id="search-price" type="radio" name="price" value="250-350" alt="250 - 350 RON" />250 - 350 RON</li>
        <li><input id="search-price" type="radio" name="price" value="350" alt="Banii nu conteaza!" />Banii nu conteaza!</li>
      </ul>
    </div>
    <div class="clear"></div>
    
    <button type="submit" name="button" id="button" value="dosearch">Cautare cadouri</button>
  </div>
  
</div>

<div id="profile" class="column span-5 prepend-1 last">
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
</div>  
