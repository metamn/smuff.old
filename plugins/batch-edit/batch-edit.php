<?php
/*
Plugin Name: Batch Editor for Smuff
Plugin URI: http://clair.ro
Description: Edit posts programatically
Version: 0.1
Author: cs
Author URI: http://clair.ro
License: GPL2
*/

/*  Copyright 2009 by cs  (email : cs@clair.ro)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



/* Plugin scheleton
*/

add_action('admin_menu', 'batch_edit_menu');

// Adding menus and submenus
function batch_edit_menu() {
  add_menu_page('Batch Editor', 'Batch Editor', 'manage_options', 'batch-editor-menu', 'batcheditor_main_page' );
  
  add_action( 'admin_init', 'register_batch_edit' );
}

// Adding DB field in Options database
function register_batch_edit() {
  //register_setting( 'datafeed', 'datafeed_shops' );
}

// Main function 
function batcheditor_main_page() {

  if (!current_user_can('manage_options'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }
  
  echo '<div class="wrap">';
  echo '<h2>Editare articole</h2>';
  
  if ($_POST) {
    plugin_process_form($_POST);
  } else { 
    plugin_display_form();
  }
  
  echo '</div>';
}


// Processing input
function plugin_process_form($data) {
  echo "running ...";
  $posts = get_posts('numberposts=-1&category=10');
  if ($posts) {
    foreach ($posts as $p) {
      setup_postdata($p);
      $descr = $p->post_content;
      $items = explode("<h3>Intrebari frecvente</h3>", $descr);
      // cut faq;
      $cut = explode("<h3>Opiniile cumparatorilor</h3>", $items[1]);
      // cut opinii text
      $opinions = str_replace("<em>Numai utilizatorii inregistrati pot exprima opiniile.</em>", "", $cut[1]); 
      $rest = "<h3>Opiniile cumparatorilor</h3>" . $opinions;
      // Assembly final output
      $final = $items[0] . $rest;
      
      // update post
      $update = array();
      $update['ID'] = $p->ID;
      $update['post_content'] = $final;
      wp_update_post($update);
      echo 'ok ';
    }
  }
  echo "done!";
}

// Displaying a form
function plugin_display_form() {
?>
<h3>Removing Post FAQ and "Only registered users can vote"</h3>
<form method="post" action="">    
    <input type="hidden" name="hide" value="1">    
    <input type="submit" class="button-primary" value="Run" />
</form>
<?php }





?>
