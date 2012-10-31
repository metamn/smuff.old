<?php


// Logging
// -------------------------------------------------------------------------------------------------

global $wplogger;
//$wplogger->log('message'.$value);




// Generate Bestsellers
// -------------------------------------------------------------------------------------------------

// This query is veru very slow ....

function generate_bestsellers() {
	global $wpdb;
	
	$start = strtotime('-3 months');
	$end = strtotime('now');
	
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
		
	$results = $wpdb->get_results($sql);
	
	foreach ($results as $r) {
		$post = get_post($r->id);
		echo $post->post_title . '<br/>';
	}
}


// wp_schedule_event(time(), 'daily', 'generate_bestsellers');
function generate_bestsellers2() {
	
	$args = array();
	$args['post_per_page'] = '-1';
	$args['meta_key'] = 'product_id'; // for getting the product ids
	add_filter('posts_where', 'bestseller_search'); // see in functions.php
	
	$results = new WP_Query($args);
	remove_filter( 'posts_where', 'bestseller_search' );
	
	/*
  if ($results) {
			while ($results->have_posts()) : $results->the_post(); update_post_caches($posts);
				echo $post->ID . ' -- ' . $post->post_title . '<br/>';
			endwhile;
		}
	*/
	
	print_r($results);
	echo '<br/>';
	
	foreach ($results as $r) {
		echo $r->post_title;
		echo '<br/>';
	}
}

