
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>
		

<div id="page" class="block page-mailchimp">
  <div id="content" class="column span-18">
    <?php 
      
      error_log("mailchimp request: \n\r" . print_r($_REQUEST, true));
      error_log("mailchimp post: \n\r" . print_r($_POST, true));
      
      if ($_REQUEST) {
        $type = $_REQUEST['type'];
        $email = $_REQUEST['data']['email'];
        
        if ($type == 'subscribe') {
          error_log("\n\rnew mailchimp subscriber:" . $email . "\n\r");
          
          $headers = "From: Smuff <shop@smuff.ro>";
          $subject = "Mersi, mersi, mersi!";
          $message = "Iti multumim ca te-ai inscris la noutatile Smuff.ro! Iti vom trimite minunatele idei de cadouri, informatii despre promotiile active si sansele de a castiga gadgeturi valoroase.";
          $message .= "\n\r\n\rAcesta este codul tau pentru LIVRARE GRATUITA!: NLs12-1";
          $message .= "\n\rFoloseste-l la checkout pentru a avea livrare gratuita prin POSTA RO + te invitam sa vezi si celelalte promotii active.";
          $message .= "\n\r\n\rSa ai o zi excelenta, si daca ai intrebari, nu ezita sa ne contactezi la 0740-456.127 sau prin email!";
          $message .= "\n\r\n\rhttp://www.smuff.ro - inseamna cadouri";
          
          $to = $email . ', shop@smuff.ro';
          
          if (wp_mail($to, $subject, $message, $headers)) {
            error_log("Coupon code sent.\n\r");
          } else {
            error_log("Coupon code WAS NOT sent.\n\r");
          }
        }
      }
    ?>
  
  
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>		  
			  <div class="entry block">
				  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>							
			  </div>
		  </div>
		<?php endwhile; endif; ?>
	</div>  
	
	
	<?php get_sidebar(); ?>  
</div>	
  
<?php get_footer(); ?>


