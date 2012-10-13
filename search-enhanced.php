<div id="search-enhanced" class="block">
	<?php include 'searchform.php' ?>
	
	<div id="categories">
		<h3>&nbsp;</h3>
		<ul>
      <?php wp_list_categories('title_li=&exclude=8,96,9,10,22, 714, 716, 715, 717, 711, 712, 713'); ?>     
    </ul>
	</div>
	
	<div id="tags">
		<?php include 'home-icons.php' ?>
	</div>
</div>