function bestseller_search($where) {
	global $wpdb;
	
	$start = strtotime('-1 months');
	$end = strtotime('now');
	
	$where .= $wpdb->prepare( ' AND ' . $wpdb->postmeta . '.meta_value '.
  	'IN ( '.
			' SELECT prodid FROM wp_cp53mf_wpsc_cart_contents
				WHERE purchaseid IN ( ' . 
					'SELECT id FROM wp_cp53mf_wpsc_purchase_logs
					WHERE date BETWEEN %s AND %s ' .
				' ) ' . 
			' ) ',
		$start, $end); 
	
	return $where;
}



// Custom search
// -------------------------------------------------------------------------------------------------


// Search for price and delivery
function custom_search($where) {
	global $wpdb;
	global $price;
	global $delivery;
	
	// Parse price
	$price_lower = '-1';
	$price_higher = '1000000';
	foreach ($price as $p) {
		$split = explode('-', $p);
		if ($price_lower == '-1') {
			$price_lower = $split[0];
		}
		$price_higher = $split[1];
	}
	
	// echo "price: $price_lower - $price_higher";
	
	// Parse delivery
	$delivery_query = '';
	foreach ($delivery as $d) {
		$delivery_query .= 'AND ( ';
		switch ($d) {
			case '1':
				$delivery_query .= ' wp_cp53mf_wpsc_productmeta.meta_value = "1" ';
				break;
			case '2':
				$delivery_query .= ' wp_cp53mf_wpsc_productmeta.meta_value = "2" ';
				break;
			case 'not-set':
				$delivery_query .= ' wp_cp53mf_wpsc_productmeta.meta_value = "" OR wp_cp53mf_wpsc_productmeta.meta_value = "100" ';
				break;
		}
		$delivery_query .= ' OR ';
	}
	if ($delivery_query != '') {
		$delivery_query = rtrim($delivery_query, ' OR ');
		$delivery_query .= ' ) ';
	}
	
	// The Query
	$where .= $wpdb->prepare( ' AND ' . $wpdb->postmeta . '.meta_value '.
        'IN ( '.
            'SELECT wp_cp53mf_wpsc_product_list.id '.
            'FROM wp_cp53mf_wpsc_product_list '.
            'WHERE wp_cp53mf_wpsc_product_list.price BETWEEN %s and %s '.
            'AND wp_cp53mf_wpsc_product_list.id ' .
            	'IN ( ' .
            		'SELECT wp_cp53mf_wpsc_productmeta.product_id '.
								'FROM wp_cp53mf_wpsc_productmeta '.
								'WHERE wp_cp53mf_wpsc_productmeta.product_id = wp_cp53mf_wpsc_product_list.id '.
								'AND wp_cp53mf_wpsc_productmeta.meta_key = "sku" ' .
								$delivery_query . 
            	' ) ' .
        ' ) ', $price_lower, $price_higher);

	// echo $where;
	
  return $where;
}


// Search SQL filter for matching against post title and excerpt only.
function search_by_title_and_excerpt( $search, &$wp_query )
{
    global $wpdb;

    if ( empty( $search ) )
        return $search; // skip processing - no search term in query

    $q = $wp_query->query_vars;    
    $n = ! empty( $q['exact'] ) ? '' : '%';

    $search =
    $searchand = '';

    foreach ( (array) $q['search_terms'] as $term ) {
        $term = esc_sql( like_escape( $term ) );
        $search .= "{$searchand}($wpdb->posts.post_title LIKE '{$n}{$term}{$n}' OR $wpdb->posts.post_excerpt LIKE '{$n}{$term}{$n}')";
        $searchand = ' AND ';
    }

    if ( ! empty( $search ) ) {
        $search = " AND ({$search}) ";
        if ( ! is_user_logged_in() )
            $search .= " AND ($wpdb->posts.post_password = '') ";
    }

    return $search;
}
add_filter( 'posts_search', 'search_by_title_and_excerpt', 500, 2 );





// Subscribe to Mailchimp / Newsletter
// -------------------------------------------------------------------------------------------------


// Subscribe by email, but not via Mailchimp, instead manually will be added to a list
function subscribe_email() {
  $nonce = $_POST['nonce'];  
  if ( wp_verify_nonce( $nonce, 'mailchimp_subscribe' ) ) {
    
    $email = strval( $_POST['email'] );
    $param = strval( $_POST['param'] );
    
    $msg = '';
    
    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
      $msg .= 'Adresa Dvs. de email nu este valid';
    } 
    
    if ($msg == '') {
      $headers = "From: Smuff <shop@smuff.ro>";
      $subject = "New email address";
      $message = "A new email address to add to Mailchimp, \n\r\n\r";
      $message .= "Email: " . $email . "\n\r";
      $message .= "Info: " . $param;
      
      $to = 'shop@smuff.ro';
      
      if (wp_mail($to, $subject, $message, $headers)) {
        $msg = "Adresa Dvs. de email a fost inregistrata";
      } else {
        $msg = "Nu am reusit sa inregistram adresa Dvs. de email. \n\rVa cerem scuze, va rugam incercati mai tarziu.";
      }
    }
   
    $ret = array(
      'success' => true,
      'message' => $msg
    );  
  
  } else {
    $ret = array(
      'success' => false,
      'message' => 'Eroare de sistem. Va cerem scuze, analizam problema.'
    );
  }
    
  $response = json_encode($ret);
  header( "Content-Type: application/json" );
  echo $response;
  exit;
}
add_action('wp_ajax_subscribe_email', 'subscribe_email');
add_action( 'wp_ajax_nopriv_subscribe_email', 'subscribe_email' );



// Subscribe via mailchimp
function mailchimp_subscribe() {
  $nonce = $_POST['nonce'];  
  if ( wp_verify_nonce( $nonce, 'mailchimp_subscribe' ) ) {
  
    $email = strval( $_POST['email'] );
    if (!is_email($email)) {
      $ret = array(
        'success' => false,
        'message' => 'Adresa de email nu este valida.'
      );      
    } else {	
			
			// Set up Mailchimp
			require_once('MCAPI.class.php');
			$api = new MCAPI('bd5532985c6eeb4e315fcd8ad323d2fe-us5');
			$merge_vars = Array( 
					'EMAIL' => $email
			);
			$list_id = "4622c90106";
			
			if ($api->listSubscribe($list_id, $email, $merge_vars) === true) {
					// It worked!   
					$msg = 'Succes! Un email de confirmare de inscriere la newsletter a fost trimis la adresa ' . $email;
			} else {
					// An error ocurred, return error message   
					$msg = 'Eroare inscriere la newsletter. ' . $api->errorMessage;
			}
      
      $ret = array(
        'success' => true,
        'message' => $msg
      );  
    }  
  } else {
    $ret = array(
      'success' => false,
      'message' => 'Nonce error'
    );
  }
    
  $response = json_encode($ret);
  header( "Content-Type: application/json" );
  echo $response;
  exit;
}
add_action('wp_ajax_mailchimp_subscribe', 'mailchimp_subscribe');
add_action( 'wp_ajax_nopriv_mailchimp_subscribe', 'mailchimp_subscribe' );


