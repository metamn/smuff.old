<div id="collections-container" class="block">
	<div id="collections">
		<ul>
			<?php
				if ($collections->have_posts()) {
					while ($collections->have_posts()) : $collections->the_post(); update_post_caches($posts);       
						include "product-collections.php";              
					endwhile; 
				}
			?>  
		</ul>
	</div>
</div>
<div class="clear"></div>
