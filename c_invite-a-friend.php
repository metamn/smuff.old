<?php
  if ( ($gow_posts) && ($gow_posts->have_posts())) {
    while ($gow_posts->have_posts()) : $gow_posts->the_post(); update_post_caches($posts); 
      $product_id = product_id($post->ID);
      $invite_product_title = get_the_title(); 
      $invite_product_link = get_permalink();
      
      ?>

      <div id="invite-friend" class="campaign-box">
        <h4>
          Invita un prieten la newsletter-ul Smuff si <strong>amandoi va inscrieti la concursul saptamanii</strong> pentru 
          <br/><br/>
          <strong class="inverted"><a href="<?php echo $invite_product_link ?>" title="<?php echo $invite_product_title ?>"><?php echo $product_title ?></a></strong>
        </h4>
        
        <div id="invite-friend-form" data-nonce="<?php echo wp_create_nonce('invite-friend') ?>" >
          <input type="hidden" id="gow" value="<?php echo $invite_product_title ?>" name="gow">
          <input type="hidden" id="gow-link" value="<?php echo $invite_product_link ?>" name="gow-link">
          <input type="text" required="" placeholder="Numele Dvs." id="name" value="" name="nume" class="text">
          <input type="email" required="" placeholder="Adresa Dvs. de email" id="email" value="" name="EMAIL" class="email">    
          <br/>
          <input type="text" required="" placeholder="Prietenul Dvs." id="friend-name" value="" name="EMAIL" class="text">
          <input type="email" required="" placeholder="Adresa prietenului de email" id="friend-email" value="" name="EMAIL" class="email">    
          <br/>
          <input type="submit" value="Invitatie la newsletter" name="subscribe" id="invite" >
        </div>
        
        <h4 id="whatis">
          <a href="http://www.smuff.ro/despre-noi/invita-un-prieten-la-newsletterul-smuff/" title="Invita un prieten la newsletterul Smuff">Ce este?</a>
        </h4>
      </div>
    <?php endwhile; ?>
  <?php } ?>

