<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>

<div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">		
  <div class="result-text"><?php wptouch_core_body_result_text(); ?></div>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="post" id="post-<?php the_ID(); ?>"> 
   		<?php if (!function_exists('dsq_comments_template') && !function_exists('id_comments_template')) { ?>
				  <?php if (wptouch_get_comment_count() && !is_archive() && !is_search()) { ?>
					  <div <?php if ($wptouch_settings['post-cal-thumb'] == 'nothing-shown') { echo 'id="nothing-shown" ';} ?>class="comment-bubble<?php if ( wptouch_get_comment_count() > 99 ) echo '-big'; ?>">
						  <?php comments_number('0','1','%'); ?>
					  </div>
				  <?php } ?>
		  <?php } ?>
 	
      <?php if (in_category(10)) { 
        include "product.php";
      } else { ?>	  
			  <div class="calendar">
				  <div class="cal-month month-<?php echo get_the_time('m') ?>"><?php echo get_the_time('M') ?></div>
				  <div class="cal-date"><?php echo get_the_time('j') ?></div>
			  </div>
			  <a class="h2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>	    
			  <div class="post-author">
		      <?php if ($wptouch_settings['post-cal-thumb'] != 'calendar-icons') { ?><span class="lead"><?php _e("Written on", "wptouch"); ?></span> <?php echo get_the_time('M') ?> <?php echo get_the_time('j') ?>, <?php echo get_the_time('Y') ?><?php if (!bnc_show_author()) { echo '<br />';} ?><?php } ?>
		      <?php if (bnc_show_author()) { ?><span class="lead"><?php _e("De", "wptouch"); ?></span> <?php the_author(); ?><br /><?php } ?>
		      <?php if (bnc_show_categories()) { echo('<span class="lead">' . __( 'In', 'wptouch' ) . ':</span> '); the_category(', '); echo('<br />'); } ?> 
		      <?php if (bnc_show_tags() && get_the_tags()) { the_tags('<span class="lead">' . __( 'Etichete', 'wptouch' ) . ':</span> ', ', ', ''); } ?>
	      </div>	
		    <div class="clearer"></div>
			<?php } ?>								 
    </div>
  <?php endwhile; ?>	

<?php if (!function_exists('dsq_comments_template') && !function_exists('id_comments_template')) { ?>

	<div id="call<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="ajax-load-more">
		<div id="spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="spin"	 style="display:none"></div>
		<a class="ajax" href="javascript:return false;" onclick="$wptouch('#spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeIn(200); $wptouch('#ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>').load('<?php echo get_next_posts_page_link(); ?>', {}, function(){ $wptouch('#call<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeOut();});">
			<?php _e( "Mai multe rezultate...", "wptouch" ); ?>
		</a>
	</div>
	<div id="ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>"></div>
	
<?php } else { ?>
				<div class="main-navigation">
					<div class="alignleft">
						<?php previous_posts_link( __( 'Articole noi', 'wptouch') ) ?>
					</div>
					<div class="alignright">
						<?php next_posts_link( __('Articole vechi', 'wptouch')) ?>
					</div>
				</div>
<?php } ?>
</div><!-- #End post -->

<?php else : ?>

	<div class="result-text-footer">
		<?php wptouch_core_else_text(); ?>
	</div>

 <?php endif; ?>

<!-- Here we're establishing whether the page was loaded via Ajax or not, for dynamic purposes. If it's ajax, we're not bringing in footer.php -->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>
