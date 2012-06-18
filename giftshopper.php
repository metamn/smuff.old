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
  $products = "";

  // Parse params
  foreach ($split as $s) {
    $val = explode("=", $s);

    if ($val[0] == 'email') {
      $email = sanitize_email(str_replace("%40", "@", $val[1]));
    } else if ($val[0] == 'nume') {
      $nume = sanitize_text_field($val[1]);
    } else if ($val[0] == 'price') {
      $price = sanitize_text_field($val[1]);
    } else if ($val[0] == 'button') {
      $button = sanitize_text_field($val[1]);
    } else if ($val[0] == 'products') {
      $products = sanitize_title($val[1]);  
    } else {
      $cats[] = sanitize_title($val[1]);
    }
  }  
  
  $cats = implode("-", $cats);

  /*
  echo "<br/> email: $email";
  echo "<br/> name: $nume";
  echo "<br/> cats: $cats";
  echo "<br/> price: $price";
  echo "<br/> lower: $lower";
  echo "<br/> higher: $higher";   
  echo "<br/> button: $button"; 
  echo "<br/> products: $products"; 
  */
  
  
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
              $save = gsh_save($email, $nume, $cats, $price, $products);
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
                <input id="email" name="email" type="email" value="" placeholder="Adresa email"/>                
                <button type='submit'>Cautare lista Giftshopper salvata</button>
                <button type='submit'>Creare lista noua</button>
                <p>&nbsp;</p>
                <p class="notice">
                  Introduceti adresa de email pentru a cauta listele Dvs.
                  in baza noastra de date, sau pentru a crea a lista noua.
                </p> 
                </form>
          </div>
              <?php }
            } else { ?>
              <input id="email" name="email" type="hidden" value="<?php echo $email ?>" />                
              
              <h3>Listele mele (<?php echo $email ?>)</h3>
              <p>
                <?php 
                  $lists = gsh_get_lists($email);
                  if ($lists) { ?>
                  <ul>
                    <?php foreach ($lists as $l) { ?>
                      <li><a href="<?php bloginfo('home')?>/giftshopper/?email=<?php echo $l->email ?>&nume=<?php echo $l->name ?>"><?php echo $l->name ?></a></li>
                    <?php } ?>
                      <li><a href="<?php bloginfo('home')?>/giftshopper/?email=<?php echo $l->email ?>">Lista noua</a></li>                    
                  </ul>
                  <?php } else {
                    echo "Inca nu aveti liste salvate.";
                  } ?>                
              </p>                                          
          </div>
              <div class="block">                                          
                <?php 
                  if ($button != 'dosearch') { ?>
                    <div id="form" class="column span-17"> 
                      <?php include 'giftshopper-form.php'; ?>
                    </div>
                  <?php } elseif ($button == 'dosearch') { ?>
                      <div id="results" class="column span-17"> 
                        <?php include 'giftshopper-results.php'; ?>
                      </div>
                  <?php } ?>
                  <div id="profile" class="column span-6 prepend-1 last">
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