// Invite a friend
function invite_friend() {
  $nonce = $_POST['nonce'];  
  if ( wp_verify_nonce( $nonce, 'invite-friend' ) ) {
    
    $email = strval( $_POST['email'] );
    $friend_email = strval( $_POST['friend-email'] );
    
    $name = strval( $_POST['name'] );
    if (!(isset($name))) $name = '';
    
    $friend_name = strval( $_POST['friend-name'] );
    if (!(isset($friend_name))) $friend_name = '';
    
    $invite_product_title = strval( $_POST['gow'] );
    if (!(isset($invite_product_title))) {
      $product_title = '';
    } else {
      $product_title = ' pentru ' . $invite_product_title;
    }  
    
    $invite_product_link = strval( $_POST['gow-link'] );
    if (!(isset($invite_product_link))) {
      $product_link = '';
    } else {
      $product_link = ': ' . $invite_product_link;
    } 
          
    
    $msg = '';
    
    if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
      $msg .= 'Adresa Dvs. de email nu este valid';
    } 
    if (!(filter_var($friend_email, FILTER_VALIDATE_EMAIL))) {
      $msg .= "\n\r" . 'Adresa de email al prietenului Dvs. nu este valid';
    }
    
    if ($msg == '') {
      $headers = "From: Smuff <shop@smuff.ro>";
      $subject = "Invitatie de inscriere la newsletter-ul Smuff";
      $message = "Salut $friend_name, \n\r\n\r";
      $message .= "Speram ca totul este ok la tine, si lucrurile iti merg bine. \n\r\n\r";
      $message .= "Prietenul tau $name te-a invitat sa te inscrii la newsletterul magazinului online de gadgeturi si cadouri Smuff (www.smuff.ro). \n\r";
      $message .= "Astfel vei primi toate noutatile si promotiile ce apar, dar acum daca te inscrii la invitatia lui $name, amandoi intrati la concursul saptamanii $product_title $product_link. \n\r\n\r";
      $message .= "Confirma aici, cu un singur click: http://eepurl.com/mjWSL \n\r\n\r";
      $message .= " + avem si alte chestii mega misto! PISICUTE MOR CAND DAI CADOURI URATE, dar Smuff te scapa de la acest gand! Hai sa vezi ce avem, vei gasi Ocelari viruali, Tricouri electronice, Sabii laser Star Wars, Masina de bere si multe multe alte gadgeturi interesante. \n\r\n\r";
      $message .= " + + daca cumperi orice de la noi, intri si la Marele Concurs Smuff pentru un FATBOY ORIGINAL! \n\r";
      $message .= "Iti multumim ca ai devenit gizmonaut!  \n\r";
      $message .= "$name prin http://www.smuff.ro \n\r";
      
      $to = $friend_email . ', shop@smuff.ro';
      
      if (wp_mail($to, $subject, $message, $headers)) {
        $msg = "Invitatia Dvs. a fost trimis cu succes.";
      } else {
        $msg = "Nu am reusit sa trimitem invitatia Dvs. \n\rVa cerem scuze, va rugam incercati mai tarziu.";
      }
    }
   
    $ret = array(
      'success' => true,
      'message' => $msg
    );  
  
  } else {
    $ret = array(
      'success' => false,
      'message' => 'Eroare de sistem. Va cerem scuze, analizam problema.'
    );
  }
    
  $response = json_encode($ret);
  header( "Content-Type: application/json" );
  echo $response;
  exit;
}
add_action('wp_ajax_invite_friend', 'invite_friend');
add_action( 'wp_ajax_nopriv_invite_friend', 'invite_friend' );




