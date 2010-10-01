<?php
/*
This file is php so that admins can control its look without editing the code.
The headers below tell the browser to cache the file and also tell the browser it is css.
*/
require('../../../wp-config.php');
// expire every 30 days
$offset = 60*60*24*30;
$ExpStr = gmdate("D, d M Y H:i:s",time() + $offset)." GMT";
$last_modified_time = gmdate("D, d M Y H:i:s",filemtime($_SERVER['SCRIPT_FILENAME']))." GMT";

header("Last-Modified: ".$last_modified_time);
header("Cache-Control: max-age=".$offset.", must-revalidate");
header("Pragma: private");
header("Expires: ".$ExpStr);
header('Content-Type: text/css');

$shout_opt = get_option('shoutbox_options');
?>
/* This file controls the look of the Live shoutbox... */

#chatoutput {
height: 200px;
/* width: 172px; */

/* Horizontal Scrollbar Killer */
padding: 6px 8px; 

/* Borders */
border: 1px solid #<?php echo $shout_opt['name_color']; ?>;
border-width: 1px 1px;
-moz-border-radius : 14px 0px 0px 0px;

font: 11px helvetica, arial, sans-serif;
color: #<?php echo $shout_opt['text_color']; ?>;
background: #<?php echo $shout_opt['fade_to']; ?>;
overflow: auto;
margin-top: 10px;
}

#chatoutput span { font-size: 9pt; color: #<?php echo $shout_opt['name_color']; ?>; }
#chatForm label, #shoutboxAdmin { display: block; margin: 4px 0; }
#chatoutput li a { font-style: normal; font-weight: bold; color: #<?php echo $shout_opt['name_color']; ?> }

/* User names with links */
#chatoutput li span a { font-weight: normal; display: inline !important; border-bottom: 1px dotted #<?php echo $shout_opt['name_color']; ?> }

#chatForm input[type="hidden"] { border: 0; padding: 0; }
#chatForm input, #chatForm textarea, #chatForm #shoutboxOp, #shout_theme { width: 120px; display: block; margin: 0 auto; }
#chatForm textarea { width: 150px; }
#chatForm input#submitchat { width: 70px; margin: 10px auto; border: 2px outset; padding: 2px; }
#chatoutput ul#outputList { padding: 0; position: static; margin: 0; }
#chatoutput ul#outputList li { padding: 4px; margin: 0; color: #<?php echo $shout_opt['text_color']; ?>; background: none; font-size: 1em; list-style: none; min-height: <?php echo $shout_opt['avatar_size']; ?>px; }

/* No bullets from Kubrick et al. */
#chatoutput ul#outputList li:before { content: ''; }

ul#outputList li:first-line { line-height: 16px; }
#lastMessage { padding-bottom: 2px; text-align: center; border-bottom: 2px dotted #<?php echo $shout_opt['fade_from']; ?>; }
div#responseTime { display: inline; }
#chatoutput .wp-smiley { vertical-align: middle; }

#JalSound { margin: 0 -16px 0 0; cursor: pointer; float: left; width: 16px; height: 16px; }
#usersOnline { color: #<?php echo $shout_opt['name_color']; ?>; font-size: 9px; text-align: center; }
#chatInput { }
#SmileyList a img { margin-top: 4px; }
#Show_Spam { text-align: center; color: red; }

#wordspew .delShout { cursor: pointer; color:red; font-weight: bold; margin-left: 4px; }
.shoutbox_archive { margin: 20px; text-align: left; }
.shoutbox_archive .header { background: #000; color: #fff; height: 30px;}
table#wordspew { -moz-border-radius: 6px; -khtml-border-radius: 6px; -webkit-border-radius: 6px; border-radius: 6px; background: #fff; padding: 6px; color: #000; }
.msg { width: 70%; }
.name { white-space: nowrap; }
.date, .IP { text-align: center; }
.alternate { background-color: #f8f8f8; }
.goback { float: right; margin: 5px; }
#chatoutput li span.jal_user, #chatoutput li span.jal_user a, td span.jal_user { font-weight: bold;  }
.ps_left { float: left; margin-right: 2px; }
.ps_right { float: right; margin-left: 2px; }

tr.bg td { border-bottom: 1px dashed #<?php echo $shout_opt['fade_from']; ?>; padding: 2px; }
tr.bg:hover td, tr.bg:hover td a { background: #<?php echo $shout_opt['name_color']; ?>; color: #<?php echo $shout_opt['fade_to']; ?>; }
#chatoutput .InfoUser, .InfoUser { color: red; font-size: xx-small; }