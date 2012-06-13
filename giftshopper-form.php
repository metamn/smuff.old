<div id="form" class="column span-17">
  <div id="nav">
    <ul class="inline-list">
      <?php 
        $counter = 1;
        foreach ($cats as $c) { ?>
          <li id="step-<?php echo $counter ?>">
            <?php echo get_the_category_by_ID($c); ?> 
            <span>></span>
          </li>
        <?php
        $counter += 1; 
      } ?>
      <li id="step-fericit">Ce il face fericit?
        <span>></span>
      </li>
      <li id="step-budget">Buget</li>
    </ul>            
  </div>
  
  <div id="steps">
    <form action="<?php echo curPageURL2() ?>" method="get">                                  
      <?php 
        $counter = 1;
        $cats[] = 10;
        foreach ($cats as $c) {
          $childrens = get_categories("child_of=" . $c); ?>
          <div id="step-<?php echo $counter ?>">
            <ul>                  
              <?php foreach ($childrens as $ch) { ?>
                <li>
                  <?php if (in_array($c, $checkboxes)) { ?>
                    <input type="checkbox" name="<?php echo $c ?>" value="<?php echo $ch->term_id ?>" /> <?php echo $ch->name ?>
                  <?php } else { ?>
                    <input type="radio" name="<?php echo $c ?>" value="<?php echo $ch->term_id ?>" /> <?php echo $ch->name ?>
                  <?php } ?>                              
                </li>
              <?php } ?>
            </ul>
          </div>
      <?php $counter += 1; } ?>
      <div id="step-budget">
        <ul>
          <li><input id="search-price" type="radio" name="price" value="0-100"/>< 100 RON</li>
          <li><input id="search-price" type="radio" name="price" value="100-250" />100 - 250 RON</li>
          <li><input id="search-price" type="radio" name="price" value="250-350" />250 - 350 RON</li>
          <li><input id="search-price" type="radio" name="price" value="350" />Banii nu conteaza!</li>
        </ul>
      </div>
    <button type='submit' name='submit'>Cautare cadouri</button>
    </form>
  </div>
  
</div>

<div id="profile" class="column span-5 prepend-1 last">
  <h3>Profil</h3>
</div>  
