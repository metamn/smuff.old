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
  add_menu_page('Datafeed', 'Datafeed', 'delete_others_posts', 'datafeed-menu', 'datafeed_main_page' );
  
  add_submenu_page('datafeed-menu', 'Marcare produse', 'Marcare produse', 'delete_others_posts', 'datafeed-shops', 'shops_options');
  add_action( 'admin_init', 'register_options' );
}

// Adding DB field in Options database
function register_options() {
  //register_setting( 'datafeed', 'datafeed_shops' );
}

// Main datafeed dashboard
function datafeed_main_page() {
  if (!current_user_can('delete_others_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }
  
  echo '<div class="wrap">';
  echo '<h2>Generare datafeed</h2>';
  echo '</div>';
}

// Main function on Admin screen
function shops_options() {

  if (!current_user_can('delete_others_posts'))  {
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
  set_meta_checked($data['shopmania'], 'shopmania'); 
  set_meta_checked($data['cautiro'], 'cautiro'); 
  set_meta_checked($data['go4it'], 'go4it'); 
  set_meta_checked($data['allshops'], 'allshops'); 
  set_meta_checked($data['magazineonline'], 'magazineonline'); 
  set_meta_checked($data['goshopping'], 'goshopping');   
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
        <td>cautiro</td>
        <td>go4it</td>
        <td>allshops</td>
        <td>magazine-online</td>
        <td>goshopping</td>
        <td><input type="submit" class="button-primary" value="Run" /></td>
      </tr>  
      <?php 
        $posts = get_posts('numberposts=-1&category=10');
        if ($posts) {
          foreach ($posts as $p) {
            $shopmania = get_meta_checked($p->ID, 'shopmania');
            $cautiro = get_meta_checked($p->ID, 'cautiro');
            $go4it = get_meta_checked($p->ID, 'go4it');
            $allshops = get_meta_checked($p->ID, 'allshops');
            $magazineonline = get_meta_checked($p->ID, 'magazineonline');
            $goshopping = get_meta_checked($p->ID, 'goshopping'); ?>
            <tr>
              <td><?php echo short_name($p->post_title)?></td>
              <td><input type="text" name="shopmania[<?php echo $p->ID ?>]" id="<?php echo $p->ID ?>" value="<?php echo $shopmania ?>"/></td>
              <td><input type="text" name="cautiro[<?php echo $p->ID ?>]" id="<?php echo $p->ID ?>" value="<?php echo $cautiro ?>"/></td>
              <td><input type="text" name="go4it[<?php echo $p->ID ?>]" id="<?php echo $p->ID ?>" value="<?php echo $go4it ?>"/></td>
              <td><input type="text" name="allshops[<?php echo $p->ID ?>]" id="<?php echo $p->ID ?>" value="<?php echo $allshops ?>"/></td>
              <td><input type="text" name="magazineonline[<?php echo $p->ID ?>]" id="<?php echo $p->ID ?>" value="<?php echo $magazineonline ?>"/></td>
              <td><input type="text" name="goshopping[<?php echo $p->ID ?>]" id="<?php echo $p->ID ?>" value="<?php echo $goshopping ?>"/></td>
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
function set_meta_checked($meta, $meta_name) {
  if ($meta) {
    foreach ($meta as $key => $value) {
      if ($value == '') {
        delete_post_meta($key, $meta_name);
      } else {
        echo 'Adding '. $meta_name .' for ' . $key . '<br/>';
        update_post_meta($key, $meta_name, $value);
      }
    }
  } else {
    delete_post_meta($key, $meta_name);
  }
}

// Checks if a product is added to a shop or not using post's meta field
function get_meta_checked($id, $shopname) {
  $s = get_post_meta($id, $shopname, true);
  return $s;
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
