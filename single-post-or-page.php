<div class="post" id="post-<?php the_ID(); ?>">
	<h1><?php the_title(); ?></h1>  
	
	<div class="block">
		<div class="entry">
			<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>							
		</div>
	</div>
	
	<div class='accordion'>
		<h3>Comentarii</h3>
		<div id="comments" class="pane block">
			<?php if (comments_open()) { comments_template(); } ?>
		</div>
	</div>
</div>