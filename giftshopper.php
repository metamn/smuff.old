<?php
  /*
  Template Name: Giftshopper
   * @package WordPress
   * @subpackage Default_Theme
   */
   
  get_header(); 
?>


<?php
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);
  
  $split = explode("&", $params);

  // We are expecting something like:
  // ?email=aaa@aaa.ro&nume=zolika&670=128&678=345&price=100-150&button=dosearch
  // When saving a list we expect:
  // ?email=aaa@aa.ro&profile=.....&products=id1,id2,&button=dosave
  $email = "";
  $nume = "";
  $cats = array();
  $price = ""; 
  $button = "";
  
  $profile = "";
  $products = "";

  // Parse params
  foreach ($split as $s) {
    $val = explode("=", $s);

    if ($val[0] == 'email') {
      $email = $val[1];
    } else if ($val[0] == 'nume') {
      $nume = $val[1];
    } else if ($val[0] == 'price') {
      $price = $val[1];
    } else if ($val[0] == 'button') {
      $button = $val[1];
    } else if ($val[0] == 'profile') {
      $profile = $val[1];
    } else if ($val[0] == 'products') {
      $products = $val[1];  
    } else {
      $cats[] = $val[1];
    }
  }  

  // Split price
  $lower = 0;
  $higher = 10000;
  if ($price) {
    $tmp = explode('-', $price);
    $lower = (int)$tmp[0];
    if (!$tmp[1]) {
      $tmp[1] = 10000;
    }
    $higher = (int)$tmp[1];    
  }

  echo "<br/> email: $email";
  echo "<br/> name: $nume";
  echo "<br/> cats: ";
  print_r($cats);
  echo "<br/> price: $price";
  echo "<br/> lower: $lower";
  echo "<br/> higher: $higher";   
  echo "<br/> button: $button"; 
  echo "<br/> profile: $profile"; 
  echo "<br/> products: $products"; 
  
  
  // The categories upon the gift quiz is built
  $steps = array(670, 686, 704, 726);
  // Which categories are checkboxes?
  $checkboxes = array(686, 726, 10);
 
?>

<div id="page" class="giftshopper share block">
  <div id="content" class="column span-24 last">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>
        
        <div class="entry box">
          <?php the_content() ?>
        </div>        
        <form action="<?php echo curPageURL2() ?>" method="get">
          
          <?php if ($button == 'dosave') {
              $save = gsh_save($profile, $products);
              if ($save) { ?>
                <div class="notice">
                  Lista Dvs. a fost salvata cu success.
                </div>
              <?php } else { ?>
                <div class="error">
                  Nu am reusit sa salvam lista Dvs. Va cerem scuze, va rugam sa reveniti mai tarziu.
                </div>
              <?php }
            } ?>
          
          <div class="box">            
            <?php if ($email == '') {
              $cookie = get_cookie("smuff_giftshopper");
              if ($cookie) {
                echo "cookie: $cookie" . "<br/>";
              } else { ?>
                <h3>Ati salvat cumva mai demult o lista Giftshopper?</h3>
                <p>
                  Introduceti adresa Dvs. de email pentru a cauta lista
                  in baza noastra de date.
                </p> 
                <input id="email" name="email" type="email" value="" placeholder="Adresa email"/>                
                <button type='submit'>Cautare lista Giftshopper salvata / Creare lista noua</button>
                </form>
          </div>
              <?php }
            } else { ?>
              <input id="email" name="email" type="hidden" value="<?php echo $email ?>" />                
              
              <h3><?php echo $email ?></h3>
              <p>
                <?php 
                  $profiles = gsh_get_profiles($email);
                  if ($profiles) {
                    foreach ($profiles as $p) {
                      echo $p->name . ',';
                    }
                  } else {
                    echo "Nu aveti liste salvate ....";
                  } ?>                
              </p>                                          
          </div>
              <div class="block">                                          
                <?php 
                  if (($nume == '') && ($button != 'dosearch')) { ?>
                    <div id="form" class="column span-17"> 
                      <?php include 'giftshopper-form.php'; ?>
                    </div>
                  <?php } elseif ($button == 'dosearch') { ?>
                      <div id="results" class="column span-17"> 
                        <?php include 'giftshopper-results.php'; ?>
                      </div>
                  <?php } ?>
                  <div id="profile" class="column span-5 prepend-1 last">
                    <?php include 'giftshopper-profile.php'; ?>
                  </div>
              </div>
        <?php } ?>
        </form>        
      </div>
    <?php endwhile; endif; ?>
    
    <?php if (comments_open()) {comments_template();}  ?>
  </div>
</div>    


<?php get_footer(); ?>
