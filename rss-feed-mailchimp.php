<?php
/*
Template Name: Custom Feed For Mailchimp
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
  if (in_category(10)) {
    $imgs = post_attachements($post->ID);
    $img = $imgs[0]; 
    $thumb = wp_get_attachment_image_src($img->ID, 'large');
    
    $product_id = product_id($post->ID);
    $product_price = product_price($post->ID);
    
    
    $body = '<p class="excerpt">' . $post->post_excerpt . '</p>';   
    $body .= '<p><span class="price">' . $product_price . ' Lei</span><span class="btn">Adauga la cos &raquo;</span></p>';
  }   
?>
  <item>
    <title><?php echo get_the_title($post->ID); ?></title>
    <link><?php echo get_permalink($post->ID); ?></link>
    <media:content xmlns:media="http://search.yahoo.com/mrss"
    	url="<?php echo $thumb[0] ?>"
    	medium="image"
    	type="image/jpg"
    	width="500"
    	height="354"
    />
    <description><?php echo '<![CDATA['. $body .']]>';  ?></description>
    <pubDate><?php yoast_rss_date( strtotime($post->post_date_gmt) ); ?></pubDate>
    <guid><?php echo get_permalink($post->ID); ?></guid>
  </item>
<?php } ?>
</channel>
</rss>
