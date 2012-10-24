<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) { ?>
	<ol class="commentlist">
		<?php wp_list_comments('type=comment'); ?>
		<!-- styled in functions.php -->
	</ol>
	
	
	<ol class="pinglist">
		<?php wp_list_comments('type=pings'); ?>
		<!-- styled in functions.php -->
	</ol>

<?php } else { // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) { ?>
		<!-- If comments are open, but there are no comments. -->
		<h4>Inca nu sunt comentarii la acest articol.</h4>
	 <?php } else { // comments are closed ?>
		<!-- If comments are closed. -->
		<h4>Comentariile sunt inchise la acest articol.</h4>
	<?php } ?>

<?php } ?>


<?php if ( comments_open() ) : ?>

	<div id="respond">
		<h4><?php comment_form_title( 'Parerea Dvs.', 'Parerea Dvs. pentru %s' ); ?></h4>
	
		<div class="cancel-comment-reply">
			<small><?php cancel_comment_reply_link(); ?></small>
		</div>

		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
			<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			
				<?php if ( is_user_logged_in() ) : ?>
					<p>Inregistrat ca <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Iesire din cont. &raquo;</a></p>
				<?php else : ?>
					<div class="block">
						<div id="normal" class="column span-12 last">
							<p><input class="required" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
							<label for="author"><small>Nume <?php if ($req) echo "(obligatoriu)"; ?></small></label></p>
					
							<p><input class="required email" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
							<label for="email"><small>E-mail (va ramane confidential) <?php if ($req) echo "(obligatoriu)"; ?></small></label></p>
					
							<p><input class="url" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
							<label for="url"><small>Adresa web</small></label></p>
						</div>
						<div id="social" class="column span-3 prepend-1 last">
							<?php do_action('fbc_display_login_button') ?>
						</div>
					</div>
				<?php endif; ?>
	
				<p><textarea class="required" name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
	
				<p><input name="submit" type="submit" id="submit" tabindex="5" value="Trimitere" />
	
				<?php comment_id_fields(); ?>
				</p>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
		<?php endif; // If registration required and not logged in ?>
	</div>

<?php endif; // if you delete this the sky will fall on your head ?>
