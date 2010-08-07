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
            <dt><label for="term">Expresia cautata: (optional)</label></dt>
            <dd><input type="text" value=" " name="s" id="s" /></dd>
            
            <dt><label for="price">Cautare dupa pret:</label></dt>
            <dd><?php include "search_price.php" ?></dd>
            
            <input type="hidden" name="is-search" value="1" />
            
            <?php 
              $cats = array(670, 686, 704, 726);
              foreach ($cats as $cat) { 
                $c = get_category($cat);
                ?>
                <dt><label for="price"><?php echo $c->name ?></label></dt>
                <dd><?php echo create_check_box_for_category($c->cat_ID, $cat->slug) ?></dd>   
            <?php } ?>
                                  
            <dt><label for="term">Produse promotionale si populare</label></dt>
            <dd><?php echo create_check_box_for_category(8, "category-promo[]")?></dd>
          </dl>
          <input type="submit" id="searchsubmit" value="Cautare" />
        </div>
        
        <div id="right" class="column span-8 prepend-1 last">                       
          <input type="submit" id="searchsubmit" value="Cautare" />            
        </div>
      </form>      
    </div>                
  </div>  
  
  <?php get_sidebar(); ?>
  
</div>

<?php get_footer(); ?>



