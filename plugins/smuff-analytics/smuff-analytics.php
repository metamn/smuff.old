<?php
/*
Plugin Name: Smuff Analytics
Plugin URI: http://www.smuff.ro
Description: Various statistics about the store performance
Version: 0.1
Author: cs
Author URI: http://www.smuff.ro
License: none
*/


// Admin menu
function smuff_analytics_admin_menu() {  
  add_menu_page('Dashboard', 'Analytics', 'delete_others_posts', 'smuff_analytics-menu', 'smuff_analytics_main_page' );
  add_submenu_page("smuff_analytics-menu", "Overview", "Overview", 'delete_others_posts', "smuff_analytics-menu", "smuff_analytics_main_page");
  add_submenu_page("smuff_analytics-menu", "Bestsellers", "Bestsellers", 'delete_others_posts', "smuff_analytics-bestsellers", "smuff_analytics_bestsellers_page");  
} 
add_action('admin_menu', 'smuff_analytics_admin_menu');



// Bestsellers

function smuff_analytics_bestsellers_page() {
  if (!current_user_can('delete_others_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  } ?> 
    
  <div id="bestsellers">
    <h1>Bestsellers</h1>   
    
    <form action="admin.php?page=smuff_analytics-bestsellers" method="post">
    	<select id="bestsellers" name="bestsellers">
        <option value="week">Last week</option>
        <option value="month">Last month</option>
        <option value="season">Last 3 months</option>
      </select>
      <p class="submit"><input type="submit" value="Generate" class="button-primary" id="submit" name="submit"></p>
    </form>
    <p class="notice">It takes a while, please be patient ...</p>
    
  
    <?php if ($_POST) {
    	echo "<h2>Rezultate</h2>";
    
    	global $wpdb;
    	
			$end = strtotime('now');
			
			$new_categories = array();
			$t = get_term_by('slug', 'produse-populare', 'category');
			$new_categories[] = $t->term_id;

			switch ($_POST['bestsellers']) {
				case 'week':
					$start = strtotime('-1 week');
					$t = get_term_by('slug', 'cele-mai-vandute-saptamana-trecuta', 'category');
					break;
				case 'month':
					$start = strtotime('-1 month');
					$t = get_term_by('slug', 'cele-mai-vandute-luna-trecuta', 'category');
					break;
				case 'season':
					$start = strtotime('-3 months');
					$t = get_term_by('slug', 'cele-mai-vandute-in-ultimele-trei-luni', 'category');
					break;
			}
			$new_categories[] = $t->term_id;
			
		
			$results = db_get_bestsellers($start, $end); 
			if ($results) {
				// Remove old posts from this new category
				$args = array();
				$args['category__and'] = $new_categories;
				$args['posts_per_page'] = -1;
				
				$removes = get_posts($args);
				foreach ($removes as $post) {
					$categories = wp_get_post_categories($post->ID);
					wp_set_post_categories($post->ID, array_diff($categories, $new_categories));
					echo '<br/>Removing ' . $post->post_title . '<br/>';
				}
				
				// Add new posts to this new category
				foreach ($results as $r) {
					$post = get_post($r->id);
					
					$categories = wp_get_post_categories($post->ID);
					wp_set_post_categories($post->ID, array_merge($categories, $new_categories));
					
					echo '<br/>Adding ' . $post->post_title . '<br/>';
				}
			}
			
			
    } ?>
  </div>
<?php   
}

function db_get_bestsellers($start, $end) {
	global $wpdb;
	
	$sql = $wpdb->prepare( 
				'
				SELECT id FROM wp_cp53mf_posts
				JOIN wp_cp53mf_postmeta ON wp_cp53mf_postmeta.post_id = wp_cp53mf_posts.ID
				WHERE wp_cp53mf_postmeta.meta_key = "product_id"
				AND wp_cp53mf_postmeta.meta_value IN ( ' .
					'
					SELECT prodid FROM wp_cp53mf_wpsc_cart_contents
					WHERE purchaseid IN ( ' . 
						'
						SELECT id FROM wp_cp53mf_wpsc_purchase_logs
						WHERE date BETWEEN %s AND %s ' .
					' ) ' . 
				' ) ',
			$start, $end);

	return $wpdb->get_results($sql);
}




register_activation_hook(__FILE__,'smuff_analytics_tables');

// Create database tables
function smuff_analytics_tables() {
  /*
  global $wpdb;
  
  // Main table
  $table = $wpdb->prefix . "smuff_analytics";
  $sql = "CREATE TABLE $table (
      id INT(9) NOT NULL AUTO_INCREMENT,
      email VARCHAR(80) NOT NULL,      
      name VARCHAR(80) NOT NULL,
      categories VARCHAR(1200) NOT NULL,
      price VARCHAR(80),
      products VARCHAR(1200) NOT NULL,
      PRIMARY KEY(id),
      UNIQUE KEY name_email (email, name)
  );";
  
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
  */
}


// Dashboard
function smuff_analytics_main_page() {
  if (!current_user_can('delete_others_posts'))  {
    wp_die( 'Nu aveti drepturi suficiente de acces.' );
  } 
  ?>
  
  <div id="smuff_analytics">
    <h2>Smuff Analytics</h2>
    
    <div id="smuff_analyticss">
      to be done ...
    </div>
  </div>
  
  <?php
}


?>
