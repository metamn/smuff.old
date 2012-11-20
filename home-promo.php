
<section id="promo">
	<div id="title">
		<div id="percent">
			<h3 class="value">
				%
			</h3>
		</div>
		<div id="arrow">
			<div class="arrow-right"></div>
		</div>
	</div>
	
  <div id="body">        
		<div id="items" class="promo">	
			<?php
				if ($promo_posts->have_posts()) {
					$counter = 1;
					while ($promo_posts->have_posts()) : $promo_posts->the_post(); update_post_caches($posts); 
						$medium = false;
						$show_category = false;
						include "product-thumb.php";
						
						$counter++;
					endwhile; 
				}
			?>               		        
		</div>
		
		<div id="more">
			<a href="<?php echo bloginfo('home') ?>/?s=+&meta=15" title="Toate cadourile cu pret redus">Vezi toate cadourile cu pret redus &rarr;</a>
		</div>   
	</div>
</section>


