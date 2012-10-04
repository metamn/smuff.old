<?php
	if (!isset($mailchimp_button)) {
		$mailchimp_button = "Inscriere la newsletter";
	}
?>

<div id="mailchimp-api" data-nonce="<?php echo wp_create_nonce('mailchimp_subscribe') ?>" >
	<input type="email" required="" placeholder="Adresa Dvs. de email" id="email" value="" name="EMAIL" class="email">    
	<input type="submit" value="<?php echo $mailchimp_button ?>" name="subscribe" id="invite" >
</div>