// Giftshopper
// -------------------------------------------------------------------------------------------------

// Add a new list to the DB
// - $cats, $products are arrays
function gsh_save($email, $nume, $cats, $price, $products) {  
  if ( ($email == '') || ($nume == '') || ($cats == '') || ($products == '') ) {
    return false;
  } else {
  
    global $wpdb;
    $wpdb->show_errors();
      
    // Save profile  
    /*
    $wpdb->insert(
      $wpdb->prefix . 'giftshopper',
      array(
        'email' => $email,
        'name' => $nume,
        'categories' => $cats,
        'price' => $price,
        'products' => $products 
      )
    );  
    
    //$wpdb->print_error();
    return $wpdb->insert_id;  
    */
    
    return $wpdb->query( 
      $wpdb->prepare( 
	    "
		    INSERT INTO wp_cp53mf_giftshopper
		    (email, name, categories, price, products)
		    VALUES (%s, %s, %s, %s, %s) ON DUPLICATE KEY UPDATE categories=VALUES(categories), price=VALUES(price), products=VALUES(products)
	    ", array($email, $nume, $cats, $price, $products)
	    )
	  );
  }
}


// Get lists of a user
function gsh_get_lists($email) {
  if ($email == '') {
    return false;
  } else {
    global $wpdb;    
    return $wpdb->get_results( 
	    "SELECT * FROM `wp_cp53mf_giftshopper` WHERE `email`='" . $email ."'"
    );
  }
}

// Get a list of a user
function gsh_get_list($email, $nume) {
  if ( ($email == '') && ($nume == '') ) {
    return false;
  } else {
    global $wpdb;    
    return $wpdb->get_results( 
	    "SELECT * FROM `wp_cp53mf_giftshopper` WHERE `email`='" . $email ."' AND `name`='" . $nume ."'"
    );
  }
}



// System & WP
// -------------------------------------------------------------------------------------------------


// Set cookies
// - cannot be done in the template only here 
function set_cookie($cookie, $value, $expire, $root) {
  setcookie($cookie, $value, $expire, $root);
}
function get_cookie($cookie) {
  return $_COOKIE[$cookie];
}


// Email obfuscator 
function obfuscate($email, $display_text) { 
  $length = strlen($email);
  $ret = '';
  for ($i = 0; $i < $length; $i++)
    $ret .= "&#" . ord($email[$i]);  // creates ASCII HTML entity
  echo '<a href="mailto:' . $ret . '">'.$display_text.'</a>';
}


// Getting current URL
// - used by shopping cart 
// - replaced by a simple call to the checkout page
function curPageURL2() {
  $pageURL = bloginfo('home') . $_SERVER["REQUEST_URI"];
  return $pageURL;
}

function curPageURL() {
  $pageURL = bloginfo('home') . '/comenzi/cos-cumparaturi';
  return $pageURL;
}

// Adding sidebars to hold various widgets
if ( function_exists('register_sidebars') )
  register_sidebars(2);




// Getting comment number for a post
function get_comment_number($id) {
  if ($id) {
    global $wpdb;
    $comms = $wpdb->get_var("SELECT count(*) FROM `wp_cp53mf_comments` WHERE `comment_post_ID`=".$id);
    return $comms;
  } 
}





// WP Extensions
// -------------------------------------------------------------------------------------------------


