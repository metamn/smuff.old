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
  add_menu_page('Selectare atafeed', 'Datafeed', 'delete_others_posts', 'datafeed-menu', 'datafeed_main_page' );
  
  add_submenu_page('datafeed-menu', 'Marcare produse', 'Marcare produse', 'delete_others_posts', 'datafeed-shops', 'shops_options');
  add_action( 'admin_init', 'register_options' );
}

// Adding DB field in Options database
function register_options() {
  //register_setting( 'datafeed', 'datafeed_shops' );
}



// Main datafeed dashboard
// - user selects which datafeeds to edit
function datafeed_main_page() {
  if (!current_user_can('delete_others_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  } 
  
  if ($_POST) {
    datafeed_process_forms($_POST);
  } else { 
    datafeed_display_select_form();
  }
}


// Main datafeed dashboard
// - processing feed selection and feed edit
// - the only function handling all forms
function datafeed_process_forms($data) {
  if ($data['datafeed']) {
    $params = $data['datafeed'];
    $items = array();
    $count = 0;
    foreach ($params as $p) {
      $items[] = $p;
      $count += 1;    
      if ($count == 3) { break; }
    }
    
    datafeed_display_form($items);
  } else {
    datafeed_process_form($data);
  }  
}

// Main datafeed dashboard
// - displaying feed selection
function datafeed_display_select_form() { 
  $datafeeds = array('shopmania', 'cautiro', 'cumparaturi', 'allshops', 'magazineonline', 'goshopping', 'cadouri-cadou'); ?>
  <div class="wrap">
    <h2>Selectare datafeed</h2>
    <p>Selectati <strong>maxim 3</strong> datafeeduri pentru editare.</p>
    <form method="post" action="">
      <ul>
        <?php foreach ($datafeeds as $df) { ?>
          <li><input type="checkbox" name="datafeed[]" value="<?php echo $df ?>" /><?php echo $df ?></li>
        <?php } ?>
      </ul>
      <input type="submit" class="button-primary" value="Selectare" />    
    </form>  
  </div>
<?php 
}




// Datafeed editor
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


// Datafeed editor
// - processing a datafeed edit form
function datafeed_process_form($data) {
  $datafeeds = array('shopmania', 'cautiro', 'cumparaturi', 'allshops', 'magazineonline', 'goshopping', 'cadouri-cadou');
  foreach ($datafeeds as $df) {
    if ($data[$df]) {
      set_meta_checked($data[$df], $df);  
    }
  }  
}

// Datafeed editor
// - displaying a datafeed edit form
function datafeed_display_form($items = null) {

  if (!($items)) {
    wp_die('In primul pas selectati datafeedurile ce vor fi editate');    
  }
  
?>
<form method="post" action="">    
    <input type="hidden" name="hide" value="1">
    <table>
      <tr>
        <td>Produs Smuff</td>
        <?php foreach ($items as $i) { 
          echo "<td>$i</td>";
        } ?>
        <td><input type="submit" class="button-primary" value="Run" /></td>
      </tr>  
      <?php 
        $posts = get_posts('numberposts=-1&category=10');
        if ($posts) {
          $counter = array();
          foreach ($posts as $p) {
            $values = array();            
            foreach ($items as $i) {
              $meta = get_meta_checked($p->ID, $i);
              $values[] = $meta;
              if ($meta) {
                $counter[$i] += 1;
              }
            }          
            ?>                      
            <tr>
              <td><?php echo short_name($p->post_title)?></td>              
              <?php 
                $index = 0;
                foreach ($items as $i) { ?>
                  <td><input type="text" name="<?php echo $i ?>[<?php echo $p->ID ?>]" id="<?php echo $p->ID ?>" value="<?php echo $values[$index] ?>"/></td>
                <?php 
                  $index += 1;
                } ?>              
            </tr>            
          <?php } ?>
          <tr>
            <td>Items</td>
            <?php foreach ($items as $i) { 
              echo "<td>$counter[$i]</td>";
            } ?>
          </tr>
        <?php }
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
// - $meta_name = 'shopmania' or 'cumparaturi'
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
