<?php if (!defined ('ABSPATH')) die ('Not allowed'); ?><?php if (!empty ($questions)) :?>
	<ol class="faq">
		<?php foreach ($questions AS $pos => $question) : ?>
		<li<?php if ($pos % 2 == 1) echo ' class="alt"' ?> id="faq_<?php echo $question->id ?>">
			<?php if ($allow_rating) : ?>
				<?php $this->render ('rating', array ('question' => $question, 'group' => $group)); ?>
			<?php endif; ?>
				
			<h5><?php echo $question->question; ?></h5>
			<div class="answer">
				<?php Formatter::display ($question->answer) ?>
			</div>
			
			<div class="author">
				<?php if ($question->author_name) : ?>
					<?php _e ('Asked by', 'faqtastic'); ?>: <?php echo $question->author_link (); ?>
				<?php endif; ?>
			</div>

			<?php $this->render ('related', array ('related' => $question->get_related ())); ?>
		</li>
		<?php endforeach; ?>
	</ol>
	<div style="clear: both"></div>
	
<?php else : ?>
  <p>Inca nu sunt intrebari.</p>
<?php endif; ?>