// The product ids during the transaction are saved into wpsc_purchase_logs
// The session id identifies the current transaction
// This function returns an array of products ids just transacted
function get_transaction_products($sessionid) {
  if ($sessionid) {
    global $wpdb;
    $billing_country = $wpdb->get_var("SELECT `billing_country` FROM `".$wpdb->prefix."wpsc_purchase_logs` WHERE `sessionid`=".$sessionid." LIMIT 1");
    if ($billing_country) {
      return explode(';', $billing_country);
    }
  }  
}

// Get the page title (category or tag name)
// - it is displayed in the header
function page_main_name() {
	$ret = '&nbsp;';
	$tag = single_tag_title("", false);
	if ($tag) {
		$tag2 = str_replace('magazin ', '', $tag);
		$ret = ucfirst($tag2);
	} else {
		$ret = single_cat_title('', false);
	}			

	return $ret;
}

// Get the main category of a page
// - used in header
// - if used in sidebar it doesn't works!
function page_name($is_category, $is_single, $post_id) {
  $page_name = '&nbsp;';
    
  if ($is_category) {
    $page_name = single_cat_title('', false);
  } elseif ($is_single) {
      $cat_id = category_id($is_category, $is_single, $post_id);      
      if (!($cat_id == 0)) {
        $page_name = get_cat_name($cat_id);         
      } 
  } elseif (is_home()) { 
    $page_name = "";
  }
  return $page_name;
}


// Getting the category id if there is any
// - used to determine which category to display in the header
function category_id2($is_cat, $is_single, $post_id) {
  if ($is_cat) {
    return get_query_var('cat');
  } else {
  	return 0;	     
  }
}

// Getting the category id if there is any
// - used to determine which category to display in the header
function category_id($is_cat, $is_single, $post_id) {
  $cat_id = 0;
  if ($is_cat) {
    return get_query_var('cat');
  } else if ($is_single) {
      $collection_categories = get_categories('child_of=10');
      $cats = array();
      foreach ($collection_categories as $cc) {
        $cats[] = $cc->cat_ID; 
      }
      $post_categories = get_the_category($post_id);
      foreach ($post_categories as $pc) {
        if (in_array($pc->cat_ID, $cats)) {
          $cat_id = $pc->cat_ID;
        }	        
      }	     
  }
  return $cat_id;
}


// Getting the main category a post belongs
function post_main_category($post_categories, $parent_id) {
  $cats = '';
  $cats = get_categories('child_of='.$parent_id);
  $first_cat_ID = 0;
  
  // Getting the first category
  if ($cats) {
    $ids1 = array();
    foreach ($cats as $c1) {
      $ids1[] = $c1->cat_ID;
    }
    $ids2 = array();
    foreach ($post_categories as $c2) {
      $ids2[] = $c2->cat_ID;
    }
    $main = array_intersect($ids1, $ids2);
    foreach ($main as $m) {
      $cat = get_category($m);
      break;
    }     
  }
  
  return $cat;
}

// Getting the categories where a post belongs in a new fashion
// - some parent categories are removed:
//   :: alte-categorii-de-produse, distribuim-online, meta, post, produse, produse-folosite-in, produse-pentru, ocazii
// - used in blog index
function get_post_categories_array($post) {
  $parent_categories = array(704, 8, 670, 686, 9, 726, 10);  
  $ret = array();
  $cats = get_the_category($post->ID);
  foreach ($cats as $cat) {
    if (!(in_array($cat->cat_ID, $parent_categories))) {
      $ret[] = $cat;
    }
  }
  return $ret;
}




// Returns the excerpt of a page
// - $page is the page slug
function page_excerpt($page) {
    $p = get_page_by_path($page);   
    return $p->post_excerpt;
}


function is_blog() {
  $non_shop_categories = array(22, 40, 96, 97, 98, 99, 39, 26, 18);
  $ret = (is_home() || is_author() || is_tag() || in_category($non_shop_categories) || is_category($non_shop_categories));
  if (is_page() || is_search()) { 
    return false;
  } else {
    return $ret;
  }
}



