<?php 
  $search_text = " ";
?>
<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
  <span class="ui-icon ui-icon-search"/></span><label>Cautare rapida</label>
  <br/>
  <input type="text" value="<?php echo $search_text; ?>" name="s" id="s"  onblur="if (this.value == '')  {this.value = '<?php echo $search_text; ?>';}"  onfocus="if (this.value == '<?php echo $search_text; ?>')  {this.value = '';}" /> 
  <?php include "search_price.php" ?>
  <input class="submit" type="submit" id="searchsubmit" value="Cautare dupa pret" />  
</form>


