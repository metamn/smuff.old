<?php
/*
Plugin Name: Gitfshopper
Plugin URI: http://www.smuff.ro
Description: Find the perfect gift
Version: 0.1
Author: cs
Author URI: http://www.smuff.ro
License: none
*/


// Admin menu
function giftshopper_admin_menu() {  
  add_menu_page('Giftshopper', 'Giftshopper', 'delete_others_posts', 'giftshopper-menu', 'giftshopper_main_page' );
  add_action( 'admin_init', 'giftshopper_tables' );
} 
add_action('admin_menu', 'giftshopper_admin_menu');


// Create database tables
function giftshopper_tables() {
  global $wpdb;
  
  // Main table
  $table = $wpdb->prefix . "giftshopper";
  $sql = "CREATE TABLE $table (
      id INT(9) NOT NULL AUTO_INCREMENT,
      email VARCHAR(80) NOT NULL,      
      name VARCHAR(80) NOT NULL,
      categories VARCHAR(1200) NOT NULL,
      price VARCHAR(80),
      products VARCHAR(1200) NOT NULL,
      UNIQUE KEY id (id)
  );";
  
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}


// Dashboard
function giftshopper_main_page() {
  if (!current_user_can('delete_others_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  } 
  ?>
  
  <div id="giftshopper">
    <h2>Giftshopper</h2>
    
    <div id="giftshoppers">
      to be done ...
    </div>
  </div>
  
  <?php
}


?>
