<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;" />

<!-- Web-app mode is not fully supported, yet : )
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
-->	

	<title><?php wp_title('&mdash;', true, 'right'); ?> <?php $str = bnc_get_header_title(); echo stripslashes($str); ?></title>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style.css" type="text/css" media="screen" />
	
	<?php if (!is_single()) { ?>
		<script type="text/javascript">
		if (window.navigator.standalone) { //don't do anything! 
		} else {
			function hideURLbar() { window.scrollTo(0,1);}
			addEventListener("load", function() { 
				setTimeout(hideURLbar, 0); }, false);}
		</script>
  <?php } ?>
</head>