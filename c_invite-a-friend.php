<div id="invite-friend" class="campaign-box">
  <h4>
    Invita un prieten la newsletter-ul Smuff si <strong>amandoi va inscrieti la concursul saptamanii</strong> pentru 
    <br/><br/>
    <strong class="inverted"><?php echo $product_title ?></strong>
  </h4>
  
  <div id="invite-friend-form" data-nonce="<?php echo wp_create_nonce('invite-friend') ?>" >
    <input type="email" required="" placeholder="Adresa Dvs. de email" id="email" value="" name="EMAIL" class="text">    
    <br/>
    <input type="email" required="" placeholder="Adresa prietenului de email" id="friend-email" value="" name="EMAIL" class="text">    
    <br/>
    <input type="submit" value="Invita la newsletter" name="subscribe" id="invite" >
  </div>
</div>