// Query for multiple posts
// - the query string has the syntax of the query_posts WP function
function query_posts2($query_string) {
  $q = new WP_Query($query_string);
  return $q;
}



// WP-E-Commerce
// -------------------------------------------------------------------------------------------------

// making the shopping cart dynamic when using the WP SuperCache plugin
function dynamic_shopping_cart() {
  echo nzshpcrt_shopping_basket();
}

// checking if an user has all mandatory fields completed or not
// - used in checkout
// - the unserialize format help: http://blog.tanist.co.uk/files/unserialize/index.php
function check_profile_info($id) {
  global $wpdb;
  $query = "SELECT `meta_value` FROM `".$wpdb->prefix."usermeta` WHERE `user_id`=".$id." AND `meta_key`='wpshpcrt_usr_profile' LIMIT 1"; 
  $info = $wpdb->get_var($query);
  
  global $wplogger;
  $wplogger->log('profile id= '.$id);
  $wplogger->log('profile info= '.$info);
  $wplogger->log('profile info query = '.$query);
  
  $ret = false;
  if ($info) {
    $i = unserialize($info);
    if ($i[2] && $i[4] && $i[5] && $i[17] && $i[8]) { 
      $ret = true; 
    }
  } 
  
  return $ret;
}


// Get the product price directly from the post
function product_price($post_id) {  
  $product_id = product_id($post_id); 
  if ($product_id) {
    global $wpdb;
    $price = $wpdb->get_var("SELECT `price` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
    return $price;
  } else {
    return -1;
  } 
}


// Get the discount price from product
function product_discount($product_id) {  
  if ($product_id) {
    global $wpdb;
    $old_price = $wpdb->get_var("SELECT `special_price` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
    return $old_price;
  }  
}


// Get the post ID from the product ID
function post_id($product_id) {
  $posts = get_posts("cat=10&posts_per_page=1&meta_key=product_id&meta_value=" . $product_id);
  if ($posts) {
    foreach ($posts as $post) {
      $id = $post->ID;
    }
  } else {
    $id = 0;
  }
  return $id;
}


// Get the wspc product id 
// Input: post_id - the wp id of the post
function product_id($post_id) {
  $id = get_post_meta($post_id, 'product_id', true);
  return $id;
}

// Get the product short name from wpsc
function product_name($product_id) {
  if ($product_id) {
    global $wpdb;
    $name = $wpdb->get_var("SELECT `name` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
    return $name;
  }  
}

// Get the product thumbnail from wpsc
function product_thumb($product_id) {
  if ($product_id) {
    global $wpdb;
    $image = $wpdb->get_var("SELECT `image` FROM `".$wpdb->prefix."wpsc_product_images` WHERE `product_id`=".$product_id." LIMIT 1");
    return $image;
  }  
}


function product_stock($product_id) {
  if ($product_id) {
    return get_product_meta($product_id, 'sku', true);
  }  
}


// Calculate Delivery time based on stock
function product_delivery_time($stock) {
  $ret = "";
  
  if ($stock) {
    switch ($stock) {
      case -1:
        $ret = "Stoc terminat";
        break;
      case 2:
        $ret = "2-4 zile";
        break;
      default:
        $ret = "1-2 zile";  
    }
  } else {
    $ret = "5-7 zile";
  }  
  return $ret;
}

// Get the excerpt of a product from the post
function product_excerpt($post_content) {
  $ret1 = explode("</div>", $post_content);
  $ret = explode('<div class="pane">', $ret1[0]);
  return $ret[1];  
}


// Get post attachements
function post_attachements($post_id) {  
  $args = array(
	  'post_type' => 'attachment',
	  'numberposts' => -1,
	  'post_status' => null,
	  'post_parent' => $post_id,
	  'orderby' => 'menu_order',
	  'order' => 'ASC'
  ); 
  $attachments = get_posts($args);
  return $attachments;
}





// Advanced Search
// -------------------------------------------------------------------------------------------------




// Displaing all category items is done with Advanced Search
// This function builds the search url
function category_url($cat_id) {
  return "?s=+&price=&is-search=0&category[]=" . $cat_id;
}


// Used in advanced search
function create_radio_button_for_category($cat_id, $name) {
  $ret = "";
  $cats = get_categories('child_of='.$cat_id);
  foreach ($cats as $cat) {
    $ret .= '<dd><input type="radio" name="' . $name . '" value="' . $cat->cat_ID . '"/>';
    $ret .= $cat->name;
    $ret .= '</dd>';
  }
  return $ret;
}
function create_check_box_for_category($cat_id, $name) {
  $ret = "";
  $cats = get_categories('child_of='.$cat_id);
  foreach ($cats as $cat) {
    $ret .= '<dd><input type="checkbox" name="' . $name . '" value="' . $cat->cat_ID . '"/>';
    $ret .= $cat->name;
    $ret .= '</dd>';
  }
  return $ret;
}

// Checks if search results fit advanced search parameters
function advanced_search($post, $price, $categories) {  
  // Category checking first
  if ($categories) {
    if (in_category($categories, $post)) {
      $ret = true;
    } else {
      $ret = false;
    }    
  } else {
    $ret = true;
  }
  
  
  
  // Price checking
  if ($ret) {
    if ($price) {
      $product_price = product_price($post->ID);
      if ($product_price) {
        // splitting $price
        $tmp = explode('-', $price);
        $lower = (int)$tmp[0];
        if (!$tmp[1]) {
          $tmp[1] = 10000;
        }
        $higher = (int)$tmp[1];        
        if ($product_price >= $lower && $product_price <= $higher) {
          $ret = true;
        } else {
          $ret = false;
        }       
      } else {
        $ret = false;
      }      
    } else {
      $ret = true;
    }
  }  
  return $ret;  
}

// On search deal only with products
function SearchFilter($query) {
    if (!$query->is_admin && $query->is_search) {
        $query->set('cat','10');
    }
    return $query;
} 
add_filter('pre_get_posts','SearchFilter');




// Goodies
// -------------------------------------------------------------------------------------------------

function html_to_text($string){

	$search = array (
		"'<script[^>]*?>.*?</script>'si",  // Strip out javascript
		"'<[\/\!]*?[^<>]*?>'si",  // Strip out html tags
		"'([\r\n])[\s]+'",  // Strip out white space
		"'&(quot|#34);'i",  // Replace html entities
		"'&(amp|#38);'i",
		"'&(lt|#60);'i",
		"'&(gt|#62);'i",
		"'&(nbsp|#160);'i",
		"'&(iexcl|#161);'i",
		"'&(cent|#162);'i",
		"'&(pound|#163);'i",
		"'&(copy|#169);'i",
		"'&(reg|#174);'i",
		"'&#8482;'i",
		"'&#149;'i",
		"'&#151;'i",
		"'&#(\d+);'e"
		);  // evaluate as php
	
	$replace = array (
		" ",
		" ",
		"\\1",
		"\"",
		"&",
		"<",
		">",
		" ",
		"&iexcl;",
		"&cent;",
		"&pound;",
		"&copy;",
		"&reg;",
		"<sup><small>TM</small></sup>",
		"&bull;",
		"-",
		"uchr(\\1)"
		);
	
	$text = preg_replace ($search, $replace, $string);
	return $text;
	
}

function replace_not_in_tags($find_str, $replace_str, $string) {
	
	$find = array($find_str);
	$replace = array($replace_str);	
	preg_match_all('#[^>]+(?=<)|[^>]+$#', $string, $matches, PREG_SET_ORDER);	
	foreach ($matches as $val) {	
		if (trim($val[0]) != "") {
			$string = str_replace($val[0], str_replace($find, $replace, $val[0]), $string);
		}
	}	
	return $string;
}


function get_tag_id_by_name($tag_name) {
  global $wpdb;
  $tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE `name` = '".$tag_name."'");

  return $tag_ID;
}



?>
