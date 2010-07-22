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
      Daca sunteti interesati intr-o anumita categorie de produse sau alte sectiuni de pe site puteti sa va inscieti prin RSS la ultimele noutati.
    </p>   
    <h3>Arhiva categorii</h3>
	  <ul>
		   <?php wp_list_categories("show_count=1&feed=RSS"); ?>
	  </ul>
    <h3>Arhiva etichete</h3>
	  <ul>
		   <?php wp_tag_cloud(); ?>
	  </ul>
	  <h3>Arhiva cronologica</h3>
	  <ul>
		   <?php wp_get_archives('type=monthly'); ?>
	  </ul>
  </div>
  
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>


