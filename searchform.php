<?php 
  $search_text = " ";
?>
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
  <input type="text" value="<?php echo $search_text; ?>" name="s" id="s"  onfocus="if (this.value == '<?php echo $search_text; ?>')  {this.value = '';}" /> 
  <?php include "search_price.php" ?>
  <input class="submit" type="submit" id="searchsubmit" value="Cautare cadouri" />  
</form>


