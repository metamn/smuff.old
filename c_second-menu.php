<div id="menu-2" class="block">
	<ul id="text" class="inline-list">
		<li class="col-1">Categorii noi</li>
		<li class="col-2">&nbsp;</li>
	</ul>
	<ul id="content" class="inline-list">
		<?php 
			$cats = array("special-pentru-ele", "ingenioase-pentru-el");		            
			foreach ($cats as $cat) { 
				$c = get_category_by_slug($cat);
			?>
				<li>
					<a class="tooltip" alt="<?php echo $c->description ?>" href="<?php echo get_category_link($c->term_id)?>?view=1" title="Toate produsele din <?php echo $c->name ?>"><?php echo $c->name ?></a>
				</li>
		<?php } ?>
		
		<!--
		<li class="search">
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/"> 
				<input type="hidden" value=" " name="s" id="s" /> 
				<select name="price">
					<option value="0-100">0 - 100 RON</option>
					<option value="100-250" >100 - 250 RON</option>
					<option value="250-350" >250 - 350 RON</option>
					<option value="350" >Banii nu conteaza!</option>
					<option value="0-100000">Toate cadourile</option>
				</select>
				<input class="submit" type="submit" id="searchsubmit" value="Cautare cadouri" />  
			</form>
		</li>
		-->
	</ul>
</div>
	