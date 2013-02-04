<?php
  /*
  Template Name: Startpage
   * @package WordPress
   * @subpackage Default_Theme
   */

  get_header();
?>

<?php 
  
  // New
  $new_products = query_posts2( array(
    'posts_per_page' => 7,
    'cat' => 10
  ));
  
  
  // Bestsellers
  $args = array();
  $args['posts_per_page'] = '6';
  
  $t = get_term_by('slug', 'cele-mai-vandute-saptamana-trecuta', 'category');
  $args['category__and'] = array(8, $t->term_id);
  $top_sales_last_week = query_posts2($args);
  
  $t = get_term_by('slug', 'cele-mai-vandute-luna-trecuta', 'category');
  $args['category__and'] = array(8, $t->term_id);
  $top_sales_last_month = query_posts2($args);
  
  $t = get_term_by('slug', 'cele-mai-vandute-in-ultimele-trei-luni', 'category');
  $args['category__and'] = array(8, $t->term_id);
  $top_sales_last_three_months = query_posts2($args);
  
  
  // Promo
  $promo_posts = query_posts2('posts_per_page=4&cat=15');
  
  
  // Anouncements
  $anouncements = query_posts2('posts_per_page=1&cat=1317');
 ?>
 
 <!--
 <nav id="startpage-main-menu" class='tab'>
  <ul>
    <li><h2 id="new-products">Noutati</h2></li>
    <li><h2 id="bestsellers">Cele mai vandute</h2></li>
    <li><h2 id="sales">Reduceri</h2></li>
  </ul>
 </nav>
-->




<?php 

  /*
  // Banners, news, campaigns
  $product_list = $anouncements;
  $product_list_title = '';
  $product_list_id = 'anouncements';
  $image_size = 'large';
  include 'product-list.php';
  */
  
  
  
  // New products
  $product_list = $new_products;
  $product_list_title = 'Noutati';
  $product_list_id = 'new-products';
  $image_size = 'medium';
  include 'product-list.php';
?>  
  
  <section id="anouncement">
    <h2>
      <span>
        <strong>Livrare gratuita</strong> la comenzi peste 300 RON
      </span>
    </h2>
  </section>
  
  
<?php 
    
  // Sales
  $product_list = $promo_posts;
  $product_list_title = 'Reduceri';
  $product_list_id = 'sales';
  
  $show_category = false;
  include 'product-list.php';
  
?>

  <section id="giftshopper">
    <header id="title">
      Alege cadoul perfect!
    </header>
    <div id="body">
      <ul>
        <li id="tagcloud">
          <div id="inner">
            <?php wp_tag_cloud('number=10') ?>
          </div>
        </li>
        <li id="for-him">
          <p>Pentru El</p>
        </li>
        <li id="for-her">
          <p>Pentru Ea</p>
        </li>
        <li id="for-kids">
          <p>Pentru Copii</p>
        </li>
        <li id="for-office" class="last">
          <p>Casa si birou</p>
        </li>
      </ul>
    </div>
  </section>
  
<?php
  /*
  // Bestsellers
  echo "<section id='bestsellers'>"; 
    $product_list = $top_sales_last_week;
    $product_list_title = 'Ultima saptamana';
    $product_list_id = 'bestsellers';
    include 'product-list.php';
    
    $product_list = $top_sales_last_month;
    $product_list_title = 'Ultima luna';
    $product_list_id = 'bestsellers';
    include 'product-list.php';
    
    $product_list = $top_sales_last_three_months;
    $product_list_title = 'Ultimele trei luni';
    $product_list_id = 'bestsellers';
    include 'product-list.php';
  echo "</section>";
  */
  
?>

  <section id="subscribe">
    <div id="body">
      <ul>
        <li id="newsletter">
          <div id="inner">
            <?php include 'c_subscribe-to-newsletter.php' ?>
          </div>
        </li>
        
        <li id="facebook">
          <div id="inner">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=348406981918786";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            
            <div class="desktop">
              <div class="fb-like-box" data-href="http://www.facebook.com/smuffgadget" data-width="292" data-show-faces="true" data-stream="false" data-header="false"></div>
            </div>
            
            <div class="mobile">
              <div class="fb-like-box" data-href="http://www.facebook.com/smuffgadget" data-width="292" data-show-faces="true" data-stream="false" data-header="false"></div>
            </div>
            
          </div>
        </li>
        
        <li id="comments" class="last">
          <div id="inner">
            <div id="text">
              Imi place magazinul vostru foarte mult. Cadourile voastre sunt pur si simplu fantastice!
            </div>
            <div id="author">
              Anca
            </div>
            
            <div id="text">
              Smuff este magazinul meu preferat. Mersi mult si spor la treaba :)
            </div>
            <div id="author">
              Ionut
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>


<?php get_footer(); ?>
