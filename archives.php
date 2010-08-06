<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="archives" class="block">

  <div id="content" class="column span-18">
    <h2>Arhiva si feed-uri RSS</h2>
    <p>
      Daca sunteti interesati in permanenta intr-o anumita categorie de produse sau alte sectiuni de pe site puteti sa va inscieti prin RSS la ultimele noutati.
    </p>   
    <div id="accordion">
      <h3>Arhiva categorii</h3>
      <div class='pane'>
	      <ul>
		       <?php wp_list_categories("show_count=1&feed=RSS&title_li="); ?>
	      </ul>
      </div>
      
      <h3>Arhiva etichete</h3>
	    <div class='pane'>
	      <ul>
		       <?php wp_tag_cloud(); ?>
	      </ul>
	   </div>
	    
	    <h3>Arhiva cronologica</h3>
	    <div class='pane'>
	      <ul>
		       <?php wp_get_archives('type=monthly'); ?>
	      </ul>
	    </div>
	    
	    <h3>Pagini</h3>
	    <div class='pane'>
	      <ul>
	        <?php wp_list_pages('title_li='); ?>
	      </ul>	  
	    </div>
	    
	    <h3>Autori si colaboratori</h3>
	    <div class='pane'>
	      <ul>
	        <?php wp_list_authors('optioncount=1&exclude_admin=0&show_fullname=1&hide_empty=0&feed=RSS'); ?>
	      </ul>
	    </div>
	  </div>
  </div>
  
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>


