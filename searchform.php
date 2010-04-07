<?php do_action( 'bp_before_blog_search_form' ) ?>

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<input type="text" value="cautare ..." name="s" id="s" class="search" />		
	<?php do_action( 'bp_blog_search_form' ) ?>
</form>

<?php do_action( 'bp_after_blog_search_form' ) ?>
