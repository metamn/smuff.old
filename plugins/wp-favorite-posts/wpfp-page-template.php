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
  
  //echo "params: $params";
  //$counter = 0; // Apache
  $counter = 1; // Nginx
  
  $split = explode("&", $params);
  $split1 = explode("email=", $split[$counter]);
  $email = $split1[1];
  
  $split2 = explode("id=", $split[$counter+1]);
  $id = $split2[1]; 
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
        <th class="no-sort">&nbsp;</th>        
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
        }     
      }
      if (!($url)) {
        $random = uniqid("wpfp", false);
        update_user_meta($current_user->ID, 'wpfp_url', $random);
        $url = $random;             
      }
      
      
      // Saving the wishlist
      if ($id) {
        $update = update_option($id, $favorite_post_ids);
        // Returns true if new items are added
        // Returns false if the old list is updated without new items
        // Returns false if the operation is unsuccessful
        // ==> cannot be used to display status messages (notice, error)
        
        $body = "";
        $body .= "De la: " . str_replace("%40", "@", $email) . "\r\n";
        $body .= "Wishlist URL: " . get_bloginfo('home') . "/wishlist/share/?id=$id\r\n";
        $body .= "Produse: \r\n";
        foreach ($favorite_post_ids as $post_id) {
          $post = get_post($post_id);
          setup_postdata($post);
          $link = get_permalink($post_id);
          $body .= " - " . $link . "\r\n";
        }
        $email = wp_mail("shop@smuff.ro", 'Wishlist nou', $body);
        
        if ($email) {
          echo "<div class='notice'>Wishlist salvat cu success</div>";     
        } else {
          echo "<div class='error'>Eroare salvare wishlist. Va rugam reveniti mai tarziu.</div>";        
        }
      }          
      ?>
      
      <table class="share">
        <tr>
          <td colspan=3>
            <h3>Salvati lista Dumneavoastra.</h3> 
            <h4>              
              Cand faceti modificari la lista de produse dorite in viitor, va rugam sa o salvati. Astfel va vom trimite notificari daca produsele selectate intra in promotie.              
            </h4>
            
            <h4>
              Totodata, acest Wishlist de gadgeturi si cadouri smuff se poate impartasi pe Facebook si Twitter! 
            </h4>
                         
            <?php 
              $share_url = get_bloginfo('home') . "/wishlist/share/?id=" . $url;
            
              if ($email) { ?>
                <h4>
                  Adresa Dvs. de wishlist: 
                  <strong>
                    <a href="<?php echo $share_url ?>"><?php echo $share_url ?></a>
                  <strong>
                </h4>              
              <?php } else { ?>              
                <form action="<?php echo curPageURL2() ?>" method="get">
                  <input class="url" type="email" name="email" value="" placeholder="Adresa Dvs. de email" />
                  <input type="hidden" name="id" value="<?php echo $url ?>"/>
                  <button type='submit' name='submit'>Salvare</button>
                </form>                
             <?php } ?>
          </td>          
        <tr>
        
        <?php if ($email) { ?>
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
        <?php } ?>
      </table>
      
      
    </div>
          
  <?php } else { ?>
    <div class="box">
      <h2>Nu aveti nici un produs adaugat la wishlist.</h2>
      
      <h4>Puteti adauga pe pagina produsului sau puteti salva tot
      continutul cosului la finalizarea comenzii.</h4>
      
      <h4>
        Cand produsele din wishlist-ul Dvs. sunt reduse va contactam prin email
        pentru a notifica despre aceste ocazii speciale.
      </h4>
    </div>
  <?php } ?>  
 
</div>

