	      
<?php 
  $product_id = product_id($post->ID);
  $product_price = product_price($post->ID);
  $product_name = product_name($product_id);
  $title = $product_name . ' pe ' . get_bloginfo('name') . ' &mdash; ' . get_bloginfo('description');
  $product_stock = product_stock($product_id);
  
  $postid = $post->ID;
  
  $cat = category_id(false, true, $postid); 
?>

<article <?php post_class('product') ?> id="post-<?php the_ID(); ?>">
  
  <div id="title">
    <h1>
		  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	  </h1>
	</div>
	
	<div id="large-image">
    <?php 
		  $imgs = post_attachements($post->ID);
		  $img = $imgs[0];  
		  $full = wp_get_attachment_image_src($img->ID, 'full');
		  $large = wp_get_attachment_image_src($img->ID, 'large');    
	  ?>
	
		<img class="large-image" src="<?php echo $large[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>"/>
		
		<div id="more">
		  <span>Click pentru mai multe imagini si detalii</span>
		</div>
	</div>
	  
  <div id="thumbs">
		<?php 
		  $counter = 1;
		  foreach ($imgs as $img) { 
			  $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
			  $large = wp_get_attachment_image_src($img->ID, 'full'); ?>
			
			  <div id="thumb" class="c<?php echo $counter ?>">
			    <img src="<?php echo $thumb[0]?>" title="<?php echo $title ?>" alt="<?php echo $title ?>" data-image="<?php echo $large[0]?>"/>				
			  </div>
		    <?php 
		      $counter += 1;
		      if ($counter == 7) { /*break;*/ }
		} ?> 
		
		<div id="close">
      <span>inapoi</span>
    </div>
	</div>
	
	
  <div id="shopping-cart">
    <?php include 'single-for-product__shopping.php' ?>
  </div>
	  
	
	  
  <div id="description"> 
	  <ul id="tabs">
	    <li id="details">Descriere</li>
	    <li id="properties">Proprietati</li>
	    <li id="usage">Folosire</li>
	   </ul>  
	   
    <div id="details">
      Incercarea de a folosi un iPhone sau iPad cu manusi este de la inceput zadarnica. 
      <br/>
      Presupun, ca nu v-ati gandit nici voi cand v-ati cumparat un telefon cu touchscreen, cum va fi iarna? Sa taiem doua degete de la manusil, le dam jos ori de cate ori folosim telefonul? Din pacate manusile nu conduc electricitatea ca si degetele goale. 
      <br/>
      Dar avem solutia, ca intotdeauna! &ndash; nici nu stiu de ce mai incepem posturile cu probleme si dupa aceea prezentam solutia?! Vom lucra la acest capitol cu siguranta. 
      <br/>
      Revenind la Manusile Touchscreen, acestea au tesute in degetul mare si cel aratator material conductiv, astfel dispozitivele cu ecran tactil se pot manevra in voie si cu manusi. Cunoasteti vorba `un prost face 100`, adica un dispozitiv are n+ accesorii, dar asta face ca tehnologia sa ne fie folositoare. Manusile Touchscreen sunt chiar o necesitate, nu? <img class="wp-smiley" alt=":)" src="http://localhost/smuff/wp-includes/images/smilies/icon_smile.gif">  <a target="_blank" href="http://razvanbb.ro/2011/11/ce-facem-iarna-cu-telefoanele-cu-touch.html">
      <br/>
      Si  vedeti inregistrarea si opinia lui Razvan Baciu aici -&gt;   http://razvanbb.ro/2011/11/ce-facem-iarna-cu-telefoanele-cu-touch.html</a>
    </div>
    
    <div id="properties">
      <ul>
        <li>Compozitie: 90% Acrylic, 8% Nylon, 2% alte materiale.</li>
        <li>Spalati in apa rece, manual.</li>
        <li>Degetul mare si cel aratator au tesut material conductiv pentru a ne permite manevrarea touchscreenelor si cu manusi.</li>
        <li>Palma manusilor este prevazuta cu material antiderapant.</li>
        <li>Nu zgarie ecranul.</li>
        <li>2 culori disponibile: Negru sau Gri.</li>
        <li>Marime universala barbati.</li>
      </ul>
    </div>
  
    <div id="usage">
      <ul>
        <li>Manusile Touchscreen au tesut un material conductiv, care permite sa folosim dispozitivele touchscreen ca si cu mainile goale.</li>
        <li>Raspunsul la comenzi este foarte rapid, nu mai este o problema sa raspundem iarna la telefon.</li>
        <li>Se pot folosi cu orice dispozitiv cu ecran capacitiv, iPhone, iPad etc.</li>
        <li>Nu zgarie ecranul.</li>
        <li>Ecranele touchscreen capacitive nu sunt capabile sa primeasca comenzi prin materiale textile sau de cauciuc. Practic ele functioneaza pe baza a 2 conductori: unul pe ecran si unul reprezentat de degetul uman iar atunci cand cei 2 conductori se unesc ecranul preia o comanda.</li>
        <li>Gadgeturile cu ecran tactil sunt peste tot, si cererea pentru folosirea lor pe timp de frig a fost manifestata clar, astfel produsul a fost creat: Manusi Touchscreen. Ne fac viata mai usoara, realmente!</li>
      </ul>
    </div>
	</div>  
	
</article>
			




    
<section id="recommended">    
 <?php
		$show_category = true;
		
		$related_posts = MRP_get_related_posts($postid, true);
		if ($related_posts) { 
			$counter = 1; ?>        
			<h2>Produse similare</h2>
			<div id="products">
			<?php foreach ($related_posts as $post) {
				setup_postdata($post);
				$show_excerpt = false;
			  $show_category = false;
				include "product-thumb.php";
				$counter += 1;
				if ($counter == 5) { break; }
			} ?>
			</div>
		<?php } 
	?>
</section>


		
<section id="promo">    
	<h2>Propunerea Smuff</h2>
	<div id="products">
	<?php       
		$specials = query_posts2('posts_per_page=2&cat=15&orderby=rand');
		if ($specials) {
			if ($specials->have_posts()) {
				$counter = 1;
				while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
					if (in_category(10)) {
						
						include "product-thumb.php";
						$counter += 1;
					}                    
				endwhile; 
			}		      
		}      
	?>
	
	<?php       
		$specials = query_posts2('posts_per_page=2&cat=10&orderby=rand');
		if ($specials) {
			if ($specials->have_posts()) {
				while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
					if (in_category(10)) {
						
						include "product-thumb.php";
						$counter += 1;
					}                    
				endwhile; 
			}		      
		}      
	?>
	</div>
</section>
  
  


  


