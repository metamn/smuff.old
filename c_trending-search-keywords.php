<div id="trending" class="block">
	<h2>Trending pe Smuff</h2>
	<div id="items">
		<?php 
			$post = get_post_by_title('Trending pe Smuff');
			if ($post) {
				$keywords = get_post_meta($post->ID, 'campaign_keywords');
				if ($keywords) {
					// the keyword history is kept in the post meta as an array
					// - we choose always the latest entry
					// - and convert this comma delimited string into an array
					$keyword = explode(',', end($keywords));
				}
				$trending = '';
				foreach ($keyword as $k) {
					$trending .= '<div class="trend"><a href="' . get_bloginfo('home') . '/?s=+&s2=' . $k . '" title="' . $k . ' pe Smuff">' . $k . '</a></div>'; 
				}
				echo $trending;
				}
		?>
	</div>
</div>