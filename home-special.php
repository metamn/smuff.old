<div id="home-special" class="block">
	<?php
	if ($special_posts) {
			while ($special_posts->have_posts()) : $special_posts->the_post(); update_post_caches($posts);
				$imgs = post_attachements($post->ID);
				$img = $imgs[0];
				$large = wp_get_attachment_image_src($img->ID, 'large');
				$title = get_the_title();
				
				$th = '<div class="item"><a class="tooltip2" title="' . $title . '" data-link="' . get_permalink() . '" data-image="' . $large[0] . '" data-excerpt="' . get_the_excerpt() . '" data-price="" data-sale-price="" >';
				$th .= '<img src="' . $large[0] . '" alt="' . $title . '" />';
				$th .= '<span class="tooltip-text">' . $title . '</span></a></div>';
				
				echo $th;
			endwhile;
			
			$home_hot_klass = '';
		} else {
			$home_hot_klass = '';
		}
		global $home_hot_klass;
	?>	

</div>