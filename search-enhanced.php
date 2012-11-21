<div id="search-enhanced">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
	
		<input type="hidden" name="s" id="s" value=" "/>
		
		<div>
			<h3>Preturi</h3>
			<ul id="search-price-list">
				<li><input id="search-price" type="checkbox" name="price" value="0-100"/>< 100 Lei</li>
				<li><input id="search-price" type="checkbox" name="price" value="100-250" />100 - 250 Lei</li>
				<li><input id="search-price" type="checkbox" name="price" value="250-350" />250 - 350 Lei</li>
				<li><input id="search-price" type="checkbox" name="price" value="350-10000000" />Banii nu conteaza!</li>  
			</ul>
			
			<p id="submit">
				<input type="hidden" name="current-category" id="s" value="<?php echo page_main_name(); ?>" />
				
				<input class="submit" type="submit" id="searchsubmit" value="Cautare cadouri" />  
				<span id="advanced-search">Cautare avansata</span>
			</p>
		</div>
		
		<div>
			<h3>Timp livrare</h3>
			<ul>
				<li><input id="search-delivery" type="checkbox" name="delivery" value="1"/>1-2 zile</li>
				<li><input id="search-delivery" type="checkbox" name="delivery" value="2"/>2-4 zile</li>
				<li><input id="search-delivery" type="checkbox" name="delivery" value="not-set"/>5-7 zile</li>
			</ul>
		</div>
		
		<div class="last">
			<h3>Categorii</h3>
			<ul>
				<li><input id="search-meta" type="checkbox" name="meta" value="10"/>Cadouri noi</li>
				<li><input id="search-meta" type="checkbox" name="meta" value="14"/>Cele mai vandute</li>
				<li><input id="search-meta" type="checkbox" name="meta" value="15"/>Cu pret redus</li>
			</ul>
		</div>
		
		<div id="categories">
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
						<ul>
							<?php echo create_check_box_for_category($c->cat_ID, "category[]") ?> 
						</ul>
					</div>
			<?php } ?>
			
			<div>
				<h3>Categorii principale</h3>
				<ul>
					<?php echo create_check_box_for_category(10, "category[]")?>
				</ul>
			</div>
		</div>	
			
			
		<div id="searchbox">
			<input type="text" name="s2" id="s2" placeholder="Tastati aici expresia cautata"/>
			<br/>
			<input class="submit" type="submit" id="searchsubmit" value="Cautare cadouri" /> 
		</div>
		
	</form>
</div>

<?php include 'c_trending-search-keywords.php' ?>
