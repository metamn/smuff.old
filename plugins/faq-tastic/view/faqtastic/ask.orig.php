<?php if (!defined ('ABSPATH')) die ('Not allowed'); ?><?php global $post; ?>
<br/>
<form action="<?php bloginfo ('wpurl') ?>/wp-content/plugins/faq-tastic/add-question.php" method="post" accept-charset="utf-8">
	<table width="100%">
		<tr>
			<th align="right" width="70" valign="top"><?php _e ('Question', 'faqtastic'); ?>:</th>
			<td align="left">
				<textarea name="faq_question" style="width: 95%" rows="5" cols="40"></textarea>
			</td>
		</tr>
		<tr>
			<th valign="top" align="right" width="70"><?php _e ('Email', 'faqtastic'); ?>:</th>
			<td align="left"><input type="text" size="30" name="faq_email" value=""/> <sup>1</sup>
				</td>
		</tr>
		<tr>
			<th width="70"></th>
			<td align="left"><input class="button-secondary" type="submit" name="add" value="<?php echo $group->ask_button () ?>"/></td>
		</tr>
	</table>
	<input type="hidden" name="group" value="<?php echo $group->id ?>"/>
	<input type="hidden" name="source" value="<?php echo get_permalink ($post->ID) ?>"/>
</form>
<br/>
<small>1 - <?php _e ('Notification of when your question has been answered. (Optional)', 'faqtastic'); ?></small>
