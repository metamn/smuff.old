
<div class="column span-18">
	<?php include 'single-post-or-page.php'; ?>
</div>
<div id="campaign" class="column span-5 prepend-1 last">
	<div id="campaign-details"> 
		<h3>Details</h3>
		
		<p class="description">
			<?php echo get_post_meta($post->ID, 'campaign_goal', true); ?>
		</p>
		
		<dl>
			<dt>Start</dt>
			<dd><?php echo get_post_meta($post->ID, 'campaign_start', true); ?></dd>
			<dt>Metrics</dt>
			<?php 
				$metrics = get_post_meta($post->ID, 'campaign_metric');
				$metrics_url = get_post_meta($post->ID, 'campaign_metric_url');
				if ($metrics) {
					foreach ($metrics as $i=>$m) {
						echo '<dd><a href="' . $metrics_url[$i] . '">' . $m . '</a></dd>';
					}
				}
			?>
		</dl>
	</div>
</div>
