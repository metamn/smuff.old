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
  $email = "";
  $nume = "";
  $cats = array();
  $price = ""; 
  $button = "";

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
          <div class="box">
            <?php if ($email == '') {
              $cookie = get_cookie("smuff_giftshopper");
              if ($cookie) {
                echo "cookie: $cookie" . "<br/>";
              } else { 
                echo "no cookie" . "<br/>";
                echo "ask for email or create new" . "<br/>"; ?>
                <h3>Ati salvat cumva mai demult o lista Giftshopper?</h3>
                <p>
                  Introduceti adresa Dvs. de email pentru a cauta lista
                  in baza noastra de date.
                </p> 
                <input id="email" name="email" type="email" value="" placeholder="Adresa email"/>                
                <button type='submit'>Cautare lista Giftshopper salvata</button>
                </form>
          </div>
              <?php }
            } else { ?>
              <input id="email" name="email" type="hidden" value="<?php echo $email ?>" />                
              
              <h3><?php echo $email ?></h3>
              <p>
                Aveti urmatoarele liste salvate: ...........
              </p>                                          
          </div>
              <div class="block">                           
                <?php 
                  if ($nume == '') { 
                    include 'giftshopper-form.php'; 
                  } else {
                    if ($button == 'dosearch') { 
                      include 'giftshopper-results.php';
                    } 
                  } ?>
              </div>
        <?php } ?>
        </form>        
      </div>
    <?php endwhile; endif; ?>
    
    <?php if (comments_open()) {comments_template();}  ?>
  </div>
</div>    


<?php get_footer(); ?>
