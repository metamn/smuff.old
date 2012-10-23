<div id="search-enhanced" class="block">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
		
		<div id="first-row" class="block">
			<div id="price">
				<h3>Preturi</h3>
				<ul id="search-price-list">
					<li><input id="search-price" type="checkbox" name="price" value="0-100000" checked/>Toate preturile</li>
					<li><input id="search-price" type="checkbox" name="price" value="0-100"/>< 100 RON</li>
					<li><input id="search-price" type="checkbox" name="price" value="100-250" />100 - 250 RON</li>
					<li><input id="search-price" type="checkbox" name="price" value="250-350" />250 - 350 RON</li>
					<li><input id="search-price" type="checkbox" name="price" value="350" />Banii nu conteaza!</li>  
				</ul>
				
				<p id="submit">
					<input type="hidden" name="current-category" id="s" value="<?php echo page_main_name(); ?>" />
					
					<input class="submit" type="submit" id="searchsubmit" value="Cautare cadouri" />  
					<a id="advanced-search" title="Cautare avansata" href="#">Cautare avansata</a>
				</p>
			</div>
			
			<div id="delivery">
				<h3>Timp livrare</h3>
				<ul>
					<li><input id="search-delivery" type="checkbox" name="delivery" value="1-2"/>1-2 zile</li>
					<li><input id="search-delivery" type="checkbox" name="delivery" value="2-4"/>2-4 zile</li>
					<li><input id="search-delivery" type="checkbox" name="delivery" value="5-7"/>5-7 zile</li>
				</ul>
			</div>
			
			<div id="meta" class="last">
				<h3>Categorii</h3>
				<ul>
					<li><input id="search-meta" type="checkbox" name="meta" value="new"/>Cadouri noi</li>
					<li><input id="search-meta" type="checkbox" name="meta" value="bestsellers"/>Cele mai vandute</li>
					<li><input id="search-meta" type="checkbox" name="meta" value="promo"/>Cu pret redus</li>
				</ul>
			</div>
		</div>
	
		<div id="second-row" class="block">
			<div id="categories" class="block">
				<?php 
					$cats = array(670, 686, 704, 726);
					$counter = 1;
					foreach ($cats as $cat) { 
						$c = get_category($cat); 
						if ($counter % 3 == 0) {
							$klass = 'last';
						} else {
							$klass = '';
						}
						$counter += 1;
						?>
						<div class="<?php echo $klass ?>">
							<h3><?php echo $c->name ?></h3>
							<dl>
								<?php echo create_check_box_for_category($c->cat_ID, $cat->slug) ?> 
							</dl>
						</div>
				<?php } ?>
				
				<div>
					<h3>Categorii principale</h3>
					<dl>
						<?php echo create_check_box_for_category(10, "category[]")?>
					</dl>
				</div>
			</div>	
			
			
			<div class="block">
				<div id="searchbox">
					<input type="text" name="s" id="s" placeholder="Tastati aici expresia cautata"/>
					<br/>
					<input class="submit" type="submit" id="searchsubmit" value="Cautare cadouri" /> 
				</div>
			</div>
		</div>		
		
	</form>
</div>