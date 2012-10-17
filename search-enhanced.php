<div id="search-enhanced" class="block">
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
		<input type="hidden" name="s" id="s" value=" " /> 
		
		<div id="price">
			<h3>Preturi</h3>
			<ul id="search-price-list">
				<li><input id="search-price" type="checkbox" name="price" value="0-100000" checked/>Toate preturile</li>
				<li><input id="search-price" type="checkbox" name="price" value="0-100"/>< 100 RON</li>
				<li><input id="search-price" type="checkbox" name="price" value="100-250" />100 - 250 RON</li>
				<li><input id="search-price" type="checkbox" name="price" value="250-350" />250 - 350 RON</li>
				<li><input id="search-price" type="checkbox" name="price" value="350" />Banii nu conteaza!</li>  
			</ul>
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
			
			<p id="submit">
				<input type="hidden" name="current-category" id="s" value="<?php echo page_main_name(); ?>" />
				
				<input class="submit" type="submit" id="searchsubmit" value="Filtrare cadouri" />  
  			<a id="advanced-search" title="Cautare avansata" href="<?php bloginfo('home'); ?>/cautare-avansata/">Cautare avansata</a>
  		</p>
		</div>
	</form>
</div>