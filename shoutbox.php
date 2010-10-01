<?php 
  $today = getdate();
  $wday = $today['wday'];
  $hr = $today['hours'] + 3;
  $min = $today['minutes'];
  if ($wday >= 1 && $wday <= 5 && $hr >= 9 && $hr <= 16 && $min <= 59) { ?>
    
    <div id="tel">
      <center>
        <h2>0740-456127</h2>
      </center>
    </div>
    
    <div id="shoutbox">
      <h3>Suport online</h3>
      <?php if(function_exists(jal_get_shoutbox)) { jal_get_shoutbox(); } ?>
    </div>
    
    
  <?php } 
?>
