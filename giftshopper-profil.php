<?php
  /*
  Template Name: Giftshopper Profil
   * @package WordPress
   * @subpackage Default_Theme
   */
   
  get_header(); 
?>

<?php

  // The categories upon the gift quiz is built
  $cats = array(670, 686, 704, 726);
  // Which categories are checkboxes?
  $checkboxes = array(686, 726, 10);
?>

<?php
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);
  
  if ($params) {  
    $gshid = '';
    $split = explode("id=", $params);
    
    //print_r($split); 
    
    if ( !(empty($split)) ) {
      //echo "not empty, $split[0]";
      if ($split[1] != '') {
        //echo "id not empty:: $split[1]";
        $gshid = $split[1];
      }
    } 
  }  
?>

<div id="page" class="giftshopper share block">
  <div id="content" class="column span-24 last">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>
        
        <div class="entry block">
          <?php the_content() ?>
        </div>
        <div class="block">
          <?php if ($params) {
            echo 'params';
            if ($gshid != '') {
              echo "id: $gshid"; 
              include "giftshopper-form.php";
            } else {
              echo 'noid';
              include "giftshopper-results.php";
            }
          } else {
            echo 'noparams';
            include "giftshopper-form.php";
          } ?>
        
        </div>
      </div>
    <?php endwhile; endif; ?>
    
    <?php if (comments_open()) {comments_template();}  ?>
  </div>
</div>    


<?php get_footer(); ?>
