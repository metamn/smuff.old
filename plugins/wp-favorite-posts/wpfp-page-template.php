<?php /*
  
  
  On product page
  1. visitor adds product(s) to wishlist
  2. when adding the first product a cookie 'wpfp_url' is generated, wpfp_url being the ID of the shared wishlist
  
  On this page
  1. if visitor the wpfp_url is read from coookie
  2. if user the wpfp_url is created / read from user_meta
  3. the wishlist is saved into wp_options under the wpfp_url key
   

*/?>




<?php
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);
  $split = explode("submit=", $params);
  $id = $split[1];    
?>


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
        setup_postdata($post);
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
    
    <div id="operations" class="box">      
      <?php if(!is_user_logged_in()) {
        global $current_user;
        get_currentuserinfo(); 
        $url = $_COOKIE['wpfp_url'];                
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
      
      // Saving the wishlist
      if ($id) {        
        if (update_option($id, $favorite_post_ids)) {
          echo "<div class='notice'>Wishlist salvat cu success</div>";   
        } else {
          echo "<div class='error'>Eroare la salvare Wishlist. Analizam aceasta problema, va rugam reveniti mai tarziu.</div>";
        }
      }
                 
      ?>
      
      <table class="share">
        <tr>
          <td colspan=3>
            <p>
              Aceasta este adresa unica a wishlist-ului Dvs. 
              <br/>
              Dupa salvare puteti trimite prietenilor.
            </p>
            <?php 
              $share_url = get_bloginfo('home') . "/wishlist/share/?id=" . $url;
            ?>
            <form action="<?php echo curPageURL2() ?>" method="get">
              <input class="url" type="text" name="url" readonly="readonly" value="<?php echo $share_url ?>" />
              <button type='submit' name='submit' value="<?php echo $url ?>" >Salvare</button>
            </form>
          </td>          
        <tr>
        <tr>
          <td class="fb">
            <a name="fb_share" type="button" share_url="http://www.smuff.ro/wishlist/share/?id=wpfp4cc297bbeab13" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
          </td>
          <td class="tw">
            <div class="twitter-button">
            <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
            <div>
               <a href="http://twitter.com/share" class="twitter-share-button"
                  data-url="<?php echo $share_url ?>"
                  data-via="smuff_ro"
                  data-text="Wishlistul meu <?php bloginfo('name')?>"
                  data-related="anywhere:The Javascript API"
                  data-count="none">Tweet</a>
            </div>
          </div>
          </td>
          <td class="email">
            <a href="mailto:?subject=Wishlist-ul meu de pe Smuff&body=<?php echo $share_url ?>"><img class="icon" src="<?php bloginfo('stylesheet_directory'); ?>/img/mail.png" title="Trimitere prin email" alt="Trimitere prin email"</a>
          </td>
        </tr>
      </table>
      
      
    </div>
          
  <?php } else { ?>
    <h4>Nu aveti nici un produs adaugat la wishlist</h4>
  <?php } ?>  
 
</div>

