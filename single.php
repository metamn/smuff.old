<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>



<?php if (have_posts()) : while (have_posts()) : the_post(); 
	if (in_category(10)) { 
		include "single-for-product.php";
	} else if (in_category('campanii')) {
		include "single-for-campaings.php";
	} else {
		include "single-post-or-page.php";
	}
endwhile; else: ?>
	<p>Va cerem scuze, articolul cautat nu exista.</p>
<?php endif; ?>


	

<?php get_footer(); ?>
