<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
 

get_header(); 

?>

<section id="page">
  
  <article>
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	    <header id="title">
        <h1 itemprop="name">
          <?php the_title(); ?>
        </h1>
	    </header>
		
		  <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
	
		<?php endwhile; endif; ?>
	</article>   
	
	<aside id="sidebar">
	  <?php if (is_page('430')) { ?>
	    <div id="account" class="tabs">
	      <ul id="tabs">
	        <li id="connected">Date de livrare</li>
	        <li id="connect">Conectare</li>
	      </ul>
	      
	      <div id="connected">
	        <ul>
	          <li>
	            <input type="text" name="name" id="name" value="">
	            <label>Nume si prenume *</label>
	          </li>
	          
	          <li>
	            <input type="text" name="email" id="email" value="">
	            <label>Email *</label>
	          </li>
	          
	          <li>
	            <input type="text" name="phone" id="phone" value="">
	            <label>Telefon *</label>
	          </li>
	          
	          <li>
	            <textarea name="address" id="address"></textarea>
	            <label>Adresa *</label>
	          </li>
	          
	          <li>
	            <input type="text" name="city" id="city" value="">
	            <label>Localitate si judet *</label>
	          </li>
	          
	        </ul>
	      </div>
	      
	      <div id="connect">
	        <ul>
	          <li id="facebook">
	            <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/facebook-connect.jpg" />
	          </li>
	          
	          <li id="or">
	            sau
	            <br/>
	            Shopping Rapid
	          </li>
	          
	          <li>
	            <input type="text" name="name" id="name" value="">
	            <label>Nume si prenume *</label>
	          </li>
	          
	          <li>
	            <input type="text" name="email" id="email" value="">
	            <label>Email *</label>
	          </li>
	          
	          <li>
	            <input type="text" name="phone" id="phone" value="">
	            <label>Telefon *</label>
	          </li>
	        </ul>
	      </div>
	     
	    </div>
	    
	    <div id="checkout">
	      <input type='submit' value="Trimite comanda acum" />
	    </div>
	  <?php } else { ?>
	    <div id="other-info">
	      <h5>Alte informatii</h5>
	      <ul>
	        <li><a href="">Despre noi</a></li>
	        <li><a href="">Cum cumpar?</a></li>
	        <li><a href="">Contacteaza-ne</a></li>
	        <li><a href="">Termeni si conditii</a></li>
	      </ul>
	    </div>
	  <?php } ?>
	</aside>
	  
</section>	
  
<?php get_footer(); ?>


