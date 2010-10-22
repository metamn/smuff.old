<div id="wishlist">
  <?php 
    if (!empty($user)):
        if (!wpfp_is_user_favlist_public($user)):
            echo "Wishlistul pentru $user";
        else:
            echo "Wishlistul pentru $user nu este public.";
        endif;
    endif;
  ?> 
  
  <?php if ($favorite_post_ids) { ?>
    <table id="archive-all-table" class="tablesorter">
      <thead><tr>
        <th class="no-sort">Produs</th>        
        <th class="header">Nume produs</th>
        <th class="header">Pret<br/>RON</th>
        <th class="header">Reducere<br/>RON</th>
        <th class="header">Livrare</th>
        <th class="no-sort">Retragere</th>        
      </tr></thead>
      <tbody>
      <?php foreach ($favorite_post_ids as $post_id) {
        $post = get_post($post_id);
        $link = get_permalink($post_id);
        $product_id = product_id($post->ID);
        $product_price = product_price($post->ID);
        $product_name = product_name($product_id); 
        $product_stoc = product_stock($product_id);
        $imgs = post_attachements($post->ID);
        $img = $imgs[0];  
        $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); ?>
        <tr>
          <td>
            <a href="<?php echo $link ?>" title="<?php echo $product_name ?>">
              <img src="<?php echo $thumb[0]?>" alt="<?php echo $product_name ?>" title="<?php echo $product_name ?>"/></a>		        
          </td>
          <td>
            <a href="<?php echo $link ?>" title="<?php echo $product_name ?>">
              <?php echo $product_name; ?></a>
          </td>
          <td><?php echo $product_price ?></td>
          <td><?php echo product_discount($product_id) ?></td>
          <td><?php echo product_delivery_time($product_stoc) ?></td>		      
          <td><?php wpfp_remove_favorite_link($post_id); ?>
        </tr>
      <?php } ?>      
      </tbody>
    </table>   
    <div class="remove-all">
      <span><?php wpfp_clear_list_link(); ?></span>
    </div>
    <div class="clear"></div>
    
    <div id="operations">      
      <?php if(!is_user_logged_in()) {
        global $current_user;
        get_currentuserinfo(); 
        $url = $_COOKIE['wpfp_url']; 
        
        if (!($url)) {
          $random = uniqid("wpfp", false);          
          $url = $random;
        }
        
      } else { 
        if (is_user_logged_in()) {
          $current_user = wp_get_current_user();
          if ( !($current_user instanceof WP_User) ) return;
          
          $url = get_user_meta($current_user->ID, 'wpfp_url', true);          
          if (!($url)) {
            $random = uniqid("wpfp", false);
            update_user_meta($current_user->ID, 'wpfp_url', $random);
            $url = $random;          
          }
        }     
      } 
      
      update_option($url, $favorite_post_ids);
      
      $ids = get_option($url);
      if ($ids) {
        foreach ($ids as $id) {
          $post = get_post($id);
          echo $post->post_title . '<br/>';
        }
      }
      
      
      ?>
      
      
      
      
    </div>
          
  <?php } else { ?>
    <h4>Nu aveti nici un produs adaugat la wishlist</h4>
  <?php } ?>  
  
  
  
</div>

