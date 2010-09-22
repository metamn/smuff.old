<?php
/*
Plugin Name: Datafeed for Smuff
Plugin URI: http://clair.ro
Description: Datafeed to an online shop aggregator
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

add_action('admin_menu', 'my_plugin_menu');

// Adding menus and submenus
function my_plugin_menu() {
  add_menu_page('Datafeed', 'Datafeed', 'manage_options', 'datafeed-menu', 'datafeed_main_page' );
  
  add_submenu_page('datafeed-menu', 'Marcare produse', 'Marcare produse', 'manage_options', 'datafeed-shops', 'shops_options');
  add_action( 'admin_init', 'register_options' );
}

// Adding DB field in Options database
function register_options() {
  //register_setting( 'datafeed', 'datafeed_shops' );
}

// Main datafeed dashboard
function datafeed_main_page() {
  if (!current_user_can('edit_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }
  
  echo '<div class="wrap">';
  echo '<h2>Generare datafeed</h2>';
  echo '</div>';
}

// Main function on Admin screen
function shops_options() {

  if (!current_user_can('edit_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }
  
  echo '<div class="wrap">';
  echo '<h2>Marcare produse pentru Datafeed</h2>';
  
  if ($_POST) {
    datafeed_process_form($_POST);
  } else { 
    datafeed_display_form();
  }
  
  echo '</div>';
}




// Plugin body
//-------------



// Precessing input
function datafeed_process_form($data) {
  $shopmania = $data['shopmania'];  
  $bizoo = $data['bizoo']; 
  $go4it = $data['go4it']; 
  $youmago = $data['youmago']; 
  $magazineonline = $data['magazineonline']; 
  $goshopping = $data['goshopping'];  
  
  $posts = get_posts('numberposts=-1&category=10');
  if ($posts) {
    foreach ($posts as $p) {
      set_meta_checked($p->ID, $p->post_title, $shopmania, 'shopmania');
      set_meta_checked($p->ID, $p->post_title, $bizoo, 'bizoo');
      set_meta_checked($p->ID, $p->post_title, $go4it, 'go4it');
      set_meta_checked($p->ID, $p->post_title, $youmago, 'youmago');
      set_meta_checked($p->ID, $p->post_title, $magazineonline, 'magazineonline');
      set_meta_checked($p->ID, $p->post_title, $goshopping, 'goshopping');
      echo '<br/>';          
    }
  }  
}

// Displaying a form
function datafeed_display_form() {
?>
<form method="post" action="">    
    <input type="hidden" name="hide" value="1">
    <table>
      <tr>
        <td>Produs Smuff</td>
        <td>shopmania</td>
        <td>bizoo</td>
        <td>go4it</td>
        <td>youmago</td>
        <td>magazine-online</td>
        <td>goshopping</td>
        <td><input type="submit" class="button-primary" value="Run" /></td>
      </tr>  
      <?php 
        $posts = get_posts('numberposts=-1&category=10');
        if ($posts) {
          foreach ($posts as $p) {
            $shopmania = get_meta_checked($p->ID, 'shopmania');
            $bizoo = get_meta_checked($p->ID, 'bizoo');
            $go4it = get_meta_checked($p->ID, 'go4it');
            $youmago = get_meta_checked($p->ID, 'youmago');
            $magazineonline = get_meta_checked($p->ID, 'magazineonline');
            $goshopping = get_meta_checked($p->ID, 'goshopping'); ?>
            <tr>
              <td><?php echo short_name($p->post_title)?></td>
              <td><input type="checkbox" name="shopmania[]" value="<?php echo $p->ID ?>" <?php echo $shopmania ?>/></td>
              <td><input type="checkbox" name="bizoo[]" value="<?php echo $p->ID ?>" <?php echo $bizoo ?>/></td>
              <td><input type="checkbox" name="go4it[]" value="<?php echo $p->ID ?>" <?php echo $go4it ?>/></td>
              <td><input type="checkbox" name="youmago[]" value="<?php echo $p->ID ?>" <?php echo $youmago ?>/></td>
              <td><input type="checkbox" name="magazineonline[]" value="<?php echo $p->ID ?>" <?php echo $magazineonline ?>/></td>
              <td><input type="checkbox" name="goshopping[]" value="<?php echo $p->ID ?>" <?php echo $goshopping ?>/></td>
            </tr>            
          <?php }
        }
      ?>
      <tr><td><input type="submit" class="button-primary" value="Run" /></td></tr>
    </table>   
</form>
<?php }




// Helper functions
// ----------------


// Updates a posts' meta field
// - $id = post id
// - $title = post title, for the output message
// - $meta = the array containing the checkboxes
// - $meta_name = 'shopmania' or 'go4it'
function set_meta_checked($id, $title, $meta, $meta_name) {
  if ($meta) {
    if (in_array($id, $meta)) {
      echo 'Adding '. $meta_name .' for ' . $title . '<br/>';
      add_post_meta($id, $meta_name, 1);
    } else {        
      delete_post_meta($id, $meta_name);
    }
  } else {
    delete_post_meta($id, $meta_name);
  }  
}

// Checks if a product is added to a shop or not using post's meta field
function get_meta_checked($id, $shopname) {
  $s = get_post_meta($id, $shopname, true);
  if (!($s == '')) {
    return 'checked';
  } else {
    return '';
  }
}


// Shorten product name
function short_name($name) {
  $s = explode(' -- ', $name);
  if (!$s[1]) {
    $s = explode(' — ', $name);
  }
  if (!$s[1]) {
    $s = explode(' – ', $name);
  }
  return $s[0];
}

?>
