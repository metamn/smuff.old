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
    <div class="block">
      <div id="category-name">
        <h1>Cautare avansata</h1>
      </div>      
    </div>
    
    <div class="block">
      <form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">         
        <div class="column span-12">
          <dl>
            <dt><label for="term">Expresia cautata:</label></dt>
            <dd><input type="text" value=" " name="s" id="s" /></dd>
            
            <dt><label for="price">Cautare dupa pret:</label></dt>
            <dd><?php include "search_price.php" ?></dd>
            
            <input type="hidden" name="is-search" value="1" />
            
            <dt><label for="price">Cu ce ocazie?</label></dt>
            <dd><?php echo create_radio_button_for_category(16, "ocasion")?></dd>
            
            <dt><label for="price">Pentru cine?</label></dt>
            <dd><?php echo create_radio_button_for_category(15, "person")?></dd>
            
            <dt><label for="price">Unde il folositi?</label></dt>
            <dd><?php echo create_radio_button_for_category(14, "environment")?></dd>
          <dl/>
        </div>
        <div class="column span-12 last">
          <dl>
            <dt><label for="term">Categorii generale:</label></dt>
            <dd><?php echo create_check_box_for_category(47, "category[]")?></dd>
            
            <dt><label for="term">Categorii speciale:</label></dt>
            <dd><?php echo create_check_box_for_category(11, "category-specials[]")?></dd>
            
            <dt><label for="term">Cautare dupa branduri:</label></dt>
            <dd><?php echo create_check_box_for_category(2, "category-brand[]")?></dd>
            
            <dt><label for="term">Produse promotionale si poplurae</label></dt>
            <dd><?php echo create_check_box_for_category(48, "category-promo[]")?></dd>
          </dl>
        </div>                       
        <input type="submit" id="searchsubmit" value="Cautare" />            
      </form>
    </div>                
  </div>  
  
  <?php get_sidebar(); ?>
  
</div>

<?php get_footer(); ?>



