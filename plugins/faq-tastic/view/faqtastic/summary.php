<?php if (!defined ('ABSPATH')) die ('Not allowed'); ?><?php if (!empty ($questions)) :?>
	<ol class="faq">
		<?php foreach ($questions AS $pos => $question) : ?>
		<li>
			<a href="<?php if ($question->page_id > 0) echo get_permalink ($question->page_id); ?>#faq_<?php echo $question->id ?>"><?php echo $question->question; ?></a>
		</li>
		<?php endforeach; ?>
	</ol>
	
<?php else : ?>
  
<?php endif; ?>
