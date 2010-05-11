<?php


// Styling comments
// - documentation @ http://codex.wordpress.org/Template_Tags/wp_list_comments
function styled_comments($comment, $args, $depth){
  $GLOBALS['comment'] = $comment; ?>
  
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="block">
      <div class="comment-author vcard column span-4 last">
         <?php echo get_avatar($comment, $size='96',$default='<path_to_url>' ); ?>
         <br/>
         <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
      </div>
      <div class="column last">
        <?php if ($comment->comment_approved == '0') : ?>
          <em><?php _e('Your comment is awaiting moderation.') ?></em>
          <br />
        <?php endif; ?>
        
        <div class="comment-body">
          <?php comment_text() ?>
        </div>
        
        <div class="comment-meta commentmetadata">
          <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s la %2$s'), get_comment_date(),  get_comment_time()) ?></a>
          <?php edit_comment_link(__('(Modificare)'),'  ','') ?>
          <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>        
      </div>
    </div>
<?php  
}

// Returns the excerpt of a page
// - $page is the page slug
function page_excerpt($page) {
    $p = get_page_by_path($page);   
    return $p->post_excerpt;
}

// Checking if the request is for the shop or the blog
// - used to display different layouts for the shop and the blog
function is_blog() {
  return is_home();
}

// Query for multiple posts
// - the query string has the syntax of the query_posts WP function
function query_posts2($query_string) {
  $q = new WP_Query($query_string);
  return $q;
}

// split tumblr imported post content into text and multimedia
// - used in blog index
function get_tumblr_media($post_content) {
  $ret = "";
  $tmp = explode('<br/>', $post_content);
  return $tmp[0];
}

// Generate a link for the current user's all posts
// - used in blog index
function get_user_posts($user) {
  $user_name = $user;
  if ($user == 'cs') {
    $user_name = 'admin';
  }
  return bloginfo('home') . '/author/' . $user_name;
}


// Getting the categories where a post belongs in a new fashion
// - some parent categories are removed:
//   :: alte-categorii-de-produse, distribuim-online, meta, post, produse, produse-folosite-in, produse-pentru, ocazii
// - used in blog index
function get_post_categories_array($post) {
  $parent_categories = array(3, 4, 8, 9, 10, 11, 12, 13);
  $ret = array();
  $cats = get_the_category($post->ID);
  foreach ($cats as $cat) {
    if (!(in_array($cat->cat_ID, $parent_categories))) {
      $ret[] = $cat;
    }
  }
  return $ret;
}

// Displaying post categories highlighting major categories
// - the parent is given for the most important category
// - major categories will go first 
// - used in blog index
// - returns list items
function display_post_categories($post_categories, $parent_id) {
  $ret = "";
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
      $first_cat_ID = $cat->cat_ID;
      $name = $cat->cat_name;
      $ret = '<li><a href="' . get_category_link($cat);
      $ret .='" title="Toate articolele din ' . $name . '" class="category main ' . $cat->category_nicename . '">' . $name . '</a></li>';
      break;
    }     
  }
  
  // Getting the other categories
  foreach ($post_categories as $c) {
    if (!($c->cat_ID == $first_cat_ID)) {
      $name = $c->cat_name;
      $ret .= '<li><a href="' . get_category_link($c);
      $ret .='" title="Toate articolele din ' . $name . '" class="category ' . $c->category_nicename . '">' . $name . '</a></li>';
    }
  }
  
  return $ret;
}


// Getting the category id if there is any
// - used to determine which category to display in the header
function category_id($is_cat, $is_single) {
  $cat_id = 0;
  if ($is_cat) {
    return get_query_var('cat');
  } else if ($is_single) {
      $collection_categories = get_categories('child_of=10');
      $cats = array();
      foreach ($collection_categories as $cc) {
        $cats[] = $cc->cat_ID; 
      }
      $post_categories = get_the_category();
      foreach ($post_categories as $pc) {
        if (in_array($pc->cat_ID, $cats)) {
          $cat_id = $pc->cat_ID;
        }	        
      }	     
  }
  return $cat_id;
}


// Get the product price directly from the post
function product_price($post_id) {  
  $product_id = product_id($post_id); 
  global $wpdb;
  $price = $wpdb->get_var("SELECT `price` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
  return $price;
}


// Get the discount price from product
function product_discount($product_id) {  
  global $wpdb;
  $old_price = $wpdb->get_var("SELECT `special_price` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
  return $old_price;
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
  global $wpdb;
  $name = $wpdb->get_var("SELECT `name` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
  return $name;
}

// Get the product stoc from wpsc
function product_stock($product_id) {
  global $wpdb;
  $quantity = $wpdb->get_var("SELECT `quantity` FROM `".$wpdb->prefix."wpsc_product_list` WHERE `id`=".$product_id." LIMIT 1");
  return $quantity;
}

// Calculate Delivery time based on stock
function product_delivery_time($stock) {
  $ret = "";
  if ($stock > 0) {
    $ret = "1-2 zile";
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
	  'numberposts' => null,
	  'post_status' => null,
	  'post_parent' => $post_id,
	  'orderby' => 'date',
	  'order' => 'ASC'
  ); 
  $attachments = get_posts($args);
  return $attachments;
}


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
    $ret .= '<input type="radio" name="' . $name . '" value="' . $cat->cat_ID . '"/>';
    $ret .= $cat->name;
    $ret .= '<br/>';
  }
  return $ret;
}
function create_check_box_for_category($cat_id, $name) {
  $ret = "";
  $cats = get_categories('child_of='.$cat_id);
  foreach ($cats as $cat) {
    $ret .= '<input type="checkbox" name="' . $name . '" value="' . $cat->cat_ID . '"/>';
    $ret .= $cat->name;
    $ret .= '<br/>';
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


?>
