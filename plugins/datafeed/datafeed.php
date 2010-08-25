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

function my_plugin_menu() {
  add_menu_page('Datafeed', 'Datafeed', 'manage_options', 'datafeed-menu', 'datafeed_main_page' );
  add_submenu_page('datafeed-menu', 'GoShopping', 'GoShopping', 'manage_options', 'datafeed-goshopping', 'goshopping_options');
}



function datafeed_main_page() {
  if (!current_user_can('edit_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }
  
  echo '<h2>Datafeed</h2>';
}


function goshopping_options() {

  if (!current_user_can('edit_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  }

  echo '<div class="wrap">';
  echo '<p>Here is where the form would go if I actually had options.</p>';
  echo '</div>';

}


?>
