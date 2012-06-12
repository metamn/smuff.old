
<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

<div id="page" class="block page-coscumparaturi">
  <div id="content" class="column span-24 last">
  
    
    <div id="pricing-policy-details" class="block hidden">      
      <div class="col-1">
        <h2>Politica de preturi Smuff</h2>
        <ol>
          <li>
            <h4>
            Noi suntem primii in Romania care va aduc cele mai noi gadgeturi si gizmouri 
            premium din intreaga lume.
            </h4>
            <h4>
            La aceste produse noi practicam preturi ca si cum vi le-ati cumpara direct din strainatate. 
            In plus, la acelasi pret la noi primiti servicii impecabile &mdash; suport si garantie pe plan local.
            </h4>
          </li>
          <li>
            <h4>
            Cu timpul unele produse de pe Smuff devin foarte populare &mdash;
            tigara electronica, Parror IR Drone, tricourile elctronice etc &mdash; 
            si sunt vandute de catre alte magazine din tara la preturi discount.
            </h4>
          </li>
          <li>
            <h4>
            La acest capitol incercam sa tinem pasul prin reduceri.
            Insa misiunea noastra ramane de a va aduce noutatiile la preturi accesibile
            </h4>
          </li>
        </ol>
        
        <h2>Costuri de livrare</h2>
        <h4>Noi am ales preturi cat se poate de mici in magazinul Smuff.
          Din acest motiv costurile de livrare nu pot fi incorporate in pretul produselor.
        </h4>
      </div>
      <div id="close" class="col-2">[x] inchide</div>
    </div>
  
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>		  
			  <div class="entry block">
				  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>							
			  </div>
		  </div>
		<?php endwhile; endif; ?>
	</div>    
</div>	
  
<?php get_footer(); ?>


