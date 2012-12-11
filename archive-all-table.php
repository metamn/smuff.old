<?php
// get all posts, not just 10/page
  $cat = category_id(true, false, null);    
  $all_posts = query_posts2('posts_per_page=-1&cat='.$cat); 
  //$all_posts2 = query_posts2('posts_per_page=200&offset=200&cat='.$cat);  
  //$all_posts3 = query_posts2('posts_per_page=200&offset=400&cat='.$cat); 
  $cat_name = '';
  if (!($cat == 10)) {
    $cat_name = ' din '. get_cat_name($cat);
  } 
?>

<div id="archive-all" class="block">  
  <div id="content" class="column span-18 content">
  	<?php include "c_second-menu.php" ?>
  	
    <div id='title' class='block'>
      <div id="left" class="column span-14 last">
        <h2>Toate produsele<?php echo $cat_name; ?></h2>
      </div>
      <div id="right" class="column span-4 last">
        <?php 
          $title = 'Lista';
          $link_type = '3'; // 2=table view, 3=grid view
          include "home-all-products-link.php";
        ?>
        | Tabela
      </div>
    </div>
    
    <?php if ($all_posts->have_posts()) : 
      $counter = 0;
      ?>
      <table id="archive-all-table" class="tablesorter">
      <thead><tr>
        <th class="header">Data publicarii</th>
        <th class="no-sort">&nbsp;</th>        
        <th class="header">Nume produs</th>
        <th class="header">Pret<br/>RON</th>
        <th class="header">Reducere<br/>RON</th>
        <th class="header">Livrare</th>        
      </tr></thead>
      <tbody>
		  <?php while ($all_posts->have_posts()) : $all_posts->the_post(); update_post_caches($posts); 
		    if (in_category(10)) {
		      $product_id = product_id($post->ID);
          $product_price = product_price($post->ID);
          $product_name = product_name($product_id); 
          $product_stoc = product_stock($product_id);
          $imgs = post_attachements($post->ID);
          $img = $imgs[0];  
          $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
          
          $counter += 1;
		    ?>
		      <tr>
		        <td><?php the_time('Y-m-d') ?></td>
		        <td>
		          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		            <img src="<?php echo $thumb[0]?>" alt="<?php echo $product_name ?>" title="<?php echo $product_name ?>"/></a>		        
		        </td>
		        <td>
		          <?php the_title(); ?>
		        </td>
		        <td><?php echo $product_price ?></td>
		        <td><?php echo product_discount($product_id) ?></td>
		        <td><?php echo product_delivery_time($product_stoc) ?></td>		      
		      </tr>
		  <?php } endwhile; ?>
		  
		  <?php while ($all_posts2->have_posts()) : $all_posts2->the_post(); update_post_caches($posts); 
		    if (in_category(10)) {
		      $product_id = product_id($post->ID);
          $product_price = product_price($post->ID);
          $product_name = product_name($product_id); 
          $product_stoc = product_stock($product_id);
          $imgs = post_attachements($post->ID);
          $img = $imgs[0];  
          $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
          
          $counter += 1;
		    ?>
		      <tr>
		        <td><?php the_time('Y-m-d') ?></td>
		        <td>
		          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		            <img src="<?php echo $thumb[0]?>" alt="<?php echo $product_name ?>" title="<?php echo $product_name ?>"/></a>		        
		        </td>
		        <td>
		          <?php the_title(); ?>
		        </td>
		        <td><?php echo $product_price ?></td>
		        <td><?php echo product_discount($product_id) ?></td>
		        <td><?php echo product_delivery_time($product_stoc) ?></td>		      
		      </tr>
		  <?php } endwhile; ?>
		  
		  <?php while ($all_posts3->have_posts()) : $all_posts3->the_post(); update_post_caches($posts); 
		    if (in_category(10)) {
		      $product_id = product_id($post->ID);
          $product_price = product_price($post->ID);
          $product_name = product_name($product_id); 
          $product_stoc = product_stock($product_id);
          $imgs = post_attachements($post->ID);
          $img = $imgs[0];  
          $thumb = wp_get_attachment_image_src($img->ID, 'thumbnail'); 
          
          $counter += 1;
		    ?>
		      <tr>
		        <td><?php the_time('Y-m-d') ?></td>
		        <td>
		          <a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
		            <img src="<?php echo $thumb[0]?>" alt="<?php echo $product_name ?>" title="<?php echo $product_name ?>"/></a>		        
		        </td>
		        <td>
		          <?php the_title(); ?>
		        </td>
		        <td><?php echo $product_price ?></td>
		        <td><?php echo product_discount($product_id) ?></td>
		        <td><?php echo product_delivery_time($product_stoc) ?></td>		      
		      </tr>
		  <?php } endwhile; ?>
		  </tbody>
		  </table>
		  <p class="alignright">
		    <?php echo $counter . ' produse. ' ?>
		    <a href="#archive-all">[ &uarr; Top ]</a>
		  </p>
		  <p class="note alignleft">
		  Apasand tasta "Shift" puteti combina mai multe criterii de sortare.
		  </p>		  
		<?php else : 
      include "not-found.php";  
	  endif; ?>
  </div>
  
  <?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
