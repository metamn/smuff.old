<?php
/*
Template Name: Custom Feed
*/
 
$numposts = 10;
 
function yoast_rss_date( $timestamp = null ) {
  $timestamp = ($timestamp==null) ? time() : $timestamp;
  echo date(DATE_RSS, $timestamp);
}
 
function yoast_rss_text_limit($string, $length, $replacer = '...') { 
  $string = strip_tags($string);
  if(strlen($string) > $length) 
    return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;   
  return $string; 
}
 
$posts = query_posts('showposts='.$numposts);
 
$lastpost = $numposts - 1;
 
header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0"?>';
?><rss version="2.0">
<channel>
  <title>Smuff</title>
  <link>http://smuff.ro/</link>
  <description>Ultimele noutati de pe Smuff</description>
  <language>ro-ro</language>
  <pubDate><?php yoast_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></pubDate>
  <lastBuildDate><?php yoast_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></lastBuildDate>
  <managingEditor>cs@smuff.ro</managingEditor>
<?php foreach ($posts as $post) { 
  $imgs = post_attachements($post->ID);
  $img = $imgs[0];  
  $medium = wp_get_attachment_image_src($img->ID, 'medium');
  $image = '';
  if ($medium) {
    $image = '<img src="'.$medium[0].'" />';
  } 
?>
  <item>
    <title><?php echo get_the_title($post->ID); ?></title>
    <link><?php echo get_permalink($post->ID); ?></link>
    <description><?php echo '<![CDATA['. $image . '<br/>' . yoast_rss_text_limit($post->post_content, 600).'<br/>Detalii: <a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a>'.']]>';  ?></description>
    <pubDate><?php yoast_rss_date( strtotime($post->post_date_gmt) ); ?></pubDate>
    <guid><?php echo get_permalink($post->ID); ?></guid>
  </item>
<?php } ?>
</channel>
</rss>
