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
  
  // Cheking if this is a db operation
  if ($params) {    
    $split = explode("email=", $params);    
    $email = $split[1];       
  }  
?>

<div id="page" class="giftshopper share block">
  <div id="content" class="column span-24 last">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>
        
        <div class="entry box">
          <?php the_content() ?>
        </div>
        <div class="box">
          
          <?php if ($email != '') { ?>
              Cautare in baza de date ....
              <br/>
              Am gasit lista
              <a href="<?php bloginfo('home')?>/giftshopper/profil/?id=test">asta</a>
          <?php } else {   
            $cookie = get_cookie("smuff_giftshopper");
            if ($cookie) {
              echo "cookie: $cookie";
            } else { ?> 
            
              <h3>Ati salvat cumva mai demult o lista Giftshopper?</h3>
              <p>
                Introduceti adresa Dvs. de email pentru a cauta lista
                in baza noastra de date.
              </p>           
              <form action="<?php echo curPageURL2() ?>" method="get">
                <input id="email" name="email" type="email" value="" placeholder="Adresa email"/>
                <button type='submit'>Cautare lista Giftshopper</button>
              </form>            
          <?php 
            } 
          }
          ?>
        </div>
        
      </div>
    <?php endwhile; endif; ?>
    
    <?php if (comments_open()) {comments_template();}  ?>
  </div>
</div>    


<?php get_footer(); ?>
