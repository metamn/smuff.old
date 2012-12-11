<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
  <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
  <div class="entry span-16 last">
    <?php 
    	the_content('<p class="serif">Detalii &rarr;</p>');
    ?>             
  </div>
  <div class="column span-16 last">      
    <?php include "post-meta-and-share.php" ?>	    				      
  </div>
</div>
<div class="clear"></div>

<?php
	// - products which belong together are collected into a special category
	// - the category slug is stored inside a meta tag
	// - there can be more special categories attached to a post
	
	$category_slugs = get_post_meta(get_the_ID(), 'special_category_slug', false);
	if (isset($category_slugs)) {
		foreach ($category_slugs as $slug) {
		
			$specials = query_posts2('posts_per_page=-1&category_name=' . $slug);
			if ($specials) {
				if ($specials->have_posts()) { 
					$cat = get_category_by_slug($slug);
					$cat_name = '';
					if ($cat) {
						$cat_name = $cat->cat_name;
					}
					?>
				
					<div id="promos" class="bestsellers block <?php echo $slug ?>">
						<h2><?php echo $cat_name ?></h2>
						<?php
							while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
								if (in_category(10)) {
									$medium = true;
									include "product-thumb.php";
								}                    
							endwhile;
						?>
					</div>
	<?php }		      
			}
		}
	}
?>