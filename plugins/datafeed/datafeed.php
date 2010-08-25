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



/* Admin
*/

add_action('admin_menu', 'my_plugin_menu');

// Adding menus and submenus
function my_plugin_menu() {
  add_menu_page('Datafeed', 'Datafeed', 'manage_options', 'datafeed-menu', 'datafeed_main_page' );
  
  add_submenu_page('datafeed-menu', 'GoShopping', 'GoShopping', 'manage_options', 'datafeed-goshopping', 'goshopping_options');
  add_action( 'admin_init', 'register_options' );
}

// Adding DB field in Options database
function register_options() {
  register_setting( 'datafeed', 'goshopping' );
}


// Main datafeed dashboard
function datafeed_main_page() {
  if (!current_user_can('edit_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }
  
  echo '<div class="wrap">';
  echo '<h2>Datafeed</h2>';
  echo '</div>';
}


/* Goshopping
*/

// Main function on Admin screen
function goshopping_options() {

  if (!current_user_can('edit_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }
  
  echo '<div class="wrap">';
  echo '<h2>GoShopping</h2>';
  
  if ($_POST) {
    goshopping_process_form($_POST);
  } else { 
    goshopping_display_form();
  }
  
  echo '</div>';
}


// Precessing input
function goshopping_process_form($data) {
  echo 'processing ... ';
  echo $data['goshopping'];
}

// Displaying a form
function goshopping_display_form() {
?>
<form method="post" action="">
    <?php settings_fields( 'datafeed' ); ?>
    <input type="hidden" name="goshopping-processing" value="1">
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Articole</th>
        <td><input type="text" name="goshopping" value="<?php echo get_option('goshopping'); ?>" /></td>
        </tr>
    </table>
    
    <p class="submit">
      <input type="submit" class="button-primary" value="Run" />
    </p>
</form>
<?php }

?>
