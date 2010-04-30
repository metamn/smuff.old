<?php
/*
Template Name: Advanced Search Page
*/
?>

<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>

<div id="advanced-search" class="block">

  <div id="content" class="column span-18">
    <h2>Cautare</h2>
    
    <div class="block">
      <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">         
        <div id="left" class="column span-8 append-1 last">
          <dl>
            <dt><label for="term">Expresia cautata:</label></dt>
            <dd><input type="text" value=" " name="s" id="s" /></dd>
            
            <dt><label for="price">Cautare dupa pret:</label></dt>
            <dd><?php include "search_price.php" ?></dd>
            
            <input type="hidden" name="is-search" value="1" />
            
            <dt><label for="price">Cu ce ocazie?</label></dt>
            <dd><?php echo create_radio_button_for_category(13, "ocasion")?></dd>
            
            <dt><label for="price">Pentru cine?</label></dt>
            <dd><?php echo create_radio_button_for_category(12, "person")?></dd>
            
            <dt><label for="price">Unde il folositi?</label></dt>
            <dd><?php echo create_radio_button_for_category(11, "environment")?></dd>
          
            <dt><label for="term">Categorii generale:</label></dt>
            <dd><?php echo create_check_box_for_category(10, "category[]")?></dd>
            
            <dt><label for="term">Categorii speciale:</label></dt>
            <dd><?php echo create_check_box_for_category(3, "category-specials[]")?></dd>
            
            <dt><label for="term">Cautare dupa branduri:</label></dt>
            <dd><?php echo create_check_box_for_category(4, "category-brand[]")?></dd>
            
            <dt><label for="term">Produse promotionale si poplurae</label></dt>
            <dd><?php echo create_check_box_for_category(8, "category-promo[]")?></dd>
          </dl>
        </div>
        
        <div id="right" class="column span-8 prepend-1 last">                       
          <input type="submit" id="searchsubmit" value="Cautare" />  
          
          <h2>Arhiva</h2>          
          <h3>Arhiva etichete</h3>
	        <ul>
		         <?php wp_tag_cloud(); ?>
	        </ul>
	        <h3>Arhiva cronologica</h3>
	        <ul>
		         <?php wp_get_archives('type=monthly'); ?>
	        </ul>
        </div>
      </form>      
    </div>                
  </div>  
  
  <?php get_sidebar(); ?>
  
</div>

<?php get_footer(); ?>



