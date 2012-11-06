<?php 
	global $home_hot_klass; 
	
	if ($home_hot_klass == '') { ?>
		<div class='block'>
			<?php include 'c_subscribe-to-newsletter.php' ?>
		</div>
<?php } ?>
  
<div id="bestsellers" class="bestsellers block <?php echo $home_hot_klass ?>"> 
    
  <div id="col-0" class="column span-2 last">    
    <h3 class='first'>B</h3>
    <h3>e</h3>
    <h3>s</h3>
    <h3>t</h3>
    <h3>s</h3>
    <h3>e</h3>
    <h3>l</h3>
    <h3>l</h3>
    <h3>e</h3>
    <h3>r</h3>
    <h3 class='last'>s</h3>        
  </div>
  
  
  <div class="column span-21 prepend-1 last">
  	<?php if ($top_sales) { // Preserving the old version, for categories ?>
  		<div class="items">	
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
  	<?php } else { ?>
			<div id="filters" class="block">
				<div id="last-week" class="col">
					<h4 class='active'>Saptamana curenta</h4>
				</div>
				<div id="last-month" class="col">
					<h4>Luna curenta</h4>
				</div>
				<div id="last-three-months" class="col last">
					<h4>Ultimele trei luni</h4>
				</div>
			</div>
			
			<div id="items" class="block">
				<div id="last-week" class="item-list active">
					<div class="items">	
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
					<div class="items">	
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
					<div class="items">	
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
		
		<div id="more" class="block">
			<a href="<?php echo bloginfo('home') ?>/?s=+&meta=14" title="Toate cadourile populare">Vezi toate cadourile populare &rarr;</a>
		</div>
  </div>


	<div class="block">
		<div id="search-header" class="column span-3">
  		<h3>Cautare cadouri</h3>
  	</div>
  	<div class="column span-21 last">
  		<?php include 'search-enhanced.php' ?>
  	</div>
	</div>
</div>