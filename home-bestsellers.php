<section id="bestsellers">    
  <div id="title">    
    <h2>Bestsellers</h2>        
  </div>
  
  
  <div id="body">
  	<?php if ($top_sales) { // Preserving the old version, for categories ?>
  		<div id="products">	
  			<div id="items" class="bestseller">
					<?php
						if ($top_sales->have_posts()) {
							$counter = 1;
							while ($top_sales->have_posts()) : $top_sales->the_post(); update_post_caches($posts); 
								$medium = true;    
								if ($cat == 0 || $cat == 10) {
									$show_category = true;         
								} else {
									$show_category = false;         
								}
								include "product-thumb.php";              
								$counter += 1;
							endwhile; 
						}
					?>    
				</div>
			</div>
  	<?php } else { ?>
			<div id="filters">
				<div id="last-week">
					<h4 class='active'>Saptamana curenta</h4>
				</div>
				<div id="last-month">
					<h4>Luna curenta</h4>
				</div>
				<div id="last-three-months">
					<h4>Ultimele trei luni</h4>
				</div>
			</div>
			
			<div id="products">
				<div id="last-week" class="item-list active">
					<div id="items" class="bestseller">	
							<?php
								if ($top_sales_last_week->have_posts()) {
									$counter = 1;
									while ($top_sales_last_week->have_posts()) : $top_sales_last_week->the_post(); update_post_caches($posts); 
										$medium = true;    
										if ($cat == 0 || $cat == 10) {
											$show_category = true;         
										} else {
											$show_category = false;         
										}
										include "product-thumb.php";              
										$counter += 1;
									endwhile; 
								}
							?>       		        
					</div>
				</div>
				
				<div id="last-month" class="item-list">
					<div id="items" class="bestseller">	
							<?php
								if ($top_sales_last_month->have_posts()) {
									$counter = 1;
									while ($top_sales_last_month->have_posts()) : $top_sales_last_month->the_post(); update_post_caches($posts); 
										$medium = true;    
										if ($cat == 0 || $cat == 10) {
											$show_category = true;         
										} else {
											$show_category = false;         
										}
										include "product-thumb.php";              
										$counter += 1;
									endwhile; 
								}
							?>       		        
					</div>
				</div>
				
				<div id="last-three-months" class="item-list">
					<div id="items" class="bestseller">	
							<?php
								if ($top_sales_last_three_months->have_posts()) {
									$counter = 1;
									while ($top_sales_last_three_months->have_posts()) : $top_sales_last_three_months->the_post(); update_post_caches($posts); 
										$medium = true;    
										if ($cat == 0 || $cat == 10) {
											$show_category = true;         
										} else {
											$show_category = false;         
										}
										include "product-thumb.php";              
										$counter += 1;
									endwhile; 
								}
							?>       		        
					</div>
				</div>
			</div>
		<?php } ?>
		
		<div id="more">
			<a href="<?php echo bloginfo('home') ?>/?s=+&meta=14" title="Toate cadourile populare">Vezi toate cadourile populare &rarr;</a>
		</div>
		
  </div>
</section>