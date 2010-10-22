<?php
  /*
  Template Name: Wishlist Share
   * @package WordPress
   * @subpackage Default_Theme
   */
   
  get_header(); 
?>

<?php 
  $params = str_replace("%5B%5D", "", $_SERVER['QUERY_STRING']);	
  $subs = explode("=", $params);
  $wish = $subs[1];
?>

<div id="page" class="wishlist share block">
  <div id="content" class="column span-18">    
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>
        
        <div class="entry block">
        <?php
          if ($wish) { 
            $ids = get_option($wish);
            if ($ids) { ?>            
              <table id="archive-all-table" class="tablesorter">
              <thead><tr>
                <th class="no-sort">Produs</th>        
                <th class="header">Nume produs</th>
                <th class="header">Pret<br/>RON</th>
                <th class="header">Reducere<br/>RON</th>
                <th class="header">Livrare</th>                
              </tr></thead>
              <tbody>            
              <?php foreach ($ids as $id) {
                $p = get_post($id);
                $link = get_permalink($p_id);
                $product_id = product_id($p->ID);
                $product_price = product_price($p->ID);
                $product_name = product_name($product_id); 
                $product_stoc = product_stock($product_id);
                $imgs = post_attachements($p->ID);
                $img = $imgs[0];  
                $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); ?>
                <tr>
                  <td>
                    <a href="<?php echo $link ?>" title="<?php echo $product_name ?>">
                      <img src="<?php echo $thumb[0]?>" alt="<?php echo $product_name ?>" title="<?php echo $product_name ?>"/></a>		        
                  </td>
                  <td>
                    <a href="<?php echo $link ?>" title="<?php echo $product_name ?>">
                      <?php echo $product_name; ?></a>
                  </td>
                  <td><?php echo $product_price ?></td>
                  <td><?php echo product_discount($product_id) ?></td>
                  <td><?php echo product_delivery_time($product_stoc) ?></td>		                        
                </tr>
              <?php } ?>
              </tbody>
              </table>
            <?php } else {
              echo "<h4>Acest wishlist este gol.</h4>";
            }
          } else {
            echo '<h4>Ooops, acest wishlist nu mai exista.</h4>';
          } ?>
        </div>        
      </div>
    <?php endwhile; endif; ?>
    
    <?php if (comments_open()) {comments_template();}  ?>
  </div>
  
  <?php get_sidebar(); ?>	    
</div>	
  
<?php get_footer(); ?>
