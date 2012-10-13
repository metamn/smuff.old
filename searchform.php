<?php 
  $search_text = " ";
?>
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
  <input type="text" placeholder="tastati aici cadoul cautat" name="s" id="s"  /> 
  <?php include "search_price.php" ?>
  <input class="submit" type="submit" id="searchsubmit" value="Cautare cadouri" />  
  <a id="advanced-search" title="Cautare avansata" href="<?php bloginfo('home'); ?>/cautare-avansata/">Cautare avansata</a>
</form>


