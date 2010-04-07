<?php if (!defined ('ABSPATH')) die ('No direct access allowed'); ?>
<ul class="category_images_ii">
<?php foreach( $categories AS & $category ) { ?>
	<li class="category_image">
	  <a href="<?php echo $category['link'] ?>" title="Sponzorat de">
	    <img src="<?php echo $category[ 'thumbnail' ]; ?>" alt="<?php echo $category[ 'name' ]; ?>" /></a>
	</li>
<?php } ?>
</ul>
