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
      profile_id VARCHAR(20) NOT NULL,
      UNIQUE KEY id (id)
  );";
  
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
  
  // Profiles
  $table = $wpdb->prefix . "profiles";
  $sql = "CREATE TABLE $table (
      id INT(9) NOT NULL AUTO_INCREMENT,
      name VARCHAR(80) NOT NULL,
      cine_id VARCHAR(20),
      personalitate_id VARCHAR(20),
      ocazie_id VARCHAR(20),
      folosi_id VARCHAR(20),
      fericit_id VARCHAR(20),
      budget_start INT(9),
      budget_end INT(9),
      product_id VARCHAR(20),
      UNIQUE KEY id (id)
  );";
  
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
      <?php 
        global $wpdb;
        
        $results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix . "giftshopper");
        if ($results) {
          foreach($results as $result) { ?>
            <div id="item">
              <ul>
                <li>User: <?php echo $result->email ?></li>
                <li>Numar profile:</li> 
              </ul>
            </div>
          <?php }
        } else {
          echo "<p>Nu avem inca giftshopperi ...</p>";
        }
      ?>
    </div>
  </div>
  
  <?php
}


?>
