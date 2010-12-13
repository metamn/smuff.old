<?php
  /*
  Template Name: Special page
   * @package WordPress
   * @subpackage Default_Theme
   */
?>



<?php get_header(); ?>

<?php 
  $special_news = query_posts2('posts_per_page=-1&cat=1319'); 
  $specials = query_posts2('posts_per_page=-1&cat=1318'); 
?>

<div id="page" class="block special <?php echo $klass ?>">
  <div id="content" class="column span-18">
	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		  <div class="post" id="post-<?php the_ID(); ?>">
		    <h2><?php the_title(); ?></h2>
		    <div class="entry block">
		    
		      <div id="text">
		        <?php the_content() ?>
		      </div>		      
		      		      
		      <div id="products" class="items">
		        <h3>Produse oferite cadou</h3>
		        <?php 
		          if ($specials) {
		            if ($specials->have_posts()) {
                  while ($specials->have_posts()) : $specials->the_post(); update_post_caches($posts); 
                    if (in_category(10)) {
                      $medium = true;
                      include "product-thumb.php";
                    }                    
                  endwhile; 
                }		      
		          }
     		    ?>
     		   </div>
     		   
		       <div id="news" class="items">		        
	          <?php 
	            if ($special_news) {
	              if ($special_news->have_posts()) { ?>	              
	                <h3>Ultimele stiri despre oferta noastra</h3>
	                  <ul>	            
	                    <li>
	                      <a href="http://www.smuff.ro/category/produse/?view=3">
	                        Toate produsele cu livrare rapida pentru Craciun 2010</a>
	                      </a>
	                    </li>  
                    <?php while ($special_news->have_posts()) : $special_news->the_post(); update_post_caches($posts); ?>
                      <li>
                      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a>
                      &nbsp;&nbsp;<span class="date"><?php the_time('j M Y') ?></span>
                      </li>  
                    <?php endwhile; ?>
                  </ul> 
                <?php }		      
	            }
     		    ?>
		      </div> 
		    
		    </div>
		  </div>
		<?php endwhile; endif; ?>
	</div>
	
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
